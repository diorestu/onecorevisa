<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\CopyText;
use App\Models\PageContent;
use App\Models\Service;
use App\Support\CmsContent;
use App\Support\CmsForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CmsController extends Controller
{
    private const MODULES = ['copywriting' => [CopyText::class, 'Copywriting'], 'content' => [PageContent::class, 'Konten Halaman'], 'articles' => [Article::class, 'Artikel'], 'categories' => [Category::class, 'Kategori'], 'services' => [Service::class, 'Layanan']];

    private function module(string $module): array
    {
        abort_unless(isset(self::MODULES[$module]), 404);

        return self::MODULES[$module];
    }

    public function index(Request $request, string $module)
    {
        [$model,$title] = $this->module($module);
        $filters = $request->validate(['q' => 'nullable|string|max:150', 'category_id' => 'nullable|integer', 'type' => 'nullable|in:article,service', 'status' => 'nullable|in:draft,published']);
        $query = $model::query();
        if ($module === 'content') {
            $query->where('key', '!=', 'initialized');
        }
        if (! empty($filters['q'])) {
            $column = in_array($module, ['copywriting', 'content']) ? 'label' : 'translations';
            $query->where($column, 'like', '%'.addcslashes($filters['q'], '%_\\').'%');
        }
        if (in_array($module, ['articles', 'services'])) {
            if (! empty($filters['category_id'])) {
                $query->where('category_id', $filters['category_id']);
            }
            if (! empty($filters['status'])) {
                $query->where('status', $filters['status']);
            }
        }
        if ($module === 'categories' && ! empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        $records = $query->orderByDesc('updated_at')->orderBy('id')->paginate(15)->withQueryString();
        $categories = Category::where('type', $module === 'articles' ? 'article' : 'service')->orderBy('sort_order')->get();
        $landingPageLocations = $module === 'categories' ? app(CmsContent::class)->landingPageCategoryLocations() : [];

        return view('admin.index', compact('module', 'title', 'records', 'categories', 'landingPageLocations'));
    }

    public function create(string $module)
    {
        [$model,$title] = $this->module($module);
        abort_if(in_array($module, ['copywriting', 'content']), 404);

        return $this->form($module, new $model, $title);
    }

    public function edit(string $module, int $id)
    {
        [$model,$title] = $this->module($module);
        $record = $model::findOrFail($id);
        abort_if($module === 'content' && $record->key === 'initialized', 404);

        return $this->form($module, $record, $title);
    }

    private function form(string $module, mixed $record, string $title)
    {
        $schema = CmsForm::schema($module, $record);
        $categories = Category::where('type', $module === 'articles' ? 'article' : 'service')->orderBy('sort_order')->get();

        return view('admin.edit', compact('module', 'record', 'title', 'schema', 'categories'));
    }

    public function store(Request $request, string $module)
    {
        [$model] = $this->module($module);
        abort_if(in_array($module, ['copywriting', 'content']), 404);

        return $this->save($request, $module, new $model);
    }

    public function update(Request $request, string $module, int $id)
    {
        [$model] = $this->module($module);
        $record = $model::findOrFail($id);
        abort_if($module === 'content' && $record->key === 'initialized', 404);

        return $this->save($request, $module, $record);
    }

    private function save(Request $request, string $module, mixed $record)
    {
        $schema = CmsForm::schema($module, $record);
        $rules = CmsForm::rules($schema);
        $rules['uploads'] = 'nullable|array|max:30';
        $rules['uploads.*'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
        $rules['image_upload'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
        if (in_array($module, ['categories', 'services', 'articles'])) {
            $rules += ['slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique($record->getTable(), 'slug')->ignore($record->id)]];
        }
        if (in_array($module, ['categories', 'services'])) {
            $rules['sort_order'] = 'nullable|integer|min:0|max:99999';
        }
        if ($module === 'categories') {
            $rules += ['type' => 'required|in:article,service', 'is_active' => 'required|boolean'];
        }
        if (in_array($module, ['services', 'articles'])) {
            $rules += ['category_id' => [$module === 'services' ? 'required' : 'nullable', 'integer', Rule::exists('categories', 'id')->where('type', $module === 'services' ? 'service' : 'article')], 'status' => 'required|in:draft,published'];
        }
        if ($module === 'articles') {
            $rules['published_at'] = 'nullable|date';
        }
        if ($module === 'content' && $record->key === 'contact') {
            foreach (['en', 'id'] as $locale) {
                $rules += ["translations.$locale.whatsapp" => 'required|regex:/^[1-9][0-9]{7,15}$/', "translations.$locale.email" => 'required|email|max:150', "translations.$locale.instagram_url" => 'nullable|url:http,https|max:255'];
            }
        }
        $validated = $request->validate($rules);
        if ($module === 'categories' && $record->exists) {
            if ($record->source_key && ($validated['slug'] !== $record->slug || $validated['type'] !== 'service')) {
                throw ValidationException::withMessages(['slug' => 'Slug dan jenis kategori layanan yang sudah ada tidak dapat diubah.']);
            }
            if ($validated['type'] !== $record->type && ($record->services()->withTrashed()->exists() || $record->articles()->exists())) {
                throw ValidationException::withMessages(['type' => 'Jenis kategori yang sedang digunakan tidak dapat diubah.']);
            }
        }
        if ($module === 'services' && $record->exists && ($validated['slug'] !== $record->slug || (int) $validated['category_id'] !== $record->category_id)) {
            throw ValidationException::withMessages(['slug' => 'Slug dan kategori layanan yang sudah disimpan tidak dapat diubah agar URL tetap berfungsi.']);
        }
        $values = $validated;
        $stored = [];
        try {
            DB::transaction(function () use ($request, $module, $record, $validated, $schema, &$values, &$stored) {
                foreach ($request->file('uploads', []) as $field => $file) {
                    $path = str_replace('__', '.', $field);
                    $rulePath = preg_replace('/\.\d+(?=\.|$)/', '.*', $path);
                    if (! array_key_exists($rulePath, CmsForm::imagePaths($schema))) {
                        continue;
                    }
                    $stored[] = $file->store('cms', 'public');
                    data_set($values, $path, end($stored));
                }
                $values = CmsForm::clean($schema, $values);
                if ($module === 'services') {
                    $values['details'] = array_replace($record->details ?? [], $values['details']);
                    $values['pricing'] = array_replace($record->pricing ?? [], $values['pricing']);
                    $values['pricing'] = array_filter($values['pricing'], fn ($v) => $v !== null && $v !== '' && $v !== []);
                    $values['pricing'] = $this->normalizePricing($values['pricing']);
                    foreach (['en', 'id'] as $locale) {
                        $values['translations'][$locale] = array_replace($record->translations[$locale] ?? [], $values['translations'][$locale]);
                    }
                    foreach (['en', 'id'] as $locale) {
                        if (empty($values['translations'][$locale]['whatsAllowed'])) {
                            $values['translations'][$locale]['whatsAllowed'] = [$values['translations'][$locale]['summary'] ?: $values['translations'][$locale]['title']];
                        }
                    }
                }
                if ($module === 'categories') {
                    $values['details'] = array_replace($record->details ?? [], $values['details']);
                    $values['source_key'] = $record->source_key ?: ($validated['type'] === 'service' ? $validated['slug'] : null);
                }
                if ($module === 'content') {
                    $this->validatePageLinks($record, $values);
                }
                foreach (['slug', 'category_id', 'status', 'sort_order', 'type', 'is_active', 'published_at'] as $key) {
                    if (array_key_exists($key, $validated)) {
                        $values[$key] = $validated[$key];
                    }
                }
                if ($module === 'articles' && $validated['status'] === 'published' && empty($values['published_at'])) {
                    $values['published_at'] = now();
                }
                if ($module === 'articles' && $request->hasFile('image_upload')) {
                    $stored[] = $request->file('image_upload')->store('cms', 'public');
                    $values['image'] = end($stored);
                }
                $record->fill($values)->save();
            });
        } catch (\Throwable $e) {
            foreach ($stored as $path) {
                Storage::disk('public')->delete($path);
            } throw $e;
        }

        return redirect()->route('admin.cms.index', $module)->with('status', 'Perubahan berhasil disimpan.');
    }

    private function validatePageLinks(PageContent $record, array $values): void
    {
        if (in_array($record->key, ['serviceHighlights', 'visaTypes'], true) && count($values['translations']['en']) !== count($values['translations']['id'])) {
            throw ValidationException::withMessages(['translations' => 'Jumlah item English dan Indonesia harus sama agar pasangan terjemahan sesuai.']);
        }
        if ($record->key !== 'serviceHighlights') {
            return;
        }
        $allowed = array_merge(array_keys(app(CmsContent::class)->categories()), ['e-visa-voa', 'single-entry-visas', 'multiple-entry-visas']);
        foreach (['en', 'id'] as $locale) {
            foreach ($values['translations'][$locale] as $item) {
                if (! in_array($item['slug'], $allowed, true)) {
                    throw ValidationException::withMessages(['translations' => 'Tujuan sorotan harus menggunakan slug kategori layanan yang aktif.']);
                }
            }
        }
    }

    private function normalizePricing(array $pricing): ?array
    {
        foreach ($pricing['options'] ?? [] as $index => $option) {
            if (! isset($option['idr']) || empty($option['label'][0]) || empty($option['label'][1])) {
                throw ValidationException::withMessages(['pricing.options.'.$index.'.idr' => 'Setiap opsi harga memerlukan nominal IDR dan label EN / ID.']);
            }
            $pricing['options'][$index] = array_filter($option, fn ($v) => $v !== null && $v !== '' && $v !== []);
        }
        if (! isset($pricing['idr']) && empty($pricing['options'])) {
            return null;
        }
        if (! isset($pricing['idr'])) {
            $pricing['idr'] = $pricing['options'][0]['idr'];
        }

        return $pricing;
    }

    public function destroy(string $module, int $id)
    {
        [$model] = $this->module($module);
        abort_if(in_array($module, ['copywriting', 'content']), 405);
        $record = $model::findOrFail($id);
        if ($module === 'categories' && ($record->source_key || $record->services()->withTrashed()->exists() || $record->articles()->exists())) {
            throw ValidationException::withMessages(['category' => 'Kategori bawaan atau yang sedang digunakan tidak dapat dihapus. Nonaktifkan kategori jika diperlukan.']);
        }
        $record->delete();

        return redirect()->route('admin.cms.index', $module)->with('status', 'Data berhasil dihapus.');
    }
}

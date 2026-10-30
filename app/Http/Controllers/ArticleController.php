<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Support\CmsContent;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class ArticleController extends Controller
{
    private function locale(Request $request): string
    {
        $locale = $request->query('lang', 'en');
        abort_unless(in_array($locale, ['en', 'id'], true), 404);

        return $locale;
    }

    private function shared(string $lang): array
    {
        return app(CmsContent::class)->data($lang) + ['lang' => $lang, 'serviceCategories' => app(CmsContent::class)->categories()];
    }

    public function index(Request $request)
    {
        $lang = $this->locale($request);
        $filters = $request->validate(['category' => 'nullable|string|max:160']);
        $categories = Schema::hasTable('categories') ? Category::where('type', 'article')->where('is_active', true)->orderBy('sort_order')->get() : collect();
        $articles = Schema::hasTable('articles') ? Article::published()->with('category')->when(! empty($filters['category']), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $filters['category'])))->latest('published_at')->paginate(9)->withQueryString() : new LengthAwarePaginator([], 0, 9);

        return view('articles.index', array_replace($this->shared($lang), compact('articles', 'categories'), ['articleIndex' => true]));
    }

    public function show(Request $request, string $slug)
    {
        $lang = $this->locale($request);
        abort_unless(Schema::hasTable('articles'), 404);
        $article = Article::published()->where('slug', $slug)->with('category')->firstOrFail();

        return view('articles.show', $this->shared($lang) + compact('article'));
    }

    public function preview(Request $request, int $id)
    {
        $lang = $this->locale($request);
        $article = Article::with('category')->findOrFail($id);

        return response()->view('articles.show', $this->shared($lang) + compact('article') + ['preview' => true])->header('X-Robots-Tag','noindex, nofollow');
    }
}

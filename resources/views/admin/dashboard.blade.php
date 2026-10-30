@extends('admin.layout')
@section('content')
<div class="row row-cards">
@foreach(['copywriting' => ['Copywriting', \App\Models\CopyText::count(), 'Teks navigasi, judul, dan tombol website.'], 'content' => ['Konten Halaman', \App\Models\PageContent::where('key','!=','initialized')->count(), 'Bagian halaman dan informasi kontak.'], 'articles' => ['Artikel', \App\Models\Article::count(), 'Berita, kategori artikel, dan publikasi.'], 'categories' => ['Kategori', \App\Models\Category::count(), 'Pengelompokan artikel dan layanan.'], 'services' => ['Layanan', \App\Models\Service::count(), 'Visa, legalitas, persyaratan, dan harga.']] as $path => [$label, $count, $description])
<div class="col-md-6 col-xl-4"><a class="card card-link" href="{{ url('/admin/'.$path) }}"><div class="card-body"><div class="subheader">{{ $label }}</div><div class="h1 my-2">{{ number_format($count) }}</div><p class="text-secondary mb-0">{{ $description }}</p></div></a></div>
@endforeach
</div>
@if(!\App\Models\PageContent::exists())<div class="alert alert-info mt-4">Konten awal belum diimpor. Jalankan <code>php artisan cms:import</code> untuk memuat konten website yang ada.</div>@endif
<div class="card mt-4"><div class="card-body"><h2 class="card-title">Pengelolaan EN dan ID</h2><p class="text-secondary mb-0">Edit kedua bahasa di setiap formulir. Artikel dan layanan berstatus draft tidak tampil di website. Konten halaman dan copywriting yang disimpan langsung tampil di website.</p></div></div>
@endsection

<!doctype html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ $title ?? 'Dashboard' }} | OneCoreVisa Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/cms.css') }}">
    <script src="{{ asset('assets/admin/cms.js') }}" defer></script>
</head>
<body>
<a class="visually-hidden-focusable" href="#main">Lewati navigasi</a>
<div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg" aria-label="Navigasi admin">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/admin') }}"><img src="{{ asset('assets/images/onecore-logo-horizontal.png') }}" width="164" height="48" alt="OneCoreVisa"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#admin-menu" aria-controls="admin-menu" aria-expanded="false" aria-label="Buka navigasi"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="admin-menu">
                <ul class="navbar-nav pt-lg-3">
                    @foreach(['' => 'Dashboard', 'copywriting' => 'Copywriting', 'content' => 'Konten Halaman', 'articles' => 'Artikel', 'categories' => 'Kategori', 'services' => 'Layanan'] as $path => $label)
                    <li class="nav-item {{ request()->is($path ? 'admin/'.$path.'*' : 'admin') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/admin/'.$path) }}"><span class="nav-link-title">{{ $label }}</span></a></li>
                    @endforeach
                </ul>
                <div class="mt-auto p-3"><p class="text-secondary small mb-2">{{ auth()->user()->name }}</p><a class="btn btn-outline-secondary w-100 mb-2" href="{{ route('home') }}" target="_blank" rel="noopener">Lihat website</a><form method="post" action="{{ route('admin.logout') }}">@csrf<button class="btn w-100" type="submit">Keluar</button></form></div>
            </div>
        </div>
    </aside>
    <div class="page-wrapper">
        <header class="page-header"><div class="container-xl"><div class="row align-items-center"><div class="col"><div class="page-pretitle">OneCoreVisa · Content Management</div><h1 class="page-title">{{ $title ?? 'Dashboard' }}</h1></div><div class="col-auto">@yield('actions')</div></div></div></header>
        <main class="page-body" id="main"><div class="container-xl">
            @if(session('status'))<div class="alert alert-success" role="status">{{ session('status') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger" role="alert"><h2 class="h4">Periksa kembali isian Anda</h2><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </div></main>
        <footer class="footer footer-transparent"><div class="container-xl text-secondary small">OneCoreVisa Admin · Tabler Free (MIT) · Konten EN / ID</div></footer>
    </div>
</div>
<script src="{{ asset('assets/admin/tabler.min.js') }}" defer></script>
</body></html>

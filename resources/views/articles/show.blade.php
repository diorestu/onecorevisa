@extends('layouts.app')
@section('content')
@php($translation=$article->translations[$lang])
<article class="article-reading container">
@if($preview??false)<div class="article-preview" role="status">Pratinjau {{ strtoupper($lang) }} · {{ $article->status }} · <a href="{{ route('admin.cms.edit',['articles',$article->id]) }}">Kembali ke editor</a></div>@endif
<nav class="service-breadcrumbs" aria-label="Breadcrumb"><a href="{{ route('articles.index',['lang'=>$lang]) }}">{{ $lang==='id'?'Artikel & Berita':'Articles & News' }}</a></nav>
<header><p class="section-label">{{ $article->category?->title($lang) }}</p><h1>{{ $article->title($lang) }}</h1>@if($article->published_at)<time datetime="{{ $article->published_at->toAtomString() }}">{{ $article->published_at->format('d M Y') }}</time>@endif<p class="article-excerpt">{{ $translation['excerpt']??'' }}</p></header>
@if($article->image)<img class="article-cover" src="{{ \App\Support\CmsContent::image($article->image) }}" alt="{{ $translation['image_alt']??'' }}" width="1200" height="750">@endif
<div class="article-body">{!! \App\Support\ArticleBody::render($translation['body']) !!}</div>
<a class="button secondary" href="{{ route('articles.index',['lang'=>$lang]) }}">{{ $lang==='id'?'Kembali ke artikel':'Back to articles' }}</a>
</article>
@endsection

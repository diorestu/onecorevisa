<div class="article-grid">
@foreach($articles as $story)
@php($translation=$story->translations[$lang==='id'?'id':'en'])
<article class="news-card">
    @if($story->image)<a href="{{ route('articles.show',['slug'=>$story->slug,'lang'=>$lang]) }}" tabindex="-1" aria-hidden="true"><img src="{{ \App\Support\CmsContent::image($story->image) }}" alt="{{ $translation['image_alt']??'' }}" width="640" height="400" loading="lazy"></a>@endif
    <div class="news-card-content">@if($story->category)<p class="section-label">{{ $story->category->title($lang) }}</p>@endif<h2><a href="{{ route('articles.show',['slug'=>$story->slug,'lang'=>$lang]) }}">{{ $story->title($lang) }}</a></h2><time datetime="{{ $story->published_at->toAtomString() }}">{{ $story->published_at->format('d M Y') }}</time><p>{{ $translation['excerpt']??'' }}</p><a class="text-link" href="{{ route('articles.show',['slug'=>$story->slug,'lang'=>$lang]) }}">{{ $lang==='id'?'Baca artikel':'Read article' }}</a></div>
</article>
@endforeach
</div>

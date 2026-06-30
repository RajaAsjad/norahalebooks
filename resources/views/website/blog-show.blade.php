@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)
@section('content')
<div class="page">
    <article class="sec">
        <div class="c article-wrap">
            <header class="article-header rev">
                <span class="sl">Blog</span>
                <h1 class="sttl xl">{{ $post->title }}</h1>
                <div class="article-meta">
                    @if($post->author)<span>By {{ $post->author }}</span>@endif
                    @if($post->published_at)<time>{{ $post->published_at->format('F j, Y') }}</time>@endif
                </div>
            </header>
            @if($post->imageUrl())
                <div class="article-featured rev" data-delay="100">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                </div>
            @endif
            <div class="article-body rev" data-delay="150">
                {!! $post->body !!}
            </div>
            <div class="article-footer rev" data-delay="200">
                <a href="{{ route('blog') }}" class="btn btn-s">← Back to Blog</a>
            </div>
        </div>
    </article>
</div>
@endsection

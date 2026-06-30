@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)
@section('content')
<div class="page">
    <section class="sec">
        <div class="c">
            <div class="detail-grid">
                <div class="detail-cover rev">
                    @if($book->coverUrl())
                        <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }} book cover">
                    @else
                        <div class="book-card-placeholder">{{ $book->title }}</div>
                    @endif
                </div>
                <div class="detail-body rev" data-delay="100">
                    <span class="sl">Book</span>
                    <h1 class="sttl lg">{{ $book->title }}</h1>
                    @if($book->subtitle)<p class="detail-sub">{{ $book->subtitle }}</p>@endif
                    <div class="detail-actions">
                        @if($book->amazon_url)
                            <a href="{{ $book->amazon_url }}" class="btn btn-p" target="_blank" rel="noopener sponsored">Buy on Amazon</a>
                        @endif
                        @if($book->other_buy_url)
                            <a href="{{ $book->other_buy_url }}" class="btn btn-s" target="_blank" rel="noopener">{{ $book->other_buy_label ?: 'Buy Now' }}</a>
                        @endif
                    </div>
                    @if($book->description)
                        <div class="detail-content">{!! nl2br(e($book->description)) !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Browse Nora Hale\'s wellness books including Castor Oil for Life and Simple Habits for a Vibrant Life.')
@section('content')
<div class="page">
    <section class="page-hero mesh">
        <div class="c">
            <span class="badge be">Books</span>
            <h1 class="page-hero-title">Books by <span class="gt">Nora Hale</span></h1>
            <p class="page-hero-sub">Science-backed wellness guides for radiant skin, vibrant health, and simple daily habits.</p>
        </div>
    </section>
    <section class="sec">
        <div class="c">
            @if($books->isEmpty())
                <div class="empty-state rev">
                    <h3>Books coming soon</h3>
                    <p>Check back shortly — or <a href="{{ route('connect') }}">join the newsletter</a> for updates.</p>
                </div>
            @else
                <div class="book-grid">
                    @foreach($books as $book)
                        @include('website.partials.book-card', ['book' => $book])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

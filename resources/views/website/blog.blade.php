@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Wellness blog by Nora Hale — natural health, castor oil, recipes, and simple habits for vibrant living.')
@section('content')
<div class="page">
    <section class="page-hero mesh">
        <div class="c">
            <span class="badge bl">Blog</span>
            <h1 class="page-hero-title">Wellness <span class="gt">Blog</span></h1>
            <p class="page-hero-sub">Tips, stories, and science-backed wisdom from Nora Hale.</p>
        </div>
    </section>
    <section class="sec">
        <div class="c">
            @if($posts->isEmpty())
                <div class="empty-state rev"><h3>No posts yet</h3><p>New articles are on the way.</p></div>
            @else
                <div class="card-grid">@foreach($posts as $post)@include('website.partials.blog-card', ['post' => $post])@endforeach</div>
                <div class="pagination-wrap">{{ $posts->links() }}</div>
            @endif
        </div>
    </section>
</div>
@endsection

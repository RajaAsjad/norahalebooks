@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Nora Hale\'s favorite wellness products — curated picks with direct buy links to Amazon and trusted marketplaces.')
@section('content')
<div class="page">
    <section class="page-hero mesh">
        <div class="c">
            <span class="badge bp">Shop Favorites</span>
            <h1 class="page-hero-title">Nora's <span class="gt">Favorites</span></h1>
            <p class="page-hero-sub">Curated wellness products Nora loves — tap Buy to shop on Amazon or other marketplaces.</p>
        </div>
    </section>
    <section class="sec">
        <div class="c">
            @if($products->isEmpty())
                <div class="empty-state rev"><h3>Favorites coming soon</h3><p>Check back for curated product picks.</p></div>
            @else
                <div class="product-grid">
                    @foreach($products as $product)
                        @include('website.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

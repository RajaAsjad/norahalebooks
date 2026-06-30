@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', 'Natural wellness recipes from Nora Hale — castor oil remedies, kitchen favorites, and bonus recipe collections.')
@section('content')
<div class="page">
    <section class="page-hero mesh">
        <div class="c">
            <span class="badge bg">Recipes</span>
            <h1 class="page-hero-title">Natural <span class="gt">Recipes</span></h1>
            <p class="page-hero-sub">Practical recipes and remedies from Nora's wellness kitchen.</p>
            <a href="{{ route('bonusrecipes') }}" class="btn btn-p" style="margin-top:20px">Get Bonus Recipes Free →</a>
        </div>
    </section>
    <section class="sec">
        <div class="c">
            @if($recipes->isEmpty())
                <div class="empty-state rev"><h3>Recipes coming soon</h3><p><a href="{{ route('bonusrecipes') }}">Sign up</a> for the bonus recipes collection.</p></div>
            @else
                <div class="card-grid">@foreach($recipes as $recipe)@include('website.partials.recipe-card', ['recipe' => $recipe])@endforeach</div>
                <div class="pagination-wrap">{{ $recipes->links() }}</div>
            @endif
        </div>
    </section>
</div>
@endsection

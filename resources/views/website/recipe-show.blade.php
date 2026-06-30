@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)
@section('content')
<div class="page">
    <article class="sec">
        <div class="c article-wrap">
            <header class="article-header rev">
                <span class="sl">Recipe</span>
                <h1 class="sttl xl">{{ $recipe->title }}</h1>
                <div class="recipe-meta">
                    @if($recipe->prep_time)<span>Prep: {{ $recipe->prep_time }}</span>@endif
                    @if($recipe->cook_time)<span>Cook: {{ $recipe->cook_time }}</span>@endif
                    @if($recipe->servings)<span>Serves: {{ $recipe->servings }}</span>@endif
                </div>
            </header>
            @if($recipe->imageUrl())
                <div class="article-featured rev" data-delay="100"><img src="{{ $recipe->imageUrl() }}" alt="{{ $recipe->title }}"></div>
            @endif
            @if($recipe->excerpt)<p class="recipe-intro rev" data-delay="120">{{ $recipe->excerpt }}</p>@endif
            <div class="recipe-columns rev" data-delay="150">
                @if($recipe->ingredients)
                    <div class="recipe-block">
                        <h2>Ingredients</h2>
                        <ul class="ingredient-list">
                            @foreach(preg_split('/\r\n|\r|\n/', $recipe->ingredients) as $line)
                                @if(trim($line))<li>{{ trim($line) }}</li>@endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($recipe->instructions)
                    <div class="recipe-block">
                        <h2>Instructions</h2>
                        <div class="detail-content">{!! nl2br(e($recipe->instructions)) !!}</div>
                    </div>
                @endif
            </div>
            <div class="article-footer rev" data-delay="200">
                <a href="{{ route('recipes') }}" class="btn btn-s">← All Recipes</a>
            </div>
        </div>
    </article>
</div>
@endsection

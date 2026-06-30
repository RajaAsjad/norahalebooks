<article class="content-card rev">
    <a href="{{ route('recipes.show', $recipe) }}" class="content-card-link">
        <div class="content-card-img">
            @if($recipe->imageUrl())
                <img src="{{ $recipe->imageUrl() }}" alt="{{ $recipe->title }}" loading="lazy">
            @else
                <div class="content-card-placeholder">Recipe</div>
            @endif
        </div>
        <div class="content-card-body">
            @if($recipe->prep_time)<span class="card-date">{{ $recipe->prep_time }}</span>@endif
            <h3>{{ $recipe->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($recipe->excerpt), 100) }}</p>
        </div>
    </a>
</article>

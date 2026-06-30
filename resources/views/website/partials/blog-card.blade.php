<article class="content-card rev">
    <a href="{{ route('blog.show', $post) }}" class="content-card-link">
        <div class="content-card-img">
            @if($post->imageUrl())
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" loading="lazy">
            @else
                <div class="content-card-placeholder">Blog</div>
            @endif
        </div>
        <div class="content-card-body">
            <time class="card-date">{{ $post->published_at?->format('M j, Y') }}</time>
            <h3>{{ $post->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->body), 120) }}</p>
        </div>
    </a>
</article>

<article class="book-card rev">
    <a href="{{ route('books.show', $book) }}" class="book-card-link">
        <div class="book-card-cover">
            @if($book->coverUrl())
                <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }} cover" loading="lazy">
            @else
                <div class="book-card-placeholder">{{ $book->title }}</div>
            @endif
        </div>
        <div class="book-card-body">
            <h3>{{ $book->title }}</h3>
            @if($book->subtitle)<p class="book-card-sub">{{ $book->subtitle }}</p>@endif
        </div>
    </a>
    <div class="book-card-actions">
        @if($book->amazon_url)
            <a href="{{ $book->amazon_url }}" class="btn-buy" target="_blank" rel="noopener sponsored">Buy on Amazon</a>
        @endif
        @if($book->other_buy_url)
            <a href="{{ $book->other_buy_url }}" class="btn-buy btn-buy-alt" target="_blank" rel="noopener">{{ $book->other_buy_label ?: 'Buy Now' }}</a>
        @endif
    </div>
</article>

<article class="product-card rev">
    <div class="product-card-img">
        @if($product->imageUrl())
            <img src="{{ $product->imageUrl() }}" alt="{{ $product->title }}" loading="lazy">
        @else
            <div class="content-card-placeholder">Product</div>
        @endif
    </div>
    <div class="product-card-body">
        @if($product->category)<span class="card-date">{{ $product->category }}</span>@endif
        <h3>{{ $product->title }}</h3>
        @if($product->description)<p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p>@endif
        <div class="product-card-actions">
            @if($product->amazon_url)
                <a href="{{ $product->amazon_url }}" class="btn-buy" target="_blank" rel="noopener sponsored">Buy on Amazon</a>
            @endif
            @if($product->other_url)
                <a href="{{ $product->other_url }}" class="btn-buy btn-buy-alt" target="_blank" rel="noopener">{{ $product->other_label ?: 'Buy Now' }}</a>
            @endif
        </div>
    </div>
</article>

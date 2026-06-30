@extends('layouts.website.master')

@section('title', $page_title)
@section('meta_description', $site['description'] ?? '')

@section('content')
<div class="page">
    <section class="hero hero-nora">
        <canvas id="hero-canvas" class="hero-canvas" aria-hidden="true"></canvas>
        <div class="blob blob-a"></div>
        <div class="blob blob-b"></div>
        <div class="c">
            <div class="hgrid">
                <div>
                    <div class="fu d1"><span class="badge be">Wellness Author</span></div>
                    <h1 class="hh1 fu d2">
                        {{ $site['name'] ?? 'Nora Hale Books' }}
                    </h1>
                    <p class="hsub fu d3">
                        {{ $site['tagline'] ?? 'Author of Castor Oil for Life' }} — science-backed books, natural recipes, and simple habits for radiant health at every age.
                    </p>
                    <div class="hbtns fu d4">
                        <a href="{{ route('books') }}" class="btn btn-p">Explore Books →</a>
                        <a href="{{ route('connect') }}" class="btn btn-s">Join Newsletter</a>
                    </div>
                    <div class="hsr fu d5">
                        @include('layouts.website.partials.social-icons')
                    </div>
                </div>
                <div class="hvis fu" style="animation-delay:.5s">
                    @if($books->isNotEmpty() && $books->first()->coverUrl())
                        <div class="hiw gb book-hero-cover">
                            <img src="{{ $books->first()->coverUrl() }}" alt="{{ $books->first()->title }} book cover">
                        </div>
                    @else
                        <div class="hiw gb book-hero-placeholder">
                            <span>Castor Oil for Life</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="hscroll"><span>Scroll</span><div class="hscroll-l"></div></div>
    </section>

    @if(!empty($site['features']['marquee']))
    <div class="mq">
        <div class="mq-t" id="mqt"></div>
    </div>
    @endif

    @if($books->isNotEmpty())
    <section class="sec">
        <div class="c">
            <div class="sh rev">
                <span class="sl">Featured Books</span>
                <h2 class="sttl xl">Wellness Guides by Nora Hale</h2>
            </div>
            <div class="book-grid rev" data-delay="100">
                @foreach($books as $book)
                    @include('website.partials.book-card', ['book' => $book])
                @endforeach
            </div>
            <div style="text-align:center;margin-top:40px" class="rev" data-delay="200">
                <a href="{{ route('books') }}" class="btn btn-s">View All Books</a>
            </div>
        </div>
    </section>
    @endif

    <section class="sec sec-alt">
        <div class="c">
            <div class="abt-og">
                <div class="rev">
                    <span class="sl" style="display:block;margin-bottom:12px">Meet the Author</span>
                    <h2 class="sttl lg" style="margin-bottom:20px">Nora Hale — RN, Author & Wellness Advocate</h2>
                    <div class="ogp">
                        <p>Meet Nora Hale, a 68-year-old dynamo who proves it's never too late to reinvent your life. After an accomplished career as a Registered Nurse, Nora traded her scrubs for a pen and a mission: to empower people of all ages to embrace the power of small, positive changes.</p>
                        <p>Her passion for wellness comes together in <em>Castor Oil for Life</em> and <em>Simple Habits for a Vibrant Life</em> — practical guides grounded in real medical insight and natural healing.</p>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-p" style="margin-top:20px">Read Nora's Story →</a>
                </div>
                <div class="rev" data-delay="150">
                    <div class="author-card gc">
                        <div class="author-badge">Registered Nurse · Author</div>
                        <h3>Simple, science-backed habits that make a world of difference.</h3>
                        <p>Feeling energized, focused, and joyful doesn't require drastic life overhauls — just the right guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($recipes->isNotEmpty())
    <section class="sec">
        <div class="c">
            <div class="sh rev"><span class="sl">From the Kitchen</span><h2 class="sttl lg">Latest Recipes</h2></div>
            <div class="card-grid rev" data-delay="100">
                @foreach($recipes as $recipe)
                    @include('website.partials.recipe-card', ['recipe' => $recipe])
                @endforeach
            </div>
            <div style="text-align:center;margin-top:32px"><a href="{{ route('recipes') }}" class="btn btn-s">All Recipes</a></div>
        </div>
    </section>
    @endif

    @if($posts->isNotEmpty())
    <section class="sec sec-alt">
        <div class="c">
            <div class="sh rev"><span class="sl">On the Blog</span><h2 class="sttl lg">Wellness & Wisdom</h2></div>
            <div class="card-grid rev" data-delay="100">
                @foreach($posts as $post)
                    @include('website.partials.blog-card', ['post' => $post])
                @endforeach
            </div>
            <div style="text-align:center;margin-top:32px"><a href="{{ route('blog') }}" class="btn btn-s">Read the Blog</a></div>
        </div>
    </section>
    @endif

    <section class="cta-sec mesh">
        <div class="cta-in rev">
            <span class="sl">Stay Connected</span>
            <h2 class="cta-h">Get Bonus Recipes & Book Updates</h2>
            <p class="cta-sub">Join Nora's newsletter for exclusive wellness tips, new recipes, and early access to upcoming books.</p>
            <div class="cta-btns">
                <a href="{{ route('connect') }}" class="btn btn-p">Newsletter Signup</a>
                <a href="{{ route('bonusrecipes') }}" class="btn btn-s">Bonus Recipes</a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>document.addEventListener('DOMContentLoaded', initHeroCanvas);</script>
@endpush

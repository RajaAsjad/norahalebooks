@php
    $navActive = '';
    foreach ($site['pages'] ?? [] as $page) {
        if (request()->routeIs($page['route'])) {
            $navActive = $page['route'];
            break;
        }
    }
@endphp

<nav id="nav">
    <div class="ni">
        <a href="{{ route('index') }}" class="logo">
            @include('layouts.website.partials.logo-mark')
        </a>
        <ul class="nav-links">
            @foreach ($site['pages'] ?? [] as $page)
                <li>
                    <a href="{{ route($page['route']) }}" class="{{ $navActive === $page['route'] ? 'act' : '' }}">
                        {{ $page['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="nav-r">
            <div class="nav-soc">
                @include('layouts.website.partials.social-icons')
            </div>
            @if (!empty($site['nav_cta']['enabled']))
                <a href="{{ route($site['nav_cta']['route'] ?? 'contact') }}" class="ncta">
                    {{ $site['nav_cta']['label'] ?? 'Get Started' }}
                </a>
            @endif
        </div>
        <button type="button" class="hbg" onclick="tmm()" aria-label="Menu">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
    </div>
</nav>

<div class="mm" id="mm">
    <div class="mm-head">
        <span class="logo-text">{{ strtoupper($site['name'] ?? 'SITE') }}</span>
        <button type="button" class="xbtn" onclick="tmm()" aria-label="Close">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <div class="mm-links">
        @foreach ($site['pages'] ?? [] as $page)
            <a href="{{ route($page['route']) }}" onclick="tmm()">{{ $page['label'] }}</a>
        @endforeach
    </div>
    <div class="mm-foot">
        <p>Follow Us</p>
        <div style="display:flex;gap:10px">
            @include('layouts.website.partials.social-icons')
        </div>
    </div>
</div>

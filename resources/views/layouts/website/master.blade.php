<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', $site['description'] ?? '')">
    <meta name="keywords" content="@yield('keywords', $site['name'] ?? '')">
    <meta property="og:title" content="@yield('title', $site['name'] ?? 'Website')">
    <meta property="og:description" content="@yield('meta_description', $site['description'] ?? '')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <title>@yield('title', $site['name'] ?? 'Website')</title>
    @php $fav = trim($home_page_data['header_favicon'] ?? ''); @endphp
    @if ($fav !== '')
        <link rel="icon" href="{{ asset('public/admin/assets/images/page/' . $fav) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset($site['assets']['favicon'] ?? 'assets/website/favicon.svg') }}" type="image/svg+xml">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if (!empty($site['theme']['google_fonts']))
        <link href="{{ $site['theme']['google_fonts'] }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset($site['assets']['css'] ?? 'assets/website/css/site.css') }}">
    <style>
        :root {
            --primary: {{ $site['theme']['primary'] ?? '#2D6A4F' }};
            --secondary: {{ $site['theme']['secondary'] ?? '#B8860B' }};
            --accent: {{ $site['theme']['accent'] ?? '#40916C' }};
            --bg0: {{ $site['theme']['background'] ?? '#FAF8F4' }};
        }
    </style>
    @stack('styles')
</head>
<body>
    @if (!empty($site['features']['page_loader']))
        <div id="page-loader" class="page-loader" aria-hidden="true">
            <canvas id="loader-canvas" class="loader-canvas"></canvas>
            <div class="loader-inner">
                <div class="loader-logo">{{ $site['short_name'] ?? 'NHB' }}</div>
                <div class="loader-bar"><span class="loader-bar-fill"></span></div>
                <p class="loader-text">{{ $site['name'] ?? 'Loading' }}</p>
            </div>
        </div>
    @endif

    @include('layouts.website.header')

    <main>@yield('content')</main>

    @include('layouts.website.footer')

    <script>
        window.SITE_MARQUEE_ITEMS = @json($site['marquee_items'] ?? []);
        window.SITE_CANVAS_HERO = {{ !empty($site['features']['canvas_hero']) ? 'true' : 'false' }};
    </script>
    <script src="{{ asset($site['assets']['js'] ?? 'assets/website/js/site.js') }}" defer></script>
    @stack('scripts')
</body>
</html>

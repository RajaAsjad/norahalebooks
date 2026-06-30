@extends('layouts.admin.app')
@section('title', $page_title ?? 'Dashboard')

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Portfolio theme: cream + pink / orange (Lyllianna site) */
        .pg-dash {
            min-height: calc(100vh - 100px);
            background: linear-gradient(180deg, #fafaf9 0%, #f5f3f0 100%);
            padding: 0 1.5rem 2.5rem;
        }

        .pg-dash__banner {
            width: 100%;
            margin: 15px auto 2.5rem;
            padding: 3.5rem 2rem;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(236, 72, 153, 0.15);
            box-shadow: 0 8px 32px rgba(236, 72, 153, 0.1);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .pg-dash__banner::before {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 55% at 75% 25%, rgba(236, 72, 153, 0.14) 0%, transparent 58%),
                radial-gradient(ellipse 55% 45% at 15% 85%, rgba(249, 115, 22, 0.1) 0%, transparent 52%),
                radial-gradient(ellipse 45% 35% at 92% 70%, rgba(219, 39, 119, 0.08) 0%, transparent 48%);
            animation: pgDashMesh 18s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes pgDashMesh {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(-10px, 12px) scale(1.02);
            }
        }

        .pg-dash__welcome {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .pg-dash__welcome-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 800;
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin: 0;
            background: linear-gradient(135deg, #ec4899 0%, #db2777 45%, #ea580c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: welcomeFloat 3s ease-in-out infinite;
        }

        @keyframes welcomeFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .pg-dash__welcome-subtitle {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 500;
            color: #6b7280;
            margin: 1rem 0 0;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            animation: subtitlePulse 2.5s ease-in-out infinite;
        }

        @keyframes subtitlePulse {

            0%,
            100% {
                opacity: 0.75;
            }

            50% {
                opacity: 1;
            }
        }

        .pg-dash__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .pg-dash__card {
            background: #fff;
            border-radius: 16px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 4px 16px rgba(236, 72, 153, 0.08);
            border: 1px solid rgba(236, 72, 153, 0.12);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s ease, border-color 0.35s ease;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(24px);
            animation: cardFadeIn 0.55s ease forwards;
        }

        .pg-dash__card:nth-child(1) {
            animation-delay: 0.08s;
        }

        .pg-dash__card:nth-child(2) {
            animation-delay: 0.15s;
        }

        .pg-dash__card:nth-child(3) {
            animation-delay: 0.22s;
        }

        .pg-dash__card:nth-child(4) {
            animation-delay: 0.29s;
        }

        .pg-dash__card:nth-child(5) {
            animation-delay: 0.36s;
        }

        .pg-dash__card:nth-child(6) {
            animation-delay: 0.43s;
        }

        .pg-dash__card:nth-child(7) {
            animation-delay: 0.5s;
        }

        .pg-dash__card:nth-child(8) {
            animation-delay: 0.57s;
        }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pg-dash__card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(236, 72, 153, 0.12), transparent);
            transition: left 0.5s ease;
        }

        .pg-dash__card:hover::before {
            left: 100%;
        }

        .pg-dash__card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(236, 72, 153, 0.15);
            border-color: rgba(236, 72, 153, 0.28);
            color: inherit;
            text-decoration: none;
        }

        .pg-dash__card-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .pg-dash__card:hover .pg-dash__card-icon {
            transform: scale(1.08) rotate(4deg);
        }

        .pg-dash__card-icon.brand {
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 50%, #fb923c 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(236, 72, 153, 0.35);
            animation: iconPulse 2.5s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                box-shadow: 0 6px 18px rgba(236, 72, 153, 0.35);
            }

            50% {
                box-shadow: 0 8px 26px rgba(236, 72, 153, 0.5);
            }
        }

        .pg-dash__card-value {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 2.35rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
            background: linear-gradient(135deg, #1a1a1a, #374151);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card:hover .pg-dash__card-value {
            background: linear-gradient(135deg, #ec4899, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pg-dash__card-label {
            font-family: 'Poppins', system-ui, sans-serif;
            font-size: 0.9375rem;
            color: #6b7280;
            margin-top: 0.25rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 1200px) {
            .pg-dash__grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .pg-dash__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pg-dash__banner {
                padding: 2.5rem 1.5rem;
            }

            .pg-dash__card-value {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .pg-dash {
                padding: 0 1rem 1.5rem;
            }

            .pg-dash__banner {
                padding: 2rem 1.25rem;
                margin-bottom: 1.5rem;
            }

            .pg-dash__grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .pg-dash__card {
                padding: 1.25rem;
            }

            .pg-dash__card-value {
                font-size: 1.65rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content pg-dash">
        @php
            /* $sliderIndex = Route::has('homeslider.index') ? route('homeslider.index') : '#'; */
           /*  $bannerIndex = Route::has('banner.index') ? route('banner.index') : '#'; */
            /* $testimonialIndex = Route::has('testimonial.index') ? route('testimonial.index') : '#'; */
            $contactUsIndex = Route::has('contactus.index') ? route('contactus.index') : '#';
           /*  $shopContactIndex = Route::has('shopcontact.index') ? route('shopcontact.index') : '#'; */
           /*  $galleryIndex = Route::has('photogallery.index') ? route('photogallery.index') : '#'; */
            $videoIndex = Route::has('video.index') ? route('video.index') : '#';
           /*  $audioIndex = Route::has('audio.index') ? route('audio.index') : '#'; */
        @endphp

        <div class="pg-dash__banner">
            <div class="pg-dash__welcome">
                <h1 class="pg-dash__welcome-title">Welcome <br>{{ $site['admin']['welcome_message'] ?: ($site['name'] ?? 'Admin') }}</h1>
                <p class="pg-dash__welcome-subtitle">Manage your portfolio</p>
            </div>
        </div>

        <div class="pg-dash__grid">
            {{-- <a href="{{ $sliderIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-sliders" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $slidersTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Home Sliders</div>
            </a> --}}

            {{-- <a href="{{ $bannerIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $bannersTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Banners</div>
            </a> --}}

            {{-- <a href="{{ $testimonialIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $testimonialsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Testimonials</div>
            </a> --}}

            <a href="{{ $contactUsIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $contactUsTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Contact Messages</div>
            </a>

            {{-- <a href="{{ $shopContactIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $shopContactTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Shop Contacts</div>
            </a> --}}

            <a href="{{ $videoIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-video-camera" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $videoTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Videos</div>
            </a>

            {{-- <a href="{{ $audioIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-music" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $audioTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Audio Tracks</div>
            </a>

            <a href="{{ $galleryIndex }}" class="pg-dash__card">
                <div class="pg-dash__card-icon brand"><i class="fa fa-camera" aria-hidden="true"></i></div>
                <div class="pg-dash__card-value">{{ $galleryTotal ?? 0 }}</div>
                <div class="pg-dash__card-label">Photo Gallery</div>
            </a> --}}
        </div>
    </section>
@endsection

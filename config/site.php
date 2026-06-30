<?php

return [

    'name' => env('SITE_NAME', 'Nora Hale Books'),
    'short_name' => env('SITE_SHORT_NAME', 'NHB'),
    'tagline' => env('SITE_TAGLINE', 'Author of Castor Oil for Life'),
    'description' => env('SITE_DESCRIPTION', 'Wellness author Nora Hale shares science-backed books, recipes, and natural health wisdom — from castor oil remedies to simple habits for vibrant living.'),
    'source_url' => env('SITE_SOURCE_URL', 'https://norahalebooks.com'),

    'contact' => [
        'email' => env('SITE_EMAIL', 'hello@norahalebooks.com'),
        'phone' => env('SITE_PHONE', ''),
        'phone_href' => env('SITE_PHONE_HREF', ''),
        'response_note' => env('SITE_RESPONSE_NOTE', 'We reply within 24–48 hours'),
        'address' => env('SITE_ADDRESS', ''),
    ],

    'social' => [
        'facebook' => env('SITE_FACEBOOK', 'https://www.facebook.com/norahalebooks'),
        'instagram' => env('SITE_INSTAGRAM', ''),
        'twitter' => env('SITE_TWITTER', ''),
        'linkedin' => env('SITE_LINKEDIN', ''),
        'youtube' => env('SITE_YOUTUBE', ''),
        'spotify' => env('SITE_SPOTIFY', ''),
        'tiktok' => env('SITE_TIKTOK', ''),
    ],

    'pages' => [
        ['route' => 'index', 'label' => 'Home', 'path' => '/'],
        ['route' => 'about', 'label' => 'About', 'path' => '/about'],
        ['route' => 'books', 'label' => 'Books', 'path' => '/books'],
        ['route' => 'blog', 'label' => 'Blog', 'path' => '/blog'],
        ['route' => 'recipes', 'label' => 'Recipes', 'path' => '/recipes'],
        ['route' => 'favorites', 'label' => 'Favorites', 'path' => '/favorites'],
        ['route' => 'contact', 'label' => 'Contact', 'path' => '/contact'],
    ],

    'nav_cta' => [
        'enabled' => true,
        'label' => 'Newsletter',
        'route' => 'connect',
    ],

    'footer' => [
        'about_text' => env('SITE_FOOTER_TEXT', 'Nora Hale is a retired Registered Nurse and wellness author helping readers embrace simple, science-backed habits for radiant health.'),
        'copyright' => env('SITE_COPYRIGHT', ''),
    ],

    'agency' => [
        'enabled' => env('SITE_AGENCY_ENABLED', false),
        'name' => env('SITE_AGENCY_NAME', 'US Design Agency'),
        'url' => env('SITE_AGENCY_URL', 'https://www.usdesignagency.com/'),
    ],

    'theme' => [
        'mode' => env('SITE_THEME_MODE', 'light'),
        'primary' => env('SITE_COLOR_PRIMARY', '#2D6A4F'),
        'secondary' => env('SITE_COLOR_SECONDARY', '#B8860B'),
        'accent' => env('SITE_COLOR_ACCENT', '#40916C'),
        'background' => env('SITE_COLOR_BG', '#FAF8F4'),
        'fonts' => [
            'display' => 'Playfair Display, serif',
            'heading' => 'Cormorant Garamond, serif',
            'body' => 'Source Sans 3, sans-serif',
            'mono' => 'JetBrains Mono, monospace',
        ],
        'google_fonts' => 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Playfair+Display:wght@500;600;700&family=Source+Sans+3:wght@400;500;600&display=swap',
        'fontshare' => '',
    ],

    'admin' => [
        'panel_title' => 'Nora Hale Admin',
        'welcome_message' => env('SITE_ADMIN_WELCOME', 'Manage your books, blog, recipes & favorites'),
        'theme' => [
            'primary' => env('SITE_ADMIN_PRIMARY', '#2D6A4F'),
            'secondary' => env('SITE_ADMIN_SECONDARY', '#B8860B'),
        ],
    ],

    'features' => [
        'audio_player' => false,
        'marquee' => true,
        'testimonials' => false,
        'video_gallery' => false,
        'photo_gallery' => false,
        'banners' => false,
        'home_slider' => false,
        'shop_contact' => false,
        'page_loader' => true,
        'canvas_hero' => true,
    ],

    /*
    | Kit (ConvertKit) landing pages — embed URLs or redirect URLs
    */
    'kit' => [
        'connect' => [
            'title' => 'Join Nora\'s Newsletter',
            'subtitle' => 'Get wellness tips, book updates, and exclusive content delivered to your inbox.',
            'embed_url' => env('KIT_CONNECT_EMBED', ''),
            'redirect_url' => env('KIT_CONNECT_REDIRECT', 'https://norahalebooks.com/connect'),
        ],
        'bonusrecipes' => [
            'title' => 'Bonus Recipes Collection',
            'subtitle' => 'Sign up to receive Nora\'s exclusive bonus recipes — natural remedies and kitchen favorites.',
            'embed_url' => env('KIT_BONUSRECIPES_EMBED', ''),
            'redirect_url' => env('KIT_BONUSRECIPES_REDIRECT', 'https://norahalebooks.com/bonusrecipes'),
        ],
        'arcreaders' => [
            'title' => 'ARC Readers Application',
            'subtitle' => 'Love reading advance copies? Apply to join Nora\'s ARC team and get early access to new books.',
            'embed_url' => env('KIT_ARC_EMBED', ''),
            'redirect_url' => env('KIT_ARC_REDIRECT', 'https://norahalebooks.com/ARCreaders'),
        ],
    ],

    'marquee_items' => [
        'Castor Oil for Life',
        'Simple Habits for a Vibrant Life',
        'Natural Wellness',
        'Science-Backed Recipes',
        'Registered Nurse Author',
    ],

    'assets' => [
        'css' => 'assets/website/css/site.css',
        'js' => 'assets/website/js/site.js',
        'favicon' => 'assets/website/favicon.svg',
        'logo_icon' => '',
    ],

];

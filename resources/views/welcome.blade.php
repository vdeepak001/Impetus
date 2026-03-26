<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/venture.svg') }}">
    <title>Compassionate Care Nursing | {{ config('app.name', 'Impetus') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback if Vite is not running -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style>
            @theme {
                --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                --font-serif: 'Playfair Display', ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
                --color-logo-light-green: #83ba2d;
                --color-logo-blue: #0082c9;
                --color-brand-900: #163a5a;
            }
            body {
                font-family: var(--font-sans);
                background-image: radial-gradient(#83ba2d10 1px, transparent 1px);
                background-size: 40px 40px;
            }
            h1, h2, h3, .font-serif { font-family: var(--font-serif); }

            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 { animation-delay: 2s; }
            .animation-delay-4000 { animation-delay: 4s; }
        </style>
    @endif

    <!-- AlpineJS for mobile menu and animations -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased bg-slate-50 text-slate-800">
    @include('welcome.partials.header')
    @include('welcome.partials.main')
    @include('welcome.partials.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
    $meta = seo()->all();
    $locale = $meta['locale'];
    $alternate = $locale === 'id' ? 'en' : 'id';
    // build alternate url safe: jika kamu punya struktur /{locale}/...
    $alternateUrl = url(str_replace("/{$locale}/", "/{$alternate}/", request()->getRequestUri()));
    @endphp

    {{-- <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="alternate" href="{{ $alternateUrl }}" hreflang="{{ $alternate }}">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="{{ $locale }}">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">

    <!-- Open Graph -->
    <meta property="og:locale" content="{{ $locale === 'id' ? 'id_ID' : 'en_US' }}">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:image" content="{{ $meta['image'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="{{ $meta['type'] }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <meta name="twitter:image" content="{{ $meta['image'] }}"> --}}

    <!-- HTML Meta Tags -->
    <title>{{ $meta['title'] }}</title>
    <meta name="description"
        content="{{ $meta['description'] }}" />

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $meta['title'] }}" />
    <meta itemprop="description"
        content="{{ $meta['description'] }}" />
    <meta itemprop="image" content="{{ $meta['image'] }}" />

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="{{ $meta['type'] }}" />
    <meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description"
        content="{{ $meta['description'] }}" />
    <meta property="og:image" content="{{ $meta['image'] }}" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $meta['title'] }}" />
    <meta name="twitter:description"
        content="{{ $meta['description'] }}" />
    <meta name="twitter:image" content="{{ $meta['image'] }}" />

    <!-- Meta Tags Generated via https://heymeta.com -->

    @if (isset($schema))
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen bg-white">
    {{-- Navbar --}}
    @include('front.components.navbar-utama')


    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('front.components.footer')
    @livewireScripts
</body>

</html>
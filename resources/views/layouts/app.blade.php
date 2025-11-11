<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
    use Illuminate\Support\Str;

    $appName = 'CMS Environmental Defender';
    $locale = app()->getLocale();
    $currentPath = request()->path(); // contoh: id/about
    $pathParts = explode('/', $currentPath);
    $urlSegment = end($pathParts);

    // Format URL segment ke Title
    $urlTitle = Str::of($urlSegment)
    ->replace('-', ' ')
    ->title(); // contoh: apa-itu-pembela-lingkungan => Apa Itu Pembela Lingkungan

    // Gunakan title/deskripsi default
    $pageTitle = $pageTitle ?? "$urlTitle | $appName";
    $pageDescription = $pageDescription ?? "Informasi tentang $urlTitle di $appName.";
    $pageImage = $pageImage ?? asset('images/new3.png');
    $pageType = $pageType ?? 'website';
    $currentUrl = url()->current();
    @endphp

    <!-- 🌐 Basic Meta -->
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="title" content="{{ $pageType }}">
    <meta itemprop="image" content="{{ $pageImage }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="mt-10">
            @yield('content')
            {{ $slot ?? '' }}
        </main>
    </div>
    @livewireScripts
    <script src="/js/tinymce/tinymce.min.js"></script>
</body>

</html>
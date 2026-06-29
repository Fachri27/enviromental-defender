<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://auriga.or.id/assets/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @php
    $meta = seo()->all();
    $locale = $meta['locale'];
    $alternate = $locale === 'id' ? 'en' : 'id';
    // build alternate url safe: jika kamu punya struktur /{locale}/...
    $alternateUrl = url(str_replace("/{$locale}/", "/{$alternate}/", request()->getRequestUri()));
    @endphp

    @php
    use Illuminate\Support\Str;

    $appName = config('app.name', 'Environmental Defender');
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
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="title" content="{{ $meta['title'] }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- 🔍 Google / Schema.org -->
    <meta itemprop="name" content="{{ $meta['title'] }}">
    <meta itemprop="description" content="{{ $meta['description'] }}">
    <meta itemprop="image" content="{{ $meta['image'] }}">

    <!-- 🟦 Open Graph / Facebook / WhatsApp -->
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="{{ $meta['type'] ?? 'website' }}">
    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:image" content="{{ $meta['image'] }}">
    <meta property="og:image:alt" content="{{ $meta['title'] }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- 🐦 Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@{{ config('app.twitter_handle') ?? 'yourhandle' }}">
    <meta name="twitter:title" content="{{ $meta['title'] }}">
    <meta name="twitter:description" content="{{ $meta['description'] }}">
    <meta name="twitter:image" content="{{ $meta['image'] }}">
    <meta name="twitter:image:alt" content="{{ $meta['title'] }}">

    @if (isset($schema))
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif

    <!-- Fonts -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        a h2,
        h3,
        h4 {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CE4LS76S14"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CE4LS76S14');
    </script>
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

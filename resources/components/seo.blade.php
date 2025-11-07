@props([
    'title' => null,
    'description' => null,
    'image' => asset('images/logo.png'),
    'type' => 'website',
])

@php
    $appName = config('app.name', 'Environmental Defender');
    $currentPath = request()->path(); // contoh: id/about
    $pathParts = explode('/', $currentPath);

    // ambil nama terakhir dari URL untuk title
    $urlTitle = ucfirst(str_replace('-', ' ', end($pathParts)));

    // fallback title
    $pageTitle = $title ?? "$urlTitle | $appName";

    // fallback description
    $pageDescription = $description ?? "Informasi tentang $urlTitle di $appName.";
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $appName }}">
<meta property="og:url" content="{{ url()->current() }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $image }}">
    
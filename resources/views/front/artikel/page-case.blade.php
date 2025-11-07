@extends('layouts.main')

@section('content')
@php
    $translation = $artikel->translations->first();
@endphp

<main class="max-w-5xl mx-auto px-5 md:px-0 mt-20 md:mt-25">
    {{-- Header Artikel --}}
    <header class="text-center mb-20">
        @if ($artikel->image)
            <figure class="mb-8">
                <img src="{{ asset('storage/' . $artikel->image) }}" 
                     alt="{{ $artikel->slug }}" 
                     class="w-full max-h-[550px] object-cover shadow-md">
                <figcaption class="text-xs text-gray-500 mt-2 italic">
                    {{ $translation->title }}
                </figcaption>
            </figure>
        @endif

        <h1 class="text-3xl md:text-5xl font-bold text-green-900 leading-tight mb-4">
            {{ $translation->title ?? $artikel->slug }}
        </h1>

        {{-- Deskripsi / ringkasan --}}
        <div class="max-w-2xl mx-auto mt-6 text-gray-600 italic leading-relaxed">
            {!! $translation->deskripsi !!}
        </div>
    </header>

</main>
{{-- Isi Artikel --}}
<article class="prose prose-sm sm:prose-base md:prose-lg lg:prose-base prose-black max-w-3xl mx-auto text-justify md:text-left px-5 leading-relaxed font-serif">
    {!! $translation->content !!}
</article>
<div class="flex justify-center mt-12 mb-20 space-x-2">
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
</div>
@endsection

    
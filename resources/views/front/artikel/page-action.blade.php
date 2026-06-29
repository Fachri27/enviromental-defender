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
        <div class="prose max-w-2xl mx-auto mt-6 text-[#2B5343] prose-p:tracking-[0.020em] prose-p:my-[1em] poppins-regular">
            {!! $translation->deskripsi !!}
        </div>
    </header>
</main>
{{-- Isi Artikel --}}
<div class="
      prose
      max-w-2xl mx-auto
      px-5
      poppins-regular

      md:text-md sm:text-base text-[16px]
      text-left

      prose-p:tracking-[0.020em]
      prose-p:my-[1em]

      prose-h2:text-[24px]
      prose-h2:mt-8 prose-h2:mb-4 prose-h2:font-bold

      prose-h3:text-[21px]
      prose-h3:mt-6 prose-h3:mb-3 prose-h3:font-semibold

    ">
    {!! $translation->content !!}
</div>
<div class="flex justify-center mt-12 mb-20 space-x-2">
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
    <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
</div>
@include('front.components.floating')

@endsection

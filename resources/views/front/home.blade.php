@extends('layouts.main')

@section('content')
<div class="w-full h-hero md:h-60 relative">
    <img src="https://environmentaldefender.id/image/ed-hero.jpg" alt=""
        class="md:h-[700px] h-[320px] w-full object-cover relative">
    {{-- <div class="absolute right-0 bottom-0 z-10">
        <img src="https://environmentaldefender.id/image/elemen.png" alt="" class="lg:h-80 h-16">
    </div> --}}
    {{-- <section x-data x-init="window.addEventListener('scroll', () => {
                $refs.parallaxImg.style.transform = `translateY(${window.scrollY * 0.3}px)`
            })" class="relative h-[500px] overflow-hidden">
        <img x-ref="parallaxImg" src="https://environmentaldefender.id/image/ed-hero.jpg"
            class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-200 ease-out">

        <div class="absolute inset-0 bg-black/50 flex items-center justify-center"></div>
    </section> --}}
</div>
@include('front.components.card-home')

<div class="w-full mt-16">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">
            ENVIRONMENTAL DEFENDER CASES
        </h1>
    </div>
</div>

@foreach ($databases as $index => $resource)
@php
$translation = $resource->translations->first();
@endphp

{{-- BAGIAN PERTAMA: FULL WIDTH --}}
@if ($loop->first)
<section class="mx-auto px-4 md:px-6 mb-12 md:mt-10">
    <h2 class=" sm:text-3xl text-base font-semibold w-full text-center ">
        {{ $translation->title }} (
        <span>
            {{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('Y') }}
        </span>
        -
        <span>
            {{ \Carbon\Carbon::parse($resource->end_date)->translatedFormat('F Y') }}
        </span>
        )
    </h2>
</section>
<section class="w-full mb-12">
    <iframe src="{{ $resource->link }}" title="Interactive or visual content" frameborder="0" scrolling="no"
        class="w-full h-[500px] sm:h-[550px]"></iframe>

    <div
        class="max-w-4xl mx-auto px-6 py-6 text-gray-700 text-sm sm:text-base leading-relaxed prose md:text-left text-justify">
        {!! $translation->deskripsi !!}
    </div>
</section>
@else
{{-- BAGIAN SELANJUTNYA: KONTEN DI TENGAH --}}
<section class="max-w-6xl mx-auto px-6 py-12">
    <!-- Judul -->
    <h1 class="text-center text-xl md:text-3xl font-semibold text-gray-900 leading-tight mb-4">
        {{ $translation->title }}
    </h1>

    <!-- Info tanggal -->
    <p class="text-center text-gray-600 text-sm md:text-base mb-10 tracking-wide">
        (
        <span>{{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('Y') }}</span>
        -
        <span>{{ \Carbon\Carbon::parse($resource->end_date)->translatedFormat('F Y') }}</span>
        )
    </p>

    <div class="overflow-hidden shadow-sm mb-8">
        <iframe src="{{ $resource->link }}" title="Interactive or visual content" frameborder="0" scrolling="no"
            class="w-full md:h-[500px] h-[400px]"></iframe>
    </div>

    <div class="max-w-4xl mx-auto text-gray-700 text-sm sm:text-base leading-relaxed prose md:text-left text-justify">
        {!! $translation->deskripsi !!}
    </div>


</section>
@endif
@endforeach

<!-- Tombol Floating -->
<div x-data="{
        show: false,
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }" x-init="window.addEventListener('scroll', () => show = window.scrollY > 300)">
    <button x-show="show" @click="scrollToTop" x-transition.opacity.duration.300ms class="fixed bottom-6 right-6 bg-red-600 text-white p-5 rounded-full shadow-lg 
               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2"
        aria-label="Back to top">
        <!-- Icon panah ke atas -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>
</div>


@endsection
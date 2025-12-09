@extends('layouts.main')

@section('content')
<div class="md:px-0 px-10">
    @foreach ($resources as $resource )
    @php
    $translation = $resource->translations->first();
    @endphp

    {{-- <section class="md:max-w-7xl max-w-2xl mx-auto md:px-6 mb-15 mt-10 py-5">
        <h1 class="text-center text-lg md:text-xl font-semibold mb-2">
            {{ $translation->title }}
        </h1>
        <p class="text-center text-gray-600 mb-8">
            (
            <span>
                {{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('Y') }}
            </span>
            -
            <span>
                {{ \Carbon\Carbon::parse($resource->end_date)->translatedFormat('F Y') }}
            </span>
            )
        </p>

        <!-- MAP WRAPPER -->
        <div class="rounded-xl overflow-hidden shadow border border-gray-200">
            <iframe src="{{ $resource->link }}" title="Interactive or visual content" frameborder="0" scrolling="no"
                class="w-full h-[450px]"></iframe>
        </div>

        <!-- DESCRIPTION -->
        <div class="mt-8">
            <article class="prose prose-sm md:prose-base prose-gray max-w-none text-sm md:text-left text-justify">
                {!! $translation->deskripsi !!}
            </article>
        </div>
    </section> --}}

    {{-- <section class="max-w-7xl mx-auto px-4 md:px-6 mb-12 mt-10">
        <h1 class="text-center text-lg md:text-xl font-semibold mb-2">
            {{ $translation->title }}
        </h1>
        <p class="text-center text-gray-600 mb-8">
            (
            <span>
                {{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('Y') }}
            </span>
            -
            <span>
                {{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('d F Y') }}
            </span>
            )
        </p>

        <!-- MAP WRAPPER -->
        <iframe src="{{ $resource->link }}" title="Interactive or visual content" frameborder="0" scrolling="no"
            class="w-full h-[450px]"></iframe>

        <!-- DESCRIPTION -->
        <div class="mt-8 pl-3">
            <p class="prose prose-sm md:prose-base max-w-none text-gray-700 leading-relaxed">
                {!! $translation->deskripsi !!}
            </p>
        </div>
    </section> --}}

    <section class="max-w-3xl md:max-w-5xl lg:max-w-7xl mx-auto md:px-8 mt-12 mb-20">
        <!-- Judul -->
        <h1 class="text-center text-xl md:text-3xl font-semibold text-gray-900 leading-tight mb-4">
            {{ $translation->title }}
        </h1>

        <!-- Info tanggal -->
        <p class="text-center text-gray-500 text-sm md:text-base mb-10 tracking-wide">
            (
            <span>{{ \Carbon\Carbon::parse($resource->start_date)->translatedFormat('Y') }}</span>
            -
            <span>{{ \Carbon\Carbon::parse($resource->end_date)->translatedFormat('j F Y') }}</span>
            )
        </p>

        <!-- MAP / Embed -->
        <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100">
            <iframe src="{{ $translation->link }}" title="Interactive or visual content" frameborder="0" scrolling="no"
                class="w-full h-[220px] sm:h-[300px] md:h-[400px] lg:h-[480px] transition-all duration-300 ease-in-out">
            </iframe>
        </div>

        <!-- Deskripsi -->
        <div class="mt-10 md:mt-14">
            <article
                class="prose prose-sm sm:prose-base md:prose-lg lg:prose-lg prose-gray max-w-none text-justify leading-relaxed font-serif">
                {!! $translation->deskripsi !!}
            </article>
        </div>
    </section>
    @endforeach
</div>  
@include('front.components.floating')

@endsection
@extends('layouts.main')

@section('content')
<div class="md:px-0 px-10">
    @foreach ($resources as $resource )
    @php
    $translation = $resource->translations->first();
    @endphp

    <section class="max-w-7xl mx-auto px-5 md:px-6 mb-15 mt-10 py-5">
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
            <iframe src="{{ $resource->link }}" title="Interactive or visual content"
                frameborder="0" scrolling="no" class="w-full h-[450px]"></iframe>
        </div>

        <!-- DESCRIPTION -->
        <div class="mt-8">
            <article class="prose prose-sm md:prose-base prose-gray max-w-none text-sm">
                {!! $translation->deskripsi !!}
            </article>
        </div>
    </section>

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
        <iframe src="{{ $resource->link }}" title="Interactive or visual content"
            frameborder="0" scrolling="no" class="w-full h-[450px]"></iframe>

        <!-- DESCRIPTION -->
        <div class="mt-8 pl-3">
            <p class="prose prose-sm md:prose-base max-w-none text-gray-700 leading-relaxed">
                {!! $translation->deskripsi !!}
            </p>
        </div>
    </section> --}}

    @endforeach
</div>
@endsection
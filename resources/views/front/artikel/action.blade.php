@extends('layouts.main')

@section('content')
<div>
    <div class="max-w-7xl mx-auto mt-10">
        <h2 class="text-sm md:text-xl font-semibold text-green-800">
            {{ __('messages.action') }}
        </h2>
    </div>
    {{-- Grid Artikel --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 items-stretch">

        @foreach ($actions as $action)
        @php
            $translation = $action->translations->first();
        @endphp

        <!-- Grid Item -->
        <div class="flex">

            <!-- Card -->
            <article class="group max-w-sm w-full shadow-sm flex flex-col min-h-[460px] bg-white rounded-md overflow-hidden">

                <!-- Gambar -->
                <div class="overflow-hidden h-52 sm:h-56 shrink-0">
                    <img
                        src="{{ asset('storage/' . $action->image) }}"
                        alt="{{ $translation->title ?? 'Artikel Image' }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <!-- Konten -->
                <div class="p-4 bg-amber-100 flex flex-col flex-1">

                    <!-- Judul -->
                    <a href="{{ route('artikel.page', $action->slug) }}">
                        <h2 class="font-semibold text-green-700 text-xl mb-3 line-clamp-3">
                            {{ $translation->title ?? 'No Title' }}
                        </h2>
                    </a>

                    <!-- Deskripsi -->
                    <div class="prose prose-sm text-black line-clamp-4">
                        {!! $translation->deskripsi ?? 'No Description' !!}
                    </div>

                    <!-- Link selalu di bawah -->
                    <!--<div class="mt-auto pt-4">
                        <a
                            href="{{ route('artikel.page', $action->slug) }}"
                            class="text-green-700 font-medium hover:underline"
                        >
                            Baca selengkapnya →
                        </a>
                    </div>-->

                </div>
            </article>

        </div>

        @endforeach

    </div>
</div>

@include('front.components.floating')
@endsection

@extends('layouts.main')

@section('content')
<div>
    {{-- image --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-5 md:mt-20 mt-20">
    @foreach ($cases as $case)
    @php
    $translation = $case->translations->first();
    @endphp
        <div class="bg-white rounded-md overflow-hidden justify-center flex">
            <!-- Grid Artikel -->
            <article class="group max-w-sm overflow-hidden shadow-sm h-full">
                <!-- Gambar -->
                <div class="overflow-hidden h-52 sm:h-56 transition-transform transform hover:scale-105">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <img src="{{ asset('storage/'. $case->image) }}" alt="{{ $translation->title }}" class="w-full h-full">
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-4 justify-between min-h-[220px] space-y-5 bg-amber-100">
                    <a href="{{ route('artikel.page', $case->slug) }}">
                        <div class="font-semibold text-green-700 pb-5 text-xl">
                            {{ $translation->title }}
                        </div>
                    </a>

                    <div class="prose prose-sm text-black">
                        {!! $translation->deskripsi !!}
                    </div>
                </div>
            </article>
        </div>
    @endforeach
    </div>
</div>
@endsection
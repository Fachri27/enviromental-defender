@extends('layouts.main')

@section('content')
<div>
    {{-- image --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-5 md:mt-20 mt-20">
    @foreach ($alerta as $item)
    @php
    $translation = $item->translations->first();
    @endphp
        <div class="bg-white rounded-md overflow-hidden justify-center flex">
            <!-- Grid Artikel -->
            <article class="group max-w-sm overflow-hidden shadow-sm h-full text-white">
                <!-- Gambar -->
                <div class="overflow-hidden h-52 sm:h-56 transition-transform transform hover:scale-105">
                    <div class="w-full md:h-full bg-gray-200 flex items-center justify-cente">
                        <img src="{{ asset('storage/'. $item->image) }}" alt="{{ $translation->title }}" class="w-full h-full">
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-5 justify-between min-h-[220px] space-y-5 bg-red-600 md:h-[600px] leading-relaxed">
                    <div class="font-bold text-xl">
                        {{ $translation->title }}
                    </div>

                    <div class="prose prose-sm text-white">
                        {!! $translation->deskripsi !!}
                    </div>
                </div>
            </article>
        </div>
    @endforeach
    </div>
</div>
@endsection
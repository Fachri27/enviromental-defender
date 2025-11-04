@extends('layouts.main')

@section('content')
    @php
        $translation = $artikel->translations->first();
    @endphp
    {{-- image --}}
       <div class="max-w-5xl md:mx-auto text-center md:my-20 my-20 mx-5">
           
           @if ($artikel->image)
           <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->slug }}"
           class="w-full shadow md:h-[550px]">
           @endif
           <h1 class="text-4xl font-semi-bold mb-4 mt-15 text-green-900">{{ $translation->title ?? $artikel->slug }}</h1>
           <div class="mb-4 prose prose-lg italic mx-auto">{!! $translation->deskripsi !!}</div>
        </div>
        <div class="md:max-w-5xl mx-auto my-15">
            <div class="prose max-w-none md:mx-50 mx-10">
                {!! $translation?->content !!}
            </div>
        </div>
        <div class="flex justify-center mt-6 space-x-2 mb-20">
            <span class="w-2 h-2 bg-black rounded-full opacity-70"></span>
            <span class="w-2 h-2 bg-black rounded-full opacity-70"></span>
            <span class="w-2 h-2 bg-black rounded-full opacity-70"></span>
        </div>
@endsection
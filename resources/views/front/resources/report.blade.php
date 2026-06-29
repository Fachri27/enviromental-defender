@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-10">
        <h2 class="text-sm md:text-xl font-semibold text-green-800">
            {{ __('messages.report') }}
        </h2>
        @foreach ($resource as $data)
            @php
                $translation = $data->translations->first();
            @endphp

            <div class="flex flex-col md:flex-row items-start gap-6 bg-white  p-5 border-b">
                <!-- Gambar sampul -->
                <img
                    src="{{ asset('storage/' . $data->image) }}"
                    alt="Cover dokumen"
                    class="w-full md:w-1/3 md:h-full object-cover rounded shadow-sm"
                />

                <!-- Konten kanan -->
                <div class="flex-1">
                    <h2 class="text-xl font-semibold mb-2 leading-snug font-sans text-green-800">
                        {{ $translation->title }}
                    </h2>

                    <div class="prose text-[#2B5343] prose-p:tracking-[0.020em] prose-p:my-[1em] poppins-regular mb-4">
                        {!! $translation->deskripsi !!}
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex flex-wrap gap-3 mt-5">
                        <a href="{{ asset('storage/' . $translation->file_type) }}"
                            target="_blank"
                            class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded-md transition">
                            Preview
                        </a>

                        <a href="{{ asset('storage/' . $data->file_type) }}" download
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition">
                            Download
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('front.components.floating')

@endsection

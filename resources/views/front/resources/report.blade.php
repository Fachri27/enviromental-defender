@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 space-y-10">
        @foreach ($resource as $data)
            @php
                $translation = $data->translations->first();
            @endphp

            <div class="flex flex-col md:flex-row items-start gap-6 bg-white  p-5">
                <!-- Gambar sampul -->
                <img 
                    src="{{ asset('storage/' . $data->image) }}" 
                    alt="Cover dokumen" 
                    class="w-full md:w-1/3 md:h-full object-cover rounded shadow-sm"
                />

                <!-- Konten kanan -->
                <div class="flex-1">
                    <h2 class="text-lg md:text-3xl font-semibold text-green-800 mb-10">
                        {{ $translation->title }}
                    </h2>

                    <div class="prose prose-lg text-sm md:text-lg text-gray-700 leading-relaxed mb-4">
                        {!! $translation->deskripsi !!}
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex flex-wrap gap-3 mt-5">
                        <a href="{{ asset('storage/' . $data->file_type) }}"
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
@endsection

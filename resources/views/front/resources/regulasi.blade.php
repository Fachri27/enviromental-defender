@extends('layouts.main')

@section('content')

<section class="max-w-3xl mx-auto px-10 md:px-6 py-8 text-gray-800 md:mt-5 mt-10 mb-20 text-justify md:text-left">
    <!-- Paragraf pembuka -->
    @php
        $locale = app()->getLocale();
    @endphp
    <p class="text-sm leading-relaxed mb-6">
        @if ($locale == 'id')
        Meski belum ada regulasi spesifik yang secara tegas dan lugas menjamin dan atau mengatur perlindungan terhadap pembela lingkungan, namun di berbagai regulasi tersirat mengenainya. Di antaranya:
        @else
        Although there is no specific regulation that explicitly guarantees and governs the protection of
        environmental defenders, several laws implicitly address it.
        @endif
    </p>

    <!-- Daftar regulasi -->
    <ul class="space-y-10">
        @foreach ($regulasi as $item)
        @php
            $translation = $item->translations->first();
        @endphp
        <li class="flex items-start gap-4">
            <div class="mt-1 w-3 h-3 bg-black rounded-full flex-shrink-0"></div>
            <div>
                <a href="{{ $item->link }}">
                    <h3 class="font-semibold text-red-600">
                        {{ $translation->title }}
                    </h3>
                </a>
                <p class="text-sm text-gray-700 leading-relaxed">
                    {!! $translation->deskripsi !!}
                </p>
            </div>
        </li>
        @endforeach
    </ul>
</section>


@endsection
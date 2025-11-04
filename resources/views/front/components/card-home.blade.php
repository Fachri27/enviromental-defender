<div class="max-w-7xl mx-auto px-4 md:px-6 mt-15 md:mt-[580px] md:mb-40 mb-30">
    <div class="grid md:grid-cols-3 md:gap-8 gap-10">
        {{-- ACTION --}}
        @if ($action)
            @php $translation = $action->translations->first(); @endphp
            <div class="flex flex-col space-y-3">
                <img src="{{ asset('storage/' . $action->image) }}" 
                     alt="{{ $translation->title ?? '' }}" 
                     class="w-full md:h-48 h-55 object-cover rounded-md">
                <p class="uppercase text-sm font-semibold text-gray-500">action</p>
                <a href="{{ route('artikel.page', $action->slug) }}">
                    <h2 class="text-xl font-bold text-green-700 leading-snug">
                        {{ $translation->title ?? '' }}
                    </h2>
                </a>
                <p class="text-sm text-gray-700 leading-relaxed">
                    <strong>{{ \Carbon\Carbon::parse($action->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($translation->deskripsi ?? ''), 150) !!}
                </p>
            </div>
        @endif

        {{-- RESOURCES --}}
        @if ($report)
            @php $translation = $report->translations->first(); @endphp
            <div class="flex flex-col space-y-3">
                <img src="{{ asset('storage/' . $report->image) }}" 
                     alt="{{ $translation->title ?? '' }}" 
                     class="w-full md:h-48 h-55 object-cover rounded-md">
                <p class="uppercase text-sm font-semibold text-gray-500">resources</p>
                <a href="{{ asset('storage/'. $report->file_type) }}">
                    <h2 class="text-xl font-bold text-green-700 leading-snug">
                        {{ $translation->title ?? '' }}
                    </h2>
                </a>
                <p class="text-sm text-gray-700 leading-relaxed">
                    <strong>{{ \Carbon\Carbon::parse($report->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($translation->deskripsi ?? ''), 150) !!}
                </p>
            </div>
        @endif

        {{-- CASES --}}
        @if ($case)
            @php $translation = $case->translations->first(); @endphp
            <div class="flex flex-col space-y-3">
                <img src="{{ asset('storage/' . $case->image) }}" 
                     alt="{{ $translation->title ?? '' }}" 
                     class="w-full md:h-48 h-55 md:object-cover rounded-md">
                <p class="uppercase text-sm font-semibold text-gray-500">cases</p>
                <a href="{{ route('artikel.page', $case->slug) }}">
                    <h2 class="text-xl font-bold text-green-700 leading-snug">
                        {{ $translation->title ?? '' }}
                    </h2>
                </a>
                <p class="text-sm text-gray-700 leading-relaxed">
                    <strong>{{ \Carbon\Carbon::parse($case->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($translation->deskripsi ?? ''), 150) !!}
                </p>
            </div>
        @endif
    </div>
</div>

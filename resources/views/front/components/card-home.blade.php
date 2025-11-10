<div class="md:max-w-7xl mx-auto px-2 md:px-6 mt-15 md:mt-[550px] md:mb-20 mb-10">
    <div class="grid md:grid-cols-3 gap-8 my-12 px-5">
        <!-- Card 1 -->
        @if ($action)
        <div class="bg-white shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            <img src="{{ asset('storage/'.$action->image) }}" alt="Bincang Hukum" class="w-full h-52 object-cover">
            <div class="p-6">
                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ $action->type }}</p>
                <a href="{{ route('artikel.page', $action->slug) }}">
                    <h3 class="text-2xl font-bold text-green-800 hover:text-green-700 transition-colors">
                        {{ $action->title }}
                    </h3>
                </a>
                <div class="text-sm text-gray-700 mt-3">
                    <strong>{{ \Carbon\Carbon::parse($report->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($action->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif

        <!-- Card 2 -->
        @if ($report)
        <div class="bg-white shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            <img src="{{ asset('storage/'.$report->image) }}" alt="Bincang Hukum" class="w-full h-52 object-cover">
            <div class="p-6">
                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ $report->type }}</p>
                <a href="{{ asset('storage/'. $report->slug) }}">
                    <h3 class="text-2xl font-bold text-green-800 hover:text-green-700 transition-colors">
                        {{ $report->title }}
                    </h3>
                </a>
                <div class="text-sm text-gray-700 mt-3">
                    <strong>{{ \Carbon\Carbon::parse($report->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($report->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif

        <!-- Card 3 -->
        @if ($case)
        <div class="bg-white shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            <img src="{{ asset('storage/'.$case->image) }}" alt="Bincang Hukum" class="w-full h-52 object-cover">
            <div class="p-6">
                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">{{ $case->type }}</p>
                <a href="{{ route('artikel.page', $case->slug) }}">
                    <h3 class="text-2xl font-bold text-green-800 hover:text-green-700 transition-colors">
                        {{ $case->title }}
                    </h3>
                </a>
                <div class="text-sm text-gray-700 mt-3">
                    <strong>{{ \Carbon\Carbon::parse($case->published_at)->translatedFormat('F Y') }}</strong> |
                    {!! Str::limit(strip_tags($case->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="max-w-7xl border-b border-gray-300 mx-auto mt-20"></div>
</div>
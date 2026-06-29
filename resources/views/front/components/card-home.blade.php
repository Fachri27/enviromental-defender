<div class="max-w-screen-xl mx-auto px-2 md:px-6 mt-15 md:mt-[550px] md:mb-20 mb-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-y-20 px-5">

        @if ($action)
        <div class="group bg-white shadow-sm hover:shadow-xl flex flex-col h-full overflow-hidden">
            <div class="overflow-hidden aspect-[16/9]">
                <img src="{{ asset('storage/'.$action->image) }}" alt="{{ $action->title }}"
                     class="w-full h-full object-cover object-[center_20%] transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="p-4 flex flex-col flex-1 text-[#2B5343]">
                <div class="text-xs text-gray-500 mb-2">
                    ACTION
                </div>
                <a href="{{ route('artikel.page', $action->slug) }}">
                    <h3 class="text-xl font-semibold mb-2 leading-snug font-sans">
                        {{ $action->title }}
                    </h3>
                </a>
                <div class="prose-sm text-[#2B5343] max-w-none prose-p:tracking-[0.020em] prose-p:my-[1em] poppins-regular flex-1">
                    {!! Str::limit(strip_tags($action->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif

        @if ($report)
        <div class="group bg-white shadow-sm hover:shadow-xl flex flex-col h-full overflow-hidden">
            <div class="overflow-hidden aspect-[16/9]">
                <img src="{{ asset('storage/'.$report->image) }}" alt="{{ $report->title }}"
                     class="w-full h-full object-cover object-[center_10%] transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="p-4 flex flex-col flex-1 text-[#2B5343]">
                <div class="text-xs text-gray-500 mb-2">
                    REPORT
                </div>
                <a href="{{ asset('storage/' . ($report->translation?->file_type ?? $report->translations->first()->file_type ?? '')) }}" target="_blank">
                    <h3 class="text-xl font-semibold mb-2 leading-snug font-sans">
                        {{ $report->title }}
                    </h3>
                </a>
                <div class="prose-sm text-[#2B5343] max-w-none prose-p:tracking-[0.020em] prose-p:my-[1em] poppins-regular flex-1">
                    {!! Str::limit(strip_tags($report->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif

        @if ($case)
        <div class="group bg-white shadow-sm hover:shadow-xl flex flex-col h-full overflow-hidden">
            <div class="overflow-hidden aspect-[16/9]">
                <img src="{{ asset('storage/'.$case->image) }}" alt="{{ $case->title }}"
                     class="w-full h-full object-cover object-[center_20%] transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="p-4 flex flex-col flex-1 text-[#2B5343]">
                <div class="text-xs text-gray-500 mb-2">
                    CASE
                </div>
                <a href="{{ route('artikel.page', $case->slug) }}">
                    <h3 class="text-xl font-semibold mb-2 leading-snug font-sans">
                        {{ $case->title }}
                    </h3>
                </a>
                <div class="prose-sm text-[#2B5343] max-w-none prose-p:tracking-[0.020em] prose-p:my-[1em] poppins-regular flex-1">
                    {!! Str::limit(strip_tags($case->deskripsi ?? ''), 150) !!}
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="max-w-7xl border-b border-gray-300 mx-auto mt-20"></div>
</div>

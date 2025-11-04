@php
$locale = app()->getLocale();
@endphp
<footer class="bg-green-900 text-gray-200 mt-20">
    <!-- Bagian deskripsi -->
    <div class="max-w-5xl mx-auto px-6 py-10 text-center">
        @if ($locale === 'id')
            <p class="text-gray-100 leading-relaxed text-sm md:text-base">
                Situs ini didedikasikan untuk peningkatan keselamatan Pembela Lingkungan. Memuat database ancaman terhadap Pembela Lingkungan, dan berbagai informasi yang relevan dengan perbaikan keselamatannya.
            </p>
        @else
            <p class="text-gray-100 leading-relaxed text-sm md:text-base">
                This site, dedicated to ensuring the safety of Environmental Defenders,
                contains a database of threats to Environmental Defenders, and information
                relevant to improving their safety.
            </p>
        @endif
    </div>

    <!-- Garis pemisah tipis -->
    <div class="border-t border-green-800"></div>

    <!-- Bagian hak cipta -->
    <div class="py-4 bg-green-950">
        @if ($locale === 'id')
            <p class="text-center text-xs md:text-sm text-gray-400">
                ©2025 Auriga Nusantara. Hak cipta dilindungi undang-undang.
            </p>
        @else
            <p class="text-center text-xs md:text-sm text-gray-400">
                © 2025 Auriga Nusantara. All rights reserved.
            </p>
        @endif
    </div>
</footer>

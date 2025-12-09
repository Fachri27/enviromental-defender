@php
    app()->getLocale();
@endphp
<div>
    <div class="md:flex hidden py-3 items-center text-white bg-red-700 fixed top-0 left-0 w-full z-50">
        <div class="justify-center mx-auto pl-115">
            {{ __('messages.text_xample') }}
        </div>
        <div class="hidden md:flex justify-end items-center max-w-7xl mx-auto px-5 py-2 text-sm">
            <div class="flex space-x-1 text-black">
                <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'en'])) }}"
                    class="hover:text-green-500 {{ app()->getLocale() === 'en' ? 'font-bold text-white' : '' }}">EN</a>
                <span>|</span>
                <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'id'])) }}"
                    class="hover:text-green-500 {{ app()->getLocale() === 'id' ? 'font-bold text-white' : '' }}">ID</a>
            </div>
        </div>
    </div>

    <nav x-data="{open: false}" class=" bg-red-700 md:bg-white shadow md:pt-10 pb-6 mt-10">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4">
            {{-- logo --}}
            <div class="hidden md:flex">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </a>
            </div>
            {{-- desktop --}}
            <div class="hidden md:flex items-center font-bold space-x-6 text-green-900">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center hover:text-green-800 cursor-pointer">
                        {{ __('messages.about_us') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute left-0 mt-2 w-60 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                        style="display: none !important">
                        <a href="{{ route('about.enviromental') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.enviromental_defender') }}</a>
                        <a href="{{ route('about.situs') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.situs_ini') }}</a>
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center hover:text-green-800 cursor-pointer text-nowrap">
                        {{ __('messages.resources') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                        style="display: none !important">
                        <a href="{{ route('report.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.report') }}</a>
                        <a href="{{ route('regulasi.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.regulasi') }}</a>
                        <a href="{{ route('database.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.database') }}</a>
                    </div>
                </div>
                <a href="{{ route('cases.index') }}" class="hover:border-b py-2">{{ __('messages.cases') }}</a>
                <a href="{{ route('action.index') }}" class="hover:border-b py-2">{{ __('messages.report') }}</a>
                <a href="{{ route('alerta.index') }}" class="hover:border-b py-2">{{ __('messages.alerta') }}</a>

                <div x-data="{ search: '{{ request('search') }}', typing: null, loading: false }"
                    class="relative w-full max-w-xs ml-4">
                    <form x-ref="form" action="" method="get" class="flex items-center border-b border-gray-300 w-full">
                        <input type="text" name="search" x-model="search" x-on:input="
                                loading = true;
                                clearTimeout(typing);
                                typing = setTimeout(() => { 
                                    $refs.form.submit(); 
                                    loading = false;
                                }, 600);
                            " placeholder="Search..." class="text-sm px-2 py-1 w-full outline-none bg-transparent">

                        <!-- Ikon pencarian -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </form>

                    <!-- Loading indicator -->
                    <div x-show="loading" x-transition.opacity
                        class="absolute right-0 -bottom-6 text-xs text-green-700 flex items-center space-x-1">
                        <span>{{ __('messages.search_placeholder') }}</span>
                        <div class="flex space-x-1">
                            <span
                                class="w-1.5 h-1.5 bg-green-700 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                            <span
                                class="w-1.5 h-1.5 bg-green-700 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                            <span class="w-1.5 h-1.5 bg-green-700 rounded-full animate-bounce"></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        {{-- overlay --}}
        <div x-show="open" x-transition.opacity class="fixed md:hidden inset-0 bg-black/50 z-50"
            style="display: none !important;">
        </div>

        {{-- mobile --}}
        <!-- Top bar merah dengan hamburger dan alert text -->
        <div
            class="md:hidden bg-red-700 text-white flex items-center justify-between fixed top-0 left-0 w-full z-50 py-6">
            <button @click="open = !open" class="text-white focus:outline-none ml-5 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="size-6 font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </button>
            <!-- Alert text -->
            <a href="/">
                <p class="ml-3 text-sm px-5 items-center font-bold">
                    ALERTA! Melindungi tanah adatnya, warga Pulau Rempang direpresi polisi
                </p>
            </a>
        </div>

        <!-- Mobile menu overlay -->
        <div x-show="open" x-transition:enter="transition-all transform ease-out"
            x-transition:enter-start="-translate-x-1/2 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition-all transform ease-in" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-1/2 opacity-0" @click.away="open = false"
            class="fixed md:hidden inset-0 z-50 bg-red-700 text-white flex flex-col p-6 space-y-5 w-[75vw]"
            style="display: none;">
            <!-- Close button -->
            <button @click="open = false" class="self-start mb-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6 font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Menu links -->
            <div class="flex flex-col space-y-5 text-lg font-semibold">
                <div x-data="{ dropdown: false }" class="ml-4">
                    <button @click="dropdown = !dropdown" class="flex items-center justify-between w-full">
                        {{ __('messages.about_us') }}
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': dropdown, 'rotate-0': !dropdown}"
                            class="inline w-4 h-4 ml-1 text-white items-center mt-1 transition-transform duration-200 transform "
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="dropdown" x-transition
                        class="mt-2 pl-3 py-3 space-y-2 text-sm bg-white text-green-900 w-full rounded">
                        <a href="{{ route('about.enviromental') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.enviromental_defender') }}</a>
                        <a href="{{ route('about.situs') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            {{ __('messages.situs_ini') }}</a>
                    </div>
                </div>

                <div class="border-b"></div>

                <div x-data="{ dropdown: false }" class="ml-4">
                    <button @click="dropdown = !dropdown" class="flex items-center justify-between w-full">
                        {{ __('messages.resources') }}
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': dropdown, 'rotate-0': !dropdown}"
                            class="inline w-4 h-4 ml-1 text-white items-center mt-1 transition-transform duration-200 transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="dropdown" x-transition
                        class="pl-3 py-3 mt-2 space-y-2 text-sm bg-white text-green-900 w-full rounded">
                        <a href="{{ route('report.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.report') }}</a>
                        <a href="{{ route('regulasi.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.regulasi') }}</a>
                        <a href="{{ route('database.index') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100">{{ __('messages.database') }}</a>
                    </div>
                </div>

                <div class="border-b"></div>

                <a href="{{ route('cases.index') }}" class="hover:underline ml-4">{{ __('messages.cases') }}</a>
                <div class="border-b"></div>
                <a href="{{ route('action.index') }}" class="hover:underline ml-4">{{ __('messages.action') }}</a>
                <div class="border-b"></div>
                <a href="{{ route('alerta.index') }}" class="hover:underline ml-4">{{ __('messages.alerta') }}</a>

                <!-- Search -->
                <div x-data="{ search: '{{ request('search') }}', typing: null, loading: false }"
                    class="relative w-full max-w-xs mt-5">
                    <form x-ref="form" action="" method="get" class="flex items-center border-b border-gray-300 w-full">
                        <input type="text" name="search" x-model="search" x-on:input="
                                loading = true;
                                clearTimeout(typing);
                                typing = setTimeout(() => { 
                                    $refs.form.submit(); 
                                    loading = false;
                                }, 600);
                            " placeholder="Search..."
                            class="text-sm px-2 py-3 w-full outline-none bg-white text-black">
                    </form>

                    <!-- Loading indicator -->
                    <div x-show="loading" x-transition.opacity
                        class="absolute right-0 -bottom-6 text-xs text-white flex items-center space-x-1">
                        <span>Mencari</span>
                        <div class="flex space-x-1">
                            <span
                                class="w-1.5 h-1.5 bg-white rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                            <span
                                class="w-1.5 h-1.5 bg-white rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-bounce"></span>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Language switcher -->
            <div class="mt-auto pt-6 border-t border-white/30 flex space-x-3 text-sm font-semibold">
                <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'en'])) }}"
                    class="{{ app()->getLocale() === 'en' ? 'underline' : '' }}">english</a>
                <span>|</span>
                <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'id'])) }}"
                    class="{{ app()->getLocale() === 'id' ? 'underline' : '' }}">indonesia</a>
            </div>
        </div>
    </nav>
</div>
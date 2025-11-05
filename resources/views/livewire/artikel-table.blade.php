<div class="flex flex-col justify-center items-center mt-20">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Artikel') }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
        {{-- button create --}}
        <div class="flex justify-end mb-3">
            <a href="{{ route('artikel.create') }}">
                <button class="border-blue-500 border-2 px-6 py-2 text-sm rounded-sm">Create</button>
            </a>
        </div>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.live.debounce.100ms="search" placeholder="Search..."
                    class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </div>

            <!-- Filter -->
            <div>
                <select wire:model.live.debounce.100ms="status"
                    class="border border-gray-300 text-sm rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">status</option>
                    <option value="draft">draft</option>
                    <option value="publish">publish</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto mx-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 font-medium text-gray-500">#</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Title (ID)</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Status</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Type</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Image</th>
                        <th class="px-4 py-3 font-medium text-gray-500">User</th>
                        <th class="px-4 py-3 font-medium text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($artikels as $index => $artikel)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $artikel->title }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $artikel->status }}</td>
                        <td class="px-4 py-3 text-gray-700 capitalize">{{ $artikel->type }}</td>
                        <td class="px-4 py-3 text-gray-700 capitalize">
                            <img src="{{ asset('storage/'. $artikel->image) }}" alt="" height="100" width="100">
                        </td>
                        <td class="px-4 py-3 text-gray-700 capitalize">{{ auth()->user()->name }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('artikel.page', ['locale' => app()->getLocale(), 'slug' => $artikel->slug]) }}">
                                <button class="text-green-600 hover:underline text-sm font-medium">Preview</button>
                            </a>
                            <a href="{{ route('artikel.edit', $artikel->id) }}">
                                <button class="text-blue-600 hover:underline text-sm font-medium">Edit</button>
                            </a>
                            <button wire:click='destroy({{ $artikel->id }})' class="text-red-600 hover:underline text-sm font-medium ml-2">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">No Resource found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $artikels->links() }}
        </div>
    </div>

     @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" x-init="setTimeout(() => show = false, 3000)"
        class="fixed bottom-6 right-6 bg-green-400 text-white p-10 shadow-lg 
               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
        {{ session('success') }}
    </div>
    @endif

</div>
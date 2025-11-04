@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center mt-20">
    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
            <!-- Search -->
            <div class="relative">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search users..."
                    class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </div>
            {{-- button create --}}
            <div class="flex justify-end mb-3 items-center">
                <a href="{{ route('register') }}">
                    <button class="border-blue-500 border-2 px-6 py-2 text-sm rounded-sm">Create</button>
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 font-medium text-gray-500">#</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Name</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Email</th>
                        <th class="px-4 py-3 font-medium text-gray-500">Role</th>
                        <th class="px-4 py-3 font-medium text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-gray-700 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-3 text-right">
                            {{-- <a href="{{ route('resource.edit', $user->id) }}">
                                <button class="text-blue-600 hover:underline text-sm font-medium">Edit</button>
                            </a> --}}
                            <a href="{{ route('user.delete', $user->id) }}">
                                <button class="text-red-600 hover:underline text-sm font-medium ml-2">Delete</button>
                            </a>
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
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
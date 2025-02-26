@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @auth
    <div class="flex justify-center items-center mt-4">
        <form method="GET" action="{{ route('search') }}" class="relative w-full max-w-lg">
            <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Search users..." 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button type="submit" class="absolute top-2 right-2 px-3 py-1 text-white bg-blue-600 rounded-lg">
                <i class="fa fa-search">search</i>
            </button>
        </form>
    </div>     
    @endauth

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Table -->
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                                    <i class="fas fa-user text-gray-500 mr-1"></i> Name
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                                    <i class="fas fa-envelope text-gray-500 mr-1"></i> Email
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                                    <i class="fas fa-user-tag text-gray-500 mr-1"></i>Created At
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                                    <i class="fas fa-calendar text-gray-500 mr-1"></i> 
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <a href="{{ route('profil.show', ['id' => $user->id]) }}">
                                                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="{{ $user->profile_picture }}" class="w-6 h-6 rounded-full">
                                            </a>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                                    </td>
                                    @auth
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <form action="{{ route('follow' , $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="mt-6 inline-block bg-indigo-600 text-white py-2 px-6 rounded-lg text-lg hover:bg-indigo-700 transition duration-300">Follow</button>
                                            </form>                                            
                                        </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection

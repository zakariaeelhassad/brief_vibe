@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 p-6 text-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-2xl overflow-hidden p-8 text-center transform transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"  class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 mb-6">
        
        <h2 class="text-3xl font-semibold text-gray-800 mb-2">{{ $user->name }}</h2>
        <p class="text-gray-500 text-sm mb-4"></p>
    
        <div class="text-left text-gray-600">
            <p class="text-sm"><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        @auth
        @php
            $isFollowing = auth()->user()->isFollowing($user->id);
        @endphp

        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <form action="{{ $isFollowing ? route('unfollow', $user->id) : route('follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="mt-6 inline-block 
                    {{ $isFollowing ? 'bg-red-600 hover:bg-red-700' : 'bg-indigo-600 hover:bg-indigo-700' }} 
                    text-white py-2 px-6 rounded-lg text-lg transition duration-300">
                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                </button>
            </form>                                            
        </td>
    @endauth
    </div>
</div>


@endsection
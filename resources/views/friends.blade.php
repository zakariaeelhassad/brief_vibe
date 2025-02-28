@extends('layouts.app')

@section('title', 'Friends')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-xl font-semibold mb-4"> Friends</h3>

                    <div class="bg-white shadow-md rounded-lg p-4">
                        @if($friends->count() > 0)
                            <ul class="space-y-3">
                                @foreach($friends as $friend)
                                    <li class="flex items-center gap-3 p-3 bg-gray-100 rounded-lg">
                                        <a href="{{ route('profil.show', ['id' =>  $friend->following->id ]) }}">
                                            <img src="{{ $friend->following->profile_picture }}" 
                                                alt="Profile Image" class="w-12 h-12 rounded-full border border-gray-300">
                                        </a>
                                        <span class="text-gray-800 font-medium text-lg">
                                            {{ $friend->following->name }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">No friends yet.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

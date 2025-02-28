@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Follow Requests</h2>

                    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
                    
                        @if($followRequests->count() > 0)
                            <ul class="space-y-4">
                                @foreach($followRequests as $request)
                                    <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-sm">
                                        <div class="flex items-center gap-4">
                                            <a href="{{ route('profil.show', ['id' => $request->follower->id]) }}">
                                                <img src="{{ asset('storage/' . $request->follower->profile_picture) }}" 
                                                    class="w-12 h-12 rounded-full border-2 border-gray-300" alt="profile_picture">
                                            </a>
                                            <span class="font-medium text-gray-800">{{ $request->follower->name }}</span>
                                        </div>
                    
                                        <div class="flex gap-2">
                                            <form action="{{ route('acceptFollow', $request->follower->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                                    Accept 
                                                </button>
                                            </form>
                    
                                            <form action="{{ route('rejectFollow', $request->follower->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                                    Reject 
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 text-center mt-4">No pending follow requests.</p>
                        @endif
                    </div>                    


            </div>
        </div>
    </div>
</div>
@endsection





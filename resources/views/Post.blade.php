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

    <div class="max-w-2xl mx-auto mt-4">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Posts de mes amis</h2>

        @if($posts->count() > 0)
            @foreach($posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden my-4">
                    <div class="flex items-center px-4 py-3">
                        <a href="">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="User Image">
                        </a>
                        <div class="ml-3">
                            <p class="text-gray-800 font-semibold">{{ $post->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="px-4">
                        <p class="text-gray-800">{{ $post->content }}</p>
                    </div>

                    @if($post->image)
                        <div class="mt-2">
                            <img class="w-full h-64 object-cover" src="{{ asset('image_post/' . $post->image) }}" alt="Post Image">
                        </div>
                    @endif

                    <div class="px-4 py-3 flex justify-between border-t">
                        <div class="post">
                            <button onclick="likePost({{ $post->id }})">
                                Like (<span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>)
                            </button>
                        </div>
                        <div class="post">
                            <button onclick="toggleCommentForm({{ $post->id }})">Commenter</button>
                        </div>
                        
                    </div>
                    <div id="comment-section-{{ $post->id }}" style="display:none;" class="mt-4">
                        <textarea id="comment-input-{{ $post->id }}" placeholder="Écrire un commentaire..." class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2"></textarea>
                        <button onclick="submitComment({{ $post->id }})" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Envoyer</button>
                    
                        <div id="comments-{{ $post->id }}" class="mt-4">
                            @foreach($post->comments as $comment)
                                <div class="mb-2 p-2 border-b border-gray-200">
                                    <p class="font-semibold">{{ $comment->user->name }}</p>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </div>
            @endforeach
        @else
            <p class="text-gray-500">Aucun post de vos amis pour le moment.</p>
        @endif
    </div>

    <script src="../js/poste.js"></script>

    @endsection

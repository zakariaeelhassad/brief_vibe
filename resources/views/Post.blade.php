@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Posts de mes amis')

@section('content')
    @auth
    <!-- Search bar with improved styling -->
    <div class="flex justify-center items-center mt-6 mb-8">
        <form method="GET" action="{{ route('search') }}" class="relative w-full max-w-lg">
            <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Rechercher des utilisateurs..." 
                   class="w-full px-4 py-3 border-0 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <button type="submit" class="absolute top-1.5 right-2 px-4 py-1.5 text-white bg-blue-600 rounded-full hover:bg-blue-700 transition duration-200">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>     
    @endauth

    <div class="max-w-3xl mx-auto">
        @if($posts->count() > 0)
        <div class="space-y-6">
            @foreach($posts as $post)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <div class="flex items-center">
                            <a href="{{ route('profil.show', ['id' => $post->user->id]) }}">
                                <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-500" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="User Image">
                            </a>
                            <div class="ml-4">
                                <p class="text-gray-800 font-bold">{{ $post->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="px-6 py-4">
                        <p class="text-gray-800 text-lg">{{ $post->content }}</p>
                    </div>
        
                    @if($post->image)
                        <div>
                            <img class="w-full h-80 object-cover" src="{{ asset('image_post/' . $post->image) }}" alt="Post Image">
                        </div>
                    @endif
        
                    <div class="px-6 py-4 flex justify-between border-t border-gray-100 bg-blue-50">
                        <button onclick="likePost({{ $post->id }})" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="font-medium">J'aime (<span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>)</span>
                        </button>
                        <button onclick="toggleCommentForm({{ $post->id }})" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M21 6h-9l-2-2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-1 12H4V6h5.17l2 2H20v10zm-5-5h-2v2h-2v-2H9v-2h2V9h2v2h2v2z"/>
                            </svg>
                            <span class="font-medium">Commenter</span>
                        </button>
                    </div>
        
                    <div id="comment-section-{{ $post->id }}" style="display:none;" class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <div class="mb-4">
                            <textarea id="comment-input-{{ $post->id }}" placeholder="Écrire un commentaire..." 
                                      class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2 resize-none"></textarea>
                            <button onclick="submitComment({{ $post->id }})" 
                                    class="text-white bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-2 rounded-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 shadow-md font-medium">
                                Envoyer
                            </button>
                        </div>
                        
                        <div id="comments-{{ $post->id }}" class="space-y-3 mt-4">
                            @foreach($post->comments as $comment)
                                <div class="p-3 bg-white rounded-lg shadow-sm border border-black">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-2">
                                            <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-500" src="{{ $comment->user->profile_picture }}" alt="User Image">
                                        </div>
                                        <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>
        @else
            <div class="text-center py-10">
                <div class="bg-blue-50 rounded-xl p-8 shadow-sm border border-blue-100">
                    <div class="text-blue-600 mb-3">
                        <i class="fas fa-users-slash text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun post pour le moment</h3>
                    <p class="text-gray-600">Vos amis n'ont pas encore partagé de contenu ou vous devez ajouter des amis.</p>
                    <a href="/friends" class="inline-block mt-4 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 shadow-md font-medium">
                        Trouver des amis
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script>
        function likePost(postId) {
    fetch(`/post/${postId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
    .then(data => {
        let likeCount = document.getElementById(`like-count-${postId}`);
        let currentCount = parseInt(likeCount.innerText);

        if (data.message === 'Post liké') {
            likeCount.innerText = currentCount + 1;
        } else {
            likeCount.innerText = currentCount - 1;
        }
    });
}



function toggleCommentForm(postId) {
    let commentSection = document.getElementById(`comment-section-${postId}`);
    commentSection.style.display = (commentSection.style.display === "none") ? "block" : "none";
}

function submitComment(postId) {
    let content = document.getElementById(`comment-input-${postId}`).value;

    fetch(`/post/${postId}/comment`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: content })
    }).then(response => response.json())
    .then(data => {
        if (data.comment) {
            let commentSection = document.getElementById(`comments-${postId}`);
            let newComment = `<p><strong>${data.comment.user.name}</strong> : ${data.comment.content}</p>`;
            commentSection.innerHTML += newComment;
            document.getElementById(`comment-input-${postId}`).value = "";
        }
    });
}
    </script>
@endsection
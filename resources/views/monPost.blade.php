
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @auth
    <div class="flex justify-center items-center mt-6 mb-4">
        <form method="GET" action="{{ route('search') }}" class="relative w-full max-w-lg">
            <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Rechercher des utilisateurs..." 
                   class="w-full px-4 py-3 border-0 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <button type="submit" class="absolute top-1.5 right-2 px-4 py-1.5 text-white bg-blue-600 rounded-full hover:bg-blue-700 transition duration-200">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>     
    @endauth

    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-6 text-gray-900">
                    <button onclick="openModal()" class="text-white bg-gradient-to-r from-blue-500 to-blue-700 px-6 py-3 rounded-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 shadow-md font-medium flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Ajouter un post</span>
                    </button>

                    <div class="mt-8 space-y-6">
                        @foreach ($posts as $post)
                            <div class="max-w-xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 hover:shadow-xl transition duration-300">
                                <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <div class="flex items-center px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50">
                                        <a href="">
                                            <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-500" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="User Image">
                                        </a>
                                        <div class="ml-4">
                                            <p class="text-gray-800 font-bold">{{ $post->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                                                              
                                        <button onclick="openUpdateModal({{ $post->id }}, '{{ addslashes($post->content) }}', '{{ $post->image }}')" class="text-gray-500 hover:text-blue-600 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            
                                <div class="px-6 py-4">
                                    <p class="text-gray-800 text-lg">{{$post->content}}</p>
                                </div>
                            
                                <div>
                                    <img class="w-full h-80 object-cover" src="{{ asset('image_post/' . $post->image) }}" alt="Post Image">
                                </div>
                            
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
        
                                <!-- Comments section (hidden by default) -->
                                <div id="comment-section-{{ $post->id }}" style="display:none;" class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                    <div class="mb-4">
                                        <textarea id="comment-input-{{ $post->id }}" placeholder="Écrire un commentaire..." 
                                                  class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2 resize-none"></textarea>
                                        <button onclick="submitComment({{ $post->id }})" 
                                                class="text-white bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-2 rounded-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 shadow-md font-medium">
                                            Envoyer
                                        </button>
                                    </div>
                                    
                                    <!-- Existing comments -->
                                    <div id="comments-{{ $post->id }}" class="space-y-3 mt-4">
                                        @foreach($post->comments as $comment)
                                            <div class="p-3 bg-white rounded-lg shadow-sm border border-black">
                                                <div class="flex items-center mb-2">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-2">
                                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-500" src="{{ $comment->user->profile_picture }}" alt="User Image">                                            </div>
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
                </div>
            </div>
        </div>
    </div>

    <div id="articleModal" class="fixed inset-0 bg-gray-900 bg-opacity-70 flex justify-center items-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-blue-800">Créer un poste</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="/monPost" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <textarea name="content" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32" placeholder="Exprimez-vous..."></textarea>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <label class="block text-sm font-medium text-blue-800 mb-2">Ajouter une image</label>
                    <input type="file" name="image" class="w-full text-gray-700 bg-white border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex space-x-3 mt-6">
                    <button type="submit" class="flex-1 text-white bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition duration-300 shadow-md font-medium">
                        Publier
                    </button>
                    <button type="button" onclick="closeModal()" class="flex-1 text-gray-700 bg-gray-100 px-6 py-3 rounded-lg hover:bg-gray-200 transition duration-300 font-medium">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div id="update" class="fixed inset-0 bg-gray-900 bg-opacity-70 flex justify-center items-center hidden z-50 transition-opacity duration-300">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="modalupdate">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-blue-800">Modifier le post</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
    
            <form id="updateForm" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <textarea id="postContent" name="content" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32"></textarea>
                </div>
    
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <label class="block text-sm font-medium text-blue-800 mb-2">Ajouter une image</label>
                    <input type="file" name="image" class="w-full text-gray-700 bg-white border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
    
                <div id="currentImageContainer" class="mt-2">
                    <img id="currentImage" src="" alt="Image du post" class="w-full rounded-lg">
                </div>
    
                <div class="flex space-x-3 mt-6">
                    <button type="submit" class="flex-1 text-white bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-900 transition duration-300 shadow-md font-medium">
                        Modifier
                    </button>
                    <button type="button" onclick="closeModal()" class="flex-1 text-gray-700 bg-gray-100 px-6 py-3 rounded-lg hover:bg-gray-200 transition duration-300 font-medium">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
    

        <script>
            function openUpdateModal(postId, postContent, postImage) {
                const modal = document.getElementById("update");
                const content = document.getElementById("modalupdate");
                const form = document.getElementById("updateForm");
                const textarea = document.getElementById("postContent");
                const imageContainer = document.getElementById("currentImageContainer");
                const imageElement = document.getElementById("currentImage");

                form.action = `/post/update/${postId}`;

                textarea.value = postContent;

                if (postImage && postImage.trim() !== "") {
                    imageElement.src = `/image_post/${postImage}`;
                    imageContainer.style.display = "block";
                } else {
                    imageContainer.style.display = "none";
                }

                modal.classList.remove("hidden");
                setTimeout(() => {
                    content.classList.remove("scale-95", "opacity-0");
                    content.classList.add("scale-100", "opacity-100");
                }, 10);
            }

            function closeModal() {
                const modal = document.getElementById("update");
                const content = document.getElementById("modalupdate");

                content.classList.remove("scale-100", "opacity-100");
                content.classList.add("scale-95", "opacity-0");

                setTimeout(() => {
                    modal.classList.add("hidden");
                }, 300);
            }
            

        </script>
    

<script>
    function openModal() {
        const modal = document.getElementById("articleModal");
        const content = document.getElementById("modalContent");
        
        modal.classList.remove("hidden");
        setTimeout(() => {
            content.classList.remove("scale-95", "opacity-0");
            content.classList.add("scale-100", "opacity-100");
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById("articleModal");
        const content = document.getElementById("modalContent");
        
        content.classList.remove("scale-100", "opacity-100");
        content.classList.add("scale-95", "opacity-0");
        
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }


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
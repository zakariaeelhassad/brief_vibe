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
                    <button onclick="openModal()" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">ajouter post</button>

                    @foreach ($posts as $post)
                        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden my-4">
                            <!-- Header -->
                            <div class="flex items-center px-4 py-3">
                                <a href="">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="User Image">
                                </a>
                                <div class="ml-3">
                                    <p class="text-gray-800 font-semibold">{{ $post->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        
                            <!-- Content -->
                            <div class="px-4">
                                <p class="text-gray-800">{{$post->content}}</p>
                            </div>
                        
                            <!-- Post Image -->
                            <div class="mt-2">
                                <img class="w-full h-64 object-cover" src="{{ asset('image_post/' . $post->image) }}" alt="Post Image" >
                            </div>
                        
                            <!-- Buttons -->
                            <div class="px-4 py-3 flex justify-between border-t">
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    <span>J'aime</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M21 6h-9l-2-2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-1 12H4V6h5.17l2 2H20v10zm-5-5h-2v2h-2v-2H9v-2h2V9h2v2h2v2z"/></svg>
                                    <span>Commenter</span>
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


    <div id="articleModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Créer un article</h2>

    <form action="/monPost" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="content" class="w-full p-2 border rounded-lg" placeholder="Exprimez-vous..."></textarea>
    
        <input type="file" name="image" class="mt-2">
    
        <button type="submit" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 mt-2">
            Ajouter Post
        </button>
        <button  onclick="closeModal()" class="text-white bg-gray-500 px-4 py-2 rounded-lg hover:bg-gray-600 mt-2">
            annuler
        </button>
    </form>
</div>
</div>
    

<script>
    function openModal() {
        document.getElementById("articleModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("articleModal").classList.add("hidden");
    }
</script>

@endsection

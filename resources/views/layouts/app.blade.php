<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vibe')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .gradient-bg {
            background: linear-gradient(90deg, #3B82F6 0%, #4F46E5 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header with gradient -->
    <div class="gradient-bg h-2"></div>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-8">
                    <a href="/" class="flex items-center">
                        <div class="gradient-bg p-2 rounded-lg mr-2">
                            <i class="fas fa-comment-alt text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">Vibe</span>
                    </a>
                    
                    @auth
                    <div class="hidden md:flex space-x-6">
                        <a href="/" class="nav-link flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            <span>Accueil</span>
                        </a>
                        <a href="/post" class="nav-link flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            <i class="fas fa-newspaper mr-2"></i>
                            <span>Posts</span>
                        </a>
                        <a href="/monPost" class="nav-link flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            <i class="fas fa-user-edit mr-2"></i>
                            <span>Mes Posts</span>
                        </a>
                        <a href="/follow/requests" class="nav-link flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            <i class="fas fa-users mr-2"></i>
                            <span>Réseau</span>
                        </a>
                        <a href="/friends" class="nav-link flex items-center text-gray-700 hover:text-blue-600 font-medium transition duration-200">
                            <i class="fas fa-user-friends mr-2"></i>
                            <span>Amis</span>
                        </a>
                    </div>
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    @guest
                    <a href="/login" class="px-5 py-2 text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 shadow-md transition duration-300 transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                    <a href="/signup" class="px-5 py-2 text-blue-600 bg-white border border-blue-500 rounded-lg hover:bg-blue-50 shadow-sm transition duration-300 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                    @endguest

                    @auth
                    <div class="flex items-center space-x-2">
                        <a href="/modificationProfil" class="relative group">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 hover:bg-blue-200 transition duration-300">
                                <img src="{{ auth()->user()->profile_picture ? asset(auth()->user()->profile_picture) : asset('images/default-profile.png') }}" 
                                     alt="Profile Image" class="w-10 h-10 rounded-full object-cover">
                            </div>
                            <span class="absolute top-full right-0 mt-2 w-auto whitespace-nowrap px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200">Mon Profil</span>
                        </a>
                        
                        
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button class="flex items-center px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg hover:from-blue-700 hover:to-indigo-800 shadow-md transition duration-300 transform hover:scale-105">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                    @endauth
                    
                    <button class="md:hidden flex items-center p-2 rounded-md text-gray-700 hover:text-blue-600" id="mobileMenuButton">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
            
            @auth
            <div class="md:hidden hidden transition duration-300 ease-in-out" id="mobileMenu">
                <div class="py-3 space-y-1 border-t border-gray-200">
                    <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="/post" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <i class="fas fa-newspaper mr-2"></i>Posts
                    </a>
                    <a href="/monPost" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <i class="fas fa-user-edit mr-2"></i>Mes Posts
                    </a>
                    <a href="/follow/requests" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <i class="fas fa-users mr-2"></i>Réseau
                    </a>
                    <a href="/friends" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <i class="fas fa-user-friends mr-2"></i>Amis
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-12 py-6 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="gradient-bg p-2 rounded-lg mr-2">
                        <i class="fas fa-comment-alt text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">Vibe</span>
                </div>
                
                <div class="text-gray-500 text-sm text-center md:text-right">
                    <p>© 2025 Vibe. Tous droits réservés.</p>
                    <p class="mt-1">Connectez-vous. Partagez. Vibez.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
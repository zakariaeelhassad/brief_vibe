<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vibe')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <div>
                <a href="/" class="text-white text-lg font-semibold m-10">Home</a>
                @auth
                    <a href="/post" class="text-white text-lg font-semibold">Posts</a>
                    <a href="/follow/requests" class="text-white text-lg font-semibold m-10">reseau</a>
                    <a href="/monPost" class="text-white text-lg font-semibold">Mon Poste</a>
                    <a href="/friends" class="text-white text-lg font-semibold m-10">friends</a>
                @endauth
            </div>

            @guest
            <div>
                <a href="/login" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Login</a>
                <a href="/signup" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Signup</a>
            </div>
            @endguest

            @auth
            <div class="flex">
                <form method="POST" action="{{route('logout')}}">
                @csrf
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 m-2">Logout</button>
                </form>
                <a href="/modificationProfil" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 m-2">Profile</a>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

</body>
</html>

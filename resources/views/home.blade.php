<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <!-- Home Link -->
            <a href="#" class="text-white text-lg font-semibold">Home</a>
            <div>
                @guest
                <a href="/Vibe.test/public/login" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">login</a>
                <a href="/Vibe.test/public/signup" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">signup</a>
                @endguest
            </div>
            @auth
            <div>
                <form method="POST" action="{{route('logout')}}">
                @csrf
                    <button class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">logout</button>
                </form>
                <a href="/Vibe.test/public/modificationProfil" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Profile</a>
            </div>
            @endauth
        </div>
    </nav>

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
                                    <i class="fas fa-user-tag text-gray-500 mr-1"></i> Updated at
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">
                                    <i class="fas fa-calendar text-gray-500 mr-1"></i> Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="{{ $user->profile_picture }}" class="w-6 h-6 rounded-full">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->updated_at }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</body>
</html>

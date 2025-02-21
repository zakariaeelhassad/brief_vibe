<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-indigo-600 p-4">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <!-- Home Link -->
            <a href="/Vibe.test/public/home" class="text-white text-lg font-semibold">Home</a>

            <!-- Profile Button -->
            <div>
                <a href="/Vibe.test/public/modificationProfil" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Profile</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        <h2 class="font-semibold text-2xl text-gray-800 mb-6">Edit Profile</h2>
        
        <!-- Form for profile update -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
        
            <!-- Profile Picture -->
            <div class="flex items-center gap-4">
                <!-- Profile image preview -->
                <img id="profile-image-preview" 
                     src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
                     alt="Profile Picture" 
                     class="w-20 h-20 rounded-full border">
            
                <div>
                    <input type="file" id="profile_image" name="profile_picture" accept="image/*" class="hidden" onchange="previewImage(event)">
                    <button type="button" onclick="document.getElementById('profile_image').click();" class="px-4 py-2 bg-secondary text-black rounded">
                        {{ __('Choose Image') }}
                    </button>
                </div>
            </div>
        
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm text-gray-600">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-2 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm text-gray-600">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="mt-2 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Current Password -->
            <div>
                <label for="password" class="block text-sm text-gray-600">Current Password</label>
                <input type="password" name="password" id="password" class="mt-2 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- New Password -->
            <div>
                <label for="new_password" class="block text-sm text-gray-600">New Password</label>
                <input type="password" name="new_password" id="new_password" class="mt-2 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('new_password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-sm text-gray-600">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 px-4 py-2 border rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        
            <div class="flex items-center justify-between">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update Profile
                </button>
            </div>
        </form>
        
    </div>

    <script>
        function previewImage(event) {
            let file = event.target.files[0]; // Récupérer l'image sélectionnée
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>

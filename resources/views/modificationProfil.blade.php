@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

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

        <form action="{{ route('profile.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Delete user
            </button>
        </form>
        
    </div>

    

    <script>
        function previewImage(event) {
            let file = event.target.files[0]; 
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection

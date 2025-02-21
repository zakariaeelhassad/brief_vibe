<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105">
        <div class="relative">
            <img class="w-full h-36 object-cover" src="{{ asset('images/champe.jpg') }}" alt="Cover">
            <img class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 absolute -bottom-12 left-1/2 transform -translate-x-1/2" src="{{ asset('images/champe.jpg') }}" alt="Profile">
        </div>        
        <div class="text-center mt-14 p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">John Doe</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300">Full Stack Developer</p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="#" class="text-blue-500 hover:text-blue-700 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-blue-400 hover:text-blue-600 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-700 dark:text-gray-400 hover:text-black dark:hover:text-white transition"><i class="fab fa-github"></i></a>
            </div>
            <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-blue-700 transition">Follow</button>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 p-6">
            <p class="text-gray-700 dark:text-gray-300 text-sm">Passionate about building web applications that are user-friendly and visually appealing. Always learning and improving.</p>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 p-6 text-center">
            <button class="bg-green-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-green-700 transition">Edit Profile</button>
        </div>
    </div>
</body>
</html>

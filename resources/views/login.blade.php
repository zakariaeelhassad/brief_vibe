<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZHOO Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('public/assets/Favicon/favicon-32x32.png') }}" type="image/x-icon">
    <style>
        /* Custom scroll bar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgb(18, 18, 18);
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgb(212, 212, 198);
            border-radius: 10px;
            border: 2px solid rgb(255, 255, 255);
        }
    </style>
</head>
<body class="overflow-x-hidden bg-[#0e1111]">
    <div class="flex flex-row bg-[#0e1111]">
        <video class="fixed top-0 left-0 h-screen w-[70vw] object-cover" autoplay loop muted>
            <source src="{{ asset('public/assets/images/vid.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="fixed top-[17%] right-0 h-screen w-[30vw] bg-[#0e1111] text-gray-100 font-[Jura]">
            <form class="max-w-md mx-auto p-8" action="/Vibe.test/public/login" method="POST">
                @csrf
                <h2 class="text-4xl font-extrabold mb-6 text-center text-blue-400">Login</h2>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-base font-semibold text-gray-300">Email</label>
                    <input type="email" name="email" id="email" class="block w-full px-4 py-2 border border-gray-700 bg-[#1a1f24] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-base font-semibold text-gray-300">Password</label>
                    <input type="password" name="password" id="password" class="block w-full px-4 py-2 border border-gray-700 bg-[#1a1f24] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4 text-center">
                    <a href="/Vibe.test/public/signup" class="text-sm text-blue-400 hover:text-blue-500 hover:underline">
                        Don't have an account?
                    </a>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-2xl w-full transition-all duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CloseCall - Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-teal-200 via-teal-300 to-teal-400 min-h-screen">
    
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="w-8 h-8">
                    <span class="text-xl font-bold text-gray-800">CloseCall</span>
                </div>
                <div class="flex space-x-4">
                    @if(session('user_id'))
                        <!-- User is logged in -->
                        <span class="text-gray-700">Welcome, {{ session('user_name') }}!</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Logout
                            </button>
                        </form>
                    @else
                        <!-- User is not logged in -->
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Success Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-center">
            <h1 class="text-4xl font-bold text-white mb-6">Welcome to CloseCall!</h1>
            
            @if(session('user_id'))
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-auto">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dashboard</h2>
                    <div class="text-left">
                        <p><strong>Name:</strong> {{ session('user_name') }}</p>
                        <p><strong>Email:</strong> {{ session('user_email') }}</p>
                        <p><strong>Status:</strong> <span class="text-green-600">Logged In</span></p>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-auto">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Get Started</h2>
                    <p class="text-gray-600 mb-4">Join CloseCall today and connect with others!</p>
                    <div class="space-x-4">
                        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Sign Up
                        </a>
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
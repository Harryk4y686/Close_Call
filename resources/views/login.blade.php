<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #b2f5ea, #81e6d9, #38b2ac);
            font-family: 'Inter', sans-serif;
        }
        .card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 1000px;
        }
        .left-side {
            background: url('/image/background.png') no-repeat center center;
            background-size:cover;
        }
        .input-field {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 12px 14px;
            width: 100%;
            outline: none;
            transition: border 0.3s;
        }
        .input-field:focus {
            border-color: #38b2ac;
        }
        .btn-login {
            background: #009688;
            color: white;
            padding: 12px;
            border-radius: 9999px;
            width: 60%;
            font-weight: 600;
            transition: background 0.3s ease;
            margin-left: 20%;
            margin-right: 20%;
        }
        .btn-login:hover {
            background: #00796b;
        }
        .social-btn {
            border-radius: 12px;
            padding: 8px;
            background: #fff;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
            transition: transform 0.2s;
        }
        .social-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="card w-10/12 lg:w-8/12 grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Side -->
<div class="left-side flex items-start p-6">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="w-12 h-12">
        <span class="text-white text-2xl font-bold">CloseCall</span>
    </div>
</div>

        <!-- Right Side (Form) -->
        <div class="bg-white p-10 flex flex-col justify-center">
            <h1 class="text-2xl font-bold mb-2">Welcome Back to CloseCall!</h1>
            <p class="font-semibold mb-1" style="font-size: 20px">Login</p>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email" class="input-field" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" class="input-field" required>

                <div class="flex justify-end text-sm">
                    <a href="" class="text-gray-600 hover:text-cyan-700">
                        Forgot your password?
                    </a>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <p class="mt-4 text-sm text-gray-600" style="text-align: center">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-cyan-700 font-medium">Sign up</a>
            </p>

            <div class="flex items-center my-6">
                <hr class="flex-grow border-gray-300">
                <span class="mx-3 text-gray-500 text-sm">or</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <div class="flex justify-center space-x-6">
                <a href="#" class="social-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-12 h-12" alt="Facebook">
                </a>
                <a href="#" class="social-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" class="w-12 h-12" alt="Google">
                </a>
            </div>
        </div>
    </div>

</body>
</html>

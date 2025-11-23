<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
        }
        
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            object-fit: cover;
            object-position: center center;
        }
        
        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.1);
            z-index: -1;
        }
        .card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 1000px;
        }
        .left-side {
            background: url('/image/background.png');
            background-size:cover;
        }
        .input-field {
            border: 1px solid #ccc;
            border-radius: 16px;
            padding: 12px 14px;
            width: 100%;
            outline: none;
            transition: border 0.3s;
        }
        .input-field:focus {
            border-color: #38b2ac;
        }
        .btn-submit {
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
        .btn-submit:hover {
            background: #00796b;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            body {
                overflow-y: auto;
                overflow-x: hidden;
            }
            
            .video-background {
                object-position: center center;
            }
            
            .card {
                height: auto;
                min-height: 100vh;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <video class="video-background" autoplay muted loop playsinline>
        <source src="{{ asset('image/loginsignup.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="video-overlay"></div>

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
            <h1 class="text-2xl font-bold mb-2">Forgot Your Password?</h1>
            <p class="text-gray-600 mb-6 text-sm">
                Enter your Gmail address and we'll send you a link to reset your password.
            </p>

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

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="email" name="email" placeholder="Enter your Gmail address" class="input-field" value="{{ old('email') }}" required>
                    <p class="text-xs text-gray-500 mt-2">
                        ℹ️ Password reset is only available for Gmail addresses (@gmail.com)
                    </p>
                </div>

                <button type="submit" class="btn-submit">Send Reset Link</button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-cyan-700 hover:text-cyan-900 font-medium text-sm">
                    ← Back to Login
                </a>
            </div>

            <p class="mt-4 text-sm text-gray-600" style="text-align: center">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-cyan-700 font-medium">Sign up</a>
            </p>
        </div>
    </div>

</body>
</html>

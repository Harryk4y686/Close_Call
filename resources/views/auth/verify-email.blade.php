<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your Email - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #b2f5ea, #81e6d9, #38b2ac);
            font-family: 'Inter', sans-serif;
        }
        .verification-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            margin: 0 auto;
        }
        .code-input {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background-color: #f7fafc;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            outline: none;
            transition: all 0.2s;
        }
        .code-input:focus {
            border-color: #38b2ac;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(56, 178, 172, 0.1);
        }
        .verify-btn {
            background: #009688;
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 200px;
        }
        .verify-btn:hover {
            background: #00796b;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 150, 136, 0.3);
        }
        .verify-btn:active {
            transform: translateY(0);
        }
        .manual-verify-btn {
            background: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        .manual-verify-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    
    <div class="verification-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Verify your Email!</h1>
            <p class="text-gray-600 text-base leading-relaxed">
                Account activation code has been sent to the address you provided. Please input the code here.
            </p>
        </div>

        <!-- Display Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p class="text-center">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Verification Code Form -->
        <form method="POST" action="{{ route('verification.code') }}" class="text-center">
            @csrf
            
            <!-- Code Input Fields -->
            <div class="flex justify-center space-x-3 mb-8">
                <input type="text" name="code1" class="code-input" maxlength="1" onkeyup="moveToNext(this, 'code2')" onkeydown="moveToPrev(this, event)" required>
                <input type="text" name="code2" class="code-input" maxlength="1" onkeyup="moveToNext(this, 'code3')" onkeydown="moveToPrev(this, event, 'code1')" required>
                <input type="text" name="code3" class="code-input" maxlength="1" onkeyup="moveToNext(this, 'code4')" onkeydown="moveToPrev(this, event, 'code2')" required>
                <input type="text" name="code4" class="code-input" maxlength="1" onkeyup="moveToNext(this, 'code5')" onkeydown="moveToPrev(this, event, 'code3')" required>
                <input type="text" name="code5" class="code-input" maxlength="1" onkeydown="moveToPrev(this, event, 'code4')" required>
            </div>

            <!-- Verify Button -->
            <button type="submit" class="verify-btn mx-auto">
                Verify
            </button>
        </form>

        <!-- Alternative Actions -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm mb-4">
                Didn't receive the code? 
                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium" onclick="resendCode()">Resend</a>
            </p>

            <!-- Logout option -->
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-gray-600 text-sm underline">
                    Use different account
                </button>
            </form>
        </div>

        <!-- Manual verification for testing (hidden by default) -->
        <div class="mt-6 pt-4 border-t border-gray-200 text-center" style="display: none;" id="debug-section">
            <small class="text-gray-400 block mb-2">For testing purposes:</small>
            <form method="POST" action="{{ route('verification.manual') }}" class="inline-block">
                @csrf
                <button type="submit" class="manual-verify-btn">
                    Skip Verification
                </button>
            </form>
        </div>
    </div>

    <script>
        // Show debug section if in development environment
        if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
            document.getElementById('debug-section').style.display = 'block';
        }

        // Auto focus and move to next input
        function moveToNext(current, nextFieldId) {
            if (current.value.length === 1) {
                const nextField = document.getElementsByName(nextFieldId)[0];
                if (nextField) {
                    nextField.focus();
                }
            }
        }

        // Handle backspace to move to previous field
        function moveToPrev(current, event, prevFieldId) {
            if (event.key === 'Backspace' && current.value.length === 0 && prevFieldId) {
                const prevField = document.getElementsByName(prevFieldId)[0];
                if (prevField) {
                    prevField.focus();
                }
            }
        }

        // Resend code functionality
        function resendCode() {
            // Here you could implement actual resend logic
            alert('Verification code sent! Please check your email.');
        }

        // Focus first input on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementsByName('code1')[0].focus();
        });

        // Only allow numeric input
        document.querySelectorAll('.code-input').forEach(input => {
            input.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
</body>
</html>

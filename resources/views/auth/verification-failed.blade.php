<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Failed - Close Call</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            max-width: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        .verify-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
        }
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="verify-card">
        <div class="verify-icon">
            <svg width="40" height="40" fill="white" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>
        
        <div class="text-center">
            <h2 class="h4 mb-3">❌ Verification Link Invalid or Expired</h2>
            <p class="text-muted mb-4">
                {{ $message ?? 'The verification link is invalid or has expired. Please request a new verification email.' }}
            </p>

            <form method="POST" action="{{ route('verification.resend') }}" class="mb-3">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    Send New Verification Email
                </button>
            </form>

            <div class="d-grid gap-2">
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                    Create New Account
                </a>
                <a href="http://127.0.0.1:8000/login" class="btn btn-outline-secondary">
                    Go to Login
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

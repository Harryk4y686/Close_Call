<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmed - Close Call</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .confirm-card {
            max-width: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 3rem;
            text-align: center;
        }
        .confirm-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            color: white;
        }
        .main-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
        .subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="confirm-card">
        <div class="confirm-icon">
            <svg width="50" height="50" fill="white" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
            </svg>
        </div>
        
        <h1 class="main-title">Email Confirmed</h1>
        <p class="subtitle">Go back and log in your email</p>
        
        <a href="http://127.0.0.1:8000/login" class="btn-login">
            Go to Login
        </a>
    </div>

    <script>
        // Auto redirect after 3 seconds
        setTimeout(function() {
            window.location.href = 'http://127.0.0.1:8000/login';
        }, 3000);
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Close_Call\resources\views/auth/email-confirmed.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Close Call</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 14H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>
            </svg>
        </div>
        
        <div class="text-center">
            <h2 class="h4 mb-3">Verifikasi Email Anda</h2>
            <p class="text-muted mb-4">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang lain.
            </p>

            <!-- Success message that appears after clicking send button -->
            <div id="sentMessage" class="alert alert-success" role="alert" style="display: none;">
                Email verifikasi telah dikirim! Silakan periksa kotak masuk Anda.
            </div>

            <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" class="form-control mb-3" required>
                    <button type="submit" class="btn btn-primary me-2">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>
            <!-- Send verification email button (non-functional but pressable) -->
    

            <!-- Logout button (keeping as functional) -->
            <form class="d-inline" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">
                    Logout
                </button>
            </form>
            
            <!-- Manual verification button at the bottom -->
            <div class="mt-4 pt-3 border-top">
                <small class="text-muted d-block mb-2">Untuk pengujian atau debugging:</small>
                <form method="POST" action="{{ route('verification.manual') }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        Verifikasi Manual (Skip Verifikasi Email)
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function sendVerificationEmail() {
            // Hide the send button and show the sent message
            document.getElementById('sendVerificationBtn').style.display = 'none';
            document.getElementById('sentMessage').style.display = 'block';
            
            // Optional: Add a small animation effect
            document.getElementById('sentMessage').style.opacity = '0';
            setTimeout(function() {
                document.getElementById('sentMessage').style.transition = 'opacity 0.5s ease-in';
                document.getElementById('sentMessage').style.opacity = '1';
            }, 100);
            
            // Optional: Show the send button again after 5 seconds
            setTimeout(function() {
                document.getElementById('sendVerificationBtn').style.display = 'inline-block';
                document.getElementById('sentMessage').style.display = 'none';
            }, 5000);
        }
    </script>
</body>
</html>




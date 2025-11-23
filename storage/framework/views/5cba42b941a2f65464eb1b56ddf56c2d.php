<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CloseCall</title>
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
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            body {
                overflow-y: auto;
                overflow-x: hidden;
            }
            
            .video-background {
                object-position: center center;
                /* Alternative for better fit: object-fit: contain; */
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
        <source src="<?php echo e(asset('image/loginsignup.mp4')); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="video-overlay"></div>

    <div class="card w-10/12 lg:w-8/12 grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Side -->
<div class="left-side flex items-start p-6">
    <div class="flex items-center space-x-3">
        <img src="<?php echo e(asset('image/logo.png')); ?>" alt="CloseCall Logo" class="w-12 h-12">
        <span class="text-white text-2xl font-bold">CloseCall</span>
    </div>
</div>

        <!-- Right Side (Form) -->
        <div class="bg-white p-10 flex flex-col justify-center">
            <h1 class="text-2xl font-bold mb-2">Welcome Back to CloseCall!</h1>
            <p class="font-semibold mb-1" style="font-size: 20px">Login</p>

            <!-- Display Validation Errors -->
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Display Success Message -->
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Display Info Message -->
            <?php if(session('info')): ?>
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('info')); ?>

                </div>
            <?php endif; ?>

            <!-- Display Warning Message -->
            <?php if(session('warning')): ?>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <?php echo e(session('warning')); ?>

                    </div>
                    <?php if(session('show_resend_link')): ?>
                        <div class="text-sm">
                            <p class="mb-2">Didn't receive the email?</p>
                            <form action="<?php echo e(route('verification.resend')); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="email" value="<?php echo e(session('user_email')); ?>">
                                <button type="submit" class="text-yellow-800 underline hover:text-yellow-900 font-medium">
                                    Resend verification email
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="Email" class="input-field" value="<?php echo e(old('email')); ?>" required>
                <input type="password" name="password" placeholder="Password" class="input-field" required>

                <div class="flex justify-end text-sm">
                    <a href="<?php echo e(route('password.request')); ?>" class="text-gray-600 hover:text-cyan-700">
                        Forgot your password?
                    </a>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <p class="mt-4 text-sm text-gray-600" style="text-align: center">
                Don’t have an account?
                <a href="<?php echo e(route('register')); ?>" class="text-cyan-700 font-medium">Sign up</a>
            </p>
            
            <!-- Admin Login Info -->
            <div style="margin-top: 16px; padding: 12px; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 8px; border: 1px solid #00A88F;">
                <p style="text-align: center; margin: 0; font-size: 13px; color: #00A88F; font-weight: 600;">
                    🔐 Admin Access: Use admin credentials to access the dashboard
                </p>
            </div>

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
<?php /**PATH C:\laragon\www\Close_Call\resources\views/login.blade.php ENDPATH**/ ?>
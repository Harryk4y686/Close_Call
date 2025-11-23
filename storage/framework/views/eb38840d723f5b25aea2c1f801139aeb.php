<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideInSoft {
            0% {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        @keyframes floatIn {
            0% {
                opacity: 0;
                transform: scale(0.95);
                filter: blur(6px);
            }
            100% {
                opacity: 1;
                transform: scale(1);
                filter: blur(0);
            }
        }
        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.7);
            }
            70% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 109px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem 0;
            z-index: 1000;
        }
        .sidebar-logo {
            width: 61px;
            height: 61px;
            margin-bottom: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .sidebar-icon-img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
        .sidebar-icon {
            width: 60px;
            height: 60px;
            margin: 0.5rem 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background-color 0.3s;
            position: relative;
            text-decoration: none;
            color: inherit;
        }
        .sidebar-icon:hover {
            background-color: #f3f4f6;
        }
        .sidebar-icon.active {
            background-color: #f3f4f6;
        }
        .sidebar-icon.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: linear-gradient(to bottom, #00A88F, #81e6d9);
            border-radius: 0 2px 2px 0;
        }
        .main-content {
            margin-left: 109px;
            padding: 0;
            min-height: 100vh;
        }
        .header {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 70px;
            gap: 1rem;
        }
        .search-bar {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 504px;
            border: 1px solid #000000;
            height: 40px;
        }
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            color: #000000;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }
        .search-bar input::placeholder {
            color: #000000;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .notification-icon, .avatar-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            transition: background-color 0.3s;
            text-decoration: none;
            color: inherit;
        }
        .notification-icon:hover, .avatar-icon:hover {
            background: #e5e7eb;
        }
        .notification-icon svg, .avatar-icon svg {
            width: 18px;
            height: 18px;
        }
        .content-wrapper {
            padding: 36px;
        }
        .main-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            margin-left: 30px;
            overflow: hidden;
            animation: slideInSoft 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .profile-header {
            background-image: url("<?php echo e(asset('image/defaultbanner.png')); ?>");
            border-radius: 12px 12px 0 0;
            padding: 2rem;
            margin: -2rem -2rem 4rem -2rem;
            position: relative;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: floatIn 0.9s ease-out 0.05s both;
        }
        .profile-avatar {
            position: absolute;
            bottom: -50px;
            left: 2rem;
            width: 172px;
            height: 172px;
            border-radius: 50%;
            background: #e5e7eb;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-avatar svg {
            width: 60px;
            height: 60px;
            fill: #9ca3af;
        }
        .profile-buttons {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
        }
        .btn-edit {
            background: #00A88F;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            width: 144px;
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
            animation: popIn 0.6s ease-out 0.25s both;
        }
        .btn-edit:hover {
            background: #00c0a3;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 168, 143, 0.3);
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: black;
            margin-bottom: 1.5rem;
            margin-top: 4rem;
        }
        .form-card {
            border: 2px solid #111;
            border-radius: 20px;
            padding: 2rem;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-top: 4rem;
            animation: slideInSoft 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
        }
        .form-card .section-title:first-of-type {
            margin-top: 0;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-group input, .form-group select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #00A88F;
        }
        .upload-section {
            margin-bottom: 2rem;
        }
        .upload-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #374151;
        }
        .upload-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            border: 2px solid #00A88F;
            color: #00A88F;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        .upload-btn:hover {
            background: #00A88F;
            color: white;
        }
        .upload-icon {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
        }
        .upload-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .cancel-btn {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .cancel-btn:hover {
            background: #dc2626;
        }
        .file-selected {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }
        .save-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 397px;
            max-width: 100%;
            margin: 2rem auto 0;
            display: block;
            animation: popIn 0.7s ease-out 0.35s both;
        }
        .save-btn:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="<?php echo e(asset('image/logo.png')); ?>" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="<?php echo e(route('AdminDashboard')); ?>" class="sidebar-icon active" data-page="home">
            <img src="<?php echo e(asset('image/home.png')); ?>" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminUserDatabase')); ?>" class="sidebar-icon" data-page="users">
            <img src="<?php echo e(asset('image/users.png')); ?>" alt="Users" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminJobDatabase')); ?>" class="sidebar-icon" data-page="jobs">
            <img src="<?php echo e(asset('image/jobs.png')); ?>" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminEventDatabase')); ?>" class="sidebar-icon" data-page="events">
            <img src="<?php echo e(asset('image/events.png')); ?>" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminCompanyDatabase')); ?>" class="sidebar-icon" data-page="companies">
            <img src="<?php echo e(asset('image/company.png')); ?>" alt="Companies" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
        </div>

        <div class="content-wrapper">
            <!-- Dashboard Title -->
            <h1 class="text-3xl font-bold text-black mb-8">Admin Dashboard</h1>

            <!-- Welcome Section -->
            <div class="mb-6 bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-black mb-2">Welcome back, Admin!</h2>
                <p class="text-gray-600 mb-6"><?php echo e(date('l, d F Y')); ?></p>
                
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-[#00A88F] hover:bg-[#008f7a] text-white px-6 py-2.5 rounded-full flex items-center gap-2 transition-colors font-medium">
                        Logout
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-6">
                <!-- Total Users -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="mb-4">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-black mb-1"><?php echo e($stats['users']); ?></div>
                    <div class="text-gray-600">Total Users</div>
                </div>

                <!-- Total Jobs -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="mb-4">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-black mb-1"><?php echo e($stats['jobs']); ?></div>
                    <div class="text-gray-600">Total Jobs</div>
                </div>

                <!-- Total Events -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="mb-4">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-black mb-1"><?php echo e($stats['events']); ?></div>
                    <div class="text-gray-600">Total Events</div>
                </div>

                <!-- Total Companies -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="mb-4">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l8-4 8 4v14"></path>
                            <path d="M17 21v-8.5a1.5 1.5 0 0 0-1.5-1.5h-7a1.5 1.5 0 0 0-1.5 1.5V21"></path>
                            <path d="M9 11h.01"></path>
                            <path d="M9 14h.01"></path>
                            <path d="M9 17h.01"></path>
                            <path d="M15 11h.01"></path>
                            <path d="M15 14h.01"></path>
                            <path d="M15 17h.01"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-black mb-1"><?php echo e($stats['companies']); ?></div>
                    <div class="text-gray-600">Total Companies</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-black mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Manage Users -->
                    <a href="<?php echo e(route('AdminUserDatabase')); ?>" class="bg-[#e9f0f5] hover:bg-[#dde5eb] p-8 rounded-2xl flex flex-col items-center justify-center transition-colors group text-decoration-none">
                        <div class="mb-4 text-gray-500 group-hover:text-gray-700">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">Manage Users</span>
                    </a>

                    <!-- Manage Jobs -->
                    <a href="<?php echo e(route('AdminJobDatabase')); ?>" class="bg-[#e9f0f5] hover:bg-[#dde5eb] p-8 rounded-2xl flex flex-col items-center justify-center transition-colors group text-decoration-none">
                        <div class="mb-4 text-gray-500 group-hover:text-gray-700">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">Manage Jobs</span>
                    </a>

                    <!-- Manage Events -->
                    <a href="<?php echo e(route('AdminEventDatabase')); ?>" class="bg-[#e9f0f5] hover:bg-[#dde5eb] p-8 rounded-2xl flex flex-col items-center justify-center transition-colors group text-decoration-none">
                        <div class="mb-4 text-gray-500 group-hover:text-gray-700">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">Manage Events</span>
                    </a>

                    <!-- Manage Companies -->
                    <a href="<?php echo e(route('AdminCompanyDatabase')); ?>" class="bg-[#e9f0f5] hover:bg-[#dde5eb] p-8 rounded-2xl flex flex-col items-center justify-center transition-colors group text-decoration-none">
                        <div class="mb-4 text-gray-500 group-hover:text-gray-700">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18"></path>
                                <path d="M5 21V7l8-4 8 4v14"></path>
                                <path d="M17 21v-8.5a1.5 1.5 0 0 0-1.5-1.5h-7a1.5 1.5 0 0 0-1.5 1.5V21"></path>
                                <path d="M9 11h.01"></path>
                                <path d="M9 14h.01"></path>
                                <path d="M9 17h.01"></path>
                                <path d="M15 11h.01"></path>
                                <path d="M15 14h.01"></path>
                                <path d="M15 17h.01"></path>
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">Manage Companies</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Close_Call\resources\views/admin/AdminDashboard.blade.php ENDPATH**/ ?>
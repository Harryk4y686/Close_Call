<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies Database - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            padding: 2rem 0;
            z-index: 1000;
        }
        
        .sidebar-logo {
            padding: 0 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-logo img {
            width: 40px;
            height: 40px;
        }
        
        .sidebar-title {
            font-size: 24px;
            font-weight: 700;
            color: #00A88F;
        }
        
        .sidebar-menu {
            flex: 1;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 2rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover,
        .menu-item.active {
            background: #f0fdf4;
            color: #00A88F;
            border-left-color: #00A88F;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall">
            <span class="sidebar-title">CloseCall</span>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="menu-item">
                <span>👥</span>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.jobs') }}" class="menu-item">
                <span>💼</span>
                <span>Jobs</span>
            </a>
            <a href="{{ route('admin.events') }}" class="menu-item">
                <span>📅</span>
                <span>Events</span>
            </a>
            <a href="{{ route('admin.companies') }}" class="menu-item active">
                <span>🏢</span>
                <span>Companies</span>
            </a>
        </div>
        
        <div style="padding: 0 2rem; border-top: 1px solid #e5e7eb; padding-top: 1rem;">
            <a href="{{ route('profile') }}" class="menu-item">
                <span>👤</span>
                <span>Back to Profile</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div style="background: white; padding: 1.5rem 2rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <h1 style="font-size: 28px; font-weight: 700; color: #1f2937; margin: 0;">Companies Database</h1>
            <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Manage company profiles</p>
        </div>
        
        <div style="background: white; padding: 4rem 2rem; border-radius: 16px; text-align: center; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 64px; margin-bottom: 1rem;">🏢</div>
            <h2 style="font-size: 24px; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Companies Management Coming Soon</h2>
            <p style="color: #6b7280; margin-bottom: 2rem;">This feature will allow you to create, edit, and delete company profiles.</p>
            <p style="color: #9ca3af; font-size: 14px;">Company model and functionality will be implemented in the next update.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CloseCall</title>
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
        
        .header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 168, 143, 0.15);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 24px;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 14px;
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
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
            <a href="{{ route('admin.companies') }}" class="menu-item">
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
        <!-- Header -->
        <div class="header">
            <div>
                <h1 style="font-size: 28px; font-weight: 700; color: #1f2937; margin: 0;">Admin Dashboard</h1>
                <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Welcome back, {{ auth()->user()->first_name ?? auth()->user()->name }}!</p>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span style="color: #6b7280;">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
                ✓ {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #ef4444; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
                ✗ {{ session('error') }}
            </div>
        @endif
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: #dbeafe; color: #3b82f6;">
                    👥
                </div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                    💼
                </div>
                <div class="stat-value">{{ $stats['total_jobs'] }}</div>
                <div class="stat-label">Total Jobs</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #f0fdf4; color: #00A88F;">
                    📅
                </div>
                <div class="stat-value">{{ $stats['total_events'] }}</div>
                <div class="stat-label">Total Events</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: #fce7f3; color: #ec4899;">
                    🏢
                </div>
                <div class="stat-value">{{ $stats['total_companies'] }}</div>
                <div class="stat-label">Total Companies</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div style="background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 1.5rem;">Quick Actions</h2>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                <a href="{{ route('admin.users') }}" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem; background: #f9fafb; border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#f0fdf4'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#f9fafb'; this.style.transform='translateY(0)'">
                    <span style="font-size: 32px; margin-bottom: 0.5rem;">👥</span>
                    <span style="color: #1f2937; font-weight: 600;">Manage Users</span>
                </a>
                
                <a href="{{ route('admin.jobs') }}" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem; background: #f9fafb; border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#f0fdf4'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#f9fafb'; this.style.transform='translateY(0)'">
                    <span style="font-size: 32px; margin-bottom: 0.5rem;">💼</span>
                    <span style="color: #1f2937; font-weight: 600;">Manage Jobs</span>
                </a>
                
                <a href="{{ route('admin.events') }}" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem; background: #f9fafb; border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#f0fdf4'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#f9fafb'; this.style.transform='translateY(0)'">
                    <span style="font-size: 32px; margin-bottom: 0.5rem;">📅</span>
                    <span style="color: #1f2937; font-weight: 600;">Manage Events</span>
                </a>
                
                <a href="{{ route('admin.companies') }}" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem; background: #f9fafb; border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#f0fdf4'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#f9fafb'; this.style.transform='translateY(0)'">
                    <span style="font-size: 32px; margin-bottom: 0.5rem;">🏢</span>
                    <span style="color: #1f2937; font-weight: 600;">Manage Companies</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

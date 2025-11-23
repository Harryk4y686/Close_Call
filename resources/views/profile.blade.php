<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100vh;
            overflow: hidden;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
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
            animation: slideInLeft 0.5s ease-out;
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
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
            color: inherit;
            transform: scale(1);
        }
        .sidebar-icon:hover {
            background-color: #f3f4f6;
            transform: scale(1.1);
        }
        .sidebar-icon:active {
            transform: scale(0.95);
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
            animation: slideInIndicator 0.3s ease-out;
        }
        @keyframes slideInIndicator {
            from {
                height: 0;
                opacity: 0;
            }
            to {
                height: 20px;
                opacity: 1;
            }
        }
        .content-container {
            margin-left: 100px;
            padding: 24px;
            min-height: calc(100vh - 70px);
            overflow-y: auto;
            overflow-x: hidden;
        }
        .content-layout {
            display: flex;
            gap: 60px;
            align-items: stretch;
            justify-content: center;
            max-width: 1720px;
            margin-left: auto;
            margin-right: auto;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        /* Left profile card */
        .profile-card {
            width: 520px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            height: 650px;
            position: relative;
            animation: fadeInUp 0.6s ease-out;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .profile-cover {
            height: 200px;
            background: linear-gradient(90deg, #cfe9e6, #a8d8e8);
            border-radius: 16px 16px 0 0;
            animation: fadeIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }
        .profile-cover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }
        .profile-card-body {
            padding: 20px;
            position: relative;
        }
        .profile-menu-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 10;
            animation: scaleIn 0.5s ease-out 0.3s both;
        }
        .profile-menu-icon:hover {
            background-color: #f3f4f6;
            transform: rotate(90deg) scale(1.1);
        }
        .profile-menu-icon svg {
            width: 20px;
            height: 20px;
            fill: #6b7280;
        }
        .avatar-row {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: -160px;
            margin-bottom: 16px;
        }
        .avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: #e5e7eb;
            border: 6px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            margin-bottom: 12px;
            overflow: hidden;
            animation: scaleIn 0.6s ease-out 0.4s both;
            transition: transform 0.3s ease;
        }
        .avatar:hover {
            transform: scale(1.05);
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        .avatar:hover img {
            transform: scale(1.1);
        }
        .profile-info {
            text-align: left;
            margin-bottom: 20px;
            width: 100%;
            position: relative;
        }
        .edit-profile-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 9999px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 12px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 354px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out 0.5s both;
            position: relative;
            overflow: hidden;
        }
        .edit-profile-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .edit-profile-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        .edit-profile-btn:hover {
            background: #008f7a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 168, 143, 0.4);
        }
        .edit-profile-btn:active {
            transform: translateY(0);
        }
        .profile-name {
            font-weight: 700;
            color: #111827;
            font-size: 20px;
            margin-bottom: 4px;
        }
        .profile-location {
            color: #111827;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .profile-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 20px 0;
        }
        .info-item { 
            margin-bottom: 16px;
            animation: fadeInUp 0.5s ease-out both;
        }
        .info-item:nth-child(1) { animation-delay: 0.6s; }
        .info-item:nth-child(2) { animation-delay: 0.7s; }
        .info-item:nth-child(3) { animation-delay: 0.8s; }
        .info-item:nth-child(4) { animation-delay: 0.9s; }
        .info-label { 
            color: #6b7280; 
            font-size: 12px; 
            margin-bottom: 4px;
        }
        .info-value { 
            color: #111827; 
            font-size: 14px;
        }

        /* Middle jobs section */
        .jobs-section {
            flex: 0 0 570px;
            width: 570px;
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            max-height: calc(100vh - 90px);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.2s both;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .jobs-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .jobs-title { font-weight: 800; font-size: 22px; }
        .jobs-subtitle { font-weight: 700; margin: 16px 0 8px; }
        .job-card {
            display: flex;
            gap: 14px;
            align-items: center;
            background: #f3f4f6;
            border-radius: 12px;
            padding: 12px;
            background: transparent;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out both;
            cursor: pointer;
        }
        .job-card:nth-child(2) { animation-delay: 0.3s; }
        .job-card:nth-child(3) { animation-delay: 0.4s; }
        .job-card:hover {
            background: #f9fafb;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .job-logo {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            overflow: hidden;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        .job-card:hover .job-logo {
            transform: scale(1.1) rotate(5deg);
        }
        .job-logo img { width: 100%; height: 100%; object-fit: contain; }
        .job-info { flex: 1; }
        .job-title { font-weight: 700; color: #111827; }
        .job-meta { color: #6b7280; font-size: 13px; }
        .job-status { color: #00A88F; font-size: 13px; display: inline-flex; align-items: center; gap: 6px; }
        .status-badge {
            background: #e5e7eb;
            border-radius: 12px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeInUp 0.5s ease-out both;
            transition: all 0.3s ease;
        }
        .status-badge:nth-of-type(1) { animation-delay: 0.5s; }
        .status-badge:nth-of-type(2) { animation-delay: 0.6s; }
        .status-badge:hover {
            background: #d1d5db;
            transform: translateX(3px);
        }
        .status-icon {
            width: 40px; height: 40px; border-radius: 9999px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;
        }
        .muted { color: #6b7280; }
        
        .right-sidebar {
            width: 416px;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 24px;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.3s both;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .right-sidebar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .completion-section {
            margin-bottom: 2rem;
        }
        .completion-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #374151;
            text-align: center;
        }
        .progress-circle {
            width: 174px;
            height: 174px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            position: relative;
            animation: scaleIn 0.8s ease-out 0.5s both, pulse 2s ease-in-out infinite 1.3s;
            transition: transform 0.3s ease;
        }
        .progress-circle:hover {
            transform: scale(1.05);
        }
        .progress-circle::before {
            content: '';
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            position: absolute;
        }
        .progress-text {
            position: relative;
            z-index: 1;
            font-size: 32px;
            font-weight: bold;
            color: #000000;
        }
        .completion-list {
            list-style: none;
            padding: 0;
        }
        .completion-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
            animation: fadeInUp 0.4s ease-out both;
            transition: all 0.3s ease;
        }
        .completion-item:nth-child(1) { animation-delay: 0.6s; }
        .completion-item:nth-child(2) { animation-delay: 0.7s; }
        .completion-item:nth-child(3) { animation-delay: 0.8s; }
        .completion-item:nth-child(4) { animation-delay: 0.9s; }
        .completion-item:nth-child(5) { animation-delay: 1.0s; }
        .completion-item:nth-child(6) { animation-delay: 1.1s; }
        .completion-item:hover {
            transform: translateX(5px);
            padding-left: 5px;
        }
        .completion-item:last-child {
            border-bottom: none;
        }
        .completion-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .check-icon {
            color: #10b981;
            font-weight: bold;
        }
        .x-icon {
            color: #ef4444;
            font-weight: bold;
        }
        .completion-percentage {
            font-weight: bold;
            color: #00A88F;
        }
        .settings-section {
            margin-top: 2rem;
        }
        .settings-title {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #374151;
        }
        .settings-list {
            list-style: none;
            padding: 0;
        }
        .settings-item {
            padding: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.4s ease-out both;
            position: relative;
        }
        .settings-item:nth-child(1) { animation-delay: 0.7s; }
        .settings-item:nth-child(2) { animation-delay: 0.8s; }
        .settings-item:nth-child(3) { animation-delay: 0.9s; }
        .settings-item:nth-child(4) { animation-delay: 1.0s; }
        .settings-item::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%) scaleX(0);
            width: 3px;
            height: 20px;
            background: #00A88F;
            border-radius: 0 2px 2px 0;
            transition: transform 0.3s ease;
        }
        .settings-item:hover {
            color: #00A88F;
            transform: translateX(5px);
        }
        .settings-item:hover::before {
            transform: translateY(-50%) scaleX(1);
        }
        /* Header and top bar (added only because HTML uses them and they weren't defined) */
        .main-content {
            padding: 0;
            height: 100vh;
            overflow: hidden;
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
            animation: fadeIn 0.5s ease-out;
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
            transition: all 0.3s ease;
        }
        .search-bar:focus-within {
            border-color: #00A88F;
            box-shadow: 0 0 0 3px rgba(0, 168, 143, 0.1);
            transform: scale(1.02);
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
        .search-bar input::placeholder { color: #000000; }
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
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            position: relative;
        }
        .notification-icon:hover, .avatar-icon:hover { 
            background: #e5e7eb;
            transform: scale(1.1);
        }
        .notification-icon:active, .avatar-icon:active {
            transform: scale(0.95);
        }
        .notification-icon svg, .avatar-icon svg { width: 18px; height: 18px; }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="{{ route('landing-page') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
    </div>

      <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" placeholder="Search...">
            </div>
            <a href="#" class="notification-icon">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </a>
            <a href="{{ route('profile') }}" class="avatar-icon">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </a>
        </div>
        
    <!-- Content Container -->
    <div class="content-container">
        <div class="content-layout">
            <!-- Left profile card -->
            <div class="profile-card">
                <div class="profile-cover"></div>
                <div class="profile-card-body">
                    <div class="profile-menu-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </div>
                    <div class="avatar-row">
                        <div class="avatar">
                            @if(isset($profile) && $profile->profile_picture)
                                <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" onerror="this.src='{{ asset('image/anthony.png') }}'">
                            @else
                                <img src="{{ asset('image/anthony.png') }}" alt="Profile Picture">
                            @endif
                        </div>
                        <div class="profile-info">
                            <div class="profile-name">{{ $user->first_name ?? 'User' }} {{ $user->last_name ?? '' }}</div>
                            <div class="profile-location">{{ $profile->location ?? $user->country ?? 'Not specified' }}</div>
                            <a href="{{ route('edit.profile') }}" class="edit-profile-btn">Edit Profile</a>
                        </div>
                    </div>

                    <div class="profile-divider"></div>

                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email ?? 'Not provided' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">{{ $user->phone_number ?? 'Not provided' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ isset($profile->gender) ? ucfirst($profile->gender) : 'Not specified' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $profile->location ?? 'Not provided' }}</div>
                    </div>
                </div>
            </div>

            <!-- Middle jobs section -->
            <div class="jobs-section">
                <div class="jobs-title">Jobs applied</div>

                <div class="jobs-subtitle">Pending</div>
                <div class="job-card">
                    <div class="job-logo">
                        <img src="{{ asset('image/halojasa.png') }}" alt="Company" />
                    </div>
                    <div class="job-info">
                        <div class="job-title">Social Media Manager</div>
                        <div class="job-meta">Indonesia | Best Partner Education</div>
                        <div class="job-status">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" fill="#00A88F"/></svg>
                            Actively reviewing applications
                        </div>
                    </div>
                </div>
                <div style="height:10px"></div>
                <div class="job-card">
                    <div class="job-logo">
                        <img src="{{ asset('image/JCI.png') }}" alt="Company" />
                    </div>
                    <div class="job-info">
                        <div class="job-title">Data Analyst</div>
                        <div class="job-meta">Indonesia | GRHA Digital</div>
                        <div class="job-status">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" fill="#00A88F"/></svg>
                            Actively reviewing applications
                        </div>
                    </div>
                </div>

                <div class="jobs-subtitle">Waitlisted</div>
                <div class="status-badge">
                    <div class="status-icon">☹️</div>
                    <div>
                        <div class="job-title">None yet...</div>
                        <div class="muted">Please wait for the company's response!</div>
                    </div>
                </div>

                <div class="jobs-subtitle">Accepted</div>
                <div class="status-badge">
                    <div class="status-icon">☹️</div>
                    <div>
                        <div class="job-title">None yet...</div>
                        <div class="muted">Please wait for the company's response!</div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="right-sidebar">
                <!-- Complete your Profile Section -->
                <div class="completion-section">
                    <h3 class="completion-title">Complete your Profile</h3>
                    <div class="progress-circle" style="background: conic-gradient(#00A88F 0deg {{ ($profile->completion_percentage ?? 0) * 3.6 }}deg, #e5e7eb {{ ($profile->completion_percentage ?? 0) * 3.6 }}deg 360deg);">
                        <span class="progress-text">{{ $profile->completion_percentage ?? 0 }}%</span>
                    </div>
                    <ul class="completion-list">
                        <li class="completion-item">
                            <div class="completion-status">
                                <span class="check-icon">✓</span>
                                <span>Setup account</span>
                            </div>
                            <span class="completion-percentage">10%</span>
                        </li>
                        <li class="completion-item">
                            <div class="completion-status">
                                @if(isset($profile->profile_picture) && $profile->profile_picture)
                                    <span class="check-icon">✓</span>
                                @else
                                    <span class="x-icon">X</span>
                                @endif
                                <span>Upload your Photo</span>
                            </div>
                            <span class="completion-percentage">+5%</span>
                        </li>
                        <li class="completion-item">
                            <div class="completion-status">
                                @if(isset($user->first_name) && isset($user->last_name) && isset($user->email) && isset($user->phone_number) && isset($profile->date_of_birth) && isset($profile->gender))
                                    <span class="check-icon">✓</span>
                                @else
                                    <span class="x-icon">X</span>
                                @endif
                                <span>Personal Info</span>
                            </div>
                            <span class="completion-percentage">20%</span>
                        </li>
                        <li class="completion-item">
                            <div class="completion-status">
                                @if(isset($profile->location) && isset($profile->postal_code))
                                    <span class="check-icon">✓</span>
                                @else
                                    <span class="x-icon">X</span>
                                @endif
                                <span>Location</span>
                            </div>
                            <span class="completion-percentage">20%</span>
                        </li>
                        <li class="completion-item">
                            <div class="completion-status">
                                @if(isset($profile->resume_path) && isset($profile->cv_path))
                                    <span class="check-icon">✓</span>
                                @else
                                    <span class="x-icon">X</span>
                                @endif
                                <span>Resume & CV</span>
                            </div>
                            <span class="completion-percentage">+20%</span>
                        </li>
                        <li class="completion-item">
                            <div class="completion-status">
                                @if(isset($profile->portfolio_path) && $profile->portfolio_path)
                                    <span class="check-icon">✓</span>
                                @else
                                    <span class="x-icon">X</span>
                                @endif
                                <span>Portfolio</span>
                            </div>
                            <span class="completion-percentage">+20%</span>
                        </li>
                    </ul>
                </div>

                <!-- Settings Section -->
                <div class="settings-section">
                    <h3 class="settings-title">Settings</h3>
                    <ul class="settings-list">
                        <li class="settings-item">Privacy</li>
                        <li class="settings-item">Language</li>
                        <li class="settings-item">Notifications</li>
                        <li class="settings-item">Preferences</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add stagger animation for elements on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate profile name and location
            const profileName = document.querySelector('.profile-name');
            const profileLocation = document.querySelector('.profile-location');
            
            if (profileName) {
                setTimeout(() => {
                    profileName.style.animation = 'fadeInUp 0.6s ease-out';
                }, 600);
            }
            
            if (profileLocation) {
                setTimeout(() => {
                    profileLocation.style.animation = 'fadeInUp 0.6s ease-out 0.1s both';
                }, 700);
            }

            // Add hover effect to job cards
            const jobCards = document.querySelectorAll('.job-card');
            jobCards.forEach((card, index) => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Animate progress circle on load
            const progressCircle = document.querySelector('.progress-circle');
            if (progressCircle) {
                setTimeout(() => {
                    progressCircle.style.animation = 'scaleIn 0.8s ease-out, pulse 2s ease-in-out infinite 0.8s';
                }, 500);
            }
        });

        // Handle upload button clicks
        document.querySelectorAll('.upload-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Create file input
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = '.png,.jpg,.jpeg';
                
                input.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        const fileName = e.target.files[0].name;
                        const originalText = btn.querySelector('b').textContent;
                        const cancelBtn = btn.parentElement.querySelector('.cancel-btn');
                        
                        btn.innerHTML = `
                            <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                            <b>${fileName}</b>
                        `;
                        btn.classList.add('file-selected');
                        btn.style.cursor = 'default';
                        cancelBtn.style.display = 'flex';
                        
                        // Store original content for reset
                        btn.setAttribute('data-original', originalText);
                    }
                });
                
                input.click();
            });
        });

        // Cancel file function
        function cancelFile(cancelBtn) {
            const uploadContainer = cancelBtn.closest('.upload-container');
            const uploadBtn = uploadContainer.querySelector('.upload-btn');
            const originalText = uploadBtn.getAttribute('data-original');
            
            uploadBtn.innerHTML = `
                <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                <b>${originalText}</b>
            `;
            uploadBtn.classList.remove('file-selected');
            uploadBtn.style.cursor = 'pointer';
            uploadBtn.removeAttribute('data-original');
            cancelBtn.style.display = 'none';
        }

        // Handle save button (guard if present)
        const saveBtn = document.querySelector('.save-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', function() {
                this.textContent = 'Saving...';
                this.disabled = true;
                setTimeout(() => {
                    this.textContent = 'Saved!';
                    this.style.background = '#10b981';
                    setTimeout(() => {
                        this.textContent = 'Save';
                        this.disabled = false;
                        this.style.background = '#00A88F';
                    }, 2000);
                }, 1500);
            });
        }

        // Handle sidebar navigation
        document.querySelectorAll('.sidebar-icon').forEach(icon => {
            icon.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Only prevent default if href is "#" (placeholder)
                if (href === '#') {
                    e.preventDefault();
                    console.log('Navigation placeholder - add route for:', this.getAttribute('data-page'));
                }
                
                // Update active state
                document.querySelectorAll('.sidebar-icon').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Removed old edit handlers (no corresponding elements on this page)
    </script>
</body>
</html>

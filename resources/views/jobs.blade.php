<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        /* Header styles - removed white background */
        .header {
            background: transparent;
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 70px;
            gap: 1rem;
            margin-left: 0px;
            padding-left: 129px;
        }
        .location-selector {
            display: flex;
            align-items: center;
            background: #00A88F;
            color: white;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            gap: 8px;
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
        
        /* Search Results Dropdown */
        .search-container {
            position: relative;
            width: 504px;
        }
        
        .search-results {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 168, 143, 0.15), 0 2px 8px rgba(0, 0, 0, 0.08);
            max-height: 450px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-results.show {
            display: block;
        }
        
        .search-result-item {
            padding: 18px 20px;
            border-bottom: 1px solid #f0f2f5;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }
        
        .search-result-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: linear-gradient(to right, #00A88F, transparent);
            transition: width 0.3s ease;
        }
        
        .search-result-item:hover {
            background: linear-gradient(to right, #f0fdf4 0%, #ffffff 100%);
            transform: translateX(4px);
        }
        
        .search-result-item:hover::before {
            width: 4px;
        }
        
        .search-result-item:last-child {
            border-bottom: none;
            border-radius: 0 0 16px 16px;
        }
        
        .search-result-item:first-child {
            border-radius: 16px 16px 0 0;
        }
        
        .search-result-title {
            color: #1f2937;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 6px;
            line-height: 1.4;
            transition: color 0.2s ease;
        }
        
        .search-result-item:hover .search-result-title {
            color: #00A88F;
        }
        
        .search-result-url {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #00A88F;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            padding: 4px 10px;
            background: #f0fdf4;
            border-radius: 6px;
            width: fit-content;
        }
        
        .search-result-url::before {
            content: '🔗';
            font-size: 12px;
        }
        
        .search-result-description {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .search-result-highlight {
            color: #00A88F;
            font-weight: 600;
            background: #dcfce7;
            padding: 2px 4px;
            border-radius: 4px;
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
        
        /* Main content */
        .main-content {
            margin-left: 109px;
            padding: 0;
            min-height: 100vh;
        }
        .content-wrapper {
            padding: 24px 60px;
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Jobs For You Header */
        .jobs-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
        }
        .jobs-header img {
            width: 48px;
            height: 48px;
        }
        .jobs-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
        }
        
        /* Profile Ready Notification */
        .profile-ready-notification {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-radius: 12px;
            border: 2px solid #00A88F;
            margin-bottom: 32px;
            box-shadow: 0 4px 12px rgba(0, 168, 143, 0.1);
        }
        .profile-ready-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #00A88F;
        }
        .profile-ready-text {
            margin: 0.75rem 0;
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
        }
        .profile-ready-btn {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 12px 24px;
            background: #00A88F;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        .profile-ready-btn:hover {
            background: #008B7A;
        }
        
        /* Job Categories Section - Same as landingpage.blade.php */
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 18px;
            color: #000000;
        }
        .categories-grid {
            margin-bottom: 30px;
        }
        .category-card {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 10px;
            text-align: left;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            width: 100%;
            gap: 12px;
            cursor: pointer;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .category-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .category-content {
            flex: 1;
        }
        .category-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
            color: #000;
        }
        .category-positions {
            font-size: 16px;
            color: #666;
        }
        .see-all-link {
            display: block;
            text-align: left;
            color: #00A49C;
            text-decoration: none;
            font-weight: 500;
            margin-top: -16px;
            margin-bottom: 24px;
        }
        
        /* Open Jobs Section - Similar to landingpage.blade.php */
        .jobs-list {
            max-width: 100%;
            margin-bottom: 32px;
        }
        .job-card {
            display: flex;
            width: 100%;
            align-items: center;
            background: #FFFFFF;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            gap: 20px;
            opacity: 1;
            max-height: 200px;
            overflow: hidden;
        }
        .job-card:hover {
            transform: translateY(-2px);
        }
        .job-card.hiding {
            opacity: 0;
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            transform: translateX(-100%);
        }
        .job-card.hidden {
            display: none;
        }
        .job-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f0f0f0;
            flex-shrink: 0;
        }
        .job-details {
            flex: 1;
            min-width: 0;
        }
        .job-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 5px;
            color: #000;
        }
        .job-company {
            font-size: 16px;
            color: #666;
            margin-bottom: 8px;
        }
        .job-status {
            display: flex;
            align-items: center;
            color: #00A49C;
            font-size: 16px;
            gap: 8px;
        }
        .job-apply-btn {
            width: 40px;
            height: 40px;
            background: #00A49C;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 300;
            transition: background 0.3s ease;
            flex-shrink: 0;
            margin-left: auto;
        }
        .job-apply-btn:hover {
            background: #008a7b;
        }
        
        /* Search for Jobs Section */
        .search-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .search-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1f2937;
        }
        .search-input-container {
            position: relative;
            margin-bottom: 24px;
        }
        .search-input-large {
            width: 100%;
            padding: 16px 20px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 24px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }
        .search-input-large:focus {
            border-color: #00A88F;
        }
        .search-icon-large {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #6b7280;
        }
        
        /* Suggested Tags */
        .suggested-section {
            margin-top: 24px;
        }
        .suggested-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1f2937;
        }
        .suggested-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
        }
        .tag {
            background: #00A88F;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }
        .tag:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
        .filter-link {
            color: #00A88F;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        
        /* Detailed Jobs (below Search for Jobs) */
        .detailed-jobs-section {
            margin-top: 20px;
        }
        .djob-card {
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.08);
            border: 1px solid #E5E7EB;
            padding: 16px 18px;
            margin-bottom: 47px;
        }
        .djob-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .djob-logo {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
        }
        .djob-headcol { flex: 1; min-width: 0; }
        .djob-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 6px;
        }
        .djob-title {
            font-weight: 700;
            font-size: 18px;
            color: #111827;
        }
        .djob-subinfo { font-size: 16px; color: #6b7280; }
        .djob-subinfo a { color: #2F80ED; text-decoration: none; }
        .djob-apply {
            color: #00A49C;
            font-weight: 600;
            font-size: 18px;
            text-decoration: none;
            white-space: nowrap;
        }
        .djob-actions { display: inline-flex; align-items: center; gap: 10px; }
        .djob-more {
            width: 35px;
            height: 35px;
            border-radius: 9999px;
            background: #EEF2F7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #E5E7EB;
            color: #111827;
            text-decoration: none;
        }
        .djob-meta {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 6px;
        }
        .djob-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 16px;
            color: #6b7280;
        }
        .djob-meta-item--green { color: #00A49C; }
        .djob-section-title {
            margin-top: 12px;
            font-weight: 700;
            font-size: 20px;
            color: #111827;
        }
        .djob-desc {
            margin-top: 4px;
            font-size: 16px;
            color: #4b5563;
            line-height: 1.5;
        }
        .djob-desc strong { color: #111827; }
        .djob-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        .dtag {
            background: #F3F4F6;
            color: #374151;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 16px;
            font-weight: 500;
            border: 1px solid #E5E7EB;
        }

        /* Error Message Styles */
        .error-alert {
            background-color: #FEE2E2;
            border: 1px solid #FECACA;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .error-alert .error-icon {
            color: #DC2626;
            flex-shrink: 0;
        }
        .error-alert .error-text {
            color: #DC2626;
            font-size: 14px;
            font-weight: 500;
        }

        /* Sidebar styles from profile.blade.php */
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
        
        /* Mobile Responsive for Header */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
                padding-left: 129px;
                flex-wrap: wrap;
                justify-content: center;
                height: auto;
                gap: 0.75rem;
            }
            
            .search-bar {
                width: 100%;
                max-width: 350px;
            }
            
            .location-selector {
                padding: 6px 12px;
                font-size: 12px;
                order: -1;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding-left: 120px;
            }
            
            .search-bar {
                max-width: 280px;
            }
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <a href="{{ route('landing-page') }}" class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </a>
        <a href="{{ route('profile') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon active" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AI') }}" class="sidebar-icon" data-page="AI">
            <img src="{{ asset('image/genius.png') }}" alt="AI" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="location-selector">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Indonesia
            </div>
            
            <div class="search-container">
                <div class="search-bar">
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    <input type="text" placeholder="Title, skill, or company..." id="searchInput">
                </div>
                <div class="search-results" id="searchResults">
                    <!-- Search results will be populated here -->
                </div>
            </div>

            <a href="#" class="notification-icon">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </a>
            <a href="{{ route('profile') }}" class="avatar-icon">
                @if(isset($profile) && $profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                         onerror="console.error('Failed to load profile image:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24" style="display: none;">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                @else
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                @endif
            </a>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Jobs For You Header -->
            <div class="jobs-header">
                <img src="{{ asset('image/logo.png') }}" alt="CloseCall">
                <h1 class="jobs-title">Jobs For You</h1>
            </div>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="error-alert">
                    <div class="error-icon">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zM12 7a1 1 0 011 1v4a1 1 0 01-2 0V8a1 1 0 011-1zm0 8a1 1 0 100 2 1 1 0 000-2z"/>
                        </svg>
                    </div>
                    <div class="error-text">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Profile Ready Notification -->
            <div class="profile-ready-notification">
                <p class="profile-ready-title">Your profile is ready!</p>
                <p class="profile-ready-text">Now you can start exploring job opportunities and connect with employers.</p>
                <a href="#jobs-section" class="profile-ready-btn">
                    Explore Jobs →
                </a>
            </div>

            <!-- Job Categories Section - Same as landingpage.blade.php -->
            <h2 class="section-title text-left" id="jobs-section">Job Categories</h2>
            
            <div class="categories-grid grid grid-cols-4 gap-5">
                <div class="category-card">
                    <img src="{{ asset('image/graphicdesign.png') }}" alt="Graphics & Design" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Graphics & Design</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/codeprogramming.png') }}" alt="Code & Programming" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Code & Programming</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/digitalmarketing.png') }}" alt="Digital Marketing" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Digital Marketing</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/videoanimation.png') }}" alt="Video & Animation" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Video & Animation</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/musicaudio.png') }}" alt="Music & Audio" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Music & Audio</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/accountfinance.png') }}" alt="Account & Finance" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Account & Finance</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/healthcare.png') }}" alt="Health & Care" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Health & Care</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card">
                    <img src="{{ asset('image/datascience.png') }}" alt="Data & Science" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Data & Science</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
            </div>
            
            <a href="#" class="see-all-link">See all...</a>

            <!-- Open Jobs Section -->
            <h2 class="section-title">Open Jobs</h2>
            <div class="jobs-list">
                <div class="job-card">
                    <img src="{{ asset('image/dataanalyst.png') }}" alt="Data Analyst" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Data Analyst</div>
                        <div class="job-company">Indonesia | GRHA Digital</div>
                        <div class="job-status">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn" data-job="data-analyst">×</a>
                </div>

                <div class="job-card" style="cursor: pointer;" title="Click to apply for this position">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Social Media Manager" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Social Media Manager</div>
                        <div class="job-company">Indonesia | Best Partner Education</div>
                        <div class="job-status">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn" data-job="social-media-manager" data-apply-url="{{ route('bestpartnerjob') }}">×</a>
                </div>

                <div class="job-card">
                    <img src="{{ asset('image/mechanicalengineer.png') }}" alt="Mechanical Engineer" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Mechanical Engineer</div>
                        <div class="job-company">Indonesia | R-Tech Computer</div>
                        <div class="job-status">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn" data-job="mechanical-engineer">×</a>
                </div>
            </div>
            <a href="#" class="see-all-link">See all</a>

            <!-- Search for Jobs Section -->
            <div class="search-section">
                <h2 class="search-title">Search for Jobs</h2>
                <div class="search-input-container">
                    <svg class="search-icon-large" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    <input type="text" class="search-input-large" placeholder="Search...">
                </div>

                <div class="suggested-section">
                    <h3 class="suggested-title">Suggested</h3>
                    <div class="suggested-tags">
                        <button class="tag">Remote</button>
                        <button class="tag">Design</button>
                        <button class="tag">Coding</button>
                        <button class="tag">Graphic</button>
                        <button class="tag">Actively reviewing</button>
                    </div>
                    <a href="#" class="filter-link">Filter searches...</a>
                </div>

            </div>

                <!-- Detailed Jobs (matches provided mock) -->
                <div class="detailed-jobs-section">
                    <!-- Card 1 -->
                    <div class="djob-card">
                        <div class="djob-header">
                            <img style="width: 65px; height:65px" src="{{ asset('image/socialmediamanager.png') }}" class="djob-logo" alt="Logo">
                            <div class="djob-headcol">
                                <div class="djob-title-row">
                                    <div class="djob-title">Social Media Manager</div>
                                    <div class="djob-actions">
                                        <a href="{{ route('bestpartnerjob') }}" class="djob-apply">+ Apply</a>
                                        <a href="#" class="djob-more" aria-label="More options">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#111827"><circle cx="12" cy="9" r="2"/><circle cx="12" cy="15" r="2"/></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="djob-subinfo">Indonesia | Best Partner Education</div>
                                <div class="djob-meta">
                                    <span class="djob-meta-item djob-meta-item--green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        Actively reviewing applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="djob-section-title">Job Description</div>
                        <div class="djob-desc">
                            <strong>Vector Illustrator (Badge Art Concept – Gamification Project)</strong><br>
                            We are seeking a vector illustrator to help us in the exploration of a visual direction for badge art within a larger gamification platform. This is a short-term opportunity to showcase your illustration style through concept work.
                        </div>
                        <div class="djob-desc">
                            <strong>Project Overview</strong><br>
                            You will be exploring badge art concepts that align with our platform’s tone and user experience. This is a short exploratory engagement to review your approach and see how it could evolve across a full slate of achievements. If your work aligns with our vision, there is potential for a longer-term engagement to illustrate the full badge set and other visual assets across the platform.
                        </div>
                        <div class="djob-tags">
                            <span class="dtag">#remote</span>
                            <span class="dtag">#design</span>
                            <span class="dtag">#socialmedia</span>
                            <span class="dtag">#activelyreviewing</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="djob-card">
                        <div class="djob-header">
                            <img style="width: 65px; height:65px" src="{{ asset('image/soechi.png') }}" class="djob-logo" alt="Logo">
                            <div class="djob-headcol">
                                <div class="djob-title-row">
                                    <div class="djob-title">Graphic Designer</div>
                                    <div class="djob-actions">
                                        <a href="#" class="djob-apply">+ Apply</a>
                                        <a href="#" class="djob-more" aria-label="More options">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#111827"><circle cx="12" cy="9" r="2"/><circle cx="12" cy="15" r="2"/></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="djob-subinfo">Indonesia | SOECHI Group</div>
                                <div class="djob-meta">
                                    <span class="djob-meta-item djob-meta-item--green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        Actively reviewing applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="djob-section-title">Job Description</div>
                        <div class="djob-desc">
                            We are seeking a graphic designer to help us explore creative directions for visual identity and brand assets within a larger branding initiative. This is a short-term opportunity to showcase your unique approach through concept work.
                        </div>
                        <div class="djob-desc">
                            <strong>Project Overview</strong><br>
                            You will be exploring and iterating graphic design concepts that align with our brand’s values, tone, and user experience. This is a short exploratory engagement to review your approach and see how it could evolve during the final build of branding materials and other visual assets across campaigns.
                        </div>
                        <div class="djob-tags">
                            <span class="dtag">#remote</span>
                            <span class="dtag">#design</span>
                            <span class="dtag">#graphicdesign</span>
                            <span class="dtag">#activelyreviewing</span>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="djob-card">
                        <div class="djob-header">
                            <img style="width: 65px; height:65px" src="{{ asset('image/halojasa.png') }}" class="djob-logo" alt="Logo">
                            <div class="djob-headcol">
                                <div class="djob-title-row">
                                    <div class="djob-title">Design Illustrator</div>
                                    <div class="djob-actions">
                                        <a href="#" class="djob-apply">+ Apply</a>
                                        <a href="#" class="djob-more" aria-label="More options">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#111827"><circle cx="12" cy="9" r="2"/><circle cx="12" cy="15" r="2"/></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="djob-subinfo">Indonesia | HaloJasa Indonesia</div>
                                <div class="djob-meta">
                                    <span class="djob-meta-item djob-meta-item--green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        Actively reviewing applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="djob-section-title">Job Description</div>
                        <div class="djob-desc">
                            <strong>Do you enjoy working at home or studio?</strong><br>
                            We offer flexible working hours; most weeks do not require you to come to the office. In fact you can work better from home and manage your own schedule. We’re looking for an effective person for you to be Design Illustrator. Of course because of this work you can work on image design through the internet.
                        </div>
                        <div class="djob-desc">
                            The most important thing from our company are your product works of art with great ideas and full of motivation. Your product images and illustrations will be used for many of our product works. That is, the only one more appreciated from what you have are the Design Illustrator team.
                        </div>
                        <div class="djob-tags">
                            <span class="dtag">#remote</span>
                            <span class="dtag">#design</span>
                            <span class="dtag">#graphicdesign</span>
                            <span class="dtag">#activelyreviewing</span>
                        </div>
                    </div>
                </div>
                <!-- End Detailed Jobs -->
        </div>
    </div>

    <script>
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

        // Handle profile ready button (only if it exists)
        const profileBtn = document.querySelector('.profile-ready-btn');
        if (profileBtn) {
            profileBtn.addEventListener('click', function(e) {
                // Allow default behavior for anchor links (like #jobs-section)
                // Only prevent default if we need custom navigation
            });
        }

        // Handle suggested tags
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function() {
                const searchInput = document.querySelector('.search-input-large');
                searchInput.value = this.textContent;
                searchInput.focus();
            });
        });

        // Handle job apply buttons (X button to hide jobs)
        document.querySelectorAll('.job-apply-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // Always prevent default for X button
                
                const jobCard = this.closest('.job-card');
                
                // All X buttons now hide the job card
                hideJobCard(jobCard);
            });
        });

        // Function to hide job card with smooth animation
        function hideJobCard(jobCard) {
            if (!jobCard) return;
            
            // Add hiding class for animation
            jobCard.classList.add('hiding');
            
            // After animation completes, fully hide the element
            setTimeout(() => {
                jobCard.classList.add('hidden');
                jobCard.classList.remove('hiding');
                
                // Optional: Log for debugging
                const jobTitle = jobCard.querySelector('.job-title')?.textContent || 'Unknown Job';
                console.log('Hidden job:', jobTitle);
                
                // Check if all jobs are hidden
                checkIfAllJobsHidden();
            }, 300); // Match the CSS transition duration
        }

        // Function to check if all jobs are hidden and show a message
        function checkIfAllJobsHidden() {
            const jobsList = document.querySelector('.jobs-list');
            const visibleJobs = jobsList.querySelectorAll('.job-card:not(.hidden)');
            
            if (visibleJobs.length === 0) {
                // All jobs are hidden, show a message
                if (!jobsList.querySelector('.no-jobs-message')) {
                    const noJobsMessage = document.createElement('div');
                    noJobsMessage.className = 'no-jobs-message';
                    noJobsMessage.style.cssText = `
                        text-align: center;
                        padding: 40px 20px;
                        color: #6b7280;
                        font-style: italic;
                    `;
                    noJobsMessage.innerHTML = 'No more jobs to display. <a href="#" onclick="showAllJobs()" style="color: #00A88F; text-decoration: underline;">Show all jobs again</a>';
                    jobsList.appendChild(noJobsMessage);
                }
            }
        }

        // Function to show all jobs again
        window.showAllJobs = function() {
            const jobCards = document.querySelectorAll('.job-card.hidden');
            const noJobsMessage = document.querySelector('.no-jobs-message');
            
            jobCards.forEach(card => {
                card.classList.remove('hidden');
            });
            
            if (noJobsMessage) {
                noJobsMessage.remove();
            }
        };

        // Handle category cards click
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function() {
                const categoryName = this.querySelector('.category-name').textContent;
                const searchInput = document.querySelector('.search-input-large');
                searchInput.value = categoryName;
                searchInput.focus();
                // Scroll to search section
                document.querySelector('.search-section').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            });
        });

        // Handle job card clicks (for more details or application)
        document.querySelectorAll('.job-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking the apply button (X button)
                if (!e.target.closest('.job-apply-btn')) {
                    const jobTitle = this.querySelector('.job-title').textContent;
                    const applyBtn = this.querySelector('.job-apply-btn');
                    const applyUrl = applyBtn ? applyBtn.getAttribute('data-apply-url') : null;
                    
                    if (applyUrl) {
                        // If job has an application URL, navigate to it
                        console.log('Navigate to application page for:', jobTitle);
                        window.location.href = applyUrl;
                    } else {
                        // For jobs without application URL, show job details
                        console.log('Navigate to job details:', jobTitle);
                        // TODO: Navigate to job details page
                        // Example: window.location.href = `/job/${jobSlug}`;
                    }
                }
            });
        });

        // Function to update progress on jobs page
        function updateJobsProgress() {
            fetch('{{ route("profile.completion") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.completion_percentage !== undefined) {
                        const progressFill = document.getElementById('jobs-progress-fill');
                        const progressText = document.getElementById('jobs-progress-text');
                        
                        if (progressFill && progressText) {
                            progressFill.style.width = data.completion_percentage + '%';
                            progressText.textContent = data.completion_percentage + '%';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error updating progress:', error);
                });
        }

        // Update progress when page loads and animate
        window.addEventListener('load', function() {
            updateJobsProgress();
        });

        // Update progress when user returns to the page (from profile page)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                updateJobsProgress();
            }
        });

        // Update progress when page gains focus
        window.addEventListener('focus', function() {
            updateJobsProgress();
        });

        // SEO Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        
        if (searchInput && searchResults) {
            // Search data - SEO-style results for "bestpartner"
            const searchData = {
                'bestpartner': [
                    {
                        title: 'Best Partner Education - About Us | CloseCall',
                        url: 'closecall.com/aboutbestpartner',
                        description: 'Learn more about <span class="search-result-highlight">Best Partner</span> Education, a leading educational institution providing quality education and career opportunities. Discover our mission, vision, and values.',
                        route: '/aboutbestpartner'
                    },
                    {
                        title: 'Best Partner Jobs - Career Opportunities | CloseCall',
                        url: 'closecall.com/bestpartnerjob',
                        description: 'Explore exciting career opportunities at <span class="search-result-highlight">Best Partner</span> Education. Find your dream job with competitive salaries and excellent benefits.',
                        route: '/bestpartnerjob'
                    },
                    {
                        title: 'Best Partner Company Profile | CloseCall',
                        url: 'closecall.com/bestpartner',
                        description: 'View the complete company profile of <span class="search-result-highlight">Best Partner</span> Education including company information, culture, and available positions.',
                        route: '/bestpartner'
                    }
                ]
            };
            
            // Search functionality
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                
                if (query === '') {
                    hideSearchResults();
                    return;
                }
                
                // Check if query matches any search terms
                const results = [];
                for (const [key, items] of Object.entries(searchData)) {
                    // Show results for any query containing "best" or "partner"
                    if (query.includes('best') || query.includes('partner') || 
                        query.includes('bestpartner') || key.includes(query)) {
                        results.push(...items);
                        break; // Only add once
                    }
                }
                
                if (results.length > 0) {
                    showSearchResults(results, query);
                } else {
                    hideSearchResults();
                }
            });
            
            // Show search results
            function showSearchResults(results, query) {
                let html = '';
                results.forEach(result => {
                    // Highlight search term in title and description
                    const highlightedTitle = result.title.replace(new RegExp(query, 'gi'), '<span class="search-result-highlight">$&</span>');
                    const highlightedDescription = result.description; // Already has highlighting
                    
                    html += `
                        <div class="search-result-item" onclick="navigateToResult('${result.route}')">
                            <div class="search-result-title">${highlightedTitle}</div>
                            <div class="search-result-url">${result.url}</div>
                            <div class="search-result-description">${highlightedDescription}</div>
                        </div>
                    `;
                });
                
                searchResults.innerHTML = html;
                searchResults.classList.add('show');
            }
            
            // Hide search results
            function hideSearchResults() {
                searchResults.classList.remove('show');
                searchResults.innerHTML = '';
            }
            
            // Navigate to result
            window.navigateToResult = function(route) {
                window.location.href = route;
            };
            
            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-container')) {
                    hideSearchResults();
                }
            });
            
            // Prevent hiding when clicking inside search container
            document.querySelector('.search-container').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    </script>
</body>
</html>
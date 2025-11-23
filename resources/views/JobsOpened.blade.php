<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs - CloseCall</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        
        /* Header styles from profile.blade.php */
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
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            padding: 24px;
            max-width: 100%;
            margin: 0;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            height: calc(100vh - 70px);
        }
        
        /* Jobs Opened Section */
        .jobs-opened-section {
            width: 100%;
            padding-bottom: 40px;
        }
        .jobs-opened-title {
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 24px;
            text-align: left;
            opacity: 0;
            animation: fadeIn 0.4s ease-out 0.1s forwards;
        }
        .jobs-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            opacity: 0;
            animation: fadeIn 0.4s ease-out 0.2s forwards;
        }
        .job-posting-card {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 0;
            padding: 16px 20px;
            margin-bottom: 0;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            gap: 20px;
            opacity: 0;
            animation: fadeInUp 0.45s ease-out forwards;
        }
        .job-posting-card:first-child {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .job-posting-card:last-child {
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
            border-bottom: none;
        }
        .job-posting-card:hover {
            background: #f9fafb;
        }
        .job-logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            flex-shrink: 0;
            width: 70px;
        }
        .job-logo-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .job-logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .job-details-container {
            flex: 1;
            min-width: 0;
        }
        .job-posting-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        .job-posting-meta {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 6px;
        }
        .job-posting-status {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #00A88F;
            font-size: 13px;
            font-weight: 400;
        }
        .job-posting-status svg {
            width: 14px;
            height: 14px;
        }
        .job-apply-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #00A88F;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 300;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
            text-decoration: none;
            border: none;
        }
        .job-apply-button:hover {
            background: #008f7a;
            transform: scale(1.1);
        }
        /* Content animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        /* Stagger job cards within the container */
        .jobs-container .job-posting-card:nth-child(1) { animation-delay: 0.25s; }
        .jobs-container .job-posting-card:nth-child(2) { animation-delay: 0.30s; }
        .jobs-container .job-posting-card:nth-child(3) { animation-delay: 0.35s; }
        .jobs-container .job-posting-card:nth-child(4) { animation-delay: 0.40s; }
        .jobs-container .job-posting-card:nth-child(5) { animation-delay: 0.45s; }
        .jobs-container .job-posting-card:nth-child(6) { animation-delay: 0.50s; }
        .jobs-container .job-posting-card:nth-child(7) { animation-delay: 0.55s; }
        .jobs-container .job-posting-card:nth-child(8) { animation-delay: 0.60s; }
        .jobs-container .job-posting-card:nth-child(9) { animation-delay: 0.65s; }
        .jobs-container .job-posting-card:nth-child(10) { animation-delay: 0.70s; }
        .jobs-container .job-posting-card:nth-child(11) { animation-delay: 0.75s; }
        .jobs-container .job-posting-card:nth-child(12) { animation-delay: 0.80s; }
        .jobs-container .job-posting-card:nth-child(13) { animation-delay: 0.85s; }
        .jobs-container .job-posting-card:nth-child(14) { animation-delay: 0.90s; }
        .jobs-container .job-posting-card:nth-child(15) { animation-delay: 0.95s; }
        .jobs-container .job-posting-card:nth-child(16) { animation-delay: 1.00s; }
        .jobs-container .job-posting-card:nth-child(17) { animation-delay: 1.05s; }
        .jobs-container .job-posting-card:nth-child(18) { animation-delay: 1.10s; }
        .jobs-container .job-posting-card:nth-child(19) { animation-delay: 1.15s; }
        .jobs-container .job-posting-card:nth-child(20) { animation-delay: 1.20s; }
        .jobs-container .job-posting-card:nth-child(21) { animation-delay: 1.25s; }
        .jobs-container .job-posting-card:nth-child(22) { animation-delay: 1.30s; }
        .jobs-container .job-posting-card:nth-child(23) { animation-delay: 1.35s; }
        .jobs-container .job-posting-card:nth-child(24) { animation-delay: 1.40s; }
        .jobs-container .job-posting-card:nth-child(25) { animation-delay: 1.45s; }
        .jobs-container .job-posting-card:nth-child(26) { animation-delay: 1.50s; }
        .jobs-container .job-posting-card:nth-child(27) { animation-delay: 1.55s; }
        .jobs-container .job-posting-card:nth-child(28) { animation-delay: 1.60s; }
        .jobs-container .job-posting-card:nth-child(29) { animation-delay: 1.65s; }
        .jobs-container .job-posting-card:nth-child(30) { animation-delay: 1.70s; }
        .jobs-container .job-posting-card:nth-child(31) { animation-delay: 1.75s; }
        .jobs-container .job-posting-card:nth-child(32) { animation-delay: 1.80s; }
        .jobs-container .job-posting-card:nth-child(33) { animation-delay: 1.85s; }
        .jobs-container .job-posting-card:nth-child(34) { animation-delay: 1.90s; }
        .jobs-container .job-posting-card:nth-child(35) { animation-delay: 1.95s; }
        .jobs-container .job-posting-card:nth-child(36) { animation-delay: 2.00s; }
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
        
        /* Complete Profile Section */
        .complete-profile {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .complete-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1f2937;
        }
        .complete-text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .progress-container {
            margin-bottom: 16px;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 16px;
        }
        .progress-fill {
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, #00A88F, #38b2ac);
            transition: width 0.3s ease;
        }
        .complete-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 24px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .complete-btn:hover {
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
            transition: transform 0.3s ease;
            gap: 20px;
        }
        .job-card:hover {
            transform: translateY(-2px);
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
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="{{ route('profile') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon active" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
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
            
            <div class="search-bar">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" placeholder="Title, skill, or company...">
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
        
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Jobs Opened Section -->
            <div class="jobs-opened-section">
                <h2 class="jobs-opened-title">Open Jobs</h2>
                <div class="jobs-container">
                    
 @foreach($jobs as $job)
<div class="job-posting-card">
    <div class="job-logo-container">
        <div class="job-logo-circle">
            @if($job->profile_picture)
                <img src="{{ asset('storage/' . $job->profile_picture) }}" alt="{{ $job->company_name }}">
            @else
                <img src="{{ asset('image/socialmediamanager.png') }}" alt="{{ $job->company_name }}">
            @endif
        </div>
    </div>
    <div class="job-details-container">
        <div class="job-posting-title">{{ $job->job_title }}</div>
        <div class="job-posting-meta">{{ $job->location }} | {{ $job->company_name }}</div>
        <div class="job-posting-status">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" fill="#00A88F"/>
            </svg>
            Actively reviewing applications
        </div>
    </div>
    <button class="job-apply-button">+</button>
</div>
@endforeach

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

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
    </script>
</body>
</html>
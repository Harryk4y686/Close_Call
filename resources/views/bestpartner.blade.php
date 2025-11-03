<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Partner Jobs - CloseCall</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Keyframe Animations */
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
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0, -8px, 0);
            }
            70% {
                transform: translate3d(0, -4px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }
        
        /* Animation Classes */
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-fadeInLeft {
            animation: fadeInLeft 0.8s ease-out forwards;
        }
        
        .animate-fadeInRight {
            animation: fadeInRight 0.8s ease-out forwards;
        }
        
        .animate-scaleIn {
            animation: scaleIn 0.6s ease-out forwards;
        }
        
        .animate-slideInFromTop {
            animation: slideInFromTop 0.8s ease-out forwards;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-bounce {
            animation: bounce 1s infinite;
        }
        
        /* Staggered Animation Delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; }
        .delay-800 { animation-delay: 0.8s; }
        
        /* Header styles from jobs.blade.php */
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
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .header:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .location-selector:hover {
            background: #008B7A;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 168, 143, 0.3);
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
            position: relative;
            overflow: hidden;
        }
        
        .search-bar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #00A88F;
        }
        
        .search-bar:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 168, 143, 0.2);
            border-color: #00A88F;
        }
        
        .search-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .search-bar:hover::before {
            left: 100%;
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
        }
        
        /* Content wrapper */
        .content-wrapper {
            padding: 24px 60px;
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Job Detail Styles */
        .job-header {
            background: linear-gradient(135deg, #a8d5ba 0%, #7eb3d3 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 50px;
            position: relative;
            min-height: 200px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .job-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        
        .job-header:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .job-company-info {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
            position: relative;
            z-index: 1;
        }
        
        .company-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .header-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
            align-self: flex-end;
            margin-bottom: 8px;
        }
        
        .company-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            padding-top: 0px;
        }
        
        .company-logo {
            width: 172px;
            height: 172px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            object-fit: cover;
            margin-top: -140px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .company-logo:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .company-details h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: #333;
        }
        
        .company-location {
            color: #666;
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .company-status {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #00A88F;
            font-size: 16px;
            font-weight: 500;
        }
        
        .apply-btn {
            background: #00A88F;
            color: white;
            padding: 12px 32px;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 200px;
            position: relative;
            overflow: hidden;
        }
        
        .apply-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .apply-btn:hover {
            background: #008B7A;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 168, 143, 0.3);
        }
        
        .apply-btn:hover::before {
            left: 100%;
        }
        
        .apply-btn:active {
            transform: translateY(0);
        }
        
        .options-btn {
            background: transparent;
            border: none;
            color: #666;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 18px;
            font-weight: bold;
        }
        
        .options-btn:hover {
            background: #f3f4f6;
        }
        
        /* Options Dropdown Menu */
        .options-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            z-index: 1000;
            display: none;
            overflow: hidden;
        }
        
        .options-dropdown.show {
            display: block;
        }
        
        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background-color: #f9fafb;
        }
        
        .dropdown-item.danger {
            color: #dc2626;
        }
        
        .dropdown-item.danger:hover {
            background-color: #fef2f2;
        }
        
        .header-buttons {
            position: relative;
        }
        
        .job-title {
            font-size: 32px;
            font-weight: 700;
            margin: 24px 0 16px 0;
            color: #333;
        }
        
        .job-tags {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        
        .tag {
            background: #f3f4f6;
            color: #555;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .tag::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.1), transparent);
            transition: left 0.3s;
        }
        
        .tag:hover {
            background: #00A88F;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 168, 143, 0.3);
        }
        
        .tag:hover::before {
            left: 100%;
        }
        
        .job-content {
            line-height: 1.6;
            color: #333;
        }
        
        .job-content h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 6px 0 6px 0;
            color: #333;
        }
        
        .job-content p {
            margin-bottom: 6px;
            color: #555;
        }
        
        .job-content ul {
            margin: 6px 0;
            padding-left: 20px;
            list-style-type: disc;
        }
        
        .job-content li {
            color: #555;
            margin-bottom: 4px;
            list-style-position: outside;
        }
        
        .job-content li::marker {
            color: #333;
            font-size: 14px;
        }
        
        .about-company {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin: 32px 0;
        }
        
        .about-company-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 16px 0;
            color: #333;
        }
        
        .about-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .about-header h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: #333;
        }
        
        .company-stats {
            font-size: 13px;
            color: #666;
            margin-bottom: 16px;
        }
        
        .company-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        
        .description-footer {
            display: flex;
            justify-content: flex-end;
        }
        
        .show-more {
            color: #00A88F;
            font-weight: 500;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        
        .show-more:hover {
            text-decoration: underline;
        }
        
        .related-jobs {
            margin-top: 32px;
        }
        
        .related-jobs h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        
        .related-job-card {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .related-job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.05), transparent);
            transition: left 0.5s;
        }
        
        .related-job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .related-job-card:hover::before {
            left: 100%;
        }
        
        .related-job-logo {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin-right: 16px;
            object-fit: cover;
        }
        
        .related-job-info {
            flex: 1;
        }
        
        .related-job-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
            color: #333;
        }
        
        .related-job-company {
            color: #666;
            font-size: 14px;
            margin-bottom: 6px;
        }
        
        .related-job-status {
            color: #00A88F;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .apply-icon {
            width: 36px;
            height: 36px;
            background: #00A88F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .apply-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        
        .apply-icon:hover {
            background: #008B7A;
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 168, 143, 0.4);
        }
        
        .apply-icon:hover::before {
            width: 100%;
            height: 100%;
        }
        
        .see-all-link {
            color: #00A88F;
            font-weight: 500;
            cursor: pointer;
            margin-top: 16px;
            display: inline-block;
        }
        
        /* Sidebar styles from jobs.blade.php */
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
        
        /* Mobile Responsive for Job Content */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 16px 20px;
            }
            
            .job-header {
                min-height: 160px;
            }
            
            .job-company-info {
                margin-top: -40px;
            }
            
            .company-header {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
            
            .company-left {
                align-items: center;
                padding-top: 0px;
            }
            
            .company-logo {
                width: 100px;
                height: 100px;
                margin-top: -50px;
                margin-bottom: 8px;
            }
            
            .job-title {
                font-size: 24px;
                text-align: center;
            }
            
            .job-tags {
                justify-content: center;
            }
            
            .related-job-card {
                padding: 12px;
            }
            
            .apply-btn {
                width: auto;
                padding: 10px 24px;
                font-size: 14px;
            }
            
            .header-buttons {
                margin-top: 12px;
            }
            
            .options-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .job-title {
                font-size: 20px;
            }
            
            .company-logo {
                width: 90px;
                height: 90px;
                margin-top: -40px;
            }
            
            .job-tags {
                gap: 8px;
            }
            
            .tag {
                font-size: 12px;
                padding: 4px 12px;
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
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
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
        <div class="header animate-slideInFromTop">
            <div class="location-selector animate-fadeInLeft delay-200">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Indonesia
            </div>
            
            <div class="search-bar animate-fadeInUp delay-300">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" placeholder="Title, skill, or company...">
            </div>

            <a href="#" class="notification-icon animate-fadeInRight delay-400">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </a>
            <a href="{{ route('profile') }}" class="avatar-icon animate-fadeInRight delay-500">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </a>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Job Header with Background -->
            <div class="job-header animate-fadeInUp delay-100"></div>
            
            <!-- Job Company Info -->
            <div class="job-company-info animate-scaleIn delay-200">
                <div class="company-header">
                    <div class="company-left">
                        <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="company-logo animate-float">
                        <div class="company-details animate-fadeInLeft delay-300">
                            <h3 style="font-size: 24px">Best Partner Education</h3>
                            <div class="company-location">Indonesia | Best Partner Education</div>
                            <div class="company-status">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                                Actively reviewing applications
                            </div>
                        </div>
                    </div>
                    <div class="header-buttons animate-fadeInRight delay-400">
                        <button class="apply-btn">Apply</button>
                        <button class="options-btn" id="optionsBtn">⋮</button>
                        <div class="options-dropdown" id="optionsDropdown">
                            <div class="dropdown-item" data-action="save">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                                </svg>
                                Save Job
                            </div>
                            <div class="dropdown-item" data-action="share">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92-1.31-2.92-2.92-2.92z"/>
                                </svg>
                                Share
                            </div>
                            <div class="dropdown-item" data-action="copy">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                </svg>
                                Copy Link
                            </div>
                            <div class="dropdown-item danger" data-action="report">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                                </svg>
                                Report Job
                            </div>
                        </div>
                    </div>
                </div>
                
                <h1 class="job-title animate-fadeInUp delay-500">Social Media Manager</h1>
                
                <div class="job-tags animate-fadeInUp delay-600">
                    <span class="tag">#remote</span>
                    <span class="tag">#design</span>
                    <span class="tag">#socialmedia</span>
                    <span class="tag">#activelyreviewing</span>
                </div>
                
                <div class="job-content animate-fadeInUp delay-700">
                    <h4>Job Description</h4>
                    
                    <p><strong>Vector Illustrator (Badge Art Concept - Gamification Project)</strong></p>
                    <p>We are seeking a vector illustrator to help us in the exploration of visual direction for badge art within a larger gamification platform. This is a short-term opportunity to showcase your illustration style through concept work.</p>
                    
                    <h4>Project Overview</h4>
                    <p>You will be creating badge art concepts that align with our platform's tone and user experience. This is a short exploratory engagement to review your approach and see how it could evolve across a full suite of achievements. If your work aligns with our vision, there is potential for a longer-term engagement to illustrate the full badge set and other visual assets across the platform.</p>
                    
                    <h4>What You'll Do</h4>
                    <ul>
                        <li>Develop 3 initial badge art concepts that represent a range of visual directions (style, tone, form).</li>
                        <li>Propose a cohesive illustration style for a digital dashboard experience.</li>
                    </ul>
                    
                    <h4>Requirements</h4>
                    <ul>
                        <li>Strong portfolio demonstrating scalable digital illustration skills, especially character, icon, or badge-style artwork.</li>
                        <li>Ability to work within brand parameters while proposing fresh visual ideas.</li>
                        <li>Experience with gamification, dashboard/UI design, or achievement systems is a plus.</li>
                        <li>Final art should be delivered in a vector format (.svg, .eps, etc)</li>
                    </ul>
                    
                    <p>This is a paid trial project with the opportunity for continued work based on fit and final direction chosen.</p>
                </div>
            </div>
            
            <!-- About the Company -->
            <div class="about-company animate-fadeInUp delay-800">
                <h3 class="about-company-title">About the Company</h3>
                
                <div class="about-header">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="company-logo" style="width: 65px; height: 65px; margin-top: 0.5px">
                    <div>
                        <h4>Best Partner Education</h4>
                        <div class="company-stats">37,000 followers<br>Education, International Studies | 50-100 employees | 349 on CloseCall</div>
                    </div>
                </div>
                
                <div class="company-description">
                    Best Partner is revolutionizing hiring with the world's first and only end-to-end AI recruiting platform. Trained with human insights and proprietary data, this reduces time to hire from months to days, instantly matching you with pre-vetted qualified candidates, and conducting the first round phone screen for you. Trusted by hundreds of Fortune 1000 enterprises including Nestlé, Porsche, Atlassian, Goldman Sachs, and Nike, Braintrust AIR is making talent acquisition professionals 10x more effective and saving companies hundreds of thousands of dollars in recruiting costs.
                </div>
                
                <div class="description-footer">
                    <a href="#" class="show-more">Show more...</a>
                </div>
            </div>
            
            <!-- Related Jobs -->
            <div class="related-jobs animate-fadeInUp delay-800">
                <h3>Related Jobs</h3>
                
                <div class="related-job-card animate-fadeInLeft delay-900">
                    <img src="{{ asset('image/dataanalyst.png') }}" alt="Data Analyst" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Data Analyst</div>
                        <div class="related-job-company">Indonesia | GRHA Digital</div>
                        <div class="related-job-status">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="related-job-card animate-fadeInUp delay-1000">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Social Media Manager" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Social Media Manager</div>
                        <div class="related-job-company">Indonesia | Best Partner Education</div>
                        <div class="related-job-status">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="related-job-card animate-fadeInRight delay-1100">
                    <img src="{{ asset('image/mechanicalengineer.png') }}" alt="Mechanical Engineer" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Mechanical Engineer</div>
                        <div class="related-job-company">Indonesia | R-Tech Computer</div>
                        <div class="related-job-status">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="see-all-link animate-fadeInUp delay-1200">See all</div>
            </div>
        </div>
    </div>

    <script>
        // Handle sidebar navigation - copied from jobs.blade.php
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

        // Handle Apply button - redirect to bestpartnerjob
        document.querySelector('.apply-btn').addEventListener('click', function() {
            window.location.href = '{{ route("bestpartnerjob") }}';
        });

        // Handle Options button dropdown
        const optionsBtn = document.getElementById('optionsBtn');
        const optionsDropdown = document.getElementById('optionsDropdown');
        
        if (optionsBtn && optionsDropdown) {
            optionsBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                optionsDropdown.classList.toggle('show');
            });
            
            // Handle dropdown item clicks
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const action = this.getAttribute('data-action');
                    
                    switch(action) {
                        case 'save':
                            alert('Job saved successfully!');
                            break;
                        case 'share':
                            if (navigator.share) {
                                navigator.share({
                                    title: 'Social Media Manager - Best Partner Education',
                                    text: 'Check out this job opportunity at Best Partner Education',
                                    url: window.location.href
                                });
                            } else {
                                alert('Share functionality not supported on this browser');
                            }
                            break;
                        case 'copy':
                            navigator.clipboard.writeText(window.location.href).then(() => {
                                alert('Link copied to clipboard!');
                            });
                            break;
                        case 'report':
                            alert('Report submitted. Thank you for your feedback.');
                            break;
                    }
                    
                    optionsDropdown.classList.remove('show');
                });
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                optionsDropdown.classList.remove('show');
            });
        }

        // Handle Show More link - Navigate to bestpartnerjob page
        document.querySelector('.show-more').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Navigate to the bestpartnerjob page
            window.location.href = "{{ route('bestpartnerjob') }}";
        });

        // Handle Related Job Apply Icons - redirect to bestpartnerjob
        document.querySelectorAll('.apply-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                window.location.href = '{{ route("bestpartnerjob") }}';
            });
        });

        // Handle Related Job Cards Click - redirect to bestpartnerjob
        document.querySelectorAll('.related-job-card').forEach(card => {
            card.addEventListener('click', function(e) {
                window.location.href = '{{ route("bestpartnerjob") }}';
            });
        });

        // Handle Tag clicks - redirect to bestpartnerjob
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function() {
                window.location.href = '{{ route("bestpartnerjob") }}';
            });
        });

        // Smooth scroll for page load
        window.addEventListener('load', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for scroll animations
        document.querySelectorAll('.animate-fadeInUp, .animate-fadeInLeft, .animate-fadeInRight, .animate-scaleIn').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            observer.observe(el);
        });

        // Add parallax effect to job header
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const jobHeader = document.querySelector('.job-header');
            if (jobHeader) {
                jobHeader.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add typing effect to job title
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect after page load
        setTimeout(() => {
            const jobTitle = document.querySelector('.job-title');
            if (jobTitle) {
                const originalText = jobTitle.textContent;
                typeWriter(jobTitle, originalText, 50);
            }
        }, 1000);

        // Add ripple effect to buttons
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        // Add ripple effect to all buttons
        document.querySelectorAll('.apply-btn, .tag, .apply-icon').forEach(button => {
            button.addEventListener('click', createRipple);
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

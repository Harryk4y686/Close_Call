<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Categories - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%;
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
            /* Remove sidebar animation */
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
            /* Remove transitions to avoid animation */
            position: relative;
            text-decoration: none;
            color: inherit;
            /* No transform scaling */
        }
        .sidebar-icon:hover {
            background-color: #f3f4f6;
            /* No hover scale */
        }
        .sidebar-icon:active {
            /* No active scale */
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
            /* No indicator animation */
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
        .main-content {
            padding: 0;
            height: 100vh;
            overflow: visible;
            display: flex;
            flex-direction: column;
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
        
        .content-container {
            margin-left: 100px;
            padding: 24px;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            height: calc(100vh - 70px);
        }
        
        /* Job Categories Section */
        .categories-section {
            margin-top: 0;
            padding: 0;
            padding-bottom: 40px;
            width: 100%;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }
        .categories-title {
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 30px;
            margin-left: 0;
            margin-right: 0;
            padding-left: 0;
            padding-right: 0;
            text-align: left;
        }
        .categories-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            width: 100%;
            margin-left: 0;
            padding-left: 0;
        }
        .category-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            animation: fadeInUp 0.5s ease-out both;
            text-decoration: none;
            color: inherit;
        }
        .category-card:nth-child(1) { animation-delay: 0.5s; }
        .category-card:nth-child(2) { animation-delay: 0.6s; }
        .category-card:nth-child(3) { animation-delay: 0.7s; }
        .category-card:nth-child(4) { animation-delay: 0.8s; }
        .category-card:nth-child(5) { animation-delay: 0.9s; }
        .category-card:nth-child(6) { animation-delay: 1.0s; }
        .category-card:nth-child(7) { animation-delay: 1.1s; }
        .category-card:nth-child(8) { animation-delay: 1.2s; }
        .category-card:nth-child(9) { animation-delay: 1.3s; }
        .category-card:nth-child(10) { animation-delay: 1.4s; }
        .category-card:nth-child(11) { animation-delay: 1.5s; }
        .category-card:nth-child(12) { animation-delay: 1.6s; }
        .category-card:nth-child(13) { animation-delay: 1.7s; }
        .category-card:nth-child(14) { animation-delay: 1.8s; }
        .category-card:nth-child(15) { animation-delay: 1.9s; }
        .category-card:nth-child(16) { animation-delay: 2.0s; }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .category-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #00A88F;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .category-card:hover .category-icon {
            transform: scale(1.1) rotate(5deg);
        }
        .category-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .category-info {
            flex: 1;
        }
        .category-name {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        .category-positions {
            font-size: 14px;
            color: #6b7280;
        }
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
            <!-- Job Categories Section -->
            <div class="categories-section">
                <h2 class="categories-title">Job Categories</h2>
                <div class="categories-container">
                    <!-- Column 1 -->
                    <a href="#" class="category-card" data-category="graphics-design">
                        <div class="category-icon">
                            <img src="{{ asset('image/graphicdesign.png') }}" alt="Graphics & Design">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Graphics & Design</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="music-audio">
                        <div class="category-icon">
                            <img src="{{ asset('image/musicaudio.png') }}" alt="Music & Audio">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Music & Audio</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="account-finance">
                        <div class="category-icon">
                            <img src="{{ asset('image/accountfinance.png') }}" alt="Account & Finance">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Account & Finance</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="code-programming">
                        <div class="category-icon">
                            <img src="{{ asset('image/codeprogramming.png') }}" alt="Code & Programming">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Code & Programming</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="digital-marketing">
                        <div class="category-icon">
                            <img src="{{ asset('image/digitalmarketing.png') }}" alt="Digital Marketing">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Digital Marketing</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="health-care">
                        <div class="category-icon">
                            <img src="{{ asset('image/healthcare.png') }}" alt="Health & Care">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Health & Care</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="video-animation">
                        <div class="category-icon">
                            <img src="{{ asset('image/videoanimation.png') }}" alt="Video & Animation">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Video & Animation</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="data-science">
                        <div class="category-icon">
                            <img src="{{ asset('image/datascience.png') }}" alt="Data & Science">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Data & Science</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <!-- Column 2 (duplicate for two columns) -->
                    <a href="#" class="category-card" data-category="graphics-design-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/graphicdesign.png') }}" alt="Graphics & Design">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Graphics & Design</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="music-audio-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/musicaudio.png') }}" alt="Music & Audio">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Music & Audio</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="account-finance-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/accountfinance.png') }}" alt="Account & Finance">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Account & Finance</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="code-programming-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/codeprogramming.png') }}" alt="Code & Programming">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Code & Programming</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="digital-marketing-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/digitalmarketing.png') }}" alt="Digital Marketing">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Digital Marketing</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="health-care-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/healthcare.png') }}" alt="Health & Care">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Health & Care</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="video-animation-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/videoanimation.png') }}" alt="Video & Animation">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Video & Animation</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>

                    <a href="#" class="category-card" data-category="data-science-2">
                        <div class="category-icon">
                            <img src="{{ asset('image/datascience.png') }}" alt="Data & Science">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Data & Science</div>
                            <div class="category-positions">100 open positions</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

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

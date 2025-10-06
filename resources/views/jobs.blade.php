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
            margin-top: 20px;
            margin-bottom: 32px;
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
            font-size: 16px;
            margin-bottom: 5px;
            color: #000;
        }
        .job-company {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        .job-status {
            display: flex;
            align-items: center;
            color: #00A49C;
            font-size: 12px;
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
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
        <a href="{{ route('genius') }}" class="sidebar-icon" data-page="genius">
            <img src="{{ asset('image/genius.png') }}" alt="Genius" class="sidebar-icon-img">
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

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Jobs For You Header -->
            <div class="jobs-header">
                <img src="{{ asset('image/logo.png') }}" alt="CloseCall">
                <h1 class="jobs-title">Jobs For You</h1>
            </div>

            <!-- Complete your Profile Section -->
            <div class="complete-profile">
                <h2 class="complete-title">Complete your Profile first!</h2>
                <p class="complete-text">You will need to complete your profile in order to apply for a job through this website. Once you're set up, you can browse the website as much as you want.</p>
                
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill"></div>
                    </div>
                    <span style="color: #00A88F; font-weight: 600;">50%</span>
                </div>
                
                <button class="complete-btn">
                    Complete Profile
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                    </svg>
                </button>
            </div>

            <!-- Job Categories Section - Same as landingpage.blade.php -->
            <h2 class="section-title text-left">Job Categories</h2>
            
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
                            <svg width="16" height="10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn" data-job="data-analyst">×</a>
                </div>

                <div class="job-card">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Social Media Manager" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Social Media Manager</div>
                        <div class="job-company">Indonesia | Best Partner Education</div>
                        <div class="job-status">
                            <svg width="16" height="10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="{{ route('bestpartnerjob') }}" class="job-apply-btn">×</a>
                </div>

                <div class="job-card">
                    <img src="{{ asset('image/mechanicalengineer.png') }}" alt="Mechanical Engineer" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Mechanical Engineer</div>
                        <div class="job-company">Indonesia | R-Tech Computer</div>
                        <div class="job-status">
                            <svg width="16" height="10" fill="currentColor" viewBox="0 0 24 24">
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

        // Handle complete profile button
        document.querySelector('.complete-btn').addEventListener('click', function() {
            window.location.href = '/profile';
        });

        // Handle suggested tags
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function() {
                const searchInput = document.querySelector('.search-input-large');
                searchInput.value = this.textContent;
                searchInput.focus();
            });
        });

        // Handle job apply buttons
        document.querySelectorAll('.job-apply-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const jobData = this.getAttribute('data-job');
                
                // If href is not "#", let the link work normally
                if (href && href !== '#') {
                    // Let the anchor tag handle navigation
                    return;
                }
                
                // Handle navigation based on data-job attribute
                if (jobData) {
                    e.preventDefault();
                    console.log('Apply for job:', jobData);
                    
                    // Navigate based on job type
                    switch(jobData) {
                        case 'data-analyst':
                            // TODO: Add your route here
                            console.log('Navigate to Data Analyst apply page');
                            // window.location.href = '/job/data-analyst/apply';
                            break;
                        case 'social-media-manager':
                            // TODO: Add your route here  
                            console.log('Navigate to Social Media Manager apply page');
                            // window.location.href = '/job/social-media-manager/apply';
                            break;
                        case 'mechanical-engineer':
                            // TODO: Add your route here
                            console.log('Navigate to Mechanical Engineer apply page');
                            // window.location.href = '/job/mechanical-engineer/apply';
                            break;
                        default:
                            console.log('No specific route set for this job');
                    }
                } else {
                    // Fallback: prevent default for placeholder links
                    e.preventDefault();
                    console.log('Please set up navigation for this apply button');
                }
            });
        });

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

        // Handle job card clicks (for more details)
        document.querySelectorAll('.job-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking the apply button
                if (!e.target.closest('.job-apply-btn')) {
                    const jobTitle = this.querySelector('.job-title').textContent;
                    console.log('Navigate to job details:', jobTitle);
                    
                    // TODO: Navigate to job details page
                    // Example: window.location.href = `/job/${jobSlug}`;
                    // For now, you can uncomment below to navigate to bestpartnerjob.blade.php
                    // window.location.href = '/bestpartnerjob';
                }
            });
        });

        // Animate progress bar on page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.progress-fill').style.width = '50%';
            }, 500);
        });
    </script>
</body>
</html>
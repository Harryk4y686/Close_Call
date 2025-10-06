<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Partner Jobs - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        
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
            margin-bottom: 0px;
            position: relative;
            min-height: 200px;
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
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            object-fit: cover;
            margin-top: -60px;
            margin-bottom: 10px;
        }
        
        .company-details h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: #333;
        }
        
        .company-location {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .company-status {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #00A88F;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            background: #00A88F;
            border-radius: 50%;
        }
        
        .apply-btn {
            background: #00A88F;
            color: white;
            padding: 12px 32px;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 200px;
        }
        
        .apply-btn:hover {
            background: #008B7A;
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
            font-size: 13px;
            font-weight: 500;
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
            transition: transform 0.2s ease;
        }
        
        .related-job-card:hover {
            transform: translateY(-2px);
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
            transition: background 0.3s ease;
        }
        
        .apply-icon:hover {
            background: #008B7A;
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
                <input type="text" placeholder="Search jobs...">
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
            <!-- Job Header with Background -->
            <div class="job-header"></div>
            
            <!-- Job Company Info -->
            <div class="job-company-info">
                <div class="company-header">
                    <div class="company-left">
                        <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="company-logo">
                        <div class="company-details">
                            <h3>Best Partner Education</h3>
                            <div class="company-location">Indonesia | Best Partner Education</div>
                            <div class="company-status">
                                <div class="status-dot"></div>
                                Actively reviewing applications
                            </div>
                        </div>
                    </div>
                    <div class="header-buttons">
                        <button class="apply-btn">Apply</button>
                        <button class="options-btn">⋮</button>
                    </div>
                </div>
                
                <h1 class="job-title">Social Media Manager</h1>
                
                <div class="job-tags">
                    <span class="tag">#remote</span>
                    <span class="tag">#design</span>
                    <span class="tag">#socialmedia</span>
                    <span class="tag">#activelyreviewing</span>
                </div>
                
                <div class="job-content">
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
            <div class="about-company">
                <h3 class="about-company-title">About the Company</h3>
                
                <div class="about-header">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="company-logo" style="width: 48px; height: 48px;">
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
            <div class="related-jobs">
                <h3>Related Jobs</h3>
                
                <div class="related-job-card">
                    <img src="{{ asset('image/dataanalyst.png') }}" alt="Data Analyst" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Data Analyst</div>
                        <div class="related-job-company">Indonesia | GRHA Digital</div>
                        <div class="related-job-status">
                            <div class="status-dot"></div>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="related-job-card">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Social Media Manager" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Social Media Manager</div>
                        <div class="related-job-company">Indonesia | Best Partner Education</div>
                        <div class="related-job-status">
                            <div class="status-dot"></div>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="related-job-card">
                    <img src="{{ asset('image/mechanicalengineer.png') }}" alt="Mechanical Engineer" class="related-job-logo">
                    <div class="related-job-info">
                        <div class="related-job-title">Mechanical Engineer</div>
                        <div class="related-job-company">Indonesia | R-Tech Computer</div>
                        <div class="related-job-status">
                            <div class="status-dot"></div>
                            Actively reviewing applications
                        </div>
                    </div>
                    <div class="apply-icon">×</div>
                </div>
                
                <div class="see-all-link">See all</div>
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

        // Handle Apply button
        document.querySelector('.apply-btn').addEventListener('click', function() {
            this.textContent = 'Applied!';
            this.style.background = '#10b981';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = 'Apply';
                this.style.background = '#00A88F';
                this.disabled = false;
            }, 3000);
        });

        // Handle Options button
        document.querySelector('.options-btn').addEventListener('click', function() {
            // TODO: Add dropdown menu or modal
            console.log('Options button clicked');
            // Example: show dropdown with Save Job, Share, Report, etc.
            alert('Options menu would appear here (Save Job, Share, Report, etc.)');
        });

        // Handle Show More link
        document.querySelector('.show-more').addEventListener('click', function(e) {
            // For now, prevent default and show expanded text
            // Later you can replace this with actual navigation
            e.preventDefault();
            
            const description = document.querySelector('.company-description');
            const fullText = `Best Partner is revolutionizing hiring with the world's first and only end-to-end AI recruiting platform. Trained with human insights and proprietary data, this reduces time to hire from months to days, instantly matching you with pre-vetted qualified candidates, and conducting the first round phone screen for you. Trusted by hundreds of Fortune 1000 enterprises including Nestlé, Porsche, Atlassian, Goldman Sachs, and Nike, Braintrust AIR is making talent acquisition professionals 10x more effective and saving companies hundreds of thousands of dollars in recruiting costs.

Our mission is to democratize access to talent by creating a more efficient, transparent, and inclusive hiring process. We believe that the best candidates should have access to the best opportunities, regardless of their background or network.

With our AI-powered platform, we're not just changing how companies hire - we're transforming careers and creating opportunities for professionals worldwide.`;
            
            if (this.textContent === 'Show more...') {
                description.textContent = fullText;
                this.textContent = 'Show less...';
            } else {
                description.textContent = description.textContent.substring(0, 400) + '...';
                this.textContent = 'Show more...';
            }
            
            // Uncomment below when you have the actual page to navigate to
            // window.location.href = '/company/best-partner-education';
        });

        // Handle Related Job Apply Icons
        document.querySelectorAll('.apply-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                this.textContent = '✓';
                this.style.background = '#10b981';
                
                setTimeout(() => {
                    this.textContent = '×';
                    this.style.background = '#00A88F';
                }, 2000);
            });
        });

        // Handle Related Job Cards Click
        document.querySelectorAll('.related-job-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking the apply icon
                if (!e.target.closest('.apply-icon')) {
                    console.log('Navigate to job:', this.querySelector('.related-job-title').textContent);
                    // Here you can add navigation logic
                }
            });
        });

        // Handle Tag clicks
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function() {
                console.log('Search for tag:', this.textContent);
                // Here you can add search functionality
            });
        });

        // Smooth scroll for page load
        window.addEventListener('load', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    </script>
</body>
</html>

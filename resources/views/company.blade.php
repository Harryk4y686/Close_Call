<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $company->company_name }} - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 80px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        
        .sidebar-logo {
            width: 50px;
            height: 50px;
            margin-bottom: 30px;
        }
        
        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .sidebar-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .sidebar-icon:hover {
            background-color: #f3f4f6;
        }
        
        .sidebar-icon.active {
            background-color: #00A88F;
        }
        
        .sidebar-icon-img {
            width: 24px;
            height: 24px;
        }
        
        .main-content {
            margin-left: 80px;
            min-height: 100vh;
        }
        
        .header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .location-selector {
            display: flex;
            align-items: center;
            background: #00A88F;
            color: white;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 14px;
            gap: 8px;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #f3f4f6;
            border-radius: 24px;
            padding: 10px 20px;
            flex: 1;
            max-width: 600px;
            gap: 10px;
        }
        
        .search-bar input {
            flex: 1;
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
        }
        
        .notification-icon, .avatar-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .notification-icon:hover, .avatar-icon:hover {
            background-color: #f3f4f6;
        }
        
        .content-wrapper {
            padding: 20px;
        }
        
        .company-banner {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #00A88F 0%, #00d4aa 100%);
            border-radius: 12px;
            margin-bottom: 20px;
            background-size: cover;
            background-position: center;
        }
        
        .company-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .company-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .company-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .company-info h1 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 8px 0;
        }
        
        .company-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #6b7280;
            font-size: 14px;
        }
        
        .company-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .about-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 16px 0;
        }
        
        .about-content {
            color: #4b5563;
            line-height: 1.6;
            font-size: 15px;
        }
        
        .jobs-section {
            margin-top: 30px;
        }
        
        .jobs-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 20px 0;
        }
        
        .job-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
            position: relative;
        }
        
        .job-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        
        .job-card.hidden {
            opacity: 0;
            transform: scale(0.95);
            max-height: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        .job-logo {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .job-info {
            flex: 1;
        }
        
        .job-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 8px 0;
        }
        
        .job-details {
            color: #6b7280;
            font-size: 14px;
        }
        
        .close-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fee;
            color: #dc2626;
            border: none;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .close-btn:hover {
            background: #dc2626;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <a href="{{ route('landing-page') }}" class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </a>
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
            <div class="location-selector">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Indonesia
            </div>
            
            <form action="{{ route('search') }}" method="GET" class="search-bar">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" name="q" placeholder="Search companies, jobs...">
            </form>

            <a href="#" class="notification-icon">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </a>
            <a href="{{ route('profile') }}" class="avatar-icon">
                @if(isset($profile) && $profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                @else
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                @endif
            </a>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Company Banner -->
            <div class="company-banner" 
                 @if($company->banner_image)
                 style="background-image: url('{{ asset('storage/' . $company->banner_image) }}');"
                 @endif>
            </div>

            <!-- Company Card -->
            <div class="company-card">
                <div class="company-header">
                    @if($company->profile_picture)
                        <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="{{ $company->company_name }}" class="company-logo">
                    @else
                        <img src="{{ asset('image/socialmediamanager.png') }}" alt="{{ $company->company_name }}" class="company-logo">
                    @endif
                    <div class="company-info">
                        <h1>{{ $company->company_name }}</h1>
                        <div class="company-meta">
                            <span>
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                {{ $company->location }}
                            </span>
                            <span>{{ $company->industry }}</span>
                            <span>{{ $company->company_size }} employees</span>
                        </div>
                    </div>
                </div>

                <!-- About the Company -->
                <div class="about-section">
                    <h2>About the Company</h2>
                    <div class="about-content">
                        {{ $company->about }}
                    </div>
                </div>
            </div>

            <!-- Related Jobs -->
            @if(isset($relatedJobs) && $relatedJobs->count() > 0)
            <div class="company-card jobs-section">
                <h2>Related Jobs</h2>
                @foreach($relatedJobs as $job)
                <div class="job-card" id="job-{{ $job->id }}">
                    @if($job->profile_picture)
                        <img src="{{ asset('storage/' . $job->profile_picture) }}" alt="{{ $job->job_title }}" class="job-logo">
                    @else
                        <img src="{{ asset('image/socialmediamanager.png') }}" alt="{{ $job->job_title }}" class="job-logo">
                    @endif
                    <div class="job-info">
                        <div class="job-title">{{ $job->job_title }}</div>
                        <div class="job-details">{{ $job->location }} | {{ $job->company_name }}</div>
                    </div>
                    <button class="close-btn" onclick="hideJob('job-{{ $job->id }}')">&times;</button>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <script>
        // Hide job with animation (no database delete)
        function hideJob(jobId) {
            const jobCard = document.getElementById(jobId);
            if (jobCard) {
                jobCard.classList.add('hidden');
                setTimeout(() => {
                    jobCard.style.display = 'none';
                }, 300);
            }
        }

        // Sidebar navigation
        document.querySelectorAll('.sidebar-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-icon').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>

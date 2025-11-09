<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Simple & Subtle Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .fade-in-up-delay {
            animation: fadeInUp 0.6s ease-out 0.2s both;
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
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .header:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
            
        }
        
        @media (max-width: 480px) {
            .header {
                padding-left: 120px;
            }
            
            .search-bar {
                max-width: 280px;
            }
        }

        /* Event Poster Styles */
        .content-wrapper {
            padding: 24px 60px;
            max-width: 100%;
            margin: 0 auto;
        }

        .event-poster {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
    position: relative;
    overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            min-height: 500px;
}

        .qr-section {
    position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qr-code {
            width: 50px;
            height: 50px;
            background: #000;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-placeholder {
            width: 35px;
            height: 35px;
            background: repeating-linear-gradient(
                0deg,
                #fff 0px, #fff 1px,
                #000 1px, #000 2px
            ),
            repeating-linear-gradient(
                90deg,
                #fff 0px, #fff 1px,
                #000 1px, #000 2px
            );
        }

        .qr-text {
    display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .qr-title {
            font-size: 12px;
            font-weight: 600;
            color: #000;
            margin: 0;
        }

        .qr-url {
            font-size: 10px;
            color: #000;
            margin: 0;
        }

        .event-logo-section {
            position: absolute;
            top: 15px;
            right: 15px;
            text-align: right;
        }

        .event-logo {
    display: flex;
    align-items: center;
            gap: 6px;
            margin-bottom: 4px;
}

        .logo-text {
            font-size: 16px;
    font-weight: 700;
            color: #dc2626;
        }

        .logo-graphic {
            width: 20px;
            height: 20px;
            background: linear-gradient(45deg, #dc2626, #ef4444);
            border-radius: 50%;
            position: relative;
        }

        .logo-graphic::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
        }

        .convention-text {
            font-size: 10px;
            color: #000;
            margin: 0;
        }

        .decorative-left {
    position: absolute;
    top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }

        .decorative-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            overflow: hidden;
        }

        .main-title {
            font-size: 36px;
            font-weight: 700;
            color: #dc2626;
            text-align: center;
            margin: 60px 0 15px 0;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .slogan {
            font-size: 16px;
            color: #000;
            text-align: center;
            margin: 0 0 25px 0;
            font-weight: 400;
        }

        .date-location {
            display: flex;
            justify-content: space-between;
    align-items: center;
            margin: 0 0 15px 0;
            padding: 0 30px;
    position: relative;
        }

        .date, .location {
            font-size: 14px;
            color: #000;
            font-weight: 500;
        }

        .date-location::after {
    content: '';
    position: absolute;
            left: 30px;
            right: 30px;
            bottom: -20px;
            height: 1px;
            background: #dc2626;
        }

        .highlights {
            display: flex;
            justify-content: space-between;
            margin-top: 35px;
            padding: 0 30px;
        }

        .highlight-column {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .highlight-item {
    display: flex;
    align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #000;
        }

        .bullet {
            width: 6px;
            height: 6px;
            background: #dc2626;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Event Info Card Styles */
        .event-info-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .event-title {
    font-size: 20px;
            font-weight: 700;
            color: #000;
            margin: 0 0 12px 0;
        }

        .event-details {
            margin-bottom: 16px;
        }

        .event-details p {
            margin: 0 0 6px 0;
            font-size: 14px;
            color: #000;
        }

        .action-buttons {
    display: flex;
            gap: 10px;
        }

        .attend-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
    cursor: pointer;
            transition: background 0.3s ease;
        }

        .attend-btn:hover {
            background: #008B7A;
        }

        .share-btn {
            background: white;
            color: #00A88F;
            border: 1px solid #00A88F;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background: #00A88F;
    color: white;
        }

        /* About Section Styles */
        .about-section {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .about-title {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            margin: 0 0 12px 0;
        }

        .about-content {
            font-size: 14px;
            color: #000;
            line-height: 1.5;
            margin: 0 0 8px 0;
        }

        .show-more {
            color: #00A88F;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            float: right;
        }

        /* Event Card Styles */
        .content-wrapper {
            padding: 24px 60px;
            max-width: 100%;
            margin: 0 auto;
        }

         .event-card {
             background: white;
             border-radius: 16px;
             box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
             overflow: hidden;
             border: 1px solid #e5e7eb;
             transition: all 0.4s ease;
         }

         .event-card:hover {
             transform: translateY(-5px);
             box-shadow: 0 12px 40px rgba(0, 168, 143, 0.15);
         }

         .event-image {
             width: 105%;
             height: 700px;
             overflow: hidden;
         }

         .background-image {
             width: 100%;
             height: 100%;
             object-fit: cover;
             transition: transform 0.6s ease;
         }

         .event-card:hover .background-image {
             transform: scale(1.05);
         }

        .event-details {
            padding: 24px;
        }

         .event-title {
             font-size: 24px;
             font-weight: 700;
             color: #000;
             margin: 0 0 16px 0;
             transition: all 0.3s ease;
         }

         .event-title:hover {
             color: #00A88F;
             transform: translateX(3px);
         }

         .event-info {
             margin-bottom: 20px;
         }

         .event-info p {
             margin: 0 0 8px 0;
             font-size: 16px;
             color: #000;
             transition: all 0.3s ease;
         }

         .event-info p:hover {
             color: #00A88F;
             padding-left: 5px;
         }

         .event-buttons {
             display: flex;
             gap: 12px;
         }

        .attend-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            width: 225px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .attend-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .attend-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .attend-btn:hover {
            background: #008B7A;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 168, 143, 0.4);
        }

        .attend-btn:active {
            transform: translateY(-1px) scale(1.01);
        }

        .share-btn {
            background: white;
            color: #00A88F;
            border: 2px solid #00A88F;
            padding: 12px 24px;
            border-radius: 30px;
            width: 225px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .share-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: #00A88F;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: 0;
        }

        .share-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .share-btn span {
            position: relative;
            z-index: 1;
        }

        .share-btn:hover {
            color: white;
            border-color: #00A88F;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 168, 143, 0.3);
        }

        .share-btn:active {
            transform: translateY(-1px) scale(1.01);
        }

         /* About Section Styles */
         .about-section {
             background: white;
             border-radius: 16px;
             padding: 24px 24px 40px 24px;
             margin-top: 20px;
             box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
             border: 1px solid #e5e7eb;
             transition: all 0.4s ease;
         }

         .about-section:hover {
             transform: translateY(-3px);
             box-shadow: 0 8px 30px rgba(0, 168, 143, 0.1);
         }

         .about-title {
             font-size: 20px;
             font-weight: 700;
             color: #000;
             margin: 0 0 16px 0;
             transition: all 0.3s ease;
         }

         .about-title:hover {
             color: #00A88F;
             transform: translateX(3px);
         }

         .about-content {
             font-size: 16px;
             color: #000;
             line-height: 1.6;
             margin: 0 0 30px 0;
         }

         .show-more {
             color: #00A88F;
             text-decoration: none;
             font-size: 16px;
             font-weight: 500;
             float: right;
             position: relative;
             transition: all 0.3s ease;
         }

         .show-more::after {
             content: '';
             position: absolute;
             bottom: -2px;
             left: 0;
             width: 0;
             height: 2px;
             background: #00A88F;
             transition: width 0.3s ease;
         }

         .show-more:hover::after {
             width: 100%;
         }

         .show-more:hover {
             color: #008B7A;
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
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon active" data-page="events">
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

        <!-- Event Content -->
        <div class="content-wrapper">
            <!-- Single Event Card -->
            <div class="event-card fade-in-up">
                <!-- Large Background Image -->
                <div class="event-image">
                    <img src="{{ $event->banner_url }}" alt="{{ $event->title }}" class="background-image"
                         onerror="this.src='{{ asset('image/JCI.png') }}';">
                </div>
                
                <!-- Event Details -->
                <div class="event-details">
                    <h2 class="event-title">{{ $event->title }}</h2>
                    <div class="event-info">
                        <p class="event-by">Event by {{ $event->creator ? $event->creator->full_name : 'Unknown' }}</p>
                        <p class="event-date">{{ $event->formatted_date_time }}</p>
                        <p class="event-location">{{ $event->location }}{{ $event->country ? ', ' . $event->country : '' }} | {{ $event->attendees_count }} Attendees</p>
                    </div>
                    <div class="event-buttons">
                        @if($isAttending)
                            <form action="{{ route('events.cancel', $event->id) }}" method="POST" style="flex: 1;" onsubmit="return confirmCancelAttendance()">
                                @csrf
                                <button type="submit" class="attend-btn" style="width: 100%; background: #dc2626;">Cancel Attendance</button>
                            </form>
                        @else
                            <form action="{{ route('events.attend', $event->id) }}" method="POST" style="flex: 1;" id="attendForm" onsubmit="return handleAttendSubmit(event)">
                                @csrf
                                <button type="submit" class="attend-btn" style="width: 100%;" id="attendButton">Attend</button>
                            </form>
                        @endif
                        <button class="share-btn" onclick="shareCurrentEvent('{{ addslashes($event->title) }}')"><span>Share</span></button>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="about-section fade-in-up-delay">
                <h3 class="about-title">About</h3>
                <p class="about-content">
                    {{ $event->description ?? 'No description available for this event.' }}
                </p>
                <a href="#" class="show-more">Show more...</a>
            </div>
        </div>
    </div>

    <script>
        // Track attendance state
        let isCurrentlyAttending = {{ $isAttending ? 'true' : 'false' }};
        
        // Handle attend button submission
        function handleAttendSubmit(event) {
            if (isCurrentlyAttending) {
                event.preventDefault(); // Prevent form submission
                showNotification('You have already attended this event!', 'info');
                return false;
            }
            
            // Disable button to prevent double submission
            const submitButton = event.target.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Processing...';
                
                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Attend';
                }, 3000);
            }
            
            // If not attending, allow form submission
            return true;
        }
        
        // Handle cancel attendance confirmation
        function confirmCancelAttendance() {
            if (confirm('Are you sure you want to cancel your attendance?')) {
                isCurrentlyAttending = false;
                return true;
            }
            return false;
        }
        
        // Update attendance button based on state
        function updateAttendanceButton(isAttending) {
            const eventButtons = document.querySelector('.event-buttons');
            if (isAttending) {
                // Update to show Cancel Attendance button
                eventButtons.innerHTML = `
                    <form action="{{ route('events.cancel', $event->id) }}" method="POST" style="flex: 1;" onsubmit="return confirmCancelAttendance()">
                        @csrf
                        <button type="submit" class="attend-btn" style="width: 100%; background: #dc2626;">Cancel Attendance</button>
                    </form>
                    <button class="share-btn" onclick="shareCurrentEvent('{{ addslashes($event->title) }}')"><span>Share</span></button>
                `;
            } else {
                // Update to show Attend button
                eventButtons.innerHTML = `
                    <form action="{{ route('events.attend', $event->id) }}" method="POST" style="flex: 1;" id="attendForm" onsubmit="return handleAttendSubmit(event)">
                        @csrf
                        <button type="submit" class="attend-btn" style="width: 100%;" id="attendButton">Attend</button>
                    </form>
                    <button class="share-btn" onclick="shareCurrentEvent('{{ addslashes($event->title) }}')"><span>Share</span></button>
                `;
            }
        }
        
        // Show notification popup
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 30px;
                right: 30px;
                background: ${type === 'info' ? '#3b82f6' : type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 20px 30px;
                border-radius: 12px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                font-size: 16px;
                font-weight: 600;
                max-width: 400px;
                min-width: 300px;
                animation: slideIn 0.4s ease-out;
                border-left: 4px solid rgba(255, 255, 255, 0.3);
            `;
            
            // Add animation styles
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
                @keyframes slideOut {
                    from { transform: translateX(0); opacity: 1; }
                    to { transform: translateX(100%); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-in';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
        
        // Share current event function - Just copy link to clipboard
        function shareCurrentEvent(eventName) {
            const eventUrl = window.location.href;
            
            // Copy link to clipboard
            navigator.clipboard.writeText(eventUrl).then(() => {
                showNotification('Link copied to clipboard!', 'success');
            }).catch((error) => {
                console.log('Error copying to clipboard:', error);
                // Alternative fallback
                prompt('Copy this link to share:', eventUrl);
            });
        }

        // Show session messages with custom notifications
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
            // If success message contains "attended", update the attendance state
            const successMessage = '{{ session('success') }}';
            if (successMessage.toLowerCase().includes('attended')) {
                isCurrentlyAttending = true;
                // Update the button to show "Cancel Attendance"
                updateAttendanceButton(true);
            }
        @endif

        @if(session('info'))
            showNotification('{{ session('info') }}', 'info');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
    </script>
</body>
</html>

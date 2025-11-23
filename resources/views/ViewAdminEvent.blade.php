<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->event_name }} - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Header styles */
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
        
        /* Main content */
        .main-content {
            margin-left: 109px;
            padding: 0;
            min-height: 100vh;
        }
        
        /* Sidebar styles */
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
        
        /* Event Content */
        .content-wrapper {
            padding: 40px 60px;
        }
        
        .event-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .event-banner {
            width: 100%;
            height: 400px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .event-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .event-details {
            padding: 30px;
        }
        
        .event-title {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            margin: 0 0 20px 0;
        }
        
        .event-info p {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #666;
        }
        
        .event-info strong {
            color: #000;
        }
        
        .event-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .attend-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .attend-btn:hover {
            background: #008B7A;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 168, 143, 0.3);
        }
        
        .share-btn {
            background: white;
            color: #00A88F;
            border: 2px solid #00A88F;
            padding: 15px 40px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .share-btn:hover {
            background: #00A88F;
            color: white;
        }
        
        /* About Section */
        .about-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .about-title {
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin: 0 0 16px 0;
        }
        
        .about-content {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
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
        <a href="{{ route('events') }}" class="sidebar-icon active" data-page="events">
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

        <!-- Event Content -->
        <div class="content-wrapper">
            <!-- Success Message -->
            @if(session('success'))
                <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <!-- Event Card -->
            <div class="event-card">
                <div class="event-banner">
                    @if($event->banner_image)
                        <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->event_name }}">
                    @else
                        <div style="color: #6b7280;">No banner image</div>
                    @endif
                </div>
                <div class="event-details">
                    <h1 class="event-title">{{ $event->event_name }}</h1>
                    <div class="event-info">
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->starting_date)->format('l, F d, Y') }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Attendees:</strong> {{ $event->attendees }} people registered</p>
                    </div>
                    <div class="event-buttons">
                        @if($isAttending)
                            <form action="{{ route('admin.events.cancel', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="attend-btn" style="background: #dc2626;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">Cancel Attendance</button>
                            </form>
                        @else
                            <form action="{{ route('admin.events.attend', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="attend-btn">Attend Event</button>
                            </form>
                        @endif
                        <button class="share-btn" onclick="shareEvent()">Share</button>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="about-section">
                <h2 class="about-title">About this event</h2>
                <div class="about-content">
                    {{ $event->about }}
                </div>
            </div>
        </div>
    </div>

    <script>
        async function shareEvent() {
            const eventTitle = "{{ $event->event_name }}";
            const eventDate = "{{ \Carbon\Carbon::parse($event->starting_date)->format('l, F d, Y') }}";
            const eventLocation = "{{ $event->location }}";
            const eventUrl = window.location.href;
            
            const shareText = `Check out this event: ${eventTitle}\nDate: ${eventDate}\nLocation: ${eventLocation}`;
            
            // Check if Web Share API is supported
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: eventTitle,
                        text: shareText,
                        url: eventUrl
                    });
                    console.log('Event shared successfully');
                } catch (err) {
                    // User cancelled sharing or error occurred
                    if (err.name !== 'AbortError') {
                        console.log('Error sharing:', err);
                        copyToClipboard(eventUrl);
                    }
                }
            } else {
                // Fallback: Copy to clipboard
                copyToClipboard(eventUrl);
            }
        }
        
        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    showNotification('✓ Link copied to clipboard!', 'success');
                }).catch(err => {
                    console.error('Failed to copy:', err);
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }
        
        function fallbackCopy(text) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.opacity = '0';
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showNotification('✓ Link copied to clipboard!', 'success');
            } catch (err) {
                showNotification('✗ Failed to copy link', 'error');
            }
            document.body.removeChild(textArea);
        }
        
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: 500;
                z-index: 10000;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                animation: slideIn 0.3s ease-out;
            `;
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(style);
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transition = 'opacity 0.3s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                    document.head.removeChild(style);
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>

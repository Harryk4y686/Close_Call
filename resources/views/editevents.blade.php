<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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
        
        .notification-icon:hover, .avatar-icon:hover {
            background: #e5e7eb;
        }
        
        .main-content {
            margin-left: 109px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }
        
        .create-event-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2rem;
        }
        
        .form-container {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-input, .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.3s;
        }
        
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #00A88F;
            box-shadow: 0 0 0 3px rgba(0, 168, 143, 0.1);
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .file-upload:hover {
            border-color: #00A88F;
            background: #f0fdf4;
        }
        
        .file-upload input[type="file"] {
            display: none;
        }
        
        .upload-icon {
            margin-bottom: 0.5rem;
        }
        
        .upload-text {
            color: #6b7280;
            font=size: 0.875rem;
        }
        
        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn-primary, .btn-secondary {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: #00A88F;
            color: white;
            flex: 1;
        }
        
        .btn-primary:hover {
            background: #008B7A;
        }
        
        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }
        
        .btn-secondary:hover {
            background: #d1d5db;
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
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="AI">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Container -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div style="flex: 1;"></div> <!-- Spacer to push icons to the right -->
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

        <!-- Edit Event Content -->
        <div class="create-event-content">
            <h1 class="page-title">Edit Event</h1>
            
            <div class="form-container">
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div style="background: #ef4444; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 8px 0 0 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display Session Messages -->
                @if(session('error'))
                    <div style="background: #ef4444; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;">
                        <strong>Error:</strong> {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px;">
                        <strong>Success:</strong> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Event Title -->
                    <div class="form-group">
                        <label for="event_title" class="form-label">Event Title</label>
                        <input type="text" id="event_title" name="event_title" class="form-input" placeholder="Enter event title" value="{{ old('event_title', $event->title) }}" required>
                    </div>

                    <!-- Event Description -->
                    <div class="form-group">
                        <label for="event_description" class="form-label">Event Description</label>
                        <textarea id="event_description" name="event_description" class="form-textarea" placeholder="Describe your event...">{{ old('event_description', $event->description) }}</textarea>
                    </div>

                    <!-- Date and Time -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" id="event_date" name="event_date" class="form-input" value="{{ old('event_date', $event->event_date) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="event_time" class="form-label">Event Time</label>
                            <input type="time" id="event_time" name="event_time" class="form-input" value="{{ old('event_time', $event->event_time) }}" required>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="form-group">
                        <label for="event_location" class="form-label">Event Location</label>
                        <input type="text" id="event_location" name="event_location" class="form-input" placeholder="Enter event location" value="{{ old('event_location', $event->location) }}" required>
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="event_country" class="form-label">Event Country (Optional)</label>
                        <input type="text" id="event_country" name="event_country" class="form-input" placeholder="Enter country" value="{{ old('event_country', $event->country) }}">
                    </div>

                    <!-- Event Banner Image -->
                    <div class="form-group">
                        <label class="form-label">Event Banner Image</label>
                        @if($event->banner_url)
                            <div style="margin-bottom: 10px;">
                                <img src="{{ $event->banner_url }}" alt="Current Banner" style="max-width: 200px; border-radius: 8px;">
                                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 5px;">Current banner (leave empty to keep)</p>
                            </div>
                        @endif
                        <div class="file-upload" onclick="document.getElementById('event_banner').click()">
                            <div class="upload-icon">
                                <svg width="24" height="24" fill="#6b7280" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                            </div>
                            <div class="upload-text">
                                <strong>Click to upload new banner</strong> or drag and drop<br>
                                PNG, JPG, GIF up to 10MB
                            </div>
                            <input type="file" id="event_banner" name="event_banner" accept="image/*">
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="form-buttons">
                        <button type="button" class="btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn-primary">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

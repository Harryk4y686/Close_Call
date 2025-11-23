<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - CloseCall</title>
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
        
        /* Create Event Page Styles */
        .create-event-content {
            padding: 40px 60px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 30px 0;
            text-align: center;
        }

        .form-container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            color: #1f2937;
            background: white;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #00A49C;
            box-shadow: 0 0 0 3px rgba(0, 164, 156, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            color: #1f2937;
            background: white;
            min-height: 120px;
            resize: vertical;
            transition: border-color 0.3s ease;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #00A49C;
            box-shadow: 0 0 0 3px rgba(0, 164, 156, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .file-upload {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            background: #f9fafb;
            transition: border-color 0.3s ease;
            cursor: pointer;
        }

        .file-upload:hover {
            border-color: #00A49C;
            background: #f0fdfa;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .upload-text {
            color: #6b7280;
            font-size: 16px;
            margin-top: 8px;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            background: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-buttons {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-primary {
            background: #00A49C;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            flex: 1;
        }

        .btn-primary:hover {
            background: #008b7a;
        }

        .btn-secondary {
            background: white;
            color: #6b7280;
            border: 1px solid #d1d5db;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        /* Mobile Responsive */
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-buttons {
                flex-direction: column;
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

    <!-- Main Content -->
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

        <!-- Create Event Content -->
        <div class="create-event-content">
            <h1 class="page-title">Create a new event</h1>
            
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

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Event Title -->
                    <div class="form-group">
                        <label for="event_title" class="form-label">Event Title</label>
                        <input type="text" id="event_title" name="event_title" class="form-input" placeholder="Enter event title" value="{{ old('event_title') }}" required>
                    </div>

                    <!-- Event Description -->
                    <div class="form-group">
                        <label for="event_description" class="form-label">Event Description</label>
                        <textarea id="event_description" name="event_description" class="form-textarea" placeholder="Describe your event...">{{ old('event_description') }}</textarea>
                    </div>

                    <!-- Date and Time -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_date" class="form-label">Event Date</label>
                            <input type="date" id="event_date" name="event_date" class="form-input" value="{{ old('event_date') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="event_time" class="form-label">Event Time</label>
                            <input type="time" id="event_time" name="event_time" class="form-input" value="{{ old('event_time') }}" required>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="form-group">
                        <label for="event_location" class="form-label">Event Location</label>
                        <input type="text" id="event_location" name="event_location" class="form-input" placeholder="Enter event location" value="{{ old('event_location') }}" required>
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="event_country" class="form-label">Event Country (Optional)</label>
                        <input type="text" id="event_country" name="event_country" class="form-input" placeholder="Enter country" value="{{ old('event_country') }}">
                    </div>

                    <!-- Event Banner Image -->
                    <div class="form-group">
                        <label class="form-label">Event Banner Image</label>
                        <div class="file-upload" onclick="document.getElementById('event_banner').click()">
                            <div class="upload-icon">
                                <svg width="24" height="24" fill="#6b7280" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                            </div>
                            <div class="upload-text">
                                <strong>Click to upload</strong> or drag and drop<br>
                                PNG, JPG, GIF up to 10MB
                            </div>
                            <input type="file" id="event_banner" name="event_banner" accept="image/*">
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="form-buttons">
                        <button type="button" class="btn-secondary" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn-primary">Create Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // File upload with preview - FIXED to keep original input with file
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.querySelector('.file-upload');
            const fileInput = document.getElementById('event_banner');
            let previewContainer = null;
            
            // Click to select file
            uploadArea.addEventListener('click', function(e) {
                // Don't trigger if clicking the file input itself
                if (e.target !== fileInput) {
                    fileInput.click();
                }
            });
            
            // Handle file selection
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image file');
                        return;
                    }
                    
                    // Validate file size (10MB max)
                    if (file.size > 10 * 1024 * 1024) {
                        alert('File size must be less than 10MB');
                        return;
                    }
                    
                    // Read and show preview
                    const reader = new FileReader();
                    
                    reader.onload = function(event) {
                        // Remove old preview if exists
                        if (previewContainer) {
                            previewContainer.remove();
                        }
                        
                        // Create preview container
                        previewContainer = document.createElement('div');
                        previewContainer.style.cssText = 'text-align: center;';
                        
                        // Create preview image
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.alt = 'Preview';
                        img.style.cssText = 'max-width: 200px; max-height: 120px; object-fit: cover; border-radius: 8px; border: 2px solid #00A49C; display: block; margin: 0 auto 12px auto;';
                        
                        // Create success message
                        const successMsg = document.createElement('div');
                        successMsg.style.cssText = 'color: #00A49C; font-weight: 600; margin-bottom: 8px;';
                        successMsg.textContent = '✓ File selected: ' + file.name;
                        
                        // Create change message
                        const changeMsg = document.createElement('div');
                        changeMsg.style.cssText = 'color: #6b7280; font-size: 14px;';
                        changeMsg.textContent = 'Click to change file';
                        
                        // Append elements to preview container
                        previewContainer.appendChild(img);
                        previewContainer.appendChild(successMsg);
                        previewContainer.appendChild(changeMsg);
                        
                        // Insert preview before the file input (don't remove input!)
                        uploadArea.insertBefore(previewContainer, fileInput);
                        
                        // Hide the upload text
                        const uploadIcon = uploadArea.querySelector('.upload-icon');
                        const uploadText = uploadArea.querySelector('.upload-text');
                        if (uploadIcon) uploadIcon.style.display = 'none';
                        if (uploadText) uploadText.style.display = 'none';
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        });

        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('event_date').min = new Date().toISOString().split('T')[0];
        });
    </script>
</body>
</html>

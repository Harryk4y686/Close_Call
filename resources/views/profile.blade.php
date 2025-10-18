<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
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
        .main-content {
            margin-left: 80px;
            padding: 0;
            min-height: 100vh;
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
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
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
        .notification-icon svg, .avatar-icon svg {
            width: 18px;
            height: 18px;
        }
        .content-wrapper {
            display: flex;
            gap: 2rem;
            padding: 36px;
        }
        .main-section {
            flex: 1;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            margin-left: 30px;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .profile-avatar {
            position: absolute;
            bottom: -50px;
            left: 2rem;
            width: 172px;
            height: 172px;
            border-radius: 50%;
            background: #e5e7eb;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-avatar svg {
            width: 60px;
            height: 60px;
            fill: #9ca3af;
        }
        .profile-buttons {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
        }
        .btn-edit {
            background: #00A88F;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            width: 144px;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: black;
            margin-bottom: 1.5rem;
            margin-top: 4rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-group input, .form-group select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #00A88F;
        }
        .upload-section {
            margin-bottom: 2rem;
        }
        .upload-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #374151;
        }
        .upload-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            border: 2px solid #00A88F;
            color: #00A88F;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        .upload-btn:hover {
            background: #00A88F;
            color: white;
        }
        .upload-icon {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
        }
        .upload-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .cancel-btn {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .cancel-btn:hover {
            background: #dc2626;
        }
        .file-selected {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }
        .save-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 2rem;
        }
        .save-btn:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
        .right-sidebar {
            width: 500px;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            height: fit-content;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
        }
        .completion-section {
            margin-bottom: 2rem;
        }
        .completion-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #374151;
            text-align: center;
        }
        .progress-circle {
            width: 174px;
            height: 174px;
            border-radius: 50%;
            background: conic-gradient(#00A88F 0deg {{ isset($profile) && $profile->completion_percentage ? ($profile->completion_percentage / 100 * 360) : 0 }}deg, #e5e7eb {{ isset($profile) && $profile->completion_percentage ? ($profile->completion_percentage / 100 * 360) : 0 }}deg 360deg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            position: relative;
            transition: background 0.5s ease;
        }
        .progress-circle::before {
            content: '';
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            position: absolute;
        }
        .progress-text {
            position: relative;
            z-index: 1;
            font-size: 32px;
            font-weight: bold;
            color: #000000;
        }
        .completion-list {
            list-style: none;
            padding: 0;
        }
        .completion-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .completion-item:last-child {
            border-bottom: none;
        }
        .completion-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .check-icon {
            color: #10b981;
            font-weight: bold;
        }
        .x-icon {
            color: #ef4444;
            font-weight: bold;
        }
        .completion-percentage {
            font-weight: bold;
            color: #00A88F;
        }
        .settings-section {
            margin-top: 2rem;
        }
        .settings-title {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #374151;
        }
        .settings-list {
            list-style: none;
            padding: 0;
        }
        .settings-item {
            padding: 4px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .settings-item:hover {
            color: #00A88F;
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="{{ route('profile') }}" class="sidebar-icon active" data-page="home">
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

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main Section -->
            <div class="main-section">
                <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-buttons">
                        <button class="btn-edit">Edit Profile</button>
                        <button class="btn-edit">Edit Banner</button>
                    </div>
                    <div class="profile-avatar">
                        @if(isset($profile) && $profile->profile_picture)
                            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" 
                                 onerror="console.error('Failed to load image:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <svg width="60" height="60" fill="#9ca3af" viewBox="0 0 24 24" style="display: none;">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        @else
                            <svg width="60" height="60" fill="#9ca3af" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Personal Information Section -->
                <h2 class="section-title">Personal Information</h2>
                <form id="profile-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label><b>First name</b></label>
                            <input type="text" id="first-name" name="first_name" placeholder="Enter your first name" value="{{ $user->first_name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Last name</b></label>
                            <input type="text" id="last-name" name="last_name" placeholder="Enter your last name" value="{{ $user->last_name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ $user->email ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Mobile Number</b></label>
                            <input type="tel" id="mobile-number" name="phone_number" placeholder="Enter your mobile number" value="{{ $user->phone_number ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Date of Birth</b></label>
                            <input type="date" id="date-of-birth" name="date_of_birth" placeholder="Select your date of birth" value="{{ $profile->date_of_birth ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Gender</b></label>
                            <select id="gender" name="gender">
                                <option value="" disabled {{ !isset($profile->gender) ? 'selected' : '' }}>Select your gender</option>
                                <option value="male" {{ isset($profile->gender) && $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ isset($profile->gender) && $profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ isset($profile->gender) && $profile->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Location</b></label>
                            <input type="text" id="location" name="location" placeholder="Enter your location" value="{{ $profile->location ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><b>Postal Code</b></label>
                            <input type="text" id="postal-code" name="postal_code" placeholder="Enter your postal code" value="{{ $profile->postal_code ?? '' }}">
                        </div>
                    </div>

                <!-- Professional Information Section -->
                <h2 class="section-title">Professional Information</h2>
                
                    <!-- Hidden file inputs -->
                    <input type="file" id="profile-picture-input" name="profile_picture" accept="image/*" style="display: none;">
                    <input type="file" id="banner-image-input" name="banner_image" accept="image/*" style="display: none;">
                    <input type="file" id="resume-input" name="resume" accept=".pdf,.doc,.docx" style="display: none;">
                    <input type="file" id="cv-input" name="cv" accept=".pdf,.doc,.docx" style="display: none;">
                    <input type="file" id="portfolio-input" name="portfolio" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" style="display: none;">

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Resume</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn" data-target="resume-input">
                                <img src="{{ asset('image/upload.png') }}" alt="Resume Icon" class="upload-icon">
                                <b>{{ isset($profile) && $profile->resume_path ? 'Change Resume' : 'Upload Resume' }}</b>
                            </button>
                            <button class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Curriculum Vitae</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn" data-target="cv-input">
                                <img src="{{ asset('image/upload.png') }}" alt="CV Icon" class="upload-icon">
                                <b>{{ isset($profile) && $profile->cv_path ? 'Change CV' : 'Upload CV' }}</b>
                            </button>
                            <button class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Portfolio</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn" data-target="portfolio-input">
                                <img src="{{ asset('image/upload.png') }}" alt="Portfolio Icon" class="upload-icon">
                                <b>{{ isset($profile) && $profile->portfolio_path ? 'Change Portfolio' : 'Upload Portfolio' }}</b>
                            </button>
                            <button class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>

                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>

            <!-- Right Sidebar -->
            <div class="right-sidebar">
                <!-- Complete your Profile Section -->
                <div class="completion-section">
                    <h3 class="completion-title">Complete your Profile</h3>
                    <div class="progress-circle" id="progressCircle">
                        <span class="progress-text" id="progressText">{{ isset($profile) && $profile->completion_percentage ? $profile->completion_percentage : 0 }}%</span>
                    </div>
                    <ul class="completion-list">
                        <li class="completion-item" id="photo-item">
                            <div class="completion-status">
                                <span class="x-icon" id="photo-icon">X</span>
                                <span>Upload your Photo</span>
                            </div>
                            <span class="completion-percentage">20%</span>
                        </li>
                        <li class="completion-item" id="personal-info-item">
                            <div class="completion-status">
                                <span class="x-icon" id="personal-info-icon">X</span>
                                <span>Personal Info</span>
                            </div>
                            <span class="completion-percentage">25%</span>
                        </li>
                        <li class="completion-item" id="location-item">
                            <div class="completion-status">
                                <span class="x-icon" id="location-icon">X</span>
                                <span>Location</span>
                            </div>
                            <span class="completion-percentage">20%</span>
                        </li>
                        <li class="completion-item" id="resume-cv-item">
                            <div class="completion-status">
                                <span class="x-icon" id="resume-cv-icon">X</span>
                                <span>Resume & CV</span>
                            </div>
                            <span class="completion-percentage">20%</span>
                        </li>
                        <li class="completion-item" id="portfolio-item">
                            <div class="completion-status">
                                <span class="x-icon" id="portfolio-icon">X</span>
                                <span>Portfolio</span>
                            </div>
                            <span class="completion-percentage">15%</span>
                        </li>
                    </ul>
                </div>

                <!-- Settings Section -->
                <div class="settings-section">
                    <h3 class="settings-title">Settings</h3>
                    <ul class="settings-list">
                        <li class="settings-item">Privacy</li>
                        <li class="settings-item">Language</li>
                        <li class="settings-item">Notifications</li>
                        <li class="settings-item">Preferences</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Profile completion tracking - initialize from server data
        let completionData = {
            uploadPhoto: {{ isset($profile) && $profile->profile_picture ? 'true' : 'false' }},    // 20%
            personalInfo: {{ isset($profile) && $profile->date_of_birth && $profile->gender && isset($user) && $user->first_name && $user->last_name && $user->email && $user->phone_number ? 'true' : 'false' }},   // 25%
            location: {{ isset($profile) && $profile->location && $profile->postal_code ? 'true' : 'false' }},       // 20%
            resume: {{ isset($profile) && $profile->resume_path ? 'true' : 'false' }},         // Resume file
            cv: {{ isset($profile) && $profile->cv_path ? 'true' : 'false' }},             // CV file
            portfolio: {{ isset($profile) && $profile->portfolio_path ? 'true' : 'false' }}       // 15%
        };

        // Update progress circle
        function updateProgressCircle() {
            let totalPercentage = 0;
            
            if (completionData.uploadPhoto) totalPercentage += 20;
            if (completionData.personalInfo) totalPercentage += 25;
            if (completionData.location) totalPercentage += 20;
            if (completionData.resume && completionData.cv) totalPercentage += 20; // Both resume AND CV required
            if (completionData.portfolio) totalPercentage += 15;

            const progressCircle = document.getElementById('progressCircle');
            const progressText = document.getElementById('progressText');
            
            // Update text
            progressText.textContent = totalPercentage + '%';
            
            // Update circle (360 degrees = 100%, so percentage * 3.6 = degrees)
            const degrees = (totalPercentage / 100) * 360;
            progressCircle.style.background = `conic-gradient(#00A88F 0deg ${degrees}deg, #e5e7eb ${degrees}deg 360deg)`;
        }

        // Update completion item status
        function updateCompletionItem(itemId, iconId, isCompleted) {
            const icon = document.getElementById(iconId);
            if (isCompleted) {
                icon.textContent = '✓';
                icon.className = 'check-icon';
            } else {
                icon.textContent = 'X';
                icon.className = 'x-icon';
            }
        }

        // Check personal info completion
        function checkPersonalInfo() {
            const firstName = document.getElementById('first-name').value.trim();
            const lastName = document.getElementById('last-name').value.trim();
            const email = document.getElementById('email').value.trim();
            const mobile = document.getElementById('mobile-number').value.trim();
            const dateOfBirth = document.getElementById('date-of-birth').value.trim();
            const gender = document.getElementById('gender').value;

            const isCompleted = firstName && lastName && email && mobile && dateOfBirth && gender;
            completionData.personalInfo = isCompleted;
            updateCompletionItem('personal-info-item', 'personal-info-icon', isCompleted);
            updateProgressCircle();
        }

        // Check location completion
        function checkLocation() {
            const location = document.getElementById('location').value.trim();
            const postalCode = document.getElementById('postal-code').value.trim();

            const isCompleted = location && postalCode;
            completionData.location = isCompleted;
            updateCompletionItem('location-item', 'location-icon', isCompleted);
            updateProgressCircle();
        }

        // Check resume & CV completion (both required)
        function checkResumeCV() {
            const isCompleted = completionData.resume && completionData.cv;
            updateCompletionItem('resume-cv-item', 'resume-cv-icon', isCompleted);
            updateProgressCircle();
        }

        // Add event listeners to form inputs
        document.addEventListener('DOMContentLoaded', function() {
            // Personal info inputs
            ['first-name', 'last-name', 'email', 'mobile-number', 'date-of-birth', 'gender'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', checkPersonalInfo);
                    element.addEventListener('change', checkPersonalInfo);
                }
            });

            // Location inputs
            ['location', 'postal-code'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', checkLocation);
                }
            });

            // Initial check and setup
            updateProgressCircle();
            
            // Initialize completion items based on server data
            updateCompletionItem('photo-item', 'photo-icon', completionData.uploadPhoto);
            updateCompletionItem('personal-info-item', 'personal-info-icon', completionData.personalInfo);
            updateCompletionItem('location-item', 'location-icon', completionData.location);
            updateCompletionItem('resume-cv-item', 'resume-cv-icon', completionData.resume && completionData.cv);
            updateCompletionItem('portfolio-item', 'portfolio-icon', completionData.portfolio);
        });

        // Handle upload button clicks
        document.querySelectorAll('.upload-btn').forEach((btn) => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                
                if (targetInput) {
                    targetInput.click();
                }
            });
        });

        // Handle file input changes
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name;
                    const targetId = this.id;
                    let btn = null;
                    
                    // Find the corresponding button
                    if (targetId === 'resume-input') {
                        btn = document.querySelector('[data-target="resume-input"]');
                    } else if (targetId === 'cv-input') {
                        btn = document.querySelector('[data-target="cv-input"]');
                    } else if (targetId === 'portfolio-input') {
                        btn = document.querySelector('[data-target="portfolio-input"]');
                    }
                    
                    if (btn) {
                        const originalText = btn.querySelector('b').textContent;
                        const cancelBtn = btn.parentElement.querySelector('.cancel-btn');
                        
                        btn.innerHTML = `
                            <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                            <b>${fileName}</b>
                        `;
                        btn.classList.add('file-selected');
                        btn.style.cursor = 'default';
                        cancelBtn.style.display = 'flex';
                        
                        // Store original content for reset
                        btn.setAttribute('data-original', originalText);

                        // Update completion based on upload type
                        if (originalText.includes('Resume')) {
                            completionData.resume = true;
                            checkResumeCV();
                        } else if (originalText.includes('CV')) {
                            completionData.cv = true;
                            checkResumeCV();
                        } else if (originalText.includes('Portfolio')) {
                            completionData.portfolio = true;
                            updateCompletionItem('portfolio-item', 'portfolio-icon', true);
                            updateProgressCircle();
                        }
                    }
                }
            });
        });

        // Cancel file function
        function cancelFile(cancelBtn) {
            const uploadContainer = cancelBtn.closest('.upload-container');
            const uploadBtn = uploadContainer.querySelector('.upload-btn');
            const originalText = uploadBtn.getAttribute('data-original');
            
            uploadBtn.innerHTML = `
                <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                <b>${originalText}</b>
            `;
            uploadBtn.classList.remove('file-selected');
            uploadBtn.style.cursor = 'pointer';
            uploadBtn.removeAttribute('data-original');
            cancelBtn.style.display = 'none';

            // Update completion based on upload type
            if (originalText.includes('Resume')) {
                completionData.resume = false;
                checkResumeCV();
            } else if (originalText.includes('CV')) {
                completionData.cv = false;
                checkResumeCV();
            } else if (originalText.includes('Portfolio')) {
                completionData.portfolio = false;
                updateCompletionItem('portfolio-item', 'portfolio-icon', false);
                updateProgressCircle();
            }
        }

        // Handle Edit Profile button (photo upload)
        document.querySelector('.btn-edit').addEventListener('click', function() {
            document.getElementById('profile-picture-input').click();
        });

        // Handle profile picture change
        document.getElementById('profile-picture-input').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                console.log('Profile picture selected:', file.name, file.size, file.type);
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file.');
                    return;
                }
                
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB.');
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const profileAvatar = document.querySelector('.profile-avatar');
                    profileAvatar.innerHTML = `<img src="${e.target.result}" alt="Profile Picture">`;
                    
                    // Update photo completion
                    completionData.uploadPhoto = true;
                    updateCompletionItem('photo-item', 'photo-icon', true);
                    updateProgressCircle();
                    
                    console.log('Profile picture preview updated');
                };
                
                reader.onerror = function() {
                    console.error('Error reading file');
                    alert('Error reading the selected file.');
                };
                
                reader.readAsDataURL(file);
            }
        });

        // Handle Edit Banner button
        document.querySelectorAll('.btn-edit')[1].addEventListener('click', function() {
            document.getElementById('banner-image-input').click();
        });

        // Handle banner image change
        document.getElementById('banner-image-input').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const profileHeader = document.querySelector('.profile-header');
                    profileHeader.style.background = `url(${e.target.result})`;
                    profileHeader.style.backgroundSize = 'cover';
                    profileHeader.style.backgroundPosition = 'center';
                    profileHeader.style.backgroundRepeat = 'no-repeat';
                };
                
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const saveBtn = document.querySelector('.save-btn');
            saveBtn.textContent = 'Saving...';
            saveBtn.disabled = true;
            
            const formData = new FormData(this);
            
            // Debug: Log form data
            console.log('Form submission data:');
            for (let [key, value] of formData.entries()) {
                if (value instanceof File) {
                    console.log(key + ':', value.name, value.size, value.type);
                } else {
                    console.log(key + ':', value);
                }
            }
            
            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    saveBtn.textContent = 'Saved!';
                    saveBtn.style.background = '#10b981';
                    
                    // Update profile picture if changed
                    if (data.profile && data.profile.profile_picture) {
                        const profileAvatar = document.querySelector('.profile-avatar');
                        profileAvatar.innerHTML = `<img src="{{ asset('storage/') }}/${data.profile.profile_picture}" alt="Profile Picture">`;
                    }
                    
                    // Update progress circle with saved percentage
                    if (data.completion_percentage) {
                        const progressText = document.getElementById('progressText');
                        const progressCircle = document.getElementById('progressCircle');
                        
                        progressText.textContent = data.completion_percentage + '%';
                        
                        // Update circle visual
                        const degrees = (data.completion_percentage / 100) * 360;
                        progressCircle.style.background = `conic-gradient(#00A88F 0deg ${degrees}deg, #e5e7eb ${degrees}deg 360deg)`;
                    }
                    
                    setTimeout(() => {
                        saveBtn.textContent = 'Save';
                        saveBtn.disabled = false;
                        saveBtn.style.background = '#00A88F';
                        location.reload(); // Reload to show updated data
                    }, 2000);
                } else {
                    saveBtn.textContent = 'Error - Try Again';
                    saveBtn.style.background = '#ef4444';
                    setTimeout(() => {
                        saveBtn.textContent = 'Save';
                        saveBtn.disabled = false;
                        saveBtn.style.background = '#00A88F';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                saveBtn.textContent = 'Error - Try Again';
                saveBtn.style.background = '#ef4444';
                setTimeout(() => {
                    saveBtn.textContent = 'Save';
                    saveBtn.disabled = false;
                    saveBtn.style.background = '#00A88F';
                }, 3000);
            });
        });

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

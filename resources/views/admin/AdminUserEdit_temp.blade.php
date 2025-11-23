<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Add</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideInSoft {
            0% {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        @keyframes floatIn {
            0% {
                opacity: 0;
                transform: scale(0.95);
                filter: blur(6px);
            }
            100% {
                opacity: 1;
                transform: scale(1);
                filter: blur(0);
            }
        }
        @keyframes popIn {
            0% {
                opacity: 0;
                transform: scale(0.7);
            }
            70% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        body {
            font-family: 'Poppins', sans-serif;
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
            padding: 36px;
        }
        .main-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            margin-left: 30px;
            overflow: hidden;
            animation: slideInSoft 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .profile-header {
            background-image: url("{{ asset('image/defaultbanner.png') }}");
            border-radius: 12px 12px 0 0;
            padding: 2rem;
            margin: -2rem -2rem 4rem -2rem;
            position: relative;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: floatIn 0.9s ease-out 0.05s both;
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
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
            animation: popIn 0.6s ease-out 0.25s both;
        }
        .btn-edit:hover {
            background: #00c0a3;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 168, 143, 0.3);
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: black;
            margin-bottom: 1.5rem;
            margin-top: 4rem;
        }
        .form-card {
            border: 2px solid #111;
            border-radius: 20px;
            padding: 2rem;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-top: 4rem;
            animation: slideInSoft 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
        }
        .form-card .section-title:first-of-type {
            margin-top: 0;
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
            width: 397px;
            max-width: 100%;
            margin: 2rem auto 0;
            display: block;
            animation: popIn 0.7s ease-out 0.35s both;
        }
        .save-btn:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="{{ route('AdminDashboard') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminUserDatabase') }}" class="sidebar-icon active" data-page="users">
            <img src="{{ asset('image/users.png') }}" alt="Users" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminJobDatabase') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminEventDatabase') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminCompanyDatabase') }}" class="sidebar-icon" data-page="companies">
            <img src="{{ asset('image/company.png') }}" alt="Companies" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main Section -->
            <div class="main-section">
                <form action="{{ route('adminuseradd.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                            <ul style="margin: 0; padding-left: 1.5rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Profile Header -->
                <div class="profile-header">
                    <div class="profile-buttons">
                        <button type="button" class="btn-edit">Edit Profile</button>
                        <button type="button" class="btn-edit">Edit Banner</button>
                    </div>
                    <div class="profile-avatar">
                        <svg width="60" height="60" fill="#9ca3af" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>

                <div class="form-card">
                    <!-- Personal Information Section -->
                    <h2 class="section-title">Personal Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label><b>First name</b></label>
                            <input type="text" name="first_name" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label><b>Last name</b></label>
                            <input type="text" name="last_name" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label><b>Mobile Number</b></label>
                            <input type="tel" name="phone_number" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="form-group">
                            <label><b>Date of Birth</b></label>
                            <input type="date" name="date_of_birth" placeholder="Select your date of birth" required>
                        </div>
                        <div class="form-group">
                            <label><b>Gender</b></label>
                            <select name="gender">
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Location</b></label>
                            <input type="text" name="location" placeholder="Enter your location" required>
                        </div>
                        <div class="form-group">
                            <label><b>Postal Code</b></label>
                            <input type="text" name="postal_code" placeholder="Enter your postal code" required>
                        </div>
                        <div class="form-group">
                            <label><b>Password</b></label>
                            <input type="password" name="password" placeholder="Enter password" required>
                        </div>
                    </div>

                    <!-- Professional Information Section -->
                    <h2 class="section-title">Professional Information</h2>
                    
                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Resume</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn">
                                <img src="{{ asset('image/upload.png') }}" alt="Resume Icon" class="upload-icon">
                                <b>Upload Resume</b>
                            </button>
                            <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Curriculum Vitae</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn">
                                <img src="{{ asset('image/upload.png') }}" alt="CV Icon" class="upload-icon">
                                <b>Upload CV</b>
                            </button>
                            <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Portfolio</h3>
                        <div class="upload-container">
                            <button type="button" class="upload-btn">
                                <img src="{{ asset('image/upload.png') }}" alt="Portfolio Icon" class="upload-icon">
                                <b>Upload Portfolio</b>
                            </button>
                            <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="save-btn">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Map upload sections to input names
        const uploadMapping = {
            'Upload Your Resume': 'resume',
            'Upload Your Curriculum Vitae': 'cv',
            'Upload Your Portfolio': 'portfolio'
        };

        // Handle upload button clicks for resume, CV, portfolio
        document.querySelectorAll('.upload-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent form submission
                
                const uploadTitle = this.closest('.upload-section').querySelector('.upload-title').textContent.trim();
                const fieldName = uploadMapping[uploadTitle];
                
                // Create file input with proper name attribute
                const input = document.createElement('input');
                input.type = 'file';
                input.name = fieldName;  // CRITICAL: Add name attribute
                input.accept = '.pdf,.doc,.docx,.png,.jpg,.jpeg';
                input.style.display = 'none';
                
                input.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        const fileName = e.target.files[0].name;
                        const originalText = btn.querySelector('b').textContent;
                        const cancelBtn = btn.parentElement.querySelector('.cancel-btn');
                        
                        btn.innerHTML = `
                            <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                            <b>${fileName}</b>
                        `;
                        btn.classList.add('file-selected');
                        btn.style.cursor = 'default';
                        cancelBtn.style.display = 'flex';
                        
                        // Store metadata for reset
                        btn.setAttribute('data-original', originalText);
                        btn.setAttribute('data-field', fieldName);
                        
                        // CRITICAL: Add the file input to the form
                        const form = document.querySelector('form');
                        // Remove existing input if re-uploading
                        const existingInput = form.querySelector(`input[name="${fieldName}"]`);
                        if (existingInput && existingInput !== input) {
                            existingInput.remove();
                        }
                        form.appendChild(input);
                    }
                });
                
                input.click();
            });
        });

        // Cancel file function
        function cancelFile(cancelBtn) {
            const uploadContainer = cancelBtn.closest('.upload-container');
            const uploadBtn = uploadContainer.querySelector('.upload-btn');
            const originalText = uploadBtn.getAttribute('data-original');
            const fieldName = uploadBtn.getAttribute('data-field');
            
            uploadBtn.innerHTML = `
                <img src="{{ asset('image/upload.png') }}" alt="Upload Icon" class="upload-icon">
                <b>${originalText}</b>
            `;
            uploadBtn.classList.remove('file-selected');
            uploadBtn.style.cursor = 'pointer';
            uploadBtn.removeAttribute('data-original');
            uploadBtn.removeAttribute('data-field');
            cancelBtn.style.display = 'none';
            
            // CRITICAL: Remove the file input from the form
            const form = document.querySelector('form');
            const existingInput = form.querySelector(`input[name="${fieldName}"]`);
            if (existingInput) {
                existingInput.remove();
            }
        }

        // Handle Edit Profile button (for profile_picture)
        document.querySelectorAll('.btn-edit')[0].addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'profile_picture';  // CRITICAL: Add name attribute
            input.accept = 'image/*';
            input.style.display = 'none';
            
            input.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const profileAvatar = document.querySelector('.profile-avatar');
                        profileAvatar.innerHTML = `<img src="${e.target.result}" alt="Profile Picture">`;
                    };
                    
                    reader.readAsDataURL(file);
                    
                    // CRITICAL: Add the file input to the form
                    const form = document.querySelector('form');
                    const existingInput = form.querySelector('input[name="profile_picture"]');
                    if (existingInput && existingInput !== input) {
                        existingInput.remove();
                    }
                    form.appendChild(input);
                }
            });
            
            input.click();
        });

        // Handle Edit Banner button (for banner_image)
        document.querySelectorAll('.btn-edit')[1].addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'banner_image';  // CRITICAL: Add name attribute
            input.accept = 'image/*';
            input.style.display = 'none';
            
            input.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const profileHeader = document.querySelector('.profile-header');
                        profileHeader.style.backgroundImage = `url(${e.target.result})`;
                        profileHeader.style.backgroundSize = 'cover';
                        profileHeader.style.backgroundPosition = 'center';
                        profileHeader.style.backgroundRepeat = 'no-repeat';
                    };
                    
                    reader.readAsDataURL(file);
                    
                    // CRITICAL: Add the file input to the form
                    const form = document.querySelector('form');
                    const existingInput = form.querySelector('input[name="banner_image"]');
                    if (existingInput && existingInput !== input) {
                        existingInput.remove();
                    }
                    form.appendChild(input);
                }
            });
            
            input.click();
        });

        // Handle sidebar navigation
        document.querySelectorAll('.sidebar-icon').forEach(icon => {
            icon.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') {
                    e.preventDefault();
                }
                document.querySelectorAll('.sidebar-icon').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>

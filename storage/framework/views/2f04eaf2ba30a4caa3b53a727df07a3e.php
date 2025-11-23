<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Edit</title>
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
            background-image: url("<?php echo e(asset('image/defaultbanner.png')); ?>");
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
            <img src="<?php echo e(asset('image/logo.png')); ?>" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="<?php echo e(route('AdminDashboard')); ?>" class="sidebar-icon" data-page="home">
            <img src="<?php echo e(asset('image/home.png')); ?>" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminUserDatabase')); ?>" class="sidebar-icon active" data-page="users">
            <img src="<?php echo e(asset('image/users.png')); ?>" alt="Users" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminJobDatabase')); ?>" class="sidebar-icon" data-page="jobs">
            <img src="<?php echo e(asset('image/jobs.png')); ?>" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminEventDatabase')); ?>" class="sidebar-icon" data-page="events">
            <img src="<?php echo e(asset('image/events.png')); ?>" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="<?php echo e(route('AdminCompanyDatabase')); ?>" class="sidebar-icon" data-page="companies">
            <img src="<?php echo e(asset('image/company.png')); ?>" alt="Companies" class="sidebar-icon-img">
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
                <form action="<?php echo e(route('adminuseredit.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Hidden file inputs -->
                    <input type="file" id="profile-upload" name="profile_picture" accept="image/*" style="display: none;">
                    <input type="file" id="banner-upload" name="banner_image" accept="image/*" style="display: none;">
                    
                    <!-- Profile Header -->
                    <div class="profile-header" style="background-image: url('<?php echo e(optional($user->registeredProfile)->banner_image ? asset('storage/' . $user->registeredProfile->banner_image) : asset('image/defaultbanner.png')); ?>');">
                        <div class="profile-buttons">
                            <button type="button" class="btn-edit" onclick="document.getElementById('profile-upload').click()">Edit Profile</button>
                            <button type="button" class="btn-edit" onclick="document.getElementById('banner-upload').click()">Edit Banner</button>
                        </div>
                        <div class="profile-avatar">
                            <?php if(optional($user->registeredProfile)->profile_picture): ?>
                                <img src="<?php echo e(asset('storage/' . $user->registeredProfile->profile_picture)); ?>" alt="Profile Picture">
                            <?php else: ?>
                                <svg width="60" height="60" fill="#9ca3af" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            <?php endif; ?>
                        </div>
                    </div>

                <div class="form-card">
                    <!-- Personal Information Section -->
                    <h2 class="section-title">Personal Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label><b>First name</b></label>
                            <input type="text" name="first_name" value="<?php echo e($user->first_name); ?>" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label><b>Last name</b></label>
                            <input type="text" name="last_name" value="<?php echo e($user->last_name); ?>" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group">
                            <label><b>Email</b></label>
                            <input type="email" name="email" value="<?php echo e($user->email); ?>" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label><b>Mobile Number</b></label>
                            <input type="tel" name="phone_number" value="<?php echo e($user->phone_number); ?>" placeholder="Enter your mobile number" required>
                        </div>
                        <div class="form-group">
                            <label><b>Date of Birth</b></label>
                            <input type="date" name="date_of_birth" value="<?php echo e(optional($user->registeredProfile)->date_of_birth ? \Carbon\Carbon::parse($user->registeredProfile->date_of_birth)->format('Y-m-d') : ''); ?>" placeholder="Select your date of birth" required>
                        </div>
                        <div class="form-group">
                            <label><b>Gender</b></label>
                            <select name="gender">
                                <option value="" disabled <?php echo e(!optional($user->registeredProfile)->gender ? 'selected' : ''); ?>>Select your gender</option>
                                <option value="male" <?php echo e(optional($user->registeredProfile)->gender == 'male' ? 'selected' : ''); ?>>Male</option>
                                <option value="female" <?php echo e(optional($user->registeredProfile)->gender == 'female' ? 'selected' : ''); ?>>Female</option>
                                <option value="other" <?php echo e(optional($user->registeredProfile)->gender == 'other' ? 'selected' : ''); ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Location</b></label>
                            <input type="text" name="location" value="<?php echo e(optional($user->registeredProfile)->location); ?>" placeholder="Enter your location" required>
                        </div>
                        <div class="form-group">
                            <label><b>Postal Code</b></label>
                            <input type="text" name="postal_code" value="<?php echo e(optional($user->registeredProfile)->postal_code); ?>" placeholder="Enter your postal code" required>
                        </div>
                        <div class="form-group">
                            <label><b>Password</b></label>
                            <input type="password" name="password" placeholder="Leave blank to keep current password">
                            <small style="color: #666; font-size: 12px;">Enter new password only if you want to change it</small>
                        </div>
                    </div>

                    <!-- Professional Information Section -->
                    <h2 class="section-title">Professional Information</h2>
                    
                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Resume</h3>
                        <div class="upload-container">
                            <?php if(optional($user->registeredProfile)->resume_path): ?>
                                <a href="<?php echo e(asset('storage/' . $user->registeredProfile->resume_path)); ?>" target="_blank" class="upload-btn file-selected" style="text-decoration: none;">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="Resume Icon" class="upload-icon">
                                    <b><?php echo e(basename($user->registeredProfile->resume_path)); ?></b>
                                </a>
                                <button type="button" class="cancel-btn" style="display: flex;" onclick="deleteFile(this, 'resume')">×</button>
                            <?php else: ?>
                                <button type="button" class="upload-btn" data-file-type="resume">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="Resume Icon" class="upload-icon">
                                    <b>Upload Resume</b>
                                </button>
                                <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Curriculum Vitae</h3>
                        <div class="upload-container">
                            <?php if(optional($user->registeredProfile)->cv_path): ?>
                                <a href="<?php echo e(asset('storage/' . $user->registeredProfile->cv_path)); ?>" target="_blank" class="upload-btn file-selected" style="text-decoration: none;">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="CV Icon" class="upload-icon">
                                    <b><?php echo e(basename($user->registeredProfile->cv_path)); ?></b>
                                </a>
                                <button type="button" class="cancel-btn" style="display: flex;" onclick="deleteFile(this, 'cv')">×</button>
                            <?php else: ?>
                                <button type="button" class="upload-btn" data-file-type="cv">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="CV Icon" class="upload-icon">
                                    <b>Upload CV</b>
                                </button>
                                <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="upload-section">
                        <h3 class="upload-title">Upload Your Portfolio</h3>
                        <div class="upload-container">
                            <?php if(optional($user->registeredProfile)->portfolio_path): ?>
                                <a href="<?php echo e(asset('storage/' . $user->registeredProfile->portfolio_path)); ?>" target="_blank" class="upload-btn file-selected" style="text-decoration: none;">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="Portfolio Icon" class="upload-icon">
                                    <b><?php echo e(basename($user->registeredProfile->portfolio_path)); ?></b>
                                </a>
                                <button type="button" class="cancel-btn" style="display: flex;" onclick="deleteFile(this, 'portfolio')">×</button>
                            <?php else: ?>
                                <button type="button" class="upload-btn" data-file-type="portfolio">
                                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="Portfolio Icon" class="upload-icon">
                                    <b>Upload Portfolio</b>
                                </button>
                                <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="save-btn">Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Function to handle file deletion
        function deleteFile(button, fileType) {
            const uploadContainer = button.closest('.upload-container');
            const link = uploadContainer.querySelector('.upload-btn');
            
            // Create hidden input to mark file for deletion
            const form = document.querySelector('form');
            let deleteInput = form.querySelector(`input[name="delete_${fileType}"]`);
            if (!deleteInput) {
                deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = `delete_${fileType}`;
                deleteInput.value = '1';
                form.appendChild(deleteInput);
            }
            
            // Replace link with upload button
            uploadContainer.innerHTML = `
                <button type="button" class="upload-btn" data-file-type="${fileType}">
                    <img src="<?php echo e(asset('image/upload.png')); ?>" alt="Upload Icon" class="upload-icon">
                    <b>Upload ${fileType.charAt(0).toUpperCase() + fileType.slice(1)}</b>
                </button>
                <button type="button" class="cancel-btn" style="display: none;" onclick="cancelFile(this)">×</button>
            `;
        }

        // Handle profile picture upload preview
        document.getElementById('profile-upload').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const profileAvatar = document.querySelector('.profile-avatar');
                    profileAvatar.innerHTML = `<img src="${e.target.result}" alt="Profile Picture">`;
                };
                
                reader.readAsDataURL(file);
            }
        });

        // Handle banner upload preview
        document.getElementById('banner-upload').addEventListener('change', function(e) {
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
            }
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
<?php /**PATH C:\laragon\www\Close_Call\resources\views/admin/adminUserEdit.blade.php ENDPATH**/ ?>
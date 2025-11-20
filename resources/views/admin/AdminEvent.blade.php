<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CloseCall</title>
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
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            margin-left: 30px;
            overflow: hidden;
            animation: slideInSoft 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .profile-header {
            background-image: url("{{ asset('image/defaultbanner.png') }}");
            border-radius: 20px 20px 0 0;
            padding: 2rem;
            margin: -2rem -2rem 2rem -2rem;
            position: relative;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: floatIn 0.9s ease-out 0.05s both;
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
            margin-top: 0;
        }
        .add-job-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            border: 2px solid #111;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            animation: slideInSoft 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.1s both;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        .form-group input, .form-group select, .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #00A88F;
        }
        .save-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 0.9rem 2.5rem;
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
        <a href="{{ route('profile') }}" class="sidebar-icon active" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
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
                <div class="profile-header">
                    <div class="profile-buttons">
                        <button class="btn-edit">Edit Banner</button>
                    </div>
                </div>

                <div class="add-job-card">
                    <!-- Add Event Section -->
                    <h2 class="section-title">Add Event</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label><b>Event Name</b></label>
                            <input type="text" placeholder="Event">
                        </div>
                        <div class="form-group">
                            <label><b>Starting Date</b></label>
                            <input type="date">
                        </div>
                        <div class="form-group">
                            <label><b>Location</b></label>
                            <input type="text" placeholder="Jl. Location">
                        </div>
                        <div class="form-group">
                            <label><b>Attendees</b></label>
                            <input type="number" placeholder="0" min="0">
                        </div>
                        <div class="form-group full-width">
                            <label><b>About</b></label>
                            <textarea rows="3" placeholder="It is amazing."></textarea>
                        </div>
                    </div>
                </div>

                <button class="save-btn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Handle save button
        document.querySelector('.save-btn').addEventListener('click', function() {
            this.textContent = 'Adding...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = 'Added!';
                this.style.background = '#10b981';
                
                setTimeout(() => {
                    this.textContent = 'Add';
                    this.disabled = false;
                    this.style.background = '#00A88F';
                }, 2000);
            }, 1500);
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

        // Handle Edit Banner button
        document.querySelector('.btn-edit').addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            
            input.addEventListener('change', function(e) {
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
            
            input.click();
        });

    </script>
</body>
</html>


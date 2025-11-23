<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - EventAdd</title>
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
        <a href="{{ route('AdminDashboard') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminUserDatabase') }}" class="sidebar-icon" data-page="users">
            <img src="{{ asset('image/users.png') }}" alt="Users" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminJobDatabase') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AdminEventDatabase') }}" class="sidebar-icon active" data-page="events">
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
                <div class="profile-header">
                    <div class="profile-buttons">
                        <button class="btn-edit">Edit Banner</button>
                    </div>
                </div>

                <form action="{{ route('admineventadd.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="add-job-card">
                    <!-- Add Event Section -->
                    <h2 class="section-title">Add Event</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label><b>Event Name</b></label>
                            <input type="text" name="event_name" placeholder="Event" required>
                        </div>
                        <div class="form-group">
                            <label><b>Starting Date</b></label>
                            <input type="date" name="starting_date" required>
                        </div>
                        <div class="form-group">
                            <label><b>Location</b></label>
                            <input type="text" name="location" placeholder="Jl. Location" required>
                        </div>
                        <div class="form-group">
                            <label><b>Attendees</b></label>
                            <input type="number" name="attendees" placeholder="0" min="0" required>
                        </div>
                        <div class="form-group full-width">
                            <label><b>About</b></label>
                            <textarea name="about" rows="3" placeholder="It is amazing." required></textarea>
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

        // Removed save button handler to allow normal form submission

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

        // Handle Edit Banner button (for banner_image)
        document.querySelector('.btn-edit').addEventListener('click', function() {
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


    </script>
</body>
</html>


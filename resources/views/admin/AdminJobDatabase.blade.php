<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Job Database</title>
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
            margin-left: 109px;
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
            padding: 10px;
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
        .save-btn:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
        /* Date Input Styling */
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
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
        <a href="{{ route('AdminJobDatabase') }}" class="sidebar-icon active" data-page="jobs">
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

        <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-black">Job Database</h1>
                    <p class="text-gray-500 mt-1">Manage your jobs.</p>
                </div>
                <a href="{{ route('adminjobadd') }}" class="bg-[#00A88F] hover:bg-[#008f7a] text-white px-6 py-2.5 rounded-full font-medium transition-colors inline-block">
                    Add Job
                </a>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">

                <div class="mb-4">
                    <button class="hover:opacity-90 transition-opacity">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-[43px] h-[43px]">
                    </button>
                </div>

                <!-- Filters -->
                <div class="mb-6 flex flex-wrap items-center gap-4">
                
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-200 rounded-lg px-4 py-2.5 pr-10 text-[#00A49C] focus:outline-none focus:border-[#00A88F] min-w-[140px]">
                        <option>Location</option>
                        <option>Indonesia</option>
                        <option>USA</option>
                    </select>
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#00A49C]">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" placeholder="Start Date" onfocus="(this.type='date')" onblur="(if(!this.value)this.type='text')" onclick="this.showPicker()" onkeydown="return false" class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-600 focus:outline-none focus:border-[#00A88F] w-[140px] cursor-pointer relative z-10">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 z-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                    </div>
                    <span class="text-gray-400">→</span>
                    <div class="relative">
                        <input type="text" placeholder="End Date" onfocus="(this.type='date')" onblur="(if(!this.value)this.type='text')" onclick="this.showPicker()" onkeydown="return false" class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-600 focus:outline-none focus:border-[#00A88F] w-[140px] cursor-pointer relative z-10">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 z-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                    </div>
                </div>

                <div class="relative max-w-md">
                    <input type="text" placeholder="Search..." class="w-full bg-white border border-gray-200 rounded-lg pl-10 pr-4 py-2.5 text-gray-600 focus:outline-none focus:border-[#00A88F]">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </div>
            </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Job Name</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Tag 1</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Tag 2</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Tag 3</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Tag 4</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Added</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Edit</th>
                            <th class="p-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($jobs as $job)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-sm font-medium text-gray-900">{{ $job->job_name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->category }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->company }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->location }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ Str::limit($job->description, 50) }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->tag_1 ?? 'N/A' }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->tag_2 ?? 'N/A' }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->tag_3 ?? 'N/A' }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->tag_4 ?? 'N/A' }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $job->created_at->format('m/d/Y') }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('adminjobedit', $job->id) }}" class="w-8 h-8 rounded-full bg-teal-50 text-[#00A88F] flex items-center justify-center hover:bg-teal-100 transition-colors inline-flex">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('adminjobdelete', $job->id) }}" method="POST" style="display: inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-100 transition-colors inline-flex">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <script>
        // Handle delete button clicks
        document.querySelectorAll('button.bg-red-50').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this job?')) {
                    // Get the table row
                    const row = this.closest('tr');
                    // Add fade out animation
                    row.style.transition = 'opacity 0.3s';
                    row.style.opacity = '0';
                    // Remove the row after animation
                    setTimeout(() => {
                        row.remove();
                    }, 300);
                }
            });
        });
    </script>
</body>
</html>

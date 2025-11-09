<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Database - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            padding: 2rem 0;
            z-index: 1000;
        }
        
        .sidebar-logo {
            padding: 0 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-logo img {
            width: 40px;
            height: 40px;
        }
        
        .sidebar-title {
            font-size: 24px;
            font-weight: 700;
            color: #00A88F;
        }
        
        .sidebar-menu {
            flex: 1;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 2rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover,
        .menu-item.active {
            background: #f0fdf4;
            color: #00A88F;
            border-left-color: #00A88F;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background: #f9fafb;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        td {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
            color: #6b7280;
        }
        
        tr:hover {
            background: #f9fafb;
        }
        
        .delete-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .delete-btn:hover {
            background: #dc2626;
        }
        
        .add-btn {
            background: #00A88F;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        
        .add-btn:hover {
            background: #008B7A;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall">
            <span class="sidebar-title">CloseCall</span>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <span>📊</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="menu-item">
                <span>👥</span>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.jobs') }}" class="menu-item">
                <span>💼</span>
                <span>Jobs</span>
            </a>
            <a href="{{ route('admin.events') }}" class="menu-item active">
                <span>📅</span>
                <span>Events</span>
            </a>
            <a href="{{ route('admin.companies') }}" class="menu-item">
                <span>🏢</span>
                <span>Companies</span>
            </a>
        </div>
        
        <div style="padding: 0 2rem; border-top: 1px solid #e5e7eb; padding-top: 1rem;">
            <a href="{{ route('profile') }}" class="menu-item">
                <span>👤</span>
                <span>Back to Profile</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div style="background: white; padding: 1.5rem 2rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="font-size: 28px; font-weight: 700; color: #1f2937; margin: 0;">Events Database</h1>
                <p style="color: #6b7280; margin: 0.5rem 0 0 0;">Manage all events</p>
            </div>
            <a href="{{ route('events.create') }}" class="add-btn">+ Add New Event</a>
        </div>
        
        @if(session('success'))
            <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
                ✓ {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background: #ef4444; color: white; padding: 12px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
                ✗ {{ session('error') }}
            </div>
        @endif
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Creator</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Attendees</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td style="font-weight: 600; color: #1f2937;">#{{ $event->id }}</td>
                            <td style="color: #1f2937; font-weight: 500;">{{ $event->title }}</td>
                            <td>{{ $event->creator ? $event->creator->full_name : 'Unknown' }}</td>
                            <td>{{ $event->event_date->format('M d, Y') }} {{ $event->event_time->format('g:i A') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->attendees_count }}</td>
                            <td>
                                @if($event->status === 'published')
                                    <span style="padding: 4px 12px; background: #dcfce7; color: #00A88F; border-radius: 12px; font-size: 12px; font-weight: 600;">Published</span>
                                @else
                                    <span style="padding: 4px 12px; background: #f3f4f6; color: #6b7280; border-radius: 12px; font-size: 12px; font-weight: 600;">{{ ucfirst($event->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('events.view', $event->id) }}" style="padding: 6px 12px; background: #00A88F; color: white; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600;">View</a>
                                    <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem; color: #9ca3af;">
                                No events found. <a href="{{ route('events.create') }}" style="color: #00A88F; font-weight: 600;">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="margin-top: 2rem;">
            {{ $events->links() }}
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        
        /* Header styles from jobs.blade.php */
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
            transition: all 0.3s ease;
        }
        
        .header:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
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
        
        
        
        /* Sidebar styles from jobs.blade.php */
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
        
        /* Mobile Responsive for Header */
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
            
        }
        
        @media (max-width: 480px) {
            .header {
                padding-left: 120px;
            }
            
            .search-bar {
                max-width: 280px;
            }
        }

        /* Events Content Styles */
        .events-content {
            padding: 40px 60px;
        }

        .events-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 30px 0;
        }

        .events-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 16px 0;
        }

        .no-events-message {
            font-size: 16px;
            color: #000000;
            margin: 0 0 24px 0;
        }

        .create-event-btn {
            background: #00A49C;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .create-event-btn:hover {
            background: #008b6b;
        }

        /* Recommended Events Section */
        .recommended-section {
            margin-top: 40px;
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .recommended-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 20px 0;
        }

        .events-scroll-container {
            display: flex;
            gap: 20px;
            padding-bottom: 10px;
            width: 100%;
            justify-content: space-between;
        }


        .event-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 320px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            height: 400px;
        }

        .event-banner {
            width: 100%;
            height: 193px;
            background: #f3f4f6;
    display: flex;
    align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 14px;
        }

        .event-details {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .event-date {
            font-size: 12px;
            color: #000000;
            margin: 0 0 8px 0;
        }

        .event-name {
            font-size: 16px;
            font-weight: 700;
            color: #000000;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .event-location {
            font-size: 14px;
            color: #6b7280;
            margin: 0 0 16px 0;
        }

        .event-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .view-btn {
            background: #00A49C;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            width: 260px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .view-btn:hover {
            background: #008b7a;
        }

        .share-btn {
            background: #00A49C;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 6px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .share-btn:hover {
            background: #008b7a;
        }

        .see-all-link {
            color: #00A49C;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-top: 16px;
            display: inline-block;
        }

        .see-all-link:hover {
            text-decoration: underline;
        }

        /* Calendar Section */
        .calendar-section {
            margin-top: 40px;
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .calendar-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 8px 0;
        }

        .calendar-month {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 24px 0;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }

        .calendar-day-header {
            background: #f9fafb;
            padding: 20px 16px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
            border-right: 1px dashed #9ca3af;
        }

        .calendar-day-header:last-child {
            border-right: none;
        }

        .calendar-day {
            background: white;
            padding: 20px 16px;
            text-align: center;
            font-size: 18px;
            color: #00A49C;
            font-weight: 500;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            border-right: 1px dashed #9ca3af;
            border-bottom: 1px dashed #9ca3af;
            position: relative;
        }

        .calendar-day:nth-child(7n) {
            border-right: none;
        }

        .calendar-day.has-event {
            background: #dbeafe;
        }

        .calendar-day.has-event .day-number {
            color: #00A49C;
            font-weight: 600;
        }

        .event-text {
            font-size: 14px;
            color: #1e40af;
            margin-top: 8px;
            line-height: 1.3;
            text-align: center;
            font-weight: 500;
        }

        .day-number {
            font-size: 20px;
            font-weight: 600;
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

        <!-- Events Content -->
        <div class="events-content">
            <h1 class="events-title">Events</h1>
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div style="background: #10b981; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    ✓ {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div style="background: #ef4444; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    ✗ {{ session('error') }}
                </div>
            @endif
            
            @if(session('info'))
                <div style="background: #3b82f6; color: white; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
                    ℹ {{ session('info') }}
                </div>
            @endif
            
            <div class="events-card">
                <h2 class="card-title">My events</h2>
                @if(isset($myEvents) && $myEvents->count() > 0)
                    <div style="margin-bottom: 20px;">
                        @foreach($myEvents as $event)
                            <div style="padding: 12px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 style="margin: 0 0 4px 0; font-weight: 600;">{{ $event->title }}</h4>
                                    <p style="margin: 0; font-size: 14px; color: #6b7280;">{{ $event->formatted_date_time }}</p>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('events.view', $event->id) }}" style="text-decoration: none;">
                                        <button class="view-btn" style="padding: 6px 16px; width: auto;">View</button>
                                    </a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="view-btn" style="padding: 6px 16px; width: auto; background: #dc2626;">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="no-events-message">No events, create a new one.</p>
                @endif
                <a href="{{ route('events.create') }}">
                    <button class="create-event-btn">Create a new event</button>
                </a>
            </div>

            <!-- Recommended Events Section -->
            <div class="recommended-section">
                <h2 class="recommended-title">Recommended events</h2>
                
                <div class="events-scroll-container">
                    <!-- Event Card 1 -->
                    <div class="event-card">
                        <div class="event-banner">
                            <img src="{{ asset('image/event1.png') }}" alt="JCI Poland National Convention" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="event-details">
                            <p class="event-date">Sat, 06 Sep 2025, 1:00 AM</p>
                            <h3 class="event-name">JCI Poland National Online Convention 2025</h3>
                            <p class="event-location">Poland | 120 Attendees</p>
                            <div class="event-actions">
                                <a href="{{ route('events.view', 1) }}">
                                    <button class="view-btn">View</button>
                                </a>
                                <button class="share-btn">
                                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Event Card 2 -->
                    <div class="event-card">
                        <div class="event-banner">
                            <img src="{{ asset('image/event2.png') }}" alt="No Matter What Foundation 5K Run/Walk" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="event-details">
                            <p class="event-date">Sun, 07 Sep 2025, 8:00 AM</p>
                            <h3 class="event-name">No Matter What Foundation 5K Run/Walk</h3>
                            <p class="event-location">East Islip | 85 Attendees</p>
                            <div class="event-actions">
                                <a href="{{ route('events.view', 2) }}">
                                    <button class="view-btn">View</button>
                                </a>
                                <button class="share-btn">
                                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Event Card 3 -->
                    <div class="event-card">
                        <div class="event-banner">
                            <img src="{{ asset('image/event3.png') }}" alt="6th Congress on Intelligent Systems" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="event-details">
                            <p class="event-date">Mon, 08 Sep 2025, 9:00 AM</p>
                            <h3 class="event-name">6th Congress on Intelligent Systems 2025</h3>
                            <p class="event-location">Hybrid | 200 Attendees</p>
                            <div class="event-actions">
                                <a href="{{ route('events.view', 3) }}">
                                    <button class="view-btn">View</button>
                                </a>
                                <button class="share-btn">
                                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Event Card 4 -->
                    <div class="event-card">
                        <div class="event-banner">
                            <img src="{{ asset('image/event4.png') }}" alt="The NGO Whisperer Masterclass" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="event-details">
                            <p class="event-date">Tue, 09 Sep 2025, 2:00 PM</p>
                            <h3 class="event-name">The NGO Whisperer Masterclass</h3>
                            <p class="event-location">Virtual | 45 Attendees</p>
                            <div class="event-actions">
                                <a href="{{ route('events.view', 4) }}">
                                    <button class="view-btn">View</button>
                                </a>
                                <button class="share-btn">
                                    <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="see-all-link">See all</a>
            </div>

            <!-- Calendar Section -->
            <div class="calendar-section">
                <h2 class="calendar-title">Calendar</h2>
                <h3 class="calendar-month">AUGUST 2025</h3>
                
                <div class="calendar-grid">
                    <!-- Day Headers -->
                    <div class="calendar-day-header">M</div>
                    <div class="calendar-day-header">T</div>
                    <div class="calendar-day-header">W</div>
                    <div class="calendar-day-header">T</div>
                    <div class="calendar-day-header">F</div>
                    <div class="calendar-day-header">S</div>
                    <div class="calendar-day-header">S</div>
                    
                    <!-- Empty cells for July dates (since Aug 1 starts on Wednesday) -->
                    <div class="calendar-day"></div>
                    <div class="calendar-day"></div>
                    
                    <!-- Calendar Days starting from Wednesday Aug 1 -->
                    <div class="calendar-day">
                        <span class="day-number">01</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">02</span>
                    </div>
                    <div class="calendar-day has-event">
                        <span class="day-number">03</span>
                        <div class="event-text">Aviation case study</div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">04</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">05</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">06</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">07</span>
                    </div>
                    <div class="calendar-day has-event">
                        <span class="day-number">08</span>
                        <div class="event-text">Voyager Emissions Dashboard</div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">09</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">10</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">11</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">12</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">13</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">14</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">15</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">16</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">17</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">18</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">19</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">20</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">21</span>
                    </div>
                    <div class="calendar-day has-event">
                        <span class="day-number">22</span>
                        <div class="event-text">?</div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">23</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">24</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">25</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">26</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">27</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">28</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">29</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">30</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">31</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
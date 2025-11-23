<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $query }} - Search Results | CloseCall</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }
        
        .search-result {
            background: white;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 12px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .search-result:hover {
            box-shadow: 0 2px 8px rgba(0, 168, 143, 0.15);
            border-left: 3px solid #00A88F;
            transform: translateX(4px);
        }
        
        .result-title {
            color: #1a0dab;
            font-size: 20px;
            font-weight: 400;
            margin-bottom: 4px;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }
        
        .result-title:hover {
            text-decoration: underline;
        }
        
        .result-url {
            color: #006621;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .result-description {
            color: #545454;
            font-size: 14px;
            line-height: 1.58;
        }
        
        .highlight {
            font-weight: 600;
            color: #00A88F;
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
    <!-- Sidebar -->
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
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Content -->
    <div style="margin-left: 129px; padding: 40px 60px; max-width: 800px;">
        <!-- Search Header -->
        <div style="margin-bottom: 40px;">
            <div style="display: flex; align-items: center; gap: 24px; margin-bottom: 24px;">
                <a href="{{ route('landing-page') }}" style="text-decoration: none;">
                    <img src="{{ asset('image/logo.png') }}" alt="CloseCall" style="height: 40px;">
                </a>
                <form action="{{ route('search') }}" method="GET" style="flex: 1; max-width: 600px;">
                    <div style="display: flex; align-items: center; background: white; border-radius: 24px; padding: 12px 20px; border: 1px solid #dfe1e5; box-shadow: 0 1px 6px rgba(32,33,36,.28);">
                        <svg width="20" height="20" fill="#9aa0a6" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <input type="text" name="q" value="{{ $query }}" placeholder="Search CloseCall..." 
                               style="border: none; outline: none; flex: 1; margin-left: 12px; font-size: 16px;">
                    </div>
                </form>
            </div>
            
            @if($query)
            <div style="color: #70757a; font-size: 14px;">
                About {{ count($results) }} results for <strong style="color: #202124;">{{ $query }}</strong>
            </div>
            @endif
        </div>

        <!-- Search Results -->
        @if(count($results) > 0)
            @foreach($results as $result)
            <div class="search-result">
                <div class="result-url">🔗 {{ $result['link_text'] }}</div>
                <a href="{{ $result['url'] }}" class="result-title">
                    {{ $result['title'] }}
                </a>
                <div class="result-description">
                    {!! str_replace($query, '<span class="highlight">' . $query . '</span>', $result['description']) !!}
                </div>
            </div>
            @endforeach
        @elseif($query)
            <div style="text-align: center; padding: 60px 20px;">
                <svg width="64" height="64" fill="#dadce0" viewBox="0 0 24 24" style="margin: 0 auto 24px;">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <h2 style="font-size: 20px; color: #202124; margin-bottom: 12px;">No results found for "{{ $query }}"</h2>
                <p style="color: #70757a; font-size: 14px;">Try different keywords or check your spelling</p>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px;">
                <svg width="64" height="64" fill="#00A88F" viewBox="0 0 24 24" style="margin: 0 auto 24px;">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <h2 style="font-size: 20px; color: #202124; margin-bottom: 12px;">Search CloseCall</h2>
                <p style="color: #70757a; font-size: 14px;">Find companies, jobs, and events</p>
            </div>
        @endif
    </div>
</body>
</html>

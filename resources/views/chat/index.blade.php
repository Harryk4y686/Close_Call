<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            width: 80px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem 0;
            z-index: 1000;
        }
        .sidebar-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.2s;
            color: #6b7280;
        }
        .sidebar-icon:hover {
            background-color: #f3f4f6;
        }
        .sidebar-icon.active {
            background-color: #3b82f6;
            color: white;
        }
        .main-content {
            margin-left: 80px;
            height: 100vh;
            display: flex;
        }
        .chat-sidebar {
            width: 320px;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
        }
        .chat-main {
            flex: 1;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
        }
        .chat-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }
        .chat-search {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .chat-list {
            flex: 1;
            overflow-y: auto;
        }
        .chat-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .chat-item:hover {
            background-color: #f8fafc;
        }
        .chat-item.active {
            background-color: #dbeafe;
        }
    </style>
</head>
<body>
    <!-- Left Navigation Sidebar -->
    <div class="sidebar">
        <div class="sidebar-icon" onclick="window.location.href='{{ route('landing-page') }}'">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        
        <div class="sidebar-icon" onclick="window.location.href='{{ route('profile') }}'">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        
        <div class="sidebar-icon" onclick="window.location.href='{{ route('jobs') }}'">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6"></path>
            </svg>
        </div>
        
        <div class="sidebar-icon active">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </div>
        
        <div class="sidebar-icon" onclick="window.location.href='{{ route('AI') }}'">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Chat Sidebar -->
        <div class="chat-sidebar">
            <!-- Header -->
            <div class="chat-header">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-gray-900">Chats</h1>
                    <button id="newChatBtn" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Search -->
            <div class="chat-search">
                <div class="relative">
                    <input type="text" placeholder="Search..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Chat List -->
            <div class="chat-list">
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Today</div>
                
                <!-- CloseCall AI Chat (Always visible) -->
                <div class="chat-item active" onclick="selectAIChat()">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">C</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">CloseCall AI</h3>
                                <span class="text-xs text-gray-500">09:26</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Review my r...</p>
                        </div>
                    </div>
                </div>

                <!-- Sample Chat Items -->
                <div class="chat-item" onclick="selectChat('how-to-make')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">H</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">How to mak...</h3>
                                <span class="text-xs text-gray-500">10:23</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">How to make...</p>
                        </div>
                    </div>
                </div>

                <div class="chat-item" onclick="selectChat('give-yourself')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">G</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">Give yoursel...</h3>
                                <span class="text-xs text-gray-500">01:20</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Give yoursel...</p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Yesterday</div>
                
                <div class="chat-item" onclick="selectChat('recommend')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">R</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">Recommend...</h3>
                                <span class="text-xs text-gray-500">08:32</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Recommend...</p>
                        </div>
                    </div>
                </div>

                <div class="chat-item" onclick="selectChat('how-to-make-2')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">H</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">How to mak...</h3>
                                <span class="text-xs text-gray-500">09:15</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">How to mak...</p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mt-4">Previous</div>
                
                <div class="chat-item" onclick="selectChat('application')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">A</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">Application r...</h3>
                                <span class="text-xs text-gray-500">14:01</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Application r...</p>
                        </div>
                    </div>
                </div>

                <div class="chat-item" onclick="selectChat('how-to-join')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">H</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">How to join a...</h3>
                                <span class="text-xs text-gray-500">12:00</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">How to join a...</p>
                        </div>
                    </div>
                </div>

                <div class="chat-item" onclick="selectChat('how-to-chat')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">H</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">How to chat...</h3>
                                <span class="text-xs text-gray-500">13:55</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">How to chat...</p>
                        </div>
                    </div>
                </div>

                @if($chatPartners->count() > 0)
                    @foreach($chatPartners as $partner)
                        <div class="chat-item" onclick="openChat({{ $partner->id }})">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <img src="{{ $partner->profile_photo ? asset('storage/' . $partner->profile_photo) : 'https://via.placeholder.com/40x40/3b82f6/ffffff?text=' . strtoupper(substr($partner->name, 0, 1)) }}" 
                                         alt="{{ $partner->name }}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $partner->name }}</h3>
                                        <span class="text-xs text-gray-500">
                                            @if($partner->last_message_time)
                                                {{ \Carbon\Carbon::parse($partner->last_message_time)->format('H:i') }}
                                            @endif
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 truncate mt-1">Click to view conversation</p>
                                </div>
                                @if($partner->unread_count > 0)
                                    <div class="bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $partner->unread_count }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="chat-main">
            <!-- Chat Header -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">C</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">CloseCall AI</h2>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chat Messages Area -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4">
                <!-- AI Message -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">C</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg px-4 py-3 max-w-md">
                        <p class="text-gray-800 text-sm leading-relaxed">
                            <strong>Key Feedback (Short Points)</strong><br>
                            • Strong resume for a high school student – academic excellence, traditional projects, and creativity shine<br>
                            • Impressive GPA and test scores<br>
                            • Education: Summarize rankings instead of listing every single item<br>
                            • Projects: Use clear action verbs and avoid redundancy<br>
                            • Achievements: Focus on top awards, group smaller ones (e.g., "June 2025 – Present" looks futuristic)<br>
                            • Add a short career goal in the summary<br>
                            • Formatting: Consistent spacing and alignment<br>
                            • Experience descriptions with strong action verbs. A concise summary with a clear career goal and slightly better formatting will make this resume stand out. Quickly while still showcasing your strengths.
                        </p>
                    </div>
                </div>

                <!-- User Message -->
                <div class="flex items-end justify-end">
                    <div class="bg-teal-500 text-white rounded-lg px-4 py-3 max-w-md">
                        <p class="text-sm">Thanks</p>
                    </div>
                </div>

                <!-- AI Response -->
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">C</span>
                    </div>
                    <div class="bg-gray-100 rounded-lg px-4 py-3 max-w-md">
                        <p class="text-gray-800 text-sm">Happy to help!</p>
                    </div>
                </div>
            </div>

            <!-- Message Input Area -->
            <div class="bg-white border-t border-gray-200 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </button>
                    <div class="flex-1 relative">
                        <input type="text" 
                               placeholder="Write your message..." 
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>
                    <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </button>
                    <button class="bg-teal-500 hover:bg-teal-600 text-white p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- New Chat Modal -->
    <div id="newChatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Start New Chat</h3>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    
                    <div class="mb-4">
                        <input type="text" id="userSearch" placeholder="Search users..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div id="usersList" class="max-h-60 overflow-y-auto">
                        <!-- Users will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openChat(userId) {
            // Remove active class from all chat items
            $('.chat-item').removeClass('active');
            // Add active class to clicked item
            event.currentTarget.classList.add('active');
            // Navigate to chat
            window.location.href = `{{ route('chats.show', '') }}/${userId}`;
        }

        function selectAIChat() {
            // Remove active class from all chat items
            $('.chat-item').removeClass('active');
            // Add active class to clicked item
            event.currentTarget.classList.add('active');
            // AI chat is already displayed, no need to navigate
        }

        function selectChat(chatId) {
            // Remove active class from all chat items
            $('.chat-item').removeClass('active');
            // Add active class to clicked item
            event.currentTarget.classList.add('active');
            // For now, just show the AI chat interface
            // In a real implementation, you would load the specific chat
        }

        $(document).ready(function() {
            // Modal functionality
            $('#newChatBtn, #startChatBtn').click(function() {
                $('#newChatModal').removeClass('hidden');
                loadUsers();
            });

            $('#closeModal').click(function() {
                $('#newChatModal').addClass('hidden');
            });

            // Close modal when clicking outside
            $('#newChatModal').click(function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden');
                }
            });

            // Load users
            function loadUsers() {
                $.get('{{ route("users.list") }}', function(users) {
                    let html = '';
                    users.forEach(function(user) {
                        html += `
                            <div class="user-item p-3 hover:bg-gray-50 cursor-pointer rounded-lg" data-user-id="${user.id}">
                                <div class="flex items-center space-x-3">
                                    <img src="${user.profile_photo ? '/storage/' + user.profile_photo : 'https://via.placeholder.com/40x40/25d366/ffffff?text=' + user.name.charAt(0).toUpperCase()}" 
                                         alt="${user.name}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">${user.name}</h4>
                                        <p class="text-xs text-gray-500">${user.email}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#usersList').html(html);
                });
            }

            // User search
            $('#userSearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.user-item').each(function() {
                    const userName = $(this).find('h4').text().toLowerCase();
                    const userEmail = $(this).find('p').text().toLowerCase();
                    if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Start chat with user
            $(document).on('click', '.user-item', function() {
                const userId = $(this).data('user-id');
                openChat(userId);
            });
        });
    </script>
</body>
</html>

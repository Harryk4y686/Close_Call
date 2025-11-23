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
        .message-wrapper {
            position: relative;
            display: flex;
            align-items: start;
            gap: 0.5rem;
        }
        .message-wrapper.sent {
            justify-content: flex-end;
        }
        .delete-message-btn {
            opacity: 0;
            transition: opacity 0.2s;
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
            flex-shrink: 0;
        }
        .message-wrapper:hover .delete-message-btn {
            opacity: 1;
        }
        .delete-message-btn:hover {
            background: #dc2626;
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

        .main-content {
            margin-left: 100px;
            height: 90vh;
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
    <!-- Top -->
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
        <!-- Left Sidebar -->
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
        <a href="{{ route('chats') }}" class="sidebar-icon active" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
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
                    <input type="text" id="chatSearchInput" placeholder="Search..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Chat List -->
            <div class="chat-list" id="chatList">
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Today</div>
                
                <!-- New Chat (Default) -->
                <div class="chat-item active" data-chat-id="chat-1" onclick="selectNewChat('chat-1', 'New Chat')">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">N</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">New Chat</h3>
                                <span class="text-xs text-gray-500">Now</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Start a new conversation...</p>
                        </div>
                    </div>
                </div>

                <!-- End chat list -->
            </div> <!-- /.chat-list -->
        </div> <!-- /.chat-sidebar -->

        <!-- Chat Main (right panel) -->
        <div class="chat-main">
            <!-- Conversation Header -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <img id="chatAvatarImg" class="w-9 h-9 rounded-full object-cover hidden" alt="avatar">
                            <div id="chatAvatarInitial" class="w-9 h-9 rounded-full bg-teal-500 text-white flex items-center justify-center font-semibold">C</div>
                        </div>
                        <div>
                            <div id="chatTitle" class="font-semibold text-gray-900">New Chat</div>
                            <div class="text-xs text-gray-500" id="chatStatus">Ready to chat</div>
                        </div>
                    </div>
                    
                    <!-- Delete Button -->
                    <button id="deleteChatBtn" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </div>
            </div>

            <!-- Messages -->
            <div id="messages" class="flex-1 overflow-y-auto px-6 py-5 space-y-3">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center text-sm">N</div>
                    <div class="max-w-xl rounded-2xl bg-white shadow px-4 py-2 text-sm text-gray-700">Hi! Start a new conversation...</div>
                </div>
            </div>

            <!-- Input -->
            <div class="border-t bg-white px-4 py-3">
                <form id="chatForm" class="flex items-center gap-3">
                    <input type="hidden" id="receiverId" name="receiver_id" value="">
                    <input id="chatInput" type="text" placeholder="Write a message"
                           class="flex-1 rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <button id="sendBtn" type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg">Send</button>
                </form>
            </div>
        </div> <!-- /.chat-main -->
    </div> <!-- /.main-content -->

    <script>
        (function() {
            const messagesEl = document.getElementById('messages');
            const formEl = document.getElementById('chatForm');
            const inputEl = document.getElementById('chatInput');
            const titleEl = document.getElementById('chatTitle');
            const statusEl = document.getElementById('chatStatus');
            const avatarImg = document.getElementById('chatAvatarImg');
            const avatarInitial = document.getElementById('chatAvatarInitial');
            const receiverEl = document.getElementById('receiverId');
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const authId = @json(\Illuminate\Support\Facades\Auth::guard('pengguna')->check() ? \Illuminate\Support\Facades\Auth::guard('pengguna')->id() : \Illuminate\Support\Facades\Auth::guard('web')->id());

            function clearMessages(){ messagesEl.innerHTML = ''; }

            function appendMessage(text, sent = false, initial = 'C') {
                const wrapper = document.createElement('div');
                wrapper.className = sent ? 'message-wrapper sent' : 'message-wrapper';
                
                if (sent) {
                    const bubble = document.createElement('div');
                    bubble.className = 'max-w-xl rounded-2xl bg-teal-600 text-white px-4 py-2 text-sm';
                    bubble.textContent = text;
                    
                    const deleteBtn = document.createElement('button');
                    deleteBtn.className = 'delete-message-btn';
                    deleteBtn.innerHTML = '×';
                    deleteBtn.onclick = function() {
                        wrapper.remove();
                        // Remove from chat session
                        if (window.currentChatId && chatSessions[window.currentChatId]) {
                            const index = chatSessions[window.currentChatId].findIndex(m => m.text === text && m.sent === sent);
                            if (index > -1) {
                                chatSessions[window.currentChatId].splice(index, 1);
                                saveChatData();
                            }
                        }
                    };
                    
                    wrapper.appendChild(deleteBtn);
                    wrapper.appendChild(bubble);
                } else {
                    const avatar = document.createElement('div');
                    avatar.className = 'w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center text-sm';
                    avatar.textContent = (initial || 'C').slice(0,1).toUpperCase();
                    
                    const bubble = document.createElement('div');
                    bubble.className = 'max-w-xl rounded-2xl bg-white shadow px-4 py-2 text-sm text-gray-700';
                    bubble.textContent = text;
                    
                    // AI messages don't have delete buttons - they're protected
                    wrapper.appendChild(avatar);
                    wrapper.appendChild(bubble);
                }
                
                messagesEl.appendChild(wrapper);
                messagesEl.scrollTop = messagesEl.scrollHeight;
            }

            // Search functionality
            const searchInput = document.getElementById('chatSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    const chatItems = document.querySelectorAll('.chat-item');
                    
                    chatItems.forEach(item => {
                        const chatName = item.querySelector('h3')?.textContent.toLowerCase() || '';
                        if (chatName.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            function setHeader(name, avatarUrl, initial) {
                titleEl.textContent = name || 'Conversation';
                statusEl.textContent = 'Online';
                if (avatarUrl) {
                    avatarImg.src = avatarUrl;
                    avatarImg.classList.remove('hidden');
                    avatarInitial.classList.add('hidden');
                } else {
                    avatarImg.src = '';
                    avatarImg.classList.add('hidden');
                    avatarInitial.classList.remove('hidden');
                    avatarInitial.textContent = (initial || (name ? name[0] : 'C')).toUpperCase();
                }
            }

            function markActive(el){
                document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                el.classList.add('active');
            }

            window.selectConversation = function(el){
                const userId = el.getAttribute('data-user-id');
                const name = el.getAttribute('data-name') || 'Conversation';
                const avatar = el.getAttribute('data-avatar') || '';
                const initial = el.getAttribute('data-initial') || (name ? name[0] : 'C');

                markActive(el);
                setHeader(name, avatar, initial);
                clearMessages();

                if (!userId || userId === 'ai') {
                    receiverEl.value = '';
                    appendMessage('Hi! How can I help?');
                    return;
                }

                receiverEl.value = userId;

                fetch(`/api/chats/${userId}/messages`, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                    .then(r => r.ok ? r.json() : [])
                    .then(list => {
                        if (Array.isArray(list) && list.length) {
                            list.forEach(m => appendMessage(m.message, m.sender_id === authId, initial));
                        } else {
                            appendMessage('No messages yet. Say hi!', false, initial);
                        }
                    })
                    .catch(() => appendMessage('Failed to load messages.', false, initial));
            }

            // Track chat sessions with localStorage persistence
            let chatCounter = parseInt(localStorage.getItem('chatCounter') || '1');
            const chatSessions = JSON.parse(localStorage.getItem('chatSessions') || '{}');
            const chatTitles = JSON.parse(localStorage.getItem('chatTitles') || '{}');

            // Save to localStorage whenever data changes
            function saveChatData() {
                localStorage.setItem('chatCounter', chatCounter.toString());
                localStorage.setItem('chatSessions', JSON.stringify(chatSessions));
                localStorage.setItem('chatTitles', JSON.stringify(chatTitles));
                localStorage.setItem('currentChatId', window.currentChatId || 'chat-1');
            }

            // Handle new chat button
            document.getElementById('newChatBtn').addEventListener('click', function() {
                chatCounter++;
                const chatId = 'chat-' + chatCounter;
                const chatName = 'New Chat ' + chatCounter;
                
                // Create new chat item
                const chatList = document.getElementById('chatList');
                const todaySection = chatList.querySelector('.px-4');
                
                // Create new chat element
                const newChatItem = document.createElement('div');
                newChatItem.className = 'chat-item';
                newChatItem.setAttribute('data-chat-id', chatId);
                newChatItem.onclick = function() { selectNewChat(chatId, chatName); };
                
                newChatItem.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">N</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-medium text-gray-900 truncate">${chatName}</h3>
                                <span class="text-xs text-gray-500">Now</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">Start a new conversation...</p>
                        </div>
                    </div>
                `;
                
                // Insert after the "Today" header
                if (todaySection && todaySection.nextSibling) {
                    chatList.insertBefore(newChatItem, todaySection.nextSibling);
                } else {
                    chatList.appendChild(newChatItem);
                }
                
                // Initialize empty chat session
                chatSessions[chatId] = [];
                chatTitles[chatId] = chatName;
                saveChatData();
                
                // Switch to the new chat
                selectNewChat(chatId, chatName);
            });

            // Function to update chat title
            function updateChatTitle(chatId, newTitle) {
                // Truncate title if too long
                const displayTitle = newTitle.length > 30 ? newTitle.substring(0, 30) + '...' : newTitle;
                
                // Save to chatTitles storage
                chatTitles[chatId] = displayTitle;
                saveChatData();
                
                // Update sidebar chat item
                const chatItem = document.querySelector(`[data-chat-id="${chatId}"]`);
                if (chatItem) {
                    const heading = chatItem.querySelector('h3');
                    if (heading) heading.textContent = displayTitle;
                }
                
                // Update header if this is the active chat
                if (window.currentChatId === chatId) {
                    titleEl.textContent = displayTitle;
                }
            }

            // Function to delete current chat
            function deleteCurrentChat() {
                const chatId = window.currentChatId;
                
                // Don't allow deleting if it's the only chat
                if (Object.keys(chatSessions).length === 1) {
                    alert('Cannot delete the last chat. Create a new chat first!');
                    return;
                }
                
                // Confirm deletion
                if (!confirm('Are you sure you want to delete this entire chat? This cannot be undone.')) {
                    return;
                }
                
                // Remove from sidebar
                const chatItem = document.querySelector(`[data-chat-id="${chatId}"]`);
                if (chatItem) {
                    chatItem.remove();
                }
                
                // Remove from storage
                delete chatSessions[chatId];
                delete chatTitles[chatId];
                saveChatData();
                
                // Switch to another chat
                const remainingChats = document.querySelectorAll('.chat-item');
                if (remainingChats.length > 0) {
                    const firstChat = remainingChats[0];
                    const newChatId = firstChat.getAttribute('data-chat-id');
                    const newChatName = chatTitles[newChatId] || 'New Chat';
                    selectNewChat(newChatId, newChatName);
                } else {
                    // Create a new default chat if somehow all were deleted
                    const newChatId = 'chat-1';
                    chatSessions[newChatId] = [];
                    chatTitles[newChatId] = 'New Chat';
                    saveChatData();
                    selectNewChat(newChatId, 'New Chat');
                }
            }

            // Attach delete button handler
            document.getElementById('deleteChatBtn').addEventListener('click', deleteCurrentChat);

            // AI Response Generator
            function generateAIResponse(userMessage) {
                const msg = userMessage.toLowerCase().trim();
                
                // Job-related responses
                if (msg.includes('job') || msg.includes('work') || msg.includes('career') || msg.includes('position')) {
                    const jobResponses = [
                        "I can help you explore job opportunities! CloseCall has many positions available. What industry are you interested in?",
                        "Looking for a job? Great! We have openings in various fields. Tell me more about your skills and experience.",
                        "I'd be happy to assist with your job search. Would you like to browse our latest job postings?",
                        "Career opportunities await! What type of work are you looking for - full-time, part-time, or internship?"
                    ];
                    return jobResponses[Math.floor(Math.random() * jobResponses.length)];
                }
                
                // Greeting responses
                if (msg.match(/^(hi|hello|hey|greetings|good morning|good afternoon)/)) {
                    return "Hello! 👋 I'm your CloseCall AI assistant. How can I help you today? I can assist with jobs, events, or answer questions!";
                }
                
                // Event-related responses
                if (msg.includes('event') || msg.includes('workshop') || msg.includes('seminar') || msg.includes('conference')) {
                    return "We have exciting events coming up! Would you like to know about networking events, workshops, or career fairs?";
                }
                
                // Company-related responses
                if (msg.includes('company') || msg.includes('companies') || msg.includes('employer')) {
                    return "Many great companies are registered on CloseCall. Are you looking to explore specific companies or industries?";
                }
                
                // How to do something
                if (msg.startsWith('how to') || msg.startsWith('how do i') || msg.startsWith('how can i')) {
                    if (msg.includes('cook')) {
                        return "To cook well, start with fresh ingredients, follow recipes carefully, and practice! Would you like some cooking tips or are you looking for career opportunities in culinary arts?";
                    }
                    if (msg.includes('apply')) {
                        return "To apply for a job on CloseCall: Browse jobs → Click '+' on a position you like → Fill out the application form. It's that easy!";
                    }
                    return "That's a great question! Could you be more specific about what you'd like to do? I'm here to help with job hunting, events, or career guidance.";
                }
                
                // Help requests
                if (msg.includes('help') || msg.includes('assist') || msg.includes('support')) {
                    return "I'm here to help! I can assist you with:\n• Finding jobs\n• Discovering events\n• Company information\n• Career advice\n\nWhat would you like to know more about?";
                }
                
                // Thank you responses
                if (msg.includes('thank') || msg.includes('thanks')) {
                    return "You're very welcome! Is there anything else I can help you with? 😊";
                }
                
                // Profile/account questions
                if (msg.includes('profile') || msg.includes('account') || msg.includes('resume')) {
                    return "Your profile is important! Make sure it's complete with your skills, experience, and photo. This helps employers find you. Need help updating your profile?";
                }
                
                // Salary/pay questions
                if (msg.includes('salary') || msg.includes('pay') || msg.includes('wage') || msg.includes('compensation')) {
                    return "Salary information varies by role and company. Check individual job postings for salary ranges, or filter jobs by your expected compensation.";
                }
                
                // Question words
                if (msg.startsWith('what') || msg.startsWith('where') || msg.startsWith('when') || msg.startsWith('why')) {
                    return "That's an interesting question! I specialize in helping with job searches and career guidance. Could you rephrase that in terms of jobs, events, or companies?";
                }
                
                // Default intelligent response
                const defaultResponses = [
                    "I understand! Let me help you with that. Could you provide more details about what you're looking for?",
                    "Interesting! While I'm specialized in job searching and career guidance, I'll do my best to assist. What specifically can I help you with?",
                    "I'm here to help with jobs, events, and career opportunities on CloseCall. How can I assist you today?",
                    "Got it! To better assist you, could you tell me if you're looking for jobs, interested in events, or have questions about companies?"
                ];
                
                return defaultResponses[Math.floor(Math.random() * defaultResponses.length)];
            }

            // Function to select a new chat
            window.selectNewChat = function(chatId, chatName) {
                // Clear active state from all items
                document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                
                // Activate this chat item
                const chatItem = document.querySelector(`[data-chat-id="${chatId}"]`);
                if (chatItem) chatItem.classList.add('active');
                
                // Reset chat UI
                receiverEl.value = '';
                setHeader(chatName, '', 'N');
                statusEl.textContent = 'Ready to chat';
                clearMessages();
                
                // Load messages for this chat session
                if (chatSessions[chatId] && chatSessions[chatId].length > 0) {
                    chatSessions[chatId].forEach(msg => {
                        appendMessage(msg.text, msg.sent, 'N');
                    });
                } else {
                    appendMessage('Hi! Start a new conversation...', false, 'N');
                }
                
                // Store current chat ID for message saving
                window.currentChatId = chatId;
            };

            // Handle AI chat item (static demo entry)
            window.selectAIChat = function(){
                document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                const aiItem = document.querySelector('.chat-item');
                if (aiItem) aiItem.classList.add('active');
                receiverEl.value = '';
                setHeader('New Chat', '', 'N');
                statusEl.textContent = 'Ready to chat';
                clearMessages();
                appendMessage('Hi! Start a new conversation...', false, 'N');
            }

            // Backward compatibility for sample items calling selectChat(...)
            window.selectChat = function(){
                window.selectAIChat();
            }

            formEl.addEventListener('submit', function(e){
                e.preventDefault();
                const text = (inputEl.value || '').trim();
                if (!text) return;

                const toId = receiverEl.value;

                appendMessage(text, true);
                
                // Save message to current chat session
                if (window.currentChatId && chatSessions[window.currentChatId]) {
                    chatSessions[window.currentChatId].push({ text: text, sent: true });
                    saveChatData();
                    
                    // Update chat title if this is the first message
                    if (chatSessions[window.currentChatId].length === 1) {
                        updateChatTitle(window.currentChatId, text);
                    }
                }
                
                inputEl.value = '';

                if (!toId) {
                    setTimeout(() => {
                        const response = generateAIResponse(text);
                        appendMessage(response);
                        // Save response to current chat session
                        if (window.currentChatId && chatSessions[window.currentChatId]) {
                            chatSessions[window.currentChatId].push({ text: response, sent: false });
                            saveChatData();
                        }
                    }, 800);
                    return;
                }

                fetch(`{{ route('chats.store') }}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
                    body: JSON.stringify({ receiver_id: toId, message: text })
                }).then(r => { if (!r.ok) throw new Error(); })
                  .catch(() => {
                      messagesEl.lastElementChild?.remove();
                      appendMessage('Failed to send. Please try again.', false);
                  });
            });

            // Render users into chat list
            function renderUserList(users) {
                const listEl = document.getElementById('chatList');
                if (!listEl) return;
                const arr = Array.isArray(users) ? users : (users.users || users.data || []);
                if (!Array.isArray(arr)) return;
                arr.forEach(u => {
                    if (!u || u.id === authId) return;
                    const name = (u.full_name || u.name || `${u.first_name ?? ''} ${u.last_name ?? ''}`.trim() || 'User').trim();
                    const avatar =
                        u.profile_picture_url ||
                        u.profile_photo_url ||
                        (u.profile_photo ? (`/storage/${u.profile_photo}`) : (u.profile_picture ? (`/storage/${u.profile_picture}`) : ''));
                    const initial = (name && name.length ? name[0] : 'U').toUpperCase();
                    const item = document.createElement('div');
                    item.className = 'chat-item';
                    item.setAttribute('data-user-id', u.id);
                    item.setAttribute('data-name', name);
                    item.setAttribute('data-avatar', avatar);
                    item.setAttribute('data-initial', initial);
                    item.onclick = function(){ selectConversation(item); };
                    item.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                ${avatar
                                    ? `<img src="${avatar}" class="w-10 h-10 rounded-full object-cover">`
                                    : `<div class=\"w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center\"><span class=\"text-white font-bold text-sm\">${initial}</span></div>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">${name}</h3>
                                    <span class="text-xs text-gray-500"></span>
                                </div>
                                <p class="text-sm text-gray-500 truncate mt-1"></p>
                            </div>
                        </div>`;
                    listEl.appendChild(item);
                });
            }

            function fetchUsersList(){
                fetch(`{{ route('users.list') }}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                    .then(r => r.ok ? r.json() : Promise.reject())
                    .then(renderUserList)
                    .catch(() => {});
            }

            // Restore saved chats on page load
            function restoreSavedChats() {
                const chatList = document.getElementById('chatList');
                const todaySection = chatList.querySelector('.px-4');
                
                // Get all saved chat IDs (except chat-1 which is default)
                const savedChatIds = Object.keys(chatSessions).filter(id => id !== 'chat-1');
                
                // Restore each saved chat
                savedChatIds.forEach(chatId => {
                    const chatName = chatTitles[chatId] || chatId;
                    
                    // Create chat item element
                    const newChatItem = document.createElement('div');
                    newChatItem.className = 'chat-item';
                    newChatItem.setAttribute('data-chat-id', chatId);
                    newChatItem.onclick = function() { selectNewChat(chatId, chatName); };
                    
                    // Get preview text from last message
                    const messages = chatSessions[chatId] || [];
                    const lastMessage = messages.length > 0 ? messages[messages.length - 1].text : 'Start a new conversation...';
                    const previewText = lastMessage.length > 40 ? lastMessage.substring(0, 40) + '...' : lastMessage;
                    
                    newChatItem.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">${chatName.charAt(0).toUpperCase()}</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">${chatName}</h3>
                                    <span class="text-xs text-gray-500">Saved</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate mt-1">${previewText}</p>
                            </div>
                        </div>
                    `;
                    
                    // Insert after the default chat-1
                    if (todaySection && todaySection.nextSibling && todaySection.nextSibling.nextSibling) {
                        chatList.insertBefore(newChatItem, todaySection.nextSibling.nextSibling);
                    } else {
                        chatList.appendChild(newChatItem);
                    }
                });
            }

            // Initialize
            if (!chatSessions['chat-1']) {
                chatSessions['chat-1'] = [];
                chatTitles['chat-1'] = 'New Chat';
                saveChatData();
            }
            
            // Restore saved chats
            restoreSavedChats();
            
            // Load last active chat or default to chat-1
            const lastChatId = localStorage.getItem('currentChatId') || 'chat-1';
            window.currentChatId = lastChatId;
            
            const lastChat = document.querySelector(`[data-chat-id="${lastChatId}"]`);
            if (lastChat) {
                selectNewChat(lastChatId, chatTitles[lastChatId] || 'New Chat');
            } else {
                const firstChat = document.querySelector('.chat-item.active') || document.querySelector('.chat-item');
                if (firstChat) {
                    const chatId = firstChat.getAttribute('data-chat-id') || 'chat-1';
                    selectNewChat(chatId, chatTitles[chatId] || 'New Chat');
                }
            }
            
            fetchUsersList();
        })();
    </script>

    </body>
    </html>
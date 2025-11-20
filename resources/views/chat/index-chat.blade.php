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
        <div class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </div>
        <a href="{{ route('profile') }}" class="sidebar-icon" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AI') }}" class="sidebar-icon active" data-page="AI">
            <img src="{{ asset('image/genius.png') }}" alt="AI" class="sidebar-icon-img">
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
                    <input type="text" placeholder="Search..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Chat List -->
            <div class="chat-list" id="chatList">
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

                <!-- End chat list -->
            </div> <!-- /.chat-list -->
        </div> <!-- /.chat-sidebar -->

        <!-- Chat Main (right panel) -->
        <div class="chat-main">
            <!-- Conversation Header -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img id="chatAvatarImg" class="w-9 h-9 rounded-full object-cover hidden" alt="avatar">
                        <div id="chatAvatarInitial" class="w-9 h-9 rounded-full bg-teal-500 text-white flex items-center justify-center font-semibold">C</div>
                    </div>
                    <div>
                        <div id="chatTitle" class="font-semibold text-gray-900">CloseCall AI</div>
                        <div class="text-xs text-gray-500" id="chatStatus">Online</div>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div id="messages" class="flex-1 overflow-y-auto px-6 py-5 space-y-3">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center text-sm">C</div>
                    <div class="max-w-xl rounded-2xl bg-white shadow px-4 py-2 text-sm text-gray-700">Hi! How can I help?</div>
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
                const row = document.createElement('div');
                if (sent) {
                    row.className = 'flex justify-end';
                    const bubble = document.createElement('div');
                    bubble.className = 'max-w-xl rounded-2xl bg-teal-600 text-white px-4 py-2 text-sm';
                    bubble.textContent = text;
                    row.appendChild(bubble);
                } else {
                    row.className = 'flex items-start gap-2';
                    const avatar = document.createElement('div');
                    avatar.className = 'w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center text-sm';
                    avatar.textContent = (initial || 'C').slice(0,1).toUpperCase();
                    const bubble = document.createElement('div');
                    bubble.className = 'max-w-xl rounded-2xl bg-white shadow px-4 py-2 text-sm text-gray-700';
                    bubble.textContent = text;
                    row.appendChild(avatar);
                    row.appendChild(bubble);
                }
                messagesEl.appendChild(row);
                messagesEl.scrollTop = messagesEl.scrollHeight;
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

            // Handle AI chat item (static demo entry)
            window.selectAIChat = function(){
                document.querySelectorAll('.chat-item').forEach(i => i.classList.remove('active'));
                const aiItem = document.querySelector('.chat-item');
                if (aiItem) aiItem.classList.add('active');
                receiverEl.value = '';
                setHeader('CloseCall AI', '', 'C');
                clearMessages();
                appendMessage('Hi! How can I help?');
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
                inputEl.value = '';

                if (!toId) {
                    setTimeout(() => appendMessage('Got it! This is a demo chat UI.'), 500);
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

            // Initialize selected/chat
            const first = document.querySelector('.chat-item.active') || document.querySelector('.chat-item');
            if (first) window.selectConversation(first);
            fetchUsersList();
        })();
    </script>

    </body>
    </html>
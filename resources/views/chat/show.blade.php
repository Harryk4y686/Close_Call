<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat with {{ $chatPartner->name }} - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }
        .chat-layout {
            display: flex;
            height: 100vh;
        }
        .chat-sidebar {
            width: 400px;
            background: white;
            border-right: 1px solid #e4e6ea;
            display: flex;
            flex-direction: column;
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
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #e5ddd5;
        }
        .chat-header {
            background: #f0f2f5;
            padding: 16px 20px;
            border-bottom: 1px solid #e4e6ea;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><defs><pattern id="chat-bg" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23chat-bg)"/></svg>');
        }
        .message {
            margin-bottom: 1rem;
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message.sent {
            text-align: right;
        }
        .message.received {
            text-align: left;
        }
        .message-bubble {
            display: inline-block;
            max-width: 70%;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            word-wrap: break-word;
        }
        .message.sent .message-bubble {
            background: #3b82f6;
            color: white;
            border-bottom-right-radius: 0.25rem;
        }
        .message.received .message-bubble {
            background: white;
            color: #374151;
            border-bottom-left-radius: 0.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .message-time {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .message-input-container {
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
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
        .typing-indicator {
            display: none;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .typing-dots {
            display: flex;
            space-x: 0.25rem;
        }
        .typing-dot {
            width: 0.5rem;
            height: 0.5rem;
            background: #9ca3af;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
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
        <!-- Chat Area -->
        <div class="chat-main">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button onclick="window.location.href='{{ route('chats') }}'" class="text-gray-500 hover:text-gray-700 mr-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <img src="{{ $chatPartner->profile_photo ? asset('storage/' . $chatPartner->profile_photo) : 'https://via.placeholder.com/40x40/3b82f6/ffffff?text=' . strtoupper(substr($chatPartner->name, 0, 1)) }}" 
                             alt="{{ $chatPartner->name }}" 
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">{{ $chatPartner->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $chatPartner->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="messages-container" id="messagesContainer">
                @foreach($messages as $message)
                    <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                        <div class="message-bubble">
                            {{ $message->message }}
                        </div>
                        <div class="message-time">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                @endforeach
                
                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typingIndicator">
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="message-input-container">
                <form id="messageForm" class="flex items-center space-x-3">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $chatPartner->id }}">
                    <button type="button" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </button>
                    <div class="flex-1">
                        <input id="messageInput" 
                               name="message" 
                               placeholder="Write your message" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                               maxlength="1000">
                    </div>
                    <button type="button" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            id="sendButton">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const messagesContainer = $('#messagesContainer');
            const messageInput = $('#messageInput');
            const messageForm = $('#messageForm');
            const sendButton = $('#sendButton');
            const chatPartnerId = {{ $chatPartner->id }};

            // Auto-resize textarea
            messageInput.on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
                
                // Enable/disable send button
                sendButton.prop('disabled', $(this).val().trim() === '');
            });

            // Send message on Enter (Shift+Enter for new line)
            messageInput.on('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    messageForm.submit();
                }
            });

            // Handle form submission
            messageForm.on('submit', function(e) {
                e.preventDefault();
                
                const message = messageInput.val().trim();
                if (!message) return;

                // Disable form while sending
                sendButton.prop('disabled', true);
                messageInput.prop('disabled', true);

                // Add message to UI immediately
                addMessageToUI(message, true, new Date());

                // Send via AJAX
                $.ajax({
                    url: '{{ route("chats.store") }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        receiver_id: chatPartnerId,
                        message: message
                    },
                    success: function(response) {
                        // Message already added to UI, just scroll
                        scrollToBottom();
                    },
                    error: function(xhr) {
                        // Remove the message from UI on error
                        $('.message').last().remove();
                        alert('Failed to send message. Please try again.');
                    },
                    complete: function() {
                        // Re-enable form
                        messageInput.val('').prop('disabled', false).focus();
                        messageInput.css('height', 'auto');
                        sendButton.prop('disabled', false);
                    }
                });
            });

            // Add message to UI
            function addMessageToUI(message, isSent, timestamp) {
                const messageClass = isSent ? 'sent' : 'received';
                const timeStr = new Date(timestamp).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });

                const messageHtml = `
                    <div class="message ${messageClass}">
                        <div class="message-bubble">
                            ${escapeHtml(message)}
                        </div>
                        <div class="message-time">
                            ${timeStr}
                        </div>
                    </div>
                `;

                $('#typingIndicator').before(messageHtml);
                scrollToBottom();
            }

            // Escape HTML to prevent XSS
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Scroll to bottom
            function scrollToBottom() {
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
            }

            // Auto-refresh messages every 5 seconds
            setInterval(function() {
                refreshMessages();
            }, 5000);

            // Refresh messages
            function refreshMessages() {
                $.get(`{{ route('chats.messages', $chatPartner->id) }}`, function(messages) {
                    const currentMessages = $('.message').length;
                    if (messages.length > currentMessages) {
                        // New messages received
                        const newMessages = messages.slice(currentMessages);
                        newMessages.forEach(function(message) {
                            if (message.sender_id !== {{ auth()->id() }}) {
                                addMessageToUI(message.message, false, message.created_at);
                            }
                        });
                    }
                });
            }

            // Initial scroll to bottom
            scrollToBottom();

            // Focus on message input
            messageInput.focus();
        });
    </script>
</body>
</html>

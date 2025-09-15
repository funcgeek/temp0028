<!-- Modern Chat Interface with PHP integration -->
<link href="common/extranal/css/chat.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #4865ff;
        --secondary-color: #5d7aff;
        --tertiary-color: #e9efff;
        --dark-color: #1e2740;
        --light-color: #f7f9ff;
        --success-color: #28d179;
        --warning-color: #ffb545;
        --danger-color: #ff4555;
        --gray-100: #f8f9fc;
        --gray-200: #eef1f9;
        --gray-300: #e0e4f0;
        --gray-400: #c8cfe0;
        --gray-500: #9aa3b8;
        --gray-600: #6c7793;
        --gray-700: #4a5169;
        --gray-800: #2d3348;
        --gray-900: #1a1f2e;
        --border-radius: 16px;
        --border-radius-sm: 8px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.1);
        --transition: all 0.2s ease-in-out;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body {
        background-color: var(--gray-100);
        color: var(--gray-900);
        line-height: 1.6;
        width: 100%;
        overflow-x: hidden;
    }

    #main-content {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .content-wrapper {
        max-width: 100%; /* Changed from 1600px to 100% */
        margin: 0 auto;
        padding: 24px;
        width: 100%;
        flex: 1;
    }

    .wrapper {
        height: 100%;
        width: 100%; /* Added width 100% */
    }

    .site-min-height {
        min-height: calc(100vh - 120px);
        width: 100%; /* Added width 100% */
    }

    .panel {
        background-color: transparent;
        border: none;
        border-radius: var(--border-radius);
        height: 100%;
        width: 100%; /* Added width 100% */
        display: flex;
        flex-direction: column;
    }

    .panel-heading {
        background-color: transparent;
        padding: 16px 0;
        border: none;
        width: 100%; /* Added width 100% */
    }

    .panel-heading h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
    }

    .breadcrumb {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 8px;
        margin: 0;
        padding: 0;
    }

    .breadcrumb-item {
        font-size: 14px;
        color: var(--gray-600);
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: var(--secondary-color);
    }

    .breadcrumb-item:not(:last-child):after {
        content: '/';
        margin-left: 8px;
        color: var(--gray-400);
    }

    .breadcrumb-item.active {
        color: var(--gray-700);
        font-weight: 500;
    }

    .float-sm-right {
        float: right;
    }

    .panel-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        width: 100%; /* Added width 100% */
    }

    .card {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        height: 100%;
        width: 100%; /* Added width 100% */
        display: flex;
        flex-direction: column;
    }

    .card-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--gray-200);
        background-color: #fff;
        width: 100%; /* Added width 100% */
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 0;
        width: 100%; /* Added width 100% */
    }

    .panel-body_class {
        height: 100%;
        margin: 0;
        width: 100%; /* Added width 100% */
        display: flex; /* Ensure this is a flex container */
    }

    .row {
        width: 100%; /* Added width 100% */
        margin: 0; /* Remove default margins */
    }

    .col-12 {
        width: 100%;
        padding: 0; /* Remove default padding */
    }

    .search_chat {
        border-right: 1px solid var(--gray-200);
        background-color: var(--light-color);
        padding: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    #searchChat {
        margin: 16px;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid var(--gray-300);
        background-color: var(--gray-100);
        color: var(--gray-900);
        font-size: 15px;
        transition: var(--transition);
        width: calc(100% - 32px);
    }

    #searchChat:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(72, 101, 255, 0.15);
    }

    #chattersBlock {
        flex: 1;
        overflow-y: auto;
        padding: 0 16px 16px;
    }

    .search_chat_p {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray-500);
        font-weight: 600;
        margin: 16px 0 8px;
    }

    #adminChatters, #employeeChatters {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .ca-btn {
        background: none;
        border: none;
        cursor: pointer;
    }

    .ca-chat-btn {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: var(--border-radius-sm);
        text-align: left;
        font-size: 15px;
        font-weight: 500;
        color: var(--gray-800);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .ca-chat-btn:hover {
        background-color: var(--gray-200);
    }

    .ca-selected-chat {
        background-color: var(--tertiary-color);
        color: var(--primary-color);
        font-weight: 600;
    }

    .ca-selected-chat:hover {
        background-color: var(--tertiary-color);
    }

    .newChat {
        position: relative;
    }

    .newChat::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }

    .chat_info {
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 0;
        flex: 1; /* Ensure it takes available space */
    }

    .chatInfo {
        padding: 16px 24px;
        font-size: 18px;
        font-weight: 600;
        color: var(--gray-900);
        border-bottom: 1px solid var(--gray-200);
        background-color: #fff;
    }

    .chat_hr {
        margin: 0;
        border-color: var(--gray-200);
    }

    .chatBox {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
        background-color: var(--gray-100);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* Message styling */
    .chat-message {
        display: flex;
        max-width: 80%;
        margin-bottom: 8px;
    }

    .chat-message.incoming {
        align-self: flex-start;
    }

    .chat-message.outgoing {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .chat-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--primary-color);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 600;
        margin-right: 12px;
        font-size: 14px;
        flex-shrink: 0;
    }

    .chat-message.outgoing .chat-avatar {
        margin-right: 0;
        margin-left: 12px;
        background-color: var(--success-color);
    }

    .chat-content {
        display: flex;
        flex-direction: column;
    }

    .chat-bubble {
        padding: 12px 16px;
        border-radius: 16px;
        font-size: 15px;
        position: relative;
        max-width: 100%;
        word-wrap: break-word;
    }

    .chat-message.incoming .chat-bubble {
        background-color: white;
        color: var(--gray-900);
        border-top-left-radius: 4px;
        box-shadow: var(--shadow-sm);
    }

    .chat-message.outgoing .chat-bubble {
        background-color: var(--primary-color);
        color: white;
        border-top-right-radius: 4px;
        box-shadow: var(--shadow-sm);
    }

    .chat-time {
        font-size: 12px;
        margin-top: 4px;
        color: var(--gray-500);
        align-self: flex-end;
    }

    .chat-message.outgoing .chat-time {
        align-self: flex-start;
    }

    .chat-date-divider {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .chat-date-divider::before {
        content: '';
        display: block;
        height: 1px;
        background-color: var(--gray-300);
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        z-index: 1;
    }

    .chat-date-text {
        background-color: var(--gray-100);
        padding: 0 16px;
        position: relative;
        z-index: 2;
        font-size: 13px;
        color: var(--gray-500);
        display: inline-block;
    }

    #sendDiv {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        background-color: #fff;
        border-top: 1px solid var(--gray-200);
        width: 100%; /* Added width 100% */
    }

    .chatInput {
        flex: 1;
        padding: 14px 16px;
        border-radius: 24px;
        border: 1px solid var(--gray-300);
        background-color: var(--gray-100);
        color: var(--gray-900);
        font-size: 15px;
        transition: var(--transition);
    }

    .chatInput:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(72, 101, 255, 0.15);
    }

    .caSendBtn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        margin-left: 12px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: var(--transition);
        flex-shrink: 0;
        box-shadow: var(--shadow-sm);
    }

    .caSendBtn:hover {
        background-color: var(--secondary-color);
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .caSendBtn::before {
        content: '';
        display: inline-block;
        width: 20px;
        height: 20px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='22' y1='2' x2='11' y2='13'%3E%3C/line%3E%3Cpolygon points='22 2 15 22 11 13 2 9 22 2'%3E%3C/polygon%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
    }

    /* Fix container issues */
    .container-fluid {
        width: 100%;
        padding-right: 0;
        padding-left: 0;
        margin-right: 0;
        margin-left: 0;
    }

    /* Ensure column widths are correct */
    .col-md-4 {
        width: 33.333333%;
    }

    .col-md-8 {
        width: 66.666667%;
    }

    /* Responsive layout */
    @media (max-width: 991px) {
        .search_chat {
            height: 300px;
            border-right: none;
            border-bottom: 1px solid var(--gray-200);
            width: 100%;
        }
        
        .chat_info {
            height: calc(100% - 300px);
            width: 100%;
        }
        
        .panel-body_class {
            flex-direction: column;
        }

        .col-md-4, .col-md-8 {
            width: 100%;
        }
    }

    @media (max-width: 767px) {
        .content-wrapper {
            padding: 16px;
        }
        
        .chatBox {
            padding: 16px;
        }
        
        #sendDiv {
            padding: 12px 16px;
        }
    }

    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: var(--gray-400);
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: var(--gray-500);
    }
</style>

<section id="main-content">
    <div class="content-wrapper">
        <section class="wrapper site-min-height">
            <!-- page start-->
            <section class="panel">
                <header class="panel-heading">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php echo lang('chat'); ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                                    <li class="breadcrumb-item active"><?php echo lang('chat') ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Main content -->
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?php echo 'Chat between all the staffs'; ?></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row panel-body_class">
                                            <div class="col-md-4 search_chat">
                                                <input type="text" id="searchChat" class="form-control" placeholder="Search users...">
                                                <div id="chattersBlock">
                                                    <p class="search_chat_p"><?php echo 'administrators'; ?></p>
                                                    <div id="adminChatters">
                                                        <?php for ($i = 0; $i < count($admins); $i++) {
                                                            if ($current_user != $admins[$i]['id']) { ?>
                                                                <button class="ca-btn ca-chat-btn d-block <?php if ($receiver_id == $admins[$i]['id']) { ?>ca-selected-chat<?php } else if ($admins[$i]['newChat'] == 'unread') { ?>newChat<?php } ?>" data-id="<?php echo $admins[$i]['id']; ?>"><?php echo $admins[$i]['username']; ?></button>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                    
                                                    <p class="search_chat_p"><?php echo 'employees'; ?></p>
                                                    <div id="employeeChatters">
                                                        <?php for ($i = 0; $i < count($employeeChat); $i++) {
                                                            if ($current_user != $employeeChat[$i]['ion_user_id']) { ?>
                                                                <button class="ca-btn ca-chat-btn d-block <?php if ($receiver_id == $employeeChat[$i]['ion_user_id']) { ?>ca-selected-chat<?php } else if ($employeeChat[$i]['newChat'] == 'unread') { ?>newChat<?php } ?>" data-id="<?php echo $employeeChat[$i]['ion_user_id']; ?>"><?php echo $employeeChat[$i]['name']; ?></button>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 chat_info">
                                                <div style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                                                    <div class="chatInfo">
                                                        <?php echo $user; ?>
                                                    </div>
                                                    <hr class="chat_hr">
                                                    <div class="chatBox">
                                                        <?php echo $chats; ?>
                                                    </div>
                                                    <input type="hidden" id="receiverId" value="<?php echo $receiver_id; ?>">
                                                    <input type="hidden" id="lastMessageId" value="<?php echo $lastMessageId; ?>">
                                                    <input type="hidden" id="recentMessageId" value="<?php echo $recentMessageId; ?>">
                                                </div>
                                                <div id="sendDiv">
                                                    <input type="text" class="form-control chatInput" placeholder="Type your message...">
                                                    <button class="caSendBtn" aria-label="Send"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </section>
        <!-- page end-->
    </div>
</section>

<!-- Script additions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format existing chat messages
        function formatChatMessages() {
            const chatBox = document.querySelector('.chatBox');
            if (!chatBox) return;
            
            // Get all direct child elements of chatBox
            const messages = chatBox.children;
            if (!messages.length) return;
            
            // Process each message
            for (let i = 0; i < messages.length; i++) {
                const message = messages[i];
                
                // Skip if already processed
                if (message.classList.contains('chat-message') || 
                    message.classList.contains('chat-date-divider')) continue;
                
                // Check if this is a date divider
                if (message.tagName === 'P' && message.classList.contains('date_section')) {
                    message.classList.add('chat-date-divider');
                    
                    // Wrap the text in a span
                    const dateText = message.textContent;
                    message.innerHTML = `<span class="chat-date-text">${dateText}</span>`;
                    continue;
                }
                
                // Try to determine if it's an incoming or outgoing message
                // This is a guess based on common patterns - adjust as needed
                const isOutgoing = message.classList.contains('outgoing') || 
                                  message.classList.contains('sent') || 
                                  message.classList.contains('me');
                
                // Apply our new class structure
                message.classList.add('chat-message');
                message.classList.add(isOutgoing ? 'outgoing' : 'incoming');
                
                // If it doesn't have our expected structure, try to fix it
                if (!message.querySelector('.chat-bubble')) {
                    // Get the message text
                    const text = message.textContent;
                    
                    // Create a structure around the message
                    const avatar = document.createElement('div');
                    avatar.className = 'chat-avatar';
                    avatar.textContent = isOutgoing ? 'Me' : 'U';
                    
                    const content = document.createElement('div');
                    content.className = 'chat-content';
                    
                    const bubble = document.createElement('div');
                    bubble.className = 'chat-bubble';
                    bubble.textContent = text;
                    
                    const time = document.createElement('div');
                    time.className = 'chat-time';
                    time.textContent = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    content.appendChild(bubble);
                    content.appendChild(time);
                    
                    // Clear the original content
                    message.textContent = '';
                    
                    // Add our new structure
                    message.appendChild(avatar);
                    message.appendChild(content);
                }
            }
        }
        
        // Call the formatting function immediately
        formatChatMessages();
        
        // Set up a MutationObserver to format new messages
        const chatBox = document.querySelector('.chatBox');
        if (chatBox) {
            const observer = new MutationObserver(formatChatMessages);
            observer.observe(chatBox, { childList: true });
        }
    });
</script>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/chat_module.js"></script>
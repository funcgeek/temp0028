<?php
// Database configuration
$db_host = 'localhost';
$db_username = 'secureispecs_emr_setup';
$db_password = 'RukrIp69FR(0';
$db_name = 'secureispecs_emr';

// Create database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch Twilio settings from database
$twilio_sid = '';
$twilio_token = '';
$twilio_number = '';

$sql = "SELECT sid, token, sendernumber FROM sms_settings WHERE name = 'Twilio' AND user = '1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $twilio_sid = $row['sid'];
    $twilio_token = $row['token'];
    $twilio_number = $row['sendernumber'];
} else {
    die("Twilio settings not found in database.");
}

// Initialize session for SMS log
session_start();
if (!isset($_SESSION['sms_log'])) {
    $_SESSION['sms_log'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_sms'])) {
    $to_numbers = explode(',', $_POST['to_numbers']);
    $message = trim($_POST['message']);
    
    // Basic validation
    $errors = [];
    if (empty($to_numbers[0])) $errors[] = "Recipient number is required";
    if (empty($message)) $errors[] = "Message is required";
    
    if (empty($errors)) {
        foreach ($to_numbers as $to) {
            $to = trim($to);
            if (!empty($to)) {
                // Send SMS using Twilio API via HTTP request
                $result = sendTwilioSMS($twilio_sid, $twilio_token, $to, $twilio_number, $message);
                
                if ($result['success']) {
                    $log_entry = [
                        'to' => $to,
                        'from' => $twilio_number,
                        'message' => $message,
                        'timestamp' => date('Y-m-d H:i:s'),
                        'status' => 'sent'
                    ];
                    $success_message = "SMS sent successfully!";
                } else {
                    $log_entry = [
                        'to' => $to,
                        'from' => $twilio_number,
                        'message' => $message,
                        'timestamp' => date('Y-m-d H:i:s'),
                        'status' => 'failed: ' . $result['error']
                    ];
                    $errors[] = "Failed to send to $to: " . $result['error'];
                }
                
                array_unshift($_SESSION['sms_log'], $log_entry);
            }
        }
    }
}

/**
 * Send SMS using Twilio API via HTTP request
 */
function sendTwilioSMS($account_sid, $auth_token, $to, $from, $body) {
    $url = "https://api.twilio.com/2010-04-01/Accounts/{$account_sid}/Messages.json";
    
    $data = [
        'To' => $to,
        'From' => $from,
        'Body' => $body
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_USERPWD, "{$account_sid}:{$auth_token}");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($http_code == 201) {
        return ['success' => true];
    } else {
        $response_data = json_decode($response, true);
        $error_msg = $error ?: (isset($response_data['message']) ? $response_data['message'] : 'Unknown error');
        return ['success' => false, 'error' => $error_msg];
    }
}
?>

    <style>
        .sms-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        
        .sms-section {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .sms-heading {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        
        .sms-form-group {
            margin-bottom: 18px;
        }
        
        .sms-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .sms-input, .sms-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            box-sizing: border-box;
        }
        
        .sms-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .sms-button {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
        }
        
        .sms-button:hover {
            background: #2980b9;
        }
        
        .sms-alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 18px;
        }
        
        .sms-alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .sms-alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .sms-log-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .sms-log-table th, .sms-log-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .sms-log-table th {
            background: #2c3e50;
            color: white;
        }
        
        .sms-log-table tr:nth-child(even) {
            background: #f2f2f2;
        }
        
        .sms-log-table tr:hover {
            background: #e9e9e9;
        }
        
        .sms-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .sms-status-sent {
            background: #d4edda;
            color: #155724;
        }
        
        .sms-status-failed {
            background: #f8d7da;
            color: #721c24;
        }
        
        .sms-config {
            background: #e8f4fc;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .sms-config-heading {
            color: #3498db;
            margin-top: 0;
        }
        
        .sms-info-item {
            margin-bottom: 8px;
            display: flex;
        }
        
        .sms-info-label {
            font-weight: 600;
            min-width: 120px;
        }
    </style>

    <div class="sms-container">
        <h1 class="sms-heading">Twilio SMS Manager</h1>
        
        <div class="sms-config">
            <h2 class="sms-config-heading">Twilio Configuration</h2>
            <div class="sms-info-item">
                <span class="sms-info-label">Account SID:</span>
                <span>••••••••••••••••••••••••••••••••</span>
            </div>
            <div class="sms-info-item">
                <span class="sms-info-label">Auth Token:</span>
                <span>••••••••••••••••••••••••••••••••</span>
            </div>
            <div class="sms-info-item">
                <span class="sms-info-label">Sender Number:</span>
                <span><?php echo htmlspecialchars($twilio_number); ?></span>
            </div>
            <p style="margin-top: 15px; font-style: italic;">
                Credentials are securely loaded from the database. No need to enter them manually.
            </p>
        </div>
        
        <div class="sms-section">
            <h2 class="sms-heading">Send SMS</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="sms-alert sms-alert-error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($success_message)): ?>
                <div class="sms-alert sms-alert-success">
                    <p><?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="sms-form-group">
                    <label class="sms-label" for="to_numbers">Recipient Numbers (comma separated)</label>
                    <input class="sms-input" type="text" id="to_numbers" name="to_numbers" placeholder="+1234567890,+1987654321" required>
                    <div style="font-size: 14px; color: #666; margin-top: 5px;">Include country code (e.g., +1 for US numbers)</div>
                </div>
                
                <div class="sms-form-group">
                    <label class="sms-label" for="message">Message</label>
                    <textarea class="sms-textarea" id="message" name="message" placeholder="Type your message here..." required></textarea>
                    <div id="sms-char-count" style="text-align: right; font-size: 14px; color: #666;">0 characters</div>
                </div>
                
                <button type="submit" class="sms-button" name="send_sms">Send SMS</button>
            </form>
        </div>
        
        <div class="sms-section">
            <h2 class="sms-heading">SMS Sent Log</h2>
            
            <?php if (empty($_SESSION['sms_log'])): ?>
                <p>No SMS messages sent yet.</p>
            <?php else: ?>
                <table class="sms-log-table">
                    <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>To</th>
                            <th>From</th>
                            <th>Message</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['sms_log'] as $log): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($log['timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($log['to']); ?></td>
                                <td><?php echo htmlspecialchars($log['from']); ?></td>
                                <td><?php echo htmlspecialchars($log['message']); ?></td>
                                <td>
                                    <?php if (strpos($log['status'], 'sent') !== false): ?>
                                        <span class="sms-status sms-status-sent"><?php echo htmlspecialchars($log['status']); ?></span>
                                    <?php else: ?>
                                        <span class="sms-status sms-status-failed"><?php echo htmlspecialchars($log['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Character counter for the message textarea
        document.addEventListener('DOMContentLoaded', function() {
            const messageTextarea = document.getElementById('message');
            const charCount = document.getElementById('sms-char-count');
            
            if (messageTextarea && charCount) {
                messageTextarea.addEventListener('input', function() {
                    const length = this.value.length;
                    charCount.textContent = length + ' characters';
                    
                    // Warn about SMS length limits
                    if (length > 160) {
                        charCount.style.color = '#e74c3c';
                        charCount.textContent = length + ' characters (Message will be split into multiple SMS)';
                    } else {
                        charCount.style.color = '#666';
                    }
                });
            }
        });
    </script>

<?php
// Close database connection
$conn->close();
?>
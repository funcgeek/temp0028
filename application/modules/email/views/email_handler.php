<?php
/**
 * Simplified Email Handler using PHPMailer
 * File: email_handler.php
 * 
 * This file handles email sending and logging only
 * Download PHPMailer from: https://github.com/PHPMailer/PHPMailer
 * Extract and place PHPMailer folder in the same directory as this file
 */

// Include PHPMailer files (traditional method without autoload)
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SimpleEmailHandler {
    
    // Database Configuration
    private $db_host = 'localhost';
    private $db_name = 'secureispecs_emr';
    private $db_user = 'secureispecs_emr_setup';
    private $db_pass = 'RukrIp69FR(0';
    
    // SMTP Configuration
    private $smtp_host = 'smtp-relay.brevo.com';  // Change to your SMTP host
    private $smtp_port = 587;
    private $smtp_username = '881f22001@smtp-brevo.com';
    private $smtp_password = '0HbLh5kwg8sZmUyK';  // Use App Password for Gmail
    private $from_email = 'support@ispecsappeal.com';
    private $from_name = 'iSpecs Appeal Support';
    
    private $pdo;
    
    public function __construct() {
        $this->connectDatabase();
        $this->handleRequest();
    }
    
    private function connectDatabase() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->db_host};dbname={$this->db_name}",
                $this->db_user,
                $this->db_pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            $this->sendJsonResponse(false, 'Database connection failed: ' . $e->getMessage());
        }
    }
    
    private function handleRequest() {
        // Set headers for AJAX response
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendJsonResponse(false, 'Only POST requests are allowed');
            return;
        }
        
        $action = $_POST['action'] ?? 'send_email';
        
        if ($action === 'send_email') {
            $this->sendEmail();
        } else {
            $this->sendJsonResponse(false, 'Invalid action');
        }
    }
    
    public function sendEmail() {
        try {
            // Validate required fields
            $subject = $this->sanitizeInput($_POST['subject'] ?? '');
            $message = $_POST['message'] ?? '';
            $send_type = $_POST['send_type'] ?? '';
            
            if (empty($subject) || empty($message)) {
                $this->sendJsonResponse(false, 'Subject and message are required');
                return;
            }
            
            // Get recipients based on send type
            $recipients = $this->getRecipients($send_type);
            
            if (empty($recipients)) {
                $this->sendJsonResponse(false, 'No recipients found');
                return;
            }
            
            // Handle file attachments
            $attachments = $this->handleAttachments();
            
            $sent_count = 0;
            $failed_count = 0;
            $email_logs = [];
            
            // Create PHPMailer instance
            $mail = new PHPMailer(true);
            
            // Configure SMTP
            $this->configureSMTP($mail);
            
            // Send emails to each recipient
            foreach ($recipients as $recipient) {
                try {
                    // Clear previous recipients
                    $mail->clearAddresses();
                    $mail->clearAttachments();
                    
                    // Set recipient
                    $mail->addAddress($recipient['email'], $recipient['name']);
                    
                    // Set email content
                    $mail->Subject = $subject;
                    $personalized_message = $this->personalizeMessage($message, $recipient);
                    $mail->Body = $personalized_message;
                    $mail->AltBody = strip_tags($personalized_message);
                    
                    // Add attachments
                    foreach ($attachments as $attachment) {
                        $mail->addAttachment($attachment['path'], $attachment['name']);
                    }
                    
                    // Send email
                    if ($mail->send()) {
                        $sent_count++;
                        $status = 'sent';
                    } else {
                        $failed_count++;
                        $status = 'failed';
                    }
                    
                } catch (Exception $e) {
                    $failed_count++;
                    $status = 'failed';
                    error_log("Email send error: " . $e->getMessage());
                }
                
                // Log email attempt
                $email_logs[] = [
                    'recipient_email' => $recipient['email'],
                    'recipient_name' => $recipient['name'],
                    'subject' => $subject,
                    'message' => $personalized_message,
                    'status' => $status,
                    'sent_at' => date('Y-m-d H:i:s'),
                    'sender_id' => $this->getCurrentUserId(),
                    'attachments' => json_encode($attachments)
                ];
            }
            
            // Save logs to database
            $this->saveEmailLogs($email_logs);
            
            // Clean up uploaded files
            $this->cleanupAttachments($attachments);
            
            $this->sendJsonResponse(true, "Email sent successfully! Sent: {$sent_count}, Failed: {$failed_count}", [
                'sent_count' => $sent_count,
                'failed_count' => $failed_count
            ]);
            
        } catch (Exception $e) {
            error_log("Email handler error: " . $e->getMessage());
            $this->sendJsonResponse(false, 'Error sending email: ' . $e->getMessage());
        }
    }
    
    private function configureSMTP($mail) {
        $mail->isSMTP();
        $mail->Host = $this->smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp_username;
        $mail->Password = $this->smtp_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $this->smtp_port;
        
        // Set from address
        $mail->setFrom($this->from_email, $this->from_name);
        $mail->addReplyTo($this->from_email, $this->from_name);
        
        // Enable HTML
        $mail->isHTML(true);
        
        // Optional: Enable debugging for troubleshooting
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }
    
    private function getRecipients($send_type) {
        $recipients = [];
        
        try {
            switch ($send_type) {
                case 'allpatient':
                    $stmt = $this->pdo->prepare("SELECT email, name FROM patient WHERE email != '' AND email IS NOT NULL");
                    $stmt->execute();
                    $recipients = $stmt->fetchAll();
                    break;
                    
                case 'single_patient':
                    $patient_id = intval($_POST['patient_id'] ?? 0);
                    if ($patient_id > 0) {
                        $stmt = $this->pdo->prepare("SELECT email, name FROM patient WHERE id = ? AND email != ''");
                        $stmt->execute([$patient_id]);
                        $recipients = $stmt->fetchAll();
                    }
                    break;
                    
                case 'manual':
                    $manual_recipients = json_decode($_POST['recipients'] ?? '[]', true);
                    foreach ($manual_recipients as $email) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $recipients[] = ['email' => $email, 'name' => ''];
                        }
                    }
                    break;
            }
        } catch (PDOException $e) {
            error_log("Database error in getRecipients: " . $e->getMessage());
        }
        
        return $recipients;
    }
    
    private function handleAttachments() {
        $attachments = [];
        
        if (!empty($_FILES['attachments']['name'][0])) {
            $upload_dir = 'uploads/email_attachments/';
            
            // Create upload directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt', 'zip'];
            $max_size = 10 * 1024 * 1024; // 10MB
            
            $files = $_FILES['attachments'];
            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $file_name = $files['name'][$i];
                    $file_size = $files['size'][$i];
                    $file_tmp = $files['tmp_name'][$i];
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    
                    // Validate file type
                    if (!in_array($file_ext, $allowed_types)) {
                        continue;
                    }
                    
                    // Validate file size
                    if ($file_size > $max_size) {
                        continue;
                    }
                    
                    // Generate unique filename
                    $new_filename = uniqid() . '_' . $file_name;
                    $file_path = $upload_dir . $new_filename;
                    
                    // Move uploaded file
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $attachments[] = [
                            'path' => $file_path,
                            'name' => $file_name,
                            'size' => $file_size
                        ];
                    }
                }
            }
        }
        
        return $attachments;
    }
    
    private function personalizeMessage($message, $recipient) {
        $personalized = $message;
        
        // Replace common shortcodes
        $replacements = [
            '[name]' => $recipient['name'],
            '[patient_name]' => $recipient['name'],
            '[email]' => $recipient['email'],
            '[date]' => date('Y-m-d'),
            '[time]' => date('H:i:s'),
            '[datetime]' => date('Y-m-d H:i:s')
        ];
        
        foreach ($replacements as $shortcode => $value) {
            $personalized = str_replace($shortcode, $value, $personalized);
        }
        
        return $personalized;
    }
    
    private function saveEmailLogs($logs) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO NewEMRemail_log 
                (recipient_email, recipient_name, subject, message, status, sent_at, sender_id, attachments) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            foreach ($logs as $log) {
                $stmt->execute([
                    $log['recipient_email'],
                    $log['recipient_name'],
                    $log['subject'],
                    $log['message'],
                    $log['status'],
                    $log['sent_at'],
                    $log['sender_id'],
                    $log['attachments']
                ]);
            }
        } catch (PDOException $e) {
            error_log("Error saving email logs: " . $e->getMessage());
        }
    }
    
    private function cleanupAttachments($attachments) {
        foreach ($attachments as $attachment) {
            if (file_exists($attachment['path'])) {
                unlink($attachment['path']);
            }
        }
    }
    
    private function getCurrentUserId() {
        // You can implement session-based user ID retrieval here
        // For now, returning a default value
        session_start();
        return $_SESSION['user_id'] ?? 1;
    }
    
    private function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }
    
    private function sendJsonResponse($success, $message, $data = []) {
        $response = [
            'success' => $success,
            'message' => $message
        ];
        
        if (!empty($data)) {
            $response = array_merge($response, $data);
        }
        
        echo json_encode($response);
        exit;
    }
}

// Initialize the email handler
new SimpleEmailHandler();
?>
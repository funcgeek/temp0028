<?php
// File: email_config.php

// Database Configuration
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

try {
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name}",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $smtp_host = $_POST['smtp_host'] ?? '';
    $smtp_port = intval($_POST['smtp_port'] ?? 0);
    $smtp_username = $_POST['smtp_username'] ?? '';
    $smtp_password = $_POST['smtp_password'] ?? '';
    $from_email = $_POST['from_email'] ?? '';
    $from_name = $_POST['from_name'] ?? '';
    
    try {
        // Check if config exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM email_config");
        $stmt->execute();
        $exists = $stmt->fetchColumn() > 0;
        
        if ($exists) {
            // Update
            $stmt = $pdo->prepare("
                UPDATE email_config 
                SET smtp_host = ?, smtp_port = ?, smtp_username = ?, smtp_password = ?, from_email = ?, from_name = ?
                LIMIT 1
            ");
        } else {
            // Insert
            $stmt = $pdo->prepare("
                INSERT INTO email_config 
                (smtp_host, smtp_port, smtp_username, smtp_password, from_email, from_name) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
        }
        
        $stmt->execute([$smtp_host, $smtp_port, $smtp_username, $smtp_password, $from_email, $from_name]);
        $message = 'Configuration saved successfully!';
    } catch (PDOException $e) {
        $message = 'Error saving configuration: ' . $e->getMessage();
    }
}

// Fetch current config
$current_config = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM email_config LIMIT 1");
    $stmt->execute();
    $current_config = $stmt->fetch();
} catch (PDOException $e) {
    $message = 'Error fetching configuration: ' . $e->getMessage();
}
?>

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="email-config-container">
            <h1>Email Configuration</h1>

            <?php if (isset($message)): ?>
                <div class="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="email-form">
                <div class="form-group">
                    <label>SMTP Host</label>
                    <input type="text" name="smtp_host" value="<?php echo $current_config['smtp_host'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>SMTP Port</label>
                    <input type="number" name="smtp_port" value="<?php echo $current_config['smtp_port'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>SMTP Username</label>
                    <input type="text" name="smtp_username" value="<?php echo $current_config['smtp_username'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>SMTP Password</label>
                    <input type="password" name="smtp_password" value="<?php echo $current_config['smtp_password'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>From Email</label>
                    <input type="email" name="from_email" value="<?php echo $current_config['from_email'] ?? ''; ?>" required>
                </div>

                <div class="form-group">
                    <label>From Name</label>
                    <input type="text" name="from_name" value="<?php echo $current_config['from_name'] ?? ''; ?>" required>
                </div>

                <button type="submit" class="btn-submit">Save Configuration</button>
            </form>
        </div>
    </section>
</section>

<style>
/* Container */
.email-config-container {
    max-width: 600px;
    margin: 40px auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Title */
.email-config-container h1 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 25px;
    color: #2c3e50;
    font-weight: 600;
}

/* Alert Message */
.alert {
    padding: 12px 15px;
    margin-bottom: 20px;
    background: #f1f9f1;
    border: 1px solid #a5d6a7;
    color: #2e7d32;
    border-radius: 8px;
    text-align: center;
    font-size: 14px;
}

/* Form styling */
.email-form .form-group {
    margin-bottom: 20px;
}

.email-form label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #34495e;
}

.email-form input {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.email-form input:focus {
    border-color: #3498db;
    box-shadow: 0 0 6px rgba(52,152,219,0.3);
}

/* Button */
.btn-submit {
    width: 100%;
    padding: 12px;
    background: #3498db;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-submit:hover {
    background: #2980b9;
    transform: translateY(-2px);
}
</style>

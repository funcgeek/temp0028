<?php
// Set the response header to JSON
header('Content-Type: application/json');

// --- Database Credentials ---
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

//$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

// --- Logic ---
$response = ['exists' => false]; // Default response

// Check if an email was sent via POST
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Only proceed if the email is not empty and looks like a valid email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // Establish Database Connection
        @$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // Check for connection errors
        if (!$conn->connect_error) {
            // Use a prepared statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT id FROM patient WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            // If a row is found, the email exists
            if ($stmt->num_rows > 0) {
                $response['exists'] = true;
            }

            $stmt->close();
            $conn->close();
        }
    }
}

// Send the JSON response back to the AJAX script
echo json_encode($response);
<?php
// upload_consent.php

// Enable CORS for cross-domain requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// --- Database Credentials ---
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

// Increase script timeout and memory limit for large files
set_time_limit(120);
ini_set('memory_limit', '256M');

// Check if patient_id is received
if (!isset($_POST['patient_id']) || !is_numeric($_POST['patient_id'])) {
    echo json_encode(['success' => false, 'message' => 'Error: Missing or invalid patient ID.']);
    exit;
}

$patient_id = (int)$_POST['patient_id'];

// Check if file is received
if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
    // Detailed error reporting for debugging
    $upload_error = isset($_FILES['pdf_file']['error']) ? $_FILES['pdf_file']['error'] : 'Unknown Error';
    echo json_encode(['success' => false, 'message' => 'Error: No file uploaded or upload error occurred. Code: ' . $upload_error]);
    exit;
}

// --- File Saving Logic ---
// Use a more robust path. __DIR__ gives the directory of the current PHP file.
$upload_dir = __DIR__ . '/uploads/ispecs_consent/'; 
$upload_date = date('Y-m-d H:i:s');
// Sanitize filename from the uploaded file for security
$original_filename = basename($_FILES['pdf_file']['name']);
$filename = $patient_id . '_' . time() . '_' . $original_filename; 
$upload_file_path = $upload_dir . $filename;
// The URL to save in the database should not have the full server path
$db_url = 'uploads/ispecs_consent/' . $filename;

// Create the upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0775, true)) {
        echo json_encode(['success' => false, 'message' => 'Error: Unable to create upload directory. Please check server permissions.']);
        exit;
    }
}

// Move the uploaded file to the destination
if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $upload_file_path)) {
    // --- Database Insertion Logic ---
    @$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        unlink($upload_file_path); // Delete the file if DB connection fails
        echo json_encode(['success' => false, 'message' => 'Error: Database connection failed.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO pdf_consent (patient_id, url, upload_date) VALUES (?, ?, ?)");
    // Note: We are saving the relative URL ($db_url) for portability
    $stmt->bind_param("iss", $patient_id, $db_url, $upload_date);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'File uploaded and record saved successfully.']);
    } else {
        unlink($upload_file_path); // Delete the file if DB insertion fails
        echo json_encode(['success' => false, 'message' => 'Error: Failed to save record to the database.']);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Error: Failed to save file. Please check directory permissions for ' . $upload_dir]);
}
?>
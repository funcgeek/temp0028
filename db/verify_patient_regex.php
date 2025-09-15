<?php
// Set the content type to JSON for the response
header('Content-Type: application/json');

// --- Database Credentials ---
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

// Establish a database connection
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if ($mysqli->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

// Check if the required POST data is received
if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['birthdate'])) {
    echo json_encode(['status' => 'error', 'message' => 'Incomplete data provided']);
    exit();
}

// Get and sanitize the input data
$first_name = trim(strtolower($_POST['first_name']));
$middle_name = isset($_POST['middle_name']) ? trim(strtolower($_POST['middle_name'])) : '';
$last_name = trim(strtolower($_POST['last_name']));
$birthdate = trim($_POST['birthdate']);

// If required fields are empty after trimming, do not proceed
if (empty($first_name) || empty($last_name) || empty($birthdate)) {
    // Send a 'not_exists' status so the form remains submittable until all fields are filled
    echo json_encode(['status' => 'not_exists']);
    exit();
}

// Prepare the SQL statement to prevent SQL injection
$sql = "SELECT id FROM patient WHERE LOWER(first_name) = ? AND LOWER(last_name) = ? AND birthdate = ?";
$params = [$first_name, $last_name, $birthdate];
$types = "sss";

// Dynamically add the middle name to the query only if it's provided
if (!empty($middle_name)) {
    $sql .= " AND LOWER(middle_name) = ?";
    $params[] = $middle_name;
    $types .= "s";
} else {
    // If middle name is empty, check for records where it's also empty or NULL
    $sql .= " AND (middle_name = '' OR middle_name IS NULL)";
}

$stmt = $mysqli->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$stmt->store_result();

// Check if any rows were found
if ($stmt->num_rows > 0) {
    // A duplicate was found
    echo json_encode(['status' => 'exists']);
} else {
    // No duplicate found
    echo json_encode(['status' => 'not_exists']);
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>
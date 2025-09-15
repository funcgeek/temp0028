<?php
// Database connection
$hostname = 'localhost';
$username = 'secureispecs_emr_setup';
$password = 'RukrIp69FR(0';
$database = 'secureispecs_emr';

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]);
    exit;
}

// Check if doctor_id is provided
if (isset($_POST['doctor_id']) && !empty($_POST['doctor_id'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $query = "SELECT id, name, lic_number, postnomials, profile FROM doctor WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => true, 'id' => $row['id'], 'name' => $row['name'], 'lic_number' => $row['lic_number'], 'postnomials' => $row['postnomials'], 'profile' => $row['profile']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Doctor not found']);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'No doctor ID provided']);
}

mysqli_close($conn);
?>
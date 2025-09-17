<?php
header('Content-Type: application/json');

// --- DATABASE CONNECTION ---
$db_host = "localhost";
$db_user = "secureispecs_emr_setup";
$db_pass = "RukrIp69FR(0";
$db_name = "secureispecs_emr";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

// Set timezone to Jamaica
date_default_timezone_set('America/Jamaica');

$patient_id = isset($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

if ($patient_id === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid patient ID.']);
    exit;
}

$invoices = [];
$sql = "SELECT id, invoice_number, submitted_on, total_amount FROM custom_invoice WHERE patient_id = ? ORDER BY submitted_on DESC";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $patient_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        // Format date for display
        $date = new DateTime($row['submitted_on']);
        $row['submitted_on_formatted'] = $date->format('d/m/Y');
        $invoices[] = $row;
    }
    mysqli_stmt_close($stmt);
    echo json_encode(['success' => true, 'invoices' => $invoices]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare query.']);
}

mysqli_close($conn);
?>
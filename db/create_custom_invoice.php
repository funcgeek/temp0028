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

// --- DATA RETRIEVAL & VALIDATION ---
$patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;
$user_id = 1; // Placeholder for actual logged-in user ID from session
$submitted_on = $_POST['submitted_on'] ?? '';
$due_date = $_POST['due_date'] ?? '';
$product_type = $_POST['product_type'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$notes = $_POST['notes'] ?? '';
$adjustments = isset($_POST['adjustments']) ? floatval($_POST['adjustments']) : 0.00;

$descriptions = $_POST['descriptions'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$unit_prices = $_POST['unit_prices'] ?? [];

if (empty($patient_id) || empty($submitted_on) || empty($due_date) || empty($descriptions)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

// --- CALCULATION ---
$subtotal = 0;
foreach ($quantities as $index => $qty) {
    $price = $unit_prices[$index] ?? 0;
    $subtotal += floatval($qty) * floatval($price);
}
$total_amount = $subtotal + $adjustments;

// --- PREPARE DATA FOR DB ---
$invoice_number = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
$descriptions_str = implode(',', $descriptions);
$quantities_str = implode(',', $quantities);
$unit_prices_str = implode(',', $unit_prices);

// --- DATABASE INSERT ---
$sql = "INSERT INTO custom_invoice (patient_id, user_id, invoice_number, submitted_on, due_date, product_type, product_name, descriptions, quantities, unit_prices, notes, adjustments, subtotal, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "iisssssssssddd", 
        $patient_id, 
        $user_id, 
        $invoice_number, 
        $submitted_on, 
        $due_date, 
        $product_type, 
        $product_name, 
        $descriptions_str, 
        $quantities_str, 
        $unit_prices_str, 
        $notes, 
        $adjustments, 
        $subtotal, 
        $total_amount
    );

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Invoice created successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to execute query.']);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare query.']);
}

mysqli_close($conn);
?>
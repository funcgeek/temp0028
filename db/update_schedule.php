<?php
header('Content-Type: application/json');

// Database Credentials
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

// Establish Database Connection
@$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form fields
    $missing_fields = [];
    if (empty($_POST['id'])) $missing_fields[] = 'id';
    if (empty($_POST['doctor'])) $missing_fields[] = 'doctor';
    if (empty($_POST['weekday'])) $missing_fields[] = 'weekday';
    if (empty($_POST['s_time'])) $missing_fields[] = 's_time';
    if (empty($_POST['e_time'])) $missing_fields[] = 'e_time';
    if (empty($_POST['duration'])) $missing_fields[] = 'duration';

    if (!empty($missing_fields)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing fields: ' . implode(', ', $missing_fields)]);
        exit;
    }

    $id = (int)$_POST['id'];
    $doctor_id = (int)$_POST['doctor'];
    $weekday = $_POST['weekday'];
    $s_time = date('H:i', strtotime($_POST['s_time'])); // Convert to 24-hour format
    $e_time = date('H:i', strtotime($_POST['e_time'])); // Convert to 24-hour format
    $duration = (int)$_POST['duration'];

    // Update the schedule
    $stmt_update = $conn->prepare("UPDATE time_schedule SET doctor=?, weekday=?, s_time=?, e_time=?, duration=? WHERE id=?");
    $stmt_update->bind_param("isssii", $doctor_id, $weekday, $s_time, $e_time, $duration, $id);

    if ($stmt_update->execute()) {
        // Fetch the updated row data
        $stmt_updated_row = $conn->prepare("
            SELECT ts.id, d.name as doctor_name, ts.weekday, ts.s_time, ts.e_time, ts.duration
            FROM time_schedule ts
            JOIN doctor d ON ts.doctor = d.id
            WHERE ts.id = ?
        ");
        $stmt_updated_row->bind_param("i", $id);
        $stmt_updated_row->execute();
        $updated_row_data = $stmt_updated_row->get_result()->fetch_assoc();
        
        echo json_encode(['status' => 'success', 'message' => 'Schedule updated successfully!', 'updated_row' => $updated_row_data]);
        $stmt_updated_row->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update schedule: ' . $stmt_update->error]);
    }
    $stmt_update->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>
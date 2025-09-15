<?php
header('Content-Type: application/json');

// --- Database Credentials ---
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

// Establish Database Connection
@$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'OMO connection failed: ' . $conn->connect_error]);
    exit;
}

// --- LOGIC TO HANDLE DIFFERENT REQUESTS ---

// ACTION 1: FETCH a single schedule's data for the modal form
if (isset($_GET['fetch_id']) && is_numeric($_GET['fetch_id'])) {
    $schedule_id = (int)$_GET['fetch_id'];
    
    // Fetch schedule details
    $stmt_schedule = $conn->prepare("SELECT id, doctor, weekday, s_time, e_time, duration FROM time_schedule WHERE id = ?");
    $stmt_schedule->bind_param("i", $schedule_id);
    $stmt_schedule->execute();
    $result_schedule = $stmt_schedule->get_result();
    $schedule_data = $result_schedule->fetch_assoc();
    $stmt_schedule->close();

    // Fetch all doctors for the dropdown
    $doctors = [];
    $result_doctors = $conn->query("SELECT id, name FROM doctor");
    while ($row = $result_doctors->fetch_assoc()) {
        $doctors[] = $row;
    }

    if ($schedule_data) {
        echo json_encode(['status' => 'success', 'schedule' => $schedule_data, 'doctors' => $doctors]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Schedule not found.']);
    }
}

// ACTION 2: UPDATE a schedule's data from the submitted form
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation
    if (empty($_POST['id']) || empty($_POST['doctor']) || empty($_POST['weekday']) || empty($_POST['s_time']) || empty($_POST['e_time']) || empty($_POST['duration'])) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    $id = (int)$_POST['id'];
    $doctor_id = (int)$_POST['doctor'];
    $weekday = $_POST['weekday'];
    $s_time = $_POST['s_time'];
    $e_time = $_POST['e_time'];
    $duration = $_POST['duration'];

    $stmt_update = $conn->prepare("UPDATE time_schedule SET doctor=?, weekday=?, s_time=?, e_time=?, duration=? WHERE id=?");
    $stmt_update->bind_param("isssii", $doctor_id, $weekday, $s_time, $e_time, $duration, $id);

    if ($stmt_update->execute()) {
        // Fetch the updated row data to send back to the page
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
}

$conn->close();
?>
<?php
// Database connection
$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect and sanitize input data
$patient_id = mysqli_real_escape_string($conn, $_POST['patient']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
// Convert date from d-m-Y to Y-m-d
$date = DateTime::createFromFormat('d-m-Y', $date);
$date = $date->format('Y-m-d');

// Old Rx Right
$old_rx_r_sphere = mysqli_real_escape_string($conn, $_POST['old_rx_r_sphere']);
$old_rx_r_cylinder = mysqli_real_escape_string($conn, $_POST['old_rx_r_cylinder']);
$old_rx_r_axis = mysqli_real_escape_string($conn, $_POST['old_rx_r_axis']);

// Old Rx Left
$old_rx_l_sphere = mysqli_real_escape_string($conn, $_POST['old_rx_l_sphere']);
$old_rx_l_cylinder = mysqli_real_escape_string($conn, $_POST['old_rx_l_cylinder']);
$old_rx_l_axis = mysqli_real_escape_string($conn, $_POST['old_rx_l_axis']);

// New Rx Right
$new_rx_r_sphere = mysqli_real_escape_string($conn, $_POST['new_rx_r_sphere']);
$new_rx_r_cylinder = mysqli_real_escape_string($conn, $_POST['new_rx_r_cylinder']);
$new_rx_r_axis = mysqli_real_escape_string($conn, $_POST['new_rx_r_axis']);
$new_rx_r_prism = mysqli_real_escape_string($conn, $_POST['new_rx_r_prism']);
$new_rx_r_add = mysqli_real_escape_string($conn, $_POST['new_rx_r_add']);
$new_rx_r_seght = mysqli_real_escape_string($conn, $_POST['new_rx_r_seght']);
$new_rx_r_pd = mysqli_real_escape_string($conn, $_POST['new_rx_r_pd']);

// New Rx Left
$new_rx_l_sphere = mysqli_real_escape_string($conn, $_POST['new_rx_l_sphere']);
$new_rx_l_cylinder = mysqli_real_escape_string($conn, $_POST['new_rx_l_cylinder']);
$new_rx_l_axis = mysqli_real_escape_string($conn, $_POST['new_rx_l_axis']);
$new_rx_l_prism = mysqli_real_escape_string($conn, $_POST['new_rx_l_prism']);
$new_rx_l_add = mysqli_real_escape_string($conn, $_POST['new_rx_l_add']);
$new_rx_l_seght = mysqli_real_escape_string($conn, $_POST['new_rx_l_seght']);
$new_rx_l_pd = mysqli_real_escape_string($conn, $_POST['new_rx_l_pd']);

// Recommendations
$rec_clear = mysqli_real_escape_string($conn, $_POST['rec_clear']);
$rec_transition = mysqli_real_escape_string($conn, $_POST['rec_transition']);
$rec_arc = mysqli_real_escape_string($conn, $_POST['rec_arc']);
$rec_blue_filter = mysqli_real_escape_string($conn, $_POST['rec_blue_filter']);
$rec_tint = mysqli_real_escape_string($conn, $_POST['rec_tint']);
$rec_other = mysqli_real_escape_string($conn, $_POST['rec_other']);

// Lens type
$lens_single_version = mysqli_real_escape_string($conn, $_POST['lens_single_version']);
$lens_bifocal = mysqli_real_escape_string($conn, $_POST['lens_bifocal']);
$lens_progressive = mysqli_real_escape_string($conn, $_POST['lens_progressive']);
$lens_other = mysqli_real_escape_string($conn, $_POST['lens_other']);

// Doctor
$doctor_id = mysqli_real_escape_string($conn, $_POST['doctor']);

// Insert into database
$sql = "INSERT INTO new_glass_presc (
    patient_id, age, date, 
    old_rx_r_sphere, old_rx_r_cylinder, old_rx_r_axis, 
    old_rx_l_sphere, old_rx_l_cylinder, old_rx_l_axis, 
    new_rx_r_sphere, new_rx_r_cylinder, new_rx_r_axis, new_rx_r_prism, new_rx_r_add, new_rx_r_seght, new_rx_r_pd, 
    new_rx_l_sphere, new_rx_l_cylinder, new_rx_l_axis, new_rx_l_prism, new_rx_l_add, new_rx_l_seght, new_rx_l_pd, 
    rec_clear, rec_transition, rec_arc, rec_blue_filter, rec_tint, rec_other, 
    lens_single_version, lens_bifocal, lens_progressive, lens_other, 
    doctor_id
) VALUES (
    '$patient_id', '$age', '$date', 
    '$old_rx_r_sphere', '$old_rx_r_cylinder', '$old_rx_r_axis', 
    '$old_rx_l_sphere', '$old_rx_l_cylinder', '$old_rx_l_axis', 
    '$new_rx_r_sphere', '$new_rx_r_cylinder', '$new_rx_r_axis', '$new_rx_r_prism', '$new_rx_r_add', '$new_rx_r_seght', '$new_rx_r_pd', 
    '$new_rx_l_sphere', '$new_rx_l_cylinder', '$new_rx_l_axis', '$new_rx_l_prism', '$new_rx_l_add', '$new_rx_l_seght', '$new_rx_l_pd', 
    '$rec_clear', '$rec_transition', '$rec_arc', '$rec_blue_filter', '$rec_tint', '$rec_other', 
    '$lens_single_version', '$lens_bifocal', '$lens_progressive', '$lens_other', 
    '$doctor_id'
)";

if (mysqli_query($conn, $sql)) {
    $new_id = mysqli_insert_id($conn);
    // Redirect to the given URL with the new ID
    header("Location: https://secure-emr.ispecsappeal.net/patient/glassPrescriptions?id=" . $new_id);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
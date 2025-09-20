<?php
// Database connection
$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the ID from URL parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch prescription data
$sql = "SELECT * FROM new_glass_presc WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Prescription not found");
}

$prescription = mysqli_fetch_assoc($result);

// Fetch patient data
$patient_id = $prescription['patient_id'];
$patient_sql = "SELECT * FROM patient WHERE id = $patient_id";
$patient_result = mysqli_query($conn, $patient_sql);
$patient = mysqli_fetch_assoc($patient_result);

// Fetch doctor data
$doctor_id = $prescription['doctor_id'];
$doctor_sql = "SELECT * FROM doctor WHERE id = $doctor_id";
$doctor_result = mysqli_query($conn, $doctor_sql);
$doctor = mysqli_fetch_assoc($doctor_result);

// Fetch all patients and doctors for dropdowns
$patients_sql = "SELECT id, name FROM patient ORDER BY name";
$patients_result = mysqli_query($conn, $patients_sql);

$doctors_sql = "SELECT id, name FROM doctor ORDER BY name";
$doctors_result = mysqli_query($conn, $doctors_sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input data
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient']);
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
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

    // Update query
    $update_sql = "UPDATE new_glass_presc SET 
        patient_id = '$patient_id',
        doctor_id = '$doctor_id',
        date = '$date',
        old_rx_r_sphere = '$old_rx_r_sphere',
        old_rx_r_cylinder = '$old_rx_r_cylinder',
        old_rx_r_axis = '$old_rx_r_axis',
        old_rx_l_sphere = '$old_rx_l_sphere',
        old_rx_l_cylinder = '$old_rx_l_cylinder',
        old_rx_l_axis = '$old_rx_l_axis',
        new_rx_r_sphere = '$new_rx_r_sphere',
        new_rx_r_cylinder = '$new_rx_r_cylinder',
        new_rx_r_axis = '$new_rx_r_axis',
        new_rx_r_prism = '$new_rx_r_prism',
        new_rx_r_add = '$new_rx_r_add',
        new_rx_r_seght = '$new_rx_r_seght',
        new_rx_r_pd = '$new_rx_r_pd',
        new_rx_l_sphere = '$new_rx_l_sphere',
        new_rx_l_cylinder = '$new_rx_l_cylinder',
        new_rx_l_axis = '$new_rx_l_axis',
        new_rx_l_prism = '$new_rx_l_prism',
        new_rx_l_add = '$new_rx_l_add',
        new_rx_l_seght = '$new_rx_l_seght',
        new_rx_l_pd = '$new_rx_l_pd',
        rec_clear = '$rec_clear',
        rec_transition = '$rec_transition',
        rec_arc = '$rec_arc',
        rec_blue_filter = '$rec_blue_filter',
        rec_tint = '$rec_tint',
        rec_other = '$rec_other',
        lens_single_version = '$lens_single_version',
        lens_bifocal = '$lens_bifocal',
        lens_progressive = '$lens_progressive',
        lens_other = '$lens_other'
        WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        $success_message = "Prescription updated successfully!";
        // Refresh the data
        $result = mysqli_query($conn, "SELECT * FROM new_glass_presc WHERE id = $id");
        $prescription = mysqli_fetch_assoc($result);
    } else {
        $error_message = "Error updating prescription: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 30px;
        }
        .card-header {
            background: linear-gradient(to right, #3498db, #2c3e50);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        .btn-primary {
            background: linear-gradient(to right, #3498db, #2c3e50);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #2c3e50, #3498db);
        }
        .form-label {
            font-weight: 600;
        }
        .rx-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .rx-table th, .rx-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .rx-table th {
            background-color: #f2f2f2;
        }
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
        }
        .back-btn {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-edit me-3"></i>Edit Glass Prescription</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="glassPrescriptionsList.php" class="btn btn-light"><i class="fas fa-arrow-left me-2"></i>Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (isset($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h5 class="m-0"><i class="fas fa-pencil-alt me-2"></i>Edit Prescription #<?php echo $prescription['id']; ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="patient" class="form-label">Patient</label>
                            <select class="form-select" id="patient" name="patient" required>
                                <option value="">Select Patient</option>
                                <?php while ($pat = mysqli_fetch_assoc($patients_result)): ?>
                                <option value="<?php echo $pat['id']; ?>" <?php echo $pat['id'] == $prescription['patient_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($pat['name']); ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="doctor" class="form-label">Doctor</label>
                            <select class="form-select" id="doctor" name="doctor" required>
                                <option value="">Select Doctor</option>
                                <?php while ($doc = mysqli_fetch_assoc($doctors_result)): ?>
                                <option value="<?php echo $doc['id']; ?>" <?php echo $doc['id'] == $prescription['doctor_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($doc['name']); ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo $prescription['date']; ?>" required>
                        </div>
                    </div>

                    <h5 class="mb-3">Old Rx</h5>
                    <table class="rx-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Sphere</th>
                                <th>Cylinder</th>
                                <th>Axis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>R</strong></td>
                                <td><input type="text" class="form-control" name="old_rx_r_sphere" value="<?php echo htmlspecialchars($prescription['old_rx_r_sphere']); ?>"></td>
                                <td><input type="text" class="form-control" name="old_rx_r_cylinder" value="<?php echo htmlspecialchars($prescription['old_rx_r_cylinder']); ?>"></td>
                                <td><input type="text" class="form-control" name="old_rx_r_axis" value="<?php echo htmlspecialchars($prescription['old_rx_r_axis']); ?>"></td>
                            </tr>
                            <tr>
                                <td><strong>L</strong></td>
                                <td><input type="text" class="form-control" name="old_rx_l_sphere" value="<?php echo htmlspecialchars($prescription['old_rx_l_sphere']); ?>"></td>
                                <td><input type="text" class="form-control" name="old_rx_l_cylinder" value="<?php echo htmlspecialchars($prescription['old_rx_l_cylinder']); ?>"></td>
                                <td><input type="text" class="form-control" name="old_rx_l_axis" value="<?php echo htmlspecialchars($prescription['old_rx_l_axis']); ?>"></td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mb-3">New Rx</h5>
                    <table class="rx-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Sphere</th>
                                <th>Cylinder</th>
                                <th>Axis</th>
                                <th>Prism</th>
                                <th>ADD</th>
                                <th>Seg HT</th>
                                <th>PD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>R</strong></td>
                                <td><input type="text" class="form-control" name="new_rx_r_sphere" value="<?php echo htmlspecialchars($prescription['new_rx_r_sphere']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_cylinder" value="<?php echo htmlspecialchars($prescription['new_rx_r_cylinder']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_axis" value="<?php echo htmlspecialchars($prescription['new_rx_r_axis']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_prism" value="<?php echo htmlspecialchars($prescription['new_rx_r_prism']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_add" value="<?php echo htmlspecialchars($prescription['new_rx_r_add']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_seght" value="<?php echo htmlspecialchars($prescription['new_rx_r_seght']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_r_pd" value="<?php echo htmlspecialchars($prescription['new_rx_r_pd']); ?>"></td>
                            </tr>
                            <tr>
                                <td><strong>L</strong></td>
                                <td><input type="text" class="form-control" name="new_rx_l_sphere" value="<?php echo htmlspecialchars($prescription['new_rx_l_sphere']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_cylinder" value="<?php echo htmlspecialchars($prescription['new_rx_l_cylinder']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_axis" value="<?php echo htmlspecialchars($prescription['new_rx_l_axis']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_prism" value="<?php echo htmlspecialchars($prescription['new_rx_l_prism']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_add" value="<?php echo htmlspecialchars($prescription['new_rx_l_add']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_seght" value="<?php echo htmlspecialchars($prescription['new_rx_l_seght']); ?>"></td>
                                <td><input type="text" class="form-control" name="new_rx_l_pd" value="<?php echo htmlspecialchars($prescription['new_rx_l_pd']); ?>"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Recommendations</h5>
                            <div class="mb-3">
                                <label class="form-label">Clear</label>
                                <input type="text" class="form-control" name="rec_clear" value="<?php echo htmlspecialchars($prescription['rec_clear']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Transition</label>
                                <input type="text" class="form-control" name="rec_transition" value="<?php echo htmlspecialchars($prescription['rec_transition']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ARC</label>
                                <input type="text" class="form-control" name="rec_arc" value="<?php echo htmlspecialchars($prescription['rec_arc']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Blue Filter</label>
                                <input type="text" class="form-control" name="rec_blue_filter" value="<?php echo htmlspecialchars($prescription['rec_blue_filter']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tint</label>
                                <input type="text" class="form-control" name="rec_tint" value="<?php echo htmlspecialchars($prescription['rec_tint']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Other</label>
                                <input type="text" class="form-control" name="rec_other" value="<?php echo htmlspecialchars($prescription['rec_other']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Lens Type</h5>
                            <div class="mb-3">
                                <label class="form-label">Single Vision</label>
                                <input type="text" class="form-control" name="lens_single_version" value="<?php echo htmlspecialchars($prescription['lens_single_version']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bifocal</label>
                                <input type="text" class="form-control" name="lens_bifocal" value="<?php echo htmlspecialchars($prescription['lens_bifocal']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Progressive</label>
                                <input type="text" class="form-control" name="lens_progressive" value="<?php echo htmlspecialchars($prescription['lens_progressive']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Other</label>
                                <input type="text" class="form-control" name="lens_other" value="<?php echo htmlspecialchars($prescription['lens_other']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="glassPrescriptionsList.php" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Prescription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

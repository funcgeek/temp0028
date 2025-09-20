<?php
// --- CONFIGURATION & INITIALIZATION ---
// It's highly recommended to place your database credentials in a separate, secure file.
$db_host = "localhost";
$db_user = "secureispecs_emr_setup";
$db_pass = "RukrIp69FR(0";
$db_name = "secureispecs_emr";

// Establish a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection for errors
if (!$conn) {
    // Use a generic error message for security
    die("Database connection failed. Please try again later.");
}

// Initialize variables
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$prescription = null;
$patients = [];
$doctors = [];
$success_message = '';
$error_message = '';

// --- DATA HANDLING (POST REQUEST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {
    // Use a prepared statement to prevent SQL injection
    $sql = "UPDATE new_glass_presc SET 
            patient_id = ?, doctor_id = ?, date = ?,
            old_rx_r_sphere = ?, old_rx_r_cylinder = ?, old_rx_r_axis = ?,
            old_rx_l_sphere = ?, old_rx_l_cylinder = ?, old_rx_l_axis = ?,
            new_rx_r_sphere = ?, new_rx_r_cylinder = ?, new_rx_r_axis = ?, new_rx_r_prism = ?, new_rx_r_add = ?, new_rx_r_seght = ?, new_rx_r_pd = ?,
            new_rx_l_sphere = ?, new_rx_l_cylinder = ?, new_rx_l_axis = ?, new_rx_l_prism = ?, new_rx_l_add = ?, new_rx_l_seght = ?, new_rx_l_pd = ?,
            rec_clear = ?, rec_transition = ?, rec_arc = ?, rec_blue_filter = ?, rec_tint = ?, rec_other = ?,
            lens_single_version = ?, lens_bifocal = ?, lens_progressive = ?, lens_other = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters from the $_POST array
    mysqli_stmt_bind_param($stmt, "iissssssssssssssssssssssssssssssi", 
        $_POST['patient'], $_POST['doctor'], $_POST['date'],
        $_POST['old_rx_r_sphere'], $_POST['old_rx_r_cylinder'], $_POST['old_rx_r_axis'],
        $_POST['old_rx_l_sphere'], $_POST['old_rx_l_cylinder'], $_POST['old_rx_l_axis'],
        $_POST['new_rx_r_sphere'], $_POST['new_rx_r_cylinder'], $_POST['new_rx_r_axis'], $_POST['new_rx_r_prism'], $_POST['new_rx_r_add'], $_POST['new_rx_r_seght'], $_POST['new_rx_r_pd'],
        $_POST['new_rx_l_sphere'], $_POST['new_rx_l_cylinder'], $_POST['new_rx_l_axis'], $_POST['new_rx_l_prism'], $_POST['new_rx_l_add'], $_POST['new_rx_l_seght'], $_POST['new_rx_l_pd'],
        $_POST['rec_clear'], $_POST['rec_transition'], $_POST['rec_arc'], $_POST['rec_blue_filter'], $_POST['rec_tint'], $_POST['rec_other'],
        $_POST['lens_single_version'], $_POST['lens_bifocal'], $_POST['lens_progressive'], $_POST['lens_other'],
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Prescription updated successfully!";
    } else {
        $error_message = "Error: Could not update the prescription.";
    }
    mysqli_stmt_close($stmt);
}

// --- DATA FETCHING (GET REQUEST) ---
if ($id > 0) {
    // Fetch the specific prescription to edit
    $stmt = mysqli_prepare($conn, "SELECT * FROM new_glass_presc WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $prescription = mysqli_fetch_assoc($result);
    } else {
        die("Prescription not found.");
    }
    mysqli_stmt_close($stmt);

    // Fetch all patients for the dropdown
    $patients_result = mysqli_query($conn, "SELECT id, name FROM patient ORDER BY name");
    while ($row = mysqli_fetch_assoc($patients_result)) {
        $patients[] = $row;
    }

    // Fetch all doctors for the dropdown
    $doctors_result = mysqli_query($conn, "SELECT id, name FROM doctor ORDER BY name");
    while ($row = mysqli_fetch_assoc($doctors_result)) {
        $doctors[] = $row;
    }
} else {
    die("No prescription ID provided.");
}

// Close the database connection
mysqli_close($conn);
?>


    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa; /* A light, neutral background */
        }
        .main-container {
            max-width: 800px; /* Set the maximum width */
            margin: 40px auto; /* Center the container and add vertical space */
        }
        .rx-table input {
            /* Ensures input fields in tables are consistent */
            min-width: 60px;
            text-align: center;
        }
    </style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <div class="container main-container">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h1 class="h3"><i class="fas fa-edit me-2"></i>Edit Glass Prescription</h1>
            <a href="https://secure-emr.ispecsappeal.net/prescription/glassPrescriptionsList" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Back to List</a>
        </div>

        <?php if ($success_message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Editing Prescription #<?php echo htmlspecialchars($prescription['id']); ?></h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="patient" class="form-label fw-bold">Patient</label>
                            <select class="form-select" id="patient" name="patient" required>
                                <option value="">Select...</option>
                                <?php foreach ($patients as $pat): ?>
                                <option value="<?php echo $pat['id']; ?>" <?php echo ($pat['id'] == $prescription['patient_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($pat['name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="doctor" class="form-label fw-bold">Doctor</label>
                            <select class="form-select" id="doctor" name="doctor" required>
                                <option value="">Select...</option>
                                <?php foreach ($doctors as $doc): ?>
                                <option value="<?php echo $doc['id']; ?>" <?php echo ($doc['id'] == $prescription['doctor_id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($doc['name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label fw-bold">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($prescription['date']); ?>" required>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h5 class="mt-4 mb-3">Old Rx</h5>
                        <table class="table table-bordered text-center rx-table">
                            <thead class="table-light">
                                <tr>
                                    <th></th><th>Sphere</th><th>Cylinder</th><th>Axis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">R</td>
                                    <td><input type="text" class="form-control" name="old_rx_r_sphere" value="<?php echo htmlspecialchars($prescription['old_rx_r_sphere']); ?>"></td>
                                    <td><input type="text" class="form-control" name="old_rx_r_cylinder" value="<?php echo htmlspecialchars($prescription['old_rx_r_cylinder']); ?>"></td>
                                    <td><input type="text" class="form-control" name="old_rx_r_axis" value="<?php echo htmlspecialchars($prescription['old_rx_r_axis']); ?>"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">L</td>
                                    <td><input type="text" class="form-control" name="old_rx_l_sphere" value="<?php echo htmlspecialchars($prescription['old_rx_l_sphere']); ?>"></td>
                                    <td><input type="text" class="form-control" name="old_rx_l_cylinder" value="<?php echo htmlspecialchars($prescription['old_rx_l_cylinder']); ?>"></td>
                                    <td><input type="text" class="form-control" name="old_rx_l_axis" value="<?php echo htmlspecialchars($prescription['old_rx_l_axis']); ?>"></td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mt-4 mb-3">New Rx</h5>
                        <table class="table table-bordered text-center rx-table">
                             <thead class="table-light">
                                <tr>
                                    <th></th><th>Sphere</th><th>Cylinder</th><th>Axis</th><th>Prism</th><th>ADD</th><th>Seg HT</th><th>PD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">R</td>
                                    <td><input type="text" class="form-control" name="new_rx_r_sphere" value="<?php echo htmlspecialchars($prescription['new_rx_r_sphere']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_cylinder" value="<?php echo htmlspecialchars($prescription['new_rx_r_cylinder']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_axis" value="<?php echo htmlspecialchars($prescription['new_rx_r_axis']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_prism" value="<?php echo htmlspecialchars($prescription['new_rx_r_prism']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_add" value="<?php echo htmlspecialchars($prescription['new_rx_r_add']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_seght" value="<?php echo htmlspecialchars($prescription['new_rx_r_seght']); ?>"></td>
                                    <td><input type="text" class="form-control" name="new_rx_r_pd" value="<?php echo htmlspecialchars($prescription['new_rx_r_pd']); ?>"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">L</td>
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
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Recommendations</h5>
                            <input type="text" class="form-control mb-2" name="rec_clear" placeholder="Clear" value="<?php echo htmlspecialchars($prescription['rec_clear']); ?>">
                            <input type="text" class="form-control mb-2" name="rec_transition" placeholder="Transition" value="<?php echo htmlspecialchars($prescription['rec_transition']); ?>">
                            <input type="text" class="form-control mb-2" name="rec_arc" placeholder="ARC" value="<?php echo htmlspecialchars($prescription['rec_arc']); ?>">
                            <input type="text" class="form-control mb-2" name="rec_blue_filter" placeholder="Blue Filter" value="<?php echo htmlspecialchars($prescription['rec_blue_filter']); ?>">
                            <input type="text" class="form-control mb-2" name="rec_tint" placeholder="Tint" value="<?php echo htmlspecialchars($prescription['rec_tint']); ?>">
                            <input type="text" class="form-control" name="rec_other" placeholder="Other" value="<?php echo htmlspecialchars($prescription['rec_other']); ?>">
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Lens Type</h5>
                            <input type="text" class="form-control mb-2" name="lens_single_version" placeholder="Single Vision" value="<?php echo htmlspecialchars($prescription['lens_single_version']); ?>">
                            <input type="text" class="form-control mb-2" name="lens_bifocal" placeholder="Bifocal" value="<?php echo htmlspecialchars($prescription['lens_bifocal']); ?>">
                            <input type="text" class="form-control mb-2" name="lens_progressive" placeholder="Progressive" value="<?php echo htmlspecialchars($prescription['lens_progressive']); ?>">
                            <input type="text" class="form-control" name="lens_other" placeholder="Other" value="<?php echo htmlspecialchars($prescription['lens_other']); ?>">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <a href="https://secure-emr.ispecsappeal.net/prescription/glassPrescriptionsList" class="btn btn-light me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Prescription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

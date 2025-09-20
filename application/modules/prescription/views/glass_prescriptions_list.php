<?php
// Database connection
// It's recommended to use a separate config file for credentials
$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all prescriptions with patient and doctor information
$sql = "SELECT ngp.*, p.name as patient_name, d.name as doctor_name 
        FROM new_glass_presc ngp
        LEFT JOIN patient p ON ngp.patient_id = p.id
        LEFT JOIN doctor d ON ngp.doctor_id = d.id
        ORDER BY ngp.id DESC";
$result = mysqli_query($conn, $sql);

$prescriptions = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $prescriptions[] = $row;
    }
}

// Calculate stats
$total_doctors = count(array_unique(array_column($prescriptions, 'doctor_name')));
$total_patients = count(array_unique(array_column($prescriptions, 'patient_name')));
$total_prescriptions = count($prescriptions);

mysqli_close($conn);
?>

   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .main-container {
            max-width: 800px; /* Set max width */
            margin: 40px auto; /* Center the container with vertical margin */
        }
    </style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <div class="container main-container">

        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h1 class="h3"><i class="fas fa-glasses me-2"></i>Glass Prescriptions</h1>
            <a href="https://secure-emr.ispecsappeal.net/prescription/addGlassPrescriptionView" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i>New Prescription</a>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary text-center">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_prescriptions; ?></h4>
                        <p class="card-text small">Total</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success text-center">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_doctors; ?></h4>
                        <p class="card-text small">Doctors</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info text-center">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_patients; ?></h4>
                        <p class="card-text small">Patients</p>
                    </div>
                </div>
            </div>
             <div class="col-md-3">
                <div class="card text-white bg-secondary text-center">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_prescriptions; ?></h4>
                        <p class="card-text small">To Print</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Prescription List</h5>
            </div>
            <div class="card-body">
                <table id="prescriptionsTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prescriptions as $prescription): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($prescription['id']); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($prescription['date'])); ?></td>
                            <td><?php echo !empty($prescription['doctor_name']) ? htmlspecialchars($prescription['doctor_name']) : 'N/A'; ?></td>
                            <td><?php echo !empty($prescription['patient_name']) ? htmlspecialchars($prescription['patient_name']) : 'N/A'; ?></td>
                            <td><span class="badge bg-info-subtle text-info-emphasis">Ready</span></td>
                            <td>
                                <a href="https://secure-emr.ispecsappeal.net/prescription/glassPrescription?id=<?php echo $prescription['id']; ?>" class="btn btn-sm btn-outline-secondary" title="View">View <i class="fas fa-eye"></i></a>
                                <a href="https://secure-emr.ispecsappeal.net/prescription/editGlassPrescription?id=<?php echo $prescription['id']; ?>" class="btn btn-sm btn-outline-secondary" title="Edit">Edit <i class="fas fa-edit"></i></a>
                                <!-- <a href="https://secure-emr.ispecsappeal.net/prescription/print_prescription.php?id=<?php echo $prescription['id']; ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Print"><i class="fas fa-print"></i></a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#prescriptionsTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100]
            });
        });
    </script>


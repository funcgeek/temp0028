<?php
// Database connection
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

mysqli_close($conn);
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
            transition: all 0.3s;
        }
        
        .view-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
        }
        
        .view-btn:hover {
            background-color: #27ae60;
        }
        
        .edit-btn {
            background-color: #f39c12;
            color: white;
            border: none;
        }
        
        .edit-btn:hover {
            background-color: #d35400;
        }
        
        .print-btn {
            background-color: #9b59b6;
            color: white;
            border: none;
        }
        
        .print-btn:hover {
            background-color: #8e44ad;
        }
        
        .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 15px;
            border: 1px solid #ddd;
        }
        
        .dataTables_length select {
            border-radius: 20px;
            padding: 5px 15px;
            border: 1px solid #ddd;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .pagination .page-link {
            color: var(--secondary-color);
        }
        
        .stats-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            margin-bottom: 20px;
        }
        
        .stats-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .stats-card .count {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .stats-card .label {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .card-1 {
            background: linear-gradient(135deg, #3498db, #2c3e50);
        }
        
        .card-2 {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }
        
        .card-3 {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
        }
        
        .card-4 {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }
        
        .btn-add {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            color: white;
        }
    </style>

    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-glasses me-3"></i>Glass Prescriptions</h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="add_prescription_glass.php" class="btn btn-add"><i class="fas fa-plus-circle me-2"></i>Add New Prescription</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card card-1">
                    <i class="fas fa-file-prescription"></i>
                    <div class="count"><?php echo count($prescriptions); ?></div>
                    <div class="label">Total Prescriptions</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-2">
                    <i class="fas fa-user-md"></i>
                    <?php
                    $doctors = [];
                    foreach ($prescriptions as $prescription) {
                        if (!empty($prescription['doctor_name']) && !in_array($prescription['doctor_name'], $doctors)) {
                            $doctors[] = $prescription['doctor_name'];
                        }
                    }
                    ?>
                    <div class="count"><?php echo count($doctors); ?></div>
                    <div class="label">Doctors</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-3">
                    <i class="fas fa-users"></i>
                    <?php
                    $patients = [];
                    foreach ($prescriptions as $prescription) {
                        if (!empty($prescription['patient_name']) && !in_array($prescription['patient_name'], $patients)) {
                            $patients[] = $prescription['patient_name'];
                        }
                    }
                    ?>
                    <div class="count"><?php echo count($patients); ?></div>
                    <div class="label">Patients</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card card-4">
                    <i class="fas fa-print"></i>
                    <div class="count"><?php echo count($prescriptions); ?></div>
                    <div class="label">Available for Print</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0"><i class="fas fa-list me-2"></i>Prescription List</h5>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light" title="Copy"><i class="fas fa-copy"></i></button>
                        <button type="button" class="btn btn-sm btn-light" title="Excel"><i class="fas fa-file-excel"></i></button>
                        <button type="button" class="btn btn-sm btn-light" title="CSV"><i class="fas fa-file-csv"></i></button>
                        <button type="button" class="btn btn-sm btn-light" title="PDF"><i class="fas fa-file-pdf"></i></button>
                        <button type="button" class="btn btn-sm btn-light" title="Print" onclick="window.print();"><i class="fas fa-print"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="prescriptionsTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Glass Frames</th>
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
                            <td>
                                <span class="badge bg-info">Prescription Ready</span>
                            </td>
                            <td>
                                <a href="glassPrescriptions.php?id=<?php echo $prescription['id']; ?>" class="action-btn view-btn" title="View Prescription">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="edit_prescription_glass.php?id=<?php echo $prescription['id']; ?>" class="action-btn edit-btn" title="Edit Prescription">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="print_prescription.php?id=<?php echo $prescription['id']; ?>" target="_blank" class="action-btn print-btn" title="Print Prescription">
                                    <i class="fas fa-print"></i> Print
                                </a>
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
                "lengthMenu": [10, 25, 50, 100],
                "language": {
                    "search": "Search...",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>

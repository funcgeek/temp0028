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

mysqli_close($conn);

// Calculate patient age
$birthDate = new DateTime($patient['birthdate']);
$today = new DateTime('today');
$age = $birthDate->diff($today)->y;

// Format the date
$date = date('F j, Y', strtotime($prescription['date']));
?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .action-buttons {
            text-align: center;
            padding: 20px;
        }
        .action-buttons .btn {
            margin: 5px;
            min-width: 150px;
        }
        .prescription-container {
            width: 800px;
            margin: 20px auto;
            background: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1756594168/Isepcs/LETTER%20HEAD/Ispecs_letterHeadFull_t3fz6s.png') no-repeat center center;
            background-size: 100% 100%;
            padding: 80px 60px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            color: #333;
            min-height: 1131px;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .prescription-header {
            text-align: center;
            margin-bottom: 20px;
            flex-shrink: 0;
        }
        .prescription-header h2 {
            font-weight: bold;
            color: #0056b3;
        }
        .prescription-header p {
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .patient-details {
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
            margin-bottom: 20px;
            flex-shrink: 0;
        }
        .patient-details p {
            margin-bottom: 5px;
        }
        .prescription-body {
            display: flex;
            flex-grow: 1;
            border-top: 1px solid #555;
        }
        .column {
            width: 50%;
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .column-content {
            flex-grow: 1;
        }
        .left-column {
            border-right: 1px solid #555;
        }
        .section-title {
            font-weight: bold;
            color: #0056b3;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .section-title i {
            margin-right: 10px;
        }
        .prescription-footer {
            margin-top: auto;
            padding-top: 40px;
            width: 100%;
            text-align: left;
        }
        .signature-line {
            border-top: 1px solid #333;
            padding-top: 5px;
            width: 250px;
            text-align: center;
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

        /* Print styles */
        @media print {
            body {
                background-color: #fff;
                margin: 0;
            }
            .action-buttons {
                display: none;
            }
            .prescription-container {
                width: 100%;
                margin: 0;
                box-shadow: none;
                padding: 20px;
                height: 100vh;
            }
            @page {
                size: A4;
                margin: 0;
            }
            /* Ensure background prints */
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
    </style>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <div class="action-buttons no-print">
        <button class="btn btn-primary btn-lg" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        <button class="btn btn-success btn-lg" id="downloadPdf"><i class="fa fa-download"></i> Download</button>
        <a class="btn btn-dark btn-lg" href="#"><i class="fa fa-plus-circle"></i> Add New Prescription</a>
    </div>

    <div id="prescription" class="prescription-container">
        <header class="prescription-header">
            <h2>iSpecs Appeal Optical</h2>
            <div class="row">
                <div class="col-md-6"><p>Shop #36 Harbour City Mall, Montego Bay<br>Tel: (876) 971-0179 | (876) 569-4945</p></div>
                <div class="col-md-6"><p>Shop #1 40 Market Street, Falmouth<br>Tel: (876) 617-0402 | (876) 385-2221</p></div>
            </div>
        </header>

        <section class="patient-details">
            <div class="row">
                <div class="col-6">
                    <p><strong>Patient:</strong> <?php echo htmlspecialchars($patient['name']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($patient['address']); ?></p>
                </div>
                <div class="col-6 text-right">
                    <p><strong>Date:</strong> <?php echo $date; ?></p>
                    <p><strong>Age:</strong> <?php echo $age; ?> Years</p>
                </div>
            </div>
        </section>

        <main class="prescription-body">
            <div class="column left-column">
                <div class="column-content">
                    <h5 class="section-title"><i class="fas fa-glasses"></i> Old Rx</h5>
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
                                <td><?php echo htmlspecialchars($prescription['old_rx_r_sphere']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['old_rx_r_cylinder']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['old_rx_r_axis']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>L</strong></td>
                                <td><?php echo htmlspecialchars($prescription['old_rx_l_sphere']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['old_rx_l_cylinder']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['old_rx_l_axis']); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="section-title"><i class="fas fa-glasses"></i> New Rx</h5>
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
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_sphere']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_cylinder']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_axis']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_prism']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_add']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_seght']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_r_pd']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>L</strong></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_sphere']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_cylinder']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_axis']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_prism']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_add']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_seght']); ?></td>
                                <td><?php echo htmlspecialchars($prescription['new_rx_l_pd']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <footer class="prescription-footer">
                    <div class="signature-line">
                        <?php echo htmlspecialchars($doctor['name']); ?><br>
                        Optical Practitioner
                    </div>
                </footer>
            </div>

            <div class="column">
                <div class="column-content">
                    <h5 class="section-title"><i class="fas fa-list-alt"></i> Recommendations</h5>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Clear:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_clear']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Transition:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_transition']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>ARC:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_arc']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Blue Filter:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_blue_filter']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tint:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_tint']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Other:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['rec_other']); ?></td>
                        </tr>
                    </table>

                    <h5 class="section-title mt-4"><i class="fas fa-eye"></i> Lens Type</h5>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Single Vision:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['lens_single_version']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bifocal:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['lens_bifocal']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Progressive:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['lens_progressive']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Other:</strong></td>
                            <td><?php echo htmlspecialchars($prescription['lens_other']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('downloadPdf').addEventListener('click', function () {
            const prescriptionElement = document.getElementById('prescription');
            html2canvas(prescriptionElement, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('prescription-<?php echo $id; ?>.pdf');
            });
        });
    </script>

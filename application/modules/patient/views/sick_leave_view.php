<?php
// Database configuration
$hostname = 'localhost';
$username = 'secureispecs_emr_setup';
$password = 'RukrIp69FR(0';
$database = 'secureispecs_emr';

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the sick leave ID from the URL parameter
$id = $_GET['id'] ?? 0;

// Fetch sick leave data
$sql = "SELECT * FROM patient_sickleave WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Assign values to variables
    $patient_id = $row['patient_id'];
    $date = $row['date'];
    $patient_first_name = $row['patient_first_name'];
    $patient_middle_name = $row['patient_middle_name'];
    $patient_last_name = $row['patient_last_name'];
    $days = $row['days'];
    $start_date = $row['start_date'];
    $doctor_name = $row['doctor_name'];
    $description = $row['description'];
    $doctor_sign = $row['doctor_sign'];
    $lic_number = $row['lic_number'];
    $doctor_id = $row['doctor_id'];
    
} else {
    die("No sick leave record found with ID: $id");
}

$stmt->close();
$conn->close();
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
    
        
        .certificate-container {
            width: 800px;
            margin: 0 auto;
        }
        
        .certificate {
            background-image: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1755893350/Isepcs/SetPrint2_hokyb1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 1000px;
            padding: 70px 60px;
            color: #2c3e50;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }
        
        .certificate-content {
            background: rgb(255 255 255 / 23%);
            border-radius: 8px;
            padding: 30px 40px;
            margin-top: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            position:relative!important;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #3498db;
        }
        
        .header h1 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .header h2 {
            color: #3498db;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .certificate-body {
            margin-bottom: 30px;
        }
        
        .intro-text {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 25px;
            text-align: justify;
        }
        
        .patient-info {
            margin-bottom: 25px;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px dashed #e0e0e0;
        }
        
        .info-label {
            font-weight: 600;
            width: 200px;
            color: #2c3e50;
        }
        
        .info-value {
            flex: 1;
            font-weight: 500;
            color: #34495e;
        }
        
        .leave-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            margin-bottom: 25px;
        }
        
        .leave-details h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #ddd;
        }
        
        .doctor-details {
            margin-bottom: 30px;
        }
        
        .signature-area {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
        }
        
        .signature-box {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .signature {
            width: 45%;
            text-align: center;
        }
        
        .signature-line {
            border-top: 1px solid #2c3e50;
            padding-top: 40px;
            margin-bottom: 5px;
        }
        
        .signature img {
            width:100%!important;
            max-height: 80px;
            margin-bottom: 10px;
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
            /* Added margin-bottom for spacing */
            margin-bottom: 25px; 
        }
        
        .btn-action {
            border-radius: 6px;
            padding: 12px 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-print {
            background: #3498db;
            color: white;
            border: none;
        }
        
        .btn-print:hover {
            background: #2980b9;
            color: white;
        }
        
        .btn-download {
            background: #2ecc71;
            color: white;
            border: none;
        }
        
        .btn-download:hover {
            background: #27ae60;
            color: white;
        }
        
        /* Print styles */
        @media print {
            body {
                background: none;
                padding: 0;
                margin: 0;
                display: block;
            }
            
            .certificate-container {
                width: 100%;
                margin: 0;
            }
            
            .certificate {
                box-shadow: none;
                border-radius: 0;
                padding: 40px 30px;
                min-height: auto;
            }
            
            .action-buttons {
                display: none;
            }
            
            /* Ensure background prints */
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>

    <div class="certificate-container">
        
        <div class="action-buttons">
            <button class="btn-action btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Print Certificate
            </button>
            <button class="btn-action btn-download">
                <i class="fas fa-download"></i> Download as PDF
            </button>
        </div>
        
        <div class="certificate" id="sickLeaveCertificate">
            <div class="certificate-content">
                <div class="header">
                    <h1>Medical Certificate of Sickness</h1>
                    <h2>ISPECS APPEAL JAMAICA LTD</h2>
                    <p>Authorized Medical Practitioner</p>
                </div>
                
                <div class="certificate-body">
                    <div class="intro-text">
                        This is to certify that I have examined <strong><?php echo htmlspecialchars($patient_first_name . ' ' . $patient_last_name); ?></strong>, 
                        who is a patient of I SPECS APPEAL JAMAICA LTD and is unable to carry out his/her normal duties due to medical reasons.
                    </div>
                    
                    <div class="patient-info">
                        <div class="info-row">
                            <div class="info-label">Patient Full Name:</div>
                            <div class="info-value"><?php echo htmlspecialchars($patient_first_name . ' ' . $patient_middle_name . ' ' . $patient_last_name); ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Patient ID:</div>
                            <div class="info-value"><?php echo htmlspecialchars($patient_id); ?></div>
                        </div>
                    </div>
                    
                    <div class="leave-details">
                        <h3>Leave Period Details</h3>
                        <div class="info-row">
                            <div class="info-label">Start Date:</div>
                            <div class="info-value"><?php echo date('F d, Y', strtotime($start_date)); ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Number of Days:</div>
                            <div class="info-value"><?php echo htmlspecialchars($days); ?> days</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">End Date:</div>
                            <div class="info-value"><?php echo date('F d, Y', strtotime($start_date . ' + ' . ($days) . ' days')); ?></div>
                        </div>
                    </div>
                    
                    <div class="intro-text">
                        The above-mentioned patient requires this period of medical leave for proper treatment and recovery. 
                        The patient is advised to follow the prescribed treatment and refrain from work during this period.
                    </div>
                    
                    <div class="doctor-details">
                        <h3>Medical Practitioner Details</h3>
                        <div class="info-row">
                            <div class="info-label">Doctor's Name:</div>
                            <div class="info-value"><?php echo htmlspecialchars($doctor_name); ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">License Number:</div>
                            <div class="info-value"><?php echo htmlspecialchars($lic_number); ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Date of Issue:</div>
                            <div class="info-value"><?php echo date('F d, Y', strtotime($date)); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="signature-area">
                    <div class="signature-box">
                        <div class="signature">
                            <?php if (!empty($doctor_sign)): ?>
                                <img src="https://secure-emr.ispecsappeal.net/<?php echo htmlspecialchars($doctor_sign); ?>" alt="Doctor's Signature">
                            <?php else: ?>
                                <div class="signature-line"></div>
                            <?php endif; ?>
                            <div>Medical Practitioner's Signature</div>
                            <div><?php echo htmlspecialchars($doctor_name); ?></div>
                        </div>
                        
                        <div class="signature">
                            <div class="signature-line"></div>
                            <div>Patient's Signature</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="action-buttons">
            <button class="btn-action btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> Print Certificate
            </button>
            <button class="btn-action btn-download">
                <i class="fas fa-download"></i> Download as PDF
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        // Function to handle the PDF download logic
        function downloadCertificateAsPdf() {
            const certificate = document.getElementById('sickLeaveCertificate');
            
            html2canvas(certificate, {
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                
                // Correctly initialize jsPDF from the UMD library
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('sick_leave_certificate_<?php echo addslashes($patient_id); ?>.pdf');
            });
        }

        // Select ALL download buttons by their class name
        const downloadButtons = document.querySelectorAll('.btn-download');

        // Loop through each button and attach the click event listener
        downloadButtons.forEach(button => {
            button.addEventListener('click', downloadCertificateAsPdf);
        });
    </script>
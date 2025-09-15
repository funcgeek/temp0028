<?php

// Database Configuration
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get ID from URL
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    // Fetch record
    $stmt = $pdo->prepare("SELECT * FROM medical_history WHERE id = ?");
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$record) {
        die("Record not found");
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to clean up empty <p> tags
function cleanHtmlContent($content) {
    // Remove empty <p> tags (containing only whitespace)
    return preg_replace('/<p>\s*<\/p>/', '', trim($content));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <style>
        /* --- Medical Theme Colors (Updated with Brand Colors) --- */
        :root {
            --primary-medical: #58c6ce;
            --secondary-medical: #ee9030; /* Used as accent */
            --accent-medical: #ee9030;
            --success-medical: #ee9030; /* Using accent for download button */
            --bg-light: #f8f9fa;
            --bg-white: #ffffff;
            --text-dark: #221f1f;
            --text-medium: #4a5568;
            --text-light: #718096;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 30px 15px;
        }

        /* --- Container --- */
        .medical-container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* --- Page Header --- */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeInDown 0.6s ease;
        }

        .page-header h1 {
            color: var(--text-dark);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .page-header h1::before {
            content: '\f0f1';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.5rem;
            color: var(--primary-medical);
        }

        /* --- Action Buttons --- */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease;
        }

        .btn-medical {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: var(--shadow-sm);
        }

        .btn-print {
            background: var(--primary-medical);
            color: white;
        }

        .btn-print:hover {
            background: #4ab8c0;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-download {
            background: var(--success-medical);
            color: white;
        }

        .btn-download:hover {
            background: #d6802a;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* --- Certificate Card --- */
        .certificate-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            animation: fadeIn 0.8s ease;
            border: 1px solid var(--border-color);
        }

        /* --- Medical Header --- */
        .medical-header {
            background: linear-gradient(135deg, var(--primary-medical) 0%, #4ab8c0 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .medical-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .medical-header::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .clinic-logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .clinic-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .clinic-locations {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 15px;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .location-item {
            font-size: 0.9rem;
            opacity: 0.95;
            line-height: 1.5;
        }

        /* --- Certificate Title --- */
        .certificate-title {
            background: var(--bg-light);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .certificate-title h2 {
            color: var(--text-dark);
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .certificate-title h2 i {
            font-size: 1.2rem;
            color: var(--primary-medical);
        }

        /* --- Certificate Content --- */
        .certificate-content {
            padding: 35px;
        }

        /* --- Patient Info Grid --- */
        .patient-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: var(--bg-light);
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid var(--accent-medical);
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.05rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        /* --- Medical Sections --- */
        .medical-section {
            margin-bottom: 25px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(90deg, var(--primary-medical) 0%, var(--accent-medical) 100%);
            color: white;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-content {
            padding: 20px;
            color: var(--text-medium);
            line-height: 1.6;
        }
        
        .section-content p, .section-content li {
             margin-bottom: 10px;
        }
        
        .section-content ul, .section-content ol {
            padding-left: 20px;
        }
        
        .notepad-container {
            text-align: center;
            padding: 20px;
        }

        .notepad-image {
            max-width: 100%;
            height: auto;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 5px;
            background: white;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }
        
        .notepad-image:hover {
            transform: scale(1.02);
        }

        /* --- Animations --- */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* --- Print Styles --- */
        @media print {
            body { background: white; padding: 0; margin: 0; }
            .page-header, .action-buttons, .loading-overlay { display: none; }
            .certificate-card { box-shadow: none; border-radius: 0; border: none; }
            .medical-section { break-inside: avoid; }
            .medical-container { max-width: 100%; }
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            .patient-info-grid { grid-template-columns: 1fr; }
            .clinic-locations { flex-direction: column; gap: 15px; }
            body { padding: 15px 10px; }
            .certificate-content { padding: 20px; }
        }

        /* --- Loading spinner for PDF generation --- */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-medical);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="medical-container">
        <div class="page-header">
            <h1>Medical Certificate</h1>
        </div>
        
        <div class="action-buttons">
            <button onclick="window.print()" class="btn-medical btn-print">
                <i class="fas fa-print"></i> Print Certificate
            </button>
            <!--<button onclick="downloadPDF()" class="btn-medical btn-download">-->
            <!--    <i class="fas fa-file-pdf"></i> Download PDF-->
            <!--</button>-->
        </div>
        
        <div class="certificate-card" id="medicalCertificate">
            <header class="medical-header">
                <div class="clinic-logo">
                    <img src="https://ispecsappeal.com/wp-content/uploads/2025/03/ispecs-logo_sjvcso.png" alt="Clinic Logo" style="width: 50px; height: 50px; object-fit: contain;">
                </div>
                <h1 class="clinic-name"><?php echo htmlspecialchars($settings->title ?? 'Medical Clinic'); ?></h1>
                <div class="clinic-locations">
                    <div class="location-item">
                        <i class="fas fa-location-dot"></i> Shop #36 Harbour City Mall, Montego Bay<br>
                        <i class="fas fa-phone"></i> (876) 971-0179 | (876) 569-4945
                    </div>
                    <div class="location-item">
                        <i class="fas fa-location-dot"></i> Shop #1 40 Market Street, Falmouth<br>
                        <i class="fas fa-phone"></i> (876) 617-0402 | (876) 385-2221
                    </div>
                </div>
            </header>
            
            <div class="certificate-title">
                <h2>
                    <i class="fas fa-file-medical"></i>
                    Medical Certificate for <?php echo htmlspecialchars($record['patient_name']); ?>
                </h2>
            </div>
            
            <div class="certificate-content">
                <div class="patient-info-grid">
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-user"></i> Patient Name</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['patient_name']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-id-card"></i> Patient ID</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['patient_id']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-birthday-cake"></i> Age</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['age']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-phone"></i> Contact Number</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['patient_phone']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-calendar-days"></i> Date of Visit</div>
                        <div class="info-value"><?php echo date('F j, Y', strtotime($record['date'])); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="fas fa-user-doctor"></i> Consulting Doctor</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['doctor_name'] ?: 'N/A'); ?></div>
                    </div>
                    <div class="info-item full-width">
                        <div class="info-label"><i class="fas fa-clipboard-list"></i> Presenting Complaint</div>
                        <div class="info-value"><?php echo htmlspecialchars($record['title']); ?></div>
                    </div>
                </div>
                
                <?php if (!empty(trim($record['med_history'])) && trim(strip_tags($record['med_history'])) !== ''): ?>
                <div class="medical-section">
                    <div class="section-header"><i class="fas fa-clock-rotate-left"></i> Medical History</div>
                    <div class="section-content"><?php echo cleanHtmlContent($record['med_history']); ?></div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty(trim($record['medications'])) && trim(strip_tags($record['medications'])) !== ''): ?>
                <div class="medical-section">
                    <div class="section-header"><i class="fas fa-pills"></i> Medications</div>
                    <div class="section-content"><?php echo cleanHtmlContent($record['medications']); ?></div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($record['doc_notepad'])): ?>
                <div class="medical-section">
                    <div class="section-header"><i class="fas fa-pen-to-square"></i> Doctor's Handwritten Notes</div>
                    <div class="section-content">
                        <div class="notepad-container">
                             <img style="width:500px!important;" src="https://secure-emr.ispecsappeal.net/<?php echo htmlspecialchars($record['doc_notepad']); ?>" alt="Doctor's Handwritten Notes" class="notepad-image">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty(trim($record['description'])) && trim(strip_tags($record['description'])) !== ''): ?>
                <div class="medical-section">
                    <div class="section-header"><i class="fas fa-notes-medical"></i> Clinical Notes & Recommendations</div>
                    <div class="section-content">
                        <?php echo html_entity_decode($record['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($record['img_url'])): ?>
                <div class="medical-section">
                    <div class="section-header"><i class="fas fa-image"></i> Medical Imaging / Documentation</div>
                    <div class="section-content">
                         <img src="<?php echo htmlspecialchars($record['img_url']); ?>" alt="Medical Documentation" class="notepad-image">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const certificate = document.getElementById('medicalCertificate');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Hide elements that should not appear in the PDF
            const pageHeader = document.querySelector('.page-header');
            const actionButtons = document.querySelector('.action-buttons');
            pageHeader.style.display = 'none';
            actionButtons.style.display = 'none';
            loadingOverlay.style.display = 'flex';

            try {
                // Wait for images to load fully
                const images = certificate.querySelectorAll('img');
                const loadPromises = Array.from(images).map(img => {
                    if (img.complete) return Promise.resolve();
                    return new Promise(resolve => {
                        img.onload = resolve;
                        img.onerror = () => resolve(); // Continue even if an image fails to load
                    });
                });
                await Promise.all(loadPromises);

                // Render with higher quality and proper CORS handling
                const canvas = await html2canvas(certificate, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff'
                });

                const imgData = canvas.toDataURL('image/jpeg', 0.95); // Use JPEG for better readability
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const canvasWidth = canvas.width;
                const canvasHeight = canvas.height;
                const ratio = canvasWidth / canvasHeight;
                const imgWidth = pdfWidth - 20; // 10mm margin on each side
                const imgHeight = imgWidth / ratio;

                let heightLeft = imgHeight;
                let position = 10; // Top margin

                pdf.addImage(imgData, 'JPEG', 10, position, imgWidth, imgHeight);
                heightLeft -= (pdfHeight - 20);

                // Handle multi-page PDFs
                while (heightLeft > 0) {
                    position -= (pdfHeight - 20);
                    pdf.addPage();
                    pdf.addImage(imgData, 'JPEG', 10, position, imgWidth, imgHeight);
                    heightLeft -= (pdfHeight - 20);
                }

                const date = new Date().toISOString().split('T')[0];
                const filename = `medical_certificate_${<?php echo json_encode($record['patient_id']); ?>}_${date}.pdf`;
                
                pdf.save(filename);
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('An error occurred while generating the PDF. Please check the console for details.');
            } finally {
                // Restore hidden elements
                pageHeader.style.display = 'block';
                actionButtons.style.display = 'flex';
                loadingOverlay.style.display = 'none';
            }
        }
    </script>
</body>
</html>
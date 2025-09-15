<?php
// --- DATABASE CONNECTION & DATA FETCHING ---

// Set the timezone to Jamaica
date_default_timezone_set('America/Jamaica');
$current_date = date('d/m/Y');
$patient_name = 'Patient Not Found';
$existing_consents = []; // To store fetched consent forms

// Check for patient ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $patient_id = (int)$_GET['id'];

    // --- Database Credentials ---
    $db_host = 'localhost';
    $db_name = 'secureispecs_emr';
    $db_user = 'secureispecs_emr_setup';
    $db_pass = 'RukrIp69FR(0';

    @$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        $patient_name = 'Error: Database Connection Failed';
    } else {
        // --- 1. Fetch Patient Name ---
        $stmt_patient = $conn->prepare("SELECT first_name, middle_name, last_name FROM patient WHERE id = ?");
        $stmt_patient->bind_param("i", $patient_id);
        $stmt_patient->execute();
        $result_patient = $stmt_patient->get_result();
        if ($result_patient->num_rows > 0) {
            $patient_data = $result_patient->fetch_assoc();
            $full_name_parts = array_filter([$patient_data['first_name'], $patient_data['middle_name'], $patient_data['last_name']]);
            $patient_name = trim(implode(' ', $full_name_parts));
        }
        $stmt_patient->close();

        // --- 2. ✨ NEW: Fetch Existing Consent Forms for this Patient ---
        $stmt_consents = $conn->prepare("SELECT url, upload_date FROM pdf_consent WHERE patient_id = ? ORDER BY upload_date DESC");
        $stmt_consents->bind_param("i", $patient_id);
        $stmt_consents->execute();
        $result_consents = $stmt_consents->get_result();
        while ($row = $result_consents->fetch_assoc()) {
            $existing_consents[] = $row;
        }
        $stmt_consents->close();

        $conn->close();
    }
} else {
    $patient_name = 'No Patient ID Provided';
}
?>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<section id="main-content">
    <section class="wrapper site-min-height">

        <style>
            /* ... (keep all your existing styles from .consent_form_body to .loader_text) ... */
            .consent_form_body { font-family: Arial, Helvetica, sans-serif; background-color: #f0f2f5; display: flex; flex-direction: column; align-items: center; padding: 20px; }
            .form_page_container { position: relative; width: 800px; height: 1131px; background-size: 100% 100%; background-repeat: no-repeat; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin-bottom: 20px; }
            #page1_container { background-image: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1756213741/Isepcs/ISSPECSConsentForm_1_-1_rzkddv.png'); }
            #page2_container { background-image: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1756213741/Isepcs/ISSPECSConsentForm_1_-2_lfrsag.png'); }
            .consent_input_field { position: absolute; background-color: transparent; border: none; font-size: 19px; font-family: 'Times New Roman', Times, serif; padding: 5px; }
            .patient_name_field { top: 23.6%; left: 22%; width: 50%; font-size:28px!important; }
            .signature_canvas { position: absolute; border: 1px dashed #ccc; }
            #patient_signature_canvas { top: 42%; left: 23%; width: 300px; height: 50px; }
            #guardian_signature_canvas { top: 51%; left: 29%; width: 250px; height: 50px; }
            .date_field_patient { top: 42.5%; left: 70%; width: 15%; }
            .date_field_guardian { top: 53%; left: 70%; width: 15%; }
            .btn_consent_form_export { background-color: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-size: 18px; cursor: pointer; transition: background-color 0.3s ease; margin-top: 20px; }
            .btn_consent_form_export:hover { background-color: #0056b3; }
            .loader_overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 9999; justify-content: center; align-items: center; flex-direction: column; }
            .loader_text { font-size: 20px; font-weight: bold; margin-bottom: 15px; }

            /* --- ✨ NEW STYLES --- */

            /* Styles for the existing documents list */
            .existing_documents_container {
                width: 800px;
                margin-bottom: 30px;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .existing_documents_container h3 {
                margin-top: 0;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
                color: #333;
            }
            .document_card {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                border: 1px solid #e0e0e0;
                border-radius: 5px;
                margin-bottom: 10px;
                background-color: #fafafa;
            }
            .document_info span {
                display: block;
                font-size: 14px;
                color: #666;
            }
            .document_info span:first-child {
                font-weight: bold;
                color: #0056b3;
                margin-bottom: 5px;
                font-size: 16px;
            }
            .download_btn {
                text-decoration: none;
                background-color: #28a745;
                color: white;
                padding: 8px 15px;
                border-radius: 5px;
                font-size: 14px;
                transition: background-color 0.2s;
            }
            .download_btn:hover {
                background-color: #218838;
            }
            .no_documents {
                color: #888;
                text-align: center;
                padding: 20px;
            }

            /* Styles for the Progress Bar */
            .progress_bar_container {
                width: 300px;
                height: 20px;
                background-color: #e0e0e0;
                border-radius: 10px;
                overflow: hidden;
                border: 1px solid #ccc;
            }
            .progress_bar {
                width: 0%; /* Starts at 0% */
                height: 100%;
                background-color: #007bff;
                border-radius: 10px;
                transition: width 0.2s ease-in-out;
                text-align: center;
                color: white;
                line-height: 20px;
                font-size: 12px;
            }
        </style>

        <div class="consent_form_body">
        
            <div class="existing_documents_container">
                <h3>Previously Uploaded Consent Forms</h3>
                <?php if (!empty($existing_consents)): ?>
                    <?php foreach ($existing_consents as $consent): ?>
                        <div class="document_card">
                            <div class="document_info">
                                <span><?php echo htmlspecialchars(basename($consent['url'])); ?></span>
                                <span>Uploaded: <?php echo date("F j, Y, g:i a", strtotime($consent['upload_date'])); ?></span>
                            </div>
                            <a href="<?php echo htmlspecialchars($consent['url']); ?>" class="download_btn" download>Download</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no_documents">No consent forms have been uploaded for this patient yet.</p>
                <?php endif; ?>
            </div>

            <div id="consent_form_to_export">
                <div id="page1_container" class="form_page_container">
                    <div class="consent_input_field patient_name_field"><?php echo htmlspecialchars($patient_name, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div id="page2_container" class="form_page_container">
                    <canvas id="patient_signature_canvas" class="signature_canvas"></canvas>
                    <div class="consent_input_field date_field_patient"><?php echo htmlspecialchars($current_date, ENT_QUOTES, 'UTF-8'); ?></div>
                    <canvas id="guardian_signature_canvas" class="signature_canvas"></canvas>
                    <div class="consent_input_field date_field_guardian"><?php echo htmlspecialchars($current_date, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>

            <button id="export_pdf_button" class="btn_consent_form_export">Upload & Save PDF</button>

     <div class="loader_overlay" id="loader">
    <div class="loader_text" id="loader_text">Generating PDF...</div>
    
    <!-- Spinner and wait text -->
    <span>
        <img src="11677416.gif" alt="Loading..." style="width:100px;height:100px;vertical-align:middle;margin-right:5px;">
        Please wait for a minimum of 3 mins
    </span>
    
    <div class="progress_bar_container">
        <div class="progress_bar" id="progress_bar">0%</div>
    </div>
</div>

        </div>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    // ... (all the variable declarations from before remain the same)
    const patientSignatureCanvas = document.getElementById('patient_signature_canvas');
    const guardianSignatureCanvas = document.getElementById('guardian_signature_canvas');
    const exportButton = document.getElementById('export_pdf_button');
    const loader = document.getElementById('loader');
    const loaderText = document.getElementById('loader_text');
    const progressBar = document.getElementById('progress_bar');

    const patientSignaturePad = new SignaturePad(patientSignatureCanvas);
    const guardianSignaturePad = new SignaturePad(guardianSignatureCanvas);

    // ... (the resizeCanvas function and its event listeners remain the same)
    function resizeCanvas(canvas) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }
    resizeCanvas(patientSignatureCanvas);
    resizeCanvas(guardianSignatureCanvas);
    window.addEventListener("resize", () => {
        resizeCanvas(patientSignatureCanvas);
        resizeCanvas(guardianSignatureCanvas);
    });

    // ... (the showToast helper function remains the same)
    function showToast(message, type = 'success') {
        Toastify({
            text: message,
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: type === 'success' ? "linear-gradient(to right, #00b09b, #96c93d)" : "linear-gradient(to right, #ff5f6d, #ffc371)",
            },
        }).showToast();
    }

    // Handle the PDF export process
    exportButton.addEventListener('click', async () => {
        loader.style.display = 'flex';
        loaderText.textContent = 'Generating PDF...';
        progressBar.style.width = '0%';
        progressBar.textContent = '0%';

        patientSignatureCanvas.style.border = 'none';
        guardianSignatureCanvas.style.border = 'none';

        const patientId = <?php echo isset($patient_id) ? json_encode($patient_id) : 'null'; ?>;
        const patientNameForFile = '<?php echo str_replace(["'", '"', ' '], ['', '', '_'], $patient_name); ?>';
        const pdfFileName = `ISPECS-Consent-Form-${patientNameForFile}.pdf`;

        if (!patientId) {
            showToast('Error: Patient ID is not available.', 'error');
            loader.style.display = 'none';
            return;
        }

        try {
            // ... (The PDF generation logic remains exactly the same)
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({ orientation: 'p', unit: 'px', format: 'a4' });
            const page1 = document.getElementById('page1_container');
            const page2 = document.getElementById('page2_container');
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = pdf.internal.pageSize.getHeight();
            const options = { scale: 2, useCORS: true };
            const canvas1 = await html2canvas(page1, options);
            pdf.addImage(canvas1.toDataURL('image/png'), 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.addPage();
            const canvas2 = await html2canvas(page2, options);
            pdf.addImage(canvas2.toDataURL('image/png'), 'PNG', 0, 0, pdfWidth, pdfHeight);
            
            // --- UPDATED UPLOAD LOGIC ---
            
            loaderText.textContent = 'Uploading file...';
            const pdfBlob = pdf.output('blob');
            const formData = new FormData();
            formData.append('patient_id', patientId);
            formData.append('pdf_file', pdfBlob, pdfFileName);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload_consent.php', true);

            // Progress event listener
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percentComplete = Math.round((e.loaded / e.total) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressBar.textContent = percentComplete + '%';

                    // ✨ CHANGE: Update text when upload is complete but server is still processing
                    if (percentComplete === 100) {
                        loaderText.textContent = 'Processing...';
                    }
                }
            });

            // On successful upload completion
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const result = JSON.parse(xhr.responseText);
                    if (result.success) {
                        // ✨ CHANGE: Update text to show completion before reloading
                        loaderText.textContent = 'Exporting Done! Please Reload the Page.';
                        progressBar.style.backgroundColor = '#28a745'; // Optional: Change bar color to green
                        
                        showToast('File uploaded successfully!', 'success');
                        pdf.save(pdfFileName);

                        // Reload the page to show the new file in the list
                        setTimeout(() => window.location.reload(), 1500); // 1.5 second delay
                        
                    } else {
                        showToast('Upload failed: ' + result.message, 'error');
                        loader.style.display = 'none'; // Hide loader on failure
                        patientSignatureCanvas.style.border = '1px dashed #ccc';
                        guardianSignatureCanvas.style.border = '1px dashed #ccc';
                    }
                } else {
                    showToast('Server error: ' + xhr.status, 'error');
                    loader.style.display = 'none'; // Hide loader on failure
                    patientSignatureCanvas.style.border = '1px dashed #ccc';
                    guardianSignatureCanvas.style.border = '1px dashed #ccc';
                }
            };

            // On network error
            xhr.onerror = function() {
                showToast('A network error occurred during the upload.', 'error');
                loader.style.display = 'none';
                patientSignatureCanvas.style.border = '1px dashed #ccc';
                guardianSignatureCanvas.style.border = '1px dashed #ccc';
            };

            xhr.send(formData);

        } catch (error) {
            console.error('Error generating PDF:', error);
            showToast('An error occurred while generating the PDF.', 'error');
            loader.style.display = 'none';
            patientSignatureCanvas.style.border = '1px dashed #ccc';
            guardianSignatureCanvas.style.border = '1px dashed #ccc';
        }
    });
});
        </script>

    </section>
</section>
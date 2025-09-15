<?php
$doctor = $this->doctor_model->getDoctorById($prescription->doctor);
$patient = $this->patient_model->getPatientById($prescription->patient);
//$settings = $this->settings_model->getSettings();
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
        .prescription-header img {
            max-width: 250px;
            margin-bottom: 20px;
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
            /*border-right: 1px solid #555;*/
        }
        .section-title {
            font-weight: bold;
            color: #0056b3;
            /*border-bottom: 2px solid #0056b3;*/
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .section-title i {
            margin-right: 10px;
        }
        .prescription-footer {
            margin-top: auto; /* Pushes footer to the bottom of the flex column */
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
                margin: 0; /* Removes browser headers and footers */
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
        <button class="btn btn-primary btn-lg" onclick="window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?></button>
        <button class="btn btn-success btn-lg" id="downloadPdf"><i class="fa fa-download"></i> <?php echo lang('download'); ?></button>
        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
            <!--<a class="btn btn-info btn-lg" href='prescription/all'><i class="fa fa-medkit"></i> <?php echo lang('all'); ?> <?php echo lang('prescription'); ?></a>-->
        <?php } ?>
        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
            <!--<a class="btn btn-info btn-lg" href='prescription'><i class="fa fa-medkit"></i> <?php echo lang('all'); ?> <?php echo lang('prescriptions'); ?></a>-->
        <?php } ?>
        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
            <a class="btn btn-dark btn-lg" href="prescription/addPrescriptionView"><i class="fa fa-plus-circle"></i> <?php echo lang('add_prescription'); ?></a>
        <?php } ?>
    </div>

    <div id="prescription" class="prescription-container">
        <header class="prescription-header">
    <!--        <img style="width: 50px !important;-->
    <!--height: 50px !important;" src="<?php echo $settings->logo; ?>" alt="<?php echo htmlspecialchars($settings->title); ?>">-->
            <h2><?php echo htmlspecialchars($settings->title); ?></h2>
            <div class="row">
                <div class="col-md-6"><p>Shop #36 Harbour City Mall, Montego Bay<br>Tel: (876) 971-0179 | (876) 569-4945</p></div>
                <div class="col-md-6"><p>Shop #1 40 Market Street, Falmouth<br>Tel: (876) 617-0402 | (876) 385-2221</p></div>
            </div>
        </header>

        <section class="patient-details">
            <div class="row">
                <div class="col-6">
                    <p><strong>Patient:</strong> <?php echo htmlspecialchars($patient->name); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($patient->address); ?></p>
                </div>
                <div class="col-6 text-right">
                    <p><strong>Date:</strong> <?php echo date('F j, Y', $prescription->date); ?></p>
                    <?php
                    if (!empty($patient->birthdate)) {
                        $birthDate = new DateTime($patient->birthdate);
                        $today = new DateTime('today');
                        $age = $birthDate->diff($today)->y;
                        echo "<p><strong>Age:</strong> " . $age . " Years</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <main class="prescription-body">
            <div class="column left-column">
<?php
// Function to clean up empty <p> tags
function cleanHtmlContent($content) {
    // Remove empty <p> tags (containing only whitespace)
    return preg_replace('/<p>\s*<\/p>/', '', trim($content));
}
?>

<div class="column-content">
    <h5 class="section-title"><i class="fas fa-notes-medical"></i> Rx </h5>
    <?php if (!empty($prescription->advice)): ?>
        <div><?php echo cleanHtmlContent($prescription->advice); ?></div>
    <?php else: ?>
        <p>No prescription advice available.</p>
    <?php endif; ?>

    <?php if (!empty($prescription->note)): ?>
        <h5 style="margin-top:300px!important;" class="section-title mt-4"><i class="fas fa-allergies"></i> Patient Allergies</h5>
        <div><?php echo cleanHtmlContent($prescription->note); ?></div>
    <?php else: ?>
        <p>No allergy information available.</p>
    <?php endif; ?>
</div>
                <footer class="prescription-footer">
                    <div class="signature-line">
                        <?php echo htmlspecialchars($doctor->name); ?><br>
                        Medical Practitioner
                    </div>
                </footer>
            </div>

            <div class="column">
                <div class="column-content">
                    <h5 class="section-title"><i class="fas fa-prescription-bottle-alt"></i> Rx</h5>
                    <!--<p><?php echo nl2br(htmlspecialchars($prescription->advice)); ?></p>-->
                    <!--<h5 class="section-title mt-4"><i class="fas fa-vial"></i> RX Tests</h5>-->
                    <!--<p></p>-->
                    <?php if (!empty($prescription->note)): ?>
                        <!--<h5 class="section-title mt-4"><i class="fas fa-allergies"></i> Patient Allergies</h5>-->
                        <!--<p><?php echo nl2br(htmlspecialchars($prescription->note)); ?></p>-->
                    <?php endif; ?>
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
                scale: 2, // Improves image quality
                useCORS: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('prescription-<?php echo addslashes($prescription->id); ?>.pdf');
            });
        });
    </script>


<?php
// --- DATABASE CONNECTION ---
$db_host = "localhost";
$db_user = "secureispecs_emr_setup";
$db_pass = "RukrIp69FR(0";
$db_name = "secureispecs_emr";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) { die("Connection failed."); }

// Set timezone to Jamaica
date_default_timezone_set('America/Jamaica');

$invoice = null;
$patient = null;
$invoice_id = isset($_GET['ref']) ? intval($_GET['ref']) : 0;

if ($invoice_id > 0) {
    // Fetch invoice details
    $sql = "SELECT * FROM custom_invoice WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $invoice_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $invoice = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
    
    // If invoice found, fetch patient details
    if ($invoice) {
        $sql_patient = "SELECT first_name, middle_name, last_name FROM patient WHERE id = ?";
        if ($stmt_patient = mysqli_prepare($conn, $sql_patient)) {
            mysqli_stmt_bind_param($stmt_patient, "i", $invoice['patient_id']);
            mysqli_stmt_execute($stmt_patient);
            $result_patient = mysqli_stmt_get_result($stmt_patient);
            $patient = mysqli_fetch_assoc($result_patient);
            mysqli_stmt_close($stmt_patient);
        }
    }
}
mysqli_close($conn);

if (!$invoice || !$patient) {
    die("<h1>Invoice not found.</h1>");
}

// Format patient name
$name_parts = [$patient['first_name'], $patient['middle_name'], $patient['last_name']];
$patient_full_name = ucwords(strtolower(implode(' ', array_filter($name_parts))));

// Process invoice items from comma-separated strings
$descriptions = explode(',', $invoice['descriptions']);
$quantities = explode(',', $invoice['quantities']);
$unit_prices = explode(',', $invoice['unit_prices']);
?>

   <link rel="stylesheet" href="https://secure-emr.ispecsappeal.net/custom_styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
    <div class="vi-actions-bar">
        <button id="print-btn" class="vi-btn">Print Invoice</button>
        <button id="download-btn" class="vi-btn">Download PDF</button>
    </div>

    <div class="vi-container" id="invoice-to-print" style="margin-bottom: 100px;">
        <div class="vi-top-line"></div>
        <div class="vi-company">ISPECS APPEAL JAMAICA LTD</div>
        <div class="vi-address">
            Shop 36 Harbour City Mall, Montego Bay<br>
            Shop #1 40 Market Street Falmouth<br>
            (123) 456-7890
        </div>
        <div class="vi-title">Invoice</div>
        <div class="vi-submitted">Submitted on <?php echo date('d/m/Y', strtotime($invoice['submitted_on'])); ?></div>
        
        <table class="vi-info-table">
            <tr>
                <td>Invoice for</td>
                <td>Payable to</td>
                <td>Invoice #</td>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($patient_full_name); ?></td>
                <td>ISPECS APPEAL JAMAICA LTD</td>
                <td><?php echo htmlspecialchars($invoice['invoice_number']); ?></td>
            </tr>
            <tr><td></td><td></td><td></td></tr>
            <tr>
                <td></td>
                <td>Product</td>
                <td>Due date</td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo htmlspecialchars($invoice['product_type'] . ': ' . $invoice['product_name']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($invoice['due_date'])); ?></td>
            </tr>
        </table>
        
        <div class="vi-divider"></div>
        
        <table class="vi-items-table">
            <thead class="vi-items-header">
                <tr>
                    <th class="vi-description">Description</th>
                    <th class="vi-qty">Qty</th>
                    <th class="vi-unit-price">Unit price</th>
                    <th class="vi-total-price">Total price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($descriptions as $index => $desc): 
                    $qty = floatval($quantities[$index]);
                    $price = floatval($unit_prices[$index]);
                    $total = $qty * $price;
                ?>
                <tr>
                    <td class="vi-description"><?php echo htmlspecialchars($desc); ?></td>
                    <td class="vi-qty"><?php echo htmlspecialchars($qty); ?></td>
                    <td class="vi-unit-price">$<?php echo number_format($price, 2); ?></td>
                    <td class="vi-total-price">$<?php echo number_format($total, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="vi-notes">
            <strong>Notes:</strong> <?php echo nl2br(htmlspecialchars($invoice['notes'])); ?>
        </div>
        
        <table class="vi-summary-table">
            <tr>
                <td class="vi-summary-label">Subtotal</td>
                <td>$<?php echo number_format($invoice['subtotal'], 2); ?></td>
            </tr>
            <tr>
                <td class="vi-summary-label">Adjustments</td>
                <td>$<?php echo number_format($invoice['adjustments'], 2); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="vi-total-amount">$<?php echo number_format($invoice['total_amount'], 2); ?></td>
            </tr>
        </table>
    </div>

<script>
document.getElementById('print-btn').addEventListener('click', function() {
    window.print();
});

document.getElementById('download-btn').addEventListener('click', function() {
    const element = document.getElementById('invoice-to-print');
    const invoiceNumber = "<?php echo $invoice['invoice_number']; ?>";
    const patientName = "<?php echo addslashes($patient_full_name); ?>";
    const opt = {
        margin:       0.5,
        filename:     `Invoice-${invoiceNumber}-${patientName}.pdf`,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().from(element).set(opt).save();
});
</script>

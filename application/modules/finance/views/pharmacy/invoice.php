
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Martel+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap');
        .invoice-container { max-width: 800px; margin:0 auto; padding-top: 70px; }
        #invoice { background-image: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1756434603/Isepcs/LETTER%20HEAD/Ispecs_frame_ly84xi.png'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 40px; font-size: 14px; font-weight: 500; color: #333; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); position: relative; margin-bottom: 20px; }
        .corporate-id { margin-bottom: 25px; text-align: center; }
        .corporate-id h1 { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px; color: #1a237e; margin-bottom: 8px; letter-spacing: -0.5px; }
        .corporate-id h3 { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 600; color: #303f9f; padding-bottom: 12px; margin: 25px 0; position: relative; display: inline-block; }
        .corporate-id h3:before, .corporate-id h3:after { content: ""; position: absolute; top: 50%; width: 60px; height: 2px; background: #303f9f; transform: translateY(-50%); }
        .corporate-id h3:before { left: -70px; }
        .corporate-id h3:after { right: -70px; }
        .corporate-id h4 { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 500; margin: 6px 0; color: #424242; }
        .invoice-info { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 25px; }
        .info-item { background: rgba(255, 255, 255, 0.7); padding: 12px 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .info-item h4 { font-size: 14px; margin: 0 0 5px 0; color: #666; }
        .info-item strong { font-size: 15px; color: #303f9f; }
        .table { width: 100%; margin-bottom: 25px; background-color: rgba(255, 255, 255, 0.85); border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .table thead { background-color: rgba(63, 81, 181, 0.1); }
        .table thead tr th { border-bottom: 2px solid #3f51b5; padding: 15px 12px; text-align: left; }
        .table thead tr th h5 { font-size: 15px; font-weight: 600; color: #303f9f; margin: 0; }
        .table tbody tr td { padding: 12px; border-bottom: 1px solid #e0e0e0; }
        .table tbody tr:nth-child(even) { background-color: rgba(255, 255, 255, 0.5); }
        .table tbody tr td h5 { font-size: 14px; margin: 0; color: #424242; }
        .invoice-summary { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; }
        .invoice-block { background-color: rgba(255, 255, 255, 0.85); padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .invoice-block h5 { font-size: 16px; font-weight: 600; margin: 0 0 15px 0; color: #303f9f; padding-bottom: 8px; border-bottom: 2px solid #3f51b5; }
        .invoice-block ul { list-style: none; padding: 0; margin: 0; }
        .invoice-block ul li { padding: 8px 0; border-bottom: 1px dashed #e0e0e0; display: flex; justify-content: space-between; }
        .invoice-block ul li:last-child { border-bottom: none; }
        .invoice-actions { display: flex; justify-content: center; gap: 15px; margin-top: 20px; }
        .btn { border-radius: 30px; padding: 12px 25px; font-weight: 600; text-transform: uppercase; font-size: 14px; transition: all 0.3s; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; }
        .btn-info { background-color: #3f51b5; color: white; }
        .btn-info:hover { background-color: #303f9f; }
        .btn i { margin-right: 8px; }
        #settings-receipt-footer { margin-top: 30px; text-align: center; font-size: 13px; color: #616161; border-top: 1px solid #e0e0e0; padding-top: 15px; }
        @media print { body { background: none; padding: 0; margin: 0; display: block; } .invoice-container { max-width: 100%; width: 100%; } #invoice { padding: 20px; box-shadow: none; border-radius: 0; page-break-inside: avoid; } .no-print { display: none !important; } .invoice-actions { display: none; } .table { page-break-inside: avoid; } .invoice-summary { page-break-inside: avoid; } -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    </style>
    <style>
        .bg-wrap { width: 800px; background-repeat: no-repeat; background-size: contain; background-position: center; }
    </style>

    <div class="invoice-container">
        <div class="invoice-actions no-print">
            <button class="btn btn-info" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            <button class="btn btn-info" id="download"><i class="fas fa-download"></i> Download</button>
        </div>
        <div class="bg-wrap">
            <div id="invoice">
                <?php
                $is_deposit_invoice = false;
                $is_balance_payment = false; // Flag for the new balance due condition
                $deposit_data = null;
                $balance_due_get_value = 0; // Variable to hold the 'bal_due' value

                // Check if deposit_ref is provided in the URL
                if (isset($_GET['deposit_ref']) && !empty($_GET['deposit_ref'])) {
                    $is_deposit_invoice = true;

                    // Additionally check for bal_due if deposit_ref exists
                    if (isset($_GET['bal_due']) && is_numeric($_GET['bal_due'])) {
                        $is_balance_payment = true;
                        $balance_due_get_value = $_GET['bal_due']; // Store the value
                    }

                    $deposit_ref_id = $_GET['deposit_ref'];
                    $payment_id = $payment->id;

                    // Database connection details
                    $servername = "localhost";
                    $username = "secureispecs_emr_setup";
                    $password = "RukrIp69FR(0";
                    $dbname = "secureispecs_emr";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        $is_deposit_invoice = false; // Fallback to normal invoice if DB connection fails
                    } else {
                        // Prepare and bind to prevent SQL injection
                        $stmt = $conn->prepare("SELECT `date`, `deposited_amount`, `deposit_type` FROM `patient_deposit` WHERE `id` = ? AND `payment_id` = ?");
                        $stmt->bind_param("is", $deposit_ref_id, $payment_id);

                        // Execute query
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            $deposit_data = $result->fetch_object();
                        } else {
                            // No matching deposit found, treat as a normal invoice
                            $is_deposit_invoice = false; 
                        }

                        $stmt->close();
                        $conn->close();
                    }
                }
                ?>
                <div class="corporate-id">
                    <h1><?php echo $settings->title; ?></h1>
                    <h4><?php echo $settings->address; ?></h4>
                    <h4>Tel: <?php echo $settings->phone; ?></h4>
                    
                    <h3><?php echo $is_deposit_invoice ? 'Deposit Invoice' : 'Invoice'; ?></h3>
                </div>
                
                <div class="invoice-info">
                    <div class="info-item">
                        <h4>Invoice Number</h4>
                        <strong>00<?php echo $payment->id; ?></strong>
                    </div>
                    <?php if (!empty($payment->patient)) { ?>
                    <div class="info-item">
                        <h4>Patient Name</h4>
                        <strong>
                            <?php
                            $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
                            echo $patient_info->first_name . ' ' . $patient_info->last_name;
                            ?>
                        </strong>
                    </div>
                    <?php } ?>
                    <div class="info-item">
                        <h4>Cashier</h4>
                        <strong><?php echo $this->db->get_where('users', array('id' => $payment->user))->row()->alias; ?></strong>
                    </div>
                    <div class="info-item">
                        <h4>Date & Time</h4>
                        <strong>
                            <?php 
                            if ($is_deposit_invoice && $deposit_data) {
                                echo date('d/m/Y', $deposit_data->date) . '<br>' . date("h:i:s a", $deposit_data->date);
                            } else {
                                echo date('d/m/Y', $payment->date) . '<br>' . date("h:i:s a");
                            }
                            ?>
                        </strong>
                    </div>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><h5>Qty</h5></th>
                            <th><h5>Item</h5></th>
                            <th><h5>Color</h5></th>
                            <th><h5>Unit Price</h5></th>
                            <th><h5>Total</h5></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php    
                        $user_id = $this->ion_auth->get_user_id(); 
                        $query = $this->db->query("SELECT * FROM  pharmacy_item_payment WHERE pharmacy_payment_id = '$payment->id'"); 
                        foreach ($query->result() as $row) { 
                            $total = $row->quantity * $row->price;
                            $i = 1;
                        ?>
                        <tr>
                            <td><h5><b><?php echo $row->quantity; ?></b></h5></td>
                            <td><h5><b><?php echo $row->name; ?></b></h5></td>
                            <td><h5><b><?php echo $row->color; ?></b></h5></td>
                            <td><h5><b><?php echo $row->price; ?></b></h5></td>
                            <td><h5><b><?php echo $total; ?></b></h5></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h5><b><?php echo $row->f_type; ?></b></h5></td>
                            <td><h5><b><?php echo $row->framelens; ?></b></h5></td>
                            <td><h5><b><?php echo $row->frameitems; ?><br><?php echo $row->misc; ?></b></h5></td>
                            <td><h5><b><?php echo $row->lens_price; ?></b></h5></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <div class="invoice-summary">
                    <div class="invoice-block">
                        <h5><?php echo $is_deposit_invoice ? 'Deposit Summary' : 'Payment Summary'; ?></h5>
                        <ul>
                            <li>Sub Total: <strong><?php echo $settings->currency; ?> <?php echo number_format($payment->subtotal, 2); ?></strong></li>
                            <?php if (!empty($payment->discount)) { ?>
                            <li>Discount: <strong><?php
                                if ($discount_type == 'percentage') {
                                    echo '(%) : ';
                                } else {
                                    echo ': ' . $settings->currency;
                                }
                                ?> <?php
                                $discount = explode('*', $payment->discount);
                                if (!empty($discount[1])) {
                                    echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . number_format($discount[1], 2);
                                } else {
                                    echo number_format($discount[0], 2);
                                }
                                ?></strong></li>
                            <?php } ?>
                            <?php if (!empty($payment->vat)) { ?>
                            <li>VAT: <strong><?php
                                if (!empty($payment->vat)) {
                                    echo $payment->vat;
                                } else {
                                    echo '0';
                                }
                                ?> % = <?php echo $settings->currency . ' ' . number_format($payment->flat_vat, 2); ?></strong></li>
                            <?php }
                            $v = $payment->amount_received;
                            $amount_result = 0;
                            if (!empty($v)) {
                                foreach(explode(',',$v) as $val)
                                    $amount_result += intval($val);
                            }
                            ?>
                            <li>Grand Total: <strong><?php echo $settings->currency; ?> <?php echo number_format($payment->gross_total, 2); ?></strong></li>
                            <li>
                                <?php if ($is_balance_payment && $deposit_data) { ?>
                                    Deposit Received: <strong><?php echo $settings->currency; ?> <?php echo number_format($deposit_data->deposited_amount, 2); ?></strong>
                                <?php } else { ?>
                                    Amount Received: <strong><?php echo $settings->currency; ?> <?php echo number_format($amount_result, 2); ?></strong>
                                <?php } ?>
                            </li>
<li>
<?php
// Check if bal_due is set in URL and is a valid number (including 0)
if (isset($_GET['bal_due']) && is_numeric($_GET['bal_due'])) {
    $balance_due = floatval($_GET['bal_due']);
    
    if ($balance_due > 0) {
        echo "Balance Due: <strong>{$settings->currency}" . number_format($balance_due, 2) . "</strong>";
    } else {
        echo "Balance Due: <strong>$0.00</strong>";
    }
} elseif ($is_balance_payment && isset($balance_due_get_value) && is_numeric($balance_due_get_value)) {
    $balance_due = floatval($balance_due_get_value);
    
    if ($balance_due > 0) {
        echo "Balance Due: <strong>{$settings->currency}" . number_format($balance_due, 2) . "</strong>";
    } else {
        echo "Balance Due: <strong>$0.00</strong>";
    }
} else {
    $change = isset($payment->gross_total) && isset($amount_result) ? $payment->gross_total - $amount_result : 0;
    
    if ($change < 0) {
        echo "Change: <strong>{$settings->currency}" . number_format(abs($change), 2) . "</strong>";
    } elseif ($change > 0) {
        echo "Balance Due: <strong>{$settings->currency}" . number_format($change, 2) . "</strong>";
    } else {
        echo "Balance Due: <strong>$0.00</strong>";
    }
}
?>
</li>
                        </ul>
                    </div>
                    
                    <div class="invoice-block">
                        <h5><?php echo $is_deposit_invoice ? 'Deposit Breakdown' : 'Payment Breakdown'; ?></h5>
                        <ul>
                            <?php
                            if ($is_deposit_invoice && $deposit_data) {
                                // Logic for deposit invoice
                                echo '<li>' . $deposit_data->deposit_type . ': <strong>' . $settings->currency . number_format($deposit_data->deposited_amount, 2) . '</strong></li>';
                            } else {
                                // Original logic for normal invoice
                                $dep_type = $payment->deposit_type;
                                $dep_amount = $payment->receive_breakdown;
                                
                                if (!empty($dep_type) && !empty($dep_amount)) {
                                    $de_type = explode(",", $dep_type);
                                    $de_amount = explode(",", $dep_amount);
                                    
                                    if (count($de_type) == count($de_amount)) {
                                        $item_type_amount = array_combine($de_type, $de_amount);
                                        foreach ($item_type_amount as $key => $value) {
                                            echo '<li>' . trim($key) . ': <strong>' . $settings->currency . number_format(trim($value), 2) . '</strong></li>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div id="settings-receipt-footer">
                    <?php echo $settings->receipt_footer; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="common/js/codearistos.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $(".flashmessage").delay(3000).fadeOut(100);
        });
        
        $('#download').click(function () {
            const invoice = document.getElementById('invoice');
            
            html2canvas(invoice, {
                scale: 2,
                useCORS: true,
                logging: false
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('invoice_id_<?php echo $payment->id; ?>.pdf');
            });
        });
    </script>

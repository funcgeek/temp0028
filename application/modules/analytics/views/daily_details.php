<?php
$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");
// $conn = mysqli_connect("swiftvbs.ipagemysql.com", "ispecs_2", "Pass2020", "ispecs_2");
//$conn = mysqli_connect("localhost", "root", "Pass2020", "ispecs");
?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="text-left">Daily Sales Report for <?php echo $_GET['id']; ?></h3>
                </div>
            </div>
            <header class="panel-heading">
                <?php echo 'Daily Sales Report'; ?> for <strong style='color:red;'><?php echo $_GET['id']; ?></strong>
            </header>
            <div class="col-md-12">
                <div class="panel-body col-md-7">
                    <section>
                        <form role="form" class="panel-body" action="finance/dailyDetails" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="<?php echo lang('date_from'); ?>">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="<?php echo lang('date_to'); ?>">
                                        <input type="hidden" class="form-control dpd2" name="doctor" value="<?php
                                        if (!empty($doctor)) {
                                            echo $doctor;
                                        }
                                        ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-5 panel-body">
                    <button id="export_excel" class="btn btn-success no-print pull-right">Export as Excel</button>
                    <button id="export_csv" class="btn btn-primary no-print pull-right" style="margin-right: 5px;">Export as CSV</button>
                    <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();" style="margin-right: 5px;"><?php echo lang('print'); ?></button>
                </div>
            </div>

            <style>
                #editable-sample_length,
                #editable-sample_info,
                .pagination {
                    display: none;
                }
                /* Add horizontal scrolling for table */
                .table-responsive {
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch; /* Smooth scrolling on touch devices */
                }
                .table-responsive table {
                    min-width: 1400px; /* Increased to accommodate new columns */
                }
                /* Ensure table headers and cells don't wrap */
                .table th, .table td {
                    white-space: nowrap;
                }
                /* Style for the title */
                h3.text-left {
                    margin-bottom: 10px;
                    font-size: 1.5em;
                    color: #333;
                }
            </style>

            <div class="panel-body col-md-12">
                <div class="adv-table editable-table table-responsive">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th><?php echo 'Invoice#'; ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo 'Model#'; ?></th>
                                <th><?php echo 'Colour'; ?></th>
                                <th><?php echo 'Frame Cost'; ?></th>
                                <th><?php echo 'Lens Price'; ?></th>
                                <th><?php echo 'Discount'; ?></th>
                                <th><?php echo 'Final Cost'; ?></th>
                                <th><?php echo 'Other Exam Cost'; ?></th>
                                <th><?php echo 'Other Prescription Cost'; ?></th>
                                <th><?php echo 'Lens'; ?></th>
                                <th><?php echo 'Exam'; ?></th>
                                <th><?php echo 'Pay. Type'; ?></th>
                                <th><?php echo 'Card'; ?></th>
                                <th><?php echo 'Cash'; ?></th>
                                <th><?php echo 'Cheque'; ?></th>
                                <th><?php echo 'HL INS'; ?></th>
                                <th><?php echo 'Claims'; ?></th>
                                <th><?php echo 'Deposit'; ?></th>
                                <th><?php echo 'Total'; ?></th>
                                <th><?php echo 'Others'; ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo 'Bal'; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $report_date = $_GET['id'];
                            $query = "SELECT * FROM pharmacy_payment 
                                    INNER JOIN pharmacy_item_payment ON pharmacy_payment.id = pharmacy_item_payment.pharmacy_payment_id 
                                    WHERE pharmacy_payment.date_string = '".$report_date."'";
                            $newdate = mysqli_query($conn, $query);
                            
                            $amt_sql = mysqli_query($conn, "SELECT sum(gross_total) as amt_total FROM pharmacy_payment where date_string = '".$report_date."'");
                            
                            $sn = 1;
                            $amt_rec = 0;
                            $total_card = 0;
                            $total_cash = 0;
                            $total_cheque = 0;
                            $total_hl_ins = 0;
                            
                            while($row = mysqli_fetch_assoc($newdate)) {
                                // Parse deposit_type and receive_breakdown
                                $deposit_types = explode(",", $row['deposit_type']);
                                $receive_breakdowns = explode(",", $row['receive_breakdown']);
                                $card_amount = 0;
                                $cash_amount = 0;
                                $cheque_amount = 0;
                                $hl_ins_amount = 0;

                                // Map amounts to respective columns based on deposit_type order
                                for ($i = 0; $i < count($deposit_types); $i++) {
                                    $amount = isset($receive_breakdowns[$i]) ? floatval($receive_breakdowns[$i]) : 0;
                                    switch (trim(strtolower($deposit_types[$i]))) {
                                        case 'card':
                                            $card_amount = $amount;
                                            $total_card += $amount;
                                            break;
                                        case 'cash':
                                            $cash_amount = $amount;
                                            $total_cash += $amount;
                                            break;
                                        case 'cheque':
                                            $cheque_amount = $amount;
                                            $total_cheque += $amount;
                                            break;
                                        case 'insurance':
                                            $hl_ins_amount = $amount;
                                            $total_hl_ins += $amount;
                                            break;
                                    }
                                }

                                $transaction_total_paid = array_sum(array_map('floatval', $receive_breakdowns));
                                $amt_rec += $transaction_total_paid;
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $row['pharmacy_payment_id']; ?></td>
                                <td><?php echo $row['patient_name']; ?></td>
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['color']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['lens_price']; ?></td>
                                <td><?php echo $row['discount']; ?></td>
                                <!--<td><?php echo $row['price'] + $row['lens_price'] - $row['discount']; ?></td>-->
                                <!--<td></td>-->
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $row['framelens']; ?></td>
                                <td><?php echo $row['doctor_name']; ?></td>
                                <td>
                                    <?php echo implode(" \n", $deposit_types); ?>
                                </td>
                                <td><?php echo $card_amount > 0 ? '$' . number_format($card_amount, 2) : ''; ?></td>
                                <td><?php echo $cash_amount > 0 ? '$' . number_format($cash_amount, 2) : ''; ?></td>
                                <td><?php echo $cheque_amount > 0 ? '$' . number_format($cheque_amount, 2) : ''; ?></td>
                                <td><?php echo $hl_ins_amount > 0 ? '$' . number_format($hl_ins_amount, 2) : ''; ?></td>
                                <td></td>
                                <td>
                                    <?php
                                        echo '$' . number_format($transaction_total_paid, 2);
                                    ?>
                                </td>
                                <td>$<?php echo number_format($row['gross_total'], 2); ?></td>
                                <td></td>
                                <td><?php echo $row['date_string']; ?></td>
                                <td>
                                    <?php
                                        $received = $row['amount_received'];
                                        $amt_receive = array_sum(explode(',', $received));
                                        $new_amt = $row['gross_total'] - $amt_receive;
                                        echo '$' . number_format($new_amt, 2);
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
           <tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="blue"><b>Total Card Received</b></font></td>
    <td><font color="blue"><b>$<?php echo number_format($total_card, 2); ?></b></font></td>
    <td colspan="11">&nbsp;</td>
</tr>
<tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="blue"><b>Total Cash Received</b></font></td>
    <td><font color="blue"><b>$<?php echo number_format($total_cash, 2); ?></b></font></td>
    <td colspan="11">&nbsp;</td>
</tr>
<tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="blue"><b>Total Cheque Received</b></font></td>
    <td><font color="blue"><b>$<?php echo number_format($total_cheque, 2); ?></b></font></td>
    <td colspan="11">&nbsp;</td>
</tr>
<tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="blue"><b>Total HI INS Received</b></font></td>
    <td><font color="blue"><b>$<?php echo number_format($total_hl_ins, 2); ?></b></font></td>
    <td colspan="11">&nbsp;</td>
</tr>
<tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="blue"><b>Total Discounts</b></font></td>
    <td><font color="blue"><b>$<?php
        $total_discounts = 0;
        $newdate->data_seek(0); // Reset pointer to beginning
        while($row = $newdate->fetch_assoc()) {
            $total_discounts += floatval($row['discount']);
        }
        echo number_format($total_discounts, 2);
    ?></b></font></td>
    <td colspan="11">&nbsp;</td>
</tr>
<tr>
    <td colspan="18">&nbsp;</td>
    <td align="right"><font color="green"><b>Total Amount Due</b></font></td>
    <td><font color="green"><b> $
        <?php
            $am_received_total = 0;
            if ($amt_row = mysqli_fetch_assoc($amt_sql)) {
                $am_received_total = $amt_row['amt_total'];
                echo number_format($am_received_total, 2);
            }
        ?>
    </b></font></td>
</tr>
                            <tr>
                                <td colspan="18">&nbsp;</td>
                                <td align="right"><font color="blue"><b>Total Amount Collected</b></font></td>
                                <td><font color="blue"><b> $<?php echo number_format($amt_rec, 2); ?> </b></font></td>
                            </tr>
                            <tr>
                                <td colspan="18">&nbsp;</td>
                                <td align="right"><b><font color="red">Balance Due</font></b></td>
                                <td>
                                    <?php
                                        $get_total = $am_received_total - $amt_rec;
                                        if ($get_total <= 0) {
                                            echo "<font color='green'><b>$" . number_format($get_total, 2) . "</b></font>";
                                        } else {
                                            echo "<font color='red'><b>$" . number_format($get_total, 2) . "</b></font>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fade out flash messages if present
    const flashMessages = document.querySelectorAll('.flashmessage');
    flashMessages.forEach(function (msg) {
        setTimeout(function () {
            msg.style.opacity = '0';
            setTimeout(function () {
                msg.style.display = 'none';
            }, 100);
        }, 3000);
    });

    const reportDate = '<?php echo $report_date; ?>';
    const fileName = `daily_sales_report_${reportDate}`;

    function downloadFile(data, filename, type) {
        const blob = new Blob([data], { type: type });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    }

    function exportTableToCSV(filename) {
        let csv = ['\ufeff']; // UTF-8 BOM for Excel compatibility
        const rows = document.querySelectorAll('#editable-sample tr');

        rows.forEach(function (row) {
            let rowData = [];
            const cols = row.querySelectorAll('td, th');

            cols.forEach(function (col) {
                let cellData = col.innerText
                    .replace(/(\r\n|\n|\r)/gm, ' ') // Remove newlines
                    .replace(/(\s\s+)/gm, ' ') // Replace multiple spaces
                    .replace(/"/g, '""') // Escape double quotes
                    .trim();
                rowData.push(`"${cellData}"`);
            });
            csv.push(rowData.join(','));
        });

        downloadFile(csv.join('\n'), `${filename}.csv`, 'text/csv;charset=utf-8');
    }

    function exportTableToExcel(tableId, filename) {
        const table = document.getElementById(tableId);
        const tableClone = table.cloneNode(true);
        // Include tfoot rows in the export
        const html = `
            <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
            <head>
                <meta charset="UTF-8">
                <title>Daily Sales Report</title>
                <!--[if gte mso 9]><xml>
                    <x:ExcelWorkbook>
                        <x:ExcelWorksheets>
                            <x:ExcelWorksheet>
                                <x:Name>Daily Sales Report</x:Name>
                                <x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions>
                            </x:ExcelWorksheet>
                        </x:ExcelWorksheets>
                    </x:ExcelWorkbook>
                </xml><![endif]-->
            </head>
            <body>
                <h3>Daily Sales Report for <?php echo $_GET['id']; ?></h3>
                ${tableClone.outerHTML}
            </body>
            </html>
        `;

        downloadFile(html, `${filename}.xls`, 'application/vnd.ms-excel');
    }

    // Attach event listeners to buttons
    const exportCsvButton = document.getElementById('export_csv');
    const exportExcelButton = document.getElementById('export_excel');

    if (exportCsvButton) {
        exportCsvButton.addEventListener('click', function () {
            exportTableToCSV(fileName);
        });
    }

    if (exportExcelButton) {
        exportExcelButton.addEventListener('click', function () {
            exportTableToExcel('editable-sample', fileName);
        });
    }
});
</script>
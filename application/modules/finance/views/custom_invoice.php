<?php
// --- DATABASE LOGIC TO FETCH PATIENT NAME ---
$db_host = "localhost";
$db_user = "secureispecs_emr_setup";
$db_pass = "RukrIp69FR(0";
$db_name = "secureispecs_emr";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
$patient_full_name = "Patient Not Found";
$patient_id = 0;
if (isset($_GET['patient']) && !empty($_GET['patient'])) {
    $patient_id = $_GET['patient'];
    $sql = "SELECT first_name, middle_name, last_name FROM patient WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $patient_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $name_parts = [$row['first_name'], $row['middle_name'], $row['last_name']];
                $full_name = implode(' ', array_filter($name_parts));
                $patient_full_name = ucwords(strtolower($full_name));
            }
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>

    <link rel="stylesheet" href="https://secure-emr.ispecsappeal.net/custom_styles.css">

    <section id="main-content">
        <section class="ci-wrapper">

        <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
            <header class="ci-header">
                <strong>Custom Invoice Management</strong>
                <p class="ci-sub-header">Managing Invoices for <?php echo htmlspecialchars($patient_full_name); ?></p>
            </header>

            <div class="ci-container">
                <div class="ci-col-left">
                    <div class="ci-panel">
                        <h2 class="ci-panel-title">Existing Invoices</h2>
                        <div class="ci-table-container">
                            <table class="ci-table">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Submitted On</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="invoice-list-body">
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="ci-col-right">
                    <div class="ci-panel">
                        <h2 class="ci-panel-title">Create New Invoice</h2>
                        <form id="create-invoice-form" class="ci-form">
                            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                            <div class="ci-form-row">
                                <div class="ci-form-group">
                                    <label for="submitted_on">Submitted On</label>
                                    <input type="date" id="submitted_on" name="submitted_on" required>
                                </div>
                                <div class="ci-form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" id="due_date" name="due_date" required>
                                </div>
                            </div>

                            <div class="ci-form-row">
                                <div class="ci-form-group">
                                    <label for="product_type">Product Type</label>
                                    <select id="product_type" name="product_type">
                                        <option value="Frame">Frame</option>
                                        <option value="Service">Service</option>
                                        <option value="Own Frame">Own Frame</option>
                                    </select>
                                </div>
                                <div class="ci-form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" id="product_name" name="product_name">
                                </div>
                            </div>

                            <hr class="ci-hr">
                            <h3 class="ci-items-title">Invoice Items</h3>
                            <div id="invoice-items-container">
                                </div>
                            <button type="button" id="add-item-btn" class="ci-btn-add">+</button>
                            
                            <hr class="ci-hr">

                            <div class="ci-summary-section">
                                <div class="ci-form-group">
                                    <label for="notes">Notes</label>
                                    <textarea id="notes" name="notes" rows="3"></textarea>
                                </div>

                                <table class="ci-summary-table">
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td id="subtotal-display">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td><label for="adjustments">Adjustments:</label></td>
                                        <td><input type="number" id="adjustments" name="adjustments" value="0.00" step="0.01"></td>
                                    </tr>
                                    <tr class="ci-total-row">
                                        <td>Total:</td>
                                        <td id="total-display">$0.00</td>
                                    </tr>
                                </table>
                            </div>

                            <button type="submit" class="ci-btn-submit">Create Invoice</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const patientId = <?php echo json_encode($patient_id); ?>;
    
    // --- Invoice List Logic ---
    const invoiceListBody = document.getElementById('invoice-list-body');

function fetchInvoices() {
    if (!patientId) return;
    fetch('./db/fetch_custom_invoice.php?patient_id='+ patientId +'&set=0')
        .then(response => response.json())
        .then(data => {
            invoiceListBody.innerHTML = ''; // Clear existing rows
            if (data.success && data.invoices.length > 0) {
                data.invoices.forEach(function(invoice) {
                    const row = 
                        '<tr>' +
                            '<td>#' + invoice.invoice_number + '</td>' +
                            '<td>' + invoice.submitted_on_formatted + '</td>' +
                            '<td>$' + parseFloat(invoice.total_amount).toFixed(2) + '</td>' +
                            '<td>' +
                                '<a href="/finance/viewCustomInvoice?ref=' + invoice.id + '" class="ci-btn-small ci-btn-view">View</a>' +
                            '</td>' +
                        '</tr>';
                    invoiceListBody.innerHTML += row;
                });
            } else {
                invoiceListBody.innerHTML = '<tr><td colspan="4">No custom invoices found.</td></tr>';
            }
        })
        .catch(function(error) {
            console.error('Error fetching invoices:', error);
        });
}


    // --- Form Logic ---
    const itemsContainer = document.getElementById('invoice-items-container');
    const addItemBtn = document.getElementById('add-item-btn');
    const form = document.getElementById('create-invoice-form');
    let itemCounter = 0;

    function addItemRow() {
        itemCounter++;
        const itemRow = document.createElement('div');
        itemRow.classList.add('ci-item-row');
        itemRow.innerHTML = `
            <input type="text" name="descriptions[]" placeholder="Description" required>
            <input type="number" name="quantities[]" placeholder="Qty" class="ci-input-qty" value="1" min="1" required>
            <input type="number" name="unit_prices[]" placeholder="Unit Price" class="ci-input-price" step="0.01" min="0" required>
            <span class="ci-item-total">$0.00</span>
            <button type="button" class="ci-btn-remove">&times;</button>`;
        itemsContainer.appendChild(itemRow);
        
        itemRow.querySelector('.ci-btn-remove').addEventListener('click', () => {
            itemRow.remove();
            updateTotals();
        });
    }

    function updateTotals() {
        let subtotal = 0;
        document.querySelectorAll('.ci-item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('[name="quantities[]"]').value) || 0;
            const price = parseFloat(row.querySelector('[name="unit_prices[]"]').value) || 0;
            const itemTotal = qty * price;
            row.querySelector('.ci-item-total').textContent = `$${itemTotal.toFixed(2)}`;
            subtotal += itemTotal;
        });

        const adjustments = parseFloat(document.getElementById('adjustments').value) || 0;
        const total = subtotal + adjustments; // Assuming adjustments can be negative or positive

        document.getElementById('subtotal-display').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('total-display').textContent = `$${total.toFixed(2)}`;
    }

    itemsContainer.addEventListener('input', updateTotals);
    document.getElementById('adjustments').addEventListener('input', updateTotals);
    addItemBtn.addEventListener('click', addItemRow);

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        
        fetch('./db/create_custom_invoice.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Invoice created successfully!');
                form.reset();
                itemsContainer.innerHTML = '';
                updateTotals();
                fetchInvoices(); // Refresh the list
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error submitting form:', error));
    });

    // Initial setup
    fetchInvoices();
    addItemRow(); // Start with one item row
});
</script>

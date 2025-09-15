<style>
    /* Existing CSS */
    .website-bookings-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 40px;
        font-family: 'Arial', sans-serif;
    }
    .website-bookings-table th, .website-bookings-table td {
        padding: 16px 12px;
        text-align: left;
        font-size: 16px;
        border-bottom: 1px solid #e0e0e0;
        color: #333;
    }
    .website-bookings-table th {
        background: linear-gradient(135deg, #4fb6e6, #3a9cd1);
        color: #fff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .website-bookings-table tr:last-child td {
        border-bottom: none;
    }
    .website-bookings-table tr:nth-child(even) {
        background: #f8fafc;
    }
    .website-bookings-table tr {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .website-bookings-table tr:hover {
        background: #e6f3fa;
        transform: translateY(-2px);
    }
    .avatar-icon {
        width: 40px;
        height: 40px;
        background: #4fb6e6;
        color: #fff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 18px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        margin-right: 8px;
    }
    @media (max-width: 600px) {
        .website-bookings-table th, .website-bookings-table td {
            font-size: 14px;
            padding: 10px 6px;
        }
        .avatar-icon {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }
    }

    /* Panel Styling */
    .panel.panel-default {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .panel-heading {
        background: #ffffff;
        border-bottom: 1px solid #e0e0e0;
        padding: 20px;
    }
    .panel-title {
        font-size: 24px;
        font-weight: 800;
        color: #2c3e50;
        margin: 0;
    }
    .panel-body {
        padding: 20px;
    }

    /* Export Button */
    .export-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #4fb6e6;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-bottom: 20px;
    }
    .export-btn:hover {
        background: #3a9cd1;
    }

    /* Animation for Rows */
    .website-bookings-table tr {
        opacity: 0;
        animation: fadeIn 0.5s ease forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Action Button */
    .action-btn {
        padding: 6px 12px;
        background: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-right: 5px;
    }
    .action-btn:hover {
        background: #45a049;
    }

    /* Delete Button */
    .delete-btn {
        padding: 6px 12px;
        background: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .delete-btn:hover {
        background: #c0392b;
    }

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
    .modal-content {
        background: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 300px;
        text-align: center;
    }
    .modal-close {
        float: right;
        font-size: 20px;
        cursor: pointer;
    }
    .modal-radio {
        margin: 10px 0;
    }
    .modal-btn {
        padding: 8px 16px;
        background: #4fb6e6;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .modal-btn:hover {
        background: #3a9cd1;
    }

    /* Flash Red for New Status */
    .status-new {
        animation: flashRed 1.5s infinite;
    }
    @keyframes flashRed {
        0%, 100% { background-color: #f8fafc; }
        50% { background-color: #ffcccc; }
    }

    /* Sort Dropdown */
    .sort-dropdown {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        margin-left: 10px;
        margin-bottom: 20px;
    }
</style>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Website Bookings</h3>
                </div>
                <div class="panel-body">
                    <button class="export-btn" onclick="exportTableToCSV()">Export to CSV</button>
                    <select class="sort-dropdown" onchange="sortTableByStatus(this.value)">
                        <option value="">Sort by Status</option>
                        <option value="New">New</option>
                        <option value="Called">Called</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Assigned Appointment">Assigned Appointment</option>
                    </select>
                    <table class="website-bookings-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Service</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Doctor</th>
                                <th>Date - Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$json_url = 'https://ispecsappeal.com/EMR/uploads/appointments.json';
$serial = 1;
$tz = new DateTimeZone('America/Jamaica');

// Initialize cURL
$ch = curl_init($json_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 10-second timeout
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
    'Accept: application/json'
]);

// Execute cURL request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// CHANGE 2: Updated colspan to 12 for error messages
if ($error || $response === false) {
    error_log('JSON Fetch Error: cURL error: ' . $error);
    echo '<tr><td colspan="12" style="text-align:center;">Unable to fetch JSON: ' . htmlspecialchars($error) . '</td></tr>';
} elseif ($http_code !== 200) {
    error_log('JSON Fetch Error: HTTP status code: ' . $http_code);
    echo '<tr><td colspan="12" style="text-align:center;">HTTP error fetching JSON, status code: ' . htmlspecialchars($http_code) . '</td></tr>';
} else {
    // Parse JSON
    $json_data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('JSON Fetch Error: JSON parsing error: ' . json_last_error_msg());
        echo '<tr><td colspan="12" style="text-align:center;">Invalid JSON format</td></tr>';
    } elseif (empty($json_data)) {
        error_log('JSON Fetch Error: Empty JSON data');
        echo '<tr><td colspan="12" style="text-align:center;">No data available in JSON</td></tr>';
    } else {
        $hasData = false;
        foreach ($json_data as $row) {
            $hasData = true;
            $date_utc = isset($row['date']) ? $row['date'] : '';
            $name = isset($row['name']) ? htmlspecialchars($row['name']) : '';
            $email = isset($row['email']) ? htmlspecialchars($row['email']) : '';
            $phone = isset($row['phone']) ? htmlspecialchars($row['phone']) : '';
            $service = isset($row['service']) ? htmlspecialchars($row['service']) : '';
            
            // CHANGE 3: Get location and type from JSON row
            $location = isset($row['location']) ? htmlspecialchars($row['location']) : '';
            $type = isset($row['type']) ? htmlspecialchars($row['type']) : '';

            $doctor = isset($row['doctor']) ? htmlspecialchars($row['doctor']) : '';
            $status = isset($row['status']) ? htmlspecialchars($row['status']) : 'New'; // Default to "New" if not set

            // Remove commas from name and extra spaces
            $name = str_replace(',', ' ', $name);
            $name = preg_replace('/\s+/', ' ', $name);

            // Avatar: first letter of name
            $avatar_letter = $name ? strtoupper(substr(trim($name), 0, 1)) : '?';

            // Convert UTC to Jamaica time
            try {
                $dt = new DateTime($date_utc, new DateTimeZone('UTC'));
                $dt->setTimezone($tz);
                $jamaica_date = $dt->format('M d, Y h:i A');
            } catch (Exception $e) {
                error_log('JSON Fetch Error: Date conversion error: ' . $e->getMessage());
                $jamaica_date = $date_utc; // Fallback to raw date
            }

            // Add class for "New" status to flash red
            $row_class = ($status === 'New') ? 'status-new' : '';
            
            // CHANGE 4: Added cells for location and type in the table row
            echo "<tr data-email='{$email}' class='{$row_class}'>
                <td>{$serial}</td>
                <td><span class='avatar-icon'>{$avatar_letter}</span></td>
                <td>{$name}</td>
                <td>{$email}</td>
                <td>{$phone}</td>
                <td>{$service}</td>
                <td>{$location}</td>
                <td>{$type}</td>
                <td>{$doctor}</td>
                <td>{$jamaica_date}</td>
                <td>{$status}</td>
                <td>
                    <button class='action-btn' onclick='showModal(\"{$email}\", \"{$status}\")'>Change Status</button>
                    <button class='delete-btn' onclick='confirmDelete(\"{$email}\")'>Delete</button>
                </td>
            </tr>";
            $serial++;
        }

        if (!$hasData) {
            error_log('JSON Fetch Error: No valid data in JSON');
            // CHANGE 2 (repeated): Updated colspan to 12
            echo '<tr><td colspan="12" style="text-align:center;">No data available in table</td></tr>';
        }
    }
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</section>

<div id="statusModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <h3>Change Status</h3>
        <input type="hidden" id="modalEmail">
        <div class="modal-radio">
            <input type="radio" id="statusNew" name="status" value="New">
            <label for="statusNew">New</label>
        </div>
        <div class="modal-radio">
            <input type="radio" id="statusCalled" name="status" value="Called">
            <label for="statusCalled">Called</label>
        </div>
        <div class="modal-radio">
            <input type="radio" id="statusCancelled" name="status" value="Cancelled">
            <label for="statusCancelled">Cancelled</label>
        </div>
        <div class="modal-radio">
            <input type="radio" id="statusAssigned" name="status" value="Assigned Appointment">
            <label for="statusAssigned">Assigned Appointment</label>
        </div>
        <button class="modal-btn" onclick="updateStatus()">Change</button>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeDeleteModal()">&times;</span>
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete this booking?</p>
        <input type="hidden" id="deleteEmail">
        <button class="modal-btn" onclick="deleteBooking()">Yes, Delete</button>
        <button class="modal-btn" style="background: #e74c3c;" onclick="closeDeleteModal()">Cancel</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript for Export to CSV
    function exportTableToCSV() {
        const table = document.querySelector('.website-bookings-table');
        const rows = table.querySelectorAll('tr');
        let csvContent = '';

        // Add header
        const headers = Array.from(rows[0].querySelectorAll('th')).map(th => `"${th.textContent.trim()}"`);
        csvContent += headers.join(',') + '\n';

        // Add data rows
        for (let i = 1; i < rows.length; i++) {
            const cells = Array.from(rows[i].querySelectorAll('td')).map(td => {
                const text = td.querySelector('.avatar-icon') ? '' : td.textContent.trim();
                return `"${text.replace(/"/g, '""')}"`;
            });
            csvContent += cells.join(',') + '\n';
        }

        // Create download link
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'bookings_export_' + new Date().toISOString().slice(0, 10) + '.csv';
        link.click();
        URL.revokeObjectURL(link.href);
    }

    // JavaScript for Row Animation Delay
    document.querySelectorAll('.website-bookings-table tr').forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
    });

    // Status Modal Functions
    function showModal(email, currentStatus) {
        const modal = document.getElementById('statusModal');
        document.getElementById('modalEmail').value = email;

        // Set the current status as selected
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.checked = radio.value === currentStatus;
        });

        modal.style.display = 'block';
    }

    function closeModal() {
        document.getElementById('statusModal').style.display = 'none';
    }

    // AJAX to Update JSON
    function updateStatus() {
        const email = document.getElementById('modalEmail').value;
        const status = document.querySelector('input[name="status"]:checked')?.value;

        if (!status) {
            alert('Please select a status.');
            return;
        }

        $.ajax({
            url: 'https://ispecsappeal.com/EMR/uploads/update_status.php',
            type: 'POST',
            data: { email: email, status: status },
            success: function(response) {
                if (response === 'Success') {
                    // Update the table row status and class
                    const row = document.querySelector(`tr[data-email="${email}"]`);
                    if (row) {
                        // CHANGE 5: Updated cell index for Status from 8 to 10
                        row.cells[10].textContent = status; // Update Status column (index 10)
                        row.className = status === 'New' ? 'status-new' : ''; // Update flash effect
                    }
                    closeModal();
                    console.log('Status updated successfully.');
                } else {
                    alert('Failed to update status: ' + response);
                    console.error('Update Status Response:', response);
                }
            },
            error: function(xhr, status, error) {
                // alert('Error updating status: ' + (xhr.responseText || error));
                // console.error('AJAX Error:', xhr.responseText, status, error);
                
                                // alert('Error updating status: ' + error);
                alert('Contact Status Updated. Reload Page!');
            }
        });
    }

    // Delete Modal Functions
    function confirmDelete(email) {
        const modal = document.getElementById('deleteModal');
        document.getElementById('deleteEmail').value = email;
        modal.style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function deleteBooking() {
        const email = document.getElementById('deleteEmail').value;

        $.ajax({
            url: 'https://ispecsappeal.com/EMR/uploads/delete_booking.php',
            type: 'POST',
            data: { email: email },
            success: function(response) {
                if (response === 'Success') {
                    // Remove the table row
                    const row = document.querySelector(`tr[data-email="${email}"]`);
                    if (row) {
                        row.remove();
                    }
                    closeDeleteModal();
                    console.log('Booking deleted successfully.');
                } else {
                    alert('Failed to delete booking: ' + response);
                    console.error('Delete Booking Response:', response);
                }
            },
            error: function(xhr, status, error) {
                // alert('Error deleting booking: ' + (xhr.responseText || error));
                // console.error('AJAX Error:', xhr.responseText, status, error);
                
                                // alert('Error updating status: ' + error);
                alert('Contact Deleted. Reload Page!');
            }
        });
    }

    // Sort Table by Status
    function sortTableByStatus(status) {
        const table = document.querySelector('.website-bookings-table tbody');
        const rows = Array.from(table.querySelectorAll('tr'));

        if (!status) {
            // Reset to original order (by serial number)
            rows.sort((a, b) => {
                return parseInt(a.cells[0].textContent) - parseInt(b.cells[0].textContent);
            });
        } else {
            // Sort by status, prioritizing the selected status
            const statusOrder = ['New', 'Called', 'Cancelled', 'Assigned Appointment'];
            rows.sort((a, b) => {
                // CHANGE 6: Updated cell index for Status from 8 to 10
                const statusA = a.cells[10].textContent;
                const statusB = b.cells[10].textContent;
                if (statusA === status && statusB !== status) return -1;
                if (statusA !== status && statusB === status) return 1;
                return statusOrder.indexOf(statusA) - statusOrder.indexOf(statusB);
            });
        }

        // Clear and re-append sorted rows
        table.innerHTML = '';
        rows.forEach(row => table.appendChild(row));
    }
</script>
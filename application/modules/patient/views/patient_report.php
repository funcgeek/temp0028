<style>
    .patient_report_container {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }
    .patient_report_header strong {
        font-size: 22px;
    }
    .patient_report_clause {
        color: #b48b00; /* Yellowish text */
        background-color: #fffacd; /* Light yellow background */
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        border: 1px solid #ffeb99;
    }
    .patient_report_filters {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 20px;
        align-items: flex-end;
    }
    .patient_report_filters .filter-group {
        display: flex;
        flex-direction: column;
    }
    .patient_report_filters label {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .patient_report_filters select,
    .patient_report_filters input[type="text"],
    .patient_report_filters input[type="date"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }
    .patient_report_toolbar {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .patient_report_count {
        font-size: 16px;
        font-weight: 500;
    }
    .patient_report_export_buttons button {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        margin-left: 10px;
    }
    .patient_report_export_buttons .csv-btn {
        background-color: #28a745;
        color: white;
    }
    .patient_report_export_buttons .excel-btn {
        background-color: #217346;
        color: white;
    }
    .patient_table_wrapper {
        margin-top: 20px;
        width: 100%;
        overflow-x: auto; /* Horizontal scroll */
        max-height: 600px; /* Vertical scroll */
        overflow-y: auto;
        border: 1px solid #ddd;
    }
    .patient_report_table {
        width: 100%;
        border-collapse: collapse;
    }
    .patient_report_table th, .patient_report_table td {
        padding: 12px;
        border: 1px solid #e0e0e0;
        text-align: left;
        white-space: nowrap; /* Prevents text wrapping */
    }
    .patient_report_table thead {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }
     /* Initially hide the custom date range inputs */
    #custom_date_range {
        display: none;
        gap: 15px;
    }
</style>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="patient_report_container">
            <header class="panel-heading patient_report_header">
                <strong><?php echo 'Patient'; ?> <?php echo 'Database'; ?> Export</strong>
                <p class="patient_report_clause">This report allows export of all the record of all Patients.</p>
            </header>

            <div class="patient_report_filters">
                <div class="filter-group">
                    <label for="location_filter">Location</label>
                    <select id="location_filter" name="location">
                        <option value="ALL">ALL</option>
                        <option value="Montego Bay">Montego Bay</option>
                        <option value="Falmouth">Falmouth</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="date_filter">Date Range</label>
                    <select id="date_filter" name="date_range">
                        <option value="None">None</option>
                        <option value="Today">Today</option>
                        <option value="1 Week">1 Week</option>
                        <option value="1 Month">1 Month</option>
                        <option value="3 Months">3 Months</option>
                        <option value="1 Year">1 Year</option>
                        <option value="Custom">Custom</option>
                    </select>
                </div>
                
                <div id="custom_date_range" class="filter-group" style="flex-direction: row; align-items: flex-end;">
                     <div class="filter-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date">
                     </div>
                     <div class="filter-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date">
                     </div>
                </div>

                <div class="filter-group">
                    <label for="patient_type_filter">Patient Type</label>
                    <select id="patient_type_filter" name="patient_type">
                        <option value="ALL">ALL</option>
                        <option value="Existing Patient">Existing Patient</option>
                        {{-- Add other patient types here if they exist --}}
                    </select>
                </div>

                <div class="filter-group">
                    <label for="search_filter">Search by Name/Email</label>
                    <input type="text" id="search_filter" name="search" placeholder="Search...">
                </div>
            </div>

            <div class="patient_report_toolbar">
                <div id="patient_count" class="patient_report_count">Loading...</div>
                <div class="patient_report_export_buttons">
                    <button id="export_csv" class="csv-btn">Export to CSV</button>
                    <button id="export_excel" class="excel-btn">Export to Excel</button>
                </div>
            </div>

            <div class="patient_table_wrapper">
                <table class="patient_report_table">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Sex</th>
                            <th>Birthdate</th>
                            <th>Location</th>
                            <th>Patient Type</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody id="patient_table_body">
                        <tr><td colspan="9" style="text-align:center;">Loading patient data...</td></tr>
                    </tbody>
                </table>
            </div>

        </section>
        </section>
</section>

{{-- You'll need jQuery for the AJAX calls. Ensure it's loaded in your main layout. --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
$(document).ready(function() {
    const API_URL = './db/get_patient_reports.php';

    // Function to fetch and display patient data
    function fetchPatients() {
        const filters = {
            location: $('#location_filter').val(),
            date_range: $('#date_filter').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            patient_type: $('#patient_type_filter').val(),
            search: $('#search_filter').val()
        };

        $('#patient_table_body').html('<tr><td colspan="9" style="text-align:center;">Fetching data...</td></tr>');

        $.ajax({
            url: API_URL,
            type: 'GET',
            data: filters,
            dataType: 'json',
            success: function(response) {
                const tableBody = $('#patient_table_body');
                tableBody.empty(); // Clear previous results

                // Update count
                $('#patient_count').text(`Showing ${response.filtered_count} of ${response.total_count} Patients`);

                if (response.data && response.data.length > 0) {
                    $.each(response.data, function(index, patient) {
                        // Use empty string for null values
                        const patientId = patient.patient_id || '';
                        const name = patient.name || '';
                        const email = patient.email || '';
                        const phone = patient.phone || '';
                        const sex = patient.sex || '';
                        const birthdate = patient.birthdate || '';
                        const location = patient.location || '';
                        const patientType = patient.patient_type || '';
                        const addDate = patient.add_date || '';

                        const row = `<tr>
                            <td>${patientId}</td>
                            <td>${name}</td>
                            <td>${email}</td>
                            <td>${phone}</td>
                            <td>${sex}</td>
                            <td>${birthdate}</td>
                            <td>${location}</td>
                            <td>${patientType}</td>
                            <td>${addDate}</td>
                        </tr>`;
                        tableBody.append(row);
                    });
                } else {
                    tableBody.html('<tr><td colspan="9" style="text-align:center;">No patients found matching your criteria.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                $('#patient_table_body').html('<tr><td colspan="9" style="text-align:center;">Failed to load data. Please check the console for errors.</td></tr>');
                $('#patient_count').text('Error');
            }
        });
    }

    // Event listeners for filters
    $('#location_filter, #date_filter, #patient_type_filter, #start_date, #end_date').on('change', fetchPatients);
    
    // Use a debounce for the search input to avoid too many requests
    let searchTimeout;
    $('#search_filter').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(fetchPatients, 500); // 500ms delay
    });

    // Show/hide custom date range inputs
    $('#date_filter').on('change', function() {
        if ($(this).val() === 'Custom') {
            $('#custom_date_range').css('display', 'flex');
        } else {
            $('#custom_date_range').hide();
        }
    });
    
    // Export functionality
    function exportData(format) {
        const filters = {
            location: $('#location_filter').val(),
            date_range: $('#date_filter').val(),
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            patient_type: $('#patient_type_filter').val(),
            search: $('#search_filter').val(),
            export: format // 'csv' or 'excel'
        };
        
        // Build query string from filters
        const queryString = $.param(filters);
        window.location.href = API_URL + '?' + queryString;
    }

    $('#export_csv').on('click', function() {
        exportData('csv');
    });

    $('#export_excel').on('click', function() {
        exportData('excel');
    });


    // Initial data load
    fetchPatients();
});
</script>

{{-- @endsection --}}
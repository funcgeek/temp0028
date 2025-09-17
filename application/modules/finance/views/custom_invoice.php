<?php
    // --- DATABASE LOGIC TO FETCH PATIENT NAME ---

    // 1. Define database connection details
    $db_host = "localhost";
    $db_user = "secureispecs_emr_setup";
    $db_pass = "RukrIp69FR(0";
    $db_name = "secureispecs_emr";

    // 2. Establish a connection to the database
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Check the connection for errors
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 3. Set a default name in case the patient isn't found
    $patient_full_name = "Patient Not Found";

    // 4. Check if a patient ID is present in the URL
    if (isset($_GET['patient']) && !empty($_GET['patient'])) {
        $patient_id = $_GET['patient'];

        // 5. Prepare a secure SQL query to prevent SQL injection
        $sql = "SELECT first_name, middle_name, last_name FROM patient WHERE id = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the patient ID to the query
            mysqli_stmt_bind_param($stmt, "i", $patient_id); // "i" means the parameter is an integer

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                // If a patient is found, fetch their details
                if ($row = mysqli_fetch_assoc($result)) {
                    // Combine the names, handling potential empty middle name
                    $name_parts = [$row['first_name'], $row['middle_name'], $row['last_name']];
                    $full_name = implode(' ', array_filter($name_parts));

                    // Format the name: make all lowercase, then capitalize the first letter of each word
                    $patient_full_name = ucwords(strtolower($full_name));
                }
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }

    // 6. Close the database connection
    mysqli_close($conn);
?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="patient_report_container">
            <header class="panel-heading patient_report_header">
                <strong>Custom Invoice</strong>
                
                <p class="patient_report_clause">Custom Invoices for <?php echo htmlspecialchars($patient_full_name); ?></p>

            </header>
        </section>
    </section>
</section>
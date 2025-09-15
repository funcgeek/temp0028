<?php
// Include your database connection file
include('db.php');	

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Get Data from Form ---
    $id = $_REQUEST['p_id']; // The ID of the record to edit
    
    // Get all the fields from the POST request
    $date = $_POST['date'];
    $age = $_POST['age'];
    $title = $_POST['title'];
    $med_history = $_POST['med_history'];
    $medications = $_POST['medications'];
    $description = $_POST['description'];
    $patient_id = $_POST['patient_id_set'];
    
    // Convert date to a timestamp to store in the database (for consistency with your add function)
    $date_timestamp = !empty($date) ? strtotime($date) : time();

    // --- 2. Prepare Secure SQL Statement ---
    // The query to update the medical_history table
    $sql = "UPDATE medical_history 
            SET date = ?, 
                age = ?, 
                title = ?, 
                med_history = ?, 
                medications = ?, 
                description = ? 
            WHERE id = ?";

    // Prepare the statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // --- 3. Bind Parameters and Execute ---
        // 'isssssi' tells MySQL the data types: i=integer, s=string
        mysqli_stmt_bind_param($stmt, "isssssi", 
            $date_timestamp,
            $age,
            $title,
            $med_history,
            $medications,
            $description,
            $id
        );

        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Close the statement
        mysqli_stmt_close($stmt);
    }
    
    // --- 4. Redirect Back to Previous Page ---
    header("Location: https://secure-emr.ispecsappeal.net/patient/medicalHistory?id=$patient_id&tab=home");
    exit(); // Always exit after a header redirect
}
?>
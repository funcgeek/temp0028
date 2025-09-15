<?php
// Database Configuration
$db_host = 'localhost';
$db_name = 'secureispecs_emr';
$db_user = 'secureispecs_emr_setup';
$db_pass = 'RukrIp69FR(0';

// Connect to database
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$connection) {
    // Return a JSON error to be handled by AJAX
    header('Content-Type: application/json');
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => "Connection failed: " . mysqli_connect_error()]);
    exit;
}

// Handle AJAX requests
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'fetch') {
        $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'created_at';
        $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';
        
        $offset = ($page - 1) * $limit;
        
        // Allowed columns for sorting (security)
        $allowed_columns = ['id', 'recipient_email', 'recipient_name', 'subject', 'message', 'status', 'sent_at', 'sender_id', 'attachments', 'created_at'];
        if (!in_array($sort_column, $allowed_columns)) {
            $sort_column = 'created_at';
        }
        
        if (!in_array(strtoupper($sort_order), ['ASC', 'DESC'])) {
            $sort_order = 'DESC';
        }
        
        // Build WHERE clause
        $where = "";
        if (!empty($search)) {
            $where = "WHERE recipient_email LIKE '%$search%' OR recipient_name LIKE '%$search%' OR subject LIKE '%$search%' OR message LIKE '%$search%' OR status LIKE '%$search%'";
        }
        
        // Count total records
        $count_sql = "SELECT COUNT(*) as total FROM NewEMRemail_log $where";
        $count_result = mysqli_query($connection, $count_sql);
        $count_row = mysqli_fetch_assoc($count_result);
        $total_records = $count_row['total'];
        
        // Fetch records
        $sql = "SELECT * FROM NewEMRemail_log $where ORDER BY `$sort_column` $sort_order LIMIT $limit OFFSET $offset";
        $result = mysqli_query($connection, $sql);
        
        $records = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $records[] = $row;
            }
        }
        
        $total_pages = ceil($total_records / $limit);
        
        header('Content-Type: application/json');
        echo json_encode([
            'records' => $records,
            'total_records' => (int)$total_records,
            'total_pages' => $total_pages,
            'current_page' => $page
        ]);
        exit;
    }
    
    if ($_GET['action'] == 'export') {
        $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
        $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'created_at';
        $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';
        
        // Allowed columns for sorting (security)
        $allowed_columns = ['id', 'recipient_email', 'recipient_name', 'subject', 'message', 'status', 'sent_at', 'sender_id', 'attachments', 'created_at'];
        if (!in_array($sort_column, $allowed_columns)) {
            $sort_column = 'created_at';
        }
        
        if (!in_array(strtoupper($sort_order), ['ASC', 'DESC'])) {
            $sort_order = 'DESC';
        }
        
        $where = "";
        if (!empty($search)) {
            $where = "WHERE recipient_email LIKE '%$search%' OR recipient_name LIKE '%$search%' OR subject LIKE '%$search%' OR message LIKE '%$search%' OR status LIKE '%$search%'";
        }
        
        $sql = "SELECT * FROM NewEMRemail_log $where ORDER BY `$sort_column` $sort_order";
        $result = mysqli_query($connection, $sql);
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="email_logs_' . date('Y-m-d_H-i-s') . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        if ($result && mysqli_num_rows($result) > 0) {
            $first_row = mysqli_fetch_assoc($result);
            fputcsv($output, array_keys($first_row));
            
            // Output the first row that was fetched
            fputcsv($output, $first_row);
            
            // Output remaining rows
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row);
            }
        } else {
            // If no data, still output headers
            fputcsv($output, ['id', 'recipient_email', 'recipient_name', 'subject', 'message', 'status', 'sent_at', 'sender_id', 'attachments', 'created_at']);
        }
        
        fclose($output);
        exit;
    }
}

// Close connection at the end
if (isset($connection)) {
    mysqli_close($connection);
}
?>
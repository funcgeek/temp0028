<?php

// --- Database Connection ---
$host = "localhost";
$username = "secureispecs_emr_setup";
$password = "RukrIp69FR(0";
$dbname = "secureispecs_emr";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die(json_encode(['error' => 'Database connection failed: ' . mysqli_connect_error()]));
}

// --- Helper function for export headers ---
function create_export_header($conn, $filters) {
    $filtered_count_sql = "SELECT COUNT(*) as count FROM `patient` " . $filters['where_clause'];
    $filtered_count_result = mysqli_query($conn, $filtered_count_sql, MYSQLI_ASSOC);
    $filtered_count = mysqli_fetch_assoc($filtered_count_result)['count'];
    
    $header_lines = ["Patient Data Export Report"];
    $header_lines[] = "Generated on: " . date("Y-m-d H:i:s");
    $header_lines[] = "Total Records in this Export: " . $filtered_count;
    $header_lines[] = "Filters Applied:";
    
    $header_lines[] = "  - Location: " . htmlspecialchars($filters['params']['location'] ?? 'ALL');
    $header_lines[] = "  - Date Range: " . htmlspecialchars($filters['params']['date_range'] ?? 'None');
    if (($filters['params']['date_range'] ?? '') === 'Custom') {
        $start = htmlspecialchars($filters['params']['start_date'] ?? 'N/A');
        $end = htmlspecialchars($filters['params']['end_date'] ?? 'N/A');
        $header_lines[] = "      - From: $start To: $end";
    }
    $header_lines[] = "  - Patient Type: " . htmlspecialchars($filters['params']['patient_type'] ?? 'ALL');
    $header_lines[] = "  - Search Term: '" . htmlspecialchars($filters['params']['search'] ?? '') . "'";
    $header_lines[] = ""; // Blank line before data
    
    return $header_lines;
}

// --- Build SQL Query from Filters ---
function build_query_filters($conn, $params) {
    $where_conditions = [];
    
    // Location Filter
    if (!empty($params['location']) && $params['location'] !== 'ALL') {
        $location = mysqli_real_escape_string($conn, $params['location']);
        $where_conditions[] = "`location` = '$location'";
    }

    // Patient Type Filter
    if (!empty($params['patient_type']) && $params['patient_type'] !== 'ALL') {
        $patient_type = mysqli_real_escape_string($conn, $params['patient_type']);
        $where_conditions[] = "`patient_type` = '$patient_type'";
    }

    // Search Filter
    if (!empty($params['search'])) {
        $search = mysqli_real_escape_string($conn, $params['search']);
        $where_conditions[] = "(`first_name` LIKE '%$search%' OR `middle_name` LIKE '%$search%' OR `last_name` LIKE '%$search%' OR `email` LIKE '%$search%' OR `name` LIKE '%$search%')";
    }
    
    // Date Range Filter
    // IMPORTANT: The date format in DB is dd/mm/yy which is not ideal. We use STR_TO_DATE.
    if (!empty($params['date_range']) && $params['date_range'] !== 'None') {
        $range = $params['date_range'];
        $date_col = "STR_TO_DATE(`add_date`, '%d/%m/%y')";
        
        if ($range === 'Today') {
            $where_conditions[] = "$date_col = CURDATE()";
        } elseif ($range === '1 Week') {
            $where_conditions[] = "$date_col >= CURDATE() - INTERVAL 7 DAY";
        } elseif ($range === '1 Month') {
            $where_conditions[] = "$date_col >= CURDATE() - INTERVAL 1 MONTH";
        } elseif ($range === '3 Months') {
            $where_conditions[] = "$date_col >= CURDATE() - INTERVAL 3 MONTH";
        } elseif ($range === '1 Year') {
            $where_conditions[] = "$date_col >= CURDATE() - INTERVAL 1 YEAR";
        } elseif ($range === 'Custom' && !empty($params['start_date']) && !empty($params['end_date'])) {
            $start_date = mysqli_real_escape_string($conn, $params['start_date']);
            $end_date = mysqli_real_escape_string($conn, $params['end_date']);
            $where_conditions[] = "$date_col BETWEEN '$start_date' AND '$end_date'";
        }
    }
    
    $where_clause = "";
    if (count($where_conditions) > 0) {
        $where_clause = "WHERE " . implode(" AND ", $where_conditions);
    }
    
    return ['where_clause' => $where_clause, 'params' => $params];
}

$filters = build_query_filters($conn, $_GET);

// --- Handle Export Request ---
if (isset($_GET['export'])) {
    $export_format = $_GET['export'];
    
    $report_header_info = create_export_header($conn, $filters);
    
    $sql = "SELECT * FROM `patient` " . $filters['where_clause'] . " ORDER BY `id` DESC";
    $result = mysqli_query($conn, $sql);

    if ($export_format === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="patient_report_'.date('Y-m-d').'.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Add report header
        foreach ($report_header_info as $line) {
            fputcsv($output, [$line]);
        }
        
        // Add table headers
        $header_row = array_keys(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `patient` LIMIT 1")));
        fputcsv($output, $header_row);

        // Add data
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }
        fclose($output);
        
    } elseif ($export_format === 'excel') {
        // For Excel, we'll generate a tab-separated TSV file which Excel opens cleanly
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="patient_report_'.date('Y-m-d').'.xls"');
        
        // Add report header
        foreach ($report_header_info as $line) {
            echo $line . "\n";
        }

        $header_row = array_keys(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `patient` LIMIT 1")));
        echo implode("\t", $header_row) . "\n";
        
        while ($row = mysqli_fetch_assoc($result)) {
            // Sanitize data to prevent issues with tabs/newlines within cells
            array_walk($row, function(&$str) {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    
    mysqli_close($conn);
    exit();
}

// --- Handle AJAX Data Request ---
header('Content-Type: application/json');

// Get total patient count
$total_count_sql = "SELECT COUNT(*) as count FROM `patient`";
$total_count_result = mysqli_query($conn, $total_count_sql);
$total_count = mysqli_fetch_assoc($total_count_result)['count'];

// Get filtered patient count
$filtered_count_sql = "SELECT COUNT(*) as count FROM `patient` " . $filters['where_clause'];
$filtered_count_result = mysqli_query($conn, $filtered_count_sql);
$filtered_count = mysqli_fetch_assoc($filtered_count_result)['count'];


// Get filtered data
$data_sql = "SELECT `patient_id`, `name`, `email`, `phone`, `sex`, `birthdate`, `location`, `patient_type`, `add_date` FROM `patient` " . $filters['where_clause'] . " ORDER BY `id` DESC";
$data_result = mysqli_query($conn, $data_sql);

$patients = [];
if ($data_result) {
    while ($row = mysqli_fetch_assoc($data_result)) {
        $patients[] = $row;
    }
}

$response = [
    'total_count' => (int)$total_count,
    'filtered_count' => (int)$filtered_count,
    'data' => $patients,
];

echo json_encode($response);

mysqli_close($conn);

?>
<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode the URL-encoded file path

    // Ensure the file exists and is accessible
    if (file_exists($file)) {
        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        
        // Clear output buffer and send the file
        ob_clean();
        flush();
        readfile($file);
        exit;
    } else {
        // Handle file not found error
        die('File not found.');
    }
} else {
    // Handle missing file parameter
    die('No file specified.');
}
?>
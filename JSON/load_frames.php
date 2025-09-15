<?php
// Database connection
$conn2 = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

// Check connection
if (!$conn2) {
    http_response_code(500);
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}

// Query to fetch data from medicine table where type = 'frames'
// MODIFIED: Added 'frame_label' to the SELECT statement
$query = "SELECT id, name, url, category, box, effects, s_price, quantity, quantity_2, frame_label 
          FROM medicine 
          WHERE type = 'frames'";

$result = mysqli_query($conn2, $query);

// Check if query was successful
if (!$result) {
    http_response_code(500);
    die(json_encode(["error" => "Query failed: " . mysqli_error($conn2)]));
}

// Initialize array to store formatted data
$frames = [];

// Default image URL for null or empty url values
$default_image_url = "https://img.freepik.com/premium-vector/pair-glasses-with-pair-glasses-it_971593-3404.jpg";
$base_url = "https://secure-emr.ispecsappeal.net/";

while ($row = mysqli_fetch_assoc($result)) {
    // Format s_price to remove dollar sign
    $sale_price_set = str_replace('$', '', $row['s_price']);
    $sale_price = str_replace(',', '', $sale_price_set);
    
    // Construct image URL
    $image_url = !empty($row['url']) ? $base_url . ltrim($row['url'], '/') : $default_image_url;
    
    // Add row to frames array with specified key names
    $frames[] = [
        'ID' => $row['id'],
        'Model' => $row['name'],
        'Image' => $image_url,
        'Brand / Category' => $row['category'],
        'Size' => $row['box'],
        'Color' => $row['effects'],
        'Sale Price' => $sale_price,
        'quantity' => $row['quantity'],
        'quantity_2' => $row['quantity_2'],
        'Labels' => $row['frame_label'] // MODIFIED: Added the new 'Labels' key
    ];
}

// Close database connection
mysqli_close($conn2);

// Set JSON header and output data
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow CORS
echo json_encode($frames, JSON_PRETTY_PRINT);
?>
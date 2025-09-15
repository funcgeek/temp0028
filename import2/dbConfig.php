<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "secureispecs_emr_setup";
$dbPassword = "RukrIp69FR(0";
$dbName     = "secureispecs_emr";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


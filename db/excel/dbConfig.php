<?php
// Database configuration
$dbHost     = "swiftvbs.ipagemysql.com";
$dbUsername = "ispecs_0";
$dbPassword = "Pass@2020";
$dbName     = "ispecs_0";

$conn = mysqli_connect("swiftvbs.ipagemysql.com", "ispecs_0", "Pass@2020", "ispecs_0");
$conn2 = mysqli_connect("swiftvbs.ipagemysql.com", "ispecs_0", "Pass@2020", "ispecs_0");

	$conn = new mysqli("swiftvbs.ipagemysql.com", "ispecs_0", "Pass@2020", "ispecs_0");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
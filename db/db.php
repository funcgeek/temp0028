<?php
$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");
$conn2 = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");

	$con = new mysqli("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");
	if($con->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>
<?php 
		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	//if (isset($_REQUEST['id'])) {
	//	if(ISSET($_POST['insert'])){
		$model=$_POST['pname'];
		$category=$_POST['pcat'];
		$color=$_POST['pcolor'];
		$size=$_POST['psize'];
	
		mysqli_query($conn, "INSERT INTO ownframe (model, category, color, size) VALUES ('$model', '$category', '$color', '$size') ") or die(mysqli_error());
	//	header("location: index.php");
//	}

?>


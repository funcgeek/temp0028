<?php
	$conn = mysqli_connect("localhost", "ispecs_0", "Pass@2020", "ispecs_0");


			$id = $_REQUEST['p_id'];
		//	$query = "SELECT * FROM medical_history WHERE id=".$id;
	
	$date=$_POST['edit_date'];
	$location=$_POST['location'];
	$doctor=$_POST['edit_doctor'];
	$title=$_POST['edit_title'];
	$description=$_POST['edit_description'];
	$appid=$_POST['appid'];
	$newdescript = '<p><hr width="100%">Updated Caption: '.$title.'<br>Updated Date: '.$date.'<br>Location: '.$location.'<br>Updated By: '.$doctor.'<p><u>Updated Description: </u><br>'.$description.'<p>';

	
	
	mysqli_query($conn, "update medical_history SET
	description = CONCAT(description,'$newdescript') where id = '$id'");
	header("Location: " . $_SERVER["HTTP_REFERER"]);	

?>

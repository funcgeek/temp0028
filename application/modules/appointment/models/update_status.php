<?php
		 
	$conn = mysqli_connect("localhost", "secureispecs_emr_setup", "RukrIp69FR(0", "secureispecs_emr");
	

		
//echo $_POST['admin_status'];		



	
		
if (isset($_REQUEST['seen'])) {	
echo 'seen';
mysqli_query($conn, "UPDATE appointment SET status = '".$_REQUEST['seen']."' where id = ".$_POST['admin_status']);
}	

if (isset($_REQUEST['not_seen'])) {			
echo 'not seen';
mysqli_query($conn, "UPDATE appointment SET status = '".$_REQUEST['not_seen']."' where id = ".$_POST['admin_status']);

}

if (isset($_REQUEST['vitals_taken'])) {	
echo 'vitals taken';
mysqli_query($conn, "UPDATE appointment SET status = '".$_REQUEST['vitals_taken']."' where id = ".$_POST['admin_status']);

}	

if (isset($_REQUEST['cancel'])) {			
echo 'not cancel';
mysqli_query($conn, "UPDATE appointment SET status = '".$_REQUEST['cancel']."' where id = ".$_POST['admin_status']);

}	



header('Location: /appointment/todays')		
?>
<?php
//this file gets the remote information for doctor notes on the NAS

//begin connecting to the databases
$db_host1 = '192.168.0.157';
$db_host2 = 'localhost';

$db_user1 = 'ispecs';
$db_user2 = 'ispecs_0';

$db_pass1 = 'Loverboy@1';
$db_pass2 = 'Pass@2020';

$db_name = 'ispecs_0';

$dbremote = mysqli_connect($db_host1, $db_user1, $db_pass1, $db_name);
$dblocal = mysqli_connect($db_host2, $db_user2, $db_pass2, $db_name);

//end database connection 

	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM medical_history WHERE id=".$id;
		$stmt = mysqli_query($dbremote, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_row($stmt, MYSQLI_ASSOC);
		//extract($row);
			
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr><th>Date: </th><td><?php echo date('d-m-Y', $date); ?></td></tr>
					<tr><th>Doctor: </th><td><?php echo $doctor_name; ?></td></tr>
					<tr><th>Title: </th><td><?php echo $title; ?></td></tr>
					<tr><th>Description: </th><td><?php echo $description; ?></td></tr>				
	
		</table>
			
		</div>
			
		<?php				
	}

?>
<?php
		 
include('remdb.php');	

	if (isset($_REQUEST['id'])) {
			
		@$id = $_REQUEST['id'];
		@$query = "SELECT * FROM medical_history WHERE id=".$id;
		@$stmt = mysqli_query($dbremote, $query );
		//$stmt->execute(array(':id'=>$id));
		@$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr><th>Date: </th><td><?php echo date('d-m-Y', $date); ?></td></tr>
					<tr><th>Location: </th><td><?php echo $location; ?></td></tr>
					<tr><th>Doctor: </th><td><?php echo $doctor_name; ?></td></tr>
					<tr><th>Title: </th><td><?php echo $title; ?></td></tr>
					<tr><th>Description: </th><td><?php echo $description; ?></td></tr>				
	
		</table>
			
		</div>
			
		<?php				
	}
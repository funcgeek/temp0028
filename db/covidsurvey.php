<?php
 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM covid_survey WHERE id=".$id;
		$stmt = mysqli_query($conn, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
		
	
		<table class="table table-striped table-bordered">
					<tr><th>Location: </th><td><?php echo $location; ?></td></tr>				
					<tr><th>Patient Name: </th><td><?php echo $patient_name; ?></td></tr>
					<tr><th>Date: </th><td><?php echo date('d-m-Y', $date); ?></td></tr>	
					<tr><th>Temperature Reading</th><td><?php echo $temperature; ?></td></tr>					
					<tr><th>Fever: </th><td><?php  echo $fever; ?></td></tr>				
					<tr><th>Coughs: </th><td><?php echo $coughs; ?></td></tr>
					<tr><th>Short Breath: </th><td><?php echo $short_breath; ?></td></tr>
					<tr><th>Travel History: </th><td><?php echo $travel_history; ?></td></tr>
					<tr><th>Contact Local: </th><td><?php echo $contact_local; ?></td></tr>
					<tr><th>Contact Local Specify: </th><td><?php echo $contact_local_specifiy; ?></td></tr>
					<tr><th>Contact Answers: </th><td><?php echo $contact_answer; ?></td></tr>
					<tr><th>Contact Answer Specify: </th><td><?php echo $contact_answer_specifiy; ?></td></tr>
					<tr><th>Nurse Name</th><td><?php echo $nurse_name; ?></td></tr>
		</table>
		
		</div>
			
		<?php				
	}
	?>

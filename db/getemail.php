<?php 
		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query2 = "SELECT * FROM email_inbox WHERE id =".$id;
		$stmt = mysqli_query($conn, $query2 );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
		$newdate = date('d/m/Y', $date);	
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr>
					<td>Date</td>
					<td><?php echo $newdate; ?></td>					
					</tr>					
					<tr>
					<td >Subject</td>
					<td ><?php echo $subject; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Recepient</td>
					<td ><?php echo $reciepient; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Message</td>
					<td ><?php echo $message; ?></td>					
					</tr>
					<tr>

		</table>
			
		</div>
			
		<?php				
	}	
	
	
	if (isset($_REQUEST['sent_id'])) {
			
		$id2 = $_REQUEST['sent_id'];
		$query3 = "SELECT * FROM email WHERE id =".$id2;
		$stmt = mysqli_query($conn, $query3 );
		//$stmt->execute(array(':id'=>$id));
		$row3 = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row3);
		$newdate3 = date('d/m/Y', $date);	
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr>
					<td>Date</td>
					<td><?php echo $newdate3; ?></td>					
					</tr>					
					<tr>
					<td >Subject</td>
					<td ><?php echo $subject; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Recepient</td>
					<td ><?php echo $reciepient; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Message</td>
					<td ><?php echo $message; ?></td>					
					</tr>
					<tr>

		</table>
			
		</div>
			
		<?php				
	}
<?php 
		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM notice WHERE id =".$id;
		$stmt = mysqli_query($conn, $query );
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
					<td >title</td>
					<td ><?php echo $title; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Enclosed to</td>
					<td ><?php echo $type; ?></td>					
					</tr>
					<tr>					
					<tr>
					<td >Description</td>
					<td ><?php echo $description; ?></td>					
					</tr>
					<tr>

		</table>
			
		</div>
			
		<?php				
	}
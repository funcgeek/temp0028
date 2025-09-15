<?php		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {		
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM medical_history WHERE id=".$id;
		$stmt = mysqli_query($conn, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr>
					<th>Date: </th>
					<td><input type="text" value="<?php echo date('d-m-Y', $date); ?>" name="edit_date" readonly /></td>
					</tr>
					
					<tr>
					<th>Doctor: </th>
					<td><input type="text" value="<?php echo $doctor_name; ?>" name="edit_doctor" /> </td>
					</tr>
					
					<tr>
					<th>Caption: </th>
					<td><input type="text" placeholder="update your caption" name="edit_title"  /> </td>
					</tr>
					
					<tr>
					<th>Description: </th>
					<td>
					
					
					<textarea readonly="readonly" cols="60" rows="10"><?php echo $description; ?></textarea><br/>
					<textarea class="var" name="edit_description" rows="20" cols="60" style="text-align:left;"></textarea>
					</td>
					</tr>				
	
		</table>
			
		</div>
			
		<?php				
	}
	?>
<?php 
		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM nurse_notes WHERE id=".$id;
		$stmt = mysqli_query($conn, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
		
		<table class="table table-striped table-bordered">
					<tr><th>Head Circle: </th><td><?php echo $head_circle; ?></td></tr>
					<tr><th>BMI: </th><td><?php echo $bmi; ?></td></tr>
					<tr><th>Length: </th><td><?php echo $length; ?></td></tr>				
					<tr><th>Pulse: </th><td><?php  echo $pulse; ?></td></tr>				
					<tr><th>Blood Pressure: </th><td><?php echo $blood_pressure; ?></td></tr>
					<tr><th>Temperature: </th><td><?php echo $temperature; ?></td></tr>
					<tr><th>Weight: </th><td><?php echo $weight; ?></td></tr>
					<tr><th>Oxygen: </th><td><?php echo $oxygen; ?></td></tr>
					<tr><th>RGB: </th><td><?php echo $rgb; ?></td></tr>
					<tr><th>Height: </th><td><?php echo $height; ?></td></tr>
					<tr><th>Glasses: </th><td><?php echo $glasses; ?></td></tr>
					<hr width="80%" align="center" />
					<tr><td align="center" colspan=2><b><u>URINE TEST</u></b></td></tr>
					<tr><td  colspan=2>&nbsp;</td></tr>
					<tr><th>Non Haem</th><td><?php echo $nonhaem; ?></td></tr>
					<tr><th>BLOOD</th><td><?php echo $blood; ?></td></tr>
					<tr><th>BILLIRUBIN</th><td><?php echo $billirubin; ?></td></tr>
					<tr><th>UROBILINOGEN</th><td><?php echo $urobilinogen; ?></td></tr>
					<tr><th>KETONE</th><td><?php echo $ketone; ?></td></tr>
					<tr><th>PROTEIN</th><td><?php echo $protein; ?></td></tr>
					<tr><th>NITRATE</th><td><?php echo $nitrate; ?></td></tr>
					
					<tr><td colspan=2>&nbsp;</td></tr>
					<tr><th>GLUCOSE</th><td><?php echo $glucose; ?></td></tr>
					
					<tr><th>PH</th><td><?php echo $ph; ?></td></tr>
					<tr><th>Specific Gravity</th><td><?php echo $gravity; ?></td></tr>					
					<tr><th>Leucocytes</th><td><?php echo $leucocytes; ?></td></tr>
					<tr><td colspan="8">&nbsp;</td></tr>
					<tr><th>Additional Notes:</th>
					<td colspan="7"><textarea rows="10" readonly cols="50" name="description">
					<?php echo $description; ?>
					</textarea>
					</td></tr>
		</table>
			
		</div>
			
		<?php				
	}
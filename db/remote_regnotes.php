<?php
//this file gets the remote information for doctor notes on the NAS
include('remdb.php');
//end database connection 
			
		@$id = $appointment->patient;
		@$queryw = "SELECT * FROM appointment WHERE patient=".$id;
		@$resultr = $dbremote->query($queryw);

if (@$resultr->num_rows > 0) {
  // output data of each row
  while(@$rowr = $resultr->fetch_assoc()) {   ?>
  <tr>
	<td><?php echo date('d-m-Y', $rowr['date']); ?></td>
    <td><?php echo $rowr['location']; ?></td>
    <td><?php echo $rowr['time_slot']; ?></td>
	<td>
		<?php
			@$querydc = "SELECT * FROM doctor WHERE id=".$rowr['doctor']; 
			@$querydoc = $dbremote->query($querydc);
			@$rowdoc = $querydoc->fetch_assoc();
					echo $rowdoc['name'];
		?>
	</td>
    <td><?php echo $rowr['status']; ?></td>	
    <td><?php echo $rowr['remarks']; ?></td>	
	</tr>										
 <?php }
} else {
  echo "0 results";
}

	


?>
<?php
//this file gets the remote information for doctor notes on the NAS
include('remdb.php');
//end database connection 
			
		@$id = $medical_history->patient_id;
		@$queryw = "SELECT * FROM medical_history WHERE patient_id=".$id;
		@$resultr = $dbremote->query($queryw);

if (@$resultr->num_rows > 0) {
  // output data of each row
  while(@$rowr = $resultr->fetch_assoc()) {   ?>
  <tr>
	<td><?php echo date('d-m-Y', $rowr['date']); ?></td>
    <td><?php echo $rowr['location']; ?></td>
    <td><?php echo $rowr['doctor_name']; ?></td>
    <td><?php echo $rowr['title']; ?></td>
    <td><?php echo $rowr['description']; ?></td>
	<td class="no-print">
		<a id="getDoctorNotesRem" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor_rem" data-id="<?php echo $rowr['id']; ?>">
		<i class="fa fa-plus-circle"> </i> View </a>
	</td>	
	</tr>										
 <?php }
} else {
  echo "0 results";
}

	


?>
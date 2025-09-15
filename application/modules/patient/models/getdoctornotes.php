<?php
		 
	$conn = mysqli_connect("localhost", "ispecs_0", "Pass@2020", "ispecs_0");
	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM medical_history WHERE id=".$id;
		$stmt = mysqli_query($conn, $query );
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

<tr class="">
        <td><?php echo date('d-m-Y', $medical_history->date); ?></td>
        <td><?php echo $medical_history->doctor_name; ?></td>
        <td><?php echo $medical_history->title; ?></td>
        <td><?php echo $medical_history->description; ?></td>
  <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
        <td class="no-print">
	<a id="getDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor2" data-id="<?php echo $medical_history->id; ?>">
		<i class="fa fa-plus-circle"> </i> View </a>
			<?php 
				if ($this->ion_auth->in_group(array('admin'))) { ?>	
                    <a id="editDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor_edit" data-id="<?php echo $medical_history->id; ?>">
					<i class="fa fa-plus-circle"> </i> Edit </a>
					<a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="patient/deleteCaseHistory?id=<?php echo $medical_history->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
			<?php }?>
        </td>
                <?php } ?>
</tr>	
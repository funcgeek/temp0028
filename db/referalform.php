

<?php
include('db.php');	
	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM patient_sickleave WHERE id=".$id;
		$stmt = mysqli_query($conn, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		$doc_info = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
		
		?>
		
		<div class="table-responsive noprint">	
		<table class="table table-striped table-bordered">
		<tr>
		<th>ID </th>
		<td><?php echo $patient_id; ?> </td>
		</tr>
		<tr>
		<th>Name</th>
		<td><?php echo $patient_first_name.' '.$patient_middle_name.' '.$patient_last_name; ?>  </td>
		</tr>		
		<tr>
		<th>Sick Days</th>
		<td><?php echo $days; ?>  </td>
		</tr>		
		<tr>
		<th>Date Started</th>
		<td><?php echo $start_date; ?>  </td>
		</tr>
		<tr>
		<th>Doctor</th>
		<td><?php echo $doctor_name	; ?>  </td>
		</tr>	
		<tr>		
		<th>Description</th>
		<td><?php echo $description	; ?>  </td>
		</tr>	
		<tr>
		<td colspan='2'><hr width="90%" />	</td>
		</tr>		
		<tr>		
		<th>Signed?</th>
		<td><?php echo $d_sign	; ?>  </td>
		</tr>	
		<?php if ($d_sign = 'Yes'){ ?>
		<tr>		
		<th>Signature</th>
		<td><img src="<?php echo $doctor_sign	; ?>" style="width:300px;height:auto;" />  </td>
		</tr>
		<?php } else {?>
		<tr>		
		<th>Signature</th>
		<td>no Signature was done </td>
		</tr>
		<?php } ?>



		</table>	
		</div>

		


<?php
$company = "SELECT * FROM settings";
$addcompany = mysqli_query($conn, $company);

?>

<div id="printableArea" style="display:none;">
				
					<table width="80%" cellspacing="5" cellpadding="5" align="center" >
					
<?php
  // output data of each row
while($row = mysqli_fetch_array($addcompany)) {  
?>						
					<tr><th><center><h3><?php echo $row['title'];?></h3></center></th></tr>
					<tr><th><center><h4><?php echo $row['address'];?><br><?php echo $row['phone'];?></h4></center></th></tr>
<?php } ?>

					<tr><td>&nbsp;</td></tr>		
					
					<tr><td><center><b>
					
					<h4><?php echo $doctor_name	; ?> - <?php echo $postnomials;?><br>
					<?php echo $profile; ?><br>
					Reg.#<?php echo $lic_number;?></h4>
					
					</b></center></td></tr>
									
					</table>
					
					<table width="80%" cellspacing="5" cellpadding="5" align="center" >
					<tr>
					<th colspan="2"><center><h4> <u>MEDICAL CERTIFICATE</u> </h4></center></th>					
					</tr>
					
					<tr>
					<td colspan="2">
					This is to certify that <u> <?php echo $patient_first_name." ".$patient_middle_name." ".$patient_last_name;?> </u> is a patient of mine at I SPECS APPEAL JAMAICA LTD. He/She is unable to carry out his/her duties for <u><?php echo  $days;?>  </u> days beginning on <?php echo $start_date; ?>.
					
					</td>
					</tr>
					<tr><td rowspan="3">&nbsp;</td></tr>
					<tr><td rowspan="3">&nbsp;</td></tr>
					<tr><td rowspan="3">&nbsp;</td></tr>
					<tr>
					<td colspan="2" align="right">
					<p>
					<i>YOURS RESPECTFULLY</I><P><p>
					
					_________________________________
					<br><?php echo $doctor_name	; ?> - <?php echo $postnomials;?>
					
					
					
					</td>
					</tr>
					

</div>


		<?php			
	}
	?>


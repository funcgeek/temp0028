<?php		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

		
?>		
	<script type="text/javascript">
	App_Transfers = JSON.parse(sessionStorage.getItem("AppTransfers"));
	<?php 

	$app_transfer = "<script>document.write(App_Transfers)</script>";
	?>
	
	//alert(App_Transfers);
	</script>
<?php	
	//var myarr = App_Transfers.split("");
	$app_transfer1 = array();
	$app_transfer1 = explode(" ",$app_transfer);

$result = str_replace(',', ' ', $app_transfer);
	echo $app_transfer;	
	//	$app_trans_date = $_REQUEST['app_trans_date'];
/*	
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
			-->
		</div>
			
		<?php				
	}
	*/
	?>
	<script type="text/javascript">
	
$('#app_trans2').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 
  
  var app_transfer = [];
  
  $.each($("input[name='app_tran']:checked"), function(){            
    app_transfer.push($(this).val());
  });
  
  var app_transfers = $.map(app_transfer, function(value){
    return (value);
  });
  
  var modal = $(this)
  modal.find('.modal-body').text('My favourite sports are: ' + app_transfers);
  <?php
  $app_transfer9 = array();
  $app_transfer9 = "<script>document.write(app_transfers)</script>";
  ?>
  modal.find('.modal-body').text('this is: ' + <?php echo app_transfer9;?>);
  localStorage.setItem("AppTransfers", JSON.stringify(app_transfers));
  
  
});	


    </script>		

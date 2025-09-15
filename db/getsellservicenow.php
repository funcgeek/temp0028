<script type="text/javascript" charset="utf-8">
function getFrameItems() {
  var x = document.getElementById("frame_lens").value;
  
  		$.ajax({          
        	type: "GET",
        	url: "./db/getframeitems.php",
        	data:'id=' + x,
        	success: function(data){
        		$("#frame_items").html(data);
				//alert(x.value);
        	}
	});
}
</script>

<?php 
		 
//		$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];
		$user = $_REQUEST['user'];
		//$id = '4534';
		$query = "SELECT * FROM medicine WHERE id=".$id;
		$query_lens = "SELECT * FROM frame_type";
		$query_frames = "SELECT * FROM frame_items where frame_type_id='6'";
		$users = "SELECT * FROM users where id = ".$user;
		//$email = "SELECT email FROM users where id = ".$user;
		$lens_result = mysqli_query($conn, $query_lens);
		$emails = mysqli_query($conn, $users);
		$email = mysqli_fetch_array($emails, MYSQLI_ASSOC);
		$frames_result = mysqli_query($conn, $query_frames);
		$stmt = mysqli_query($conn, $query );
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
		extract($row);
			
		?>
			
		<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered" id="sellnow">
						
						<tr>
						<td colspan="6"><font color="red"><b>Please Select Your Store Location</b></font>
						<select name="plocation" id="location" required>
						<?php 
						
						//$ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->location;
						?>
						<option value="<?php echo $email['location']; ?>"><?php echo $email['location']; ?></option>
						<option value="Montego Bay">Montego Bay</option>
						<option value="Falmouth">Falmouth</option>
					
							</select>	
								
						
						</td>
						</tr>
						<tr> 
                                <th> Qty.</th>  
								<th> Service Name</th>
								<th> Price</th>
                        </tr>
						<tr>
						<td> <input type="text" name="pqty" class="minput2" value="1" readonly> </input> </td>
						<td><input type="text" name="pname" class="minput" value="<?= $service_name ?>" readonly> <input type="hidden" name="pid" class="minput" value="<?= $id ?>" ></td>
						<td><input type="text" name="pprice" class="minput" value="<?= $service_price ?>" readonly>
						 <input type="hidden" name="pid" class="minput" value="<?= $id ?>" >
						 <input type="hidden" name="ftype" class="minput" value="<?= $f_type ?>" ></td>
							</td>
						</tr>

					
						</table>
	
		</div>
			
		<?php				
	}

?>


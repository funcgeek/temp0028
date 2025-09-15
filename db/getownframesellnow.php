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
		

		//	$location = $this->db->get_where('users', array('email' => $email))->row()->location;		
		?>
			
		<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered" id="sellnow">
						
						<tr>
						<td colspan="6"><font color="red"><b>Please Select Your Store Location</b></font>
						<select name="plocation" id="location" required>
						<option value="">select location</option>
						<option value="Montego Bay">Montego Bay</option>
						<option value="Falmouth">Falmouth</option>					
						</select>
								
						
						</td>
						</tr>

						<tr> 
                                <th> Qty.</th>  
								<th> Model|Name</th>
								<th> Brand</th>
                                <th> Color</th>
                                <th> Size</th>
								<th> Price</th>
                        </tr>
						<tr>
						<td> <input type="text" name="pqty" class="minput2" value="1" > </input> </td>
						<td>
						<input type="text" name="pname" id="pname" class="minput" value="<?= $name ?>" >
                     		<input type="hidden" name="pid" class="minput" value="<?= $id ?>" >
							<input type="hidden" name="ftype" class="minput" value="<?= $f_type ?>" ></td>
                     		<td><input type="text" name="pcat" class="minput" value="<?= $category ?>" ></td>
                     		<td><input type="text" name="pcolor" id="pcolor" class="minput" value="<?= $effects ?>" ></td>
                     		<td> <input type="text" name="psize" id="psize" class="minput" value="<?= $box ?>" ></td>
                       		<td> 
							<input type="text" name="pprice" class="minput" value="<?= $s_price ?>" >
							</td>
						</tr>
						  <tr>
												   
												   
												   <td colspan='2' >                
												   <select onchange="getFrameItems()" name="framelens" id="frame_lens" >
														<option value="">Choose Lens Type</option>
													<?php  while($frame = mysqli_fetch_array($lens_result)){?>
														<option value="<?php echo $frame['id']; ?>"><?php echo $frame['name']; ?></option>
						
													<?php } ?>
													</select>	
													</td>
												   
												   <td colspan="2">
												   <select name="frameitems" style="width:250px" id="frame_items"  >
												   <option value="">Choose Lens Option</option> 
												   </select>
												   
												   <div name="frameitemsprice"></div>
												   </td>
												   <td>
												   	 <select name="frame_misc" id="frame_misc">
														<option value="">Choose Miscellaneous</option>
													<?php  while($misc = mysqli_fetch_array($frames_result)){?>
														<option value="<?php echo $misc['name']; ?>"><?php echo $misc["name"].'  -  - <font color="red"><b>'.$misc["price"].'</b></font>'; ?></option>
						
													<?php } ?>
													</select>	
												   </td>
												   </tr> 

					
						</table>
	
		</div>
			
		<?php				
	}

?>


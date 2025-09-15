<?php
include('db.php');	
if(isset($_GET['id'])) {
        $frameitems_id = $_GET["id"];           
		$query ="SELECT * FROM frame_items WHERE frame_type_id = ".$frameitems_id;
		//$stmt = mysqli_query($conn, $query );
		$result = mysqli_query($conn,$query);
		//$row = mysqli_fetch_ASSOC($result, MYSQLI_ASSOC);	
?>
<option value="">Select Lens Option</option>
<?php
	while($row = mysqli_fetch_array($result)) {
?>
	<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"].'  -  - <font color="red"><b>'.$row["price"].'</b></font>'; ?></option>
<?php
	}


}
?>
<?php
include('db.php');	

if(isset($_REQUEST['frameprice_id'])) {
        $frameprice_id = $_REQUEST["frameprice_id"];           
		$query ="SELECT * FROM frame_items WHERE id = ".$frameprice_id;
		//$stmt = mysqli_query($conn, $query );
		$result = mysqli_query($conn,$query);
		//$row = mysqli_fetch_ASSOC($result, MYSQLI_ASSOC);	
		//$stmt->execute(array(':id'=>$id));
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		extract($row);	
		
		
		?><input type="text" name="frameitemsprice3" style="border: none;" readonly size="10" value="<?php echo $price;?>" />
<?php		
}
?>

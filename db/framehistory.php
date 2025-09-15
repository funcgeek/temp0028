<?php 
 
//$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];

$query = "SELECT * FROM medicine_history WHERE frame_id = ".$id;
$addhistory = mysqli_query($conn, $query);

?>
<table class="table table-striped table-hover table-bordered" id="editable-sample2">
<tr>
<th>ID# </th>
<th>Model# </th>
<th>Main Location </th>
<th>M.L. Old Qty. </th>
<th>Trans. Location</th>
<th>T.L Old Qty. </th>
<th>Trans. Amt. </th>
<th>M.L New Qty. </th>
<th>T.L New Qty. </th>
<th>Trans. Time </th>
<th>Trans. Day </th>
<th>Trans. Date </th>
<th>Trans. By </th>
</tr>
<?php

if (mysqli_num_rows($addhistory) > 0) {
  // output data of each row
while($row = mysqli_fetch_array($addhistory)) {
echo "<tr>";
echo "<td>". $row['frame_id'] ."</td>";
echo "<td>". $row['model'] ."</td>";
echo "<td>". $row['location1'] ."</td>";
echo "<td>". $row['old_quantity1'] ."</td>";
echo "<td>". $row['location2'] ."</td>";
echo "<td>". $row['old_quantity2'] ."</td>";
echo "<td>". $row['amount'] ."</td>";
echo "<td>". $row['new_quantity1'] ."</td>";
echo "<td>". $row['new_quantity2'] ."</td>";
echo "<td>". $row['time'] ."</td>";
echo "<td>". $row['update_day'] ."</td>";
echo "<td>". $row['transfer_date'] ."</td>";
echo "<td>". $row['user'] ."</td>";
echo "</tr>"; 
	}	

	}else {
echo "<tr>";	
echo "<td colspan='12'>";
echo "0 results";
echo "</td>";
echo "</tr>";
} 
}
	
?>
</table>
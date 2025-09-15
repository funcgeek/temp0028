<?php
 
include('db.php');	

	if (isset($_REQUEST['id'])) {
			
		@$id = $_REQUEST['id'];

$query = "SELECT * FROM medicine_loadhistory WHERE frame_id = ".$id;
$addhistory = mysqli_query($conn, $query);

?>
<table class="table table-striped table-hover table-bordered" id="editable-sample2">
<tr>
<th>ID# </th>
<th>Frame ID </th>
<th>Model# </th>
<th><font color='red'>Mobay Old Qty. </font></th>
<th><font color='green'>Falmouth Old Qty. </font></th>
<th><font color='red'>Mobay Load Amt</font></th>
<th><font color='green'>Falmouth Load Amt</font></th>
<th><font color='red'>Mobay New Qty. </font></th>
<th><font color='green'>Falmouth New Qty. </font></th>
<th>Loaded By </th>
<th>Date Loaded </th>
</tr>
<?php

if (mysqli_num_rows($addhistory) > 0) {
  // output data of each row
while($row = mysqli_fetch_array($addhistory)) {
echo "<tr>";
echo "<td>". $row['id'] ."</td>";
echo "<td>". $row['frame_id'] ."</td>";
echo "<td>". $row['model'] ."</td>";
echo "<td><font color='red'>". $row['mobay_old'] ."</font></td>";
echo "<td><font color='green'>". $row['falmouth_old'] ."</font></td>";
echo "<td><font color='red'>". $row['update_mobay'] ."</font></td>";
echo "<td><font color='green'>". $row['update_falmouth'] ."</font></td>";
echo "<td><font color='red'>". $row['mobay_new'] ."</font></td>";
echo "<td><font color='green'>". $row['falmouth_new'] ."</font></td>";
echo "<td>". $row['loaded_by'] ."</td>";
echo "<td>". $row['date'] ."</td>";
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
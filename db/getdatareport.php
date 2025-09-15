<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 150px;
  height: 280px;
}

div.gallery:hover {
  border: 1px solid #777;
}
 
div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 5px;
  text-align: center;
}

        .first-txt { 

            position: absolute; 

            top: 17px; 

            left: 50px; 

        } 

  

        .second-txt {  

            position: absolute; 

            bottom: 20px; 

            left: 10px; 

        } 

</style>

<?php


//$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	

	
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];

$query = "SELECT * FROM patient_material as pm, patient_material_images as pmi WHERE pm.patient = pmi.patient_id 
AND pmi.image_id =".$id;
$addimg = mysqli_query($conn, $query);
?>
<table width="100%" cellpadding=10 cellspacing=10 border=1>
<thead>
<tr>
<th>ID </th>
<th>DATE </th>
<th>LOCATION </th>
<th>TITLE </th>
<th>PATIENT NAME </th>
<th>IMAGE NAME </th>
<th>UPLOADED BY </th>
</tr>
</thead>
<tbody>
<?php
if (mysqli_num_rows($addimg) > 0) {
  // output data of each row
while($row = mysqli_fetch_array($addimg)) {  
echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['date_string']." </td>";
echo "<td>".$row['location']." </td>";
echo "<td>".$row['title']." </td>";
echo "<td>".$row['patient_name']."</td>";
echo "<td>".$row['image_name']." </td>";
echo "<td>".$row['user']." </td>";
																	
echo "</tr>";
	}	
	} ?>
</tbody>	
</table>	
<?php	
}

		

?>
	
<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
var info2 = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "./db/deletedatareport.php",
   data: info,
   success: function(){
 }
});
  $(this).parents(".show").animate({ backgroundColor: "blue" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>
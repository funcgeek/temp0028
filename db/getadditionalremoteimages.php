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
</style>

<?php


//this file gets the remote information for doctor notes on the NAS
include('remdb.php');
//end database connection 
			
	//	$id = $patient_material->patient;

		
	
	if (isset($_REQUEST['id'])) {	
		@$id = $_REQUEST['id'];

		@$querys = "SELECT * FROM patient_material as pm, patient_material_images as pmi WHERE pm.patient = pmi.patient_id AND pmi.image_id =".$id;
		@$addimgs = $dbremote->query($querys);


if (@$addimgs->num_rows > 0) {
  // output data of each row
while(@$row = $addimgs->fetch_assoc()) {  

if($row['multi_image'] ==='yes'){
		$locate2 = "http://192.168.0.157/uploads/patient/documents/".$row['patient_id']."/";
		
		$path_parts1 = 'http://192.168.0.157/'.$row['image_url'];
		$thumb_nail1 = pathinfo(parse_url($path_parts1, PHP_URL_PATH), PATHINFO_EXTENSION);	

												
		
?>	  
 
<div class="gallery">
  <a target="_blank" href="<?php echo $path_parts1; ?>">
 <?php if($thumb_nail1 == "pdf"){ ?>
			<embed src="<?php echo $path_parts1; ?>" width="150" height="180" />
	<?php	} elseif(!empty($thumb_nail1) && $thumb_nail1 <> 'pdf'){ ?>

    <img src="<?php echo $path_parts1; ?>" alt="<?php echo $row['image_name']; ?>" width="180" height="200" /> 
	<?php } ?>
	<center><button>View Larger</button></center>
  </a>
  <div class="desc"><font size="1"><?php echo basename($path_parts1); ?><br>(<b><?php echo $row['title']; ?></b>)</font></div>
	<a class="btn btn-primary" href="<?php echo $locate2.'/'.$row['image_name']; ?>" download> Download</a>
&nbsp;&nbsp;&nbsp;  

</div>
	
<?php		
	}	

	}
}

	}	
	
	if (isset($_REQUEST['vmid'])) {
			
		@$id = $_REQUEST['vmid'];

	//	$id = $patient_material->patient;
		@$querym = "SELECT * FROM patient_material as pm, patient_material_images as pmi WHERE pm.patient = pmi.patient_id AND pmi.image_id =".$id;
		@$addimgm = $dbremote->query($querym);

if (@$addimgm->num_rows > 0) {
  // output data of each row
while(@$row = $addimgm->fetch_assoc()) {  

if($row['multi_image'] ==='yes'){
		$locate2 = "http://192.168.0.157/uploads/patient/documents/".$row['patient_id']."/";
		$path_parts2 = $locate2.'/'.$row['image_url'];
		$thumb_nail2 = pathinfo(parse_url($path_parts2, PHP_URL_PATH), PATHINFO_EXTENSION);	
?>	  
 
<div class="gallery">
  <a target="_blank" href="<?php echo $locate2.'/'.$row['image_name']; ?>">
   <?php if($thumb_nail2 == "pdf"){ ?>
			<embed src="<?php echo $locate2.'/'.$row['image_name']; ?>" width="150" height="200" />
	<?php	} elseif(!empty($thumb_nail2) && $thumb_nail2 <> 'pdf'){ ?>
    <img src="<?php echo $locate2.'/'.$row['image_name']; ?>" alt="<?php echo $row['image_name']; ?>" width="150" height="200" /> 
	<?php } ?>
	<center>View Larger</center>
  </a>
  <div class="desc"><font size="1"><?php echo basename($path_parts2); ?><br>(<b><?php echo $row['title']; ?></b>)</font></div>
	<a class="btn btn-primary" href="<?php echo $locate2.'/'.$row['image_name']; ?>" download> Download</a>
&nbsp;&nbsp;&nbsp;

</div>

	
<?php		
	}	

	}
}

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
   url: "./db/deleteimages.php",
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
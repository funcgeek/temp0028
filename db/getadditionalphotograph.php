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

$query = "SELECT * FROM patient_photograph as pm, patient_photograph_images as pmi WHERE pm.patient = pmi.patient_id 
AND pmi.image_id =".$id;
$addimg = mysqli_query($conn, $query);



if (mysqli_num_rows($addimg) > 0) {
  // output data of each row
while($row = mysqli_fetch_array($addimg)) {

if($row['multi_image'] ==='yes'){
		$locate2 = "./uploads/patient/photograph/".$row['patient_id']."/";
		
		$path_parts1 = $row['image_url'];
		$thumb_nail1 = pathinfo(parse_url($path_parts1, PHP_URL_PATH), PATHINFO_EXTENSION);	

												
		
?>	  
 
<div class="gallery">
  <a target="_blank" href="<?php echo $row['image_url']; ?>">
 <?php if($thumb_nail1 == "pdf"){ ?>
			<embed src="<?php echo $row['image_url']; ?>" width="150" height="180" />		
	<?php	} elseif(!empty($thumb_nail1) && $thumb_nail1 <> 'pdf'){ ?>

    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['image_name']; ?>" width="180" height="200" /> 
	<?php } ?>
	<center><button>View Larger</button></center>
  </a>
  <div class="desc">
	<font size="1">
		<?php echo basename($row['image_url']); ?>
		<br>(<b><?php echo $row['title']; ?></b>)
		<br>(<b><?php echo 'uploaded on: ' . date('d-m-Y', $row['date']); ?></b>)
	</font>
</div>
	<a class="btn btn-primary" href="<?php echo $locate2.'/'.$row['image_name']; ?>" download> Download</a>
&nbsp;&nbsp;&nbsp;
   <span class="action"><a href="./db/deletephotograph.php?id2=<?php echo $row['id'];?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i> </a></span>   

</div>
	
<?php		
	}	

	}
}

	}	
	
	if (isset($_REQUEST['vmid'])) {
			
		$id = $_REQUEST['vmid'];

$query = "SELECT * FROM patient_photograph as pm, patient_photograph_images as pmi WHERE pm.patient = pmi.patient_id 
AND pmi.image_id =".$id;
$addimg = mysqli_query($conn, $query);



if (mysqli_num_rows($addimg) > 0) {
  // output data of each row
while($row = mysqli_fetch_array($addimg)) {

if($row['multi_image'] ==='yes'){
	$locate2 = "./uploads/patient/photograph/".$row['patient_id']."/";
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
  <div class="desc"><font size="1"><?php echo basename($row['image_url']); ?><br>(<b><?php echo $row['title']; ?></b>)</font></div>
	<a class="btn btn-primary" href="<?php echo $locate2.'/'.$row['image_name']; ?>" download> Download</a>
&nbsp;&nbsp;&nbsp;
   <span class="action"><a href="./db/deletephotograph.php?id2=<?php echo $row['id'];?>" class="btn btn-danger btn-sm" title="Delete">Delete </a></span>   

</div>

	
<?php		
	}	

	}
}

	}
	// $_SERVER['DOCUMENT_ROOT'].
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
   url: "./db/deleteoct.php",
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
<?php

//$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include('db.php');	


$id2=$_REQUEST['id2'];


$remove = "select image_url,patient_id FROM patient_result_images WHERE id='$id2'";
$delimg = mysqli_query($conn, $remove);
$row = mysqli_fetch_array($delimg);

$file_to_remove = basename($row['image_url']);
$fileDeleted = $_SERVER['DOCUMENT_ROOT'].'/uploads/patient/results/'.$row['patient_id'].'/'.$file_to_remove;
unlink($fileDeleted);


$delete = "DELETE FROM patient_result_images WHERE id='$id2'";
$del = mysqli_query($conn, $delete);
if($del){
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
}
?>
<?php 
$folderPath = "upload/"; 
$image_parts = explode(";base64,", $_POST['signed']); 
$image_type_aux = explode("image/", $image_parts[0]); 
$image_type = $image_type_aux[1]; 
$image_base64 = base64_decode($image_parts[1]); 
$file = $folderPath . uniqid() . '.'.$image_type; 
file_put_contents($file, $image_base64); echo "Signature Uploaded Successfully.";
$sign=$_POST['signed'];
echo "<br><img src='".$file."'><br>";
echo "<br>test<img src='".$sign."'><br>";
echo "<br>".$sign."><br>";
echo "<br>".$_POST['signed']."><br>";
echo "<br>".$image_type_aux."><br>";
echo "<br>".$image_type."><br>";
echo "<br><img src='".$image_base64."'><br>";
?>
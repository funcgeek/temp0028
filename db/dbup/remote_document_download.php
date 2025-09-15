<?php
//this file upload the documents information for on the NAS

include('updb.php');

//if (isset($_REQUEST['id'])) {

/*/		$id = $_REQUEST['id'];

*/
//		$oldtime = date('d-m-Y');

		$queryloc1 = "SELECT * FROM patient_material_images";// WHERE date >=".strtotime("-1 day");
		$resultr1 = $dblocal->query($queryloc1);		
		
		$queryrem1 = "SELECT * FROM patient_material_images";
		$resultrem1 = $dbremote->query($queryrem1);
		

//dataebase  information

if ($resultrem1->num_rows > 0) {
  // output data of each row
  while($rowr = $resultrem1->fetch_assoc()) {  
//print_r ($rowr);
$rowrem = $resultr1->fetch_assoc();

$patid = $rowr['id'];
$patient_id = $rowr['patient_id'];
$location = $rowr['location'];
$image_id	 = $rowr['image_id'];
$date = $rowr['date'];
$title = $rowr['title'];
$image_name = $rowr['image_name'];
$image_url = $rowr['image_url'];
$date_string = $rowr['date_string'];

if($rowrem['id'] == $patid && $rowrem['patient_id'] == $patient_id && $rowrem['date'] == $date && $rowrem['location'] == $location && $rowrem['image_id'] == $image_id ){
	echo "user already exist<br>";
}else{
	$queryins = "INSERT INTO `patient_material_images` (`id`, `date`, `location`, `title`, `patient_id`, `image_id`, `image_name`, `image_url`, `date_string`) VALUES
('$patid', '$date', '$location', '$title', '$patient_id', '$image_id', '$image_name', '$image_url', '$image_url')";//.$id;

//$stmt = $dbremote->query($queryins);	

if ($dbremote->query($queryins) === TRUE) {
  echo "New record created successfully<br>";
    echo $patid." ".$patient_id." ".$image_name." ".$image_url." ".$date_string."<br>";
 } else {
  echo "Error: " . $queryins . "<br>" . $dbremote->error;
  
}
	
}	


 
			
/**
 * Transfer (Import) Files Server to Server using PHP FTP
 * @link https://shellcreeper.com/?p=1249
 */
 
/* Source File Name and Path */
$url = 'http://localhost/uploads/patient/documents/'.$patient_id.'/'.$image_name;
 

 
 
/* New file name and path for this file */
$img = 'http://192.168.0.157/uploads/patient/documents/'.$patient_id.'/'.$image_name;
 


// Save image
$ch = curl_init($url);
$fp = fopen($img, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
 
 
}

}

?>
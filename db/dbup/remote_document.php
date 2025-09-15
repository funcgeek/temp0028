<?php
//this file gets the remote information for doctor notes on the NAS

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

if ($resultr1->num_rows > 0) {
  // output data of each row
  while($rowr = $resultr1->fetch_assoc()) {  
//print_r ($rowr);
$rowrem = $resultrem1->fetch_assoc();

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
(1, '1616159811', 'test', '441', '6172485351562538', 'ClaimConcentForm26.04.14.pdf', './uploads/patient/documents/441/ClaimConcentForm26.04.14.pdf', '19-03-21')";//.$id;

//$stmt = $dbremote->query($queryins);	

if ($dbremote->query($queryins) === TRUE) {
  echo "New record created successfully<br>";
} else {
  echo "Error: " . $queryins . "<br>" . $dbremote->error;
  
}
	
}	


 
			
/**
 * Transfer (Import) Files Server to Server using PHP FTP
 * @link https://shellcreeper.com/?p=1249
 */
 
/* Source File Name and Path */
$remote_file = 'http://localhost/uploads/patient/documents/'.$patient_id.'/'.$image_name;
 

 
 
/* New file name and path for this file */
$local_file = 'http://192.168.0.157/uploads/patient/documents/'.$patient_id.'/'.$image_name;
 
/* Connect using basic FTP */
$connect_it = ftp_connect( $ftp_host );
 
/* Login to FTP */
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );
 
/* Download $remote_file and save to $local_file */
if ( ftp_get( $connect_it, $local_file, $remote_file, FTP_BINARY ) ) {
    echo "WOOT! Successfully written to $local_file\n";
}
else {
    echo "Doh! There was a problem\n";
}
 
}

}


?>
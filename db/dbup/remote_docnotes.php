<?php
//this file gets the remote information for doctor notes on the NAS
include('updb.php');

//if (isset($_REQUEST['id'])) {

/*/		$id = $_REQUEST['id'];

*/
//		$oldtime = date('d-m-Y');

		$queryloc1 = "SELECT * FROM medical_history";// WHERE date >=".strtotime("-1 day");
		$resultr1 = $dblocal->query($queryloc1);		
		
		$queryrem1 = "SELECT * FROM medical_history";
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
//$patient = $rowr['patient'];
$doctor	 = $rowr['doctor_name'];
$date = $rowr['date'];
$title = $rowr['title'];
$description = $rowr['description'];
$patient_name = $rowr['patient_name'];
$patient_first_name = $rowr['patient_first_name'];
$patient_last_name = $rowr['patient_last_name'];
$patient_address = $rowr['patient_address'];
$patient_phone = $rowr['patient_phone'];
$img_url = $rowr['img_url'];
$registration_time = $rowr['registration_time'];
//$request = $rowr['request'];
//$patientname = $rowr['patientname'];
//$doctorname = $rowr['doctorname'];

if($rowrem['id'] == $patid && $rowrem['patient_id'] == $patient_id && $rowrem['date'] == $date ){
	echo "user already exist<br>";
}else{
	$queryins = "INSERT INTO `medical_history` (`id`, `patient_id`, `doctor_name`, `location`, `title`, `description`, `patient_name`, `patient_first_name`, `patient_last_name`, `patient_address`, `patient_phone`, `img_url`, `date`, `registration_time`) VALUES
('$patid', '$patient_id', '$doctor', '$location', '$title', '$description', '$patient_name', '$patient_first_name', '$patient_last_name', '$patient_address', '$patient_phone', '$img_url', '$date', '$registration_time')";//.$id;

//$stmt = $dbremote->query($queryins);	

if ($dbremote->query($queryins) === TRUE) {
  echo "New record created successfully<br>";
} else {
  echo "Error: " . $queryins . "<br>" . $dbremote->error;
}
	
}	
}
}


?>
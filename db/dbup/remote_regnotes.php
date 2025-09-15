<?php
//this file gets the remote information for doctor notes on the NAS
include('updb.php');

//if (isset($_REQUEST['id'])) {

/*/		$id = $_REQUEST['id'];

*/
//		$oldtime = date('d-m-Y');

		$queryloc = "SELECT * FROM appointment";// WHERE date >=".strtotime("-1 day");
		$resultr = $dblocal->query($queryloc);		
		
		$queryrem = "SELECT * FROM appointment";
		$resultrem = $dbremote->query($queryrem);
		

//dataebase  information

if ($resultr->num_rows > 0) {
  // output data of each row
  while($rowr = $resultr->fetch_assoc()) {  
//print_r ($rowr);
$rowrem = $resultrem->fetch_assoc();

$patid = $rowr['id'];
$location = $rowr['location'];
$patient = $rowr['patient'];
$doctor = $rowr['doctor'];
$date = $rowr['date'];
$timeslot = $rowr['time_slot'];
$s_time = $rowr['s_time'];
$e_time = $rowr['e_time'];
$remarks = $rowr['remarks'];
$add_date = $rowr['add_date'];
$registration_time = $rowr['registration_time'];
$s_time_key = $rowr['s_time_key'];
$status = $rowr['status'];
$user = $rowr['user'];
$request = $rowr['request'];
$patientname = $rowr['patientname'];
$doctorname = $rowr['doctorname'];

if($rowrem['id'] == $patid && $rowrem['location'] == $location && $rowrem['patient'] == $patient && $rowrem['date'] == $date ){
	echo "user already exist<br>";
}else{
	$queryins = "INSERT INTO `appointment` (`id`, `location`, `patient`, `doctor`, `date`, `time_slot`, `s_time`, `e_time`, `remarks`, `add_date`, `registration_time`, `s_time_key`, `status`, `user`, `request`, `patientname`, `doctorname`) VALUES
('$patid', '$location', '$patient', '$doctor', '$date', '$timeslot', '$s_time', '$e_time', '$remarks', '$add_date', '$registration_time', '$s_time_key', '$status', '$user', '$request', '$patientname', '$doctorname')";//.$id;

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
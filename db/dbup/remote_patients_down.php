<font size="+1" color="red"><center>NOW SENDING PATIENT <br>INFORMATION TO <br>THE ONLINE SERVER</center></font>
<hr width="100%" />
<?php
//this file gets the remote information for doctor notes on the NAS
include('updb.php');

//if (isset($_REQUEST['id'])) {

/*/		$id = $_REQUEST['id'];

*/
//		$oldtime = date('d-m-Y');

		$querylocpat = "SELECT * FROM patient";// WHERE date >=".strtotime("-1 day");
		$resultrpat = $dblocal->query($querylocpat);		
		
		$queryrempat = "SELECT * FROM patient";
		$resultrempat = $dbremote->query($queryrempat);
		

//dataebase  information

if ($resultrempat->num_rows > 0) {
  // output data of each row
  while($rowr = $resultrempat->fetch_assoc()) {  

$rowrem = $resultrpat->fetch_assoc();
//print_r ($rowrem);

$patid 		= $rowr['id'];
$location 	= $rowr['location'];
$img_url 	= $rowr['img_url'];
$name 		= addslashes($rowr['name']);
$first_name = addslashes($rowr['first_name']);
$last_name	= addslashes($rowr['last_name']);
$email 		= $rowr['email'];
$doctor	 	= $rowr['doctor'];
$address	= addslashes($rowr['address']);
$phone	 	= $rowr['phone'];
$blood_pressure	 	= $rowr['blood_pressure'];
$mobile	 	= $rowr['mobile'];
$sec_phone	= $rowr['sec_phone'];
$sex		= $rowr['sex'];
$birthdate	= $rowr['birthdate'];
$age		= $rowr['age'];
$bloodgroup	= $rowr['bloodgroup'];
$ion_user_id	= $rowr['ion_user_id'];
$patient_id	= $rowr['patient_id'];
$add_date	= $rowr['add_date'];
$registration_time = $rowr['registration_time'];
$how_added = $rowr['how_added'];
$company = addslashes($rowr['company']);
$job_description = addslashes($rowr['job_description']);
$e_contact = addslashes($rowr['e_contact']);
$e_contact_phone = addslashes($rowr['e_contact_phone']);
$e_contact_relation = addslashes($rowr['e_contact_relation']);
$e_contact_email = $rowr['e_contact_email'];
$first_time = addslashes($rowr['first_time']);
$ref_by = addslashes($rowr['ref_by']);
$ins_company = addslashes($rowr['ins_company']);
$hear_about_dir = addslashes($rowr['hear_about_dir']);
$hear_others = addslashes($rowr['hear_others']);
$reason_examination = addslashes($rowr['reason_examination']);
$physical_examination = $rowr['physical_examination'];
$glaucoma = $rowr['glaucoma'];
$cataracts = $rowr['cataracts'];
$eye_surgery = $rowr['eye_surgery'];
$lazy_eye = $rowr['lazy_eye'];
$light_flashes = $rowr['light_flashes'];
$eye_injury = $rowr['eye_injury'];
$floaters = $rowr['floaters'];
$sick_others = $rowr['sick_others'];
$thyroid_disease = $rowr['thyroid_disease'];
$sinusitis = $rowr['sinusitis'];
$hiv = $rowr['hiv'];
$diabetes = $rowr['diabetes'];
$asthma = $rowr['asthma'];
$respiratory_problem = $rowr['respiratory_problem'];
$problem_others = $rowr['problem_others'];
$taking_medications = $rowr['taking_medications'];
$medications_yes = $rowr['medications_yes'];
$wearing_contact_lens = $rowr['wearing_contact_lens'];
$allergies_list = $rowr['allergies_list'];
$other_allergies = $rowr['other_allergies'];
$wear_glasses = $rowr['wear_glasses'];
$worn_contacts = $rowr['worn_contacts'];
$contact_lens_yes = $rowr['contact_lens_yes'];
$contact_lens_hours = $rowr['contact_lens_hours'];
$blood_pressure2 = $rowr['blood_pressure2'];
$authorization = $rowr['authorization'];
$assignment = $rowr['assignment'];





//$request = $rowr['request'];
//$patientname = $rowr['patientname'];
//$doctorname = $rowr['doctorname'];

if($rowrem['id'] == $patid and $rowrem['location'] == $location and $rowrem['phone'] == $phone and $rowrem['birthdate'] == $birthdate and $rowrem['last_name'] == $last_name){
	echo "user already exist<br>";
}else{
	$queryins = "INSERT INTO `patient` (`id`, `location`, `img_url`, `name`, `first_name`, `last_name`, `email`, `doctor`, `address`, `phone`, `blood_pressure`, `mobile`, `sec_phone`, `sex`, `birthdate`, `age`, `bloodgroup`, `ion_user_id`, `patient_id`, `add_date`, `registration_time`, `how_added`, `company`, `job_description`, `e_contact`, `e_contact_phone`, `e_contact_relation`, `e_contact_email`, `first_time`, `ref_by`, `ins_company`, `hear_about_dir`, `hear_others`, `reason_examination`, `physical_examination`, `glaucoma`, `cataracts`, `eye_surgery`, `lazy_eye`, `light_flashes`, `eye_injury`, `floaters`, `sick_others`, `thyroid_disease`, `sinusitis`, `hiv`, `diabetes`, `asthma`, `respiratory_problem`, `problem_others`, `taking_medications`, `medications_yes`, `wearing_contact_lens`, `allergies_list`, `other_allergies`, `wear_glasses`, `worn_contacts`, `contact_lens_yes`, `contact_lens_hours`, `blood_pressure2`, `authorization`, `assignment`) VALUES
('$patid ', '$location', '$img_url', '$name ', '$first_name', '$last_name', '$email', '$doctor', '$address', '$phone', '$blood_pressure', '$mobile', '$sec_phone', '$sex', '$birthdate', '$age', '$bloodgroup', '$ion_user_id', '$patient_id', '$add_date', '$registration_time', '$how_added', '$company', '$job_description', '$e_contact', '$e_contact_phone', '$e_contact_relation', '$e_contact_email', '$first_time', '$ref_by', '$ins_company', '$hear_about_dir', '$hear_others', '$reason_examination', '$physical_examination', '$glaucoma', '$cataracts', '$eye_surgery', '$lazy_eye', '$light_flashes', '$eye_injury', '$floaters', '$sick_others', '$thyroid_disease', '$sinusitis', '$hiv', '$diabetes', '$asthma', '$respiratory_problem', '$problem_others', '$taking_medications', '$medications_yes', '$wearing_contact_lens', '$allergies_list', '$other_allergies', '$wear_glasses', '$worn_contacts', '$contact_lens_yes', '$contact_lens_hours', '$blood_pressure2', '$authorization', '$assignment')";//.$id;

//$stmt = $dbremote->query($queryins);	

if ($dbremote->query($queryins) === TRUE) {
  echo $name." ".$email." ".$doctor." ".$phone." ".$birthdate."<br>";
} else {
  echo "Error: " . $queryins . "<br>" . $dbremote->error;
}
	
}	
}
}


?>
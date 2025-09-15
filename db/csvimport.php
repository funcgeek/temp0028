<?php
 
//$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
include_once('db.php');	
/*
	 
	if (isset($_REQUEST['id'])) {
			
		$id = $_REQUEST['id'];

$query = "SELECT * FROM medicine_history WHERE frame_id = ".$id;
$addhistory = mysqli_query($conn, $query);
*/

$user = $_POST['user'];
if (isset($_POST['submit']))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['filename']['name']) && in_array($_FILES['filename']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['filename']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
				if($getData[5] != ""){
					$e_mail = $getData[5];
				}else{
					$e_mail = $getData[1].'_'.rand(10,1000).'@ispecs.com';
				}				
				if($getData[6] != ""){
					$a_ddress = $getData[6];
				}else{
					$a_ddress = 'changeme';
				}				
				if($getData[7] != ""){
					$p_hone1 = $getData[7];
				}else{
					$p_hone1 = 'changeme';
				}				
				if($getData[8] != ""){
					$p_hone2 = $getData[8];
				}else{
					$p_hone2 = 'changeme';
				}					
				if($getData[9] != ""){
					$s_ex = $getData[9];
				}else{
					$s_ex = 'changeme';
				}	
                // Get row data
                $location = $getData[0];
                $first_name = $getData[1];
                $middle_name = $getData[2];
                $last_name = $getData[3];
                $birthdate = $getData[4];
                $name = $first_name.'_'.$last_name;
                $email = $e_mail;
                $phone1 = $p_hone1;
                $phone2 = $p_hone2;
                $address = $a_ddress;
                $password = '12345';
                $sex = $s_ex;
				$ip_address = $_SERVER['REMOTE_ADDR'];
 
                $dfg = 5;
                $username = $name;
				
				$ion_user = mysqli_query($conn, "INSERT INTO users (location, username,password,email,created_on,first_name,last_name,ip_address) VALUES ('" . $location . "', '" . $username . "', '" . $password . "', '" . $email . "', '". time() . "', '" . $first_name . "', '" . $last_name . "', '" . $ip_address . "')");
				
				  $last_id = mysqli_insert_id($conn);
				  $mb_id = 'mb_'.$last_id;	
				  $fm_id = 'fm_'.$last_id;	
				  
				 $user_group = mysqli_query($conn, "insert into users_groups (user_id,group_id) VALUES ('" . $last_id . "', '" . $dfg . "')");
				 
				if(isset($ion_user)){ 
				  mysqli_query($conn, "INSERT INTO patient (location, mb_id, fm_id, first_name, middle_name, last_name, birthdate, name, email, phone, phone2, address, sex, ion_user_id,add_date,registration_time,patient_id,added_by) VALUES ('" . $location . "', '" . $mb_id . "', '" . $fm_id . "', '" . $first_name . "', '" . $middle_name . "', '" . $last_name . "', '" . $birthdate . "', '" . $name . "', '" . $email . "', '" . $phone1 . "', '" . $phone2 . "', '" . $address . "', '" . $sex . "', '" . $last_id . "', '" . date('d/m/y') . "', '" . time() . "', '" . rand(10000, 1000000) . "', '" . $user . "')");
				  }
            }
 
            // Close opened CSV file
            fclose($csvFile);
 
            header("Location: /patient");
         
    }
    else
    {
        echo "Please select valid file";
    }
}
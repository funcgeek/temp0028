<?php
// Load the database configuration file
include_once 'dbConfig.php';

// Include PhpSpreadsheet library autoloader
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['importSubmit'])){
    $users = $_POST['user2'];
    // Allowed mime types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    // Validate whether selected file is a Excel file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet(); 
            $worksheet_arr = $worksheet->toArray();

            // Remove header row
            unset($worksheet_arr[0]);

            foreach($worksheet_arr as $row){
                $name = $row[0];
                $location = $row[1];
                $price = $row[2];
                $s_price = $row[3];
                $box = $row[4];
                $quantity = $row[5];
                $quantity_2 = $row[6];
                $category = $row[7];
                $effects = $row[8];


				if ($location = "Montego Bay" && $location != 'Falmouth')
				{
					$loc = "Montego Bay";
					$loc_2 = '';
				}				
				
				if ($location != "Montego Bay" && $location = 'Falmouth')
				{
					$loc = "";
					$loc_2 = "Falmouth";
				}				
				
				if($location != "Montego Bay" AND $location != 'Falmouth')
				{
					$loc = "";
					$loc_2 = "";
				}

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM medicine WHERE name = '".$name."' AND box = '".$box."' AND effects = '".$effects."'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $db->query("UPDATE medicine SET name = '".$name."', location = '".$loc."', location_2 = '".$loc_2."', user = '".$users."', price = '".$price."', box = '".$box."', s_price = '".$s_price."', effects = '".$effects."', quantity = '".$quantity."', quantity_2 = '".$quantity_2."', category = '".$category."', type='frames', add_date = NOW() WHERE name = '".$name."' AND box = '".$box."' AND effects = '".$effects."'");
                }else{
                    // Insert member data in the database
                    $db->query("INSERT INTO medicine (name, location, location_2, price, s_price, box, effects, quantity, quantity_2, category, add_date, type, user) VALUES ('".$name."', '".$loc."', '".$loc_2."', '".$price."', '".$s_price."', '".$box."', '".$effects."', '".$quantity."', '".$quantity_2."', '".$category."', NOW(), 'frames','".$users."')");
                }
            }
            
            $qstring = '?status=succ?user='.$users;
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: index.php".$qstring);
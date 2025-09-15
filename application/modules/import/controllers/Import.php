<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Excel');
        $this->load->model('import_model');
        $this->load->helper('file');

        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

    }

    function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        } else {
          /*  $this->load->view('home/dashboard');
            $this->load->view('import');
            $this->load->view('home/footer');
			*/
			redirect('./import2/', 'refresh');
        }
    }

    function importPatientInfo() {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');
            $this->importPatient($path, $tablename);
        }
    }

    function importDoctorInfo() {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');

            $this->importDoctor($path, $tablename);
        }
    }

    function importMedicineInfo() {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');

            $this->importMedicine($path, $tablename);
        }
    }
    function importPaymentProccedureInfo() {
        if (isset($_FILES["filename"]["name"])) {
            $path = $_FILES["filename"]["tmp_name"];
            $tablename = $this->input->post('tablename');

            $this->importPaymentProccedure($path, $tablename);
        }
    }
    function importPatient() {

 
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
			$data = array();
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data
                $location = $getData[0];
                $first_name = $getData[1];
                $middle_name = $getData[2];
                $last_name = $getData[3];
                $birthdate = $getData[4];
                $name = $first_name.'_'.$last_name;
                $email = $first_name.'_'.rand(10,1000).'@ispecs.com';
                $phone = 'changeme';
                $address = 'changeme';
                $password = '12345';
                $sex = 'changeme';
 
                $dfg = 5;
                $username = $name;

                $this->ion_auth->register($username, $password, $email, $dfg);
                           
                $ionid = $this->db->get_where('users', array('email' => $email))->row()->id;
				
				$data = array(
				'location' => $location,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name
				
				
				);
				
				$this->import_model->dataEntry($data);
                    
			/*	mysqli_query($conn, "INSERT INTO patient (location, first_name, middle_name, last_name, birthdate, name, email, phone, address, sex, ion_user_id,add_date,registration_time,patient_id) VALUES ('" . $location . "', '" . $first_name . "', '" . $middle_name . "', '" . $last_name . "', '" . $birthdate . "', '" . $name . "', '" . $email . "', '" . $phone . "', '" . $address . "', '" . $sex . "', '" . $ionid . "', '" . date('d/m/y') . "', '" . time() . "', '" . rand(10000, 1000000) . "')");
				*/
 
              //  }
            }
 
            // Close opened CSV file
            fclose($csvFile);
 
           
         
    }
    else
    {
        echo "Please select valid file";
    }
	 header("Location: /patient");
} 
  

    function importDoctor($file, $tablename) {
        $object = PHPExcel_IOFactory::load($file);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();   
            $highestColumnLetter = $worksheet->getHighestColumn(); 
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); 
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }


            $headerexist = $this->import_model->headerExist($rowData1, $tablename); 


            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {
                            $rowData3[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        } else {
                            $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                          
                        }

                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) != 'password') {
                            $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
                            $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'phone') {
                            $phone = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {

                            $password = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'email') {

                            $email = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                    }



                    if ($this->ion_auth->email_check($email)) {
                        $exist_email[] = $row;
                        $exist_rows = implode(', ', $exist_email);
                        $message1 = 'Rows number ' . $exist_rows . ' contain the emails which already exist!';
                    } else {
                        if (!empty($email)) {
                            $dfg = 4;
                            $username = $name;

                            $this->ion_auth->register($username, $password, $email, $dfg);
                            
                            $ionid = $this->db->get_where('users', array('email' => $email))->row()->id;
                           
                            array_push($rowData, $ionid);
                            array_push($rowData2, 'ion_user_id');
                            $data = array_combine($rowData2, $rowData);
                            $this->import_model->dataEntry($data, $tablename);
                        }
                    }
                }
                $this->session->set_flashdata('feedback', lang('successful_data_import'));
                $this->session->set_flashdata('message1', $message1);
            } else {
                $this->session->set_flashdata('feedback', lang('wrong_file_format'));
            }
        }


        redirect('import');
    }

    function importMedicine($file, $tablename) {
        $object = PHPExcel_IOFactory::load($file);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();    
            $highestColumnLetter = $worksheet->getHighestColumn(); 
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); 
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }


            $headerexist = $this->import_model->headerExist($rowData1, $tablename); 


            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {
                       
                        $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        


                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
                            $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                       
                    }

                    $medicinename = $this->db->get_where('medicine', array('name =' => $name))->row();

                    if (!empty($medicinename)) {
                        $exist_name[] = $row;
                        $exist_rows = implode(',', $exist_name);
                        $message2 = 'Rows number ' . $exist_rows . ' contain the medicine which already exist!';
                    } else {
                        array_push($rowData, date('d/m/y'));
                        array_push($rowData2, 'add_date');
                        $data = array_combine($rowData2, $rowData);

                        $this->import_model->dataEntry($data, $tablename);
                    }
                }
                $this->session->set_flashdata('feedback', lang('successful_data_import'));
                $this->session->set_flashdata('message2', $message2);
            } else {
                $this->session->set_flashdata('feedback', lang('wrong_file_format'));
            }
        }


        redirect('import');
    }
    function importPaymentProccedure($file, $tablename) {
        $object = PHPExcel_IOFactory::load($file);
        foreach ($object->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();    
            $highestColumnLetter = $worksheet->getHighestColumn(); 
            $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); 
            for ($column1 = 0; $column1 < $highestColumn; $column1++) {
                $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
            }
            

            $headerexist = $this->import_model->headerExist($rowData1, $tablename); 

          
            if ($headerexist) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = [];
                    $rowData2 = [];

                    for ($column = 0; $column < $highestColumn; $column++) {
                       
                        $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
                        $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        


                        if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'code') {
                            $code = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
                        }
                       
                    }

                   
                       
                        $data = array_combine($rowData2, $rowData);

                        $this->import_model->dataEntry($data, $tablename);
                   // }
                }
                $this->session->set_flashdata('feedback', lang('successful_data_import'));
                $this->session->set_flashdata('message2', $message2);
            } else {
                $this->session->set_flashdata('feedback', lang('wrong_file_format'));
            }
        }


        redirect('import');
    }

}
?>
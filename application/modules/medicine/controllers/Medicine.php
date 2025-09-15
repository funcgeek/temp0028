<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('medicine_model');
		 $this->load->model('patient/patient_model');
		 $this->load->model('logs/logs_model');
        if (!$this->ion_auth->in_group(array('admin', 'Receptionist', 'Doctor','Nurse'))) {
            redirect('home/permission');
        }
    }

public function index() {
        $id = $this->input->get('id');
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
        $data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // Header
        $this->load->view('medicine', $data); // Frame inventory view
        $this->load->view('home/footer'); // Footer
    }   
	
	public function frameList() {
		$id = $this->input->get('id');
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine/framesList.php', $data);
        $this->load->view('home/footer'); // just the header file
    }  	
	
	public function serviceList() {
		$id = $this->input->get('id');
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine/servicesList.php', $data);
        $this->load->view('home/footer'); // just the header file
    }   
    
     public function sellNow() {
		$id = $this->input->get('id');
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('sell_now', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function medicineByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['medicines'] = $this->medicine_model->getMedicineByPageNumber($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['p_n'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function medicineStockAlert() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = '0';
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);
        //  $data['medicines'] = $this->medicine_model->getMedicineByStockAlertByPageNumber($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $data['alert'] = 'Alert Stock';
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function medicineStockAlertByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $data['medicines'] = $this->medicine_model->getMedicineByStockAlert($page_number);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['pagee_number'] = $page_number;
        $data['alert'] = 'Alert Stock';
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function searchMedicine() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKey($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function searchMedicineInAlertStock() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['medicines'] = $this->medicine_model->getMedicineByKeyByStockAlert($page_number, $key);
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_stock_alert', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addMedicineView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer'); // just the header file
    }    
	
	public function addServiceView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getService();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_service_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addFrameTypeView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_frame_type_view', $data);
        $this->load->view('home/footer'); // just the header file
    }    
    
    public function addFrameTypeItemsView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->medicine_model->getFrameTypeItems();
        $data['frame_types'] = $this->medicine_model->getFrameType();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_frame_type_items_view', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
public function addNewMedicine() {
    $id = $this->input->post('id');
    $name = $this->input->post('name');
    $location = $this->input->post('location');
    $location_2 = $this->input->post('location_2');
    $type = $this->input->post('type');
    $category = $this->input->post('category');
    $price = $this->input->post('price');
    $box = $this->input->post('box');
    $s_price = $this->input->post('s_price');
    $quantity = $this->input->post('quantity');
    $quantity_2 = $this->input->post('quantity_2');
    $generic = $this->input->post('generic');
    $company = $this->input->post('company');
    $effects = $this->input->post('effects');
    $e_date = $this->input->post('e_date');
    $transfer_date = date("l d-m-Y h:i:sa");
    $reception_id = $this->input->post('reception_id');
    $doctor_id = $this->input->post('doctor_id');
    $user_id = $this->input->post('user_id');
    
    // Process the frame_label checkboxes
    $frame_labels_array = $this->input->post('frame_label');
    $frame_label_string = ''; // Default to an empty string
    if (!empty($frame_labels_array) && is_array($frame_labels_array)) {
        // Convert the array of selected labels into a comma-separated string
        $frame_label_string = implode(',', $frame_labels_array);
    }
    
    if (empty($id)) {
        $add_date = date('m/d/y');
    } else {
        $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
    }

    // Process file upload
    $img_url = "";
    
    // Debug file upload
    if(isset($_FILES['img_url'])) {
        $log_message = "File upload info: " . json_encode($_FILES['img_url']);
        log_message('debug', $log_message);
    }

    if(isset($_FILES['img_url']) && $_FILES['img_url']['name'] != '') {
        $config = array();
        $config['upload_path'] = './Uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '5000'; // in KB (5MB)
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['file_name'] = time() . '_' . $_FILES['img_url']['name'];

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('img_url')) {
            $upload_data = $this->upload->data();
            $img_url = 'Uploads/' . $upload_data['file_name'];
            
            if (!empty($id)) {
                $old_image = $this->db->get_where('medicine', array('id' => $id))->row()->url;
                if ($old_image && file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            log_message('debug', 'File uploaded successfully: ' . $img_url);
        } else {
            $error = $this->upload->display_errors();
            log_message('error', 'File upload failed: ' . $error);
            $this->session->set_flashdata('error_message', $error);
        }
    } else {
        log_message('debug', 'No file was uploaded');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    
    $this->form_validation->set_rules('name', 'Model', 'trim|min_length[2]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('category', 'Category', 'trim|min_length[2]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('box', 'Store Box', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('s_price', 'Selling Price', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('quantity', 'Quantity', 'trim|max_length[100]|xss_clean');

    if (empty($id)) {
        $this->db->select('*');
        $this->db->where('name', $name);
        $this->db->where('effects', $effects);
        $fetched_records = $this->db->get('medicine');
        $count = $fetched_records->num_rows();
        
        if ($count > 0) {
            $this->form_validation->set_rules('name', 'Model & Color', 'trim|min_length[2]|max_length[100]|xss_clean|is_unique[medicine.name]');
        }
    }

    if ($this->form_validation->run() == FALSE) {
        $data = array();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer');
    } else {
        if (!empty($reception_id) && empty($doctor_id)) {
            $user_details = $this->receptionist_model->getReceptionistById($reception_id);
            $user_name = $user_details->name;
        } else if (!empty($doctor_id) && empty($reception_id)) {
            $user_details = $this->doctor_model->getDoctorById($doctor_id);
            $user_name = $user_details->name;
        } else {
            $user_details = $this->ion_auth->user()->row();
            $user_name = $user_details->username;
        }
        
        $data = array(
            'name' => $name,
            'location' => $location,
            'location_2' => $location_2,
            'category' => $category,
            'price' => $price,
            'box' => $box,
            's_price' => $s_price,
            'quantity' => $quantity,
            'quantity_2' => $quantity_2,
            'generic' => $generic,
            'company' => $company,
            'effects' => $effects,
            'add_date' => $add_date,
            'type' => $type,
            'e_date' => $e_date,
            'frame_label' => $frame_label_string,
            'user' => $user_name
        );
        
        if (!empty($img_url)) {
            $data['url'] = $img_url;
        }
        
        $data_newframe = array(
            'model' => $name,
            'location_mobay' => $location,
            'location_falmouth' => $location_2,
            'brand' => $category,
            'description' => '<font color="red"><b>a new Frame or Service was added</b></font>',
            'size' => $box,
            'quantity_mobay' => $quantity,
            'quantity_falmouth' => $quantity_2,
            'date_time' => date('d-m-Y H:i:s'), // e.g., 22-08-2025 12:44:00
            'color' => $effects,
            'price' => $price,
            'date' => $add_date, // e.g., 08/22/25
            'user' => $user_name
        );
        
        if (empty($id)) {
            $this->medicine_model->insertMedicine($data);
            $this->logs_model->insertFramesLog($data_newframe);
            $this->session->set_flashdata('feedback', lang('added'));
        } else {
            $this->medicine_model->updateMedicine($id, $data);
            $this->logs_model->insertFramesLog($data_newframe);
            $this->session->set_flashdata('feedback', lang('updated'));
        }
        
        redirect('medicine');
    }
}
	
    public function addNewFrameType() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
       // $transfer_date = date("l d-m-Y h:i:sa");
		$reception_id = $this->input->post('reception_id');
		$doctor_id = $this->input->post('doctor_id');
		$user_id = $this->input->post('user_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

if (empty($id)) {
            $this->db->select('*');
			$this->db->where('name',$name);
			$this->db->where('description',$description);
            $fetched_records = $this->db->get('frame_type');
            $query9 = $fetched_records->result();
			$count = $fetched_records->num_rows();
			
		if ($count > 0){
			$this->form_validation->set_rules('name', 'Name & Description', 'trim|min_length[2]|max_length[100]|xss_clean|is_unique[frame_type.name]');	
        }
}
      if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['categories'] = $this->medicine_model->getFrameType();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_frame_type_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
			if (!empty($reception_id) && empty($doctor_id) ) {
                $user_details = $this->receptionist_model->getReceptionistById($reception_id);
                $user_name = $user_details->name;
            } 			
			if (!empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->doctor_model->getDoctorById($doctor_id);
                $user_name = $user_details->name;
            } 			
			if (empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->ion_auth->user()->row();
                $user_name = $user_details->username;
            } 
			
			
            $data = array();
            $data = array('name' => $name,
                		  'description' => $description,
                		  'user' => $user_name
            	);
				
			$data_newtype = array();
            $data_newtype=array(
				'model' => $name,
                'description' => 'a new Frame Type was addded with this description <br>'.$description,
                'user' => $user_name,
                'date_time'=>date('d-m-Y H:i:s')
               );				 
                					
            	
            if (empty($id)) {
                $this->medicine_model->insertFrameType($data);
				$this->logs_model->insertFramesLog($data_newtype);	
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->medicine_model->updateFrameType($id, $data);
				$this->logs_model->insertFramesLog($data_newtype);	
               $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('medicine/addFrameTypeView');
        }
    }    
      
 
    public function addNewFrameTypeItems() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $frame_type = $this->input->post('frame_type');
        //$frame_id = $this->input->post('frame_id');
        $price = $this->input->post('price');

		$reception_id = $this->input->post('reception_id');
		$doctor_id = $this->input->post('doctor_id');
		$user_id = $this->input->post('user_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Category Name', 'required|trim|min_length[2]|max_length[100]|xss_clean');
       // $this->form_validation->set_rules('name', 'Model', 'trim|min_length[2]|max_length[100]|xss_clean|is_unique[medicine.name]');
		
        // Validating Category Field
      //  $this->form_validation->set_rules('category', 'Category', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Purchase Price Field
       // $this->form_validation->set_rules('price', 'Purchase Price', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Store Box Field
      //  $this->form_validation->set_rules('box', 'Store Box', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Selling Price Field
     //   $this->form_validation->set_rules('s_price', 'Selling Price', 'trim|min_length[1]|max_length[100]|xss_clean');
        //$this->form_validation->set_rules('s_price_2', 'Selling Price', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('price', 'Price', 'trim|max_length[200]|xss_clean');
        // Validating Generic Name Field
        //$this->form_validation->set_rules('generic', 'Generic Name', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Company Name Field
        //$this->form_validation->set_rules('company', 'Company', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Effects Field
        //$this->form_validation->set_rules('effects', 'Effects', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Expire Date Field
        //$this->form_validation->set_rules('e_date', 'Expire Date', 'trim|min_length[1]|max_length[100]|xss_clean');

//data mods
if (empty($id)) {
            $this->db->select('*');
			$this->db->where('name',$name);
			$this->db->where('price',$price);
            $fetched_records = $this->db->get('frame_items');
            $query9 = $fetched_records->result();
			$count = $fetched_records->num_rows();
			
		if ($count > 0){
			$this->form_validation->set_rules('name', 'Name & Description', 'trim|min_length[2]|max_length[100]|xss_clean|is_unique[frame_items.name]');
			/*
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		$txt = print_r ($query9,true);
		fwrite($myfile, $txt);		
		fclose($myfile);
*/		
        }
}

			
	//	$data33 = $this->medicine_model->getMedicineCompare();
	//	foreach ($query9 as $ch_names) {
			
	//	$test = $this->db->get_where('medicine', array('name' => $name))->row();


			
			
	//	}


			

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['frame_items'] = $this->medicine_model->getFrameTypeItems();
            $data['frame_types'] = $this->medicine_model->getFrameType();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_frame_type_items_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
			if (!empty($reception_id) && empty($doctor_id) ) {
                $user_details = $this->receptionist_model->getReceptionistById($reception_id);
                $user_name = $user_details->name;
            } 			
			if (!empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->doctor_model->getDoctorById($doctor_id);
                $user_name = $user_details->name;
            } 			
			if (empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->ion_auth->user()->row();
                $user_name = $user_details->username;
            } 


			$frame_id = $this->medicine_model->getFrameTypeID($frame_type);
	
	      /*  $this->db->select('*');
			$this->db->where('name',$frame_type);
            $fetched_records = $this->db->get('frame_type');
            $frame_id = $fetched_records->result();
		//	$count = $fetched_records->num_rows();
			*/
						
            $data = array();
            $data = array('name' => $name,
            			  'frame_type_name' => $frame_type,
            			  'frame_type_id' => $frame_id->id,
                		  'price' => $price,
                		  'user' => $user_name
            	);
			
			$data_newlens = array();
            $data_newlens=array(
				'model' => $name,
                'description' => 'a new Lens was addded with '. $frame_type. 'and the following id '.$frame_id->id,
                'user' => $user_name,
				'price' => $price,
                'date_time'=>date('d-m-Y H:i:s')
               );				 
                	            	
            if (empty($id)) {
                $this->medicine_model->insertFrameItems($data);
				$this->logs_model->insertFramesLog($data_newlens);	
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->medicine_model->updateFrameType($id, $data);
                            
/*							$framename = $this->medicine_model->getFrameTypeByName($name);
				
				$sql = "update frame_items SET name='tutsmake',email='support@tutsmake.com',mobile='888889999' where id='".1."'";
				$query=$this->db->query($sql);			
							
							
							
							
*/							
							
                
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('medicine/addFrameTypeItemsView'); 
        }
    }    
    


    function editMedicine() {
        $data = array();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_medicine_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }    
	
	function editService() {
        $data = array();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_service_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function load() {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $qty_2 = $this->input->post('qty_2');
        $previous_qty = $this->db->get_where('medicine', array('id' => $id))->row()->quantity;
        $previous_qty_2 = $this->db->get_where('medicine', array('id' => $id))->row()->quantity_2;
        $frame_name = $this->db->get_where('medicine', array('id' => $id))->row()->name;
        $new_qty = $previous_qty + $qty;
        $new_qty_2 = $previous_qty_2 + $qty_2;
		$reception_id = $this->input->post('reception_id');
		$current_userid = $this->input->post('current_userid');
		$doctor_id = $this->input->post('doctor_id');
		$user_id = $this->input->post('user_id');
			if (!empty($reception_id) && empty($doctor_id) ) {
                $user_details = $this->receptionist_model->getReceptionistById($reception_id);
                $user_name = $user_details->name;
            } 			
			if (!empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->doctor_model->getDoctorById($doctor_id);
                $user_name = $user_details->name;
            } 			
			if (empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->ion_auth->user()->row();
                $user_name = $user_details->username;
            } 			
		
		/*	if (!empty($current_userid)) {
                $user_details = $this->patient_model->getUsersById($current_userid);
                $user_name = $user_details->username;
            } else {
                $user_name = "";
            } 
			*/

		
        $data = array();
        $data = array('quantity' => $new_qty,
					  'quantity_2' => $new_qty_2
					  );
					  
		$data2 = array();
		$data2 = array('frame_id' => $id,
					   'model' => $frame_name,
					   'mobay_old' => $previous_qty,
					   'falmouth_old' => $previous_qty_2,
					   'update_mobay' => $qty,
					   'update_falmouth' => $qty_2,
					   'mobay_new' => $new_qty,
					   'falmouth_new' => $new_qty_2,
					  // 'loaded_by' => $current_username,
					   'loaded_by' => $user_name,
					   'date' => date("h:i:s A M-d-Y ")
					   );					   
        $this->medicine_model->updateMedicine($id, $data);
		$this->medicine_model->insertLoadMedicine($data2);	
		
       $this->session->set_flashdata('feedback', lang('medicine_loaded'));
        redirect('medicine');
    }      
	
	/*
	function updatePrices() {
        $id = $this->input->post('id');
        $qty_value = $this->input->post('qty_value');
        $qty_percentage = $this->input->post('qty_percentage');
        $previous_qty = $this->db->get_where('medicine', array('id' => $id))->row()->quantity;
        $previous_qty_2 = $this->db->get_where('medicine', array('id' => $id))->row()->quantity_2;
        $frame_name = $this->db->get_where('medicine', array('id' => $id))->row()->name;
        $new_qty = $previous_qty + $qty;
        $new_qty_2 = $previous_qty_2 + $qty_2;
		$reception_id = $this->input->post('reception_id');
		$doctor_id = $this->input->post('doctor_id');
		$user_id = $this->input->post('user_id');
			if (!empty($reception_id) && empty($doctor_id) ) {
                $user_details = $this->receptionist_model->getReceptionistById($reception_id);
                $user_name = $user_details->name;
            } 			
			if (!empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->doctor_model->getDoctorById($doctor_id);
                $user_name = $user_details->name;
            } 			
			if (empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->ion_auth->user()->row();
                $user_name = $user_details->username;
            } 			
		
		
        $data = array();
        $data = array('quantity' => $new_qty,
					  'quantity_2' => $new_qty_2
					  );
					  
		$data2 = array();
		$data2 = array('frame_id' => $id,
					   'model' => $frame_name,
					   'mobay_old' => $previous_qty,
					   'falmouth_old' => $previous_qty_2,
					   'update_mobay' => $qty,
					   'update_falmouth' => $qty_2,
					   'mobay_new' => $new_qty,
					   'falmouth_new' => $new_qty_2,
					   'loaded_by' => $user_name,
					   'date' => date("h:i:s A M-d-Y ")
					   );					   
        $this->medicine_model->updateMedicine($id, $data);
		$this->medicine_model->insertLoadMedicine($data2);	
		
       $this->session->set_flashdata('feedback', lang('medicine_loaded'));
        redirect('medicine/medicineStockAlert');
    }  
    
    */
    
    function updatePrices() {
    $qty_value = $this->input->post('qty_value');
    $qty_percentage = $this->input->post('qty_percentage');
    
    // Get all medicines to update their prices
    $medicines = $this->db->get('medicine')->result();
    
    foreach($medicines as $medicine) {
        $id = $medicine->id;
        $current_price = $medicine->s_price; // Assuming there's a price column
        $new_price = $current_price;
        
        // Update by percentage
        if(!empty($qty_percentage)) {
            $new_price = $current_price + ($current_price * ($qty_percentage / 100));
        }
        
        // Update by dollar value
        if(!empty($qty_value)) {
            $new_price = $current_price + $qty_value;
        }
        
        // Update the medicine price
        $data = array('s_price' => $new_price);
        $this->medicine_model->updateMedicine($id, $data);
    }
    
    $this->session->set_flashdata('feedback', 'All medicine prices updated successfully');
    redirect('medicine/medicineStockAlert');
}
	
	function transfer() {
        $id = $this->input->post('id');
        $location1 = $this->input->post('location');
        $location2 = $this->input->post('location_2'); 
		$item_model = $this->db->get_where('medicine', array('id' => $id))->row()->name;
		$qty = $this->input->post('qty');
        $previous_qty = $this->db->get_where('medicine', array('id' => $id))->row()->quantity;
        $frame_id = $this->db->get_where('medicine', array('id' => $id))->row()->id;
        $previous_qty_2 = $this->db->get_where('medicine', array('id' => $id))->row()->quantity_2;	
		$transfer_date = date("d-m-Y");
		$update_day = date("l");
		$update_time = date('h:i:sa');	
		$reception_id = $this->input->post('reception_id');
		$current_userid = $this->input->post('user_id');
		$doctor_id = $this->input->post('doctor_id');
		$current_user = $this->input->post('user_id');
		
		//$reception_id = $this->db->get_where('receptionist', array('ion_user_id' => $current_user))->row()->id;
	//	$doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
	//	$user_id = $this->db->get_where('user', array('ion_user_id' => $current_user))->row()->id;
							//$admin_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
		
		if ($location1 == "Falmouth" && $location2 == "Montego Bay"){
			$update_qt2 = $previous_qty_2 - $qty;
			$update_qt = $previous_qty + $qty;
					
				//	if($update_qt2 > 0 ){ echo '<script>alert("quantity is less that 0");</script>'; }
		//	$class_disabled1 = "disabled";
			
		}
		else if ($location1 == "Montego Bay" && $location2 == "Falmouth"){
			$update_qt = $previous_qty - $qty;
			$update_qt2 = $previous_qty_2 + $qty;
		//	if($previous_qty > 0 ){ echo '<script>alert("quantity is less that 0");</script>'; }
		//	$class_disabled2 = "disabled";
		}
		else {
			$update_qt = $previous_qty;
			$update_qt2 = $previous_qty_2;	
		}

			if (!empty($current_userid)) {
                $current_details = $this->patient_model->getUsersById($current_userid);
                $current_username = $current_details->username;
            } else {
                $current_username = "";
            } 
            		
			if (!empty($reception_id) && empty($doctor_id) ) {
                $user_details = $this->receptionist_model->getReceptionistById($reception_id);
                $user_name = $user_details->name;
            } 			
			if (!empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->doctor_model->getDoctorById($doctor_id);
                $user_name = $user_details->name;
            } 			
			if (empty($doctor_id) && empty($reception_id) ) {
                $user_details = $this->ion_auth->user()->row();
                $user_name = $user_details->username;
            } 		
        //$new_qty = $previous_qty + $qty;
        //$new_qty_2 = $previous_qty_2 + $qty_2;
        $data2 = array();
        $data2 = array( 'model' => $item_model,
						'frame_id' => $frame_id,
						'location1' => $location1,
						'location2' => $location2,
						'amount' => $qty,
						'old_quantity1' => $previous_qty,
						'old_quantity2' => $previous_qty_2,						
						'new_quantity1' => $update_qt,
						'new_quantity2' => $update_qt2,
						'transfer_date' => $transfer_date,
						'update_day' => $update_day,
						'time' => $update_time,
						'user' => $user_name
						//'user' => $current_username
						);  
		$data = array();
		$data = array('quantity' => $update_qt,'quantity_2' => $update_qt2);
		
		if ($location1 <> $location2){       
			if ( $update_qt >= 0 && $update_qt2 >= 0 && $previous_qty >= 0 && $previous_qty_2 >= 0 ) { 
			        $this->medicine_model->updateMedicine($id, $data);
					$this->medicine_model->insertMedicineHistory($data2);				
		
				$disp = $this->session->set_flashdata('feedback', 'Transfer complete');
			}else {
				$disp =  $this->session->set_flashdata('feedback', 'Item Transer is below what is available <br> please choose smaller quantity');
			}
			

		}
    //   $this->session->set_flashdata('feedback', lang('medicine_loaded'));
		echo $disp;
	   
        redirect('medicine');
    }

    function editMedicineByJason() {
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        echo json_encode($data);
    }        
	
	function editServiceTypeByJason() {
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineById($id);
        echo json_encode($data);
    }    
	
	function editMedicineHistoryByJason() {
        $frame_id = $this->input->get('frame_id');
        $data['medicine'] = $this->medicine_model->getMedicineHistoryById($frame_id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicine($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine');
    }

    public function medicineCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_category', $data);
        $this->load->view('home/footer'); // just the header file
    }    
	
	public function history() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
		$id = $this->input->post('id');
        $data['histories'] = $this->medicine_model->getMedicineHistory();
		$data['medicine'] = $this->medicine_model->getMedicineHistoryById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('medicine_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

	function viewMedicineHistoryByJason() {
        $id = $this->input->get('id');
        //$data['view_nurse_notes'] = $this->patient_model->viewNurseNotesById($id);
        $this->medicine_model->viewMedicineHistoryById($id);
        $patient = $data['view_covid_surveys']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        echo json_encode($data);
    } 	
	
    public function addCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Description Field
        //$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_category_view');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->medicine_model->insertMedicineCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->medicine_model->updateMedicineCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('medicine/medicineCategory');
        }
    }    
	
	public function addNewService() {
        $id = $this->input->post('id');
        $name = $this->input->post('service_name');
        $price = $this->input->post('service_price');
        $type = $this->input->post('type');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('service_name', 'Service Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('service_price', 'Service Price', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        //$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_new_service_view');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array(
			'service_name' => $name,
			'type' => $type,
            'service_price' => $price
            );
            if (empty($id)) {
                $this->medicine_model->insertService($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->medicine_model->updateService($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('medicine/addServiceView');
        }
    }

    function edit_category() {
        $data = array();
        $id = $this->input->get('id');
        $data['medicine'] = $this->medicine_model->getMedicineCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicineCategoryByJason() {
        $id = $this->input->get('id');
        $data['medicinecategory'] = $this->medicine_model->getMedicineCategoryById($id);
        echo json_encode($data);
    }    
	
	function editFrameTypeByJason() {
        $id = $this->input->get('id');
        $data['frametype'] = $this->medicine_model->getFrameTypeById($id);
        echo json_encode($data);
    }

    function deleteMedicineCategory() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicineCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine/medicineCategory');
    }    

    function deleteFrameType() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteFrameType($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine/addFrameTypeView');
    }     
	
	function deleteServices() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteService($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine/addServiceView');
    }     
    
    function deleteFrameItems() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteFrameItems($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine/addFrameTypeItemsView');
    } 
    	
	function deleteMedicineHistory() {
        $id = $this->input->get('id');
        $this->medicine_model->deleteMedicineHistory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('medicine/history');
    }

function getMedicineList() {
    $requestData = $_REQUEST;
    $start = $requestData['start'];
    $limit = $requestData['length'];
    $search = $this->input->post('search')['value'];

    if ($limit == -1) {
        if (!empty($search)) {
            $data['medicines'] = $this->medicine_model->getMedicineBysearch($search);
        } else {
            $data['medicines'] = $this->medicine_model->getMedicine();
        }
    } else {
        if (!empty($search)) {
            $data['medicines'] = $this->medicine_model->getMedicineByLimitBySearch($limit, $start, $search);
        } else {
            $data['medicines'] = $this->medicine_model->getMedicineByLimit($limit, $start);
        }
    }
    
    $i = 0;
    $info = [];
    foreach ($data['medicines'] as $medicine) {
        $i = $i + 1;
        $settings = $this->settings_model->getSettings();

        if ($medicine->type == 'frames') {
            // Prepare image display
            $image_html = '';
            if (!empty($medicine->url)) {
                $image_html = '<div class="frames_image_container"><img src="' . base_url($medicine->url) . '" alt="Frame" class="frames_thumbnail"></div>';
            } else {
                $image_html = '<div class="frames_image_container"><img src="https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg" alt="No Image" class="frames_thumbnail"></div>';
            }
            
            // Prepare quantity display for Location 1
            if ($medicine->quantity <= 0) {
                $quan = '<span class="frames_stock_out">Stock Out</span>';
            } else if ($medicine->quantity <= 5) {
                $quan = '<span class="frames_stock_low">' . $medicine->quantity . '</span>';
            } else {
                $quan = '<span class="frames_stock_ok">' . $medicine->quantity . '</span>';
            }
            
            // Prepare quantity display for Location 2
            if ($medicine->quantity_2 <= 0) {
                $quan_2 = '<span class="frames_stock_out">Stock Out</span>';
            } else if ($medicine->quantity_2 <= 5) {
                $quan_2 = '<span class="frames_stock_low">' . $medicine->quantity_2 . '</span>';
            } else {
                $quan_2 = '<span class="frames_stock_ok">' . $medicine->quantity_2 . '</span>';
            }
            
            // Prepare buttons
            $option3 = '<button type="button" class="btn btn-info no-print btn-xs btn_width btn-warning history" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-history"></i> ' . lang('history') . '</button>';
            $option4 = '<button type="button" class="btn btn-info no-print btn-xs btn_width btn-warning loadhistory" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-history"></i> Loading History</button>';
            
            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                $option2 = '<a class="btn btn-danger btn-xs btn_width delete_button" href="medicine/delete?id=' . $medicine->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
                $load = '<button type="button" class="btn btn-success btn-xs btn_width load" data-toggle="modal" data-id="' . $medicine->id . '">' . lang('load') . '</button>';
                $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton no-print" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . '</button>';
                $option0 = '<button type="button" class="btn btn-primary btn-xs btn_width no-print transfer" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-exchange"></i> ' . lang('transfer') . '</button>';
            } else {
                $option1 = '';
                $option2 = '';
                $option0 = '';
                $load = '<button type="button" class="btn btn-info btn-xs btn_width load" disabled> Load </button>';
            }
            
            // Format buttons in a div for better styling
            $buttons = '<div class="frames_action_buttons">';
            if (!empty($option0)) $buttons .= $option0 . ' ';
            if (!empty($option1)) $buttons .= $option1 . ' ';
            if (!empty($option3)) $buttons .= $option3 . ' ';
            if (!empty($option4)) $buttons .= $option4 . ' ';
            if (!empty($option2)) $buttons .= $option2;
            $buttons .= '</div>';
            
            // Create the row data
            $info[] = array(
                $image_html,
                $medicine->name,
                $medicine->category,
                $medicine->box,
                '<span class="frames_location frames_location_1">' . $medicine->location . '</span>',
                $quan . '<div class="frames_load_btn">' . $load . '</div>',
                '<span class="frames_location frames_location_2">' . $medicine->location_2 . '</span>',
                $quan_2 . '<div class="frames_load_btn">' . $load . '</div>',
                '<span class="frames_price">' . $settings->currency . $medicine->s_price . '</span>',
                $medicine->effects,
                $medicine->user,
                $buttons
            );
        }
    }

    if (!empty($data['medicines'])) {
        $output = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => $this->db->get('medicine')->num_rows(),
            "recordsFiltered" => $this->db->get('medicine')->num_rows(),
            "data" => $info
        );
    } else {
        $output = array(
            "draw" => 1,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => []
        );
    }

    echo json_encode($output);
}
   

   function getServiceList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['medicines'] = $this->medicine_model->getMedicineBysearch($search);
            } else {
                $data['medicines'] = $this->medicine_model->getMedicine();
            }
        } else {
            if (!empty($search)) {
                $data['medicines'] = $this->medicine_model->getMedicineByLimitBySearch($limit, $start, $search);
            } else {
                $data['medicines'] = $this->medicine_model->getMedicineByLimit($limit, $start);
            }
        }
        //  $data['appointments'] = $this->appointment_model->getAppointment();
        $i = 0;
        foreach ($data['medicines'] as $medicine) {
            $i = $i + 1;
            $settings = $this->settings_model->getSettings();

           if ($medicine->type =='frames') {
		   /*
		   
		   if ($medicine->quantity <= 0) {
                $quan = '<p class="os">Stock Out</p>';
            } else {
                $quan = $medicine->quantity;
            }            
			
			if ($medicine->quantity_2 <= 0) {
                $quan_2 = '<p class="os">Stock Out</p>';
            } else {
                $quan_2 = $medicine->quantity_2;
            }
			*/


						
            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
			$option2 = '<a class="btn btn-info btn-xs btn_width delete_button"  href="medicine/deleteService?id=' . $medicine->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
			$option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton no-print" data-toggle="modal" data-id="' . $medicine->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';
			}
            if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
			$option1 = '';
			$option2 = '';
			$option0 = '';
			$load = '<button type="button" class="btn btn-info btn-xs btn_width load" disabled> Load </button>';

			}
			
            $info[] = array(
                //$i,
                $medicine->name,
				$settings->currency . $medicine->s_price,
                $medicine->user,
                $option1 . ' ' . $option2
                    //  $options2
            );
		   }
			
        }

        if (!empty($data['medicines'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medicine')->num_rows(),
                "recordsFiltered" => $this->db->get('medicine')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    public function getMedicinenamelist() {
        $searchTerm = $this->input->post('searchTerm');

        $response = $this->medicine_model->getMedicineNameByAvailablity($searchTerm);
        $data = array();
        foreach ($response as $responses) {
            $data[] = array("id" => $responses->id, "data-id" => $responses->id, "data-med_name" => $responses->name, "text" => $responses->name);
        }

        echo json_encode($data);
    }

    public function getMedicineListForSelect2() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->medicine_model->getMedicineInfo($searchTerm);

        echo json_encode($response);
    }

    public function getMedicineForPharmacyMedicine() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->medicine_model->getMedicineInfoForPharmacySale($searchTerm);

        echo json_encode($response);
    }

}

/* End of file medicine.php */
/* Location: ./application/modules/medicine/controllers/medicine.php */

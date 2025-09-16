<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('bed/bed_model');
        $this->load->model('lab/lab_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
        $this->load->model('prescription/prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('doctor/doctor_model');
     //   $this->load->module('paypal');
		$this->load->model('nurse/nurse_model');
		$this->load->model('receptionist/receptionist_model');
		$this->load->helper('url');        

        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Patient', 'Doctor', 'Laboratorist', 'Accountant', 'Receptionist'))) {
            // // redirect('home/permission');  
        }
    }

    public function index() {
     //   if ($this->ion_auth->in_group(array('Patient'))) {
      //      // // redirect('home/permission');  
      //  }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

        public function patientReport() {
     //   if ($this->ion_auth->in_group(array('Patient'))) {
      //      // // redirect('home/permission');  
      //  }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function calendar() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
       public function printNote() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('print_note', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
    
          public function consentForm() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('consent_form', $data);
        $this->load->view('home/footer'); // just the header file
    }
    
    
    

    public function addNewView() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            // // // redirect('home/permission');   
        }
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
      //  $this->load->view('add_new', $data);
	  $this->session->set_flashdata('existemail', 'Email already Exist  !');
	  $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }    
    
    public function allDocsView() {
        $data = array();
        $id = $this->input->get('patient');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $data['patient_materials_images'] = $this->patient_model->getPatientMaterialImagesByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('view_all_docs', $data);
        $this->load->view('home/footer'); // just the footer file
    }


public function addNew() {
    $id = $this->input->post('id');
    $redirect = $this->input->get('redirect');
    $name = $this->input->post('name');
    $first_name = $this->input->post('first_name');
    $deceased = $this->input->post('deceased');
    $last_name = $this->input->post('last_name');
    $middle_name = $this->input->post('middle_name');
    $password = $this->input->post('password');
    $sms = $this->input->post('sms');
    $doctor = $this->input->post('doctor');
    $address = $this->input->post('address');
    $phone = $this->input->post('phone');
    $phone2 = $this->input->post('phone2');
    $sex = $this->input->post('sex');
    $birthdate = $this->input->post('birthdate');
    $bloodgroup = $this->input->post('bloodgroup');
    $patient_type = $this->input->post('patient_type');
    $patient_id = $this->input->post('p_id');     
    $e_contact = $this->input->post('kin_name');
    $e_contact_phone = $this->input->post('kin_phone');
    $e_contact_relation = $this->input->post('kin_relations');
    $e_contact_email = $this->input->post('kin_email');       
    $blood_pressure2 = $this->input->post('blood_pressure2');       
    $first_time = $this->input->post('first_time');
    $ref_by = $this->input->post('ref_by');
    $ins_company = $this->input->post('ins_company');
    $hear_about_dir = $this->input->post('hear_about_dir');
    $hear_others = $this->input->post('hear_others');
    $reason_examination = $this->input->post('reason_examination');
    $physical_examination = $this->input->post('physical_examination');     
    $glaucoma = $this->input->post('glaucoma');
    $cataracts = $this->input->post('cataracts');
    $eye_surgery = $this->input->post('eye_surgery');
    $lazy_eye = $this->input->post('lazy_eye');
    $light_flashes = $this->input->post('light_flashes');
    $eye_injury = $this->input->post('eye_injury');
    $floaters = $this->input->post('floaters');       
    $thyroid_disease = $this->input->post('thyroid_disease');
    $sinusitis = $this->input->post('sinusitis');
    $hiv = $this->input->post('hiv');
    $sugar = $this->input->post('sugar');
    $diabetes = $this->input->post('diabetes');
    $asthma = $this->input->post('asthma');
    $respiratory_problem = $this->input->post('respiratory_problem');
    $taking_medications = $this->input->post('taking_medications');       
    $medications_yes = $this->input->post('medications_yes');
    $wearing_contact_lens = $this->input->post('wearing_contact_lens');
    $hours_screen_day = $this->input->post('hours_screen_day');
    $other_allergies = $this->input->post('other_allergies');       
    $wear_glasses = $this->input->post('wear_glasses');
    $worn_contacts = $this->input->post('worn_contacts');
    $contact_lens_yes = $this->input->post('contact_lens_yes');
    $contact_lens_hours = $this->input->post('contact_lens_hours');               
    $authorization = $this->input->post('authorization');
    $assignment = $this->input->post('assignment');
    $sign1 = $this->input->post('sign2');
    $location = $this->input->post('location');
    $occupation = $this->input->post('occupation');
    $referred_by = $this->input->post('referred_by');
    $comment_med_bp = $this->input->post('comment_med_bp');
    $comment_med_diabetes = $this->input->post('comment_med_diabetes');
    $current_user2 = $this->ion_auth->get_user_id();

    if (empty($patient_id)) {
        $patient_id = rand(10000, 1000000);
    }
   
    if (empty($name)) {
        $name = $first_name;
    }
    if ((empty($id))) {
        $add_date = date('d/m/y');
        $registration_time = time();
    } else {
        $add_date = $this->patient_model->getPatientById($id)->add_date;
        $registration_time = $this->patient_model->getPatientById($id)->registration_time;
    }

    $email = $this->input->post('email');
    if (empty($email)) {
        // $email = $patient_id.'@ispecs.com';
    }

    // Check for duplicate name and DOB combination (case-insensitive)
    if (empty($id)) { // Only for new patients
        if (!empty($first_name) && !empty($last_name) && !empty($birthdate)) {
            $this->db->where('LOWER(first_name)', strtolower($first_name));
            $this->db->where('LOWER(last_name)', strtolower($last_name));
            if (!empty($middle_name)) {
                $this->db->where('LOWER(middle_name)', strtolower($middle_name));
            } else {
                $this->db->where('middle_name', $middle_name); // Handle empty middle name
            }
            $this->db->where('birthdate', $birthdate);
            $name_dob_exists = $this->db->get('patient')->row();
            if ($name_dob_exists) {
                $this->session->set_flashdata('feedback', '<b style="color:red;">This Patient Name and Date of Birth Combination Already Exists</b>');
                redirect('patient');
            }
        }
    } else { // For updating patient
        // Check for duplicate name and DOB during update (case-insensitive)
        if (!empty($first_name) && !empty($last_name) && !empty($birthdate)) {
            $this->db->where('LOWER(first_name)', strtolower($first_name));
            $this->db->where('LOWER(last_name)', strtolower($last_name));
            if (!empty($middle_name)) {
                $this->db->where('LOWER(middle_name)', strtolower($middle_name));
            } else {
                $this->db->where('middle_name', $middle_name);
            }
            $this->db->where('birthdate', $birthdate);
            $this->db->where('id !=', $id); // Exclude the current patient
            $name_dob_exists = $this->db->get('patient')->row();
            if ($name_dob_exists) {
                $this->session->set_flashdata('feedback', '<b style="color:red;">This Patient Name and Date of Birth Combination Already Exists</b>');
                redirect('patient');
            }
        }
    }

    // Rest of your existing code for signature handling and form validation
    if (!empty($sign1)) {
        $folderPath = './Uploads/patient/signatures/'.$patient_id.'/';
        if(!is_dir($folderPath)){
            mkdir($folderPath, 0755, true);
        }       
        $image_parts = explode(";base64,", $_POST['sign2']); 
        $image_type_aux = explode("image/", $image_parts[0]); 
        $image_type = $image_type_aux[1]; 
        $image_base64 = base64_decode($image_parts[1]); 
        $patient_signature = $folderPath . uniqid() . '.'.$image_type; 
        file_put_contents($patient_signature, $image_base64);
    }

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('birthdate', 'Date of Birth', 'trim|required|xss_clean'); // Added birthdate validation
    $this->form_validation->set_rules('occupation', 'Occupation', 'trim|required|min_length[2]|max_length[100]|xss_clean');
    if (empty($id)) {
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[1]|max_length[100]|xss_clean');
    } 
    $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('address', 'Address', 'trim|min_length[2]|max_length[500]|xss_clean');
    $this->form_validation->set_rules('phone', 'Phone', 'trim|min_length[6]|max_length[50]|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        if (!empty($id)) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect("patient/editPatient?id=$id");
        } else {
            $data = array();
            $data['setval'] = 'setval';
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['groups'] = $this->donor_model->getBloodBank();
            $this->load->view('home/dashboard');
            $this->session->set_flashdata('feedback', 'Validation Error !');
            $this->load->view('patient', $data);
            $this->load->view('home/footer');
        }
    } else {
        if ($sex === 'Female'){
            $new_file_name = 'female.jpg';
        } else {
            $new_file_name = 'male.jpg';
        }

        $config = array(
            'file_name' => $new_file_name,
            'upload_path' => "./Uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
            'overwrite' => False,
            'max_size' => "1004800000",
            'max_height' => "1768",
            'max_width' => "2024"
        );
        $img_url = "/Uploads/" . $new_file_name;
        $this->load->library('Upload', $config);
        $this->upload->initialize($config);

        $data = array(
            'patient_id' => $patient_id,
            'img_url' => $img_url,
            'name' => $name,
            'first_name' => $first_name,
            'deceased' => $deceased,
            'last_name' => $last_name,
            'middle_name' => $middle_name,
            'email' => $email,
            'address' => $address,
            'doctor' => $doctor,
            'phone' => $phone,
            'phone2' => $phone2,
            'sex' => $sex,
            'birthdate' => $birthdate,
            'bloodgroup' => $bloodgroup,
            'patient_type' => $patient_type,
            'add_date' => $add_date,
            'registration_time' => $registration_time,                   
            'e_contact' => $e_contact,
            'e_contact_phone' => $e_contact_phone,
            'e_contact_relation' => $e_contact_relation,
            'e_contact_email' => $e_contact_email,                   
            'blood_pressure2' => $blood_pressure2,                                        
            'first_time' => $first_time,
            'ref_by' => $ref_by,
            'ins_company' => $ins_company,
            'hear_about_dir' => $hear_about_dir,                   
            'hear_others' => $hear_others,
            'reason_examination' => $reason_examination,
            'physical_examination' => $physical_examination,
            'glaucoma' => $glaucoma,
            'cataracts' => $cataracts,
            'eye_surgery' => $eye_surgery,
            'lazy_eye' => $lazy_eye,                   
            'light_flashes' => $light_flashes,
            'eye_injury' => $eye_injury,
            'floaters' => $floaters,
            'thyroid_disease' => $thyroid_disease,
            'sinusitis' => $sinusitis,
            'hiv' => $hiv,                   
            'sugar' => $sugar,                   
            'diabetes' => $diabetes,
            'asthma' => $asthma,
            'respiratory_problem' => $respiratory_problem,
            'taking_medications' => $taking_medications,
            'medications_yes' => $medications_yes,
            'wearing_contact_lens' => $wearing_contact_lens,
            'hours_screen_day' => $hours_screen_day,
            'other_allergies' => $other_allergies,                   
            'wear_glasses' => $wear_glasses,
            'worn_contacts' => $worn_contacts,
            'contact_lens_yes' => $contact_lens_yes,               
            'contact_lens_hours' => $contact_lens_hours,                                        
            'authorization' => $authorization,                                       
            'location' => $location,                                       
            'assignment' => $assignment,                                       
            'signature' => $patient_signature,                                       
            'added_by' => $current_user2,
            'occupation' => $occupation,
            'referred_by' => $referred_by,
            'comment_med_bp' => $comment_med_bp,
            'comment_med_diabetes' => $comment_med_diabetes                                      
        );

        $username = $this->input->post('name');
        $first_name1 = $this->input->post('first_name');
        $last_name1 = $this->input->post('last_name');

        if (empty($id)) {    // Adding New Patient
            $dfg = 5;
            // Note: ion_auth->register might still fail if the email exists in the 'users' table.
            // You may need to adjust Ion Auth's configuration or logic if you want duplicate emails there as well.
            // For now, this code assumes you handle that or that it's acceptable.
            if (!$this->ion_auth->email_check($email)) {
                $this->ion_auth->register($username, $password, $email, $first_name1, $last_name1, $dfg);
            }
            $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
            $this->patient_model->insertPatient($data);
            $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
            $id_info = array('ion_user_id' => $ion_user_id);
            $this->patient_model->updatePatient($patient_user_id, $id_info);

            if (!empty($sms)) {
                $this->sms->sendSmsDuringPatientRegistration($patient_user_id);
            }
            $this->session->set_flashdata('feedback', 'Added');
        } else { // Updating Patient
            $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->patient_model->updateIonUser($username, $email, $password, $first_name1, $last_name1, $ion_user_id);
            $this->patient_model->updatePatient($id, $data);
            $this->session->set_flashdata('feedback', 'Updated');
        }

        if (!empty($redirect)) {
            redirect('finance/addPaymentView');
        } else {
            redirect('patient');
        }
    }
}

    
public function EditPatientSet() {
    $id = $this->input->post('id');
    $p_id = $this->input->post('p_id');

    // Prepare data array
    $data = array(
        'name' => $this->input->post('name'),
        'first_name' => $this->input->post('first_name'),
        'middle_name' => $this->input->post('middle_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
        'address' => $this->input->post('address'),
        'phone' => $this->input->post('phone'),
        'phone2' => $this->input->post('phone2'),
        'sex' => $this->input->post('sex'),
        'birthdate' => $this->input->post('birthdate'),
        'doctor' => $this->input->post('doctor'),
        'deceased' => $this->input->post('deceased'),
        'location' => $this->input->post('location'),
        // Medical history fields
        'patient_type' => $this->input->post('patient_type'),
        'blood_pressure2' => $this->input->post('blood_pressure2'),
        'first_time' => $this->input->post('first_time'),
        'ref_by' => $this->input->post('ref_by'),
        'ins_company' => $this->input->post('ins_company'),
        'hear_about_dir' => $this->input->post('hear_about_dir'),
        'hear_others' => $this->input->post('hear_others'),
        'reason_examination' => $this->input->post('reason_examination'),
        'physical_examination' => $this->input->post('physical_examination'),
        'glaucoma' => $this->input->post('glaucoma'),
        'cataracts' => $this->input->post('cataracts'),
        'eye_surgery' => $this->input->post('eye_surgery'),
        'lazy_eye' => $this->input->post('lazy_eye'),
        'light_flashes' => $this->input->post('light_flashes'),
        'eye_injury' => $this->input->post('eye_injury'),
        'floaters' => $this->input->post('floaters'),
        'sick_others' => $this->input->post('sick_others'),
        'thyroid_disease' => $this->input->post('thyroid_disease'),
        'sinusitis' => $this->input->post('sinusitis'),
        'hiv' => $this->input->post('hiv'),
        'sugar' => $this->input->post('sugar'),
        'diabetes' => $this->input->post('diabetes'),
        'asthma' => $this->input->post('asthma'),
        'respiratory_problem' => $this->input->post('respiratory_problem'),
        'problem_others' => $this->input->post('problem_others'),
        'taking_medications' => $this->input->post('taking_medications'),
        'medications_yes' => $this->input->post('medications_yes'),
        'wearing_contact_lens' => $this->input->post('wearing_contact_lens'),
        'allergies_list' => $this->input->post('allergies_list'),
        'other_allergies' => $this->input->post('other_allergies'),
        'wear_glasses' => $this->input->post('wear_glasses'),
        'worn_contacts' => $this->input->post('worn_contacts'),
        'contact_lens_yes' => $this->input->post('contact_lens_yes'),
        'contact_lens_hours' => $this->input->post('contact_lens_hours'),
        'authorization' => $this->input->post('authorization'),
        'assignment' => $this->input->post('assignment'),
        'e_contact' => $this->input->post('kin_name'),
        'e_contact_relation' => $this->input->post('kin_relations'),
        'e_contact_phone' => $this->input->post('kin_phone'),
        'e_contact_email' => $this->input->post('kin_email')
    );

    // Handle password update
    $password = $this->input->post('password');
    if (!empty($password)) {
        $this->ion_auth->update($this->db->get_where('patient', array('id' => $id))->row()->ion_user_id, array('password' => $password));
    }

    // Handle image upload
    if (!empty($_FILES['img_url']['name'])) {
        $config['upload_path'] = './Uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['file_name'] = 'patient_' . $id . '_' . time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img_url')) {
            $upload_data = $this->upload->data();
            $data['img_url'] = '/uploads/' . $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }
    }

    // Update patient record
    $this->db->where('id', $id);
    $this->db->update('patient', $data);

    // Handle SMS notification
    if ($this->input->post('sms') == 'sms') {
        $patient_phone = $this->input->post('phone');
        $message = "Your patient details have been updated successfully.";
        $this->sms_model->send_sms($patient_phone, $message);
    }

    $this->session->set_flashdata('feedback', lang('patient_updated'));
    redirect('patient');
}

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
		$this->session->set_flashdata('feedback', 'Validation Error !');	
       // $this->load->view('add_new', $data);
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }

    function getPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);

        $doctor = $data['patient']->doctor;
        $data['doctor'] = $this->doctor_model->getDoctorById($doctor);

        if (!empty($data['patient']->birthdate)) {
            $birthDate = strtotime($data['patient']->birthdate);
            $birthDate = date('d/m/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        echo json_encode($data);
    }

    function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function report() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addDiagnosticReport() {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $patient = $this->input->post('patient');
        $report = $this->input->post('report');

        $date = time();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        // Validating Name Field
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect('patient/report?id=' . $invoice);
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'invoice' => $invoice,
                'date' => $date,
                'report' => $report
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertDiagnosticReport($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateDiagnosticReport($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('patient/report?id=' . $invoice);
        }
    }

    function patientPayments() {
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_payments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function caseList() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function documents() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['files'] = $this->patient_model->getPatientMaterial();
        $data['files_images'] = $this->patient_model->getPatientMaterialImages();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('documents', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myCaseList() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_case_list', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myDocuments() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['files'] = $this->patient_model->getPatientMaterialByPatientId($patient_id);
            $data['files_images'] = $this->patient_model->getPatientMaterialImagesByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_documents', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myPrescription() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($patient_id);
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('my_prescription', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    public function myPayment() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_payment', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    function myPaymentHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient);
            $data['pharmacy_payments'] = $this->pharmacy_model->getPaymentByPatientId($patient);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByPatientId($patient);
            $data['deposits'] = $this->finance_model->getDepositByPatientId($patient);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('my_payments_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function deposit() {
        $id = $this->input->post('id');


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        } else {
            $this->session->set_flashdata('feedback', 'Undefined Patient Id');
            redirect('patient/myPaymentsHistory');
        }



        $payment_id = $this->input->post('payment_id');
        $date = time();

        $deposited_amount = $this->input->post('deposited_amount');

        $deposit_type = $this->input->post('deposit_type');

        if ($deposit_type != 'Card') {
            $this->session->set_flashdata('feedback', 'Undefined Payment Type');
            redirect('patient/myPaymentsHistory');
        }

        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
// Validating Patient Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
// Validating Deposited Amount Field
        $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('patient/myPaymentsHistory');
        } else {
            $data = array();
            $data = array('patient' => $patient,
                'date' => $date,
                'payment_id' => $payment_id,
                'deposited_amount' => $deposited_amount,
                'deposit_type' => $deposit_type,
                'user' => $user
            );
			
			$patient_details=$this->patient_model->getPatientById($patient);
            if (empty($id)) {
                $data_logs=array(
                    'date_time'=>date('d-m-Y H:i'),
                    'patientname'=>$patient_details->name,
                    'invoice_id'=>$payment_id,
                    'action'=>'Added/deposited',
                    'deposit_type'=>$deposit_type,
                     'amount'=>$deposited_amount,
                     'user'=>$this->ion_auth->get_user_id()
    
    
                );
			}
            if (empty($id)) {
                if ($deposit_type == 'Card') {
                    $payment_details = $this->finance_model->getPaymentById($payment_id);
                    $gateway = $this->settings_model->getSettings()->payment_gateway;
                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');

                        $all_details = array(
                            'patient' => $payment_details->patient,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'doctor' => $payment_details->doctor_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'patient_name' => $payment_details->patient_name,
                            'patient_first_name' => $payment_details->patient_first_name,
                            'patient_last_name' => $payment_details->patient_last_name,
                            'patient_phone' => $payment_details->patient_phone,
                            'patient_address' => $payment_details->patient_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'patient_payment_details',
                            'user' => $user
                        );
                        $this->paypal->Do_direct_payment($all_details);
						$this->logs_model->insertTransactionLogs($data_logs);
                    } elseif ($gateway == 'Pay U Money') {
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                    } else {
                        $this->session->set_flashdata('feedback', 'Payment failed. No Gateway Selected');
                        redirect('patient/myPaymentHistory');
                    }
                } else {
                    $this->finance_model->insertDeposit($data);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else {
				$data_logs=array(
                    'date_time'=>date('d-m-Y H:i'),
                    'patientname'=>$patient_details->name,
                    'invoice_id'=>$payment_id,
                    'action'=>'Updated/deposited',
                    'deposit_type'=>$deposit_type,
                    'amount'=>$deposited_amount,
                    'user'=>$this->ion_auth->get_user_id()
					);
					
                $this->finance_model->updateDeposit($id, $data);
				$this->logs_model->insertTransactionLogs($data_logs);
                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('patient/myPaymentHistory');
        }
    }

    function myInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function addMedicalHistory() {
    $id = $this->input->post('id');
    $patient_id = $this->input->post('patient_id');
    $doc_id = $this->input->post('doctors_id');
    $doc_signed = $this->input->post('doc_signed');
    $date = $this->input->post('date');
    $title = $this->input->post('title');
    $description = $this->input->post('description');

    // ADDED: Get the new form fields
    $age = $this->input->post('age');
    $med_history = $this->input->post('med_history');
    $medications = $this->input->post('medications');
    $hand_notes = $this->input->post('hand_notes');
    $canvas_left_data = $this->input->post('canvas_left_data');
    $canvas_right_data = $this->input->post('canvas_right_data');


    if (!empty($date)) {
        $date = strtotime($date);
    } else {
        $date = time();
    }

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $redirect = $this->input->post('redirect');
    if (empty($redirect)) {
        $redirect = 'patient/medicalHistory?id=' . $patient_id;
    }

    // Validation rules
    $this->form_validation->set_rules('date', 'Date', 'trim|xss_clean');
    $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');
    $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

    // ADDED: Validation for new fields
    $this->form_validation->set_rules('age', 'Age', 'trim|xss_clean');
    $this->form_validation->set_rules('med_history', 'Medical History', 'trim|xss_clean');
    $this->form_validation->set_rules('medications', 'Medications', 'trim|xss_clean');
    $this->form_validation->set_rules('hand_notes', 'Handwritten Notes', 'trim|xss_clean');
    $this->form_validation->set_rules('canvas_left_data', 'Left Eye Canvas', 'trim');
    $this->form_validation->set_rules('canvas_right_data', 'Right Eye Canvas', 'trim');


    if ($this->form_validation->run() == FALSE) {
        if (!empty($id)) {
            redirect("patient/editMedicalHistory?id=$id");
        } else {
            $this->load->view('home/dashboard'); // just the header file
            $this->session->set_flashdata('feedback', 'Validation Error !');
            $this->load->view('medical_history');
            $this->load->view('home/footer'); // just the header file
        }
    } else {
        if (!empty($patient_id)) {
            $patient_details = $this->patient_model->getPatientById($patient_id);
            $patient_name = $patient_details->name;
            $patient_first_name = $patient_details->first_name;
            $patient_last_name = $patient_details->last_name;
            $patient_phone = $patient_details->phone;
            $patient_address = $patient_details->address;
        } else {
            $patient_name = 0;
            $patient_first_name = 0;
            $patient_last_name = 0;
            $patient_phone = 0;
            $patient_address = 0;
        }

        if (!empty($doc_signed)) {
            $folderPath = './uploads/patient/doc_notepad/'.$patient_id.'/';
            if(!is_dir($folderPath)){
                mkdir($folderPath, 0755, true);
            }
            $image_parts = explode(";base64,", $_POST['doc_signed']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $doc_noted = $folderPath . uniqid() . '.'.$image_type;
            file_put_contents($doc_noted, $image_base64);
        }

        if (!empty($doc_id)) {
            $doc_details = $this->doctor_model->getDoctorById($doc_id);
            $doctor_name = $doc_details->name;
        } else {
            $doctor_name = "";
        }

        $data = array();
        $data = array(
            'patient_id' => $patient_id,
            'date' => $date,
            'title' => $title,
            'description' => $description,
            'patient_name' => $patient_name,
            'patient_first_name' => $patient_first_name,
            'patient_last_name' => $patient_last_name,
            'patient_phone' => $patient_phone,
            'patient_address' => $patient_address,
            'doctor_name' => $doctor_name,
            'doc_notepad' => $doc_noted,
            // ADDED: New data for database insertion
            'age' => $age,
            'med_history' => $med_history,
            'medications' => $medications,
            'hand_notes' => $hand_notes,
            'canvas_left_data' => $canvas_left_data,
            'canvas_right_data' => $canvas_right_data
        );

        if (empty($id)) {
            $this->patient_model->insertMedicalHistory($data);
            $this->session->set_flashdata('feedback', 'Added');
        } else {
            $this->patient_model->updateMedicalHistory($id, $data);
            $this->session->set_flashdata('feedback', 'Updated');
        }
        redirect($redirect);
    }
}
	function addNurseNotes() {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');

        $date = $this->input->post('date');

        $title = $this->input->post('title');

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
		
		$head_circle = $this->input->post('head_circle');
		$bmi = $this->input->post('bmi');
		
		$length = $this->input->post('length');
		$pulse = $this->input->post('pulse');
		$blood_pressure = $this->input->post('blood_pressure');
		$temperature = $this->input->post('temperature');
		$weight = $this->input->post('weight');
		$oxygen = $this->input->post('oxygen');
		$rgb = $this->input->post('rgb');
		$height = $this->input->post('height');
		$glasses = $this->input->post('glasses');
		$nonhaem = $this->input->post('nonhaem');
		$blood = $this->input->post('blood');
		$billirubin = $this->input->post('billirubin');
		$urobilinogen = $this->input->post('urobilinogen');
		$ketone = $this->input->post('ketone');
		$protein = $this->input->post('protein');
		$nitrate = $this->input->post('nitrate');
		$glucose = $this->input->post('glucose');
		$ph = $this->input->post('ph');
		$gravity = $this->input->post('gravity');
		$leucocytes = $this->input->post('leucocytes');
		$nurse_id = $this->input->post('nurses_id');
		//$add_notes = $this->input->post('add_notes');
		
        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
      //  $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
     //   $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }            
			if (!empty($nurse_id)) {
                $nurse_details = $this->nurse_model->getNurseById($nurse_id);
                $nurse_name = $nurse_details->name;
            } else {
                $nurse_name = "";
            }

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'title' => $title,
                'description' => $description,
                'patient_name' => $patient_name,
                'patient_first_name' => $patient_first_name,
                'patient_last_name' => $patient_last_name,
                'patient_phone' => $patient_phone,
                'patient_address' => $patient_address,
                'head_circle' => $head_circle,
                'bmi' => $bmi,
				'blood_pressure' =>	$blood_pressure,
                'length' => $length,
                'pulse' => $pulse,
                'temperature' => $temperature,
                'weight' => $weight,
                'oxygen' => $oxygen,
                'rgb' => $rgb,
                'height' => $height,
                'glasses' => $glasses,
                'nonhaem' => $nonhaem,
                'blood' => $blood,
                'billirubin' => $billirubin,
                'urobilinogen' => $urobilinogen,
                'ketone' => $ketone,
                'protein' => $protein,
                'nitrate' => $nitrate,
                'glucose' => $glucose,
                'ph' => $ph,
                'gravity' => $gravity,
                'leucocytes' => $leucocytes,
                'nurse_name' => $nurse_name,
            );		
            if (empty($id)) {     // Adding New department
                $this->patient_model->insertNurseNotes($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateNurseNotes($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect);
        }
    }	

	
	function addReferralNew() {
    $id = $this->input->post('id');
    $patient_id = $this->input->post('patient_id');
    $date = $this->input->post('date');
    $ref_doctor = $this->input->post('ref_doctor');
    $doctor = $this->input->post('doctor');
    $doctor_nominals = $this->input->post('doctor_nom');
    $full_name = $this->input->post('full_name');
    $age = $this->input->post('age');
    $past_ocular_history = $this->input->post('past_ocular_history');
    $r_rx = $this->input->post('r_rx');
    $l_rx = $this->input->post('l_rx');  // Fixed: was previously overwriting r_rx
    $r_visual_acuity = $this->input->post('r_visual_acuity');
    $l_visual_acuity = $this->input->post('l_visual_acuity');
    $r_intra_pressure = $this->input->post('r_intra_pressure');
    $l_intra_pressure = $this->input->post('l_intra_pressure');
    $r_ant_segment = $this->input->post('r_ant_segment');
    $l_ant_segment = $this->input->post('l_ant_segment');
    $r_lens = $this->input->post('r_lens');
    $l_lens = $this->input->post('l_lens');
    $r_fundoscopy = $this->input->post('r_fundoscopy');
    $l_fundoscopy = $this->input->post('l_fundoscopy');
    $general_comment = $this->input->post('general_comment');
    $patient = $this->input->post('patient');
    $user_name = $this->input->post('user_name');
    
    // Handle signature file upload
    $file_img = $this->input->post('file_img');
    $patient_referral_img = '';
    
    if (!empty($date)) {
        $date = strtotime($date);
    } else {
        $date = time();
    }
    
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $redirect = $this->input->post('redirect');
    if (empty($redirect)) {
        $redirect = 'patient/medicalHistory?id=' . $patient_id;
    }

    // Validating Name Field
    $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

    // Process signature image if provided
    if (!empty($file_img)) {
        $folderPath = './uploads/doctor/reffa/'.$patient_id.'/';
        
        // Check if the directory already exists
        if(!is_dir($folderPath)){
            // Directory does not exist, so create it
            mkdir($folderPath, 0755, true);
        }
        
        $image_parts = explode(";base64,", $file_img); 
        $image_type_aux = explode("image/", $image_parts[0]); 
        $image_type = $image_type_aux[1]; 
        $image_base64 = base64_decode($image_parts[1]); 
        $patient_referral_img = $folderPath . uniqid() . '.'.$image_type; 
        file_put_contents($patient_referral_img, $image_base64);
    }

    $this->form_validation->set_rules('ref_doctor', 'Referring Doctor', 'trim|xss_clean');
    $this->form_validation->set_rules('general_comment', 'General Comment', 'trim|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        if (!empty($id)) {
            redirect("patient/editMedicalHistory?id=$id");
        } else {
            $this->load->view('home/dashboard');
            $this->load->view('add_new');
            $this->load->view('home/footer');
        }
    } else {

        if (!empty($patient_id)) {
            $patient_details = $this->patient_model->getPatientById($patient_id);
            $patient_name = $patient_details->name;
            $patient_first_name = $patient_details->first_name;
            $patient_last_name = $patient_details->last_name;
            $patient_phone = $patient_details->phone;
            $patient_address = $patient_details->address;
        } else {
            $patient_name = 0;
            $patient_first_name = 0;
            $patient_last_name = 0;
            $patient_phone = 0;
            $patient_address = 0;
        }
        
        if (!empty($nurse_id)) {
            $nurse_details = $this->nurse_model->getNurseById($nurse_id);
            $nurse_name = $nurse_details->name;
        } else {
            $nurse_name = "";
        }

        $data = array();
        $data = array(
            'patient_id' => $patient_id,
            'date' => $date,
            'ref_doctor' => $ref_doctor,
            'doctor' => $doctor,
            'doctor_nominals' => $doctor_nominals,
            'full_name' => $full_name,
            'age' => $age,
            'past_ocular_history' => $past_ocular_history,
            'r_rx' => $r_rx,
            'l_rx' => $l_rx,
            'r_visual_acuity' => $r_visual_acuity,
            'l_visual_acuity' => $l_visual_acuity,
            'r_intra_pressure' => $r_intra_pressure,
            'l_intra_pressure' => $l_intra_pressure,
            'r_ant_segment' => $r_ant_segment,
            'l_ant_segment' => $l_ant_segment,
            'r_lens' => $r_lens,
            'l_lens' => $l_lens,
            'r_fundoscopy' => $r_fundoscopy,
            'l_fundoscopy' => $l_fundoscopy,
            'general_comment' => $general_comment,
            'user_name' => $user_name,
            'patient' => $patient,
            'file_img' => $patient_referral_img  // Add the signature image path
        );
        
        if (empty($id)) {     // Adding New referral
            $this->patient_model->insertReferralNew($data);
            $this->session->set_flashdata('feedback', 'Added');
        } else { // Updating referral
            $this->patient_model->updateReferralNew($id, $data);
            $this->session->set_flashdata('feedback', 'Updated');
        }
        // Loading View
        redirect($redirect);
    }
}
	  
	function addSickLeave() {
        $id = $this->input->post('id');
		$patient_id = $this->input->post('patient_id');
		$location = $this->input->post('location');
        $sick_days = $this->input->post('sick_days');
        $patient_name = $this->input->post('patient_name');
        $first_name = $this->input->post('first_name');
        $middle_name = $this->input->post('middle_name');
        $doctor_name = $this->input->post('doctor_name');
        $doctor_id = $this->input->post('doctor_id');
        $doctor_nominals = $this->input->post('doctor_nominals');
        $doctor_lic = $this->input->post('doctor_lic');
        $last_name = $this->input->post('last_name');
        $days = $this->input->post('sick_days');
        $start_date = $this->input->post('begin_date');
        $description = $this->input->post('description');
		
        $date = date("Y-m-d h:i:sa");
		$doctor_sign = $this->input->post('doctor_sign');
		
		if (isset($doctor_sign)){$d_sign = 'Yes';}else{$d_sign = 'No';}
		$recept_id = $this->input->post('recept_id');

		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
      //  $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
     //   $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

  if (!empty($doctor_sign)) {
			$folderPath = './uploads/doctor/sickleave/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($folderPath)){
					//Directory does not exist, so lets create it.
					mkdir($folderPath, 0755, true);
				}            
				$image_parts = explode(";base64,", $_POST['doctor_sign']); 
				$image_type_aux = explode("image/", $image_parts[0]); 
				$image_type = $image_type_aux[1]; 
				$image_base64 = base64_decode($image_parts[1]); 
				$patient_sickleave = $folderPath . uniqid() . '.'.$image_type; 
				file_put_contents($patient_sickleave, $image_base64);
	}   

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
            } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;

            }            
			if (!empty($recept_id)) {
                $nurse_details = $this->patient_model->getUsersById($recept_id);
                $nurse_name = $nurse_details->username;
            } else {
                $nurse_name = "";
            }

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'location' => $location,
                'patient_name' => $patient_name,
                'patient_first_name' => $first_name,
                'patient_last_name' => $last_name,
                'patient_middle_name' => $middle_name,
                'doctor_name' => $doctor_name,
                'days' => $days,
                'start_date' => $start_date,
                'description' => 'Medical Leave Request',
                'doctor_id' => $doctor_id,
                'doctor_sign' => $patient_sickleave,
                'postnomials' => $doctor_nominals,
                'lic_number' => $doctor_lic,
                'd_sign' => $d_sign
				);		
				
            if (empty($id)) {     // Adding New survey
                $this->patient_model->insertSickLeave($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating survey
                $this->patient_model->updateSickLeave($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect); 
        }
    }    
	
	
	function addConsentForms() {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');
        $date = date("Y-m-d h:i:sa");

		$consent_date = $this->input->post('date');
		$consent_name = $this->input->post('consent_name');
		$consent_sign = $this->input->post('consent_sign');
			if (isset($consent_sign)){$c_sign = 'Yes';}else{$c_sign = 'No';}
		$disclaim_date = $this->input->post('disclaim_date');
		$disclaim_name = $this->input->post('disclaim_name');
		$disclaim_sign = $this->input->post('disclaim_sign');
			if (isset($disclaim_sign)){$d_sign = 'Yes';}else{$d_sign = 'No';}
		$recept_id = $this->input->post('recept_id');
		$location = $this->input->post('location');
		$form_type = $this->input->post('form_type');

		
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
      //  $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
     //   $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

  if (!empty($consent_sign)) {
			$folderPath = './uploads/patient/consent/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($folderPath)){
					//Directory does not exist, so lets create it.
					mkdir($folderPath, 0755, true);
				}            


				$image_parts = explode(";base64,", $_POST['consent_sign']); 
				$image_type_aux = explode("image/", $image_parts[0]); 
				$image_type = $image_type_aux[1]; 
				$image_base64 = base64_decode($image_parts[1]); 
				$patient_consent = $folderPath . uniqid() . '.'.$image_type; 
				file_put_contents($patient_consent, $image_base64);
	}   
	
	if (!empty($disclaim_sign)) {
			$folderPathd = './uploads/patient/disclaimer/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($folderPathd)){
					//Directory does not exist, so lets create it.
					mkdir($folderPathd, 0755, true);
				}            


				$image_partsd = explode(";base64,", $_POST['disclaim_sign']); 
				$image_type_auxd = explode("image/", $image_partsd[0]); 
				$image_typed = $image_type_auxd[1]; 
				$image_based64 = base64_decode($image_partsd[1]); 
				$patient_disclaimer = $folderPathd . uniqid() . '.'.$image_typed; 
				file_put_contents($patient_disclaimer, $image_based64);
	} 



        $this->form_validation->set_rules('consent_name', 'Consent Name', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
            } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;

            }            
			if (!empty($recept_id)) {
                $nurse_details = $this->patient_model->getUsersById($recept_id);
                $nurse_name = $nurse_details->username;
            } else {
                $nurse_name = "";
            }

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'patient_name' => $patient_name,
                'patient_first_name' => $patient_first_name,
                'patient_last_name' => $patient_last_name,
                'consent_date' => $consent_date,
                'consent_name' => $consent_name,
				'disclaim_name' =>	$disclaim_name,
                'consent_sign' => $patient_consent,
                'c_sign' => $c_sign,
                'disclaim_date' => $disclaim_date,
                'disclaim_sign' => $patient_disclaimer,
                'd_sign' => $d_sign,
                'form_type' => $form_type,					
                'location' => $location,					
               'nurse_name' => $nurse_name
            );		
            if (empty($id)) {     // Adding New survey
                $this->patient_model->insertConsentForms($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating survey
                $this->patient_model->updateConsentForms($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect); 
        }
    }    
	
	function addDoctorNotes() {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');
		$location = $this->input->post('location');
        $date = $this->input->post('date');
        $doc_signed = $this->input->post('doc_signed');

        $title = $this->input->post('title');

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }

        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|xss_clean');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|xss_clean');

        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }
            
  if (!empty($doc_signed)) {
			$folderPath = './uploads/patient/doc_notepad/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($folderPath)){
					//Directory does not exist, so lets create it.
					mkdir($folderPath, 0755, true);
				}            


				$image_parts = explode(";base64,", $_POST['doc_signed']); 
				$image_type_aux = explode("image/", $image_parts[0]); 
				$image_type = $image_type_aux[1]; 
				$image_base64 = base64_decode($image_parts[1]); 
				$patient_signature = $folderPath . uniqid() . '.'.$image_type; 
				file_put_contents($patient_signature, $image_base64);
	}          

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'date' => $date,
                'title' => $title,
                'description' => $description,
                'patient_name' => $patient_name,
                'patient_first_name' => $patient_first_name,
                'patient_last_name' => $patient_last_name,
                'patient_phone' => $patient_phone,
				'location' => $location,
                'patient_address' => $patient_address,
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertDoctorNotes($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating department
                $this->patient_model->updateDoctorNotes($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect($redirect);
        }
    }

    public function diagnosticReport() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            $current_user = $this->ion_auth->get_user_id();
            $patient_user_id = $this->patient_model->getPatientByIonUserId($current_user)->id;
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_user_id);
        } else {
            $data['payments'] = $this->finance_model->getPayment();
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

//NEW SICK LEAVE VIEW
function SickLeaveView(){
    
        $data = array();
        $id = $this->input->get('id');
        
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('sick_leave_view', $data);
        $this->load->view('home/footer'); // just the footer file

}
    function medicalHistory() {
        $data = array();
        $id = $this->input->get('id');

   /*    if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }*/

        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['appointments'] = $this->appointment_model->getAppointmentByPatient($data['patient']->id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->patient_model->getPrescriptionByPatientId($id);
        $data['labs'] = $this->lab_model->getLabByPatientId($id);
        $data['beds'] = $this->bed_model->getBedAllotmentsByPatientId($id);
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id); 
        $data['patient_materials_images'] = $this->patient_model->getPatientMaterialImagesByPatientId($id);         
		
		$data['patient_octs'] = $this->patient_model->getPatientOctByPatientId($id); 
        $data['patient_octs_images'] = $this->patient_model->getPatientOctImagesByPatientId($id); 		
		$data['patient_photographs'] = $this->patient_model->getPatientPhotographByPatientId($id); 
        $data['patient_photographs_images'] = $this->patient_model->getPatientPhotographImagesByPatientId($id); 		
		$data['patient_results'] = $this->patient_model->getPatientResultByPatientId($id); 
        $data['patient_results_images'] = $this->patient_model->getPatientResultImagesByPatientId($id);  		
		$data['patient_referals'] = $this->patient_model->getPatientReferalByPatientId($id); 
		$data['patient_referrals_new'] = $this->patient_model->getReferralNewByPatientId($id); 
        $data['patient_referals_images'] = $this->patient_model->getPatientReferalImagesByPatientId($id);  
		
        $data['patient_refractions'] = $this->patient_model->getPatientRefractionByPatientId($id); 
        $data['patient_refractions_images'] = $this->patient_model->getPatientRefractionImagesByPatientId($id); 

		
		$data['nurse_notes'] = $this->patient_model->getNurseNotesByPatientId($id);        
		$data['consent_forms'] = $this->patient_model->getConsentFormsByPatientId($id);        
		$data['doctor_notes'] = $this->patient_model->getDoctorNotesByPatientId($id);
		
		$data['sick_leave'] = $this->patient_model->getSickLeaveByPatientId($id);



        foreach ($data['appointments'] as $appointment) {
            $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$appointment->date + 1] = '<div class="panel-body profile-activity" >
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['prescriptions'] as $prescription) {
            $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$prescription->date + 2] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('prescription') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $prescription->date) . '</h5>
                                            <div class="activity purple">
                                                <span>
                                                    <i class="fa fa-medkit"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $prescription->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <a class="btn btn-info btn-xs detailsbutton" title="View" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> View</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['labs'] as $lab) {

            $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_details)) {
                $lab_doctor = $doctor_details->name;
            } else {
                $lab_doctor = '';
            }

            $timeline[$lab->date + 3] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('lab') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $lab->date) . '</h5>
                                            <div class="activity blue">
                                                <span>
                                                    <i class="fa fa-flask"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $lab->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-user-md"></i>
                                                                <h4>' . $lab_doctor . '</h4>
                                                                    <a class="btn btn-xs invoicebutton" title="Lab" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file-text"></i>' . lang('report') . '</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['medical_histories'] as $medical_history) {
            $timeline[$medical_history->date + 4] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('case_history') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $medical_history->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $medical_history->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $medical_history->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['patient_materials'] as $patient_material) {
            $timeline[$patient_material->date + 5] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('documents') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $patient_material->date) . '</h5>
                                            <div class="activity purplee">
                                                <span>
                                                    <i class="fa fa-file-o"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $patient_material->date) . ' <a class="pull-right" title="' . lang('download') . '"  href="' . $patient_material->url . '" download=""> <i class=" fa fa-download"></i> </a> </h4>
                                                                
                                                                 <h4>' . $patient_material->title . '</h4>
                                                            
                                                                
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }        
		foreach ($data['patient_refractions'] as $patient_refraction) {
            $timeline[$patient_refraction->date + 5] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('refractions') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $patient_refraction->date) . '</h5>
                                            <div class="activity purplee">
                                                <span>
                                                    <i class="fa fa-file-o"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $patient_refraction->date) . ' <a class="pull-right" title="' . lang('download') . '"  href="' . $patient_refraction->url . '" download=""> <i class=" fa fa-download"></i> </a> </h4>
                                                                
                                                                 <h4>' . $patient_refraction->title . '</h4>
                                                            
                                                                
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }
		
		        foreach ($data['nurse_notes'] as $nurse_notes) {
            $timeline[$nurse_notes->date + 6] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">Nurse Notes</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $nurse_notes->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $nurse_notes->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $nurse_notes->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }		        
		
		foreach ($data['consent_forms'] as $consent_forms) {
            $timeline[$consent_forms->date] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">Consent Forms</span></h5>
                                            <h5 class="pull-right">' . $consent_forms->date . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . $consent_forms->date . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                             <p> Location -('.$consent_forms->location
                                                            .'),<br> DATE OF CONSENT -('.$consent_forms->consent_date
															.'),<br> CONSENT NAME -('.$consent_forms->consent_name
															.'),<br> CONSENT SIGNATURE -('.$consent_forms->c_sign
															.'),<br> DATE OF DISCLAIMER -('.$consent_forms->disclaim_date
															.'),<br> DISCLAIMER NAME-('.$consent_forms->disclaim_name
															.'),<br> DISCLAIMER SIGNATURE-('.$consent_forms->d_sign
															.')</p>	
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }
		
		        foreach ($data['doctor_notes'] as $doctor_notes) {
            $timeline[$doctor_notes->date + 7] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">Doctor Notes</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $doctor_notes->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $doctor_notes->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $doctor_notes->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        if (!empty($timeline)) {
            $data['timeline'] = $timeline;
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editMedicalHistoryByJason() {
        $id = $this->input->get('id');
        $data['medical_history'] = $this->patient_model->getMedicalHistoryById($id);
        echo json_encode($data);
    }    
	
	function editSickLeaveByJason() {
        $id = $this->input->get('id');
        $data['patient_sickleave'] = $this->patient_model->getSickLeaveById($id);
        echo json_encode($data);
    }	
	
	function editNurseNotesByJason() {
        $id = $this->input->get('id');
        $data['nurse_notes'] = $this->patient_model->getNurseNotesById($id);
        echo json_encode($data);
    }	
	
	function editConsentFormsByJason() {
        $id = $this->input->get('id');
        $data['consent_forms'] = $this->patient_model->getConsentFormsById($id);
        echo json_encode($data);
    }    
	
	function editDoctorNotesByJason() {
        $id = $this->input->get('id');
        $data['doctor_notes'] = $this->patient_model->getDoctorNotesById($id);
        echo json_encode($data);
    }

    function viewNurseNotesByJason() {
        $id = $this->input->get('id');
        //$data['view_nurse_notes'] = $this->patient_model->viewNurseNotesById($id);
        $this->patient_model->viewNurseNotesById($id);
        $patient = $data['view_nurse_notes']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        echo json_encode($data);
    }     
	      
	
	function viewConsentFormsByJason() {
        $id = $this->input->get('id');
        //$data['view_nurse_notes'] = $this->patient_model->viewNurseNotesById($id);
        $this->patient_model->viewConsentFormsById($id);
        $patient = $data['view_consent_forms']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        echo json_encode($data);
    }    
	
	function getCaseDetailsByJason() {
        $id = $this->input->get('id');
        $data['case'] = $this->patient_model->getMedicalHistoryById($id);
        $patient = $data['case']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        echo json_encode($data);
    }

    function getPatientByAppointmentByDctorId($doctor_id) {
        $data = array();
        $appointments = $this->appointment_model->getAppointmentByDoctor($doctor_id);
        foreach ($appointments as $appointment) {
            $patient_exists = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patient_exists)) {
                $patients[] = $appointment->patient;
            }
        }

        if (!empty($patients)) {
            $patients = array_unique($patients);
        } else {
            $patients = '';
        }

        return $patients;
    }

    function patientMaterial() {
        $data = array();
        $id = $this->input->get('patient');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $data['patient_materials_images'] = $this->patient_model->getPatientMaterialImagesByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_material', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addPatientMaterial() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $img_2_url = $this->input->post('img_2_url');
        $image_id = $this->input->post('image_id');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);
		$thumb_img_ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);	
		$thumb_img_name  = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_FILENAME);
		
		$current_user1 = $this->ion_auth->get_user_id();
		$current_user2 = $this->db->get_where('users', array('id' => $current_user1))->row();
		$user_name = $current_user2->first_name.' '.$current_user2->last_name;
		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

			$directoryName = './uploads/patient/documents/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($directoryName)){
					//Directory does not exist, so lets create it.
					mkdir($directoryName, 0755, true);
				}            

            //$file_name1 = $_FILES['img_url']['name'];
            $file_name = '';
			if($thumb_img_ext == "jpeg"){
				$file_name = $thumb_img_name.'jpg';
			}else{
				$file_name = $_FILES['img_url']['name'];
			}
			
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => $directoryName,
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000",
                'max_width' => "5000"
            );

//insert multiple images start

 //*  $stripped = str_replace(' ', '', $sentence)       
if(count($_FILES["img_2_url"]['name'])>0){		
			$count=0;
            foreach ($_FILES['img_2_url']['name'] as $file2name) 
            {
				$file2name = str_replace(' ', '', $file2name) ;
                $temp=$directoryName;
                $tmp=$_FILES['img_2_url']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($file2name);
                move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
/*				
$myfile = fopen($directoryName."newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $file2name);
fclose($myfile); */
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,				
                    'patient_id' => $patient_id,
                    'patient_name' => $patient_name,
                    'user' => $user_name,
                    'image_id' => $image_id,
                    'image_name' => $file2name,
                    'image_url' => $directoryName . $file2name,
                    'date_string' => date('d-m-y', $date),
                );
				/*
$myfile2 = fopen($directoryName."newfile2.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$data $title $patient_id");
fclose($myfile2);*/
$this->patient_model->insertPatientMaterialImages($data);
            }
			
            $this->session->set_flashdata('feedback', 'Added');
		}			

//insert multiple images end

				$multi_image = 'no';
				if(!empty($_FILES["img_2_url"]['name'][0])){	
					$multi_image = 'yes';
				}				
			/*	if(!empty($_FILES["img_2_url"]['name'][0] && empty($_FILES['img_url']['name'])){	
					$multi_image2 = 'yes';
				}*/

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
				
			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$file2name = str_replace(' ', '', $file2name) ;
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = $directoryName.$path['file_name'];
			}
				
                
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,					
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
					'image_id' => $image_id,					
					'multi_image' => $multi_image,					
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {	

			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = '';
			}			
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
					'image_id' => $image_id,	
					'url' => $img_url,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,					
                    'patient_address' => $patient_address,
					'multi_image' => $multi_image,					
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientMaterial($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }
      
function addPatientOct() {
    $title = $this->input->post('title');
    $patient_id = $this->input->post('patient');
    $img_url = $this->input->post('img_url');
    $image_id = $this->input->post('image_id');
    $date = time();
    $redirect = $this->input->post('redirect');
    if (empty($redirect)) {
        $redirect = "patient/medicalHistory?id=" . $patient_id;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');

    if (empty($_FILES['img_url']['name']) && empty($_FILES['img_2_url']['name'][0])) {
        $this->session->set_flashdata('feedback', 'Validation Error: At least one file must be uploaded!');
        redirect($redirect);
    }

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('feedback', 'Validation Error: ' . validation_errors());
        redirect($redirect);
    }

    // Patient details
    $patient_details = $this->patient_model->getPatientById($patient_id);
    $patient_name = $patient_details->name ?? '';
    $patient_first_name = $patient_details->first_name ?? '';
    $patient_last_name = $patient_details->last_name ?? '';
    $patient_phone = $patient_details->phone ?? '';
    $patient_address = $patient_details->address ?? '';

    // Create directory
    $directoryName = './uploads/patient/oct/' . $patient_id . '/';
    if (!is_dir($directoryName)) {
        if (!mkdir($directoryName, 0755, true)) {
            $this->session->set_flashdata('feedback', 'Failed to create directory: ' . $directoryName);
            redirect($redirect);
        }
    }

    // Handle multiple file uploads
    if (!empty($_FILES['img_2_url']['name'][0])) {
        $this->load->library('upload');
        $count = count($_FILES['img_2_url']['name']);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['img_2_url']['name'][$i])) {
                $_FILES['file']['name'] = pathinfo(str_replace(' ', '', $_FILES['img_2_url']['name'][$i]), PATHINFO_FILENAME) . '_' . time() . '_' . $i . '.' . pathinfo($_FILES['img_2_url']['name'][$i], PATHINFO_EXTENSION);
                $_FILES['file']['type'] = $_FILES['img_2_url']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['img_2_url']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['img_2_url']['error'][$i];
                $_FILES['file']['size'] = $_FILES['img_2_url']['size'][$i];

                $config = array(
                    'file_name' => $_FILES['file']['name'],
                    'upload_path' => $directoryName,
                    'allowed_types' => 'gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt',
                    'overwrite' => false,
                    'max_size' => '480000000',
                    'max_height' => '5000',
                    'max_width' => '5000'
                );

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $file2name = $upload_data['file_name'];
                    $data = array(
                        'date' => $date,
                        'title' => $title,
                        'patient_id' => $patient_id,
                        'image_id' => $image_id,
                        'image_name' => $file2name,
                        'image_url' => $directoryName . $file2name,
                        'date_string' => date('d-m-y', $date),
                    );
                    if (!$this->patient_model->insertPatientOctImages($data)) {
                        $this->session->set_flashdata('feedback', 'Database Error: Failed to insert multiple file record');
                        redirect($redirect);
                    }
                } else {
                    $this->session->set_flashdata('feedback', 'Multiple File Upload Error: ' . $this->upload->display_errors());
                    redirect($redirect);
                }
            }
        }
        $this->session->set_flashdata('feedback', 'Multiple Files Added');
    }

    // Handle single file upload
    $img_url = '';
    if (!empty($_FILES['img_url']['name'])) {
        $file_name = pathinfo(str_replace(' ', '', $_FILES['img_url']['name']), PATHINFO_FILENAME) . '_' . time() . '.' . pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
        $config = array(
            'file_name' => $file_name,
            'upload_path' => $directoryName,
            'allowed_types' => 'gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt',
            'overwrite' => false,
            'max_size' => '480000000',
            'max_height' => '5000',
            'max_width' => '5000'
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('img_url')) {
            $path = $this->upload->data();
            $img_url = $directoryName . $path['file_name'];
        } else {
            $this->session->set_flashdata('feedback', 'Single File Upload Error: ' . $this->upload->display_errors());
            redirect($redirect);
        }
    }

    $data = array(
        'date' => $date,
        'title' => $title,
        'url' => $img_url,
        'patient' => $patient_id,
        'patient_name' => $patient_name,
        'patient_first_name' => $patient_first_name,
        'patient_last_name' => $patient_last_name,
        'image_id' => $image_id,
        'multi_image' => !empty($_FILES['img_2_url']['name'][0]) ? 'yes' : 'no',
        'patient_address' => $patient_address,
        'patient_phone' => $patient_phone,
        'date_string' => date('d-m-y', $date),
    );

    if ($this->patient_model->insertPatientOct($data)) {
        $this->session->set_flashdata('feedback', 'Added');
    } else {
        $this->session->set_flashdata('feedback', 'Database Error: Failed to insert record');
    }

    redirect($redirect);
}
  	  
	  
	  function addPatientResult() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $img_2_url = $this->input->post('img_2_url');
        $image_id = $this->input->post('image_id');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);
		$thumb_img_ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);	
		$thumb_img_name  = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_FILENAME);
		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

			$directoryName = './uploads/patient/results/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($directoryName)){
					//Directory does not exist, so lets create it.
					mkdir($directoryName, 0755, true);
				}            

            //$file_name1 = $_FILES['img_url']['name'];
            $file_name = '';
			if($thumb_img_ext == "jpeg"){
				$file_name = $thumb_img_name.'jpg';
			}else{
				$file_name = $_FILES['img_url']['name'];
			}
			
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => $directoryName,
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000",
                'max_width' => "5000"
            );

//insert multiple images start

 //*  $stripped = str_replace(' ', '', $sentence)       
if(count($_FILES["img_2_url"]['name'])>0){		
			$count=0;
            foreach ($_FILES['img_2_url']['name'] as $file2name) 
            {
				$file2name = str_replace(' ', '', $file2name) ;
                $temp=$directoryName;
                $tmp=$_FILES['img_2_url']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($file2name);
                move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
/*				
$myfile = fopen($directoryName."newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $file2name);
fclose($myfile); */
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,				
                    'patient_id' => $patient_id,
                    'image_id' => $image_id,
                    'image_name' => $file2name,
                    'image_url' => $directoryName . $file2name,
                    'date_string' => date('d-m-y', $date),
                );
				/*
$myfile2 = fopen($directoryName."newfile2.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$data $title $patient_id");
fclose($myfile2);*/
$this->patient_model->insertPatientResultImages($data);
            }
			
            $this->session->set_flashdata('feedback', 'Added');
		}			

//insert multiple images end

				$multi_image = 'no';
				if(!empty($_FILES["img_2_url"]['name'][0])){	
					$multi_image = 'yes';
				}				
			/*	if(!empty($_FILES["img_2_url"]['name'][0] && empty($_FILES['img_url']['name'])){	
					$multi_image2 = 'yes';
				}*/

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
				
			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$file2name = str_replace(' ', '', $file2name) ;
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = $directoryName.$path['file_name'];
			}
				
                
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,					
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
					'image_id' => $image_id,					
					'multi_image' => $multi_image,					
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {	

			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = '';
			}			
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
					'image_id' => $image_id,	
					'url' => $img_url,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,					
                    'patient_address' => $patient_address,
					'multi_image' => $multi_image,					
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientResult($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }
 		  
		  
		function addPatientNewResult() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $img_2_url = $this->input->post('img_2_url');
        $image_id = $this->input->post('image_id');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);
		$thumb_img_ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);	
		$thumb_img_name  = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_FILENAME);
		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

			$directoryName = './uploads/patient/results/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($directoryName)){
					//Directory does not exist, so lets create it.
					mkdir($directoryName, 0755, true);
				}            

            //$file_name1 = $_FILES['img_url']['name'];
            $file_name = '';
			if($thumb_img_ext == "jpeg"){
				$file_name = $thumb_img_name.'jpg';
			}else{
				$file_name = $_FILES['img_url']['name'];
			}
			
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => $directoryName,
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000",
                'max_width' => "5000"
            );

//insert multiple images start

 //*  $stripped = str_replace(' ', '', $sentence)       
if(count($_FILES["img_2_url"]['name'])>0){		
			$count=0;
            foreach ($_FILES['img_2_url']['name'] as $file2name) 
            {
				$file2name = str_replace(' ', '', $file2name) ;
                $temp=$directoryName;
                $tmp=$_FILES['img_2_url']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($file2name);
                move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
/*				
$myfile = fopen($directoryName."newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $file2name);
fclose($myfile); */
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,				
                    'patient_id' => $patient_id,
                    'image_id' => $image_id,
                    'image_name' => $file2name,
                    'image_url' => $directoryName . $file2name,
                    'date_string' => date('d-m-y', $date),
                );
				/*
$myfile2 = fopen($directoryName."newfile2.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$data $title $patient_id");
fclose($myfile2);*/
$this->patient_model->insertPatientResultImages($data);
            }
			
            $this->session->set_flashdata('feedback', 'Added');
		}			

//insert multiple images end

				$multi_image = 'no';
				if(!empty($_FILES["img_2_url"]['name'][0])){	
					$multi_image = 'yes';
				}				
			/*	if(!empty($_FILES["img_2_url"]['name'][0] && empty($_FILES['img_url']['name'])){	
					$multi_image2 = 'yes';
				}*/

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
				
			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$file2name = str_replace(' ', '', $file2name) ;
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = $directoryName.$path['file_name'];
			}
				
                
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,					
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
					'image_id' => $image_id,					
					'multi_image' => $multi_image,					
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {	

			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = '';
			}			
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
					'image_id' => $image_id,	
					'url' => $img_url,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,					
                    'patient_address' => $patient_address,
					'multi_image' => $multi_image,					
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientResult($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }
 	 
	 function addPatientReferal() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $img_2_url = $this->input->post('img_2_url');
        $image_id = $this->input->post('image_id');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);
		$thumb_img_ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);	
		$thumb_img_name  = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_FILENAME);
		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

			$directoryName = './uploads/patient/referal/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($directoryName)){
					//Directory does not exist, so lets create it.
					mkdir($directoryName, 0755, true);
				}            

            //$file_name1 = $_FILES['img_url']['name'];
            $file_name = '';
			if($thumb_img_ext == "jpeg"){
				$file_name = $thumb_img_name.'jpg';
			}else{
				$file_name = $_FILES['img_url']['name'];
			}
			
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => $directoryName,
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000",
                'max_width' => "5000"
            );

//insert multiple images start

 //*  $stripped = str_replace(' ', '', $sentence)       
if(count($_FILES["img_2_url"]['name'])>0){		
			$count=0;
            foreach ($_FILES['img_2_url']['name'] as $file2name) 
            {
				$file2name = str_replace(' ', '', $file2name) ;
                $temp=$directoryName;
                $tmp=$_FILES['img_2_url']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($file2name);
                move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
/*				
$myfile = fopen($directoryName."newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $file2name);
fclose($myfile); */
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,				
                    'patient_id' => $patient_id,
                    'image_id' => $image_id,
                    'image_name' => $file2name,
                    'image_url' => $directoryName . $file2name,
                    'date_string' => date('d-m-y', $date),
                );
				/*
$myfile2 = fopen($directoryName."newfile2.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$data $title $patient_id");
fclose($myfile2);*/
$this->patient_model->insertPatientReferalImages($data);
            }
			
            $this->session->set_flashdata('feedback', 'Added');
		}			

//insert multiple images end

				$multi_image = 'no';
				if(!empty($_FILES["img_2_url"]['name'][0])){	
					$multi_image = 'yes';
				}				
			/*	if(!empty($_FILES["img_2_url"]['name'][0] && empty($_FILES['img_url']['name'])){	
					$multi_image2 = 'yes';
				}*/

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
				
			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$file2name = str_replace(' ', '', $file2name) ;
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = $directoryName.$path['file_name'];
			}
				
                
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,					
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
					'image_id' => $image_id,					
					'multi_image' => $multi_image,					
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {	

			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = '';
			}			
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
					'image_id' => $image_id,	
					'url' => $img_url,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,					
                    'patient_address' => $patient_address,
					'multi_image' => $multi_image,					
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientReferal($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }
   	  
	  function addPatientPhotograph() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $img_2_url = $this->input->post('img_2_url');
        $image_id = $this->input->post('image_id');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);
		$thumb_img_ext = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_EXTENSION);	
		$thumb_img_name  = pathinfo(parse_url($img_url, PHP_URL_PATH), PATHINFO_FILENAME);
		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

			$directoryName = './uploads/patient/photograph/'.$patient_id.'/';
				//Check if the directory already exists.
				if(!is_dir($directoryName)){
					//Directory does not exist, so lets create it.
					mkdir($directoryName, 0755, true);
				}            

            //$file_name1 = $_FILES['img_url']['name'];
            $file_name = '';
			if($thumb_img_ext == "jpeg"){
				$file_name = $thumb_img_name.'jpg';
			}else{
				$file_name = $_FILES['img_url']['name'];
			}
			
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => $directoryName,
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc|csv|txt",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000",
                'max_width' => "5000"
            );

//insert multiple images start

 //*  $stripped = str_replace(' ', '', $sentence)       
if(count($_FILES["img_2_url"]['name'])>0){		
			$count=0;
            foreach ($_FILES['img_2_url']['name'] as $file2name) 
            {
				$file2name = str_replace(' ', '', $file2name) ;
                $temp=$directoryName;
                $tmp=$_FILES['img_2_url']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($file2name);
                move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
/*				
$myfile = fopen($directoryName."newfile.txt", "a") or die("Unable to open file!");
fwrite($myfile, $file2name);
fclose($myfile); */
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,				
                    'patient_id' => $patient_id,
                    'image_id' => $image_id,
                    'image_name' => $file2name,
                    'image_url' => $directoryName . $file2name,
                    'date_string' => date('d-m-y', $date),
                );
				/*
$myfile2 = fopen($directoryName."newfile2.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$data $title $patient_id");
fclose($myfile2);*/
$this->patient_model->insertPatientPhotographImages($data);
            }
			
            $this->session->set_flashdata('feedback', 'Added');
		}			

//insert multiple images end

				$multi_image = 'no';
				if(!empty($_FILES["img_2_url"]['name'][0])){	
					$multi_image = 'yes';
				}				
			/*	if(!empty($_FILES["img_2_url"]['name'][0] && empty($_FILES['img_url']['name'])){	
					$multi_image2 = 'yes';
				}*/

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
				
			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$file2name = str_replace(' ', '', $file2name) ;
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = $directoryName.$path['file_name'];
			}
				
                
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,					
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
					'image_id' => $image_id,					
					'multi_image' => $multi_image,					
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {	

			if(empty($_FILES['img_url']['name']) && !empty($_FILES["img_2_url"]['name'][0])){
				$img_url = $directoryName.$_FILES["img_2_url"]['name'][0];
				$img_url = str_replace(' ', '', $img_url) ;
			}else{		
				$img_url = '';
			}			
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
					'image_id' => $image_id,	
					'url' => $img_url,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,					
                    'patient_address' => $patient_address,
					'multi_image' => $multi_image,					
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientPhotograph($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }
    
	function addPatientRefraction() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
		$thumb_url = pathinfo($img_url, PATHINFO_EXTENSION);		
        $date = time();
        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Validation Error !');
            redirect($redirect);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->patient_model->getPatientById($patient_id);
                $patient_name = $patient_details->name;
                $patient_first_name = $patient_details->first_name;
                $patient_last_name = $patient_details->last_name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
           } else {
                $patient_name = 0;
                $patient_first_name = 0;
                $patient_last_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 0;
            foreach ($file_name_pieces as $piece) {
                if ($count > 0) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/patient/refractions/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|docx|xls|xlsx|doc",
                'overwrite' => False,
                'max_size' => "480000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "3000",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('img_url')) {
				$path = $this->upload->data();
                $img_url = "./uploads/patient/refractions/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'url_thumb' => $thumb_view,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_first_name' => $patient_first_name,
                    'patient_last_name' => $patient_last_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', 'Upload Error !');
            }

            $this->patient_model->insertPatientRefraction($data);
            $this->session->set_flashdata('feedback', 'Added');


            redirect($redirect);
        }
    }

    function deleteCaseHistory() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $case_history = $this->patient_model->getMedicalHistoryById($id);
        $this->patient_model->deleteMedicalHistory($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'case') {
            redirect('patient/caseList');
        } else {
            redirect("patient/MedicalHistory?id=" . $case_history->patient_id);
        }
    }    
	function deleteNurseNotes() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $nurse_notes = $this->patient_model->getNurseNotesById($id);
        $this->patient_model->deleteNurseNotes($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'nurse_notes') {
            redirect('patient/nurseNotes');
        } else {
            redirect("patient/MedicalHistory?id=" . $nurse_notes->patient_id);
        }
    }	
	
	function deleteConsentForms() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $consent_forms = $this->patient_model->getConsentFormsById($id);
        $this->patient_model->deleteConsentForms($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'consent_forms') {
            redirect('patient/consentForm');
        } else {
            redirect("patient/MedicalHistory?id=" . $consent_forms->patient_id);
        }
    }
	function deleteDoctorNotes() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $doctor_notes = $this->patient_model->getDoctorNotesById($id);
        $this->patient_model->deleteDoctorNotes($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'doctor_notes') {
            redirect('patient/doctorNotes');
        } else {
            redirect("patient/MedicalHistory?id=" . $doctor_notes->patient_id);
        }
    }

    function deletePatientMaterial() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_material = $this->patient_model->getPatientMaterialById($id);
        $path = $patient_material->url;
		$img_url = file_get_contents($path);
		$image_path = '/uploads/patient/documents/'.$id.'/'.$img_url;
        if (!empty($path)) {
            unlink($path);
		//	unlink($img_url);
        }
        $this->patient_model->deletePatientMaterial($id);
        $this->patient_model->deletePatientMaterialImages($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'documents') {
            redirect('patient/documents');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_material->patient);
        }
    }    
	
	function deletePatientOct() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_oct = $this->patient_model->getPatientOctById($id);
        $path = $patient_oct->url;
		$img_url = file_get_contents($path);
		$image_path = '/uploads/patient/oct/'.$id.'/'.$img_url;
        if (!empty($path)) {
            unlink($path);
		//	unlink($img_url);
        }
        $this->patient_model->deletePatientOct($id);
        $this->patient_model->deletePatientOctImages($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'octs') {
            redirect('patient/octs');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_oct->patient);
        }
    }	
	
	function deletePatientResult() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_result = $this->patient_model->getPatientResultById($id);
        $path = $patient_result->url;
		$img_url = file_get_contents($path);
		$image_path = '/uploads/patient/results/'.$id.'/'.$img_url;
        if (!empty($path)) {
            unlink($path);
		//	unlink($img_url);
        }
        $this->patient_model->deletePatientResult($id);
        $this->patient_model->deletePatientResultImages($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'result') {
            redirect('patient/result');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_result->patient);
        }
    }	
	function deletePatientReferal() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_referal = $this->patient_model->getPatientReferalById($id);
        $path = $patient_referal->url;
		$img_url = file_get_contents($path);
		$image_path = '/uploads/patient/referal/'.$id.'/'.$img_url;
        if (!empty($path)) {
            unlink($path);
		//	unlink($img_url);
        }
        $this->patient_model->deletePatientReferal($id);
        $this->patient_model->deletePatientReferalImages($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'result') {
            redirect('patient/referal');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_result->patient);
        }
    }
	
	function deletePatientPhotograph() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_oct = $this->patient_model->getPatientPhotographById($id);
        $path = $patient_oct->url;
		$img_url = file_get_contents($path);
		$image_path = '/uploads/patient/photograph/'.$id.'/'.$img_url;
        if (!empty($path)) {
            unlink($path);
		//	unlink($img_url);
        }
        $this->patient_model->deletePatientPhotograph($id);
        $this->patient_model->deletePatientPhotographImages($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        if ($redirect == 'octs') {
            redirect('patient/photograph');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_photograph->patient);
        }
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('patient', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->patient_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('patient');
    }

/*
    function getPatient() {
    $requestData = $_REQUEST;
    $start = $requestData['start'];
    $limit = $requestData['length'];
    $search = $this->input->post('search')['value'];

    // Handle sorting
    $orderColumnIndex = isset($requestData['order'][0]['column']) ? $requestData['order'][0]['column'] : 0;
    $orderDirection = isset($requestData['order'][0]['dir']) ? $requestData['order'][0]['dir'] : 'asc';
    $columns = array('id', 'location', 'first_name', 'middle_name', 'last_name', 'phone', 'due_balance'); // Map column indices to DB fields
    $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';

    if ($limit == -1) {
        if (!empty($search)) {
            $data['patients'] = $this->patient_model->getPatientBySearch($search, $orderColumn, $orderDirection);
        } else {
            $data['patients'] = $this->patient_model->getPatient($orderColumn, $orderDirection);
        }
    } else {
        if (!empty($search)) {
            $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search, $orderColumn, $orderDirection);
        } else {
            $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start, $orderColumn, $orderDirection);
        }
    }

    $info = [];
    foreach ($data['patients'] as $patient) {
        $options1 = $this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))
            ? '<a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $patient->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . '</a>'
            : '';
        $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';
        $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';
        $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money"></i> ' . lang('payment') . '</a>';
        $options7 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/pharmacy/sellNowSingle?id=' . $patient->id . '&type=gen"><i class="fa fa-money"></i> P.O.S</a>';
        $options5 = $this->ion_auth->in_group(array('admin', 'Doctor'))
            ? '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>'
            : '';
        $options6 = '<a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

        $dueBalance = $this->patient_model->getDueBalanceByPatientId($patient->id);
        $getbalancedue = $dueBalance > 0 ? "<b><font color='red'>$" . $dueBalance . "</font></b>" : "<b>$" . $dueBalance . "</b>";

        $pat_id = $patient->deceased === "YES" ? "<font color='red'><b>Deceased</b></font>" : $patient->id;

        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Doctor')) ||
            $this->ion_auth->in_group(array('Laboratorist', 'Nurse'))) {
            $info[] = array(
                $pat_id,
                $patient->location,
                $patient->first_name,
                $patient->middle_name,
                $patient->last_name,
                $patient->phone,
                $getbalancedue,
                $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5 . ' ' . $options7
            );
        }
    }

    $output = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => $this->db->count_all('patient'), // Total unfiltered records
        "recordsFiltered" => !empty($search) ? $this->patient_model->getFilteredCount($search) : $this->db->count_all('patient'), // Filtered count
        "data" => $info
    );

    echo json_encode($output);
}
*/

////UPDATED//// 
function getPatient() {
    $requestData = $_REQUEST;
    $start = $requestData['start'];
    $limit = $requestData['length'];
    $search = $this->input->post('search')['value'];

    // Handle sorting
    $orderColumnIndex = isset($requestData['order'][0]['column']) ? $requestData['order'][0]['column'] : 0;
    $orderDirection = isset($requestData['order'][0]['dir']) ? $requestData['order'][0]['dir'] : 'desc';
    $columns = array('id', 'location', 'first_name', 'middle_name', 'last_name', 'phone','add_date'); 
    
    // Updated columns
    $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';

    try {
        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBySearch($search, $orderColumn, $orderDirection);
            } else {
                $data['patients'] = $this->patient_model->getPatient($orderColumn, $orderDirection);
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search, $orderColumn, $orderDirection);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start, $orderColumn, $orderDirection);
            }
        }

        $info = [];
        foreach ($data['patients'] as $patient) {
            $options1 = $this->ion_auth->in_group(array('admin', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))
                ? '<a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $patient->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . '</a>'
                : '';
            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';
             $options3 = $this->ion_auth->in_group(array('admin', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))
            ? '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>'
            : '';
            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money"></i> ' . lang('payment') . '</a>';
            $options7 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/pharmacy/sellNowSingle?id=' . $patient->id . '&type=gen"><i class="fa fa-money"></i> P.O.S</a>';
            $options5 = $this->ion_auth->in_group(array('admin', 'Doctor'))
                ? '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>'
                : '';
                
            $options6 = $this->ion_auth->in_group(array('admin', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))
           ? '<a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>'
: '';
            $dueBalance = $this->patient_model->getDueBalanceByPatientId($patient->id);
            $getbalancedue = $dueBalance > 0 ? "<b><font color='red'>$" . $dueBalance . "</font></b>" : "<b>$" . $dueBalance . "</b>";

            $pat_id = $patient->deceased === "YES" ? "<font color='red'><b>Deceased</b></font>" : $patient->id;
            
            //$pat_id = $patient->id;

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Doctor')) ||
                $this->ion_auth->in_group(array('Laboratorist', 'Nurse'))) {
                $info[] = array(
                    $pat_id,
                    $patient->location,
                    $patient->first_name,
                    $patient->middle_name,
                    $patient->last_name,
                    $patient->phone,
                    $patient->add_date,
                    $getbalancedue,
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5 . ' ' . $options7
                );
            }
        }

        $output = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => $this->db->count_all('patient'),
            "recordsFiltered" => !empty($search) ? $this->patient_model->getFilteredCount($search) : $this->db->count_all('patient'),
            "data" => $info
        );
    } catch (Exception $e) {
        log_message('error', 'getPatient Error: ' . $e->getMessage());
        $output = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => [],
            "error" => "An error occurred: " . $e->getMessage()
        );
    }

    header('Content-Type: application/json');
    echo json_encode($output);
    exit;
}

    function getPatientPayments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn btn-xs green" title="' . lang('payment') . ' ' . lang('history') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money"></i> ' . lang('payment') . ' ' . lang('history') . '</a>';
			
			$options7 = '<a class="btn btn-xs green" title="' . lang('payment') . ' ' . lang('history') . '" style="color: #fff;" href="finance/pharmacy/sellNowSingle?id=' . $patient->id . '&type=gen"><i class="fa fa-money"></i> ' . lang('payment') . ' ' . lang('history') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

			if ($this->ion_auth->in_group(array('Nurse'))) {
                $options5 = '';
            }
            
            $due = $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id);

            $info[] = array(
                $patient->id,
                $patient->name,
                $patient->first_name,
                $patient->last_name,
                $patient->phone,
                $due,
                //  $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                $options4
            );
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function getCaseList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryBySearch($search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistory();
            }
        } else {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimitBySearch($limit, $start, $search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['cases'] as $case) {


			if ($this->ion_auth->in_group(array('Nurse'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' ';
                $options2 = ' ';
                $options3 = ' ';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-edit"> </i> </a>';				
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteCaseHistory?id=' . $case->id . '&redirect=case" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton case" title="' . lang('case') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($case->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($case->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->first_name . '</br>' .$patient_info->last_name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $case->patient_name . '</br>' . $patient_details = $case->patient_first_name . '</br>' .$patient_details = $case->patient_last_name . '</br>' . $case->patient_address . '</br>' . $case->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $case->date),
                $patient_details,
                $case->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['cases'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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
    function getNurseNotes() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['nurse_notes'] = $this->patient_model->getNurseNotesBySearch($search);
            } else {
                $data['nurse_notes'] = $this->patient_model->getNurseNotes();
            }
        } else {
            if (!empty($search)) {
                $data['nurse_notes'] = $this->patient_model->getNurseNotesByLimitBySearch($limit, $start, $search);
            } else {
                $data['nurse_notes'] = $this->patient_model->getNurseNotesByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['nurse_notes'] as $nurse_notes) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $nurse_notes->id . '"><i class="fa fa-edit"> </i> </a>';
            }


            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="View Info" data-toggle = "modal" data-id="' . $nurse_notes->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteNurseNotes?id=' . $nurse_notes->id . '&redirect=nurse_notes" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton Nurse_notes" title="Nurse Notes" data-toggle = "modal" data-id="' . $nurse_notes->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($nurse_notes->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($nurse_notes->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->first_name . '</br>' . $patient_info->last_name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $nurse_notes->patient_name . '</br>' . $nurse_notes->patient_first_name . '</br>' .$nurse_notes->patient_last_name . '</br>' . $nurse_notes->patient_address . '</br>' . $nurse_notes->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $nurse_notes->date),
                $patient_details,
                $nurse_notes->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['nurse_notes'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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
	
	function getConsentForms() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['consent_forms'] = $this->patient_model->getConsentFormsBySearch($search);
            } else {
                $data['consent_forms'] = $this->patient_model->getConsentForms();
            }
        } else {
            if (!empty($search)) {
                $data['consent_forms'] = $this->patient_model->getConsentFormsByLimitBySearch($limit, $start, $search);
            } else {
                $data['consent_forms'] = $this->patient_model->getConsentFormsByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['consent_forms'] as $consent_forms) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $consent_forms->id . '"><i class="fa fa-edit"> </i> </a>';
            }


            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="View Info" data-toggle = "modal" data-id="' . $consent_forms->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteConsentForms?id=' . $consent_forms->id . '&redirect=consent_forms" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton consent_forms" title="Nurse Notes" data-toggle = "modal" data-id="' . $consent_forms->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($consent_forms->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($consent_forms->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->first_name . '</br>' .$patient_info->last_name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $consent_forms->patient_name . '</br>' . $consent_forms->patient_first_name . '</br>' .$consent_forms->patient_last_name . '</br>' . $consent_forms->patient_address . '</br>' . $consent_forms->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $consent_forms->date),
                $patient_details,
                $consent_forms->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['consent_forms'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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
	
	
    function getDoctorNotes() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['doctor_notes'] = $this->patient_model->getDoctorNotesBySearch($search);
            } else {
                $data['doctor_notes'] = $this->patient_model->getDoctorNotes();
            }
        } else {
            if (!empty($search)) {
                $data['doctor_notes'] = $this->patient_model->getDoctorNotesByLimitBySearch($limit, $start, $search);
            } else {
                $data['doctor_notes'] = $this->patient_model->getDoctorNotesByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['doctor_notes'] as $doctor_notes) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $doctor_notes->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteDoctorNotes?id=' . $doctor_notes->id . '&redirect=doctor_notes" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton doctor_notes" title="Doctor Notes" data-toggle = "modal" data-id="' . $doctor_notes->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($doctor_notes->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($doctor_notes->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->first_name . '</br>' . $patient_info->last_name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $doctor_notes->patient_name . '</br>' . $doctor_notes->patient_first_name . '</br>' .$doctor_notes->patient_last_name . '</br>' . $doctor_notes->patient_address . '</br>' . $doctor_notes->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $doctor_notes->date),
                $patient_details,
                $doctor_notes->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['doctor_notes'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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
	

public function getPatientinfo() {

        $searchTerm = $this->input->post('searchTerm');


        $response = $this->patient_model->getPatientInfo($searchTerm);

        echo json_encode($response);
    }

    public function getPatientinfoWithAddNewOption() {

        $searchTerm = $this->input->post('searchTerm');


        $response = $this->patient_model->getPatientinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }


	
    function getDocuments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentBySearch($search);
                $data['documents_img'] = $this->patient_model->getDocumentImagesBySearch($search);
            } else {
                $data['documents'] = $this->patient_model->getPatientMaterial();
                $data['documents_img'] = $this->patient_model->getPatientMaterialImages();
            }
        } else {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentByLimitBySearch($limit, $start, $search);
                $data['documents_img'] = $this->patient_model->getDocumentImagesByLimitBySearch($limit, $start, $search);
            } else {
                $data['documents'] = $this->patient_model->getDocumentByLimit($limit, $start);
                $data['documents_img'] = $this->patient_model->getDocumentImagesByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['documents'] as $document) {
            
            

          //  if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = '<a class="btn btn-info btn-xs" href="' . $document->url . '" download> ' . lang('download') . ' </a>';
           //// }
          //  if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs delete_button" href="patient/deletePatientMaterial?id=' . $document->id . '&redirect=documents"onclick="return confirm(\'You want to delete the item??\');"> X </a>';
          //  }

            if (!empty($document->patient)) {
                $patient_info = $this->patient_model->getPatientById($document->patient);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                    $patient_alias = $patient_info->name .'</br>';
					$patient_details_fn = $patient_info->first_name . '</br>';
					$patient_details_ln = $patient_info->last_name . '</br>'; 
				} else {
                    $patient_details = $document->patient_name . '</br>' . $document->patient_address . '</br>' . $document->patient_phone . '</br>';
					$patient_alias = $document->patient_name . '</br>';
					$patient_details_fn = $document->patient_first_name . '</br>';
					$patient_details_ln = $document->patient_last_name . '</br>'; 
                }
            } else {
                $patient_details = '';
				$patient_alias = '';
            }
				$test = $document->url;	
			//	$path_parts = pathinfo($test, PATHINFO_EXTENSION);		
				$path_parts =  pathinfo(parse_url($test, PHP_URL_PATH), PATHINFO_EXTENSION);	
			
			
				if($path_parts == 'pdf'){
				$path_parts2 = '<embed src="'.$document->url.'" width="100" height="100" ><br><a href="'.$document->url.'" target="_blank">view</a></embed>';
				}elseif(!empty($document->url) && $path_parts <> 'pdf'){
				$path_parts2 = '<img src="'.$document->url.'" width="100" height="100" ><br><a href="'.$document->url.'" target="_blank">view</a></img>';
				}else{
					$path_parts2 = '';
				}	
				/*
				if($path_parts <> "pdf"){
                $new_options1 = '<img src="' . $url_path2 . '" width="100" height="100" ><br><a href="'.$url_path2.'" target="_blank">view</a>';
				}
				*/
				
				$pagecheck = basename($document->url);
				if($document->multi_image == 'yes'){
				$path_parts3 = '<a href="/db/getadditionalimages.php?vmid='.$document->image_id.'" target="_blank">View More</a></embed>';
				}else{
				$path_parts3 = '';				
				}
				
			
			$info[] = array(
                date('d-m-y', $document->date),
                $patient_details,
				$patient_details_fn,
				$patient_details_ln,
                $document->title,
				$path_parts2,
				$path_parts3,
                $options1 . ' ' . $options2
            ); 
        }

        if (!empty($data['documents'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient_material')->num_rows(),
                "recordsFiltered" => $this->db->get('patient_material')->num_rows(),
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
/*	
		function docnotes_csv_load_data(){
		$result_notes = $this->patient_model->docnotes_csv_select();
		$output = '
		 <h3 align="center">Imported User Details from CSV File</h3>
        <div class="table-responsive">
        	<table class="table table-bordered table-striped">
        		<tr>
        			<th>Patient ID</th>
        			<th>Doctor ID</th>
        			<th>Doctor Name</th>
        			<th>Notes Title</th>
        			<th>Notes</th>
        			<th>Patient Name</th>
        			<th>Patient Address</th>
        			<th>Patient Phone</th>
        			<th>Image URL</th>
        			<th>Date</th>
        			<th>Registration Time</th>
        		</tr>
		';
		$count = 0;
		if($result_notes->num_rows() > 0)
		{
			foreach($result_notes->result() as $row)
			{
				$count = $count + 1;
				$output .= '
				<tr>
					<td>'.$row->patient_id.'</td>
					<td>'.$row->doctor_id.'</td>
					<td>'.$row->doctor_name'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->description.'</td>	
					<td>'.$row->patient_name.'</td>
					<td>'.$row->patient_address.'</td>
					<td>'.$row->patient_phone'</td>
					<td>'.$row->img_url.'</td>
					<td>'.$row->date.'</td>
					<td>'.$row->registration_time.'</td>
				</tr>
				';
			}
		}
		else
		{
			$output .= '
			<tr>
	    		<td colspan="5" align="center">Data not Available</td>
	    	</tr>
			';
		}
		$output .= '</table></div>';
		echo $output;
	}

	function docnotes_csv_import(){
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
	//	$data['patient'] = $this->patient_model->getPatientById($id);
    //    $data['doctors'] = $this->doctor_model->getDoctor();
	//	$birthDate = strtotime($data['patient']->birthdate);
     //       $birthDate = date('m/d/Y', $birthDate);
		foreach($file_data as $row)
		{
			$data[] = array(
				'patient_id'	=>	$row["Patient ID"],
        		'doctor_id'		=>	$row["Doctor ID"],
        		'doctor_name'	=>	$row["Doctor Name"],
        		'title'			=>	$row["Title"],
				'description'	=>	$row["Notes"],
        		'patient_name'		=>	$row["Patient Name"],
        		'patient_address'	=>	$row["Patient Address"],
        		'patient_phone'			=>	$row["Patient Phone"],        		
				'img_url'		=>	$row["Image Url"],
        		'date'			=>	 strtotime($row["Date"]);,
        		'registration_time'			=>	$row["Registration Time"]
			);
		}
		$this->patient_model->docnotes_csv_insert($data);
	}
	
*/
}

/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    
    ?>
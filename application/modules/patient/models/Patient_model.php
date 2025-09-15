<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }



   function insertFolder($data) {
        $this->db->insert('folder', $data);
    }

    function getFolder() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('folder');
        return $query->result();
    }

    function getFolderById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('folder');
        return $query->row();
    }

    function updateFolder($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('folder', $data);
    }

    function getFolderByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('folder');
        return $query->result();
    }

    function getPatientMaterialByFolderId($id) {
        $this->db->where('folder', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }
    

    function deleteFolder($id) {
        $this->db->where(array('id'=> $id));
        $this->db->delete('folder');
    }

    function deletePatientMaterialByFolderId($id) {
        $this->db->where(array('folder'=> $id));
        $this->db->delete('patient_material');

    }
     public function deleteImage($con){ 
        // Delete image data 
        $delete = $this->db->delete($this->imgTbl, $con); 
         
        // Return the status 
        return $delete?true:false; 
    } 

    function getPatientMaterialByyPatientId($patient_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient_id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }


//edited to add location to the specific station
    function insertPatient($data) {
        $this->db->insert('patient', $data);
    }
//end editing for specific station


function getPatient($orderColumn = 'id', $orderDirection = 'desc') {
    $this->db->order_by($orderColumn, $orderDirection);
    $query = $this->db->get('patient');
    return $query->result();
}

function getPatientWithoutSearch($order = null, $dir = 'desc') {
    if ($order != null) {
        $this->db->order_by($order, $dir);
    } else {
        $this->db->order_by('id', $dir);
    }
    $query = $this->db->get('patient');
    return $query->result();
}

function getPatientBySearch($search, $orderColumn = 'id', $orderDirection = 'desc') {
    $this->db->like('id', $search);
    $this->db->or_like('name', $search);
    $this->db->or_like('first_name', $search);
    $this->db->or_like('middle_name', $search);
    $this->db->or_like('last_name', $search);
    $this->db->or_like('phone2', $search);
    $this->db->or_like('birthday', $search);
    $this->db->or_like('location', $search);
    $this->db->order_by($orderColumn, $orderDirection);
    $query = $this->db->get('patient');
    return $query->result();
}

function getPatientByLimit($limit, $start, $orderColumn = 'id', $orderDirection = 'desc') {
    $this->db->order_by($orderColumn, $orderDirection);
    $this->db->limit($limit, $start);
    $query = $this->db->get('patient');
    return $query->result();
}

/*
function getPatientByLimitBySearch($limit, $start, $search, $orderColumn = 'id', $orderDirection = 'desc') {
    $this->db->like('id', $search);
    $this->db->or_like('name', $search);
    $this->db->or_like('first_name', $search);
    $this->db->or_like('last_name', $search);
    $this->db->or_like('phone', $search);
    $this->db->or_like('address', $search);
    $this->db->order_by($orderColumn, $orderDirection);
    $this->db->limit($limit, $start);
    $query = $this->db->get('patient');
    return $query->result();
}
*/

function getPatientByLimitBySearch($limit, $start, $search, $orderColumn = 'id', $orderDirection = 'desc') {
    $this->db->group_start();
    $this->db->like('id', $search);
    $this->db->or_like('name', $search);
    $this->db->or_like('first_name', $search);
    $this->db->or_like('middle_name', $search);
    $this->db->or_like('last_name', $search);
    $this->db->or_like('phone2', $search); // Changed from phone to phone2 for consistency
    $this->db->or_like('birthdate', $search); // Added back from getPatientBySearch
    $this->db->or_like('location', $search); // Added back from getPatientBySearch
    $this->db->group_end();
    $this->db->order_by($orderColumn, $orderDirection);
    $this->db->limit($limit, $start);
    $query = $this->db->get('patient');
    return $query->result();
}

//ADD FILTERED COUNT MODEL
function getFilteredCount($search) {
    $this->db->group_start();
    $this->db->like('id', $search);
    $this->db->or_like('name', $search);
    $this->db->or_like('first_name', $search);
    $this->db->or_like('middle_name', $search);
    $this->db->or_like('last_name', $search);
    $this->db->or_like('phone2', $search);
    $this->db->or_like('birthdate', $search);
    $this->db->or_like('location', $search);
    $this->db->group_end();
    return $this->db->get('patient')->num_rows();
}


function getPatientById($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('patient');
    return $query->row();
}

function getPatientByIonUserId($id) {
    $this->db->where('ion_user_id', $id);
    $query = $this->db->get('patient');
    return $query->row();
}

function getPatientByEmail($email) {
    $this->db->where('email', $email);
    $query = $this->db->get('patient');
    return $query->row();
}

    function updatePatient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient');
    }

    function insertMedicalHistory($data) {
        $this->db->insert('medical_history', $data);
 		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('medical_history');       
    }    
	
	function insertNurseNotes($data) {
        $this->db->insert('nurse_notes', $data);
 		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('nurse_notes');       
    } 		
	
	function insertReferralNew($data) {
        $this->db->insert('patient_referal_new', $data);      
    } 	

// added allowing the system to automatically add the Mobay location ID	
	function insertConsentForms($data) {
        $this->db->insert('consent_form', $data); 
		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('consent_form');
    } 	
	
   
// end

	function insertSickLeave($data) {
        $this->db->insert('patient_sickleave', $data); 
    }
	
	function viewNurseNotesByJason($id) {
		$this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('nurse_notes');
        return $query->row();
    }	
	
	function viewReferralNewByJason($id) {
		$this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('patient_referal_new');
        return $query->row();
    }	
	
	function viewConsentFormsByJason($id) {
		$this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('consent_form');
        return $query->row();
    }	
	
	function viewSickLeaveByJason($id) {
		$this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('patient_sickleave');
        return $query->row();
    }

	function insertDoctorNotes($data) {
        $this->db->insert('doctor_notes', $data);
  		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('doctor_notes');      
    }

    function getMedicalHistoryByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('medical_history');
        return $query->result();
    }    

    function getPrescriptionByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('prescription');
        return $query->result();
    }
	
	function getNurseNotesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('nurse_notes');
        return $query->result();
    } 	
	
	function getReferralNewByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_referal_new');
        return $query->result();
    }  

	function getConsentFormsByPatientId($id) {
        $this->db->where('patient_id', $id);
		$this->db->order_by('id', 'desc');
        $query = $this->db->get('consent_form');
        return $query->result();
    } 	
	
	function getSickLeaveByPatientId($id) {
        $this->db->where('patient_id', $id);
		$this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_sickleave');
        return $query->result();
    }    
	
	function getDoctorNotesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('doctor_notes');
        return $query->result();
    }

    function getMedicalHistory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }    
	
	function getNurseNotes() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('nurse_notes');
        return $query->result();
    } 	
	
	function getReferralNew() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_referal_new');
        return $query->result();
    } 	
	
	function getConsentForms() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('consent_form');
        return $query->result();
    } 	
	
	function getSickLeave() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('patient_sickleave');
        return $query->result();
    }    
	
	function getDoctorNotes() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('doctor_notes');
        return $query->result();
    }

    function getMedicalHistoryBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('medical_history');
        return $query->result();
    }   

	function getNurseNotesBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('nurse_notes');
        return $query->result();
    } 	
	
	function getReferralNewBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('date', $date);
        $this->db->or_like('ref_doctor', $ref_doctor);
        $this->db->or_like('full_name', $full_name);
        $this->db->or_like('age', $age);
        $this->db->or_like('patient', $patient);
        $query = $this->db->get('patient_referal_new');
        return $query->result();
    } 	
	
	function getConsentFormsBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('consent_form');
        return $query->result();
    }	
	
	function getSickLeaveBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_sickleave');
        return $query->result();
    }    
	
	function getDoctorNotesBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('doctor_notes');
        return $query->result();
    }

    function getMedicalHistoryByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }    
	
	function getNurseNotesByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('nurse_notes');
        return $query->result();
    }	
	function getReferralNewByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal_new');
        return $query->result();
    }	
	
	function getConsentFormsByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('consent_form');
        return $query->result();
    } 	
	
	function getSickLeaveByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_sickleave');
        return $query->result();
    }   

	function getDoctorNotesByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('doctor_notes');
        return $query->result();
    }

    function getMedicalHistoryByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }    
	
	function getNurseNotesByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'desc');
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('description', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('nurse_notes');
        return $query->result();
    }	
	function getReferralNewByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'desc');
        $this->db->or_like('age', $age);
        $this->db->or_like('full_name', $full_name);
        $this->db->or_like('date', $date);		
        $this->db->or_like('ref_doctor', $ref_doctor);
        $this->db->or_like('patient', $patient);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal_new');
        return $query->result();
    }	
	
	function getConsentFormsByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('consent_form');
        return $query->result();
    } 	
	
	function getSickLeaveByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_sickleave');
        return $query->result();
    }    
	
	function getDoctorNotesByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('doctor_notes');
        return $query->result();
    }

    function getMedicalHistoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medical_history');
        return $query->row();
    }   

	function getNurseNotesById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('nurse_notes');
        return $query->row();
    } 	
	
	function getReferralNewById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_referal_new');
        return $query->row();
    }  	
	
	function getConsentFormsById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('consent_form');
        return $query->row();
    }	
	
	function getSickLeaveById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_sickleave');
        return $query->row();
    }    
	
	function getDoctorNotesById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('doctor_notes');
        return $query->row();
    }

    function updateMedicalHistory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medical_history', $data);
    }    
	
	function updateNurseNotes($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('nurse_notes', $data);
    } 	
	
	function updateReferralNew($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient_referal_new', $data);
    }   	
	
	function updateConsentForms($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('consent_form', $data);
    } 	
	
	function updateSickLeave($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient_sickleave', $data);
    }    
	
	function updateDoctorNotes($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('doctor_notes', $data);
    }

    function insertDiagnosticReport($data) {
        $this->db->insert('diagnostic_report', $data);
    }

    function updateDiagnosticReport($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('diagnostic_report', $data);
    }

    function getDiagnosticReport() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function getDiagnosticReportById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByInvoiceId($id) {
        $this->db->where('invoice', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function insertPatientMaterial($data) {
        $this->db->insert('patient_material', $data);
 		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('patient_material');       
		return $this->db->insert_id();
    }       
	
	function insertPatientRefraction($data) {
        $this->db->insert('patient_refraction', $data);
		return $this->db->insert_id();
    } 	
	
	function insertPatientOct($data) {
        $this->db->insert('patient_oct', $data);
		return $this->db->insert_id();
    }    	
	
	function insertPatientPhotograph($data) {
        $this->db->insert('patient_photograph', $data);
		return $this->db->insert_id();
    }	
	
	function insertPatientResult($data) {
        $this->db->insert('patient_result', $data);
		return $this->db->insert_id();
    }   	
	
	function insertPatientReferal($data) {
        $this->db->insert('patient_referal', $data);
		return $this->db->insert_id();
    }    
	
	function insertPatientMaterialImages($data) {
        $this->db->insert('patient_material_images', $data);
 		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('patient_material_images');          
		return $this->db->insert_id();
    }	
	
	function insertPatientRefractionImages($data) {
        $this->db->insert('patient_refraction_images', $data);
		return $this->db->insert_id();
    }	
	
	function insertPatientOctImages($data) {
        $this->db->insert('patient_oct_images', $data);
		return $this->db->insert_id();
    }	
	
	function insertPatientResultImages($data) {
        $this->db->insert('patient_result_images', $data);
		return $this->db->insert_id();
    }
		
	function insertPatientReferalImages($data) {
        $this->db->insert('patient_referal_images', $data);
		return $this->db->insert_id();
    }
	
	function insertPatientPhotographImages($data) {
        $this->db->insert('patient_photograph_images', $data);
		return $this->db->insert_id();
    }

    function getPatientMaterial() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_material');
        return $query->result();
    }      
	
	function getPatientRefraction() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_refraction');
        return $query->result();
    }    
		
	function getPatientOct() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_oct');
        return $query->result();
    }    
			
	function getPatientPhotograph() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_photograph');
        return $query->result();
    }    
				
	function getPatientResult() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_result');
        return $query->result();
    }    
					
	function getPatientReferal() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_referal');
        return $query->result();
    }    
	
	function getPatientMaterialImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_material_images');
        return $query->result();
    }	
	
	function getPatientRefractionImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_refraction_images');
        return $query->result();
    }
    
    	
	function getPatientOctImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_oct_images');
        return $query->result();
    }
        	
	function getPatientPhotographImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_photograph_images');
        return $query->result();
    }
            	
	function getPatientReferalImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_referal_images');
        return $query->result();
    }
                	
	function getPatientResultImages() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_result_images');
        return $query->result();
    }
    
    
      function getDocumentBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_material');
        return $query->result();
    }       
	
	function getDocumentImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('image_id', $search);
       // $this->db->or_like('patient_name', $search);
        $query = $this->db->get('patient_material_images');
        return $query->result();
    }        
	
	function getRefractionBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_refraction');
        return $query->result();
    }      
		
	function getOctBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_oct');
        return $query->result();
    }      
			
	function getPhotographBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_photograph');
        return $query->result();
    }      
				
	function getReferalBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_referal');
        return $query->result();
    }      
					
	function getResultBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $query = $this->db->get('patient_result');
        return $query->result();
    }      
	
	function getRefractionImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('patient_id', $search);
        $this->db->or_like('image_name', $search);
        $query = $this->db->get('patient_refraction_images');
        return $query->result();
    }
	
	function getOctImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('patient_id', $search);
        $this->db->or_like('image_name', $search);
        $query = $this->db->get('patient_oct_images');
        return $query->result();
    }
	
	function getPhotographImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('patient_id', $search);
        $this->db->or_like('image_name', $search);
        $query = $this->db->get('patient_photograph_images');
        return $query->result();
    }
	
	function getReferalImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('patient_id', $search);
        $this->db->or_like('image_name', $search);
        $query = $this->db->get('patient_referal_images');
        return $query->result();
    }
	
	function getResultImagesBySearch($search) {
        $this->db->order_by('id', 'asc');
        $this->db->like('patient_id', $search);
        $this->db->or_like('image_name', $search);
        $query = $this->db->get('patient_result_images');
        return $query->result();
    }

    function getRefractionByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_refraction');
        return $query->result();
    }    
	
    function getOctByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_oct');
        return $query->result();
    }    
		
    function getPhotographByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_photograph');
        return $query->result();
    }    
			
    function getResultByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_result');
        return $query->result();
    }  			
    function getReferalByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal');
        return $query->result();
    }    
	
	function getDocumentImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material_images');
        return $query->result();
    }	
	
	function getRefractionImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_refraction_images');
        return $query->result();
    }
	
	function getOctImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_oct_images');
        return $query->result();
    }
	
	function getPhotographImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_photograph_images');
        return $query->result();
    }
	
	function getResultImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_result_images');
        return $query->result();
    }
	
	function getReferalImagesByLimit($limit, $start) {
        $this->db->order_by('id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal_images');
        return $query->result();
    }

    function getDocumentByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'asc');
        
        $this->db->or_like('date_string', $search);

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('title', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material');
        return $query->result();
    }    
	    
		function getRefractionByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'asc');
        $this->db->or_like('date_string', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('title', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_refraction');
        return $query->result();
    } 	    
		function getOctByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'asc');
        $this->db->or_like('date_string', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('title', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_oct');
        return $query->result();
    }  

	function getPhotographByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'asc');
        $this->db->or_like('date_string', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('title', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_photograph');
        return $query->result();
    }  		
	
	function getResultByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'asc');
        $this->db->or_like('date_string', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('title', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_result');
        return $query->result();
    } 	
	function getReferalByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'asc');
        $this->db->or_like('date_string', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);
        $this->db->or_like('title', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal');
        return $query->result();
    }    
	
	function getDocumentImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material_images');
        return $query->result();
    }	
	
	function getRefractionImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_refraction_images');
        return $query->result();
    }
	
	function getOctImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_oct_images');
        return $query->result();
    }
	
	function getPhotographImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_photograph_images');
        return $query->result();
    }
	
	function getResultImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_result_images');
        return $query->result();
    }
	
	function getReferalImagesByLimitBySearch($limit, $start, $search) {

        $this->db->like('patient_id', $search);
        $this->db->order_by('id', 'asc');       
        $this->db->or_like('date', $search);
        $this->db->or_like('date_string', $search);
        $this->db->or_like('image_name', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_referal_images');
        return $query->result();
    }

    function getPatientMaterialById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_material');
        return $query->row();
    }      
	
	function getPatientRefractionById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_refraction');
        return $query->row();
    } 	
	
	function getPatientOctById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_oct');
        return $query->row();
    }    
		
	function getPatientPhotographById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_photograph');
        return $query->row();
    }    
			
	function getPatientReferalById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_referal');
        return $query->row();
    }    
				
	function getPatientResultById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_result');
        return $query->row();
    }    
	
	function getPatientMaterialImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_material_images');
        return $query->row();
    }	
	
	function getPatientRefractionImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_refraction_images');
        return $query->row();
    }
	
	function getPatientOctImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_oct_images');
        return $query->row();
    }
	
	function getPatientPhotographImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_photograph_images');
        return $query->row();
    }
	
	function getPatientResultImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_result_images');
        return $query->row();
    }
	
	function getPatientReferalImagesById($id) {
        $this->db->where('image_id', $id);
        $query = $this->db->get('patient_referal_images');
        return $query->row();
    }

    function getPatientMaterialByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }     
	
	function getPatientRefractionByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_refraction');
        return $query->result();
    }    
		
	function getPatientOctByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_oct');
        return $query->result();
    }    
			
	function getPatientPhotographByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_photograph');
        return $query->result();
    }    
				
	function getPatientReferalByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_referal');
        return $query->result();
    }    
					
	function getPatientResultByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_result');
        return $query->result();
    }    
	
	function getPatientMaterialImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_material_images');
        return $query->result();
    }	
	
	function getPatientRefractionImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_refraction_images');
        return $query->result();
    }
	
	function getPatientOctImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_oct_images');
        return $query->result();
    }
	
	function getPatientPhotographImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_photograph_images');
        return $query->result();
    }
	
	function getPatientResultImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_result_images');
        return $query->result();
    }
	
	function getPatientReferalImagesByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('patient_referal_images');
        return $query->result();
    }

    function deletePatientMaterial($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_material');
    }     

	function deletePatientRefraction($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_refraction');
    }    
	
	function deletePatientOct($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_oct');
    }    
		
	function deletePatientPhotograph($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_photograph');
    }    
			
	function deletePatientReferal($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_referal');
    }    
				
	function deletePatientResult($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_result');
    }    
	
	function deletePatientMaterialImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_material_images');
    }	
	
	function deletePatientRefractionImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_refraction_images');
    }
	
	function deletePatientOctImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_oct_images');
    }
	
	function deletePatientPhotographImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_photograph_images');
    }
	
	function deletePatientResultImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_result_images');
    }
	
	function deletePatientReferalImages($id) {
        $this->db->where('patient_id', $id);
        $this->db->delete('patient_referal_images');
    }

    function deleteMedicalHistory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medical_history');
    }    
	
	function deleteNurseNotes($id) {
        $this->db->where('id', $id);
        $this->db->delete('nurse_notes');
    } 		
	
	function deleteReferralNew($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_referal_new');
    } 	
	
	function deleteConsentForms($id) {
        $this->db->where('id', $id);
        $this->db->delete('consent_form');
    }   	
	
	function deleteSickLeave($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_sickleave');
    }    
	
	function deleteDoctorNotes($id) {
        $this->db->where('id', $id);
        $this->db->delete('doctor_notes');
    }

    function updateIonUser($username, $email, $password, $first_name1, $last_name1, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name1,
            'last_name' => $last_name1
			);
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getUsersById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

function getDueBalanceByPatientId($patient) {
    // Database connection details
    $hostname = 'localhost';
    $username = 'secureispecs_emr_setup';
    $password = 'RukrIp69FR(0';
    $database = 'secureispecs_emr';
    
    // Establish MySQLi connection
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        error_log("Connection failed: " . mysqli_connect_error());
        return false; // Return false on connection failure
    }
    
    // Initialize variables
    $total_payable_bill = 0;
    $total_deposit = 0;
    
    // Query pharmacy_payment for patient
    $query = "SELECT gross_total, amount_received FROM pharmacy_payment WHERE patient = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($conn));
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $patient);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Calculate total bill and amount received
    $payments = [];
    while ($payment = mysqli_fetch_object($result)) {
        $payments[] = $payment;
        // Sum gross_total for total payable bill (adjust to amount_due if needed)
        $bill_amount = !empty($payment->gross_total) ? floatval($payment->gross_total) : 0;
        $total_payable_bill += $bill_amount;
    }
    mysqli_stmt_close($stmt);
    
    // Query patient_deposit for patient
    $query = "SELECT deposited_amount, amount_received_id FROM patient_deposit WHERE patient = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($conn));
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $patient);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch deposits
    $deposits = [];
    while ($deposit = mysqli_fetch_object($result)) {
        $deposits[] = $deposit;
    }
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
    
    // Add up amount_received from all payments
    foreach ($payments as $payment) {
        $received = !empty($payment->amount_received) ? array_sum(array_map('floatval', array_filter(explode(',', $payment->amount_received), 'is_numeric'))) : 0;
        $total_deposit += $received;
    }
    
    // Add up extra deposits not linked to amount_received_id
    foreach ($deposits as $deposit) {
        if (!empty($deposit->deposited_amount) && empty($deposit->amount_received_id)) {
            $deposit_amount = floatval($deposit->deposited_amount);
            $total_deposit += $deposit_amount;
        }
    }
    
    // Calculate due amount
    $due_balance = $total_payable_bill - $total_deposit;
    
    // Debugging output (remove in production)
    error_log("Patient ID: $patient");
    error_log("Total Payable Bill (gross_total): $total_payable_bill");
    error_log("Total Deposits: $total_deposit");
    error_log("Due Balance: $due_balance");
    
    return $due_balance;
}
    
    
   function getPatientInfo($searchTerm) {
       if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%' OR first_name like '%" . $searchTerm . "%'OR last_name like '%" . $searchTerm . "%' OR phone like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            if(empty($user['age'])){
                $dateOfBirth = $user['birthdate'];
                if(empty($dateOfBirth)){
                    $age[0]='0';
                }else{
                    if(strtotime($dateOfBirth)){
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        $age[0]=$diff->format('%y');
                    }else{
                        $age[0]='';
                    }
                }
                
            }else{
                $age=explode('-',$user['age']);
            }
            $data[] = array("id" => $user['id'], "text" => $user['first_name'] . ' ' . $user['last_name'] . '- '.lang('phone'). ': '.$user['phone']);
        }
        return $data;
    }


     function getPatientinfoWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%' OR first_name like '%" . $searchTerm . "%'OR last_name like '%" . $searchTerm . "%' OR phone like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
           
            if(empty($user['age'])){
                $dateOfBirth = $user['birthdate'];
                if(empty($dateOfBirth)){
                    $age[0]='0';
                }else{
                    if(strtotime($dateOfBirth)){
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    $age[0]=$diff->format('%y');
                    }else{
                        $age[0]='';
                    }
                }
                
            }else{
                $age=explode('-',$user['age']);
            }
             $data[] = array("id" => $user['id'], "text" => $user['first_name'] . ' ' . $user['last_name'] . '- '.lang('phone'). ': '.$user['phone']);
        }
        return $data;
    }
/*	
		function docnotes_csv_select(){
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('doctor_notes');
		return $query;
	}

		function docnotes_csv_insert($data){
		$this->db->insert_batch('doctor_notes', $data);
	}
*/
}


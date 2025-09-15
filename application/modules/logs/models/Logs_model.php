<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertUsersLog($data) {
        $this->db->insert('logs_user', $data);
    }    
	
	function insertFramesLog($data) {
        $this->db->insert('logs_frame', $data);
    }

    function getUsersLog() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs_user');
        return $query->result();
    }    
	
	function getFramesLog() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs_frame');
        return $query->result();
    }

    function getUsersLogById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('logs_user');
        return $query->row();
    }    
	
	function getFramesLogById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('logs_frame');
        return $query->row();
    }

    function updateUsersLog($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('logs_user', $data);
    }    
	
	function updateFrameLog($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('logs_frame', $data);
    }

    function deleteUsersLog($id) {
        $this->db->where('id', $id);
        $this->db->delete('logs_user');
    }    
	
	function deleteFramesLog($id) {
        $this->db->where('id', $id);
        $this->db->delete('logs_frame');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }



 public function insertTransactionLogs($data) {
        $this->db->insert('transaction_logs', $data);
    }
     function getTransactionLogsWithoutSearch($order, $dir) {
        // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
         
         if ($order != null) {
             $this->db->order_by($order, $dir);
         } else {
             //$this->db->order_by('id', 'desc');
             $this->db->order_by('name', 'asc');
         }
      
         $this->db->order_by('id', 'desc');
         $query = $this->db->get('transaction_logs');
         return $query->result();
     }
 
     function getTransactionLogsBySearch($search, $order, $dir) {
        // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
 
         if ($order != null) {
             $this->db->order_by($order, $dir);
         } else {
             //$this->db->order_by('id', 'desc');
             $this->db->order_by('name', 'asc');
         }
         $query = $this->db->select('*')
                 ->from('transaction_logs')
                
                 ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                 ->get();
         ;
         return $query->result();
     }
 
     function getTransactionLogsByLimit($limit, $start, $order, $dir) {
        // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
 
        
         if ($order != null) {
             $this->db->order_by($order, $dir);
         } else {
             //$this->db->order_by('id', 'desc');
             $this->db->order_by('name', 'asc');
         }
         $this->db->limit($limit, $start);
         $query = $this->db->get('transaction_logs');
         return $query->result();
     }
 
     function getTransactionLogsByLimitBySearch($limit, $start, $search, $order, $dir) {
        // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
 
         if ($order != null) {
             $this->db->order_by($order, $dir);
         } else {
             //$this->db->order_by('id', 'desc');
             $this->db->order_by('name', 'asc');
         }
         $this->db->limit($limit, $start);
         $query = $this->db->select('*')
                 ->from('transaction_logs')
              
                 ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                 ->get();
         ;
         return $query->result();
     }
     
     function getTransactionLogsCount($search = '') {
    $this->db->from('transaction_logs');
    if (!empty($search)) {
        $this->db->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%' OR action LIKE '%" . $search . "%')", NULL, FALSE);
    }
    return $this->db->count_all_results();
}
}
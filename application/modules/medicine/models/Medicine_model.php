<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMedicine($data) {
        $this->db->insert('medicine', $data);
    }     
	
	function insertOwnFrame($data) {
        $this->db->insert('ownframe', $data);
    }     
	
	function insertService($data) {
        $this->db->insert('medicine', $data);
    }    

    function insertFrameType($data) {
        $this->db->insert('frame_type', $data);
    }     
    
    function insertFrameItems($data) {
        $this->db->insert('frame_items', $data);
    }  
    	
	function insertLoadMedicine($data2) {
        $this->db->insert('medicine_loadhistory', $data2);
    }

    // Updated to support filtering by type
    function getMedicine($type = null) {
        $this->db->order_by('id', 'asc');
        if ($type) {
            $this->db->where('type', $type);
        }
        $query = $this->db->get('medicine');
        return $query->result();
    }    
	
	// Fixed incomplete method
	function getMedicineCompare() {
        $this->db->select('*');
        $fetched_records = $this->db->get('medicine');
        return $fetched_records->result();
    }

    // Updated to support filtering by type
    function getLatestMedicine($type = null) {
        $this->db->order_by('id', 'desc'); // Changed to 'desc' for latest records
        if ($type) {
            $this->db->where('type', $type);
        }
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineLimitByNumber($number) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', $number);
        return $query->result();
    }

    function getMedicineByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByStockAlert() {
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByStockAlertByPageNumber($page_number) {
        $data_range_1 = 50 * $page_number;
        $this->db->where('quantity <=', 20);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine');
        return $query->row();
    }    
    
    function getFrameTypeID($frame_type) {
    	$this->db->select('*');
        $this->db->where('name', $frame_type);
        $query = $this->db->get('frame_type');
        return $query->row();
    }    
	
	function getOwnFrameID($id) {
    	$this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('ownframe');
        return $query->row();
    }

    function getMedicineByKeyByStockAlert($page_number, $key) {
        $data_range_1 = 50 * $page_number;

        $this->db->where('quantity <=', 20);
        $this->db->or_like('name', $key);
        $this->db->or_like('company', $key);

        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKey($page_number, $key) {
        $data_range_1 = 50 * $page_number;
        $this->db->like('name', $key);
        $this->db->or_like('company', $key);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine', 50, $data_range_1);
        return $query->result();
    }

    function getMedicineByKeyForPos($key) {
        $this->db->like('name', $key);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function updateMedicine($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine', $data);
    }    
    
	function updateService($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine', $data);
    }    

    function updateFrameType($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('frame_type', $data);
    }   
    
    function updateFrameItems($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('frame_items', $data);
    } 
    	
	function insertMedicineHistory($data2) {
		$this->db->insert('medicine_history', $data2);
    }	
	
	function getMedicineHistoryById($frame_id) {
        $this->db->where('frame_id', $frame_id);
		$this->db->order_by('frame_id', 'asc');
        $query = $this->db->get('medicine_history');
        return $query->row();
    }
    
	function getMedicineHistory() {
		$this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine_history');
        return $query->result();
    }
	
    function insertMedicineCategory($data) {
        $this->db->insert('medicine_category', $data);
    }

    function getMedicineCategory() {
		$this->db->order_by('category', 'asc');
        $query = $this->db->get('medicine_category');
        return $query->result();
    }    
	
    function getService() {
        $this->db->where('type', 'services'); // Updated to filter by type = 'services'
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }      
	
	function getOwnFrame() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('ownframe');
        return $query->result();
    }  
	
    function getFrameType() {
		$this->db->order_by('id', 'asc');
        $query = $this->db->get('frame_type');
        return $query->result();
    }   
    
    function getFrameTypeItems() {
		$this->db->order_by('id', 'asc');
        $query = $this->db->get('frame_items');
        return $query->result();
    }

    function getMedicineCategoryById($id) {
        $this->db->where('id', $id);
		$this->db->order_by('category', 'asc');
        $query = $this->db->get('medicine_category');
        return $query->row();
    }    
	
	function getServiceById($id) {
        $this->db->where('id', $id);
		$this->db->order_by('category', 'asc');
        $query = $this->db->get('medicine_category');
        return $query->row();
    }	
	
	function getOwnFrameById($id) {
        $this->db->where('id', $id);
		$this->db->order_by('category', 'asc');
        $query = $this->db->get('ownframe');
        return $query->row();
    }

    function getFrameTypeById($id) {
        $this->db->where('id', $id);
		$this->db->order_by('id', 'asc');
        $query = $this->db->get('frame_type');
        return $query->row();
    }    
    
    function getFrameItemsById($id) {
        $this->db->where('id', $id);
		$this->db->order_by('id', 'asc');
        $query = $this->db->get('frame_items');
        return $query->row();
    }    
    
    function getFrameTypeByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('frame_type');
        return $query->row();
    }    
	
	function getOwnFrameByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('ownframe');
        return $query->row();
    }    
    
    function getFrameItemsByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('frame_items');
        return $query->row();
    }    
    
    function getFrameItemsByName2($name) {
        $this->db->where('frame_type_name', $name);
        $query = $this->db->get('frame_items');
        return $query->row();
    }
    
    function totalStockPrice() {
        $query = $this->db->get('medicine')->result();
        $stock_price = array();
        foreach ($query as $medicine) {
            $stock_price[] = $medicine->price * $medicine->quantity;
        }

        if (!empty($stock_price)) {
            return array_sum($stock_price);
        } else {
            return 0;
        }
    }

    function updateMedicineCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medicine_category', $data);
    }

    function deleteMedicine($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine');
    }

    function deleteFrameType($id) {
        $this->db->where('id', $id);
        $this->db->delete('frame_type');
    }     
	
	function deleteService($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine');
    }    
    
    function deleteFrameItems($id) {
        $this->db->where('id', $id);
        $this->db->delete('frame_items');
    }
    
    function deleteMedicineCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medicine_category');
    }

    function getMedicineBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('category', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('e_date', $search);
        $this->db->or_like('box', $search);
        $this->db->or_like('company', $search);
        $this->db->or_like('effects', $search);
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineByLimitBySearch($limit, $start, $search) {
        $this->db->like('id', $search);
        $this->db->order_by('id', 'desc');
        $this->db->or_like('category', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('e_date', $search);
        $this->db->or_like('box', $search);
        $this->db->or_like('company', $search);
        $this->db->or_like('effects', $search);
        $this->db->limit($limit, $start);
        $query = $this->db->get('medicine');
        return $query->result();
    }

    function getMedicineNameByAvailablity($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('medicine');
            $query = $fetched_records->result();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('medicine');
            $query = $fetched_records->result();
        }
        return $query;
    }

    function getMedicineInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('medicine');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('medicine');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'] .  '*' . $user['name'] , "text" => $user['name']);
        }
        return $data;
    }

    function getMedicineInfoForPharmacySale($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('quantity >', '0');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('medicine');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('quantity >', '0');
            $this->db->limit(10);
            $fetched_records = $this->db->get('medicine');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'].'*'.(float) $user['s_price'].'*'.$user['name'].'*'.$user['company'].'*'.$user['quantity'], "text" => $user['name']);
        }
        return $data;
    }
}
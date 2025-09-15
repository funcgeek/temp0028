<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pharmacy extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pharmacy_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('settings/settings_model');
		$this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('accountant/accountant_model');
        $this->load->model('receptionist/receptionist_model');
        $this->load->model('nurse/nurse_model');		
		$this->load->model('finance/finance_model');
		$this->load->library('session');
        $data['settings'] = $this->settings_model->getSettings();
       /* if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            redirect('home/permission');
        }*/
    }

    function home() {
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['latest_medicines'] = $this->medicine_model->getLatestMedicine();
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->pharmacy_model->getPayment();
        $data['expenses'] = $this->pharmacy_model->getExpense();
        $data['today_sales_amount'] = $this->pharmacy_model->todaySalesAmount();
        $data['today_expenses_amount'] = $this->pharmacy_model->todayExpensesAmount();
        
        
        
        $data['this_month']['payment'] = $this->pharmacy_model->thisMonthPayment();
        $data['this_month']['expense'] = $this->pharmacy_model->thisMonthExpense();


        $data['this_day']['payment'] = $this->pharmacy_model->thisDayPayment();
        $data['this_day']['expense'] = $this->pharmacy_model->thisDayExpense();


        $data['this_year']['payment'] = $this->pharmacy_model->thisYearPayment();
        $data['this_year']['expense'] = $this->pharmacy_model->thisYearExpense();

        
        
        $data['this_year']['payment_per_month'] = $this->pharmacy_model->getPaymentPerMonthThisYear();
        
        
        $data['this_year']['expense_per_month'] = $this->pharmacy_model->getExpensePerMonthThisYear();
        
        
        
        
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance/pharmacy/home', $data);
        $this->load->view('home/footer');
    }

    public function index() {
        redirect('pharmacy/financial_report');
    }

     public function sellNow() {
		$id = $this->input->get('id');
		$type = $this->input->get('type');
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();
        $data['allservices'] = $this->medicine_model->getService();		
        $data['allownframes'] = $this->medicine_model->getOwnFrame();		
		$data['discount_type2'] = $this->finance_model->getDiscountType();	
		$data['discount_type'] = $this->finance_model->getDiscountType();
		$data['doctors'] = $this->doctor_model->getDoctor();		
	//	$data['patients'] = $this->patient_model->getPatient();			
		$data['patient'] = $this->patient_model->getPatientById($id);		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance/pharmacy/sell_now', $data);
        $this->load->view('home/footer'); // just the header file
    }      
/*	
	public function sellNowSingle() {
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();		
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance/pharmacy/sell_now_single', $data);
        $this->load->view('home/footer'); // just the header file
    }     
 */   
	public function sellNowSingle() {
		$id = $this->input->get('id');
		$type = $this->input->get('type');
		
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
      //  $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
		$data['patient'] = $this->patient_model->getPatientById($id);
        $data['discount_type2'] = $this->finance_model->getDiscountType();
		$data['medicines'] = $this->medicine_model->getMedicine();
        $data['allservices'] = $this->medicine_model->getService();	
		$data['allownframes'] = $this->medicine_model->getOwnFrame();		
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();		
        $data['settings'] = $this->settings_model->getSettings();
		

        if ($type == 'gen') {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('finance/pharmacy/sell_now_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        } else {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('finance/pharmacy/sell_now_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        }
		
    }	
	
	
    public function getFrameItemsbyType() {
 //       $response = $this->medicine_model->getFrameItemsByName($name);
  //      echo json_encode($response); 
        
        $data = array();
        $name = $this->input->get('name');
        $doctor = $this->input->get('doctor');
        $data['frameitems'] = $this->medicine_model->getFrameItemsByName($name);
        echo json_encode($data);        
 }
 
     function getFrameItemsNameByJason() {
        $data = array();
        $name = $this->input->get('framelens');
        $lensitems = $this->input->get('frameitems');
        $data['lens'] = $this->medicine_model->getFrameItemsByName2($name);
        echo json_encode($data);
    }
    
    
    public function payment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->pharmacy_model->getPayment();
        // $data['payments'] = $this->pharmacy_model->getPaymentByPageNumber($page_number);


        $data['pagee_number'] = $page_number;
        $data['p_n'] = '0';

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function paymentByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['payments'] = $this->pharmacy_model->getPaymentByPageNumber($page_number);
        $data['pagee_number'] = $page_number;
        $data['p_n'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentView() {
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
		$data['patients'] = $this->patient_model->getPatient();		
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['categories'] = $this->medicine_model->getMedicineCategory();
        $data['medicinehistories'] = $this->medicine_model->getMedicineHistory();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
		$data['historiesbyid'] = $this->medicine_model->getMedicineHistoryById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();		
        $data['settings'] = $this->settings_model->getSettings();		
		
		
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_payment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }    
    public function addPaymentView0() {
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
		$data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_payment_view0', $data);
        $this->load->view('home/footer'); // just the header file
    }    
    
    public function shoppingCartView() {
    	$userid = $this->ion_auth->get_user_id();
    	//$userid = $this->input->get('user_id');
		$id = $this->db->get_where('cart', array('patient_id' => $id))->row()->amount_received;
		$type = $this->input->get('type');
        $data = array();

        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['carts'] = $this->pharmacy_model->getCartByUserId($userid);
		$data['cartuser'] = $this->pharmacy_model->getCartUserId($userid);
		$data['doctors'] = $this->doctor_model->getDoctor();
    //    $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotalByUserid($userid);
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
		 $data['categories'] = $this->finance_model->getPaymentCategory();
		 $data['allownframes'] = $this->medicine_model->getOwnFrame();
		$data['patients'] = $this->patient_model->getPatient();		
		$data['patient'] = $this->patient_model->getPatientById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance/pharmacy/shopping_cart', $data);
        $this->load->view('home/footer'); // just the header file
    }   
	
	public function shoppingCartSingleView() {
    	$userid = $this->ion_auth->get_user_id();
    	//$userid = $this->input->get('user_id');
		$id = $this->db->get_where('cart', array('patient_id' => $id))->row()->amount_received;
		$type = $this->input->get('type');
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['carts'] = $this->pharmacy_model->getCartByUserId($userid);
		$data['cartuser'] = $this->pharmacy_model->getCartUserId($userid);
    //    $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotal();
        $data['cart_subtotal'] = $this->pharmacy_model->getCartSubtotalByUserid($userid);
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
		 $data['categories'] = $this->finance_model->getPaymentCategory();
		 $data['allownframes'] = $this->medicine_model->getOwnFrame();
		$data['patients'] = $this->patient_model->getPatient();		
		$data['patient'] = $this->patient_model->getPatientById($id);
		$data['frame_types'] = $this->medicine_model->getFrameType();
        $data['frame_items'] = $this->medicine_model->getFrameTypeItems();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('finance/pharmacy/shopping_cart_single', $data);
        $this->load->view('home/footer'); // just the header file
    }	
	
	
	    function addPaymentByPatientView() {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
		 $data['medicines'] = $this->medicine_model->getMedicine();
     //   $data['categories'] = $this->medicine_model->getPaymentCategory();
      //  $data['gateway'] = $this->medicine_model->getGatewayByName($data['settings']->payment_gateway);
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['patient'] = $this->patient_model->getPatientById($id);
        if ($type == 'gen') {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('pharmacy/add_payment_view_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        } else {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('pharmacy/add_ot_payment_view_single', $data);
            $this->load->view('home/footer'); // just the footer fi
        }
    }
	
    public function addPaymentViewDebug() {
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_payment_view_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getMedicineByKeyJason() {
        $key = $this->input->get('keyword');
        $medicines = $this->medicine_model->getMedicineByKeyForPos($key);

        $data[] = array();
        $lists = array();
        $options = array();
        $selected = array();
        foreach ($medicines as $medicine) {
            if ($medicine->quantity > 0) {
                $lists[] = '<li class="ooppttiioonn ms-elem-selectable" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '" data-m_name="' . $medicine->name . '" data-c_name="' . trim($medicine->effects) . '" id="' . $medicine->id . '-selectable"><span>' . $medicine->name . '</span></li>';
                $options[] = '<option class="ooppttiioonn" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '" data-m_name="' . $medicine->name . '" data-c_name="' . trim($medicine->effects) . '" value="' . $medicine->id . '">' . $medicine->name . '</option>';
                $selected[] = '<li class="ooppttiioonn ms-elem-selection" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '"data-m_name="' . $medicine->name . '"data-c_name="' . trim($medicine->effects) . '" id="' . $medicine->id . '-selection" style="display: none;"><span> ' . $medicine->name . '  </span></li>';
            }
        }
        $data['ltst'] = $lists;
        $data['opp'] = $options;
        $data['slt'] = $selected;

        $lists = NULL;
        $options = NULL;
        $selected = NULL;

        echo json_encode($data);
    }

    function searchPayment() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['payments'] = $this->pharmacy_model->getPaymentByKey($page_number, $key);
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }


public function addPayment() {
    $id = $this->input->post('id');
    $item_id = $this->input->post('medicine_id');
    $pframeid = $this->input->post('pframeid');      
    $item_qty1 = array();
    $item_qty1 = $this->input->post('item_qty');
    $item_qty = $this->input->post('item_qty');
    $item_name = $this->input->post('item_name');
    $service_name = $this->input->post('service_name');
    $ftype = $this->input->post('ftype');
    $item_color = $this->input->post('item_color');
    $item_price = $this->input->post('item_price');
    $item_size = $this->input->post('item_size');
    $item_cat = $this->input->post('item_cat');
    $len_lens = $this->input->post('len_lens');
    $len_misc = $this->input->post('len_misc');
    $len_frame = $this->input->post('len_frame');
    $len_price = $this->input->post('len_price');
    $location = $this->input->post('location');
    $users = $this->input->post('users');
    $userid = $this->ion_auth->get_user_id(); // Use user_id consistently

    $patient = $this->input->post('patient');
    $doctor = $this->input->post('doctor');
    $date = time();
    $date2 = $this->input->post('item_date');
    $discount = $this->input->post('discount');
    $sub_total = $this->input->post('subtotal');
    $remarks = $this->input->post('remarks');
    $gross_total = $this->input->post('grsss');

    $date_string = date('d-m-y', $date);
    $date_string2 = date('d-m-y', $date2);

    $amount_received1 = $this->input->post('amount_received');
    $receive_breakdown1 = $this->input->post('amount_received');
    $deposit_type1 = $this->input->post('deposit_type');
    
    $amount_received = implode(',', $amount_received1);
    $deposit_type = implode(',', $deposit_type1);
    $receive_breakdown = implode(',', $receive_breakdown1);
    
    $amount_received_ex = explode(",", $amount_received);
    $amount_received_add = array_sum($amount_received_ex);
    $balance = $gross_total - $amount_received_add;

    $patient_fname = $this->db->get_where('patient', array('id' => $patient))->row()->first_name;
    $patient_mname = $this->db->get_where('patient', array('id' => $patient))->row()->middle_name;
    $patient_lname = $this->db->get_where('patient', array('id' => $patient))->row()->last_name;
    $patient_id = $this->db->get_where('patient', array('id' => $patient))->row()->id;

    $item_quantity_array = $this->input->post('pframeid');

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        echo 'form validate noe nai re';
    } else {
        if ($amount_received_add == $gross_total) {
            $status = "Paid";
        } elseif ($amount_received_add > 0 && $amount_received_add < $gross_total) {
            $status = "Part Payment";
        } else {
            $status = "Unpaid";
        }

        $data = array();
        $data1 = array();
        $data_fin = array();

        if (empty($id)) {
            $data = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'location' => $location,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'patient_first_name' => $patient_fname,
                'patient_last_name' => $patient_lname,
                'doctor' => $doctor,
                'date' => $date,
                'subtotal' => $sub_total,
                'amount' => $sub_total,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'full_total' => $gross_total,
                'amount_received' => $amount_received_add,
                'payment_received' => $amount_received_add,
                'balance' => $balance,
                'receive_breakdown' => $receive_breakdown,
                'deposit_type' => $deposit_type,
                'user' => $userid,
                'f_type' => $ftype,
                'date_string' => $date_string,
                'remarks' => $remarks,
                'status' => $status
            );

            $data_fin = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'location' => $location,
                'date' => $date,
                'amount' => $sub_total,
                'doctor' => $doctor,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'amount_received' => $amount_received_add,
                'payment_received' => $amount_received_add,
                'status' => $status,
                'user' => $userid,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'patient_first_name' => $patient_fname,
                'patient_last_name' => $patient_lname,
                'date_string' => $date_string,
                'deposit_type' => $deposit_type,
                'receive_breakdown' => $receive_breakdown,
                'amount_due' => $balance,
                'remarks' => $remarks
            );

            $this->pharmacy_model->insertPayment($data);
            $inserted_id = $this->db->insert_id();
            
            //$this->finance_model->insertPayment($data_fin);
            //$inserted_id_f = $this->db->insert_id();

            $pay_id = $this->db->get_where('payment', array('id' => $inserted_id))->row()->id;

            $query1 = $this->db->query("SELECT * FROM cart;");
            foreach ($query1->result() as $row) {
                $data1 = array(
                    'frame_id' => $row->frame_id,
                    'pharmacy_payment_id' => $inserted_id,
                    'name' => $row->name,
                    'location' => $row->location,
                    'model' => $row->name,
                    'category' => $row->category,
                    'color' => $row->color,
                    'size' => $row->size,
                    'quantity' => $row->quantity,
                    'price' => $row->price,
                    'framelens' => $row->framelens,
                    'frameitems' => $row->frameitems,
                    'user_name' => $row->users,
                    'lens_price' => $row->lens_price,
                    'misc' => $row->misc,
                    'patient_id' => $patient,
                    'f_type' => $ftype,
                    'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                    'date' => $date_string2
                );

                $this->pharmacy_model->insertItemPayment($data1);

                $previous_mb_qty = $this->db->get_where('medicine', array('id' => $row->frame_id))->row()->quantity;
                $previous_fl_qty = $this->db->get_where('medicine', array('id' => $row->frame_id))->row()->quantity_2;

                $new_qty_mb = $previous_mb_qty - $row->quantity;
                $new_qty_fl = $previous_fl_qty - $row->quantity;

                if ($row->location == "Montego Bay") {
                    $this->db->where('id', $row->frame_id);
                    $this->db->update('medicine', array('quantity' => $new_qty_mb));
                } elseif ($row->location == "Falmouth") {
                    $this->db->where('id', $row->frame_id);
                    $this->db->update('medicine', array('quantity_2' => $new_qty_fl));
                }
            }

            $this->db->where('user_id', $userid);
            $this->db->delete('cart');

            // Log the transaction for adding a new payment
            $this->load->model('logs/logs_model');
            $this->logs_model->insertTransactionLogs([
                'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:43:00
                'invoice_id' => $inserted_id,
                'patientname' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'deposit_type' => $deposit_type,
                'payment_gateway' => 'N/A', // Adjust if payment gateway is used
                'action' => 'Added Payment',
                'amount' => $gross_total,
                'user' => $userid
            ]);

            $this->session->set_flashdata('feedback', lang('added'));
            redirect("finance/pharmacy/invoice?id=" . "$inserted_id");
        } else {
            $data = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'location' => $location,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'patient_first_name' => $patient_fname,
                'patient_last_name' => $patient_lname,
                'doctor' => $doctor,
                'date' => $date,
                'subtotal' => $sub_total,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'amount_received' => $amount_received_add,
                'balance' => $balance,
                'user_name' => $users,
                'receive_breakdown' => $receive_breakdown,
                'deposit_type' => $deposit_type,
                'date_string' => $date_string,
                'remarks' => $remarks,
                'f_type' => $ftype,
                'status' => $status
            );

            $data_fin = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'location' => $location,
                'date' => $date,
                'amount' => $sub_total,
                'doctor' => $doctor,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'status' => $status,
                'user' => $userid,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'patient_first_name' => $patient_fname,
                'patient_last_name' => $patient_lname,
                'date_string' => $date_string,
                'amount_due' => $balance,
                'remarks' => $remarks
            );

            $this->pharmacy_model->updatePayment($id, $data);
            $this->pharmacy_model->updateItemPayment($id, $data);
            //$this->finance_model->insertPayment($data_fin);
            $inserted_id_f = $this->db->insert_id();

            $data_dep = array(
                'date' => $date,
                'patient' => $patient,
                'deposited_amount' => $amount_received_add,
                'payment_id' => $inserted_id_f,
                'amount_received_id' => $inserted_id_f . '.' . 'gp',
                'amount_due' => $balance,
                'deposit_type' => $deposit_type,
                'user' => $userid
            );
            $this->finance_model->insertDeposit($data_dep);

            $data_payment = array('amount_received' => $amount_received_add, 'deposit_type' => $deposit_type, 'amount_due' => $balance);
            $this->finance_model->updatePayment($inserted_id_f, $data_payment);

            $this->db->truncate('cart');

            // Log the transaction for updating a payment
            $this->load->model('logs/logs_model');
            $this->logs_model->insertTransactionLogs([
                'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:43:00
                'invoice_id' => $id,
                'patientname' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'deposit_type' => $deposit_type,
                'payment_gateway' => 'N/A', // Adjust if payment gateway is used
                'action' => 'Updated Payment',
                'amount' => $gross_total,
                'user' => $userid
            ]);

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect("finance/pharmacy/invoice?id=" . "$id");
        }
    }
}


 public function addCartItems() {
    $id = $this->input->post('id');
    $pframeid = $this->input->post('pframeid');
    $item_selected = array();
    $quantity = array();
    $item_selected = $this->input->post('medicine_id');
    $quantity = $this->input->post('quantity');
    $ftype = $this->input->post('ftype');

    $item_selected_cat = array();
    $item_selected_med = array();
    $category_selected = array();
    $amount_by_category = $this->input->post('category_amount');
    $category_selected = $this->input->post('category_name');
    $item_selected_cat = $this->input->post('category_id');
    $item_selected_med = $this->input->post('medicine_id');	

    if (empty($item_selected)) {
        $this->session->set_flashdata('feedback', lang('select_an_item'));
        redirect('finance/pharmacy/addPaymentView');
    } else {
        $item_quantity_array = array();
        $item_quantity_array = array_combine($item_selected, $quantity);
    }
    foreach ($item_quantity_array as $key => $value) {
        $current_medicine = $this->db->get_where('medicine', array('id' => $key))->row();
        $unit_price = $current_medicine->s_price;
        $unit_color = $current_medicine->effects;
        $cost = $current_medicine->price;
        $current_stock = (string) $current_medicine->quantity;
        $qty = $value;
        if ($current_stock < $qty) {
            $this->session->set_flashdata('quantity_check', 'Insufficient Quantity selected for Medicine ' . $current_medicine->name);
            redirect('pharmacy/addPaymentView');
        }
        $item_price[] = $unit_price * $value;
        $category_name[] = $key . '*' . $unit_price . '*' . $qty . '*' . $cost;
        $category_color[] = $unit_color;
    }

    $category_name = implode(',', $category_name);
    $category_color = implode(',', $category_color);

    $patient = $this->input->post('patient');
    $patient_name = $this->input->post('patient_name');
    $date = time();
    $discount = $this->input->post('discount');
    $patient_name = $this->db->get_where('patient', array('id' => $patient))->row()->name;
    $patient_fname = $this->db->get_where('patient', array('id' => $patient))->row()->first_name;
    $patient_mname = $this->db->get_where('patient', array('id' => $patient))->row()->middle_name;
    $patient_lname = $this->db->get_where('patient', array('id' => $patient))->row()->last_name;
    $date_string = date('d-m-y', $date);

    $amount_received1 = $this->input->post('amount_received');
    $receive_breakdown1 = $this->input->post('amount_received');
    $deposit_type1 = $this->input->post('deposit_type');
    
    $amount_received = implode(',', $amount_received1);
    $deposit_type = implode(',', $deposit_type1);
    $receive_breakdown = implode(',', $receive_breakdown1);
    
    $amount_received_ex = explode(",", $amount_received);
    $amount_received_add = array_sum($amount_received_ex);	

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        echo 'form validate noe nai re';
    } else {
        $amount = array_sum($item_price);
        $sub_total = $amount;
        $discount_type = $this->pharmacy_model->getDiscountType();

        if ($discount_type == 'flat') {
            $flat_discount = $discount;
            $gross_total = $sub_total - $flat_discount;
        } else {
            $flat_discount = $amount * ($discount / 100);
            $gross_total = $sub_total - $flat_discount;
        }

        if ($amount_received_add == $gross_total) {
            $status = "Paid";
        } elseif ($amount_received_add > 0 && $amount_received_add < $gross_total) {
            $status = "Part Payment";
        } else {
            $status = "Unpaid";
        }

        $data = array();
        if (empty($id)) {
            $data = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'location' => $location,
                'date' => $date,
                'amount' => $sub_total,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'amount_received' => $amount_received_add,
                'receive_breakdown' => $receive_breakdown,
                'deposit_type' => $deposit_type,
                'date_string' => $date_string,
                'color' => $unit_color,
                'f_type' => $ftype,
                'status' => $status
            );
            $this->pharmacy_model->insertPayment($data);
            $inserted_id = $this->db->insert_id();
            foreach ($item_quantity_array as $key => $value) {
                $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                $new_qty = $previous_qty - $value;
                $this->db->where('id', $key);
                $this->db->update('medicine', array('quantity' => $new_qty));
            }

            // Log the transaction for adding cart items
            $this->load->model('logs/logs_model');
            $this->logs_model->insertTransactionLogs([
                'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:52:00
                'invoice_id' => $inserted_id,
                'patientname' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'deposit_type' => $deposit_type,
                'payment_gateway' => 'N/A', // Adjust if payment gateway is used
                'action' => 'Added Cart Items',
                'amount' => $gross_total,
                'user' => $this->ion_auth->get_user_id()
            ]);

            $this->session->set_flashdata('feedback', lang('added'));
            redirect("finance/pharmacy/invoice?id=" . "$inserted_id");
        } else {
            $data = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'patient_name' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'location' => $location,
                'amount' => $sub_total,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'amount_received' => $amount_received_add,
                'receive_breakdown' => $receive_breakdown,
                'deposit_type' => $deposit_type,
                'color' => $unit_color,
                'f_type' => $ftype,
                'date_string' => $date_string
            );

            $original_sale = $this->pharmacy_model->getPaymentById($id);
            $original_sale_quantity = array();
            $original_sale_quantity = explode(',', $original_sale->category_name);
            $o_s_value[] = array();
            foreach ($item_quantity_array as $key => $value) {
                $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                foreach ($original_sale_quantity as $osq_key => $osq_value) {
                    $o_s_value = explode('*', $osq_value);
                    if ($o_s_value[0] == $key) {
                        $previous_qty1 = $previous_qty + $o_s_value[2];
                        $new_qty = $previous_qty1 - $value;
                        $this->db->where('id', $key);
                        $this->db->update('medicine', array('quantity' => $new_qty));
                    }
                }
            }
            $this->pharmacy_model->updatePayment($id, $data);

            // Log the transaction for updating cart items
            $this->load->model('logs/logs_model');
            $this->logs_model->insertTransactionLogs([
                'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:52:00
                'invoice_id' => $id,
                'patientname' => $patient_fname . ' ' . $patient_mname . ' ' . $patient_lname,
                'deposit_type' => $deposit_type,
                'payment_gateway' => 'N/A', // Adjust if payment gateway is used
                'action' => 'Updated Cart Items',
                'amount' => $gross_total,
                'user' => $this->ion_auth->get_user_id()
            ]);

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect("finance/pharmacy/invoice?id=" . "$id");
        }
    }
}     
      

    public function addShoppingCart() {
    $id = $this->input->post('pid');
    $pat_id = $this->input->post('pat_id');
    $pat_name = $this->input->post('pat_name');
    $pname = $this->input->post('pname');
    $service_name = $this->input->post('pname');
    $pcat = $this->input->post('pcat');
    $pcolor = $this->input->post('pcolor');
    $psize = $this->input->post('psize');
    $pqty = $this->input->post('pqty');
    $pprice = $this->input->post('pprice');
    $service_price = $this->input->post('pprice');
    $plens = $this->input->post('framelens');
    $pitems = $this->input->post('frameitems');
    $pmisc = $this->input->post('frame_misc');
    $plocation = $this->input->post('plocation');
    $ftype = $this->input->post('ftype');
    $date = time();
    $date_string = date('d-m-y', $date);	

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $user_id = $this->ion_auth->get_user_id();
    $user_name = $this->db->get_where('users', array('id' => $user_id))->row()->username;

    $newPrice = $pqty * $pprice;

    $getframe = $this->db->get_where('frame_items', array('id' => $pitems))->row()->name;			
    $gettype = $this->db->get_where('frame_type', array('id' => $plens))->row()->name;			
    $getmiscitem = $this->db->get_where('frame_items', array('name' => $pmisc))->row()->price;	
    $getlensitem = $this->db->get_where('frame_items', array('id' => $pitems))->row()->price;	

    if (!empty($pframeid)) {
        $pframeid = $this->db->get_where('medicine', array('name' => $pname))->row()->id;	
    } else {
        $pframeid = "1001" . mt_rand(10, 1000);
    }

    $sumItems = $getmiscitem + $getlensitem;

    $item_price[] = $pqty * $pprice;
    $len_price[] = $getmiscitem + $getlensitem;
    $items_amount = array_sum($item_price);
    $lens_amount = array_sum($len_price);

    $sub_total = $items_amount + $lens_amount;	

    /*$patient_fname = $this->db->get_where('patient', array('id' => $patient))->row()->first_name;
    $patient_mname = $this->db->get_where('patient', array('id' => $patient))->row()->middle_name;
    $patient_lname = $this->db->get_where('patient', array('id' => $patient))->row()->last_name;*/

    if (!empty($pat_id)) {
        $patient_fname = $this->db->get_where('patient', array('id' => $pat_id))->row()->first_name ?? '';
        $patient_mname = $this->db->get_where('patient', array('id' => $pat_id))->row()->middle_name ?? '';
        $patient_lname = $this->db->get_where('patient', array('id' => $pat_id))->row()->last_name ?? '';
    } else {
        $patient_fname = '';
        $patient_mname = '';
        $patient_lname = '';
    }

    $data = array();
    if (!empty($id)) {
        $data = array(
            'frame_id' => $pframeid,
            'name' => $pname,
            'service_name' => $service_name,
            'service_price' => $service_price,
            'model' => $pname,
            'location' => $plocation,
            'category' => $pcat,
            'color' => $pcolor,
            'size' => $psize,
            'quantity' => $pqty,
            'price' => $newPrice,                    
            'framelens' => $gettype,
            'frameitems' => $getframe,
            'lens_price' => $sumItems,
            'subtotal' => $sub_total,
            'misc' => $pmisc,
            'date' => $date_string,
            'user_id' => $user_id,                    
            'patient_id' => $pat_id,
            'patient_name' => $pat_name,
            'f_type' => $ftype,
            'user_name' => $user_name
        );
        $this->pharmacy_model->insertCart($data);
        $inserted_id = $this->db->insert_id();

        // Log the transaction for adding a shopping cart item
        $this->load->model('logs/logs_model');
        $this->logs_model->insertTransactionLogs([
            'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 01:00:00
            'invoice_id' => null, // No invoice ID yet, set to null
            'patientname' => $pat_name ?: ($patient_fname . ' ' . $patient_mname . ' ' . $patient_lname),
            'deposit_type' => 'N/A', // No deposit at this stage
            'payment_gateway' => 'N/A', // Adjust if payment gateway is used
            'action' => 'Added Shopping Cart Item',
            'amount' => $newPrice, // Price of the added item
            'user' => $user_id
        ]);

        $this->session->set_flashdata('feedback', lang('added'));
        redirect("finance/pharmacy/sellNowSingle?id=" . $pat_id . "&type=gen", 'refresh');
    } else {
        $pqty = $pqty + 1;
        $data = array(
            'frame_id' => $pframeid,
            'name' => $pname,
            'model' => $pname,
            'service_name' => $service_name,
            'service_price' => $service_price,					
            'location' => $plocation,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'category' => $pcat,
            'color' => $pcolor,
            'size' => $psize,
            'quantity' => $pqty,
            'price' => $pprice,                    
            'framelens' => $plens,
            'frameitems' => $pitems,
            'subtotal' => $sub_total,
            'patient_id' => $pat_id,
            'patient_name' => $pat_name,
            'f_type' => $ftype,					
            'misc' => $pmisc,
            'date' => $date_string
        );

        $this->pharmacy_model->updateCart($id, $data);

        // Log the transaction for updating a shopping cart item
        $this->load->model('logs/logs_model');
        $this->logs_model->insertTransactionLogs([
            'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 01:00:00
            'invoice_id' => null, // No invoice ID yet, set to null
            'patientname' => $pat_name ?: ($patient_fname . ' ' . $patient_mname . ' ' . $patient_lname),
            'deposit_type' => 'N/A', // No deposit at this stage
            'payment_gateway' => 'N/A', // Adjust if payment gateway is used
            'action' => 'Updated Shopping Cart Item',
            'amount' => $newPrice, // Updated price of the item
            'user' => $user_id
        ]);

        $this->session->set_flashdata('feedback', lang('updated'));
        redirect("finance/pharmacy/sellNowSingle?id=" . $pat_id . "&type=gen", 'refresh');
    }
}


public function addSingleShoppingCart() {
    $id = $this->input->post('pid');
    $pat_id = $this->input->post('pat_id');
    $pat_name = $this->input->post('pat_name');
    $ftype = $this->input->post('ftype');
    $pname = $this->input->post('pname');
    $pcat = $this->input->post('pcat');
    $pcolor = $this->input->post('pcolor');
    $psize = $this->input->post('psize');
    $pqty = $this->input->post('pqty');
    $pprice = $this->input->post('pprice');
    $plens = $this->input->post('framelens');
    $pitems = $this->input->post('frameitems');
    $pmisc = $this->input->post('frame_misc');
    $plocation = $this->input->post('plocation');
    $date = time();
    $date_string = date('d-m-y', $date);	

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $user_id = $this->ion_auth->get_user_id();
    $user_name = $this->db->get_where('users', array('id' => $user_id))->row()->username;

    $newPrice = $pqty * $pprice;

    $getframe = $this->db->get_where('frame_items', array('id' => $pitems))->row()->name;			
    $gettype = $this->db->get_where('frame_type', array('id' => $plens))->row()->name;			
    $getmiscitem = $this->db->get_where('frame_items', array('name' => $pmisc))->row()->price;	
    $getlensitem = $this->db->get_where('frame_items', array('id' => $pitems))->row()->price;	

    $pframeid = $this->db->get_where('medicine', array('name' => $pname))->row()->id;	
    $sumItems = $getmiscitem + $getlensitem;

    $item_price[] = $pqty * $pprice;
    $len_price[] = $getmiscitem + $getlensitem;
    $items_amount = array_sum($item_price);
    $lens_amount = array_sum($len_price);

    $sub_total = $items_amount + $lens_amount;	

    if (!empty($pat_id)) {
        $patient_fname = $this->db->get_where('patient', array('id' => $pat_id))->row()->first_name ?? '';
        $patient_mname = $this->db->get_where('patient', array('id' => $pat_id))->row()->middle_name ?? '';
        $patient_lname = $this->db->get_where('patient', array('id' => $pat_id))->row()->last_name ?? '';
    } else {
        $patient_fname = '';
        $patient_mname = '';
        $patient_lname = '';
    }

    $data = array();
    if (!empty($id)) {
        $data = array(
            'frame_id' => $pframeid,
            'name' => $pname,
            'model' => $pname,
            'location' => $plocation,
            'category' => $pcat,
            'color' => $pcolor,
            'size' => $psize,
            'quantity' => $pqty,
            'price' => $newPrice,                    
            'framelens' => $gettype,
            'frameitems' => $getframe,
            'lens_price' => $sumItems,
            'subtotal' => $sub_total,
            'misc' => $pmisc,
            'date' => $date_string,
            'user_id' => $user_id,                    
            'patient_id' => $pat_id,
            'patient_name' => $pat_name,
            'f_type' => $ftype,
            'user_name' => $user_name
        );
        $this->pharmacy_model->insertCart($data);
        $inserted_id = $this->db->insert_id();

        // Log the transaction for adding a single shopping cart item
        $this->load->model('logs/logs_model');
        $this->logs_model->insertTransactionLogs([
            'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:52:00
            'invoice_id' => null, // No invoice ID yet, set to null
            'patientname' => $pat_name ?: ($patient_fname . ' ' . $patient_mname . ' ' . $patient_lname),
            'deposit_type' => 'N/A', // No deposit at this stage
            'payment_gateway' => 'N/A', // Adjust if payment gateway is used
            'action' => 'Added Single Shopping Cart Item',
            'amount' => $newPrice, // Price of the added item
            'user' => $user_id
        ]);

        $this->session->set_flashdata('feedback', lang('added'));
        redirect("finance/pharmacy/sellNowSingle", 'refresh');
    } else {
        $pqty = $pqty + 1;
        $data = array(
            'frame_id' => $pframeid,
            'name' => $pname,
            'model' => $pname,
            'location' => $plocation,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'category' => $pcat,
            'color' => $pcolor,
            'size' => $psize,
            'quantity' => $pqty,
            'price' => $pprice,                    
            'framelens' => $plens,
            'frameitems' => $pitems,
            'subtotal' => $sub_total,
            'patient_id' => $pat_id,
            'patient_name' => $pat_name,
            'f_type' => $ftype,					
            'misc' => $pmisc,
            'date' => $date_string
        );

        $this->pharmacy_model->updateCart($id, $data);

        // Log the transaction for updating a single shopping cart item
        $this->load->model('logs/logs_model');
        $this->logs_model->insertTransactionLogs([
            'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:52:00
            'invoice_id' => null, // No invoice ID yet, set to null
            'patientname' => $pat_name ?: ($patient_fname . ' ' . $patient_mname . ' ' . $patient_lname),
            'deposit_type' => 'N/A', // No deposit at this stage
            'payment_gateway' => 'N/A', // Adjust if payment gateway is used
            'action' => 'Updated Single Shopping Cart Item',
            'amount' => $newPrice, // Updated price of the item
            'user' => $user_id
        ]);

        $this->session->set_flashdata('feedback', lang('updated'));
        redirect("finance/pharmacy/sellNowSingle", 'refresh');
    }
}
    

function deposit() {
    $id = $this->input->post('id');
    $patient = $this->input->post('patient');
    $payment_id = $this->input->post('payment_id');
    $date = time();

    $deposited_amount = $this->input->post('deposited_amount');
    $deposit_type = $this->input->post('deposit_type');

    if (empty($deposit_type)) {
        $deposit_type = 'Cash';
    }

    $user = $this->ion_auth->get_user_id();

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
    $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        redirect('finance/patientPaymentHistory?patient=' . $patient);
    } else {
        $data = array();
        $data = array('patient' => $patient,
            'date' => $date,
            'payment_id' => $payment_id,
            'deposited_amount' => $deposited_amount,
            'deposit_type' => $deposit_type,
            'user' => $user
        );
        if (empty($id)) {
            /* if ($deposit_type == 'Cardss') {
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
                } elseif ($gateway == 'Stripe') {
                    $card_number = $this->input->post('card_number');
                    $expire_date = $this->input->post('expire_date');
                    $cvv = $this->input->post('cvv');
                    $token = $this->input->post('token');
                    $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe'))->row();
                    \Stripe\Stripe::setApiKey($stripe->secret);
                    $charge = \Stripe\Charge::create(array(
                                "amount" => $deposited_amount * 100,
                                "currency" => "usd",
                                "source" => $token
                    ));
                    $chargeJson = $charge->jsonSerialize();
                    // redirect("finance/invoice?id=" . "$inserted_id");
                } elseif ($gateway == 'Pay U Money') {
                    redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                } else {
                    $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                    redirect("finance/invoice?id=" . "$payment_id");
                }
            } else { */
                $this->finance_model->insertDeposit($data);
                $this->session->set_flashdata('feedback', lang('added'));

                // Log the transaction for adding a deposit
                $this->load->model('logs/logs_model');
                $this->logs_model->insertTransactionLogs([
                    'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 01:05:00
                    'invoice_id' => $payment_id, // Use payment_id as invoice reference
                    'patientname' => $this->getPatientName($patient) ?? 'Unknown', // Custom function to get patient name
                    'deposit_type' => $deposit_type,
                    'payment_gateway' => 'N/A', // Adjust if gateway is used (e.g., 'PayPal', 'Stripe')
                    'action' => 'Added Deposit',
                    'amount' => $deposited_amount,
                    'user' => $user
                ]);
            /* } */
            } else {
                $this->finance_model->updateDeposit($id, $data);

                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', lang('updated'));

                // Log the transaction for updating a deposit
                $this->load->model('logs/logs_model');
                $this->logs_model->insertTransactionLogs([
                    'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 01:05:00
                    'invoice_id' => $payment_id, // Use payment_id as invoice reference
                    'patientname' => $this->getPatientName($patient) ?? 'Unknown', // Custom function to get patient name
                    'deposit_type' => $deposit_type,
                    'payment_gateway' => 'N/A', // Adjust if gateway is used (e.g., 'PayPal', 'Stripe')
                    'action' => 'Updated Deposit',
                    'amount' => $deposited_amount,
                    'user' => $user
                ]);
            }
            redirect('finance/patientPaymentHistory?patient=' . $patient);
        }
    }

    function editDepositByJason() {
        $id = $this->input->get('id');
        $data['deposit'] = $this->finance_model->getDepositById($id);
        echo json_encode($data);
    }

    function deleteDeposit() {
        $id = $this->input->get('id');
        $patient = $this->input->get('patient');

        $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
        if (!empty($amount_received_id)) {
            $amount_received_payment_id = explode('.', $amount_received_id);
            $payment_id = $amount_received_payment_id[0];
            $data_amount_received = array('amount_received' => NULL);
            $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
        }

        $this->finance_model->deleteDeposit($id);

        redirect('finance/patientPaymentHistory?patient=' . $patient);
    }
	
    public function sellPayment() {
      $id = $this->input->post('pid');
      $pframeid = $this->input->post('pframeid');
      $pname = $this->input->post("pname");
      $pcat = $this->input->post("pcat");
      $pcolor = $this->input->post("pcolor");
      $psize = $this->input->post("psize");
      $pqty = $this->input->post("pqty");
      $pprice = $this->input->post("pprice");  
      $ftype = $this->input->post("ftype");  
      
      $total_price = $pprice * $pqty;      
	/*
            $this->db->select('*');
			$this->db->where('name',$name);
			$this->db->where('effects',$effects);
            $fetched_records = $this->db->get('medicine');
            $query9 = $fetched_records->result();
			$count = $fetched_records->num_rows();
	*/		

            $data = array();
            if (empty($id)) {
                $data = array(
                    'id' => $id,
                    'frame_id' => $pframeid,
                    'name' => $pname,
                    'category' => $pcat,
                    'effects' => $pcolor,
                    'box' => $psize,
                    'quantity' => $pqty,
                    'f_type' => $ftype,
                    's_price' => $pprice
                   /* 'gross_total' => $gross_total,
                    'amount_received' => $amount_received_add,
                    'receive_breakdown' => $receive_breakdown,
                    'deposit_type' => $deposit_type,
					'date_string' => $date_string,
					'color' => $unit_color,
                    'status' => $status*/
                );
                $this->pharmacy_model->insertCart($data);
                $inserted_id = $this->db->insert_id();
             /*   foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    $new_qty = $previous_qty - $value;
                    $this->db->where('id', $key);
                    $this->db->update('medicine', array('quantity' => $new_qty));
                }*/
                $this->session->set_flashdata('feedback', lang('added'));
             //   redirect("finance/pharmacy/invoice?id=" . "$inserted_id");
                redirect("finance/pharmacy/sellNow");
            } else {
                $data = array(
                	'frame_id' => $pframeid,
					'name' => $pname,
                    'category' => $pcat,
                    'effects' => $pcolor,
                    'box' => $psize,
                    'quantity' => $pqty,
					'f_type' => $ftype,
                    's_price' => $pprice
                );

           /*     $original_sale = $this->pharmacy_model->getPaymentById($id);
                $original_sale_quantity = array();
                $original_sale_quantity = explode(',', $original_sale->category_name);
                $o_s_value[] = array();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    foreach ($original_sale_quantity as $osq_key => $osq_value) {
                        $o_s_value = explode('*', $osq_value);
                        if ($o_s_value[0] == $key) {
                            $previous_qty1 = $previous_qty + $o_s_value[2];
                            $new_qty = $previous_qty1 - $value;
                            $this->db->where('id', $key);
                            $this->db->update('medicine', array('quantity' => $new_qty));
                        }
                    }
                }*/
                $this->pharmacy_model->updateCart($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
               	redirect("finance/pharmacy/sellNow");
               // redirect("finance/pharmacy/invoice?id=" . "$id");
            }
        }
    

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Pharmacist'))) {
            $data = array();
            $data['discount_type'] = $this->pharmacy_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['medicines'] = $this->medicine_model->getMedicine();
            $id = $this->input->get('id');
            $data['payment'] = $this->pharmacy_model->getPaymentById($id);
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('pharmacy/add_payment_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $id = $this->input->get('id');
            $category_name = $this->pharmacy_model->getPaymentById($id)->category_name;
            $all_product_details = array();
            $all_product_details = explode(',', $category_name);

            foreach ($all_product_details as $key => $value) {
                $product_details = array();
                $product_details = explode('*', $value);
                $product_id = $product_details[0];
                $qty = $product_details[2];
                $previous_qty = $this->medicine_model->getMedicineById($product_details[0])->quantity;
                $new_qty = $previous_qty + $qty;
                $data = array();
                $data = array('quantity' => $new_qty);
                $this->medicine_model->updateMedicine($product_id, $data);
            }

            $this->pharmacy_model->deletePayment($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('finance/pharmacy/payment');
        }
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->pharmacy_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->pharmacy_model->getExpenseCategory();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'amount' => $amount
                );
            } else {
                $data = array(
                    'category' => $category,
                    'amount' => $amount
                );
            }
            if (empty($id)) {
                $this->pharmacy_model->insertExpense($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->pharmacy_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/pharmacy/expense');
        }
    }

    function editExpense() {
        $data = array();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->pharmacy_model->getExpenseById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deletecart() {
        $id = $this->input->get('id');
        $this->pharmacy_model->deleteCart($id);        
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/shoppingCartView');
    }    
	
	function deletesinglecart() {
        $id = $this->input->get('id');
        $this->pharmacy_model->deleteCart($id);        
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/shoppingCartSingleView');
    }
    
    function clearcart() {
        $id = $this->input->get('user_id');
        $this->pharmacy_model->clearCart($id);        
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/shoppingCartView');
    }     
	
	function clearsinglecart() {
        $id = $this->input->get('user_id');
        $this->pharmacy_model->clearCart($id);        
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/shoppingCartSingleView');
    }      
	
	function deleteExpense() {
        $id = $this->input->get('id');
		$this->pharmacy_model->deleteExpense($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/expense');
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('pharmacy/add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->pharmacy_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->pharmacy_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/pharmacy/expenseCategory');
        }
    }

    function editExpenseCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->pharmacy_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        $this->pharmacy_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/expenseCategory');
    }

function invoice() {
    $id = $this->input->get('id');
    if (empty($id)) {
        show_404();
        return;
    }

    $data['settings'] = $this->settings_model->getSettings();
    $data['discount_type'] = $this->pharmacy_model->getDiscountType();
    $data['payment'] = $this->pharmacy_model->getPaymentById($id);
    $data['Item_payment'] = $this->pharmacy_model->getItemPaymentById($id);

    if (empty($data['payment'])) {
        log_message('error', 'No payment found for ID: ' . $id);
        redirect('finance/pharmacy/patientPaymentHistory?patient=' . $this->input->get('patient', TRUE));
        return;
    }

    $this->load->model('logs/logs_model');
    $patient_name = isset($data['payment']->patient_name) ? $data['payment']->patient_name : 'Unknown'; // Use patient_name column
    $this->logs_model->insertTransactionLogs([
        'date_time' => date('Y-m-d H:i:s'), // e.g., 2025-08-22 00:36:00
        'invoice_id' => $id,
        'patientname' => $patient_name, // Log as 'patientname' to match transaction_logs schema
        'deposit_type' => 'N/A',
        'payment_gateway' => 'N/A',
        'action' => 'Viewed Invoice',
        'amount' => $data['payment']->gross_total ?? 0,
        'user' => $this->ion_auth->user() ? $this->ion_auth->get_user_id() : null
    ]);

    $this->load->view('home/dashboard', $data);
    $this->load->view('pharmacy/invoice', $data);
    $this->load->view('home/footer');
}

    function printInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['payment'] = $this->pharmacy_model->getPaymentById($id);
         $data['Item_payment'] = $this->pharmacy_model->getItemPaymentById($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/print_invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('pharmacy_payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->pharmacy_model->amountReceived($id, $data);
        redirect('finance/pharmacy/invoice?id=' . $id);
    }

    function amountReceivedFromPT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->pharmacy_model->getPaymentByPatientId($id);
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->pharmacy_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->pharmacy_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('finance/pharmacy/invoicePatientTotal?id=' . $id);
    }

    function todaySales() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->pharmacy_model->getPaymentByDate($today, $today_last);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_sales', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function todayExpense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->pharmacy_model->getExpenseByDate($today, $today_last);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_expenses', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function todayNetCash() {
        $data['today_sales_amount'] = $this->pharmacy_model->todaySalesAmount();
        $data['today_expenses_amount'] = $this->pharmacy_model->todayExpensesAmount();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_net_cash', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function salesPerMonth() {

        $payments = $this->pharmacy_model->getPayment();
        foreach ($payments as $payment) {
            $date = $payment->date;
            $month = date('m', $date);
            $year = date('y', $date);
            if ($month = '01') {
                
            }
        }
    }

    function financialReport() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['expense_categories'] = $this->pharmacy_model->getExpenseCategory();


        // if(empty($date_from)&&empty($date_to)) {
        //    $data['payments']=$this->pharmacy_model->get_payment();
        //     $data['ot_payments']=$this->pharmacy_model->get_ot_payment();
        //     $data['expenses']=$this->pharmacy_model->get_expense();
        // }
        // else{

        $data['payments'] = $this->pharmacy_model->getPaymentByDate($date_from, $date_to);
        $data['expenses'] = $this->pharmacy_model->getExpenseByDate($date_from, $date_to);
        // } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function getPaymentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['payments'] = $this->pharmacy_model->getPaymentBysearch($search);
            } else {
                $data['payments'] = $this->pharmacy_model->getPayment();
            }
        } else {
            if (!empty($search)) {
                $data['payments'] = $this->pharmacy_model->getPaymentByLimitBySearch($limit, $start, $search);
            } else {
                $data['payments'] = $this->pharmacy_model->getPaymentByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['payments'] as $payment) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();
            if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) {
                $option1 = '<a class="btn btn-info btn-xs editbutton" href="finance/pharmacy/editPayment?id=' . $payment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            if ($this->ion_auth->in_group('admin')) {
                $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="finance/pharmacy/delete?id=' . $payment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            }
            $option3 = '<a class="btn btn-xs green" style="color: #fff;" href="finance/pharmacy/invoice?id=' . $payment->id . '"><i class="fa fa-file-invoice"></i> ' . lang('invoice') . '</a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="finance/pharmacy/printInvoice?id=' . $payment->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            if (!empty($payment->flat_discount)) {
                $discount = number_format($payment->flat_discount, 2, '.', ',');
            } else {
                $discount = '0';
            }
            $info[] = array(
                $payment->id,
                date('d/m/y', $payment->date + 11 * 60 * 60),
                $settings->currency . '' . number_format($payment->amount, 2, '.', ','),
                $settings->currency . '' . $discount,
                $settings->currency . '' . number_format($payment->gross_total, 2, '.', ','),
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if ($data['payments']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function previousInvoice() {
        $id = $this->input->get('id');
        $data1 = $this->pharmacy_model->getFirstRowPaymentById();
        if ($id == $data1->id) {
            $data = $this->pharmacy_model->getLastRowPaymentById();
            redirect('finance/pharmacy/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id - 1; $id1 >= $data1->id; $id1--) {

                $data = $this->pharmacy_model->getPreviousPaymentById($id1);
                if (!empty($data)) {
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->pharmacy_model->getLastRowPaymentById();
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function nextInvoice() {
        $id = $this->input->get('id');


        $data1 = $this->pharmacy_model->getLastRowPaymentById();


        //$id1 = $id + 1;
        if ($id == $data1->id) {
            $data = $this->pharmacy_model->getFirstRowPaymentById();
            redirect('finance/pharmacy/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id + 1; $id1 <= $data1->id; $id1++) {

                $data = $this->pharmacy_model->getNextPaymentById($id1);


                if (!empty($data)) {
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->pharmacy_model->getFirstRowPaymentById();
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function daily() {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $payments = $this->pharmacy_model->getPaymentByDate($first_minute, $last_minute);
        $all_payments = array();
        foreach ($payments as $payment) {
            $date = date('D d-m-y', $payment->date);
            if (array_key_exists($date, $all_payments)) {
                $all_payments[$date] = $all_payments[$date] + $payment->gross_total;
            } else {
                $all_payments[$date] = $payment->gross_total;
            }
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/daily', $data);
        $this->load->view('home/footer'); // just the header file
    }
    function dailyDetails() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['id'] = $_GET['id'];
        //$data['payments'] = $this->finance_model->getPayment();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('finance/pharmacy/daily_details', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
    function dailyExpense() {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $expenses = $this->pharmacy_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $date = date('D d-m-y', $expense->date);
            if (array_key_exists($date, $all_expenses)) {
                $all_expenses[$date] = $all_expenses[$date] + $expense->amount;
            } else {
                $all_expenses[$date] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;



        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/daily_expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function monthly() {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $payments = $this->pharmacy_model->getPaymentByDate($first_minute, $last_minute);
        $all_payments = array();
        foreach ($payments as $payment) {
            $month = date('m-Y', $payment->date);
            if (array_key_exists($month, $all_payments)) {
                $all_payments[$month] = $all_payments[$month] + $payment->gross_total;
            } else {
                $all_payments[$month] = $payment->gross_total;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/monthly', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function monthlyExpense() {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $expenses = $this->pharmacy_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $month = date('m-Y', $expense->date);
            if (array_key_exists($month, $all_expenses)) {
                $all_expenses[$month] = $all_expenses[$month] + $expense->amount;
            } else {
                $all_expenses[$month] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/monthly_expense', $data);
        $this->load->view('home/footer'); // just the header file
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
        //  $data['appointments'] = $this->appointment_model->getAppointment();
        $i = 0;
        foreach ($data['medicines'] as $medicine) {
            $i = $i + 1;
            $settings = $this->settings_model->getSettings();

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
			$quan = $medicine->quantity;
			$quan_2 = $medicine->quantity_2;		
			$option5 = '<button class="btn btn-info no-print btn-xs btn_width btn-warning addtocart">Add<i class="fas fa-cart-plus"></i>Cart</button>';
						
            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
			$option2 = '<a class="btn btn-info btn-xs btn_width delete_button"  href="medicine/delete?id=' . $medicine->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
			}
            if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
			$option2 = '';
			}

            $info[] = array(
                //$i,
                $medicine->name,
                $medicine->effects,
                $medicine->category,
                $medicine->box,
                //$settings->currency . $medicine->price,            
                '<font color="red">' .$quan . '</font>',				            
                '<font color="red">' .$quan_2. '</font>',// . '<br>' . $load,
				$settings->currency . $medicine->s_price,
               // $medicine->generic,
                //$medicine->company,
              //  $medicine->user,
                $option5// . ' ' . $option1 . ' ' . $option3. ' '. $option4. ' ' . $option2  //. ' ' . $option5
                    //  $options2
            );
			
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
    
}

/* End of file pharmacy.php */
/* Location: ./application/modules/pharmacy/controllers/pharmacy.php */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends MX_Controller {

    function __construct() {
        parent::__construct();
       
        $this->load->model('logs_model');
        $this->load->model('settings_model');
        if(!$this->ion_auth->in_group(array('admin','superadmin'))){
            redirect('home/permission');
        }
    }
    function index(){
        $this->load->view('home/dashboard');
        $this->load->view('logs');
        $this->load->view('home/footer');
    }

    function getUserLogs() {
        $data['user_logs'] = $this->logs_model->getUsersLog();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('logs/user_logs', $data);
        $this->load->view('home/footer'); // just the footer file
    }   

	function getFrameLogs() {
        $data['frame_logs'] = $this->logs_model->getFramesLog();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('logs/frame_logs', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteUserLogs() {
        $data = array();
        $id = $this->input->get('id');
        $this->logs_model->deleteUsersLog($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('logs/getUserLogs');
    }    
	
	function deleteFrameLogs() {
        $data = array();
        $id = $this->input->get('id');
        $this->logs_model->deleteFramesLog($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('logs/getFrameLogs');
    }







 function transactionLogs(){
        $this->load->view('home/dashboard');
        $this->load->view('transaction_logs');
        $this->load->view('home/footer');
    }
function getTransaction() {
    $requestData = $_REQUEST;
    $start = $requestData['start'];
    $limit = $requestData['length'];
    $search = $this->input->post('search')['value'];

    $order = $this->input->post("order");
    $columns_valid = array(
        "0" => "date_time",
        "1" => "invoice_id",
        "2" => "patientname",
        "3" => "deposit_type",
        "4" => "amount",
        "5" => "user",
        "6" => "action"
    );
    $values = $this->settings_model->getColumnOrder($order, $columns_valid);
    $dir = $values[0];
    $order = $values[1];

    if ($limit == -1) {
        if (!empty($search)) {
            $data['logs'] = $this->logs_model->getTransactionLogsBySearch($search, $order, $dir);
        } else {
            $data['logs'] = $this->logs_model->getTransactionLogsWithoutSearch($order, $dir);
        }
    } else {
        if (!empty($search)) {
            $data['logs'] = $this->logs_model->getTransactionLogsByLimitBySearch($limit, $start, $search, $order, $dir);
        } else {
            $data['logs'] = $this->logs_model->getTransactionLogsByLimit($limit, $start, $order, $dir);
        }
    }

    $total_records = $this->db->count_all('transaction_logs');
    $filtered_records = $this->logs_model->getTransactionLogsCount($search);

    $info = [];
    foreach ($data['logs'] as $log) {
        $action = '';
        if ($log->action == 'Added') {
            $action = '<span class="label label-success">' . lang('added') . '</span>';
        } elseif ($log->action == 'Added/Deposited') {
            $action = '<span class="label label-success">' . lang('added') . ' ' . lang('deposited') . '</span>';
        } elseif ($log->action == 'Updated') {
            $action = '<span class="label label-success">' . lang('updated') . '</span>';
        } elseif ($log->action == 'View Invoice') {
            $action = '<span class="label label-info">' . lang('view') . ' ' . lang('invoice') . '</span>';
        } else {
            $action = '<span class="label label-info">' . $log->action . '</span>'; // Fallback to raw action
        }
        $user_name = $this->db->get_where('users', array('id' => $log->user))->row()->username ?? 'Unknown';
        $info[] = array(
            $log->date_time,
            $log->invoice_id,
            $log->patientname,
            $log->deposit_type,
            $log->amount,
            $user_name,
            $action
        );
    }

    $output = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => $total_records,
        "recordsFiltered" => $filtered_records,
        "data" => $info
    );

    log_message('debug', 'Transaction Logs Response: ' . json_encode($output));
    echo json_encode($output);
}
}
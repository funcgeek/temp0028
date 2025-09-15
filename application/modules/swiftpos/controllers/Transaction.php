<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MX_Controller {
    function __construct() {
        parent::__construct();

       // $this->load->model('transaction_model');

        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor', 'Patient'))) {
            redirect('home/permission');
        }
    }
	
    public function index() {
        $data['transactions'] = 'test'; //$this->transaction_model->getDonor();
        $data['groups'] = 'another';//$this->transaction_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('transaction', $data);
        $this->load->view('home/footer'); // just the header file
    }
	
/*	public function index()
	{
		$this->load->view('transaction');
	}
	*/
}

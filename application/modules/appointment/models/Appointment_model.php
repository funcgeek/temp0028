<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

//edited to add location to the specific station
    function insertAppointment($data) {
        $this->db->insert('appointment', $data);
		$recordId = 'mb_'.$this->db->insert_id(); 
		$this->db->set('mb_id', $recordId);
		$this->db->where('id', $this->db->insert_id());
		$this->db->update('appointment');
    }
//end editing for specific station

    function getAppointment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('first_name', $search);
        $this->db->or_like('last_name', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('doctorname', $search);		
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('name', $search);
        $this->db->or_like('first_name', $search);
        $this->db->or_like('last_name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('doctorname', $search);
		
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentForCalendar() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentRequest() {
        $this->db->order_by('id', 'desc');
        $this->db->where('request', 'Yes');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentRequestByDoctor($doctor) {
        $this->db->where('request', 'Yes');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByPatient($patient) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient);
        $query = $this->db->get('appointment');
        return $query->result();
    }
 /*    
	 function getPatientByAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient);
        $query = $this->db->get('appointment');
        return $query->result();
		
		
		
		$this->db->select('patient.*, appointment.*');
		$this->db->from('patient');
		$this->db->join('appointment', 'appointment.id = firstTable.id');
		$this->db->where('firstTable.field_name','field_value');
		$query = $this->db->get();
    } */
  
  
    function getAppointmentByStatus($status) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointmentByStatusByDoctor($status, $doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', $status);
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }

    function getAppointmentByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getAppointmentByDoctorByToday($doctor_id) {
        $today = strtotime(date('Y-m-d'));
        $this->db->where('doctor', $doctor_id);
        $this->db->where('date', $today);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }    
	
/////////////////
	function updatelocation($id, $data2) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointment');
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

 function getRequestAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimitBySearch($limit, $start, $search) {
        $this->db->where('status', 'Requested');
        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimitBySearch($limit, $start, $search) {
        $this->db->where('status', 'Pending Confirmation');
        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimitBySearch($limit, $start, $search) {
        $this->db->where('status', 'Confirmed');
        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimitBySearch($limit, $start, $search) {
        $this->db->where('status', 'Treated');
        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointment() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimitBySearch($limit, $start, $search) {
        $this->db->where('status', 'Cancelled');
        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByDoctor($doctor) {
        $this->db->where('doctor', $doctor);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListBySearchByDoctor($doctor, $search) {
        $this->db->where('doctor', $doctor);
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByLimitByDoctor($doctor, $limit, $start) {
        $this->db->where('doctor', $doctor);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentListByLimitBySearchByDoctor($doctor, $limit, $start, $search) {
        $this->db->where('doctor', $doctor);

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('patientname', $search);
        $this->db->or_like('patient_first_name', $search);
        $this->db->or_like('patient_last_name', $search);		
        $this->db->or_like('doctorname', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Requested')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getRequestAppointmentByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Requested');
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getRequestAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search) {

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Requested')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getCancelledAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Cancelled')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getCancelledAppointmentByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Cancelled');
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getCancelledAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search) {

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Cancelled')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPendingAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Pending Confirmation')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPendingAppointmentByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Pending Confirmation');
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getPendingAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search) {

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Pending Confirmation')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getTreatedAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Treated')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getTreatedAppointmentByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Treated');
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getTreatedAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search) {

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Treated')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getConfirmedAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Confirmed')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getConfirmedAppointmentByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', 'Confirmed');
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getConfirmedAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search) {

        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('appointment')
                ->where('status', 'Confirmed')
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR patient_first_name LIKE '%" . $search . "%' OR patient_last_name LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }	
	
	
}

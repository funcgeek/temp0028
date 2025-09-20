<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist', 'Doctor', 'Patient', 'Receptionist'))) {
          //  redirect('home/permission');
        }
    }

    public function index() {

        if ($this->ion_auth->in_group(array('Patient'))) {
         //   redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $current_user = $this->ion_auth->get_user_id();
            $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
        }
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctorId($doctor_id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function all() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) {
         //   redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('all_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPrescriptionView() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) {
         //   redirect('home/permission');
        }

        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer'); // just the header file
    }    
	
	public function addGlassPrescriptionView() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) {
         //   redirect('home/permission');
        }

        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_newglass_prescription_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewPrescription() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Receptionist'))) {
         //   redirect('home/permission');
        }

        $id = $this->input->post('id');
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $symptom = $this->input->post('symptom');
        $medicine = $this->input->post('medicine');
        $dosage = $this->input->post('dosage');
        $frequency = $this->input->post('frequency');
        $days = $this->input->post('days');
        $instruction = $this->input->post('instruction');
        $note = $this->input->post('note');
        $admin = $this->input->post('admin');
		
        $oldrx = $this->input->post('oldrx');
        $oldrx_r_sphere = $this->input->post('oldrx_r_sphere');
        $oldrx_r_cyl = $this->input->post('oldrx_r_cyl');
        $oldrx_r_axis = $this->input->post('oldrx_r_axis');
        $oldrx_r_prism = $this->input->post('oldrx_r_prism');
        $oldrx_r_base = $this->input->post('oldrx_r_base');
        $oldrx_r_ipd = $this->input->post('oldrx_r_ipd');
        $oldrx_r_basecurve = $this->input->post('oldrx_r_basecurve');
        $oldrx_l_sphere = $this->input->post('oldrx_l_sphere');
        $oldrx_l_cyl = $this->input->post('oldrx_l_cyl');
        $oldrx_l_axis = $this->input->post('oldrx_l_axis');
        $oldrx_l_prism = $this->input->post('oldrx_l_prism');
        $oldrx_l_base = $this->input->post('oldrx_l_base');
        $oldrx_l_ipd = $this->input->post('oldrx_l_ipd');
        $oldrx_l_basecurve = $this->input->post('oldrx_l_basecurve');
        $r_add = $this->input->post('r_add');
        $r_trif = $this->input->post('r_trif');
        $seg_width = $this->input->post('seg_width');
        $lens_type_bif = $this->input->post('lens_type_bif');
        $l_add = $this->input->post('l_add');
        $l_trif = $this->input->post('l_trif');
        $r_colorvision = $this->input->post('r_colorvision');
        $l_colorvision = $this->input->post('l_colorvision');
        $r_stereopsis = $this->input->post('r_stereopsis');
        $l_stereopsis = $this->input->post('l_stereopsis');
        $r_amsler = $this->input->post('r_amsler');
        $l_amsler = $this->input->post('l_amsler');
        $r_nct = $this->input->post('r_nct');
        $l_nct = $this->input->post('l_nct');
        $r_blood_pressure = $this->input->post('r_blood_pressure');
        $r_blood_glucose = $this->input->post('r_blood_glucose');
        $r_keratometry = $this->input->post('r_keratometry');
        $l_keratometry = $this->input->post('l_keratometry');
        $r_rx = $this->input->post('r_rx');
        $l_rx = $this->input->post('l_rx');
        $r_rx_date = $this->input->post('r_rx_date');
        $l_rx_date = $this->input->post('l_rx_date');
        $r_cycloplegic = $this->input->post('r_cycloplegic');
        $l_cycloplegic = $this->input->post('l_cycloplegic');
        $r_cycloplegic_other = $this->input->post('r_cycloplegic_other');
        $l_cycloplegic_other = $this->input->post('l_cycloplegic_other');
        $ver_pos = $this->input->post('ver_pos');
        $ver_neg = $this->input->post('ver_neg');
        $newrx_r_sphere = $this->input->post('newrx_r_sphere');
        $newrx_l_sphere = $this->input->post('newrx_l_sphere');
        $newrx_r_cyl = $this->input->post('newrx_r_cyl');
        $newrx_l_cyl = $this->input->post('newrx_l_cyl');
        $newrx_r_axis = $this->input->post('newrx_r_axis');
        $newrx_l_axis = $this->input->post('newrx_l_axis');
        $newrx_r_prism = $this->input->post('newrx_r_prism');
        $newrx_l_prism = $this->input->post('newrx_l_prism');
        $newrx_r_base = $this->input->post('newrx_r_base');
        $newrx_l_base = $this->input->post('newrx_l_base');
        $newrx_r_ipo = $this->input->post('newrx_r_ipo');
        $newrx_l_ipo = $this->input->post('newrx_l_ipo');
        $newrx_r_base_curve = $this->input->post('newrx_r_base_curve');
        $newrx_l_base_curve = $this->input->post('newrx_l_base_curve');
        $r_heter_add = $this->input->post('r_heter_add');
        $r_heter_seg_width = $this->input->post('r_heter_seg_width');
        $r_heter_lens_type = $this->input->post('r_heter_lens_type');
        $r_heter_plastic = $this->input->post('r_heter_plastic');
        $ver_near_pos = $this->input->post('ver_near_pos');
        $ver_near_neg = $this->input->post('ver_near_neg');
        $l_vergency_near = $this->input->post('l_vergency_near');
        $ver_near_only = $this->input->post('ver_near_only');
        $ver_near_distance = $this->input->post('ver_near_distance');
        $l_vergency_fulltime = $this->input->post('l_vergency_fulltime');
        $l_vergency_other = $this->input->post('l_vergency_other');
        $info_manufacture_1 = $this->input->post('info_manufacture_1');
        $info_manufacture_2 = $this->input->post('info_manufacture_2');
        $info_manufacture_3 = $this->input->post('info_manufacture_3');
        $info_manufacture_4 = $this->input->post('info_manufacture_4');
        $info_manufacture_5 = $this->input->post('info_manufacture_5');
        $info_type_1 = $this->input->post('info_type_1');
        $info_type_2 = $this->input->post('info_type_2');
        $info_type_3 = $this->input->post('info_type_3');
        $info_type_4 = $this->input->post('info_type_4');
        $info_type_5 = $this->input->post('info_type_5');
        $info_size_1 = $this->input->post('info_size_1');
        $info_size_2 = $this->input->post('info_size_2');
        $info_size_3 = $this->input->post('info_size_3');
        $info_size_4 = $this->input->post('info_size_4');
        $info_size_5 = $this->input->post('info_size_5');
        $info_colour_1 = $this->input->post('info_colour_1');
        $info_colour_2 = $this->input->post('info_colour_2');
        $info_colour_3 = $this->input->post('info_colour_3');
        $info_colour_4 = $this->input->post('info_colour_4');
        $info_colour_5 = $this->input->post('info_colour_5');
        $anterior_seg_LL_r = $this->input->post('anterior_seg_LL_r');
        $anterior_seg_LL_l = $this->input->post('anterior_seg_LL_l');
        $anterior_seg_cornea_r = $this->input->post('anterior_seg_cornea_r');
        $anterior_seg_cornea_l = $this->input->post('anterior_seg_cornea_l');
        $anterior_seg_bulbar_r = $this->input->post('anterior_seg_bulbar_r');
        $anterior_seg_bulbar_l = $this->input->post('anterior_seg_bulbar_l');
        $anterior_seg_suppal_r = $this->input->post('anterior_seg_suppal_r');
        $anterior_seg_suppal_l = $this->input->post('anterior_seg_suppal_l');
        $anterior_seg_infpal_r = $this->input->post('anterior_seg_infpal_r');
        $anterior_seg_infpal_l = $this->input->post('anterior_seg_infpal_l');
        $anterior_seg_amtchamber_r = $this->input->post('anterior_seg_amtchamber_r');
        $anterior_seg_amtchamber_l = $this->input->post('anterior_seg_amtchamber_l');
        $anterior_seg_iris_r = $this->input->post('anterior_seg_iris_r');
        $anterior_seg_iris_l = $this->input->post('anterior_seg_iris_l');
        $anterior_lens_r = $this->input->post('anterior_lens_r');
        $anterior_seg_lens_l = $this->input->post('anterior_seg_lens_l');
        $ant_seg_app_ton_r = $this->input->post('ant_seg_app_ton_r');
        $ant_seg_app_ton_time = $this->input->post('ant_seg_app_ton_time');
        $ant_seg_bloodpressure_time = $this->input->post('ant_seg_bloodpressure_time');
        $ant_seg_dpa_admin_1 = $this->input->post('ant_seg_dpa_admin_1');
        $ant_seg_dpa_admin_2 = $this->input->post('ant_seg_dpa_admin_2');
        $ant_seg_dpa_admin_3 = $this->input->post('ant_seg_dpa_admin_3');
        $ant_seg_dpa_admin_4 = $this->input->post('ant_seg_dpa_admin_4');
        $ant_seg_time_1 = $this->input->post('ant_seg_time_1');
        $ant_seg_time_2 = $this->input->post('ant_seg_time_2');
        $ant_seg_time_3 = $this->input->post('ant_seg_time_3');
        $ant_seg_time_4 = $this->input->post('ant_seg_time_4');
        $ant_seg_conc_1 = $this->input->post('ant_seg_conc_1');
        $ant_seg_conc_2 = $this->input->post('ant_seg_conc_2');
        $ant_seg_conc_3 = $this->input->post('ant_seg_conc_3');
        $ant_seg_conc_4 = $this->input->post('ant_seg_conc_4');
        $ant_seg_qty_1 = $this->input->post('ant_seg_qty_1');
        $ant_seg_qty_2 = $this->input->post('ant_seg_qty_2');
        $ant_seg_qty_3 = $this->input->post('ant_seg_qty_3');
        $ant_seg_qty_4 = $this->input->post('ant_seg_qty_4');
        $fundoscopy_cd_r = $this->input->post('fundoscopy_cd_r');
        $fundoscopy_cd_l = $this->input->post('fundoscopy_cd_l');
        $fundoscopy_depth_r = $this->input->post('fundoscopy_depth_r');
        $fundoscopy_depth_l = $this->input->post('fundoscopy_depth_l');
        $fundoscopy_margin_r = $this->input->post('fundoscopy_margin_r');
        $fundoscopy_margin_l = $this->input->post('fundoscopy_margin_l');
        $fundoscopy_vessel_r = $this->input->post('fundoscopy_vessel_r');
        $fundoscopy_vessel_l = $this->input->post('fundoscopy_vessel_l');
        $fundoscopy_crossing_r = $this->input->post('fundoscopy_crossing_r');
        $fundoscopy_crossing_l = $this->input->post('fundoscopy_crossing_l');
        $fundoscopy_macula_r = $this->input->post('fundoscopy_macula_r');
        $fundoscopy_macula_l = $this->input->post('fundoscopy_macula_l');
        $fundoscopy_postpole_r = $this->input->post('fundoscopy_postpole_r');
        $fundoscopy_postpole_l = $this->input->post('fundoscopy_postpole_l');
        $fundoscopy_vitreous_r = $this->input->post('fundoscopy_vitreous_r');
        $fundoscopy_vitreous_l = $this->input->post('fundoscopy_vitreous_l');
        $fundoscopy_peri_r	 = $this->input->post('fundoscopy_peri_r	');
        $fundoscopy_peri_l = $this->input->post('fundoscopy_peri_l');
		
        $docrec_tint = $this->input->post('docrec_tint');
        $docrec_transition = $this->input->post('docrec_transition');
        $docrec_trindex = $this->input->post('docrec_trindex');
        $docrec_arc = $this->input->post('docrec_arc');
        $docrec_src = $this->input->post('docrec_src');
        $docrec_uvcoat = $this->input->post('docrec_uvcoat');
        $docrec_prog = $this->input->post('docrec_prog');
        $docrec_bif = $this->input->post('docrec_bif');
        $docrec_trif = $this->input->post('docrec_trif');
        $docrec_ploycarb = $this->input->post('docrec_ploycarb');
        $info_frame = $this->input->post('info_frame');
        $info_lens = $this->input->post('info_lens');
        $info_clr = $this->input->post('info_clr');
        $info_poly = $this->input->post('info_poly');
        $info_trindex = $this->input->post('info_trindex');
        $info_tint = $this->input->post('info_tint');
        $info_uv = $this->input->post('info_uv');
        $info_trans = $this->input->post('info_trans');
        $info_arc = $this->input->post('info_arc');
        $info_src = $this->input->post('info_src');
        $info_others = $this->input->post('info_others');
        $info_subttl = $this->input->post('info_subttl');
        $info_discount = $this->input->post('info_discount');
        $info_total = $this->input->post('info_total');
        $info_paid = $this->input->post('info_paid');
        $info_balance = $this->input->post('info_balance');
        $pres_type = $this->input->post('pres_type');
        
        
        $advice = $this->input->post('advice');

        $report = array();

        if (!empty($medicine)) {
            foreach ($medicine as $key => $value) {
                $report[$value] = array(
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $days[$key],
                    'instruction' => $instruction[$key],
                );

                // }
            }

            foreach ($report as $key1 => $value1) {
                $final[] = $key1 . '***' . implode('***', $value1);
            }

            $final_report = implode('###', $final);
        } else {
            $final_report = '';
        }





        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Date Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Advice Field
        $this->form_validation->set_rules('symptom', 'History', 'trim|min_length[1]|max_length[1000]|xss_clean');
        // Validating Do And Dont Name Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[1000]|xss_clean');
        
        // Validating Advice Field
        $this->form_validation->set_rules('advice', 'Advice', 'trim|min_length[1]|max_length[1000]|xss_clean');
        
        // Validating Validity Field
        $this->form_validation->set_rules('validity', 'Validity', 'trim|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('prescription/editPrescription?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['medicines'] = $this->medicine_model->getMedicine();
                $data['patients'] = $this->patient_model->getPatient();
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
            $data = array('date' => $date,
                'patient' => $patient,
                'doctor' => $doctor,
                'symptom' => $symptom,
                'medicine' => $final_report,
                'note' => $note,
                'advice' => $advice,
                'patientname' => $patientname,
                'doctorname' => $doctorname,
				
                'oldrx' => $oldrx,
                'oldrx_r_sphere' => $oldrx_r_sphere,
                'oldrx_r_cyl' => $oldrx_r_cyl,
                'oldrx_r_axis' => $oldrx_r_axis,
                'oldrx_r_prism' => $oldrx_r_prism,
                'oldrx_r_base' => $oldrx_r_base,
                'oldrx_r_ipd' => $oldrx_r_ipd,
                'oldrx_r_basecurve' => $oldrx_r_basecurve,
                'oldrx_l_sphere' => $oldrx_l_sphere,
                'oldrx_l_cyl' => $oldrx_l_cyl,
                'oldrx_l_axis' => $oldrx_l_axis,
                'oldrx_l_prism' => $oldrx_l_prism,
                'oldrx_l_base' => $oldrx_l_base,
                'oldrx_l_ipd' => $oldrx_l_ipd,
                'oldrx_l_basecurve' => $oldrx_l_basecurve,
                'r_add' => $r_add,
                'r_trif' => $r_trif,
                'seg_width' => $seg_width,
                'lens_type_bif' => $lens_type_bif,
                'l_add' => $l_add,
                'l_trif' => $l_trif,
                'r_colorvision' => $r_colorvision,
                'l_colorvision' => $l_colorvision,
                'r_stereopsis' => $r_stereopsis,
                'l_stereopsis' => $l_stereopsis,
                'r_amsler' => $r_amsler,
                'l_amsler' => $l_amsler,
                'r_nct' => $r_nct,
                'l_nct' => $l_nct,
                'r_blood_pressure' => $r_blood_pressure,
                'r_blood_glucose' => $r_blood_glucose,
                'r_keratometry' => $r_keratometry,
                'l_keratometry' => $l_keratometry,
                'r_rx' => $r_rx,
                'l_rx' => $l_rx,
                'r_rx_date' => $r_rx_date,
                'l_rx_date' => $l_rx_date,
                'r_cycloplegic' => $r_cycloplegic,
                'l_cycloplegic' => $l_cycloplegic,
                'r_cycloplegic_other' => $r_cycloplegic_other,
                'l_cycloplegic_other' => $l_cycloplegic_other,
                'ver_pos' => $ver_pos,
                'ver_neg' => $ver_neg,
                'newrx_r_sphere' => $newrx_r_sphere,
                'newrx_l_sphere' => $newrx_l_sphere,
                'newrx_r_cyl' => $newrx_r_cyl,
                'newrx_l_cyl' => $newrx_l_cyl,
                'newrx_r_axis' => $newrx_r_axis,
                'newrx_l_axis' => $newrx_l_axis,
                'newrx_r_prism' => $newrx_r_prism,
                'newrx_l_prism' => $newrx_l_prism,
                'newrx_r_base' => $newrx_r_base,
                'newrx_l_base' => $newrx_l_base,
                'newrx_r_ipo' => $newrx_r_ipo,
                'newrx_l_ipo' => $newrx_l_ipo,
                'newrx_r_base_curve' => $newrx_r_base_curve,
                'newrx_l_base_curve' => $newrx_l_base_curve,
                'r_heter_add' => $r_heter_add,
                'r_heter_seg_width' => $r_heter_seg_width,
                'r_heter_lens_type' => $r_heter_lens_type,
                'r_heter_plastic' => $r_heter_plastic,
                'ver_near_neg' => $ver_near_neg,
                'l_vergency_near' => $l_vergency_near,
                'ver_near_only' => $ver_near_only,
                'ver_near_distance' => $ver_near_distance,
                'l_vergency_fulltime' => $l_vergency_fulltime,
                'l_vergency_other' => $l_vergency_other,
                'info_manufacture_1' => $info_manufacture_1,
                'info_manufacture_2' => $info_manufacture_2,
                'info_manufacture_3' => $info_manufacture_3,
                'info_manufacture_4' => $info_manufacture_4,
                'info_manufacture_5' => $info_manufacture_5,
                'info_type_1' => $info_type_1,
                'info_type_2' => $info_type_2,
                'info_type_3' => $info_type_3,
                'info_type_4' => $info_type_4,
                'info_type_5' => $info_type_5,
                'pres_type' => $pres_type,
                'info_size_1' => $info_size_1,
                'info_size_2' => $info_size_2,
                'info_size_3' => $info_size_3,
                'info_size_4' => $info_size_4,
                'info_size_5' => $info_size_5,
                'info_colour_1' => $info_colour_1,
                'info_colour_2' => $info_colour_2,
                'info_colour_3' => $info_colour_3,
                'info_colour_4' => $info_colour_4,
                'info_colour_5' => $info_colour_5,				
                'docrec_tint' => $docrec_tint,
                'docrec_transition' => $docrec_transition,
                'docrec_trindex' => $docrec_trindex,
                'docrec_arc' => $docrec_arc,
                'docrec_src' => $docrec_src,
                'docrec_uvcoat' => $docrec_uvcoat,
                'docrec_prog' => $docrec_prog,
                'docrec_bif' => $docrec_bif,
                'docrec_trif' => $docrec_trif,
                'docrec_ploycarb' => $docrec_ploycarb,
                'info_frame' => $info_frame,
                'info_lens' => $info_lens,
                'info_clr' => $info_clr,
                'info_poly' => $info_poly,
                'info_trindex' => $info_trindex,
                'info_tint' => $info_tint,
                'info_uv' => $info_uv,
                'info_trans' => $info_trans,
                'info_arc' => $info_arc,
                'info_src' => $info_src,
                'info_others' => $info_others,
                'info_subttl' => $info_subttl,
                'info_discount' => $info_discount,
                'info_total' => $info_total,
                'info_paid' => $info_paid,
                'info_balance' => $info_balance,				
                'anterior_seg_LL_r' => $anterior_seg_LL_r,
                'anterior_seg_LL_l' => $anterior_seg_LL_l,
                'anterior_seg_cornea_r' => $anterior_seg_cornea_r,
                'anterior_seg_cornea_l' => $anterior_seg_cornea_l,
                'anterior_seg_bulbar_r' => $anterior_seg_bulbar_r,
                'anterior_seg_bulbar_l' => $anterior_seg_bulbar_l,
                'anterior_seg_suppal_r' => $anterior_seg_suppal_r,
                'anterior_seg_suppal_l' => $anterior_seg_suppal_l,
                'anterior_seg_infpal_r' => $anterior_seg_infpal_r,
                'anterior_seg_infpal_l' => $anterior_seg_infpal_l,
                'anterior_seg_amtchamber_r' => $anterior_seg_amtchamber_r,
                'anterior_seg_amtchamber_l' => $anterior_seg_amtchamber_l,
                'anterior_seg_iris_r' => $anterior_seg_iris_r,
                'anterior_seg_iris_l' => $anterior_seg_iris_l,
                'anterior_lens_r' => $anterior_lens_r,
                'anterior_seg_lens_l' => $anterior_seg_lens_l,
                'ant_seg_app_ton_r' => $ant_seg_app_ton_r,
                'ant_seg_app_ton_time' => $ant_seg_app_ton_time,
                'ant_seg_bloodpressure_time' => $ant_seg_bloodpressure_time,
                'ant_seg_dpa_admin_1' => $ant_seg_dpa_admin_1,
                'ant_seg_dpa_admin_2' => $ant_seg_dpa_admin_2,
                'ant_seg_dpa_admin_3' => $ant_seg_dpa_admin_3,
                'ant_seg_dpa_admin_4' => $ant_seg_dpa_admin_4,
                'ant_seg_time_1' => $ant_seg_time_1,
                'ant_seg_time_2' => $ant_seg_time_2,
                'ant_seg_time_3' => $ant_seg_time_3,
                'ant_seg_time_4' => $ant_seg_time_4,
                'ant_seg_conc_1' => $ant_seg_conc_1,
                'ant_seg_conc_2' => $ant_seg_conc_2,
                'ant_seg_conc_3' => $ant_seg_conc_3,
                'ant_seg_conc_4' => $ant_seg_conc_4,
                'ant_seg_qty_1' => $ant_seg_qty_1,
                'ant_seg_qty_2' => $ant_seg_qty_2,
                'ant_seg_qty_3' => $ant_seg_qty_3,
                'ant_seg_qty_4' => $ant_seg_qty_4,
                'fundoscopy_cd_r' => $fundoscopy_cd_r,
                'fundoscopy_cd_l' => $fundoscopy_cd_l,
                'fundoscopy_depth_r' => $fundoscopy_depth_r,
                'fundoscopy_depth_l' => $fundoscopy_depth_l,
                'fundoscopy_margin_r' => $fundoscopy_margin_r,
                'fundoscopy_margin_l' => $fundoscopy_margin_l,
                'fundoscopy_vessel_r' => $fundoscopy_vessel_r,
                'fundoscopy_vessel_l' => $fundoscopy_vessel_l,
                'fundoscopy_crossing_r' => $fundoscopy_crossing_r,
                'fundoscopy_crossing_l' => $fundoscopy_crossing_l,
                'fundoscopy_macula_r' => $fundoscopy_macula_r,
                'fundoscopy_macula_l' => $fundoscopy_macula_l,
                'fundoscopy_postpole_r' => $fundoscopy_postpole_r,
                'fundoscopy_vitreous_r' => $fundoscopy_vitreous_r,
                'fundoscopy_vitreous_l' => $fundoscopy_vitreous_l,
                'fundoscopy_peri_r' => $fundoscopy_peri_r,
                'fundoscopy_peri_l' => $fundoscopy_peri_l
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescription($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescription($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            if (!empty($admin)) {
                if ($this->ion_auth->in_group(array('Doctor'))) {
                    redirect('prescription');
                } else {
                    redirect('prescription/all');
                }
            } else {
                redirect('prescription');
            }
            
        }
    }

    function viewPrescription() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_view_1', $data);
        $this->load->view('home/footer'); // just the header file
    }

      function glassPrescription() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('glass_prescription', $data);
        $this->load->view('home/footer'); // just the header file
    }


    function viewPrescriptionPrint() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_view_print', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function editPrescription() {
        $data = array();
        $id = $this->input->get('id');
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatientById($data['prescription']->patient);
        $data['doctors'] = $this->doctor_model->getDoctorById($data['prescription']->doctor);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPrescriptionByJason() {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        echo json_encode($data);
    }

    function getPrescriptionByPatientIdByJason() {
        $id = $this->input->get('id');
        $prescriptions = $this->prescription_model->getPrescriptionByPatientId($id);
        foreach ($prescriptions as $prescription) {
            $lists[] = ' <div class="pull-left prescription_box" style = "padding: 10px; background: #fff;"><div class="prescription_box_title">Prescription Date</div> <div>' . date('d-m-Y', $prescription->date) . '</div> <div class="prescription_box_title">Medicine</div> <div>' . $prescription->medicine . '</div> </div> ';
        }
        $data['prescription'] = $lists;
        $lists = NULL;
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $admin = $this->input->get('admin');
        $patient = $this->input->get('patient');
        $this->prescription_model->deletePrescription($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if (!empty($patient)) {
            redirect('patient/caseHistory?patient_id=' . $patient);
        } elseif (!empty($admin)) {
            redirect('prescription/all');
        } else {
            redirect('prescription');
        }
    }

    public function prescriptionCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->prescription_model->getPrescriptionCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('prescription_category', $data);
        $this->load->view('home/footer'); // just the header file
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
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
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
                $this->prescription_model->insertPrescriptionCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescriptionCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('prescription/prescriptionCategory');
        }
    }

    function edit_category() {
        $data = array();
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPrescriptionCategoryByJason() {
        $id = $this->input->get('id');
        $data['prescriptioncategory'] = $this->prescription_model->getPrescriptionCategoryById($id);
        echo json_encode($data);
    }

    function deletePrescriptionCategory() {
        $id = $this->input->get('id');
        $this->prescription_model->deletePrescriptionCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('prescription/prescriptionCategory');
    }

    function getPrescriptionListByDoctor() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearchByDoctor($doctor, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctor($doctor);
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearchByDoctor($doctor, $limit, $start, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitByDoctor($doctor, $limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye">' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $patientname,
                $prescription->patient,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $option2 . ' ' . $options4
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
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

    function getPrescriptionList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearch($search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescription();
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearch($limit, $start, $search);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a title="' . lang('view') . ' ' . lang('prescription') . '" class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> ' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-info btn-xs btn_width" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=' . $prescription->id . '&admin=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $prescription->doctorname;
            }

            if($this->ion_auth->in_group(array('Pharmacist', 'Receptionist'))){
                $option2 = '';
                $option3 = '';
            }

            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $doctorname,
                $patientname,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
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

}

/* End of file prescription.php */
/* Location: ./application/modules/prescription/controllers/prescription.php */

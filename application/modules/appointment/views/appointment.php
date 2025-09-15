 <!--
 
 <SCRIPT>
function app_trans() {
    var x = document.getElementById('App_Trans2');
    var y = document.getElementById('App_Trans1');    
    if (x.style.display == 'none') {
        x.style.display = 'block';
        y.style.display = 'block';
    } else {
        x.style.display = 'none';
        y.style.display = 'none';
    }
   
}
</SCRIPT>  -->
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('appointment'); ?>
                <br>
                <a data-toggle="modal" href="#app_trans3" id="app_trans4">
                    <button id="" class="btn btn-info btn-xs btn_width delete_button">
                        <i class="fa fa-plus-circle"></i> <?php echo 'Shift Registration'; ?>
                    </button>
                </a>
                <div class="clearfix no-print col-md-8 pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_appointment'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="col-md-12">
                <header class="panel-heading tab-bg-dark-navy-blueee row">
                    <ul class="nav nav-tabs col-md-8">
                        <li class="<?php echo (!isset($_GET['tab']) || $_GET['tab'] == 'all') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=all"><?php echo lang('all'); ?></a>
                        </li>
                        <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'pending') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=pending"><?php echo lang('pending_confirmation'); ?></a>
                        </li>
                        <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'confirmed') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=confirmed"><?php echo lang('confirmed'); ?></a>
                        </li>
                        <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'treated') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=treated"><?php echo lang('treated'); ?></a>
                        </li>
                        <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'cancelled') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=cancelled"><?php echo lang('cancelled'); ?></a>
                        </li>
                        <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'requested') ? 'active' : ''; ?>">
                            <a data-toggle="tab" href="<?php echo $_SERVER['PHP_SELF']; ?>?tab=requested"><?php echo lang('requested'); ?></a>
                        </li>
                    </ul>
                    <div class="pull-right col-md-4"><div class="pull-right custom_buttonss"></div></div>
                </header>
            </div>

            <div class="">
                <div class="tab-content">
                    <?php
                    // Get the 'tab' parameter from the URL, default to 'all' if not set
                    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
                    
                    // Determine which appointments to display based on the tab parameter
                    $appointments_to_display = $appointments; // Default to all appointments
                    if ($tab == 'pending') {
                        $appointments_to_display = $appointment_pendings;
                    } elseif ($tab == 'confirmed') {
                        $appointments_to_display = $appointment_confirmeds;
                    } elseif ($tab == 'treated') {
                        $appointments_to_display = $appointment_treateds;
                    } elseif ($tab == 'cancelled') {
                        $appointments_to_display = $appointment_cancelleds;
                    } elseif ($tab == 'requested') {
                        $appointments_to_display = $appointment_requesteds;
                    }
                    ?>

                    <div id="<?php echo $tab; ?>" class="tab-pane active">
                        <div class="">
                            <div class="panel-body">
                                <div class="adv-table editable-table ">
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th><?php echo 'Shf Reg'; ?></th>
                                                <th><?php echo lang('id'); ?></th>
                                                <th><?php echo 'Alias|Company'; ?></th>
                                                <th><?php echo 'Firstname'; ?></th>
                                                <th><?php echo 'Lastname'; ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th><?php echo lang('date-time'); ?></th>
                                                <th><?php echo lang('remarks'); ?></th>
                                                <th><?php echo lang('comments'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                                <th><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <style>
                                                .img_url {
                                                    height: 20px;
                                                    width: 20px;
                                                    background-size: contain;
                                                    max-height: 20px;
                                                    border-radius: 100px;
                                                }
                                            </style>

                                            <?php foreach ($appointments_to_display as $appointment) { ?>
                                                <tr class="">
                                                    <td><input type="checkbox" name="app_tran" value='<?php echo $appointment->id; ?>'></td>
                                                    <td><?php echo $appointment->id; ?></td>
                                                    <td>
                                                        <?php
                                                        $patient = $this->patient_model->getPatientById($appointment->patient);
                                                        if (!empty($patient)) {
                                                            $patient_name = $patient->name;
                                                            $patid = $appointment->patient;
                                                        } else {
                                                            $patient_name = '';
                                                        }
                                                        echo $patient_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($patient)) {
                                                            $patient_first_name = $patient->first_name;
                                                        } else {
                                                            $patient_first_name = '';
                                                        }
                                                        echo $patient_first_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($patient)) {
                                                            $patient_last_name = $patient->last_name;
                                                        } else {
                                                            $patient_last_name = '';
                                                        }
                                                        echo $patient_last_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $doctor = $this->doctor_model->getDoctorById($appointment->doctor);
                                                        if (!empty($doctor)) {
                                                            $doctor_name = $doctor->name;
                                                        } else {
                                                            $doctor_name = '';
                                                        }
                                                        echo $doctor_name;
                                                        ?>
                                                    </td>
                                                    <td class="center"><?php echo date('d-m-Y', $appointment->date); ?> : <?php echo $appointment->s_time; ?> - <?php echo $appointment->e_time; ?></td>
                                                    <td><?php echo $appointment->remarks; ?></td>
                                                    <td><?php echo $appointment->comments; ?></td>
                                                    <td><?php echo $appointment->status; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-edit"> <?php echo lang('edit'); ?></i></button>
                                                        <a class="btn green" title="<?php echo lang('history'); ?>" href="patient/medicalHistory?id=<?php echo $patid; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=<?php echo $appointment->id; ?>" <?php echo lang('delete'); ?> onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->




<!-- Add Appointment Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_appointment'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="appointment/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                            <option value="">Select</option>
                            <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->first_name."&nbsp;|&nbsp;".$patient->last_name."&nbsp;|&nbsp;".$patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="name"> <?php echo lang('patient'); ?> <?php echo 'Alias or Company Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>                        
						<div class="payment pad_bot pull-right">
                            <label for="firstname"> <?php echo lang('patient'); ?> <?php echo 'First Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pf_name" value='' placeholder="">
                        </div>						
						<div class="payment pad_bot pull-right">
                            <label for="lastname"> <?php echo lang('patient'); ?> <?php echo 'Last Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pl_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>
                                <option value="Others" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Others') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Others </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="adoctors" name="doctor" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''> 
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
							<option value="Dilating" <?php ?> > <?php echo 'Dilating'; ?> </option> 
                                <option value="Other" <?php ?> > <?php echo 'Other'; ?> </option> 
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
				            <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <select class="form-control m-bot15" name="remarks"  >
							<option value="Office Visit"> Office Visit </option>
							<option value="Doctor's Visit"> Doctor Visit </option>
							<option value="Special Visit">Special Visit </option>
							<option value="Followup Visit">Follow up Visit </option>
							<option value="Pickup">Pickup </option>
							<option value="Other">Other Visit </option>
							
							</select>
                    </div>	
					
                    <div class="col-md-6 panel">
                        <label for="exampleInputComments"> <?php echo lang('comments'); ?></label>
                        <input type="text" class="form-control" name="comments" id="exampleInputComments" value='' placeholder="additional comments">
                    </div>
                    <div class="col-md-6 panel">
                     <!--   <label> <?php echo lang('send_sms'); ?>  </label> <br>
                        <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?> -->
                    </div>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->


<!-- Add Appointment Modal- ->
<div class="modal fade" id="app_trans2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_appointment'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="appointment/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                            <option value="">Select</option>
                            <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->first_name."&nbsp;|&nbsp;".$patient->last_name."&nbsp;|&nbsp;".$patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="name"> <?php echo lang('patient'); ?> <?php echo 'Alias or Company Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>                        
						<div class="payment pad_bot pull-right">
                            <label for="firstname"> <?php echo lang('patient'); ?> <?php echo 'First Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pf_name" value='' placeholder="">
                        </div>						
						<div class="payment pad_bot pull-right">
                            <label for="lastname"> <?php echo lang('patient'); ?> <?php echo 'Last Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pl_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>
                                <option value="Others" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Others') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Others </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="adoctors" name="doctor" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''> 
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
				            <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <select class="form-control m-bot15" name="remarks"  >
							<option value="Office Visit"> Office Visit </option>
							<option value="Doctor's Visit"> Doctor Visit </option>
							<option value="Special Visit">Special Visit </option>
							<option value="Followup Visit">Follow up Visit </option>
							<option value="Pickup">Pickup </option>
							<option value="Other">Other Visit </option>
							
							</select>
                    </div>	
					
                 <!--   <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>-->
                    <div class="col-md-6 panel">
                     <!--   <label> <?php echo lang('send_sms'); ?>  </label> <br>
                        <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?> -->
                    </div>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->

<!-- transfer Appointment Modal-->
<div class="modal fade" id="app_trans3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Appointments to be Transferred</h4>
            </div>
            <div class="modal-body">		
                <form role="form" action="./db/app_trans.php" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Transfer to Date:</label> 
						<input type="text" id="app_trans_date" name="dateFrom" class="form-control default-date-picker" />
                    </div>
                    
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="adoctors" name="doctor" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''> 
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
							<option value="Dilating" <?php ?> > <?php echo 'Dilating'; ?> </option> 
                                <option value="Other" <?php ?> > <?php echo 'Other'; ?> </option> 
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
				            <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <select class="form-control m-bot15" name="remarks"  >
							<option value="Office Visit"> Office Visit </option>
							<option value="Doctor's Visit"> Doctor Visit </option>
							<option value="Special Visit">Special Visit </option>
							<option value="Followup Visit">Follow up Visit </option>
							<option value="Pickup">Pickup </option>
							<option value="Other">Other Visit </option>
							
							</select>
                    </div>	
					<div class="col-md-6 panel">
                        <label for="exampleInputComments">Addtional Comments:</label> 
						<input type="text" id="exampleInputComments" name="comments" class="form-control" />
                    </div>
                    </div>
                    <div class="col-md-12 panel">
					<h6 id="modal_body"></h6>
					

<?php //echo $app_transfer9; ?>
                    </div>                    
					<div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
						
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- transfer Appointment Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_appointment'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select patient" id="pos_select" name="patient" value=''> 
                            <option value="">Select</option>
                            <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->first_name."&nbsp;|&nbsp;".$patient->last_name."&nbsp;|&nbsp;".$patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
						<div class="payment pad_bot pull-right">
                            <label for="firstname"> <?php echo lang('patient'); ?> <?php echo 'First Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pf_name" value='' placeholder="">
                        </div>						
						<div class="payment pad_bot pull-right">
                            <label for="lastname"> <?php echo lang('patient'); ?> <?php echo 'Last Name';//lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="pl_name" value='' placeholder="">
                        </div>						
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

                                <option value="Male" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Male') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Male </option>   
                                <option value="Female" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Female') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Female </option>
                                <option value="Others" <?php
                                if (!empty($patient->sex)) {
                                    if ($patient->sex == 'Others') {
                                        echo 'selected';
                                    }
                                }
                                ?> > Others </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single doctor" id="adoctors1" name="doctor" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date1" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
							<option value="Dilating" <?php ?> > <?php echo 'Dilating'; ?> </option> 
                                <option value="Other" <?php ?> > <?php echo 'Other'; ?> </option> 
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>

                    <div class="col-md-6 panel">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <select class="form-control m-bot15" name="remarks"  >
							<option value="Office Visit"> Office Visit </option>
							<option value="Doctor's Visit"> Doctor Visit </option>
							<option value="Special Visit">Special Visit </option>
							<option value="Followup Visit">Follow up Visit </option>
							<option value="Pickup">Pickup </option>
							<option value="Other">Other Visit </option>
							
							</select>
                    </div>
					
                    <div class="col-md-6 panel">
                        <label for="exampleInputComments"> <?php echo lang('comments'); ?></label>
                        <input type="text" class="form-control" name="comments" id="exampleInputComments" value='' placeholder="additional comments">
                    </div>
                    <div class="col-md-6 panel">
                     <!--   <label> <?php echo lang('send_sms'); ?> ? </label> <br>
                        <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?> -->
                    </div>
                    <input type="hidden" name="id" id="appointment_id" value=''>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                                        $(document).ready(function () {
                                                            $(".editbutton").click(function (e) {
                                                                e.preventDefault(e);
                                                                // Get the record's ID via attribute  
                                                                var iid = $(this).attr('data-id');
                                                                var id = $(this).attr('data-id');

                                                                $('#editAppointmentForm').trigger("reset");
                                                                $('#myModal2').modal('show');
                                                                $.ajax({
                                                                    url: 'appointment/editAppointmentByJason?id=' + iid,
                                                                    method: 'GET',
                                                                    data: '',
                                                                    dataType: 'json',
                                                                }).success(function (response) {
                                                                    var de = response.appointment.date * 1000;
                                                                    var d = new Date(de);
                                                                    var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                                                                    // Populate the form fields with the data returned from server
                                                                    $('#editAppointmentForm').find('[name="id"]').val(response.appointment.id).end()
                                                                    $('#editAppointmentForm').find('[name="patient"]').val(response.appointment.patient).end()
                                                                    $('#editAppointmentForm').find('[name="doctor"]').val(response.appointment.doctor).end()
                                                                    $('#editAppointmentForm').find('[name="date"]').val(da).end()
                                                                    $('#editAppointmentForm').find('[name="status"]').val(response.appointment.status).end()
                                                                    $('#editAppointmentForm').find('[name="remarks"]').val(response.appointment.remarks).end()
																	$('#editAppointmentForm').find('[name="comments"]').val(response.appointment.comments).end()

                                                                    $('.js-example-basic-single.doctor').val(response.appointment.doctor).trigger('change');
                                                                    $('.js-example-basic-single.patient').val(response.appointment.patient).trigger('change');




                                                                    var date = $('#date1').val();
                                                                    var doctorr = $('#adoctors1').val();
                                                                    var appointment_id = $('#appointment_id').val();
                                                                    // $('#default').trigger("reset");
                                                                    $.ajax({
                                                                        url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + appointment_id,
                                                                        method: 'GET',
                                                                        data: '',
                                                                        dataType: 'json',
                                                                    }).success(function (response) {
                                                                        $('#aslots1').find('option').remove();
                                                                        var slots = response.aslots;
                                                                        $.each(slots, function (key, value) {
                                                                            $('#aslots1').append($('<option>').text(value).val(value)).end();
                                                                        });

                                                                        $("#aslots1").val(response.current_value)
                                                                                .find("option[value=" + response.current_value + "]").attr('selected', true);
                                                                        //  $('#aslots1 option[value=' + response.current_value + ']').attr("selected", "selected");
                                                                        //   $("#default-step-1 .button-next").trigger("click");
                                                                        if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                                                                            $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                                                                        }
                                                                        // Populate the form fields with the data returned from server
                                                                        //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
                                                                    });
                                                                });
                                                            });
                                                        });
</script>




<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>




<script>
    $(document).ready(function () {
      var table = $('table.table').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "asc"]],

            "language": {
                "lengthMenu": "_MENU_",
                 search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            }
        });
        table.buttons().container().appendTo('.custom_buttons'); 
    });
</script>





<script type="text/javascript">
    $(document).ready(function () {
        $("#adoctors").change(function () {
            // Get the record's ID via attribute  
            var iid = $('#date').val();
            var doctorr = $('#adoctors').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
            });
        });

    });

    $(document).ready(function () {
        var iid = $('#date').val();
        var doctorr = $('#adoctors').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    });




    $(document).ready(function () {
        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged)
                .on('changeDate', dateChanged);
    });

    function dateChanged() {
        // Get the record's ID via attribute  
        var iid = $('#date').val();
        var doctorr = $('#adoctors').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }


            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    }




</script>












<script type="text/javascript">
    $(document).ready(function () {
        $("#adoctors1").change(function () {
            // Get the record's ID via attribute 
            var id = $('#appointment_id').val();
            var date = $('#date1').val();
            var doctorr = $('#adoctors1').val();
            $('#aslots1').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots1').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
            });
        });
    });

    $(document).ready(function () {
        var id = $('#appointment_id').val();
        var date = $('#date1').val();
        var doctorr = $('#adoctors1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    });




    $(document).ready(function () {
        $('#date1').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged1)
                .on('changeDate', dateChanged1);
    });    
	
	$(document).ready(function () {
        $('#app_trans_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged1)
                .on('changeDate', dateChanged1);
    });

    function dateChanged1() {
        // Get the record's ID via attribute  
        var id = $('#appointment_id').val();
        var iid = $('#date1').val();
        var doctorr = $('#adoctors1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + iid + '&doctor=' + doctorr + '&appointment_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }


            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
        });

    }



</script>

<script>
  // Wait for the HTML document to be fully loaded and parsed
  document.addEventListener('DOMContentLoaded', function() {

    // Function to get URL query parameters
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    // Check if the 'add' parameter exists and equals 'new'
    if (getQueryParam('add') === 'new') {

      // Find the specific link that triggers the modal with href="#myModal"
      // We select the <a> tag because it has the data-toggle and href attributes
      // which Bootstrap's modal JS relies on.
      const modalTriggerLink = document.querySelector('a[href="#myModal"]');

      // Check if the element was actually found
      if (modalTriggerLink) {
        // Programmatically click the link to open the modal
        modalTriggerLink.click();
        // Alternatively, if using Bootstrap's JS API directly (requires jQuery usually):
        // $('#myModal').modal('show'); // If you are using jQuery and Bootstrap JS
      } else {
        console.warn('Could not find the modal trigger link (a[href="#myModal"]) to open automatically.');
      }
    }

  });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>




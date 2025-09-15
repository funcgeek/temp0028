<style>

/* (A) HIDE CHECKBOX */
.togCheck { display: none; }

/* (B) HIDE CONTENT BY DEFAULT */
.togContent {
  max-height: 0;
  opacity: 0;
  visibility: hidden;
  transition: max-height 1s;
}

/* (C) SHOW CONTENT WHEN CHECKED */
.togCheck:checked + .togContent {
  max-height: 100vh; /* any insanely large number if a lot of contents */
  opacity: 1;
  visibility: visible;
}

/* (X) COSMETICS - DOES NOT MATTER */
/* (X1) ENTIRE DEMO */
* {
  font-family: arial, sans-serif;
  box-sizing: border-box;
}

/* (X2) TOGGLE BUTTON */
.togButton {
  display: block;
  padding: 10px;
  cursor: pointer;
  color: blue;
  font-size: 14px;
  font-weight: bold;
}

/* (X3) CONTENT */
.togContent { background: #fff; }
.togContent p {
  padding: 50px 10px;
  margin: 0;
}
.myHistoryDIV {
  width: 100%;
  padding: 10px;
  text-align: left;
/*  background-color: lightblue; */
  margin-top: 2px;
  color: #000;
}
.ulstyl {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #5c77c5;
}

.listyl {
  float: left;
}

.listyl a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.listyl a:hover {
  background-color: #111;
}	
.liactive {
  background-color: #111;
}

.noinputborder {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: #fff;
        width: 11px;
        color: #ff0000;
        font-weight: bold;
      }
      
      .noinputborder:focus {
        outline: none;
      }
.noinputborder2 {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: #fff;
        color: #ff0000;
        font-weight: bold;
      }
      
      .noinputborder2:focus {
        outline: none;
      }	


#hidden_div1 {
    display: none;
}
#hidden_div2 {
    display: none;
}
#hidden_div3 {
    display: none;
}

#hidden_rem_doc {
    display: none;
}
#hidden_rem_reg {
    display: none;
}
#hidden_rem_document {
    display: none;
}


/* Tooltip container */
.tooltip2 {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip2 .tooltip2text {
  visibility: hidden;
  width: 400px;
  height: 100px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip2:hover .tooltip2text {
  visibility: visible;
}

        .input20:focus{
            border: none;
			font-weight: bold;
			text-decoration: underline;
			    margin: 0 ;
				padding: 0 ;
        }        
		.input20{
            border: none;
			font-weight: bold;
			text-decoration: underline;
				margin: 0 ;
				padding: 0 ;
				
        }
</style>	

<script>
var htp =   window.location.hostname;
</script>

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">

        <section class="col-md-12">
            <header class="panel-heading clearfix">
                <div class="col-md-9">
                   Medical Record Dashboard - <?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name; ?>
                </div>           
                <div class="col-md-3 pull-right">
                    <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                </div>
            </header>

            <section class="panel-body">   
                <header class="panel-heading tab-bg-dark-navy-blueee">
                    <ul class="nav nav-tabs">
                  <!--   <li class="">
                            <a data-toggle="tab" href="#dashboard">Dashboard</a>
                        </li>-->
                        <li class="active">
                            <a data-toggle="tab" href="#appointments"><?php echo lang('appointments'); ?></a>
                        </li>
                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
                        <li class="">
                            <a data-toggle="tab" href="#home"><?php echo "Doctor Notes";//lang('case_history'); ?></a>
                        </li>
						<?php } ?>
						<li class="">
                            <a data-toggle="tab" href="#oct"><?php echo 'O.C.T'; ?></a>
                        </li>
                        
                     <!--   <li class="">
                            <a data-toggle="tab" href="#photograph"><?php echo 'Photographs'; ?></a>
                        </li>-->
                        <li class="">
                            <a data-toggle="tab" href="#results"><?php echo 'Results'; ?></a>
                        </li>
						<?php //if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
                        <li class="">
                            <a data-toggle="tab" href="#sick_leave">Sick Leave</a>
                        </li>    
						<?php //} ?>
                        <li class="">
                            <a data-toggle="tab" href="#referal">Referral Report</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#about">Prescription</a>
                        </li>--
                        
                        <!--  <li class="">
                            <a data-toggle="tab" href="#glasses">Glasses</a>
                        </li>-->
                         <li class="">
                            <a data-toggle="tab" href="#consent">Consent Form</a>
                        </li>                     

                      
                        
                        <li class="">
                            <a data-toggle="tab" href="#refraction"><?php echo lang('refractions'); ?></a>
                        </li>                        
					
                        
                        <li class="">
                            <a data-toggle="tab" href="#documents"><?php echo lang('documents'); ?></a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#timeline"><?php echo lang('timeline'); ?></a> 
                        </li>  
					</ul>

                 
                </header>
                <div class="panel">
                    <div class="tab-content">
                        <div id="appointments" class="tab-pane active">
                            <div class="">
									 <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
							
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#addAppointmentModal">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New Registration";//lang('add_new'); ?> 
                                        </a>

                                    </div>
                                <?php  } else { ?>
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#addAppointmentModal">
                                            <i class="fa fa-plus-circle"> </i> <?php echo lang('request_a_appointment'); ?> 
                                        </a>
                                    </div>
                                <?php }  ?>
                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('time_slot'); ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th><?php echo 'Reason';//lang('remarks'); ?></th>
                                                <th><?php echo 'Comments';//lang('comm'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                                <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($appointments as $appointment) { ?>
                                                <tr class="">

                                                    <td>
<?php	$strtm = $appointment->time;
		$parts = explode(" ", $strtm);
		$one = $parts[0];
		$twotime = $parts[1];
?>													
													
											<?php echo date('d-m-Y', $appointment->date).' ('.$twotime.')'; ?>
													
													
													
													
													</td>
                                                    <td><?php echo $appointment->time_slot; ?></td>
                                                    <td>
                                                        <?php
                                                        $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
                                                        if (!empty($doctor_details)) {
                                                            $appointment_doctor = $doctor_details->name;
                                                        } else {
                                                            $appointment_doctor = '';
                                                        }
                                                        echo $appointment_doctor;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $appointment->remarks; ?></td>
                                                    <td><?php echo $appointment->comments; ?></td>
                                                    <td><?php echo $appointment->status; ?></td>
                                                     <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
                                                        <td class="no-print">
														
                                                            <button type="button" class="btn btn-info btn-xs btn_width editAppointmentButton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $appointment->id; ?>"><i class="fa fa-edit"></i> </button>  

															<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="appointment/delete?id=<?php echo $appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
															<?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
											<?php } ?>	
										<!--	<tr>
											<td colspan='7'>
											<table id="hidden_rem_reg" width="100%"> 
											<caption><b style="color:red;"><u>OTHER SYSTEM INFORMATION</u></b></caption>
											  <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo 'location'; ?></th>
                                                <th><?php echo lang('time_slot'); ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                                <th class="no-print"><?php echo 'Reason for Visit'; ?></th>
                                             
                                            </tr>
										<!-- insert for remote system information - ->
											<?php //include('./db/remote_regnotes.php'); ?>
										<!-- end remote system information - ->		
											</table>
											</td>
											</tr>												
                                          -->  
                                        </tbody>
                                    </table>
<script>
function myRemreg() {
  var x = document.getElementById("hidden_rem_reg");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>									
                                </div>
                            </div>
                        </div>
 <div id="dashboard" class="tab-pane ">
                             <section class="col-md-9">
                    <div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction0();">Medical History</a></label>  
<div class="myHistoryDIV" id="myDIV0" style="display:none;">				
<ul class="ulstyl">
  <li class="listyl" id="listyl0"><a onclick="ulstyl0()">General</a></li>
  <li class=" listyl" id="listyl1" ><a onclick="ulstyl1()">Family History</a></li>
  <li class=" listyl" id="listyl2"><a onclick="ulstyl2()">Relatives</a></li>
  <li class=" listyl" id="listyl3"><a onclick="ulstyl3()">Lifestyle</a></li>
  <li class=" listyl" id="listyl4"><a onclick="ulstyl4()">Others</a></li>
</ul>
<div id='mystyl0' style="display:none;">
<table cellpadding="0" cellspacing="5" border="0" width="100%" >
<caption style="float: left;"><h3>Risk Factors</h3></caption>
<tr>
<td>[<input type="text" class="noinputborder" name="vveins"  value=" " readonly />] Varicose Veins </td>		
<td>[<input type="text" class="noinputborder" name="hypertension"  value=" " readonly />] Hypertension   </td>		
<td>[<input type="text" class="noinputborder" name="diabetes"  value=" " readonly />] Diabetes   </td>		
<td>[<input type="text" class="noinputborder" name="sickle_cell"  value=" " readonly />] Sickle Cell    </td>		
</tr>	
<tr>
<td>[<input type="text" class="noinputborder" name="fibroids"  value=" " readonly />] Fibroids </td>		
<td>[<input type="text" class="noinputborder" name="PID"  value=" " readonly />] PID (Pelvic Inflammatory Disease)     </td>		
<td>[<input type="text" class="noinputborder" name="severe_migraine"  value=" " readonly />] Severe Migraine   </td>		
<td>[<input type="text" class="noinputborder" name="heart_disease  "  value=" " readonly />] Heart Disease      </td>		
</tr>
<tr>
<td>[<input type="text" class="noinputborder" name="thrombosis_stroke"  value=" " readonly />] Thrombosis/Stroke </td>		
<td>[<input type="text" class="noinputborder" name="hepatitis  "  value=" " readonly />] Hepatitis  </td>		
<td>[<input type="text" class="noinputborder" name="gall_bladder_condition "  value=" " readonly />] Gall Bladder Condition  </td>		
<td>[<input type="text" class="noinputborder" name="breast_disease  "  value=" " readonly />] Breast Disease </td>		
</tr>
<tr>
<td>[<input type="text" class="noinputborder" name="depression"  value=" " readonly />]Depression </td>		
<td>[<input type="text" class="noinputborder" name="allergies  "  value=" " readonly />] Allergies  </td>		
<td>[<input type="text" class="noinputborder" name="Infertility "  value=" " readonly />] Infertility </td>		
<td>[<input type="text" class="noinputborder" name="asthma   "  value=" " readonly />]Asthma   </td>		
</tr>
<tr>
<td>[<input type="text" class="noinputborder" name="epilepsy  "  value=" " readonly />]Epilepsy </td>		
<td>[<input type="text" class="noinputborder" name="contact_lenses  "  value=" " readonly />] Contact Lenses   </td>		
<td>[<input type="text" class="noinputborder" name="contraceptive_complication "  value=" " readonly />] Contraceptive Complication (specify)   </td>		
<td>[<input type="text" class="noinputborder" name="other   "  value=" " readonly />]Other (specify)    </td>		
</tr>	

</table>
<table cellpadding="0" cellspacing="5" border="0" width="100%" >
<caption style="float: left;"><h3>Exams/Tests</h3></caption>
<tr>
<td>Breast Exam</td>	
<td><input type="text" class="noinputborder2" name="breast_exam"  value="" readonly /></td>
<td><input type="text" class="noinputborder2" name="breast_exam_date"  value="" readonly /></td>
<td>&nbsp;</td>	
</tr>
<tr>
<td>Cardiac Echo</td>	
<td><input type="text" class="noinputborder2" name="cardiac_ccho"  value="" readonly /></td>
<td><input type="text" class="noinputborder2" name="cardiac_ccho_date"  value="" readonly /></td>
<td>&nbsp;</td>	
</tr>
<tr>
<td>ECG </td>	
<td><input type="text" class="noinputborder2" name="ECG"  value="" readonly /></td>
<td><input type="text" class="noinputborder2" name="ECG_date"  value="" readonly /></td>
<td>&nbsp;</td>	
</tr>
</table>
</div>
<div id='mystyl1' style="display:none;">
<table cellpadding="0" cellspacing="5" border="0" width="100%" >
<caption><h3>Family History</h3></caption>
<tr>
<td width="10%">Father:</td>	
<td width="25%"><input type="text" class="noinputborder2" name="father_name"  value="" readonly /></td>	
<td width="15%">Diagnosis Code:</td>	
<td><input type="text" class="noinputborder2" name="f_diagnosis_code"  value="" readonly /></td>		
</tr>
<tr>
<td width="10%">Mother:</td>	
<td><input type="text" class="noinputborder2" name="mother_name"  value="" readonly /></td>	
<td>Diagnosis Code:</td>	
<td><input type="text" class="noinputborder2" name="m_diagnosis_code"  value="" readonly /></td>		
</tr>
<tr>
<td width="10%">Siblings:</td>	
<td><input type="text" class="noinputborder2" name="sibling_name"  value="" readonly /></td>	
<td>Diagnosis Code:</td>	
<td><input type="text" class="noinputborder2" name="s_diagnosis_code"  value="" readonly /></td>		
</tr>
<tr>
<td width="10%">Spouse:</td>	
<td><input type="text" class="noinputborder2" name="spouse_name"  value="" readonly /></td>	
<td>Diagnosis Code:</td>	
<td><input type="text" class="noinputborder2" name="sp_diagnosis_code"  value="" readonly /></td>		
</tr>
<tr>
<td width="10%">Offspring:</td>	
<td><input type="text" class="noinputborder2" name="offspring_name"  value="" readonly /></td>	
<td width="10%">Diagnosis Code:</td>	
<td><input type="text" class="noinputborder2" name="off_diagnosis_code"  value="" readonly /></td>		
</tr>

</table>
</div>
<div id='mystyl2' style="display:none;">
<table cellpadding="0" cellspacing="5" border="0" width="100%" >
<caption style="float: left;"><h3> Relatives with Issues</h3></caption>
<tr>
<td>Cancer:</td>	
<td><input type="text" class="noinputborder2" name="history_cancer"  value="" readonly /></td>	
<td>Tuberculosis:</td>	
<td><input type="text" class="noinputborder2" name="history_tuberculosis"  value="" readonly /></td>		
</tr>
<tr>
<td>Diabetes:</td>	
<td><input type="text" class="noinputborder2" name="history_diabetes"  value="" readonly /></td>	
<td>High Blood Pressure:</td>	
<td><input type="text" class="noinputborder2" name="history_blood_pressure"  value="" readonly /></td>		
</tr>	
<tr>
<td>Heart Problems:</td>	
<td><input type="text" class="noinputborder2" name="history_heart_problem"  value="" readonly /></td>	
<td>Stroke:</td>	
<td><input type="text" class="noinputborder2" name="history_stroke"  value="" readonly /></td>		
</tr>
<tr>
<td>Epilepsy:</td>	
<td><input type="text" class="noinputborder2" name="history_epilepsy"  value="" readonly /></td>	
<td>Mental Illness:	</td>	
<td><input type="text" class="noinputborder2" name="history_mental_illness"  value="" readonly /></td>		
</tr>
<tr>
<td>Suicide:</td>	
<td><input type="text" class="noinputborder2" name="history_suicide"  value="" readonly /></td>	
<td>Others:	</td>	
<td><input type="text" class="noinputborder2" name="history_other"  value="" readonly /></td>		
</tr>	
</table>
	
</div>
<div id='mystyl3' style="display:none;">test4</div>
<div id='mystyl4' style="display:none;">test5</div>

								
							</div>  
					</div>                     
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction();">Billing</a></label>  
							<div class="myHistoryDIV" id="myDIV1" style="display:none;">
								<p>
									Patient Balance Due. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0.00 <br>
									Insurance Balance Due.&nbsp;&nbsp;&nbsp;&nbsp; 0.00 </p>
									<b>Total Balance Due. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0.00</b>
								
							</div>  
					</div>  
					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction2();">Demographics</a></label>  
							<div class="myHistoryDIV" id="myDIV2" style="display:none;">
								
								<ul class="ulstyl">
  <li class="listyl" id="lidem0"><a onclick="uldem0()">Patient</a></li>
  <li class=" listyl" id="lidem1" ><a onclick="uldem1()">Contact</a></li>
  <li class=" listyl" id="lidem2"><a onclick="uldem2()">Choices</a></li>
  <li class=" listyl" id="lidem3"><a onclick="uldem3()">Employer</a></li>
  <li class=" listyl" id="lidem4"><a onclick="uldem4()">Stats</a></li>
  <li class=" listyl" id="lidem5"><a onclick="uldem5()">Guardian</a></li>
  <li class=" listyl" id="lidem6"><a onclick="uldem6()">Misc</a></li>
</ul>
							</div>  
					</div> 					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction3();">Messages</a></label>  
							<div class="myHistoryDIV" id="myDIV3" style="display:none;">
								<p>New Patient Messages Information will be added  here shortly.</p>
							</div>  
					</div> 					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction4();">Patient Reminders</a></label>  
							<div class="myHistoryDIV" id="myDIV4" style="display:none;">
								<p>New Patient Reminders Information will be added  here shortly.</p>
							</div>  
					</div> 					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction5();">Disclosures</a></label>  
							<div class="myHistoryDIV" id="myDIV5" style="display:none;">
								<p>New Patient Disclosures Information will be added  here shortly.</p>
							</div>  
					</div>  					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myFunction6();">Amendments</a></label>  
							<div class="myHistoryDIV" id="myDIV6" style="display:none;">
								<p>New Patient Amendments Information will be added  here shortly.</p>
							</div>  
					</div>  

                              
<script>
function myFunction() {
  var x = document.getElementById("myDIV1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myFunction0() {
  var x = document.getElementById("myDIV0");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function myFunction2() {
  var x = document.getElementById("myDIV2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myFunction3() {
  var x = document.getElementById("myDIV3");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myFunction4() {
  var x = document.getElementById("myDIV4");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myFunction5() {
  var x = document.getElementById("myDIV5");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}function myFunction6() {
  var x = document.getElementById("myDIV6");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function ulstyl0() {
  var x = document.getElementById("mystyl0");
  var x1 = document.getElementById("mystyl1");
  var x2 = document.getElementById("mystyl2");
  var x3 = document.getElementById("mystyl3");
  var x4 = document.getElementById("mystyl4");
  if (x.style.display === "none") {
    x.style.display = "block";
    x1.style.display = "none";
    x2.style.display = "none";
    x3.style.display = "none";
    x4.style.display = "none";
    document.getElementById("listyl0").classList.add("liactive");    
    document.getElementById("listyl1").classList.remove("liactive");    
    document.getElementById("listyl2").classList.remove("liactive");    
    document.getElementById("listyl3").classList.remove("liactive");    
    document.getElementById("listyl4").classList.remove("liactive");    
  } else {
    x.style.display = "none";

  }
}
function ulstyl1() {
  var x = document.getElementById("mystyl0");
  var x1 = document.getElementById("mystyl1");
  var x2 = document.getElementById("mystyl2");
  var x3 = document.getElementById("mystyl3");
  var x4 = document.getElementById("mystyl4");
  if (x1.style.display === "none") {
    x.style.display = "none";
    x1.style.display = "block";
    x2.style.display = "none";
    x3.style.display = "none";
    x4.style.display = "none";
    document.getElementById("listyl1").classList.add("liactive"); 
    document.getElementById("listyl0").classList.remove("liactive");
    document.getElementById("listyl2").classList.remove("liactive");
    document.getElementById("listyl3").classList.remove("liactive");
    document.getElementById("listyl4").classList.remove("liactive");
  } else {
    x1.style.display = "none";
  }
}
function ulstyl2() {
  var x = document.getElementById("mystyl0");
  var x1 = document.getElementById("mystyl1");
  var x2 = document.getElementById("mystyl2");
  var x3 = document.getElementById("mystyl3");
  var x4 = document.getElementById("mystyl4");
  if (x2.style.display === "none") {
    x.style.display = "none";
    x1.style.display = "none";
    x2.style.display = "block";
    x3.style.display = "none";
    x4.style.display = "none";
    document.getElementById("listyl2").classList.add("liactive"); 
    document.getElementById("listyl0").classList.remove("liactive");
    document.getElementById("listyl1").classList.remove("liactive");
    document.getElementById("listyl3").classList.remove("liactive");
    document.getElementById("listyl4").classList.remove("liactive");
  } else {
    x2.style.display = "none";
  }
}
function ulstyl3() {
  var x = document.getElementById("mystyl0");
  var x1 = document.getElementById("mystyl1");
  var x2 = document.getElementById("mystyl2");
  var x3 = document.getElementById("mystyl3");
  var x4 = document.getElementById("mystyl4");
  if (x3.style.display === "none") {
    x.style.display = "none";
    x1.style.display = "none";
    x2.style.display = "none";
    x3.style.display = "block";
    x4.style.display = "none";
    document.getElementById("listyl3").classList.add("liactive");
    document.getElementById("listyl0").classList.remove("liactive"); 
    document.getElementById("listyl1").classList.remove("liactive"); 
    document.getElementById("listyl2").classList.remove("liactive"); 
    document.getElementById("listyl4").classList.remove("liactive"); 
  } else {
    x3.style.display = "none";
  }
}
function ulstyl4() {
  var x = document.getElementById("mystyl0");
  var x1 = document.getElementById("mystyl1");
  var x2 = document.getElementById("mystyl2");
  var x3 = document.getElementById("mystyl3");
  var x4 = document.getElementById("mystyl4");
  if (x4.style.display === "none") {
    x.style.display = "none";
    x1.style.display = "none";
    x2.style.display = "none";
    x3.style.display = "none";
    x4.style.display = "block";
    document.getElementById("listyl4").classList.add("liactive"); 
    document.getElementById("listyl0").classList.remove("liactive");
    document.getElementById("listyl1").classList.remove("liactive");
    document.getElementById("listyl2").classList.remove("liactive");
    document.getElementById("listyl3").classList.remove("liactive");
  } else {
    x4.style.display = "none";
  }
}

</script>                            
                              
                              
</section>
 <section class="col-md-3">
					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myclinicalFunction();">Clinical Reminders</a></label>  
							<div class="myHistoryDIV" id="myclin" style="display:none;">
								<p> Patient Clinical Reminders Information will be added  here shortly.</p>
							</div>  
					</div>  					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myrecallFunction();">Recall</a></label>  
							<div class="myHistoryDIV" id="myrecall" style="display:none;">
								<p>Patient Recall Information will be added  here shortly.</p>
							</div>  
					</div>		
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myappointmentFunction();">Appointment</a></label>  
							<div class="myHistoryDIV" id="myappointment" style="display:none;">
								<p>Patient Appointment Information will be added  here shortly.</p>
							</div>  
					</div> 			
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="mymedproblemFunction();">Medical Problem</a></label>  
							<div class="myHistoryDIV" id="mymedproblem" style="display:none;">
								<p>Patient MEdical Problem Information will be added  here shortly.</p>
							</div>  
					</div> 					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myallergiesFunction();">Allergies</a></label>  
							<div class="myHistoryDIV" id="myallergies" style="display:none;">
								<p>Patient Allergies Information will be added  here shortly.</p>
							</div>  
					</div>					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="mymedicationFunction();">Medications</a></label>  
							<div class="myHistoryDIV" id="mymedication" style="display:none;">
								<p>Patient Medication Information will be added  here shortly.</p>
							</div>  
					</div> 					
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myimmuneFunction();">Immunization</a></label>  
							<div class="myHistoryDIV" id="myimmune" style="display:none;">
								<p>Patient Immunization Information will be added  here shortly.</p>
							</div>  
					</div>  		
					<div style="border-style: ridge;"> 
						<label class="togButton"><a onclick="myprescriptionFunction();">Prescriptions</a></label>  
							<div class="myHistoryDIV" id="myprescription" style="display:none;">
								<p>Patient Prescription Information will be added  here shortly.</p>
							</div>  
					</div>  
 
 



<script>
function myimmuneFunction() {
  var x = document.getElementById("myimmune");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myprescriptionFunction() {
  var x = document.getElementById("myprescription");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function mymedicationFunction() {
  var x = document.getElementById("mymedication");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myclinicalFunction() {
  var x = document.getElementById("myclin");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myallergiesFunction() {
  var x = document.getElementById("myallergies");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myrecallFunction() {
  var x = document.getElementById("myrecall");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}	
function myappointmentFunction() {
  var x = document.getElementById("myappointment");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}	
function mymedproblemFunction() {
  var x = document.getElementById("mymedproblem");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}	
	
</script> 
 </section> 
 
 </div>
                                                
                        <div id="home" class="tab-pane">
                            <div class="">

                                <?php // if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New Notes";//lang('add_new'); ?> 
                                        </a> 
                                  <!--      <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalDocHistory">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "Medical History";//lang('add_new'); ?> 
                                        </a> 
										<button class="btn btn-info btn_width btn-xs" id="button_rem_doc" class="button_rem_doc" onclick="myRemdoc()">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "Other Location Notes";//lang('add_new'); ?> 
                                        </button>-->
										
                                    </div>
                                <?php //} ?>

                                <div class="adv-table editable-table ">


                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo 'Location'; ?></th>
                                                <th><?php echo "Doctor"; ?></th>
                                                <th><?php echo "Age"; ?></th>
                                                <th><?php echo 'Complaint';//lang('title'); ?></th>
                                                <th><?php echo lang('description'); ?></th>
                                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($medical_histories as $medical_history) { ?>
                                                <tr class="">

                                                    <td><?php echo date('d-m-Y', $medical_history->date); ?></td>
                                                    <td><?php echo $medical_history->location; ?></td>
                                                    <td><?php echo $medical_history->doctor_name; ?></td>
                                                    <td><?php echo $medical_history->age;
														$todate= strtotime('May 3, 2012 10:38:22 GMT');
														$fromdate= strtotime('06 Apr 2012 07:22:21 GMT');
														$calculate_seconds = $todate- $fromdate; // Number of seconds between the two dates
														$days = floor($calculate_seconds / (24 * 60 * 60 )); // convert to days
														echo($days);


													?></td>
                                                    <td><?php echo $medical_history->title; ?></td>
                                                    <td><?php echo $medical_history->description; ?></td>
                                                    <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                        <td class="no-print">
														
														<a id="getDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor2" 
															 data-id="<?php echo $medical_history->id; ?>">
															<i class="fa fa-plus-circle"> </i> View </a>
														
														
														
														
														<?php 
														
															if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?>
                                                            <a id="editDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor_edit" 
															 data-id="<?php echo $medical_history->id; ?>">
															<i class="fa fa-plus-circle"> </i> Edit </a>
																									
                                                            <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="patient/deleteCaseHistory?id=<?php echo $medical_history->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
															<?php }?>
                                                        </td>
                                                    <?php //} ?>
                                                </tr>  						
											<?php } ?>
											<tr>
											<td colspan='7'>
										<!--	<table id="hidden_rem_doc" width="100%"> 
											<caption><b style="color:red;"><u>REMOTE SYSTEM INFORMATION</u></b></caption>
											     <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo 'Location'; ?></th>
                                                <th><?php echo "Doctor"; ?></th>
                                                <th><?php echo lang('title'); ?></th>
                                                <th><?php echo lang('description'); ?></th>
                                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php } ?>
                                            </tr>
										<!-- insert for remote system information -->
											<?php //include('./db/remote_docnotes.php'); ?>
										<!-- end remote system information -- >		

 
											</table> -->
											</td>
											</tr>
											
                                        </tbody>
                                    </table>
<!-- 
<script>
function myRemdoc() {
  var x = document.getElementById("hidden_rem_doc");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
-->

                                </div> 
                            </div>
                        </div>
                        <div id="about" class="tab-pane"> <div class="">
						
                              <?php //if ($this->ion_auth->in_group(array('admin','Doctor')) { ?>
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" href="prescription/addPrescriptionView">
                                            <i class="fa fa-plus-circle"> </i> Add Prescription</a>
                                   
                                        <a class="btn btn-info btn_width btn-xs" href="prescription/addGlassPrescriptionView">
                                            <i class="fa fa-plus-circle"> </i>Add Glasses Prescription </a>
                                    </div>
                                <?php // } ?>
                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>

                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th><?php echo lang('medicine'); ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($prescriptions as $prescription) { ?>
                                                <tr class="">
                                                    <td><?php echo date('m/d/Y', $prescription->date); ?></td>
                                                    <td>
                                                        <?php
                                                        $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
                                                        if (!empty($doctor_details)) {
                                                            $prescription_doctor = $doctor_details->name;
                                                        } else {
                                                            $prescription_doctor = '';
                                                        }
                                                        echo $prescription_doctor;
                                                        ?>

                                                    </td>
                                                    <td>

                                                        <?php
                                                        if (!empty($prescription->medicine)) {
                                                            $medicine = explode('###', $prescription->medicine);

                                                            foreach ($medicine as $key => $value) {
                                                                $medicine_id = explode('***', $value);
                                                                $medicine_details = $this->medicine_model->getMedicineById($medicine_id[0]);
                                                                if (!empty($medicine_details)) {
                                                                    $medicine_name_with_dosage = $medicine_details->name . ' -' . $medicine_id[1];
                                                                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                                                                    rtrim($medicine_name_with_dosage, ',');
                                                                    echo '<p>' . $medicine_name_with_dosage . '</p>';
                                                                }
                                                            }
                                                        }
                                                        ?>


                                                    </td>
                                                    <td class="no-print">
                                                        <a class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=<?php echo $prescription->id; ?>"><i class="fa fa-eye"> <?php echo lang('view'); ?> </i></a> 
                                                       
													   <?php if ($this->ion_auth->in_group('admin','Doctor')) { ?>
                                                            <a type="button" class="btn btn-info btn-xs btn_width" data-toggle="modal" href="prescription/editPrescription?id=<?php echo $prescription->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></a>   
															<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                            <a class="btn btn-info btn-xs btn_width delete_button" href="prescription/delete?id=<?php echo $prescription->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></a>
															<?php } ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="lab" class="tab-pane"> <div class="">
                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('id'); ?></th>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($labs as $lab) { ?>
                                                <tr class="">
                                                    <td><?php echo $lab->id; ?></td>
                                                    <td><?php echo date('m/d/Y', $lab->date); ?></td>
                                                    <td>
                                                        <?php
                                                        $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
                                                        if (!empty($doctor_details)) {
                                                            $lab_doctor = $doctor_details->name;
                                                        } else {
                                                            $lab_doctor = '';
                                                        }
                                                        echo $lab_doctor;
                                                        ?>
                                                    </td>
                                                    <td class="no-print">
                                                        <a class="btn btn-info btn-xs btn_width" href="lab/invoice?id=<?php echo $lab->id; ?>"><i class="fa fa-eye"> <?php echo lang('report'); ?> </i></a>   
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div id="documents" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal1">
                                        <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                                    </a>
                                    <a class="btn btn-info btn_width btn-xs" id="viewalldocs" target="_blank" href="./db/viewdocs.php?id=<?php echo $patient->id;?>">
                                        <i class="fa fa-plus-circle"> </i> View All Documents
                                    </a>                                    
									
					<!--				<button class="btn btn-info btn_width btn-xs" id="button_rem_document" class="button_rem_document" onclick="myRemdocument()">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "Other Location Notes";//lang('add_new'); ?> 
                                        </button> 
									
					<a  href="javascript:void(0);" name="download_document" onClick="new_popup3();">
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs"  style="background-color:orange;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Download From Server";//lang('add_new'); ?>
                            </button>
						<script type="text/javascript">
							function new_popup3(){
							var popupwin3 = window.open('./db/dbup/remote_document_download.php','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin3.close();}, 15000);
							}
						</script>	
                        </div>
                    </a>						
					<a  href="javascript:void(0);" name="upload_document" onClick="new_popup4();">
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs"  style="background-color:skyblue;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Upload to Server";//lang('add_new'); ?>
                            </button>
						<script type="text/javascript">
							function new_popup4(){
							var popupwin4 = window.open('http://ispecs.familyds.com/db/dbup/remote_document_upload_fal.php?id=<?php echo $patient->id;?>','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin4.close();}, 15000);
							}
						</script>	
                        </div>
                    </a>	-->
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($patient_materials as $patient_material) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_material->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_material->title)) {
                                                        echo $patient_material->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_material->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_material->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_material->title)) {
                                                        echo $patient_material->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_material->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_material->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_material->url)) {
														echo basename($patient_material->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_material->multi_image == 'yes'){?>
													<a id="getAdditionalImages" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalImages_modal" 
															 data-id="<?php echo $patient_material->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
													<a id="getDataReport" class="btn btn-xs" data-toggle="modal" href="#getDataReport_modal"
															 data-id="<?php echo $patient_material->image_id; ?>">
															View Report </a>
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_material->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientMaterial?id=<?php echo $patient_material->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>									
                                </div>
                            </div>
                        </div>
                                
	<!--					<div id="sick_leave" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_sickleave">
                                        <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?> 
                                    </a>
                                    <a class="btn btn-info btn_width btn-xs" id="viewalldocs" target="_blank" href="./db/viewsickleaves.php?id=<?php echo $patient->id;?>">
                                        <i class="fa fa-plus-circle"> </i> View All Sick Leaves
                                    </a>                                    														
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($sick_leaves as $sick_leave) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $sick_leave->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($sick_leave->title)) {
                                                        echo $sick_leave->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $sick_leave->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $sick_leave->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($sick_leave->title)) {
                                                        echo $sick_leave->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $sick_leave->url; ?>" height="100" width="100">
													<br><a href="<?php echo $sick_leave->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($sick_leave->url)) {
														echo basename($sick_leave->url);
                                                    }
                                                    ?>
													
								<br>
													<?php if($sick_leave->multi_image == 'yes'){?>
													<a id="getAdditionalImages" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalImages_modal" 
															 data-id="<?php echo $sick_leave->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
													
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $sick_leave->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deleteSickLeave?id=<?php echo $sick_leave->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -- >
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -- >		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>									
                                </div>
                            </div>
                        </div>
                                     
    -->                                

	<div id="oct" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalOct">
                                        <i class="fa fa-plus-circle"> </i> Add New OCT 
                                    </a>  
									
								<!--	<a class="btn btn-info btn_width btn-xs" id="viewalldocs" target="_blank" href="./db/viewocts.php?id=<?php echo $patient->id;?>">
                                        <i class="fa fa-plus-circle"> </i> View All Documents
                                    </a>   -->									
									
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($patient_octs as $patient_oct) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_oct->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_oct->title)) {
                                                        echo $patient_oct->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_oct->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_oct->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_oct->title)) {
                                                        echo $patient_oct->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_oct->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_oct->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_oct->url)) {
														echo basename($patient_oct->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_oct->multi_image == 'yes'){?>
													<a id="getAdditionalOct" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalOct_modal" 
															 data-id="<?php echo $patient_oct->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_oct->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientOct?id=<?php echo $patient_oct->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
<!--											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
-->									
                                </div>
                            </div>
                        </div>
                                                        
									                                     
																		 
									<div id="results" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalResults">
                                        <i class="fa fa-plus-circle"> </i> Uploaded Results 
                                    </a>  
								 								
									
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($patient_results as $patient_result) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_result->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_result->title)) {
                                                        echo $patient_result->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_result->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_result->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_result->title)) {
                                                        echo $patient_result->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_result->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_result->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_result->url)) {
														echo basename($patient_result->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_result->multi_image == 'yes'){?>
													<a id="getAdditionalResult" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalResult_modal" 
															 data-id="<?php echo $patient_result->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Reports </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_result->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientResult?id=<?php echo $patient_result->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
<!--											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
-->									
                                </div>
                            </div>
                        </div>
                                                        
																		
							<div id="referal" class="tab-pane"> 
							<div class="">
                                <div class=" no-print">
								<ul class="nav nav-tabs">
									<li class="active">
									 <a data-toggle="tab" href="#ref_upload">Upload Referals</a>
									</li>
									<li>
									 <a data-toggle="tab" href="#ref_new">Add New Referal </a>								
									</li>
								</ul>
                                </div>
                             </div>
                        </div>
                                                        
							

<div id="ref_upload" class="tab-pane"> 
	<div class="">
               <div class=" no-print">
								<ul class="nav nav-tabs">
									<li>
									 <a data-toggle="tab" href="#ref_upload">Upload Referals</a>
									</li>
									<li>
									 <a data-toggle="tab" href="#ref_new">Add New Referal </a> 								
									</li>
								</ul>
                                </div>                   
		    <div class="adv-table editable-table ">

									<div class=" no-print">
            <header class="panel-heading clearfix">
                <div class="col-md-9">
					<a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalReferals">
                                        <i class="fa fa-plus-circle"> </i> Upload Referals 
                                    </a>                 </div>           
                <div class="col-md-3 pull-right">
                </div>
            </header>
                     </div>               
					 <div class="col-md-12">
                                        <?php foreach ($patient_referals as $patient_referal) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_referal->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_referal->title)) {
                                                        echo $patient_referal->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_referal->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_referal->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_referal->title)) {
                                                        echo $patient_referal->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_referal->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_referal->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_referal->url)) {
														echo basename($patient_referal->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_referal->multi_image == 'yes'){?>
													<a id="getAdditionalReferal" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalReferal_modal" 
															 data-id="<?php echo $patient_referal->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Reports </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_referal->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientReferal?id=<?php echo $patient_referal->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
<!--											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
-->									
                                </div>
                           				
						
						
	</div>
</div>	
<div id="ref_new" class="tab-pane"> 
	<div class="">
                    <div class=" no-print">
								<ul class="nav nav-tabs">
									<li>
									 <a data-toggle="tab" href="#ref_upload">Upload Referals</a>
									</li>
									<li>
									 <a data-toggle="tab" href="#ref_new">Add New Referal </a>								
									</li>
								</ul>
                                </div>             				
		    <div class="adv-table editable-table ">
			 <div class=" no-print">
            <header class="panel-heading clearfix">
                <div class="col-md-9">
				<a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalNewResults">
                 <i class="fa fa-plus-circle"> </i> Add New Referal 
                </a>
                </div>           
                <div class="col-md-3 pull-right">
                </div>
            </header>
				</div>							
                                    <div class="">
     <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('id'); ?></th>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo 'Refer Doctor'; ?></th>
                                                <th><?php echo 'Doctor'; ?></th>
                                                <th><?php echo 'Age'; ?></th>
                                                <th><?php echo 'Comments'; ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($patient_referrals_new as $patient_referral_new) { ?>
                                                <tr class="">
                                                    <td><?php echo $patient_referral_new->id; ?></td>
                                                    <td><?php echo date('m/d/Y', $patient_referral_new->date); ?></td>
													<td><?php echo $patient_referral_new->ref_doctor; ?></td>
													<td><?php echo $patient_referral_new->doctor; ?></td>
													<td><?php echo $patient_referral_new->age; ?></td>
													<td><?php echo $patient_referral_new->general_comment; ?></td>
                                                    <td class="no-print">
   <a class="btn btn-info btn-xs btn_width" href="patient/medicalHistory?id=<?php echo $patient_referral_new->id; ?>"><i class="fa fa-eye"> <?php echo lang('report'); ?> </i></a> <a id="getDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor2"  data-id="<?php echo $medical_history->id; ?>">
															<i class="fa fa-plus-circle"> </i> View </a>
															
															<?php if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?>
                                                            <a id="editDoctorNotes" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_doctor_edit" 
															 data-id="<?php echo $patient_referral_new->id; ?>">
															<i class="fa fa-plus-circle"> </i> Edit </a>
																									
                                                            <a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="patient/deleteCaseHistory?id=<?php echo $medical_history->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
															<?php }?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    </div>	
										
										
<!--											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
-->									
                                </div>
                           				
						
						
	</div>
</div>	

							
								<div id="photograph" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalPhotograph">
                                        <i class="fa fa-plus-circle"> </i> Add New Photographs 
                                    </a>  
<a class="btn btn-info btn_width btn-xs" id="viewallphotograph" target="_blank" href="./db/viewphotograph.php?id=<?php echo $patient->id;?>">
                                        <i class="fa fa-plus-circle"> </i> View All Photographs
                                    </a>   									
									
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($patient_photographs as $patient_photograph) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_photograph->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_photograph->title)) {
                                                        echo $patient_photograph->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_photograph->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_photograph->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_photograph->title)) {
                                                        echo $patient_photograph->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_photograph->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_photograph->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_photograph->url)) {
														echo basename($patient_photograph->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_photograph->multi_image == 'yes'){?>
													<a id="getAdditionalPhotograph" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalPhotograph_modal" 
															 data-id="<?php echo $patient_photograph->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_photograph->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientPhotograph?id=<?php echo $patient_photograph->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>									
                                </div>
                            </div>
                        </div>
                                                
				<div id="refraction" class="tab-pane"> <div class="">
                                <div class=" no-print">
                                    <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModalRefraction">
                                        <i class="fa fa-plus-circle"> </i> <?php echo 'Add New Refraction'; ?> 
                                    </a>                                    
									
					<!--				<button class="btn btn-info btn_width btn-xs" id="button_rem_document" class="button_rem_document" onclick="myRemdocument()">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "Other Location Notes";//lang('add_new'); ?> 
                                        </button> 
									
					<a  href="javascript:void(0);" name="download_document" onClick="new_popup3();">
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs"  style="background-color:orange;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Download From Server";//lang('add_new'); ?>
                            </button>
						<script type="text/javascript">
							function new_popup3(){
							var popupwin3 = window.open('./db/dbup/remote_document_download.php','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin3.close();}, 15000);
							}
						</script>	
                        </div>
                    </a>						
					<a  href="javascript:void(0);" name="upload_document" onClick="new_popup4();">
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs"  style="background-color:skyblue;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Upload to Server";//lang('add_new'); ?>
                            </button>
						<script type="text/javascript">
							function new_popup4(){
							var popupwin4 = window.open('http://ispecs.familyds.com/db/dbup/remote_document_upload_fal.php?id=<?php echo $patient->id;?>','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin4.close();}, 15000);
							}
						</script>	
                        </div>
                    </a>	-->
                                </div>
                                <div class="adv-table editable-table ">
                                    <div class="">
                                        <?php foreach ($patient_refractions as $patient_refraction) { ?>
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="">
												<?php 
												$path_parts = $patient_refraction->url;
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($patient_refraction->title)) {
                                                        echo $patient_refraction->title;
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $patient_refraction->url; ?>" width="100" height="100" />
												<br><a href="<?php echo $patient_refraction->url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($patient_refraction->title)) {
                                                        echo $patient_refraction->title;
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $patient_refraction->url; ?>" height="100" width="100">
													<br><a href="<?php echo $patient_refraction->url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($patient_refraction->url)) {
														echo basename($patient_refraction->url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($patient_refraction->multi_image == 'yes'){?>
													<a id="getAdditionalImages" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalImages_modal" 
															 data-id="<?php echo $patient_refraction->image_id; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $patient_refraction->url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <a class="btn btn-info btn-xs btn_width" title="<?php echo lang('delete'); ?>" href="patient/deletePatientRefraction?id=<?php echo $patient_refraction->id; ?>"onclick="return confirm('Are you sure you want to delete this item?');"> X </a>
                                                    <?php } ?>	
													</div>


                                                <hr>

                                            </div>
											
											<div class="" id="hidden_rem_document">
										<!-- insert for remote system information -->
											<?php //include('./db/remote_document.php'); ?>
										<!-- end remote system information -->		
											</div>
										
                                        <?php } ?>
                                    </div>	
										
										
											
<script>
function myRemdocument() {
  var x = document.getElementById("hidden_rem_document");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>									
                                </div>
                            </div>
                        </div>

					<div id="consent" class="tab-pane"> 
                            <div class="">

                                <?php // if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_ownframeconsent">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New OwnFrame Consent Form";//lang('add_new'); ?> 
                                        </a>  
										<a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_consent">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New Glass Prescription Consent Form";//lang('add_new'); ?> 
                                        </a>
										<a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_octemailconsent">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New OCT Email Consent Form";//lang('add_new'); ?> 
                                        </a>
                                    </div>
                                <?php// } ?>

                                <div class="adv-table editable-table ">


                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo "Location";//lang('date'); ?></th>
                                                <th><?php echo "Quick View"; ?></th>
                                                <th><?php echo "Form Type"; ?></th>
                                                <?php if ($this->ion_auth->in_group(array('admin','Doctor','Receptionist','Nurse','Supervisor'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											/*		$get_id = $_GET['id'];
													$this->db->select('*');
													$this->db->where('patient_id', $get_id);								
													$query4 = $this->db->get('consent_form');
													print_r($query4->row());
											*/
											
											foreach ($consent_forms as $consent_form) { ?>
                                                <tr class="">

                                                    <td><?php echo $consent_form->date; ?></td>
                                                    <td><?php echo $consent_form->location; ?></td>
													
                                                    <td>
													
													<?php 
																							
													  echo 	"DATE OF CONSENT -(<font color='red'>".$consent_form->date
															."</font>),<br> CONSENT NAME -(<font color='red'>".$consent_form->consent_name
															."</font>),<br> CONSENT SIGNATURE -(<font color='red'>".$consent_form->c_sign
															."</font>),<br> DATE OF DISCLAIMER -(<font color='red'>".$consent_form->disclaim_date
															."</font>),<br> DISCLAIMER NAME-(<font color='red'>".$consent_form->disclaim_name
															."</font>),<br> DISCLAIMER SIGNATURE-(<font color='red'>".$consent_form->d_sign
															."</font>)";



													?></td>
													 <td><?php echo $consent_form->form_type; ?></td>
                                                        <td class="no-print">
											                
															 <a id="getConsentForm" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_consent_view" data-id="<?php echo $consent_form->id; ?>">
															<i class="fa fa-plus-circle"> </i> View </a>
															
															<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                          <a class="btn btn-info btn-xs btn_width delete_button" title="Delete" href="patient/deleteConsentForms?id=<?php echo $consent_form->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Delete</a> <?php } ?>
                                                        </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>					
						
						
						<div id="sick_leave" class="tab-pane"> 
                            <div class="">

                                <?php // if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                    <div class=" no-print">
                                        <a class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_sickleave">
                                            <i class="fa fa-plus-circle"> </i> <?php echo "New Sick Leave";//lang('add_new'); ?> 
                                        </a>  
										
                                    </div>
                                <?php// } ?>

                                <div class="adv-table editable-table ">


                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo "Location";//lang('date'); ?></th>
                                                <th><?php echo "Days";//lang('date'); ?></th>
                                                <th><?php echo "Starting Date";//lang('date'); ?></th>
                                                <th><?php echo "Doctor";//lang('date'); ?></th>
                                                <th><?php echo "Quick View"; ?></th>
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($sick_leave as $sickleave) { ?>
                                                <tr class="">

                                                    <td><?php echo $sickleave->date; ?></td>
                                                    <td><?php echo $sickleave->location; ?></td>													
                                                    <td><?php echo $sickleave->days; ?></td>													
                                                    <td><?php echo $sickleave->start_date; ?></td>													
                                                    <td><?php echo $sickleave->doctor_name; ?></td>													
                                                    <td>
													Date: <?php echo $sickleave->date; ?><br>
													Patient Name: <?php echo $sickleave->patient_first_name . ' '.$sickleave->patient_middle_name.' '.$sickleave->patient_last_name; ?><br>
													No. of Days: <?php echo $sickleave->days; ?><br>
													Start Date : <?php echo $sickleave->start_date; ?><br>
													End Date : 
													<?php   
														$newDate = date('Y-m-d', strtotime($sickleave->start_date + $sickleave->days));
														echo $newDate;
													 ?>	<br>
													
													</td>
                                                        <td class="no-print">
											                
															 <a id="getSickForm" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_sickleave_view" data-id="<?php echo $sickleave->id; ?>">
															<i class="fa fa-plus-circle"> </i> View </a>
															
															<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                          <a class="btn btn-info btn-xs btn_width delete_button" title="Delete" href="patient/deleteSickLeave?id=<?php echo $sickleave->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Delete</a> <?php } ?>
                                                        </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
						
                        <div id="timeline" class="tab-pane"> 
                            <div class="">
                                <div class="">
                                    <section class="panel ">
                                        <header class="panel-heading">
                                            Timeline
                                        </header>

                                        <?php
                                        if (!empty($timeline)) {
                                            krsort($timeline);
                                            foreach ($timeline as $key => $value) {
                                                echo $value;
                                            }
                                        }
                                        ?>

                                    </section>
                                </div>
                            </div>
                        </div>
						     
                        
                    </div>
                </div>
				
            </section>

        </section>



    </section>
    <!-- page end-->
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<!-- Add OCT  Modal-->
<div class="modal fade" id="myModalOct" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientOct" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Uploaded RESULTS  Modal-->
<div class="modal fade" id="myModalResults" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> Result <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientResult" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add New RESULTS  Modal-->
<div class="modal fade" id="myModalNewResults" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> Referal</h4>
            </div>
			
					<?php
						$doc_id2 = '';
						$current_doc2 = $this->ion_auth->get_user_id();
						if ($this->ion_auth->in_group(array('Doctor','admin'))) {
						$doc_id2 = $this->db->get_where('doctor', array('ion_user_id' => $current_doc2))->row()->id;
						$doc_name2 = $this->db->get_where('doctor', array('ion_user_id' => $current_doc2))->row()->name;
						$doc_nom = $this->db->get_where('doctor', array('ion_user_id' => $current_doc2))->row()->postnomials;
						$doc_profile = $this->db->get_where('doctor', array('ion_user_id' => $current_doc2))->row()->profile;
						$user_name2 = $this->db->get_where('users', array('id' => $current_doc2))->row()->username;								
						}
					?>			
			
            <div class="modal-body">
                <form role="form" action="patient/addReferralNew" class="clearfix row"  method="post" enctype="multipart/form-data">
					<table border='0' cellpadding='10' cellspacing='0' width='100%' >
						<tr>
							<td colspan='2'>Date: &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text"  class="form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="" required="">
							</td>	
						</tr>
						<tr>
							<td colspan='2'>&nbsp;</td>
						</tr>
						<tr>
							<td colspan='2'>Dear Dr. <input type="text"  size="100" name="ref_doctor" required="" ></td>
						</tr>
						<tr>
							<td colspan='2'>&nbsp;</td>
						</tr>						
						<tr>
							<td width='50%'>
								I reviewed <input type="text" class="input20"  name="full_name" value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name; ?>" >and found the following.  
							</td>
							<td width='50%'>
								Age: <input type='hidden' name="age" value="<?php echo date_diff(date_create($patient->birthdate), date_create('today'))->y; ?>" ><u><?php echo date_diff(date_create($patient->birthdate), date_create('today'))->y; ?></u> 
							</td>
						</tr>
						<tr>
							<td colspan='2'>&nbsp;</td>
						</tr>						
						<tr>
							<td width="50%">
							<h4> <b>Past Ocular History: </b></h4> <p>
							<textarea cols="65" rows="5" name="past_ocular_history" > </textarea>
							</td>
							<td width="50%">
							<h4> <b>Rx: </b></h4>
							R:<input type="text" name="r_rx" size='30' ><br>
							L:&nbsp;<input type="text" name="l_rx" size='30' ><br>
							</td>
						</tr>						
						<tr>
							<td width="50%">
							<h4> <b>Visual Acuity: </b></h4> <p>
							R:<input type="text" name="r_visual_acuity" size='50' ><br>
							L:&nbsp;<input type="text" name="l_visual_acuity" size='50' ></td>
							<td width="50%">
							<h4> <b>Intraocular Pressure: </b></h4> <p>
							R:<input type="text" name="r_intra_pressure" size='50' ><br>
							L:&nbsp;<input type="text" name="l_intra_pressure" size='50' ></td>
						</tr>													
						<tr>
							<td width="50%">
							<h4> <b>Anterior Segment: </b></h4> <p>
							<input type="text" name="r_ant_segment" size='50' ><br>
							<input type="text" name="l_ant_segment" size='50' ></td>
							<td width="50%">
							<h4> <b>Lens: </b></h4> <p>
							R:<input type="text" name="r_lens" size='50' ><br>
							L:&nbsp;<input type="text" name="l_lens" size='50' ></td>
						</tr>							
						<tr>
							<td width="50%">
							<h4> <b>Fundoscopy: </b></h4> <p>
							R:<input type="text" name="r_fundoscopy" size='50' ><br>
							L:&nbsp;<input type="text" name="l_fundoscopy" size='50' ></td>
							<td width="50%">
							</td>
						</tr>						
						<tr>
							<td colspan="2">
							<h4> <b>General Comments: </b></h4> <p>
							<textarea cols="100" rows="10" name='general_comment'> </textarea>
							</td>
						</tr>						
						<tr>
							<td colspan="2">
							Your continued support is greatly appreciated. <p><br>
							Yours Sincerely,
							<p>
							__________________________________________________ <p>
							Dr. <?php echo $doc_name2 . '('.$doc_nom.')'; ?> <br>
							<?php echo $doc_profile; ?>
							<input type="hidden" value ="<?php echo $doc_name2; ?>" name="doctor" >
							<input type="hidden" value ="<?php echo $doc_nom; ?>" name="doctor_nominals" >
							<input type="hidden" value ="<?php echo $user_name2; ?>" name="user_name" >
							</td>
						</tr>						


						<tr>
							<td colspan='2'> 
								<input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>
								<input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
								<button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
							</td>
						</tr>
					</table>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add REFERALS  Modal-->
<div class="modal fade" id="myModalReferals" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> Referal <?php echo lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientReferal" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Add Photograph  Modal  -->
<div class="modal fade" id="myModalPhotograph" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo 'photographs';//lang('files'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientPhotograph" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Refraction Modal-->
<div class="modal fade" id="myModalRefraction" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add'); ?> <?php echo lang('refractions'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientRefraction" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>ONE</u> File';//lang('file'); ?></label>
                        <input type="file" name="img_url" accept="image/*;capture=camera" >
                        
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="file"> <?php echo 'Add <u>Multiple</u> Files';//lang('file'); ?></label>
                        <input type="file" name="img_2_url[]"  multiple="" accept="image/*;capture=camera">
                        <input type="hidden" name="image_id" value="<?php echo(rand(100,10000000000000000)); ?>" >
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->


<!-- Add Medical History Modal-->
<div class="modal fade" id="myModal" tabindex="-1" data-keyboard="true" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="age"><?php echo 'Age'; ?></label>
                        <input type="number" class="form-control" name="age" id="age" value='' placeholder="Age" required="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo "Presenting Complaint";//lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div> 
                    <div class="form-group col-md-12">
                        <label for="medicaHistory"><?php echo "Medical History";//lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="med_history" id="exampleInputEmail1" value='' placeholder="">
                    </div> 
                    <div class="form-group col-md-12">
                        <label for="Medication"><?php echo "Medications";//lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="medications" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class=""><?php echo "Notes";//lang('description'); ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>                    
<style>
#hidden_div30 {
    display: none;
}
</style>
					 <div class="form-group col-md-12">
					<label for="authorization"> Write Handwritten Notes?  </label>
					<select name="hand_notes" class="form-control form-control-inline input-medium" onchange="showDiv30('hidden_div30', this)">
						<option value="NO">NO</option>
						<option value="YES">YES</option>
						</select>
					</div>						

                    <div class="form-group col-md-12">
						<script type="text/javascript">
						function showDiv30(divId, element)
							{
								document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
							//	document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
							}					
						</script>

						<div id="hidden_div30">

<?php 

//include("db/canvas/index.html"); 
?>
  <!--  <link rel="stylesheet" type="text/css" href="http://ispecs-server/doc_sig/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/doc_sig/jquery.signature.css">
  
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery.min.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery.signature.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/flashcanvas.js"></script>
	
    <script type="text/javascript" src="http://ispecs-server/doc_sig/js/jquery.signature.min.js"></script>

		<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
	-->
	
	<script type="text/javascript" src="http://ispecs-server/doc_sig/jquery.signature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"> </script>
	
<style>
    .doc {
        width: 604px;
        margin: 0 auto;
    }
    canvas {
        display: block;
        border: 2px solid #888;
    }
</style>


<a id="undo" class="btn btn-info">undo</a><br>
<canvas id="paint"></canvas>
<textarea id="doc_sig64" class="form-control bgq" name="doc_signed" style="display: none;"></textarea>

<script>
const canvas = document.getElementById('paint');
const ctx = canvas.getContext('2d');
canvas.style.background = 'url(https://visioneyeinstitute.com.au/wp-content/uploads/healthy-eyes-2.jpg)';
canvas.width = 800;
canvas.height=400;
ctx.lineJoin = 'round';
ctx.lineCap = 'round';
ctx.strokeStyle = "red";
let drawing = false;
let pathsry = [];
let points = [];

var mouse = {x: 0, y: 0};
var previous = {x: 0, y: 0};

canvas.addEventListener('mousedown', function(e) {
drawing = true; 
previous = {x:mouse.x,y:mouse.y};
mouse = oMousePos(canvas, e);
points = [];
points.push({x:mouse.x,y:mouse.y})
});

canvas.addEventListener('mousemove', function(e) {
if(drawing){
previous = {x:mouse.x,y:mouse.y};
mouse = oMousePos(canvas, e);
// saving the points in the points array
points.push({x:mouse.x,y:mouse.y})
// drawing a line from the previous point to the current point
ctx.beginPath();
ctx.moveTo(previous.x,previous.y);
ctx.lineTo(mouse.x,mouse.y);
ctx.stroke();
}
}, false);


canvas.addEventListener('mouseup', function() {
drawing=false;
// Adding the path to the array or the paths
pathsry.push(points);
}, false);


undo.addEventListener("click",Undo);

function drawPaths(){
  // delete everything
  ctx.clearRect(0,0,canvas.width,canvas.height);
  // draw all the paths in the paths array
  pathsry.forEach(path=>{
  ctx.beginPath();
  ctx.moveTo(path[0].x,path[0].y);  
  for(let i = 1; i < path.length; i++){
    ctx.lineTo(path[i].x,path[i].y); 
  }
    ctx.stroke();
  })
}  

function Undo(){
  // remove the last path from the paths array
  pathsry.splice(-1,1);
  // draw all the paths in the paths array
  drawPaths();
}


// a function to detect the mouse position
function oMousePos(canvas, evt) {
  var ClientRect = canvas.getBoundingClientRect();
	return { //objeto
	x: Math.round(evt.clientX - ClientRect.left),
	y: Math.round(evt.clientY - ClientRect.top)
}
}
</script>

<script type="text/javascript">
    var paint = $('#paint').signature({syncField: '#doc_sig64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        paint.signature('clear');
        $("#doc_sig64").val('');
    });
	
</script>
	
 <!--
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	
-- >

    <link rel="stylesheet" type="text/css" href="http://ispecs-server/doc_sig/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/doc_sig/jquery.signature.css">
  
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery.min.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/jquery.signature.js"></script>
    <script type="text/javascript" src="http://ispecs-server/doc_sig/flashcanvas.js"></script>
	
    <script type="text/javascript" src="http://ispecs-server/doc_sig/js/jquery.signature.min.js"></script>

		<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 500px; height: 600px;}
        #doc_sig canvas{
            width: 500 !important;
            height: auto;
        }
        .bgq {
			background-image: url('./common/img/eyes.jpg');
		}
    </style>

  
<div class="form-group col-md-12">
            <div id="doc_sig" class="bgq" ></div>
            <br/>
            <button id="clear">Clear Notepad</button>
            <textarea id="doc_sig64" class="form-control bgq" name="doc_signed" style="display: none;"></textarea>

  
        <br/>
     <!--   <button class="btn btn-success">Submit</button> -- >
    </div>
  
  
<script type="text/javascript">
    var doc_sig = $('#doc_sig').signature({syncField: '#doc_sig64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        doc_sig.signature('clear');
        $("#doc_sig64").val('');
    });
	
	
</script>

-->						
						</div>	                    
					</div>					
					
					
                    
					
					<?php
						$doc_id = '';
						$current_doc = $this->ion_auth->get_user_id();
						if ($this->ion_auth->in_group('Doctor')) {
						$doc_id = $this->db->get_where('doctor', array('ion_user_id' => $current_doc))->row()->id;
						}
					?>
					
					
					<input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="doctors_id" value="<?php echo $doc_id; ?>">
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Doctor Notes Modal-->
<div class="modal fade" id="myModal_doc" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Add Notes"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addDoctorNotes" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo "Caption";//lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class=""><?php echo "Notes";//lang('description'); ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
<div class="modal fade" id="mydoc_csv" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Import CSV";//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">

		<form method="post" id="import_csv" enctype="multipart/form-data">
			<div class="form-group">
				<label>Select CSV File</label>
				<input type="file" name="csv_file" id="csv_file" required accept=".csv" />
			</div>
			<br />
			<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
		</form> 
		<br />
		<div id="imported_csv_data"></div>    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> <?php } ?>

<!-- Add Nurse Notes Modal-->
<div class="modal fade" id="myModal_nurse" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Add Nurses Notes"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addNurseNotes" class="clearfix row" method="post" enctype="multipart/form-data">
                   
					
					<!-- <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label> -->
                        <input type="hidden" class="form-control form-control-inline input-medium" placeholder ="fff" value="<?php echo date('d-m-Y');?>" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    <!-- </div> -->
					
					<table width="100%" cellspacing="10" cellpadding="10" >
					<tr><td align="center">Head Circle: </td><td><input type="text" name="head_circle" id="head_circle" placeholder="0.00"></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">BMI: </td><td><input type="text" name="bmi" id="bmi"  placeholder="0.00"></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Length: </td><td><input type="text"  name="length" id="length"  placeholder="0.00"></td><td colspan="6">&nbsp;</td></tr>				
					<tr><td align="center">Pulse: </td><td><input type="text"  name="pulse" id="length"  placeholder="0.00"></td><td colspan="6">&nbsp;</td></tr>				
					<tr><td align="center">Blood Pressure: </td><td><input type="text" name="blood_pressure" id="blood_pressure" ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Temperature: </td><td><input type="text" name="temperature" id="bmi"  ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Weight: </td><td><input type="text"  name="weight" id="length"  ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Oxygen: </td><td><input type="text"  name="oxygen" id="oxygen"  ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">RGB: </td><td><input type="text"  name="rgb" id="rgb"  ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Height: </td><td><input type="text"  name="height" id="height"  ></td><td colspan="6">&nbsp;</td></tr>
					<tr><td align="center">Glasses: </td><td><select name="glasses">
						<option value="NO">NO</option>
						<option value="YES">YES</option>
						</select>
						</td><td colspan="6">&nbsp;</td></tr>
					</table>
					<table width="100%" cellspacing="10" cellpadding="10">
					<tr><td align="center" colspan=8><b><u>URINE TEST</u></b></td></tr>
					<tr><td align="center" colspan=2>&nbsp;</td></tr>
					<tr><td >&nbsp;</td><td >Neg</td><td >+-</td><td >+</td><td >++</td><td >+++</td><td >++++</td><td >&nbsp;</td></tr>
					<tr><td>&nbsp;</td><td>&nbsp;</td><td>Non Haem</td><td>&nbsp;</td><td><input type="radio" name="nonhaem" value="++" /> </td><td><input type="radio" name="nonhaem" value="+++" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">BLOOD</td><td><input type="radio" name="blood" value="Neg" /></td><td>Haem</td><td><input type="radio" name="blood" value="+" /></td><td><input type="radio" name="blood" value="++" /> </td><td><input type="radio" name="blood" value="+++" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">BILLIRUBIN</td><td><input type="radio" name="billirubin" value="Neg" /></td><td>&nbsp;</td><td><input type="radio" name="billirubin" value="+" /></td><td><input type="radio" name="billirubin" value="++" /></td><td><input type="radio" name="billirubin" value="+++" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">UROBILINOGEN</td><td><input type="radio" name="urobilinogen" value="Neg" /></td><td>&nbsp;</td><td><input type="radio" name="urobilinogen" value="+" /></td><td><input type="radio" name="urobilinogen" value="++" /></td><td><input type="radio" name="urobilinogen" value="+++" /></td><td><input type="radio" name="urobilinogen" value="++++" /></td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">KETONE</td><td><input type="radio" name="ketone" value="Neg" /></td><td><input type="radio" name="ketone" value="+/-" /></td><td><input type="radio" name="ketone" value="+" /></td><td><input type="radio" name="ketone" value="++" /></td><td><input type="radio" name="ketone" value="+++" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">PROTEIN</td><td><input type="radio" name="protein" value="Neg" /></td><td><input type="radio" name="protein" value="+/-" /></td><td><input type="radio" name="protein" value="+" /></td><td><input type="radio" name="protein" value="++" /></td><td><input type="radio" name="protein" value="+++" /></td><td><input type="radio" name="protein" value="++++" /></td><td>&nbsp;</td><td>&nbsp;</td></tr>
					<tr><td  align="center">NITRATE</td><td><input type="radio" name="nitrate" value="Neg" /></td><td><input type="radio" name="nitrate" value="+/-" /></td><td><input type="radio" name="nitrate" value="+" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					
					<tr><td></td><td></td><td></td><td colspan=5>&nbsp;</td></tr>
					<tr><td >&nbsp;</td><td >-</td><td >+</td><td >++</td><td >&nbsp;</td><td >&nbsp;</td><td>&nbsp;</td><td >&nbsp;</td></tr>
					<tr><td  align="center">GLUCOSE</td><td><input type="radio" name="glucose" value="-" /></td><td><input type="radio" name="glucose" value="+" /></td><td><input type="radio" name="glucose" value="++" /></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
					
					<tr><td >&nbsp;</td>
					<td >5.0</td>
					<td >6.0</td>
					<td >6.5</td>
					<td >7.0</td>
					<td >7.5</td>
					<td >8.0</td>
					<td >9.0</td></tr>
					<tr>
					<td  align="center">PH</td>
					<td><input type="radio" name="ph" value="5.0" /></td>
					<td><input type="radio" name="ph" value="6.0" /></td>
					<td><input type="radio" name="ph" value="6.5" /></td>
					<td><input type="radio" name="ph" value="7.0" /></td>
					<td><input type="radio" name="ph" value="7.5" /></td>
					<td><input type="radio" name="ph" value="8.0" /></td>
					<td><input type="radio" name="ph" value="9.0" /></td>
										
					
					<tr><td >&nbsp;</td>
					<td >1.000</td>					
					<td >1.005</td>
					<td >1.010</td>
					<td >1.015</td>
					<td >1.020</td>
					<td >1.025</td>
					<td >1.030</td>
					</tr>
					<tr>
					<td  align="center">Specific Gravity</td>
					<td><input type="radio" name="gravity" value="1.000" /></td>
					<td><input type="radio" name="gravity" value="1.005" /></td>
					<td><input type="radio" name="gravity" value="1.010" /></td>
					<td><input type="radio" name="gravity" value="1.015" /></td>
					<td><input type="radio" name="gravity" value="1.020" /></td>
					<td><input type="radio" name="gravity" value="1.025" /></td>
					<td><input type="radio" name="gravity" value="1.030" /></td>
					</tr>					
					<tr>
					<td  align="center">Leucocytes</td>
					<td><input type="radio" name="leucocytes" value="Neg" /></td>
					<td>&nbsp;</td>
					<td><input type="radio" name="leucocytes" value="+" /></td>
					<td><input type="radio" name="leucocytes" value="++" /></td>
					<td><input type="radio" name="leucocytes" value="+++" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr><td colspan="8">&nbsp;</td></tr>
					<tr><td>Additional Notes:</td>
					<td colspan="7"><textarea rows="10" cols="50" name="description">
					</textarea></td></tr>
					<tr><td colspan="8">
					<?php
						$current_nurse = $this->ion_auth->get_user_id();
							if ($this->ion_auth->in_group('Nurse')) {
							$nurse_id = $this->db->get_where('nurse', array('ion_user_id' => $current_nurse))->row()->id;
						}?>
						<input type="hidden" name="nurses_id" value="<?php echo @$nurse_id; ?>" />
					
					
					
					
					</td></tr>
					<tr >
					<td colspan="8" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
</table>				
                </form>
					
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add consent Survey Notes Modal-->
<div class="modal fade" id="myModal_consent" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Add Consent Form"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addConsentForms" class="clearfix row" method="post" enctype="multipart/form-data">
                   					
					<table width="100%" cellspacing="5" cellpadding="5" >
					<tr>
					<th colspan="2"><center><h4> <u>PRESCRIPTION CONSENT FORM</u> </h4></center></th>					
					</tr>
					
					<tr><td align="right">Patient Name: </td>
					<td style="padding:10px"><input type="text" class="form-control form-control-inline input-medium" name="patient_name" id="patient_name" value="<?php echo  $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name;?>" placeholder="" readonly=""></td>
					</tr>								
					<tr>
					<td colspan="2" style="padding:10px"><label for="assignment">"I" SPECS APPEAL JAMAICA shall under no circumstances be liable to any patient whose prescribed lenses are filled other than through this establishment. </label>
					<br><br>
					<div class="form-group col-md-12">
					
<?php //include("dist/sig2.php"); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="http://ispecs-server/dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/dist/css/jquery.signature.css">
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 450px; height: 50px;}
        #con_sign canvas{
            width: 450 !important;
            height: auto;
        }
    </style>
    <div class="form-group col-md-12">
					<div class="col-md-12">
					<b ><label class="" for="">Date:</label></b><br>
					<input type="text" class="form-control " placeholder ="fff" value="<?php echo date("Y-m-d");?>" name="date" id="date" placeholder="" readonly="readonly">
					</div>	<br><br>					
					<div class="col-md-12">
					<b ><label class="" for="">Name:</label></b><br>
					<input type="text" class="form-control " value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name;?>" name="consent_name" id="consent_name" placeholder="">
					<input type="hidden" value="Prescription Consent Form" name="form_type">

					</div>	<br><br>
	
        <div class="col-md-12">
            <label class="" for="">Customer Signature:</label>
            <br/>
            <div id="consent2_sign" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
            <textarea id="consent_sig64" class="form-control" name="consent_sign" style="display: none"></textarea>
        </div>
  
        <br/>
     <!--   <button class="btn btn-success">Submit</button> -->
    </div>
  
  
<script type="text/javascript">
    var consent2_sign = $('#consent2_sign').signature({syncField: '#consent_sig64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        consent2_sign.signature('clear');
        $("#consent_sig64").val('');
    });
	
	
</script>	
</div>					</td>
				</tr>					
			

				</table>
					<tr><td colspan="2">
					<?php
						$current_nurse = $this->ion_auth->get_user_id();
						//	if ($this->ion_auth->in_group(array('admin','Receptionist',''))) { 
							$reception_id = $this->db->get_where('users', array('id' => $current_nurse))->row()->id;								
						//}
						?>
						<input type="hidden" name="recept_id" value="<?php echo $reception_id; ?>" />
					
					
					
					
					</td></tr>
					<tr >
					<td colspan="2" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
	
					</table>
					</form>
					
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add medical leave form Modal-->
<div class="modal fade" id="myModal_sickleave" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Add Sick Leave Form"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addSickLeave" class="clearfix row" method="post" enctype="multipart/form-data">
                   					
					<table width="100%" cellspacing="5" cellpadding="5" >
					<tr>
					<th colspan="2"><center><h4> <u>Medical Leave Form</u> </h4></center></th>					
					</tr>
					
					<tr>
					<td colspan="2">
					This is to certify that <u> <?php echo $patient->first_name." ".$patient->middle_name." ".$patient->last_name;?> </u> is a patient of I SPECS APPEAL JAMAICA LTD. He/She is unable to carry out his/her duties for 
					<input type='text' name='sick_days' id='sick_days' size='4' > day(s) beginning 
					<input type='date' name='begin_date' id='begin_date' >.
					
					
				<input type='hidden' name='first_name' id='first_name' value='<?php echo $patient->first_name; ?>'>
					<input type='hidden' name='last_name' id='last_name' value='<?php echo $patient->last_name; ?>'> 
					<input type='hidden' name='middle_name' id='middle_name' value='<?php echo $patient->middle_name; ?>'> 
					<input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="" value=''>
					</td>
					</tr>
<tr><td>
<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctor_name = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->name;
    $doctor_lic = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->lic_number;
    $doctor_nominals = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->postnomials;
    $doctor_profile = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->profile;
	$doctor_details = $this->doctor_model->getDoctorById($doctor_id);
	
}


?>
<input type="hidden" name="doctor_lic" value='<?php echo $doctor_lic; ?>'>
<input type="hidden" name="doctor_nominals" value='<?php echo $doctor_nominals; ?>'>
<input type="hidden" name="doctor_id" value='<?php echo $doctor_id; ?>'>
<input type="hidden" name="doctor_name" value='<?php echo $doctor_name; ?>'>
<input type="hidden" name="doctor_details" value='<?php echo $doctor_details; ?>'>
<input type="hidden" name="doctor_profile" value='<?php echo $doctor_profile; ?>'>
</td></tr>					
					<tr>
					<td>
					<div class="form-group col-md-12">
					
<?php //include("dist/sig2.php"); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="http://ispecs-server/dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/dist/css/jquery.signature.css">
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 450px; height: 50px;}
        #doc_sign canvas{
            width: 450 !important;
            height: auto;
        }
    </style>
	
        <div class="col-md-12">
            <label class="" for="">Doctor's Signature:</label>
            <br/>
            <div id="doc_sign" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
			<span style="float:right;"><label class="" for="">Dr. <?php echo $doctor_name; ?></label></span>
            <textarea id="con_sig64" class="form-control" name="doctor_sign" style="display: none"></textarea>
        </div>
  
        <br/>
     <!--   <button class="btn btn-success">Submit</button> -->
    </div>
  
  
<script type="text/javascript">
    var doc_sign = $('#doc_sign').signature({syncField: '#con_sig64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        doc_sign.signature('clear');
        $("#con_sig64").val('');
    });
	
	
</script>	
</div>	
</td>
</tr>					
			

				</table>
					<tr><td colspan="2">
					<?php
						$current_nurse = $this->ion_auth->get_user_id();
						//	if ($this->ion_auth->in_group(array('admin','Receptionist',''))) { 
							$reception_id = $this->db->get_where('users', array('id' => $current_nurse))->row()->id;								
						//}
						?>
						<input type="hidden" name="recept_id" value="<?php echo $reception_id; ?>" />
					
					
					
					
					</td></tr>
					<tr >
					<td colspan="2" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
	
					</table>
					</form>
					
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Add Ownframe consent Survey Notes Modal-->
<div class="modal fade" id="myModal_ownframeconsent" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Add Consent Form"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addConsentForms" class="clearfix row" method="post" enctype="multipart/form-data">
                   					
					<table width="100%" cellspacing="5" cellpadding="5" >
					<tr>
					<th colspan="2"><center><h4> <u>GLASSES CONSENT FORM</u> </h4></center></th>					
					</tr>
					
					<tr><td align="right">Patient Name: </td>
					<td style="padding:10px"><input type="text" class="form-control form-control-inline input-medium" name="patient_name" id="patient_name" value="<?php echo $patient->first_name. ' '.$patient->middle_name. ' '.$patient->last_name ;?>" placeholder="" readonly=""></td>
					</tr>								
					<tr>
					<td colspan="2" style="padding:10px">
					<div class="form-group col-md-12">
					
<?php //include("dist/sig2.php"); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="http://ispecs-server/dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/dist/css/jquery.signature.css">
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 450px; height: 50px;}
        #con_sign canvas{
            width: 450 !important;
            height: auto;
        }
    </style>

</div>					</td>
				</tr>					
				
				<tr><td colspan="2" > <hr width="100%" ></td></tr>
				<tr>
					<td colspan="2" style="padding:10px"><label for="assignment">"I" SPECS APPEAL JAMAICA <u><b>does not</b></u> accept liability for any damages which occur to customers own glasses (frame & lens) during repairs, adjustments or insertion of new lens. <b><u>Reading glasses frames are not accepted</u></b>. </label>
					<br><br>
					<div class="form-group col-md-12">
	
  
    <div class="form-group col-md-12">
					<div class="col-md-12">
					<b ><label class="" for="">Date:</label></b><br>
					<input type="text" class="form-control " value="<?php echo date("Y-m-d");?>" name="disclaim_date" id="disclaim_date" placeholder="" readonly="readonly">
					<input type="hidden" value="Own Frame Consent" name="form_type">
					</div>	<br><br>					
					<div class="col-md-12">
					<b ><label class="" for="">Name:</label></b><br>
					<input type="text" class="form-control " value="<?php echo $patient->name.' '.$patient->middle_name.' '.$patient->last_name;?>" name="disclaim_name" id="disclaim_date" placeholder="">
					</div>	<br><br>
					<input type="hidden" class="form-control " value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name;?>" name="consent_name" id="consent_name" placeholder="">
	
        <div class="col-md-12">
            <label class="" for="">Customer Signature:</label>
            <br/>
            <div id="own_f" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
            <textarea id="dis_ownframe" class="form-control" name="disclaim_sign" style="display: none"></textarea>
        </div>
  
        <br/>
     <!--   <button class="btn btn-success">Submit</button> -->
    </div>
  
  
<script type="text/javascript">
    var own_f = $('#own_f').signature({syncField: '#dis_ownframe', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        own_f.signature('clear');
        $("#dis_ownframe").val('');
    });
	
	
</script>	
</div>					</td>
				</tr>

				</table>
                  

	


				

					<tr><td colspan="2">
					<?php
						$current_nurse = $this->ion_auth->get_user_id();
						//	if ($this->ion_auth->in_group(array('admin','Receptionist',''))) { 
							$reception_id = $this->db->get_where('users', array('id' => $current_nurse))->row()->id;								
						//}
						?>
						<input type="hidden" name="recept_id" value="<?php echo $reception_id; ?>" />
					
					
					
					
					</td></tr>
					<tr >
					<td colspan="2" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
	
					</table>
					</form>
					
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Add consent Survey Notes Modal-->
<div class="modal fade" id="myModal_consent_view" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Consent Form";//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
		<div id="consentform"></div>  	
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Sick Leae view Modal-->
<div class="modal fade" id="myModal_sickleave_view" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "Sick Leave Form";//lang('add_case'); ?></h4>
				<input type="button" onclick="printDiv('printableArea')" value="Print Sickleave" />
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
		<div id="sickform"></div> 
		
            </div>
			 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- Add consent OCT Email Notes Modal-->
<div class="modal fade" id="myModal_octemailconsent" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "OCT EMail Form"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addConsentForms" class="clearfix row" method="post" enctype="multipart/form-data">
                   					
					<table width="100%" cellspacing="5" cellpadding="5" >
					<tr>
<tr>
					<th colspan="2"><center><h4> <u>OCT EMAIL CONSENT FORM</u> </h4></center></th>					
					</tr>					</tr>
					
					<tr><td align="right">Patient Name: </td>
					<td style="padding:10px"><input type="text" class="form-control form-control-inline input-medium" name="patient_name" id="patient_name" value="<?php echo $patient->first_name. ' '.$patient->middle_name. ' '.$patient->last_name ;?>" placeholder="" readonly=""></td>
					</tr>								
					<tr>
					<td colspan="2" style="padding:10px">
					<div class="form-group col-md-12">
					
<?php //include("dist/sig2.php"); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="http://ispecs-server/dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ispecs-server/dist/css/jquery.signature.css">
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.js"></script>
	<script type="text/javascript" src="http://ispecs-server/dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="http://ispecs-server/dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 450px; height: 50px;}
        #con_sign canvas{
            width: 450 !important;
            height: auto;
        }
    </style>

  
  
  
  
  <!--
<script type="text/javascript">
    var con_sign = $('#con_sign').signature({syncField: '#con_sig64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        con_sign.signature('clear');
        $("#con_sig64").val('');
    });
	
	
</script>-->	
</div>					</td>
				</tr>					
				
				<tr><td colspan="2" > <hr width="100%" ></td></tr>
				<tr>
					<td colspan="2" style="padding:10px"><label for="assignment">I <?php echo $patient->first_name. ' '.$patient->middle_name. ' '.$patient->last_name ;?> give consent to "I" Specs Appeal Jamaica Ltd. to send my results via email. </label>
					<br><br>
					<div class="form-group col-md-12">
					
<?php //include("dist/sig2.php"); ?>
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="./dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./dist/css/jquery.signature.css">
	<script type="text/javascript" src="./dist/js/jSignature.js"></script>
	<script type="text/javascript" src="./dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="./dist/js/jquery.ui.touch-punch.min.js"></script>
  --> 
  
    <div class="form-group col-md-12">
					<div class="col-md-12">
					<b ><label class="" for="">Date:</label></b><br>
					<input type="text" class="form-control " value="<?php echo date("Y-m-d");?>" name="disclaim_date" id="disclaim_date" placeholder="" readonly="readonly">
					</div>	<br><br>					
					<div class="col-md-12">
					<b ><label class="" for="">Name:</label></b><br>
					<input type="text" class="form-control " value="<?php echo $patient->name.' '.$patient->middle_name.' '.$patient->last_name;?>" name="disclaim_name" id="disclaim_date" placeholder="">
					<input type="hidden" value="OCT Email Consent" name="form_type">

					</div>	<br><br>
	
        <div class="col-md-12">
            <label class="" for="">Customer Signature:</label>
            <br/>
            <div id="oct_email" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
            <textarea id="dis_octemail" class="form-control" name="disclaim_sign" style="display: none"></textarea>
        </div>
  
        <br/>
     <!--   <button class="btn btn-success">Submit</button> -->
    </div>
  
  
<script type="text/javascript">
    var oct_email = $('#oct_email').signature({syncField: '#dis_octemail', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        oct_email.signature('clear');
        $("#dis_octemail").val('');
    });
	
	
</script>	
</div>					</td>
				</tr>

				</table>
                  

	


				

					<tr><td colspan="2">
					<?php
						$current_nurse = $this->ion_auth->get_user_id();
						//	if ($this->ion_auth->in_group(array('admin','Receptionist',''))) { 
							$reception_id = $this->db->get_where('users', array('id' => $current_nurse))->row()->id;								
						//}
						?>
						<input type="hidden" name="recept_id" value="<?php echo $reception_id; ?>" />
					
					
					
					
					</td></tr>
					<tr >
					<td colspan="2" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
	
					</table>
					</form>
					
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
function printDiv(divId) {
     var printContents = document.getElementById(divId).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

   //  document.body.innerHTML = document.referrer;
     document.body.innerHTML = location.reload();;
	//  window.close();
}
</script>
<!-- Edit Additional Images Modal-->
 <div id="getAdditionalImages_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Images";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionalimages-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->	

<!-- Edit Additional Images Modal-->
 <div id="getDataReport_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Upload Details";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="datareport-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->	

<!-- Edit Additional Images Modal-->
 <div id="getAdditionalOct_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Images";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionaloct-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->	

<!-- Edit Additional Results Modal-->
 <div id="getAdditionalResult_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Reports";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionalresult-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->

	<!-- Edit Additional Referal Modal-->
 <div id="getAdditionalReferal_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Referals";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionalreferal-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->	

<!-- Edit Additional Photographs Modal-->
 <div id="getAdditionalPhotograph_modal" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Photographs";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionalphotograph-content-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional photograph Modal-->	

<!-- Edit Additional Images Modal-->
 <div id="getAdditionalRemoteImages_modal" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Additional Images";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="additionalremoteimages-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Additional Images Modal-->	



<!-- Edit Event Modal-->
<div class="modal fade" id="editAppointmentModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('edit_appointment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" class="clearfix row" action="appointment/addNew" method="post" enctype="multipart/form-data">
                    <div class="col-md-4 panel"> 
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single pos_select patient" id="pos_select" name="patient" value=''> 
                            <option value="">Select .....</option>
                            <option value="<?php echo $patient->id; ?>"><?php echo $patient->name; ?> </option>
                        </select>
                    </div>

                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single doctor" id="adoctors1" name="doctor" value=''>  
                            <option value="">Select .....</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"<?php
                                if (!empty($payment->doctor)) {
                                    if ($payment->doctor == $doctor->id) {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo $doctor->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>


                    <div class="col-md-4 panel"> 
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" readonly="" id="date1" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="col-md-6 panel">
                        <label class=""><?php echo lang('available_slots'); ?></label> 
                        <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''> 

                        </select>
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label>
                        <select class="form-control m-bot15" name="status" value=''>
                            <?php if (!$this->ion_auth->in_group('Patient')) { ?>
                                <option value="Registered" <?php ?> > <?php echo "Registered";//lang('pending_confirmation'); ?> </option>
                                <option value="Vitals Taken" <?php ?> > <?php echo "Vitals Taken";//lang('confirmed'); ?> </option>
                                <option value="Dilating" <?php ?> > <?php echo "Dilating";//lang('confirmed'); ?> </option>
                                <option value="Seen" <?php
                                ?> > <?php echo "Seen";//lang('treated'); ?> </option>
                                <option value="Cancelled" <?php ?> > <?php echo lang('cancelled'); ?> </option>
                            <?php } else { ?>
                                <option value="Requested" <?php ?> > <?php echo lang('requested'); ?> </option> 
                            <?php } ?>
                                <option value="Other" <?php ?> > <?php echo "Other";//lang('confirmed'); ?> </option>
							
                        </select>
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div> 
					<div class="col-md-6 panel">
                        <label for="exampleInputComments"> <?php echo lang('comments'); ?></label>
                        <input type="text" class="form-control" name="comments" id="exampleInputComments" value='' placeholder="additional comments">
                    </div>




                    <div class="col-md-6 panel">
                     <!--   <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br> -->
                    </div>



                    <input type="hidden" name="redirect" value='patient/medicalHistory?id=<?php echo $patient->id; ?>' />
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
 <div id="myModal_doctor2" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Doctor's Notes";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="doctor-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Doctor Edit Event Modal-->	 

<!-- View Refferal New Event Modal-->
 <div id="myModal_doctor2" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Doctor's Notes";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="doctor-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Doctor Edit Event Modal-->	 
 
<div id="myModal_doctor_rem" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "View Remote Doctor's Notes";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="doctor-content-rem"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Doctor Edit Event Modal-->	   
	   <div id="myModal_doctor_edit" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> <?php echo "Edit Doctor's Notes";//lang('add_case'); ?>
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div> 
						   
							<form action="./db/doctor_notes_edit.php?p_id=<?php echo $medical_history->id; ?>" method="post" id="edit_doc">
                           <!-- content will be load here -->                          
                           <div id="doctor-content-edit" class="doctor-content-edit">						   
						   </div>                             
                        </div> 
                        <div class="modal-footer"> 
						<button type="submit" form="edit_doc"   class="btn btn-success" >Update</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div>
						 <input type="hidden" name="appid" value='<?php echo $patient->id; ?>'>
						</form>
                        
                 </div> 
              </div>
       </div>
<!-- Nurse model view-->
 <div id="myModal_nurse2" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog"> 
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i>View Nurses Notes
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>                            
                           <!-- content will be load here -->                          
                           <div id="nurse-content"></div>                             
                        </div> 
                        <div class="modal-footer"> 
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div>

<!-- Add Medical History Modal-->

<!-- Edit Medical History Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_case'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" class="clearfix row" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium" name="title" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class=""><?php echo lang('description'); ?></label>
                        <div class="">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>


<!-- Add Appointment Modal-->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo lang('add_appointment'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="appointment/addNew" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('patient'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                            <option value="">Select .....</option>
                            <option value="<?php echo $patient->id; ?>"><?php echo $patient->name; ?> </option>
                        </select>
                    </div>
                    <div class="col-md-4 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="adoctors" name="doctor" value=''>  
                            <option value="">Select .....</option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>"<?php
                                if (!empty($payment->doctor)) {
                                    if ($payment->doctor == $doctor->id) {
                                        echo 'selected';
                                    }
                                }
                                ?>><?php echo $doctor->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>


                    <div class="col-md-4 panel">
                        <label for="exampleInputDate"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date"  name="date" id="exampleInputDate" value='' placeholder="">
                    </div>

                    <div class="col-md-6 panel">
                        <label class=""><?php echo lang('available_slots'); ?></label> 
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>

                    <div class="col-md-6 panel"> 
                        <label for="exampleInputEmail1"> <?php echo lang('appointment'); ?> <?php echo lang('status'); ?></label>
                        <select class="form-control m-bot15" name="status" value=''>

                            <?php //if ($this->ion_auth->in_group('admin','Nurse','Receptionist','Doctor')) { ?>
                                <option value="Pending Confirmation" <?php
                                ?> > <?php echo lang('pending_confirmation'); ?> </option>
                                <option value="Confirmed" <?php
                                ?> > <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated" <?php
                                ?> > <?php echo lang('treated'); ?> </option>
                                <option value="Cancelled" <?php ?> > <?php echo lang('cancelled'); ?> </option>
                            <?php // } else { ?>
                                <option value="Requested" <?php ?> > <?php echo lang('requested'); ?> </option> 
                                <option value="Dilating" <?php ?> > <?php echo 'Dilating'; ?> </option> 
                                <option value="Other" <?php ?> > <?php echo 'Other'; ?> </option> 
                            <?php // } ?>
                        </select>
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					<div class="col-md-6 panel">
                        <label for="exampleInputComments"> <?php echo lang('comments'); ?></label>
                        <input type="text" class="form-control" name="comments" id="exampleInputComments" value='' placeholder="additional comments">
                    </div>




                    <div class="col-md-5 panel">
                     <!--   <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br> -->
                    </div>

                    <input type="hidden" name="redirect" value='patient/medicalHistory?id=<?php echo $patient->id; ?>'>

                    <input type="hidden" name="request" value='<?php
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        echo 'Yes';
                    }
                    ?>'>

                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->
<?php /* echo; ?>
<!-- doctor model view-->
<div class="modal fade" id="myModal_doctor2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo "View Doctor's Notes"//lang('add_case'); ?></h4>
            </div> 
            <div class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
                <form role="form" action="patient/addDoctorNotes" class="clearfix row" method="post" enctype="multipart/form-data">
                   
					
					<!-- <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label> -->
                        <input type="hidden" class="form-control form-control-inline input-medium" placeholder ="fff" value="<?php echo date('d-m-Y');?>" name="date" id="exampleInputEmail1" value='' placeholder="" readonly="">
                    <!-- </div> -->
					
					<table width="100%" cellspacing="10" cellpadding="10" >
					
					<?php foreach ($doctor_notes as $doctor_notes2) { ?>
                                               <tr class="">

                                                    <td><?php echo date('d-m-Y', $doctor_notes2->date); ?></td>
                                                    <td><?php echo $doctor_notes2->title; ?></td>
                                                    <td><?php echo $doctor_notes2->description; ?></td>				
					</tr>
					<?php } ?>
					<tr >
					<td colspan="8" >
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <p align="center">
                        <button type="submit" name="submit" class="btn btn-info submit_button pull-right">SAVE</button>
					</p>	
                   
					</td>
					</tr>
</table>				
                </form>
					
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div> 
<?php */ ?>
<!-- Add Medical History Modal-->





<style>


    thead {
        background: #f1f1f1; 
        border-bottom: 1px solid #ddd; 
    }

    .btn_width{
        margin-bottom: 20px;
    }

    .tab-content{
        padding: 20px 0px;
    }

    .cke_editable {
        min-height: 1000px;
    }




</style>


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                                            $(document).ready(function () {
                                                                $(".editbutton").click(function (e) {
                                                                    e.preventDefault(e);
                                                                    // Get the record's ID via attribute  
                                                                    var iid = $(this).attr('data-id');
                                                                    $('#myModal2').modal('show');
                                                                    $.ajax({
                                                                        url: 'patient/editMedicalHistoryByJason?id=' + iid,
                                                                        method: 'GET',
                                                                        data: '',
                                                                        dataType: 'json',
                                                                    }).success(function (response) {
                                                                        // Populate the form fields with the data returned from server
                                                                        var date = new Date(response.medical_history.date * 1000);
                                                                        var de = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();

                                                                        $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
                                                                        $('#medical_historyEditForm').find('[name="date"]').val(de).end()
                                                                        $('#medical_historyEditForm').find('[name="title"]').val(response.medical_history.title).end()
                                                                        CKEDITOR.instances['editor'].setData(response.medical_history.description)
                                                                    });
                                                                });
                                                            });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".editPrescription").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#myModal5').modal('show');
            $.ajax({
                url: 'prescription/editPrescriptionByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#prescriptionEditForm').find('[name="id"]').val(response.prescription.id).end()
                $('#prescriptionEditForm').find('[name="patient"]').val(response.prescription.patient).end()
                $('#prescriptionEditForm').find('[name="doctor"]').val(response.prescription.doctor).end()

                CKEDITOR.instances['editor1'].setData(response.prescription.symptom)
                CKEDITOR.instances['editor2'].setData(response.prescription.medicine)
                CKEDITOR.instances['editor3'].setData(response.prescription.note)
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".editAppointmentButton").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            var id = $(this).attr('data-id');

            $('#editAppointmentForm').trigger("reset");
            $('#editAppointmentModal').modal('show');
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
    $(document).ready(function () {
        $('#editable-sample').DataTable({
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
                        columns: [0, 1],
                    }
                },
            ],

            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_ records per page",
            }


        });
    });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

<!-- /*
<script type="text/javascript">
    $(".table").on("click", ".case", function () {
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');

        $('.case_date').html("").end()
        $('.case_details').html("").end()
        $('.case_title').html("").end()
        $('.case_patient').html("").end()
         $('.case_patient_id').html("").end()
        $.ajax({
            url: 'patient/getCaseDetailsByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server
            var de = response.case.date * 1000;
            var d = new Date(de);


            var monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];

            var day = d.getDate();
            var monthIndex = d.getMonth();
            var year = d.getFullYear();

            var da = day + ' ' + monthNames[monthIndex] + ', ' + year;


            $('.case_date').append(da).end()
            $('.case_patient').append(response.patient.name).end()
            $('.case_patient_id').append('ID: ' + response.patient.id).end()
            $('.case_title').append(response.case.title).end()
            $('.case_details').append(response.case.description).end()






            $('#caseModal').modal('show');

        });
    });
</script> */ -->

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getNurseNotes', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#nurse-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getnursenotes.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#nurse-content').html('');    
			$('#nurse-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#nurse-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getDoctorNotes', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#doctor-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getdoctornotes.php',
			type: 'GET',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#doctor-content').html('');    
			$('#doctor-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#doctor-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getDoctorNotesRem', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#doctor-content-rem').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getdoctornotesrem.php',
			type: 'GET',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#doctor-content-rem').html('');    
			$('#doctor-content-rem').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#doctor-content-rem').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>
 
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalRemoteImages', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#additionalremoteimages-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionalremoteimages.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionalremoteimages-content').html('');    
			$('#additionalremoteimages-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionalremoteimages-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>	

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalPhotograph', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#additionalphotograph-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionalphotograph.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionalphotograph-content').html('');    
			$('#additionalphotograph-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionalphotograph-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getDataReport', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		
		$('#datareport-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getdatareport.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#datareport-content').html('');    
			$('#datareport-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#datareport-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalImages', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#additionalimages-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionalimages.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionalimages-content').html('');    
			$('#additionalimages-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionalimages-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalOct', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		
		$('#additionaloct-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionaloct.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionaloct-content').html('');    
			$('#additionaloct-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionaloct-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>	
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalResult', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		
		$('#additionalresult-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionalresult.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionalresult-content').html('');    
			$('#additionalresult-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionalresult-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>	
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getAdditionalReferal', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		
		$('#additionalreferal-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/getadditionalreferal.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#additionalreferal-content').html('');    
			$('#additionalreferal-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#additionalreferal-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>	

<script>
$(document).ready(function(){
	
	$(document).on('click', '#editDoctorNotes', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#doctor-content-edit').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/editdoctornotes.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#doctor-content-edit').html('');    
			$('#doctor-content-edit').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#doctor-content-edit').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

$(document).ready(function(){
	
	$(document).on('click', '#doc_update2', function(e){
		
		e.preventDefault();
		
		var id2 = $(this).data('id');   // it will get id of clicked row
		
		$('.doctor-content-edit').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/editdoctornotes.php',
			type: 'POST',
			data: 'id2='+id2,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('.doctor-content-edit').html('');    
			$('.doctor-content-edit').html('<i class="glyphicon glyphicon-info-sign"></i> Successful'); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('.doctor-content-edit').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

 
</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getConsentForm', function(e){
		
		e.preventDefault();
		
		//var uid = $(this).data('id');   // it will get id of clicked row
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#consentform').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/consentform.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#consentform').html('');    
			$('#consentform').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#consentform').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});


</script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getSickForm', function(e){
		
	//	e.preventDefault();
		
		//var uid = $(this).data('id');   // it will get id of clicked row
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#sickform').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: './db/sickform.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#sickform').html('');    
			$('#sickform').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#sickform').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});


</script>



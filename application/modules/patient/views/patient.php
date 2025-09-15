<style>
#hidden_div1 {
    display: none;
}
#hidden_div2 {
    display: none;
}
#hidden_div3 {
    display: none;
}
#hidden_div10 {
    display: none;
}
#hidden_div11 {
    display: none;
}


*,
*::before,
*::after {
  box-sizing: border-box;
}

:root {
  --color-primary: #ff0000;
  --color-secondary: #f49b90;
  --color-tertiary: #f28b7d;
  --color-quaternary: #f07a6a;
  --color-quinary: #ee6352;
  /*
  --color-primary: #00ff00;
  --color-secondary: #69A1F0;
  --color-tertiary: #7EAEF2;
  --color-quaternary: #90BAF5;
  --color-quinary: #A2C4F5;
  */
}




.text_shadows {
  text-shadow: 3px 3px 0 var(--color-secondary), 6px 6px 0 var(--color-tertiary),
    9px 9px var(--color-quaternary), 12px 12px 0 var(--color-quinary);
  font-family: bungee, sans-serif;
  font-weight: 20;
  text-transform: uppercase;
  font-size: calc(0.5rem + 1vw);
  text-align: center;
  margin: 0;
  color: var(--color-primary);
  //color: transparent;
  //background-color: white;
  //background-clip: text;
  animation: shadows 1.2s ease-in infinite, move 1.2s ease-in infinite;
  letter-spacing: 0.4rem;
}

@keyframes shadows {
  0% {
    text-shadow: none;
  }
  10% {
    text-shadow: 3px 3px 0 var(--color-secondary);
  }
  20% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary);
  }
  30% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary);
  }
  40% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  50% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  60% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary),
      12px 12px 0 var(--color-quinary);
  }
  70% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary), 9px 9px var(--color-quaternary);
  }
  80% {
    text-shadow: 3px 3px 0 var(--color-secondary),
      6px 6px 0 var(--color-tertiary);
  }
  90% {
    text-shadow: 3px 3px 0 var(--color-secondary);
  }
  100% {
    text-shadow: none;
  }
}

@keyframes move {
  0% {
    transform: translate(0px, 0px);
  }
  40% {
    transform: translate(-12px, -12px);
  }
  50% {
    transform: translate(-12px, -12px);
  }
  60% {
    transform: translate(-12px, -12px);
  }
  100% {
    transform: translate(0px, 0px);
  }
}
</style>

    <!--<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
	
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                <?php echo lang('patient'); ?> <?php echo lang('database'); ?>
                <div class="col-md-4 no-print pull-right"> 
                  <!--  <a data-toggle="modal" href="http://192.168.0.157/patient/" target="_blank" > -- >
                    <a data-toggle="modal" href="" target="_blank" >
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs" style="background-color:orange;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Visit Other Location";//lang('add_new'); ?>
                            </button>
							
                        </div>

                    </a>  -->
<a data-toggle="modal" href="#myModalPotential">
                        <div class="btn-group pull-right">
                            <!-- Disable Add Potential Client Modal -->
                            <!--
                            <button class="btn btn-info btn-xs" style="background-color:orange;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Add Potential Patient";//lang('add_new'); ?>
                            </button>
                            -->
							
                        </div>
                    </a>					
					<!--<a  href="javascript:void(0);" name="Upload Patients to Online Server" onClick="new_popup();">
                        <div class="btn-group pull-right">
                            <button class="btn btn-alert btn_width btn-xs"  style="background-color:orange;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Update Server";//lang('add_new'); ?>
                            </button>
						<script type="text/javascript">
							function new_popup(){
							var popupwin = window.open('./db/dbup/remote_patients.php','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin.close();}, 5000);
							}
						</script>	-->
                        </div>
                    </a>					
					<a  href="javascript:void(0);" name="Download Patients from Online Server" onClick="new_popup2();">
                        <div class="btn-group pull-right">
                            <button class="btn btn_width btn-xs" style="background-color:skyblue;">
                                <i class="fa fa-plus-circle"></i> <?php echo "Download Patient Info";//lang('add_new'); ?>
                            </button>
					<!--	<script type="text/javascript">
							function new_popup2(){
							var popupwin2 = window.open('./db/dbup/remote_patients_down.php','Online-Sync','width=600,height=150,left=30%,top=30%');
							setTimeout(function() { popupwin2.close();}, 5000);
							}
						</script>	-->
                        </div>
                    </a>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button class="btn btn-info btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo "Add New Patient";//lang('add_new'); ?>
                            </button>
							
                        </div>
                    </a>
					
					
                </div>
            </header>
            <div class="panel-body">
				 <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>                        
                               <th><?php echo 'Location';//lang('name'); ?></th>
                                <th><?php echo 'Firstname';//lang('name'); ?></th>
                                <th><?php echo 'Middlename';//lang('name'); ?></th>
                                <th><?php echo 'Lastname';//lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                              <!--  <th><?php echo "D.O.B";//lang('phone'); ?></th>  -->
                                      <th>Date Added</th>
                              <!--  <th><?php echo "D.O.B";//lang('phone'); ?></th>  -->
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist','Nurse','Doctor'))) { ?>
                                    <th><font color="red"><?php echo lang('due_balance'); ?></font></th>
                                <?php } ?>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style> 
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data" autocomplete="off">
				 <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Personal Information</u></h2></b>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="Fullname"><?php echo 'Alias'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Firstname"><?php echo 'First Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Middlename"><?php echo 'Middle Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Lastname"><?php echo 'Last Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Patient's Email">
                        <small id="email_error" class="text-danger"></small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="<?php echo rand(); ?>" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Address"><?php echo 'Complete Address'; //lang('address'); ?></label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control" name="phone" value='' placeholder="" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone2"><?php echo lang('other_phone'); ?></label>
                        <input type="number" class="form-control" name="phone2" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputSex"><?php echo 'Gender';//lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''required>
                            <option value="Male" <?php if (!empty($patient->sex) && $patient->sex == 'Male') echo 'selected'; ?>> Male </option>
                            <option value="Female" <?php if (!empty($patient->sex) && $patient->sex == 'Female') echo 'selected'; ?>> Female </option>
                            <option value="Others" <?php if (!empty($patient->sex) && $patient->sex == 'Others') echo 'selected'; ?>> Others </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium" type="date" name="birthdate" id="birthdate" value="" placeholder="" required>
                    </div>
                   
                    <div id="duplicate_error" class="form-group col-md-12" style="color: red;
    font-size: 28px;
    text-align: center;
    /* height: 20px; */
    padding: 10px;
   "></div>
                    <div class="form-group col-md-6">
                                                <label for="patient_type">Patient Type</label>
                        <select class="form-control js-example-basic-single" name="patient_type" id="patient_type" >
                        <option value="New Patient">New Patient</option>
                        <option value="Existing Patient">Existing Patient</option>
                        </select>
                     </div>

                    <div class="form-group col-md-6">     
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control js-example-basic-single"  name="doctor" required> 
                            <option value=""> </option>
                            <?php foreach ($doctors as $doctor) { ?>                                       
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>  
                    <div class="form-group col-md-6">     
                        <label for="exampleInputEmail1">Office Location</label>
                        <select class="form-control js-example-basic-single"  name="location" required> 
                        <?php
                            $log_id = $this->ion_auth->get_user_id();
                            $log_email = $this->db->get_where('users', array('id' => $log_id))->row()->location;
                        ?>
                            <option value="<?php echo $log_email; ?>"><?php echo $log_email; ?></option>
                            <option value="Montego Bay">Montego Bay </option>
                            <option value="Falmouth">Falmouth</option>
                           
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                         <label for="occupation">Occupation</label>
                        <input type="text" class="form-control" name="occupation" required>
                    </div>
                    <div class="form-group col-md-6">
                         <label for="referred_by">Referred by</label>
                        <input type="text" class="form-control" name="referred_by">
                    </div>
                    
                    <div class="form-group col-md-6">
                         <label for="examination">  Is this your first examination at this office? &nbsp;&nbsp; </label>
                            <select name="first_time" class="form-control form-control-inline input-medium" onchange="showDiv1('hidden_div1', this)">
                        <option value="">&darr;&darr; Please select one &darr;&darr;</option>
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        <option value="N/A">N/A</option>
                        </select>      
                    </div>	
                    
                
                    <script type="text/javascript">
                    function showDiv1(divId, element)
                        {
                            document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
                            //document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
                        }

            function ref(str){
                document.getElementById('oth').style.display = 'none';
                document.getElementById('ins').style.display = 'none';
                document.getElementById('ref').style.display = 'block';
                document.getElementById('dir2').style.display = 'none';
            }             
    function ins(str){
                document.getElementById('oth').style.display = 'none';
                document.getElementById('ins').style.display = 'block';
                document.getElementById('ref').style.display = 'none';
                document.getElementById('dir2').style.display = 'none';
            }			
    function oth(str){
                document.getElementById('oth').style.display = 'block';
                document.getElementById('ins').style.display = 'none';
                document.getElementById('ref').style.display = 'none';
                document.getElementById('dir2').style.display = 'none';
            }			
    function dir2(str){
                document.getElementById('oth').style.display = 'none';
                document.getElementById('ins').style.display = 'none';
                document.getElementById('ref').style.display = 'none';
                document.getElementById('dir2').style.display = 'block';
            }

                        
                    </script>

                    <div class="form-group col-md-6" id="hidden_div1">
                    <label for="howdid">  How did you hear about us? </label> <br>
                        <input type="radio" name="hear_about" id="ref2" onchange="ref()" /> Referred by: <br>
                        <div id="ref" style="display:none;">
                        <input class="form-control form-control-inline input-medium " type="text" name="ref_by" />
                        </div>
                        <input type="radio" name="hear_about" id="ins2" onchange="ins()" /> Insurance Company: <br>
                        <div id="ins" style="display:none;">
                        <input class="form-control form-control-inline input-medium " type="text" name="ins_company" /></div>					
                        <input type="radio" name="hear_about" id="dir3"   onchange="dir2()" /> Directory: <br>
                        <div id="dir2" style="display:none;">
                        <input class="form-control form-control-inline input-medium " type="text" name="hear_about_dir"  /></div>
                        <input type="radio" name="hear_about" id="oth1" onchange="oth()" /> Others: <br>
                        <div id="oth" style="display:none;">
                        <input class="form-control form-control-inline input-medium " type="text" name="hear_others" /></div>
                        
                    </div>					
                    
                    
                    
                    

<hr width="100%" />

<!-- medical history -->
                    <div class="form-group col-md-12">
                <b><h2 style="float:left;"><u>Medical History</u></h2></b>
                </div>
                <input type="hidden" class="default" name="img_url" value="./uploads/patient.jpg" />

                    <div class="form-group col-md-6">
                        <label for="examination">Reasons for today's examination</label>
                        <input type="text" class="form-control" name="reason_examination" id="reason_examination" >
                        <input class="form-control form-control-inline input-medium" type="hidden" name="physical_examination" id="physical_examination"  >

                    </div>

<!--    <div class="form-group col-md-6">
                        <label for="kin_relations">Date of last Physical Examination</label>
                        <input class="form-control form-control-inline input-medium" type="date" name="physical_examination" id="physical_examination"  >
                    </div>	-->
                    

<div class="form-group col-md-12">
<label for="agree">Have you had any of the following? (Please tick Yes or No)</label>
  <div class="row">
    <div class="form-group col-md-4">
		<p><b>YES &nbsp;&nbsp; NO </b></p><p>
		<input type="radio" name="glaucoma"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="glaucoma"  value="NO"  /> &nbsp;
		<label for="glaucoma">Glaucoma</label><br>		
		<input type="radio" name="cataracts"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="cataracts"  value="NO"  /> &nbsp;
		<label for="cataracts">Cataracts</label><br>		
		<input type="radio" name="eye_surgery"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="eye_surgery"  value="NO"  /> &nbsp;
		<label for="eye_surgery">Eye Surgery</label><br>		
		<input type="radio" name="lazy_eye"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="lazy_eye"  value="NO"  /> &nbsp;
		<label for="lazy_eye">Lazy Eye/Eye /turn</label><br>		
		
		<input type="radio" name="light_flashes"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="light_flashes"  value="NO"  /> &nbsp;
		<label for="light_flashes">Light Flashes</label><br>		
		<input type="radio" name="eye_injury"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="eye_injury"  value="NO"  /> &nbsp;
		<label for="eye_injury">Eye Injury</label>

    </div>
	<div class="form-group col-md-4">
		<p><b>YES &nbsp;&nbsp; NO </b></p><p>
		<input type="radio" name="floaters"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="floaters"  value="NO"  /> &nbsp;
		<label for="floaters">Sudden increase in Floaters</label><br>						
		<input type="radio" name="thyroid_disease"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="thyroid_disease"  value="NO"  /> &nbsp;		
		<label for="thyroid_disease">Thyroid Disease</label><br>		
		<input type="radio" name="sinusitis"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="sinusitis"  value="NO"  /> &nbsp;
		<label for="sinusitis">Sinusitis</label><br>		
		
		<input type="radio" name="hiv"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="hiv"  value="NO"  /> &nbsp;
		<label for="hiv">HIV</label><br>		
    </div>	
	
    <div class="form-group col-md-4">
		<p><b>YES &nbsp;&nbsp; NO </b></p><p>
		<input type="radio" name="blood_pressure2"  value="YES" onchange="showDiv_bp('hidden_div_bp', this)"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="blood_pressure2"  value="NO" onchange="showDiv_bp('hidden_div_bp', this)" /> &nbsp;
		<label for="blood_pressure2">Blood Pressure</label><br>		
		<input type="radio" name="diabetes"  value="YES" onchange="showDiv_diabetes('hidden_div_diabetes', this)"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="diabetes"  value="NO" onchange="showDiv_diabetes('hidden_div_diabetes', this)" /> &nbsp;
		<label for="diabetes">Diabetes</label><br>		
		<input type="radio" name="asthma"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="asthma"  value="NO"  /> &nbsp;
		<label for="asthma">Asthma</label><br>		
		<input type="radio" name="respiratory_problem"  value="YES"  /> &nbsp;&nbsp; &nbsp;&nbsp;
		<input type="radio" name="respiratory_problem"  value="NO"  /> &nbsp;
		<label for="respiratory_problem">Other lungs or respiratory problems</label><br>		
		
				
    </div> 	

  </div>
</div>

<script type="text/javascript">
function showDiv_bp(divId, element)
    {
        document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
    }					
function showDiv_diabetes(divId, element)
    {
        document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
    }					
</script>		

<div class="form-group col-md-6" id="hidden_div_bp" style="display:none;">
<label for="comment_med_bp">Current medication for BP</label>
<input class="form-control form-control-inline input-medium " type="text" name="comment_med_bp" />
</div>

<div class="form-group col-md-6" id="hidden_div_diabetes" style="display:none;">
<label for="comment_med_diabetes">Current medication for Diabetes</label>
<input class="form-control form-control-inline input-medium " type="text" name="comment_med_diabetes" />
</div>
			
<style>
#hidden_div4 {
    display: none;
}
#hidden_div5 {
    display: none;
}
#hidden_div6 {
    display: none;
}
</style>

                    <div class="form-group col-md-6">
                         <label for="medications">  Are you currently taking medications? &nbsp;&nbsp; </label>
                            <select name="taking_medications" class="form-control form-control-inline input-medium" onchange="showDiv4('hidden_div4', this)">
                        <option value="">&darr;&darr; Please select one &darr;&darr;</option>
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        <option value="N/A">N/A</option>
                        </select>      
                    </div>	
					
				
                    <script type="text/javascript">
                    function showDiv4(divId, element)
                        {
                            document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
                            //document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
                        }					
                    function showDiv5(divId, element)
                        {
                            document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
                            //document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
                        }						
                        
                    function showDiv6(divId, element)
                        {
                            document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
                            //document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
                        }

                    </script>

                    <div class="form-group col-md-6" id="hidden_div4">
                    <label for="medications_yes">Please list medications </label> <br>
                        <input class="form-control form-control-inline input-medium " type="text" name="medications_yes" />
                    </div>					
                    
                    <div class="form-group col-md-6">
                         <label for="wearing_contact_lens">Do you work at a computer or video display terminal? &nbsp;&nbsp; </label>
                            <select name="wearing_contact_lens" class="form-control form-control-inline input-medium" onchange="showDiv5('hidden_div5', this)">
                        <option value="">&darr;&darr; Please select one &darr;&darr;</option>
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        <option value="N/A">N/A</option>
                        </select>      
                    </div>	

                    <div class="form-group col-md-6" id="hidden_div5">
                    <label for="hours_screen_day">How many hours per day?</label> <br>
                        <input class="form-control form-control-inline input-medium " type="text" name="hours_screen_day" />
                    </div>	
                    
                    <div class="form-group col-md-6">
                         <label for="allergies">List Other Allergies  &nbsp;&nbsp; </label>
                        <input class="form-control form-control-inline input-medium " type="text" name="other_allergies" />
    
                    </div>						
                    
                    <div class="form-group col-md-6">
                       <label for="glasses"> Do you wear glasses? &nbsp;&nbsp; </label>
                            <select name="wear_glasses" class="form-control form-control-inline input-medium">
                        <option value="">&darr;&darr; Please select one &darr;&darr;</option>
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        <option value="N/A">N/A</option>
                        </select>      
                    </div>						
                                       
                    <div class="form-group col-md-6">
                         <label for="worn_contacts">  Have you worn Contacts Lens? &nbsp;&nbsp; </label>
                            <select name="worn_contacts" class="form-control form-control-inline input-medium" onchange="showDiv6('hidden_div6', this)">
                        <option value="">&darr;&darr; Please select one &darr;&darr;</option>
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        <option value="N/A">N/A</option>
                        </select>      
                    </div>	
                    
                    <div class="form-group col-md-6" id="hidden_div6">
                    <label for="contact_lens_yes">What type of contact lens </label> <br>
                        <input class="form-control form-control-inline input-medium " type="text" name="contact_lens_yes" /> <br>
                    <label for="contact_lens_hours">And how many hours per day? </label> <br>
                        <input class="form-control form-control-inline input-medium " type="text" name="contact_lens_hours" />
                    </div>	
                    

                     <hr width="100%" />
                    

                    <!--  <div class="form-group col-md-6">
                      <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>-->
<style>
#hidden_div20 {
    display: none;
}
</style>					
                     <hr width="100%" />
                     <div class="form-group col-md-6">
                    <label for=""><h4> <u>AUTHORIZATION TO RELEASE INFORMATION</u> </h4></label> <p>					 
                    <p>
                    <label for="authorization"> Do you authorize "I" SPECS APPEAL to release any information necessary to process your insurance claims  </label>
                    <select name="authorization" class="form-control form-control-inline input-medium" onchange="showDiv20('hidden_div20', this)">
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        </select>
                    </div>	
    
                       
                        <div class="form-group col-md-6">					 
                    <label for=""><h4> <u>ASSIGNMENT OF INSURANCE BENEFITS:</u> </h3></label> <p>					 
                         <p>
                         <label for="assignment">Do you hereby authorize payments of medication benefits to "I SPECS APPEAL" for services rendered. <br>
                    Do you understand that you are financially responsibly to "I SPECS APPEAL" for charges not covered by this assignment
                         </label>
                    <select name="assignment" class="form-control form-control-inline input-medium" >
                        <option value="NO">NO</option>
                        <option value="YES">YES</option>
                        </select>
                    </div>
                   
                    
                    <div class="form-group col-md-12">
                        <script type="text/javascript">
                        function showDiv20(divId, element)
                            {
                                document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
                            //	document.getElementById(divId).style.display = element.value == "NO" ? 'none' : 'block';
                            }					
                        </script>

                        <div id="hidden_div20">

<?php //include("dist/sig2.php"); ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="./dist/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./dist/css/jquery.signature.css">
	<script type="text/javascript" src="./dist/js/jSignature.js"></script>
	<script type="text/javascript" src="./dist/js/jSignature.UndoButton.js"></script> 
	<script type="text/javascript" src="./dist/js/jquery.ui.touch-punch.min.js"></script>
  
    <style>
        .kbw-signature { width: 300px; height: 50px;}
        #sig canvas{
            width: 300 !important;
            height: auto;
        }
    </style>

  
<!-- Replace the existing signature div with this implementation -->
<div class="form-group col-md-6">
    <div class="col-md-12">
        <label for="">Signature:</label>
        <br/>
        <div class="signature-pad-container">
            <canvas id="signature-pad" width="400" height="200" style="border: 1px solid #ddd; touch-action: none;"></canvas>
        </div>
        <br/>
        <button type="button" id="clear-signature" class="btn btn-sm btn-default">Clear Signature</button>
        <input type="hidden" id="signature-data" name="sign2">
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('signature-pad');
    const signatureDataInput = document.getElementById('signature-data');
    const clearButton = document.getElementById('clear-signature');
    const ctx = canvas.getContext('2d');
    
    // Set canvas background to white
    ctx.fillStyle = "#fff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    
    // Set drawing style
    ctx.lineWidth = 2;
    ctx.lineJoin = 'round';
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#000';
    
    // Mouse/touch events for drawing
    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        
        lastX = x;
        lastY = y;
    }
    
    function draw(e) {
        if (!isDrawing) return;
        
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        const x = (e.clientX || e.touches[0].clientX) - rect.left;
        const y = (e.clientY || e.touches[0].clientY) - rect.top;
        
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.stroke();
        
        lastX = x;
        lastY = y;
        
        // Save signature data to hidden input field
        signatureDataInput.value = canvas.toDataURL('image/png');
    }
    
    function stopDrawing() {
        isDrawing = false;
    }
    
    // Mouse events
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch events for mobile devices
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    
    // Clear button functionality
    clearButton.addEventListener('click', function() {
        ctx.fillStyle = "#fff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        signatureDataInput.value = '';
    });
});
</script>
	</div> 
   
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
	
	
</script>	
                        </div>	                 		   
                    </div>					
                    
                    


                 <section class="col-md-12">
    <button type="submit" name="submit" id="submit_button" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
</section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    
	</div><!-- /.modal-dialog -->
<!-- Add Patient Modal-->



<!-- Add Patient Modal-->
<div class="modal fade" id="myModalPotential" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> SFSF <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group col-md-12">
				<b><h2 style="float:left;"><u>Personal Information</u></h2></b>
				</div>
                    <div class="form-group col-md-6">
                        <label for="Fullname"><?php echo 'Alias'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" >
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="Firstname"><?php echo 'First Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="first_name"  required>
                    </div> 					
					<div class="form-group col-md-6">
                        <label for="Middlename"><?php echo 'Middle Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="middle_name" >
                    </div>                    
					<div class="form-group col-md-6">
                        <label for="Lastname"><?php echo 'Last Name'; //lang('name'); ?></label>
                        <input type="text" class="form-control" name="last_name"  required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value=''  placeholder="" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="<?php echo rand(); ?>"  placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="Address" ><?php echo 'Complete Address'; //lang('address'); ?></label>
                    <textarea class="form-control"  name="address" rows="3" ></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone"><?php echo lang('phone'); ?></label>
                        <input type="number" class="form-control" name="phone"  value='' placeholder="" required>
                    </div>
					<div class="form-group col-md-6">
                        <label for="phone2"><?php echo lang('other_phone'); ?></label>
                        <input type="number" class="form-control" name="phone2"  value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputSex"><?php echo 'Gender';//lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

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

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium" type="date" name="birthdate" value="" placeholder="" required>      
                    </div>
					<div class="form-group col-md-6">
                                            <label for="patient_type">Patient Type</label>
											<select class="form-control js-example-basic-single" name="patient_type" id="patient_type" >
											<option value="Potential Patient">Potential Patient </option>
											</select>
                      </div>

                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control js-example-basic-single"  name="doctor" required value=''> 
                            <option value=""> </option>
                            <?php foreach ($doctors as $doctor) { ?>                                        
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>  
                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1">Office Location</label>
                        <select class="form-control js-example-basic-single"  name="location" required> 
						<?php
							$log_id = $this->ion_auth->get_user_id();
							$log_email = $this->db->get_where('users', array('id' => $log_id))->row()->location;
						?>
                            <option value="<?php echo $log_email; ?>"><?php echo $log_email; ?></option>
                            <option value="Montego Bay">Montego Bay </option>
                            <option value="Falmouth">Falmouth</option>
                        
                        </select>
                    </div>

						</div>	                    
					</div>					
					
					


                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" autocomplete="off" action="patient/EditPatientSet" class="clearfix" method="post" enctype="multipart/form-data">
                    <!-- Personal Information Section -->
                    <div class="form-group col-md-12">
                        <h3><u>Personal Information</u></h3>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Alias</label>
                        <input type="text" class="form-control" name="name" value="<?= $patient->name ?>">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?= $patient->first_name ?>">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" value="<?= $patient->middle_name ?>">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?= $patient->last_name ?>">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $patient->email ?>">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label>Change Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea class="form-control" name="address" rows="2"><?= $patient->address ?></textarea>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="<?= $patient->phone ?>">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Other Phone</label>
                        <input type="text" class="form-control" name="phone2" value="<?= $patient->phone2 ?>">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Gender</label>
                        <select class="form-control" name="sex">
                            <option value="Male" <?= ($patient->sex == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($patient->sex == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Others" <?= ($patient->sex == 'Others') ? 'selected' : '' ?>>Others</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Birth Date</label>
                        <input type="date" class="form-control" name="birthdate" value="<?= $patient->birthdate ?>">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Patient Type</label>
                        <select class="form-control" name="patient_type">
                            <option value="Regular Patient" <?= ($patient->patient_type == 'Regular Patient') ? 'selected' : '' ?>>Regular Patient</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Doctor</label>
                        <select class="form-control js-example-basic-single" name="doctor">
                            <option value="">Select Doctor</option>
                            <?php foreach ($doctors as $doc): ?>
                                <option value="<?= $doc->id ?>" <?= ($patient->doctor == $doc->id) ? 'selected' : '' ?>>
                                    <?= $doc->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Office Location</label>
                        <select class="form-control" name="location">
                            <option value="Montego Bay" <?= ($patient->location == 'Montego Bay') ? 'selected' : '' ?>>Montego Bay</option>
                            <option value="Falmouth" <?= ($patient->location == 'Falmouth') ? 'selected' : '' ?>>Falmouth</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Deceased?</label>
                        <select class="form-control" name="deceased">
                            <option value="NO" <?= ($patient->deceased == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->deceased == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <!-- Medical History Section -->
                    <div class="form-group col-md-12">
                        <hr>
                        <h3><u>Medical History</u></h3>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>First Examination?</label>
                        <select class="form-control" name="first_time" onchange="showDiv1('hidden_div1', this)">
                            <option value="NO" <?= ($patient->first_time == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->first_time == 'YES') ? 'selected' : '' ?>>YES</option>
                            <option value="N/A" <?= ($patient->first_time == 'N/A') ? 'selected' : '' ?>>N/A</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6" id="hidden_div1" style="<?= ($patient->first_time == 'YES') ? 'display:block' : 'display:none' ?>">
                        <label>How did you hear about us?</label><br>
                        <input type="radio" name="hear_about" value="Referred" <?= ($patient->ref_by) ? 'checked' : '' ?> onchange="ref()"> Referred by:<br>
                        <div id="ref" style="display:<?= ($patient->ref_by) ? 'block' : 'none' ?>">
                            <input class="form-control" type="text" name="ref_by" value="<?= $patient->ref_by ?>">
                        </div>
                        
                        <input type="radio" name="hear_about" value="Insurance" <?= ($patient->ins_company) ? 'checked' : '' ?> onchange="ins()"> Insurance Company:<br>
                        <div id="ins" style="display:<?= ($patient->ins_company) ? 'block' : 'none' ?>">
                            <input class="form-control" type="text" name="ins_company" value="<?= $patient->ins_company ?>">
                        </div>
                        
                        <input type="radio" name="hear_about" value="Directory" <?= ($patient->hear_about_dir) ? 'checked' : '' ?> onchange="dir2()"> Directory:<br>
                        <div id="dir2" style="display:<?= ($patient->hear_about_dir) ? 'block' : 'none' ?>">
                            <input class="form-control" type="text" name="hear_about_dir" value="<?= $patient->hear_about_dir ?>">
                        </div>
                        
                        <input type="radio" name="hear_about" value="Others" <?= ($patient->hear_others) ? 'checked' : '' ?> onchange="oth()"> Others:<br>
                        <div id="oth" style="display:<?= ($patient->hear_others) ? 'block' : 'none' ?>">
                            <input class="form-control" type="text" name="hear_others" value="<?= $patient->hear_others ?>">
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Reasons for today's examination</label>
                        <input type="text" class="form-control" name="reason_examination" value="<?= $patient->reason_examination ?>">
                    </div>
                    
                    <!-- Medical Conditions -->
                    <div class="form-group col-md-12">
                        <label>Medical Conditions:</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="glaucoma" value="YES" <?= ($patient->glaucoma == 'YES') ? 'checked' : '' ?>> Glaucoma
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="cataracts" value="YES" <?= ($patient->cataracts == 'YES') ? 'checked' : '' ?>> Cataracts
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="eye_surgery" value="YES" <?= ($patient->eye_surgery == 'YES') ? 'checked' : '' ?>> Eye Surgery
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="lazy_eye" value="YES" <?= ($patient->lazy_eye == 'YES') ? 'checked' : '' ?>> Lazy Eye
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="light_flashes" value="YES" <?= ($patient->light_flashes == 'YES') ? 'checked' : '' ?>> Light Flashes
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="eye_injury" value="YES" <?= ($patient->eye_injury == 'YES') ? 'checked' : '' ?>> Eye Injury
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="floaters" value="YES" <?= ($patient->floaters == 'YES') ? 'checked' : '' ?>> Floaters
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="thyroid_disease" value="YES" <?= ($patient->thyroid_disease == 'YES') ? 'checked' : '' ?>> Thyroid Disease
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="sinusitis" value="YES" <?= ($patient->sinusitis == 'YES') ? 'checked' : '' ?>> Sinusitis
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="hiv" value="YES" <?= ($patient->hiv == 'YES') ? 'checked' : '' ?>> HIV
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="blood_pressure2" value="YES" <?= ($patient->blood_pressure2 == 'YES') ? 'checked' : '' ?>> Blood Pressure
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="diabetes" value="YES" <?= ($patient->diabetes == 'YES') ? 'checked' : '' ?>> Diabetes
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="asthma" value="YES" <?= ($patient->asthma == 'YES') ? 'checked' : '' ?>> Asthma
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="respiratory_problem" value="YES" <?= ($patient->respiratory_problem == 'YES') ? 'checked' : '' ?>> Respiratory Problems
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Other Conditions</label>
                                    <input type="text" class="form-control" name="problem_others" value="<?= $patient->problem_others ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Medications Section -->
                    <div class="form-group col-md-6">
                        <label>Currently taking medications?</label>
                        <select class="form-control" name="taking_medications" onchange="showDiv4('hidden_div4', this)">
                            <option value="NO" <?= ($patient->taking_medications == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->taking_medications == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6" id="hidden_div4" style="<?= ($patient->taking_medications == 'YES') ? 'display:block' : 'display:none' ?>">
                        <label>Medications List</label>
                        <input type="text" class="form-control" name="medications_yes" value="<?= $patient->medications_yes ?>">
                    </div>
                    
                    <!-- Contact Lenses Section -->
                    <div class="form-group col-md-6">
                        <label>Interested in contact lenses?</label>
                        <select class="form-control" name="wearing_contact_lens" onchange="showDiv5('hidden_div5', this)">
                            <option value="NO" <?= ($patient->wearing_contact_lens == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->wearing_contact_lens == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6" id="hidden_div5" style="<?= ($patient->wearing_contact_lens == 'YES') ? 'display:block' : 'display:none' ?>">
                        <label>Allergies List</label>
                        <input type="text" class="form-control" name="allergies_list" value="<?= $patient->allergies_list ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Other Allergies</label>
                        <input type="text" class="form-control" name="other_allergies" value="<?= $patient->other_allergies ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Wear glasses?</label>
                        <select class="form-control" name="wear_glasses">
                            <option value="NO" <?= ($patient->wear_glasses == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->wear_glasses == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Worn contact lenses?</label>
                        <select class="form-control" name="worn_contacts" onchange="showDiv6('hidden_div6', this)">
                            <option value="NO" <?= ($patient->worn_contacts == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->worn_contacts == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6" id="hidden_div6" style="<?= ($patient->worn_contacts == 'YES') ? 'display:block' : 'display:none' ?>">
                        <label>Contact lens type</label>
                        <input type="text" class="form-control" name="contact_lens_yes" value="<?= $patient->contact_lens_yes ?>">
                        
                        <label>Hours per day</label>
                        <input type="text" class="form-control" name="contact_lens_hours" value="<?= $patient->contact_lens_hours ?>">
                    </div>
                    
                    <!-- Authorization Section -->
                    <div class="form-group col-md-12">
                        <hr>
                        <h3><u>Authorization</u></h3>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Release Information Authorization</label>
                        <select class="form-control" name="authorization">
                            <option value="NO" <?= ($patient->authorization == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->authorization == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Insurance Benefits Assignment</label>
                        <select class="form-control" name="assignment">
                            <option value="NO" <?= ($patient->assignment == 'NO') ? 'selected' : '' ?>>NO</option>
                            <option value="YES" <?= ($patient->assignment == 'YES') ? 'selected' : '' ?>>YES</option>
                        </select>
                    </div>
                    
                    <!-- Image Upload -->
                    <div class="form-group col-md-12">
                        <hr>
                        <label>Profile Image</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <?php if ($patient->img_url): ?>
                                    <img src="<?= $patient->img_url ?>" alt="Current Image">
                                <?php else: ?>
                                    <img src="path/to/default/image.jpg" alt="No Image">
                                <?php endif; ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                    <input type="file" class="default" name="img_url" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SMS Notification -->
                    <div class="form-group col-md-12">
                        <label>
                            <input type="checkbox" name="sms" value="sms"> Send SMS Notification
                        </label>
                    </div>
                    
                    <input type="hidden" name="id" value="<?= $patient->id ?>">
                    <input type="hidden" name="p_id" value="<?= $patient->patient_id ?>">
                    
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-info pull-right">Update Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript functions for showing/hiding sections
function showDiv1(divId, element) {
    document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
}

function ref() {
    document.getElementById('oth').style.display = 'none';
    document.getElementById('ins').style.display = 'none';
    document.getElementById('ref').style.display = 'block';
    document.getElementById('dir2').style.display = 'none';
}

function ins() {
    document.getElementById('oth').style.display = 'none';
    document.getElementById('ins').style.display = 'block';
    document.getElementById('ref').style.display = 'none';
    document.getElementById('dir2').style.display = 'none';
}

function oth() {
    document.getElementById('oth').style.display = 'block';
    document.getElementById('ins').style.display = 'none';
    document.getElementById('ref').style.display = 'none';
    document.getElementById('dir2').style.display = 'none';
}

function dir2() {
    document.getElementById('oth').style.display = 'none';
    document.getElementById('ins').style.display = 'none';
    document.getElementById('ref').style.display = 'none';
    document.getElementById('dir2').style.display = 'block';
}

function showDiv4(divId, element) {
    document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
}

function showDiv5(divId, element) {
    document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
}

function showDiv6(divId, element) {
    document.getElementById(divId).style.display = element.value == "YES" ? 'block' : 'none';
}
</script>

<!-- Patient Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?php echo lang('patient'); ?> <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" autocomplete="off" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <!-- Patient Image and ID -->
                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img id="img1" src="./Uploads/patient.jpg" alt="Patient Image" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="patient_id"><?php echo lang('patient_id'); ?>: <span class="patientIdClass"></span></label>
                            </div>
                        </div>
                    </div> 

                    <!-- Personal Information -->
                    <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Personal Information</u></h2></b>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name"><?php echo 'Alias'; ?></label>
                        <div class="nameClass"></div>
                    </div>                    
                    <div class="form-group col-md-4">
                        <label for="first_name"><?php echo 'First Name'; ?></label>
                        <div class="firstnameClass"></div>
                    </div>                    
                    <div class="form-group col-md-4">
                        <label for="middle_name"><?php echo 'Middle Name'; ?></label>
                        <div class="middlenameClass"></div>
                    </div>                    
                    <div class="form-group col-md-4">
                        <label for="last_name"><?php echo 'Last Name'; ?></label>
                        <div class="lastnameClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="sex"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone2"><?php echo lang('other_phone'); ?></label>
                        <div class="phone2Class"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="deceased">Deceased?</label>
                        <div class="deceasedClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="bloodgroup"><?php echo lang('bloodgroup'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="occupation"><?php echo 'Occupation'; ?></label>
                        <div class="occupationClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="referred_by"><?php echo 'Referred by'; ?></label>
                        <div class="referredByClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="patient_type"><?php echo 'Patient Type'; ?></label>
                        <div class="patientTypeClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="doctor"><?php echo lang('doctor'); ?></label>
                        <div class="doctorClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="location">Location</label>
                        <div class="locationClass"></div>                    
                    </div>

                    <div class="form-group col-md-4">
                        <label for="company"><?php echo 'Company'; ?></label>
                        <div class="companyClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="job_description"><?php echo 'Job Description'; ?></label>
                        <div class="jobDescriptionClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="first_time"><?php echo 'First Time Examination'; ?></label>
                        <div class="firstTimeClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="howdid">How did you hear about us?</label> <br>
                        Referred by: <div class="ref_byClass"></div>
                        Insurance Company: <div class="ins_companyClass"></div>
                        Directory: <div class="hear_about_dirClass"></div>
                        Others: <div class="hear_othersClass"></div>
                    </div>

                    <!-- Emergency Contact Information -->
                    <!--
                    <hr width="100%" />
                    <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Emergency Contact Information</u></h2></b>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="e_contact"><?php echo lang('kin_name'); ?></label>
                        <div class="kin_nameClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="e_contact_relation"><?php echo lang('kin_relations'); ?></label>
                        <div class="kin_relationsClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="e_contact_phone"><?php echo lang('kin_phone'); ?></label>
                        <div class="kin_phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="e_contact_email"><?php echo lang('kin_email'); ?></label>
                        <div class="kin_emailClass"></div>
                    </div>
                    -->

                    <!-- Medical History -->
                    <hr width="100%" />
                    <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Medical History</u></h2></b>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="reason_examination">Reasons for today's examination</label>
                        <div class="reason_examinationClass"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="physical_examination">Date of last Physical Examination</label>
                        <div class="physical_examinationClass"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="agree">Have you had any of the following? (Please tick Yes or No)</label>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="glaucoma">Glaucoma</label>
                                <div class="glaucomaClass"></div> &nbsp;&nbsp;
                                <br>         
                                <label for="cataracts">Cataracts</label>
                                <div class="cataractsClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="eye_surgery">Eye Surgery</label>        
                                <div class="eyesurgeryClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="lazy_eye">Lazy Eye/Eye Turn</label>        
                                <div class="lazyeyeClass"></div> &nbsp;&nbsp;
                                <br>        
                                <label for="light_flashes">Light Flashes</label>
                                <div class="lightflashesClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="eye_injury">Eye Injury</label>
                                <div class="eyeinjuryClass"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="floaters">Sudden increase in Floaters</label>
                                <div class="floatersClass"></div> 
                                <br>
                                <label for="thyroid_disease">Thyroid Disease</label>
                                <div class="thyroiddiseaseClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="sinusitis">Sinusitis</label>
                                <div class="sinusitisClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="hiv">HIV</label>
                                <div class="hivClass"></div> &nbsp;&nbsp;
                                <br>        
                            </div>    
                            <div class="form-group col-md-4">
                                <label for="blood_pressure2">Blood Pressure</label>
                                <div class="bloodpressure2Class"></div> &nbsp;&nbsp;
                                <br>
                                <label for="comment_med_bp">Current medication for BP</label>
                                <div class="commentMedBpClass"></div> &nbsp;&nbsp;
                                <br>    
                                <label for="diabetes">Diabetes</label>
                                <div class="diabetesClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="comment_med_diabetes">Current medication for Diabetes</label>
                                <div class="commentMedDiabetesClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="asthma">Asthma</label>
                                <div class="asthmaClass"></div> &nbsp;&nbsp;
                                <br>
                                <label for="respiratory_problem">Other lungs or respiratory problems</label>
                                <div class="respiratoryproblemClass"></div> &nbsp;&nbsp;
                                <br>    
                            </div>    
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="taking_medications">Are you currently taking medications?</label>
                        <div class="takingmedicationsClass"></div> &nbsp;&nbsp;                        
                    </div>    

                    <div class="form-group col-md-6">
                        <label for="medications_yes">Please list medications</label>
                        <div class="medicationsyesClass"></div> 
                    </div>                    

                    <div class="form-group col-md-6">
                        <label for="wearing_contact_lens">Do you work at a computer or video display terminal?</label>  
                        <div class="wearingcontactlensClass"></div> 
                    </div>    

                    <div class="form-group col-md-6">
                        <label for="hours_screen_day">How many hours per day?</label>
                        <div class="hoursScreenDayClass"></div> 
                    </div>    

                    <div class="form-group col-md-6">
                        <label for="other_allergies">Other Allergies</label>
                        <div class="otherallergiesClass"></div> 
                    </div>                        

                    <div class="form-group col-md-6">
                        <label for="wear_glasses">Do you wear glasses?</label>  
                        <div class="wearglassesClass"></div> 
                    </div>                        

                    <div class="form-group col-md-6">
                        <label for="worn_contacts">Have you worn Contact Lenses?</label>  
                        <div class="worncontactsClass"></div> 
                    </div>    

                    <div class="form-group col-md-6">
                        <label for="contact_lens_yes">What type of contact lens</label>
                        <div class="contactlensyesClass"></div> 
                        <br>
                        <label for="contact_lens_hours">And how many hours per day?</label>
                        <div class="contactlenshoursClass"></div> 
                    </div>    

                    <!-- Authorization and Signature -->
                    <hr width="100%" />
                    <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Authorization and Signature</u></h2></b>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="authorization">Authorization to Release Information</label>
                        <div class="authorizationClass"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="assignment">Assignment of Insurance Benefits</label>
                        <div class="assignmentClass"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="signed">Signature:</label> 
                        <div class="mytest" id="slideshow-carousel">
                            <a href="#" rel="p1" class="thumbnail_img"> 
                                <img class="signedClass" src="" style="height:100px; width:200px" alt="Signature"/>
                                <span><img class="signedClass" src="" style="height:300px; width:300px" /></span>
                            </a>
                        </div>                        
                    </div>

                    <!-- Additional Fields -->
                    <!--
                    <hr width="100%" />
                    <div class="form-group col-md-12">
                        <b><h2 style="float:left;"><u>Additional Information</u></h2></b>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="added_by">Added By</label>
                        <div class="addedByClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="add_date">Add Date</label>
                        <div class="addDateClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="registration_time">Registration Time</label>
                        <div class="registrationTimeClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="how_added">How Added</label>
                        <div class="howAddedClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="appointment_confirmation">Appointment Confirmation</label>
                        <div class="appointmentConfirmationClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="payment_confirmation">Payment Confirmation</label>
                        <div class="paymentConfirmationClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="appointment_creation">Appointment Creation</label>
                        <div class="appointmentCreationClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="meeting_schedule">Meeting Schedule</label>
                        <div class="meetingScheduleClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="mb_id">Montego Bay ID</label>
                        <div class="mbIdClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="fm_id">Falmouth ID</label>
                        <div class="fmIdClass"></div>
                    </div>
                    -->

                    <style>
                        .thumbnail_img {
                            position: relative;
                            z-index: 0;
                        }
                        .thumbnail_img:hover {
                            background-color: transparent;
                            z-index: 100;
                        }
                        .thumbnail_img span img { 
                            display: inline-block;
                        }
                        .thumbnail_img span { 
                            position: absolute;
                            visibility: hidden;
                            color: black;
                            text-decoration: none;
                            opacity: 0.7;
                        }
                        .thumbnail_img:hover span {
                            visibility: visible;
                            background: transparent;
                            top: 0px;
                            left: 5px;
                            opacity: 3;
                            height: auto;
                            width: auto;
                            border: 0;
                        }
                    </style>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>

<!--
<script>


    var video = document.getElementById('video');
    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function () {
        context.drawImage(video, 0, 0, 200, 200);
    });

</script>

-->



<script type="text/javascript">

    $(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
            $('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
            $('#editPatientForm').find('[name="first_name"]').val(response.patient.first_name).end()
            $('#editPatientForm').find('[name="deceased"]').val(response.patient.deceased).end()
            $('#editPatientForm').find('[name="middle_name"]').val(response.patient.middle_name).end()
            $('#editPatientForm').find('[name="last_name"]').val(response.patient.last_name).end()
            $('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
            $('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
            $('#editPatientForm').find('[name="location"]').val(response.patient.location).end()
            $('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
            $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
            $('#editPatientForm').find('[name="phone2"]').val(response.patient.phone2).end()
            $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
            $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end()
            $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end()
            $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()            
			$('#editPatientForm').find('[name="kin_name"]').val(response.patient.e_contact).end()
            $('#editPatientForm').find('[name="kin_relations"]').val(response.patient.e_contact_relation).end()
            $('#editPatientForm').find('[name="kin_phone"]').val(response.patient.e_contact_phone).end()
            $('#editPatientForm').find('[name="kin_email"]').val(response.patient.e_contact_email).end()			
            $('#editPatientForm').find('[name="reason_examination"]').val(response.patient.reason_examination).end()
            $('#editPatientForm').find('[name="physical_examination"]').val(response.patient.physical_examination).end()
            $('#editPatientForm').find('[name="glaucoma"]').val(response.patient.glaucoma).end()
            $('#editPatientForm').find('[name="cataracts"]').val(response.patient.cataracts).end()
            $('#editPatientForm').find('[name="eyesurgery"]').val(response.patient.eyesurgery).end()
            $('#editPatientForm').find('[name="lazyeye"]').val(response.patient.lazyeye).end()
            $('#editPatientForm').find('[name="lightflashes"]').val(response.patient.lightflashes).end()
            $('#editPatientForm').find('[name="eyeinjury"]').val(response.patient.eyeinjury).end()
            $('#editPatientForm').find('[name="sickothers"]').val(response.patient.sickothers).end()
            $('#editPatientForm').find('[name="floaters"]').val(response.patient.floaters).end()
            $('#editPatientForm').find('[name="thyroiddisease"]').val(response.patient.thyroiddisease).end()
            $('#editPatientForm').find('[name="sinusitis"]').val(response.patient.sinusitis).end()
            $('#editPatientForm').find('[name="hiv"]').val(response.patient.hiv).end()
            $('#editPatientForm').find('[name="bloodpressure2"]').val(response.patient.bloodpressure2).end()
            $('#editPatientForm').find('[name="diabetes"]').val(response.patient.diabetes).end()
            $('#editPatientForm').find('[name="respiratoryproblem"]').val(response.patient.respiratoryproblem).end
            $('#editPatientForm').find('[name="problemothers"]').val(response.patient.problemothers).end
            $('#editPatientForm').find('[name="takingmedications"]').val(response.patient.takingmedications).end
            $('#editPatientForm').find('[name="medicationsyes"]').val(response.patient.medicationsyes).end
            $('#editPatientForm').find('[name="wearingcontactlens"]').val(response.patient.wearingcontactlens).end
            $('#editPatientForm').find('[name="allergieslist"]').val(response.patient.allergieslist).end
            $('#editPatientForm').find('[name="otherallergies"]').val(response.patient.otherallergies).end
            $('#editPatientForm').find('[name="wearglasses"]').val(response.patient.wearglasses).end
            $('#editPatientForm').find('[name="worncontacts"]').val(response.patient.worncontacts).end
            $('#editPatientForm').find('[name="signed"]').val(response.patient.signed).end
            $('#editPatientForm').find('[name="contactlensyes"]').val(response.patient.contactlensyes).end
            $('#editPatientForm').find('[name="contactlenshours"]').val(response.patient.contactlenshours).end

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img").attr("src", response.patient.img_url);
            }


            $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');

            $('#myModal2').modal('show');

        });
    });

</script>



<script type="text/javascript">

$(document).ready(function() {
    $(".table").on("click", ".inffo", function() {
        var iid = $(this).attr('data-id');
        
        // Reset all fields
        $("#img1").attr("src", "Uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('.patientIdClass').html("");
        $('.nameClass').html("");
        $('.firstnameClass').html("");
        $('.middlenameClass').html("");
        $('.lastnameClass').html("");
        $('.emailClass').html("");
        $('.addressClass').html("");
        $('.phoneClass').html("");
        $('.phone2Class').html("");
        $('.genderClass').html("");
        $('.birthdateClass').html("");
        $('.bloodgroupClass').html("");
        $('.doctorClass').html("");
        $('.locationClass').html("");
        $('.ageClass').html("");
        $('.kin_nameClass').html("");
        $('.kin_relationsClass').html("");
        $('.kin_phoneClass').html("");
        $('.kin_emailClass').html("");
        $('.reason_examinationClass').html("");
        $('.physical_examinationClass').html("");
        $('.glaucomaClass').html("");
        $('.cataractsClass').html("");
        $('.eyesurgeryClass').html("");
        $('.lazyeyeClass').html("");
        $('.lightflashesClass').html("");
        $('.eyeinjuryClass').html("");
        $('.floatersClass').html("");
        $('.thyroiddiseaseClass').html("");
        $('.sinusitisClass').html("");
        $('.hivClass').html("");
        $('.bloodpressure2Class').html("");
        $('.diabetesClass').html("");
        $('.asthmaClass').html("");
        $('.respiratoryproblemClass').html("");
        $('.takingmedicationsClass').html("");
        $('.medicationsyesClass').html("");
        $('.wearingcontactlensClass').html("");
        $('.otherallergiesClass').html("");
        $('.wearglassesClass').html("");
        $('.worncontactsClass').html("");
        $('.signedClass').html("");
        $('.contactlensyesClass').html("");
        $('.contactlenshoursClass').html("");
        $('.occupationClass').html("");
        $('.referredByClass').html("");
        $('.patientTypeClass').html("");
        $('.commentMedBpClass').html("");
        $('.commentMedDiabetesClass').html("");
        $('.hoursScreenDayClass').html("");
        $('.companyClass').html("");
        $('.jobDescriptionClass').html("");
        $('.firstTimeClass').html("");
        $('.ref_byClass').html("");
        $('.ins_companyClass').html("");
        $('.hear_about_dirClass').html("");
        $('.hear_othersClass').html("");
        $('.authorizationClass').html("");
        $('.assignmentClass').html("");
        $('.addedByClass').html("");
        $('.addDateClass').html("");
        $('.registrationTimeClass').html("");
        $('.howAddedClass').html("");
        $('.appointmentConfirmationClass').html("");
        $('.paymentConfirmationClass').html("");
        $('.appointmentCreationClass').html("");
        $('.meetingScheduleClass').html("");
        $('.mbIdClass').html("");
        $('.fmIdClass').html("");

        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function(response) {
            // Populate the form fields with the data returned from server
            $('.patientIdClass').append(response.patient.patient_id);
            $('.nameClass').append(response.patient.name);
            $('.firstnameClass').append(response.patient.first_name);
            $('.middlenameClass').append(response.patient.middle_name);
            $('.lastnameClass').append(response.patient.last_name);
            $('.emailClass').append(response.patient.email);
            $('.addressClass').append(response.patient.address);
            $('.phoneClass').append(response.patient.phone);
            $('.phone2Class').append(response.patient.phone2);
            $('.genderClass').append(response.patient.sex);
            $('.birthdateClass').append(response.patient.birthdate);
            $('.bloodgroupClass').append(response.patient.bloodgroup);
            $('.doctorClass').append(response.doctor.name);
            $('.locationClass').append(response.patient.location);
            $('.ageClass').append(response.age);
            $('.kin_nameClass').append(response.patient.e_contact);
            $('.kin_relationsClass').append(response.patient.e_contact_relation);
            $('.kin_phoneClass').append(response.patient.e_contact_phone);
            $('.kin_emailClass').append(response.patient.e_contact_email);
            $('.reason_examinationClass').append(response.patient.reason_examination);
            $('.physical_examinationClass').append(response.patient.physical_examination);
            $('.glaucomaClass').append(response.patient.glaucoma);
            $('.cataractsClass').append(response.patient.cataracts);
            $('.eyesurgeryClass').append(response.patient.eye_surgery);
            $('.lazyeyeClass').append(response.patient.lazy_eye);
            $('.lightflashesClass').append(response.patient.light_flashes);
            $('.eyeinjuryClass').append(response.patient.eye_injury);
            $('.floatersClass').append(response.patient.floaters);
            $('.thyroiddiseaseClass').append(response.patient.thyroid_disease);
            $('.sinusitisClass').append(response.patient.sinusitis);
            $('.hivClass').append(response.patient.hiv);
            $('.bloodpressure2Class').append(response.patient.blood_pressure2);
            $('.diabetesClass').append(response.patient.diabetes);
            $('.asthmaClass').append(response.patient.asthma);
            $('.respiratoryproblemClass').append(response.patient.respiratory_problem);
            $('.takingmedicationsClass').append(response.patient.taking_medications);
            $('.medicationsyesClass').append(response.patient.medications_yes);
            $('.wearingcontactlensClass').append(response.patient.wearing_contact_lens);
            $('.otherallergiesClass').append(response.patient.other_allergies);
            $('.wearglassesClass').append(response.patient.wear_glasses);
            $('.worncontactsClass').append(response.patient.worn_contacts);
            $('.contactlensyesClass').append(response.patient.contact_lens_yes);
            $('.contactlenshoursClass').append(response.patient.contact_lens_hours);
            $('.occupationClass').append(response.patient.occupation);
            $('.referredByClass').append(response.patient.referred_by);
            $('.patientTypeClass').append(response.patient.patient_type);
            $('.commentMedBpClass').append(response.patient.comment_med_bp);
            $('.commentMedDiabetesClass').append(response.patient.comment_med_diabetes);
            $('.hoursScreenDayClass').append(response.patient.hours_screen_day);
            $('.companyClass').append(response.patient.company);
            $('.jobDescriptionClass').append(response.patient.job_description);
            $('.firstTimeClass').append(response.patient.first_time);
            $('.ref_byClass').append(response.patient.ref_by);
            $('.ins_companyClass').append(response.patient.ins_company);
            $('.hear_about_dirClass').append(response.patient.hear_about_dir);
            $('.hear_othersClass').append(response.patient.hear_others);
            $('.authorizationClass').append(response.patient.authorization);
            $('.assignmentClass').append(response.patient.assignment);
            $('.addedByClass').append(response.patient.added_by);
            $('.addDateClass').append(response.patient.add_date);
            $('.registrationTimeClass').append(response.patient.registration_time);
            $('.howAddedClass').append(response.patient.how_added);
            $('.appointmentConfirmationClass').append(response.patient.appointment_confirmation);
            $('.paymentConfirmationClass').append(response.patient.payment_confirmation);
            $('.appointmentCreationClass').append(response.patient.appointment_creation);
            $('.meetingScheduleClass').append(response.patient.meeting_schedule);
            $('.mbIdClass').append(response.patient.mb_id);
            $('.fmIdClass').append(response.patient.fm_id);

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img1").attr("src", response.patient.img_url);
            }
            if (typeof response.patient.signature !== 'undefined' && response.patient.signature != '') {
                $(".signedClass").attr("src", response.patient.signature);
            }

            $('#infoModal').modal('show');
        });
    });
});

</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "patient/getPatient",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            
			buttons: [
			<?php if ($this->ion_auth->in_group(array('admin','Doctor'))) { ?>
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
				
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
				<?php } ?>
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 25,
            "order": [[0, "desc"]],

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
/*
$(document).ready(function() {
    let debounceTimeout; // This will be used to delay the AJAX call

    // Listen for the 'keyup' event on the email input field
    $('#email').on('keyup', function() {
        // Clear the previous timer
        clearTimeout(debounceTimeout);

        const emailInput = $(this);
        const submitButton = $('#submit_button');
        const errorContainer = $('#email_error');
        const email = emailInput.val().trim();

        // If the email field is empty, clear the error and enable the button
        if (email === "") {
            errorContainer.text('');
            submitButton.prop('disabled', false);
            return;
        }

        // Set a timer to run the check after 500ms of inactivity
        debounceTimeout = setTimeout(function() {
            $.ajax({
                url: './db/patient_check_email.php', // Path to your new PHP script
                type: 'POST',
                data: {
                    email: email
                },
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        // If the email exists, show an error and disable the submit button
                        errorContainer.text('This email address is already registered.');
                        submitButton.prop('disabled', true);
                    } else {
                        // If the email is available, clear the error and enable the submit button
                        errorContainer.text('');
                        submitButton.prop('disabled', false);
                    }
                },
                error: function() {
                    // Handle cases where the AJAX call itself fails
                    errorContainer.text('Could not verify email. Please check connection.');
                    submitButton.prop('disabled', true); // Disable submit on error as a precaution
                }
            });
        }, 500); // 500 millisecond delay
    });
});
*/
</script>


<script>
$(document).ready(function() {
    // Define the input fields to monitor
    const firstNameInput = $('#first_name');
    const middleNameInput = $('#middle_name');
    const lastNameInput = $('#last_name');
    const birthdateInput = $('#birthdate');
    const errorDiv = $('#duplicate_error');
    const submitButton = $('#submit_button');

    // Function to perform the AJAX check
    function checkPatientDuplicate() {
        const firstName = firstNameInput.val().trim();
        const middleName = middleNameInput.val().trim();
        const lastName = lastNameInput.val().trim();
        const birthdate = birthdateInput.val().trim();

        // Only run the check if the required fields have values
        if (firstName && lastName && birthdate) {
            $.ajax({
                url: './db/verify_patient_regex.php', // The path to your new PHP script
                type: 'POST',
                data: {
                    first_name: firstName,
                    middle_name: middleName,
                    last_name: lastName,
                    birthdate: birthdate
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'exists') {
                        // If patient exists, show error and disable submit button
                        errorDiv.text('A patient with this name and date of birth already exists.');
                        submitButton.prop('disabled', true);
                    } else {
                        // If patient does not exist, clear error and enable submit button
                        errorDiv.text('');
                        submitButton.prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    // Optional: Log errors to the console for debugging
                    console.error("AJAX Error: " + status + " - " + error);
                    errorDiv.text('Could not verify patient. Please try again.');
                    submitButton.prop('disabled', true); // Disable submission on error
                }
            });
        } else {
            // If required fields are not filled, ensure no error is shown
            errorDiv.text('');
            submitButton.prop('disabled', false);
        }
    }

    // Attach the event listener to all relevant fields
    // 'keyup' is for typing, 'change' is for when the date is selected
    firstNameInput.on('keyup', checkPatientDuplicate);
    middleNameInput.on('keyup', checkPatientDuplicate);
    lastNameInput.on('keyup', checkPatientDuplicate);
    birthdateInput.on('change', checkPatientDuplicate);
});
</script>


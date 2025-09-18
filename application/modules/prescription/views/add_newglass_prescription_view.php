<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column {
  flex: 50%;
  padding: 5px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 1px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.w3-input{padding:8px;display:block;border:none;border-bottom:1px solid #ccc;}
.w3-animate-input{transition:width 0.4s ease-in-out}
.w3-animate-input:focus{width:100%!important}

</style>

<!--sidebar end-->
<!--main content start-->


<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
    $doctordetails = $this->db->get_where('doctor', array('id' => $doctor_id))->row();
}
?>


<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-8">
            <header class="panel-heading">
                <?php
                if (!empty($prescription->id))
                    echo 'Edit Patient Prescription Information';//lang('edit_prescription');
                else
                    echo 'Add Patient Prescription Information';//lang('add_prescription');
                ?>
            </header>
            <div class="panel col-md-12">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="prescription/addNewPrescription" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="">
							
<table border='0' width="100%" cellpadding='0' cellspacing='0'>
<tr>	
<td>						
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                                    <select class="form-control m-bot15" id="patientchoose" name="patient" value='' size="10">
                                        <?php if (!empty($prescription->patient)) { ?>
                                            <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> - (<?php echo lang('id'); ?> : <?php echo $patients->id; ?>)</option>  
                                        <?php } ?>
                                        <?php
                                        if (!empty($setval)) {
                                            $patientdetails = $this->db->get_where('patient', array('id' => set_value('patient')))->row();
                                            ?>
                                            <option value="<?php echo $patientdetails->id; ?>" selected="selected"><?php echo $patientdetails->name; ?> - (<?php echo lang('id'); ?> : <?php echo $patientdetails->id; ?>)</option>
                                        <?php }
                                        ?>
                                    </select>
                             
</td>
<td>							
                                    <label for="exampleInputEmail1">Age</label>									                                        
									<?php
                                        if (!empty($setval)) {
                                            $patientage= $this->db->get_where('patient', array('id' => set_value('patient')))->row();
											$bday = new DateTime($patientdetails->birthdate); // Your date of birth
											$btoday = new Datetime(date('Y-m-d'));
											$diff = $btoday->diff($bday);
											
										//	printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
										//	$todate = date('Y-m-d');
										//	$bdate = $today - $patientage->birthdate;
                                        } ?>
										
                                    <input type="text"  class="w3-input" class="form-control" name="age" id="exampleInputAge" value='<?php echo $diff->y; ?>' placeholder="" >
</td>
<td>								
                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                    <input type="text"  class="form-control default-date-picker" name="date" id="exampleInputEmail1" value='<?php
                                    if (!empty($setval)) {
                                        echo set_value('date');
                                    }
                                    if (!empty($prescription->date)) {
                                        echo date('d-m-Y', $prescription->date);
                                    }
                                    ?>' placeholder="" readonly="">
</td>
</tr>
</table>	
<!--							
<div class="form-group col-md-12">
<table border='0' width="100%" cellpadding='0' cellspacing='0'>
<tr>
<td width="70%">
<table border='1' cellpadding='0' cellspacing='0'>
<tr><td>OLD RX</td><td colspan='10'></td></tr>
<tr>
<td><input type="text"  class="w3-input" size="5" name='oldrx' > </td>
<th>SPHERE</th>
<th>CYL</th>
<th>AXIS</th>
<th>PRISM</th>
<th>BASE</th>
<th>IPD</th>
<th>BASE CURVE</th>
<th>&nbsp;</th>
</tr>
<tr>
<td><b>R</b></td>
<td><input type="text" class="w3-input"size="5" name='oldrx_r_sphere' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_cyl' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_axis' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_prism' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_base' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_ipd' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_r_basecurve' ></td>
</tr>
<tr>
<td><b>L</b></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_sphere' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_cyl' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_axis' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_prism' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_base' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_ipd' ></td>
<td><input type="text"  class="w3-input" size="5" name='oldrx_l_basecurve' ></td>
</tr>
<tr>
<td></td>
<th>ADD</th>
<th colspan=2>SEG WIDTH</th>
<th colspan=3>LENS TYPE S.V BIF</th>
<th>TRIF PROG</th>
</tr>
<tr>
<td><b>R</b></td>
<td><input type="text"  class="w3-input" size="5" name='r_add' ></td>
<td colspan='2' rowspan='2'><textarea name="seg_width" cols='3' rows='2'> </textarea></td>
<td colspan='3' rowspan='2'><textarea name="lens_type_bif" cols='5' rows='5'> </textarea></td>
<td><input type="text"  class="w3-input" size="5" name='r_trif' ></td>
</tr>
<tr>
<td><b>L</b></td>
<td><input type="text"  class="w3-input" size="5" name='l_add' ></td>
<td><input type="text"  class="w3-input" size="5" name='l_trif' ></td>
</tr>
</table>
</td>
<td width="30%">
<table border='1' cellpadding='0' cellspacing='0'>
<tr>
<th><B>COLOR VISION</B></th>
<td>R<input type="text"  class="w3-input" size="5" name='r_colorvision' ><br>L<input type="text"  class="w3-input" size="5" name='l_colorvision' ></td>
</tr>
<tr>
<th>STEREOPSIS</B></th>
<td><input type="text"  class="w3-input" size="5" name='r_stereopsis' ><br><input type="text"  class="w3-input" size="5" name='l_stereopsis' ></td>
</tr>
<tr>
<th><B>AMSLER</B></th>
<td>R<input type="text"  class="w3-input" size="5" name='r_amsler' ><br>L<input type="text"  class="w3-input" size="5" name='l_amsler' ></td>
</tr>
<tr>
<th><B>NCT</B></th>
<td>R<input type="text"  class="w3-input" size="5" name='r_nct' ><br>L<input type="text"  class="w3-input" size="5" name='l_nct' ></td>
</tr>
<tr>
<td>Blood Pressure:</td><td> <input type="text"  class="w3-input" size="5" name='r_blood_pressure' ></td>
</tr>
<tr>
<td>Blood Glucose: </td><td><input type="text"  class="w3-input" size="5" name='r_blood_glucose' >

</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
<div class="form-group col-md-12">
<table border='0' width="100%" cellpadding='0' cellspacing='0'>
<tr>
<td>KERATOMETRY </td>
<td>R </td>
<td colspan='2'><input type="text"  class="w3-input" size="40" name='r_keratometry' > </td>
<td>L</td>
<td colspan='3'><input type="text"  class="w3-input" size="40" name='l_keratometry' > </td>
</tr>

<tr>
<td>Rx </td>
<td>R </td>
<td colspan='2'><input type="text"  class="w3-input" size="15" name='r_rx' > 20/ <input type="text"   size="2" name='r_rx_date' >  </td>
<td>L</td>
<td colspan='3'><input type="text"  class="w3-input" size="15" name='l_rx' > 20/<input type="text"   size="2" name='l_rx_date' > </td>
</tr>
</table>
</div>

<div class="form-group col-md-12">
<table border='0' width="100%" cellpadding='0' cellspacing='0'>
<tr>
<td>CYCLOPLEGIC RET </td>
<td>R </td>
<td colspan='2'><input type="text"  class="w3-input" size="30" name='r_cycloplegic' > </td>
<td>L</td>
<td colspan='3'><input type="text"  class="w3-input" size="30" name='l_cycloplegic' > </td>
</tr>

<tr>
<td></td>
<td></td>
<td colspan='2'><input type="text"  class="w3-input" size="30" name='r_cycloplegic_other' > </td>
<td></td>
<td colspan='3'><input type="text"  class="w3-input" size="30" name='l_cycloplegic_other' >  </td>
</tr>
</table>
</div>

<div class="form-group col-md-12">
<table border='1' width="100%" cellpadding='0' cellspacing='0'>
<tr>
<td>VERGENCY (BM) </td>
<td>POS</td>
<td><input type="text"  class="w3-input" size="3" name='ver_pos' ></td>
<td>NEG </td>
<td><input type="text"  class="w3-input" size="3" name='ver_neg' > </td>
<td>NEW RX </td>
<td colspan='7'><!--<input type="text"  class="w3-input" size="30" name='ver_newrx' >-->
<!--
</td>
</tr>
<tr>
<td colspan='5'>&nbsp; </td>
<td>&nbsp; </td>
<td>SPHERE</td>
<td>CYL</td>
<td>AXIS </td>
<td>PRISM </td>
<td>BASE</td>
<td>IPO</td>
<td>BASE CURVE</td>
</tr>
<tr>
<td>ADD </td>
<td colspan='4'></td>
<td>R</td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_sphere' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_cyl' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_axis' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_prism' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_base' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_ipo' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_r_base_curve' > </td>
</tr>
<tr>
<td colspan='5'></td>
<td>L</td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_sphere' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_cyl' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_axis' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_prism' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_base' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_ipo' > </td>
<td><input type="text"  class="w3-input" size="3" name='newrx_l_base_curve' > </td>
</tr>
<tr>
<td>HETERPHORIA (NEAR) </td>
<td colspan='4'></td>
<td></td>
<td>ADD </td>
<td colspan='2'>SEG WIDTH </td>
<td colspan='2'>LENS TYPE  S.V BIF </td>
<td></td>
<td>TRIF PROG </td>
</tr>
<tr>
<td colspan='5'></td>
<td>R</td>
<td><input type="text"  class="w3-input" size="3" name='r_heter_add' > </td>
<td rowspan='2' colspan='2'><input type="text"  class="w3-input" size="10" name='r_heter_seg_width' > </td>
<td rowspan='2' colspan='3'> GLASS <input type="text"  class="w3-input" size="30" name='r_heter_lens_type' > </td>
<td rowspan='2'>PLASTIC <input type="text"  class="w3-input" size="3" name='r_heter_plastic' > </td>
</tr>
<tr>
<td>VERGENCY (NEAR) </td>
<td>POS</td>
<td><input type="text"  class="w3-input" size="3" name='ver_near_pos' ></td>
<td>NEG </td>
<td><input type="text"  class="w3-input" size="3" name='ver_near_neg' > </td>
<td>L</td>
<td><input type="text"  class="w3-input" size="3" name='l_vergency_near' > </td>

</tr>
<tr>
<td colspan='5'></td>
<td>NEAR ONLY</td>
<td><input type="text"  class="w3-input" size="3" name='ver_near_only' ></td>
<td>DISTANCE </td>
<td><input type="text"  class="w3-input" size="3" name='ver_near_distance' ></td>
<td>FULLTIME </td>
<td><input type="text"  class="w3-input" size="3" name='l_vergency_fulltime' > </td>
<td>OTHER </td>
<td><input type="text"  class="w3-input" size="3" name='l_vergency_other' > </td>
</tr>

</table>
<p>
<h4>ADDITIONAL INFO/TEST:</h4>
</p>

<div class="row">
  <div class="column">
    <table>
<tr>
<td>
	<table>
      <tr>
        <th>MANUFACTURE</th>
        <th>TYPE</th>
        <th>SIZE</th>
        <th>COLOUR</th>
      </tr>
      <tr>
        <td><input type="text"  class="w3-input" size="10" name='info_manufacture_1' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_type_1' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_size_1' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_colour_1' ></td>
      </tr>    
       <tr>
        <td><input type="text"  class="w3-input" size="10" name='info_manufacture_2' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_type_2' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_size_2' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_colour_2' ></td>
      </tr>      
      <tr>
        <td><input type="text"  class="w3-input" size="10" name='info_manufacture_3' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_type_3' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_size_3' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_colour_3' ></td>
      </tr>     
      <tr>
        <td><input type="text"  class="w3-input" size="10" name='info_manufacture_4' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_type_4' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_size_4' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_colour_4' ></td>
      </tr>
      <tr>
        <td><input type="text"  class="w3-input" size="10" name='info_manufacture_5' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_type_5' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_size_5' ></td>
        <td><input type="text"  class="w3-input" size="6" name='info_colour_5' ></td>
      </tr>
   </table>   
 </td>
 </tr>
<tr>
<td>
	<table>
      <tr> 
      <td colspan="2">DOCTOR'S RECOMMENDATIONS</td>
      </tr> 
      <tr>
        <td>TINT</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_tint' ></td>
      </tr>
      <tr>
        <td>TRANSITION</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_transition' ></td>
      </tr> 
      <tr>
        <td>TRI INDEX</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_trindex' ></td>
      </tr>
      <tr>
        <td>ARC</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_arc' ></td>
      </tr>
      <tr>
        <td>SRC</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_src' ></td>
      </tr>      
      <tr>
        <td>UV COAT</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_uvcoat' ></td>
      </tr>
      <tr>
        <td>PROG</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_prog' ></td>
      </tr>
      <tr>
        <td>BIF</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_bif' ></td>
      </tr>
      <tr>
        <td>TRIF</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_trif' ></td>
      </tr>
      <tr>
        <td>POLY CARB</td>
        <td><input type="text"  class="w3-input" size="30" name='docrec_ploycarb' ></td>
      </tr>
    </table>
</td>
</tr>
         
    </table>
  </div>
  <div class="column">
    <table>
      <tr>
        <td>FRAME</td>
        <td><input type="text"  class="w3-input" size="30" name='info_frame' ></td>
      </tr>
      <tr>
        <td>LENS</td>
        <td><input type="text"  class="w3-input" size="30" name='info_lens' ></td>
      </tr>
      <tr>
        <td>CLR</td>
        <td><input type="text"  class="w3-input" size="30" name='info_clr' ></td>
      </tr>
      <tr>
        <td>POLY</td>
        <td><input type="text"  class="w3-input" size="30" name='info_poly' ></td>
      </tr>
      <tr>
        <td>TRI INDEX</td>
        <td><input type="text"  class="w3-input" size="30" name='info_trindex' ></td>
      </tr>
      <tr>
        <td>TINT</td>
        <td><input type="text"  class="w3-input" size="30" name='info_tint' ></td>
      </tr>
      <tr>
        <td>UV</td>
        <td><input type="text"  class="w3-input" size="30" name='info_uv' ></td>
      </tr>
       <tr>
        <td>TRANS</td>
        <td><input type="text"  class="w3-input" size="30" name='info_trans' ></td>
      </tr>       
      <tr>
        <td>ARC</td>
        <td><input type="text"  class="w3-input" size="30" name='info_arc' ></td>
      </tr> 
      <tr>
        <td>SRC</td>
        <td><input type="text"  class="w3-input" size="30" name='info_src' ></td>
      </tr>
      <tr>
        <td>OTHERS</td>
        <td><input type="text"  class="w3-input" size="30" name='info_others' ></td>
      </tr>
      <tr>
        <td>SUB TTL</td>
        <td><input type="text"  class="w3-input" size="30" name='info_subttl' ></td>
      </tr>
      <tr>
        <td>DISCOUNT</td>
        <td><input type="text"  class="w3-input" size="30" name='info_discount' ></td>
      </tr>
      <tr>
        <td>TOTAL</td>
        <td><input type="text"  class="w3-input" size="30" name='info_total' ></td>
      </tr>
      <tr>
        <td>PAID</td>
        <td><input type="text"  class="w3-input" size="30" name='info_paid' ></td>
      </tr>      
      <tr>
        <td>BALANCE</td>
        <td><input type="text"  class="w3-input" size="30" name='info_balance' ></td>
      </tr>

    </table>
  </div>
</div>
<p>&nbsp;</p>
<table border='1' width="100%" cellpadding='0' cellspacing='0'>
 <caption> <h3>ANTERIOR SEGMENT</h3></caption>
 <tr>
        <th>RIGHT</TH>
        <TH></TH>
        <TH style="float: right;">LEFT</TH>
</tr>
 		<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_LL_r' ></td>
        <td>L/L</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_LL_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_cornea_r' ></td>
        <td>CORNEA</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_cornea_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_bulbar_r' ></td>
        <td>BULBAR CONJ.</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_bulbar_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_suppal_r' ></td>
        <td>SUP PAL CONJ.</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_suppal_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_infpal_r' ></td>
        <td>INF PAL CONJ.</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_infpal_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_amtchamber_r' ></td>
        <td>AMT CHAMBER</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_amtchamber_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_iris_r' ></td>
        <td>IRIS</td>
        <td><input type="text"  class="w3-input" size="50" name='anterior_seg_iris_l' ></td>
      	</tr>        
      	<td><input type="text"  class="w3-input"  name='anterior_lens_r' ></td>
        <td>LENS</td>
        <td><input type="text"  class="w3-input" size="" name='anterior_seg_lens_l' ></td>
      	</tr>

</table>

<p>&nbsp;</p>
<table border='1' width="100%" cellpadding='0' cellspacing='0'>
<tr>
	<td>DPA ADMINISTERED</td>
	<td>TIME</td>
	<td>CONC</td>
	<td>QUANTITY</td>
	<td rowspan="5" colspan="2">
		APPLICATION 
		TONOMERTY <br>
		R <input type="text"  class="w3-input" size="5" name='ant_seg_app_ton_r' >&nbsp;&nbsp;
		TIME <input type="text"  class="w3-input" size="5" name='ant_seg_app_ton_time' >&nbsp;&nbsp;<br>
		L <input type="text"  class="w3-input" size="5" name='ant_seg_app_ton_r' >&nbsp;&nbsp;
		<input type="text"  class="w3-input" size="5" name='ant_seg_app_ton_time' >&nbsp;&nbsp;<br>
	</td>
	<td rowspan="5" colspan="2">BLOOD PRESSURE TIME <BR><input type="text"  class="w3-input" size="5" name='ant_seg_bloodpressure_time' > </td>
</tr>
<tr>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_dpa_admin_1' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_time_1' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_conc_1' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_qty_1' ></td>	
</tr>
<tr>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_dpa_admin_2' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_time_2' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_conc_2' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_qty_2' ></td>	
</tr>
<tr>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_dpa_admin_3' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_time_3' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_conc_3' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_qty_3' ></td>	
</tr>
<tr>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_dpa_admin_4' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_time_4' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_conc_4' ></td>
	<td><input type="text"  class="w3-input" size="10" name='ant_seg_qty_4' ></td>	
</tr>

</table>
<p>&nbsp;</p>
<table border='1' width="100%" cellpadding='0' cellspacing='0'>
 <caption> <h3>FUNDOSCOPY</h3></caption>
 		<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_cd_r' ></td>
        <td>C/D</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_cd_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_depth_r' ></td>
        <td>DEPTH</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_depth_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_margin_r' ></td>
        <td>MARGINS</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_margin_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_vessel_r' ></td>
        <td>VESSELS</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_vessel_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_crossing_r' ></td>
        <td>CROSSINGS</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_crossing_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_macula_r' ></td>
        <td>MACULA</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_macula_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_postpole_r' ></td>
        <td>POSTERIOR POLE</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_postpole_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_vitreous_r' ></td>
        <td>VITREOUS</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_vitreous_l' ></td>
      	</tr>
      	<tr>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_peri_r' ></td>
        <td>PERIPHERY</td>
        <td><input type="text"  class="w3-input" size="50" name='fundoscopy_peri_l' ></td>
      	</tr>

</table>
<input  type="hidden" name="pres_type" value="Glass Prescription"/>


</div>

                                  -->


                                <?php if (!$this->ion_auth->in_group('Doctor')) { ?>
                                    <div class="form-group col-md-4"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                                        <select class="form-control m-bot15" id="doctorchoose" name="doctor" value=''>
                                            <?php if (!empty($prescription->doctor)) { ?>
                                                <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>  
                                            <?php } ?>
                                            <?php
                                            if (!empty($setval)) {
                                                $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                ?>
                                                <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> -(<?php echo lang('id'); ?> : <?php echo $doctordetails1->id; ?>)</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-4"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                                        <?php if (!empty($prescription->doctor)) { ?>
                                            <select class="form-control m-bot15" name="doctor" value=''>
                                                <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>  
                                            </select>
                                        <?php } else { ?>
                                            <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>
                                                <?php if (!empty($prescription->doctor)) { ?>
                                                    <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctors->id; ?>)</option>  
                                                <?php } ?>
                                                <?php if (!empty($doctordetails)) { ?>
                                                    <option value="<?php echo $doctordetails->id; ?>" selected="selected"><?php echo $doctordetails->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>  
                                                <?php } ?>
                                                <?php
                                                if (!empty($setval)) {
                                                    $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                                    ?>
                                                    <option value="<?php echo $doctordetails1->id; ?>" selected="selected"><?php echo $doctordetails1->name; ?> - (<?php echo lang('id'); ?> : <?php echo $doctordetails->id; ?>)</option>
                                                <?php }
                                                ?>
                                            </select>
                                        <?php } ?>



                                    </div>
                                <?php } ?>

                             <!--   <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('history'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor1" name="symptom" value="" rows="50" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('symptom');
                                        }
                                        if (!empty($prescription->symptom)) {
                                            echo $prescription->symptom;
                                        }
                                        ?></textarea>
                                </div> -->



                             <!--   <div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('note'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor3" name="note" value="" rows="30" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('note');
                                        }
                                        if (!empty($prescription->note)) {
                                            echo $prescription->note;
                                        }
                                        ?></textarea>
                                </div>-->

                            <!--    <div class="form-group col-md-12 medicine_block">
                                    <label class="control-label col-md-3"> <?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9">
                                        <?php if (empty($prescription->medicine)) { ?>
                                            <select class="form-control m-bot15 medicinee"  id="my_select1_disabled" name="category" value=''>

                                            </select>
                                        <?php } else { ?>
                                            <select name="category"  class="form-control m-bot15 medicinee"  multiple="multiple" id="my_select1_disabled" >
                                                <?php
                                                if (!empty($prescription->medicine)) {

                                                    // $category_name = $payment->category_name;
                                                    $prescription_medicine = explode('###', $prescription->medicine);
                                                    foreach ($prescription_medicine as $key => $value) {
                                                        $prescription_medicine_extended = explode('***', $value);
                                                        $medicine = $this->medicine_model->getMedicineById($prescription_medicine_extended[0]);
                                                        ?>
                                                        <option value="<?php echo $medicine->id . '*' . $medicine->name; ?>"  <?php echo 'data-dosage="' . $prescription_medicine_extended[1] . '"' . 'data-frequency="' . $prescription_medicine_extended[2] . '"data-days="' . $prescription_medicine_extended[3] . '"data-instruction="' . $prescription_medicine_extended[4] . '"'; ?> selected="selected">
                                                            <?php echo $medicine->name; ?>
                                                        </option>                

                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                    </div>
                                </div>-->

                            <!--    <div class="form-group col-md-12 panel-body medicine_block">
                                    <label class="control-label col-md-3"><?php echo lang('medicine'); ?></label>
                                    <div class="col-md-9 medicine pull-right">

                                    </div>

                                </div>-->



                                <div class="form-group col-md-12">
                                    <label class="control-label"><?php echo lang('rx'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor3" name="advice" value="" rows="30" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('advice');
                                        }
                                        if (!empty($prescription->advice)) {
                                            echo $prescription->advice;
                                        }
                                        ?>
                                    </textarea>
                                </div>
								<div class="form-group col-md-6">
                                    <label class="control-label"><?php echo lang('patient_allergies'); ?></label>
                                    <textarea class="form-control ckeditor" id="editor1" name="note" value="" rows="50" cols="20"><?php
                                        if (!empty($setval)) {
                                            echo set_value('note');
                                        }
                                        if (!empty($prescription->note)) {
                                            echo $prescription->note;
                                        }
                                        ?></textarea>


                                <input type="hidden" name="admin" value='admin'>

                                <input type="hidden" name="id" value='<?php
                                if (!empty($prescription->id)) {
                                    echo $prescription->id;
                                }
                                ?>'>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </div>

                            <div class="col-md-5">

                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<style>

    form{
        border: 0px;
    }

    .med_selected{
        background: #fff;
        padding: 10px 0px;
        margin: 5px;
    }


    .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
        clear: both !important;
    }

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 500;
        font-weight: bold;
    }

    .medicine_block{
        background: #f1f2f7;
        padding: 50px !important;
    }


</style>


<script src="common/js/codearistos.min.js"></script>







<script type="text/javascript">
    $(document).ready(function () {
        //   $(".medicine").html("");
        var selected = $('#my_select1_disabled').find('option:selected');
        var unselected = $('#my_select1_disabled').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        $.each(unselected, function (index, value1) {
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                $('#med_selected_section-' + id).remove();
                // $('#removediv' + $(this).val() + '').remove();
                //this option was selected before

            }
        });

        /* $("select").on("select2:unselect", function (e) {
         var value = e.params.val();
         
         var res = value.split("*");
         // var unit_price = res[1];
         var id = res[0];
         $('#med_selected_section-' + id).remove();
         });
         */


        var count = 0;
        $.each($('select.medicinee option:selected'), function () {
            var value = $(this).val();
            var res = value.split("*");
            // var unit_price = res[1];
            var id = res[0];
            // var id = $(this).data('id');
            var med_id = res[0];
            var med_name = res[1];
            var dosage = $(this).data('dosage');
            var frequency = $(this).data('frequency');
            var days = $(this).data('days');
            var instruction = $(this).data('instruction');
            if ($('#med_id-' + id).length)
            {

            } else {

                $(".medicine").append('<section id="med_selected_section-' + med_id + '" class="med_selected row">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" id="med_id-' + id + '" class = "medi_div" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "' + dosage + '" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "' + frequency + '" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "' + days + '" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "' + instruction + '" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
            }
        });
    }
    );


</script> 





<script type="text/javascript">
    $(document).ready(function () {
        $('.medicinee').change(function () {
            //   $(".medicine").html("");
            var count = 0;


            var selected = $('#my_select1_disabled').find('option:selected');
            var unselected = $('#my_select1_disabled').find('option:not(:selected)');
            selected.attr('data-selected', '1');
            $.each(unselected, function (index, value1) {
                if ($(this).attr('data-selected') == '1') {
                    var value = $(this).val();
                    var res = value.split("*");
                    // var unit_price = res[1];
                    var id = res[0];
                    $('#med_selected_section-' + id).remove();
                    // $('#removediv' + $(this).val() + '').remove();
                    //this option was selected before

                }
            });

            $.each($('select.medicinee option:selected'), function () {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                // var id = $(this).data('id');
                var med_id = res[0];
                var med_name = res[1];


                if ($('#med_id-' + id).length)
                {

                } else {


                    $(".medicine").append('<section class="med_selected row" id="med_selected_section-' + med_id + '">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' + med_name + '" placeholder="" required>\n\
 <input type="hidden" class = "medi_div" id="med_id-' + id + '" name = "medicine[]" value = "' + med_id + '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' + count + '" name = "frequency[]" value = "" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "days[]" value = "" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n\<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' + count + '" name = "instruction[]" value = "" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>');
                }
            });
        });
    });


</script> 
<script>
    $(document).ready(function () {

        $("#patientchoose").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        $("#doctorchoose").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorinfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
        $("#doctorchoose1").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorInfo',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });



    });
</script>

<script>
    $(document).ready(function () {
        // $(".flashmessage").delay(3000).fadeOut(100);
        // $("#my_select10").select2();
        $('#my_select1').select2({
            multiple: true,
            placeholder: '<?php echo lang('medicine'); ?>',
            allowClear: true,
            closeOnSelect: true,
            ajax: {
                url: 'medicine/getMedicinenamelist',
                dataType: 'json',
                type: "post",
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        newTag: true,
                        pagination: {
                            more: (params.page * 1) < data.total_count
                        }
                    };
                },
                cache: true
            },
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#my_select1_disabled").select2({
            placeholder: '<?php echo lang('medicine'); ?>',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'medicine/getMedicineListForSelect2',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }

        });
    });</script>
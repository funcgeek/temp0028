<script type="text/javascript">
function addRows(){ 
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);
	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
		if(i == 3){ 
			var radioinput = document.getElementById('col3').getElementsByTagName('input'); 
			for(var j = 0; j <= radioinput.length; j++) { 
				if(radioinput[j].type == 'radio') { 
					var rownum = rowCount;
					radioinput[j].name = 'gender['+rownum+']';
				}
			}
		}
	}
}
function deleteRows(){
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}
}
</script>

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id))
                    echo lang('edit_payment');
                else
                    echo 'Collect New Payment';//lang('add_new_payment');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <!--  <div class="col-lg-12"> -->
                        <div class="">
                           <!--   <section class="panel"> -->
                            <section class="">
                                <!--   <div class="panel-body"> -->
                                <div class="">
                                    <style> 
                                        .payment{
                                            padding-top: 10px;
                                            padding-bottom: 0px;
                                            border: none;

                                        }
                                        .pad_bot{
                                            padding-bottom: 5px;
                                        }  

                                        form{
                                            background: #f1f1f1;
                                            padding: 15px 0px;
                                        }

                                        .modal-body form{
                                            background: #fff;
                                            padding: 21px;
                                        }

                                        .remove{
                                            width: 20%;
                                            float: right;
                                            margin-bottom: 10px;
                                            padding: 1px;
                                            height: 39px;
                                            text-align: center;
                                            border-bottom: 1px solid #f1f1f1;
                                        }

                                        .remove1{
                                            width: 80%;
                                            float: left;
                                            margin-bottom: 10px;
                                            border-bottom: 1px solid #f1f1f1;
                                        }

                                        form input {
                                            border: none;
                                        }

                                        .pos_box_title{
                                            border: none;
                                        }

                                        .payment_label {
                                            text-align: left;
                                        }

                                    </style>

                                    <form role="form" id="editPaymentForm" class="clearfix" action="finance/addPayment" method="post" enctype="multipart/form-data">

                                        <div class="col-md-5 row">
                                            <!--
                                            <div class="pull-right">
                                                <a data-toggle="modal" href="#myModal">
                                                    <div class="btn-group">
                                                        <button id="" class="btn green">
                                                            <i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?>
                                                        </button>
                                                    </div>
                                                </a>
                                            </div>
                                            -->

                                            <!--
                                            <div class="col-md-8 payment pad_bot">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('date'); ?> </label>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <input type="text" class="form-control  default-date-picker" name="date" id="" value='<?php
                                            if (!empty($payment->date)) {
                                                echo date('d-m-Y');
                                            } else {
                                                echo date('d-m-Y');
                                            }
                                            ?>' placeholder=" ">
                                                </div>

                                            </div>
                                            -->

                                            <div class="col-md-12 payment pad_bot">
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                                <select required class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                    <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                                                    <?php foreach ($patients as $patient) { ?>
                                                        <option value="<?php echo $patient->id; ?>" <?php
                                                        if (!empty($payment->patient)) {
                                                            if ($payment->patient == $patient->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> ><?php echo $patient->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div> 


                                            <div class="pos_client">
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                                    if (!empty($payment->p_name)) {
                                                        echo $payment->p_name;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_email" value='<?php
                                                    if (!empty($payment->p_email)) {
                                                        echo $payment->p_email;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_phone" value='<?php
                                                    if (!empty($payment->p_phone)) {
                                                        echo $payment->p_phone;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="p_age" value='<?php
                                                    if (!empty($payment->p_age)) {
                                                        echo $payment->p_age;
                                                    }
                                                    ?>' placeholder="">
                                                </div> 
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                                    <select class="form-control m-bot15" name="p_gender" value=''>

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

                                            <div class="col-md-12 payment pad_bot">
                                                <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label>
                                                <select class="form-control m-bot15 js-example-basic-single add_doctor" id="add_doctor" name="doctor" value='' required>  
                                                    <option value=""><?php echo lang('select'); ?></option>
                                                    <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
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

                                            <div class="pos_doctor">
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                                    if (!empty($payment->p_name)) {
                                                        echo $payment->p_name;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot">
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                                    if (!empty($payment->p_email)) {
                                                        echo $payment->p_email;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                                <div class="col-md-6 payment pad_bot"> 
                                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                                    <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                                    if (!empty($payment->p_phone)) {
                                                        echo $payment->p_phone;
                                                    }
                                                    ?>' placeholder="">
                                                </div>
                                            </div>



                                            <div class="col-md-12 payment">
                                                <div class="form-group last"> 
                                                    <label for="exampleInputEmail1"> <?php echo 'Select Services';//;lang('select'); ?></label>
                                                    <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" data-idd="<?php echo $category->id; ?>" data-cat_name="<?php echo $category->category; ?>" value="<?php echo $category->category; ?>" 

                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'data-qtity=' . $category_name3[3];
                                                                            }
                                                                        }
                                                                    }  ?>


                                                                    <?php
                                                                    if (!empty($payment->category_name)) {
                                                                        $category_name = $payment->category_name;
                                                                        $category_name1 = explode(',', $category_name);
                                                                        foreach ($category_name1 as $category_name2) {
                                                                            $category_name3 = explode('*', $category_name2);
                                                                            if ($category_name3[0] == $category->id) {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>><?php echo $category->category; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
 <!-- Glass Frames - ->
 <div class="form-group last">
                                        <div class="col-md-6 payment_label row"> 
                                            <label for="exampleInputEmail1"> <?php echo 'Select Frames';//;lang('select_item'); ?></label>
                                        </div>
                                        <div class="col-md-9 row">
                                            <?php if (empty($payment->id)) { ?>
                                                <select name="category_name[]" class="multi-select1" id="my_multi_select4" >

                                                </select>
                                            <?php } else { ?>
                                                <select name="category_name[]"  class="multi-select1"  multiple="multiple" id="my_multi_select4" >
                                                    <?php
                                                    if (!empty($payment)) {

                                                        $category_name0 = $payment->category_name;
                                                        $category_name10 = explode(',', $category_name0);
                                                        foreach ($category_name10 as $category_name20) {
                                                            $category_name30 = explode('*', $category_name20);
                                                            $medicine = $this->medicine_model->getMedicineById($category_name30[0]);
                                                            ?>
                                                            <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company. '*' . $medicine->box; ?>" data-qtity="<?php echo $category_name30[2]; ?>" selected="selected">
                                                                <?php echo $medicine->name; ?>
                                                            </option>                

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div> 
                                    </div>

<!- - end frames -->
                                        </div>


                                        <div class="col-md-4">


                                            <div class="col-md-12 qfloww">

                                                <label class=" col-md-10 pull-left remove1"><?php echo lang('items') ?></label>
												<label class="pull-right col-md-2 remove"><?php echo lang('qty'); ?></label>


                                            </div>
											<p>
										<!--	<div class="col-md-12 qfloww2">
											<label class=" col-md-10 pull-left "><?php echo 'Frames'; ?></label>
												<label class="pull-right col-md-2 "><?php echo lang('qty'); ?></label>
											</div>-->

                                        </div>
										



                                        <div class="col-md-3">
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('sub_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                    if (!empty($payment->amount)) {

                                                        echo $payment->amount;
                                                    }
                                                    ?>'>
                                                </div>

                                            </div>

											<?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('discount'); ?>  <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
												
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                            </div>
											<?php } else {?>
											<div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('discount'); ?>  <?php
                                                        if ($discount_type == 'percentage') {
                                                            echo ' (%)';
                                                        }
                                                        ?> </label>
                                                </div>
												
                                                <div class=""> 
                                                    <input type="text" readonly class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                    if (!empty($payment->discount)) {
                                                        $discount = explode('*', $payment->discount);
                                                        echo $discount[0];
                                                    }
                                                    ?>' placeholder="">
                                                </div>

                                            </div>
											<?php } ?>

                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('gross_total'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                    if (!empty($payment->gross_total)) {

                                                        echo $payment->gross_total;
                                                    }
                                                    ?>' placeholder=" " disabled>
                                                </div>

                                            </div>





                                            <div class="col-md-12 payment right-six">
                                                <div class="payment_label"> 
                                                    <label for="exampleInputEmail1"><?php echo lang('note'); ?> </label>
                                                </div>
                                                <div class=""> 
                                                    <input type="text" class="form-control pay_in" name="remarks" id="" value='<?php
                                                    if (!empty($payment->remarks)) {

                                                        echo $payment->remarks;
                                                    }
                                                    ?>' placeholder=" ">
                                                </div>

                                            </div>  

                                            <div class="col-md-12 payment right-six">



	<table id="emptbl" cellspacing='0' cellpadding='0'>
		<tr>
			<th><?php echo lang('deposited_amount'); ?></th>
			<th style="float:right;">Payment Type</th>
		</tr> 
		<tr> 
			<td id="col0">
			
			<input type="text" size='12' class="form-control form-control-lg" style="border: 1;" name="amount_received[]"  id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {
                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" ">
												   
			</td> 
			<td id="col1"> 
									<?php if (empty($payment->id)) { ?>                 
                                                        <select id="selecttype" name="deposit_type[]" style="width: 100px;"> 
                                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist','Nurse'))) { ?>
                                                                <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                                <option value="No Charge"> <?php echo 'No Charge';//lang('cash'); ?> </option>
                                                                <option value="Insurance"> <?php echo 'Insurance';//lang('cash'); ?> </option>
                                                                <option value="Pay Next Visit"> <?php echo 'Pay Next Visit';//lang('cash'); ?> </option>
                                                                <option value="Card"> <?php echo lang('card'); ?> </option>
                                                                <option value="Other/Balance Due"> <?php echo 'Other | Balance Due';//echo lang('card'); ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                   
                                                    <?php
                                                    $payment_gateway = $settings->payment_gateway;
                                                    ?>
                                                 
                                            <?php }  ?>
                                            <?php
                                            if (!empty($payment)) {
                                                $deposits = $this->finance_model->getDepositByPaymentId($payment->id);
                                                $i = 1;
                                                foreach ($deposits as $deposit) {

                                                    if (empty($deposit->amount_received_id)) {
                                                        $i = $i + 1;
                                                        ?>
                                                        <div class="col-md-12 payment right-six">
                                                            <div class="payment_label"> 
                                                                <label for="exampleInputEmail1"><?php echo lang('deposit'); ?> <?php
                                                                    echo $i . '<br>';
                                                                    echo date('d/m/Y', $deposit->date);
                                                                    ?> 
                                                                </label>
                                                            </div>
                                                            <div class=""> 
                                                                <input type="text" class="form-control pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>'>
                                                                <input type="hidden" class="form-control pay_in" name="deposit_edit_id[]" id="amount_received" value='<?php echo $deposit->id; ?>' placeholder=" ">
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>											
		        </td> 
		</tr>  
	</table> 

	<table cellspacing='0' cellpadding='0'>
		<tr> 
			<td>
			<font color="green">
			<!--<input type="button" class="btn btn-success" value="+" onclick="addRows()"  /> -->
			<a  role="button"  onclick="addRows()"><span class="glyphicon glyphicon-plus-sign" style="color:green; font-size: 20px;"></span></a>
			</font>
			</td> 
			<td>
			<font color="red">
			<!--<input type="button" value="Delete Row" onclick="deleteRows()" /> -->
			<a class="" role="button"  onclick="deleteRows()"><span class="glyphicon glyphicon-minus-sign" style="color:red; font-size: 20px;"></span></a>
			</font>
			</td>  
			<td><b>Payment Type</b></td>
		</tr>  
	</table> 



                                            </div>





                                            <?php /* if (empty($payment->id)) { ?>
                                                <div class="col-md-12 payment right-six">
                                                    <div class="payment_label"> 
                                                        <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                                    </div>
                                                    <div class=""> 
                                                        <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''> 
                                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist','Nurse'))) { ?>
                                                                <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                                                <option value="No_Charge"> <?php echo 'No Charge';//lang('cash'); ?> </option>
                                                                <option value="Insurance"> <?php echo 'Insurance';//lang('cash'); ?> </option>
                                                                <option value="Pay Next Visit"> <?php echo 'Pay Next Visit';//lang('cash'); ?> </option>
                                                                <option value="Card"> <?php echo lang('card'); ?> </option>
                                                                <option value="Other/Balance Due"> <?php echo 'Other | Balance Due';//echo lang('card'); ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <?php
                                                    $payment_gateway = $settings->payment_gateway;
                                                    ?>
                                                </div> 
                                            <?php }  */?>



                                            <div class="form-group cashsubmit payment  right-six col-md-12">
                                                <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                                            </div>
                                            <div class="form-group cardsubmit  right-six col-md-12 hidden">
                                                <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right" <?php /* if ($settings->payment_gateway == 'Stripe') {
                                                ?>onClick="stripePay(event);"<?php }*/
                                            ?>> <?php echo lang('submit'); ?></button>
                                            </div>


                                        </div>

   
                                      <!--  <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                              <label for="exampleInputEmail1">G.C.T (%)</label>
                                            </div>
                                            <div class="col-md-9"> 
                                              <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        }
                                        ?>' placeholder="%">
                                            </div>
                                        </div>
                                       -->

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($payment->id)) {
                                            echo $payment->id;
                                        }
                                        ?>'>
                                        <div class="row">
                                        </div>
                                        <div class="form-group">
                                        </div>

                                </div>
                                </form>





                        </div>
                        </section>
                    </div>
                </div>
            </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<!--<script src="common/js/ajaxrequest-codearistos.min.js"></script> -->


<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Patient Registration</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew?redirect=payment" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>

                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->



<script type="text/javascript">
    $(document).ready(function () {
  
	$('#selecttype').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var $paytype = $(this).find('option:selected');
    //Added with the EDIT
    var payment_type = $paytype.val();//to get content of "value" attrib
    //var text = $option.text();//to get <option>Text</option> content
    //alert(value);
});	



if (payment_type = 'Cash' || payment_type = 'Insurance' || payment_type = 'Card' || payment_type = 'Other/Balance Due' ){	

function addRows(){ 
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);

	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
		if(i == 3){ 
			var radioinput = document.getElementById('col3').getElementsByTagName('input'); 
			for(var j = 0; j <= radioinput.length; j++) { 
				if(radioinput[j].type == 'radio') { 
					var rownum = rowCount;
					radioinput[j].name = 'gender['+rownum+']';
				}
			}
		}
	}
}
	
}

function deleteRows(){
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}
}
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
        $('.pos_doctor').hide();
        $(document.body).on('change', '#add_doctor', function () {

            var v = $("select.add_doctor option:selected").val()
            if (v == 'add_new') {
                $('.pos_doctor').show();
            } else {
                $('.pos_doctor').hide();
            }
        });

    });


</script>


<script>
    $(document).ready(function () {
        $("#pos_select").select2({
            placeholder: '<?php echo lang('select_patient'); ?>',
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfoWithAddNewOption',
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

        $("#add_doctor").select2({
            placeholder: '<?php echo lang('select_doctor'); ?>',
            allowClear: true,
            ajax: {
                url: 'doctor/getDoctorWithAddNewOption',
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
        $("#my_multi_select4").select2({
            placeholder: '<?php echo lang('medicine'); ?>',
            multiple: true,
            allowClear: true,
            ajax: {
                url: 'medicine/getMedicineForPharmacyMedicine',
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

function getArraySum(a){
    var total=0;
    for(var i in a) { 
        total += a[i];
    }
    return total;
}

/*
var payChecks = [1,1,1]; 
var weeklyPay= getArraySum(payChecks); //sums up to 722
alert(weeklyPay);

*/


 var tot = 0;
    $(document).ready(function () {
      //  var tot = 0;
        var selected = $('#my_multi_select4').find('option:selected');
        var unselected = $('#my_multi_select4').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        $.each(unselected, function (index, value1) {
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");
                // var unit_price = res[1];
                var id = res[0];
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();
                // $('#removediv' + $(this).val() + '').remove();
                //this option was selected before

            }
        });

        $.each($('select.multi-select1 option:selected'), function () {
            var value = $(this).val();
            var res = value.split("*");
            var unit_price = res[1];
            var id = res[0];
            var qtity = $(this).data('qtity');
            if ($('#idinput-' + id).length)
            {

            } else {
                if ($('#id-div' + id).length)
                {

                } else {

                    $("#editPaymentForm .qfloww2").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity: <div></div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww2');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'medicine_id[]',
                    value: id,
                }).appendTo('#editPaymentForm .qfloww2');
            }
            $(document).ready(function () {
                $('#idinput-' + id).keyup(function () {
                    var qty = 0;
                    var total1 = 0;
                    $.each($('select.multi-select1 option:selected'), function () {
                        var value = $(this).val();
                        var res = value.split("*");
                        // var unit_price = res[1];
                        var id1 = res[0];
                        qty = $('#idinput-' + id1).val();
                        var ekokk1 = res[1];
                        total1 = total1 + qty * ekokk1;
                    });
                    tot = total1;
                    var discount1 = $('#dis_id').val();
                    var gross = tot - discount1;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)
                });
            });
            var curr_val = res[1] * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        var discount1 = $('#dis_id').val();
        var gross = tot - discount1;
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
        $('#editPaymentForm').find('[name="grsss"]').val(gross)
        //  });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

    $(document).ready(function () {
        $('.multi-select1').change(function () {
           // var tot = 0;
            var selected = $('#my_multi_select4').find('option:selected');
            var unselected = $('#my_multi_select4').find('option:not(:selected)');
            selected.attr('data-selected', '1');
            $.each(unselected, function (index, value1) {
                if ($(this).attr('data-selected') == '1') {
                    var value = $(this).val();
                    var res = value.split("*");
                    // var unit_price = res[1];
                    var id = res[0];
                    $('#id-div' + id).remove();
                    $('#idinput-' + id).remove();
                    $('#mediidinput-' + id).remove();
                    // $('#removediv' + $(this).val() + '').remove();
                    //this option was selected before

                }
            });
            $.each($('select.multi-select1 option:selected'), function () {
                var value = $(this).val();
                var res = value.split("*");
                var unit_price = res[1];
                var id = res[0];
                if ($('#idinput-' + id).length)
                {

                } else {
                    if ($('#id-div' + id).length)
                    {

                    } else {

                        $("#editPaymentForm .qfloww2").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div></div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww2');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'medicine_id[]',
                        value: id,
                    }).appendTo('#editPaymentForm .qfloww2');
                }

                $(document).ready(function () {
                    $('#idinput-' + id).keyup(function () {
                        var qty = 0;
                        var total2 = 0;
                        $.each($('select.multi-select1 option:selected'), function () {
                            var value = $(this).val();
                            var res = value.split("*");
                            // var unit_price = res[1];
                            var id1 = res[0];
                            qty = $('#idinput-' + id1).val();
                            var ekokk = res[1];
                            total2 = total2 + qty * ekokk;
                        });

                        tot = total2;

                        var discount2 = $('#dis_id').val();
                        var gross = tot - discount2;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)
                    });
                });
                var curr_val = res[1] * $('#idinput-' + id).val();
                tot = tot + curr_val;
            });
            var discount2 = $('#dis_id').val();
            var gross = tot - discount2;
            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        });
    });
    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php if ($discount_type == 'percentage') { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
<?php if ($discount_type == 'flat') { ?>
                ggggg = amount - val_dis;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });


                                                    $(document).ready(function () {

                                                        var tot = 0;
                                                        //  $(".qfloww").html("");
                                                        $(".ms-selected").click(function () {
                                                            var idd = $(this).data('idd');
                                                            $('#id-div' + idd).remove();
                                                            $('#idinput-' + idd).remove();
                                                            $('#categoryinput-' + idd).remove();

                                                        });
                                                        $.each($('select.multi-select option:selected'), function () {
                                                            var curr_val = $(this).data('id');
                                                            var idd = $(this).data('idd');
                                                            var qtity = $(this).data('qtity');
                                                            //  tot = tot + curr_val;
                                                            var cat_name = $(this).data('cat_name');
                                                            if ($('#idinput-' + idd).length)
                                                            {

                                                            } else {
                                                                if ($('#id-div' + idd).length)
                                                                {

                                                                } else {
                                                                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div>')
                                                                }


                                                                var input2 = $('<input>').attr({
                                                                    type: 'text',
                                                                    class: "remove",
                                                                    id: 'idinput-' + idd,
                                                                    name: 'quantity[]',
                                                                    value: qtity,
                                                                }).appendTo('#editPaymentForm .qfloww');

                                                                $('<input>').attr({
                                                                    type: 'hidden',
                                                                    class: "remove",
                                                                    id: 'categoryinput-' + idd,
                                                                    name: 'category_id[]',
                                                                    value: idd,
                                                                }).appendTo('#editPaymentForm .qfloww');
                                                            }


                                                            $(document).ready(function () {
                                                                $('#idinput-' + idd).keyup(function () {
                                                                    var qty = 0;
                                                                    var total = 0;
                                                                    $.each($('select.multi-select option:selected'), function () {
                                                                        var id1 = $(this).data('idd');
                                                                        qty = $('#idinput-' + id1).val();
                                                                        var ekokk = $(this).data('id');
                                                                        total = total + qty * ekokk;
                                                                    });

                                                                    tot = total;

                                                                    var discount = $('#dis_id').val();
                                                                    var gross = tot - discount;
                                                                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                                                                    $('#editPaymentForm').find('[name="grsss"]').val(gross)

/*
const arr = [10, 20, 30, 40];
let result = 0;
arr.forEach(number => {
  result += number;
})
alert(result);
*/




                                                                    var amount_received0 = $('#amount_received').val();
																	var amount_received1 = getArraySum(amount_received0); //sums up to 722
																	//alert(weeklyPay);
                                                                    var change = amount_received1 - gross;
                                                                    $('#editPaymentForm').find('[name="change"]').val(change).end()


                                                                });
                                                            });
                                                            var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
                                                            tot = tot + sub_total;


                                                        });

                                                        var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

                                                            var gross = tot - discount;

<?php } else { ?>

                                                            var gross = tot - tot * discount / 100;

<?php } ?>

                                                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

                                                        $('#editPaymentForm').find('[name="grsss"]').val(gross)

                                                        var amount_received0 = $('#amount_received').val();
														var amount_received1 = getArraySum(amount_received0); //sums up to 722
														
                                                        //var amount_received = $('#amount_received').val();
                                                        var change = amount_received1 - gross;
                                                        $('#editPaymentForm').find('[name="change"]').val(change).end()

                                                    }

                                                    );




                                                    $(document).ready(function () {
                                                        $('#dis_id').keyup(function () {
                                                            var val_dis = 0;
                                                            var amount = 0;
                                                            var ggggg = 0;
                                                            amount = $('#subtotal').val();
                                                            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                                                                ggggg = amount - val_dis;
<?php } else { ?>
                                                                ggggg = amount - amount * val_dis / 100;
<?php } ?>
                                                            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)

                                                        var amount_received0 = $('#amount_received').val();
														var amount_received1 = getArraySum(amount_received0); //sums up to 722
														

                                                            //var amount_received = $('#amount_received').val();
                                                            var change = amount_received1 - ggggg;
                                                            $('#editPaymentForm').find('[name="change"]').val(change).end()

                                                        });
                                                    });


    $(document).ready(function () {

        $('.multi-select').change(function () {
            var tot = 0;
            //  $(".qfloww").html("");
            $(".ms-selected").click(function () {
                var idd = $(this).data('idd');
                $('#id-div' + idd).remove();
                $('#idinput-' + idd).remove();
                $('#categoryinput-' + idd).remove();

            });
            $.each($('select.multi-select option:selected'), function () {
                var curr_val = $(this).data('id');
                var idd = $(this).data('idd');
                //  tot = tot + curr_val;
                var cat_name = $(this).data('cat_name');
                if ($('#idinput-' + idd).length)
                {

                } else {
                    if ($('#id-div' + idd).length)
                    {

                    } else {
                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '- <?php echo $settings->currency; ?> ' + $(this).data('id') + '</div>')
                    }


                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + idd,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'categoryinput-' + idd,
                        name: 'category_id[]',
                        value: idd,
                    }).appendTo('#editPaymentForm .qfloww');
                }


                $(document).ready(function () {
                    $('#idinput-' + idd).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select option:selected'), function () {
                            var id1 = $(this).data('idd');
                            qty = $('#idinput-' + id1).val();
                            var ekokk = $(this).data('id');
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        var discount = $('#dis_id').val();
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)


 		                var amount_received0 = $('#amount_received').val();
						var amount_received1 = getArraySum(amount_received0); //sums up to 722

						//var amount_received = $('#amount_received').val();
                        var change = amount_received1 - gross;
                        $('#editPaymentForm').find('[name="change"]').val(change).end()


                    });
                });
                var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
                tot = tot + sub_total;


            });

            var discount = $('#dis_id').val();

<?php
if ($discount_type == 'flat') {
    ?>

                var gross = tot - discount;

<?php } else { ?>

                var gross = tot - tot * discount / 100;

<?php } ?>

            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()

            $('#editPaymentForm').find('[name="grsss"]').val(gross)


 		    var amount_received0 = $('#amount_received').val();
			var amount_received1 = getArraySum(amount_received0); //sums up to 722
			
            //var amount_received = $('#amount_received').val();
            var change = amount_received1 - gross;
            $('#editPaymentForm').find('[name="change"]').val(change).end()


        }

        );
    });

    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php
if ($discount_type == 'flat') {
    ?>
                ggggg = amount - val_dis;
<?php } else { ?>
                ggggg = amount - amount * val_dis / 100;
<?php } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)


		    var amount_received0 = $('#amount_received').val();
			var amount_received1 = getArraySum(amount_received0); //sums up to 722
			
            //var amount_received = $('#amount_received').val();
            var change = amount_received1 - ggggg;
            $('#editPaymentForm').find('[name="change"]').val(change).end()





        });
    });

</script> 



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    echo lang('pharmacy') . ' ' . lang('edit_payment');
                else
                    echo lang('pharmacy') . ' ' . lang('poss');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
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
										border: 1px solid #ccc;
										background: transparent;
											}
										
										.pos{
										padding-left:0px;
											}
                            
										.form-control{
										font-size: 14px;
										font-weight: 600;
										box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
											}

                                        .modal-body form{
                                            background: #fff;
                                            padding: 21px;
                                        }

                                        .remove{
                                            width: 20%;
                                            float: right;
                                            margin-bottom: 10px;
                                            padding: 10px;
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
							#HIDDENDIV {
								display: none;
							}

							#table td {
								padding: 1em;
								border: 1px solid black;
							}


							#table.show tr > *:nth-child(2) {
								display: block;
							}
                                    </style>
                        <form role="form" class="clearfix pos form1"  id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                            <div class="col-md-6 row">     
                                <?php if (!empty($payment->id)) { ?>
                                    <div class="col-md-8 payment pad_bot">
                                        <div class="col-md-3 payment_label"> 
                                            <label for="exampleInputEmail1">  <?php echo lang('invoice_id'); ?> :</label>
                                        </div>
                                        <div class="col-md-6">                                                   
                                            <?php echo '00' . $payment->id; ?>                                                                                                       
                                        </div>                                              
                                    </div>                                           
                                <?php } ?>
								
								<div class="col-md-12 payment pad_bot">
                                             <!--   <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
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
                                                        ?> ><?php echo $patient->name;
															$patient_name = $patient->name;
														?> </option>
                                                            <?php } ?>
                                                </select>-->
												
									<div class="col-md-12 payment pad_bot panel">
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                                <h4>  <?php echo $patient->name; ?></h4>
                                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                                <h4>  <?php echo $patient->id; ?></h4>
                                                <input type="hidden" name="patient" value="<?php echo $patient->id; ?>">
                                            </div> 
											
                                </div> 								
								
                                <div class="col-md-8 payment">
                                    <div class="form-group last">
                                        <div class="col-md-6 payment_label row"> 
                                            <label for="exampleInputEmail1"> <?php echo lang('select_item'); ?></label>
                                        </div>
                                        <div class="col-md-9 row">
                                            <?php if (empty($payment->id)) { ?>
                                                <select name="category_name[]" class="multi-select1" id="my_multi_select4" >

                                                </select>
                                            <?php } else { ?>
                                                <select name="category_name[]"  class="multi-select1"  multiple="multiple" id="my_multi_select4" >
                                                    <?php
                                                    if (!empty($payment)) {

                                                        $category_name = $payment->category_name;
                                                        $category_name1 = explode(',', $category_name);
                                                        foreach ($category_name1 as $category_name2) {
                                                            $category_name3 = explode('*', $category_name2);
                                                            $medicine = $this->medicine_model->getMedicineById($category_name3[0]);
                                                            ?>
                                                            <option value="<?php echo $medicine->id . '*' . (float) $medicine->s_price . '*' . $medicine->name . '*' . $medicine->company. '*' . $medicine->box; ?>" data-qtity="<?php echo $category_name3[2]; ?>" selected="selected">
                                                                <?php echo $medicine->name; 
																$med_name = $medicine->name; 
																?>
                                                            </option>                

                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 qfloww">
							<p class="title"><?php echo lang('selected_items'); ?></p></div>
                            <div class="col-md-4 right-six">
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('sub_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                        if (!empty($payment->amount)) {

                                            echo $payment->amount;
                                        }
                                        ?>' placeholder=" " disabled>
                                    </div>

                                </div>
								<?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                            if ($discount_type == 'percentage') {
                                                echo ' (%)';
                                            }
                                            ?> </label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="number" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                        if (!empty($payment->discount)) {
                                            $discount = explode('*', $payment->discount);
                                            echo $discount[0];
                                        }
                                        ?>' placeholder="Discount">
                                    </div>
                                </div>
								<?php } else {?>
								<div class="col-md-12 payment right-six" id="table2" > 
								<div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                            if ($discount_type == 'percentage') {
                                                echo ' (%)';
                                            }
                                            ?> </label>
                                    </div>							 
                                    <div class="col-md-9" >
                                        <input type="number" class="form-control pay_in" name="discount" id="dis_id2" min="00" max ="10" maxlength="2" value='<?php
                                        if (!empty($payment->discount)) {
                                            $discount = explode('*', $payment->discount);
                                            echo $discount[0];
                                        }
                                        ?>' placeholder="Discount">

                                    </div>
									</div>								
								
									<div id="passw" class="col-md-12 payment right-six">
										<div class="col-md-3 payment_label">
										Apply More Discount
										</div>
									<div class="col-md-9">	
									<input type="password" id="password" onkeydown="if (event.keyCode == 13) document.getElementById('button').click()" /> <!-- IMPORTANT! this part is so if you click enter, it works. -->	
									<input id="button" type="button" value="Verify" onclick="showDiv()" />			
<script>
function showDiv(){
if (document.getElementById('password').value == 'PASSWORD') { 
	document.getElementById('table').style.display='BLOCK'; 
	document.getElementById('passw').style.display='none'; 
	document.getElementById('table2').style.display='none'; 
	$('#editPaymentForm').find('[id="dis_id2"]').val('0').end()
	} 
else {  
alert('Invalid Password!'); 
password.setSelectionRange(0, password.value.length);   
document.getElementById('table2').style.display='BLOCK'; 
}
}
</script>				
            
<!-- it will autoselect wrong input if wrong -->
        </div>
        </div>
								<div class="col-md-12 payment right-six" id="table" style="display:none"> 
								<div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('discount'); ?><?php
                                            if ($discount_type == 'percentage') {
                                                echo ' (%)';
                                            }
                                            ?> </label>
                                    </div>							 
                                    <div class="col-md-9" >
                                        <input type="number" class="form-control pay_in" name="discount"  id="dis_id"  value='<?php
                                        if (!empty($payment->discount)) {
                                            $discount = explode('*', $payment->discount);
                                            echo $discount[0];
                                        }
                                        ?>' placeholder="Discount">

                                    </div>
									</div>	

									
									
								<?php } ?>

                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"> <?php echo lang('gross_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
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
			
			<input type="text" size='8' class="form-control" style="border: 1;" name="amount_received[]"  id="amount_received" value='<?php
                                                    if (!empty($payment->amount_received)) {
                                                        echo $payment->amount_received;
                                                    }
                                                    ?>' placeholder=" ">
												   
			</td>

	<script>



</script> 			
			<td id="col1"> 


<?php if (empty($payment->id)) { ?>                 
    <select id="selecttype" name="deposit_type[]" style="width: 100px;" onchange="showcharge()" required> 
        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse'))) { ?>
            <option value="Cash"> <?php echo lang('cash'); ?> </option>
            <option value="No Charge"> <?php echo 'No Charge'; ?> </option>
            <option value="Insurance"> <?php echo 'Insurance'; ?> </option>
            <option value="Pay Next Visit"> <?php echo 'Pay Next Visit'; ?> </option>
            <option value="Card"> <?php echo lang('card'); ?> </option>
            <option value="Cheque"> <?php echo 'Cheque'; ?> </option>
            <option value="Other | Balance Due"> <?php echo 'Other | Balance Due'; ?> </option>
        <?php } ?>
    </select>
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
	
	<table cellspacing='0' cellpadding='0' id="nocharge" >
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
<script>
function showcharge(){
    if (document.getElementById('selecttype').value === 'No Charge') {
	document.getElementById('nocharge').style.display='none'; 
	document.getElementById('amount_received').style.display='none'; 
    //$("#nocharge").show()
    }
    else if (document.getElementById('selecttype').value === 'Pay Next Visit') {
	document.getElementById('nocharge').style.display='none'; 
	document.getElementById('amount_received').style.display='none'; 
    //$("#nocharge").show()
    }
    else{
    document.getElementById('nocharge').style.display='block'; 
    document.getElementById('amount_received').style.display='block'; 
    }
};

</script>	
	

 <div class="form-group cashsubmit payment  right-six col-md-12">
                                                <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"> <?php echo lang('submit'); ?></button>
                                            </div>
                                            <div class="form-group cardsubmit  right-six col-md-12 hidden">
											
                                                <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right" <?php /* if ($settings->payment_gateway == 'Stripe') {
                                                ?>onClick="stripePay(event);"<?php }*/
                                            ?>> <?php echo lang('submit'); ?></button>
                                            </div>


                                            </div>


                         <!--       <div class="col-md-12 payment right-six">
                                    <div class="col-md-12">
                                        <div class="col-md-3"> 
                                        </div>  
                                        <div class="col-md-6"> 
                                            <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                        </div>
                                        <div class="col-md-3"> 
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="col-md-12 payment">
                                    <div class="col-md-3 payment_label"> 
                                      <label for="exampleInputEmail1">Vat (%)</label>
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
								
								<input type="hidden" name="patient_name" value='<?php echo $patient_name; ?>'>
								<input type="hidden" name="med_name" value='<?php echo $med_name; ?>'>
                                <div class="row">
                                </div>
                                <div class="form-group">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>


<style>

    .remove {
        margin: 27px;
        width: 50%;
        background: #f1f1f1 !important;
        float: right;
        margin: -25px 0px;
        border: 1px solid #eee;
    }


    .remove1 {
        margin-top: 10px;
        background: #fff; 
        color: #000;
        padding: 5px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }


</style>

<script>
    $(document).ready(function () {
			
        var tot = 0;
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

                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: qtity,
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'medicine_id[]',
                    value: id,
                }).appendTo('#editPaymentForm .qfloww');
            }
            $(document).ready(function () {
                $('#idinput-' + id).keyup(function () {
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select1 option:selected'), function () {
                        var value = $(this).val();
                        var res = value.split("*");
                        // var unit_price = res[1];
                        var id1 = res[0];
                        qty = $('#idinput-' + id1).val();
                        var ekokk = res[1];
                        total = total + qty * ekokk;
                    });
                    tot = total;
					var discount="";
                    var discount1 = $('#dis_id').val();
                    var discount2 = $('#dis_id2').val();
					
					if (discount1 = "10"){
						discount = discount1;
						discount2 = "0";
					}					
					if (discount2 > "1"){
						discount = discount2;
						discount1 = "0";
					}
					
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                    $('#editPaymentForm').find('[name="grsss"]').val(gross)
                });
            });
            var curr_val = res[1] * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        //var discount = $('#dis_id').val();
					var discount="";
                    var discount1 = $('#dis_id').val();
                    var discount2 = $('#dis_id2').val();
					
					if (discount1 == "10"){
						discount = discount1;
						discount2 = "0";
					}					
					if (discount2 > "1"){
						discount = discount2;
						discount1 = "0";
					}		
		
        var gross = tot - discount;
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
        $('#dis_id2').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 



<script>
    $(document).ready(function () {
        $('.multi-select1').change(function () {
            var tot = 0;
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

                        $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
                    }
                    var input2 = $('<input>').attr({
                        type: 'text',
                        class: "remove",
                        id: 'idinput-' + id,
                        name: 'quantity[]',
                        value: '1',
                    }).appendTo('#editPaymentForm .qfloww');

                    $('<input>').attr({
                        type: 'hidden',
                        class: "remove",
                        id: 'mediidinput-' + id,
                        name: 'medicine_id[]',
                        value: id,
                    }).appendTo('#editPaymentForm .qfloww');
                }

                $(document).ready(function () {
                    $('#idinput-' + id).keyup(function () {
                        var qty = 0;
                        var total = 0;
                        $.each($('select.multi-select1 option:selected'), function () {
                            var value = $(this).val();
                            var res = value.split("*");
                            // var unit_price = res[1];
                            var id1 = res[0];
                            qty = $('#idinput-' + id1).val();
                            var ekokk = res[1];
                            total = total + qty * ekokk;
                        });

                        tot = total;

                        //var discount = $('#dis_id').val();
					var discount="";
                    var discount1 = $('#dis_id').val();
                    var discount2 = $('#dis_id2').val();
					
					if (discount1 = "10"){
						discount = discount1;
						discount2 = "0";
					}					
					if (discount2 > "1"){
						discount = discount2;
						discount1 = "0";
					}						
						
						
                        var gross = tot - discount;
                        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                        $('#editPaymentForm').find('[name="grsss"]').val(gross)
                    });
                });
                var curr_val = res[1] * $('#idinput-' + id).val();
                tot = tot + curr_val;
            });
         //   var discount = $('#dis_id').val();
		 
					var discount="";
                    var discount1 = $('#dis_id').val();
                    var discount2 = $('#dis_id2').val();
					
					if (discount1 = "10"){
						discount = discount1;
						discount2 = "0";
					}					
					if (discount2 > "1"){
						discount = discount2;
						discount1 = "0";
					}
					
            var gross = tot - discount;
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
<?php //if ($discount_type == 'percentage') { ?>
                ggggg = amount - amount * val_dis / 100;
<?php //} ?>
<?php //if ($discount_type == 'flat') { ?>
      //          ggggg = amount - val_dis;
<?php ////// } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });    
	
	$(document).ready(function () {
        $('#dis_id2').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
<?php //if ($discount_type == 'percentage') { ?>
                ggggg = amount - amount * val_dis / 100;
<?php //} ?>
<?php //if ($discount_type == 'flat') { ?>
      //          ggggg = amount - val_dis;
<?php ////// } ?>
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
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
    });</script>


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


<script src="common/js/codearistos.min.js"></script>
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
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

<script >
    $(document).ready(function () {
        // no keyboard
// document.getElementById("dis_id").addEventListener("keydown", e => e.preventDefault());

// allow up/down keyboard cursor buttons
document.getElementById("dis_id2").addEventListener("keydown", e => e.keyCode != 38 && e.keyCode != 40 && e.preventDefault());
    });

    </script>
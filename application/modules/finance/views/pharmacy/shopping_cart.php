<script type="text/javascript">
function addRows(emptbl) {
    var table = document.getElementById("emptbl");
    var rowCount = table.rows.length;
    if (rowCount <= 4) { // Limit the user from creating fields more than your limits
        var row = table.insertRow(rowCount);
        var colCount = table.rows[1].cells.length;
        row.id = 'row_' + rowCount;
        for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.outerHTML = table.rows[1].cells[i].outerHTML;            
        }
        var listitems = row.getElementsByTagName("input");
        for (i = 0; i < listitems.length; i++) {
            listitems[i].setAttribute("oninput", "calculate('" + row.id + "')");
        }
        $(".amount_received").on('input', getAmountRec);
    } else {
        alert("Maximum Row Reached.");
    }
}

function deleteRows() {
    var table = document.getElementById('emptbl');
    var rowCount = table.rows.length;
    if (rowCount > '2') {
        var row = table.deleteRow(rowCount - 1);
        rowCount--;
    } else {
        alert('There should be at least one row');
    }
}

function deleteFrameRows() {
    var table = document.getElementById('frame_table');
    var rowCount = table.rows.length;
    if (rowCount > '2') {
        var row = table.deleteRow(rowCount - 1);
        rowCount--;
    } else {
        alert('There should be at least one row');
    }
}

function showcharge() {
    if (document.getElementById('selecttype').value === 'No Charge') {
        document.getElementById('nocharge').style.display = 'none'; 
    } else if (document.getElementById('selecttype').value === 'Pay Next Visit') {
        document.getElementById('nocharge').style.display = 'none'; 
    } else {
        document.getElementById('nocharge').style.display = 'block'; 
    }
}

function showDiv() {
    if (document.getElementById('password').value == 'PASSIDEMR20') { 
        document.getElementById('table').style.display = 'BLOCK'; 
        document.getElementById('passw').style.display = 'none'; 
    } else {  
        alert('Invalid Password!'); 
        password.setSelectionRange(0, password.value.length);   
    }
}
</script>

<?php 
$user_id2 = $this->ion_auth->get_user_id(); 
?>  
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id)) {
                    echo lang('pharmacy') . ' ' . lang('edit_payment');
                } else {
                    echo lang('pharmacy') . ' ' . lang('poss'); ?>
                    <a href='finance/pharmacy/sellNowSingle?id=<?=$cartuser->patient_id ?>&type=gen' class='btn btn-success btn-xs button'>P.O.S</a>
                <?php } ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <style> 
                            .payment {
                                padding-top: 20px;
                                padding-bottom: 20px;
                                border: none;
                            }
                            .pad_bot {
                                padding-bottom: 10px;
                            }  
                            form {
                                border: 1px solid #ccc;
                                background: transparent;
                            }
                            .pos {
                                padding-left: 0px;
                            }
                            .form-control {
                                font-size: 14px;
                                font-weight: 600;
                                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
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
                            .inputhidden {
                                border: hidden;
                            }
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

                        <form role="form" class="clearfix pos form1" id="editPaymentForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                            <div class="col-md-8 row">     
                                <?php if (!empty($payment->id)) { ?>
                                    <div class="col-md-8 payment pad_bot">
                                        <div class="col-md-3 payment_label"> 
                                            <label for="exampleInputEmail1"><?php echo lang('invoice_id'); ?> :</label>
                                        </div>
                                        <div class="col-md-6">                                                   
                                            <?php echo '00' . $payment->id; ?>   
                                        </div>                                              
                                    </div>                                           
                                <?php } ?>
                                <div class="col-md-12 payment pad_bot panel">
                                    <?php if (isset($cartuser->patient_name)) { ?>
                                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                        <h4><?=$cartuser->patient_name ?></h4>
                                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('id'); ?></label>
                                        <h4><?=$cartuser->patient_id ?></h4>
                                        <input type="hidden" name="patient" value="<?=$cartuser->patient_id ?>">
                                    <?php } else { ?>
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
                                                ?>><?php echo $patient->first_name .' '. $patient->middle_name .'. '. $patient->last_name;
                                                $patient_name = $patient->first_name .' '. $patient->middle_name .'. '. $patient->last_name;
                                                ?> </option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12 payment pad_bot">
                                    <label for="exampleInputEmail1"><?php echo 'Doctor'; ?></label>
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
                                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                        <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                        if (!empty($payment->p_name)) {
                                            echo $payment->p_name;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="col-md-6 payment pad_bot">
                                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                        <input type="text" class="form-control pay_in" name="d_email" value='<?php
                                        if (!empty($payment->p_email)) {
                                            echo $payment->p_email;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="col-md-6 payment pad_bot"> 
                                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                        <input type="text" class="form-control pay_in" name="d_phone" value='<?php
                                        if (!empty($payment->p_phone)) {
                                            echo $payment->p_phone;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-12 payment">
                                    <div class="col-md-12 row">
                                        <table class="table table-striped table-hover table-bordered" id="frame_table" width="100%">
                                            <tr>
                                                <th><u>Qty</u></th>
                                                <th><u>Model|Name</u></th>
                                                <th><u>Color</u></th>
                                                <th><u><b><font color="red">Frame|Service Price</font></b></u></th>
                                                <th><u>Lens Type</u></th>
                                                <th><u>Lens Option</u></th>
                                                <th><u><b><font color="red">Lens Price</font></b></u></th>
                                                <th><u>Option</u></th>
                                                <hr>    
                                            </tr>    
                                            <?php foreach ($carts as $cart) { ?>
                                            <tr id="addview">
                                                <td><?php echo $cart->quantity; ?>
                                                    <input type="hidden" name="item_qty" value="<?php echo $cart->quantity; ?>" />
                                                </td>
                                                <td><?php echo $cart->name; ?>
                                                    <input type="hidden" name="item_name" value="<?php echo $cart->name; ?>" />
                                                    <input type="hidden" name="service_name" value="<?php echo $cart->service_name; ?>" />
                                                </td>
                                                <td><?php echo $cart->color; ?>
                                                    <input type="hidden" name="item_color" value="<?php echo $cart->color; ?>" />
                                                </td>                
                                                <td><b><font color="red"><?php echo $cart->price;  ?></font></b>
                                                    <input type="hidden" name="item_price" value="<?php echo $cart->price; ?>" />
                                                    <input type="hidden" name="service_price" value="<?php echo $cart->service_price; ?>" />
                                                </td>
                                                <td><?php echo $cart->framelens; ?>
                                                    <input type="hidden" name="len_lens" value="<?php echo $cart->framelens; ?>" />
                                                </td>
                                                <td><?php echo $cart->frameitems; ?><br><b><?php if ($cart->misc != "") { echo 'Misc.<br>(<font color="green">'. $cart->misc . '</font>)'; } ?></b>
                                                    <input type="hidden" name="len_misc" value="<?php echo $cart->misc; ?>" />
                                                    <input type="hidden" name="len_frame" value="<?php echo $cart->frameitems; ?>" />
                                                </td>
                                                <td><b><font color="red"><?php echo $cart->lens_price; ?></font></b>
                                                    <input type="hidden" name="len_price" value="<?php echo $cart->lens_price; ?>" />
                                                    <input type="hidden" name="pframeid" value="<?php echo $cart->frame_id; ?>" />
                                                    <input type="hidden" name="item_cat" value="<?php echo $cart->category; ?>" />
                                                    <input type="hidden" name="location" value="<?php echo $cart->location; ?>" />
                                                    <input type="hidden" name="item_size" value="<?php echo $cart->size; ?>" />
                                                    <input type="hidden" name="item_date" value="<?php echo $cart->date; ?>" />
                                                    <input type="hidden" name="ftype" value="<?php echo $cart->f_type; ?>" />
                                                    <input type="hidden" name="users" value="<?php echo $cart->user_name; ?>" />
                                                </td>
                                                <td><font color="red">
                                                    <a class="" role="button" href="finance/pharmacy/deletecart?id=<?= $cart->id ?>" onclick="deleteFrameRows()"><span class="glyphicon glyphicon-minus-sign" style="color:red; font-size: 20px;"></span></a>
                                                </font></td>                     
                                            </tr>    
                                            <?php } ?>    
                                        </table>            
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4 right-six">
                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"><?php echo lang('sub_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <?php foreach ($cart_subtotal as $ctotal) { ?>
                                            <input type="text" class="form-control pay_in subtotal" name="subtotal" id="subtotal" value='<?=$ctotal->subtotal?>' placeholder=" " readonly="readonly">
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                    <div class="col-md-12 payment right-six">
                                        <div class="col-md-3 payment_label"> 
                                            <label for="exampleInputEmail1"><?php echo lang('discount'); ?></label>
                                        </div>
                                        <div class="col-md-9"> 
                                            <input type="text" class="form-control pay_in" name="discount" id="dis_id" placeholder="Discount in %">%
                                            <sub><font color="red"><b><input class="inputhidden" name="disc_val" /></b></font></sub>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div id="passw" class="col-md-12 payment right-six">
                                        <div class="col-md-3 payment_label">
                                            Discount Password Required
                                        </div>
                                        <div class="col-md-9">    
                                            <input type="password" id="password" onkeydown="if (event.keyCode == 13) document.getElementById('button').click()" />
                                            <input id="button" type="button" value="Verify" onclick="showDiv()" />            
                                        </div>
                                    </div>
                                    <div class="col-md-12 payment right-six" id="table" style="display:none"> 
                                        <div class="col-md-3 payment_label"> 
                                            <label for="exampleInputEmail1"><?php echo lang('discount'); ?><?php
                                                if ($discount_type == 'percentage') { 
                                                    echo ' (%)';
                                                }
                                                ?> </label>
                                        </div>                             
                                        <div class="col-md-9">
                                            <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                            if (!empty($payment->discount)) {
                                                $discount = explode('*', $payment->discount);
                                                echo $discount[0];
                                            }
                                            ?>' placeholder="Discount in %">%
                                            <sub><font color="red"><input class="inputhidden" name="disc_val" /></font></sub>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-12 payment right-six">
                                    <div class="col-md-3 payment_label"> 
                                        <label for="exampleInputEmail1"><?php echo lang('gross_total'); ?></label>
                                    </div>
                                    <div class="col-md-9"> 
                                        <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                        if (!empty($payment->gross_total)) {
                                            echo $payment->gross_total;
                                        }
                                        ?>' placeholder=" " readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-12 payment right-six">
                                    <div class="payment_label"> 
                                        <label for="exampleInputEmail1"><?php echo lang('note'); ?></label>
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
                                                <input type="number" size='8' oninput="getAmountRec()" class="form-control amount_received" style="border: 1;" name="amount_received[]" id="amount_received" value='<?php
                                                if (!empty($payment->amount_received)) {
                                                    echo $payment->amount_received;
                                                }
                                                ?>' required>
                                                <sub class="balance-field"><font color="red"><b><input class="inputhidden" name="remain_balance" /></b></font></sub>                                   
                                            </td>
                                            <td id="col1"> 
                                                <?php if (empty($payment->id)) { ?>                 
                                                    <select id="selecttype" name="deposit_type[]" style="width: 100px;" onchange="showcharge()" required> 
                                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse'))) { ?>
                                                            <option value="Cash"><?php echo lang('cash'); ?></option>
                                                            <option value="No Charge"><?php echo 'No Charge'; ?></option>
                                                            <option value="Insurance"><?php echo 'Insurance'; ?></option>
                                                            <option value="Pay Next Visit"><?php echo 'Pay Next Visit'; ?></option>
                                                            <option value="Card"><?php echo lang('card'); ?></option>
                                                            <option value="Cheque"><?php echo 'Cheque'; ?></option>
                                                            <option value="Other | Balance Due"><?php echo 'Other | Balance Due'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                                <?php
                                                $payment_gateway = $settings->payment_gateway;
                                                ?>
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
                                                                    <input type="number" class="form-control pay_in" name="deposit_edit_amount[]" id="amount_received" value='<?php echo $deposit->deposited_amount; ?>'>
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
                                    <table cellspacing='0' cellpadding='0' id="nocharge">
                                        <tr> 
                                            <td>
                                                <font color="green">
                                                    <a role="button" onclick="addRows()"><span class="glyphicon glyphicon-plus-sign" style="color:green; font-size: 20px;"></span></a>
                                                </font>
                                            </td> 
                                            <td>
                                                <font color="red">
                                                    <a class="" role="button" onclick="deleteRows()"><span class="glyphicon glyphicon-minus-sign" style="color:red; font-size: 20px;"></span></a>
                                                </font>
                                            </td>  
                                            <td><b>Payment Type</b></td>
                                        </tr>    
                                    </table>    
                                    <div class="form-group cashsubmit payment right-six col-md-12">
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="finance/pharmacy/clearcart?user_id=<?=$user_id2 ?>" onclick="return confirm('Are you sure you want to clear the cart?');"><i class="fa fa-trash"></i>Clear Cart</a>
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-info row pull-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                    <div class="form-group cardsubmit right-six col-md-12 hidden">
                                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value='<?php
                                if (!empty($payment->id)) {
                                    echo $payment->id;
                                }
                                ?>'>
                                <input type="hidden" name="patient_name" value="<?php echo $patient_name; ?>">
                                <input type="hidden" name="med_name" value="">
                                <input type="hidden" name="user_id" value="<?php echo $user_id2; ?>">
                                <div class="row"></div>
                                <div class="form-group"></div>
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>

<script>
$(document).ready(function () {
    // Initialize discount and gross total calculation on page load
    var discount = $('#dis_id').val();
    var subtotal = $('#subtotal').val();
    var new_discount = (discount / 100) * subtotal;
    var gross = subtotal - new_discount;
    $('#editPaymentForm').find('[name="grsss"]').val(gross);
    $('#editPaymentForm').find('[name="disc_val"]').val(new_discount);
});

// Update gross total and discount value on discount input change
$('#dis_id').keyup(function () {
    var val_dis = parseFloat(this.value) || 0;
    var subtotal = parseFloat($('#subtotal').val()) || 0;

    var new_dis = (val_dis / 100) * subtotal;
    var gross = subtotal - new_dis;

    $('#gross').val(gross.toFixed(2));
    $('[name="disc_val"]').val(new_dis.toFixed(2));

    // Trigger deposit check again
    getAmountRec();
});

// Function to calculate remaining balance and handle deposit validation
function getAmountRec() {
    var totalDeposited = 0;
    var grossTotal = parseFloat($('#gross').val()) || 0;
    var $submitBtn = $('#submit1');
    var $balanceFields = $('.balance-field'); // Target all balance fields

    $('.amount_received').each(function () {
        var val = parseFloat($(this).val()) || 0;
        totalDeposited += val;
    });

    var remaining = grossTotal - totalDeposited;

    // Reset all balance fields
    $balanceFields.hide(); // Hide all balance fields initially
    $balanceFields.find('[name="remain_balance"]').val(''); // Clear all

    if (remaining < 0) {
        $submitBtn.prop('disabled', true);
        if ($('#deposit-error').length === 0) {
            $('<div id="deposit-error" style="color: red; margin-top: 10px;">You cannot deposit more than the Gross Total!</div>').insertAfter($submitBtn);
        }
    } else {
        $submitBtn.prop('disabled', false);
        $('#deposit-error').remove();
        // Show and update the balance field on the last row only if remaining is not negative
        var $lastBalanceField = $('#emptbl tr:last').find('.balance-field');
        $lastBalanceField.show(); // Show the last balance field
        $lastBalanceField.find('[name="remain_balance"]').val('Remaining Balance: ' + remaining.toFixed(2));
    }
}

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

    $(".flashmessage").delay(3000).fadeOut(100);

    $('.pos_client').hide();
    $(document.body).on('change', '#pos_select', function () {
        var v = $("select.pos_select option:selected").val();
        if (v == 'add_new') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

    $('#category_search').selectize({
        sortField: 'text'
    });

    $("#category_search").change(function () {
        $('#fileUploadModal').modal('show');
    });

    $('.pos_doctor').hide();
    $(document.body).on('change', '#add_doctor', function () {
        var v = $("select.add_doctor option:selected").val();
        if (v == 'add_new') {
            $('.pos_doctor').show();
        } else {
            $('.pos_doctor').hide();
        }
    });

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
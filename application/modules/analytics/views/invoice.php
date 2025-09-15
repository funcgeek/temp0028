
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div  class="panel-body col-md-5 panel-moree" id="invoice" style="font-size: 10px;">
                    <div class="row invoice-list">

                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo $settings->title ?>
                            </h1>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>

                      <!--  <div class="col-lg-4 col-sm-4">
                            <h4> <?php echo lang('payment_to'); ?> :</h4>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>-->
                        <?php if (!empty($payment->patient)) { ?>
                            <div class="col-lg-4 col-sm-4">
                                <h4> <?php echo lang('bill_to'); ?> :</h4>
                                <p>
                                    <?php
                                    $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
                                    echo $patient_info->name . ' <br>';
                                    echo $patient_info->address . '  <br/>';
                                    P: echo $patient_info->phone
                                    ?>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="col-lg-4 col-sm-4">
                            <h4> <?php echo lang('invoice_info'); ?> </h4>
                            <ul class="unstyled">
                                <li> <?php echo lang('invoice_number'); ?> 		: <strong>00<?php echo $payment->id; ?></strong></li>
                                <!--
                                <li> <?php echo lang('status'); ?> 		:
                                <?php
                                if ($payment->gross_total <= $payment->amount_received) {
                                    echo '<strong>' . lang('paid') . '</strong>';
                                } else {
                                    if ($payment->amount_received == 0) {
                                        echo '<strong>' . lang('unpaid') . '</strong>';
                                    } else {
                                        echo '<strong>' . lang('paid_partially') . '</strong>';
                                    }
                                }
                                ?> 
                                </li>
                                -->
                            </ul>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <h4> <?php echo lang('date'); ?> </h4>
                            <ul class="unstyled"> 
                                <li><?php echo date('m/d/Y', $payment->date); ?></li>    
                            </ul>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo 'Model';//lang('Model'); ?> </th>
                                <th> <?php echo lang('color'); ?> </th>
                                <th> <?php echo lang('unit_price'); ?></th>
                                <th> <?php echo lang('quantity'); ?> </th>
                                <th> <?php echo lang('total_per_item'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($payment->x_ray)) { ?>
                                <tr>
                                    <td><?php echo $i = 1 ?></td>
                                    <td>X Ray</td>
                                    <td class=""><?php echo $settings->currency; ?> <?php echo $payment->x_ray; ?> </td>
                                </tr>
                            <?php } ?>
                            <?php
                            if (!empty($payment->category_name)) {
                                $category_name = $payment->category_name;
                                $category_name1 = explode(',', $category_name);
                                if (empty($payment->x_ray)) {
                                    $i = 0;
                                }
                                foreach ($category_name1 as $category_name2) {
                                    $category_name3 = explode('*', $category_name2);
                                    if ($category_name3[1] > 0) {
                                        ?>                
                                        <tr>
                                            <td><?php echo $i = $i + 1; ?></td>
                                            <td><?php
                                                $current_medicine = $this->db->get_where('medicine', array('id' => $category_name3[0]))->row();
                                                echo $current_medicine->name;
                                                ?>
                                            </td>
                                            <td class=""> <?php echo $current_medicine->effects; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                            <td class=""> <?php echo $category_name3[2]; ?> </td>
                                            <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1] * $category_name3[2]; ?> </td>
                                        </tr> 
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6 invoice-block pull-right">
                            <ul >
                                <li> <?php echo lang('sub_total'); ?>   <?php echo lang('amount'); ?>  : <strong><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></strong></li>
                                <?php if (!empty($payment->discount)) { ?>
                                    <li>Discount <strong><?php
                                        if ($discount_type == 'percentage') {
                                            echo '(%) : ';
                                        } else {
                                            echo ': ' . $settings->currency;
                                        }
                                        ?> <?php
                                        $discount = explode('*', $payment->discount);
                                        if (!empty($discount[1])) {
                                            echo $discount[0] . ' %  =  ' . $settings->currency . ' ' . $discount[1];
                                        } else {
                                            echo $discount[0];
                                        }
                                        ?> </strong></li>
                                <?php } ?>
                                <?php if (!empty($payment->vat)) { ?>
                                    <li><strong> <?php echo lang('vat'); ?>  :</strong>   <?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        } else {
                                            echo '0';
                                        }
                                        ?> % = <?php echo $settings->currency . ' ' . $payment->flat_vat; ?></li>
                                <?php } 
$v = $payment->amount_received;
$amount_result = 0;
foreach(explode(',',$v) as $val)
     $amount_result +=intval($val);
								?>
                                <li> <?php echo lang('grand_total'); ?>  : <strong><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></strong></li>
								<li>&nbsp;</li>
								<li> <?php echo lang('amount_received'); ?>  : <strong><?php echo $settings->currency; ?> <?php echo $amount_result;//$payment->amount_received; ?></strong></li>
                                <li> <?php echo 'Balance Due';//lang('amount_to_be_paid'); ?>  : <strong><?php echo $settings->currency; ?> <?php echo $payment->gross_total - $payment->amount_received; ?></strong></li>
                                
                            </ul>
                        </div>
							<div class="col-lg-6 invoice-block pull-left">
							<u>Payment Breakdown</u>
							
                            <ul >
							
							<?php

							$dep_type = $payment->deposit_type;
							$dep_amount = $payment->receive_breakdown;
							
							$de_type = array();
							$de_amount = array();
							$item_type_amount = array();
							
							$de_type = explode("," ,$dep_type);
							$de_amount = explode("," ,$dep_amount);
							
							
							$item_type_amount = array_combine($de_type, $de_amount);
							
							foreach ($item_type_amount as $key => $value) {

								echo '<li>'.$key .': <b>$'.$value.'</b></li>';
								
								
							}	
							
				
?>
							
							
							
							
							
							
							</ul>
                        </div>
                    </div>





                </div>

                <div class="col-md-5 panel-moree" style="font-size: 10px;">

                    <div class="text-center invoice-btn clearfix">
                        <a class="btn btn-info btn-lg editbutton pull-left" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                    <div class="text-center invoice-btn clearfix">
                        <a class="btn btn-info btn-sm detailsbutton pull-left download" id="download"><i class="fa fa-download"></i> <?php echo lang('download'); ?> </a>
                    </div>

                    <div class="text-center invoice-btn clearfix">
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                            <a href="finance/pharmacy/editPayment?id=<?php echo $payment->id; ?>" class="btn btn-info btn-lg green pull-left"><i class="fa fa-edit"></i> <?php echo lang('edit_invoice'); ?> </a>
                        <?php } ?>
                    </div>
                  <div class="text-center invoice-btn no-print pull-left ">
                        <a href="finance/pharmacy/previousInvoice?id=<?php echo $payment->id ?>"class="btn btn-info btn-lg green previousone1"><i class="glyphicon glyphicon-chevron-left"></i> </a>
                        <a href="finance/pharmacy/nextInvoice?id=<?php echo $payment->id ?>"class="btn btn-info btn-lg green nextone1 "><i class="glyphicon glyphicon-chevron-right"></i> </a>

                    </div>
                    


                </div>


                <!--
                <div class="panel-body col-md-6 add_deposit" style="font-size: 10px; float: right;">

                    <form role="form" action="finance/pharmacy/amountReceived" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="exampleInputEmail1"></label>
                <?php echo lang('amount_to_be_paid'); ?> : <?php echo $settings->currency; ?>  <?php echo $payment->gross_total - $payment->amount_received; ?> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('add_deposit'); ?> </label>
                            <input type="text" class="form-control" name="amount_received" id="exampleInputEmail1" value='<?php
                if (!empty($category->description)) {
                    echo $category->description;
                }
                ?>' placeholder="<?php echo $settings->currency; ?> ">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $payment->id; ?>">

                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </form>
                </div>
                
                
                -->
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script>
                            $(document).ready(function () {
                                $(".flashmessage").delay(3000).fadeOut(100);
                            });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script>


                            $('#download').click(function () {
                                var pdf = new jsPDF('p', 'pt', 'letter');
                                pdf.addHTML($('#invoice'), function () {
                                    pdf.save('invoice_id_<?php echo $payment->id; ?>.pdf');
                                });
                            });

                            // This code is collected but useful, click below to jsfiddle link.
</script>

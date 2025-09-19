<!--sidebar end-->
<!--main content start--> 
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="frames_section">
            <header class="frames_panel_heading">
                <?php echo lang('medicine'); ?> 
                <div class="col-md-4 no-print pull-right"> 
                <?php 
                    if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                ?>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs frames_add_btn">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?>
                            </button>
                        </div>
                    </a>
                <?php } ?>
                </div>
            </header>

            <div class="frames_panel_body"> 
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                                <th class="frames_image_column"><?php echo lang('image'); ?></th>
                                <th><?php echo lang('model'); ?></th>
                                <th><?php echo 'Brand|Category';//lang('category'); ?></th>
                                <th><?php echo 'Size';//lang('store_box'); ?></th>
                                <th class="frames_location_column"><span class="frames_location_label frames_location_label_1">Location 1</span></th>                               
                                <th class="frames_quantity_column"><span class="frames_location_label frames_location_label_1">Qty.</span></th>                                
                                <th class="frames_location_column"><span class="frames_location_label frames_location_label_2">Location 2</span></th>                              
                                <th class="frames_quantity_column"><span class="frames_location_label frames_location_label_2">Qty.</span></th>
                                <th><?php echo lang('s_price'); ?></th>                               
                                <th><?php echo lang('color'); ?></th>
                                <th><?php echo 'Added by'; ?></th>
                                <th class="frames_actions_column"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<style>
    /* Modern CSS for Frames List */

/* Panel Styling */

.table-responsive {
    overflow-x: auto;
}

.frames_section {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    overflow: hidden;
}

.frames_panel_heading {
    padding: 15px 20px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.frames_panel_body {
    padding: 20px;
}

.frames_add_btn {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.frames_add_btn:hover {
    background-color: #218838;
    border-color: #1e7e34;
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
}

/* Table Styling */
.frames_section table.table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.frames_section table.table thead th {
    background-color: #f8f9fa;
    padding: 12px 15px;
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
    vertical-align: middle;
}

.frames_section table.table tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    border-top: none;
    border-bottom: 1px solid #e9ecef;
}

.frames_section table.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Image Column Styling */
.frames_image_column {
    width: 90px;
}

.frames_image_container {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.frames_thumbnail {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Location Column Styling */
.frames_location_column {
    min-width: 100px;
}

.frames_location {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.frames_location_1 {
    background-color: #ffebee;
    color: #e53935;
}

.frames_location_2 {
    background-color: #e8f5e9;
    color: #43a047;
}

.frames_location_label {
    padding: 3px 6px;
    border-radius: 3px;
    font-size: 12px;
    font-weight: 600;
}

.frames_location_label_1 {
    background-color: #ffebee;
    color: #e53935;
}

.frames_location_label_2 {
    background-color: #e8f5e9;
    color: #43a047;
}

/* Quantity Column Styling */
.frames_quantity_column {
    min-width: 120px;
}

.frames_stock_ok {
    display: inline-block;
    background-color: #e8f5e9;
    color: #43a047;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
}

.frames_stock_low {
    display: inline-block;
    background-color: #fff8e1;
    color: #ffa000;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
}

.frames_stock_out {
    display: inline-block;
    background-color: #ffebee;
    color: #e53935;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
}

.frames_load_btn {
    margin-top: 5px;
}

/* Price Styling */
.frames_price {
    font-weight: 600;
    color: #212529;
}

/* Actions Column Styling */
.frames_actions_column {
    min-width: 210px;
}

.frames_action_buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.frames_action_buttons .btn {
    margin-bottom: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.frames_action_buttons .btn i {
    margin-right: 5px;
}

/* Button Styling */
.btn-xs {
    padding: 3px 8px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-info {
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}

.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-warning {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .frames_action_buttons {
        flex-direction: column;
    }
    
    .frames_action_buttons .btn {
        margin-right: 0;
    }
}

@media (max-width: 768px) {
    .frames_section table.table {
        font-size: 13px;
    }
    
    .frames_section table.table thead th,
    .frames_section table.table tbody td {
        padding: 8px 5px;
    }
    
    .frames_stock_ok,
    .frames_stock_low,
    .frames_stock_out {
        padding: 2px 5px;
        font-size: 11px;
    }
}

/* Print Styling */
@media print {
    .no-print {
        display: none !important;
    }
    
    .frames_section {
        box-shadow: none;
    }
    
    .frames_panel_heading {
        background-color: white;
    }
    
    .frames_section table.table thead th {
        background-color: white;
    }
    
    .frames_location,
    .frames_stock_ok,
    .frames_stock_low,
    .frames_stock_out {
        border: 1px solid #ddd;
        background-color: transparent !important;
        color: black !important;
    }
}
</style>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                    <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                        <button type=submit onclick="return false;" style="display:none;"></button>
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="model"> <?php echo lang('model'); ?></label><br>
                                    <input type="text" class="" name="name"  value='' required placeholder="">
                                </td>
                                <td>
                                    <label for="category"> <?php echo 'Brand|Category';//lang('category'); ?></label><br>
                                    <select class="" name="category"  value='' required >
                                        <option value=""><?php echo lang('select'); ?></option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?php echo $category->category; ?>" <?php
                                            if (!empty($medicine->category)) {
                                                if ($category->category == $medicine->category) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?> > <?php echo $category->category; ?> </option>
                                        <?php } ?> 
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1"> <?php echo 'Size';//lang('store_box'); ?></label><br>
                                    <input type="text" class="" name="box" value='' required placeholder="">
                                </td>
                                <td>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label><br>
                                    <input type="text" class="" name="price" id="exampleInputEmail1" value='' placeholder="">
                                    <?php } ?>
                                </td>
                            </tr>  
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1"> <?php echo lang('color'); ?></label><br>
                                    <input type="text" class="" name="effects" id="exampleInputEmail1" value='' required placeholder="">
                                </td>
                                <td>
                                    <label for="exampleInputEmail1"><?php echo 'Selling Price';//lang('s_price'); ?></label><br>
                                    <input type="text" class="" name="s_price" id="exampleInputEmail1" value='' required placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1"> <?php echo '<b><u>Locations</u></b>';//lang('category'); ?></label><br>
                                    <select class="form-control m-bot15" name="location"  value='' required>
                                        <option value="Montego Bay"><font color="red">Montego Bay</font></option>
                                    </select>
                                </td>
                                <td>
                                    <label for="exampleInputEmail1"> <font color="red"><?php echo lang('quantity'); ?></font></label><br>
                                    <input type="text" class="" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control m-bot15" name="location_2"  value='' required>
                                        <option value="Falmouth">Falmouth</option>
                                    </select>
                                </td>
                                <td>
                                    <label for="exampleInputEmail1"> <font color="green"><?php echo lang('quantity'); ?></font></label><br>
                                    <input type="text" class="" name="quantity_2" id="exampleInputEmail1" value='' placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="img_url">Photo Upload</label><br>
                                </td>
                                <td>
                                    <input type="file" class="" name="img_url" id="img_url">
                                    <?php if (isset($_SESSION['error_message'])): ?>
                                        <div class="text-danger"><?php echo $_SESSION['error_message']; ?></div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Frame Label</label><br>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="frame_label[]" value="Best Seller"> Best Seller</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="frame_label[]" value="On Sale"> On Sale</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="frame_label[]" value="On Clearance"> On Clearance</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <?php
                                    $current_user = $this->ion_auth->get_user_id();
                                    ?>
                                    <input type="hidden" name="user_id" value="<?php echo $current_user; ?>" />
                                    <input type="hidden" name="type" value="frames" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="form-group col-md-12">
                                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </table>    
            </div>
        </div></div></div>





<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <button type="submit" onclick="return false;" style="display:none;"></button>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('model'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5" >
                        <label for="exampleInputEmail1"> <?php echo 'Location';//lang('category'); ?></label>
                        <select class="form-control m-bot15" name="location"  value=''>
                            <option value=""><?php echo lang('select'); ?></option>
                            <option value="Montego Bay">Montego Bay</option>
                            <option value="Falmouth">Falmouth</option>
                        </select>
                    </div> 
                    <div class="form-group col-md-5" >
                        <label for="exampleInputEmail1"> <?php echo 'Location';//lang('category'); ?></label>
                        <select class="form-control m-bot15" name="location_2"  value=''>
                            <option value=""><?php echo lang('select'); ?></option>
                            <option value="Montego Bay">Montego Bay</option>
                            <option value="Falmouth">Falmouth</option>
                        </select>
                    </div>             
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo 'Brand|Category';//lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value='' >
                            <option value=""><?php echo lang('select'); ?></option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group col-md-4"> 
                        <label for="exampleInputEmail1"> <?php echo 'Size';//lang('store_box'); ?></label>
                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="existingInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo 'Quantity Montego Bay'; ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>            
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo 'Quantity Falmouth'; ?></label>
                        <input type="text" class="form-control" name="quantity_2" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <?php } ?>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('color'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('image'); ?></label>
                        <input type="file" class="form-control" name="img_url" id="exampleInputEmail1" accept="image/*">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Frame Label</label><br>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="frame_label[]" value="Best Seller"> Best Seller</label>
                        </div>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="frame_label[]" value="On Sale"> On Sale</label>
                        </div>
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="frame_label[]" value="On Clearance"> On Clearance</label>
                        </div>
                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <input type="hidden" name="type" value="frames" />
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div></div></div>








<!-- Load Medicine -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('load_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                
                <!-- Changed the Quanitty input to "number" - NovPilot --->
 <form role="form" id="editMedicineForm" class="clearfix" action="medicine/load" method="post" enctype="multipart/form-data">
    <button type="submit" onclick="return false;" style="display:none;"></button>
    <div class="form-group">
        <label for="qtyMontegoBay"> <font color="red"><?php echo lang('add_quantity'); ?> to Montego Bay </font></label>
        <input type="number" class="form-control" name="qty" id="qtyMontegoBay" value='' placeholder="" min="0" onkeypress="return (event.charCode != 45 && event.charCode != 43)">
    </div>
    <div class="form-group">
        <label for="qtyFalmouth"><font color="green"><?php echo lang('add_quantity'); ?> to Falmouth </font></label>
        <input type="number" class="form-control" name="qty_2" id="qtyFalmouth" value='' placeholder="" min="0" onkeypress="return (event.charCode != 45 && event.charCode != 43)">
    </div>

    <input type="hidden" name="id" value=''>
    <input type="hidden" name="reception_id" value="<?php echo @$reception_id; ?>" />
    <input type="hidden" name="doctor_id" value="<?php echo @$doctor_id; ?>" />

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
    </div>
</form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Load Medicine -->

<!-- Transer Stock -->
<div class="modal fade" id="myModal_trans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo 'Transer Between Stores';//lang('load_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/transfer" method="post" enctype="multipart/form-data">
                <button type=submit onclick="return false;" style="display:none;"></button>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <font color="red">Quantity Amount</font></label>
                        <input type="text" class="form-control" name="qty" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					
					<div class="form-group">
                        <label for="exampleInputEmail1"> Transer From Location</label>
                        <select class="form-control m-bot15" name="location"  value='' required>
						<option value=""><?php echo lang('select'); ?></option>
						<option value="Montego Bay">Montego Bay</option>
						<option value="Falmouth">Falmouth</option>

                        </select>
                    </div>
					
					<div class="form-group">
                        <label for="exampleInputEmail1"> Transer to Location</label>
                        <select class="form-control m-bot15" name="location_2"  value='' required>
						<option value=""><?php echo lang('select'); ?></option>
						<option value="Montego Bay">Montego Bay</option>
						<option value="Falmouth" >Falmouth</option>

                        </select>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Transfer Stock -->

<!-- History of Stock -->




<div class="modal fade" id="myModal_history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div id="printThis" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo 'Transfer History'; ?></h4>
            </div> 
            <div  class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
		<div id="framehistory"></div>  	
            </div>
            <div class="modal-footer">
                <button type="button" id="Print" class="btn btn-primary no-print">Print</button>
            </div>			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- History Stock -->

<!-- History of loading to stock -->




<div class="modal fade" id="myModal_loadhistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div id="printThis" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">   <?php echo 'Load History';//lang('add_case'); ?></h4>
            </div> 
            <div  class="modal-body">
			<!-- <table cellspacing="10" cellpadding="10" width='700' style="padding: 15px;text-align: left;"> -->
		<div id="loadhistory"></div>  	
            </div>
            <div class="modal-footer">
                <button type="button" id="Print" class="btn btn-primary no-print">Print</button>
            </div>			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- History Stock -->




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".editbutton", function () {
            
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal2').modal('show');
            $.ajax({
                url: 'medicine/editMedicineByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end()
                $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end()
                $('#editMedicineForm').find('[name="box"]').val(response.medicine.box).end()
                $('#editMedicineForm').find('[name="location"]').val(response.medicine.location).end()
                $('#editMedicineForm').find('[name="location_2"]').val(response.medicine.location_2).end()
                $('#editMedicineForm').find('[name="category"]').val(response.medicine.category).end()
                $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end()
                $('#editMedicineForm').find('[name="s_price"]').val(response.medicine.s_price).end()
                $('#editMedicineForm').find('[name="quantity"]').val(response.medicine.quantity).end()
                $('#editMedicineForm').find('[name="quantity_2"]').val(response.medicine.quantity_2).end()
                $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end()
                $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end()
                $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end()
                $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end()

                // Clear all checkboxes first
                $('#editMedicineForm').find('[name="frame_label[]"]').prop('checked', false);
                
                // Check boxes based on the response
                if (response.medicine.frame_label) {
                    var labels = response.medicine.frame_label.split(',');
                    labels.forEach(function(label) {
                        // Trim whitespace and check the checkbox with the matching value
                        $('#editMedicineForm').find('[name="frame_label[]"][value="' + label.trim() + '"]').prop('checked', true);
                    });
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".load", function () {

            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid2 = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal3').modal('show');

            //  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid2).end()
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(".table").on("click", ".transfer", function () {

            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
            $('#myModal_trans').modal('show');

            //  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid).end()
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $(".table").on("click", ".history", function () {

            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
			$('#framehistory').html('');
            $('#myModal_history').modal('show');
			//$('#modal-loader').show();      // load ajax loader

			$.ajax({
			url: '/db/framehistory.php',
			type: 'POST',
			data: 'id='+iid,
			dataType: 'html'
			})
 
		.done(function(data){
			console.log(data);	
			$('#framehistory').html('');    
			$('#framehistory').html(data); // load response 
			$('#myModal_history').show();		  // hide ajax loader	
		})
		.fail(function(){
			$('#framehistory').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#myModal_history').show();
		});
		//  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid).end()
											
  });
    });
	
document.getElementById("Print").onclick = function () {
    printElement(document.getElementById("printThis"));
};

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
	
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $(".table").on("click", ".loadhistory", function () {

            // e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#editMedicineForm').trigger("reset");
			$('#loadhistory').html('');
            $('#myModal_loadhistory').modal('show');
			//$('#modal-loader').show();      // load ajax loader

			$.ajax({
			url: '/db/loadhistory.php',
			type: 'POST',
			data: 'id='+iid,
			dataType: 'html'
			})
 
            // Change it to:
            .done(function(data){
                console.log(data);    
                $('#loadhistory').html('');    
                $('#loadhistory').html(data); // load response 
                // Remove the hide() call or change it to show() if needed
            })
		.fail(function(){
			$('#loadhistory').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#myModal_loadhistory').hide();
		});
		//  var id = $(this).data('id');

            // Populate the form fields with the data returned from server
            $('#editMedicineForm').find('[name="id"]').val(iid).end()
											
  });
    });
	
document.getElementById("Print").onclick = function () {
    printElement(document.getElementById("printThis"));
};

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
	
</script>

<script>


    $(document).ready(function () {
        var table = $('#editable-sample1').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "medicine/getMedicineList",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
     "<'row'<'col-sm-12'<'table-responsive'tr>>" +
     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
            <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>	
				'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
			<?php } ?>
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "asc"]],
            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            },
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>

<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


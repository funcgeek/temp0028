<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php echo lang('medicine'); ?> 
                <div class="col-md-4 no-print pull-right"> 
				<?php 
						if ($this->ion_auth->in_group(array('admin','Doctor')))	{ ?> 
					
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?>
                            </button>
                        </div>
                    </a>
				<?php } ?>
                </div>
            </header>
            <style>

                    .editable-table .search_form{
                        border: 0px solid #ccc !important;
                        padding: 0px !important;
                        background: none !important;
                        float: right;
                        margin-right: 14px !important;
                    }
    
    
                    .editable-table .search_form input{
                        padding: 6px !important;
                        width: 250px !important;
                        background: #fff !important;
                        border-radius: none !important;
                    }
    
                    .editable-table .search_row{
                        margin-bottom: 20px !important;
                    }
    
                    .panel-body {
                        padding: 15px 0px 15px 0px;
                    }


@media print {
    body * {
        visibility:hidden;
    }
    #printSection, #printSection * {
        visibility:visible;
    }
    #printSection {
        position:absolute;
        left:0;
        top:0;
    }
}

            </style>

            <div class="panel-body"> 
                <div class="adv-table editable-table">
                    <div class="space15">
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                        <thead>
                            <tr>
                               
                                <th> <?php echo lang('model'); ?></th>
                                <th> <?php echo 'Brand|Category';//lang('category'); ?></th>
                                <th> <?php echo 'Size';//lang('store_box'); ?></th>
                                <th> <font color ="red">Location 1</font></th>								
                                <th> <font color ="red">Qty.</font></th>                                
								<th> <font color="green">Location 2</font></th>								
                                <th> <font color ="green">Qty.</font></th>
                                <th> <?php echo lang('s_price'); ?></th>								
                                <th> <?php echo lang('color'); ?></th>
                                <th> <?php echo 'Added by'; ?></th>
                                <th> <?php echo lang('options'); ?></th>
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

                            .load{
                                float: right !important;
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






<!-- Add Frames Modal-->
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
					 	<?php if ($this->ion_auth->in_group('admin','Doctor')) { ?>
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label><br>
                        <input type="text" class="" name="price" id="exampleInputEmail1" value='' placeholder="">
                    	<?php } ?>
					</td>
					</tr>  
					
					<tr>
					<td>
                    
                        <label for="exampleInputEmail1"> <?php echo lang('color'); ?></label><br>
                        <input type="text" class="" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    
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
					<td colspan='2'>
						<?php
						$current_user = $this->ion_auth->get_user_id();
							if ($this->ion_auth->in_group('admin','Receptionist','Doctor')) {
							$reception_id = $this->db->get_where('receptionist', array('ion_user_id' => $current_user))->row()->id;
							$doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
							$user_id = $this->db->get_where('user', array('ion_user_id' => $current_user))->row()->id;
							//$admin_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
						}?>
						<input type="hidden" name="reception_id" value="<?php echo @$reception_id; ?>" />
						<input type="hidden" name="doctor_id" value="<?php echo @$doctor_id; ?>" />
					</td>
					</tr>
				


					<tr>
					<td colspan="2" align="center">
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
					</td>
					</tr>
                </form>
			</table>	

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit frame Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_medicine'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                <button type=submit onclick="return false;" style="display:none;"></button>
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
                    <?php if ($this->ion_auth->in_group('admin','Doctor')) { ?>
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-3" hidden="hidden">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>                    
                    <div class="form-group col-md-3" hidden="hidden">
                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity_2" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputEmail1"> <?php echo lang('color'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                   
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>



                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->









<!-- Load Medicine -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('load_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" class="clearfix" action="medicine/load" method="post" enctype="multipart/form-data">
				<button type=submit onclick="return false;" style="display:none;"></button>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <font color="red"><?php echo lang('add_quantity'); ?> to Montego Bay </font></label>
                        <input type="text" class="form-control" name="qty" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1"><font color="green"><?php echo lang('add_quantity'); ?> to Falmouth </font></label>
                        <input type="text" class="form-control" name="qty_2" id="exampleInputEmail1" value='' placeholder="">
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
						<option value="Montego Bay" <?php echo $class_disabled1;?>>Montego Bay</option>
						<option value="Falmouth" <?php echo $class_disabled2;?> >Falmouth</option>

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
                <h4 class="modal-title">   <?php echo 'Transfer History';//lang('add_case'); ?></h4>
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
			$('#myModal_history').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#framehistory').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#myModal_history').hide();
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
 
		.done(function(data){
			console.log(data);	
			$('#loadhistory').html('');    
			$('#loadhistory').html(data); // load response 
			$('#myModal_loadhistory').hide();		  // hide ajax loader	
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


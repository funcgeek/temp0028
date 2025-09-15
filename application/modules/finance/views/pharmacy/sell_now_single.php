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
        .smallinput {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        width: 50px;
      }        
      .biginput {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        width: 100px;
      }      
      
      .minput {
        width: 100px;
        border: none;
      }      
      .minput2 {
        width: 50px;
        border: none;
      }
      
      .no-outline:focus {
        outline: none;
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




/* Reset default margins and paddings */
#own_frame {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Table container styling */
.adv-table.editable-table {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    overflow-x: auto;
}

/* Table styling */
#sellframes {
    border-collapse: separate;
    border-spacing: 0;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
}

/* Header styling */
#sellframes thead th {
    background-color: #343a40;
    color: #fff;
    font-weight: 600;
    padding: 12px 15px;
    text-transform: uppercase;
    font-size: 14px;
    border-bottom: 2px solid #dee2e6;
}

/* Cell styling */
#sellframes td {
    padding: 10px 15px;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
    font-size: 14px;
    color: #333;
}

/* Input fields */
#sellframes input.minput {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background-color: #e9ecef;
    font-size: 14px;
}

/* Hover effect for rows */
#sellframes tbody tr:hover {
    background-color: #f1f3f5;
}

/* Button styling */
#sellframes .btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

#sellframes .btn-info:hover {
    background-color: #138496;
    border-color: #138496;
}

/* Icon in button */
#sellframes .btn-info .fa {
    margin-right: 5px;
}

/* No-print class for print media */
@media print {
    .no-print {
        display: none;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #sellframes {
        font-size: 12px;
    }
    #sellframes th,
    #sellframes td {
        padding: 8px 10px;
    }
    #sellframes .btn-info {
        padding: 4px 8px;
        font-size: 12px;
    }
}

/* DataTables-specific styles */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 15px;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 5px;
    margin-left: 10px;
}

.dataTables_wrapper .dataTables_paginate {
    margin-top: 15px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    background: #17a2b8;
    color: #fff !important;
    border: none;
    border-radius: 4px;
    padding: 5px 10px;
    margin: 0 2px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #138496;
}

</style>

<script>
    
    $(document).ready(function() {
    // Initialize DataTables for the sellframes table
    $('#sellframes').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "pageLength": 10,
        "language": {
            "emptyTable": "No frames available in the table",
            "search": "Search Frames:",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    // Ensure modal link works (optional: confirm modal functionality)
    $('#sellframes').on('click', '#getSellFrameNow', function(e) {
        var frameId = $(this).data('id');
        console.log('Sell Now clicked for Frame ID: ' + frameId);
        // Ensure modal ID #myownframeModal_tocart exists in your HTML
        // Add custom modal logic here if needed
    });
});
</script>

<!-- Edit To cart Modal-->
 <div id="myModal_tocart" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-lg"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> Add Item to Cart</h4> 

                       </div> 
                       <div class="modal-body"> 
							
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>
<form role="form" action="./finance/pharmacy/addShoppingCart" class="clearfix" method="post" enctype="multipart/form-data">						   
                           <!-- content will be load here -->   
							<div id="sellnow-content"> </div>
							<center>
							<!-- <input type="submit" name="Add2Cart" value="Add to Cart" class="btn btn-success"> -->
							<button onclick="form_submit()" name='Add2Cart' id='AddCart' value='Add to Cart' class="btn btn-success">
							<input type="hidden" name="pat_id" class="minput" value="<?php echo $patient->id; ?>" readonly>           										
							<input type="hidden" name="pat_name" class="minput" value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name; ?>" readonly>
							<i class="fa fa-user"></i>Add to Cart</button>
							</center>
</form> 
                      
						</div> 
                        <div class="modal-footer"> 
                              
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Edit to cart Modal-->
 <!-- Edit To cart Modal-->
 <div id="myServiceModal_tocart" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-lg"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> Add Service to Cart</h4> 

                       </div> 
                       <div class="modal-body"> 
							
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>
<form role="form" action="./finance/pharmacy/addShoppingCart" class="clearfix" method="post" enctype="multipart/form-data">						   
                           <!-- content will be load here -->   
							<div id="sellservicenow-content"> </div>
						   	<center>
							<!-- <input type="submit" name="Add2Cart" value="Add to Cart" class="btn btn-success"> -->
							<button onclick="form_submit()" name='Add2Cart' value='Add to Cart' class="btn btn-success">
							<button onclick="form_submit()" name='Add2Cart' id='AddCart' value='Add to Cart' class="btn btn-success">
							<input type="hidden" name="pat_id" class="minput" value="<?php echo $patient->id; ?>" readonly>           										
							<input type="hidden" name="pat_name" class="minput" value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name; ?>" readonly>
							<i class="fa fa-user"></i>Add to Cart</button>
							</center>
</form>                         
						</div> 
                        <div class="modal-footer"> 
                              
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Edit to cart Modal-->	
<!-- Edit To cart Modal-->
 <div id="myownframeModal_tocart" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-lg"> 
                  <div class="modal-content "> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                            	<i class="glyphicon glyphicon-user"></i> Add OwnFrame to Cart</h4> 

                       </div> 
                       <div class="modal-body"> 
							
                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	   	<img src="ajax-loader.gif">
                       	   </div>
<form role="form" action="./finance/pharmacy/addShoppingCart" class="clearfix" method="post" enctype="multipart/form-data">						   
                           <!-- content will be load here -->   
							<div id="sellframenow-content"> </div>
						   	<center>
							<!-- <input type="submit" name="Add2Cart" value="Add to Cart" class="btn btn-success"> -->
							<button onclick="form_submit()" name='Add2Cart' value='Add to Cart' class="btn btn-success">
							<button onclick="form_submit()" name='Add2Cart' id='AddCart' value='Add to Cart' class="btn btn-success">
							<input type="hidden" name="pat_id" class="minput" value="<?php echo $patient->id; ?>" readonly>           										
							<input type="hidden" name="pat_name" class="minput" value="<?php echo $patient->first_name.' '.$patient->middle_name.' '.$patient->last_name; ?>" readonly>
							<i class="fa fa-user"></i>Add to Cart</button>
							</center>
</form>                         
						</div> 
                        <div class="modal-footer"> 
                              
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                        </div> 
                        
                 </div> 
              </div>
       </div> 
<!-- Edit to cart Modal-->		   
  <!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php echo "SERVICE | FRAMES FOR <U>"; ?> <?php echo $patient->first_name.' '.$patient->last_name; ?> 
				<?php echo "</U>"; ?>
                <div class="col-md-4 no-print pull-right"> 
                <div id="message"></div>
                </div>
            </header>
            <section class="panel-body">   
			    <header class="panel-heading tab-bg-dark-navy-blueee">
                    <ul class="nav nav-tabs">
					<li class="active">
                            <a data-toggle="tab" href="#frames" style="display:block;"><?php echo 'FRAMES';//lang('bed'); ?></a>
                        </li> 
                        <li >
                            <a data-toggle="tab" href="#services"><?php echo 'SERVICES';//lang('appointments'); ?></a>
                        </li>
						         
						<li >
                      <a data-toggle="tab" href="#own_frame"><?php echo 'OWN FRAME';//lang('appointments'); ?></a>
                        </li>
						                    

                    </ul>
                </header>
 
                <div class="panel">
                    <div class="tab-content">
					
                        <div id="services" class="tab-pane"> 
							<div class="">
                                <div class="adv-table editable-table ">                    
                    <table class="table table-striped table-hover table-bordered quickserv" id="sellservices">
                    
                        <thead>
                                            <tr>
                                                <th><?php echo 'id'; ?></th>
                                                <th><?php echo 'Service Name'; ?></th>
                                                <th><?php echo 'Service Price'; ?></th>
                                             <!--   <th><?php echo 'Added by'; ?></th> -->
                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                            </tr>
                        </thead>
                        <tbody>
							 
  							<?php 
			$ser = 'services';	
			$this->db->select('*');
			$this->db->where('type',$ser);
            $fetched_records = $this->db->get('medicine');
            $query_services = $fetched_records->result();
							
							foreach ($query_services as $service) { 
							?>
							
							
							
							
  									
                                              <tr>                						
														<td><?php echo $service->id; ?></td>
                     									<td><?php echo $service->service_name; ?></td>
                     									<td><?php echo $service->service_price; ?></td>
                     								<!--	<td><?php echo $service->user_name; ?></td> -->
          <input type="hidden" name="pserviceid" class="minput" value="<?php echo $service->id; ?>" readonly>           										
          <input type="hidden" name="users" id="users" class="minput" value="<?php echo $this->ion_auth->get_user_id(); ?>" readonly>           									
		  
<td class="no-print">         
<a id="getSellServiceNow" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myServiceModal_tocart" data-id="<?php echo $service->id; ?>"><i class="fa fa-plus-circle"> </i> Sell Now </a>
                     									</td>
														</tr>
                                                 <?php }  ?>

                        </tbody>
                     
                    </table>
                    




                </div>
 </div>           
 </div>                     
                    
            <div id="frames" class="tab-pane active"> 
				<div class="">
                <div class="adv-table editable-table">
                    <div class="space15">
                    </div>
                    
                    <table class="table table-striped table-hover table-bordered quickframes" id="sellframes">
                    
                        <thead>
                            <tr>
                               
                                <th> <?php echo lang('model'); ?></th>
                                <th> <?php echo lang('color'); ?></th>
                                <th> <?php echo 'Brand|Category';//lang('category'); ?></th>
                                <th> <?php echo 'Size';//lang('store_box'); ?></th>
                                <th> <font color ="red">Montego Bay Qty.</font></th>								
                             <!--   <th> <font color ="red">Qty.</font></th>  -->                              
								<th> <font color="green">Falmouth Qty.</font></th>								
                             <!--   <th> <font color ="green">Qty.</font></th> -->
                                <th> <?php echo 'Price'; ?></th>
                              <!--  <th> <?php echo 'Added by'; ?></th> -->
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
							 
  							<?php 
			$fra = 'frames';	
			$this->db->select('*');
			$this->db->where('type',$fra);
            $fetched_records = $this->db->get('medicine');
            $query_frames = $fetched_records->result();							
							
							foreach ($query_frames as $medicine) { ?>									
                                              <tr>                						
        <td><?= $medicine->name ?><input type="hidden" name="pname" class="minput" value="<?= $medicine->name ?>" readonly></td>
        <td><?= $medicine->effects ?><input type="hidden" name="pcolor" class="minput" value="<?= $medicine->effects ?>" readonly></td>
        <td><?= $medicine->category ?> <input type="hidden" name="pcat" class="minput" value="<?= $medicine->category ?>" readonly></td>
        <td><?= $medicine->box ?> <input type="hidden" name="psize" class="minput" value="<?= $medicine->box ?>" readonly></td>
        <td><?= $medicine->quantity ?> <input type="hidden" name="pqty" class="minput2" value="<?= $medicine->quantity ?>" readonly>  </td>
        <td><?= $medicine->quantity_2 ?><input type="hidden" name="pqty2" class="minput2" value="<?= $medicine->quantity_2 ?>" readonly></td>
        <td><?= $medicine->s_price ?> <input type="hidden" name="pprice" class="minput" value="<?= $medicine->s_price ?>" readonly> </td>
          <input type="hidden" name="pframeid" class="minput" value="<?php echo $medicine->id; ?>" readonly>           										
          <input type="hidden" name="ftype" class="minput" value="<?php echo $medicine->f_type; ?>" readonly>           										
          <input type="hidden" name="users" id="users" class="minput" value="<?php echo $this->ion_auth->get_user_id(); ?>" readonly>          										
          <td class="no-print">         
<a id="getSellNow" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myModal_tocart" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-plus-circle"> </i> Sell Now </a>
                     									</td>
                                                   <?php //} ?>                                                  
                                                   </tr>                                                 
                                                 <?php } ?>
                        </tbody>                    
                    </table>
                </div>
 </div>           
 </div>  			 
<div id="own_frame" class="tab-pane">
    <div class="">
        <div class="adv-table editable-table">
            <div class="space15"></div>
            <table class="table table-striped table-hover table-bordered" id="sellframes">
                <thead>
                    <tr>
                        <th><?php echo lang('model'); ?></th>
                        <th><?php echo lang('color'); ?></th>
                        <th><?php echo 'Brand|Category'; ?></th>
                        <th><?php echo 'Size'; ?></th>
                        <th><?php echo lang('options'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fra2 = 'own_frames';
                    $this->db->select('*');
                    $this->db->where('type', $fra2);
                    $fetched_records = $this->db->get('medicine');
                    
                    // Debugging: Log the query and number of records
                    log_message('debug', 'Query: ' . $this->db->last_query());
                    $num_rows = $fetched_records->num_rows();
                    log_message('debug', 'Records found: ' . $num_rows);

                    // Check for database errors
                    if ($this->db->error()['code']) {
                        echo '<tr><td colspan="5">Database error: ' . $this->db->error()['message'] . '</td></tr>';
                    } elseif ($num_rows == 0) {
                        // Show message if no records are found
                        echo '<tr><td colspan="5">No frames found with type "own_frames".</td></tr>';
                    } else {
                        $query_frames2 = $fetched_records->result();
                        foreach ($query_frames2 as $medicine) {
                    ?>
                        <tr>
                            <td><input type="text" name="pname" class="minput" value="<?= htmlspecialchars($medicine->name) ?>" readonly></td>
                            <td><input type="text" name="pcolor" class="minput" value="<?= htmlspecialchars($medicine->effects) ?>" readonly></td>
                            <td><input type="text" name="pcat" class="minput" value="<?= htmlspecialchars($medicine->category) ?>" readonly></td>
                            <td><input type="text" name="psize" class="minput" value="<?= htmlspecialchars($medicine->box) ?>" readonly></td>
                            <input type="hidden" name="pframeid" class="minput" value="<?= htmlspecialchars($medicine->id) ?>" readonly>
                            <input type="hidden" name="users" id="users" class="minput" value="<?= $this->ion_auth->logged_in() ? htmlspecialchars($this->ion_auth->get_user_id()) : '' ?>" readonly>
                            <td class="no-print">
                                <a id="getSellFrameNow" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#myownframeModal_tocart" data-id="<?= htmlspecialchars($medicine->id) ?>">
                                    <i class="fa fa-plus-circle"></i> Sell Now
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
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
<!--footer start-->

 

<script src="common/js/codearistos.min.js"></script>

<script>
$(document).ready(function(){
	
	$(document).on('click', '#getSellNow', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#sellnow-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getsellnow.php',
			type: 'POST',
			data: {id: uid, user: $("#users").val(), city: $("#city_new").val()},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#sellnow-content').html('');    
			$('#sellnow-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#sellnow-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

$(document).ready(function(){
	
	$(document).on('click', '#getSellServiceNow', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#sellservicenow-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getsellservicenow.php',
			type: 'POST',
			data: {id: uid, user: $("#users").val(), city: $("#city_new").val()},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#sellservicenow-content').html('');    
			$('#sellservicenow-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#sellservicenow-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});
$(document).ready(function(){
	
	$(document).on('click', '#getSellFrameNow', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#sellframenow-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getownframesellnow.php',
			type: 'POST',
			data: {id: uid, user: $("#users").val(), city: $("#city_new").val()},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#sellframenow-content').html('');    
			$('#sellframenow-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#sellframenow-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

/*
$(document).ready(function(){
	
	$(document).on('click', '#getownframeSellNow', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#sellownframenow-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: '/db/getownframesellnow.php',
			type: 'POST',
			data: {id: uid, user: $("#users").val(), city: $("#city_new").val()},
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#sellownframenow-content').html('');    
			$('#sellownframenow-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#sellownframenow-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});


$(document).ready(function(){
	
$(document).on('click', '#setownframeSellNow', function(e){
//$('#submitform').submit(function (event) {
   event.preventDefault();
   $.ajax({
      type: "POST",
      url: '/db/setownframesellnow.php',
      data: $(this).serialize(),
       success: function (data) {
         console.log(data);
       $('.result').html(data);
      }
    });
});

});

*/
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
<!-- below is used to add the search to a page for frames -->

<script>
                                    $(document).ready(function () {
                                        $('.quickframes').DataTable({
                                            responsive: true,
											autoFill: true,

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
                                                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                                                    }
                                                },
                                            ],

                                            aLengthMenu: [
                                                [10, 25, 50, 100, -1],
                                                [10, 25, 50, 100, "All"]
                                            ],
                                            iDisplayLength: 10,
                                            "order": [[0, "desc"]],

                                            "language": {
                                                "lengthMenu": "_MENU_",
                                                search: "_INPUT_",
                                                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                                            },

                                        });

                                        table.buttons().container()
                                                .appendTo('.custom_buttons');
                                    });


</script>

<script>
                                    $(document).ready(function () {
                                        $('.quickserv').DataTable({
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
                                                        columns: [0, 1, 2, 3],
                                                    }
                                                },
                                            ],

                                            aLengthMenu: [
                                                [10, 25, 50, 100, -1],
                                                [10, 25, 50, 100, "All"]
                                            ],
                                            iDisplayLength: 10,
                                            "order": [[0, "desc"]],

                                            "language": {
                                                "lengthMenu": "_MENU_",
                                                search: "_INPUT_",
                                                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
                                            },

                                        });

                                        table.buttons().container()
                                                .appendTo('.custom_buttons');
                                    });


</script>
<!--
 <script>
$(document).ready(function(){
	
	$(document).on('click', '#AddCart', function(e){
		
		e.preventDefault();
                    var hasErrors = false,
                        var pname = document.getElementById("pname").value;
                        var pcolor = document.getElementById("pcolor").value;
                        var psize = document.getElementById("psize").value;
						

                    if(pname == "Own Frame") {
                        document.getElementById("pname").innerHTML = "* You Must Enter the name or description of the Frame";
                        hasErrors = true;
                    } else {
                        document.getElementById("pname").innerHTML = "*";
                    }
                    if(pcolor == "Own Frame") {
                        document.getElementById("pcolor").innerHTML = "* You Must Enter The Color of Frame";
                        hasErrors = true;
                    } else {
                        document.getElementById("pcolor").innerHTML = "*";
                    }
                    if(psize == "Own Frame") {
                        document.getElementById("psize").innerHTML = "* You Must enter color or description of the Frame";
                        hasErrors = true;
                    }
					if(hasErrors != false) {alert('Please change Own Frame to the frame information');}
                });
            });
</script>  
-->
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

            </style>

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
							<button onclick="form_submit()" name='Add2Cart' value='Add to Cart' class="btn btn-success">
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
            <header class="panel-heading">
                <?php echo "Point of Sale"; ?> 
                <div class="col-md-4 no-print pull-right"> 
				<button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();">
					<?php echo lang('print'); ?>
				</button>

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
						                    

                    </ul>
                </header>
 
                <div class="panel">
                    <div class="tab-content">
					
                        <div id="services" class="tab-pane"> 
							<div class="">
                                <div class="adv-table editable-table ">                    
                    <table class="table table-striped table-hover table-bordered" id="sellservices">
                    
                        <thead>
                                            <tr>
                                                <th><?php echo 'id'; ?></th>
                                                <th><?php echo 'Service Name'; ?></th>
                                                <th><?php echo 'Service Price'; ?></th>
                                                <th><?php echo 'Added by'; ?></th>
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
                     									<td><?php echo $service->user; ?></td>
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
                    
                    <table class="table table-striped table-hover table-bordered" id="sellframes">
                    
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
<!-- below is used to add the search to a page -->

<script>
                                    $(document).ready(function () {
                                        $('#sellservices').DataTable({
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
                                        $('#sellframes').DataTable({
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

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">
            <header class="panel-heading">
                <?php "Point of Sale"; ?> 
                <div class="col-md-4 no-print pull-right"> 
                <div id="message"></div>
				<?php /*
						//if ($this->ion_auth->in_group('admin','Receptionist','Doctor')) {
					?>
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?>
                            </button>
                        </div>
                    </a>
				<?php //} */?>

          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
    
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
                    
                    <table class="table table-striped table-hover table-bordered" id="sellnow">
                    <form action="" class="form-submit">
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
							 
  							<?php foreach ($medicines as $medicine) { ?>
  									
                                              <tr>
                                            <td><input type='text' size="15" readonly name='pname' id='pid' value="<?php echo $medicine->name; ?>" /></td>
                     						<td><input type='text' readonly name='pname' id='pid' value="<?php echo $medicine->effects; ?>" /></td>
                     						<td><?php echo $medicine->category; ?></td>
                     						<td><?php echo $medicine->box; ?></td>
                     						<td><?php echo $medicine->quantity; ?></td>
                     						<td><?php echo $medicine->quantity_2; ?></td>
                     						<td><?php echo $medicine->s_price; ?></td>
                     									
                     						 <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>			
                     									<td class="no-print">
                     	<button class="btn btn-info no-print btn-xs btn_width btn-warning addtocart"><i class="fas fa-cart-plus"></i>Add to cart</button>
                     								<!--	<a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="medicine/deleteFrameType?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>-->
                     									
                     									</td>
                                                   <?php //} ?>
                                                   
                <input type="hidden" class="pid" value="<?= $medicine->id ?>">
                <input type="hidden" class="pname" value="<?= $medicine->name ?>">
                <input type="hidden" class="pcat" value="<?= $medicine->category ?>">
                <input type="hidden" class="pcolor" value="<?= $medicine->effects ?>">
                <input type="hidden" class="psize" value="<?= $medicine->box ?>">
                <input type="hidden" class="pqty" value="<?= $medicine->quantity ?>">                                
                <input type="hidden" class="pqty2" value="<?= $medicine->quantity_2 ?>">                                
                <input type="hidden" class="pprice" value="<?= $medicine->s_price ?>">                                                              
                                                   </tr>
                                                  
                                                 <?php } ?>

                        </tbody>
                        </form> 
                    </table>
                    




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
                                        $('#sellnow').DataTable({
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
  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addtocart").click(function(e) {
      e.preventDefault();
      var $form = $(this).find(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pcat = $form.find(".pcat").val();
      var pcolor = $form.find(".pcolor").val();
      var psize = $form.find(".psize").val();
      var pqty = $form.find(".pqty").val();
      var pqty2 = $form.find(".pqty2").val();
      var pprice = $form.find(".pprice").val();

      $.ajax({
        url: './db/newSale.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pcat: pcat,
          pcolor: pcolor,
          psize: psize,
          pqty: pqty,
          pqty2: pqty2,
          pprice: pprice

        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: './db/newSale.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>


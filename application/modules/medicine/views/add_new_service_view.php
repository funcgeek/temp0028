<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel-body col-md-12">
            <header class="panel-heading">
                <?php
                if (!empty($medicine->id))
                    echo 'Add New Services';
                else
                    echo 'Add New Services';
                ?>
            </header>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
			
                <form role="form" action="medicine/addNewService" class="clearfix" method="post" enctype="multipart/form-data">
                   <div class="row">
                     <div class="col-md-3">
					
                        <label for="exampleInputServiceName"> <?php echo 'Service Name'; ?></label><br>
                        <input type="text" name="service_name"  placeholder="" required="">
					</div>
				
					<div class="col-md-9">			
                        <label for="exampleInputServicePrice"> <?php echo 'Service Price'; ?></label><br>
                      <input type="number" class="" size="90" name="service_price"  placeholder="" required="">
                      <input type="hidden" name="type" value="services"  >
					
					</div>
					</div>
					<div class="row"><p>&nbsp;</p>
                       <center><button type="submit" name="submit" class="btn btn-info"> <?php echo 'Add New'; ?></button></center>
                   
					</div>
                </form>
			
                                    </div>

                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body" id="frameType">
                                <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th><?php echo 'id'; ?></th>
                                                <th><?php echo 'Service Name'; ?></th>
                                                <th><?php echo 'Service Price'; ?></th>
                                                <th><?php echo 'Added by'; ?></th>
                                                
                                                <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php // } ?>
                                            </tr>
                                        </thead>
							   <?php foreach ($categories as $category) { ?>
											<?php if ($category->service_name <> NULL){ ?>
                                              <tr>
												
                     									<td><?php echo $category->id; ?></td>
                     									<td><?php echo $category->service_name; ?></td>
                     									<td><?php echo $category->service_price; ?></td>
                     									<td><?php echo $category->user; ?></td>
                     									
                     						 <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>			
                     									<td class="no-print">
													<!--	<button type="button" class="btn btn-info btn-xs btn_width editbutton no-print" data-toggle="modal" <!-- data-target="#myModal2"  data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"> </i>Edit</button>                 								
														<button type="button" class="btn btn-info btn-xs btn_width editbutton no-print" data-toggle="modal"  data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"> </i>Edit</button>                     -->  								
														<a href="#editbutton" class="btn btn-default btn- editbutton id="editbutton" data-toggle="modal" data-id="<?php echo $category->id; ?>" >Edit</a>
														<a class="btn btn-info btn-xs btn_width delete_button" title="<?php echo lang('delete'); ?>" href="medicine/deleteServices?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                     									</td>
                                                   <?php //} ?>
                                                   </tr>
                                                 <?php } 
												 }
												 ?>
                                    			
                                    			</table>
											</div>
                            </section>
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
<!-- Edit frame type Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('edit_medicine_category'); ?></h4>
            </div>
            <div class="modal-body row">
			<table class="table table-striped table-hover table-bordered" id="editable-sample1">				
                <form role="form" id="editCategoryForm" action="medicine/addNewService" class="clearfix" method="post" enctype="multipart/form-data">
                   <div class="row">
                     <div class="col-md-3">
					
                        <label for="exampleInputCategory"> <?php echo 'Service Name'; ?></label><br>
                        <input type="text" name="service_name"   placeholder="" required="">
					</div>
				
					<div class="col-md-9">			
                        <label for="exampleInputDescription"> <?php echo 'Service Price'; ?></label><br>
                      <input type="number" class=""  name="" value='' placeholder="">
					
					</div>
					</div>
					<div class="row"><p>&nbsp;</p>
                       <center><button type="submit" name="submit" class="btn btn-info"> <?php echo 'Add New'; ?></button></center>
                   
					</div>
                </form>				
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
	</table>
</div>
<!-- Edit frame type Modal-->

<style>
    .wrapper{
        padding: 24px 30px;
    }
</style>

<script type="text/javascript">
                                    $(document).ready(function(){
									    $('.editbutton').on('show.bs.modal', function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editCategoryForm').trigger("reset");
                                            $('#myModal').modal('show');
                                            $.ajax({
                                                url: 'medicine/editServiceTypeByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editCategoryForm').find('[name="id"]').val(response.frametype.id).end()
                                                $('#editCategoryForm').find('[name="service_name"]').val(response.medicine.service_name).end()
                                                $('#editCategoryForm').find('[name="service_price"]').val(response.medicine.service_price).end()
                                            });
                                        });
                                    });
</script>									

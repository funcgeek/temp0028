<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel-body col-md-12">
            <header class="panel-heading">
                <?php
                if (!empty($medicine->id))
                    echo 'Add Frame Type Items';
                else
                    echo 'Add Frame Type Items';
                ?>
            </header>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
				 <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                <form role="form" action="medicine/addNewFrameTypeItems" class="clearfix" method="post" enctype="multipart/form-data">
                   <tr>
                     <td>
					
                        <label for="exampleInputname"> <?php echo 'Lens Type'; ?></label><br>
                        <select class="" name="frame_type"  value=''  >
						<option value=""><?php echo lang('select'); ?></option>
                            <?php foreach ($frame_types as $frame_type) { ?>
                                <option value="<?php echo $frame_type->name; ?>" >
                                	 <?php echo $frame_type->name; ?> 
                                	 
                                </option>
                            	
                                <?php } ?>
                                
                        </select>
                    
					</td>
					<td>
                        <label for="exampleInputname"> <?php echo 'Name'; ?></label><br>
                        <input type="text" name="name"  value='' placeholder="">
					</td>
				
					<td>			
                        <label for="exampleInputprice"> <?php echo 'Price'; ?></label><br>
                      <input type="text"  name="price"  value='' placeholder="">
					
					</td>
					</tr>
					<tr>
					<td colspan="3">
					<p>&nbsp;</p>
                       <center><button type="submit" name="submit" class="btn btn-info"> <?php echo 'Add New'; ?></button></center>
                    </td>
                    </tr>
                </form>
				</table>
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
                                                <th><?php echo 'Lens Type'; ?></th>
                                                <th><?php echo 'Name'; ?></th>
                                                <th><?php echo lang('price'); ?></th>
                                                <th><?php echo 'Added by'; ?></th>
                                                
                                                <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                <?php //} ?>
                                            </tr>
                                        </thead>
							   <?php foreach ($categories as $category) { ?>
                                              <tr>
												
                     									<td><?php echo $category->id; ?></td>
                     									<td><?php echo $category->frame_type_name; ?></td>
                     									<td><?php echo $category->name; ?></td>
                     									<td><?php echo $category->price; ?></td>
                     									<td><?php echo $category->user; ?></td>
                     									
                     						 <?php //if (!$this->ion_auth->in_group(array('Patient'))) { ?>			
                     									<td class="no-print">
                     									<a class="btn btn-success btn-xs edit_button" title="edit" data-toggle = "modal" data-id="<?php echo $category->id; ?>"><i class="fa fa-edit"> </i>Edit</a>
                     									
                     									<a class="btn btn-danger btn-xs delete_button" title="<?php echo lang('delete'); ?>" href="medicine/deleteFrameItems?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                     									</td>
                                                   <?php //} ?>
                                                   </tr>
                                                 <?php } ?>
                                    			
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


<style>
    .wrapper{
        padding: 24px 30px;
    }
</style>

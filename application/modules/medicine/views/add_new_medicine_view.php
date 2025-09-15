<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel-body col-md-12">
            <header class="panel-heading">
                <?php
                if (!empty($medicine->id))
                    echo lang('edit_medicine');
                else
                    echo lang('add_medicine');
                ?>
            </header>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
			<table width="100%" >
                <form role="form" action="medicine/addNewMedicine" class="clearfix" method="post" enctype="multipart/form-data">
                <button type=submit onclick="return false;" style="display:none;"></button>
                    <tr align="right">
					<td >
                        <label for="exampleInputEmail1"> <?php echo lang('model'); ?></label>
                        <input type="text" name="name"  value='' placeholder="">
					</td>
					<td>
					
                        <label for="exampleInputEmail1"> <?php echo 'Brand|Category';//lang('category'); ?></label>
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
					<td>
					<div > 
                        <label for="exampleInputEmail1"> <?php echo 'Size';//lang('store_box'); ?></label>
                        <input type="text" class="" name="box" value='' placeholder="">
                    </div>	
					
					</td>
					</tr align="right">  
					
					<tr>
					<td>
					 <div class="">
					 <?php if ($this->ion_auth->in_group('admin','Doctor')) { ?>
                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                        <input type="text" class="" name="price" id="exampleInputEmail1" value='' placeholder="">
                        <?php } ?>
                    </div>
					</td>
					<td>
                    <div >
                        <label for="exampleInputEmail1"> <?php echo lang('color'); ?></label>
                        <input type="text" class="" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    </td>					
					

					<td>
					 <div class="">
                        <label for="exampleInputEmail1"><?php echo 'Selling Price';//lang('s_price'); ?></label>
                        <input type="text" class="" name="s_price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					</td>
					</tr>
					
					
					<tr><td colspan=3>&nbsp;</td></tr>
					<tr>
					<td>
					
                    <div class="">
                        <label for="exampleInputEmail1"> <?php echo '<b><u>Locations</u></b>';//lang('category'); ?></label>
                        <select class="form-control m-bot15" name="location"  value='' required>
						<option value="Montego Bay"><font color="red">Montego Bay</font></option>
                        </select>
                    </div>                    					
					</td>
					
					<td>
					<div class="">
                        <label for="exampleInputEmail1"> <font color="red"><?php echo lang('quantity'); ?></font></label>
                        <input type="text" class="" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
					</td>
					<td>&nbsp;</td>
					</tr>					
					<tr><td colspan=3>&nbsp;</td></tr>
					<tr>
					<td>
                    <div class="">
                        <select class="form-control m-bot15" name="location_2"  value='' required>
						<option value="Falmouth">Falmouth</option>
                        </select>
                    </div>                    					
					</td>
					<td>
					<div class="">
                        <label for="exampleInputEmail1"> <font color="green"><?php echo lang('quantity'); ?></font></label>
                        <input type="text" class="" name="quantity_2" id="exampleInputEmail1" value='' placeholder="">
                        <input type="hidden" class="" name="type" value='frames'>
                    </div>
					</td>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td colspan="3" align="center">
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
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

<?php
//this file gets the remote information for doctor notes on the NAS
include('remdb.php');
//end database connection 
			
		@$id = $patient_material->patient;
		@$queryd = "SELECT * FROM patient_material WHERE patient=".$id;
		@$resultd = $dbremote->query($queryd);

if (@$resultd->num_rows > 0) {
  // output data of each row
  while(@$rowd = $resultd->fetch_assoc()) {   ?>
								
                                              <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">
                                                <div class="">
												
												<?php
												$doc_url = 'http://192.168.0.157/'.$rowd['url'];
												$path_parts = 'http://192.168.0.157/'.$rowd['url'];
												$thumb_nail = pathinfo(parse_url($path_parts, PHP_URL_PATH), PATHINFO_EXTENSION);

												if($thumb_nail == "pdf"){ ?>
												<font color="red"><b><center>
													<?php
                                                    if (!empty($rowd['title'])) {
                                                        echo $rowd['title'];
                                                    }
                                                    ?>
													</center></b></font>
													<embed src="<?php echo $doc_url; ?>" width="100" height="100" />
												<br><a href="<?php echo $doc_url; ?>" target="_blank">view</a> 
												<?php	}elseif(!empty($thumb_nail) && $thumb_nail <> 'pdf'){ ?><font color="red"><b><center>
												<?php
                                                    if (!empty($rowd['title'])) {
                                                        echo $rowd['title'];
                                                    }
                                                    ?></center></b></font>
													<img src="<?php echo $doc_url; ?>" height="100" width="100">
													<br><a href="<?php echo $doc_url; ?>" target="_blank">view</a><br>
												<?php }else{
														$thumb_nail = '';
												}														
												 ?>
													
                                                </div>
                                                <div class="post-info">
                                                    <?php
                                                    if (!empty($doc_url)) {
														echo basename($doc_url);
                                                    }
                                                    ?>
													
<!--  For testing -->								<br>
													<?php if($rowd['multi_image'] == 'yes'){?>
													<a id="getAdditionalRemoteImages" class="btn btn-info btn_width btn-xs" data-toggle="modal" href="#getAdditionalRemoteImages_modal" 
															 data-id="<?php echo $rowd['image_id']; ?>">
															<i class="fa fa-plus-circle"> </i>More Images </a>
												<?php	}	?>	
<!-- end of testing -->														
													<br>
												   <a class="btn btn-info btn-xs btn_width" href="<?php echo $doc_url; ?>" download> <?php echo lang('download'); ?> </a> <br>
                                                  
													</div>


                                                <hr>

                                            </div>
                                
 <?php } 
} else {
  echo "0 results";
}

	


?>

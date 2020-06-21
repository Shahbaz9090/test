
   
						<div class="row">
                        
                        <div class="col-sm-12"><?=get_flashdata();?></div>
                        
                        <div class="col-sm-12">
						<?php if(isset($status) && $status){?>
                           <a href="<?=SITE_PATH?>product/add/subproduct" class="btn btn-success btn-sm pull-left  " ><i class="ace-icon fa fa-plus"></i> Add SubProduct</a>  
                        <?php }else{ ?>
                           <a href="<?=SITE_PATH?>product/add" class="btn btn-success btn-sm pull-left  " ><i class="ace-icon fa fa-plus"></i> Add Facility</a>
                        <?php } ?> 
                        </div>
      
                        <!---------------------------------------grid goes here------------------------->
                        
                        <?php
                         $data['controller']='product';
                         $data['status'] = $status;
                         $this->load->view('grid',$data);
                         ?>
                       
                        <!------------------------------------------------------------------------------->
                        
                        
                        
                        
                        
                        
                        
						</div><!-- /.row -->
                        
                        
                        
                        

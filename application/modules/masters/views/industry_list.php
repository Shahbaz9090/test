
   
						<div class="row">
						
                        <a href="<?=SITE_PATH?>masters/industry/add" class="btn btn-success pull-left btn-sm add-user-button" ><i class="ace-icon fa fa-plus"></i> Add Industry</a>
                        
                          <?php if(@$this->session->flashdata('success'))
                                {?><br /><br /><br />
                                <div class="alert alert-success">
																<button type="button" class="close" data-dismiss="alert">
																	<i class="ace-icon fa fa-times"></i>
																</button>

																<strong>
																	<i class="ace-icon fa fa-check"></i>	</strong>
																<?php echo strip_tags($this->session->flashdata('success')) ;?>
															

																
																<br>
															</div>
                                                            
                                                            <?php }?>
                                                            
                                           <?php if(@$this->session->flashdata('error'))
                                {?>                    
                                                    <br /><br /><br />        
                                                            <div class="alert alert-danger">
																<button type="button" class="close" data-dismiss="alert">
																	<i class="ace-icon fa fa-times"></i>
																</button>

																<strong>
																	<i class="ace-icon fa fa-times"></i>
                                                                    	</strong>
																<?php echo strip_tags($this->session->flashdata('error'));?>
															

																
																<br>
															</div>
                                                            
                                                            <?php } ?>
                        <!---------------------------------------grid goes here------------------------->
                        
                        <?php
                        $data['controller']='masters/industry';
                         $this->load->view('grid',$data);
                         ?>
                       
                        <!------------------------------------------------------------------------------->
                        
                        
                        
                        
                        
                        
                        
						</div><!-- /.row -->
                        
                        
                        
                        

 <?php		

	

include 'grid_helper.php';



	   $this->lang->load('flexy_grid',get_site_language());

	   

	   //$uri = $this->session->userdata("current_uri");    

          //pr($base_url);  

	  // $uri = str_replace("/list_items/","",$uri);

	   $uri = str_replace(SITE_PATH,"",$grid['base_url']);

       

	   $userinfo = currentuserinfo();

	   $permission = get_permissions_lists();

	   $add = FALSE;

	   $delete = FALSE;

	   $export = FALSE;

	   $view = FALSE;

     $edit = FALSE;

     if($uri=='form_module')

    {

       $uri = $uri.'/'.$dynamic_module_name;

    }



	   

	   foreach($permission as $k =>$v)

	   {

	  

			if($v == AT_ADD && $uri.'/add' == $k)

				$add = TRUE;

			if($v == AT_DELTE && $uri.'/delete' == $k)

				$delete = TRUE;

			if($v == AT_EXPORT && $uri.'/export' == $k)

				$export = TRUE;

			

			if($v == AT_VIEW && $uri.'/view' == $k)

				$view = TRUE;

			if($v == AT_EDIT && $uri.'/edit' == $k)

				$edit = TRUE;

			

	   }

?>

    <style>

    .dataTables_paginate {

float: right;

text-align: right;

margin-top: 0px;

}

.box .dataTables_info {

margin-top: 0px;

margin-bottom: 15px;

color: #4E5F70;

font-weight: normal;

}



.scheckbox {margin-right: 2px;}



    </style>

<?php

    foreach($grid['result'] as $key=>$val){

      $ids[]=$val->id;

    }

    $main_ids = implode(',',$ids);

    //pr($grid);die;

    $page_offset = $grid['page_offset'];

    $limit=$grid['limit'];

    $total=$grid['total'];

    $page=$page_offset;

    $offset=1;

    $total_cols=count($grid['cols'])+2;



?>

   

                <div id="table-box" style="overflow-x: auto;">                 

				<table class="responsive table table-bordered draggable table-striped" id="dragdata1">

				   <thead>

					  <tr>

					  	<th id="sh" style="min-width: 50px;width:50px;vertical-align: middle;">SN.<span id="sn" style="cursor: pointer;"><i class="iconic-icon-cog" style="color:#555;float: right;margin-top:2px;"></i></span>

                        <div class="relative-table">

                        

                         <div  id="checkbox_div" class="absolute-table">

                              <span class="table-close">&times;</span>

                              <div class="checker" id="uniform-undefined"><span><input type="checkbox" name="checkBox" value="checkBox" class="scheckbox" ></span></div><div class="checker" id="uniform-undefined"><span><input type="checkbox" /></span></div><br/>

					            <?php

                                foreach($grid['cols'] as $k=>$v){

                                ?>

        						<div class="checker" id="uniform-undefined"><span> <input type="checkbox" name="<?=$v['name']?>" id="schk_<?=$v['name']?>" value="<?=$v['name']?>" class="scheckbox " ></span></div><?=$v['display']?><br/>

        						<?php

                                }

                                ?>

						</div>

                        </div></th>

                        <th id="all-checkbox" class="checkBox" style="min-width: 50px;width:50px;vertical-align: middle;"><div class="checker" id="uniform-undefined"><span><input type="checkbox" class="all-checkbox" /></span></div></th>

                        <?php

                        

                        foreach($grid['cols'] as $k=>$v){

                        ?>

						<th style="vertical-align: middle;" id="<?=$v['name']?>" class="<?=$v['name']?> <?php if(isset($v['order_by']) && $v['order_by'] == 'yes') { ?>order_by<?php } ?>"><?=$v['display']?></th>

						<?php

                        }

                        ?>

          <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

						<th style="min-width:70px;vertical-align: middle;"><?='action'?></th>

          <?php } ?>

					  </tr>

					</thead>

					<tbody>

						<?php

                            //pr($grid);exit;

						  if($grid['result']){

							foreach($grid['result'] as $key=>$val){

						?>

							<tr id="row-<?=$val->id?>" <?php if(!empty($val->tr_color)){ ?> class="<?=$val->tr_color?>" <?php } ?>>								

								<td><?=($limit*($page_offset-1))+$key+1?></td>

                                <td class="checkBox ischecked"><div class="checker" id="uniform-undefined"><span><input type="checkbox" class="single-checkbox" value="<?=$val->id?>" id="single-checkbox-<?=$val->id?>" /></span></div></td>

								 <?php

                        foreach($grid['cols'] as $k=>$v){

                        ?>

						<td class="<?=$v['name']?>"><?=$val->{$v['name']};?></td>

						<?php

                        }

                        ?>

								    



								<td>

									<?php

                                    $uri=strtolower($this->uri->segment(1));

                                    $uri2=strtolower($this->uri->segment(2));

                                    $uri_arr=array('demo','paid');

                                     if($uri=='customer' && $uri2!="requests")

                                     {

                                        if(!in_array($uri2,$uri_arr)){

                                        ?>

                                        	

                                   	<?php

										if($val->status==0){

									?><a title="Verify" data-toggle="modal" data-target="#myModal1" class="tip view" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

										 <a title="Create" rel="<?=$val->status?>" class="tip  create" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-hand-right"></i></a>

									<?php } else{?>

                                    <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                    <?php } ?>

                                       <a title="Comment" dir="<?=$val->id?>" data-toggle="modal" data-target="#myModal" class="tip in-process" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-comment"></i></a>

                                       <?php if($val->status!='1'){ ?>

								       <a title="Delete" class="tip delete-customer" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

                                       <?php } ?>

                                        

                                     <?php 

                                     

                                    }

                                    else{ ?>

                                           

                                     <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'].'/edit/'.$val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                

                                    <?php }}

                                    elseif($uri=="scr")

                                    {?>

                                     <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                      <?php endif; ?>

                                   <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>            

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'].'/edit/'.$val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                 <?php endif; ?>

                                 <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                 <a title="Generate PDF" class="tip" href="<?=SITE_PATH?>scr/invoice_pdf/<?=$val->id?>" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-print"></i></a>

                                 <?php endif; ?>

                                

                                    <?php }

                                    elseif($uri=="job_order")

                                    { ?>

                                      <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif; ?>   &nbsp;

                                        <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>     

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'].'/edit/'.$val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif; ?>

                                

                                <?php if($userinfo->is_super_site || $userinfo->is_super || $add):?>     

                                 <a title="Generate SCR" rel="" class="tip view_scr_candidate"  <?php if(isset($val->link) && $val->link=="yes"){ ?> job_id="<?=$val->id?>" data-toggle="modal" data-target="#view-scr-candidate" <?php } ?> style="cursor:pointer;" ><i class="icon-file"></i></a>

                                <?php endif; ?>

                                

                                        

                                    <?php }

                                    elseif($uri=="candidate" && $uri2=="ajax_list_items")

                                    {?>

                                    

                                      <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif; ?>   &nbsp;

                                        <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>     

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'].'/edit/'.$val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif; ?>

                                

                                <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>     

                                 <a title="Add Comment" rel="" class="tip add_candidate_comment" style="cursor:pointer;" dir="<?=$val->id?>" data-toggle="modal" data-target="#add-candidate-comment"><i class="icon-comment"></i></a>

                                <?php endif; ?>

                                

                                        

                                   <?php  }

                                   elseif($uri=="vendor" && $uri2=="ajax_list_items"){

                                    ?>    

                                   <?php                                     

                                   }      

                                   elseif($uri=="customer" && $uri2=="requests"){

                                    ?>                                    

                                    <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif; ?>   &nbsp;

                                        <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>     

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

                               

                                <?php endif; ?>

                                

                                <?php

								}elseif ($uri == "form_module" && ($uri2 == "dynamic" || $uri2 == "ajax_list_items")) {

                                    

										$key = $key-1;

									

									?>                   <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>

                                  		  <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/dynamic_edit/' . $val->form_id ."/". $dynamic_module_id ."/" . $dynamic_module_name?>" style="cursor:pointer;" ><i class="fa fa-edit"></i></a>

										                    <?php endif;?>

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/dynamic_view/' . $val->form_id ."/". $dynamic_module_id ."/" . $dynamic_module_name?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

										  

                                           <?php endif;?>   &nbsp;

                                        <?php //if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <!--<a title="Delete" rel="" class="tip delete-dynamic-value-requests" id="<?=$dynamic_module_id?>" data = "<?=$val->form_id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>-->



                                <?php //endif;?>







                                

                                <?php                                     

                                   }      

                                   elseif($uri=="billing" && $uri2=="requests"){

                                    ?>                                    

                                    <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?>  

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'].'/view/'.$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif; ?>   &nbsp;

                                        <?php if($userinfo->is_super_site || $userinfo->is_super || $edit):?>     

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

                               

                                <?php endif; ?>

                                

                                  <?php                                     

                                   }else

                                     {

                                    ?>

                                     <?php if($userinfo->is_super_site || $userinfo->is_super || $view):?> 

                                     <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php } ?>

                                        <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>    

                                         <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                        <?php } ?>

                                        <?php endif; ?>

								

								         

									<?php

                                    }?>

								       

                                       

								

								</td>

                                 

							</tr>

						<?php

							 }

						  }else{

						?>

						<tr><td  id="no-customer" colspan="<?=($total_cols+1)?>">No record found.</td></tr>

						<?php

						  }

						?>

					</tbody>

                 </table>

                   <div id="show_grid_bsy" style="display:none;position:absolute;top:0px;left:0px;height:100%;width:100%; background-color: #FFFAFA;opacity: 0.7;">

                 <img src="<?php echo PUBLIC_URL;?>images/loaders/clock.gif" style="margin-top:17% ;margin-left:48%;" />

                 </div>

                 </div>

                 

                 <div class="row-fluid">

                    <div class="span8">

                        <div class="dataTables_info" id="sample_1_info">

                        Showing <?php 

                        if($page_offset>0){

                             echo ($limit*($page_offset-1))+1; 

                        }else{

                            echo 1;

                        }

                        ?> to <?php 

                        $next = null;

                        if($page_offset<1){

                            if($limit > $total){

                                $next.= $total;

                            }else{

                                $next.= $limit;   

                            }

                        }elseif($limit*$page_offset < $total){

                            $next.= ($limit*$page_offset);

                        }elseif(@$hiddenLimit>0){

                            $next.= $total;

                        }else{

                            $next.= $total;

                        }

                        echo $next;

                        

                        ?> of <?=$total?> entries</div>

                    </div>

                     <?php  if($total>$limit){  ?>

                    <div  class="span2"><span class="go-to-page">Go To Page</span>

                        <form onsubmit="changePagination(page.value);return false;">

                            <input type="number" name="page" id="page" value="<?=$page_offset?>" min="1" max="<?=ceil($total/$limit)?>" style="width:40px; height:17px; float: right;padding:4px 5px;margin-top: 1px;" placeholder="Page"   />

                        </form>

                    </div>

                    <?php  }  ?>

                    <div class="span2">

                         <?php

        					$data['page_offset'] = $page_offset; 

        					$data['limit'] = $limit;

        				    $data['total'] = $total;

        				    $data['page'] = $page;

        					echo $this->load->view("kg_grid/ajax_pagination",$data);

            			?>

                    </div>

                </div>

                

                

  <script type="text/javascript" src="<?=PUBLIC_URL?>js/kg.datagrid/ajax.main.js"></script> 

   <script src="<?=PUBLIC_URL;?>js/dragtable.js"></script>



   <script type="text/javascript">

     $(document).ready(function(){

      //alert('<?=$total_amt?>')

      $("#main_ids").val('<?=$main_ids?>');

     })



   </script>






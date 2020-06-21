    <main class="app-content">
      	<?php $this->load->view("includes/breadcrumb"); ?>
        <?= get_flashdata(); ?>
        <div class="box">
    		<div class="title">
    			<h4><i class="fa fa-th"></i> <?php echo $page_heading ?></h4>
    		</div>

        	<div class="tile-footer search-container">
	            <div class="row">
	                <div class="col-md-8">
	                    <form class="form-inline" action="<?=base_url($controller)?>" method='GET'>
	                        <input value="<?=isset($_GET['name'])?$_GET['name']:''?>" type="text" class="form-control" name="name" placeholder="Search">&nbsp;
	                        <select class="form-control" name="status">
	                            <option value="">Status</option>
	                            <option <?=isset($_GET['status']) && $_GET['status']==1?'selected':''?> value="1">Active</option>
	                            <option <?=isset($_GET['status']) && $_GET['status']==2 && $_GET['status']!=''?'selected':''?> value="2">Inactive</option>
	                        </select>&nbsp;
	                        <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-search"></i>Search</button>&nbsp;
	                        <button onclick="location.href='<?=base_url($controller)?>'" type="reset" class="btn btn-secondary"><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>
	                    </form>
	                </div>
	                <div class="col-md-4">
	                    <a class="btn btn-info text-right" href="<?=base_url($controller.'/add')?>"><i class="fa fa-fw fa-lg fa-plus"></i>Add More</a>&nbsp;
	                </div>
	            </div>
	        </div>
        </div>
        <!-- <div class="line"></div> -->
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="pagination_link row">
                <div class="col-sm-6 text-left">
                    <b><?php echo $total_title ?>:</b><?=$total_record?>
                </div>
                <div class="col-sm-6 text-right">
                    <?=$pagination_link?>
                </div>
            </div>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead class="table-head">
                  <tr>
                    <th>Sr.No.</th>
                    <th>Form Name</th>
                    <th>Source Code</th>
                    <th>View On Menu</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  
                </thead>
                <tbody>
                   <?php
                   if(count($data_list)){
                    $i=$total_pages+1;
                    foreach ($data_list as $row){?>
                  <tr style="background: <?=$row->view_on_left==1?'':'#e8bbbb5c'?>">
                    <td><?=$i?>.</td>
                    <td><?=ucwords($row->form_label)?></td>
                    <td><?=$row->source_code?></td>
                    <td><?=$row->view_on_left==1?'Yes':'No'?></td>
                    <td><a onclick="return confirm('Do you realy want to change status?')" class="label <?=$row->status==1?'label-success':'label-danger'?>" href="<?=base_url('form_module/status/')?><?=$row->id?>/<?=$row->status?>"><?=$row->status==1?'Active':'Inactive'?></a></td>
                    <td class="text-center">
                    	<a href="<?=base_url('form_module/view/')?><?=$row->id?>"><i class="app-menu__icon fa fa-eye"></i></a>
                      <a href="<?=base_url('form_module/edit/')?><?=$row->id?>"><i class="app-menu__icon fa fa-edit"></i></a>
                    	<a onclick="return confirm('Do you realy want to delete <?=$row->form_label?>?\n It can`t be restore.')" href="<?=base_url('form_module/delete/')?><?=$row->id?>"><i class="app-menu__icon fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php $i++; }}
                   else {?>
                    <tr><td colspan="6" style="color: red;text-align: center;font-size: .9em;">No record exist</td></tr>
                    <?php }?>
                </tbody>
              </table>
            </div>
            <div class="pagination_link row">
                <div class="col-sm-6 text-left">
                    <b><?php echo $total_title ?>:</b><?=$total_record?>
                </div>
                <div class="col-sm-6 text-right">
                    <?=$pagination_link?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>

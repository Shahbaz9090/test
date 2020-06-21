
   
						<div class="row">
						
                        <!--<a href="<?=SITE_PATH?>opportunity/add" class="btn btn-success pull-left btn-sm add-user-button" ><i class="ace-icon fa fa-plus"></i> Add Opportunity</a>-->
                        
                        <div class="col-sm-12"><?=get_flashdata();?></div>
                        <!---------------------------------------grid goes here------------------------->
                        <div class="col-sm-12">
						<div class="col-sm-6">
							<a href="<?=SITE_PATH?>lead/add" class="btn btn-success btn-sm pull-left  " ><i class="ace-icon fa fa-plus"></i> Add Lead</a>
						</div>
						<div class="col-sm-6">
							<div class="col-sm-3">
								<select name="filter_by" class="form-control">
									<option value="added_by" <?= (@$_GET['filter_by'] == 'added_by')?'selected':'selected' ?>>Added By</option>
									<option value="assigned_telemarketer" <?= (@$_GET['filter_by'] == 'assigned_telemarketer')?'selected':'' ?>>Assigned Telemarketer</option>
									<option value="assigned_salesperson" <?= (@$_GET['filter_by'] == 'assigned_salesperson')?'selected':'' ?>>Assigned Salesperson</option>
								</select>
							</div>
							<div class="col-sm-3">
								<input name="search" id="search" class="form-control" value="<?= (@$_GET['search'])?@$_GET['search']:"" ?>" placeholder = "Keyword">
							</div>
							<div class="col-sm-3">
								<input class="form-control date-range-picker col-xs-12 date-picker-small active" autocomplete="off" type="text" name="duration" value="<?= (@$_GET['duration'])?@$_GET['duration']:"" ?>" id="id-date-range-picker-1" placeholder="Date Range">
							</div>
							<div class="col-sm-3">
								<button name="submit" id="submit" class="btn btn-primary">Search</button>
								<?php if(@$_GET['search'] != ''){ ?>
									<span style="color:red;cursor:pointer;" class="clear_search">clear</span>
								<?php } ?>
							</div>
							
						</div>
					</div>
                        <?php
                        $data['controller']='opportunity';
                        $data['status']=$status;
						if(@$this->input->get('user'))
						{
							$data['user']	=	@$this->input->get('user');
						}else if(@$this->input->post('user'))
						{
							$data['user']	=	@$this->input->post('user');
						}
						if(@$this->input->get('duration'))
						{
							$data['duration']	=	@$this->input->get('duration');
						}else if(@$this->input->post('duration'))
						{
							$data['duration']	=	@$this->input->post('duration');
						}
						if(@$this->input->get('filter_by'))
						{
							$data['filter_by']	=	@$this->input->get('filter_by');
						}
						if(@$this->input->get('search'))
						{
							$data['search']	=	@$this->input->get('search');
						}
						$this->load->view('grid',$data);
                         ?>
                       
                        <!------------------------------------------------------------------------------->
                        
                        
                        
                        
                        
                        
                        
						</div><!-- /.row -->
                        
               <script>
	$("#submit").click(function(){
		let filter_by 	= 	$("select[name='filter_by']").val();
		let search 		= 	$("input[name='search']").val();
		search 			=	search.trim();
		let duration    =	$("input[name='duration']").val();
		if(search == ''){
			alert("Please enter search keyword.");
			return false;
		}else{
			window.location.href = '<?= base_url() ?>opportunity/list_items/working?filter_by='+filter_by+'&search='+search+'&duration='+duration;
		}
		
	});
	$(".clear_search").click(function(){
		window.location.href = '<?= base_url() ?>opportunity/list_items/working';
	});
</script>         
                        
                        

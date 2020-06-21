
<div class="grid_10" style="margin-left: 10px;">
 <?php echo get_flashdata();?>
</div>
    


	<div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang('search_title')?></span>
				</h4>

			</div>
			<div class="content">

		<!--	<form action="<?=$base_url?>/ajax_list_items/" method="post" id="form">-->
            <?php echo form_open("$base_url/ajax_list_items/",array('id'=>'form') );  ?>
				<div class="form-row row-fluid">
					<div class="span4">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('filter_by')?><em>*</em></label>
								<select name="search_by" class="span8">
                                    <option value="global_search" ><?=lang('global_search')?> </option>
                                    <option value="site.name" ><?=lang('name')?> </option>
                                    <option value="site.email" ><?=lang('email')?> </option>
                                    <option value="site.description" ><?=lang('description')?> </option>
                                    <option value="site.website" ><?=lang('website')?></option>
                                </select>  
						</div>
					</div>


					<div class="span3">
						<div class="row-fluid">
							 <input class="span10 required" type="text"name="keyword" autocomplete="off" />
						</div>
					</div>


					<div class="span2">
						<div class="row-fluid">
							<button class="btn marginR10" type="submit" name="Submit" value="Search" id="Submit">Search</button>
							
						</div>
					</div>

				</div>

				</form>

			</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>








<div class="grid_10">
    <table class="flexme" style="display: none"></table>
     <?php 
     $this->load->view('_flexy_grid_functions',$flexigrid);
     ?>             
</div>

  
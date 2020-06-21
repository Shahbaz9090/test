<!-- BEGIN CONTENT -->
<!--<script src="<?php echo base_url().'assets/admin/layout/scripts/common_functions.js'?>"></script>-->
<div class="grid_10">
	<table class="flexme" style="display: none"></table>
	<?php 
	//pr($grid);die;
 $this->load->view('kg_grid/grid',$grid);
	?>
</div>
<!-- END CONTENT -->

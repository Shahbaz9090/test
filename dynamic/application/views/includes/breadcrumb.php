<div class="app-title">
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i></a></li>
      <?php 
      foreach ($breadcrumbs as $key => $breadcrumb) {
      	// echo $breadcrumb;
      	if(!empty($breadcrumb))
      	{?>
      	
      		<li class="breadcrumb-item active"><a href="<?php echo $breadcrumb; ?>"><?php echo $key ?></a></li>
       		
      <?php } else{?>
      	<li class="breadcrumb-item active"><?php echo $key ?></li>
      <?php } } ?>
    </ul>
</div>
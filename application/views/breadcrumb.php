<?php

if(!isset($active))
$active = '';   
if(!isset($module_link))
$module_link = '';   

if(!isset($module_lev1))
$module_lev1 = '';   


if(!isset($module_lev1_link))
$module_lev1_link = '';   

if(!isset($module))
$module = '';   

if(!isset($submodule))
$submodule = ''; 



$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
$segment3 = $this->uri->segment(3);

?>

<div class="row-fluid mb15">

    <div class="span10">
        <div class="breadcrumb-erookie">
        	<a href="<?=SITE_PATH.'dashboard'?>" class="<?php if($active == 'dashboard'){ ?>active<?php } ?>">Dashboard</a>
            <?php if($module){ ?>
        	<a href="<?=$module_link?>" class="<?php if($active == $module){ ?>active<?php } ?>" ><?php echo $module;  ?></a>
            <?php } ?>
        	<?php if($module_lev1){ ?>
        	<a <?php if($module_lev1_link) { ?> href="<?=$module_lev1_link?>"  <?php } ?>><?php echo $module_lev1;  ?></a>
            <?php } ?>
            <?php if($submodule){ ?>
        	<a class="active"><?php echo $submodule;  ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="span2">
        <?php if(@$segment2 == 'list_items' || $segment3 == 'list_items' || $segment1 == 'dashboard' ){  ?>
        <div class="erookie-search"><span title="Search" class="tip brocco-icon-search" style="color: #1b9ba5; margin-top:3px; cursor: pointer;"></span></div>
        <?php
        }
        if($segment1 == 'dashboard'){
        ?>
        <div class="erookie-setting"><span title="Dashboard Settings" class="tip iconic-icon-cog" style="color: #1b9ba5;margin-top:3px; cursor: pointer;"></span></div>
        <?php
        }
		if($segment1=='filter_installation'){
        ?>
		<div class="erookie-setting"><span title="Filter Settings" class="tip iconic-icon-cog" style="color: #1b9ba5;margin-top:3px; cursor: pointer;"></span></div>
        <?php
        }
		?>
    </div>

</div>
<script>
 $(function(){
    $("#search").hide();
    $(".erookie-search").click(function(){
               $("#search").slideToggle(); 
    }); 
  });  

</script>

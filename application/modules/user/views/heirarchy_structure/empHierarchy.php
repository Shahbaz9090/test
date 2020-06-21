<link type="text/css" rel="stylesheet" href="<?=PUBLIC_URL?>css/admin-layout.css"/>
<link type="text/css" rel="stylesheet" href="<?=PUBLIC_URL?>assets/css/time-attendance.css"/>

<?php  $cls = $this->router->fetch_class();



?>
 <div class="row-fluid">	
	<div class="span12">		
		<div class="box">
			<div class="title">
                <h4>
					 <span><?=@$submodule?></span>
                     <span class="grid-button " style="height: 22px !important;margin-top: -5px;" >
                    <!-- <div class="fbutton show_addon_form" id="add_button"><div>	<span class="add-plan" ><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>New Add-on</span></div></div>
                    -->
                     
                     <div class="fbutton show_addon_form" id="hide_button" style="display: none;"><div>	<span class="add-plan" ><span aria-hidden="true" class="cut-icon-minus-2 grid-list-icon"></span>Hide</span></div></div>
                    </span>
                    
				</h4>
                <a class="minimize" href="#" style="display: none;">Minimize</a>
			</div>

    <div class="content">
    
    
    
    
    
<div class="portlet box blue <? if($cls == 'employee') {?><? }?>">
	<div class="portlet-title">
		<div class="caption"><? if($cls == 'employee') {?>My Team<? }else{ /*echo $title;*/    }?> </div>
        <div align="right"><a href="#" id="expandAll">Expand All</a><a href="#" id="collapseAll" style="display:none;">Collapse All</a>&nbsp;|&nbsp;<a href="#" onclick="getTree('<?=$cls?>');">Reset</a></div>
	</div>
	<div class="portlet-body" style="overflow:visible">
    <div class="tabbable tabbable-custom tabbable-full-width">
	<? if($cls == 'employee') {?>
   <ul class="nav nav-tabs">
     <!-- <li ><a href="<?=base_url().'subcompany/employee/emp_hierarchy_tree'?>" >Tree View</a></li>-->
      <li class="active"><a data-toggle="tab" href="#tab_1_2">Chart View</a></li>
    </ul>
    <? }?>
        <div class="table-responsive" id="mainassetDiv" style="padding:10px 0 0 0;">
            <div class="table-toolbar">
                <div class="row-fluid">
                	 <div class="span12" id="treeDiv">
                
                	</div>
                </div>
             </div>
        </div>
        </div>
    </div>         
</div>  






 </div>
        </div>
    </div>
</div>
    
<script type="text/javascript">
$(function(){
	var $_clss = '<?=$cls ?>';
	getTree($_clss);
});
function getTree(clss)
{
	$('#treeDiv').html('<img id="loadImg" style="margin-left: 35%;" src="'+baseurl+'assets/images/loader.gif" width="120" height="35" border="0" alt="">');
	$.ajax({
			type : 'GET',
			//async: false,
			url : '<?php echo base_url();?>user/hierarchy',
			//data: ""+token_name+"="+$("[name='"+token_name+"']").val(),
			success: function(result) {
				console.log(result);
				//return false;
				if(result) 
				{ 
					$('#treeDiv').html(result);
				} 
				else 
				{
					alert('Server issue #','Please report this issue if problem persists');
				}
			},
			error: function (request, status, errorThrown) {
				alert(status +","+ errorThrown);
			}
		});
}
</script>

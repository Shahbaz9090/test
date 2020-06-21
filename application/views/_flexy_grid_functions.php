<?php		
		$page=getPerPage("per_page");
		if($page){
			$per_page=$page;
		}else{
			$per_page=20;
		}

	   $this->lang->load('flexy_grid',get_site_language());
	   
	   $uri = $this->session->userdata("current_uri");               
	   $uri = str_replace("/list_items/","",$uri);
	   
	  
	   $userinfo = currentuserinfo();
	   $permission = get_permissions_lists();
	   $add = FALSE;
	   $delete = FALSE;
	   $export = FALSE;
	   $actions = FALSE;
	 
	
	   
	   foreach($permission as $k =>$v)
	   {
	  
			if($v == AT_ADD && $uri.'/add' == $k)
				$add = TRUE;
			if($v == AT_DELTE && $uri.'/delete' == $k)
				$delete = TRUE;
			if($v == AT_EXPORT && $uri.'/export' == $k)
				$export = TRUE;
			
			if($v == AT_VIEW && $uri.'/view' == $k)
				$actions = TRUE;
			if($v == AT_EDIT && $uri.'/edit' == $k)
				$actions = TRUE;
			
	   }
?>
<script type="text/javascript">
function addFormData() 
{ 
 
//passing a form object to serializeArray will get the valid data from all the objects, but, if the you pass a non-form object, you have to specify the input elements that the data will come from 
var dt = $('#form').serializeArray(); 
$(".flexme").flexOptions({params: dt}); 
return true; 
} 
 
$('#form').submit 
( 
    function () 
        { 
            $('.flexme').flexOptions({newp: 1}).flexReload(); 
            return false; 
        } 
);            


jQuery(document).ready(function ($) {
   
    $(".all_check").live("click",function(){ 
        if($(this).attr('checked') == "checked")
        {
             $('.flexme tbody tr').addClass("trSelected");
             $('.single_checkbox').attr('checked', true );
        }
        else
        {
            $('.flexme tbody tr').removeClass("trSelected");
            $('.single_checkbox').attr('checked', false );
        }
    }); 
    
    
	$(".flexme").flexigrid({
		
		dataType : 'json',                
        url : '<?=$base_url?>/ajax_list_items',
		colModel : [
        {
			display : '<input type="checkbox" class="all_check" >',
			name : 'checkbox',
			width :50,
			sortable : false,
			align : 'center'
		},{
			display : '<?=lang('fl_sno')?>',
			name : 'sno',
			width : 20,
			sortable : false,
			align : 'center'
		},
        <?php 
            foreach($cols as $row){
                echo '{';
                foreach($row as $k=>$v) {
                    echo $k.' : "'.$v.'",';
                }
                echo '},';
            }
        ?> 
        <?php if($userinfo->is_super_site || $userinfo->is_super || $actions):?>     
        {
			display : 'Actions',
			name : 'actions',
			width : 120,
			sortable : false,
			align : 'center'
		}
		<?php endif;?>
        ],
		buttons : [ 
		<?php if($userinfo->is_super_site || $userinfo->is_super || $add): ?>	
		{
			name : 'Add',
			bclass : 'add',
			onpress : test
		},
        {
			separator : true
		},
		<?php endif ?>
		<?php if($userinfo->is_super_site || $userinfo->is_super || $delete): ?>	
        {
			name : 'Delete',
			bclass : 'delete',
			onpress : test
		},
        {
			separator : true
		},
		<?php endif ?>
		<?php if($userinfo->is_super_site || $userinfo->is_super || $export): ?>	
        {
			name : 'Export',
			bclass : 'export',
			onpress : test
		}, {
			separator : true
		}
		<?php endif ?>
		 ],
        title    : "<?=lang('list_title');?>",
		sortname : "<?=$sortname?>",
		sortorder : "desc",
		usepager : true,
		useRp : true,
		rp : '<?=$per_page?>',                          
		height : 540,
        onSubmit: addFormData, 
	});
   }); 
	
</script>         
                    
                    
                    
                    
<script>   

function performAction(className){    
    if(className =='add'){
        location.href='<?=$base_url?>/add';
    }else{
        var listitems = '';
        $('.trSelected input[type="checkbox"]:checked').each(function(){
            listitems += $(this).val()+',';
        });
        
        
        var total_items = listitems.split(',');
        var arr_length = (total_items.length)-1;
        
        if(className =='export'){            
            if(arr_length > 0){
                if(confirm('<?=lang("fl_export")?> ' + arr_length + ' <?=lang("fl_export_items")?>'))
                {
                  location.href='<?=$base_url?>/export/?items='+listitems;
                }
            }else{                
                alert('Please select atleast one record');
                return false;
            }
            
        }else if(className =='delete'){
            if(arr_length > 0){
                if(confirm('<?=lang("fl_delete")?> ' + arr_length + ' <?=lang("fl_export_items")?>'))
                {
                    
                    $.ajax({
                       type: "POST",
                       url: "<?=$base_url?>/delete/",
                       data: token_name+"="+token_hash+"&items="+listitems,
                       success: function(data){
                        $('.flexme').flexReload();
                        if(data == 'YES')
                        {
                          alert("<?=lang('fl_delete_length_sucess')?>");
                        }
                       }
                    }); 
                }
            }else{
                alert('Please select atleast one record');
                return false;
            }
            
            
        }
    }
}   
function test(com, grid) {
    
	if (com == 'Delete') 
    {
		if($('.trSelected',grid).length>0)
        {
           if(confirm('<?=lang("fl_delete")?> ' + $('.trSelected',grid).length + ' <?=lang("fl_export_items")?>'))
           {
                var items = $('.trSelected',grid);
                
                if(items.length > <?=$delete_limit?>)
                {
                    alert("<?=lang('fl_delete_length_error')?>"+<?=$delete_limit?>);
                    return false;
                }
                
                var itemlist ='';
                for(i=0;i<items.length;i++){
                    itemlist+= items[i].id+",";
                }
                
                
                $.ajax({
                   type: "POST",
                   url: "<?=$base_url?>/delete/",
                   data: token_name+"="+token_hash+"&items="+itemlist,
                   success: function(data){
                    $('.flexme').flexReload();
                    if(data == 'YES')
                    {
                      alert("<?=lang('fl_delete_length_sucess')?>");
                    }
                   }
                });
                
                
                
            }
        } else {
            return false;
        }
      
	}
    else if (com == 'Add') 
    {
	   location.href='<?=$base_url?>/add'; 
	}
    else if(com == "Export")
    {
      if($('.trSelected',grid).length>0){
           if(confirm('<?=lang("fl_export")?> ' + $('.trSelected',grid).length + ' <?=lang("fl_export_items")?>'))      {
                var items = $('.trSelected',grid);
                
                if(items.length > <?=$export_limit?>)
                {
                    alert("<?=lang('fl_export_length_error')?> "+<?=$export_limit?>);
                    return false;
                }
                
                var itemlist ='';
                for(i=0;i<items.length;i++){
                    itemlist+= items[i].id+",";
                }
                
                location.href='<?=$base_url?>/export/?items='+itemlist; 
                 
            }
        } else {
            return false;
        }        
    }
}
</script>
<table class="table table-bordered">
    <thead>
        <tr>
           
            <th width="60">S. No.</th>
            <th width="">Form Name</th>
			 <th width="">Source Code</th>
            <th width="60">Status </th>
            <th width="140">Action </th>
        </tr>
    </thead>
    <?php
    if (isset($result) && !empty($result['result'])) 
	{
        $i = $start + 1;
        foreach ($result['result'] as $row) 
		{ ?>
            <tbody>
                <tr align="left">
                   
                    <td > <?php echo $i; ?> </td>
                    <td > <?php echo  $row->form_name; // str_replace('_',' ',$row->form_name); ?> </td>
                    <td > <?php echo $row->source_code; ?> </td>
					
                    <td>
                        <?php if ($row->status == 1) { ?>
                            <span class="label label-sm label-success">Active </span>
                        <?php } else { ?>
                            <span class="label label-sm label-danger">In-active </span>
                        <?php } ?>
                    </td>
					
                    <td>                 
                        <a href="<?php echo base_url('form_module/view/' . ID_encode($row->id)); ?>" class="btn btn-xs blue"> <i class="fa fa-search-plus"></i> </a>                     
                        <a href="<?php echo base_url('form_module/edit/' . ID_encode($row->id)); ?>"  class="btn btn-xs btn-success"> <i class="fa fa-pencil-square-o"></i> </a> 
						<a href="<?php echo base_url('form_module/delete/' . ID_encode($row->id)); ?>"  class="btn btn-xs delete" onclick=" return confirm('Are you really want to delete?')"> <i class="fa fa-trash-o"></i> </a>
					</td>
                </tr>
            </tbody>
		<?php $i++; }
    } 
	else 
	{ ?>
        <tbody>
            <tr>
                <td colspan="7" align="center"> <strong>No Result Found </strong></td>
            </tr>
        </tbody>
	<?php } ?>
</table>
<?php
$paging = custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
echo $paging;
?>
<div id="myModal_pos" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				
				
			</div>
			<div class="modal-body" id="postion_content">
				
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>

<script>

function pos_postion(pos_val,row_id)
{
//alert();return false;
   mypopup_postion(pos_val,row_id);
}
function mypopup_postion(pos_val,row_id)
{
	var token_value=$( "input[name='"+token_name+"']" ).val();
	$.ajax({
		type : 'POST',
		url : '<?php echo base_url().'support/postion_popup/';?>',
		data :  token_name+"="+token_value+"&pos_val="+pos_val+"&row_id="+row_id,
		beforeSend : function()
		{
			$('#postion_content').html();				
		},
		success : function(res)
		{

			$('#postion_content').html(res);										
		}
	});
}

</script>
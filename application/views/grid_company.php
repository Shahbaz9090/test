 
 <style>
 #paginate_btn{cursor: pointer;}
 </style>
                     
                         <div class="col-xs-12 col-sm-12 widget-container-col">
								<!-- #section:custom/widget-box -->
								<div class="widget-box">
										<div class="widget-header">
												<h5 class="widget-title">Listing</h5>

												<!-- #section:custom/widget-box.toolbar -->
												<div class="widget-toolbar">
													

													<a href="#" data-action="fullscreen" class="orange2">
														<i class="ace-icon fa fa-expand"></i>
													</a>

													<a href="#" data-action="reload">
														<i class="ace-icon fa fa-refresh"></i>
													</a>

													<!--<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>-->

													<a href="#" data-action="close">
														<i class="ace-icon fa fa-times"></i>
													</a>
												</div>

												<!-- /section:custom/widget-box.toolbar -->
											</div>

										<!-- <div class="table-responsive"> -->

										<!-- <div class="dataTables_borderWrap"> -->
										<div>
											<div id="sample-table-2_wrapper" class="dataTables_wrapper form-inline no-footer">
                                            <div class="row"><div class="col-xs-6">
                                            <div class="dataTables_length" id="sample-table-2_length">
                                            <?php echo form_open('',array('id'=>'search_grid')); ?>
                                            <label>Display <select  aria-controls="sample-table-2" class="form-control input-sm change_limit" name="change_limit">
                                            <option value="10">10</option><option value="25">25</option>
                                            <option value="50">50</option><option value="100">100</option>
                                            </select> records</label></div></div><div class="col-xs-6">
                                            <div id="sample-table-2_filter" class="dataTables_filter">
                                            <label class="w42"><input type="search" class="form-control input-sm search-box" placeholder="Search" aria-controls="sample-table-2" name="search_text" id="search_text" /></label> 
                                            <input type="hidden" id="grid_order_by" value="modified" name="order_by" />
                                            <input type="hidden" id="grid_order" value="desc" name="order"  />
                                            <input type="hidden" id="page" value="1" name="page"  />
                                            <input type="hidden" id="max_page_val"   />
                                            <input type="hidden" id="min_page" value="1" />
                                            <input type="hidden" id="max_page" value="3" />
                                            <input type="hidden" id="dynamic" name="dynamic" value="<?=(isset($status))?$status:null;?>" />
                                            <?php echo form_close();?></div>
                                            </div></div><table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="sample-table-2_info">
												<thead>
                                                <!-----------------------cols extends here------------------------>
													<tr role="row" id="dynamic_th">
                                                   
                                                  
                                                        
                                                      
                                                        
                                                        
                                                        </tr>
                                                        <!-----------------------end of cols extends here------------------------>
												</thead>

												<tbody id="grid_data">
                                                <!-------------------------grid data extends here---------------->
                                                
                                                
                                                <!-------------------------end of grid data extends here---------------->
												

													</tbody>
											</table><div class="row"><div class="col-xs-6"><div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                                            Showing <span id="grid_from_data"></span> to <span id="grid_upto_data"></span> of <span id="grid_total_data"></span> entries
                                            </div></div>
                                            <div class="col-xs-6"><div class="dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate">
                                            <ul class="pagination" id="paginate_btn">
                                           
                                            </ul></div></div></div></div>
										</div>
									</div>
                                 </div>   
                                
 <script type="text/javascript">

$(function(){
$("#search_grid").trigger('submit');
$(".fa-refresh").click(function(){
    $("#search_grid").trigger('submit');
});
 $('#search_txt').keydown(function (e){
    if(e.keyCode == 13){
         $("#paginate_btn").empty();
           $("#search_grid").trigger('submit');
           	$('#page').val('1');
      
    }
});   
});

var csrf_name="<?=$this->security->get_csrf_token_name()?>";
var csrf_token="<?=$this->security->get_csrf_hash()?>";
var controller="<?=$controller?>";

    

 $("#search_grid").submit(function(){
    var str=$(this).serialize();
    $.post("<?=SITE_PATH?>"+controller+"/listGridData",str,function(data){
       // alert(data);
       var obj=JSON.parse(data);
       var s_no=(($('#page').val()-1) * ($('.change_limit').val()))+1;
       $("#dynamic_th").empty();
       $("#grid_data").empty();
       
       /////////////////////to create table cols /////////////////////////////////
       if(obj['grid_cols'])
       {
            
             var table_th="";
            //table_th += "  <th class=\"center sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"\">";
//            table_th += "															<label class=\"position-relative\">";
//            table_th += "																<input type=\"checkbox\" class=\"ace\">";
//            table_th += "																<span class=\"lbl\"><\/span>";
//            table_th += "															<\/label>";
//            table_th += "														<\/th>";
            table_th += "                                                         <th class=\"center sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"\">S.No<\/th>";

            for(q in obj['grid_cols'])
            {
                if(obj['grid_cols'][q]['sorting']=='yes')
                {
                    var sort_order=$("#grid_order").val();
                     table_th += "<th class=\"hidden-480 sorting sort_grid\" sort_order=\""+sort_order+"\" data=\""+obj['grid_cols'][q]['name']+"\" tabindex=\"0\" aria-controls=\"sample-table-2\"";
                   sorting="";
                }
                else
                {
                     table_th += "<th class=\"hidden-480 \" sort_order=\"desc\" data=\""+obj['grid_cols'][q]['name']+"\" tabindex=\"0\" aria-controls=\"sample-table-2\"";
                }
               
                table_th += " rowspan=\"1\" colspan=\"1\">"+obj['grid_cols'][q]['display']+"<\/th>";
               
            }
            //table_th += "<th class=\"sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"\">Action<\/th>";
             $("#dynamic_th").append(table_th);
       }
       
       //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  
                  
                  
                  ////////////////////////////////////////////to add data in cols///////////////////////////////////////////////
                   for(p in obj['result'])
                   {
                     
                   
                                    var grid_data="";
                                    grid_data += "  <tr role=\"row\" class=\"even\">";
                                    
                                    //grid_data += "														<td class=\"center\">";
//                                    grid_data += "															<label class=\"position-relative\">";
//                                    grid_data += "																<input type=\"checkbox\" class=\"ace\">";
//                                    grid_data += "																<span class=\"lbl\"><\/span>";
//                                    grid_data += "															<\/label>";
//                                    grid_data += "														<\/td>";
                                    grid_data += "														<td class=\"center\">"+s_no+"";
                                    grid_data += "														<\/td>";
                                    
                                   
                                    for(q in obj['grid_cols'])
                                    {
                                         grid_data += "	<td>"+obj[p][obj['grid_cols'][q]['fetch_name']]+"<\/td>"; 
                                    }
                                   
                                    
                                    // grid_data += "	<td>";
                                    // grid_data += "															<div class=\"hidden-sm hidden-xs action-buttons\">";
                                    // grid_data += "																<a class=\"blue\" data-rel=\"tooltip\" title=\"View\" href=\"<?=SITE_PATH?>"+controller+"\/view\/"+obj['result'][p]['id']+"\">";
                                    // grid_data += "																	<i class=\"ace-icon fa fa-search-plus bigger-130\"><\/i>";
                                    // grid_data += "																<\/a>";
                                    // grid_data += "";
                                    // grid_data += "																<a class=\"green\" data-rel=\"tooltip\" title=\"Edit\" href=\"<?=SITE_PATH?>"+controller+"\/edit\/"+obj['result'][p]['id']+"\">";
                                    // grid_data += "																	<i class=\"ace-icon fa fa-pencil bigger-130\"><\/i>";
                                    // grid_data += "																<\/a>";
//                                                                     
                                    // grid_data += "";
                                      // if(obj['result'][p]['is_delete'] != '0'){
                                    // grid_data += "																<a class=\"red delete-grid-row\" data-rel=\"tooltip\" title=\"Delete\" data=\""+obj['result'][p]['id']+"\" href=\"#\">";
                                    // grid_data += "																	<i class=\"ace-icon fa fa-trash-o bigger-130\"><\/i>";
                                    // grid_data += "																<\/a>";
                                   // }
                                    // grid_data += "															<\/div>";
                                    // grid_data += "";
                                    // grid_data += "															<div class=\"hidden-md hidden-lg\">";
                                    // grid_data += "																<div class=\"inline position-relative\">";
                                    // grid_data += "																	<button class=\"btn btn-minier btn-yellow dropdown-toggle\" data-toggle=\"dropdown\" data-position=\"auto\">";
                                    // grid_data += "																		<i class=\"ace-icon fa fa-caret-down icon-only bigger-120\"><\/i>";
                                    // grid_data += "																	<\/button>";
                                    // grid_data += "";
                                    // grid_data += "																	<ul class=\"dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close\">";
                                    // grid_data += "																		<li>";
                                    // grid_data += "																			<a href=\"#\" class=\"tooltip-info\" data-rel=\"tooltip\" title=\"\" data-original-title=\"View\">";
                                    // grid_data += "																				<span class=\"blue\">";
                                    // grid_data += "																					<i class=\"ace-icon fa fa-search-plus bigger-120\"><\/i>";
                                    // grid_data += "																				<\/span>";
                                    // grid_data += "																			<\/a>";
                                    // grid_data += "																		<\/li>";
                                    // grid_data += "";
                                    // grid_data += "																		<li>";
                                    // grid_data += "																			<a href=\"#\" class=\"tooltip-success\" data-rel=\"tooltip\" title=\"\" data-original-title=\"Edit\">";
                                    // grid_data += "																				<span class=\"green\">";
                                    // grid_data += "																					<i class=\"ace-icon fa fa-pencil-square-o bigger-120\"><\/i>";
                                    // grid_data += "																				<\/span>";
                                    // grid_data += "																			<\/a>";
                                    // grid_data += "																		<\/li>";
                                    // grid_data += "";
                                    // grid_data += "																		<li>";
                                    // grid_data += "																			<a href=\"#\" class=\"tooltip-error\" data-rel=\"tooltip\" title=\"\" data-original-title=\"Delete\">";
                                    // grid_data += "																				<span class=\"red\">";
                                    // grid_data += "																					<i class=\"ace-icon fa fa-trash-o bigger-120\"><\/i>";
                                    // grid_data += "																				<\/span>";
                                    // grid_data += "																			<\/a>";
                                    // grid_data += "																		<\/li>";
                                    // grid_data += "																	<\/ul>";
                                    // grid_data += "																<\/div>";
                                    // grid_data += "															<\/div>";
                                    // grid_data += "														<\/td>";
                                    grid_data += "													<\/tr>";
                                    
                            
                                        $("#grid_data").append(grid_data);
                                        $('[data-rel=tooltip]').tooltip();
                                        s_no++;
                        
            }
       
       ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
       //////////////////////grid lower funcnality goes here///////////////////////////////////////////
       
       $("#grid_from_data").html($("#grid_data").children().eq(0).children().eq(0).html());
       
       $("#grid_upto_data").html($("#grid_data").children().last().children().eq(0).html());
       
       var record=$(".change_limit").val();
       var total_record=obj['total_data'];
       var int_page=Math.ceil(total_record/record);
       
       if(+record * +3 < +obj['total_data'])
       {
        
        if($("#paginate_btn").children().length==0)
        {
        
        var paginate_btn="";
        var active="";
        
            paginate_btn += "<li class=\"paginate_button previous\" aria-controls=\"sample-table-2\" tabindex=\"0\" id=\"paginate_prev_btn\" data=\"prev\"><a >Previous<\/a><\/li>";
                
                
                for(i=1;i<=3;i++)
                {
                    if(i==1)
                    {
                        active="active";
                    }
                    else
                    {
                        active="";
                    }
                    
                   paginate_btn += "<li class=\"paginate_button "+active+" p_number\" aria-controls=\"sample-table-2\" tabindex=\"0\" data=\""+i+"\"><a >"+i+"<\/a><\/li>";
                      
                }
                
         
            paginate_btn += "<li class=\"paginate_button next\" aria-controls=\"sample-table-2\" tabindex=\"0\" id=\"paginate_next_btn\" data=\"next\"><a >Next<\/a><\/li>";
            $("#paginate_btn").append(paginate_btn);
            }

             
       }
       
       else
       {
         if($("#paginate_btn").children().length==0)
        {
         var paginate_btn="";
         
             for(i=1;i<=int_page;i++)
                {
                    if(i==1)
                    {
                        active="active";
                    }
                    else
                    {
                        active="";
                    }
                    
                   paginate_btn += "<li class=\"paginate_button "+active+" p_number\" aria-controls=\"sample-table-2\" tabindex=\"0\" data=\""+i+"\"><a >"+i+"<\/a><\/li>";
                      
                }
                 $("#paginate_btn").append(paginate_btn);
         }
       }
     
       var actual_page=$("#page").val();
       
       var int_page=Math.ceil(total_record/record);
       $("#max_page_val").val(int_page);
       
       if($("#paginate_btn").children().eq(3).attr('data') == int_page)
       {
          $("#paginate_next_btn").hide();
        }else{
           $("#paginate_next_btn").show(); 
        }
       
       if($("#paginate_btn").children().eq(1).attr('data')>1)
       {
            $("#paginate_prev_btn").show();
       }
       else
       {
            $("#paginate_prev_btn").hide();
            
       }
       
       
       
       
       
       
      // $("#paginate_btn").children().eq(page_no).addClass('active');
      

       //alert($(".change_limit").val());
       
       $("#grid_total_data").html(total_record);        
       //////////////////////////////////////////////////////////////////////////////////////////////
    });
    return false;
   });
   
   
   $(".change_limit").change(function(){
      $('#page').val(1);
      /*var record=$(".change_limit").val();
      var total_record=$('#grid_total_data').text();
      var int_page=Math.ceil(total_record/record);
      $("#max_page_val").val(int_page);*/
      $("#search_grid").trigger('submit'); 
   });
   
   $(document).on('click','.paginate_button',function(){
      var paging_data=$(this).attr("data");
      var page=$('#page').val();
      var min_page=$('#min_page').val();
      var max_page=$('#max_page').val();
       var max_page_limit=$("#max_page_val").val();
      if(paging_data=="prev"){
         var page=parseInt(page)-1;
         $('#min_page').val(parseInt(min_page)-1);
         $('#max_page').val(parseInt(max_page)-1);
         
            
            var curr_page=$("#paginate_btn").children().eq(1).attr('data');
          curr_page=+curr_page - +1;
          for(i=1;i<=3;i++)
          {
            
             if((curr_page) > max_page_limit)
                 {
                    
                    return false;
                 }
                    $("#paginate_btn").children().eq(i).attr('data',curr_page);
                    $("#paginate_btn").children().eq(i).find('a').html(curr_page);
                   
                    curr_page++;
                    
                   
          }
          
          
         
      }else if(paging_data=="next"){
         var page=parseInt(page)+1;
         $('#min_page').val(parseInt(min_page)+1);
         $('#max_page').val(parseInt(max_page)+1);
     
          var curr_page=$("#paginate_btn").children().eq(1).attr('data');
          curr_page=+curr_page + +1;
          for(i=1;i<=3;i++)
          {
            
             if((curr_page) > max_page_limit)
                 {
                    
                    return false;
                 }
                    $("#paginate_btn").children().eq(i).attr('data',curr_page);
                    $("#paginate_btn").children().eq(i).find('a').html(curr_page);
                   
                    curr_page++;
                    
                   
          }
         
             
      }else{
         $(this).addClass('active');
         $(this).siblings().removeClass('active');
         var page=paging_data;
      }
      
      
      $('#page').val(page);
      $("#search_grid").trigger('submit');
      
   });

$(document).on('click','.sort_grid',function(){
     $("#grid_order_by").val($(this).attr('data'));
     var sort_order=$(this).attr('sort_order');
     if(sort_order=='desc')
     {
        $("#grid_order").val('asc');
        $(this).attr('sort_order','asc')
     }
     else
     {
         $("#grid_order").val('desc');
         $(this).attr('sort_order','desc')
     }
     $("#search_grid").trigger('submit');
  });
  
  
$(document).on('click','.delete-grid-row',function(){
    var delete_row=$(this).attr('data');
    
    var c = confirm("Sure to delete?");
        if (c == true) {
            $(this).parents().eq(1).parent().remove();
            $.post('<?=SITE_PATH?>'+controller+'/deleteGridRow',csrf_name+'='+csrf_token+'&delete_row='+delete_row);
        } else {
            return false;
        }

    
    
    
    });

   
</script>

<span id="lead_id" style="display: none;"><?=$lead_id;?></span>  
<span id="url" style="display: none;"><?=base_url('opportunity/save_appointment');?></span>
<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-sm-12">
										<div class="space"></div>

										<!-- #section:plugins/data-time.calendar -->
										<div id="calendar"></div>
										<!-- /section:plugins/data-time.calendar -->
									</div>

								<!--	<div class="col-sm-3">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4>Draggable events</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="external-events">
														<div class="external-event label-grey ui-draggable ui-draggable-handle" data-class="label-grey" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 1
														</div>

														<div class="external-event label-success ui-draggable ui-draggable-handle" data-class="label-success" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 2
														</div>

														<div class="external-event label-danger ui-draggable ui-draggable-handle" data-class="label-danger" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 3
														</div>

														<div class="external-event label-purple ui-draggable ui-draggable-handle" data-class="label-purple" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 4
														</div>

														<div class="external-event label-yellow ui-draggable ui-draggable-handle" data-class="label-yellow" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 5
														</div>

														<div class="external-event label-pink ui-draggable ui-draggable-handle" data-class="label-pink" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 6
														</div>

														<div class="external-event label-info ui-draggable ui-draggable-handle" data-class="label-info" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 7
														</div>

														<label>
															<input type="checkbox" class="ace ace-checkbox" id="drop-remove">
															<span class="lbl"> Remove after drop</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>-->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
                        <?php
                        //_pr($result);exit;
                        
                        ?>
<script>

$(function(){
   /* initialize the calendar
	-----------------------------------------------------------------*/

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
    
    var val = '<?=$result?>';
    if(val){
        var jobj=JSON.parse('<?=$result?>');    
    }else{
        jobj = null;
    }
    
    

	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		 buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
	
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: jobj
		,
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { // this function is called when something is dropped
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			var $extraEventClass = $(this).attr('data-class');
			
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
			
		}
		,
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			var date_obj=new Date(start);
            var clicked_date=date_obj.getFullYear()+'-'+(date_obj.getMonth()+1)+'-'+date_obj.getDate();
			bootbox.prompt("Appointment Title:", function(title) {
			    var lead_id=$('#lead_id').text();//alert(lead_id);
                var hit_url=$('#url').text();
                if(title){
                   //var eventId=save_appointment(hit_url,lead_id,title,clicked_date);
                   $.ajax({
                         type: "POST",
                         url:hit_url,
                         data:token_name+'='+token_hash+'&lead_id='+lead_id+'&title='+title+'&appointment_date='+clicked_date,
                         beforeSend:function(){
                                beforeAjaxResponse();
                           },
                           success: function(msg){ 
                                 afterAjaxResponse();
                                 if (title !== null) {
                					calendar.fullCalendar('renderEvent',
                						{
                						    id:msg,
                							title: title,
                							start: start,
                							end: end,
                							allDay: allDay,
                							className: 'label-info'
                						},
                						true // make the event "stick"
                					);
                				}
                                  
                           }
                    }); 
                }
                
				
			});

			calendar.fullCalendar('unselect');
		}
		,
		eventClick: function(calEvent, jsEvent, view) {
            console.log(calEvent);
			//display a modal
			var modal = 
			'<div class="modal fade">\
			  <div class="modal-dialog">\
			   <div class="modal-content">\
				 <div class="modal-body">\
				   <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
				   <form class="no-margin">\
					  <label>Change event name &nbsp;</label>\
                      <input  type="hidden" id="appointmentId" value="' + calEvent.id + '" />\
                  	  <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
					 <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
				   </form>\
				 </div>\
				 <div class="modal-footer">\
					<button type="button" class="btn btn-sm btn-danger" data-action="delete" ><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
					<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
				 </div>\
			  </div>\
			 </div>\
			</div>';
		
		
			var modal = $(modal).appendTo('body');
			modal.find('form').on('submit', function(ev){
				ev.preventDefault();
                update_appointment($('#appointmentId').val(),$(this).find("input[type=text]").val());
				calEvent.title = $(this).find("input[type=text]").val();
				calendar.fullCalendar('updateEvent', calEvent);
				modal.modal("hide");
			});
			modal.find('button[data-action=delete]').on('click', function() {
			    if(calEvent.id){
			       deleteAppointment(calEvent.id);
			    }  
				calendar.fullCalendar('removeEvents' , function(ev){
					return (ev._id == calEvent._id);
				})
				modal.modal("hide");
			});
			
			modal.modal('show').on('hidden', function(){
				modal.remove();
			});


			//console.log(calEvent.id);
			//console.log(jsEvent);
			//console.log(view);

			// change the border color just for fun
			//$(this).css('border-color', 'red');

		}
		
	});
 
});

function update_appointment(id,title){
    $.ajax({
         type: "POST",
         url:"<?=base_url('opportunity/ajaxUpdateAppointment')?>",
         data:token_name+'='+token_hash+'&id='+id+'&title='+title,
         beforeSend:function(){
                beforeAjaxResponse();
           },
           success: function(msg){ 
                 afterAjaxResponse();                 
           }
    });
}
function beforeAjaxResponse(){
    $("#preLoader").show();
    $("#loader").show();
}

function afterAjaxResponse(){
    $("#preLoader").hide();
    $("#loader").hide();
}
function deleteAppointment(id){
    var str=token_name+'='+token_hash+'&id='+id;
    $.post("<?=base_url('opportunity/ajaxDeleteAppointment')?>",str,function(data){
        return;
    });
}
</script>
	<!-- page specific plugin scripts -->
<script src="<?php  echo SITE_PATH  ?>assets/js/jquery-ui.custom.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/jquery.ui.touch-punch.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/date-time/moment.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/fullcalendar.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/bootbox.js"></script>
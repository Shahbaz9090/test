    


<link href="<?=PUBLIC_URL?>css/heirarchy/emphierarchy.css" rel="stylesheet" type="text/css"/>
 <?php $data = _get_all_rms_in_hierarchy(4, 30);
	 	//pr($data);die;
	 	if(!empty($data['id'])) 
		{ 
            $emp_id = currentuserinfo()->id;
			$parentEmpIds[] = $emp_id;

		} //pr($parentEmpIds); die;
 ?>
<div id="container" style="overflow-x: hidden;overflow-y: hidden; padding:0px 0 74px;">

<div id="wrapperCls" class="wrapperCls">
<div class="chart-multiple-bg">
<?php foreach($parentEmpIds as $key => $parentEmpId)
{?>
<div class="hierarchy-relative-left">
<div class="wrappers"> <span class="hierarchy">
      <?php if(in_array($parentEmpId, $data['rm_id'])) 
		 {?>
			<div class="hierarchy-btn" id="btn_<?=$parentEmpId;?>" onclick="minToggle(this);" data-rmid="<?=$parentEmpId;?>" data-level="0">-</div>
	  <?php }?>
      <div class="image_bg" style="background-color:#BBC6FF;">
        <div class="image_icon"><img src="<?=$data['profile_pic'][$parentEmpId];?>" width="50" height="50" /></div>
        <div class="image_textBg">
         <div class="image_h"><?=ucfirst($data['name'][$parentEmpId]);?></div> 
          <div class="image_text"><?=@$data['dept_name'][$parentEmpId];?></div>
         <!--  <div class="image_text"><?=$data['desg_name'][$parentEmpId];?></div> --->
        </div>
      </div>
      </span>
   	<?php if(in_array($parentEmpId, $data['rm_id'])) //level 1
	   {
		  ?>   
      <div class="branch lv1" style="display:;" id="lvlDiv_<?=$parentEmpId;?>">
  	<?php  $numOfChilds = array_count_values($data['rm_id']);
		//pr($numOfChilds);die;
		foreach($data['rm_id'] AS $empid => $rmid) 
		{
			$showHierBtn = $goToNextEmp = true;
			$hasLeftCss = "";	
			if($rmid == $parentEmpId)	
			{	
				$cls = $numOfChilds[$parentEmpId] > 1 ? 'entry' : 'entry sole'; 
				if(in_array($empid, $data['rm_id'])) 
				{
					if($data['status'][$empid] == 4)
					{
						$hasLeftCss = "hierarchy-left-employee";	
					}	
				}
				else
				{
					$showHierBtn = false;
					if($data['status'][$empid] == 4)
					{
						$goToNextEmp = false;
					}	
				}
				if($goToNextEmp)
				{
			?>	
				<div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
					  <?php if($showHierBtn) 
						 { 	                        
					  ?>
                      		<div class="hierarchy-btn" id="btn_<?=$empid;?>" onclick="maxToggle(this);" data-rmid="<?=$empid;?>" data-level="1">+</div>
                      <?php }?>
                      <div class="image_bg" style="background-color: antiquewhite;">
						<div class="image_icon"><img src="<?=$data['profile_pic'][$empid];?>" width="50" height="50" /></div>
						<div class="image_textBg">
						  <div class="image_h"><?=ucfirst($data['name'][$empid]);?></div>
						 <div class="image_text"><?=$data['dept_name'][$empid];?></div>
                          <!-- <div class="image_text"><?=$data['desg_name'][$empid];?></div> --->
						</div>
					  </div>
					  </span>
                      	
				   <?php //-------------------------------------------------level 2-------------//
				   	  if(in_array($empid, $data['rm_id'])) //level 2
					  { 	                        
                   ?>
                        <div class="branch lv2" style="display:none;" id="lvlDiv_<?=$empid;?>">
							<?php  foreach($data['rm_id'] AS $empid1 => $rmid1) 
								{
									if($rmid1 == $empid)
									{
										$cls = $numOfChilds[$empid] > 1 ? 'entry' : 'entry sole'; 		
										$showHierBtn = $goToNextEmp = true; $hasLeftCss = "";	
										if(in_array($empid1, $data['rm_id'])) 
										{
											if($data['status'][$empid1] == 4)
											{
												$hasLeftCss = "hierarchy-left-employee";	
											}	
										}
										else
										{
											$showHierBtn = false;
											if($data['status'][$empid1] == 4)
											{
												$goToNextEmp = false;
											}	
										}
										if($goToNextEmp)
										{	
									?>	
                                        <div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
                                              <?php if($showHierBtn) 
												 { 	                        
											   ?>
                                              		<div class="hierarchy-btn" id="btn_<?=$empid1;?>" onclick="maxToggle(this);" data-rmid="<?=$empid1;?>" data-level="2">+</div> 
											  <?php }?>
                                              <div class="image_bg" style="background-color: beige;">
                                                <div class="image_icon"><img src="<?=$data['profile_pic'][$empid1];?>" width="30" height="30" /></div>
                                                <div class="image_textBg">
                                                  <div class="image_h"><?=ucfirst($data['name'][$empid1]);?></div>
                                                  
                                                  <div class="image_text"><?=$data['dept_name'][$empid1];?></div>
                                                  <!----
                                                  <div class="image_text"><?=$data['desg_name'][$empid1];?></div>
                                                  --->
                                                </div>
                                              </div>
                                              </span>
                                              
                                              
                                              <?php //-------------------------------------------------level 3---------------//
											      if(in_array($empid1, $data['rm_id'])) //level 3
												  { 	                        
											   ?>
													<div class="branch lv2" style="display:none;" id="lvlDiv_<?=$empid1;?>">
														<?php  foreach($data['rm_id'] AS $empid2 => $rmid2) 
															{
																if($rmid2 == $empid1)
																{
																	$cls = $numOfChilds[$empid1] > 1 ? 'entry' : 'entry sole'; 		
																	$showHierBtn = $goToNextEmp = true; $hasLeftCss = "";	
																	if(in_array($empid2, $data['rm_id'])) 
																	{
																		if($data['status'][$empid2] == 4)
																		{
																			$hasLeftCss = "hierarchy-left-employee";	
																		}	
																	}
																	else
																	{
																		$showHierBtn = false;
																		if($data['status'][$empid2] == 4)
																		{
																			$goToNextEmp = false;
																		}	
																	}
																	if($goToNextEmp)
																	{
																?>	
																	<div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
																		  <?php if($showHierBtn) 
																			 { 	                        
																		   ?>
																				<div class="hierarchy-btn" id="btn_<?=$empid2;?>" onclick="maxToggle(this);" data-rmid="<?=$empid2;?>" data-level="3">+</div> 
																		  <?php }?>
																		  <div class="image_bg" style="background-color:#FBC2FF;">
																			<div class="image_icon"><img src="<?=$data['profile_pic'][$empid2];?>" width="50" height="50" /></div>
																			<div class="image_textBg">
																			  <div class="image_h"><?=ucfirst($data['name'][$empid2]);?></div>
                                                                              <div class="image_text"><?=$data['dept_name'][$empid2];?></div>
																			  <!--
                                                                              <div class="image_text"><?=$data['desg_name'][$empid2];?></div>
                                                                              --->
																			</div>
																		  </div>
																		  </span>
                                                                          
                                                                          
                                                                          <?php //-------------------------------------------------level 4---------------//
																			  if(in_array($empid2, $data['rm_id'])) //level 4
																			  { 	                        
																		   ?>
																				<div class="branch lv2" style="display:none;" id="lvlDiv_<?=$empid2;?>">
																					<?php  foreach($data['rm_id'] AS $empid3 => $rmid3) 
																						{
																							if($rmid3 == $empid2)
																							{
																								$cls = $numOfChilds[$empid2] > 1 ? 'entry' : 'entry sole'; 		
																								$showHierBtn = $goToNextEmp = true; $hasLeftCss = "";	
																								if(in_array($empid3, $data['rm_id'])) 
																								{
																									if($data['status'][$empid3] == 4)
																									{
																										$hasLeftCss = "hierarchy-left-employee";	
																									}	
																								}
																								else
																								{
																									$showHierBtn = false;
																									if($data['status'][$empid3] == 4)
																									{
																										$goToNextEmp = false;
																									}	
																								}
																								if($goToNextEmp)
																								{
																							?>	
																								<div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
																									  <?php if($showHierBtn) 
																										 { 	                        
																								?>
																											<div class="hierarchy-btn" id="btn_<?=$empid3;?>" onclick="maxToggle(this);" data-rmid="<?=$empid3;?>" data-level="4">+</div> 
																									  <?php }?>
																									  <div class="image_bg" style="background-color:#D8F8FF;">
																										<div class="image_icon"><img src="<?=$data['profile_pic'][$empid3];?>" width="50" height="50" /></div>
																										<div class="image_textBg">
																										  <div class="image_h"><?=ucfirst($data['name'][$empid3]);?></div>
                                                                                                          <div class="image_text"><?=@$data['dept_name'][$empid3];?></div>
																										  <!--
                                                                                                          <div class="image_text"><?=$data['desg_name'][$empid3];?></div>
                                                                                                          --->
																										</div>
																									  </div>
																									  </span>
                                                                                                      
                                                                                                      
                                                                                                      
                                                                                                      <?php //------------------------------level 5---------------//
																										  if(in_array($empid3, $data['rm_id'])) //level 5
																										  { 	                        
																									   ?>
																											<div class="branch lv2" style="display:none;" id="lvlDiv_<?=$empid3;?>">
																												<?php  foreach($data['rm_id'] AS $empid4 => $rmid4) 
																													{
																														if($rmid4 == $empid3)
																														{
																															$cls = $numOfChilds[$empid3] > 1 ? 'entry' : 'entry sole'; 					
																															$showHierBtn = $goToNextEmp = true; $hasLeftCss = "";	
																															if(in_array($empid4, $data['rm_id'])) 
																															{
																																if($data['status'][$empid4] == 4)
																																{
																																	$hasLeftCss = "hierarchy-left-employee";	
																																}	
																															}
																															else
																															{
																																$showHierBtn = false;
																																if($data['status'][$empid4] == 4)
																																{
																																	$goToNextEmp = false;
																																}	
																															}
																															if($goToNextEmp)
																															{
																														?>	
																															<div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
																																  <?php if($showHierBtn) 
																																	 { 	                        
																																   ?>
																																		<div class="hierarchy-btn" id="btn_<?=$empid4;?>" onclick="maxToggle(this);" data-rmid="<?=$empid4;?>" data-level="5">+</div> 
																																  <?php }?>
																																  <div class="image_bg" style="background-color:#CDFFEA;">
																																	<div class="image_icon"><img src="<?=$data['profile_pic'][$empid4];?>" width="50" height="50" /></div>
																																	<div class="image_textBg">
																																	  <div class="image_h"><?=ucfirst($data['name'][$empid4]);?></div>
																																	  <div class="image_text"><?=@$data['dept_name'][$empid4];?></div>
                                                                                                                                      <!--
                                                                                                                                      <div class="image_text"><?=$data['desg_name'][$empid4];?></div>
                                                                                                                                      ---->
																																	</div>
																																  </div>
																																  </span>
                                                                                                                                  
                                                                                                                                  
                                                                                                                                    <?php //------------------------------level 6---------------//
																																	  if(in_array($empid4, $data['rm_id'])) //level 6
																																	  { 	                        
																																   ?>
																																		<div class="branch lv2" style="display:none;" id="lvlDiv_<?=$empid4;?>">
																																			<?php  foreach($data['rm_id'] AS $empid5 => $rmid5) 
																																				{
																																					if($rmid5 == $empid4)
																																					{
																																						$cls = $numOfChilds[$empid4] > 1 ? 'entry' : 'entry sole'; 		
																																						$showHierBtn = $goToNextEmp = true; $hasLeftCss = "";	
																																						if(in_array($empid5, $data['rm_id'])) 
																																						{
																																							if($data['status'][$empid5] == 4)
																																							{
																																								$hasLeftCss = "hierarchy-left-employee";	
																																							}	
																																						}
																																						else
																																						{
																																							$showHierBtn = false;
																																							if($data['status'][$empid5] == 4)
																																							{
																																								$goToNextEmp = false;
																																							}	
																																						}
																																						if($goToNextEmp)
																																						{
																																					?>	
																																						<div class="<?=$cls;?>"><span class="hierarchy <?=$hasLeftCss;?>">
																																							  <?php if($showHierBtn) 
																																								 { 	                        
																																							   ?>
																																									<div class="hierarchy-btn" id="btn_<?=$empid5;?>" onclick="maxToggle(this);" data-rmid="<?=$empid5;?>" data-level="6">+</div> 
																																							  <?php }?>
																																							  <div class="image_bg" style="background-color:#DDDFFF;">
																																								<div class="image_icon"><img src="<?=$data['profile_pic'][$empid5];?>" width="50" height="50" /></div>
																																								<div class="image_textBg">
																																								  <div class="image_h"><?=ucfirst($data['name'][$empid5]);?></div>
																																								  <div class="image_text"><?=@$data['dept_name'][$empid5];?></div>
                                                                                                                                                                  <!---
                                                                                                                                                                  <div class="image_text"><?=$data['desg_name'][$empid5];?></div>
                                                                                                                                                                  ---->
																																								</div>
																																							  </div>
																																							  </span>
																																						</div>
																																				<?php }} 
																																				}?>
																																		</div>
																																	 <?php }?>	
                                                                                                                                  
                                                                                                                                  
																															</div>
																													<?php }} 
																													}?>
																											</div>
																										 <?php }?>	
                                                                                                       
                                                                                                       
                                                                                                       
                                                                                                       
																								</div>
																						<?php }} 
																						}?>
																				</div>
																			 <?php }?>	
                                                                	</div>
															<?php }} 
															}?>
													</div>
												 <?php }?>		    
                                        </div>
             					<?php }} 
                                }?>
                        </div>
                     <?php }?>
				</div>
          <?php }} 
		}
 ?>
 	</div>
<?php }?>   
 </div>
 </div>
<?php }?> 
</div>
 </div>
 <!-- ===============To make draggable in Tab/Phone====================   -->  
 <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<script type="text/javascript">
/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
(function ($) {

  // Detect touch support
  $.support.touch = 'ontouchend' in document;

  // Ignore browsers without touch support
  if (!$.support.touch) {
    return;
  }

  var mouseProto = $.ui.mouse.prototype,
      _mouseInit = mouseProto._mouseInit,
      _mouseDestroy = mouseProto._mouseDestroy,
      touchHandled;

  /**
   * Simulate a mouse event based on a corresponding touch event
   * @param {Object} event A touch event
   * @param {String} simulatedType The corresponding mouse event
   */
  function simulateMouseEvent (event, simulatedType) {

    // Ignore multi-touch events
    if (event.originalEvent.touches.length > 1) {
      return;
    }

    event.preventDefault();

    var touch = event.originalEvent.changedTouches[0],
        simulatedEvent = document.createEvent('MouseEvents');
    
    // Initialize the simulated mouse event using the touch event's coordinates
    simulatedEvent.initMouseEvent(
      simulatedType,    // type
      true,             // bubbles                    
      true,             // cancelable                 
      window,           // view                       
      1,                // detail                     
      touch.screenX,    // screenX                    
      touch.screenY,    // screenY                    
      touch.clientX,    // clientX                    
      touch.clientY,    // clientY                    
      false,            // ctrlKey                    
      false,            // altKey                     
      false,            // shiftKey                   
      false,            // metaKey                    
      0,                // button                     
      null              // relatedTarget              
    );

    // Dispatch the simulated event to the target element
    event.target.dispatchEvent(simulatedEvent);
  }

  /**
   * Handle the jQuery UI widget's touchstart events
   * @param {Object} event The widget element's touchstart event
   */
  mouseProto._touchStart = function (event) {

    var self = this;

    // Ignore the event if another widget is already being handled
    if (touchHandled || !self._mouseCapture(event.originalEvent.changedTouches[0])) {
      return;
    }

    // Set the flag to prevent other widgets from inheriting the touch event
    touchHandled = true;

    // Track movement to determine if interaction was a click
    self._touchMoved = false;

    // Simulate the mouseover event
    simulateMouseEvent(event, 'mouseover');

    // Simulate the mousemove event
    simulateMouseEvent(event, 'mousemove');

    // Simulate the mousedown event
    simulateMouseEvent(event, 'mousedown');
  };

  /**
   * Handle the jQuery UI widget's touchmove events
   * @param {Object} event The document's touchmove event
   */
  mouseProto._touchMove = function (event) {

    // Ignore event if not handled
    if (!touchHandled) {
      return;
    }

    // Interaction was not a click
    this._touchMoved = true;

    // Simulate the mousemove event
    simulateMouseEvent(event, 'mousemove');
  };

  /**
   * Handle the jQuery UI widget's touchend events
   * @param {Object} event The document's touchend event
   */
  mouseProto._touchEnd = function (event) {

    // Ignore event if not handled
    if (!touchHandled) {
      return;
    }

    // Simulate the mouseup event
    simulateMouseEvent(event, 'mouseup');

    // Simulate the mouseout event
    simulateMouseEvent(event, 'mouseout');

    // If the touch interaction did not move, it should trigger a click
    if (!this._touchMoved) {

      // Simulate the click event
      simulateMouseEvent(event, 'click');
    }

    // Unset the flag to allow other widgets to inherit the touch event
    touchHandled = false;

  };

  /**
   * A duck punch of the $.ui.mouse _mouseInit method to support touch events.
   * This method extends the widget with bound touch event handlers that
   * translate touch events to mouse events and pass them to the widget's
   * original mouse event handling methods.
   */
  mouseProto._mouseInit = function () {
    
    var self = this;

    // Delegate the touch handlers to the widget's element
    self.element.bind({
      touchstart: $.proxy(self, '_touchStart'),
      touchmove: $.proxy(self, '_touchMove'),
      touchend: $.proxy(self, '_touchEnd')
    });

    // Call the original $.ui.mouse init method
    _mouseInit.call(self);
  };

  /**
   * Remove the touch event handlers
   */
  mouseProto._mouseDestroy = function () {
    
    var self = this;

    // Delegate the touch handlers to the widget's element
    self.element.unbind({
      touchstart: $.proxy(self, '_touchStart'),
      touchmove: $.proxy(self, '_touchMove'),
      touchend: $.proxy(self, '_touchEnd')
    });

    // Call the original $.ui.mouse destroy method
    _mouseDestroy.call(self);
  };

})(jQuery);
</script> 
 <!-- ===============To make draggable in Tab/Phone====================   -->  					                        
<script type="text/javascript">
$(function(){ 
<?php $cls = $this->router->fetch_class();?>
	var clss = '<?=$cls?>';
	
	wrpPosFromLeft = clss == 'empmaster' ? 66 : 66; //256;
	//setInterval(function(){ $('#wrapperCls').draggable();  }, 5000);
    $('.hierarchy').click(function(){
        $('#wrapperCls').draggable(); 
    });
    
	$('#wrapperCls').draggable(); 
	
	$('#expandAll').click(function(){
			$('.lv2').each(function(){
				var $_banch = $(this);
				$_banch.show('slow');
				$_banch.find('.hierarchy-btn').each(function(){
					$(this).attr('onClick', 'minToggle(this)').html('-');
				});
			});	
			
			$('#wrapperCls').find('.hierarchy-btn').attr('onClick', 'minToggle(this)').html('-');
			$('.lv1').show('slow');
			$('.lv1').find('.hierarchy-btn').each(function(){
					$(this).attr('onClick', 'minToggle(this)').html('-');
			});
			
			currPos = parseInt($('#wrapperCls').position().left);
			//alert(currPos);
			currPos = currPos < wrpPosFromLeft ? -(currPos - wrpPosFromLeft) : -(currPos - wrpPosFromLeft);  
			//alert(currPos);
			$('#wrapperCls').animate({'margin-left' : currPos});
			
		$('#expandAll').hide();	$('#collapseAll').show();	
	});

	$('#collapseAll').click(function(){
			$('.lv2').each(function(){
				var $_banch = $(this);
				$_banch.hide('slow');
				$_banch.find('.hierarchy-btn').each(function(){
					$(this).attr('onClick', 'maxToggle(this)').html('+');
					});
			});	
			
			$('#wrapperCls').find('.hierarchy-btn').attr('onClick', 'maxToggle(this)').html('+');	
			$('.lv1').hide('slow');
			$('.lv1').find('.hierarchy-btn').each(function(){
					$(this).attr('onClick', 'maxToggle(this)').html('+');
			});
			
			//alert($('#wrapperCls').position().top);
			//posFromTop = parseInt($('#wrapperCls').position().top) - 227;
			currPos = parseInt($('#wrapperCls').position().left);
			currPos = currPos < wrpPosFromLeft ? -(currPos - wrpPosFromLeft) : -(currPos - wrpPosFromLeft);  
			//alert(currPos);
			$('#wrapperCls').animate({'margin-left' : currPos});
			
			$('#expandAll').show();	$('#collapseAll').hide();
	});
});//dom
function maxToggle(item)
{	
    //$('#wrapperCls').draggable();
	rmid = item.getAttribute('data-rmid');
	level = parseInt(item.getAttribute('data-level'));
	$('#lvlDiv_'+rmid).show('slow');
	//alert($(item).offset().left+','+level);	
	posFromLeft = $(item).offset().left;
	if(posFromLeft > 1100)
	{
		if(level >= 3)
		{
			marginLeft = - 304 * (level - 2);
			//alert(marginLeft);
			$('#wrapperCls').animate({'margin-left' : marginLeft});
		}
	}
	$('#btn_'+rmid).replaceWith('<div class="hierarchy-btn" id="btn_'+rmid+'" onclick="minToggle(this);" data-rmid="'+rmid+'" data-level="'+level+'">-</div>');
}
function minToggle(item)
{	
    //$('#wrapperCls').draggable();
	rmid = item.getAttribute('data-rmid');
	level = parseInt(item.getAttribute('data-level'));
	//alert($(item).offset().left+','+level);		
	posFromLeft = $(item).offset().left;
	//if(posFromLeft > 800)
	//{
		marginLeft = 0;
		switch(level)
		{
			case 3 : marginLeft = 0;
			break; 	
			case 4 : marginLeft = -(304 * 1);
			break;
			case 5 : marginLeft = -(304 * 2);
			break; 	
			case 6 : marginLeft = -(304 * 3);
			break; 	
		}
		//alert(marginLeft);
		$('#wrapperCls').animate({'margin-left' : marginLeft});
	//}
	$('#lvlDiv_'+rmid).hide('slow');
	$('#btn_'+rmid).replaceWith('<div class="hierarchy-btn" id="btn_'+rmid+'" onclick="maxToggle(this);" data-rmid="'+rmid+'" data-level="'+level+'">+</div>');
}
</script>           

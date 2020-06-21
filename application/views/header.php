<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="//www.w3.org/1999/xhtml">

    <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Inch-Group</title>

    <link href="<?=PUBLIC_URL?>css/font-1.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>css/font-2.css" rel="stylesheet" type="text/css" />



    <!--[if lt IE 9]>

        <link href="<?=PUBLIC_URL?>css/font1.css" rel="stylesheet" type="text/css" />

        <link href="<?=PUBLIC_URL?>css/font2.css" rel="stylesheet" type="text/css" />

        <link href="<?=PUBLIC_URL?>css/font3.css" rel="stylesheet" type="text/css" />

        <link href="<?=PUBLIC_URL?>css/font4.css" rel="stylesheet" type="text/css" />

    <![endif]-->

    <!----------------------------------Ajax Alert popup model----------------------------->

    <link href="<?=PUBLIC_URL?>css/font-awesome.css" rel="stylesheet" type="text/css" />

    <!----------------------------------Ajax Alert popup model----------------------------->

    <script type="text/javascript">

        var baseurl = '<?php echo base_url();?>';

        var token_name = "<?=$this->config->item('csrf_token_name')?>";

        var token_hash = "<?php echo $this->security->get_csrf_hash(); ?>";



        function ajax_response_msg(replace_id,msg,response_alert){

            var className=response_alert;

            if(response_alert=="success"){

                className='span12 ajax_response_success';

            }else{

                className='span12 ajax_response_error';

            }

            var response="<div class='"+className+"'>"+msg+"</div>";

            $("#"+replace_id).html(response);

        }



    </script>



    <link href="<?=PUBLIC_URL?>css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>css/bootstrap/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>

    <link href="<?=PUBLIC_URL?>css/icons.css" rel="stylesheet" type="text/css" />

     <link href="<?=PUBLIC_URL?>css/subscription.css" rel="stylesheet" type="text/css" />

    <!-- Plugin stylesheets -->

    <link href="<?=PUBLIC_URL?>plugins/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>plugins/jpages/jPages.css" rel="stylesheet" type="text/css" />

    <link href="<?=PUBLIC_URL?>plugins/prettify/prettify.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/inputlimiter/jquery.inputlimiter.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/ibutton/jquery.ibutton.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/color-picker/color-picker.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/select/select2.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/validate/validate.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/pnotify/jquery.pnotify.default.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/pretty-photo/prettyPhoto.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/smartWizzard/smart_wizard.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/dataTables/jquery.dataTables.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/elfinder/elfinder.css" type="text/css" rel="stylesheet" />

    <link href="<?=PUBLIC_URL?>plugins/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" rel="stylesheet" />

    

    <!-- Main stylesheets -->

    

    <link href="<?=PUBLIC_URL?>css/main.css" rel="stylesheet" type="text/css" /> 

    <script src="<?=PUBLIC_URL?>js/setup.js" type="text/javascript"></script>

    <!--  HTML5, for IE6-8 support of HTML5 elements -->

    <!--[if lt IE 9]>      

      <script type="text/javascript" src="<?=PUBLIC_URL?>js/html5.js"></script>

    <![endif]-->

    <!--[if lt IE 9]>

        <link type="text/css" href="<?=PUBLIC_URL?>css/ie.css" rel="stylesheet" />

    <![endif]-->



    <!-- Le fav and touch icons -->

    <link rel="shortcut icon" href="images/favicon.ico" />

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=PUBLIC_URL?>images/apple-touch-icon-144-precomposed.png" />

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=PUBLIC_URL?>images/apple-touch-icon-114-precomposed.png" />

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=PUBLIC_URL?>images/apple-touch-icon-72-precomposed.png" />

    <link rel="apple-touch-icon-precomposed" href="<?=PUBLIC_URL?>images/apple-touch-icon-57-precomposed.png" />

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/sumoselect/sumoselect.min.css')?>">

    <script src="<?php echo base_url();?>assets/plugins/sumoselect/jquery.sumoselect.min.js"></script>

    <script>

    // Code that uses other library's $ can follow here.

    var jq = $.noConflict();

    jq(document).ready(function () {

        jq('.assign_group_multiselect').SumoSelect({search: true, searchText: 'Enter here.'});

        jq('.filter_multiselect').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select State'});

    });

    </script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.7.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/main.js"></script>

	<link rel="stylesheet" href="<?=PUBLIC_URL?>css/jquery.multiselect.css"/>

    

    <link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>plugins/chosen/chosen.css" media="screen" />



    <!-- 

        START SCRIPT FOR CHAT 

            <script src='<?php echo site_url();?>assets/js/chat/chat.js' type="text/javascript" ></script>

            <link href='<?php echo site_url();?>assets/css/chat/chat.css' type="text/css" rel="stylesheet"/>

        END SCRIPT FOR CHAT

    -->



    <!-- Breadcrumb-->

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/breadcrumb.js"></script>  

    <!-- Breadcrumb-->

    

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/bootstrap/bootstrap.js"></script>  

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.cookie.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.mousewheel.js"></script>



    <!-- Load plugins -->

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/qtip/jquery.qtip.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.grow.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.pie.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.resize.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.tooltip_0.4.4.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/flot/jquery.flot.orderBars.js"></script>



    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/sparkline/jquery.sparkline.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/knob/jquery.knob.js"></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/fullcalendar/fullcalendar.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/prettify/prettify.js"></script>



    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/watermark/jquery.watermark.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/elastic/jquery.elastic.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/inputlimiter/jquery.inputlimiter.1.3.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/maskedinput/jquery.maskedinput-1.3.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/ibutton/jquery.ibutton.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/uniform/jquery.uniform.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/stepper/ui.stepper.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/color-picker/colorpicker.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/timeentry/jquery.timeentry.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/select/select2.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/dualselect/jquery.dualListBox-1.3.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/tiny_mce/jquery.tinymce.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/validate/jquery.validate.min.js"></script>



    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/animated-progress-bar/jquery.progressbar.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/pnotify/jquery.pnotify.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/lazy-load/jquery.lazyload.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/jpages/jPages.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/pretty-photo/jquery.prettyPhoto.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/smartWizzard/jquery.smartWizard-2.0.min.js"></script>



    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/touch-punch/jquery.ui.touch-punch.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/ios-fix/ios-orientationchange-fix.js"></script>



    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/dataTables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/elfinder/elfinder.min.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/plupload/plupload.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/plupload/plupload.html4.js"></script>

    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>





    <!-- Init plugins -->

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/statistic.js"></script><!-- Control graphs ( chart, pies and etc) -->



    <!-- Important Place before main.js  -->    

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-ui.min.js"></script>



    

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.validate.js"></script>

    <!-- START JS FOR CK editor-->

    <script type="text/javascript" src="<?php echo PUBLIC_URL;?>js/ckeditor/ckeditor.js"></script>

    <!-- END JS FOR CK editor-->  

    

    <link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>flexigrid/css/flexigrid.css" /> 

    <link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>css/custom.css" /> 

    <script type="text/javascript" src="<?=PUBLIC_URL?>js/ajax.response.js"></script>

    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/jquery.scrollbars.min.css"/> 

	

    

   	

    

    </head>

      

    <body>

    <?php @include(APPPATH.'flexigrid.php');?>

    

    <div id="header">



        <div class="navbar">

            <div class="navbar-inner">

              <div class="container-fluid">

               <!-- <a class="brand" href="<?php echo SITE_PATH;?>">E-Rookie<span class="slogan">admin</span></a> -->

               <a class="brand" href="<?php echo SITE_PATH;?>"><img src="<?=PUBLIC_URL?>images/admin_logo.png" width="24%"/></a>

               

                <div class="nav-no-collapse">

                    <ul class="nav pull-right usernav">

                         <?php

                           $cuser=currentuserinfo();

						   //pr($cuser);die;

                           $username=$cuser->first_name.' '.$cuser->last_name;

                           $image=$cuser->profile_image;

                           if($image==''){

                               $image='no_image.jpeg';

                           }

                         ?>

                         <?php

                         

                         /*$get_cart_total = count_cart_total_id();

                         

                         $uri_segment = $this->uri->segment(1);

                         if($uri_segment != 'activity' && $uri_segment != 'candidate' && $uri_segment != 'error')

                         {

                            

                            delete_cart();

                            

                         }*/

                         

                         ?>



                         <?php

                            $from_date=date("Y-m-d");

                            $to_date=date("Y-m-d");

                            

                            $user_list = null;

                             $userId=currentuserinfo()->id;

                            if($cuser->added_by!=0){

                            //  $user_list = json_decode($this->session->userdata('child_list'));

                                  $user_list = child_users($userId)['total_list'];

                                //pr($user_list);die;

                            }

                            

                            $limit=4;

                            //$result=notifications($from_date,$to_date,$user_list,6,$limit);

                        //  pr($result);

                            //$total_notification=$result["total"];

                        ?>

                          <li class="dropdown">

                            <!--<a href="javascript:void(0);" class="dropdown-toggle show" data-toggle="dropdown" style="padding:3px 10px;">

                               I <span class="notification" style="padding-left:2px; padding-right:2px;"><?=$total_notification?></span>

                            </a> -->                           

                            <ul class="dropdown-menu">

                                

                            </ul>

                        </li>



                      <!--   <input type="hidden" id="show_cart_hidden" value="<?php//$get_cart_total?>" /> -->
  <input type="hidden" id="show_cart_hidden" value="" />
                        <li class="dropdown" id="show_cart" style="display: none;">

                             <a id="mail_cart" href="<?=SITE_PATH?>activity/activity_cart_email/list_items">

                                <span id="mail_cart_span" class="icon16 icomoon-icon-basket">

                                </span>Mail Cart <span id="total_mail_span" class="notification"><?php  //$get_cart_total; ?></span>

                             </a>

                        </li>

                         

                        <li class="dropdown">                            

                            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">

                                <img src="<?php echo PUBLIC_URL.'images/'.$image;?>" alt="" class="image" /> 

                                <span class="txt"><?=$username?></span>

                                <b class="caret"></b>

                            </a>

                            <ul class="dropdown-menu" >

                                <li class="menu">

                                    <ul>

                                        <li style="padding:0;margin:0;">

                                            <a href="<?php echo SITE_PATH.'user/profile_setting'?>"><span class="icon"><span class="icon16 icomoon-icon-user-3"></span>Profile Setting</span></a>

                                        </li>

                                        <li style="padding:0;margin:0;">

                                            <a href="<?php echo SITE_PATH.'user/password_setting'?>"><span class="icon"><span class="icon16 cut-icon-unlock"></span>Password Setting</span></a>

                                        </li>  

                                        <li style="padding:0;margin:0;">

                                            <a href="<?php echo SITE_PATH.'user/signature'?>"><span class="icon"><span class="icon16 entypo-icon-card"></span>Set Signature</span></a>

                                        </li>  

                                        <li style="padding:0;margin:0;">

                                            <a href="<?=base_url('auth/logout')?>"><span class="icon"><span class="icon16 brocco-icon-switch"></span>Logout</span></a>

                                        </li> 



                                    </ul>

                                </li>

                            </ul>

                         </li>

                    </ul>

                </div><!-- /.nav-collapse -->

              </div>

            </div><!-- /navbar-inner -->

          </div><!-- /navbar --> 



    </div><!-- End #header -->  

<script type="text/javascript">

    jQuery(document).ready(function($){

        $("#user_notification").click(function () {         

            $.ajax({

                type:"POST",                

                data: token_name+"="+token_hash,

                url: baseurl+"auth/notifications",

                beforeSend : function(){

                  $("#ajax_notification").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

                },

                success: function(response){

                    $("#ajax_notification").html(response);                 

                }

            });

        });



        

    

   

    });

    

    function intDetail(id){

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id,

            url: baseurl+"auth/interviewDetail",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }



    function companyLocation(id){

        $("#list_item").val(id);

        $("#location_flash").html("");

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submit=0",

            url: baseurl+"user/location/set_location",

            beforeSend : function(){

                $("#ajax_location").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;;" width="60px">');

            },

            success: function(response){

                $("#ajax_location").html(response);

            }

        });

    }



    function setCompanyLocation(){

        var country_id=$("#country").val();

        var area_name=$("#area_name").val();

        var id=$("#list_item").val();

        var msg='';

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&country_id="+country_id+"&area_name="+area_name+"&id="+id+"&is_submit=1",

            url: baseurl+"user/location/set_location",

            beforeSend : function(){

              $("#location_flash").html(""); 

              $("#ajax_submit").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif"width="25px">');

            },

            success: function(response){

                if(response==1){

                    msg="Location has been added successfully.";

                    ajax_response_msg("location_flash",msg,"success");

                    setTimeout(function(){

                            $('#locationModel').modal('hide');

                            ajax_refresh_location();

                    },2000);

                }else if(response==2){

                    msg="Location has been updated successfully.";

                    ajax_response_msg("location_flash",msg,"success");

                    setTimeout(function(){

                            $('#locationModel').modal('hide');

                            ajax_refresh_location();

                    },2000);

                }else{

                    msg=response;

                    ajax_response_msg("location_flash",msg,"error");

                }

               $("#ajax_submit").html("");

            }

        });

    }

    

    function ajax_refresh_location(id){

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash,

            url: baseurl+"user/location/ajax_list_items",

            beforeSend : function(){

              beforeAjaxResponse();

            },

            success: function(response){

                afterAjaxResponse();

                $("#ajax_location_refresh").html(response);

            }

        });

    }

    function deleteLocation(id){

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id,

            url: baseurl+"user/location/delete_location",

            beforeSend : function(){

              beforeAjaxResponse();

            },

            success: function(response){

                afterAjaxResponse();

                $("#ajax_location_refresh").html(response);

            }

        });

    }

    

/* ############################# START SCRIPT FOR ASSIGN JOB  ################################ */



    function assignJob(id){

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submit=0",

            url: baseurl+"job_order/assign_job/add",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }

    

    function assignJobUpdate(id,assign_user_id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submit=1"+"&assign_user="+assign_user_id,

            url: baseurl+"job_order/assign_job/add",

            beforeSend : function(){

                $("#ajax_response").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){

                $("#ajax_response").html("");

                var msg="";

                

                if(response==1){

                    msg="Job has been assigned successfully.";

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);



                }else{

                    msg=response;

                    ajax_response_msg("success_response",msg,"error");

                }

            }

        });

    }

/* ############################# END SCRIPT FOR ASSIGN JOB  ################################ */



/* ############################# START SCRIPT FOR USER SUBMISSION TARGET SETTING ############################# */

    function setTarget(id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id,

            url: baseurl+"user/setting",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }



    function updateSubmissionSetting(id){ 

        var u_id= parseInt($("#user_id").val());

        if(id==''){

            id = u_id;

        }

        var submission= $("#submission").val();

        var duration = $("#sub_duration").val();

        var achievement= $("#sub_achievement").val();

        var achievement_duration= $("#sub_achieve_duration").val();

        var mail_deliever = $("input:radio[name=sub_mail_deliever]:checked").val();

        

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&user_id="+id+"&submission="+submission+"&sub_achievement="+achievement+"&sub_mail_deliever="+mail_deliever+"&sub_duration="+duration+"&sub_achieve_duration="+achievement_duration+"&is_submitted=1",

            url: baseurl+"user/setting/edit",

            beforeSend : function(){

                $("#ajax_sub_loader").html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){

                $("#ajax_sub_loader").html("");

                var msg="";

                if(response==1){

                    msg="Submission setting has been added successfully.";

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else if(response==2){

                    msg="Submission setting has been updated successfully.";                    

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else{

                    msg=response;

                    ajax_response_msg("success_response",msg,"error");

                }

            }

        });

    }

    function updateInterviewSetting(id){ 

        var u_id= parseInt($("#user_id").val());

        if(id==''){

            id = u_id;

        }

        var interview= $("#interview").val();

        var duration = $("#int_duration").val();

        var achievement= $("#int_achievement").val();

        var achievement_duration = $("#int_achieve_duration").val();

        var mail_deliever = $("input:radio[name=int_mail_deliever]:checked").val();

        

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&user_id="+id+"&interview="+interview+"&int_achievement="+achievement+"&int_mail_deliever="+mail_deliever+"&int_duration="+duration+"&int_achieve_duration="+achievement_duration+"&is_submitted=2",

            url: baseurl+"user/setting/edit",

            beforeSend : function(){

                $("#ajax_int_loader").html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){

                $("#ajax_int_loader").html("");

                var msg="";

                if(response==1){

                    msg="Interviews setting has been added successfully.";

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else if(response==2){

                    msg="Interviews setting has been updated successfully.";                    

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else{

                    msg=response;

                    ajax_response_msg("success_response",msg,"error");

                }

            }

        });

    }



    function updateSendMailSetting(id){ 

        var u_id= parseInt($("#user_id").val());

        if(id==''){

            id = u_id;

        }

        var max_limit = $("#send_mail_max_limit").val(); 

        var target= $("#send_mail_target").val();

        var target_period= $("#send_mail_duration").val();

        var achievement= $("#send_mail_achievement").val();

        var achievement_period= $("#send_mail_achieve_duration").val();

        var mail_deliever = $("input:radio[name=send_mail_deliever]:checked").val();



        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&user_id="+id+"&send_mail_max_limit="+max_limit+"&send_mail_target="+target+"&send_mail_duration="+target_period+"&send_mail_achievement="+achievement+"&send_mail_achieve_duration="+achievement_period+"&send_mail_deliever="+mail_deliever+"&is_submitted=3",

            url: baseurl+"user/setting/edit",

            beforeSend : function(){

                $("#ajax_send_mail_loader").html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){

                $("#ajax_send_mail_loader").html("");

                var msg="";

                if(response==1){

                    msg="Send mail setting has been added successfully.";

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else if(response==2){

                    msg="Send mail setting has been updated successfully.";                 

                    ajax_response_msg("success_response",msg,"success");

                    setTimeout(function(){

                            $('#commonModel').modal('hide');                            

                    },2000);

                }else{

                    msg=response;

                    ajax_response_msg("success_response",msg,"error");

                }

            }

        });

    }

    



    function ajax_Target(offset){

        var list_type=$("#select_list").val();

        $.ajax({

            data:token_name+"="+token_hash+"&offset="+offset,

            type:"post",

            url: baseurl+"user/setting/ajax_list_items",

            beforeSend : function(){

                beforeAjaxResponse();

            },

            success: function(data){

                afterAjaxResponse();

                $("#ajax_replace").html(data);

            }

        });

    }



    function getUserPermission(id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submitted=0",

            url: baseurl+"user/set_permission",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }

    function setUserPermission(id){ 

        var group_id = [];

        $('input[name="group_name"]:checked').each(function() {

           group_id.push($(this).val());

        });

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&group_name="+group_id+"&is_submitted=1",

            url: baseurl+"user/set_permission",

            beforeSend : function(){

                $("#ajax_job_btn_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){

                $("#ajax_job_btn_assign").html("");

                $("#ajax_job_assign").html(response);

            }

        });

    }



    function getUserStatus(id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submitted=0",

            url: baseurl+"user/status",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }



    function setUserStatus(id){ 

        var status=$("#status").val();

        var status_comment=$("#status_comment").val();

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&status="+status+"&status_comment="+status_comment+"&is_submitted=1",

            url: baseurl+"user/status",

            beforeSend : function(){

                $("#ajax_status_btn_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" width="25px">');

            },

            success: function(response){                

                if(response=="active"){

                    $("#ajax_status_btn_assign").html('');

                    $("#response_status").html('<div class="row-fluid"><div class="span12"><div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">&times</button><strong>Success:  </strong>status has been updated successfully.</div>  </div>  </div>');

                    $("tr#row"+id+" td a#status"+id).text(response);

                }else if(response=="inactive"){

                    $("#response_status").html('<div class="row-fluid"><div class="span12"><div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">&times</button><strong>Success:  </strong>status has been updated successfully.</div>  </div>  </div>');

                    $("#ajax_status_btn_assign").html('');

                    $("tr#row"+id+" td a#status"+id).text(response);

                }else if(response=="banned"){

                    $("#response_status").html('<div class="row-fluid"><div class="span12"><div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">&times</button><strong>Success:  </strong>status has been updated successfully.</div>  </div>  </div>');

                    $("#ajax_status_btn_assign").html('');

                    $("tr#row"+id+" td a#status"+id).text(response);

                }else{

                    $("#ajax_job_assign").html(response);

                }

            }

        });

    }



    function getgroupPermission(id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submitted=0",

            url: baseurl+"user/group/permission",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }

    



    function reactive_job(id){ 

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash,

            url: "<?=SITE_PATH?>job_order/reactivate/"+id,

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }

    

    function update_reactive_job(){

                  

                var assign_group = $("#assign_group").val();

          

                var assign_user = $("#assign_user").val();

                var id = $("#row_id").val();

                $.ajax({                

                data:token_name+"="+token_hash+"&assign_group="+assign_group+"&assign_user="+assign_user,

                type:"post",

                url: "<?=SITE_PATH?>job_order/reactivate/"+id+'/view',

                beforeSend:function(){

                    $("#ajax_status_btn_").html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" width="25px">');

                   

                    

                },

                success: function(data){

                    if(data == 1)

                    {

                        

                        var msg="Job order has been activated successfully.";

                        ajax_response_msg("success_response",msg,"success");

                        //$("#reactive_link").hide();

                        //$("#add_to_pipelink_link").show();

                        

                    }

                    else

                    {

                       ajax_response_msg("success_response",data,"error");

                       

                       

                    } 

                    $("#ajax_status_btn_").html('');

                }

                });

            }

    

    function reload_page()

    {

        window.location.reload();

    }

    

    

    /* #############################  END SCRIPT FOR USER SUBMISSION TARGET SETTING ############################# */

    

    

        /* #############################  START SCRIPT FOR Requests ############################# */

    function getRequestStatus(id){ 

        //alert();

        $.ajax({

            type:"POST",            

            data: token_name+"="+token_hash+"&id="+id+"&is_submitted=0",

            url: baseurl+"customer/requests/status",

            beforeSend : function(){

                $("#ajax_job_assign").html('<img src="https://e-rookie.com/assets/images/loaders/ajax_preloader.gif" style="margin:2% 38%;" width="60px">');

            },

            success: function(response){

                $("#ajax_job_assign").html(response);

            }

        });

    }

        /* #############################  END SCRIPT FOR Requests ############################# */

    

</script>



<!-- Modal for Multiple Removal -->

    <div class="modal fade" id="notificationModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <span id="ajax_notification"></span>

                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->       

    </div>

<!-- /.modal -->



<!-- Modal for Multiple Removal -->

    <div class="modal fade" id="commonModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <span id="ajax_job_assign"></span>

    </div>

<!-- /.modal -->










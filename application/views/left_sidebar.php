<?php 



	$current_user_id 	= currentuserinfo()->id;

	$is_super_user     	= currentuserinfo()->is_super;

	$uri               	= $this->uri->segment(1);

	$uri1              	= $this->uri->segment(2);	  // to check out expand menu bar 	 

    

?> 

<style type="text/css">

    .fa_icon

    {

        width: 20px;

        height: 20px;

        

    }

    ul.page-sidebar-menu > li a.selected {

        background: #0e5696;

        border-top-color: transparent !important;

        color: #ffffff;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li > a > .title, .page-sidebar-closed ul.page-sidebar-menu > li > a > .icon16 {

        display: none !important;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li:hover:not(.sidebar-bg) {

        width: 236px !important;

        position: relative !important;

        z-index: 2000;

        display: block !important;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li:hover .title {

        display: inline !important;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li > .sub {

        display: none !important;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li:hover .sub {

        background-color: #eee;

    }

    .page-sidebar-closed ul.page-sidebar-menu > li:hover > .sub {

        width: 200px;

        position: absolute;

        z-index: 2000;

        left: 36px;

        margin-top: 0;

        top: 100%;

        display: block !important;

    }

    .minimize-sidebar-wrapper

    {

        width: 35px !important;

    }

    .minimize-content-wrapper

    {

        margin-left: 35px !important;

    }

    #sidebar {

        z-index: 4;

    }

    .mainnav ul li .sub li a

    {

        display: -webkit-box;

        max-height: 3.2rem;

        /*-webkit-box-orient: vertical;*/

        overflow: hidden;

        /*text-overflow: ellipsis;*/

        white-space: normal;

        -webkit-line-clamp: 1;

        font-weight: 500;

    }

    .sidebar-fixed

    {

        position: fixed !important;

        padding-top: 0px !important;

        top: 0 !important;

    }

    .mainnav:not(.page-sidebar-closed)

    {

        overflow-y: auto;

        max-height: 90vh;

    }

    .mainnav::-webkit-scrollbar,

    .page-sidebar-closed ul.page-sidebar-menu > li .sub::-webkit-scrollbar{

        width: 3px;

        height: 3px;

    }

    .mainnav::-moz-scrollbar,.page-sidebar-closed ul.page-sidebar-menu > li .sub::-moz-scrollbar {

        width: 3px;

        height: 3px;

    }

    .mainnav::-ms-scrollbar,.page-sidebar-closed ul.page-sidebar-menu > li .sub::-ms-scrollbar {

        width: 3px;

        height: 3px;

    }

    .mainnav::-o-scrollbar,.page-sidebar-closed ul.page-sidebar-menu > li .sub::-o-scrollbar {

        width: 3px;

        height: 3px;

    }

    .mainnav::scrollbar,.page-sidebar-closed ul.page-sidebar-menu > li .sub::scrollbar {

        width: 3px;

        height: 3px;

    }

    .mainnav::-webkit-scrollbar-thumb,.page-sidebar-closed ul.page-sidebar-menu > li .sub::-webkit-scrollbar-thumb {

        background: #464343 !important;

    }

    

    .page-sidebar-closed ul.page-sidebar-menu > li .sub

    {

        max-height: 70vh;

        overflow-y: auto;

    }

    .has-child

    {

        background: #f77c047a !important;

    }

</style>

   <div id="wrapper">

        <div class="resBtn">

            <a href="javascript:void(0)"><span class="icon16 minia-icon-list-3"></span></a>

        </div>  



        <!-- <div id="sidebarbg"></div> -->



        <?php 

        if($is_super_user==1){ 

    	$modules	= module_list_superAdmin();?>

        <div id="sidebar" class="<?php echo ($_COOKIE['sidebar_minimize']==1)?'minimize-sidebar-wrapper':''; ?>">

            <!-- <div class="sidenav"> -->

            	

            <div class="mainnav page-sidebar <?php echo ($_COOKIE['sidebar_minimize']==1)?'page-sidebar-closed':''?>">

                <ul class="page-sidebar-menu">

                	<!-- sidebar-toggler hidden-phone -->

                	<li class="sidebar-bg sidebar-toggler-btn"><span class="sidebar-toggler"><span style="color: #ffffff;" class="icon-toggler <?php echo $_COOKIE['sidebar_minimize']==1?'entypo-icon-arrow-17':'entypo-icon-arrow-14'?>" aria-hidden="true"></span></span></li>

                    <li> <a href="<?=base_url('dashboard')?>"><span class="fa_icon">&nbsp;&nbsp;<i class="fa fa-dashboard"></i></span><span class="title">&nbsp;&nbsp;Dashboard</span></a> </li>

                    <?php 

                    if(isset($modules) && !empty($modules))

                    {

                    	foreach ($modules as $module_key => $module) {

                    		$main_module_url = "javascript:void(0);";

                    		if($module->module_controller!='#')

                    		{

                    			$main_module_url = base_url($module->module_name.'/'.$module->module_controller);

                    		}?>

                    		<li>

                        		<a href="<?=($main_module_url)?>" <?php if($uri == $module->module_name){?>class="selected" <?php }?>><span class="fa_icon">&nbsp;&nbsp;<i class="<?php echo $module->module_icon ?>"></i></span><span class="title">&nbsp;&nbsp;<?php echo $module->module_title ?></span></a>

                        		<?php

		                        if(isset($module->child_list) && !empty($module->child_list))

		                        {?>

		                        	<ul class="sub <?php if(($uri==$module->module_name) || $module->module_name=='masters' && $uri == 'form_module'){?>extract<?php }?>">

		                        		<?php 

			                        	foreach ($module->child_list as $child_key => $child) {

			                        		if($child->module_type==1)

			                        		{

			                        			$module_url = $child->module_name.'/dynamic/'.$child->module_controller;

                                                $has_child  = $this->uri->segment(3);

			                        		}

			                        		elseif($child->module_name!=$child->module_controller)

			                        		{

			                        			$module_url = $child->module_name.'/'.$child->module_controller.'/list_items';

                                                $has_child  = $uri1;

			                        		}

			                        		else

			                        		{

			                        			$module_url = $child->module_name.'/list_items';

                                                $has_child  = $uri;

			                        		}?>



			                                <li data="<?=$child->module_controller?>" data2="<?=$uri1?>" style="text-indent: 2px;" class="<?=$child->module_controller==$has_child?'has-child':''?>"><a href="<?=base_url($module_url)?>" class="job-order-list">&nbsp;&nbsp;<i class="<?php echo $child->module_icon ?>"></i>&nbsp;&nbsp;<?php echo $child->module_title ?></a></li>



			                        	<?php } ?>

		                            </ul>

	                        	<?php } ?>

                        	</li>

                    	<?php }

                    }?>

                    <div style="clear: both"></div>

                </ul>

            </div>

            <!-- </div> -->

        </div>

    	<?php }else{

    	$modules    		= module_list();

	    // $modules	= module_list_superAdmin();

	    // pr(currentuserinfo());die;

	    // pr($modules);die;

 		?>

    	<div id="sidebar" class="<?php echo $_COOKIE['sidebar_minimize']==1?'minimize-sidebar-wrapper':''?>">

            <!-- <div class="sidenav"> -->

            <div class="mainnav page-sidebar <?php echo $_COOKIE['sidebar_minimize']==1?'page-sidebar-closed':''?>">

                <ul class="page-sidebar-menu">

                	<li class="sidebar-bg sidebar-toggler-btn"><span class="sidebar-toggler"><span style="color: #ffffff;" class="icon-toggler <?php echo $_COOKIE['sidebar_minimize']==1?'entypo-icon-arrow-17':'entypo-icon-arrow-14'?>" aria-hidden="true"></span></span></li>

                	<li> <a href="<?=base_url('dashboard')?>"><span class="fa_icon">&nbsp;&nbsp;<i class="fa fa-dashboard"></i></span><span class="title">&nbsp;&nbsp;Dashboard</a></span></li>

                    <?php 

                    if(isset($modules) && !empty($modules))

                    {

                    	foreach ($modules as $module_key => $module) {

                    		$main_module_url = "javascript:void(0);";

                    		if($module->module_controller!='#')

                    		{

                    			$main_module_url = base_url($module->module_name.'/'.$module->module_controller);

                    		}?>

                    		<li>

                        		<a href="<?=($main_module_url)?>" <?php if($uri == $module->module_name){?>class="selected" <?php }?>><span class="fa_icon">&nbsp;&nbsp;<i class="<?php echo $module->module_icon ?>"></i></span><span class="title">&nbsp;&nbsp;<?php echo $module->module_title ?></span></a>

                        		<?php

		                        if(isset($module->child_list) && !empty($module->child_list))

		                        {?>

		                        	<ul class="sub <?php if(($uri==$module->module_name) || $module->module_name=='masters' && $uri == 'form_module'){?>extract<?php }?>">

		                        		<?php 

			                        	foreach ($module->child_list as $child_key => $child) {

			                        		if($child->module_type==1)

			                        		{

			                        			$module_url = $child->module_name.'/dynamic/'.$child->module_controller;

                                                $has_child  = $this->uri->segment(3);

			                        		}

			                        		elseif($child->module_name!=$child->module_controller)

			                        		{

			                        			$module_url = $child->module_name.'/'.$child->module_controller.'/list_items';

                                                $has_child  = $uri1;

			                        		}

			                        		else

			                        		{

			                        			$module_url = $child->module_name.'/list_items';

                                                $has_child  = $uri;

			                        		}?>



			                                <li style="text-indent: 2px;" class="<?=$child->module_controller==$has_child?'has-child':''?>"><a href="<?=base_url($module_url)?>" class="job-order-list">&nbsp;&nbsp;<i class="<?php echo $child->module_icon ?>"></i>&nbsp;&nbsp;<?php echo $child->module_title ?></a></li>



			                        	<?php } ?>

		                            </ul>

	                        	<?php } ?>

                        	</li>

                    	<?php }

                    }?>

                </ul>

            </div>

            <!-- </div> -->

        </div>

    	<?php } ?>

      

    <div id="content" class="clearfix <?php echo $_COOKIE['sidebar_minimize']==1?'minimize-content-wrapper':''?>">

        <div class="contentwrapper">

        <div class="heading1" style="margin-bottom:9px"></div>



    <script>

       $(document).ready(function(){

       $(".hasUl").on('click',function(){

        $(".mainnav ul").each(function(){

        $(".mainnav ul li").removeClass('toggle-navigate');

        });

        $(this).parent().attr('class','toggle-navigate');

        $('.toggle-navigate ul .toggle-navigate ul ul').show();

        });

        //Make the lis highlighted

        //remove all highlight

        $(".mainnav ul li ul li a").each(function(){

             $(this).removeClass('current');                        

             

        });

        var uri =  "<?=$uri?>";

        var uri_string = "<?=uri_string()?>";

        var uri_2 = "<?=$this->uri->segment(2)?>";

        var uri_3 = "<?=$this->uri->segment(3)?>";

        var comb_url = uri+'/'+uri_2;

        //alert(uri_3);

        //alert(uri+'/'+uri_2);

        //alert(uri+'/list_items');

        //highlight current menu using conditions

        /*Master Module*/

        if(uri_string == 'subscription/list_items'){

            $('.subscription-list').addClass('current'); 

        }

        if(uri_string == "subscription/add_features" || uri_2 == "edit_feature"){

            $('.subscription-Features').addClass('current'); 

        }

        if(uri+'/add_support' == "<?=uri_string()?>" || uri_2 == "edit_support"){

            $('.subscription-Support').addClass('current'); 

        }

        if(uri+'/plans' == "<?=uri_string()?>"){

            $('.subscription-Plans').addClass('current'); 

        }

        if(uri+'/discounts' == "<?=uri_string()?>"){

            $('.subscription-Billing').addClass('current'); 

        }

        /*Subscription ends*/

        

        /*Customer Module*/

        if(uri+'/customer_request' == "<?=uri_string()?>"){

            $('.customer-request').addClass('current'); 

        }

        if(uri+'/customers/customer_request' == "<?=uri_string()?>"){

            $('.customers-request').addClass('current'); 

        }

        /*Customer ends*/

        /*Training Module*/

        if(uri == "training" && uri_2 != 'category'){

            $('.training-list').addClass('current'); 

        }

        if(comb_url == "training/category"){

            $('.training-category').addClass('current'); 

        }

        /*Customer ends*/

        /*Company Module*/

        if(uri == "company" && uri_2 != 'contact'){

            $('.company-list').addClass('current'); 

        }

        if(comb_url == "company/contact"  ){

            $('.company-contact').addClass('current'); 

        }

        /*Company ends*/

        /*Candidate Module*/

        if(uri == "form_module" && uri_2 == 'dynamic' ){

            $('.candidate-list').addClass('current'); 

        }

        if(comb_url == "candidate/upload_resume"  ){

            $('.candidate-upload').addClass('current'); 

        }

        if(comb_url == "candidate/candidate_search"  ){

            $('.candidate-search').addClass('current'); 

        }

        /*Candidate ends*/

        /*User Module*/

        if(comb_url == "user/site"){

            $('.site-list').addClass('current'); 

        }

        if(comb_url == "user/group"){

            $('.group-list').addClass('current'); 

        }

        if(comb_url == "user/location"){

            $('.location-list').addClass('current'); 

        }

        if(comb_url == "user/setting"){

            $('.setting-list').addClass('current'); 

        }

        if(comb_url == "user/list_items" || comb_url == "user/add" || comb_url == "user/edit" || comb_url == "user/view" ){

            $('.user-list').addClass('current'); 

        }

        if(comb_url == "user/authorisation"){

            $('.auth-list').addClass('current'); 

        }   

        /*User ends*/

        /*Job Order Module*/

        if(uri == "job_order"){

            $('.job-order-list').addClass('current'); 

        }

        if(comb_url == "user/hierarchy"){

          $('.hierarchy-list').addClass('current');

        }

        //alert();

        /*Job Order ends*/

        /*Activity Module*/

        if(comb_url == "activity/list_items"){

            $('.activity-list').addClass('current'); 

        }

        if(uri_2 == "activity_cart_email"){

            $('.cart-list').addClass('current'); 

        }

        if(uri_2 == "email_report"){

            $('.email-report').addClass('current'); 

        }

        if(uri_2 == "activity_sent_email"){

            $('.sent-list').addClass('current'); 

        }

        if(uri_2 == "activity_email"){

            $('.email-list').addClass('current'); 

        }

        if(uri_2 == "inactive_email"){

            $('.inactive-list').addClass('current'); 

        }

        if(uri_2 == "email_report"){

            $('.report-list').addClass('current'); 

        }   

        /*Activity ends*/

        /*Report Module*/

        if(comb_url == "report/job_order"){

            $('.job-report').addClass('current'); 

        }

        if(comb_url == "report/company"){

            $(  '.company-report').addClass('current'); 

        }

        if(comb_url == "report/interviews"){

            $('.interviews').addClass('current'); 

        }

        /*Report ends*/

        /*NewsLetter Module*/

        if(uri  == "newsletter"){

            $('.newsletter').addClass('current'); 

        }

        /*NewsLetter ends*/

        /*kModule*/

        if(uri  == "vendor" && uri_2 != 'blacklist'){

            $('.vendor-list').addClass('current'); 

        }

         if(comb_url == "vendor/blacklist"){

            $('.black-list-vendor').addClass('current'); 

        }

       

       

        /*NewsLetter ends*/

        

        

        /*Billing Module*/

        

        //alert(uri_string);

        var first_uri = '<?php echo $this->uri->segment(1);?>';

        if(comb_url  == "billing/"+first_uri){

            $('.billing-'+first_uri).addClass('current'); 

        }

        /*Billing ends*/

        

        $(".mainnav ul li ul li a").click(function(){

           // alert("<?=$_SERVER['REQUEST_URI']?>" + "<?=uri_string()?>");

           // $(this).addClass('current'); 

            //return false; 

        });



        // $(".has-child").scrollTop(20);



        $(".sidebar-toggler-btn").click(function(){

            if($('.page-sidebar').hasClass('page-sidebar-closed'))

            {

                setCookie('sidebar_minimize','0',10);

                $('#sidebar').removeClass('minimize-sidebar-wrapper'); 

                $('.page-sidebar').removeClass('page-sidebar-closed'); 

                $('#content').removeClass('minimize-content-wrapper'); 

                $('.icon-toggler').removeClass('entypo-icon-arrow-17'); 

                $('.icon-toggler').addClass('entypo-icon-arrow-14'); 

            }

            else

            {

                setCookie('sidebar_minimize','1',10);

                $('#sidebar').addClass('minimize-sidebar-wrapper');

                $('.page-sidebar').addClass('page-sidebar-closed'); 

                $('#content').addClass('minimize-content-wrapper');

                $('.icon-toggler').removeClass('entypo-icon-arrow-14'); 

                $('.icon-toggler').addClass('entypo-icon-arrow-17'); 

            }

        });

        

        $(window).scroll(function () {

            if ($(this).scrollTop() > 100) {

                $('#sidebar').addClass('sidebar-fixed');

            } else {

                $('#sidebar').removeClass('sidebar-fixed');

            }

        });

    });



    function setCookie(cname, cvalue, exdays) {

        var d = new Date();

        d.setTime(d.getTime() + (exdays*24*60*60*1000));

        var expires = "expires="+ d.toUTCString();

        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

    }



</script>


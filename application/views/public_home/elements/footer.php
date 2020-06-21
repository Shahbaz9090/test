
<div id="footer"><!-- Footer -->
        <div class="container"><!-- Container -->
            <div class="row">
                            <div class="col-md-5 footer-widget"><!-- Text Widget -->
                                <h4 class="widget-title">What solution we have ?</h4>
                                <div class="textwidget">
                                 <p>e-Rookie is for Leading Staffing Organization, Recruiters, Sales Team &amp; Higher Management. Enhancing the Effectiveness of Work-flow, Gearing up the ROI, Automate the Organization System &amp; Satisfying Centrically. However, most of the leaders are grappling with the challenges like accelerating the sales, satisfying the clients, providing quality resources within the timeline, Delivering Cross-Channel Experience providing all your organization need at centre point. </p>
                                </div>
                            </div><!-- Text Widget -->
                            
                            <div class="col-md-2  footer-widget"><!-- Footer Menu Widget -->
                                <h6 class="widget-title">Useful Links</h6>
                                <div class="footer-widget-nav">
                                    <ul>
                                        <li><a href="<?=SITE_PATH?>">Home</a></li>
                                        <!-- <li><a href="#">Plans</a></li> -->
                                        <li><a href="<?=SITE_PATH?>about">What's E-rookie</a></li>
                                        <li><a href="<?=PUBLIC_URL?>e-rookie1.com.pdf" target="_blank">Tutorial</a></li>
                                        
                                    </ul>
                                </div>
                            </div><!-- Footer Menu Widget -->
                            
                            <div class="col-md-2  footer-widget"><!-- Recent Tweet Widget -->
                                <h6 class="widget-title">Connect With Us</h6>
                                
                                 <div class="footer-widget-nav">
                                    <ul>
                                    <li><a href="#">Twitter</a></li>
                                    <li><a href="#">Linkedin</a></li>
                                    <li><a href="https://www.facebook.com/erookiesolutionshttps://twitter.com/erookieservices">Facebook </a></li>
                                    <li><a href="<?=SITE_PATH?>contact">Contact Us</a></li>
                                    </ul>
                                    </div>
                               
                            </div><!-- Recent Tweet Widget -->
        
                            <div class="col-md-3 footer-widget"><!-- News Leter Widget -->
                                            <h6 class="widget-title">Sign up For news Letter</h6>
                                            <div class="textwidget">
                                            <p>Want to keep up to date with all our latest news and information?
                                       Enter your email below to be added to our mailing list</p>
                                            </div>
        
                                            <form role="form">
                                                <div class="form-group">
                                                 <input type="email" class="input-newstler"/>
                                                </div>
                                                <div class="form-group">
                                                <button type="button" class="btn-newstler btn btn-blue">Sign Up</button>
                                                </div>
                                                            
                                            </form>
                            </div><!-- News Leter Widget -->
                            <div class="clearfix"></div>
            </div>
        </div><!-- Container -->
        
           <!-- Footer credits -->
            <div class="footer-credits">
             <div class="hastag text-center"> 
                <a href="#" style="padding-right:6px;">Disclaimer </a>|<a href="#" style="padding-right:6px;"> Legal</a>|<a href="#" style="padding-right:6px;"> Copyright</a>
               </div>
              </div>
              <!-- Footer credits -->
</div>

    
    <!-- modals starts here -->
    
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="demoModalLabel">Demo Registration</h4>
      </div>
      <?php echo form_open("home/demoSignUp"); ?>
      <div class="modal-body">
      
      <?php if($this->session->flashdata("reg_error")){?>
     <div class="alert alert-danger" style="margin: 0;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?=$this->session->flashdata("reg_error")?>
</div>  <br /><?php } ?>

<?php if($this->session->flashdata("reg_success")){?>
     <div class="alert alert-success" style="margin: 0;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?=$this->session->flashdata("reg_success")?>
</div>  <br /><?php } ?>
       
								<div class="form-group ">
                                
                               
									<input type="text" class="form-control input-form" placeholder="Full Name" name="name"  required=""/>
                                
								
								</div>
                                <div class="form-group">
										<input type="text" class="form-control input-form validate_input" placeholder="Contact No"  name="contact_no" required=""/>
								</div>
                                
								<div class="form-group">
									<input type="email" class="form-control input-form" placeholder="Email" name="email" required=""/>
									
								</div>
                                <div class="form-group">
									<input type="text" class="form-control input-form" placeholder="Company Name" name="company_name"/>
									
								</div>
                                <div class="form-group">
									<input type="text" class="form-control input-form" placeholder="Website Address" name="website"/>
								
								</div>
                                <div class="form-group">
									<select class="form-control input-form" placeholder="Select Country" required="" name="country">
                                    <option value="" >Select Country</option>
                                     <option value="1" >United States</option>
                                     <option value="2">India</option>
                                    </select>
                                    
								</div>
                                <div class="form-group">
									<input type="number" class="form-control input-form validate_input" placeholder="No of Users" min="1" autocomplete="off" required="" name="no_users"/>
									
								</div>

							
      </div>
      <div class="modal-footer">
      
    	<button type="submit" class="btn btn-default btn-blue">SUBMIT</button>
        
      </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>
        
        
        
        
         <div class="modal fade bs-example-modal-sm" id="log_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
   
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="mySmallModalLabel">Login</h4>
      </div>
     <div class="modal-body">
  
    	<?php echo form_open(SITE_PATH.'auth/login',array('id'=>'loginForm')); ?>
								<div class="form-group ">
                                <?php 
                                if(@$this->session->flashdata("Error"))
                                {?>
                                <span style="font-size: 12px; color:red"><?=$this->session->flashdata("Error")?></span>
                                <?php } ?>
                               
									<input type="email" name="email" class="form-control input-form" required="" placeholder="User Name"/>
                                
								
								</div>
                           <div class="form-group">
									<input type="password" name="password" class="form-control input-form" placeholder="Password" required=""/>
                                    </div>
                                    
                                <div class="row">
                                <div class="col-md-4">
    	<button class="btn btn-default btn-blue" type="submit">LOGIN</button>
        </div>
        <div class="col-md-7">
        <a href="#" data-toggle="modal" data-target="#forgot_modal" class="forgot_click">Forgot Password ?</a>
        </div>
      </div>
                                


								
							<?php echo form_close();?>
                            </div>
    </div>
  </div>
</div>       





<!-- Forgot password Modal Start -->

<div class="modal fade" style="display:none;" id="forgot_modal" tabindex="-1" role="dialog" aria-labelledby="RetrieveModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">

<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="RetrieveModalLabel">Retrieve Password</h4>
</div>
<div class="modal-body">

<?php echo form_open(SITE_PATH.'auth/forget'); ?>

<div class="form-group ">
<p>Enter your email to retreive password</p>

 <?php 
        if(@$this->session->flashdata("forgot_error"))
        {?>
        <span style="font-size: 12px; color:red"><?=$this->session->flashdata("forgot_error")?></span>
        <?php }
        elseif(@$this->session->flashdata("forgot_success")) { ?>
        <span style="font-size: 12px; color:green"><?=$this->session->flashdata("forgot_success")?></span>
        <?php }?>
<input type="email" name="email_id" class="form-control input-form" required="" placeholder="Email"/>
</div>

<div class="row">
<div class="col-md-4">
<button class="btn btn-default btn-blue" type="submit">SEND ME !</button>
</div>
<div class="col-md-8">
<a href="#" class="back_login" data-dismiss="modal">Back to Login</a>
</div>
</div>




</form> </div>
</div>
</div>
</div>

<!-- Forgot password Modal End -->
        
        <!-- modals ends here -->
        
        
        
        
        <!-- resume upload model -->
        
        
<div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md" style="width:515px;margin:10% auto; border-radius: 5px">
<div class="modal-content">
<div class="main-header  model_header">
<button type="button" class=" main-close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title padding-main" id="ModalLabel" style="padding-top:12px; padding-left:12px;">Apply job</h4>
</div>
<div class="modal-body">
    
    <div class="form-group">
    
     <div class="row-fluid">
      
         
          <div class="col-md-12">
             <span class="detail" id="modal_title"></span>
        <p class="text-detail" ><span id="modal_desc"> </span> </p> 
         
          
          
          
          
          </div>
         
         
         
         </div>
        
        
        <div class="row-fluid">
        
        <div class="center-box">
   
            <div class="pop-up-bx">
    
    <div class="job-list-logo col-md-1">
        <div class="location_icon"><i class="fa fa-map-marker"></i></div>
        </div>
         <div class="pop-up-bx">
        <p id="modal_location" class="margin-line"></p>
        </div>
        </div>
        <div class="pop-up-bx">
         <div class="job-list-logo col-md-1">
        <div class="job-list-icon"><i class="fa fa-user"></i></div>
        </div>
        <div class="pop-up-bx">
         <p id="modal_type" class="margin-line"></p>
        </div>
       
        </div>
        </div>
        </div>
        
    
        
        
        
        
      
            
    </div>
    <div class="clearfix"></div>
     <div class="modal-footer" style="text-align:left;border:none;">
     <?php echo form_open_multipart('home/upload_resume',array("id"=>"resume_form"));?>
     <input type="hidden" name="added_by" id="modal_added_by" />
     <input type="hidden" name="job_id" id="modal_job_id" />
     <input type="hidden" name="country" id="modal_country" />
     <input type="hidden" name="shared_by" id="shared_by" />
     <input type="file" name="fileToUpload" id="resume_file" style="display: none;"  />
     
     <?php echo form_close();?>
     <span id="upload_button">
     </span>
    </div>
</div>
</div>
</div>
</div> 
<!-- Display Information Popup End -->
        
        <!-- end of resume upload modal -->
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --> 
      
   	<!-- Tabs -->
	<script src="<?=PUBLIC_HOME?>js/jquery.easytabs.min.js" type="text/javascript"></script>
	<script src="<?=PUBLIC_HOME?>js/modernizr.custom.49511.js"></script>
	<!-- Tabs -->
  
	<!-- Owl Carousel -->
	 <script src="<?=PUBLIC_HOME?>js/owl.carousel.js" type="text/javascript"></script>
	<!-- Owl Carousel -->

	<!-- Form Slider -->
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/tmpl.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/draggable-0.1.js"></script>
	<script type="text/javascript" src="<?=PUBLIC_HOME?>js/jquery.slider.js"></script>
    
	<!-- Form Slider -->
  <script src="<?=PUBLIC_HOME?>js/job-board.js" type="text/javascript"></script> 
 <script type="text/javascript">
    $(document).ready(function(){
	jQuery('.first-hand').mouseover(function() {
	
		var cur_hand_id = jQuery(this).attr('id');
		
		var u_idz = cur_hand_id.split('first-mobile-');
		var latest_idz = u_idz[1]; 
		
		jQuery('#text-'+latest_idz).css('display','block');
		jQuery('#text-'+latest_idz).fadeIn('slow');
				
	}).mouseout(function(){
      	var cur_hand_id = jQuery(this).attr('id');
		
		var u_idz = cur_hand_id.split('first-mobile-');
		var latest_idz = u_idz[1]; 
		
		jQuery('#text-'+latest_idz).css('display','none');
		jQuery('#text-'+latest_idz).fadeOut('slow');
	});
	
	
});


       
 </script>
   <script type="text/javascript" src="<?=PUBLIC_URL?>wp-content/plugins/revslider/rs-plugin/js/jquery.slider.min.js"></script>
	  <script type="text/javascript" src="<?=PUBLIC_URL?>wp-content/plugins/revslider/rs-plugin/js/jquery.slider.tools.min.js"></script>
       <script type="text/javascript" src="<?=PUBLIC_URL?>wp-content/plugins/revslider/rs-plugin/js/slider-control.js"></script>
       
 
  
  
       <!-- Choosen -->
 <!-- <script src="<?=PUBLIC_URL?>plugins/chosen/chosen.jquery.js"></script> 
  
 <script type="text/javascript">
 
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
      
  </script>
  -->
 
    <!-- tags creation script -->
    <script type="text/javascript" src="<?=PUBLIC_HOME?>js/bootstrap-tokenfield.js" charset="UTF-8"></script>
    <!-- end of tags creation script -->
   

    
    <script type="text/javascript">
    
      $(function(){
            
             var url = $(location).attr('href').split("/").splice(4, 5).join("/");
             var append_div=url.replace("#","");
             
             if(append_div=="")
             {
                $("#search_type").val("all");
             }
             else
             {
                $("#search_type").val(append_div);
             }
              $(".my-form").trigger('submit');
        });
        <?php 
            if(@$this->session->flashdata("Error"))
             {?>
                $(function(){
                    $("#login_modal").trigger('click');
                });
        <?php }?>
        
          <?php 
            if(@$this->session->flashdata("forgot_error") || @$this->session->flashdata("forgot_success"))
             {?>    
        $(function(){
            $(".forgot_click").trigger('click');
           
        });
        
        <?php } ?>
      
        
        <?php if($this->session->flashdata("reg_error") || $this->session->flashdata("reg_success")){?>
        $(function(){
            $("#demo_registration").trigger('click');
           
        });
        
        <?php } ?>
        
        $(".access_demo").click(function(){
            $("#demo_registration").trigger('click');
        });
         
        $(".my-form").submit(function(){
            var str=$(this).serialize();
            var action=$(this).attr('action');
            var triger_val=$("#search_type").val();
            var limit=$("#limit").val();
            var offset=$("#offset").val();
            
            $.post(action,str,function(data){
                if(data)
                {
                    var obj=JSON.parse(data);
                    var search_result="";
                    if(obj[triger_val].length!=0)
                    {
                            for(p in obj[triger_val])
                            {
                                
                                    search_result += "<div class=\"recent-job-list-home\"><!-- Tabs content -->";
                                    search_result += "										<div class=\"job-list-logo col-md-1 \">";
                                    search_result += "											<i class=\"fa fa-user\"><\/i>";
                                    search_result += "										<\/div>";
                                    search_result += "										<div class=\"col-md-6 job-list-desc\">";
                                    search_result += "											<h6><a href=\"#\" class=\"upload_resume\" source=\"home_detail\" data-toggle=\"modal\" data-target=\"#info_modal\" country=\""+obj['country']+"\" added_by=\""+obj[triger_val][p]['added_by']+"\" job_id=\""+obj[triger_val][p]['id']+"\">"+obj[triger_val][p]['title']+"<\/><\/h6>";
                                    search_result += "											<p>"+obj[triger_val][p]['description']+"<\/p>";
                                    search_result += "<span id=\"is_applied_"+obj[triger_val][p]['id']+"\" \>";
                                    if(obj[triger_val][p]['is_applied']=="yes")
                                    {
                                        search_result += "<div class=\"text-green\" style=\"color: #0E977C;font-size: 12px;\"><span aria-hidden=\"true\" class=\"fa fa-check\" \"=\"\"><\/span>Applied<\/div>";
                                    }
                                    search_result += "<\/span>";

                                    search_result += "										<\/div>";
                                    search_result += "										<div class=\"col-md-5 full\">";
                                    search_result += "		    									<div class=\"row\">";
                                    search_result += "												<div class=\"job-list-location col-md-7 \">";
                                    search_result += "													<h6><i class=\"fa fa-map-marker\"><\/i>"+obj[triger_val][p]['cityName']+"<\/h6>";
                                    search_result += "												<\/div>";
                                    search_result += "												<div class=\"job-list-type col-md-5 \">";
                                    search_result += "													<h6><i class=\"fa fa-user\"><\/i>"+obj[triger_val][p]['type']+"<\/h6>";
                                    search_result += "												<\/div>";
                                    search_result += "											<\/div>";
                                    search_result += "										<\/div>";
                                    search_result += "										<div class=\"clearfix\"><\/div>";
                                    search_result += "									<\/div>";
                                
                            }
                    }
                    else
                    {
                            search_result += "<div class=\"recent-job-list-home\"><!-- Tabs content -->";
                            search_result += "<div class=\"col-md-12 text-center\">";
                            search_result += "<h6>No result Found<\/h6><\/div>";
                            search_result += "<div class=\"clearfix\"><\/div>";
                            search_result += "<\/div>";

                    }
                    if(+limit <= +6)
                    {
                        $("#"+triger_val).empty();
                    }
                    
                    $("#"+triger_val).append(search_result);
                    
                    /////to create load more////////
                    var total_fetched=$("#"+triger_val).children().length;
                    if(+total_fetched < +obj['total'])
                    {
                        $("#load_more").show();
                    }
                    else{
                         $("#load_more").hide();
                    }
                    //////////////////////////////////
                    
                }
            });
            
           return false; 
        });
        
        
        $(".search_by").click(function(){
           var  val=$(this).attr('data'); 
            $("#offset").val('0');
            $("#limit").val('6');
            $("#search_type").val(val);
            $(".my-form").trigger('submit');
        });
        
        $("#submit-form").click(function(){
            var val=$("#search_type").val();
            $("#offset").val('0');
            $("#limit").val('6');
            $("#search_"+val).trigger('click');
            $("html, body").animate({ scrollTop: $('#jobs_extends_here').offset().top }, 500);
        });
        
        $("#load_more").click(function(){
            var limit=$("#limit").val();
            var offset=$("#offset").val();
            $("#offset").val(limit);
            $("#limit").val((+limit + +'6'));
            $(".my-form").trigger('submit');
        });
        
       
       
       ///////////////////to upload resume ////////////////////////
       
       $(document).on('click','.upload_resume',function(){
        var id=$(this).attr('job_id');
        var country=$(this).attr('country');
        var redirect_url="";
       
        var source=$(this).attr('source');
        var added_by=$(this).attr('added_by');
        var shared_by=$(this).attr('shared_by');
        $.get("<?=SITE_PATH?>home/get_job_detail","id="+id+"&country="+country,function(data){
            var obj=JSON.parse(data);
            if(source=='home_detail')
            {
                redirect_url=' <a href="<?=SITE_PATH?>home/job/'+obj['id']+'/'+added_by+'/'+country+'" class="see-more" >View full detail</a>';
            }
            else
            {   
                $("#shared_by").val(shared_by);
            }
            
            $("#modal_title").html(obj['title']);
            $("#modal_desc").html(obj['description']+redirect_url);
            $("#modal_location").html(obj['cityName']);
            $("#modal_type").html(obj['type']);
            $("#modal_added_by").val(obj['added_by']);
            //$("#modal_added_by").val("janterparia@gmail.com");
            $("#modal_job_id").val(obj['id']);
            $("#modal_country").val(country);
            if(obj['exists']=='yes')
            {
                $("#upload_button").html('<div class="text-green" style="color: #0E977C;font-size: 12px;"><span aria-hidden="true" class="fa fa-check" "=""></span>Applied</div>');
            }
            else
            {
                <?php if(!$this->session->userdata('candidate_login')=="yes"){ ?>
                $("#upload_button").html('<button type="button" class="post-resume-button-1 activate-resume-file">Upload Your Resume <i class="fa fa-upload"></i></button>');
                <?php } else { ?>
                $("#upload_button").html('<button type="button" class="post-resume-button-1 session_apply" data="'+obj['id']+'" email=janterparia@gmail.com">Apply for this Job<i class="icon-upload grey"></i></button>');
                <?php } ?>
            }
        });
       });
       
       $(document).on('click','.activate-resume-file',function(){
            $("#resume_file").trigger('click');
       });
       
       $("#resume_file").change(function(){
            $("#resume_form").trigger('submit');
       });
       
    
       
       $( '#resume_form' ).submit( function( e ) {
        var img='<img src="<?=PUBLIC_URL?>images/loaders/pik.gif" alt="" /><br />Please wait...';
        $("#upload_button").html(img);
            $.ajax( {
              url: $(this).attr('action'),
              type: 'POST',
              data: new FormData( this ),
              cache: false,
              processData: false,
              contentType: false,
               success: function(data){
                $("#upload_button").html(data);
                $('#resume_form')[0].reset();
            }
            } );
            e.preventDefault();
            return false;
        } );
        
        
        $(document).on('click','.session_apply',function(){
             var img='<img src="<?=PUBLIC_URL?>images/loaders/pik.gif" alt="" /><br />Please wait...';
            $("#upload_button").html(img);
            var id=$(this).attr('data');
            var email=$(this).attr('email');
            $.get("<?=SITE_PATH?>home/job_apply","job_id="+id+"&added_by="+email,function(data){
                $("#is_applied_"+id).html(data);
                $("#upload_button").html(data);
            });
        });


     $(document).on('keypress','.validate_input',function(event){
   
            var ew = event.which;
            var num=[48,49,50,51,52,53,54,55,56,57];
          
           if($.inArray( ew, num ) > -1) 
           {
             return true;
           }
           
            return false;
    });

       
       
       $(document).on('click','.forgot_click',function(){
        $("#log_modal").hide();
       });

$(document).on('click','.back_login',function(){
        $("#log_modal").show();
       });
       
       $("input[name='country']").change(function(){
        if($(this).val()=='1')
        {
            $("#searchplace_us").show();
            $("#searchplace_india").hide();
        }
        else
        {
            $("#searchplace_us").hide();
            $("#searchplace_india").show();
        }
       });
      
    </script>
  

 <!--Start of Zopim Live Chat Script-->
 <!--
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2nJSfY8KcS0a09Cs3NaNebhPkZU3LO1O';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script> -->
<!--End of Zopim Live Chat Script-->


    
   
  
 
  </body>
</html>
</div>

<!--<div id="page-content">

	<div class="container">
        <div class="row">
<h2>Contact Us</h2>





</div>
</div>
    </div>-->

<div id="page-content"><!-- start content -->
  <div class="content-about ">
    <div class="container"> 
      <!--<div class="col-md-7">
                    <div class="ab">
					<form role="form" class="contact form-back " id="contact_form" method="post" name="contact_form" action="#">
						<div class="form-group col-md-12">
							<label>Name</label>
							<input type="text" class="form-control name" name="name" id="name">
						</div>

						<div class="form-group col-md-12">
							<label>Email</label>
							<input type="text" class="form-control email" name="email" id="email" >
						</div>

						<div class="form-group col-md-12">
							<label>Tel</label>
							<input type="text" class="form-control phone" name="phone" id="phone">
						</div>

						<div class="form-group col-md-12">
							<label>Website</label>
							<input type="text" class="form-control website" name="web" id="web">
						</div>

						<div class="form-group col-md-12">
							<label>Subject</label>
							<input type="text" class="form-control subject" name="subject" id="subject">
						</div>

						<div class="form-group col-md-12">
							<label>Message</label>
							<textarea class="form-control message" rows="8" id="message" name="message"></textarea>

							<button class="btn btn-default btn-green" type="submit" name="submit" id="submit">SEND</button>
							
						</div>
						<div class="clearfix"></div>
					</form>
                    </div>
</div>-->
      
      <div class="contact-us-1">
        <div class="contact-paragraph"> Please contact us to discuss how "e-rookie" can help you in Optimizing your Business Process .
          We will Also assist you in deciding how it can be implemented with your business .<br>
        </div>
        <div class="clearfix" style="clear: both;"></div>
        <?php if($this->session->flashdata('success')) { ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success" style="margin: 0;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('success'); ?> </div>
          </div>
        </div>
        <?php } ?>
        <?php echo form_open(''); ?>
        <div class="col-md-7">
        <div class="row">
          <div class="top-label">
            <div class="row mb10" style="margin-top:10px;margin-bottom:10px;">
              <div class="col-md-12">
                <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/name-icon.jpg" width="42" height="36"></div>
                <div class="form-group-new ">
                  <input type="text" placeholder="Full Name" name="name" required="" class="form-control-1 input-form ">
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
                <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/contact-icon.jpg" width="42" height="36"/></div>
                <div class="form-group-new ">
                  <input type="text" placeholder="Contact No" name="contact_no" min="1" maxlength="10"  required="" class="form-control-1 input-form "/>
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
                <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/email-icon.jpg" width="42" height="36"/></div>
                <div class="form-group-new ">
                  <input type="email" placeholder="Email" name="email" required="" class="form-control-1 input-form "/>
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
                <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/company-icon.jpg" width="42" height="36"/></div>
                <div class="form-group-new ">
                  <input type="text" placeholder="Company Name" name="company_name" class="form-control-1 input-form "/>
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
                <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/website-icon.jpg" width="42" height="36"/></div>
                <div class="form-group-new ">
                  <input type="url" placeholder="Website Address" name="website"  class="form-control-1 input-form "/>
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
                <div class="form-group-new-text-area"  >
                  <textarea class="form-control-textarea " name="query" required="" rows="5" placeholder="Your Query" ></textarea>
                </div>
              </div>
            </div>
            <div class="row mb10">
              <div class="col-md-12">
                <div class="btn-boxs">
                  <button class="btn btn-blue btn-right"  type="submit" >SUBMIT</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php echo form_close(); ?>
        <div class="col-md-5">
        
          <div class="form-right">
            <div class="row">
              <div class="form-r-bg">
                <h3> <span style="color:#ffad05">We'd love to</span><span style="color:#4a96cc"> hear from you!!!</span></h3>
                <div class="form-r-heading"> <i class="fa fa-envelope"></i> For Sales, Operations, Assistance do write us at:</div>
                <!-- <div class="form-r-text">Nothing scripted, and we are speedy with our responses our responses.</div>
              <div class="form-r-text">Nothing scripted, and we are speedy with our responses our responses.</div>--> 
              </div>
            </div>
            <div class="row mt10">
              <div class="form-r-bg">
                <div class="form-r-heading-1"><span style="color:#000;">For Sales :</span> <br/>
                  <a href="mailto:sales@e-rookie.com" style="color:#707bcb;"> sales@e-rookie.com </a></div>
              </div>
            </div>
            <div class="row mt10">
              <div class="form-r-bg">
                <div class="form-r-heading-1"><span style="color:#000;">For Technical Assistance :</span><br/>
                  <a href="mailto:technical@e-rookie.com" style="color:#707bcb;"> technical@e-rookie.com </a></div>
              </div>
            </div>
            <div class="row mt10">
              <div class="form-r-bg">
                <div class="form-r-heading-1"><span style="color:#000;">For Any Complaint :</span><br/>
                  <a href="mailto:report@e-rookie.com" style="color:#707bcb;"> report@e-rookie.com </a></div>
              </div>
            </div>
            <div class="row mt10">
              <div class="form-r-bg">
                <div class="form-r-heading-1"><span style="color:#000;">For Any Other Information:</span><br/>
                  <a href="mailto:info@e-rookie.com" style="color:#707bcb;"> info@e-rookie.com </a></div>
              </div>
            </div>
          </div>
        </div>
        </div>
      
    </div>
    
    <!--<div class="spacer-2">&nbsp;</div>--> 
    <!--<div class="row clearfix">
						<div class="col-md-6 about-post-resume">
							<h4>Post Your Resume</h4>
							<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
							<p><button class="btn btn-default btn-black">UPLOAD YOUR RESUME <i class="icon-upload white"></i></button></p>
						</div>
						<div class="col-md-6 about-post-job">
							<h4>Post Job Now</h4>
							<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
							<p><button class="btn btn-default btn-green">POST A JOB NOW</button></p>
						</div>
					</div>--> 
    <!--<div class="spacer-2">&nbsp;</div>--> 
  </div>
  
  <!--<div id="cs"><!-- CS --> 
  
</div>
<!-- CS --> 
<!-- end content -->
</div>

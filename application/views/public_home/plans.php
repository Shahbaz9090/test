
        </div>
        
        
        
        
          <!--<div id="page-content">

	<div class="container">
        <div class="row">
<h2>Contact Us</h2>





</div>
</div>
    </div>-->    
        <div id="page-content" ><!-- start content -->
        <div class="row" style="background-color: #0069B6;color: #f1f2f6;padding: 9px;margin-bottom: 25px;" >
        </div>
        
        
        
        <!-----------------plans goes here --------------------------------------------->
			<div class="container">
<?php $plan_class=array("personal","standard","professional","business"); ?>
<?php if(!empty($us_plan)){ ?>
<div class="row">
<div class="col-md-12">
<div class="group pricing-table">
            <h1 class="heading">Our U.S Pricing</h1>
            <div class="row">
            <div class="price-mid display-center-plan">
            <?php foreach($us_plan as $key=>$val) {    ?>
            <!-- PERSONAL -->
            
            <div class="display-inline-plan <?=$plan_class[$key]?>">
                <h2 class="title"><?=$val->plan_name?></h2>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                        <sup>$</sup>
                        <span><?=$val->slab_range->price?></span>
                        <sub>/mo.</sub>
                    </p>
                    <p class="flag-icon-usa"></p>
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <ul class="features">
                <?php
                if(!empty($val->features)){
                 foreach($val->features as $k=>$v) { ?>
                    <li><span class="fontawesome-cog"></span>
                    <?php 
                    foreach($v->slab_range as $slab_k => $slab_v)
                                        {
                                            if($slab_v->id==$val->slab_range->id)
                                            {
                                                 if($v->addon_type[$slab_k]=='4')
                                                 {
                                                    echo $v->total_resume[$slab_k]." Upload Resume";
                                                   }
                                                elseif($v->addon_type[$slab_k]=='3')
                                                {
                                                    echo $v->total_email[$slab_k]." Email Address<br/ >";        
                                                }
                                                else
                                                {
                                                    echo ucwords($v->feature_name);
                                                }
                                                 
                                            }
                                            
                                        }
                     }?></li>
                <?php   }?>
                
                <?php   if(!empty($plan->support))
                    {
                         foreach($plan->support as $k => $v)
                        {
                            ?>
                             <li><span class="fontawesome-cog"></span>
                            <?=ucwords($v->service_name)?>
                            </li>
                       
                <?php } } ?>
                </ul>
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <a href="#">SIGN UP</a>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PERSONAL -->
            
            <?php } ?>
            </div>
           </div>
            
            
        </div>
        <!-- /PRICING-TABLE -->
</div>

</div>
<?php } ?>


<?php if(!empty($india_plan)){ ?>
<div class="row">
<div class="col-md-12">
<div class="group pricing-table">
            <h1 class="heading">Our India Pricing</h1>
            <div class="row">
            <div class="price-mid">
            <?php foreach($india_plan as $key=>$val) {    ?>
            <!-- PERSONAL -->
            
            <div class="col-md-3 <?=$plan_class[$key]?>">
                <h2 class="title"><?=$val->plan_name?></h2>
                <!-- CONTENT -->
                <div class="content">
                    <p class="price">
                        <sup>$</sup>
                        <span><?=$val->slab_range->price?></span>
                        <sub>/mo.</sub>
                    </p>
                    <p class="flag-icon-india"></p>
                </div>
                <!-- /CONTENT -->
                <!-- FEATURES -->
                <ul class="features">
                <?php
                if(!empty($val->features)){
                 foreach($val->features as $k=>$v) { ?>
                    <li><span class="fontawesome-cog"></span>
                    <?php 
                    foreach($v->slab_range as $slab_k => $slab_v)
                                        {
                                            if($slab_v->id==$val->slab_range->id)
                                            {
                                                 if($v->addon_type[$slab_k]=='4')
                                                 {
                                                    echo $v->data_storage[$slab_k]." "._storage_type($v->data_storage_type[$slab_k])." of Storage<br/ >";
                                                   }
                                                elseif($v->addon_type[$slab_k]=='3')
                                                {
                                                    echo $v->total_email[$slab_k]." Email Address<br/ >";        
                                                }
                                                else
                                                {
                                                    echo ucwords($v->feature_name);
                                                }
                                                 
                                            }
                                            
                                        }
                     }?></li>
                <?php   }?>
                
                <?php   if(!empty($plan->support))
                    {
                         foreach($plan->support as $k => $v)
                        {
                            ?>
                             <li><span class="fontawesome-cog"></span>
                            <?=ucwords($v->service_name)?>
                            </li>
                       
                <?php } } ?>
                </ul>
                <!-- /FEATURES -->
                <!-- PT-FOOTER -->
                <div class="pt-footer">
                    <a href="#">SIGN UP</a>
                </div>
                <!-- /PT-FOOTER -->
            </div>
            <!-- /PERSONAL -->
            
            <?php } ?>
            </div>
           </div>
            
            
        </div>
        <!-- /PRICING-TABLE -->
</div>

</div>
<?php } ?>



</div>
            
        <!----------------------- PLans ends here-------------------------------------->    
		</div><!-- CS -->
			<!-- end content -->
		</div>


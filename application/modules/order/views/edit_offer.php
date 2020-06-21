<style>
    .radio-inline .radio{padding-top:0px !important;}
    .block-title {
        padding: 5px 0px 5px 10px;
        margin: 20px 0;
        text-align: left;
        background: linear-gradient(to bottom, rgba(209,207,208,1) 0%,rgba(231,231,231,1) 60%,rgba(235,235,235,1) 77%,rgba(235,235,235,1) 100%);
        border-top: 1px solid #e5e5e5;
        zoom: 1;
    }
    .m-b-10
    {
        margin-bottom: 10px;
    }
    input,select
    {
        margin-bottom: 0px !important;
    }
    .span6.select_style_margin-left{
        width: 50%;
        margin-left: -7px !important;
    }
    .tab_data {
        padding: 10px 0;
        margin: 0px 0 10px;
        border: 1px solid #bdbdbd;
        box-shadow: 0px 4px 9px 2px #949494;
    }
    .mt-10{
        margin-top: 10px !important;
    }
    .ms-options-wrap > .ms-options {
        position: absolute;
        left: 689px !important;
        width: calc(100% - 802px) !important ;
        margin-top: 1px;
        margin-bottom: 20px;
        background: white;
        z-index: 2000;
        border: 1px solid #aaa;
        overflow: auto;
        margin: 0px 12px 0px 12px;
        visibility: hidden;
    }
    .ms-options-wrap > .ms-options > .ms-search input {

        height: 27px !important;
    }
    .ms-options-wrap > .ms-options > ul input[type="checkbox"] {

        left: -53px !important;

    }
    .ms-options-wrap, .ms-options-wrap * {

        border-radius: 5px;
        line-height:12px;
        margin-bottom:5px;

    }
    .error,em{
        color:red;
    }
    select
    {
        float: right;
    }
    input[type="file"] {
        line-height: unset; 
        width: unset;
    }
    .SumoSelect {
        width: 100%;
    }
    .SumoSelect > .CaptionCont > span {
        color: #555;
    }
    .SumoSelect.open .search-txt {
        padding: 12px 8px;
    }
    .SumoSelect > .optWrapper > .options li.opt {
        padding: 2px 2px;
        
    }
    .SumoSelect > .optWrapper.multiple > .options li.opt span i, .SumoSelect .select-all > span i {
       
        width: 10px;
        height: 10px;
    }
    .SumoSelect > .optWrapper > .options::-webkit-scrollbar {
        width: 3px;
    }
    .SumoSelect > .optWrapper > .options::-moz-scrollbar {
        width: 3px;
    }
    .SumoSelect > .optWrapper > .options::-ms-scrollbar {
        width: 3px;
    }
    .SumoSelect > .optWrapper > .options::-o-scrollbar {
        width: 3px;
    }
    .SumoSelect > .optWrapper > .options::scrollbar {
        width: 3px;
    }
    .SelectBox {
        padding: 2px 5px;
    }
    .SumoSelect > .CaptionCont > span {
        font-size: .9em;
    }
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<script type="text/javascript">
    var module_url = '<?=$module_url?>';
</script>
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            
            <div class="portlet-title">
                <!-- <div class="caption"><?=($module_title);?></div> -->
            </div>
            <div class="content">
            
                <?php if(!empty($error_msg)) { ?>
                    <div class="alert alert-danger">
                        <button class="close" data-dismiss="alert"></button>
                        <span id="danger_msg"><?php echo $error_msg; ?></span>
                    </div>
                <?php } ?>
                <?php echo get_flashdata();?>
            
                <form action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><?php echo $title ?></h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Description issued by Customer</label>
                                </div>
                                <div class="span7">
                                    <textarea readonly required="" type="text" name="description_issued_by_customer" id="description_issued_by_customer" value="" class="span12 unique"><?php echo $product_list->description_issued_by_customer ?></textarea>

                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Quantity</label>
                                </div>
                                <div class="span7">
                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty" value="<?=$product_list->qty?>">

                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="currency_factor" class="form-label">Currency Factor<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="currency_factor span12 text" type="text" name="cf" id="currency_factor" value="<?=$enquiry_list->currency_factor?>">
                                    <div class="error" id="error_cf"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="unit_price_with_tax" class="form-label">Unit Price With Tax<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="unit_price_with_tax span12 text" type="text" name="unit_price_with_tax" id="unit_price_with_tax" value="<?php echo $product_list->unit_price_with_tax ?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="total_price_with_tax" class="form-label">Total Unit Price With Tax<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="total_price_with_tax span12 text" type="text" name="total_price_with_tax" id="total_price_with_tax" value="<?php echo $product_list->total_price_with_tax*$enquiry_list->currency_factor ?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div> 
                            <!-- <div class="span6">
                                <div class="span5">
                                    <label for="shipping_cost_china_india" class="form-label">Shipping Cost China-India %<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input onkeyup="calc_shipping_cost_china_india(this.value)" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="shipping_cost_china_india_per span12 text" type="text" name="shipping_cost_china_india_per" id="shipping_cost_china_india_per" value="<?php echo $product_list->shipping_cost_china_india_per ?>">
                                    <div class="error" id="error_shipping_cost_china_india"></div>
                                </div>
                            </div> --> 
                            <div class="span6">
                                <div class="span5">
                                    <label for="shipping_cost_china_india" class="form-label">Shipping Cost China-India<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input onkeyup="calc_shipping_cost_china_india()" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="shipping_cost_china_india span12 text" type="text" name="shipping_cost_china_india" id="shipping_cost_china_india" value="<?php echo $product_list->shipping_cost_china_india ?>">
                                    <div class="error" id="error_shipping_cost_china_india"></div>
                                </div>
                            </div> 
                        </div>

                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="hsn_code" class="form-label">HSN Code<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="hsn_code span12 text" type="text" name="hsn_code" id="hsn_code" value="<?php echo $product_list->hsn_name ?>">
                                    <div class="error" id="error_hsn_code"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="basic_custom_duty" class="form-label"> Basic Custom Duty<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="basic_custom_duty span12 text" type="text" name="basic_custom_duty" id="basic_custom_duty" value="<?php echo $product_list->basic_custom_duty ?>">
                                    <div class="error" id="error_basic_custom_duty"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="shipping_cost_india" class="form-label">Shipping Cost India</label>
                                </div>
                                <div class="span7">
                                    <input onkeyup="calc_shipping_cost_china_india()" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="shipping_cost_india span12 text" type="text" name="shipping_cost_india" id="shipping_cost_india" value="<?php echo $product_list->shipping_cost_india ?>">
                                    <div class="error" id="error_shipping_cost_india"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="total_landed_price" class="form-label">Total Landed Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="total_landed_price span12 text" type="text" name="total_landed_price" id="total_landed_price" value="<?php echo $product_list->total_landed_price ?>">
                                    <div class="error" id="error_total_landed_price"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="unit_price_landed_cost" class="form-label">Unit Price Landed Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="unit_price_landed_cost span12 text" type="text" name="unit_price_landed_cost" id="unit_price_landed_cost" value="<?php echo $product_list->unit_price_landed_cost ?>">
                                    <div class="error" id="error_unit_price_landed_cost"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="margin" class="form-label">Margin %<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input onkeyup="calc_shipping_cost_china_india()" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="margin span12 text" type="text" name="margin" id="margin" value="<?php echo $product_list->margin ?>">
                                    <div class="error" id="error_margin"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="unit_offer_price" class="form-label">Unit offer price<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="unit_offer_price span12 text" type="text" name="unit_offer_price" id="unit_offer_price" value="<?php echo $product_list->unit_offer_price ?>">
                                    <div class="error" id="error_unit_offer_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="total_unit_offer_price" class="form-label">Total offer price<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="total_unit_offer_price span12 text" type="text" name="total_unit_offer_price" id="total_unit_offer_price" value="<?php echo $product_list->total_unit_offer_price ?>">
                                    <div class="error" id="error_total_unit_offer_price"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <button class="btn  btn-info"> Update</button>
                                <button class="btn btn-danger" type="reset" name="reset">Reset</button>
                                <a href="javascript: history.go(-1)" class="btn btn-goback"><span class="icon16 typ-icon-back"></span>Go back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End .box -->
    </div>
<!-- End .span12 -->
</div>
<!-- End .row-fluid -->
<script>
	$(document).ready(function(){
		$("#shipping_cost_china_india").trigger('keyup');
	});

    function calc_shipping_cost_china_india()
    {
        var qty    	= '<?=$product_list->qty?>';
        qty        	= parseFloat(qty);
        if(isNaN(qty)){qty=0}
        var currency_factor         = $("#currency_factor").val();
        currency_factor             = parseFloat(currency_factor);
        if(isNaN(currency_factor)){currency_factor=1}

        var unit_price_with_tax    	= '<?= $quotation_list->unit_price_with_tax ?>';
        unit_price_with_tax        	= parseFloat(unit_price_with_tax);
        if(isNaN(unit_price_with_tax)){unit_price_with_tax=0}
    	unit_price_with_tax 		= unit_price_with_tax*currency_factor;

        total_price_with_tax        = unit_price_with_tax*qty;
		        
        var shipping_cost_china_india    = $("#shipping_cost_china_india").val();
        shipping_cost_china_india        = parseFloat(shipping_cost_china_india);
        if(isNaN(shipping_cost_china_india)){shipping_cost_china_india=0}

        var shipping_cost_india    = $("#shipping_cost_india").val();
        shipping_cost_india        = parseFloat(shipping_cost_india);
        if(isNaN(shipping_cost_india)){shipping_cost_india=0}
        
        var customs_duty_per    = '<?= $product_list->customs_duty ?>';
        customs_duty_per        = parseFloat(customs_duty_per);
        if(isNaN(customs_duty_per)){customs_duty_per=0}

    	var margin    = $("#margin").val();
        margin        = parseFloat(margin);
        if(isNaN(margin)){margin=0}
		 
		var scci_tpwt = shipping_cost_china_india+total_price_with_tax;
        var basic_custom_duty   = scci_tpwt+((scci_tpwt*customs_duty_per)/100);

        var total_landed_price  = total_price_with_tax+shipping_cost_china_india+shipping_cost_india+basic_custom_duty;

        // var unit_price_landed_cost  = unit_price_with_tax+shipping_cost_china_india+shipping_cost_india+basic_custom_duty;
        var unit_price_landed_cost  = total_landed_price/qty;

        var unit_offer_price = unit_price_landed_cost+(unit_price_landed_cost*margin/100);
        var total_unit_offer_price = unit_offer_price*qty;
        $("#basic_custom_duty").val(parseFloat(basic_custom_duty).toFixed(2));
        $("#unit_price_landed_cost").val(parseFloat(unit_price_landed_cost).toFixed(2));
        $("#total_landed_price").val(parseFloat(total_landed_price).toFixed(2));
        $("#unit_offer_price").val(parseFloat(unit_offer_price).toFixed(2));
        $("#total_unit_offer_price").val(parseFloat(total_unit_offer_price).toFixed(2));
    }

</script>

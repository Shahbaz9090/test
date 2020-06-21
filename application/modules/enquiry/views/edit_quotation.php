
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
            
                <form action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal" id="support_form" enctype="multipart/form-data" >

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><?php echo $title ?></h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10" id="1">

                            <div class="span6" id="1">
                                <div class="span5">
                                    <label for="age" class="form-label">Description issued by Customer</label>
                                </div>
                                <div class="span7">
                                    <textarea readonly required="" type="text" name="description_issued_by_customer" id="description_issued_by_customer" value="" class="span12 unique"><?php echo $product_list->description_issued_by_customer ?></textarea>

                                    <div class="error" id="error_description_issued_by_customer"><?php echo form_error('description_issued_by_customer') ?></div>
                                </div>
                            </div>

                            <div class="span6" id="1">
                                <div class="span5">
                                    <label for="age" class="form-label">Description issued by Inch</label>
                                </div>
                                <div class="span7">
                                    <textarea readonly required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch" value="" class="span12 unique"><?php echo $product_list->description_issued_by_inch ?></textarea>

                                    <div class="error" id="error_description_issued_by_inch"><?php echo form_error('description_issued_by_inch') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6" id="1">
                                <div class="span5">
                                    <label for="age" class="form-label">Quantity</label>
                                </div>
                                <div class="span7">
                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty" value="<?=$product_list->qty?>">

                                    <div class="error" id="error_description_issued_by_customer"><?php echo form_error('qty') ?></div>
                                </div>
                            </div>

                            <div class="span6" id="1">
                                <div class="span5">
                                    <label for="age" class="form-label">Unit Of Measurement</label>
                                </div>
                                <div class="span7">
                                    <input readonly="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="uom span12 text" type="text" name="uom" id="uom" value="<?=$product_list->unit_name?>">

                                    <div class="error" id="error_description_issued_by_inch"><?php echo form_error('uom') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Country<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select" name="supplier_country" id="supplier_country" required="">
                                        <option value="">Select Supplier</option>
                                        <?php 
                                        $user_country = explode(',', $userinfo->country);
                                        // if(($userinfo->group_id!=1 && !(in_array(1, $user_country) && in_array(2, $user_country))) && (isset($userinfo->is_super) && $userinfo->is_super==0))
                                        if((isset($userinfo->is_super) && $userinfo->is_super==0) && !(in_array('1', $user_country) && in_array('2', $user_country)))
                                        {
                                            if(in_array('1', $user_country)){?>
                                                 <option <?php echo isset($quotation_list->supplier_country) && $quotation_list->supplier_country==1?'selected':'' ?> value="1">India</option>
                                            <?php }else{?>
                                                <option <?php echo isset($quotation_list->supplier_country) && $quotation_list->supplier_country==2?'selected':'' ?> value="2">China</option>
                                            <?php }
                                        }else{?>
                                        <option <?php echo isset($quotation_list->supplier_country) && $quotation_list->supplier_country==1?'selected':'' ?> value="1">India</option>
                                        <option <?php echo isset($quotation_list->supplier_country) && $quotation_list->supplier_country==2?'selected':'' ?> value="2">China</option>
                                        <?php }?>
                                        
                                    </select>
                                    <div class="error" id="error_supplier_country"><?php echo form_error('supplier_country') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Name <em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select" name="supplier">
                                        <option value="">Select Supplier</option>
                                        <?php 
                                        if(isset($supplier_master) && !empty($supplier_master))
                                        {
                                        foreach ($supplier_master as $key => $supplier) {?>
                                            <option <?php echo isset($quotation_list->supplier) && $supplier->id==$quotation_list->supplier?'selected':'' ?> value="<?php echo $supplier->id ?>" data-vendor-type="<?php echo $supplier->vendor_type ?>"><?php echo $supplier->supplier_name ?></option>
                                        <?php }
                                        }?>
                                    </select>
                                    <div class="error" id="error_supplier"><?php echo form_error('supplier') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label"> Supplier Type<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select" name="supplier_type" required="">
                                        <option value="">Select Supplier Type</option>
                                        <?php 
                                        if(isset($supplier_type_master) && !empty($supplier_type_master))
                                        {
                                        foreach ($supplier_type_master as $key => $supplier_type) {?>

                                            <option <?php echo isset($quotation_list->supplier_type) && $supplier_type->id==$quotation_list->supplier_type?'selected':'12' ?> value="<?php echo $supplier_type->id ?>"><?php echo $supplier_type->name ?></option>

                                        <?php }
                                        }?>
                                    </select>
                                    <div class="error" id="error_supplier_type"><?php echo form_error('supplier_type') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">VAT %<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" onkeyup="cal_unit_price()" class="vat span12 text" type="text" name="vat" id="vat" value="<?php echo $quotation_list->vat ?>">
                                    <div class="error" id="error_vat"><?php echo form_error('vat') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Unit Price<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9.]/,'')" onkeyup="cal_unit_price()" class="unit_price span12 text" type="text" name="unit_price" id="unit_price" value="<?php echo $quotation_list->unit_price ?>">
                                    <div class="error" id="error_unit_price"><?php echo form_error('unit_price') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Unit Price With Tax<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="unit_price_with_tax span12 text" type="text" name="unit_price_with_tax" id="unit_price_with_tax" value="<?php echo $quotation_list->unit_price_with_tax ?>">
                                    <div class="error" id="error_unit_price_with_tax"><?php echo form_error('unit_price_with_tax') ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Total Price With Tax<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="total_price_with_tax span12 text" type="text" name="total_price_with_tax" id="total_price_with_tax" value="<?php echo $quotation_list->total_price_with_tax ?>">
                                    <div class="error" id="error_total_price_with_tax"><?php echo form_error('total_price_with_tax') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery days<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="delivery_days span12 text" type="text" name="delivery_days" id="delivery_days" value="<?php echo $quotation_list->delivery_days ?>">
                                    <div class="error" id="error_delivery_days"><?php echo form_error('delivery_days') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Remarks<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="gw span12 text" type="text" name="gw" id="gw" value="<?php echo $quotation_list->gw ?>">
                                    <div class="error" id="error_gw"><?php echo form_error('gw') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Payment term<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="payment_terms span12 text" type="text" name="payment_terms" id="payment_terms" value="<?php echo $quotation_list->payment_terms ?>">
                                    <div class="error" id="error_payment_terms"><?php echo form_error('payment_terms') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Validity Days<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="validity_days span12 text" type="text" name="validity_days" id="validity_days" value="<?php echo $quotation_list->validity_days ?>">
                                    <div class="error" id="error_validity_days"><?php echo form_error('validity_days') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="delivery_cost span12 text" type="text" name="delivery_cost" id="delivery_cost" value="<?php echo $quotation_list->delivery_cost ?>">
                                    <div class="error" id="error_delivery_cost"><?php echo form_error('delivery_cost') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Packing Cost <em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="packing_cost span12 text" type="text" name="packing_cost" id="packing_cost" value="<?php echo $quotation_list->packing_cost ?>">
                                    <div class="error" id="error_packing_cost"><?php echo form_error('packing_cost') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Warranty months<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="warranty_month span12 text" type="text" name="warranty_month" id="warranty_month" value="<?php echo $quotation_list->warranty_month ?>">
                                    <div class="error" id="error_warranty_month"><?php echo form_error('warranty_month') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn  btn-info"> Update</button>

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

    function cal_unit_price()
    {
        var qty = $("#qty").val();
        qty = parseFloat(qty);
        if(isNaN(qty)){qty=0}
        var unit_price = $("#unit_price").val();
        unit_price = parseFloat(unit_price);
        if(isNaN(unit_price)){unit_price=0}
        var vat = $("#vat").val();
        vat = parseFloat(vat);
        if(isNaN(vat)){vat=0}

        var unit_price_tax = (unit_price*vat)/100;
        var unit_price_with_tax = unit_price_tax+unit_price;
        var total_price_with_tax = unit_price_with_tax*qty;
        $("#unit_price_with_tax").val(parseFloat(unit_price_with_tax).toFixed(2));
        $("#total_price_with_tax").val(parseFloat(total_price_with_tax).toFixed(2));
        /*console.log("qty:"+qty);
        console.log("unit_price:"+unit_price);
        console.log("unit_price_tax:"+unit_price_tax);*/
    }

    $("select[name='supplier_country']").change(function(){
        var supplier_country = $(this).val(); 
        if(supplier_country!=undefined && supplier_country!=null && supplier_country!='')
        {
            $.ajax({
                url:module_url+'/get_venders',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&supplier_country="+supplier_country,
                beforeSend:function()
                {
                    beforeAjaxResponse();
                },
                success:function(res)
                {
                    afterAjaxResponse();
                    if(res.status==1)
                    {
                        $("select[name='supplier']").html(res.data);
                        $("select[name='supplier']").trigger("chosen:updated");
                        $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
                        $("select[name='supplier_type']").trigger("chosen:updated");
                    }
                    else
                    {
                        $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
                        $("select[name='supplier']").trigger("chosen:updated");
                        $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
                        $("select[name='supplier_type']").trigger("chosen:updated");
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
                    $("select[name='supplier']").trigger("chosen:updated");
                    $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
                    $("select[name='supplier_type']").trigger("chosen:updated");
                    alert("Network error.");
                }
            });
        }
        else
        {
            $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
            $("select[name='supplier']").trigger("chosen:updated");
            // alert("Something went wrong!");
            $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
            $("select[name='supplier_type']").trigger("chosen:updated");
        }
    });

    $("select[name='supplier']").change(function(){
        var element = $(this).find('option:selected'); 
        var vendor_type = element.attr("data-vendor-type"); 
        var country_id = $("#supplier_country").val();
        // console.log(vendor_type);
        if(vendor_type!=undefined && vendor_type!=null && vendor_type!='')
        {
            $.ajax({
                url:module_url+'/get_vender_type',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&vendor_type="+vendor_type+"&country_id="+country_id,
                beforeSend:function()
                {
                    beforeAjaxResponse();
                },
                success:function(res)
                {
                    afterAjaxResponse();
                    if(res.status==1)
                    {
                        var data = res.data;
                        $("select[name='supplier_type']").html('<option value="'+data.id+'" >'+data.name+'</option>');
                        $("select[name='supplier_type']").trigger("chosen:updated");
                    }
                    else
                    {
                        $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
                        $("select[name='supplier_type']").trigger("chosen:updated");
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
                    $("select[name='supplier_type']").trigger("chosen:updated");
                    alert("Network error.");
                }
            });
        }
        else
        {
            $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
            $("select[name='supplier_type']").trigger("chosen:updated");
            alert("Something went wrong!");
        }
    });
</script>

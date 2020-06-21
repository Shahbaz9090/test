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
                <?php echo get_flashdata();?>
                <form action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal" id="support_form" enctype="multipart/form-data" onsubmit="return validation()">

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><?php echo $title ?></h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">


                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Communication ID<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="enquiry_id span12 text" type="text" name="enquiry_id" id="enquiry_id" value="<?php echo $product_list->enquiry_id ?>">
                                    <div class="error" id="error_enq_no"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Description issued by Client</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="description_issued_by_customer" id="description_issued_by_customer" class="span12 unique"><?php echo $product_list->description_issued_by_customer ?><?php echo set_value('description_issued_by_customer') ?></textarea>
                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Description issued by Inch</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch"class="span12 unique"><?php echo $product_list->description_issued_by_inch ?><?php echo set_value('description_issued_by_inch') ?></textarea>

                                    <div class="error" id="error_description_issued_by_inch"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">HSN Code India<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select required="" name="hsn_code_india" id="hsn_code_india" class="span12 chosen-select nostyle">
                                        <option value="">Select HSN Code India</option>
                                        <?php 
                                        if(isset($hsncode_master_india) && !empty($hsncode_master_india))
                                        {
                                            foreach ($hsncode_master_india as $key => $hsncode) {?>

                                                <option <?php echo $product_list->hsn_code == $hsncode->form_id ?'selected':'' ?> value="<?php echo $hsncode->form_id?>"><?php echo $hsncode->hsn_name ?></option>
                                            <?php }
                                        }?>
                                    </select>
                                    <div class="error" id="error_hsn_code"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Quantity<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9]/,'')" class="qty span12 text" type="text" name="qty" id="qty" value="<?php echo $product_list->qty ?>" onkeyup="cal_unit_price()">

                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Unit Of Measurement<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select required="" name="uom" class="span12 nostyle chosen-select">
                                        <option value="">Select Unit Type</option>
                                        <?php 
                                        if(isset($unit_master) && !empty($unit_master))
                                        {
                                        foreach ($unit_master as $key => $unit) {?>
                                            <option <?php echo $product_list->uom == $unit->form_id?'selected':'' ?> value="<?php echo $unit->form_id ?>" data-vendor_type="<?php echo $unit->vendor_type ?>"><?php echo $unit->unit_name ?></option>
                                        <?php }
                                        }?>
                                    </select>
                                    <div class="error" id="error_uom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Source<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select" name="supplier_country" id="supplier_country" required="">
                                        <option value="">Select Source</option>
                                        <option value="1" <?php echo $product_list->supplier_country == 1?'selected':'' ?>>India</option>
                                        <option value="2" <?php echo $product_list->supplier_country == 2?'selected':'' ?>>CFIT</option>
                                        <option value="3" <?php echo $product_list->supplier_country == 3?'selected':'' ?>>CFIT & India</option>
                                    </select>
                                    <div class="error" id="error_supplier_country"><?php echo form_error('supplier_country') ?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" onkeyup="cal_unit_price()" class="po_basic span12 text" type="text" name="po_basic" id="po_basic" value="<?php echo $product_list->po_basic ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Total Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" readonly class="po_total_basic span12 text" type="text" name="po_total_basic" id="po_total_basic" value="<?php echo $product_list->po_total_basic ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax%<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo $product_list->vat ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax_value span12 text" type="text" name="po_tax_value" id="po_tax_value" value="<?php echo $product_list->po_tax_value ?>">
                                    <div class="error" id="error_total_price_with_tax"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Total Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="total_price_with_tax span12 text" type="text" name="total_price_with_tax" id="total_price_with_tax" value="<?php echo $product_list->total_price_with_tax ?>">
                                    <div class="error" id="error_total_price_with_tax"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Inv Description<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="inv_description" id="inv_description"class="span12 unique"><?php echo $product_list->inv_description ?><?php echo $product_list->inv_description ?></textarea>
                                    <div class="error" id="error_edit_make_issue_inch"></div>
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
    function cal_unit_price()
    {
        var qty = $("#qty").val();
        qty = parseFloat(qty);
        if(isNaN(qty)){qty=0}
        var po_basic = $("#po_basic").val();
        po_basic = parseFloat(po_basic);
        if(isNaN(po_basic)){po_basic=0}
        var po_tax = $("#po_tax").val();
        po_tax = parseFloat(po_tax);
        if(isNaN(po_tax)){po_tax=0}
        

        var po_total_basic = (po_basic*qty);
        var po_tax_value = (po_basic*po_tax)/100;
        var po_total_value = po_total_basic+(po_tax_value*qty);
        $("#po_total_basic").val(parseFloat(po_total_basic).toFixed(2));
        $("#po_tax_value").val(parseFloat(po_tax_value).toFixed(2));
        $("#total_price_with_tax").val(parseFloat(po_total_value).toFixed(2));
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
        // console.log(vendor_type);
        if(vendor_type!=undefined && vendor_type!=null && vendor_type!='')
        {
            $.ajax({
                url:module_url+'/get_vender_type',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&vendor_type="+vendor_type,
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
//==================CHECK ENQUIRY NO.==============//
function validation()
{
    status = check_enq_no();
    // alert(!status);return false;
    if(status == 0)
    {
        return false;
    }
}
$('#enquiry_id').change(function(){
    check_enq_no();
});
function check_enq_no()
{
    var enq_no = $("#enquiry_id").val();
    var status = 0;
    if(enq_no!='' && enq_no!=undefined && enq_no!=null)
    {
        $.ajax({
            url:module_url+'/check_enquiry_no/',
            type:"POST",
            dataType:'json',
            async:false,
            data: token_name+"="+token_hash+"&enq_no="+enq_no,
            success:function(res)
            {
                // success
                
                if(res.status==0)
                {
                    $("#error_enq_no").text("Enter Valid Enquiry No.");

                }
                else
                {
                    $("#error_enq_no").text("");
                    status = 1;
                }
            }
        });
    }
    // alert(status);
    return status;
}
</script>

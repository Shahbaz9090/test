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
                <form action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal" id="support_invoice_form" enctype="multipart/form-data" onsubmit="return validation()">

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Edit Invoice</h3>
                            </div>
                        </div>
                        <!--<div class="form-row row-fluid m-b-10">


                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">GSTIN No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="enquiry_id span12 text" type="text" name="enquiry_id" id="enquiry_id" value="<?php //echo set_value('enquiry_id') ?>">
                                    <div class="error" id="error_enq_no"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PAN No.</label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="description_issued_by_customer" id="description_issued_by_customer" class="span12 unique">
                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">CIN</label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="description_issued_by_inch" id="description_issued_by_inch"class="span12 unique">

                                    <div class="error" id="error_description_issued_by_inch"></div>
                                </div>
                            </div>
                        </div></br>-->
                        
                        <!--<input type="hidden" name="product_id" value="<?=$this->input->get_post('ids')?>">
                        <input type="hidden" name="order_id" value="<?=$this->input->get_post('order_id')?>">-->
                        <?php //pr($invoice_data)?>
                        <div class="form-row row-fluid m-b-10">

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Invoice No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly  class="qty span12 text" type="text" name="invoice_no" id="qty" value="<?=$invoice_data->invoice_no?>" >

                                    <div class="error" id="error_invoice_no"></div>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Invoice Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required readonly=""  class="invoice_date_time span12 text <?=$invoice_data->is_freeze!=1?'calendarDate':''?>" type="text" name="invoice_date_time" id="invoice_date_time" value="<?=$invoice_data->invoice_date_time?>" >
                                    <div class="error" id="error_invoice_date_time"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Dispatch Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" readonly="" required=""   class="dispatch_date span12 <?=$invoice_data->is_freeze!=1?'calendarDate':''?>" type="text" name="dispatch_date" id="dispatch_date" value="<?=$invoice_data->dispatch_date?>">
                                    <div class="error" id="error_dispatch_date"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Taxable Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <?php $taxable = 0; $i = 0; $po_total_basic = 0; foreach($taxable_values as $key=>$val){
                                        $taxable += $val->po_tax_value;
                                        $po_total_basic += $val->po_total_basic;
                                        $i++;
                                    } $avg_gst = $gst_val/$i; ?>
                                    <input autocomplete="off" readonly  class="taxable_value span12" type="text" name="taxable_value" id="taxable_value" value="<?=$po_total_basic?>">
                                    <div class="error" id="error_taxable_value"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Taxes on Purchase<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" readonly  class="purchase_tax span12 text" type="text" name="purchase_tax" id="purchase_tax" value="<?=$taxable?>">
                                    <div class="error" id="error_purchase_tax"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Freight & Insurance<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required=""  class="freight_insurance span12" type="text" name="freight_insurance" id="freight_insurance" value="<?=$invoice_data->freight_insurance?>" <?=$invoice_data->is_freeze==1?'readonly':''?>>
                                    <div class="error" id="error_freight_insurance"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Packing & Forwarding<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required=""  class="packing_forwarding span12 text" type="text" name="packing_forwarding" id="packing_forwarding" value="<?=$invoice_data->packing_forwarding?>" <?=$invoice_data->is_freeze==1?'readonly':''?>>
                                    <div class="error" id="error_packing_forwarding"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Other Taxes<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" readonly class="other_taxes span12 text" type="text" name="other_taxes" id="other_taxes" value="<?=$invoice_data->other_taxes?>">
                                    <div class="error" id="error_other_taxes"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Total Invoice Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly  required="" type="text" name="total_invoice_value" id="total_invoice_value" class="span12" value="<?=$invoice_data->total_invoice_value?>">
                                    <div class="error" id="error_total_invoice_value"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Advances Paid<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="advance_paid" id="advance_paid"class="span12" value="<?=$invoice_data->advance_paid?>" <?=$invoice_data->is_freeze==1?'readonly':''?>>
                                    <div class="error" id="error_advance_paid"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Due Amount<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly required="" type="text" name="due_amount" id="due_amount"class="span12" value="<?=$invoice_data->due_amount?>">
                                    <div class="error" id="error_due_amount"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery Challan No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="awb_no" id="awb_no"class="span12" value="<?=$invoice_data->awb_no?>">
                                    <div class="error" id="error_awb_no"></div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Shipment Through<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <?php $shipment_company = get_shipment_company();?>
                                    <select name="shipment_through" class="nostyle chosen-select">
                                        <option value="">Select Shipment Company</option>
                                        <?php foreach($shipment_company as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->shipment_through)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_shipping_through"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">LR/AWB No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="lr_no" id="lr_no"class="span12" value="<?=$invoice_data->lr_no?>" <?=$invoice_data->is_freeze==1?'readonly':''?>>
                                    <div class="error" id="error_lr_no"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Client Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="client_contact" class="nostyle chosen-select">
                                        <option value="">Select Contact Person</option>
                                        <?php foreach($contact_person as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->client_contact)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_client_contact"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Client Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="second_client_contact" class="nostyle chosen-select">
                                        <option value="">Select Contact Person</option>
                                        <?php foreach($contact_person as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->second_client_contact)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_second_client_contact"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Consignee<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="consignee" class="nostyle chosen-select" id="consignee" onchange="get_other_data(this.value);">
                                        <option value="">Select Contact Person</option>
                                        <?php foreach($consignee as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->consignee)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_consignee"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Consignee Address<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" readonly type="text" name="consignee_address" id="consignee_address" class="span12 " value=""><?=$invoice_data->consignee_address?></textarea>
                                    <div class="error" id="error_consignee_address"></div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Consignee GST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" readonly name="consignee_gst" id="consignee_gst"class="span12" value="<?=$invoice_data->consignee_gst?>">
                                    <div class="error" id="error_consignee_gst"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Consignee Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="consignee_contact" class="nostyle chosen-select" id="consignee_contact">
                                        <option value="">Select Consignee Contact</option>
                                        <?php foreach($consignee_contact as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->consignee_contact)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_consignee_contact"></div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Consignee Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="second_consignee_contact" class="nostyle chosen-select" id="second_consignee_contact" >
                                        <option value="">Select Consignee Contact</option>
                                        <?php foreach($consignee_contact as $key=>$val){ ?>
                                            <option value="<?=$val->id?>" <?= ($val->name == $invoice_data->second_consignee_contact)?"selected='selected'":"" ?> <?=$invoice_data->is_freeze==1?'disabled':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_second_consignee_contact"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Mode Of<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="mode_of" id="mode_of"class="span12" value="<?=$invoice_data->mode_of?>" <?=$invoice_data->is_freeze==1?'readonly':''?>>
                                    <div class="error" id="error_mode_of"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">E-Way Bill No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="eway_bill_no" id="eway_bill_no"class="span12" value="<?=$invoice_data->eway_bill_no?>">
                                    <div class="error" id="error_eway_bill_no"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info"> Update</button>

                                <!-- <button class="btn btn-danger" type="reset" name="reset">Reset</button> -->
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

$('document').ready(function(){
    $('#freight_insurance, #packing_forwarding').keyup(function(){
        var freight_insurance = parseFloat($('#freight_insurance').val()) || 0;
        var packing_forwarding = parseFloat($('#packing_forwarding').val()) || 0;
        
        //var other_tax = (freight_insurance*packing_forwarding).toFixed(2);
        $('#other_taxes').val(((freight_insurance+packing_forwarding)*0.18).toFixed(2));
    });
    $('#freight_insurance, #packing_forwarding, #taxable_value, #purchase_tax, #other_taxes').keyup(function(){
        var freight_insurance   = parseFloat($('#freight_insurance').val()) || 0;
        var packing_forwarding  = parseFloat($('#packing_forwarding').val()) || 0;
        var taxable_value       = parseFloat($('#taxable_value').val()) || 0;
        var purchase_tax        = parseFloat($('#purchase_tax').val()) || 0;
        var other_taxes         = parseFloat($('#other_taxes').val()) || 0;
        
        //var other_tax = (freight_insurance*packing_forwarding).toFixed(2);
        $('#total_invoice_value').val((freight_insurance+packing_forwarding+taxable_value+purchase_tax+other_taxes).toFixed(2));
    });

    $('#total_invoice_value, #advance_paid').keyup(function(){
        var total_invoice_value = parseFloat($('#total_invoice_value').val()) || 0;
        var advance_paid = parseFloat($('#advance_paid').val()) || 0;
        
        //var other_tax = (freight_insurance*packing_forwarding).toFixed(2);
        $('#due_amount').val((total_invoice_value-advance_paid).toFixed(2));
    });
});

//================================//
function get_other_data(company_id)
{
    if(company_id!=''){
        $.ajax({
            url:"<?php echo base_url();?>order/sales_spares_order/fetch_data_according_company",
          
            data:{company_id:company_id},
            success:function(data)
            {
                var val = JSON.parse(data);
                $('#consignee_address').val(val.company_address);
                $('#consignee_gst').val(val.tax_gst);

            }
        });
        $.ajax({
            url:"<?php echo base_url();?>order/sales_spares_order/fetch_contact_according_company",
          
            data:{company_id:company_id},
            success:function(data)
            {
                //alert(country_id);
               // alert(data);false;
                //console.log(data);
                if(data=='<option value="">No Contact Person found</option>'){
                    //alert();
                    $('#consignee_contact').html(data);
                    $('#consignee_contact').trigger("chosen:updated");
                    $('#second_consignee_contact').html(data);
                    $('#second_consignee_contact').trigger("chosen:updated");
                }else{
                $('#consignee_contact').html(data);
                $('#consignee_contact').trigger("chosen:updated");
                $('#second_consignee_contact').html(data);
                $('#second_consignee_contact').trigger("chosen:updated");
                }

            }
        }); 
    }
    else
    {
        //$('#state_comp').append('<option value="">select country first</option>');
        alert('Company ID not found!!');return false;
    }
}

$(document).ready(function(){
 //$( ".calendarDate" ).datepicker();
 
 $(".calendarDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        constrainInput: false
    });

});
//=======get tax value=================//
</script>

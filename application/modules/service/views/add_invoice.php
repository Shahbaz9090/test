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
                <form action="<?=current_url().'?job_ids='.$_GET['job_ids']?>" method="post" accept-charset="utf-8" class="form-horizontal" id="support_invoice_form" enctype="multipart/form-data" onsubmit="return validation()">

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Add Invoice</h3>
                            </div>
                        </div>
                       
                        
                        <input type="hidden" name="job_ids" value="<?=$this->input->get('job_ids')?>">
                        <input type="hidden" name="service_id" value="<?=$service_id?>">
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Dispatch Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" readonly="" required=""   class="dispatch_date span12 calendarDate" type="text" name="dispatch_date" id="dispatch_date" value="<?php echo isset($invoice_detail) && !empty($invoice_detail)?date('Y-m-d',strtotime($invoice_detail->dispatch_date)):(isset($_POST['dispatch_date']) && !empty($_POST['dispatch_date'])?$_POST['dispatch_date']:'') ?>">
                                    <div class="error" id="error_dispatch_date"><?=form_error('dispatch_date')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Taxable Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" readonly  class="taxable_value span12" type="text" name="taxable_value" id="taxable_value" value="<?=isset($taxable_value) && !empty($taxable_value)?$taxable_value:0;?>">
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
                                    <input autocomplete="off" readonly  class="purchase_tax span12 text" type="text" name="purchase_tax" id="purchase_tax" value="<?=isset($taxable_value) && !empty($taxable_value)?round(0.18*$taxable_value,2):0;?>">
                                    <div class="error" id="error_purchase_tax"></div>
                                </div>
                            </div>
                           <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Total Invoice Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly  required="" type="text" name="total_invoice_value" id="total_invoice_value"class="span12" value="<?=isset($taxable_value) && !empty($taxable_value)?round(1.18*$taxable_value,2):0;?>">
                                    <div class="error" id="error_total_invoice_value"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery Challan No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="del_challan" id="del_challan"class="span12" value="<?php echo isset($invoice_detail->del_challan) && !empty($invoice_detail->del_challan)?$invoice_detail->del_challan:(isset($_POST['del_challan']) && !empty($_POST['del_challan'])?$_POST['del_challan']:'') ?>">
                                    <div class="error" id="error_del_challan"><?=form_error('del_challan')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">E-Way Bill No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="eway_bill_no" id="eway_bill_no"class="span12" value="<?php echo isset($invoice_detail->eway_bill_no) && !empty($invoice_detail->eway_bill_no)?$invoice_detail->eway_bill_no:(isset($_POST['eway_bill_no']) && !empty($_POST['eway_bill_no'])?$_POST['eway_bill_no']:'') ?>">
                                    <div class="error" id="error_eway_bill_no"><?=form_error('eway_bill_no')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Shipment Through<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="shipment_through" class="nostyle chosen-select">
                                        <option value="">Select Shipment Company</option>
                                        <?php foreach($shipment_company as $key=>$val){
                                            $shipment =  isset($invoice_detail->shipment_through) && !empty($invoice_detail->shipment_through)?$invoice_detail->shipment_through:(isset($_POST['shipment_through']) && !empty($_POST['shipment_through'])?$_POST['shipment_through']:'');
                                         ?>
                                            <option value="<?=$val->id?>" <?=$shipment==$val->id?'selected':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_shipping_through"><?=form_error('shipment_through')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">LR/AWB No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="lr_no" id="lr_no"class="span12" value="<?php echo isset($invoice_detail->lr_no) && !empty($invoice_detail->lr_no)?$invoice_detail->lr_no:(isset($_POST['lr_no']) && !empty($_POST['lr_no'])?$_POST['lr_no']:'') ?>">
                                    <div class="error" id="error_lr_no"><?=form_error('lr_no')?></div>
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
                                        <?php foreach($contact_person as $key=>$val){
                                        $contact =  isset($invoice_detail->client_contact) && !empty($invoice_detail->client_contact)?$invoice_detail->client_contact:(isset($_POST['client_contact']) && !empty($_POST['client_contact'])?$_POST['client_contact']:'');
                                         ?>
                                            <option value="<?=$val->id?>" <?=$contact==$val->id?'selected':''?>><?=$val->name?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="error" id="error_client_contact"><?=form_error('client_contact')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Client Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="second_client_contact" class="nostyle chosen-select">
                                        <option value="">Select Contact Person</option>
                                        <?php foreach($contact_person as $key=>$val){
                                        $second_contact =  isset($invoice_detail->second_client_contact) && !empty($invoice_detail->second_client_contact)?$invoice_detail->second_client_contact:(isset($_POST['second_client_contact']) && !empty($_POST['second_client_contact'])?$_POST['second_client_contact']:'');
                                         ?>
                                            <option value="<?=$val->id?>" <?=$second_contact==$val->id?'selected':''?>><?=$val->name?></option>
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
                                        <option value="">Select Consignee</option>
                                        <?php foreach($consignee as $key=>$val){
                                            $cons = isset($invoice_detail->consignee) && !empty($invoice_detail->consignee)?$invoice_detail->consignee:(isset($_POST['consignee']) && !empty($_POST['consignee'])?$_POST['consignee']:'');
                                         ?>
                                            <option value="<?=$val->id?>" <?=$cons==$val->id?'selected':''?>><?=$val->name?></option>
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
                                    <textarea  required="" readonly type="text" name="consignee_address" id="consignee_address" class="span12 " value=""></textarea>
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
                                    <input  required="" type="text" readonly name="consignee_gst" id="consignee_gst"class="span12" value="">
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
                                        
                                    </select>
                                    <div class="error" id="error_second_consignee_contact"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Mode Of<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" type="text" name="mode_of" id="mode_of"class="span12" value="<?php echo isset($invoice_detail->mode_of) && !empty($invoice_detail->mode_of)?$invoice_detail->mode_of:(isset($_POST['mode_of']) && !empty($_POST['mode_of'])?$_POST['mode_of']:'') ?>">
                                    <div class="error" id="error_mode_of"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info"> <?=$title;?></button>

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
    var consignee_contact = "<?=isset($invoice_detail->consignee_contact) && !empty($invoice_detail->consignee_contact)?$invoice_detail->consignee_contact:''?>";
    var second_consignee_contact = "<?=isset($invoice_detail->second_consignee_contact) && !empty($invoice_detail->second_consignee_contact)?$invoice_detail->second_consignee_contact:''?>";
    if(company_id!='')
    {
        $.ajax
        ({
            url:"<?php echo base_url();?>service/fetch_data_according_company",
            type:"POST",
            data: token_name+"="+token_hash+"&company_id="+company_id,
            success:function(data)
            {
                var val = JSON.parse(data);
                if(val.company_address != '' && val.tax_gst != '')
                {
                    $('#consignee_gst').val(val.tax_gst);
                    $('#consignee_address').val(val.company_address);
                }

            }
        });
        $.ajax({
            url:"<?php echo base_url();?>service/fetch_contact_according_company",
            type:"POST",
            data: token_name+"="+token_hash+"&company_id="+company_id,
            success:function(data)
            {
                if(data=='<option value="">No Contact Person found</option>')
                {
                    //alert();
                    $('#consignee_contact').html(data);
                    
                    $('#consignee_contact').trigger("chosen:updated");
                    $('#second_consignee_contact').html(data);
                    
                    $('#second_consignee_contact').trigger("chosen:updated");
                }
                else
                {
                    $('#consignee_contact').html(data);
                    if(consignee_contact)
                    {
                        // alert();
                        $('#consignee_contact').val(consignee_contact);
                    }
                    $('#consignee_contact').trigger("chosen:updated");
                    $('#second_consignee_contact').html(data);
                    if(second_consignee_contact)
                    {
                        $('#second_consignee_contact').val(second_consignee_contact);
                    }
                    $('#second_consignee_contact').trigger("chosen:updated");
                }

            }
        }); 
    }
    else
    {
        alert('Company ID not found!!');
    }
}

$(document).ready(function(){
 //$( ".calendarDate" ).datepicker();
 //=====for edit get consignee==========//
<?php if(isset($invoice_detail->consignee) && !empty($invoice_detail->consignee)):?>
get_other_data("<?=$invoice_detail->consignee?>");
<?php endif;?>
//=====for edit get consignee==========//
 $(".calendarDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        constrainInput: false
    });

});
//=======get tax value=================//
</script>

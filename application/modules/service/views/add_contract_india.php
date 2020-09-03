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
<?php $contract_details = isset($contract_details) && !empty($contract_details)? $contract_details[0]:'' ?>
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            
            <div class="portlet-title">
                <!-- <div class="caption"><?=($module_title);?></div> -->
            </div>
            <div class="content">
                <?php echo get_flashdata();?>
                <form action="" method="post" accept-charset="utf-8" class="form-horizontal" id="support_form" enctype="multipart/form-data" onsubmit="return validation()">

                    <div class="portlet-body" style="padding: 5px;">
                        <!-- Other -->
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Other</h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Status<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select required="" name="contract_status" class="span12 nostyle chosen-select contract_status">
                                        <option value="">Select Contract Status</option>
                                        <?php 
                                            if(isset($contract_status) && !empty($contract_status))
                                            {
                                                foreach ($contract_status as  $unit) {?>

                                                    <option value="<?php echo $unit->form_id ?>" <?=isset($contract_details->contract_status) && !empty($contract_details->contract_status) && $contract_details->contract_status==$unit->form_id?'selected':(isset($_POST['contract_status']) && !empty($_POST['contract_status'])  && $_POST['contract_status'] == $unit->form_id?'selected':'')?> >
                                                        <?php echo $unit->unit_name ?>
                                                    </option>

                                                <?php }
                                            }?>
                                        
                                    </select>
                                    <span>
                                        <div class="error" id="contract_status_error"></div>
                                    </span>
                                </div>
                            </div>
                           <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Internal Remarks<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="internal_remarks" id="internal_remarks"class="span12 unique "><?=isset($contract_details->internal_remarks) && !empty($contract_details->internal_remarks)?$contract_details->internal_remarks:(isset($_POST['internal_remarks']) && !empty($_POST['internal_remarks'])?$_POST['internal_remarks']:'')?></textarea>
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Advance Paid<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" class="advance_paid decimal_input span12 text" type="text" name="advance_paid" id="advance_paid" value="<?=isset($contract_details->advance) && !empty($contract_details->advance)?$contract_details->advance:(isset($_POST['advance_paid']) && !empty($_POST['advance_paid'])?$_POST['advance_paid']:'')?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="advance_paid_date datepicker span12 text" type="text" name="advance_paid_date" id="advance_paid_date" value="<?=isset($contract_details->advance_date) && !empty($contract_details->advance_date)?$contract_details->advance_date:(isset($_POST['advance_paid_date']) && !empty($_POST['advance_paid_date'])?$_POST['advance_paid_date']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Balance Paid<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" class="balance_paid decimal_input span12 text" type="text" name="balance_paid" id="balance_paid" value="<?=isset($contract_details->balance) && !empty($contract_details->balance)?$contract_details->balance:(isset($_POST['balance_paid']) && !empty($_POST['balance_paid'])?$_POST['balance_paid']:'')?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="balance_paid_date datepicker span12 text" type="text" name="balance_paid_date" id="balance_paid_date" value="<?=isset($contract_details->balance_date) && !empty($contract_details->balance_date)?$contract_details->balance_date:(isset($_POST['balance_paid_date']) && !empty($_POST['balance_paid_date'])?$_POST['balance_paid_date']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Advance Amount<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" class="advance_amount decimal_input span12 text" type="text" name="advance_amount" id="advance_amount" value="<?=isset($contract_details->advance_amount) && !empty($contract_details->advance_amount)?$contract_details->advance_amount:(isset($_POST['advance_amount']) && !empty($_POST['advance_amount'])?$_POST['advance_amount']:'')?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Comitted Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="comitted_date datepicker span12 text" type="text" name="comitted_date" id="comitted_date" value="<?=isset($contract_details->comitted_date) && !empty($contract_details->comitted_date)?$contract_details->comitted_date:(isset($_POST['comitted_date']) && !empty($_POST['comitted_date'])?$_POST['comitted_date']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Invoice No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required=""  class="supplier_invoice_no span12 text" type="text" name="supplier_invoice_no" id="supplier_invoice_no" value="<?=isset($contract_details->supplier_invoice_no) && !empty($contract_details->supplier_invoice_no)?$contract_details->supplier_invoice_no:(isset($_POST['supplier_invoice_no']) && !empty($_POST['supplier_invoice_no'])?$_POST['supplier_invoice_no']:'')?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required=""  class="supplier_invoice_date datepicker span12 text" type="text" name="supplier_invoice_date" id="supplier_invoice_date" value="<?=isset($contract_details->supplier_date) && !empty($contract_details->supplier_date)?$contract_details->supplier_date:(isset($_POST['supplier_invoice_date']) && !empty($_POST['supplier_invoice_date'])?$_POST['supplier_invoice_date']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                        </div>
                        <!-- Other -->
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Contract Details</h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Subject</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="subject" id="subject"class="span12 unique "><?=isset($contract_details->subject) && !empty($contract_details->subject)?$contract_details->subject:(isset($_POST['subject']) && !empty($_POST['subject'])?$_POST['subject']:'')?></textarea>

                                    <div class="error" id="error_subject"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Name<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="contract_name span12 text" type="text" name="contract_name" id="contract_name" value="<?=isset($contract_details->contract_name) && !empty($contract_details->contract_name)?$contract_details->contract_name:(isset($_POST['contract_name']) && !empty($_POST['contract_name'])?$_POST['contract_name']:'')?>">
                                    <div class="error" id="error_currency"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">

                             <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Name<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select supplier" name="supplier" id="supplier" required="">
                                        <option value="">Select Supplier</option>
                                        
                                    </select>
                                    <input type="hidden" name="haryana_supplier" id="haryana_supplier" value="2">
                                    <span>
                                        <div class="error" id="supplier_error"></div>
                                    </span>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select required="" name="supplier_contract" id="supplier_contract" class="span12 nostyle chosen-select supplier_contact">
                                        <option value="">Select Supplier Contract</option>
                                    </select>
                                    <span>
                                        <div class="error" id="supplier_contact_error"></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract No.</label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required=""  class="po_basic span12 text" type="text" name="contract_no" id="contract_no" value="<?=isset($contract_details->contract_no) && !empty($contract_details->contract_no)?$contract_details->contract_no:(isset($_POST['contract_no']) && !empty($_POST['contract_no'])?$_POST['contract_no']:'')?>">

                                    <div class="error" id="error_contract_no"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  readonly required="" class="contract_date span12 text datepicker" type="text" name="contract_date" id="contract_date" value="<?=isset($contract_details->contract_date) && !empty($contract_details->contract_date)?$contract_details->contract_date:(isset($_POST['contract_date']) && !empty($_POST['contract_date'])?$_POST['contract_date']:'')?>">
                                    <div class="error" id="error_delivery_date"></div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Payment Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  autocomplete="off" required="" class="payment_terms span12 text" type="text" name="payment_terms" id="payment_terms"><?=isset($contract_details->payment_terms) && !empty($contract_details->payment_terms)?$contract_details->payment_terms:(isset($_POST['payment_terms']) && !empty($_POST['payment_terms'])?$_POST['payment_terms']:'')?></textarea>
                                    <div class="error" id="error_payment_terms"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Freight & Insuarnce<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea autocomplete="off" required=""  class="freight span12 text" type="text" name="freight" id="freight"><?=isset($contract_details->freight_insurance) && !empty($contract_details->freight_insurance)?$contract_details->freight_insurance:(isset($_POST['freight']) && !empty($_POST['freight'])?$_POST['freight']:'')?></textarea>
                                    <div class="error" id="error_freight"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">P&F<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  autocomplete="off" required="" class="pf span12 text" type="text" name="pf" id="pf"><?=isset($contract_details->pf) && !empty($contract_details->pf)?$contract_details->pf:(isset($_POST['pf']) && !empty($_POST['pf'])?$_POST['pf']:'')?></textarea>
                                    <div class="error" id="error_pf"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" class="delivery_terms span12 text" type="text" name="delivery_terms" id="delivery_terms"><?=isset($contract_details->delivery_terms) && !empty($contract_details->delivery_terms)?$contract_details->delivery_terms:(isset($_POST['delivery_terms']) && !empty($_POST['delivery_terms'])?$_POST['delivery_terms']:'')?></textarea>
                                    <div class="error" id="error_delivery_terms"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Warranty Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" class="warranty_terms span12 text" type="text" name="warranty_terms" id="warranty_terms"><?=isset($contract_details->warranty_terms) && !empty($contract_details->warranty_terms)?$contract_details->warranty_terms:(isset($_POST['warranty_terms']) && !empty($_POST['warranty_terms'])?$_POST['warranty_terms']:'')?></textarea>
                                    <div class="error" id="error_warranty_terms"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">LD Charges<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" class="ld_charges span12 text" type="text" name="ld_charges" id="ld_charges"><?=isset($contract_details->ld_charges) && !empty($contract_details->ld_charges)?$contract_details->ld_charges:(isset($_POST['ld_charges']) && !empty($_POST['ld_charges'])?$_POST['ld_charges']:'')?></textarea>
                                    <div class="error" id="error_ld_charges"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Currency<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="currency span12 text" type="text" name="currency" id="currency" value="<?=isset($contract_details->currency) && !empty($contract_details->currency)?$contract_details->currency:(isset($_POST['currency']) && !empty($_POST['currency'])?$_POST['currency']:'')?>">
                                    <div class="error" id="error_currency"></div>
                                </div>
                            </div>
                             <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Currency Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea   required="" class="currency_terms span12 text" type="text" name="currency_terms" id="currency_terms"><?=isset($contract_details->currency_terms) && !empty($contract_details->currency_terms)?$contract_details->currency_terms:(isset($_POST['currency_terms']) && !empty($_POST['currency_terms'])?$_POST['currency_terms']:'')?></textarea>
                                    <div class="error" id="error_currency_terms"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Inspection<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" class="inspection span12 text" type="text" name="inspection" id="inspection" ><?=isset($contract_details->inspection) && !empty($contract_details->inspection)?$contract_details->inspection:(isset($_POST['inspection']) && !empty($_POST['inspection'])?$_POST['inspection']:'')?></textarea>
                                    <div class="error" id="error_inspection"></div>
                                </div>
                            </div>
                        </div>
                        <!-- products -->
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Total</h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                       
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_basic span12 text" type="text" name="po_basic" id="po_basic" value="<?=isset($contract_details->po_basic) && !empty($contract_details->po_basic)?$contract_details->po_basic:(isset($_POST['po_basic']) && !empty($_POST['po_basic'])?$_POST['po_basic']:'')?>" onkeyup="cal_unit_price()">
                                    <div class="error" id="error_po_basic"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax%<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="po_tax decimal_input span12 text" type="text" name="po_tax" id="po_tax" value="<?=isset($contract_details->po_tax) && !empty($contract_details->po_tax)?$contract_details->po_tax:(isset($_POST['po_tax']) && !empty($_POST['po_tax'])?$_POST['po_tax']:'')?>" onkeyup="cal_unit_price()">
                                    <div class="error" id="error_po_tax"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="po_tax_value decimal_input span12 text" type="text" name="po_tax_value" id="po_tax_value" value="<?=isset($contract_details->po_tax_value) && !empty($contract_details->po_tax_value)?$contract_details->po_tax_value:(isset($_POST['po_tax_value']) && !empty($_POST['po_tax_value'])?$_POST['po_tax_value']:'')?>" onkeyup="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="contract_basic span12 text" type="text" name="contract_basic" id="contract_basic" value="<?=isset($contract_details->contract_basic) && !empty($contract_details->contract_basic)?$contract_details->contract_basic:(isset($_POST['contract_basic']) && !empty($_POST['contract_basic'])?$_POST['contract_basic']:'')?>">
                                    <div class="error" id="error_contract_basic"></div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">CGST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="cgst span12 text" type="text" name="cgst" id="cgst" value="<?=isset($contract_details->cgst) && !empty($contract_details->cgst)?$contract_details->cgst:(isset($_POST['cgst']) && !empty($_POST['cgst'])?$_POST['cgst']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">IGST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="igst span12 text" type="text" name="igst" id="igst" value="<?=isset($contract_details->igst) && !empty($contract_details->igst)?$contract_details->igst:(isset($_POST['igst']) && !empty($_POST['igst'])?$_POST['igst']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">SGST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="sgst span12 text" type="text" name="sgst" id="sgst" value="<?=isset($contract_details->sgst) && !empty($contract_details->sgst)?$contract_details->sgst:(isset($_POST['sgst']) && !empty($_POST['sgst'])?$_POST['sgst']:'')?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Note</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="note" id="note"class="span12 unique "><?=isset($contract_details->note) && !empty($contract_details->note)?$contract_details->note:(isset($_POST['note']) && !empty($_POST['note'])?$_POST['note']:'')?></textarea>

                                    <div class="error" id="error_subject"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Amount<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="contract_amount span12 text" type="text" name="contract_amount" id="contract_amount" value="<?=isset($contract_details->contract_basic) && !empty($contract_details->contract_basic)?$contract_details->contract_basic:(isset($_POST['contract_basic']) && !empty($_POST['contract_basic'])?$_POST['contract_basic']:'')?>">
                                    <div class="error" id="error_contract_amount"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info add_contract"><?=$btn_title?></button>

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


    // $("select[name='supplier_country']").change(function(){
    //     var supplier_country = $(this).val(); 
    //     if(supplier_country!=undefined && supplier_country!=null && supplier_country!='')
    //     {
    //         $.ajax({
    //             url:module_url+'/get_venders',
    //             type:"POST",
    //             dataType:'json',
    //             data: token_name+"="+token_hash+"&supplier_country="+supplier_country,
    //             beforeSend:function()
    //             {
    //                 beforeAjaxResponse();
    //             },
    //             success:function(res)
    //             {
    //                 afterAjaxResponse();
    //                 if(res.status==1)
    //                 {
    //                     $("select[name='supplier']").html(res.data);
    //                     $("select[name='supplier']").trigger("chosen:updated");
    //                     $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //                     $("select[name='supplier_type']").trigger("chosen:updated");
    //                 }
    //                 else
    //                 {
    //                     $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
    //                     $("select[name='supplier']").trigger("chosen:updated");
    //                     $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //                     $("select[name='supplier_type']").trigger("chosen:updated");
    //                 }
    //             },
    //             error:function()
    //             {
    //                 afterAjaxResponse();
    //                 $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
    //                 $("select[name='supplier']").trigger("chosen:updated");
    //                 $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //                 $("select[name='supplier_type']").trigger("chosen:updated");
    //                 alert("Network error.");
    //             }
    //         });
    //     }
    //     else
    //     {
    //         $("select[name='supplier']").html('<option value="" >Select Supplier Country</option>');
    //         $("select[name='supplier']").trigger("chosen:updated");
    //         // alert("Something went wrong!");
    //         $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //         $("select[name='supplier_type']").trigger("chosen:updated");
    //     }
    // });

    // $("select[name='supplier']").change(function(){
    //     var element = $(this).find('option:selected'); 
    //     var vendor_type = element.attr("data-vendor-type"); 
    //     var vendor_country = $('#supplier_country').val(); 
    //     // alert(vendor_country);
    //     if(vendor_type!=undefined && vendor_type!=null && vendor_type!='' && vendor_country!='')
    //     {
    //         $.ajax({
    //             url:module_url+'/get_vender_type',
    //             type:"POST",
    //             dataType:'json',
    //             data: token_name+"="+token_hash+"&vendor_type="+vendor_type+"&vendor_country="+vendor_country,
    //             beforeSend:function()
    //             {
    //                 beforeAjaxResponse();
    //             },
    //             success:function(res)
    //             {
    //                 afterAjaxResponse();
    //                 if(res.status==1)
    //                 {
    //                     var data = res.data;
    //                     $("select[name='supplier_type']").html('<option value="'+data.id+'" >'+data.name+'</option>');
    //                     $("select[name='supplier_type']").trigger("chosen:updated");
    //                 }
    //                 else
    //                 {
    //                     $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //                     $("select[name='supplier_type']").trigger("chosen:updated");
    //                 }
    //             },
    //             error:function()
    //             {
    //                 afterAjaxResponse();
    //                 $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //                 $("select[name='supplier_type']").trigger("chosen:updated");
    //                 alert("Network error.");
    //             }
    //         });
    //     }
    //     else
    //     {
    //         $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
    //         $("select[name='supplier_type']").trigger("chosen:updated");
    //         alert("Something went wrong!");
    //     }
    // });
//==================CHECK ENQUIRY NO.==============//
function validation()
{
    status = 1;//check_contract_no();
    // alert(!status);return false;
    if(status == 0)
    {
        return false;
    }
}
$('#contract_no').change(function(){
    check_contract_no();
});
function check_contract_no()
{
    var enq_no = $("#contract_no").val();
    var status = 0;
    if(enq_no!='' && enq_no!=undefined && enq_no!=null)
    {
        $.ajax({
            url:module_url+'/check_contract_no/',
            type:"POST",
            dataType:'json',
            async:false,
            data: token_name+"="+token_hash+"&contract_no="+enq_no+"&source=1",
            success:function(res)
            {
                // success
                if(res.status==1)
                {
                    $("#error_contract_no").text("Contract No. should be unique!");

                }
                else
                {
                    $("#error_contract_no").text("");
                    status = 1;
                }
            }
        });
    }
    // alert(status);
    return status;
}
//=======get tax value=================//
$('#hsn_code_india').change(function(){
    var element = $(this).val(); 
    // alert(element);
    if(element!=undefined)
    {
        $.ajax({
            url:module_url+'/get_hsn_tax',
            type:"POST",
            dataType:'json',
            data: token_name+"="+token_hash+"&hsncode="+element,
            beforeSend:function()
            {
                beforeAjaxResponse();
            },
            success:function(res)
            {
                afterAjaxResponse();
                if(res.status=='success')
                {
                    $('#po_tax').val(res.tax);
                    cal_unit_price();
                }
                else
                {
                    alert(res.message);
                }
            }
        });
    }
});
$("#delivery_date").datepicker({
    dateFormat:'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    // maxDate: 0
});
// $('.hasDatepicker').datepicker();
    $(document).ready(function(){
        var supplier_country = '1'; //for china 2 & for india 1
        var supplier = "<?=$contract_details->supplier?>";
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
                        if(supplier)
                        {
                            $("select[name='supplier']").val(supplier);
                        }
                        $("select[name='supplier']").trigger("chosen:updated");
                        $("select[name='supplier_type']").html('<option value="" >Select Supplier Contact</option>');
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
            $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
            $("select[name='supplier_type']").trigger("chosen:updated");
        }
        //=================================get supplier contract===================================//
        // var vendor_type = element.attr("data-vendor-type"); 
        var country_id = '1';
        var supplier_contract = "<?=$contract_details->supplier_contract?>";
        // console.log(supplier);
        get_supplier_state(supplier);
        if(supplier!=undefined && supplier!=null && supplier!='')
        {
            $.ajax({
                url:module_url+'/get_supplier_contact',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&supplier="+supplier+"&country_id="+country_id,
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
                        $("select[name='supplier_contract']").html('<option value="'+data.id+'" >'+data.name+'</option>');
                        $("select[name='supplier_contract']").val(supplier_contract);
                        $("select[name='supplier_contract']").trigger("chosen:updated");
                    }
                    else
                    {
                        $("select[name='supplier_contract']").html('<option value="" >Select Supplier Contract</option>');
                        $("select[name='supplier_contract']").trigger("chosen:updated");
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    $("select[name='supplier_contract']").html('<option value="" >Select Supplier Contract</option>');
                    $("select[name='supplier_contract']").trigger("chosen:updated");
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

    $("select[name='supplier']").change(function(){
        var supplier = $(this).val();//('option:selected'); 
        // var vendor_type = element.attr("data-vendor-type"); 
        get_supplier_state(supplier);
        var country_id = '1';
        // console.log(supplier);
        if(supplier!=undefined && supplier!=null && supplier!='')
        {
            $.ajax({
                url:module_url+'/get_supplier_contact',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&supplier="+supplier+"&country_id="+country_id,
                beforeSend:function()
                {
                    beforeAjaxResponse();
                },
                success:function(res)
                {
                    afterAjaxResponse();
                    cal_unit_price();
                    if(res.status==1)
                    {
                        var data = res.data;
                        $("select[name='supplier_contract']").html('<option value="'+data.id+'" >'+data.name+'</option>');
                        $("select[name='supplier_contract']").trigger("chosen:updated");
                    }
                    else
                    {
                        $("select[name='supplier_contract']").html('<option value="" >Select Supplier Contract</option>');
                        $("select[name='supplier_contract']").trigger("chosen:updated");
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    $("select[name='supplier_contract']").html('<option value="" >Select Supplier Contract</option>');
                    $("select[name='supplier_contract']").trigger("chosen:updated");
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
//=======get tax value=================//
function cal_unit_price(key)
{
    var haryana = $('#haryana_supplier').val()==1?true:false;//if haryaana then cgst & igst else igst
    // alert(haryana);
    // var qty = $("#qty"+key).val();
    // qty = parseFloat(qty);
    // if(isNaN(qty)){qty=0}
    var po_basic = $("#po_basic").val();
    po_basic = parseFloat(po_basic);
    if(isNaN(po_basic)){po_basic=0}
    var po_tax = $("#po_tax").val();
    po_tax = parseFloat(po_tax);
    if(isNaN(po_tax)){po_tax=0}
    
    // var freight = parseFloat($('#contract_freight').val()) || 0;
    // var pf_cost = parseFloat($('#pf_cost').val()) || 0;
    // var po_total_basic = (po_basic*qty);
    var po_tax_value = (po_basic*po_tax)/100;
    var po_total_value = po_basic+po_tax_value;
    // $("#contract_total_basic"+key).val(parseFloat(po_total_basic).toFixed(2));
    $("#po_tax_value").val(parseFloat(po_tax_value).toFixed(2));
    $("#contract_amount").val(parseFloat(po_total_value).toFixed(2));
    // var overall_contract_basic = 0;
    // var overall_total_value = 0;
    // $('.contract_total_basic').each(function(){
    //     var price = parseFloat($(this).val()) || 0;
    //     overall_contract_basic += price;
    // });
    // $('.contract_total_value').each(function(){
    //     var price1 = parseFloat($(this).val()) || 0;
    //     //for igst,cgst,sgst
    //     // alert(price1);
    //     overall_total_value += price1;
    // });
    // $('#overall_contract_basic').val(overall_contract_basic);
    //==================for cgst,igst,sgst====================//
    var gst = po_tax_value;
    if(haryana)
    {
        $('#cgst').val(parseFloat(gst/2).toFixed(2));
        $('#sgst').val(parseFloat(gst/2).toFixed(2));
        $('#igst').val(0);
    }
    else
    {
        $('#igst').val(parseFloat(gst).toFixed(2));
        $('#cgst').val(0);
        $('#sgst').val(0);
    }
    //==================for cgst,igst,sgst====================//
    
    // alert(freight);
    // var overall_total_value = freight + overall_contract_basic + pf_cost;
    // var contract_amount     = overall_total_value + gst;
    // $('#overall_contract_total_value').val(overall_total_value);
    // $('#overall_contract_amount').val(parseFloat(contract_amount).toFixed(2));
    /*console.log("qty:"+qty);
    console.log("unit_price:"+unit_price);
    console.log("unit_price_tax:"+unit_price_tax);*/
}
$(".decimal_input").keypress(function(e){
var num = $(this).val();
// alert(e.which);
if(num.indexOf('.') == -1 )
{
    if((e.which <48 || e.which>57) && e.which != 46)
    {
        e.preventDefault();
    }
}
else
{
    if(e.which <48 || e.which>57)
    {
        e.preventDefault();
    }
}
});
$('.datepicker').datepicker({
    dateFormat:'yy-mm-dd',
});

//==========get supplier state for gst============//
function get_supplier_state(supplier)
{
    if(supplier!=undefined && supplier!=null && supplier!='')
    {
        $.ajax({
            url:module_url+'/get_supplier_state',
            type:"POST",
            dataType:'json',
            data: token_name+"="+token_hash+"&supplier="+supplier,
            success:function(res)
            {
                var data = res.data;
                $("#haryana_supplier").val(data);
                
            }
        });
    }
}

$(document).ready(function(){
    $('.add_contract').click(function(){
        var contract_status  = $('.contract_status').val();
        var supplier         = $('.supplier').val();
        var supplier_contact = $('.supplier_contact').val();
        var unit             = $('.unit').val();

        //alert(contract_status+' '+supplier+' '+supplier_contact+' '+unit);return false;
        if(contract_status=='')
        {
            $("#contract_status_error").html("Please select contract status!");    
        }
        else
        {
            $("#contract_status_error").html("");  
        }
        if(supplier=='')
        {
            $("#supplier_error").html("Please select supplier!");
        }
        else
        {
            $("#supplier_error").html("");  
        }
        if(supplier_contact=='')
        {
            $("#supplier_contact_error").html("Please select supplier contact!!");
        }
        else
        {
            $("#supplier_contact_error").html("");  
        }
        $('.unit').each(function(){
            // alert($(this).val() == '');
            if($(this).val() == '')
            {
                $(this).parent().find('.error').html('Please select unit!!');
            }
            else
            {
                $(this).parent().find('.error').html('');
            }
        });
    });
});
</script>

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
                                    <label for="age" class="form-label">Subject</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="subject" id="subject"class="span12 unique "><?php echo set_value('subject') ?></textarea>

                                    <div class="error" id="error_subject"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract No.</label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required=""  class="po_basic span12 text" type="text" name="contract_no" id="contract_no" value="<?php echo set_value('contract_no') ?>">

                                    <div class="error" id="error_contract_no"></div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="form-row row-fluid m-b-10">

                             <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Name<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select class="span12 nostyle chosen-select" name="supplier" id="supplier" required="">
                                        <option value="">Select Supplier</option>
                                        
                                    </select>
                                    <div class="error" id="error_supplier"><?php echo form_error('supplier') ?></div>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Contact<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select required="" name="supplier_contract" id="supplier_contract" class="span12 nostyle chosen-select">
                                        <option value="">Select Supplier Contract</option>
                                    </select>
                                    <div class="error" id="error_uom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Payment Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" class="payment_terms span12 text" type="text" name="payment_terms" id="payment_terms" value="<?php echo set_value('payment_terms') ?>">
                                    <div class="error" id="error_payment_terms"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Freight & Insuarnce<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required=""  class="freight span12 text" type="text" name="freight" id="freight" value="<?php echo set_value('freight') ?>">
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
                                    <input autocomplete="off" required="" class="pf span12 text" type="text" name="pf" id="pf" value="<?php echo set_value('pf') ?>">
                                    <div class="error" id="error_pf"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Delivery Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="delivery_terms span12 text" type="text" name="delivery_terms" id="delivery_terms" value="<?php echo set_value('delivery_terms') ?>">
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
                                    <input  required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="warranty_terms span12 text" type="text" name="warranty_terms" id="warranty_terms" value="<?php echo set_value('warranty_terms') ?>">
                                    <div class="error" id="error_warranty_terms"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">LD Charges<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="ld_charges span12 text" type="text" name="ld_charges" id="ld_charges" value="<?php echo set_value('ld_charges') ?>">
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
                                    <input  required="" class="currency span12 text" type="text" name="currency" id="currency" value="<?php echo set_value('currency') ?>">
                                    <div class="error" id="error_currency"></div>
                                </div>
                            </div>
                             <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Currency Terms<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  required="" class="currency_terms span12 text" type="text" name="currency_terms" id="currency_terms" value="<?php echo set_value('currency_terms') ?>">
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
                                    <input  required="" class="inspection span12 text" type="text" name="inspection" id="inspection" value="<?php echo set_value('inspection') ?>">
                                    <div class="error" id="error_inspection"></div>
                                </div>
                            </div>
                             <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input  readonly required="" class="contract_date span12 text" type="text" name="contract_date" id="contract_date" value="<?php echo set_value('contract_date') ?>">
                                    <div class="error" id="error_delivery_date"></div>
                                </div>
                            </div>
                        </div>
                        <!-- products -->
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Products</h3>
                            </div>
                        </div>
                    <?php if(isset($products) && !empty($products)):?>
                    <?php foreach($products as $product):?>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Communication ID<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="enquiry_id span12 text" type="text" name="enquiry_id" id="enquiry_id" value="<?php echo $product->enquiry_id ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">HSN Code<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="hsn_name span12 text" type="text" name="hsn_name" id="hsn_name" value="<?php echo $product->hsn_name ?>" >
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Inch Description<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required=""  readonly class="description_issued_by_inch span12 text" type="text" name="description_issued_by_inch" id="description_issued_by_inch" value="<?php echo $product->description_issued_by_inch ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Description<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" class="contract_description span12 text" type="text" name="contract_description" id="contract_description" value="<?php echo set_value('contract_description') ?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Qty<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="qty span12 text" type="text" name="qty" id="qty" value="<?php echo $product->qty ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Unit<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" class="uom_name span12 text" type="text" name="uom_name" id="uom_name" value="<?php echo $oroduct->uom_name ?>">
                                    <div class="error" id="error_uom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="po_basic span12 text" type="text" name="po_basic" id="po_basic" value="<?php echo $product->po_basic ?>">
                                    <div class="error" id="error_po_basic"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="contract_basic span12 text" type="text" name="contract_basic" id="contract_basic" value="<?php echo set_value('contract_basic') ?>">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Total Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="po_total_basic span12 text" type="text" name="po_total_basic" id="po_total_basic" value="<?php echo $product->po_total_basic ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Total Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="contract_total_basic span12 text" type="text" name="contract_total_basic" id="contract_total_basic" value="<?php echo set_value('contract_total_basic') ?>">
                                    <div class="error" id="error_contract_total_basic"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax %<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo $product->vat ?>">
                                    <div class="error" id="error_po_tax"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Tax %<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="contract_tax span12 text" type="text" name="contract_tax" id="contract_tax" value="<?php echo set_value('contract_tax') ?>">
                                    <div class="error" id="error_contract_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Tax Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="po_tax_value span12 text" type="text" name="po_tax_value" id="po_tax_value" value="<?php echo $product->po_tax_value ?>">
                                    <div class="error" id="error_po_tax_value"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Tax Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="contract_tax_value span12 text" type="text" name="contract_tax_value" id="contract_tax_value" value="<?php echo set_value('contract_tax_value') ?>">
                                    <div class="error" id="error_contract_tax_value"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">PO Total Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" readonly class="po_total_value span12 text" type="text" name="po_total_value" id="po_total_value" value="<?php echo $product->total_price_with_tax ?>">
                                    <div class="error" id="error_po_total_value"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Total Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="contract_total_value span12 text" type="text" name="contract_total_value" id="contract_total_value" value="<?php echo set_value('contract_total_value') ?>">
                                    <div class="error" id="error_unit_price_with_tax1"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <?php endif;?>
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Total</h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Note</label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="subject" id="subject"class="span12 unique "><?php echo set_value('subject') ?></textarea>

                                    <div class="error" id="error_subject"></div>
                                </div>
                            </div>
                       
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Total Basic<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">IGST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                       
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">CGST<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
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
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Total Value<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">P&F Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                       
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Freight & Insuarnce<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Contract Amount<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3>Other</h3>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Advance Paid<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" readonly class="po_total_basic span12 text" type="text" name="po_total_basic" id="po_total_basic" value="<?php echo set_value('po_total_basic') ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
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
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" readonly class="po_total_basic span12 text" type="text" name="po_total_basic" id="po_total_basic" value="<?php echo set_value('po_total_basic') ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
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
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" readonly class="po_total_basic span12 text" type="text" name="po_total_basic" id="po_total_basic" value="<?php echo set_value('po_total_basic') ?>">
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input readonly="" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="po_tax span12 text" type="text" name="po_tax" id="po_tax" value="<?php echo set_value('po_tax') ?>" onchange="cal_unit_price()">
                                    <div class="error" id="error_unit_price_with_tax"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Internal Remarks<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <textarea  required="" type="text" name="subject" id="subject"class="span12 unique "><?php echo set_value('subject') ?></textarea>
                                    <div class="error" id="error_unit_price"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info"> Add</button>

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
            // alert("Something went wrong!");
            $("select[name='supplier_type']").html('<option value="" >Select Supplier Type</option>');
            $("select[name='supplier_type']").trigger("chosen:updated");
        }
    });
    $("select[name='supplier']").change(function(){
        var supplier = $(this).val();//('option:selected'); 
        // var vendor_type = element.attr("data-vendor-type"); 
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
</script>

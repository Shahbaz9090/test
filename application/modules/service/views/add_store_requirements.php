
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
                                    <label for="age" class="form-label">New/Existing<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="new_or_exist" id="new_or_exist" class="span12 chosen-select nostyle">
                                        <option value="1" <?=isset($store_req->new_or_exist) && !empty($store_req->new_or_exist)?($store_req->new_or_exist==1?'selected':''):''?>>New</option>
                                        <option value="2" <?=isset($store_req->new_or_exist) && !empty($store_req->new_or_exist)?($store_req->new_or_exist==2?'selected':''):''?>>Existing</option>
                                    </select>
                                    <div class="error" id=""><?=form_error('new_or_exist')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">UPC</label>
                                </div>
                                <div class="span7">
                                    <select name="upc" id="upc" class="span12 chosen-select nostyle"  onchange="get_details()">
                                        <option value="">Select UPC</option>
                                         <?php if(isset($upc_list) && !empty($upc_list)):?>
                                        <?php foreach($upc_list as $upc):?>
                                            <option value="<?=$upc->product_id?>" data-name="<?=$upc->upc?>"  <?=isset($store_req->upc) && !empty($store_req->upc)?($store_req->upc==$upc->upc?'selected':''):''?>><?=$upc->upc?></option>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <input type="hidden" name="upc_value" id="upc_value" value="<?=isset($store_req->upc) && !empty($store_req->upc)?$store_req->upc:''?>">
                                    <div class="error" id="upc_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Category</label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="category" class="category" id="category" value="<?=isset($store_req->category) && !empty($store_req->category)?$store_req->category:''?>" style="width: 98%;">
                                    <div class="error" id=""><?=form_error('category')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Sub-Category<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="sub_cat" class="sub_cat" id="sub_cat" value="<?=isset($store_req->sub_cat) && !empty($store_req->sub_cat)?$store_req->sub_cat:''?>">
                                    <div class="error" id=""><?=form_error('sub_cat')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Specification</label>
                                </div>
                                <div class="span7">
                                    <textarea name="specification" id="specification" style="width: 98%;"><?=isset($store_req->specification) && !empty($store_req->specification)?$store_req->specification:''?></textarea>
                                    <div class="error" id=""><?=form_error('specification')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Quantity<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="qty" class="qty decimal_input" id="qty" value="<?=isset($store_req->qty) && !empty($store_req->qty)?$store_req->qty:''?>">
                                    <div class="error" id=""><?=form_error('qty')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Requirement</label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="requirement" class="requirement decimal_input" id="requirement" style="width: 98%;" onkeyup="calc_price()" value="<?=isset($store_req->requirement) && !empty($store_req->requirement)?$store_req->requirement:''?>">
                                    <div class="error" id=""><?=form_error('requirement')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Ref. Price<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="ref_price" class="ref_price decimal_input" id="ref_price" onkeyup="calc_price()" value="<?=isset($store_req->ref_price) && !empty($store_req->ref_price)?$store_req->ref_price:''?>">
                                    <div class="error" id=""><?=form_error('ref_price')?></div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Total Price<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="total_price" class="total_price" id="total_price" style="width: 98%;" readonly value="<?=isset($store_req->total_price) && !empty($store_req->total_price)?$store_req->total_price:''?>">
                                    <div class="error" id=""><?=form_error('total_price')?></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Supplier Name</label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="supplier_name" class="supplier_name" id="supplier_name" style="width: 98%;" value="<?=isset($store_req->supplier_name) && !empty($store_req->supplier_name)?$store_req->supplier_name:''?>">
                                    <div class="error" id=""><?=form_error('supplier_name')?></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info"> <?=$btn_title?></button>

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
function get_details()
{
    var product_id = $('#upc').val();
    var upc_val    = $('#upc :selected').data('name');
    // alert(upc_val);
    if(product_id)
    {
        $.ajax({
            type: 'POST',
            url: module_url+'/get_product_details',
            data: token_name+"="+token_hash+"&product_id="+product_id,
            success: function(dat)
            {
                dat = JSON.parse(dat);
                $('#category').val(dat.category);
                $('#sub_cat').val(dat.sub_category);
                $('#specification').val(dat.specification);
                $('#ref_price').val(dat.price);
                $('#upc_value').val(upc_val);
                $('#category,#sub_cat,#specification,#ref_price').attr('readonly',true);
                calc_price();
            }
        });
    }
    else
    {
        $('#category,#sub_cat,#specification,#ref_price').val('');
        $('#category,#sub_cat,#specification,#ref_price').attr('readonly',false);
    }
}
function calc_price()
{
    var requirement = parseInt($('#requirement').val())||0;
    var ref_price = parseFloat($('#ref_price').val())||0;
    var total_price = requirement*ref_price;
    $('#total_price').val(total_price);
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
</script>

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
    .SumoSelect .CaptionCont.SelectBox.search {
        width: 100%;
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
    .text-center
    {
        text-align: center !important;
    }
    .text-right
    {
        text-align: right !important;
    }
    .text-left
    {
        text-align: left !important;
    }
    @media (min-width: 1200px)
    {
        .row-fluid [class*="span"] {
            margin-left: 0px; 
        }
    }

    .table thead th, .table tbody td {
        border: 1px solid #dddddd;
    }
.border-none
{
    border:none;
}
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<script type="text/javascript">
    var base_url = '<?=$base_url?>';
</script>
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <div class="title">
                <h4><span>Manage LOT</span></h4>
            </div>
            
            <div class="content">
                <?php echo get_flashdata();?>
                <form action="<?=current_url()?>" method="post" accept-charset="utf-8" class="form-horizontal"  enctype="multipart/form-data">

                    <div class="portlet-body" style="padding: 5px;">
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><?php echo $title ?></h3>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Invoice No.<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input placeholder="Auto Generated" readonly oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="invoice_no text" type="text" name="invoice_no" id="invoice_no" value="<?php echo set_value('invoice_no') ?>">

                                    <div class="error" id="error_invoice_no"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Date<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required onkeypress="return false" class="lot_date  text datepicker" type="text" name="lot_date" id="lot_date" value="<?php echo set_value('lot_date') ?>">

                                    <div class="error" id="error_lot_date"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Client Reference<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="client_reference  text" type="text" name="client_reference" id="client_reference" value="<?php echo set_value('client_reference') ?>">

                                    <div class="error" id="error_source"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Source<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="source  text" type="text" name="source" id="source" value="<?php echo set_value('source') ?>">

                                    <div class="error" id="error_source"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Destination<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="destination  text" type="text" name="destination" id="destination" value="<?php echo set_value('destination') ?>">

                                    <div class="error" id="error_destination"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Via<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="via  text" type="text" name="via" id="via" value="<?php echo set_value('via') ?>">

                                    <div class="error" id="error_via"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Mode of Dispatch <em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="mode_of_dispatch  text" type="text" name="mode_of_dispatch" id="mode_of_dispatch" value="<?php echo set_value('mode_of_dispatch') ?>">
                                    <div class="error" id="error_mode_of_dispatch"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Terms of Delivery<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="terms_of_delivery  text" type="text" name="terms_of_delivery" id="terms_of_delivery" value="<?php echo set_value('terms_of_delivery') ?>">

                                    <div class="error" id="error_terms_of_delivery"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Search Order<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input oninput="this.value=this.value.replace(/[^0-9a-zA-Z_+,.@% ]/,'')" class="search_order text" type="text" name="search_order" id="search_order" value="<?php echo set_value('search_order') ?>">

                                    <div class="error" id="error_terms_of_delivery"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label class="form-label">Select Order<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select multiple="" name="order_id" id="order_id" class=" nostyle multiselect1 order_id">
                                    <?php 
                                    if(isset($order_list) && !empty($order_list))
                                    {
                                        foreach ($order_list as $key => $order) {?>
                                            <option value="<?php echo $order->form_id ?>"><?php echo $order->po_no ?></option>
                                        <?php }
                                        }?>
                                    </select>
                                    <div class="error" id="error_hsn_code"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th  class="ch" width="3%">
                                            <input type="checkbox" name="allCheckbox" value="all" class="checkall">
                                        </th>
                                        <th class="text-left">Sr. No</th>
                                        <th class="text-left">Comm ID</th>
                                        <th class="text-left">Item Name</th>
                                        <th class="text-left">Qty</th>
                                        <th class="text-left">USD</th>
                                        <th class="text-left">USD Total</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody order_product_list">
                                    
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="no_of_box" id="no_of_box" value="1">
                        <div class="form-row row-fluid m-b-10 first_box">
                            <!-- <div class="form-row">hgbhg </div> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left">Sr. No</th>
                                        <th style="width: 100px;" class="text-left">Comm ID</th>
                                        <th class="text-left">Qty</th>
                                        <th class="text-left">L</th>
                                        <th class="text-left">W</th>
                                        <th class="text-left">H</th>
                                        <th class="text-left">CBM</th>
                                        <th class="text-left">NW</th>
                                        <th class="text-left">GW <a style="float: right;padding: 2px 3px" class="btn btn-info add_more_box">+ Box</a></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody order_box_list">
                                    <tr class="box">
                                        <td></td>
                                        <td></td>
                                        <td class="text-left" style="width: 60px"><input placeholder="Box Name" type="text" name="box_name"></td>
                                        <td><input type="text" name="" value="23"></td>
                                        <td><input type="text" name="" value="23"></td>
                                        <td><input type="text" name="" value="45"></td>
                                        <td><input type="text" name="" value="0.02"></td>
                                        <td><input type="text" name="" value="11"></td>
                                        <td><input type="text" name="" value="14"></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="block-title text-right">
                                <h3 style="text-align: left;position: absolute;">Action</h3>
                                <button type="button" class="btn-info border-none ">Prepare invoice</button>
                                <button type="button" class="btn-info  border-none ">Prepare Contract</button>
                                <button type="button" class="btn-info border-none ">Prepare PL</button>
                                <button type="button" class="btn-info border-none ">Prepare Check</button>
                                <button type="button" class="btn-info border-none ">Prepare HSN</button>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions" style="padding-left: 0;">
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

    $(document).ready(function(){
        jq(".multiselect1").SumoSelect({placeholder:'Select Order',search:true});
        $("input.datepicker").datepicker({
            dateFormat:'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });

        $(".search_order").keyup(function(){
            setTimeout(search($(this).val()), 500);
        });

        jq('select.order_id').on('sumo:closed', function(sumo) {
            // Do stuff here
            console.log("Drop down closed");
            var ids = [];
            var added_product = [];
            jq("select.order_id option:selected").each(function(){
                ids.push($(this).val());
                
            });

            $(".record_checkbox").each(function(){
                added_product.push($(this).attr('data-product-id'));
                
            });
            console.log(ids);
            console.log(added_product);
            if(Array.isArray(ids) && ids.length)
            {
                get_order_product_detail(ids, added_product);
            }

        });

        $('.checkall').change(function(){
            // alert($(this).is(':checked'))
            if($(this).is(':checked')){
                
                $('.record_checkbox').prop('checked','checked');
                $('.record_checkbox').parent().addClass('checked');
            }
            else
            {
                $('.record_checkbox').prop('checked',false);
                $('.record_checkbox').parent().removeClass('checked');
            }
            
        });

        /*jq('select.order_id').change(function() {
            var ids = [];
            jq("order_id option:selected").each(function(){
                ids.push(js(this).val());
                
            });

            if(Array.isArray(ids) && ids.length)
            {
                get_order_product_detail(ids);
            }
        });*/
    });

    function search(searchText)
    {
        if(searchText)
        {
            $.ajax({
                url:base_url+'/get_order_list',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&searchText="+searchText,
                beforeSend:function()
                {
                    beforeAjaxResponse();
                },
                success:function(res)
                {
                    afterAjaxResponse();
                    if(res.status==1)
                    {
                        $("select.order_id").html(res.data);
                        $('select.order_id')[0].sumo.reload();
                    }
                    else
                    {
                        $("select.order_id").html('');
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    alert("Network error.");
                }
            });
        }
        else
        {
            // alert("Network error.");
        }
    }

    function get_order_product_detail(ids, added_product)
    {
        if(ids)
        {
            $.ajax({
                url:base_url+'/get_order_product_list',
                type:"POST",
                dataType:'json',
                data: token_name+"="+token_hash+"&ids="+ids+"&added_product="+added_product,
                beforeSend:function()
                {
                    beforeAjaxResponse();
                },
                success:function(res)
                {
                    afterAjaxResponse();
                    if(res.status==1)
                    {
                        $(".order_product_list").append(res.data);
                    }
                    else
                    {
                        // $(".order_product_list").html('');
                    }
                },
                error:function()
                {
                    afterAjaxResponse();
                    alert("Network error.");
                }
            });
        }
        else
        {
            // alert("Network error.");
        }
    }

    function add_in_box(this1,p_id, order_id, qty, unit_offer_price=0, total_unit_offer_price=0,po_no)
    {
        if($(this1).is(':checked'))
        {
            var box = '';
            box += '<tr class="product_box_'+p_id+'">';
                box += '<td>1</td>';
                box += '<td class="text-left">'+po_no+'-'+p_id+'</td>';
                box += '<td><input placeholder="Qty" type="text" name="qty" value="'+qty+'"><input type="hidden" name="p_id" value="'+p_id+'"><input type="hidden" name="order_id" value="'+order_id+'"></td>';
                box += '<td></td>';
                box += '<td></td>';
                box += '<td></td>';
                box += '<td><input type="text" name="cbm" value=""></td>';
                box += '<td></td>';
                box += '<td></td>';
            box += '</tr>';
            $(".order_box_list").append(box);
        }
        else
        {
            $(".product_box_"+p_id).remove();
        }
    }

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
    
$('.add_more_box').click(function(){
var i = $('#no_of_box').val();
i += 1;
$('#no_of_box').val(i);
$('.first_box').append('<div class="form-row row-fluid m-b-10 box'+i+'">\
                            <table class="table">\
                                <thead>\
                                    <tr>\
                                        <th class="text-left">Sr. No</th>\
                                        <th style="width: 100px;" class="text-left">Comm ID</th>\
                                        <th class="text-left">Qty</th>\
                                        <th class="text-left">L</th>\
                                        <th class="text-left">W</th>\
                                        <th class="text-left">H</th>\
                                        <th class="text-left">CBM</th>\
                                        <th class="text-left">NW</th>\
                                        <th class="text-left">GW <a style="float: right;cursor:pointer;" class="btn btn-xs delete" onclick="delete_box('+i+')"><i class="fa fa-trash-o" ></i></a></th>\
                                    </tr>\
                                </thead>\
                                <tbody class="tbody order_box_list">\
                                    <tr class="box">\
                                        <td></td>\
                                        <td></td>\
                                        <td class="text-left" style="width: 60px"><input placeholder="Box Name" type="text" name="box_name"></td>\
                                        <td><input type="text" name="" ></td>\
                                        <td><input type="text" name="" ></td>\
                                        <td><input type="text" name="" ></td>\
                                        <td><input type="text" name="" ></td>\
                                        <td><input type="text" name="" ></td>\
                                        <td><input type="text" name="" ></td>\
                                    </tr>\
                                </tbody>\
                            </table>\
                        </div>');
});
function delete_box(i)
{
    $('.box'+i).remove();
} 
</script>

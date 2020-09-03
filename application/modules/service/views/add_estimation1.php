<!-- <script src="<?php  echo SITE_PATH  ?>assets/js/jquery.ui.touch-punch.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/date-time/moment.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/ace.js"></script>
<link href="<?php echo base_url();?>assets/css/bootstrap/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.js"></script>
<script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-timepicker.js"></script>
<!-- <script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-datetimepicker.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/date-time/daterangepicker.js"></script> -->
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
                                    <input required="" class="job_id span12 text" type="text" name="job_id" id="job_id" value="<?php echo set_value('job_id') ?>">
                                    <div class="error" id="error_enq_no"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Repairable</label>
                                </div>
                                <div class="span7">
                                    <select name="repairable" id="repairable" class="span12 chosen-select nostyle">
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Service level</label>
                                </div>
                                <div class="span7">
                                    <select name="service_level" id="service_level" class="span12 chosen-select nostyle">
                                        <option value="1">Starter</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Expert</option>
                                    </select>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Service Time<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="service_time" class="service_time timepicker" readonly>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Testing level</label>
                                </div>
                                <div class="span7">
                                    <select name="testing_level" id="testing_level" class="span12 chosen-select nostyle">
                                        <option value="1">Starter</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Expert</option>
                                    </select>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Testing Time<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="testing_time" class="service_time timepicker" readonly>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Quality level</label>
                                </div>
                                <div class="span7">
                                    <select name="quality_level" id="quality_level" class="span12 chosen-select nostyle">
                                        <option value="1">Starter</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Expert</option>
                                    </select>
                                    <div class="error" id="error_description_issued_by_customer"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Quality Time<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="quality_time" class="service_time timepicker" readonly>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Lead level</label>
                                </div>
                                <div class="span7">
                                    <select name="lead_level" id="lead_level" class="span12 chosen-select nostyle">
                                        <option value="1">Starter</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Expert</option>
                                    </select>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Lead Time<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="lead_time" class="service_time timepicker1 bootstrap-timepicker">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Offloading<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <select name="Offloading" id="Offloading" class="span12 chosen-select nostyle">
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    <div class="error" id=""></div>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Offloading Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="offloading_cost" class="offloading_cost">
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Components<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input type="text" name="components" class="components">
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Components Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="components_cost span12 text" type="text" name="components_cost" id="components_cost" value="<?php echo set_value('components_cost') ?>">
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Remarks<em>*</em></label>
                                </div>
                                <div class="span7">
                                     <textarea  required="" type="text" name="remarks" id="remarks"class="span12 unique"><?php echo set_value('remarks') ?></textarea>
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Approximate Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="approximate_cost span12 text" type="text" name="approximate_cost" id="approximate_cost" value="<?php echo set_value('approximate_cost') ?>">
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row row-fluid m-b-10">
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Original Reference<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input required=""  class="original_ref span12 text" type="text" name="original_ref" id="original_ref" value="<?php echo set_value('original_ref') ?>">
                                    <div class="error" id=""></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="span5">
                                    <label for="age" class="form-label">Original Cost<em>*</em></label>
                                </div>
                                <div class="span7">
                                    <input autocomplete="off" required="" oninput="this.value=this.value.replace(/[^0-9]/,'')" class="original_cost span12 text" type="text" name="original_cost" id="original_cost" value="<?php echo set_value('original_cost') ?>">
                                    <div class="error" id="error_total_price_with_tax"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button class="btn  btn-info"> Add</button>

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
function validation()
{
    status = check_enq_no();
    // alert(!status);return false;
    if(status == 0)
    {
        return false;
    }
}
// $('.timepicker').timepicker({
//         minuteStep: 1,
//         showSeconds: true,
//         showMeridian: false
// }).next().on(ace.click_event, function(){
// $(this).prev().focus();
// });
$(function(){
     $('.timepicker1').timepicker({
        // minuteStep: 1,
        template: 'dropdown',
        // // appendWidgetTo: 'body',
        // showSeconds: true,
        showMeridian: false,
        // defaultTime: false
    });
});
</script>

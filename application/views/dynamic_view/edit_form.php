
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css')?>">

<script src="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js')?>"></script>
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
         font-size: .9em;

    }
    .SumoSelect > .CaptionCont > label > i {
        background: url(<?=base_url('assets/plugins/chosen/chosen-sprite.png')?>) no-repeat 13px 2px;
        display: block;
        width: 100%;
        height: 100%;
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
    .bootstrap-tagsinput
    {
        width: 95%;
    }
    .text-center
    {
        text-align: center;
    }
    .pl-0 {
     padding-left: 0px !important; 
    }
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<script type="text/javascript">
    var module_url = '<?=$module_url?>';
</script>
<?php 
$module = uri_segment(1);
$text_centre = "";
if(isset($is_modal_view) && $is_modal_view)
{
    $text_centre = "text-center";
}
?>
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <!-- do not load for modal -->
            <?php if(!isset($is_modal_view) && !$is_modal_view):?>
            <div class="title">
                <h4><span><?php echo $module_title ?></span> </h4>
            </div>
            <?php endif;?>
            <!-- do not load for modal -->
            <div class="content">
            
                <?php if(!empty($error_msg)) { ?>
                    <div class="alert alert-danger">
                        <button class="close" data-dismiss="alert"></button>
                        <span id="danger_msg"><?php echo $error_msg; ?></span>
                    </div>
                <?php } ?>
                <?php echo get_flashdata();?>
            
                <form action="<?php echo isset($action_url)&&!empty($action_url)?$action_url:current_url() ?>" method="post" accept-charset="utf-8" class="form-horizontal" id="support_form" enctype="multipart/form-data">

                <?php 
                if(isset($form_data) && !empty($form_data) && count($form_data)>0){
                    foreach($form_data as $block_key=>$frm_data){?>
                    <div class="portlet-body" style="padding: 5px;">
                        <!-- do not load for modal -->
                        <?php if(!isset($is_modal_view) && !$is_modal_view):?>
                        <div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><!--<?=isset($frm_data->block) && strtolower($frm_data->block)=='default'?$form_title:ucwords(strtolower($frm_data->block)) ?>-->Master</h3>
                            </div>
                        </div>
                        <?php endif;?>
                        <!-- do not load for modal -->
                        <?php 
                        if(isset($frm_data->elements) && !empty($frm_data->elements) && count($frm_data->elements)>0){
                            $iterat_arr = $frm_data->elements;
                            $i=1;$k=0;
                            
                            foreach($frm_data->elements as $key=>$cols){
                                $elemnt     = (array) $iterat_arr[$k];
                                $data_input = $elemnt['data-input'];
                                if($key%2==0)
                                {?>
                                <div class="form-row row-fluid m-b-10" id="<?=$i?>">
                                <?php } ?>
                                            
                                    <?php if($iterat_arr[$k]->type == 'input'){ ?>

                                        <div class="span6 field-block" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label" ><?php echo $iterat_arr[$k]->label; ?><em><?= $iterat_arr[$k]->required == 'true'?'*':'' ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <?php 
                                                $class_name_dynamic = '';
                                                $class_name_dynamic_unq = '';
                                                
                                                if(isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'){
                                                    $class_name_dynamic = 'required';
                                                }
                                                if(isset($iterat_arr[$k]->unique) && $iterat_arr[$k]->unique == 'true'){
                                                    $class_name_dynamic_unq='unique';
                                                }

                                                if($data_input=='textarea')
                                                {?>

                                                    <textarea <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" rows="<?php echo $iterat_arr[$k]->rows ?>" class="span12 <?=$class_name_dynamic_unq;?>"><?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?></textarea>
                                                <?php } elseif($data_input=='texteditor')
                                                {?>
                                                    <textarea <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" rows="<?php echo $iterat_arr[$k]->rows ?>" class="ckeditor- span12 <?=$class_name_dynamic_unq;?>">
                                                        <?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>
                                                    </textarea>
                                                <?php } elseif($data_input=='number'){ ?>
                                                    <input type="text" oninput="this.value=this.value.replace(/[^0-9.]/,'')" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>" class="span12 <?=$class_name_dynamic_unq;?> " <?=$class_name_dynamic;?> >
                                                <?php }  elseif($iterat_arr[$k]->name=='enquiry_tag'){ ?>
                                                    <input type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>" data-role="tagsinput" class="span12 <?=$class_name_dynamic_unq;?> " <?=$class_name_dynamic;?> >
                                                <?php } else{ ?>
                                                    <input <?=isset($iterat_arr[$k]->is_readonly) && $iterat_arr[$k]->is_readonly == '1'?'readonly':''?> <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>" class="span12 <?=$class_name_dynamic_unq;?>" <?=$class_name_dynamic;?> >
                                                <?php } ?>
                                                <div class="error" id="error_<?php echo $iterat_arr[$k]->name ?>"><?php echo form_error('field_<?php echo $iterat_arr[$k]->name ?>label');?></div>
                                            </div>
                                        </div>

                                    <?php } else if($iterat_arr[$k]->type == 'password'){ ?>
                                        <div class="span6 field-block" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php echo $iterat_arr[$k]->label ?></label>
                                            </div>
                                            
                                            <div class="span7">
                                                <?php
                                                $class_name_dynamic='';
                                                $class_name_dynamic_unq='';
                                                if(isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'){
                                                    $class_name_dynamic='required';
                                                }
                                                if(isset($iterat_arr[$k]->unique) && $iterat_arr[$k]->unique == 'true'){
                                                    $class_name_dynamic_unq='unique';
                                                }?>
                                                <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> type="password" name="<?php echo $iterat_arr[$k]->name ?>" id="field_label" value="" class="span12 <?=$class_name_dynamic_unq;?> " <?=$class_name_dynamic;?> >
                                              
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                    <?php } else if($data_input == 'file'){ ?>
                                        <?php //pr($data_list[$iterat_arr[$k]->name]); ?>
                                        <div class="span6 field-block" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                <span style="font-size: .8em;color: red"><?= isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)?' Allowed Only ['.implode(", ", $iterat_arr[$k]->allowed_extensions).']':'' ?></span>
                                            </div>
                                            <div class="span7">
                                                <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                                    <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> onchange="validate__<?php echo $cols->name ?>(this)" type="file" name="<?php echo $cols->name ?>" id="field_label" value="<?=$data_list[$iterat_arr[$k]->name]; ?>" class="span12" >
                                                <?php }else{ ?>
                                                    <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> type="file" name="<?php echo $cols->name ?>" id="field_label" value="<?=$data_list[$iterat_arr[$k]->name]; ?>" class="span12" >
                                                <?php } ?>
                                                <div class="error" id="error_<?php echo $cols->name ?>"><?php echo form_error('field_label');?></div>
                                            </div>
                                            <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                            <script type="text/javascript">
                                                function validate__<?php echo $cols->name ?>(obj)
                                                {
                                                    var allowedExtensions = <?=json_encode($iterat_arr[$k]->allowed_extensions)?>;
                                                    // alert(typeof(allowedExtensions))
                                                    var file      = $(obj).val();
                                                    var extension   = file.split('.').pop().toUpperCase();
                                                    if (allowedExtensions.indexOf(extension) === -1) 
                                                    {
                                                        $(obj).val('');
                                                        $("#error_<?php echo $cols->name ?>").text('Invalid file extension.');
                                                    }
                                                    else
                                                    {
                                                        $("#error_<?php echo $cols->name ?>").text('');
                                                    }
                                                }
                                            </script>
                                        <?php } ?>
                                        </div>

                                    <?php }  else if($data_input == 'multiplefile'){ ?>

                                        <div class="span6 field-block" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em>
                                                    <span style="color: green;font-weight: bold" title="Multiple File Allowed">M*</span>
                                                    <span style="font-size: .8em;color: red"><?= isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)?' Allowed Only ['.implode(", ", $iterat_arr[$k]->allowed_extensions).']':'' ?></span>
                                                </label>
                                            </div>

                                            <div class="span7">
                                                <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                                    <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> onchange="validate__<?php echo $cols->name ?>(this)" multiple="" type="file" name="<?php echo $cols->name ?>[]" id="field_label" value="" class="span12" >
                                                <?php }else{ ?>
                                                    <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> multiple="" type="file" name="<?php echo $cols->name ?>[]" id="field_label" value="" class="span12" >
                                                <?php } ?>
                                                <div class="error" id="error_<?php echo $cols->name ?>"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                        <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                            <script type="text/javascript">
                                                function validate__<?php echo $cols->name ?>(obj)
                                                {
                                                    var allowedExtensions = <?=json_encode($iterat_arr[$k]->allowed_extensions)?>;
                                                    var th  =   $("input[name='<?php echo $cols->name ?>[]']");
                                                    // console.log(th);
                                                    var status = 0;
                                                    for (var i = 0; i < th[0].files.length; ++i)
                                                    {
                                                        var file       = th[0].files[i].name;
                                                        var extension   = file.split('.').pop().toUpperCase();
                                                        if (allowedExtensions.indexOf(extension) === -1) 
                                                        {
                                                            status++;
                                                        }
                                                    }
                                                    if(status>0)
                                                    {
                                                        $(obj).val('');
                                                        $("#error_<?php echo $cols->name ?>").text('Some selected file is not allowed');
                                                    }
                                                    else
                                                    {
                                                        $("#error_<?php echo $cols->name ?>").text('');
                                                    }
                                                }
                                            </script>
                                        <?php } ?>

                                    <?php } else if($iterat_arr[$k]->type == 'label'){
                                        $option = $iterat_arr[$k]->list; ?>
                                        <div class="span6 field-block" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                                            
                                            <div class="span7">
                                                <?php 
                                                foreach ($option as $option_key => $option_value) {?>
                                                <div class="checker">
                                                    <span class="checked">
                                                        <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> type="<?php echo $option_value->type ?>" id="radio5" name="<?=$option_value->name?>" value="<?=$option_value->value?>" style="opacity: 0;">
                                                    </span>
                                                </div><?=$option_value->label?>

                                                <?php }?>
                                            </div>
                                        </div>
                                    <?php } else if($iterat_arr[$k]->type == 'combo'){
                                        $option = json_decode($cols->connector)->options; ?>

                                        <div class="span6 field-block" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" class="nostyle chosen-select1">
                                                    <option value="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                    <?php foreach($option as $opt){ ?>
                                                    <option value="<?php echo $opt->value; ?>" ><?php echo $opt->text; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                    <?php } else if($iterat_arr[$k]->type == 'select'){

                                        if(isset($iterat_arr[$k]->option_type) && $iterat_arr[$k]->option_type=='table')
                                        {
                                            $table_name = $iterat_arr[$k]->options->table_name;
                                            $label_name = $iterat_arr[$k]->options->label_name;
                                            $value_name = $iterat_arr[$k]->options->value_name;
                                            $options    = isset($iterat_arr[$k]->options->data)?$iterat_arr[$k]->options->data:'';
                                            // pr($data_list[$cols->name]);
                                            // pr($option);die;?>
                                            <div class="span6 field-block">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" class="span12 nostyle chosen-select multiselect1_no <?php echo $iterat_arr[$k]->name ?>">
                                                        <option value="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php
                                                        if(isset($options) && !empty($options)){
                                                            foreach($options as $option){ 
                                                            $option_arr = (array) $option;?>
                                                            <option <?=isset($data_list[$cols->name]) && $data_list[$cols->name]==$option_arr[$value_name]?'selected':''?> value="<?php echo $option_arr[$value_name]; ?>" ><?php echo $option_arr[$label_name]; ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>

                                        <?php } elseif(isset($iterat_arr[$k]->option_type) && $iterat_arr[$k]->option_type=='dependent')
                                        { 
                                            $label_title    = $iterat_arr[$k]->label;
                                            $table_name     = $iterat_arr[$k]->options->table_name;
                                            $label_name     = $iterat_arr[$k]->options->label_name;
                                            $value_name     = $iterat_arr[$k]->options->value_name;
                                            $event_field    = $iterat_arr[$k]->options->event_field;
                                            // if($event_field=='department')
                                            // {
                                            //     $event_field = $event_field.'[]';
                                            // }
                                            $condition_column   = $iterat_arr[$k]->options->condition_column;
                                            $dpen_ids           = $data_list[$event_field];
                                            $dpnd_data          = $iterat_arr[$k]->options->dpnd_data;
                                            // pr($data_list[$event_field]);die;
                                            $all_ids = [];
                                            if(isset($data_list[$cols->name]) && !empty($data_list[$cols->name]))
                                            {
                                                $all_ids =  explode(",", $data_list[$cols->name]);
                                            }?>
                                            <div class="span6 field-block">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" class="span12 nostyle chosen-select1">
                                                        <option value="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php
                                                        if(isset($dpnd_data) && !empty($dpnd_data)){
                                                            foreach($dpnd_data as $option_arr){ ?>
                                                            <option <?=in_array($option_arr[$value_name], $all_ids)?'selected':''?> value="<?php echo $option_arr[$value_name]; ?>" ><?php echo $option_arr[$label_name]; ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>
                                           
                                            <script type="text/javascript">
                                                
                                                $(".<?=$event_field?>").change(function()
                                                {
                                                    var all_values = [];
                                                    $("select[name='<?=$event_field?>'] option:selected").each(function(){
                                                        if($(this).val()!='' && $(this).val()!=undefined && $(this).val()!=null && $(this).val()!=0)
                                                        {
                                                            all_values.push($(this).val());
                                                        }
                                                    });
                                                    // alert();
                                                    // console.log(all_values);
                                                    /*console.log(all_values);
                                                    return false;*/
                                                    if(all_values.length > 0)
                                                    {
                                                        $.ajax({
                                                            url:module_url+'/get_dependent_data',
                                                            dataType:'json',
                                                            method:'POST',
                                                            data:{tblname:"<?=$table_name?>",label_title:"<?=$label_title?>",label_name:"<?=$label_name?>",value_name:"<?=$value_name?>",condition_column:"<?=$condition_column?>",condition_values:all_values},
                                                            beforeSend:function(){
                                                                //
                                                            },
                                                            success:function(res){
                                                                if(res.status==1)
                                                                {
                                                                   $("select[name='<?=$iterat_arr[$k]->name?>']").html(res.data);
                                                                }
                                                                else
                                                                {
                                                                    $("select[name='<?=$iterat_arr[$k]->name?>']").html(res.data);
                                                                }
                                                            },
                                                            error:function(){
                                                                alert("Network Error");
                                                            },
                                                        })
                                                    }
                                                    else
                                                    {
                                                        $("select[name='<?=$iterat_arr[$k]->name?>']").html('');
                                                    }
                                                });
                                            </script>

                                        <?php }else{
                                            $option = isset($iterat_arr[$k]->options)?$iterat_arr[$k]->options:'';?>
                                            <div class="span6 field-block" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" class="span12 nostyle chosen-select1">
                                                        <option value="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php foreach($option as $opt){ 
                                                         ?>
                                                            <option <?=isset($data_list[$cols->name]) && $data_list[$cols->name]==$opt->value?'selected':''?> value="<?php echo $opt->value; ?>" ><?php echo $opt->text; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    <?php }  else if($iterat_arr[$k]->type == 'multiselect'){
                                        if(isset($iterat_arr[$k]->option_type) && $iterat_arr[$k]->option_type=='table')
                                        {
                                            // pr($iterat_arr[$k]);

                                            $table_name = $iterat_arr[$k]->options->table_name;
                                            $label_name = $iterat_arr[$k]->options->label_name;
                                            $value_name = $iterat_arr[$k]->options->value_name;
                                            $options    = isset($iterat_arr[$k]->options->data)?$iterat_arr[$k]->options->data:'';
                                            $all_ids = [];
                                            if(isset($data_list[$cols->name]) && !empty($data_list[$cols->name]))
                                            {
                                                $all_ids =  explode(",", $data_list[$cols->name]);
                                            }
                                            // pr($option);die;?>

                                            <div class="span6 field-block" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> multiple="" name="<?php echo $iterat_arr[$k]->name ?>[]" class="span12 nostyle chosen-select multiselect1_no <?php echo $iterat_arr[$k]->name ?>">
                                                        <option value="" disabled="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php
                                                        if(isset($options) && !empty($options)){
                                                            foreach($options as $option){ 
                                                            $option_arr = (array) $option;?>
                                                            <option <?=in_array($option_arr[$value_name], $all_ids)?'selected':''?> value="<?php echo $option_arr[$value_name]; ?>" ><?php echo $option_arr[$label_name]; ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>

                                        <?php } else if(isset($iterat_arr[$k]->option_type) && $iterat_arr[$k]->option_type=='dependent')
                                        { 

                                            $label_title        = $iterat_arr[$k]->label;
                                            $table_name         = $iterat_arr[$k]->options->table_name;
                                            $label_name         = $iterat_arr[$k]->options->label_name;
                                            $value_name         = $iterat_arr[$k]->options->value_name;
                                            $event_field        = $iterat_arr[$k]->options->event_field;
                                            
                                            $condition_column   = $iterat_arr[$k]->options->condition_column;
                                            $dpen_ids           = $data_list[$event_field];
                                            $dpnd_data          = $iterat_arr[$k]->options->dpnd_data;
                                            // pr($data_list[$event_field]);die;
                                            $all_ids = [];
                                            if(isset($data_list[$cols->name]) && !empty($data_list[$cols->name]))
                                            {
                                                $all_ids =  explode(",", $data_list[$cols->name]);
                                            }
                                            ?>
                                            <div class="span6 field-block" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php echo $iterat_arr[$k]->label;?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> multiple="" name="<?php echo $iterat_arr[$k]->name ?>[]" class="span12 nostyle chosen-select_no multiselect1 <?php echo $iterat_arr[$k]->name ?>">
                                                        <option value="" disabled="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php
                                                        if(isset($dpnd_data) && !empty($dpnd_data)){
                                                            foreach($dpnd_data as $option_arr){ ?>
                                                            <option <?=in_array($option_arr[$value_name], $all_ids)?'selected':''?> value="<?php echo $option_arr[$value_name]; ?>" ><?php echo $option_arr[$label_name]; ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                
                                                $(".<?=$event_field?>").change(function()
                                                {
                                                    var all_values = [];
                                                    $(".<?=$event_field?> option:selected").each(function(){
                                                        all_values.push($(this).val());
                                                    });
                                                    /*console.log(all_values);
                                                    return false;*/
                                                    if(all_values.length>0)
                                                    {
                                                        $.ajax({
                                                            url:module_url+'/get_dependent_data',
                                                            dataType:'json',
                                                            method:'POST',
                                                            data:{tblname:"<?=$table_name?>",label_title:"<?=$label_title?>",label_name:"<?=$label_name?>",value_name:"<?=$value_name?>",condition_column:"<?=$condition_column?>",condition_values:all_values},
                                                            beforeSend:function(){
                                                                //
                                                            },
                                                            success:function(res){
                                                                if(res.status==1)
                                                                {
                                                                    $(".<?=$iterat_arr[$k]->name?>").html(res.data);
                                                                    $(".<?=$iterat_arr[$k]->name?>")[0].sumo.reload();

                                                                }
                                                                else
                                                                {
                                                                    $(".<?=$iterat_arr[$k]->name?>").html(res.data);
                                                                    $(".<?=$iterat_arr[$k]->name?>")[0].sumo.reload();
                                                                }
                                                            },
                                                            error:function(){
                                                                alert("Network Error");
                                                            },
                                                        })
                                                    }
                                                    else
                                                    {
                                                        $(".<?=$iterat_arr[$k]->name?>").html('');
                                                        $(".<?=$iterat_arr[$k]->name?>")[0].sumo.reload();
                                                    }
                                                });
                                            </script>

                                        <?php }else{
                                            $option = isset($iterat_arr[$k]->options)?$iterat_arr[$k]->options:'';?>
                                            <div class="span6 field-block" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" class="span12 nostyle">
                                                        <option value="">Select <?php echo ucwords($iterat_arr[$k]->label) ?></option>
                                                        <?php foreach($option as $opt){ ?>
                                                        <option value="<?php echo $opt->value; ?>" ><?php echo $opt->text; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    <?php } else if($iterat_arr[$k]->type == 'calendar'){ ?>

                                        <div class="span6 field-block" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> readonly="" class="<?php echo $iterat_arr[$k]->name ?> span12" type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo isset($data_list[$cols->name]) && strtotime($data_list[$cols->name])?date('Y-m-d',strtotime($data_list[$cols->name])):'' ?>">
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                var name = "<?php echo $iterat_arr[$k]->name ?>";
                                                if(name=='from_client' || name=='from_cfit' || name=='to_client' || name=='to_cfit')
                                                {
                                                    $("input[name='"+name+"']").datepicker({
                                                        dateFormat:'yy-mm-dd',
                                                        changeMonth: true,
                                                        changeYear: true,
                                                        maxDate: 0
                                                    });
                                                }
                                                else
                                                {
                                                    $("input[name='"+name+"']").datepicker({
                                                        dateFormat:'yy-mm-dd',
                                                        changeMonth: true,
                                                        changeYear: true
                                                    });
                                                }
                                            });
                                        </script>
                                        <?php } else if($iterat_arr[$k]->type == 'timepicker'){ ?>

                                        <div class="span6 field-block" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> readonly="" class="<?php echo $iterat_arr[$k]->name ?> span12" type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="">
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">

                                            $(document).ready(function(){
                                                var name = "<?php echo $iterat_arr[$k]->name ?>";
                                                
                                                $("#"+name).datetimepicker({
                                                    format: "hh:ii",
                                                    showMeridian: false,
                                                    autoclose: true
                                                });
                                            });
                                        </script>
                                    <?php }else if($iterat_arr[$k]->type == 'checkbox'){
                                        $list = isset($iterat_arr[$k]->list['0'])?$iterat_arr[$k]->list['0']:'';?>

                                        <div class="span6 field-block" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7" style="color: #333">
                                                <input <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> class="span12 pull-right" type="checkbox" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo $list->value; ?>"><span style="color: #333"><?php echo $list->label ?></span>
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            <?php 
                            if($key%2!=0)
                            {?>
                                </div>
                            <?php } elseif(count($frm_data->elements)==$key+1){
                                echo "</div>";
                            } ?>
                        <?php $i++; $k++;
                            }
                        }?>
                    </div>
                    <?php }
                }?>
                    
                    <div class="row-fluid" style="margin-bottom:10px;">
                        <div class="span12">
                            <div class="form-actions <?=$text_centre?> pl-0">
                                <input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <button type="submit" class="btn btn-info submit_btn">
                                    Update
                                </button>
                                <?php if($module != 'enquiry'):?>
                                    <button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
                                <?php endif;?>
                                <!-- do not load for modal -->
                                <?php if(!isset($is_modal_view) && !$is_modal_view):?>
                                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
                                <?php else:?>
                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-goback" >Close</a>
                                <?php endif;?>
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
    var i = $("select[name='applicable']").val();
    if(i==2){
        $("#company").parents(".field-block:first").hide();
        $("select[name='insurance_done']").parents(".field-block:first").hide();
        $("#policy_no").parents(".field-block:first").hide();
        $("#insurance_dated").parents(".field-block:first").hide();
        $("#usd_amount").parents(".field-block:first").hide();
        $("#insurance_amount").parents(".field-block:first").hide();
        $("#company").removeAttr("required");
        $("select[name='insurance_done']").removeAttr("required");
        $("#policy_no").removeAttr("required");
        $("#insurance_dated").removeAttr("required");
        $("#usd_amount").removeAttr("required");
        $("#insurance_amount").removeAttr("required");
    }else{
        $("#company").parents(".field-block:first").show();
        $("select[name='insurance_done']").parents(".field-block:first").show();
        $("#policy_no").parents(".field-block:first").show();
        $("#insurance_dated").parents(".field-block:first").show();
        $("#usd_amount").parents(".field-block:first").show();
        $("#insurance_amount").parents(".field-block:first").show();
        $("#company").attr("required","required");
        $("select[name='insurance_done']").attr("required","required");
        $("#policy_no").attr("required","required");
        $("#insurance_dated").attr("required","required");
        $("#usd_amount").attr("required","required");
        $("#insurance_amount").attr("required","required");
    }
});

$("select[name='applicable']").change(function(){
    if($(this).val()==2)
    {   
        $("#company").parents(".field-block:first").hide();
        $("select[name='insurance_done']").parents(".field-block:first").hide();
        $("#policy_no").parents(".field-block:first").hide();
        $("#insurance_dated").parents(".field-block:first").hide();
        $("#usd_amount").parents(".field-block:first").hide();
        $("#insurance_amount").parents(".field-block:first").hide();
        $("#company").removeAttr("required");
        $("select[name='insurance_done']").removeAttr("required");
        $("#policy_no").removeAttr("required");
        $("#insurance_dated").removeAttr("required");
        $("#usd_amount").removeAttr("required");
        $("#insurance_amount").removeAttr("required");
    }
    else
    {
        $("#company").parents(".field-block:first").show();
        $("select[name='insurance_done']").parents(".field-block:first").show();
        $("#policy_no").parents(".field-block:first").show();
        $("#insurance_dated").parents(".field-block:first").show();
        $("#usd_amount").parents(".field-block:first").show();
        $("#insurance_amount").parents(".field-block:first").show();
        $("#company").attr("required","required");
        $("select[name='insurance_done']").attr("required","required");
        $("#policy_no").attr("required","required");
        $("#insurance_dated").attr("required","required");
        $("#usd_amount").attr("required","required");
        $("#insurance_amount").attr("required","required");
    }
});


var base_url = '<?=$base_url?>';
var check_enquiry_no = '<?=isset($check_enquiry_no) && !empty($check_enquiry_no)?$check_enquiry_no:0?>';
$(document).ready(function(){
    jq(".multiselect1").SumoSelect();
    $('.datepicker').datepicker();
    // $( "#datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
// do not load for modal 
<?php if(!isset($is_modal_view) && !$is_modal_view):?>
    // check unique value or not 
    error = true;
    $("form").submit(function() { 
        if(check_enquiry_no>0)
        {
            var st = check_enq_no();
            if(st==0)
            {
                return false;
            }
        }
        var form = this;
        var count_data = $("input.unique");
        var array_input_name =[];
        var array_input_type =[];
        var array_input_value =[];
        var action  = "<?=$action;?>";
        var column_id = "<?=$data_list['form_id'];?>";
        var module_id = "<?=$table_id;?>";
        $($("input.unique")).each(function(index,value){
            var input_name = count_data[index].name;
            var input_type = count_data[index].type;
            var input_val = count_data[index].value;

            array_input_name.push(input_name);
            array_input_type.push(input_type);
            array_input_value.push(input_val);
        });
          form.submit();
        // $.ajax({
        //     url:base_url+'/check_all_fields_unq',
        //     type:"POST",
        //     dataType:'json',
        //     data: token_name+"="+token_hash+"&array_input_name="+array_input_name+"&array_input_type="+array_input_type+"&array_input_value="+array_input_value+"&action="+action+"&column_id="+column_id+"&module_id="+module_id,
        //     success:function(res)
        //     {
        //         if(res.validation==1){
        //             error =true;
        //             var not_unique = res.data;
        //             for(var i=0;i<not_unique.length;i++){
        //                 // console.log(not_unique[i].id);
        //                 // console.log(not_unique[i].error);
        //                 field_unq = not_unique[i].id;
        //                 field_unq_error = not_unique[i].error;
                        
        //                 $($("input.unique")).each(function(index,value){
        //                     //alert(index); 
        //                     // Using $() to re-wrap the element.
        //                     //$(testimonials[i]).text('a');
        //                     var field_name = count_data[index].name;
        //                     if(field_name ==field_unq){
                                
        //                         $("input[name=" + field_name + "]").next().html( field_unq_error );
        //                     } 
        //                 });
        //             }
        //         }else{
        //             error=false;
        //             $("div.error").html('');
        //             //alert(error);
        //             form.submit();
        //         }
        //         //return true;
        //     }
        // });
        // always return false
        //alert(error);
        if(error == true){
            return false;
        }
    });
<?php endif;?>
});  

function check_enq_no()
{
    var enq_no = $("#enq_no").val();
    var status = 0;
    if(enq_no!='' && enq_no!=undefined && enq_no!=null)
    {
        $.ajax({
            url:base_url+'/check_enquiry_no/',
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
                    $("#enq_no").focus();

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
// $('#support_form').submit(function(){
// $('.submit_btn').prop('disabled', true);
// })
</script>

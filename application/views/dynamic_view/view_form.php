<link rel="stylesheet" type="text/css" href="<?=base_url('bucket/assets/plugins/sumoselect/sumoselect.min.css')?>">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url('bucket/assets/plugins/sumoselect/jquery.sumoselect.min.js')?>"></script>

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

<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            
            <!--<div class="portlet-title">
                <div class="caption"><?=($module_title);?></div>
            </div>-->
            <div class="content">
            
                <?php if(!empty($error_msg)) { ?>
                    <div class="alert alert-danger">
                        <button class="close" data-dismiss="alert"></button>
                        <span id="danger_msg"><?php echo $error_msg; ?></span>
                    </div>
                <?php } ?>
                <?php echo get_flashdata();?>
            
                <form action="#" method="post" accept-charset="utf-8" class="form-horizontal" id="support_form" enctype="multipart/form-data">

                <?php 
                if(isset($form_data) && !empty($form_data) && count($form_data)>0){
                    foreach($form_data as $block_key=>$frm_data){?>
                    <div class="portlet-body" style="padding: 5px;">
                        <!--<div class="form-row row-fluid">
                            <div class="block-title">
                                <h3><?=isset($frm_data->block) && strtolower($frm_data->block)=='default'?$form_title:ucwords(strtolower($frm_data->block)) ?>Master</h3>
                            </div>
                        </div>-->
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

                                        <div class="span6" id="<?=$key?>">
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
                                                { ?>

                                                    <textarea <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" rows="<?php echo $iterat_arr[$k]->rows ?>" class="span12 <?=$class_name_dynamic_unq;?>">
                                                        <?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>
                                                    </textarea>
                                                <?php } elseif($data_input=='texteditor')
                                                { ?>
                                                    <textarea <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" rows="<?php echo $iterat_arr[$k]->rows ?>" class="ckeditor- span12 <?=$class_name_dynamic_unq;?>">
                                                        <?php echo isset($data_list[$cols->name])?$data_list[$cols->name]:'' ?>
                                                    </textarea>
                                                <?php } elseif($data_input=='number'){ ?>
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                <?php } else{ ?>
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                <?php } ?>
                                                <div class="error" id="error_<?php echo $iterat_arr[$k]->name ?>"><?php echo form_error('field_<?php echo $iterat_arr[$k]->name ?>label');?></div>
                                            </div>
                                        </div>

                                    <?php } else if($iterat_arr[$k]->type == 'password'){ ?>
                                        <div class="span6" id ="<?=$key?>">
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
                                        <?php //pr($iterat_arr[$k]); ?>
                                        <div class="span6" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                <span style="font-size: .8em;color: red"><?= isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)?' Allowed Only ['.implode(", ", $iterat_arr[$k]->allowed_extensions).']':'' ?></span>
                                            </div>
                                            <div class="span7">
                                                <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                <?php }else{ ?>
                                                    <a href="<?=base_url('manage_lot/custom_cfit_doc_download/'.$data_list['form_id'])?>" ><?php echo $data_list[$iterat_arr[$k]->name]; ?></a>
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

                                        <div class="span6" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em>
                                                    <span style="color: green;font-weight: bold" title="Multiple File Allowed">M*</span>
                                                    <span style="font-size: .8em;color: red"><?= isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)?' Allowed Only ['.implode(", ", $iterat_arr[$k]->allowed_extensions).']':'' ?></span>
                                                </label>
                                            </div>

                                            <div class="span7">
                                                <?php if(isset($iterat_arr[$k]->allowed_extensions) && is_array($iterat_arr[$k]->allowed_extensions) && count($iterat_arr[$k]->allowed_extensions)>0){ ?>
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                <?php }else{ ?>
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
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
                                        <div class="span6" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                                            
                                            <div class="span7">
                                                <?php 
                                                foreach ($option as $option_key => $option_value) {?>
                                                <div class="checker">
                                                    <span class="checked">
                                                        <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                    </span>
                                                </div><?=$option_value->label?>

                                                <?php }?>
                                            </div>
                                        </div>
                                    <?php } else if($iterat_arr[$k]->type == 'combo'){
                                        $option = json_decode($cols->connector)->options; ?>

                                        <div class="span6" id ="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <select <?=isset($iterat_arr[$k]->required) && $iterat_arr[$k]->required == 'true'?'required':''?> name="<?php echo $iterat_arr[$k]->name ?>" class="">
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
                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>

                                        <?php } elseif(isset($iterat_arr[$k]->option_type) && $iterat_arr[$k]->option_type=='dependent')
                                        {?>
                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>
                                            <?php 
                                                $label_title    = $iterat_arr[$k]->label;
                                                $table_name     = $iterat_arr[$k]->options->table_name;
                                                $label_name     = $iterat_arr[$k]->options->label_name;
                                                $value_name     = $iterat_arr[$k]->options->value_name;
                                                $event_field    = $iterat_arr[$k]->options->event_field;
                                                $condition_column = $iterat_arr[$k]->options->condition_column;
                                             ?>
                                            <script type="text/javascript">
                                                
                                                $("select[name='<?=$event_field?>']").change(function()
                                                {
                                                    var all_values = [];
                                                    $("select[name='<?=$event_field?>'] option:selected").each(function(){
                                                        if($(this).val()!='' && $(this).val()!=undefined && $(this).val()!=null && $(this).val()!=0)
                                                        {
                                                            all_values.push($(this).val());
                                                        }
                                                    });
                                                    // console.log(all_values);
                                                    /*console.log(all_values);
                                                    return false;*/
                                                    if(all_values.length > 0)
                                                    {
                                                        $.ajax({
                                                            url:baseurl+'form_module/get_dependent_data',
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
                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
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

                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
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
                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php echo $iterat_arr[$k]->label;?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
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
                                                            url:baseurl+'form_module/get_dependent_data',
                                                            dataType:'json',
                                                            method:'POST',
                                                            data:{tblname:"<?=$table_name?>",label_title:"<?=$label_title?>",label_name:"<?=$label_name?>",value_name:"<?=$value_name?>",condition_column:"<?=$condition_column?>",condition_values:all_values},
                                                            beforeSend:function(){
                                                                //
                                                            },
                                                            success:function(res){
                                                                if(res.status==1)
                                                                {
                                                                    $("select[name='<?=$iterat_arr[$k]->name?>[]']").html(res.data);
                                                                    $("select[name='<?=$iterat_arr[$k]->name?>[]']")[0].sumo.reload();

                                                                }
                                                                else
                                                                {
                                                                    $("select[name='<?=$iterat_arr[$k]->name?>[]']").html(res.data);
                                                                    $("select[name='<?=$iterat_arr[$k]->name?>[]']")[0].sumo.reload();
                                                                }
                                                            },
                                                            error:function(){
                                                                alert("Network Error");
                                                            },
                                                        })
                                                    }
                                                    else
                                                    {
                                                        $("select[name='<?=$iterat_arr[$k]->name?>[]']").html('');
                                                        $("select[name='<?=$iterat_arr[$k]->name?>[]']")[0].sumo.reload();
                                                    }
                                                });
                                            </script>

                                        <?php }else{
                                            $option = isset($iterat_arr[$k]->options)?$iterat_arr[$k]->options:'';?>
                                            <div class="span6" id ="<?=$key?>">
                                                <div class="span5">
                                                    <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                                </div>
                                                <div class="span7">
                                                    <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                    <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                                </div>
                                            </div>
                                        <?php }?>
                                    <?php } else if($iterat_arr[$k]->type == 'calendar'){ ?>

                                        <div class="span6" id="<?=$key?>">
                                            <div class="span5">
                                                <label for="age" class="form-label"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
                                            </div>
                                            <div class="span7">
                                                <?php echo $data_list[$iterat_arr[$k]->name]; ?>
                                                <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                var name = "<?php echo $iterat_arr[$k]->name ?>";
                                                $("input[name='"+name+"']").datepicker({
                                                    changeMonth: true,
                                                    changeYear: true
                                                });
                                            });
                                        </script>

                                    <?php }else if($iterat_arr[$k]->type == 'checkbox'){
                                        $list = isset($iterat_arr[$k]->list['0'])?$iterat_arr[$k]->list['0']:'';?>

                                        <div class="span6" id ="<?=$key?>">
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
                            <div class="form-actions">
                                
                                <a style="margin-left: 183px;" href="javascript: history.go(0)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
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
    $('.datepicker').datepicker();
    // $( "#datepicker" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });

    // check unique value or not 
    error = true;
    $("form").submit(function() { 
        var form = this;
        var count_data = $("input.unique");
        var array_input_name =[];
        var array_input_type =[];
        var array_input_value =[];
        var action  = "<?=$action;?>";
        var column_id = "<?=$table_id;?>";
        var module_id = "<?=$table_id;?>";
        $($("input.unique")).each(function(index,value){
            var input_name = count_data[index].name;
            var input_type = count_data[index].type;
            var input_val = count_data[index].value;

            array_input_name.push(input_name);
            array_input_type.push(input_type);
            array_input_value.push(input_val);
        });
         
        $.ajax({
            url:baseurl+'form_module/check_all_fields_unq',
            type:"POST",
            dataType:'json',
            data: token_name+"="+token_hash+"&array_input_name="+array_input_name+"&array_input_type="+array_input_type+"&array_input_value="+array_input_value+"&action="+action+"&column_id="+column_id+"&module_id="+module_id,
            success:function(res)
            {
                if(res.validation==1){
                    error =true;
                    var not_unique = res.data;
                    for(var i=0;i<not_unique.length;i++){
                        // console.log(not_unique[i].id);
                        // console.log(not_unique[i].error);
                        field_unq = not_unique[i].id;
                        field_unq_error = not_unique[i].error;
                        
                        $($("input.unique")).each(function(index,value){
                            //alert(index); 
                            // Using $() to re-wrap the element.
                            //$(testimonials[i]).text('a');
                            var field_name = count_data[index].name;
                            if(field_name ==field_unq){
                                
                                $("input[name=" + field_name + "]").next().html( field_unq_error );
                            } 
                        });
                    }
                }else{
                    error=false;
                    $("div.error").html('');
                    //alert(error);
                    form.submit();
                }
                //return true;
            }
        });
        // always return false
        //alert(error);
        if(error == true){
            return false;
        }
    });
});  
</script>

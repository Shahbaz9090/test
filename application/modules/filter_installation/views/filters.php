<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/sumoselect/sumoselect.css" rel="stylesheet" />
<style>
    .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid blue;
  width: 5px;
  height: 5px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin: 0 auto;
  display:none;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
select[multiple], select[size] {
    height: 100%;

}
.margin-top-10{
margin-top:10px;
}
.show_filter{
display:none;
}
.error_form,.error{
color:#f50707;
}
.SumoSelect {
    width: 100%;
}
.SumoSelect .CaptionCont.SelectBox.search {
    width: 96%;
    line-height: initial;
    float: left;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #353535;
    font-style: normal;
    cursor: pointer;
    }
   .SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {
    box-shadow: 0 0 2px #c8cbce;
    border-color: #e4e6e8;
}
.SumoSelect > .CaptionCont {
    position: relative;
    border: 1px solid #e8e3e3;
    min-height: 14px;
    background-color: #fff;
    border-radius: 8px;
    margin: 0;
}
.SumoSelect.open .search-txt {
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    margin: 0;
    padding: 14px 7px;
}
.SumoSelect > .CaptionCont > label > i {
    background: url("<?=base_url()?>/assets/plugins/chosen/chosen-sprite.png") no-repeat 13px 2px;
    display: block;
    width: 100%;
    height: 100%;
}   
#Mytable{
    max-height: 500px;
    overflow-y: scroll;
    display: block;
}
#myModal12{
    width: 47%;
}
</style>
<div class="row-fluid">
    <div class="span12">
     <?php echo get_flashdata();?>
       <div class="box">
        <div class="row-fluid" id="setting" style="display: none;">
            <div class="title" >
                <h4>
                    <span class="icon16 brocco-icon-grid"></span> <span>Filter Settings</span>
                </h4>

            </div>
    
         <div class="content" style="margin-bottom: 13px;color: #999;min-height:90px;" >
            
        <div class="row-fluid">
            <div class="span12" >
            <select name="module_filters" id="module_filters">
                    <option value=''>Select Module For Filter</option>
                    <option value='sales_spares'>Sales Spares</option>
                    <option value='sales_governing'>Sales Governing</option>
                    <option value='sales_pcb'>Sales PCB/Fanuc</option>
                    <option value='client_list'>Client List</option>
                    
                </select>
        </div>
        </div>
    <div class="show_filter">
        <div class="margin-top-10"></div>
        
          <div class="row-fluid">
            <div class="span3 ">
                <select name="country_filter_selct[]" onchange="get_all_data_from_country(this);get_filter_data_by_zero();" class="filter_multiselect_country nostyle" id="country_filter_selct" multiple>
                   
                   
                    <?php if(!empty($country)){
                            foreach($country as $val_country_filter){
                        ?>
                        <option value="<?=$val_country_filter->id?>"><?=ucwords($val_country_filter->country_name);?></option>
                    <?php } }?>
                </select>
            </div>
            <div class="span3 ">
                <select name="state_filter_selct[]" onchange="get_all_data_from_state(this);get_filter_data_by_zero();" class="filter_multiselect nostyle" id="state_filter_selct" multiple>
                   
                   
                    <?php if(!empty($state_filter)){
                            foreach($state_filter as $val_state_filter){
                        ?>
                        <option value="<?=$val_state_filter->id?>"><?=ucwords($val_state_filter->state_name);?></option>
                    <?php } }?>
                </select>
            </div>
            <div class="span3 ">
                 <select name="city_filter_selct[]" id="city_filter_selct" onchange="get_filter_data_by_zero()" class="filter_multiselect_city nostyle" multiple>
                    
                    <?php if(!empty($city_filter)){
                            foreach($city_filter as $val_city_filter){
                        ?>
                        <option value="<?=$val_city_filter->id?>"><?=ucwords($val_city_filter->city_name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_city').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select City'});
                   jq('.filter_multiselect_country').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Country'});
                </script>

            </div>

            
            
           
             
            <div class="span3 ">
                 <select name="type_of_establishment_filter_selct[]" id="type_of_establishment_filter_selct" class="filter_multiselect_type_of_establishment nostyle" multiple onchange="get_filter_data_by_zero()">
                    
                   
                    <?php if(!empty($type_of_establishment_filter)){
                            foreach($type_of_establishment_filter as $val_type_of_establishment_filter){
                        ?>
                        <option value="<?=$val_type_of_establishment_filter->form_id?>"><?=ucwords($val_type_of_establishment_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_type_of_establishment').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Type of Establishment'});
                </script>


                 


            </div>
         
        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
                 <select name="type_of_client_filter_selct[]" id="type_of_client_filter_selct" class="filter_multiselect_type_of_client nostyle" multiple onchange="get_filter_data_by_zero()">
                    
                     <?php if(!empty($type_of_client_filter)){
                            foreach($type_of_client_filter as $val_type_of_client_filter){
                        ?>
                        <option value="<?=$val_type_of_client_filter->form_id?>"><?=ucwords($val_type_of_client_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_type_of_client').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Type of Client'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="plant_established_year_filter[]" id="plant_established_year_filter" class="filter_multiselect_plant_established_year nostyle" multiple onchange="get_filter_data_by_zero()">
                    
                    <?php 
                        $static_year =1950;
                        $current_year = date("Y");
                        for($static_year;$static_year<=$current_year;$static_year++){?>
                            <option value="<?=$static_year?>"><?=$static_year;?></option>
                        
                    <?php } ?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_plant_established_year').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Plant Established Year'});
                </script>
            </div>
            <div class="span3 ">
                <select name="department_filter[]" id="department_filter" class="filter_multiselect_department nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($department_filter)){
                            foreach($department_filter as $val_department_filter){
                        ?>
                        <option value="<?=$val_department_filter->id?>"><?=ucwords($val_department_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_department').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Department'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="designation_filter[]" id="designation_filter" class="filter_multiselect_designation nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($designation_filter)){
                            foreach($designation_filter as $val_designation_filter){
                        ?>
                        <option value="<?=$val_designation_filter->id?>"><?=ucwords($val_designation_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_designation').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Designation'});
                </script>
            </div>
        </div>
        <!-- CLIENT LIST -->
    <div class="client_d">
        <div class="margin-top-10"></div>
        <div class="row-fluid">
             <div class="span3 ">
                 <select name="industry_type_filter_selct[]" id="industry_type_filter_selct" class="filter_multiselect_industry_type nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($industry_type_filter)){
                            foreach($industry_type_filter as $val_industry_type_filter){
                        ?>
                        <option value="<?=$val_industry_type_filter->id?>"><?=ucwords($val_industry_type_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_industry_type').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Industry Type'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="plc_dcs_make_filter[]" id="plc_dcs_make_filter" class="filter_multiselect_plc_dcs_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($plc_dcs_make_filter)){
                            foreach($plc_dcs_make_filter as $val_plc_dcs_make_filter){
                        ?>
                        <option value="<?=$val_plc_dcs_make_filter->form_id?>"><?=ucwords($val_plc_dcs_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_plc_dcs_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PLC/DCS Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="actuator_make_filter[]" id="actuator_make_filter" class="filter_multiselect_actuator_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($actuator_make_filter)){
                            foreach($actuator_make_filter as $val_actuator_make_filter){
                        ?>
                        <option value="<?=$val_actuator_make_filter->form_id?>"><?=ucwords($val_actuator_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_actuator_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Actuator Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="vfd_make_filter[]" id="vfd_make_filter" class="filter_multiselect_vfd_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($vfd_make_filter)){
                            foreach($vfd_make_filter as $val_vfd_make_filter){
                        ?>
                        <option value="<?=$val_vfd_make_filter->form_id?>"><?=ucwords($val_vfd_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_vfd_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select VFD Make/Model'});
                </script>
            </div>
        </div>
    </div>
        <!-- CLIENT LIST -->
        <div class="margin-top-10"></div>
        <div class="spares_d">
        <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
                 <select name="plc_dcs_make_filter[]" id="plc_dcs_make_filter" class="filter_multiselect_plc_dcs_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($plc_dcs_make_filter)){
                            foreach($plc_dcs_make_filter as $val_plc_dcs_make_filter){
                        ?>
                        <option value="<?=$val_plc_dcs_make_filter->form_id?>"><?=ucwords($val_plc_dcs_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_plc_dcs_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PLC/DCS Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="actuator_make_filter[]" id="actuator_make_filter" class="filter_multiselect_actuator_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($actuator_make_filter)){
                            foreach($actuator_make_filter as $val_actuator_make_filter){
                        ?>
                        <option value="<?=$val_actuator_make_filter->form_id?>"><?=ucwords($val_actuator_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_actuator_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Actuator Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="vfd_make_filter[]" id="vfd_make_filter" class="filter_multiselect_vfd_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($vfd_make_filter)){
                            foreach($vfd_make_filter as $val_vfd_make_filter){
                        ?>
                        <option value="<?=$val_vfd_make_filter->form_id?>"><?=ucwords($val_vfd_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_vfd_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select VFD Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="capacity_of_unit_filter[]" id="capacity_of_unit_filter" class="filter_multiselect_capacity_of_unit nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php 
                        $min =100;
                        $max = 1000;
                        for($min;$min<=$max;$min++){?>
                            <option value="<?=$min?>"><?=$min;?></option>
                        
                    <?php } ?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_capacity_of_unit').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Capacity of Unit'});
                </script>
            </div>
        </div>


            <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
                <select name="epc_company_filter[]" id="epc_company_filter" class="filter_multiselect_epc_company nostyle" multiple onchange="get_filter_data_by_zero()"> 
                    <?php if(!empty($epc_company_filter)){
                            foreach($epc_company_filter as $val_epc_company_filter){
                        ?>
                        <option value="<?=$val_epc_company_filter->form_id?>"><?=ucwords($val_epc_company_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_epc_company').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select EPC Company'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="cod_month_year_filter[]" id="cod_month_year_filter" class="filter_multiselect_cod_month_year nostyle" multiple onchange="get_filter_data_by_zero()">
                    
                    <option value='1'>COD Month/Year</option>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_cod_month_year').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select COD Month/Year'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="boiler_make_filter[]" id="boiler_make_filter" class="filter_multiselect_boiler_make nostyle" multiple onchange="get_filter_data_by_zero()">
                     <?php if(!empty($boiler_make_filter)){
                            foreach($boiler_make_filter as $val_boiler_make_filter){
                        ?>
                        <option value="<?=$val_boiler_make_filter->form_id?>"><?=ucwords($val_boiler_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_boiler_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Boiler Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="spares_turbine_make_filter[]" id="spares_turbine_make_filter" class="filter_multiselect_spares_turbine_make nostyle" multiple onchange="get_filter_data_by_zero()">
                   <?php if(!empty($spares_turbine_make_filter)){
                            foreach($spares_turbine_make_filter as $val_spares_turbine_make_filter){
                        ?>
                        <option value="<?=$val_spares_turbine_make_filter->form_id?>"><?=ucwords($val_spares_turbine_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_spares_turbine_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Turbine Make'});
                </script>

                
            </div>

           

        </div>

            <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
                <select name="spares_generator_make_filter[]" id="spares_generator_make_filter" class="filter_multiselect_spares_generator_make nostyle" multiple onchange="get_filter_data_by_zero()">
                   <?php if(!empty($spares_generator_make_filter)){
                            foreach($spares_generator_make_filter as $val_spares_generator_make_filter){
                        ?>
                        <option value="<?=$val_spares_generator_make_filter->form_id?>"><?=ucwords($val_spares_generator_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_spares_generator_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Generator Make'});
                </script>

               
            </div>

           
            <div class="span3 ">
                 <select name="bfpt_make_filter[]" id="bfpt_make_filter" class="filter_multiselect_bfpt_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($bfpt_make_filter)){
                            foreach($bfpt_make_filter as $val_bfpt_make_filter){
                        ?>
                        <option value="<?=$val_bfpt_make_filter->form_id?>"><?=ucwords($val_bfpt_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_bfpt_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select BFPT Make'});
                </script>
            </div>
            <div class="span3 ">
                <select name="bfpm_make_filter[]" id="bfpm_make_filter" class="filter_multiselect_bfpm_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($bfpm_make_filter)){
                            foreach($bfpm_make_filter as $val_bfpm_make_filter){
                        ?>
                        <option value="<?=$val_bfpm_make_filter->form_id?>"><?=ucwords($val_bfpm_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_bfpm_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select BFPM Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="bfp_make_filter[]" id="bfp_make_filter" class="filter_multiselect_bfp_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($bfp_make_filter)){
                            foreach($bfp_make_filter as $val_bfp_make_filter){
                        ?>
                        <option value="<?=$val_bfp_make_filter->form_id?>"><?=ucwords($val_bfp_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_bfp_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select BFP Make'});
                </script>
            </div>
        </div>


            <div class="margin-top-10"></div>
        <div class="row-fluid">

            <div class="span3 ">
                 <select name="bfbp_make_filter[]" id="bfbp_make_filter" class="filter_multiselect_bfbp_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($bfbp_make_filter)){
                            foreach($bfbp_make_filter as $val_bfbp_make_filter){
                        ?>
                        <option value="<?=$val_bfbp_make_filter->form_id?>"><?=ucwords($val_bfbp_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_bfbp_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select BFBP Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="cep_make_filter[]" id="cep_make_filter" class="filter_multiselect_cep_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($cep_make_filter)){
                            foreach($cep_make_filter as $val_cep_make_filter){
                        ?>
                        <option value="<?=$val_cep_make_filter->form_id?>"><?=ucwords($val_cep_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_cep_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select CEP Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="cep_motor_make_filter[]" id="cep_motor_make_filter" class="filter_multiselect_cep_motor_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($cep_motor_make_filter)){
                            foreach($cep_motor_make_filter as $val_cep_motor_make_filter){
                        ?>
                        <option value="<?=$val_cep_motor_make_filter->form_id?>"><?=ucwords($val_cep_motor_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_cep_motor_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select CEP Motor Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="coal_mill_make_filter[]" id="coal_mill_make_filter" class="filter_multiselect_coal_mill_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($coal_mill_make_filter)){
                            foreach($coal_mill_make_filter as $val_coal_mill_make_filter){
                        ?>
                        <option value="<?=$val_coal_mill_make_filter->form_id?>"><?=ucwords($val_coal_mill_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_coal_mill_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Coal Mill Make'});
                </script>
            </div>
        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">

            <div class="span3 ">
                 <select name="inch_id_fan_filter[]" id="inch_id_fan_filter" class="filter_multiselect_inch_id_fan nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_id_fan_filter)){
                            foreach($inch_id_fan_filter as $val_inch_id_fan_filter){
                        ?>
                        <option value="<?=$val_inch_id_fan_filter->form_id?>"><?=ucwords($val_inch_id_fan_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_id_fan').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select ID Fan Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="inch_id_fan_motor_make_filter[]" id="inch_id_fan_motor_make_filter" class="filter_multiselect_inch_id_fan_motor_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_id_fan_motor_make_filter)){
                            foreach($inch_id_fan_motor_make_filter as $val_inch_id_fan_motor_make_filter){
                        ?>
                        <option value="<?=$val_inch_id_fan_motor_make_filter->form_id?>"><?=ucwords($val_inch_id_fan_motor_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_id_fan_motor_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select ID Fan Motor make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="inch_fd_fan_filter[]" id="inch_fd_fan_filter" class="filter_multiselect_inch_fd_fan nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_fd_fan_filter)){
                            foreach($inch_fd_fan_filter as $val_inch_fd_fan_filter){
                        ?>
                        <option value="<?=$val_inch_fd_fan_filter->form_id?>"><?=ucwords($val_inch_fd_fan_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_fd_fan').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select FD Fan Make'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="inch_fd_fan_motor_make_filter[]" id="inch_fd_fan_motor_make_filter" class="filter_multiselect_inch_fd_fan_motor_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_fd_fan_motor_make_filter)){
                            foreach($inch_fd_fan_motor_make_filter as $val_inch_fd_fan_motor_make_filter){
                        ?>
                        <option value="<?=$val_inch_fd_fan_motor_make_filter->form_id?>"><?=ucwords($val_inch_fd_fan_motor_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_fd_fan_motor_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select FD Fan Motor Make'});
                </script>
            </div>
        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">

            <div class="span3 ">
                <select name="inch_pa_fan_filter[]" id="inch_pa_fan_filter" class="filter_multiselect_inch_pa_fan nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_pa_fan_filter)){
                            foreach($inch_pa_fan_filter as $val_inch_pa_fan_filter){
                        ?>
                        <option value="<?=$val_inch_pa_fan_filter->form_id?>"><?=ucwords($val_inch_pa_fan_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_pa_fan').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PA Fan Make'});
                </script>
            </div>
            <div class="span3 ">
                <select name="inch_pa_fan_motor_make_filter[]" id="inch_pa_fan_motor_make_filter" class="filter_multiselect_inch_pa_fan_motor_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_pa_fan_motor_make_filter)){
                            foreach($inch_pa_fan_motor_make_filter as $val_inch_pa_fan_motor_make_filter){
                        ?>
                        <option value="<?=$val_inch_pa_fan_motor_make_filter->form_id?>"><?=ucwords($val_inch_pa_fan_motor_make_filter->name);?></option>
                    <?php } }?>
                </select>
                 <script type="text/javascript">
                   jq('.filter_multiselect_inch_pa_fan_motor_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PA Fan Motor Make'});
                </script>
            </div>
            <div class="span3 ">
            <select name="inch_esp_make_filter[]" id="inch_esp_make_filter"  class="filter_multiselect_inch_esp_make nostyle" multiple onchange="get_filter_data_by_zero()">
                     <?php if(!empty($inch_esp_make_filter)){
                            foreach($inch_esp_make_filter as $val_inch_esp_make_filter){
                        ?>
                        <option value="<?=$val_inch_esp_make_filter->form_id?>"><?=ucwords($val_inch_esp_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_esp_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select ESP Make'});
                </script>
            </div>
            <div class="span3 ">
                <select name="inch_aph_make_filter[]" id="inch_aph_make_filter" class="filter_multiselect_inch_aph_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_aph_make_filter)){
                            foreach($inch_aph_make_filter as $val_inch_aph_make_filter){
                        ?>
                        <option value="<?=$val_inch_aph_make_filter->form_id?>"><?=ucwords($val_inch_aph_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_aph_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select APH Make'});
                </script>
            </div>
        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">

            <div class="span3 ">
                <select name="inch_vibration_system_filter[]" id="inch_vibration_system_filter" class="filter_multiselect_inch_vibration_system nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_vibration_system_filter)){
                            foreach($inch_vibration_system_filter as $val_inch_vibration_system_filter){
                        ?>
                        <option value="<?=$val_inch_vibration_system_filter->form_id?>"><?=ucwords($val_inch_vibration_system_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_vibration_system').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Vibration System'});
                </script>
            </div>
            <div class="span3 ">
                <select name="inch_btld_make_filter[]" id="inch_btld_make_filter" class="filter_multiselect_inch_btld_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_btld_make_filter)){
                            foreach($inch_btld_make_filter as $val_inch_btld_make_filter){
                        ?>
                        <option value="<?=$val_inch_btld_make_filter->form_id?>"><?=ucwords($val_inch_btld_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_btld_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select BTLD Make'});
                </script>
            </div>
            <div class="span3 ">
                <select name="inch_coal_feeder_make_filter[]" id="inch_coal_feeder_make_filter" class="filter_multiselect_inch_coal_feeder_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_coal_feeder_make_filter)){
                            foreach($inch_coal_feeder_make_filter as $val_inch_coal_feeder_make_filter){
                        ?>
                        <option value="<?=$val_inch_coal_feeder_make_filter->form_id?>"><?=ucwords($val_inch_coal_feeder_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_coal_feeder_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Coal Feeder Make'});
                </script>
            </div>
            <div class="span3 ">
                <select name="inch_flame_scanner_make_filter[]" id="inch_flame_scanner_make_filter" class="filter_multiselect_inch_flame_scanner_make nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_flame_scanner_make_filter)){
                            foreach($inch_flame_scanner_make_filter as $val_inch_flame_scanner_make_filter){
                        ?>
                        <option value="<?=$val_inch_flame_scanner_make_filter->form_id?>"><?=ucwords($val_inch_flame_scanner_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_flame_scanner_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Flame Scanner Make'});
                </script>
            </div>
        </div>

       

    </div>

    <div class="governing_d">
          <div class="row-fluid">
            <div class="span3 ">
                     <select name="inch_vib_system_make_model_filter[]" id="inch_vib_system_make_model_filter" class="filter_multiselect_inch_vib_system_make_model nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_vib_system_make_model_filter)){
                            foreach($inch_vib_system_make_model_filter as $val_inch_vib_system_make_model_filter){
                        ?>
                        <option value="<?=$val_inch_vib_system_make_model_filter->form_id?>"><?=ucwords($val_inch_vib_system_make_model_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_vib_system_make_model').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Vib. System Make/Model'});
                </script>
            </div>

            <div class="span3">
                  <select name="inch_ext_system_make_model_filter[]" id="inch_ext_system_make_model_filter" class="filter_multiselect_inch_ext_system_make_model nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_ext_system_make_model_filter)){
                            foreach($inch_ext_system_make_model_filter as $val_inch_ext_system_make_model_filter){
                        ?>
                        <option value="<?=$val_inch_ext_system_make_model_filter->form_id?>"><?=ucwords($val_inch_ext_system_make_model_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_ext_system_make_model').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Ext. System Make/Model'});
                </script>
            </div>


            <div class="span3">
                <select name="inch_elec_governor_make_model_filter[]" id="inch_elec_governor_make_model_filter" class="filter_multiselect_inch_elec_governor_make_model nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_elec_governor_make_model_filter)){
                            foreach($inch_elec_governor_make_model_filter as $val_inch_elec_governor_make_model_filter){
                        ?>
                        <option value="<?=$val_inch_elec_governor_make_model_filter->form_id?>"><?=ucwords($val_inch_elec_governor_make_model_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_elec_governor_make_model').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Elec Governor Make/Model'});
                </script>
             </div>

                <div class="span3">
                <select name="inch_i_h_actuator_make_model_filter[]" id="inch_i_h_actuator_make_model_filter" class="filter_multiselect_inch_i_h_actuator_make_model nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_i_h_actuator_make_model_filter)){
                            foreach($inch_i_h_actuator_make_model_filter as $val_inch_i_h_actuator_make_model_filter){
                        ?>
                        <option value="<?=$val_inch_i_h_actuator_make_model_filter->form_id?>"><?=ucwords($val_inch_i_h_actuator_make_model_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_i_h_actuator_make_model').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select I-H/Actuator Make/ Model'});
                </script>
            </div>

        </div>

         <div class="margin-top-10"></div>
        <div class="row-fluid">

                 <div class="span3">
                <select name="governing_turbine_make_filter[]" id="governing_turbine_make_filter" class="filter_multiselect_governing_turbine_make nostyle" multiple onchange="get_filter_data_by_zero()">
                   <?php if(!empty($governing_turbine_make_filter)){
                            foreach($governing_turbine_make_filter as $val_governing_turbine_make_filter){
                        ?>
                        <option value="<?=$val_governing_turbine_make_filter->form_id?>"><?=ucwords($val_governing_turbine_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_governing_turbine_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Turbine Make'});
                </script>
            </div>

                  <div class="span3">
                 <select name="governing_generator_make_filter[]" id="governing_generator_make_filter" class="filter_multiselect_governing_generator_make_filter nostyle" multiple onchange="get_filter_data_by_zero()">
                   <?php if(!empty($governing_turbine_make_filter)){
                            foreach($governing_turbine_make_filter as $val_governing_turbine_make_filter){
                        ?>
                        <option value="<?=$val_governing_turbine_make_filter->form_id?>"><?=ucwords($val_governing_turbine_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_governing_generator_make_filter').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Generator Make'});
                </script>
             </div>




              <div class="span3 ">
                 <select name="plc_dcs_make_filter_sales_governing[]" id="plc_dcs_make_filter_sales_governing" class="filter_multiselect_plc_dcs_make_sales_governing nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($plc_dcs_make_filter)){
                            foreach($plc_dcs_make_filter as $val_plc_dcs_make_filter){
                        ?>
                        <option value="<?=$val_plc_dcs_make_filter->form_id?>"><?=ucwords($val_plc_dcs_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_plc_dcs_make_sales_governing').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PLC/DCS Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="actuator_make_filter_sales_governing[]" id="actuator_make_filter_sales_governing" class="filter_multiselect_actuator_make_sales_governing nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($actuator_make_filter)){
                            foreach($actuator_make_filter as $val_actuator_make_filter){
                        ?>
                        <option value="<?=$val_actuator_make_filter->form_id?>"><?=ucwords($val_actuator_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_actuator_make_sales_governing').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Actuator Make/Model'});
                </script>
            </div>
            



        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
                 <select name="vfd_make_filter_sales_governing[]" id="vfd_make_filter_sales_governing" class="filter_multiselect_vfd_make_sales_governing nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($vfd_make_filter)){
                            foreach($vfd_make_filter as $val_vfd_make_filter){
                        ?>
                        <option value="<?=$val_vfd_make_filter->form_id?>"><?=ucwords($val_vfd_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_vfd_make_sales_governing').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select VFD Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                <select name="capacity_of_unit_filter_sales_governing[]" id="capacity_of_unit_filter_sales_governing" class="filter_multiselect_capacity_of_unit_sales_governing nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php 
                        $min =100;
                        $max = 1000;
                        for($min;$min<=$max;$min++){?>
                            <option value="<?=$min?>"><?=$min;?></option>
                        
                    <?php } ?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_capacity_of_unit_sales_governing').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Capacity of Unit'});
                </script>
            </div>
        </div>




    </div>

    <div class="spares_pcb_d">
          <div class="row-fluid">
            <div class="span3 ">
                   <select name="inch_type_make_machine_filter[]" id="inch_type_make_machine_filter" class="filter_multiselect_inch_type_make_machine nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_type_make_machine_filter)){
                            foreach($inch_type_make_machine_filter as $val_inch_type_make_machine_filter){
                        ?>
                        <option value="<?=$val_inch_type_make_machine_filter->form_id?>"><?=ucwords($val_inch_type_make_machine_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_type_make_machine').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Type/Make of Machine'});
                </script>
            </div>

             <div class="span3">
                  <select name="inch_make_model_controller_filter[]" id="inch_make_model_controller_filter" class="filter_multiselect_inch_make_model_controller nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($inch_type_make_machine_filter)){
                            foreach($inch_type_make_machine_filter as $val_inch_type_make_machine_filter){
                        ?>
                        <option value="<?=$val_inch_type_make_machine_filter->form_id?>"><?=ucwords($val_inch_type_make_machine_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_inch_make_model_controller').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Make/Model of controller'});
                </script>
             </div>

             <div class="span3 ">
                 <select name="plc_dcs_make_filter_sales_pcb[]" id="plc_dcs_make_filter_sales_pcb" class="filter_multiselect_plc_dcs_make_sales_pcb nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($plc_dcs_make_filter)){
                            foreach($plc_dcs_make_filter as $val_plc_dcs_make_filter){
                        ?>
                        <option value="<?=$val_plc_dcs_make_filter->form_id?>"><?=ucwords($val_plc_dcs_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_plc_dcs_make_sales_pcb').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select PLC/DCS Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                 <select name="actuator_make_filter_sales_pcb[]" id="actuator_make_filter_sales_pcb" class="filter_multiselect_actuator_make_sales_pcb nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($actuator_make_filter)){
                            foreach($actuator_make_filter as $val_actuator_make_filter){
                        ?>
                        <option value="<?=$val_actuator_make_filter->form_id?>"><?=ucwords($val_actuator_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_actuator_make_sales_pcb').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Actuator Make/Model'});
                </script>
            </div>





        </div>

        <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span3 ">
            <select name="vfd_make_filter_sales_pcb[]" id="vfd_make_filter_sales_pcb" class="filter_multiselect_vfd_make_sales_pcb nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php if(!empty($vfd_make_filter)){
                            foreach($vfd_make_filter as $val_vfd_make_filter){
                        ?>
                        <option value="<?=$val_vfd_make_filter->form_id?>"><?=ucwords($val_vfd_make_filter->name);?></option>
                    <?php } }?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_vfd_make_sales_pcb').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select VFD Make/Model'});
                </script>
            </div>
            <div class="span3 ">
                <select name="capacity_of_unit_filter_sales_pcb[]" id="capacity_of_unit_filter_sales_pcb" class="filter_multiselect_capacity_of_unit_sales_pcb nostyle" multiple onchange="get_filter_data_by_zero()">
                    <?php 
                        $min =100;
                        $max = 1000;
                        for($min;$min<=$max;$min++){?>
                            <option value="<?=$min?>"><?=$min;?></option>
                        
                    <?php } ?>
                </select>
                <script type="text/javascript">
                   jq('.filter_multiselect_capacity_of_unit_sales_pcb').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Capacity of Unit'});
                </script>
            </div>
        </div>



    </div>



        
        <div class="margin-top-10"></div>
        <div class="row-fluid">
            <div class="span12" style="text-align:center; ">
            <!-- <button type="button" class="btn btn-primary" id="get_filter" value="submit">Submit</button> -->
            <button type="submit" class="btn btn-primary" id="refresh_data_filter"value="filter">Refresh</button>
        </div>
        </div>
    </div>
           
            
        </div>
        </div>
            <div class="title">
                <h4>
                    
                    <span id="list_by">Filter Data</span>
                    
                    <div class="btn-group right " data-toggle="buttons-radio" style="padding-right:75px;top:-5px;">
                        
                        <button type="button" class="btn btn-goback" id="send" value="1" >Send Email</button>
                        <button class="btn btn-goback" id="sms" value="2">Send SMS</button>
                        <button class="btn btn-goback" id="sms" onclick="performAction('export');" value="3">Export</button>
                        
                        
                    </div>

                </h4>
                <a href="#" class="minimize">Minimize</a>
            </div>    
            <div class="content noPad" >
            <div class="row-fluid" style="padding: 7px 0px 0px 0px;" id="search">
                <div class="span3" style="float: right;">
                    <input type="text" placeholder="search" id="search_keyword" />
                </div>
            </div>
            <div class="ajax_div">
                <span id="ajax_replace">
                <table class="responsive table table-bordered" id="Mytable">
                    <thead>
                      <tr  id="removeAllssss" style="display:none;">
                        <td colspan="7">
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                <span class="icon16 icomoon-icon-loop white"></span> Remove
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <th  class="ch" width="3%">
                            <input type="checkbox" class="styled" id="allCheckbox"/>
                        </th>
                        <th width="6%">S.N</th>
                        <th width="10%">Company Name</th>
                        <th width="14%">Company Address</th>
                        <th width="10%">State</th>
                        <th width="10%">City</th>
                        <th width="10%">Contact Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="10%">Official Email-ID </th>
                        <th width="10%">Personal Mobile </th>
                        <th width="10%">Personal Email-ID </th>
                        
                      </tr>
                      <tr>
                        <td colspan="10"> 
                         <div class="loader" id="loader"></div>
                        </td>
                      </tr>
                     

                    </thead>
                    <tbody id="data_after_filteration">
                        <tr>
                        </tr>
                    </tbody>

                   
                 </table>
                 <input type="hidden" name="total_result" id="total_result">
                 <input type="hidden" name="page_no" id="page_no" value="0">
                 <div class="span8" style="float:right;margin-top: 8px; margin-right: -23px;" >
                    <ul class="pagination" style="float: right;"><?=$links?></ul>
                 </div>

                </span>
            </div>
                <input type="hidden" name="select_list" id="select_list" value="0">
              </div>
          </div><!-- End .box -->
      </div><!-- End .span12 -->
 </div><!-- End .row-fluid -->


<span id="reload"></span>

<!-- Modal for Multiple Removal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form  id="form-horizontal" method="post" action="<?=SITE_PATH?>user/authorisation/edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="10%">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" >User Authorise Panel Setting</h3>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" id="responseDiv">       
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4 class="black">Login On</h4></label>
                            <select name="login_type" class="span5 nostyle" id="login_type" >
                                <option value=''>Select</option>
                                <option value="1">Network IP Based</option>
                                <option value="2">System IP Based</option>
                                <option value="3">Non IP Based</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid" style="display:none;" id="static_ip_based">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4>Network IP</h4></label>
                            <input type="text" name="static_ip" class="span5" id="static_ip">
                        </div>
                    </div>
                    <div class="row-fluid" style="display:none;" id="ip_based">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4>System IP</h4></label>
                            <input type="text" name="ip" class="span5" id="ip">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: left;">
                   <input type="hidden" name="users_id" id="users_id" value="">
                   <input type="hidden" name="multi_update" id="multi_update" value="1">
                   <button type="button" class="btn btn-primary" id="submit_btn">Submit</button>
                   <span id="ajax_loader"></span>
                   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
                <span id="redirectDiv" style="padding-left:25px;color:green;font-weight:bold;"></span>  
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="myModal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="10%">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Send Mail </h3>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <input type="hidden" id="sender_to" name="to" value="" />
                        <label class="control-label" for="rec_subject"><h4>Subject</h4></label>
                        <input type="text" class="span4" id="subject" name="subject"/>
                        <div class="error subject_error"></div>
                        <label class="control-label" for="message"><h4>Message </h4></label>
                            <select class="select2 nostyle" id="template1">
                                <option value="">Select Template</option>
                                <?php  
                                    foreach($template as $key=>$val){        
                                ?>
                                <option value='<?=$val->id?>'><?=$val->name?></option>
                               
                                <?php
                                    }
                                ?>
                            </select>
                        <span id="message1">
                            <textarea class='span12 ckeditor' rows='15' name="message" id="message"></textarea>
                        </span>
                        <div class="error body_error"></div>
                    </fieldset>
                </div>
                <div class="modal-footer" style="text-align: left;">
                   <button type="submit" class="btn btn-primary"  onclick="sendmail();">Send Mail</button>
                   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal for Single Removal -->

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form  id="form-horizontal-mail" method="post" action="<?=SITE_PATH?>user/authorisation/edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="10%">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">User Authorise Panel</h3>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="span12" id="responseDiv_single">        
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4>Login On</h4></label>
                            <select name="login_type" class="span5 nostyle" id="login_type_single" >
                                <option value=''>Select</option>
                                <option value="1">Network IP Based</option>
                                <option value="2">System IP Based</option>
                                <option value="3">Non IP Based</option>
                          </select>
                        </div>
                    </div>
                    <div class="row-fluid" style="display:none;" id="static_ip_based_single">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4>Network IP</h4></label>
                            <input type="text" name="static_ip" class="span5" id="static_ip_single">
                        </div>
                    </div>
                    <div class="row-fluid" style="display:none;" id="ip_based_single">
                        <div class="span12">
                            <label class="span3" for="rec_subject"><h4>System IP</h4></label>
                            <input type="text" name="ip" class="span5" id="ip_single">
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="text-align: left;">
                   <input type="hidden" name="unique_value" id="unique_value" value="">
                   <button type="button" class="btn btn-primary" id="submit_btn_single">Submit</button>
                   <span id="ajax_loader_single"></span>
                   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
                <span id="redirectDiv_single" style="padding-left:25px;color:green;font-weight:bold;"></span>  
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </form>
</div>
<!--  model for perticuler id to send email-->

<!--Ajax search starts -->
<script>
    $( document ).ready(function() {
  // Handler for .ready() called.
    $("#search_keyword").keyup(function(){
        var keyword = $("#search_keyword").val();
        keyword = keyword.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toLowerCase();
        });
        var list_type=$("#select_list").val();
        $.ajax({                
                data:token_name+"="+token_hash+"&keyword="+keyword+"&login_type="+list_type,
                type:"post",
                url: "<?php echo SITE_PATH;?>user/authorisation/ajax_list_items/",
                beforeSend : function(){                    
                    //beforeAjaxResponse();
                },
                success: function(data){
                $("#ajax_replace").html(data);
                afterAjaxResponse();
                }
        });
    });
    
    });

</script>

<!--Ajax search starts -->

<script>
  $(function(){
    
    $(".erookie-setting").click(function(){
               $("#setting").slideToggle(); 
    }); 

    $("#loader").hide();
  });  
//=========GET MORE ROW ON SCROLL=============//
$('#Mytable').scroll(function(){

    var maxScrollHeight = $('#Mytable tbody').height() + $('#Mytable thead').height();
    var scrollFromTop = Math.ceil($('#Mytable').scrollTop()) + $('#Mytable').height();
    if (scrollFromTop >= (maxScrollHeight - 50))
    {
        var p = parseInt($('#page_no').val());
        var total = $('#total_result').val();
        p = p + 1;
        if(100*p <= total)
        {   
            $('#page_no').val(p);
            get_all_filters_data();
        }
      // alert("you reached the End");
    }
  });
//=========GET MORE ROW ON SCROLL=============//
  $(document).ready(function () {
  $("#module_filters").on('change',function(){
    var filter_val = $(this).val();

    if(filter_val){
        $(".show_filter").css('display','block');
       //Sales Spares
       $('#country_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#country_filter_selct')[0].sumo.unSelectAll();  
            }
        });
       $('#state_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#state_filter_selct')[0].sumo.unSelectAll();  
            }
        });
       $('#city_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#city_filter_selct')[0].sumo.unSelectAll();  
            }
        });
    

        $('#state_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#state_filter_selct')[0].sumo.unSelectAll();  
            }
        
       });
        $('#industry_type_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#industry_type_filter_selct')[0].sumo.unSelectAll();  
            }
        
        });

        $('#type_of_establishment_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#type_of_establishment_filter_selct')[0].sumo.unSelectAll();  
            }
        });

        $('#type_of_client_filter_selct option').each(function() {
            if($(this).is(':selected')){
              $('#type_of_client_filter_selct')[0].sumo.unSelectAll();  
            }
        });

        $('#plant_established_year_filter option').each(function() {
            if($(this).is(':selected')){
              $('#plant_established_year_filter')[0].sumo.unSelectAll();  
            }
        });
        $('#department_filter option').each(function() {
            if($(this).is(':selected')){
              $('#department_filter')[0].sumo.unSelectAll();  
            } 
       });

        $('#designation_filter option').each(function() {
            if($(this).is(':selected')){
              $('#designation_filter')[0].sumo.unSelectAll();  
            }
        });

        $('#plc_dcs_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#plc_dcs_make_filter')[0].sumo.unSelectAll();  
            }
       });

        $('#actuator_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#actuator_make_filter')[0].sumo.unSelectAll();  
            }
       });
       $('#vfd_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#vfd_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#capacity_of_unit_filter option').each(function() {
            if($(this).is(':selected')){
              $('#capacity_of_unit_filter')[0].sumo.unSelectAll();  
            }
        });$('#epc_company_filter option').each(function() {
            if($(this).is(':selected')){
              $('#epc_company_filter')[0].sumo.unSelectAll();  
            }
        });$('#cod_month_year_filter option').each(function() {
            if($(this).is(':selected')){
              $('#cod_month_year_filter')[0].sumo.unSelectAll();  
            }
       });$('#boiler_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#boiler_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#spares_turbine_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#spares_turbine_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#spares_generator_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#spares_generator_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#bfpt_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#bfpt_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#bfpm_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#bfpm_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#bfp_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#bfp_make_filter')[0].sumo.unSelectAll();  
            }
       });
        $('#bfbp_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#bfp_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#cep_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#cep_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#coal_mill_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#coal_mill_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_id_fan_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_id_fan_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_id_fan_motor_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_id_fan_motor_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_fd_fan_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_fd_fan_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_fd_fan_motor_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_fd_fan_motor_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_pa_fan_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_pa_fan_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_pa_fan_motor_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_pa_fan_motor_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_pa_fan_motor_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_pa_fan_motor_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_esp_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_esp_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_aph_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_aph_make_filter')[0].sumo.unSelectAll();  
            }
       });

       $('#inch_vibration_system_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_vibration_system_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_btld_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_btld_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_coal_feeder_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_coal_feeder_make_filter')[0].sumo.unSelectAll();  
            }
       });$('#inch_flame_scanner_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_flame_scanner_make_filter')[0].sumo.unSelectAll();  
            }
       });
       
      
       // sales Governing
       $('#inch_vib_system_make_model_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_vib_system_make_model_filter')[0].sumo.unSelectAll();  
            }
        });
      $('#inch_ext_system_make_model_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_ext_system_make_model_filter')[0].sumo.unSelectAll();  
            }
        });$('#inch_elec_governor_make_model_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_elec_governor_make_model_filter')[0].sumo.unSelectAll();  
            }
        });$('#inch_i_h_actuator_make_model_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_i_h_actuator_make_model_filter')[0].sumo.unSelectAll();  
            }
        });
        $('#governing_turbine_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#governing_turbine_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#governing_generator_make_filter option').each(function() {
            if($(this).is(':selected')){
              $('#governing_generator_make_filter')[0].sumo.unSelectAll();  
            }
        });$('#plc_dcs_make_filter_sales_governing option').each(function() {
            if($(this).is(':selected')){
              $('#plc_dcs_make_filter_sales_governing')[0].sumo.unSelectAll();  
            }
        });
        $('#actuator_make_filter_sales_governing option').each(function() {
            if($(this).is(':selected')){
              $('#actuator_make_filter_sales_governing')[0].sumo.unSelectAll();  
            }
        });$('#vfd_make_filter_sales_governing option').each(function() {
            if($(this).is(':selected')){
              $('#vfd_make_filter_sales_governing')[0].sumo.unSelectAll();  
            }
        });$('#capacity_of_unit_filter_sales_governing option').each(function() {
            if($(this).is(':selected')){
              $('#capacity_of_unit_filter_sales_governing')[0].sumo.unSelectAll();  
            }
        });
      
      

       // Sales PCB

       $('#inch_type_make_machine_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_type_make_machine_filter')[0].sumo.unSelectAll();  
            }
        });$('#inch_make_model_controller_filter option').each(function() {
            if($(this).is(':selected')){
              $('#inch_make_model_controller_filter')[0].sumo.unSelectAll();  
            }
        });$('#plc_dcs_make_filter_sales_pcb option').each(function() {
            if($(this).is(':selected')){
              $('#plc_dcs_make_filter_sales_pcb')[0].sumo.unSelectAll();  
            }
        });$('#actuator_make_filter_sales_pcb option').each(function() {
            if($(this).is(':selected')){
              $('#actuator_make_filter_sales_pcb')[0].sumo.unSelectAll();  
            }
        });$('#vfd_make_filter_sales_pcb option').each(function() {
            if($(this).is(':selected')){
              $('#vfd_make_filter_sales_pcb')[0].sumo.unSelectAll();  
            }
        });
      
      
      
       
      


        if(filter_val=='sales_spares'){
           $(".spares_d").css('display','block');
            $(".governing_d").css('display','none');
            $(".spares_pcb_d").css('display','none');
            
        }else if(filter_val=='sales_governing'){
            $(".governing_d").css('display','block');
            $(".spares_d").css('display','none');
            $(".spares_pcb_d").css('display','none');
        }else if(filter_val=='sales_pcb'){
            $(".spares_pcb_d").css('display','block');
            $(".spares_d").css('display','none');
            $(".governing_d").css('display','none');
        }else if(filter_val=='client_list'){
            $(".client_d").css('display','block');
            $(".spares_pcb_d").css('display','none');
            $(".spares_d").css('display','none');
            $(".governing_d").css('display','none');
        }


    }else{
        $(".show_filter").css('display','none'); 
    }

    //empty data at change of value
    $('#data_after_filteration').html('');

  }); 
});


  // Country filter goes
  function get_all_data_from_country(country){
    var module_id = $("#module_filters option:selected").val();
    // alert(module_id);
     var all_state_ids=[];
      $(country).each(function(i, v){
                if($(this).val()!='')
                {
                    all_state_ids.push($(this).val());
                }
            });
            // get all city according to state given
              if(all_state_ids.length >= 1 ){
                $.ajax({
                url:"<?=base_url('filter_installation/filters/get_all_state_from_country/')?>",
                method:'POST',
                data:{token_name:token_hash,all_state_ids:all_state_ids,module_id:module_id},
                success:function(res){
                    if(res!='')
                    {
                        $('#state_filter_selct').html(res);
                        $('#state_filter_selct')[0].sumo.reload();
                    }
                    else
                    {
                        $('#state_filter_selct').html('');
                    }
                }
            });
        }
        // end here
        // alert();
        // get_all_filters_data();
  }
    // state filter goes
  function get_all_data_from_state(states){
    var module_id = $("#module_filters option:selected").val();
    //alert(module_id);
     var all_state_ids=[];
      $(states).each(function(i, v){
                
                if($(this).val()!='')
                {
                    all_state_ids.push($(this).val());
                }

                    
                    
            });
      // alert(all_state_ids);
            // get all city according to state given
              if(all_state_ids.length >= 1 ){
                $.ajax({
                url:"<?=base_url('filter_installation/filters/get_all_city_from_states/')?>",
                method:'POST',
                data:{token_name:token_hash,all_state_ids:all_state_ids,module_id:module_id},
                success:function(res){
                    if(res!='')
                    {
                        $('#city_filter_selct').html(res);
                        $('#city_filter_selct')[0].sumo.reload();

                    }
                    else
                    {
                        $('#city_filter_selct').html('');
                    }
                }
            });
        }
        // end here
        // get_all_filters_data();
  }
 
function get_all_filters_data(){

    var module_id = $("#module_filters option:selected").val();
        var all_state_ids=[];
        var all_city_ids=[];
        var all_industry_ids=[];
        var all_type_establishment_ids=[];
        var all_type_client_ids=[];
        var all_plant_established_year_ids=[];
        var all_department_ids=[];
        var all_designation_ids=[];
        var all_plc_dcs_make_ids=[];
        var all_actuator_make_ids=[];
        var all_vfd_make_ids=[];
        var all_capacity_of_unit_ids=[];
        var all_capacity_of_unit_filter_sales_pcb_ids=[];
        var all_plc_dcs_make_sales_pcb_ids=[];
        var all_actuator_make_sales_pcb_ids=[];
        var all_vfd_make_sales_pcb_ids=[];
        var all_capacity_of_unit_filter_sales_governing_ids=[];
        var all_plc_dcs_make_sales_governing_ids=[];
        var all_actuator_make_sales_governing_ids=[];
        var all_vfd_make_sales_governing_ids=[];
        var all_epc_company_ids=[];
        var all_cod_month_year_ids=[];
        var all_boiler_make_ids=[];
        var all_spares_turbine_make_ids=[];
        var all_spares_generator_make_ids=[];
        var all_governing_turbine_make_ids=[];
        var all_governing_generator_make_ids=[];
        var all_bfpt_make_ids=[];
        var all_bfpm_make_ids=[];
        var all_bfp_make_ids=[];
        var all_bfbp_make_ids=[];
        var all_cep_make_ids=[];
        var all_cep_motor_make_ids=[];
        var all_coal_mill_make_ids=[];
        var all_id_fan_make_ids=[];
        var all_id_fan_motor_make_ids=[];
        var all_fd_fan_make_ids=[];
        var all_fd_fan_motor_make_ids=[];
        var all_pa_fan_make_ids=[];
        var all_pa_fan_motor_make_ids=[];
        var all_esp_make_ids=[];
        var all_aph_make_ids=[];
        var all_vib_system_ids=[];
        var all_btld_make_ids=[];
        var all_coal_feeder_make_ids=[];
        var all_flame_scaner_make_ids=[];
        var all_vib_system_make_ids=[];
        var all_ext_system_make_ids=[];
        var all_elec_governor_make_ids=[];
        var all_ih_actuator_make_ids=[];
        var all_type_make_machine_ids=[];
        var all_inch_make_model_controller_filter_ids=[];
        var page = $('#page_no').val();
     $("#state_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_state_ids.push($(this).val());
                }

        }
      });
     $("#city_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_city_ids.push($(this).val());
                }

        }
      });

     $("#industry_type_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_industry_ids.push($(this).val());
                }

        }
      });$("#type_of_establishment_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_establishment_ids.push($(this).val());
                }

        }
      });$("#type_of_client_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_client_ids.push($(this).val());
                }

        }
      });$("#plant_established_year_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plant_established_year_ids.push($(this).val());
                }

        }
      });$("#department_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_department_ids.push($(this).val());
                }

        }
      });$("#designation_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_designation_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_ids.push($(this).val());
                }

        }
      });$("#capacity_of_unit_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#capacity_of_unit_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_filter_sales_governing_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_sales_pcb_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_sales_pcb_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_sales_pcb_ids.push($(this).val());
                }

        }
      });/*$("#capacity_of_unit_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_filter_sales_pcb_ids.push($(this).val());
                }

        }
      });*/$("#epc_company_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_epc_company_ids.push($(this).val());
                }

        }
      });$("#cod_month_year_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cod_month_year_ids.push($(this).val());
                }

        }
      });$("#boiler_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_boiler_make_ids.push($(this).val());
                }

        }
      });$("#spares_turbine_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_spares_turbine_make_ids.push($(this).val());
                }

        }
      });$("#spares_generator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_spares_generator_make_ids.push($(this).val());
                }

        }
      });$("#governing_turbine_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_governing_turbine_make_ids.push($(this).val());
                }

        }
      });$("#governing_generator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_governing_generator_make_ids.push($(this).val());
                }

        }
      });$("#bfpt_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfpt_make_ids.push($(this).val());
                }

        }
      });$("#bfpm_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfpm_make_ids.push($(this).val());
                }

        }
      });$("#bfp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfp_make_ids.push($(this).val());
                }

        }
      });$("#bfbp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfbp_make_ids.push($(this).val());
                }

        }
      });$("#cep_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cep_make_ids.push($(this).val());
                }

        }
      });$("#cep_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cep_motor_make_ids.push($(this).val());
                }

        }
      });$("#coal_mill_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_coal_mill_make_ids.push($(this).val());
                }

        }
      });$("#inch_id_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_id_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_id_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_id_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_fd_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_fd_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_fd_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_fd_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_pa_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_pa_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_pa_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_pa_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_esp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_esp_make_ids.push($(this).val());
                }

        }
      });$("#inch_aph_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_aph_make_ids.push($(this).val());
                }

        }
      });$("#inch_vibration_system_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vib_system_ids.push($(this).val());
                }

        }
      });$("#inch_btld_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_btld_make_ids.push($(this).val());
                }

        }
      });$("#inch_coal_feeder_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_coal_feeder_make_ids.push($(this).val());
                }

        }
      });$("#inch_flame_scanner_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_flame_scaner_make_ids.push($(this).val());
                }

        }
      });$("#inch_vib_system_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vib_system_make_ids.push($(this).val());
                }

        }
      });$("#inch_ext_system_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_ext_system_make_ids.push($(this).val());
                }

        }
      });$("#inch_elec_governor_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_elec_governor_make_ids.push($(this).val());
                }

        }
      });$("#inch_i_h_actuator_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_ih_actuator_make_ids.push($(this).val());
                }

        }
      });$("#inch_type_make_machine_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_make_machine_ids.push($(this).val());
                }

        }
      });

      $("#inch_make_model_controller_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_inch_make_model_controller_filter_ids.push($(this).val());
                }

        }
      });

       
     
        
        // $('#data_after_filteration').html('');
        if(all_state_ids.length > 0 || all_city_ids.length > 0 || all_industry_ids.length > 0 || all_type_establishment_ids.length > 0|| all_type_client_ids.length > 0 || all_plant_established_year_ids.length > 0|| all_department_ids.length > 0 || all_designation_ids.length > 0 ||all_plc_dcs_make_ids.length > 0 || all_actuator_make_ids.length > 0 || all_vfd_make_ids.length > 0 || all_capacity_of_unit_ids.length > 0 || all_epc_company_ids.length > 0 ||all_cod_month_year_ids.length > 0 || all_boiler_make_ids.length > 0 || all_spares_turbine_make_ids.length > 0 ||all_spares_generator_make_ids.length > 0 ||all_governing_turbine_make_ids.length > 0 || all_governing_generator_make_ids.length > 0 ||all_bfpt_make_ids.length > 0 || all_bfpm_make_ids.length > 0|| all_bfp_make_ids.length > 0 || all_bfbp_make_ids.length > 0|| all_cep_make_ids.length > 0 || all_cep_motor_make_ids.length > 0 || all_coal_mill_make_ids.length > 0 || all_id_fan_make_ids.length > 0 || all_id_fan_motor_make_ids.length > 0 || all_fd_fan_make_ids.length > 0 ||all_fd_fan_motor_make_ids.length > 0 || all_pa_fan_make_ids.length > 0||all_pa_fan_motor_make_ids.length > 0 ||all_esp_make_ids.length > 0 || all_aph_make_ids.length > 0 || all_vib_system_ids.length > 0 || all_btld_make_ids.length > 0||all_coal_feeder_make_ids.length > 0 || all_flame_scaner_make_ids.length > 0 || all_vib_system_make_ids.length > 0|| all_ext_system_make_ids.length > 0 || all_elec_governor_make_ids.length > 0 ||all_ih_actuator_make_ids.length > 0 || all_type_make_machine_ids.length > 0 ||all_inch_make_model_controller_filter_ids.length > 0 || all_vfd_make_sales_pcb_ids.length > 0 ||all_plc_dcs_make_sales_pcb_ids.length > 0 || all_actuator_make_sales_pcb_ids.length > 0 ||all_capacity_of_unit_filter_sales_governing_ids.length > 0 ||all_vfd_make_sales_governing_ids.length > 0 || all_plc_dcs_make_sales_governing_ids.length > 0 || all_actuator_make_sales_governing_ids.length > 0){
         $.ajax({
                url:"<?=base_url('filter_installation/filters/filters_modules_datas/')?>",
                method:'POST',

                


                data:{token_name:token_hash,all_state_ids:all_state_ids,module_id:module_id,all_city_ids:all_city_ids,all_industry_ids:all_industry_ids,all_type_establishment_ids:all_type_establishment_ids,all_type_client_ids:all_type_client_ids,all_plant_established_year_ids:all_plant_established_year_ids,all_department_ids:all_department_ids,all_designation_ids:all_designation_ids,all_plc_dcs_make_ids:all_plc_dcs_make_ids,all_actuator_make_ids:all_actuator_make_ids,all_vfd_make_ids:all_vfd_make_ids,all_capacity_of_unit_ids:all_capacity_of_unit_ids,all_epc_company_ids:all_epc_company_ids,all_cod_month_year_ids:all_cod_month_year_ids,all_boiler_make_ids:all_boiler_make_ids,all_spares_turbine_make_ids:all_spares_turbine_make_ids,all_spares_generator_make_ids:all_spares_generator_make_ids,all_governing_turbine_make_ids:all_governing_turbine_make_ids,all_governing_generator_make_ids:all_governing_generator_make_ids,all_bfpt_make_ids:all_bfpt_make_ids,all_bfpm_make_ids:all_bfpm_make_ids,all_bfp_make_ids:all_bfp_make_ids,all_bfbp_make_ids:all_bfbp_make_ids,all_cep_make_ids:all_cep_make_ids,all_cep_motor_make_ids:all_cep_motor_make_ids,all_coal_mill_make_ids:all_coal_mill_make_ids,all_id_fan_make_ids:all_id_fan_make_ids,all_id_fan_motor_make_ids:all_id_fan_motor_make_ids,all_fd_fan_make_ids:all_fd_fan_make_ids,all_fd_fan_motor_make_ids:all_fd_fan_motor_make_ids,all_pa_fan_make_ids:all_pa_fan_make_ids,all_pa_fan_motor_make_ids:all_pa_fan_motor_make_ids,all_esp_make_ids:all_esp_make_ids,all_aph_make_ids:all_aph_make_ids,all_vib_system_ids:all_vib_system_ids,all_btld_make_ids:all_btld_make_ids,all_coal_feeder_make_ids:all_coal_feeder_make_ids,all_flame_scaner_make_ids:all_flame_scaner_make_ids,all_vib_system_make_ids:all_vib_system_make_ids,all_ext_system_make_ids:all_ext_system_make_ids,all_elec_governor_make_ids:all_elec_governor_make_ids,all_ih_actuator_make_ids:all_ih_actuator_make_ids,all_type_make_machine_ids:all_type_make_machine_ids,all_inch_make_model_controller_filter_ids:all_inch_make_model_controller_filter_ids,all_capacity_of_unit_filter_sales_pcb_ids:all_capacity_of_unit_filter_sales_pcb_ids,all_vfd_make_sales_pcb_ids:all_vfd_make_sales_pcb_ids,all_plc_dcs_make_sales_pcb_ids:all_plc_dcs_make_sales_pcb_ids,all_actuator_make_sales_pcb_ids:all_actuator_make_sales_pcb_ids,all_capacity_of_unit_filter_sales_governing_ids:all_capacity_of_unit_filter_sales_governing_ids,all_vfd_make_sales_governing_ids:all_vfd_make_sales_governing_ids,all_plc_dcs_make_sales_governing_ids:all_plc_dcs_make_sales_governing_ids,all_actuator_make_sales_governing_ids:all_actuator_make_sales_governing_ids,page:page},
                beforeSend: function(){
                // Show image container
                    $("#loader").show();
                    if(parseInt(page) != 0)
                    {
                        beforeAjaxResponse();
                    }
                   
                 },
                success:function(res){
                    res = JSON.parse(res);
                    // alert(res.total);
                    if(res.result !='')
                    {
                        if(parseInt(page) == 0)
                        {
                            $('#data_after_filteration').html(res.result);
                        }
                        else
                        {
                            // alert();
                            afterAjaxResponse();
                            $('#data_after_filteration tr').last().after(res.result);
                        }
                    }
                    $('#total_result').val(res.total);
                },
                complete:function(data){
                    // Hide image container
                    $("#loader").hide();
                   }
            });
     }

}

$("#refresh_data_filter").on('click',function(){
        var url = "<?=base_url()?>filter_installation/filters";
        window.location.href = url;
   });
$("#allCheckbox").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
 $(function(){
      $('#send').click(function(){
        $('#myModal12').modal('show');
        // var val = [];
        // var module_type = $('#module_filters').val();
        // $("input[name='subCheck']:checked").each(function(i){
        //   val[i] = $(this).val();
        // });
        // var action="<?=base_url('/filter_installation/filters/bulk_email')?>";
        // var str = "&id="+val+"&module_type="+module_type;   
        // console.log(str);
        // alert();
        // return;
        // $.ajax({
            
        //     url: action,
        //     method:"POST",
        //     data:str,
        //     async:false,
        //     success: function(data){ 
        //         alert(data);
        //         location.reload();
        //     }
        // });
      });
    });


 function performAction(className){
    var subject = '';
    var body = '';
    var async_variable = false;
    if(className =='export')
    {
        
        var val = [];
        $("input[name='subCheck']:checked").each(function(i){
          val[i] = $(this).val();
        });
        var checkbox_id = val;
        var list_ids = '';
        if(checkbox_id!=''){  
            var url='<?=base_url("filter_installation/filters")?>/export/?items='+checkbox_id;
        }else{  
            var url='<?=base_url("filter_installation/filters")?>/export/?items='+list_ids;
        }
    }
    else if(className =='sendMail')
    { 
        var editor = CKEDITOR.instances.message;
        // $('#myModal12').modal('show');return false;
        var subject = $('#subject').val();
        var body = editor.getData();
        var val = [];
        $("input[name='subCheck']:checked").each(function(i){
          val[i] = $(this).val();
        });
        var checkbox_id = val;
        var list_ids = '';
        if(checkbox_id!=''){  
            var url='<?=base_url("filter_installation/filters")?>/bulk_email/?items='+checkbox_id;
        }else{  
            var url='<?=base_url("filter_installation/filters")?>/bulk_email/?items='+list_ids;
        }
        async_variable = true;
    }
        var module_id = $("#module_filters option:selected").val();
        var all_state_ids=[];
        var all_city_ids=[];
        var all_industry_ids=[];
        var all_type_establishment_ids=[];
        var all_type_client_ids=[];
        var all_plant_established_year_ids=[];
        var all_department_ids=[];
        var all_designation_ids=[];
        var all_plc_dcs_make_ids=[];
        var all_actuator_make_ids=[];
        var all_vfd_make_ids=[];
        var all_capacity_of_unit_ids=[];
        var all_capacity_of_unit_filter_sales_pcb_ids=[];
        var all_plc_dcs_make_sales_pcb_ids=[];
        var all_actuator_make_sales_pcb_ids=[];
        var all_vfd_make_sales_pcb_ids=[];
        var all_capacity_of_unit_filter_sales_governing_ids=[];
        var all_plc_dcs_make_sales_governing_ids=[];
        var all_actuator_make_sales_governing_ids=[];
        var all_vfd_make_sales_governing_ids=[];
        var all_epc_company_ids=[];
        var all_cod_month_year_ids=[];
        var all_boiler_make_ids=[];
        var all_spares_turbine_make_ids=[];
        var all_spares_generator_make_ids=[];
        var all_governing_turbine_make_ids=[];
        var all_governing_generator_make_ids=[];
        var all_bfpt_make_ids=[];
        var all_bfpm_make_ids=[];
        var all_bfp_make_ids=[];
        var all_bfbp_make_ids=[];
        var all_cep_make_ids=[];
        var all_cep_motor_make_ids=[];
        var all_coal_mill_make_ids=[];
        var all_id_fan_make_ids=[];
        var all_id_fan_motor_make_ids=[];
        var all_fd_fan_make_ids=[];
        var all_fd_fan_motor_make_ids=[];
        var all_pa_fan_make_ids=[];
        var all_pa_fan_motor_make_ids=[];
        var all_esp_make_ids=[];
        var all_aph_make_ids=[];
        var all_vib_system_ids=[];
        var all_btld_make_ids=[];
        var all_coal_feeder_make_ids=[];
        var all_flame_scaner_make_ids=[];
        var all_vib_system_make_ids=[];
        var all_ext_system_make_ids=[];
        var all_elec_governor_make_ids=[];
        var all_ih_actuator_make_ids=[];
        var all_type_make_machine_ids=[];
        var all_inch_make_model_controller_filter_ids=[];
     $("#state_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_state_ids.push($(this).val());
                }

        }
      });
     $("#city_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_city_ids.push($(this).val());
                }

        }
      });

     $("#industry_type_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_industry_ids.push($(this).val());
                }

        }
      });$("#type_of_establishment_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_establishment_ids.push($(this).val());
                }

        }
      });$("#type_of_client_filter_selct option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_client_ids.push($(this).val());
                }

        }
      });$("#plant_established_year_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plant_established_year_ids.push($(this).val());
                }

        }
      });$("#department_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_department_ids.push($(this).val());
                }

        }
      });$("#designation_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_designation_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_ids.push($(this).val());
                }

        }
      });$("#capacity_of_unit_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_sales_governing_ids.push($(this).val());
                }

        }
      });$("#capacity_of_unit_filter_sales_governing option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_filter_sales_governing_ids.push($(this).val());
                }

        }
      });$("#plc_dcs_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_plc_dcs_make_sales_pcb_ids.push($(this).val());
                }

        }
      });$("#actuator_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_actuator_make_sales_pcb_ids.push($(this).val());
                }

        }
      });$("#vfd_make_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vfd_make_sales_pcb_ids.push($(this).val());
                }

        }
      });/*$("#capacity_of_unit_filter_sales_pcb option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_capacity_of_unit_filter_sales_pcb_ids.push($(this).val());
                }

        }
      });*/$("#epc_company_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_epc_company_ids.push($(this).val());
                }

        }
      });$("#cod_month_year_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cod_month_year_ids.push($(this).val());
                }

        }
      });$("#boiler_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_boiler_make_ids.push($(this).val());
                }

        }
      });$("#spares_turbine_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_spares_turbine_make_ids.push($(this).val());
                }

        }
      });$("#spares_generator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_spares_generator_make_ids.push($(this).val());
                }

        }
      });$("#governing_turbine_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_governing_turbine_make_ids.push($(this).val());
                }

        }
      });$("#governing_generator_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_governing_generator_make_ids.push($(this).val());
                }

        }
      });$("#bfpt_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfpt_make_ids.push($(this).val());
                }

        }
      });$("#bfpm_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfpm_make_ids.push($(this).val());
                }

        }
      });$("#bfp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfp_make_ids.push($(this).val());
                }

        }
      });$("#bfbp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_bfbp_make_ids.push($(this).val());
                }

        }
      });$("#cep_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cep_make_ids.push($(this).val());
                }

        }
      });$("#cep_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_cep_motor_make_ids.push($(this).val());
                }

        }
      });$("#coal_mill_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_coal_mill_make_ids.push($(this).val());
                }

        }
      });$("#inch_id_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_id_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_id_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_id_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_fd_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_fd_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_fd_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_fd_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_pa_fan_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_pa_fan_make_ids.push($(this).val());
                }

        }
      });$("#inch_pa_fan_motor_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_pa_fan_motor_make_ids.push($(this).val());
                }

        }
      });$("#inch_esp_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_esp_make_ids.push($(this).val());
                }

        }
      });$("#inch_aph_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_aph_make_ids.push($(this).val());
                }

        }
      });$("#inch_vibration_system_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vib_system_ids.push($(this).val());
                }

        }
      });$("#inch_btld_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_btld_make_ids.push($(this).val());
                }

        }
      });$("#inch_coal_feeder_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_coal_feeder_make_ids.push($(this).val());
                }

        }
      });$("#inch_flame_scanner_make_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_flame_scaner_make_ids.push($(this).val());
                }

        }
      });$("#inch_vib_system_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_vib_system_make_ids.push($(this).val());
                }

        }
      });$("#inch_ext_system_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_ext_system_make_ids.push($(this).val());
                }

        }
      });$("#inch_elec_governor_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_elec_governor_make_ids.push($(this).val());
                }

        }
      });$("#inch_i_h_actuator_make_model_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_ih_actuator_make_ids.push($(this).val());
                }

        }
      });$("#inch_type_make_machine_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_type_make_machine_ids.push($(this).val());
                }

        }
      });

      $("#inch_make_model_controller_filter option:selected").each(function(i,v){
        if($(this).val()!=''){
            if($(this).val()!='')
                {
                    all_inch_make_model_controller_filter_ids.push($(this).val());
                }

        }
      });
      $('#data_after_filteration').html('');
        if(all_state_ids.length > 0 || all_city_ids.length > 0 || all_industry_ids.length > 0 || all_type_establishment_ids.length > 0|| all_type_client_ids.length > 0 || all_plant_established_year_ids.length > 0|| all_department_ids.length > 0 || all_designation_ids.length > 0 ||all_plc_dcs_make_ids.length > 0 || all_actuator_make_ids.length > 0 || all_vfd_make_ids.length > 0 || all_capacity_of_unit_ids.length > 0 || all_epc_company_ids.length > 0 ||all_cod_month_year_ids.length > 0 || all_boiler_make_ids.length > 0 || all_spares_turbine_make_ids.length > 0 ||all_spares_generator_make_ids.length > 0 ||all_governing_turbine_make_ids.length > 0 || all_governing_generator_make_ids.length > 0 ||all_bfpt_make_ids.length > 0 || all_bfpm_make_ids.length > 0|| all_bfp_make_ids.length > 0 || all_bfbp_make_ids.length > 0|| all_cep_make_ids.length > 0 || all_cep_motor_make_ids.length > 0 || all_coal_mill_make_ids.length > 0 || all_id_fan_make_ids.length > 0 || all_id_fan_motor_make_ids.length > 0 || all_fd_fan_make_ids.length > 0 ||all_fd_fan_motor_make_ids.length > 0 || all_pa_fan_make_ids.length > 0||all_pa_fan_motor_make_ids.length > 0 ||all_esp_make_ids.length > 0 || all_aph_make_ids.length > 0 || all_vib_system_ids.length > 0 || all_btld_make_ids.length > 0||all_coal_feeder_make_ids.length > 0 || all_flame_scaner_make_ids.length > 0 || all_vib_system_make_ids.length > 0|| all_ext_system_make_ids.length > 0 || all_elec_governor_make_ids.length > 0 ||all_ih_actuator_make_ids.length > 0 || all_type_make_machine_ids.length > 0 ||all_inch_make_model_controller_filter_ids.length > 0 || all_vfd_make_sales_pcb_ids.length > 0 ||all_plc_dcs_make_sales_pcb_ids.length > 0 || all_actuator_make_sales_pcb_ids.length > 0 ||all_capacity_of_unit_filter_sales_governing_ids.length > 0 ||all_vfd_make_sales_governing_ids.length > 0 || all_plc_dcs_make_sales_governing_ids.length > 0 || all_actuator_make_sales_governing_ids.length > 0){
            if(className == 'sendMail')
            {
                $('#myModal12').modal('hide');
                // alert();
                beforeAjaxResponse();
            }  
         $.ajax({
                url:url,
                method:'POST',
                async:async_variable,
                data:{token_name:token_hash,all_state_ids:all_state_ids,module_id:module_id,all_city_ids:all_city_ids,all_industry_ids:all_industry_ids,all_type_establishment_ids:all_type_establishment_ids,all_type_client_ids:all_type_client_ids,all_plant_established_year_ids:all_plant_established_year_ids,all_department_ids:all_department_ids,all_designation_ids:all_designation_ids,all_plc_dcs_make_ids:all_plc_dcs_make_ids,all_actuator_make_ids:all_actuator_make_ids,all_vfd_make_ids:all_vfd_make_ids,all_capacity_of_unit_ids:all_capacity_of_unit_ids,all_epc_company_ids:all_epc_company_ids,all_cod_month_year_ids:all_cod_month_year_ids,all_boiler_make_ids:all_boiler_make_ids,all_spares_turbine_make_ids:all_spares_turbine_make_ids,all_spares_generator_make_ids:all_spares_generator_make_ids,all_governing_turbine_make_ids:all_governing_turbine_make_ids,all_governing_generator_make_ids:all_governing_generator_make_ids,all_bfpt_make_ids:all_bfpt_make_ids,all_bfpm_make_ids:all_bfpm_make_ids,all_bfp_make_ids:all_bfp_make_ids,all_bfbp_make_ids:all_bfbp_make_ids,all_cep_make_ids:all_cep_make_ids,all_cep_motor_make_ids:all_cep_motor_make_ids,all_coal_mill_make_ids:all_coal_mill_make_ids,all_id_fan_make_ids:all_id_fan_make_ids,all_id_fan_motor_make_ids:all_id_fan_motor_make_ids,all_fd_fan_make_ids:all_fd_fan_make_ids,all_fd_fan_motor_make_ids:all_fd_fan_motor_make_ids,all_pa_fan_make_ids:all_pa_fan_make_ids,all_pa_fan_motor_make_ids:all_pa_fan_motor_make_ids,all_esp_make_ids:all_esp_make_ids,all_aph_make_ids:all_aph_make_ids,all_vib_system_ids:all_vib_system_ids,all_btld_make_ids:all_btld_make_ids,all_coal_feeder_make_ids:all_coal_feeder_make_ids,all_flame_scaner_make_ids:all_flame_scaner_make_ids,all_vib_system_make_ids:all_vib_system_make_ids,all_ext_system_make_ids:all_ext_system_make_ids,all_elec_governor_make_ids:all_elec_governor_make_ids,all_ih_actuator_make_ids:all_ih_actuator_make_ids,all_type_make_machine_ids:all_type_make_machine_ids,all_inch_make_model_controller_filter_ids:all_inch_make_model_controller_filter_ids,all_capacity_of_unit_filter_sales_pcb_ids:all_capacity_of_unit_filter_sales_pcb_ids,all_vfd_make_sales_pcb_ids:all_vfd_make_sales_pcb_ids,all_plc_dcs_make_sales_pcb_ids:all_plc_dcs_make_sales_pcb_ids,all_actuator_make_sales_pcb_ids:all_actuator_make_sales_pcb_ids,all_capacity_of_unit_filter_sales_governing_ids:all_capacity_of_unit_filter_sales_governing_ids,all_vfd_make_sales_governing_ids:all_vfd_make_sales_governing_ids,all_plc_dcs_make_sales_governing_ids:all_plc_dcs_make_sales_governing_ids,all_actuator_make_sales_governing_ids:all_actuator_make_sales_governing_ids,subject:subject,body:body},
                beforeSend : function(){     

                    // if(className == 'sendMail')
                    // {
                    //     $('#myModal12').modal('hide');
                    //     // alert();
                    //     beforeAjaxResponse();
                    // }               
                    
                },
                success:function(res){
                    if(className == 'sendMail')
                    {
                        res = JSON.parse(res);
                        if(res.status == 'error')
                        {
                            alert(res.message);
                        }
                        else
                        {
                            afterAjaxResponse(); 
                        }  
                        location.reload(); 
                    }
                    if(className == 'export')
                    {
                        var url = res;
                        window.location.href=url;
                        $('#page_no').val(0);
                        get_all_filters_data();  
                    }
                    
                }
            });
     }
     else
     {
        $('#myModal12').modal('hide');
        alert('Please select filter data first');
     }
        

 }

 //============ON CLICK OF THIS GET FILTER=========//
 $('#get_filter').click(function(){
    $('#page_no').val(0);
    get_all_filters_data();
});

 function get_filter_data_by_zero()
 {
    $('#page_no').val(0);
    get_all_filters_data();
 }
 //============ON CLICK OF THIS GET FILTER=========//


//============ON CHANGE OF TEMPLATE NAME GET TEMPLATE=========//
$('#template1').change(function(){
    var id = $(this).val();
    var editor = CKEDITOR.instances.message;
    if(id)
    {
        $.ajax({                
        data:token_name+"="+token_hash+"&id="+id,
        type:"post",
        url: "<?php echo SITE_PATH;?>filter_installation/filters/get_template_note",
        beforeSend : function(){                    
            beforeAjaxResponse();
        },
        success: function(data){
        // $("#message").html(data);
        // tinyMce();
       
        editor.setData( data );
        afterAjaxResponse();
        }
        });
    }
    else
    {
        editor.setData(' ');
    }
   

});

//============ON CHANGE OF TEMPLATE NAME GET TEMPLATE=========//

function sendmail()
{
    // $('#myModal12').modal('hide');
    var editor = CKEDITOR.instances.message;
    var body = editor.getData();
    var z = true;
    if($('#subject').val() == '')
    {
        $('.subject_error').html('Subject is required!');
        z = false;
    }
    else
    {
        $('.subject_error').html('');
    }
    if(body == '')
    {
        $('.body_error').html('Mail body is required!');
        z = false;
    }
    else
    {
        $('.body_error').html('');
    }
    if(z)
    {
        performAction('sendMail');
    }
    return z;
}
</script>


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Account Model 
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Account 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Filters_mod extends CI_Model {

	public $tbl_sales_spares       = "leads_sales_spares";
    public $companies              = "companies";
    public $companies_contact      = "companies_contact";
    

    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }
    
    
	public function filters_all_module($filter_data,$is_export=false,$items_data=null){
            
            // pr($filter_data['modules_for_filter']);die;
            if(!empty($filter_data['modules_for_filter'])){
                $module_for_filter = $filter_data['modules_for_filter'];
                   // pr($filter_data);
                if($module_for_filter=='sales_spares' &&(!empty($filter_data['states_arr']) || !empty($filter_data['all_city_ids']) || !empty($filter_data['all_type_establishment_ids']) || !empty($filter_data['all_industry_ids']) || !empty($filter_data['all_type_client_ids']) || !empty($filter_data['all_plant_established_year_ids'])|| !empty($filter_data['all_department_ids'])|| !empty($filter_data['all_designation_ids'])|| !empty($filter_data['all_plc_dcs_make_ids'])|| !empty($filter_data['all_actuator_make_ids'])|| !empty($filter_data['all_vfd_make_ids'])|| !empty($filter_data['all_capacity_of_unit_ids'])|| !empty($filter_data['all_epc_company_ids'])|| !empty($filter_data['all_boiler_make_ids'])|| !empty($filter_data['all_spares_turbine_make_ids'])|| !empty($filter_data['all_spares_generator_make_ids'])|| !empty($filter_data['all_bfpt_make_ids'])|| !empty($filter_data['all_bfpm_make_ids'])|| !empty($filter_data['all_bfp_make_ids'])|| !empty($filter_data['all_bfbp_make_ids'])|| !empty($filter_data['all_cep_make_ids'])|| !empty($filter_data['all_cep_motor_make_ids'])|| !empty($filter_data['all_coal_mill_make_ids'])|| !empty($filter_data['all_id_fan_make_ids'])|| !empty($filter_data['all_id_fan_motor_make_ids'])|| !empty($filter_data['all_fd_fan_make_ids'])|| !empty($filter_data['all_fd_fan_motor_make_ids'])|| !empty($filter_data['all_pa_fan_make_ids'])|| !empty($filter_data['all_pa_fan_motor_make_ids'])|| !empty($filter_data['all_esp_make_ids'])|| !empty($filter_data['all_aph_make_ids'])|| !empty($filter_data['all_vib_system_ids'])|| !empty($filter_data['all_btld_make_ids'])|| !empty($filter_data['all_coal_feeder_make_ids'])|| !empty($filter_data['all_flame_scaner_make_ids'])|| !empty($filter_data['all_vib_system_make_ids'])|| !empty($filter_data['all_ext_system_make_ids'])|| !empty($filter_data['all_elec_governor_make_ids'])|| !empty($filter_data['all_ih_actuator_make_ids'])|| !empty($filter_data['all_type_make_machine_ids']))){

                     $this->db->select("SQL_CALC_FOUND_ROWS spares.id as lead_id,spares.company_name as company_id,comp.name as Client_Name, comp.state_comp as state_id,comp.city_comp as city_id,comp.company_address as Company_Address,conts.name as Contact_Name,conts.primary_phone as Mobile,conts.secondary_phone as Personal_Mobile,conts.email_id as Official_email_id,conts.personal_email as Personal_Email,st.state_name as State_Name,ct.city_name as City_name",false);
                    $this->db->from("leads_sales_spares as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','INNER');
                    $this->db->join('companies_contact as conts','conts.company_id=comp.id','LEFT');
                    $this->db->join('states as st','st.id=comp.state_comp','LEFT');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','LEFT');
                    $this->db->join('lead_sales_pcb_common_plc as plc_dcs','plc_dcs.company_id=comp.id','LEFT');
                    $this->db->join('lead_sales_pcb_common_actuator as actu','actu.company_id=comp.id','LEFT');
                    $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.company_id=comp.id','LEFT');
                    $this->db->join('lead_others as others_data','others_data.lead_id=spares.id','INNER');

                    // check filter

                    if($filter_data['states_arr']){
                        // pr($filter_data);die;
                        $this->db->where_in('comp.state_comp',$filter_data['states_arr']);
                    }if($filter_data['all_city_ids']){
                        $this->db->where_in('comp.city_comp',$filter_data['all_city_ids']);
                    }if($filter_data['all_type_establishment_ids']){
                        $this->db->where_in('comp.type_of_establishment',$filter_data['all_type_establishment_ids']);
                    }if($filter_data['all_industry_ids']){
                        $this->db->where_in('comp.industry',$filter_data['all_industry_ids']);
                    }if($filter_data['all_type_client_ids']){
                        $this->db->where_in('comp.type_of_client',$filter_data['all_type_client_ids']);
                    }if($filter_data['all_plant_established_year_ids']){
                        $this->db->where_in('comp.plant_established_year',$filter_data['all_plant_established_year_ids']);
                    }if($filter_data['all_department_ids']){
                        $this->db->where_in('conts.department',$filter_data['all_department_ids']);
                    }if($filter_data['all_designation_ids']){
                        $this->db->where_in('conts.designation',$filter_data['all_designation_ids']);
                    }if($filter_data['all_plc_dcs_make_ids']){
                        $this->db->where_in('plc_dcs.plc_dcs_make',$filter_data['all_plc_dcs_make_ids']);
                    }if($filter_data['all_actuator_make_ids']){
                        $this->db->where_in('actu.actuator_make',$filter_data['all_actuator_make_ids']);
                    }if($filter_data['all_vfd_make_ids']){
                        $this->db->where_in('vfd.vfd_make',$filter_data['all_vfd_make_ids']);
                    }if($filter_data['all_capacity_of_unit_ids']){
                        $this->db->where_in('others_data.capacity_of_unit',$filter_data['all_capacity_of_unit_ids']);
                    }if($filter_data['all_epc_company_ids']){
                        $this->db->where_in('others_data.epc_company',$filter_data['all_epc_company_ids']);
                    }if($filter_data['all_boiler_make_ids']){
                        $this->db->where_in('others_data.boiler_make',$filter_data['all_boiler_make_ids']);
                    }if($filter_data['all_spares_turbine_make_ids']){
                        $this->db->where_in('others_data.turbine_make',$filter_data['all_spares_turbine_make_ids']);
                    }if($filter_data['all_spares_generator_make_ids']){
                        $this->db->where_in('others_data.generator_make',$filter_data['all_spares_generator_make_ids']);
                    }if($filter_data['all_bfpt_make_ids']){
                        $this->db->where_in('others_data.bfpt_make',$filter_data['all_bfpt_make_ids']);
                    }if($filter_data['all_bfpm_make_ids']){
                        $this->db->where_in('others_data.bfpm_make',$filter_data['all_bfpm_make_ids']);
                    }if($filter_data['all_bfp_make_ids']){
                        $this->db->where_in('others_data.bfp_make',$filter_data['all_bfp_make_ids']);
                    }if($filter_data['all_bfbp_make_ids']){
                        $this->db->where_in('others_data.bfbp_make',$filter_data['all_bfbp_make_ids']);
                    }if($filter_data['all_cep_make_ids']){
                        $this->db->where_in('others_data.cep_make',$filter_data['all_cep_make_ids']);
                    }if($filter_data['all_cep_motor_make_ids']){
                        $this->db->where_in('others_data.cep_motor_make',$filter_data['all_cep_motor_make_ids']);
                    }if($filter_data['all_coal_mill_make_ids']){
                        $this->db->where_in('others_data.coal_mill_make',$filter_data['all_coal_mill_make_ids']);
                    }if($filter_data['all_id_fan_make_ids']){
                        $this->db->where_in('others_data.id_fan',$filter_data['all_id_fan_make_ids']);
                    }if($filter_data['all_id_fan_motor_make_ids']){
                        $this->db->where_in('others_data.id_fan_motor_make',$filter_data['all_id_fan_motor_make_ids']);
                    }if($filter_data['all_fd_fan_make_ids']){
                        $this->db->where_in('others_data.fd_fan_make',$filter_data['all_fd_fan_make_ids']);
                    }if($filter_data['all_fd_fan_motor_make_ids']){
                        $this->db->where_in('others_data.fd_fan_motor_make',$filter_data['all_fd_fan_motor_make_ids']);
                    }if($filter_data['all_pa_fan_make_ids']){
                        $this->db->where_in('others_data.pa_fan_make',$filter_data['all_pa_fan_make_ids']);
                    }if($filter_data['all_pa_fan_motor_make_ids']){
                        $this->db->where_in('others_data.pa_fan_motor_make',$filter_data['all_pa_fan_motor_make_ids']);
                    }if($filter_data['all_esp_make_ids']){
                        $this->db->where_in('others_data.esp_make',$filter_data['all_esp_make_ids']);
                    }if($filter_data['all_aph_make_ids']){
                        $this->db->where_in('others_data.aph_make',$filter_data['all_aph_make_ids']);
                    }if($filter_data['all_vib_system_ids']){
                        $this->db->where_in('others_data.vibration_system',$filter_data['all_vib_system_ids']);
                    }if($filter_data['all_btld_make_ids']){
                        $this->db->where_in('others_data.btld_make',$filter_data['all_btld_make_ids']);
                    }if($filter_data['all_coal_feeder_make_ids']){
                        $this->db->where_in('others_data.coal_feeder_make',$filter_data['all_coal_feeder_make_ids']);
                    }if($filter_data['all_flame_scaner_make_ids']){
                        $this->db->where_in('others_data.flame_scanner_make',$filter_data['all_flame_scaner_make_ids']);
                    }
                    if($is_export==true &&  !empty($items_data))
                    {
                        // pr($items_data);die;
                        $this->db->where_in("spares.id", $items_data);
                    }
                    $this->db->group_by('spares.id');
                    $query = $this->db->get();
						//pr($this->db->last_query());die;
                    if(!$is_export)
                    {
                        $this->db->limit(100,100*$filter_data['page']);
                    }
                    $data["result"] =  $query->result() ;
                    $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                    $data["total"] = $query->row()->count;
                    return $data;

                }else if($module_for_filter=='sales_governing' &&(!empty($filter_data['states_arr']) || !empty($filter_data['all_city_ids']) || !empty($filter_data['all_type_establishment_ids']) || !empty($filter_data['all_industry_ids']) || !empty($filter_data['all_type_client_ids']) || !empty($filter_data['all_plant_established_year_ids'])|| !empty($filter_data['all_department_ids'])|| !empty($filter_data['all_designation_ids'])|| !empty($filter_data['all_vib_system_make_ids']) || !empty($filter_data['all_ext_system_make_ids']) || !empty($filter_data['all_elec_governor_make_ids']) || !empty($filter_data['all_ih_actuator_make_ids']) || !empty($filter_data['all_governing_turbine_make_ids']) || !empty($filter_data['all_governing_generator_make_ids'])|| !empty($filter_data['all_plc_dcs_make_sales_governing_ids'])|| !empty($filter_data['all_actuator_make_sales_governing_ids'])|| !empty($filter_data['all_vfd_make_sales_governing_ids'])|| !empty($filter_data['all_capacity_of_unit_filter_sales_governing_ids']))){


                     $this->db->select("SQL_CALC_FOUND_ROWS gov.id as lead_id,gov.company_name as company_id,comp_gov.name as Client_Name, comp_gov.state_comp as state_id,comp_gov.city_comp as city_id,comp_gov.company_address as Company_Address,conts_gov.name as Contact_Name,conts_gov.primary_phone as Mobile,conts_gov.secondary_phone as Personal_Mobile,conts_gov.email_id as Official_email_id,conts_gov.personal_email as Personal_Email,st_gov.state_name as State_Name,ct_gov.city_name as City_name",false);
                    $this->db->from("leads_sales_governing as gov");
                    $this->db->join('companies as comp_gov','comp_gov.id=gov.company_name','INNER');
                    $this->db->join('companies_contact as conts_gov','conts_gov.company_id=comp_gov.id','left');
                    $this->db->join('states as st_gov','st_gov.id=comp_gov.state_comp','left');
                    $this->db->join('cities as ct_gov','ct_gov.id=comp_gov.city_comp','left');
                    $this->db->join('lead_sales_pcb_common_plc as plc_dcs_gov','plc_dcs_gov.company_id=comp_gov.id','left');
                    $this->db->join('lead_sales_pcb_common_actuator as actu_gov','actu_gov.company_id=comp_gov.id','left');
                    $this->db->join('lead_sales_pcb_common_vfd as vfd_gov','vfd_gov.company_id=comp_gov.id','left');
                    $this->db->join('lead_gov_others as others_data_gov','others_data_gov.lead_id=gov.id','INNER');

                    // check filter
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp_gov.state_comp',$filter_data['states_arr']);
                    }if($filter_data['all_city_ids']){
                        $this->db->where_in('comp_gov.city_comp',$filter_data['all_city_ids']);
                    }if($filter_data['all_type_establishment_ids']){
                        $this->db->where_in('comp_gov.type_of_establishment',$filter_data['all_type_establishment_ids']);
                    }if($filter_data['all_industry_ids']){
                        $this->db->where_in('comp_gov.industry',$filter_data['all_industry_ids']);
                    }if($filter_data['all_type_client_ids']){
                        $this->db->where_in('comp_gov.type_of_client',$filter_data['all_type_client_ids']);
                    }if($filter_data['all_plant_established_year_ids']){
                        $this->db->where_in('comp_gov.plant_established_year',$filter_data['all_plant_established_year_ids']);
                    }if($filter_data['all_department_ids']){
                        $this->db->where_in('conts_gov.department',$filter_data['all_department_ids']);
                    }if($filter_data['all_designation_ids']){
                        $this->db->where_in('conts_gov.designation',$filter_data['all_designation_ids']);
                    }
                    if($filter_data['all_vib_system_make_ids']){
                        $this->db->where_in('others_data_gov.vib_system_make_model',$filter_data['all_vib_system_make_ids']);
                    }if($filter_data['all_ext_system_make_ids']){
                        $this->db->where_in('others_data_gov.ext_system_make_model',$filter_data['all_ext_system_make_ids']);
                    }if($filter_data['all_elec_governor_make_ids']){
                        $this->db->where_in('others_data_gov.elec_governor_make_model',$filter_data['all_elec_governor_make_ids']);
                    }if($filter_data['all_ih_actuator_make_ids']){
                        $this->db->where_in('others_data_gov.i_h_actuator_make_model',$filter_data['all_ih_actuator_make_ids']);
                    }if($filter_data['all_governing_turbine_make_ids']){
                        $this->db->where_in('others_data_gov.turbine_make',$filter_data['all_governing_turbine_make_ids']);
                    }if($filter_data['all_governing_generator_make_ids']){
                        $this->db->where_in('others_data_gov.generator_make',$filter_data['all_governing_generator_make_ids']);
                    }
                    if($filter_data['all_plc_dcs_make_sales_governing_ids']){
                        $this->db->where_in('plc_dcs_gov.plc_dcs_make',$filter_data['all_plc_dcs_make_sales_governing_ids']);
                    }if($filter_data['all_actuator_make_sales_governing_ids']){
                        $this->db->where_in('actu_gov.actuator_make',$filter_data['all_actuator_make_sales_governing_ids']);
                    }if($filter_data['all_vfd_make_sales_governing_ids']){
                        $this->db->where_in('vfd_gov.vfd_make',$filter_data['all_vfd_make_sales_governing_ids']);
                    }if($filter_data['all_capacity_of_unit_filter_sales_governing_ids']){
                        $this->db->where_in('others_data_gov.capacity_of_unit',$filter_data['all_capacity_of_unit_filter_sales_governing_ids']);
                    }
                    if($is_export==true &&  !empty($items_data))
                    {
                        $this->db->where_in("gov.id", $items_data);
                    }
                    if(!$is_export)
                    {
                        $this->db->limit(100,100*$filter_data['page']);
                    }
                    $this->db->group_by('gov.id');
                    $query = $this->db->get();
                    //echo $this->db->last_query();die;
                    $data["result"] =  $query->result() ;
                    $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                    $data["total"] = $query->row()->count;
                    return $data;

                }else if($module_for_filter=='sales_pcb' &&(!empty($filter_data['states_arr']) || !empty($filter_data['all_city_ids']) || !empty($filter_data['all_type_establishment_ids']) || !empty($filter_data['all_industry_ids']) || !empty($filter_data['all_type_client_ids']) || !empty($filter_data['all_plant_established_year_ids'])|| !empty($filter_data['all_department_ids'])|| !empty($filter_data['all_designation_ids'])|| !empty($filter_data['all_inch_make_model_controller_filter_ids']) || !empty($filter_data['all_plc_dcs_make_sales_pcb_ids'])|| !empty($filter_data['all_actuator_make_sales_pcb_ids'])|| !empty($filter_data['all_vfd_make_sales_pcb_ids'])|| !empty($filter_data['all_capacity_of_unit_ids']) )){
                        
                     $this->db->select("SQL_CALC_FOUND_ROWS pcb.id as lead_id,pcb.lead_status as lead_status,pcb.company_name as company_id,comp_pcb.name as Client_Name, comp_pcb.state_comp as state_id,comp_pcb.city_comp as city_id,comp_pcb.company_address as Company_Address,conts_pcb.name as Contact_Name,conts_pcb.primary_phone as Mobile,conts_pcb.secondary_phone as Personal_Mobile,conts_pcb.email_id as Official_email_id,conts_pcb.personal_email as Personal_Email,st_pcb.state_name as State_Name,ct_pcb.city_name as City_name",false);
                    $this->db->from(" leads_sales_pcb as pcb");
                    $this->db->join('companies as comp_pcb','comp_pcb.id=pcb.company_name','INNER');
                    $this->db->join('companies_contact as conts_pcb','conts_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('states as st_pcb','st_pcb.id=comp_pcb.state_comp','left');
                    $this->db->join('cities as ct_pcb','ct_pcb.id=comp_pcb.city_comp','left');
                    $this->db->join('lead_sales_pcb_common_plc as plc_dcs_pcb','plc_dcs_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('lead_sales_pcb_common_actuator as actu_pcb','actu_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('lead_sales_pcb_common_vfd as vfd_pcb','vfd_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('lead_sales_pcb_others as others_data_pcb','others_data_pcb.lead_id=pcb.id','INNER');

                    // check filter
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp_pcb.state_comp',$filter_data['states_arr']);
                    }if($filter_data['all_city_ids']){
                        $this->db->where_in('comp_pcb.city_comp',$filter_data['all_city_ids']);
                    }if($filter_data['all_type_establishment_ids']){
                        $this->db->where_in('comp_pcb.type_of_establishment',$filter_data['all_type_establishment_ids']);
                    }if($filter_data['all_industry_ids']){
                        $this->db->where_in('comp_pcb.industry',$filter_data['all_industry_ids']);
                    }if($filter_data['all_type_client_ids']){
                        $this->db->where_in('comp_pcb.type_of_client',$filter_data['all_type_client_ids']);
                    }if($filter_data['all_plant_established_year_ids']){
                        $this->db->where_in('comp_pcb.plant_established_year',$filter_data['all_plant_established_year_ids']);
                    }if($filter_data['all_department_ids']){
                        $this->db->where_in('conts_pcb.department',$filter_data['all_department_ids']);
                    }if($filter_data['all_designation_ids']){
                        $this->db->where_in('conts_pcb.designation',$filter_data['all_designation_ids']);
                    }
                    if($filter_data['all_type_make_machine_ids']){
                        $this->db->where_in('others_data_pcb.type_make_machine',$filter_data['all_type_make_machine_ids']);
                    }if($filter_data['all_inch_make_model_controller_filter_ids']){
                        $this->db->where_in('others_data_pcb.make_model_controller',$filter_data['all_inch_make_model_controller_filter_ids']);
                    }if($filter_data['all_plc_dcs_make_sales_pcb_ids']){
                        $this->db->where_in('plc_dcs_pcb.plc_dcs_make',$filter_data['all_plc_dcs_make_sales_pcb_ids']);
                    }if($filter_data['all_actuator_make_sales_pcb_ids']){
                        $this->db->where_in('actu_pcb.actuator_make',$filter_data['all_actuator_make_sales_pcb_ids']);
                    }if($filter_data['all_vfd_make_sales_pcb_ids']){
                        $this->db->where_in('vfd_pcb.vfd_make',$filter_data['all_vfd_make_sales_pcb_ids']);
                    }
                    if($is_export==true &&  !empty($items_data))
                    {
                        $this->db->where_in("pcb.id", $items_data);
                    }
                    if(!$is_export)
                    {
                        $this->db->limit(100,100*$filter_data['page']);
                    }
                    $this->db->group_by('pcb.id');
                    $query = $this->db->get();
                    //echo $this->db->last_query();die;
                    $data["result"] =  $query->result() ;
                    $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                    $data["total"] = $query->row()->count;
                    return $data;

                }else if($module_for_filter=='client_list' &&(!empty($filter_data['states_arr']) || !empty($filter_data['all_city_ids']) || !empty($filter_data['all_type_establishment_ids']) || !empty($filter_data['all_industry_ids']) || !empty($filter_data['all_type_client_ids']) || !empty($filter_data['all_plant_established_year_ids'])|| !empty($filter_data['all_department_ids'])|| !empty($filter_data['all_designation_ids'])|| !empty($filter_data['all_vfd_make_ids']) || !empty($filter_data['all_plc_dcs_make_sales_pcb_ids'])|| !empty($filter_data['all_actuator_make_sales_pcb_ids'])|| !empty($filter_data['all_vfd_make_sales_pcb_ids']) || !empty($filter_data['all_plc_dcs_make_ids']) || !empty($filter_data['all_actuator_make_ids']) )){
                        // pr($filter_data['states_arr']);die;
                     $this->db->select("SQL_CALC_FOUND_ROWS comp_pcb.id as lead_id,comp_pcb.name as Client_Name, comp_pcb.state_comp as state_id,comp_pcb.city_comp as city_id,comp_pcb.company_address as Company_Address,conts_pcb.name as Contact_Name,conts_pcb.primary_phone as Mobile,conts_pcb.secondary_phone as Personal_Mobile,conts_pcb.email_id as Official_email_id,conts_pcb.personal_email as Personal_Email,st_pcb.state_name as State_Name,ct_pcb.city_name as City_name",false);
                    // $this->db->from("companies as comp_pcb");
                    $this->db->from("companies_contact as conts_pcb");
                    // $this->db->join('companies_contact as conts_pcb','conts_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('companies as comp_pcb','comp_pcb.id=conts_pcb.company_id','left');
                    $this->db->join('states as st_pcb','st_pcb.id=comp_pcb.state_comp','left');
                    $this->db->join('cities as ct_pcb','ct_pcb.id=comp_pcb.city_comp','left');
                    $this->db->join('lead_sales_pcb_common_plc as plc_dcs_pcb','plc_dcs_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('lead_sales_pcb_common_actuator as actu_pcb','actu_pcb.company_id=comp_pcb.id','left');
                    $this->db->join('lead_sales_pcb_common_vfd as vfd_pcb','vfd_pcb.company_id=comp_pcb.id','left');
                    // $this->db->join('lead_sales_pcb_common_plc as plc_dcs','plc_dcs.company_id=comp.id','LEFT');
                    // $this->db->join('lead_sales_pcb_others as others_data_pcb','others_data_pcb.lead_id=pcb.id','INNER');

                    // check filter
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp_pcb.state_comp',$filter_data['states_arr']);
                    }if($filter_data['all_city_ids']){
                        $this->db->where_in('comp_pcb.city_comp',$filter_data['all_city_ids']);
                    }if($filter_data['all_type_establishment_ids']){
                        $this->db->where_in('comp_pcb.type_of_establishment',$filter_data['all_type_establishment_ids']);
                    }if($filter_data['all_industry_ids']){
                        $this->db->where_in('comp_pcb.industry',$filter_data['all_industry_ids']);
                    }if($filter_data['all_type_client_ids']){
                        $this->db->where_in('comp_pcb.type_of_client',$filter_data['all_type_client_ids']);
                    }if($filter_data['all_plant_established_year_ids']){
                        $this->db->where_in('comp_pcb.plant_established_year',$filter_data['all_plant_established_year_ids']);
                    }if($filter_data['all_department_ids']){
                        $this->db->where_in('conts_pcb.department',$filter_data['all_department_ids']);
                    }if($filter_data['all_designation_ids']){
                        $this->db->where_in('conts_pcb.designation',$filter_data['all_designation_ids']);
                    }
                    if($filter_data['all_actuator_make_ids']){
                        $this->db->where_in('actu_pcb.actuator_make',$filter_data['all_actuator_make_ids']);
                    }if($filter_data['all_vfd_make_ids']){
                        $this->db->where_in('vfd_pcb.vfd_make',$filter_data['all_vfd_make_ids']);
                    }
                    if($filter_data['all_plc_dcs_make_ids']){
                        $this->db->where_in('plc_dcs_pcb.plc_dcs_make',$filter_data['all_plc_dcs_make_ids']);
                    }
                    if($is_export==true &&  !empty($items_data))
                    {
                        $this->db->where_in("comp_pcb.id", $items_data);
                    }
                    if(!$is_export)
                    {
                        $this->db->limit(100,100*$filter_data['page']);
                    }
                    // $this->db->group_by('comp_pcb.id');
                    $query = $this->db->get();
                    // echo $this->db->last_query();die;
                    $data["result"] =  $query->result() ;
                    $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                    $data["total"] = $query->row()->count;
                    return $data;

                }
            }
           
    }



    public function get_all_state_according_country($filter_data){
        // pr($filter_data);die;
            if(!empty($filter_data['modules_for_filter'])){
                $module_for_filter = $filter_data['modules_for_filter'];

                if($module_for_filter=='sales_spares'){

                     // $this->db->select("comp.city_comp as city_id,ct.city_name as City_name",false);
                     $this->db->select("comp.state_comp as state_id,st.state_name as City_name",false);
                    $this->db->from("leads_sales_spares as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    // $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.country',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.state_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='sales_governing'){

                    $this->db->select("comp.state_comp as state_id,st.state_name as City_name",false);
                    $this->db->from("leads_sales_governing as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    // $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.country',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.state_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='sales_pcb'){

                    $this->db->select("comp.state_comp as state_id,st.state_name as City_name",false);
                    $this->db->from("leads_sales_pcb as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    // $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.country',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.state_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='client_list'){

                    $this->db->select("comp.state_comp as state_id,st.state_name as City_name",false);
                    $this->db->from("companies as comp");
                    // $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    // $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','left');
                    // check filter
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.country',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.state_comp');
                    $query = $this->db->get();
                    return $query->result();

                }
            }
           
    }

    public function get_all_cities_according_states($filter_data){
        
            if(!empty($filter_data['modules_for_filter'])){
                $module_for_filter = $filter_data['modules_for_filter'];

                if($module_for_filter=='sales_spares'){

                     $this->db->select("comp.city_comp as city_id,ct.city_name as City_name",false);
                    $this->db->from("leads_sales_spares as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.state_comp',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.city_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='sales_governing'){

                     $this->db->select("comp.city_comp as city_id,ct.city_name as City_name",false);
                    $this->db->from("leads_sales_governing as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.state_comp',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.city_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='sales_pcb'){

                     $this->db->select("comp.city_comp as city_id,ct.city_name as City_name",false);
                    $this->db->from("leads_sales_pcb as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','left');

                    // check filter
                    
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.state_comp',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.city_comp');
                    $query = $this->db->get();
                    

                    return $query->result();

                }else if($module_for_filter=='client_list')
                {
                    $this->db->select("comp.city_comp as city_id,ct.city_name as City_name",false);
                    $this->db->from("companies as comp");
                    // $this->db->join('companies as comp','comp.id=spares.company_name','left');
                    // $this->db->join('companies_contact as conts','conts.id=spares.company_contact','left');
                    $this->db->join('states as st','st.id=comp.state_comp','left');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','left');
                    if($filter_data['states_arr']){
                        $this->db->where_in('comp.state_comp',$filter_data['states_arr']);
                    }
                    $this->db->group_by('comp.city_comp');
                    $query = $this->db->get();
                    return $query->result();

                }
            }
           
    }


    /*function export(){
        
        $items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);
        if($items==''){
            $items_data='';
        }
         $this->db->select("spares.id as lead_id,spares.company_name as company_id,comp.name as Client_Name, comp.state_comp as state_id,comp.city_comp as city_id,comp.company_address as Company_Address,conts.name as Contact_Name,conts.primary_phone as Mobile,conts.secondary_phone as Personal_Mobile,conts.email_id as Official_email_id,conts.personal_email as Personal_Email,st.state_name as State_Name,ct.city_name as City_name",false);
                    $this->db->from("leads_sales_spares as spares");
                    $this->db->join('companies as comp','comp.id=spares.company_name','INNER');
                    $this->db->join('companies_contact as conts','conts.company_id=comp.id','LEFT');
                    $this->db->join('states as st','st.id=comp.state_comp','LEFT');
                    $this->db->join('cities as ct','ct.id=comp.city_comp','LEFT');
                    $this->db->join('lead_sales_pcb_common_plc as plc_dcs','plc_dcs.company_id=comp.id','LEFT');
                    $this->db->join('lead_sales_pcb_common_actuator as actu','actu.company_id=comp.id','LEFT');
                    $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.company_id=comp.id','LEFT');
                    $this->db->join('lead_others as others_data','others_data.lead_id=spares.id','INNER');
        //$this->db->group_by('spares.id');
        if(!empty($items_data))
                    {
                        $this->db->where_in("spares.id", $items_data);
                    }
       //pr($this->db->last_query());die;
        $query = $this->db->get();

        $data= $query->result();    
        pr($data);die;
        return $data;
    }*/

//=======================GET TEMPLATE FOR EMAIL=====================//
    public function get_template_for_mail()
    {
        $this->db->select('id,name')->from('email_template')->where('status','1');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function get_note_by_id($id)
    {
        $this->db->select('notes')->from('email_template')->where('status','1')->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row()->notes;
        }
        return false;
    }
//=======================GET TEMPLATE FOR EMAIL=====================//

}
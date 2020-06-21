<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Dashboard Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Dashboard 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Filters extends MY_Controller {
    
    /**
	 * Constructor
	 */
     
    function __construct()
    {
        parent::__construct();
        isProtected();

		//pr($this->session); die;
         $this->load->model('filters_mod');
		 //$this->load->model('job_order/pipeline_mod');
        $this->data['base_url'] = base_url("filter_installation/filters");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        //$this->table_name   = "leads_sales_governing";
        
        $this->data['module'] = 'Filter Installation Base';
        $this->data['module_link'] = base_url("filter_installation/filters")."/list_items";
    }
    
    // ------------------------------------------------------------------------

    /**
     * Index
     *
     * This function display user dashboard
     * 
     * @access	public
     * @return	html data
     */
	

	public function list_items()
    {
        redirect($this->data['base_url']);
    }

    public function index()
	{

        
	   $views[]         = "filter_installation/filters";
       $data['title']   = "Filter Installation Base";
       $data['country'] = get_country_from_master();
       $data['state_filter'] = get_state_filters();
       $data['city_filter'] = get_city_filters();	
       $data['industry_type_filter'] = get_industry_type_filters(); 
       $table_type_of_establishment = "inch_client_type_establishment";
       $data['type_of_establishment_filter'] = get_dynamic_tbl_filters($table_type_of_establishment);

       $table_type_of_client = "inch_type_of_client";
       $data['type_of_client_filter'] = get_dynamic_tbl_filters($table_type_of_client);

       $table_plc_dcs_make = "inch_plc_dcs_make";
       $data['plc_dcs_make_filter'] = get_dynamic_tbl_filters($table_plc_dcs_make);

       $table_actuator_make = "inch_actuator_make";
       $data['actuator_make_filter'] = get_dynamic_tbl_filters($table_actuator_make);


       $table_vfd_make = " inch_vfd_make";
       $data['vfd_make_filter'] = get_dynamic_tbl_filters($table_vfd_make); 


       $table_inch_epc_company = "inch_epc_company";
       $data['epc_company_filter'] = get_dynamic_tbl_filters($table_inch_epc_company);

       $table_inch_boiler_make = "inch_boiler_make";
       $data['boiler_make_filter'] = get_dynamic_tbl_filters($table_inch_boiler_make); 

       $table_inch_turbine_make = "  inch_spares_turbine_make";
       $data['spares_turbine_make_filter'] = get_dynamic_tbl_filters($table_inch_turbine_make);
       $table_inch_spares_generator_make = "inch_spares_generator_make";
       $data['spares_generator_make_filter'] = get_dynamic_tbl_filters($table_inch_spares_generator_make);
       
        $table_inch_governing_turbine_make = "inch_governing_turbine_make";
       $data['governing_turbine_make_filter'] = get_dynamic_tbl_filters($table_inch_governing_turbine_make); 


       $table_inch_governing_generator_make = "inch_governing_generator_make";
       $data['governing_generator_make_filter'] = get_dynamic_tbl_filters($table_inch_governing_generator_make);  

       $table_inch_bfpt_make = "inch_bfpt_make";
       $data['bfpt_make_filter'] = get_dynamic_tbl_filters($table_inch_bfpt_make);

       $table_inch_bfpm_make = "inch_bfpm_make";
       $data['bfpm_make_filter'] = get_dynamic_tbl_filters($table_inch_bfpm_make);

       $table_inch_bfp_make = "inch_bfp_make";
       $data['bfp_make_filter'] = get_dynamic_tbl_filters($table_inch_bfp_make); 

       $table_inch_bfbp_make = "inch_bfbp_make";
       $data['bfbp_make_filter'] = get_dynamic_tbl_filters($table_inch_bfbp_make);

       $table_inch_cep_make = "inch_cep_make";
       $data['cep_make_filter'] = get_dynamic_tbl_filters($table_inch_cep_make);

       $table_inch_cep_motor_make = "inch_cep_motor_make";
       $data['cep_motor_make_filter'] = get_dynamic_tbl_filters($table_inch_cep_motor_make);

       $table_inch_coal_mill_make = "inch_coal_mill_make";
       $data['coal_mill_make_filter'] = get_dynamic_tbl_filters($table_inch_coal_mill_make);

       $table_inch_id_fan = "inch_id_fan";
       $data['inch_id_fan_filter'] = get_dynamic_tbl_filters($table_inch_id_fan);

       $table_inch_id_fan_motor_make = "inch_id_fan_motor_make";
       $data['inch_id_fan_motor_make_filter'] = get_dynamic_tbl_filters($table_inch_id_fan_motor_make); 


       $table_inch_fd_fan = "inch_fd_fan";
       $data['inch_fd_fan_filter'] = get_dynamic_tbl_filters($table_inch_fd_fan);

       $table_inch_fd_fan_motor_make = "inch_fd_fan_motor_make";
       $data['inch_fd_fan_motor_make_filter'] = get_dynamic_tbl_filters($table_inch_fd_fan_motor_make);


       $table_inch_pa_fan = "inch_pa_fan";
       $data['inch_pa_fan_filter'] = get_dynamic_tbl_filters($table_inch_pa_fan);

       $table_inch_pa_fan_motor_make = "inch_pa_fan_motor_make";
       $data['inch_pa_fan_motor_make_filter'] = get_dynamic_tbl_filters($table_inch_pa_fan_motor_make); 

       $table_inch_esp_make = "inch_esp_make";
       $data['inch_esp_make_filter'] = get_dynamic_tbl_filters($table_inch_esp_make);

       $table_inch_aph_make = "inch_aph_make";
       $data['inch_aph_make_filter'] = get_dynamic_tbl_filters($table_inch_aph_make); 

       $table_inch_vibration_system = "inch_vibration_system";
       $data['inch_vibration_system_filter'] = get_dynamic_tbl_filters($table_inch_vibration_system); 

       $table_inch_btld_make = "inch_btld_make";
       $data['inch_btld_make_filter'] = get_dynamic_tbl_filters($table_inch_btld_make);

       $table_inch_coal_feeder_make = "inch_coal_feeder_make";
       $data['inch_coal_feeder_make_filter'] = get_dynamic_tbl_filters($table_inch_coal_feeder_make);

       $table_inch_flame_scanner_make = "inch_flame_scanner_make";
       $data['inch_flame_scanner_make_filter'] = get_dynamic_tbl_filters($table_inch_flame_scanner_make); 

       $table_inch_vib_system_make_model = "inch_vib_system_make_model";
       $data['inch_vib_system_make_model_filter'] = get_dynamic_tbl_filters($table_inch_vib_system_make_model); 

       $table_inch_ext_system_make_model = "inch_ext_system_make_model";
       $data['inch_ext_system_make_model_filter'] = get_dynamic_tbl_filters($table_inch_ext_system_make_model);

       $table_inch_elec_governor_make_model = "inch_elec_governor_make_model";
       $data['inch_elec_governor_make_model_filter'] = get_dynamic_tbl_filters($table_inch_elec_governor_make_model); 

       $table_inch_i_h_actuator_make_model = "inch_i_h_actuator_make_model";
       $data['inch_i_h_actuator_make_model_filter'] = get_dynamic_tbl_filters($table_inch_i_h_actuator_make_model); 

       $table_inch_type_make_machine = "inch_type_make_machine";
       $data['inch_type_make_machine_filter'] = get_dynamic_tbl_filters($table_inch_type_make_machine);
       $table_inch_make_model_controller = "inch_make_model_controller";
       $data['inch_make_model_controller_filter'] = get_dynamic_tbl_filters($table_inch_make_model_controller); 
       $data['template'] = $this->filters_mod->get_template_for_mail();  
       $data['department_filter'] = get_department_filters();  
       $data['designation_filter'] = get_designation_filters();  
	  
	 		 $data['submodule'] = 'Filter Installation Base';
	   view_load($views,$data);
	   
	}

    public function filters_modules_datas(){

        $filter_data = array();
        
        if(isset($_GET['all_state_ids']) && !empty($_GET['all_state_ids']))
            {
                $filter_data['states_arr'] = $_GET['all_state_ids'];
            }

            if(isset($_GET['all_type_establishment_ids']) && !empty($_GET['all_type_establishment_ids']))
            {
                $filter_data['all_type_establishment_ids'] = $_GET['all_type_establishment_ids'];
            }
            if(isset($_GET['all_city_ids']) && !empty($_GET['all_city_ids']))
            {
                $filter_data['all_city_ids'] = $_GET['all_city_ids'];
            }

            if(isset($_GET['all_industry_ids']) && !empty($_GET['all_industry_ids']))
            {
                $filter_data['all_industry_ids'] = $_GET['all_industry_ids'];
            }
            if(isset($_GET['all_type_client_ids']) && !empty($_GET['all_type_client_ids']))
            {
                $filter_data['all_type_client_ids'] = $_GET['all_type_client_ids'];
            }

            if(isset($_GET['all_plant_established_year_ids']) && !empty($_GET['all_plant_established_year_ids']))
            {
                $filter_data['all_plant_established_year_ids'] = $_GET['all_plant_established_year_ids'];
            }
            if(isset($_GET['all_department_ids']) && !empty($_GET['all_department_ids']))
            {
                $filter_data['all_department_ids'] = $_GET['all_department_ids'];
            }
            if(isset($_GET['all_designation_ids']) && !empty($_GET['all_designation_ids']))
            {
                $filter_data['all_designation_ids'] = $_GET['all_designation_ids'];
            }
            if(isset($_GET['all_plc_dcs_make_ids']) && !empty($_GET['all_plc_dcs_make_ids']))
            {
                $filter_data['all_plc_dcs_make_ids'] = $_GET['all_plc_dcs_make_ids'];
            }
            if(isset($_GET['all_actuator_make_ids']) && !empty($_GET['all_actuator_make_ids']))
            {
                $filter_data['all_actuator_make_ids'] = $_GET['all_actuator_make_ids'];
            }
            if(isset($_GET['all_vfd_make_ids']) && !empty($_GET['all_vfd_make_ids']))
            {
                $filter_data['all_vfd_make_ids'] = $_GET['all_vfd_make_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_ids']) && !empty($_GET['all_capacity_of_unit_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_governing_ids']) && !empty($_GET['all_plc_dcs_make_sales_governing_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_governing_ids'] = $_GET['all_plc_dcs_make_sales_governing_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_governing_ids']) && !empty($_GET['all_actuator_make_sales_governing_ids']))
            {
                $filter_data['all_actuator_make_sales_governing_ids'] = $_GET['all_actuator_make_sales_governing_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_governing_ids']) && !empty($_GET['all_vfd_make_sales_governing_ids']))
            {
                $filter_data['all_vfd_make_sales_governing_ids'] = $_GET['all_vfd_make_sales_governing_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_governing_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_governing_ids']))
            {
                $filter_data['all_capacity_of_unit_filter_sales_governing_ids'] = $_GET['all_capacity_of_unit_filter_sales_governing_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_pcb_ids']) && !empty($_GET['all_plc_dcs_make_sales_pcb_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_pcb_ids'] = $_GET['all_plc_dcs_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_pcb_ids']) && !empty($_GET['all_actuator_make_sales_pcb_ids']))
            {
                $filter_data['all_actuator_make_sales_pcb_ids'] = $_GET['all_actuator_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_pcb_ids']) && !empty($_GET['all_vfd_make_sales_pcb_ids']))
            {
                $filter_data['all_vfd_make_sales_pcb_ids'] = $_GET['all_vfd_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_pcb_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_pcb_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_filter_sales_pcb_ids'];
            }

            if(isset($_GET['all_epc_company_ids']) && !empty($_GET['all_epc_company_ids']))
            {
                $filter_data['all_epc_company_ids'] = $_GET['all_epc_company_ids'];
            }
            if(isset($_GET['all_boiler_make_ids']) && !empty($_GET['all_boiler_make_ids']))
            {
                $filter_data['all_boiler_make_ids'] = $_GET['all_boiler_make_ids'];
            }
            if(isset($_GET['all_spares_turbine_make_ids']) && !empty($_GET['all_spares_turbine_make_ids']))
            {
                $filter_data['all_spares_turbine_make_ids'] = $_GET['all_spares_turbine_make_ids'];
            }
            if(isset($_GET['all_spares_generator_make_ids']) && !empty($_GET['all_spares_generator_make_ids']))
            {
                $filter_data['all_spares_generator_make_ids'] = $_GET['all_spares_generator_make_ids'];
            }
            if(isset($_GET['all_bfpt_make_ids']) && !empty($_GET['all_bfpt_make_ids']))
            {
                $filter_data['all_bfpt_make_ids'] = $_GET['all_bfpt_make_ids'];
            }
            if(isset($_GET['all_bfpm_make_ids']) && !empty($_GET['all_bfpm_make_ids']))
            {
                $filter_data['all_bfpm_make_ids'] = $_GET['all_bfpm_make_ids'];
            }
            if(isset($_GET['all_bfp_make_ids']) && !empty($_GET['all_bfp_make_ids']))
            {
                $filter_data['all_bfp_make_ids'] = $_GET['all_bfp_make_ids'];
            }
            if(isset($_GET['all_bfbp_make_ids']) && !empty($_GET['all_bfbp_make_ids']))
            {
                $filter_data['all_bfbp_make_ids'] = $_GET['all_bfbp_make_ids'];
            }
            if(isset($_GET['all_cep_make_ids']) && !empty($_GET['all_cep_make_ids']))
            {
                $filter_data['all_cep_make_ids'] = $_GET['all_cep_make_ids'];
            }
            if(isset($_GET['all_cep_motor_make_ids']) && !empty($_GET['all_cep_motor_make_ids']))
            {
                $filter_data['all_cep_motor_make_ids'] = $_GET['all_cep_motor_make_ids'];
            }
            if(isset($_GET['all_coal_mill_make_ids']) && !empty($_GET['all_coal_mill_make_ids']))
            {
                $filter_data['all_coal_mill_make_ids'] = $_GET['all_coal_mill_make_ids'];
            }
            if(isset($_GET['all_id_fan_make_ids']) && !empty($_GET['all_id_fan_make_ids']))
            {
                $filter_data['all_id_fan_make_ids'] = $_GET['all_id_fan_make_ids'];
            }
            if(isset($_GET['all_id_fan_motor_make_ids']) && !empty($_GET['all_id_fan_motor_make_ids']))
            {
                $filter_data['all_id_fan_motor_make_ids'] = $_GET['all_id_fan_motor_make_ids'];
            }
            if(isset($_GET['all_fd_fan_make_ids']) && !empty($_GET['all_fd_fan_make_ids']))
            {
                $filter_data['all_fd_fan_make_ids'] = $_GET['all_fd_fan_make_ids'];
            }
            if(isset($_GET['all_fd_fan_motor_make_ids']) && !empty($_GET['all_fd_fan_motor_make_ids']))
            {
                $filter_data['all_fd_fan_motor_make_ids'] = $_GET['all_fd_fan_motor_make_ids'];
            }
            if(isset($_GET['all_pa_fan_make_ids']) && !empty($_GET['all_pa_fan_make_ids']))
            {
                $filter_data['all_pa_fan_make_ids'] = $_GET['all_pa_fan_make_ids'];
            }
            if(isset($_GET['all_pa_fan_motor_make_ids']) && !empty($_GET['all_pa_fan_motor_make_ids']))
            {
                $filter_data['all_pa_fan_motor_make_ids'] = $_GET['all_pa_fan_motor_make_ids'];
            }
            if(isset($_GET['all_esp_make_ids']) && !empty($_GET['all_esp_make_ids']))
            {
                $filter_data['all_esp_make_ids'] = $_GET['all_esp_make_ids'];
            }
            if(isset($_GET['all_aph_make_ids']) && !empty($_GET['all_aph_make_ids']))
            {
                $filter_data['all_aph_make_ids'] = $_GET['all_aph_make_ids'];
            }
            if(isset($_GET['all_vib_system_ids']) && !empty($_GET['all_vib_system_ids']))
            {
                $filter_data['all_vib_system_ids'] = $_GET['all_vib_system_ids'];
            }
            if(isset($_GET['all_btld_make_ids']) && !empty($_GET['all_btld_make_ids']))
            {
                $filter_data['all_btld_make_ids'] = $_GET['all_btld_make_ids'];
            }
            if(isset($_GET['all_coal_feeder_make_ids']) && !empty($_GET['all_coal_feeder_make_ids']))
            {
                $filter_data['all_coal_feeder_make_ids'] = $_GET['all_coal_feeder_make_ids'];
            }
            if(isset($_GET['all_flame_scaner_make_ids']) && !empty($_GET['all_flame_scaner_make_ids']))
            {
                $filter_data['all_flame_scaner_make_ids'] = $_GET['all_flame_scaner_make_ids'];
            }
            if(isset($_GET['all_vib_system_make_ids']) && !empty($_GET['all_vib_system_make_ids']))
            {
                $filter_data['all_vib_system_make_ids'] = $_GET['all_vib_system_make_ids'];
            }
            if(isset($_GET['all_ext_system_make_ids']) && !empty($_GET['all_ext_system_make_ids']))
            {
                $filter_data['all_ext_system_make_ids'] = $_GET['all_ext_system_make_ids'];
            }
            if(isset($_GET['all_elec_governor_make_ids']) && !empty($_GET['all_elec_governor_make_ids']))
            {
                $filter_data['all_elec_governor_make_ids'] = $_GET['all_elec_governor_make_ids'];
            }
            if(isset($_GET['all_ih_actuator_make_ids']) && !empty($_GET['all_ih_actuator_make_ids']))
            {
                $filter_data['all_ih_actuator_make_ids'] = $_GET['all_ih_actuator_make_ids'];
            }
            if(isset($_GET['all_type_make_machine_ids']) && !empty($_GET['all_type_make_machine_ids']))
            {
                $filter_data['all_type_make_machine_ids'] = $_GET['all_type_make_machine_ids'];
            }
            if(isset($_GET['all_inch_make_model_controller_filter_ids']) && !empty($_GET['all_inch_make_model_controller_filter_ids']))
            {
                $filter_data['all_inch_make_model_controller_filter_ids'] = $_GET['all_inch_make_model_controller_filter_ids'];
            }


         if(isset($_GET['module_id']) && !empty($_GET['module_id']))
            {
                $filter_data['modules_for_filter'] = $_GET['module_id'];
            } 

            $filter_data['page'] = !empty($_GET['page'])?$_GET['page']:0;
           // pr($filter_data); 
       
        if(!empty($filter_data)){
            $data_after_filter = $this->filters_mod->filters_all_module($filter_data);
            // pr($data_after_filter);die;
            if(count($data_after_filter['result']) > 0){
                $i= (100*(int)$filter_data['page']) + 1;
                $html = '';
                foreach($data_after_filter['result'] as $row)
                 {
                    $html .= '<tr>';
                    $html .=  '<td><input type="checkbox" name="subCheck" value="'.$row->lead_id.'" class="styled cdCheckbox_'.$row->lead_id.'" id="subCheck" onclick="chk('.$row->lead_id.')"/></td>';
                    $html .=  '<td>'.$i.'</td>';
                    $html .=  '<td >'.ucwords($row->Client_Name).'</td>';
                    $html .=  '<td>'.ucwords($row->Company_Address).'</td>';
                    $html .=  '<td>'.ucwords($row->State_Name).'</td>';
                    $html .=  '<td>'.ucwords($row->City_name).'</td>';
                    $html .=  '<td>'.ucwords($row->Contact_Name).'</td>';
                    $html .=  '<td>'.$row->Mobile.'</td>';
                    $html .=  '<td>'.$row->Official_email_id.'</td>';
                    if(!empty($row->Personal_Mobile)){
                     $html .=  '<td>'.$row->Personal_Mobile.'</td>';
                    }else{
                    $html .=  '<td>-/-</td>'; 
                     }
                    if(!empty($row->Personal_Email)){
                    $html .=  '<td>'.$row->Personal_Email.'</td>';
                    }else{
                    $html .=  '<td>-/-</td>'; 
                    }
                    $html .=  '</tr>';
                    $i++;
                    // $result[] = $html;
                 }
                 $data['result'] = $html;
                 $data['total'] = $data_after_filter['total'];
                 echo json_encode($data);die;

            }
            else
            {
                $data['result'] ='<td colspan="11" align="center"><--No Data Found--></td>';
                $data['total'] = 0;
            }
        }
        else
        {
            $data['result'] ='<td colspan="11" align="center"><--No Data Found--></td>';
            $data['total'] = 0;
            
        }
        echo json_encode($data);die;
    }



public function get_all_state_from_country()
{

        $filter_data = array();
        if(isset($_GET['all_state_ids'][0]) && !empty($_GET['all_state_ids'][0]) && $_GET['all_state_ids'][0] != 'null' )
        {
          $filter_data['states_arr'] = $_GET['all_state_ids'][0];
        }

       if(isset($_GET['module_id']) && !empty($_GET['module_id']) && $_GET['all_state_ids'][0] != 'null')
       {
          $filter_data['modules_for_filter'] = $_GET['module_id'];
       }
             
       if(isset($_GET['all_state_ids'][0]) && $_GET['all_state_ids'][0] == 'null')
       {
                 $all_cities_data = get_city_filters();
                 if(!empty($all_cities_data)){
                     foreach($all_cities_data as $row)
                    {
                        echo '<option '.' value="'.$row->id.'">'.ucwords($row->city_name).'</option>';
                    }

                }else{
                   echo '<option value=""><--No State--></option>'; 
                }
        }
        if(!empty($filter_data) && $_GET['all_state_ids'][0] != 'null'){
            $city_data_after_filter = $this->filters_mod->get_all_state_according_country($filter_data);
            if(count($city_data_after_filter) > 0)
            echo '';
        else
            echo '<option value=""><--No State--></option>';
        
        foreach($city_data_after_filter as $row)
        {
            echo '<option '.' value="'.$row->state_id.'">'.ucwords($row->City_name).'</option>';
        }
        

        }
}

public function get_all_city_from_states(){

        $filter_data = array();
        if(isset($_GET['all_state_ids'][0]) && !empty($_GET['all_state_ids'][0]) && $_GET['all_state_ids'][0] != 'null' )
            {
                $filter_data['states_arr'] = $_GET['all_state_ids'][0];
            }

         if(isset($_GET['module_id']) && !empty($_GET['module_id']) && $_GET['all_state_ids'][0] != 'null')
            {
                $filter_data['modules_for_filter'] = $_GET['module_id'];
            }
             
       if(isset($_GET['all_state_ids'][0]) && $_GET['all_state_ids'][0] == 'null'){
                
                 $all_cities_data = get_city_filters();
                 
                 if(!empty($all_cities_data)){
                     foreach($all_cities_data as $row)
                    {
                        echo '<option '.' value="'.$row->id.'">'.ucwords($row->city_name).'</option>';
                    }

                }else{
                   echo '<option value=""><--No City--></option>'; 
                }
            }
        if(!empty($filter_data) && $_GET['all_state_ids'][0] != 'null'){
            $city_data_after_filter = $this->filters_mod->get_all_cities_according_states($filter_data);

           

            if(count($city_data_after_filter) > 0)
            echo '';
        else
            echo '<option value=""><--No City--></option>';
        
        foreach($city_data_after_filter as $row)
        {
            echo '<option '.' value="'.$row->city_id.'">'.ucwords($row->City_name).'</option>';
        }
        

        }
    }
    
  function bulk_email(){
      

        $filter_data  = array();
        $text         = $this->input->get_post('text',TRUE);
        $is_export    = true;
        $items        = $this->input->get_post('items',TRUE);
        $items_data   = str_replace("row","",$items);       
        $items_data   = explode(",",$items_data);
        if($items==''){
            $items_data='';
        }
        if(isset($_GET['all_state_ids']) && !empty($_GET['all_state_ids']))
            {
                $filter_data['states_arr'] = $_GET['all_state_ids'];
            }

            if(isset($_GET['all_type_establishment_ids']) && !empty($_GET['all_type_establishment_ids']))
            {
                $filter_data['all_type_establishment_ids'] = $_GET['all_type_establishment_ids'];
            }
            if(isset($_GET['all_city_ids']) && !empty($_GET['all_city_ids']))
            {
                $filter_data['all_city_ids'] = $_GET['all_city_ids'];
            }

            if(isset($_GET['all_industry_ids']) && !empty($_GET['all_industry_ids']))
            {
                $filter_data['all_industry_ids'] = $_GET['all_industry_ids'];
            }
            if(isset($_GET['all_type_client_ids']) && !empty($_GET['all_type_client_ids']))
            {
                $filter_data['all_type_client_ids'] = $_GET['all_type_client_ids'];
            }

            if(isset($_GET['all_plant_established_year_ids']) && !empty($_GET['all_plant_established_year_ids']))
            {
                $filter_data['all_plant_established_year_ids'] = $_GET['all_plant_established_year_ids'];
            }
            if(isset($_GET['all_department_ids']) && !empty($_GET['all_department_ids']))
            {
                $filter_data['all_department_ids'] = $_GET['all_department_ids'];
            }
            if(isset($_GET['all_designation_ids']) && !empty($_GET['all_designation_ids']))
            {
                $filter_data['all_designation_ids'] = $_GET['all_designation_ids'];
            }
            if(isset($_GET['all_plc_dcs_make_ids']) && !empty($_GET['all_plc_dcs_make_ids']))
            {
                $filter_data['all_plc_dcs_make_ids'] = $_GET['all_plc_dcs_make_ids'];
            }
            if(isset($_GET['all_actuator_make_ids']) && !empty($_GET['all_actuator_make_ids']))
            {
                $filter_data['all_actuator_make_ids'] = $_GET['all_actuator_make_ids'];
            }
            if(isset($_GET['all_vfd_make_ids']) && !empty($_GET['all_vfd_make_ids']))
            {
                $filter_data['all_vfd_make_ids'] = $_GET['all_vfd_make_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_ids']) && !empty($_GET['all_capacity_of_unit_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_governing_ids']) && !empty($_GET['all_plc_dcs_make_sales_governing_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_governing_ids'] = $_GET['all_plc_dcs_make_sales_governing_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_governing_ids']) && !empty($_GET['all_actuator_make_sales_governing_ids']))
            {
                $filter_data['all_actuator_make_sales_governing_ids'] = $_GET['all_actuator_make_sales_governing_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_governing_ids']) && !empty($_GET['all_vfd_make_sales_governing_ids']))
            {
                $filter_data['all_vfd_make_sales_governing_ids'] = $_GET['all_vfd_make_sales_governing_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_governing_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_governing_ids']))
            {
                $filter_data['all_capacity_of_unit_filter_sales_governing_ids'] = $_GET['all_capacity_of_unit_filter_sales_governing_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_pcb_ids']) && !empty($_GET['all_plc_dcs_make_sales_pcb_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_pcb_ids'] = $_GET['all_plc_dcs_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_pcb_ids']) && !empty($_GET['all_actuator_make_sales_pcb_ids']))
            {
                $filter_data['all_actuator_make_sales_pcb_ids'] = $_GET['all_actuator_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_pcb_ids']) && !empty($_GET['all_vfd_make_sales_pcb_ids']))
            {
                $filter_data['all_vfd_make_sales_pcb_ids'] = $_GET['all_vfd_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_pcb_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_pcb_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_filter_sales_pcb_ids'];
            }

            if(isset($_GET['all_epc_company_ids']) && !empty($_GET['all_epc_company_ids']))
            {
                $filter_data['all_epc_company_ids'] = $_GET['all_epc_company_ids'];
            }
            if(isset($_GET['all_boiler_make_ids']) && !empty($_GET['all_boiler_make_ids']))
            {
                $filter_data['all_boiler_make_ids'] = $_GET['all_boiler_make_ids'];
            }
            if(isset($_GET['all_spares_turbine_make_ids']) && !empty($_GET['all_spares_turbine_make_ids']))
            {
                $filter_data['all_spares_turbine_make_ids'] = $_GET['all_spares_turbine_make_ids'];
            }
            if(isset($_GET['all_spares_generator_make_ids']) && !empty($_GET['all_spares_generator_make_ids']))
            {
                $filter_data['all_spares_generator_make_ids'] = $_GET['all_spares_generator_make_ids'];
            }
            if(isset($_GET['all_bfpt_make_ids']) && !empty($_GET['all_bfpt_make_ids']))
            {
                $filter_data['all_bfpt_make_ids'] = $_GET['all_bfpt_make_ids'];
            }
            if(isset($_GET['all_bfpm_make_ids']) && !empty($_GET['all_bfpm_make_ids']))
            {
                $filter_data['all_bfpm_make_ids'] = $_GET['all_bfpm_make_ids'];
            }
            if(isset($_GET['all_bfp_make_ids']) && !empty($_GET['all_bfp_make_ids']))
            {
                $filter_data['all_bfp_make_ids'] = $_GET['all_bfp_make_ids'];
            }
            if(isset($_GET['all_bfbp_make_ids']) && !empty($_GET['all_bfbp_make_ids']))
            {
                $filter_data['all_bfbp_make_ids'] = $_GET['all_bfbp_make_ids'];
            }
            if(isset($_GET['all_cep_make_ids']) && !empty($_GET['all_cep_make_ids']))
            {
                $filter_data['all_cep_make_ids'] = $_GET['all_cep_make_ids'];
            }
            if(isset($_GET['all_cep_motor_make_ids']) && !empty($_GET['all_cep_motor_make_ids']))
            {
                $filter_data['all_cep_motor_make_ids'] = $_GET['all_cep_motor_make_ids'];
            }
            if(isset($_GET['all_coal_mill_make_ids']) && !empty($_GET['all_coal_mill_make_ids']))
            {
                $filter_data['all_coal_mill_make_ids'] = $_GET['all_coal_mill_make_ids'];
            }
            if(isset($_GET['all_id_fan_make_ids']) && !empty($_GET['all_id_fan_make_ids']))
            {
                $filter_data['all_id_fan_make_ids'] = $_GET['all_id_fan_make_ids'];
            }
            if(isset($_GET['all_id_fan_motor_make_ids']) && !empty($_GET['all_id_fan_motor_make_ids']))
            {
                $filter_data['all_id_fan_motor_make_ids'] = $_GET['all_id_fan_motor_make_ids'];
            }
            if(isset($_GET['all_fd_fan_make_ids']) && !empty($_GET['all_fd_fan_make_ids']))
            {
                $filter_data['all_fd_fan_make_ids'] = $_GET['all_fd_fan_make_ids'];
            }
            if(isset($_GET['all_fd_fan_motor_make_ids']) && !empty($_GET['all_fd_fan_motor_make_ids']))
            {
                $filter_data['all_fd_fan_motor_make_ids'] = $_GET['all_fd_fan_motor_make_ids'];
            }
            if(isset($_GET['all_pa_fan_make_ids']) && !empty($_GET['all_pa_fan_make_ids']))
            {
                $filter_data['all_pa_fan_make_ids'] = $_GET['all_pa_fan_make_ids'];
            }
            if(isset($_GET['all_pa_fan_motor_make_ids']) && !empty($_GET['all_pa_fan_motor_make_ids']))
            {
                $filter_data['all_pa_fan_motor_make_ids'] = $_GET['all_pa_fan_motor_make_ids'];
            }
            if(isset($_GET['all_esp_make_ids']) && !empty($_GET['all_esp_make_ids']))
            {
                $filter_data['all_esp_make_ids'] = $_GET['all_esp_make_ids'];
            }
            if(isset($_GET['all_aph_make_ids']) && !empty($_GET['all_aph_make_ids']))
            {
                $filter_data['all_aph_make_ids'] = $_GET['all_aph_make_ids'];
            }
            if(isset($_GET['all_vib_system_ids']) && !empty($_GET['all_vib_system_ids']))
            {
                $filter_data['all_vib_system_ids'] = $_GET['all_vib_system_ids'];
            }
            if(isset($_GET['all_btld_make_ids']) && !empty($_GET['all_btld_make_ids']))
            {
                $filter_data['all_btld_make_ids'] = $_GET['all_btld_make_ids'];
            }
            if(isset($_GET['all_coal_feeder_make_ids']) && !empty($_GET['all_coal_feeder_make_ids']))
            {
                $filter_data['all_coal_feeder_make_ids'] = $_GET['all_coal_feeder_make_ids'];
            }
            if(isset($_GET['all_flame_scaner_make_ids']) && !empty($_GET['all_flame_scaner_make_ids']))
            {
                $filter_data['all_flame_scaner_make_ids'] = $_GET['all_flame_scaner_make_ids'];
            }
            if(isset($_GET['all_vib_system_make_ids']) && !empty($_GET['all_vib_system_make_ids']))
            {
                $filter_data['all_vib_system_make_ids'] = $_GET['all_vib_system_make_ids'];
            }
            if(isset($_GET['all_ext_system_make_ids']) && !empty($_GET['all_ext_system_make_ids']))
            {
                $filter_data['all_ext_system_make_ids'] = $_GET['all_ext_system_make_ids'];
            }
            if(isset($_GET['all_elec_governor_make_ids']) && !empty($_GET['all_elec_governor_make_ids']))
            {
                $filter_data['all_elec_governor_make_ids'] = $_GET['all_elec_governor_make_ids'];
            }
            if(isset($_GET['all_ih_actuator_make_ids']) && !empty($_GET['all_ih_actuator_make_ids']))
            {
                $filter_data['all_ih_actuator_make_ids'] = $_GET['all_ih_actuator_make_ids'];
            }
            if(isset($_GET['all_type_make_machine_ids']) && !empty($_GET['all_type_make_machine_ids']))
            {
                $filter_data['all_type_make_machine_ids'] = $_GET['all_type_make_machine_ids'];
            }
            if(isset($_GET['all_inch_make_model_controller_filter_ids']) && !empty($_GET['all_inch_make_model_controller_filter_ids']))
            {
                $filter_data['all_inch_make_model_controller_filter_ids'] = $_GET['all_inch_make_model_controller_filter_ids'];
            }


         if(isset($_GET['module_id']) && !empty($_GET['module_id']))
            {
                $filter_data['modules_for_filter'] = $_GET['module_id'];
            } 

           // pr($filter_data); 
       
        if(!empty($filter_data)){
            $result = $this->filters_mod->filters_all_module($filter_data,$is_export,$items_data);
        }
        $result =$result['result'];
        if($result)
        {
            $send_mail = false;
            foreach ($result as $key=>$info)
            {
                $final_email = [];
                $final_email[] = $info->Official_email_id;
                $final_email[] = $info->Personal_Email;
                $filter_email = array_unique(array_filter($final_email));
                $subject = !empty($_GET['subject'])?$_GET['subject']:'';
                $body    = !empty($_GET['body'])?$_GET['body']:'';
                $to     = implode(',',$filter_email);
                if($to)
                {
                    $userCred = get_smtp_user('all_erp_email', 1);
                    if(isset($userCred) && !empty($userCred) && isset($userCred->smtp_host) && !empty($userCred->smtp_host) && isset($userCred->smtp_port) && !empty($userCred->smtp_port) && isset($userCred->smtp_port) && !empty($userCred->smtp_port) && isset($userCred->password) && !empty($userCred->password))
                    {
                        $smtp['smtp_host'] = $userCred->smtp_host;
                        $smtp['smtp_port'] = $userCred->smtp_port;
                        $smtp['smtp_user'] = $userCred->email_id;
                        $smtp['smtp_pass'] = $userCred->password;
                    }
                    $body = str_replace('$name', $info->Client_Name, $body);
                    $send_mail = $this->SendEmail($subject, $body, $to, NULL, NULL, NULL, NULL, NULL, $smtp);
                }
            }
            // var_dump($send_mail);die;
            if($send_mail)
            {
              
              // add_report($id);
              set_flashdata('success',"Email send successfully.");
              $data['status'] = "success";

            }
            else
            {
              set_flashdata('error',"Email could not be send.");
              $data['status'] = "error";
              $data['message'] = "Email could not be send.";
            }
        }
        else
        {
          set_flashdata('error',"Email could not be send.");
          $data['status'] = "error";
          $data['message'] = "Email could not be send.";
        }
        echo json_encode($data);
      }

  	public function export()
    {
        $this->load->library('export_lib');
        $filter_data = array();
        $text          =$this->input->get_post('text',TRUE);
        $is_export =true;
        $items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);
        if($items==''){
            $items_data='';
        }
        if(isset($_GET['all_state_ids']) && !empty($_GET['all_state_ids']))
            {
                $filter_data['states_arr'] = $_GET['all_state_ids'];
            }

            if(isset($_GET['all_type_establishment_ids']) && !empty($_GET['all_type_establishment_ids']))
            {
                $filter_data['all_type_establishment_ids'] = $_GET['all_type_establishment_ids'];
            }
            if(isset($_GET['all_city_ids']) && !empty($_GET['all_city_ids']))
            {
                $filter_data['all_city_ids'] = $_GET['all_city_ids'];
            }

            if(isset($_GET['all_industry_ids']) && !empty($_GET['all_industry_ids']))
            {
                $filter_data['all_industry_ids'] = $_GET['all_industry_ids'];
            }
            if(isset($_GET['all_type_client_ids']) && !empty($_GET['all_type_client_ids']))
            {
                $filter_data['all_type_client_ids'] = $_GET['all_type_client_ids'];
            }

            if(isset($_GET['all_plant_established_year_ids']) && !empty($_GET['all_plant_established_year_ids']))
            {
                $filter_data['all_plant_established_year_ids'] = $_GET['all_plant_established_year_ids'];
            }
            if(isset($_GET['all_department_ids']) && !empty($_GET['all_department_ids']))
            {
                $filter_data['all_department_ids'] = $_GET['all_department_ids'];
            }
            if(isset($_GET['all_designation_ids']) && !empty($_GET['all_designation_ids']))
            {
                $filter_data['all_designation_ids'] = $_GET['all_designation_ids'];
            }
            if(isset($_GET['all_plc_dcs_make_ids']) && !empty($_GET['all_plc_dcs_make_ids']))
            {
                $filter_data['all_plc_dcs_make_ids'] = $_GET['all_plc_dcs_make_ids'];
            }
            if(isset($_GET['all_actuator_make_ids']) && !empty($_GET['all_actuator_make_ids']))
            {
                $filter_data['all_actuator_make_ids'] = $_GET['all_actuator_make_ids'];
            }
            if(isset($_GET['all_vfd_make_ids']) && !empty($_GET['all_vfd_make_ids']))
            {
                $filter_data['all_vfd_make_ids'] = $_GET['all_vfd_make_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_ids']) && !empty($_GET['all_capacity_of_unit_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_governing_ids']) && !empty($_GET['all_plc_dcs_make_sales_governing_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_governing_ids'] = $_GET['all_plc_dcs_make_sales_governing_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_governing_ids']) && !empty($_GET['all_actuator_make_sales_governing_ids']))
            {
                $filter_data['all_actuator_make_sales_governing_ids'] = $_GET['all_actuator_make_sales_governing_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_governing_ids']) && !empty($_GET['all_vfd_make_sales_governing_ids']))
            {
                $filter_data['all_vfd_make_sales_governing_ids'] = $_GET['all_vfd_make_sales_governing_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_governing_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_governing_ids']))
            {
                $filter_data['all_capacity_of_unit_filter_sales_governing_ids'] = $_GET['all_capacity_of_unit_filter_sales_governing_ids'];
            }


            if(isset($_GET['all_plc_dcs_make_sales_pcb_ids']) && !empty($_GET['all_plc_dcs_make_sales_pcb_ids']))
            {
                $filter_data['all_plc_dcs_make_sales_pcb_ids'] = $_GET['all_plc_dcs_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_actuator_make_sales_pcb_ids']) && !empty($_GET['all_actuator_make_sales_pcb_ids']))
            {
                $filter_data['all_actuator_make_sales_pcb_ids'] = $_GET['all_actuator_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_vfd_make_sales_pcb_ids']) && !empty($_GET['all_vfd_make_sales_pcb_ids']))
            {
                $filter_data['all_vfd_make_sales_pcb_ids'] = $_GET['all_vfd_make_sales_pcb_ids'];
            }
            if(isset($_GET['all_capacity_of_unit_filter_sales_pcb_ids']) && !empty($_GET['all_capacity_of_unit_filter_sales_pcb_ids']))
            {
                $filter_data['all_capacity_of_unit_ids'] = $_GET['all_capacity_of_unit_filter_sales_pcb_ids'];
            }

            if(isset($_GET['all_epc_company_ids']) && !empty($_GET['all_epc_company_ids']))
            {
                $filter_data['all_epc_company_ids'] = $_GET['all_epc_company_ids'];
            }
            if(isset($_GET['all_boiler_make_ids']) && !empty($_GET['all_boiler_make_ids']))
            {
                $filter_data['all_boiler_make_ids'] = $_GET['all_boiler_make_ids'];
            }
            if(isset($_GET['all_spares_turbine_make_ids']) && !empty($_GET['all_spares_turbine_make_ids']))
            {
                $filter_data['all_spares_turbine_make_ids'] = $_GET['all_spares_turbine_make_ids'];
            }
            if(isset($_GET['all_spares_generator_make_ids']) && !empty($_GET['all_spares_generator_make_ids']))
            {
                $filter_data['all_spares_generator_make_ids'] = $_GET['all_spares_generator_make_ids'];
            }
            if(isset($_GET['all_bfpt_make_ids']) && !empty($_GET['all_bfpt_make_ids']))
            {
                $filter_data['all_bfpt_make_ids'] = $_GET['all_bfpt_make_ids'];
            }
            if(isset($_GET['all_bfpm_make_ids']) && !empty($_GET['all_bfpm_make_ids']))
            {
                $filter_data['all_bfpm_make_ids'] = $_GET['all_bfpm_make_ids'];
            }
            if(isset($_GET['all_bfp_make_ids']) && !empty($_GET['all_bfp_make_ids']))
            {
                $filter_data['all_bfp_make_ids'] = $_GET['all_bfp_make_ids'];
            }
            if(isset($_GET['all_bfbp_make_ids']) && !empty($_GET['all_bfbp_make_ids']))
            {
                $filter_data['all_bfbp_make_ids'] = $_GET['all_bfbp_make_ids'];
            }
            if(isset($_GET['all_cep_make_ids']) && !empty($_GET['all_cep_make_ids']))
            {
                $filter_data['all_cep_make_ids'] = $_GET['all_cep_make_ids'];
            }
            if(isset($_GET['all_cep_motor_make_ids']) && !empty($_GET['all_cep_motor_make_ids']))
            {
                $filter_data['all_cep_motor_make_ids'] = $_GET['all_cep_motor_make_ids'];
            }
            if(isset($_GET['all_coal_mill_make_ids']) && !empty($_GET['all_coal_mill_make_ids']))
            {
                $filter_data['all_coal_mill_make_ids'] = $_GET['all_coal_mill_make_ids'];
            }
            if(isset($_GET['all_id_fan_make_ids']) && !empty($_GET['all_id_fan_make_ids']))
            {
                $filter_data['all_id_fan_make_ids'] = $_GET['all_id_fan_make_ids'];
            }
            if(isset($_GET['all_id_fan_motor_make_ids']) && !empty($_GET['all_id_fan_motor_make_ids']))
            {
                $filter_data['all_id_fan_motor_make_ids'] = $_GET['all_id_fan_motor_make_ids'];
            }
            if(isset($_GET['all_fd_fan_make_ids']) && !empty($_GET['all_fd_fan_make_ids']))
            {
                $filter_data['all_fd_fan_make_ids'] = $_GET['all_fd_fan_make_ids'];
            }
            if(isset($_GET['all_fd_fan_motor_make_ids']) && !empty($_GET['all_fd_fan_motor_make_ids']))
            {
                $filter_data['all_fd_fan_motor_make_ids'] = $_GET['all_fd_fan_motor_make_ids'];
            }
            if(isset($_GET['all_pa_fan_make_ids']) && !empty($_GET['all_pa_fan_make_ids']))
            {
                $filter_data['all_pa_fan_make_ids'] = $_GET['all_pa_fan_make_ids'];
            }
            if(isset($_GET['all_pa_fan_motor_make_ids']) && !empty($_GET['all_pa_fan_motor_make_ids']))
            {
                $filter_data['all_pa_fan_motor_make_ids'] = $_GET['all_pa_fan_motor_make_ids'];
            }
            if(isset($_GET['all_esp_make_ids']) && !empty($_GET['all_esp_make_ids']))
            {
                $filter_data['all_esp_make_ids'] = $_GET['all_esp_make_ids'];
            }
            if(isset($_GET['all_aph_make_ids']) && !empty($_GET['all_aph_make_ids']))
            {
                $filter_data['all_aph_make_ids'] = $_GET['all_aph_make_ids'];
            }
            if(isset($_GET['all_vib_system_ids']) && !empty($_GET['all_vib_system_ids']))
            {
                $filter_data['all_vib_system_ids'] = $_GET['all_vib_system_ids'];
            }
            if(isset($_GET['all_btld_make_ids']) && !empty($_GET['all_btld_make_ids']))
            {
                $filter_data['all_btld_make_ids'] = $_GET['all_btld_make_ids'];
            }
            if(isset($_GET['all_coal_feeder_make_ids']) && !empty($_GET['all_coal_feeder_make_ids']))
            {
                $filter_data['all_coal_feeder_make_ids'] = $_GET['all_coal_feeder_make_ids'];
            }
            if(isset($_GET['all_flame_scaner_make_ids']) && !empty($_GET['all_flame_scaner_make_ids']))
            {
                $filter_data['all_flame_scaner_make_ids'] = $_GET['all_flame_scaner_make_ids'];
            }
            if(isset($_GET['all_vib_system_make_ids']) && !empty($_GET['all_vib_system_make_ids']))
            {
                $filter_data['all_vib_system_make_ids'] = $_GET['all_vib_system_make_ids'];
            }
            if(isset($_GET['all_ext_system_make_ids']) && !empty($_GET['all_ext_system_make_ids']))
            {
                $filter_data['all_ext_system_make_ids'] = $_GET['all_ext_system_make_ids'];
            }
            if(isset($_GET['all_elec_governor_make_ids']) && !empty($_GET['all_elec_governor_make_ids']))
            {
                $filter_data['all_elec_governor_make_ids'] = $_GET['all_elec_governor_make_ids'];
            }
            if(isset($_GET['all_ih_actuator_make_ids']) && !empty($_GET['all_ih_actuator_make_ids']))
            {
                $filter_data['all_ih_actuator_make_ids'] = $_GET['all_ih_actuator_make_ids'];
            }
            if(isset($_GET['all_type_make_machine_ids']) && !empty($_GET['all_type_make_machine_ids']))
            {
                $filter_data['all_type_make_machine_ids'] = $_GET['all_type_make_machine_ids'];
            }
            if(isset($_GET['all_inch_make_model_controller_filter_ids']) && !empty($_GET['all_inch_make_model_controller_filter_ids']))
            {
                $filter_data['all_inch_make_model_controller_filter_ids'] = $_GET['all_inch_make_model_controller_filter_ids'];
            }


         if(isset($_GET['module_id']) && !empty($_GET['module_id']))
            {
                $filter_data['modules_for_filter'] = $_GET['module_id'];
            } 

           // pr($filter_data); 
       
        if(!empty($filter_data)){
            $result = $this->filters_mod->filters_all_module($filter_data,$is_export,$items_data);
        }
        $result =$result['result'];
            // pr($result);die;
        $table_columns = ["Client_Name"=>"Company Name","Company_Address"=>"Company Address","State_Name"=>"State","City_name"=>"City ","Contact_Name"=>"Contact Name","Mobile"=>"Mobile No.","Official_email_id"=>"Official Email-Id","Personal_Mobile"=>"Personal Mobile","Personal_Email"=>"Personal Email-Id"];
        $filename = "Filters-" . date('dmYhis'). ".xls";
        $this->export_lib->export($table_columns, $result, $filename); 
    } 


public function get_template_note()
{
  if($this->input->is_ajax_request())
  {
      $id = $_POST['id'];
      $note = $this->filters_mod->get_note_by_id($id);
      echo $note;die;
  }
}


}
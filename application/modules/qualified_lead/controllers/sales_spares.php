<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter qualified_lead Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Company
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Sales_Spares extends MY_Controller {
   
    private $data = array();
    public $table = 'leads_sales_spares';
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        isProtected();

        $this->load->model('sales_spares_mod');
		$this->load->model('user_group_mod');
        $this->load->model('company/company_mod');
		$this->load->model('opportunity/opportunity_mod');
        $this->load->model('product/product_mod');
        $this->lang->load('sales_spares', get_site_language());
               
        $this->data['head']['title'] = "Installation Base";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("qualified_lead/sales_spares");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "leads_sales_spares";

		$this->data['module'] = 'Installation Base/Sales Spares';
        $this->data['module_link'] = base_url("qualified_lead/sales_spares")."/list_items";
        
		//pr($this->data);die;
    }
    
   
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * This function add new Company
     * 
     * @access	public
     * @return	html data
     */
	public function add()
	{
		
	   if(isPostBack())
       {
            $id = $this->sales_spares_mod->add();
            if($id){
				//set_flashdata("success",lang('success'));
                redirect($this->data['base_url']."/list_items/");
            }else{
			   //redirect($this->data['base_url']."/add");
			  }
       }
	    $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "add";
	   $views[] = "sales_spares/lead_form";
	   $table_data = $this->sales_spares_mod->get_table_name();
		//pr($table_data);die;
	   foreach($table_data as $key=>$val){
		   if($val->form_name=='plc_dcs_make'){
            $table_name = 'inch_plc_dcs_make';
            $form_data ='';
            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='actuator_make'){
            $table_name = 'inch_actuator_make';
            $form_data ='';
            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='vfd_make'){
            $table_name = 'inch_vfd_make';
            $form_data ='';
            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
           }
			if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }
           if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='epc_company'){
			$table_name = 'inch_epc_company';
			$form_data ='';
			$this->data['epc_company'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_mill_make'){
			$table_name = 'inch_coal_mill_make';
			$form_data ='';
			$this->data['coal_mill_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan'){
			$table_name = 'inch_id_fan';
			$form_data ='';
			$this->data['id_fan'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan_motor_make'){
			$table_name = 'inch_id_fan_motor_make';
			$form_data ='';
			$this->data['id_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='fd_fan'){
			$table_name = 'inch_fd_fan';
			$form_data ='';
			$this->data['fd_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='boiler_make'){
			$table_name = 'inch_boiler_make';
			$form_data ='';
			$this->data['boiler_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='fd_fan_motor_make'){
			$table_name = 'inch_fd_fan_motor_make';
			$form_data ='';
			$this->data['fd_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_turbine_make'){
			$table_name = 'inch_spares_turbine_make';
			$form_data ='';
			$this->data['spares_turbine_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='pa_fan'){
			$table_name = 'inch_pa_fan';
			$form_data ='';
			$this->data['pa_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_generator_make'){
			$table_name = 'inch_spares_generator_make';
			$form_data ='';
			$this->data['spares_generator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='pa_fan_motor_make'){
			$table_name = 'inch_pa_fan_motor_make';
			$form_data ='';
			$this->data['pa_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfpt_make'){
			$table_name = 'inch_bfpt_make';
			$form_data ='';
			$this->data['bfpt_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='esp_make'){
			$table_name = 'inch_esp_make';
			$form_data ='';
			$this->data['esp_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='bfpm_make'){
			$table_name = 'inch_bfpm_make';
			$form_data ='';
			$this->data['bfpm_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='aph_make'){
			$table_name = 'inch_aph_make';
			$form_data ='';
			$this->data['aph_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfp_make'){
			$table_name = 'inch_bfp_make';
			$form_data ='';
			$this->data['bfp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vibration_system'){
			$table_name = 'inch_vibration_system';
			$form_data ='';
			$this->data['vibration_system'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfbp_make'){
			$table_name = 'inch_bfbp_make';
			$form_data ='';
			$this->data['bfbp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='btld_make'){
			$table_name = 'inch_btld_make';
			$form_data ='';
			$this->data['btld_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_make'){
			$table_name = 'inch_cep_make';
			$form_data ='';
			$this->data['cep_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_feeder_make'){
			$table_name = 'inch_coal_feeder_make';
			$form_data ='';
			$this->data['coal_feeder_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_motor_make'){
			$table_name = 'inch_cep_motor_make';
			$form_data ='';
			$this->data['cep_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='flame_scanner_make'){
			$table_name = 'inch_flame_scanner_make';
			$form_data ='';
			$this->data['flame_scanner_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
	   }
	   //$data = 'inch_epc_company';
	   //$query = "select form_data from inch_form where view_on_left = 1 AND status = 1";
	   //$result = mysql_query($query) or die(mysql_error());
	  // $res=mysql_fetch_assoc($result);
	   //pr($res);die;
	  $result = $this->sales_spares_mod->get($id);
      $this->data['row'] = $result;
	  
	  $this->data['submodule'] = 'Add Sales Spares';
	  $this->data['industry'] = $this->sales_spares_mod->get_industry();
	  $this->data['country'] = get_country_from_master();
	  $this->data['department'] = get_all_department_from_masters();
      $this->data['designation'] = get_all_designation_from_masters();
	  //pr($this->data);die;
       view_load($views,$this->data);
	}
    
    // ------------------------------------------------------------------------

    /**
     * View
     *
     * This function View Company Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
	public function view($id = NULL)
	{        
       $result = $this->sales_spares_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "sales_spares/view_lead"; 
	   $table_data = $this->sales_spares_mod->get_table_name();
		//pr($table_data);die;
	   foreach($table_data as $key=>$val){
		   if($val->form_name=='plc_dcs_make'){
            $table_name = 'inch_plc_dcs_make';
            $form_data ='';
            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='actuator_make'){
            $table_name = 'inch_actuator_make';
            $form_data ='';
            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='vfd_make'){
            $table_name = 'inch_vfd_make';
            $form_data ='';
            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
           }
			if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }
           if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='epc_company'){
			$table_name = 'inch_epc_company';
			$form_data ='';
			$this->data['epc_company'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_mill_make'){
			$table_name = 'inch_coal_mill_make';
			$form_data ='';
			$this->data['coal_mill_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan'){
			$table_name = 'inch_id_fan';
			$form_data ='';
			$this->data['id_fan'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan_motor_make'){
			$table_name = 'inch_id_fan_motor_make';
			$form_data ='';
			$this->data['id_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='fd_fan'){
			$table_name = 'inch_fd_fan';
			$form_data ='';
			$this->data['fd_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='boiler_make'){
			$table_name = 'inch_boiler_make';
			$form_data ='';
			$this->data['boiler_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='fd_fan_motor_make'){
			$table_name = 'inch_fd_fan_motor_make';
			$form_data ='';
			$this->data['fd_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_turbine_make'){
			$table_name = 'inch_spares_turbine_make';
			$form_data ='';
			$this->data['spares_turbine_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='pa_fan'){
			$table_name = 'inch_pa_fan';
			$form_data ='';
			$this->data['pa_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_generator_make'){
			$table_name = 'inch_spares_generator_make';
			$form_data ='';
			$this->data['spares_generator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='pa_fan_motor_make'){
			$table_name = 'inch_pa_fan_motor_make';
			$form_data ='';
			$this->data['pa_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfpt_make'){
			$table_name = 'inch_bfpt_make';
			$form_data ='';
			$this->data['bfpt_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='esp_make'){
			$table_name = 'inch_esp_make';
			$form_data ='';
			$this->data['esp_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='bfpm_make'){
			$table_name = 'inch_bfpm_make';
			$form_data ='';
			$this->data['bfpm_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='aph_make'){
			$table_name = 'inch_aph_make';
			$form_data ='';
			$this->data['aph_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfp_make'){
			$table_name = 'inch_bfp_make';
			$form_data ='';
			$this->data['bfp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vibration_system'){
			$table_name = 'inch_vibration_system';
			$form_data ='';
			$this->data['vibration_system'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfbp_make'){
			$table_name = 'inch_bfbp_make';
			$form_data ='';
			$this->data['bfbp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='btld_make'){
			$table_name = 'inch_btld_make';
			$form_data ='';
			$this->data['btld_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_make'){
			$table_name = 'inch_cep_make';
			$form_data ='';
			$this->data['cep_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_feeder_make'){
			$table_name = 'inch_coal_feeder_make';
			$form_data ='';
			$this->data['coal_feeder_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_motor_make'){
			$table_name = 'inch_cep_motor_make';
			$form_data ='';
			$this->data['cep_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='flame_scanner_make'){
			$table_name = 'inch_flame_scanner_make';
			$form_data ='';
			$this->data['flame_scanner_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
	   }
	   $note = $this->sales_spares_mod->get_notes($id);
	   $this->data['note'] = $note;
	   $appoitment = $this->sales_spares_mod->appointment_data();
       $this->data['appoitment'] = $appoitment;
	   $notes = $this->sales_spares_mod->notes();
	   $product = $this->sales_spares_mod->product();
	   $service = $this->sales_spares_mod->service();
	   $this->data['service'] = $service;
	   $this->data['product'] = $product;
	   $this->data['notes'] = $notes;
	   $this->data['submodule'] = 'View Sales Spares';
	   $this->data['leads_ids'] = $id;
	   $this->data['user_groups'] = $this->user_group_mod->get_groups();
	   $this->data['assign_user'] = $this->user_group_mod->get_users($result->group_id);
	   //pr($this->data);die;
	   view_report($id);
       view_load($views,$this->data);
	}
    
    
    // ------------------------------------------------------------------------

    /**
     * Edit
     *
     * This function Edit Company Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
	public function edit($id = NULL)
	{   	

		if(check_own_all_permission( ['id'=>$id], $this->table)==false)
        {
            set_flashdata("error", "You do not have permission.");
            return redirect(base_url('qualified_lead/sales_spares/list_items'));exit;
        }   
       if(isPostBack())
       {
           $r = $this->sales_spares_mod->update($id);
		   
            if($r){
                redirect($this->data['base_url']."/list_items/");
            }else{
                //redirect($this->data['base_url']."/edit/".$id);
			}
       }
       
       $result = $this->sales_spares_mod->get($id);
	   $table_data = $this->sales_spares_mod->get_table_name();
		//pr($table_data);die;
	   foreach($table_data as $key=>$val){
		   if($val->form_name=='plc_dcs_make'){
            $table_name = 'inch_plc_dcs_make';
            $form_data ='';
            $this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='actuator_make'){
            $table_name = 'inch_actuator_make';
            $form_data ='';
            $this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
           }
           if($val->form_name=='vfd_make'){
            $table_name = 'inch_vfd_make';
            $form_data ='';
            $this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
           }
			if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }
           if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='epc_company'){
			$table_name = 'inch_epc_company';
			$form_data ='';
			$this->data['epc_company'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_mill_make'){
			$table_name = 'inch_coal_mill_make';
			$form_data ='';
			$this->data['coal_mill_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan'){
			$table_name = 'inch_id_fan';
			$form_data ='';
			$this->data['id_fan'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='id_fan_motor_make'){
			$table_name = 'inch_id_fan_motor_make';
			$form_data ='';
			$this->data['id_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='fd_fan'){
			$table_name = 'inch_fd_fan';
			$form_data ='';
			$this->data['fd_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='boiler_make'){
			$table_name = 'inch_boiler_make';
			$form_data ='';
			$this->data['boiler_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='fd_fan_motor_make'){
			$table_name = 'inch_fd_fan_motor_make';
			$form_data ='';
			$this->data['fd_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_turbine_make'){
			$table_name = 'inch_spares_turbine_make';
			$form_data ='';
			$this->data['spares_turbine_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='pa_fan'){
			$table_name = 'inch_pa_fan';
			$form_data ='';
			$this->data['pa_fan'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='spares_generator_make'){
			$table_name = 'inch_spares_generator_make';
			$form_data ='';
			$this->data['spares_generator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='pa_fan_motor_make'){
			$table_name = 'inch_pa_fan_motor_make';
			$form_data ='';
			$this->data['pa_fan_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfpt_make'){
			$table_name = 'inch_bfpt_make';
			$form_data ='';
			$this->data['bfpt_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='esp_make'){
			$table_name = 'inch_esp_make';
			$form_data ='';
			$this->data['esp_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='bfpm_make'){
			$table_name = 'inch_bfpm_make';
			$form_data ='';
			$this->data['bfpm_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='aph_make'){
			$table_name = 'inch_aph_make';
			$form_data ='';
			$this->data['aph_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfp_make'){
			$table_name = 'inch_bfp_make';
			$form_data ='';
			$this->data['bfp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vibration_system'){
			$table_name = 'inch_vibration_system';
			$form_data ='';
			$this->data['vibration_system'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='bfbp_make'){
			$table_name = 'inch_bfbp_make';
			$form_data ='';
			$this->data['bfbp_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='btld_make'){
			$table_name = 'inch_btld_make';
			$form_data ='';
			$this->data['btld_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_make'){
			$table_name = 'inch_cep_make';
			$form_data ='';
			$this->data['cep_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='coal_feeder_make'){
			$table_name = 'inch_coal_feeder_make';
			$form_data ='';
			$this->data['coal_feeder_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='cep_motor_make'){
			$table_name = 'inch_cep_motor_make';
			$form_data ='';
			$this->data['cep_motor_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='flame_scanner_make'){
			$table_name = 'inch_flame_scanner_make';
			$form_data ='';
			$this->data['flame_scanner_make'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
	   }
	   $notes = $this->sales_spares_mod->get_notes($id);
	   $this->data['notes'] = $notes;
	   //pr($result);die;
	   $this->data['row'] = $result;
	   $this->data['industry'] = $this->sales_spares_mod->get_industry();
	  $this->data['country'] = get_country_from_master();
	  $this->data['state'] = get_state_from_master_acord_country($result->country);
	  $this->data['city'] = get_city_from_master_acord_state($result->state_comp);
	  //pr($this->data['state']);die;
	  $this->data['department'] = get_all_department_from_masters();
      $this->data['designation'] = get_all_designation_from_masters();
       $this->data['action'] = "edit";
       $views[] = "sales_spares/lead_form";

	   $this->data['submodule'] = 'Edit Sales Spares';
	   //pr($this->data);die;
	   view_load($views,$this->data);
	   
	}
    
    // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all Company list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
	{  
         
		$views[] = "sales_spares/lead_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->sales_spares_mod->get_flexigrid_cols();

        $this->data['grid']['base_url'] = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;
        
        //check session offset
        if($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
		/*Getting user by filter options*/
		if($this->input->post('user'))
		{
			$user=$this->input->post('user');
		}else if($this->input->get('user'))
		{
			$user=$this->input->get('user');
		}
		if($user)
		{
			//echo $user;die;
			if(!is_array($user)){
				$is_all = 'yes';
				$data['user_id']	=	$user;
				if(!isset($user) || !$user){
					$user=currentUserID();
				}else{
					$is_all = 'no';
				}
				if($user=='all_sm'){
				   $user=array(); 
				   $usersList=usersList(SALES_MANAGER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_sp'){
				   $user=array(); 
				   $usersList=usersList(SALES_PERSON);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_tm'){
				   $user=array(); 
				   $usersList=usersList(TELE_MARKETER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}
				if(_isTaleMarketer() || _isSalesPerson()){
					$user= currentUserID();    
				}
			}else{
				echo "asdasd";die;
			}
		}else{
			$added_by =  '';
			$is_all	=	'';		/*This is for initial land of dashboard*/
		}
        $this->data['user'] = $user;
		
		
		
		
        $text = $this->input->post('text');
        $limit=@$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset=1;
        $order_by='id';
        $order='desc';
        $result =  $this->sales_spares_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$user);
		//pr($result);
		$priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $row) { 
            if (!empty($row->display_id)) {
                $row->display_id = '<a href="'.base_url().'qualified_lead/sales_spares/view/'.$row->id.'">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
				//$row->display_id = '<a href="#">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
            } 
			
			if (!empty($row->assigned_telemarketer)) { // for assign telemarketer value
                    $name = @get_user_data($v[$val['name']])->first_name . ' ' . @get_user_data($v[$val['name']])->last_name;
                    $result[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                } else {
                    $result[$k][$val['name']] = $v[$val['name']];
                }
				
				if (!empty($row->contact_name)) {
                    //$companyContact = _contactPersonById($row->company_contact);
                    $row->contact_name = ucwords($row->contact_name); //@$companyContact->contact_person;
                }
				
				/*if ($row->lead_status==2 || $row->lead_status) {
                    $status = _getLeadStatus($row->lead_status);
                    $row->lead_status = ucwords($status); //@$companyContact->contact_person;
                }
				
				if ($row->company_name==0 || $row->company_name) {
                   $row->company_name = @_companyNameById($row->company_name);
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->priority==0 || $row->priority) {
                   $row->priority = @$priority[$row->priority];
                    //@$companyContact->contact_person;
                }
				
				/*if ($row->added_by==0 || $row->added_by) {
                   $row->added_by = $row->ADDED_BY;
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->referral_source==0 || $row->referral_source) {
                   $row->referral_source = @$referalSource[$row->referral_source];
                    
                }
				
				if ($row->modified_time==0 || $row->modified_time) {
                   $row->modified_time = date("d-M-Y ",strtotime($row->modified_time));
                    
                }
				
				if ($row->follow_up_date==0 || $row->follow_up_date) {
                   $row->follow_up_date = formatDate(_latestFollowUpDate($row->follow_up_date));
				   
				    $followupdate = date('d-m-Y',strtotime($row->follow_up_date));
			        if($followupdate=='01-01-1970'){
                        $row->follow_up_date='N/A';
                    }
                    
                }
			
			
        }
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
       
        $this->data['submodule'] = 'Sales Spares List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->sales_spares_mod->perPage($user->id);
       
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->sales_spares_mod->insert_perPage($pageArr);
        }

       
        if($this->input->post("order_by")) {
            $order_by = $this->input->post("order_by");
        }else{
            $order_by = 'id';
        }
        if($this->input->post("order")) {
            $order = $this->input->post("order");
        }else{
            $order = 'desc';
        }
        $offset = $this->input->post("offset");
        if(!$offset){
            $offset =1;
        }
        if(!$limit) {
            $limit = 10;
        }
        if($this->input->post("limit")) {
            $limit = $this->input->post("limit");
            $this->data["hiddenLimit"] = $limit;
        }
        if($this->input->post('text')) {
            $text = $this->input->post('text');
        } else {
            $text = null;
        }
        
        $data = $this->sales_spares_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
       
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->sales_spares_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];

        $this->load->view('kg_grid/ajax_grid', $data);
       
  
	}
    
    
     // ------------------------------------------------------------------------

    /**
     * Export items
     *
     * This function display Export by id
     * 
     * @access	public
     * @return	html data
     */
    
    public function export()
    {
       $items          =$this->input->get_post('items',TRUE);
       $items_data     = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);
       $data = $this->company_mod->export();

       export_report($items_data);
       array_to_csv($data,"Company.csv");
    }
    
    
  // ------------------------------------------------------------------------

    /**
     * delete items
     *
     * This function display delete by id
     * 
     * @access	public
     * @return	html data
     */
    
    public function delete()
    {
       $items           = $this->input->get_post('items',TRUE);
       $items_data      = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);      
       
       $this->db->where_in("id",$items_data);
       filter_data();
       $this->db->delete($this->table_name);
       delete_report($items_data);
    }
	
	
	/**
     * get company name suggestion
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
   public function get_company_suggestion()
    {
	   $this->session->unset_userdata("key");
       $comp_text           = $this->input->get_post('query',TRUE);
	   
	   if(!empty($comp_text)){
		   $this->db->select("com.*,plc.*,act.*,vfd.*");
		   $this->db->join('lead_sales_pcb_common_plc as plc','plc.lead_id =com.id','left');
		   $this->db->join('lead_sales_pcb_common_actuator as act','act.lead_id =com.id','left');
		   $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.lead_id =com.id','left');
		   $this->db->where("(com.name like '%".$comp_text."%')");
		   $query = $this->db->get('companies as com');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->result();
			    $output = ''; 
				$output = '<ul class="list-unstyled">';
				foreach($result as $val){
					$output .= '<li class="suggestion"><a>'.ucwords($val->name).'</a></li>'; 
				}
				$output .= '</ul>';  
				echo $output;  
		   }
	   }
    }
	
	
	/**
     * get All company Data
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_company_all_data()
    {
       $comp_text           = $this->input->get_post('company_name',TRUE);
	  
	   if(!empty($comp_text)){
		   $this->db->select("com.*,plc.plc_dcs_qty,inch_plc.name as plc_name,act.actuator_qty,inch_act.name as actuator_name,vfd.vfd_qty,inch_vfd.name as vfd_name");
		   $this->db->join('lead_sales_pcb_common_plc as plc','plc.lead_id =com.id','left');
		   $this->db->join('inch_plc_dcs_make as inch_plc','inch_plc.form_id =plc.plc_dcs_make','left');
		   $this->db->join('lead_sales_pcb_common_actuator as act','act.lead_id =com.id','left');
		   $this->db->join('inch_actuator_make as inch_act','inch_act.form_id =act.actuator_make','left');
		   $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.lead_id =com.id','left');
		   $this->db->join('inch_vfd_make as inch_vfd','inch_vfd.form_id =vfd.vfd_make','left');
		   $this->db->where("com.name",$comp_text);
		   $query = $this->db->get('companies as com');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->row();
			   
			    $output = ''; 
				
				$output = $result; 
				///$this->session->set_userdata("key",$output->id);
				//pr($this->session->userdata("key"));
				echo json_encode($output);  
		   }
	   }
    }
	
	// ------------------------------------------------------------------------
	
	/**
     * get contact name suggestion
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_contact_suggestion()
    {
       $cont_text           = $this->input->get_post('query',TRUE);
	   $company_id = $this->input->get_post('company_id',TRUE);
	   if(!empty($cont_text)){
		   $this->db->select("primary_phone");
		   $this->db->where("(companies_contact.primary_phone like '%".$cont_text."%' )");
		   $query = $this->db->get('companies_contact');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->result();
			    $output = ''; 
				$output = '<ul class="list-unstyled">';
				foreach($result as $val){
					$output .= '<li class="suggestion_cont"><a>'.ucwords($val->primary_phone).'</a></li>'; 
				}
				$output .= '</ul>';  
				echo $output;  
		   }
	   }
    }
	
	
	/**
     * get All company Data
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_contact_all_data()
    {
       $comp_contact           = $this->input->get_post('company_contact',TRUE);
	   $company_id = $this->input->get_post('company_id',TRUE);
	   
	   if(!empty($comp_contact)){
		   $this->db->select("*");
		   $this->db->where("primary_phone",$comp_contact);
		   $query = $this->db->get('companies_contact');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->row();
			   
			    $output = ''; 
				
				$output = $result;  
				echo json_encode($output);  
		   }
	   }
    }
	
	// ------------------------------------------------------------------------

    /**
     * Fetch State 
     *
     * This function Fetch All State by Country id
     * 
     * @access	public
     * @return	html data
     */
    
    public function fetch_state_according_country()
    {
       $id          = $this->input->get_post('id',TRUE);
		
		if(!empty($id)){
			echo $data['value'] = $this->company_mod->fetch_state($id);
		}else{
			return false;
		}
    }
	
	/**
     * Fetch City 
     *
     * This function Fetch All City by State id
     * 
     * @access	public
     * @return	html data
     */
    
    public function fetch_city_according_country()
    {
       $id          = $this->input->get_post('id',TRUE);
		
		if(!empty($id)){
			echo $data['value'] = $this->company_mod->fetch_city($id);
		}else{
			return false;
		}
    }
     
	public function checkVendorCodeExistence() {
        is_ajax_request();
        $vendor_code = $this->input->post('vendor_code', true);
        $result = $this->sales_spares_mod->check_vendor_code_existance($vendor_code);
        //pr($result);die;
        if ($result == true)
            echo true;
    }

     /**
     * installation_view_notes
     *
     * This function show installation view notes
     * 
     * @access	public
     * @return  json array 
     */
	  public function addNote() {
		//pr(strtolower($this->uri->segment(2)););die;
	  $this->form_validation->set_rules('notes', 'notes', "trim|required"); 
	  if($this->form_validation->run() == FALSE)
		  {
			  set_flashdata("error",validation_errors());
			  return FALSE;
		  }
	  else{
	  $data['module'] = strtolower($this->uri->segment(2));
	  $data['lead_id'] = $_POST['lead_id'];
	  $data['notes'] = $_POST['notes'];
	  $data['created_time'] = date('Y-m-d H:i:s');
	  }
	  //pr($data);die;
	  $this->db->insert('installation_view_notes', $data);
	  // pr($this->db->last_query());die;
	 return redirect(base_url("qualified_lead/sales_spares")."/view/".$_POST['lead_id']);
  }
   /**
     * Qualified Sales Spares
     *
     * This function show Sales Spares
     * 
     * @access	public
     * @return  json array 
     */
	public function disqualified_form() {
	  $id = $_POST['lead_id'];
	  
	  $data['disqualified_reason'] = $_POST['disqualified_reason'];
	  $data['lead_status'] = '1';
	  set_common_update_value();
	  $this->db->where('id',$id);
	  $this->db->update('leads_sales_spares', $data);
	  //pr($this->db->last_query());die;
	  return redirect(base_url("qualified_lead/sales_spares")."/list_items");
  }
    
	/**
     * Add Product
     *
     * This function show Product
     * 
     * @access	public
     * @return  json array 
     */
	public function addproduct() {
		$id = $_POST['lead_id'];
		
		$data['product'] = $_POST['product'];
		$this->db->where('id',$id);
		$this->db->update('leads_sales_spares', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('qualified_lead/sales_spares/list_items'));
	}
	
	/**
     * Add Product
     *
     * This function show Product
     * 
     * @access	public
     * @return  json array 
     */
	public function addservice() {
		$id = $_POST['lead_id'];
		
		$data['service'] = $_POST['service'];
		$this->db->where('id',$id);
		$this->db->update('leads_sales_spares', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('qualified_lead/sales_spares/list_items'));
	}
	/**
     * Assign Opportunity
     *
     * This function assign opportunity
     * 
     * @access	public
     * @return  json array 
     */
	public function assignopportunity() {
		$id = $_POST['lead_id'];
		
		$data['group_id']    = $this->input->post('assign_group',TRUE);
		$data['added_by']            = $this->input->post('assign_user',TRUE);
		$this->db->where('id',$id);
		$this->db->update('leads_sales_spares', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('qualified_lead/sales_spares/list_items'));
	}
	
	public function remove_client_doc() {

		if(isset($_GET['leads_sales_spares_doc_id']) && !empty($_GET['leads_sales_spares_doc_id']) && is_numeric($_GET['leads_sales_spares_doc_id']))
		{
			$leads_sales_spares_doc_id = $_GET['leads_sales_spares_doc_id'];
			$this->db->select('filename');
			$this->db->where('id',$leads_sales_spares_doc_id);
			$record = $this->db->get("leads_sales_spares_doc")->row();
			if(isset($record->filename) && !empty($record->filename))
			{
				unlink(FCPATH.'upload/sales_spares/'.$record->filename);
				$this->db->where('id',$leads_sales_spares_doc_id);
				$this->db->delete('leads_sales_spares_doc');
				echo json_encode(['status'=>1,'message'=>'Document removed.']);
			}
			else
			{
				echo json_encode(['status'=>0,'message'=>'Document not found.']);
			}
		}
		else
		{
			echo json_encode(['status'=>0,'message'=>'Document did not remove.']);
		}
	}
	
	public function checkNameExistence() {
		//pr("yess");die;
		is_ajax_request();
		
        $company_text = $this->input->get_post('company_name', true);
        $id = $this->input->get_post('id', true);
		$result = $this->sales_spares_mod->check_name_existance($company_text,$id);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
}

    
 
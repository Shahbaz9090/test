<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Controller
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Location extends CI_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->model('location_mod');
        $this->lang->load('user', get_site_language());
               
        $this->data['head']['title'] = "User";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("user/location");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "users";

		$this->data['module'] = 'User';
		$this->data['module_link'] = base_url("user")."/list_items";
        $this->data['submodule'] = 'Location List';

        
    }
    // ------------------------------------------------------------------------
	function ajax_list_items(){
		$this->data['company_locations']  = $this->location_mod->company_location_list();
		$this->load->view("ajax_location",$this->data);
	}
	function list_items(){
		$this->data['company_locations']  = $this->location_mod->company_location_list();
		$view[]="location_list";
		view_load($view,$this->data);
	}
	function set_location(){
		$ajax_submit=$this->input->post("is_submit",true);
		if($ajax_submit==1){
			$result=$this->location_mod->set_location($this->input->post("id",true));
			if($result["response"]==1){
				echo "1";
			}else if($result["response"]==2){
				echo "2";
			}else{
				echo $result["error"];
			}
		}else{
			$locationData=$this->location_mod->get_location($this->input->post("id",true));
			$country=array("1"=>"United State","106"=>"India");
			$response = "<div class='row-fluid'>
				<div class='span12'>
					<label class='span3'><h4>Country</h4></label>
					<select name='country' id='country' class='span5 required nostyle'><option value=''>Select</option>";
						foreach($country as $k=>$v){
							if($k==@$locationData->country_id){
								$response .= "<option value='$k' selected='true'>$v</option>";
							}else{
								$response .= "<option value='$k'>$v</option>";
							}
						}
				$response .= " </select>
				</div>
			</div>";

			$response .= "<div class='row-fluid'>
				<div class='span12'>
					<label class='span3'><h4>Company Area</h4></label>
					<input type='text' name='area_name' id='area_name' value='".@$locationData->area_name."' class='required span5'>
				</div>
			</div>";
			echo $response;
		}

	}

	function delete_location(){
		$id=$this->input->post("id",true);
		$this->db->delete("company_areas",array("id"=>$id));
		$this->data['company_locations']  = $this->location_mod->company_location_list();
		$this->load->view("ajax_location",$this->data);
	}

}
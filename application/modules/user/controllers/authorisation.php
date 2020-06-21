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
 
class Authorisation extends MY_Controller {
   
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
        $this->load->model('authorisation_mod');
		$this->load->library('pagination');
        $this->lang->load('user', get_site_language());
               
        $this->data['head']['title'] = "User";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("user");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "users";

		$this->data['module'] = 'User';
		$this->data['module_link'] = base_url("user")."/list_items";
        $this->data['submodule'] = 'Authorozation List';

    }
    
	function list_items(){
		$config["base_url"]    = SITE_PATH."user/authorisation/list_items/";
		$config["per_page"]    = 20;
		$config["uri_segment"] = 4;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$count=$this->authorisation_mod->list_items();
		$config["total_rows"]=$count["total"];
		$this->pagination->initialize($config);
		$this->data["links"] = $this->pagination->create_links();
		$result=$this->authorisation_mod->list_items($page,$config["per_page"]);//param 1.list_type 2. offset 3.perpage
		$this->data["result"]=$result["result"];
		$views[] = "authorisation_list";
        view_load($views,$this->data);
	}

	function edit($id=null){
		if(isPostBack()){
			//pr($_POST);die;
			$data=$this->authorisation_mod->update();
			if($data["response"]){
				echo "1";
			}else{
				echo $data["error"];
			}
		}

	}

	function ajax_list_items(){
		$list_type=$this->input->post("login_type");
		$offset=$this->input->post("offset");
		$offset_list=$offset;
		if($offset==''){
			$offset_list=0;
		}else if($offset >0){
			$offset_list=$offset-1;
		}
		$config["base_url"]    = SITE_PATH."user/authorisation/ajax_list_items/";
		$config["per_page"]    = 20;
		$config["uri_segment"] = 4;
		$page = $config["per_page"] * $offset_list;
		
        $keyword = $this->input->post('keyword');
		$result=$this->authorisation_mod->list_items($page,$config["per_page"],$list_type,$keyword);
		
		$this->data["result"]=$result["result"];
		$this->data['page_offset'] = $offset; 
		$this->data['limit'] = $config["per_page"];
        $this->data['total'] = $result['total'];
        $this->data['page'] = $result['total'];

        $this->data['url'] = base_url("user/");
        $this->data['perpage'] = $config["per_page"];
		$this->load->view("ajax_authorisation_list",$this->data);
	}

	
    
}
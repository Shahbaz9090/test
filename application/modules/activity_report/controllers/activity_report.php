<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter activity_report Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	activity_report
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @activity_report     Tekshapers Inc
 * @since		Version 1.0
 */
 
class  Activity_report extends MY_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
		//echo "yess";die;
        isProtected();
        $this->load->model('activity_report_mod');
        $this->lang->load('activity_report', get_site_language());
               
        $this->data['head']['title'] = "Activity Report";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("activity_report");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "report";

		$this->data['module'] = 'Activity Report';
        $this->data['module_link'] = base_url("activity_report")."/list_items";
        
    }
    
    
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * This function add new activity_report
     * 
     * @access	public
     * @return	html data
     */
	
    
    // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all activity_report list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
    {   
        //pr("yess");die;
        /*Pagination*/
        $config['base_url']     = $this->data['base_url']."/list_items/";
        $config['per_page']     = PERPAGE;
        $config["uri_segment"]  = 3;
        
        if( count($_GET) > 0 )
        {
            $query_string_url               = '?'.http_build_query($_GET, '', "&");
            $config['enable_query_string']  = TRUE;
            $config['suffix']               = $query_string_url;
            $config['first_url']            = $config["base_url"].$config['suffix'];
        }
        $config['full_tag_open']    = '<ul class="pagination pagination-sm">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = FALSE;
        $config['last_link']        = FALSE;
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo;';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo;';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        
        $page       = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $this->data['total_pages']   = $page;
        $response   = $this->activity_report_mod->get_report_list('', PERPAGE, $page, null);
        
		$this->data['data_list']   = $response['result'];
        $this->data['total_record']= $response['total'];
        $config['total_rows']         = $response['total'];
        // pr($response);die;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->data['pagination_link']   = $this->pagination->create_links();
        /*Pagination*/
        
        $this->data['place_holder']  = "Enter filter terms here";        
        $this->data['action']        = "list";
        $this->data['title']         = $this->submodule;
        $this->data['action_data']   = get_action_data();
        $this->data['all_module']   = get_all_modules();
        $views[]                        = 'activity_report_list';
        //pr($this->data);die;
        view_load($views, $this->data);
    }
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->activity_report_mod->perPage($user->id);
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->activity_report_mod->insert_perPage($pageArr);
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
        
        $data = $this->activity_report_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $permission=_check_perm();
       // pr($data);die;
        foreach ($data['result'] as $row)
        {

             $row->name = ucwords($row->name); //@$activity_reportContact->contact_person;
                $row->industry_name = ucwords($row->industry_name);
				$row->country_name = ucwords($row->country_name);
				$row->state_name = ucwords(strtolower($row->state_name));
				$row->city_name = ucwords(strtolower($row->city_name));
				if($row->type_of_establishment!=0){
					$row->type_of_establishment = ucwords(strtolower($row->type_of_establishment_name));
				}else{
						$row->type_of_establishment = '-/-';
				}
				
				if($row->type_of_client!=0){
					$row->type_of_client = ucwords(strtolower($row->type_client_name));
				}else{
						$row->type_of_client = '-/-';
				}
				
				//pr($row->name);die;
				
			if ($row->status == '0')
            {
                $row->status = "Inactive";
            } else
            {
                $row->status = "Active";
            }  
                
            if($row->added_by == $user->id && ($permission != '1' && $permission !='' ))
            {
                $row->status =  $row->status;
				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
            //$cityResult = viewCity($row->city);
			//pr($cityResult);die;
            //$row->city = @$cityResult->cityName;
        }
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->activity_report_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];

        $this->load->view('kg_grid/ajax_grid', $data);
       
  
	}
    
     public function export()
	 {
		$this->load->library('export_lib');
		//$text          = $this->input->get_post('text',TRUE);
		$is_export = true;
		
		//pr($items);die;
		$result = $this->activity_report_mod->get_report_list(null,null,null,$is_export);
		//pr($result);die;
		
		$result =$result['result'];
        //pr($result);die;
		foreach($result as $key=>$val){  
			if($val->action=='103'){ 
				$val->action = 'Add';
			}
			if($val->action=='102'){
				$val->action = 'Edit';
			}
			if($val->action=='101'){
				$val->action = 'View';
			}
			if($val->action=='104'){
                $val->action = 'Delete';
            }
            if($val->action=='105'){
                $val->action = 'Export';
            }
            if($val->action=='106'){
                $val->action = 'Import';
            }
            
		}
		//pr($result);die;
		$table_columns = ["uri"=>"Module","action"=>"Action","username"=>"Added By", "created_time"=>"Date"];
		$filename = "Activity Report-" . date('dmYhis'). ".xls";
		
        //pr($table_columns);
		//pr($filename);
		//pr($result);die;
		$this->export_lib->export($table_columns, $result, $filename); 
     }
			
}

    
 
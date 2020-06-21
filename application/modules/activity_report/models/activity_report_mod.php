<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		
 * @subpackage	Models
 * @category	Company
 * @author		Prabhakar Ram
 * @website		http://www.onlienprabhakar.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class  Activity_report_mod extends CI_Model {

    public $table     = "report";
	public $per_page  = "per_page";
   
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
       
    }
    
    // ------------------------------------------------------------------------

    /**
     * Add Company
     *
     * This function Add Company
     * 
     * @access	public
     * @return	mixed Array 
     */     
    
    

    // ------------------------------------------------------------------------

    public function get_report_list($count='', $limit='', $start='', $is_export=false)
    {
        $this->db->select("SQL_CALC_FOUND_ROWS e.*,users.first_name,users.last_name,CONCAT(users.first_name,' ',users.last_name) as username",FALSE);
        $this->db->join('users' ,'users.id=e.added_by');
        //pr($count); 
        //pr($limit); 
        //pr($start);die;
       // $status = $this->input->get('status');
        //$search = $this->input->get('search');
        ///$email = $this->input->get('email');
        $action = $this->input->get_post('action');
        $date_range = $this->input->get_post('date_range');
        $modules  = $this->input->get_post('modules');
        if($is_export==true){ 
			$checkbox  = $this->input->get_post('checkbox_id');
			$checkbox_id     = str_replace("row","",$checkbox);       
			$checkbox_id      = explode(",",$checkbox_id);
            if(!empty($checkbox_id['0']))
			{   
				$this->db->where_in('e.id', $checkbox_id);
			}
        }
		if(isset($action) && $action!='')
		{   
			$this->db->where_in('action', $action);
		}
		if($date_range!='undefined' && !empty($date_range)){ 
				
			$date_range = explode(' - ',$date_range);
			$from = $date_range['0'];
			$to   = $date_range['1'];
			$from = date("Y-m-d", strtotime($from));
			$to = date("Y-m-d", strtotime($to));
			//pr($from);
            //pr($to);die;
			$this->db->where("e.created_time BETWEEN  '$from' AND '$to'");
		}
        if(isset($modules) && $modules!=''){
			$this->db->where_in("Substr(uri,1, (INSTR(uri, '/')- 1))",$modules);
		}
		if ($limit != "" && $start != "") {
                $this->db->limit($limit, $start);
            }
        if($limit != '' && $start == '' && $count == '')
        {
            
            $this->db->limit(PERPAGE, 0);
        }
        $this->db->order_by('id', "DESC");
        $query = $this->db->get($this->table .' AS e');
        $data['result'] = $query->result();
        //echo $this->db->last_query();exit;
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"]  = $query->row()->count;
        //pr($data);die;
        return $data;
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Ajax Companies
     *
     * This function Get Companies with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */     
    function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc') {
		
        $offset = ($offset - 1) * $limit;

        $this->db->limit($limit, $offset);
        $text=strtolower(trim($text));

        if($text) {
            $this->db->like("CONCAT(companies.name,companies.website,companies.client_id,co.country_name,st.state_name,ct.city_name,ind.name)",
                $text);
        }

        if($order_by && $order)
            $this->db->order_by($order_by, $order);

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        filter_data($this->table);   // c is alias of companies   
        //$query = $this->db->get();
       // pr($query->result());exit;
        // echo $this->db->last_query();exit;
		
		$this->db->select('SQL_CALC_FOUND_ROWS companies.id as ids,companies.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name,tc.name as type_client_name,cte.name as type_of_establishment_name',false);
		$this->db->from('companies');
		$this->db->join("industry ind" , 'companies.industry=ind.id',"left");
		$this->db->join("countries co" , 'co.id=companies.country',"left");
		$this->db->join("states st" , 'st.id=companies.state_comp',"left");
		$this->db->join("cities ct" , 'ct.id=companies.city_comp',"left");
		$this->db->join("inch_client_type_establishment cte" , 'cte.form_id=companies.type_of_establishment',"left");
		$this->db->join("inch_type_of_client tc" , 'tc.form_id=companies.type_of_client',"left");
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		//$this->db->select("id,name as industry_name");
		//$this->db->order_by("name","asc");
       // $query1 = $this->db->get("industry");
		//$data['industry'] = $query1->result();
        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
		//pr($data);die;
        return $data;
    }
    
    
    
    
    
}
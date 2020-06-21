<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class User_mod extends CI_Model {
  
    var $table = "site";
    var $user_table = "users";
    var $group_table = "user_groups";
    var $permission_table = "user_group_permissions";
	var $per_page = "per_page";
    
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }    
    
    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function Add User
     * 
     * @access	public
     * @return	int or Boolean
     */     
    function add()
    {
        
        $this->form_validation->set_rules('group_id', lang('group_name'), 'trim|required');
		$this->form_validation->set_rules('first_name', lang('first_name'), "trim|required");
        $this->form_validation->set_rules('last_name', lang('last_name'), "trim|required");
        $this->form_validation->set_rules('email', lang('email'), "trim|required|is_unique[$this->user_table.email]");
        $this->form_validation->set_rules('password', lang('password'), 'required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password|min_length[6]'), 'required');
        $this->form_validation->set_rules('status', lang('status'), "trim|required");
        
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
      // pr($_POST);exit;
                
        $data['group_id']           =  $this->input->post('group_id',TRUE);
        $data['parent_user_id']     = $this->input->post('parent_user_id',TRUE);
        $data['first_name']         = $this->input->post('first_name',TRUE);
        $data['last_name']          = $this->input->post('last_name',TRUE);
        $data['email']              = $this->input->post('email',TRUE);
        $data['password']           = md5($this->input->post('password',TRUE));
        $data['status']             = $this->input->post('status',TRUE);
        $data['status_comment']     = $this->input->post('status_comment',TRUE);
        $data['ip_based']     		= $this->input->post('ip_based',TRUE);
        set_common_insert_value();
        
       
        $this->db->insert($this->user_table,$data);           
        $id = $this->db->insert_id();
        add_report($id);
        set_flashdata("success",lang('success'));
        return $id;
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get User
     *
     * This function Get User by User id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {   
        
        filter_data($this->user_table);
        $this->db->where('id',$id);
        $query = $this->db->get($this->user_table);
		//echo $this->db->last_query();exit;
        if($query->num_rows() > 0)
        return $query->row();
           
   
        show_404();
    }
    
    
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Groups
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */     
    function get_groups($id=null)
    {   
        $this->db->where("site_id",current_site_id());
		
        $query = $this->db->get($this->group_table);
		//echo $this->db->last_query();exit;
        return $query->result();
    }
    
     // ------------------------------------------------------------------------

    /**
     * Get Parent Groups
     *
     * This function Get parent group data
     * 
     * @access	public
     * @return	Object 
     */     
    function get_parent_groups($id=null)
    {   
        $this->db->where("site_id",current_site_id());
        $this->db->where_in("id",$id);  
       
        $query = $this->db->get($this->group_table);
		//echo $this->db->last_query();exit;
        return $query->result();
    }


	 // ------------------------------------------------------------------------

    /**
     * View Groups
     *
     * This function View Users Groups
     * 
     * @access	public
     * @return	Object 
     */     
    function view_groups($id=null)
    {   
		if($id!=null){
			$this->db->where("id",$id);
		}
		
        $query = $this->db->get($this->group_table);		
        return $query->row();
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Users
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */     
    function get_users($group_id =NULL)
    {   
        $this->db->where("id",$group_id);
        $group_parent = $this->db->get($this->group_table);
        
        $group_id_list  = $group_parent->row()->parent_group_id;
        
        $this->db->where("group_id",$group_id_list);
		$this->db->where("status","active");
	    $this->db->where("site_id",currentuserinfo()->site_id);
		
		filter_data($this->user_table);
        $query = $this->db->get($this->user_table);
        return $query->result();
    }

    
    
	
	
	
	 //----------------------------------------------------------------------------------
     /**
     * Update User
     *
     * This function User Status Update
     * 
     * @access	public
     * @return	int 
     */     
    function user_status_update($id = NULL) {       
        $this->form_validation->set_rules('status_comment', lang('status_comment'), "trim|required");
        if ($this->form_validation->run() == FALSE){
			return false;
        }
        $data['status']             = $this->input->post('status',TRUE);
        $data['status_comment']     = $this->input->post('status_comment',TRUE);
        $data['ip_based']     		= $this->input->post('ip_based',TRUE);
        filter_data($this->user_table);
        set_common_update_value();
        $this->db->where("id",$id);
        $this->db->update($this->user_table,$data);
        update_report($id);
        return true;
    }
	
	
    //----------------------------------------------------------------------------------
     /**
     * Update User
     *
     * This function Update User
     * 
     * @access	public
     * @return	int 
     */     
    function update($id = NULL)
    {
        $this->form_validation->set_rules('group_id', lang('group_name'), 'trim|required');
		$this->form_validation->set_rules('first_name', lang('first_name'), "trim|required");
        $this->form_validation->set_rules('last_name', lang('last_name'), "trim|required");
        $this->form_validation->set_rules('email', lang('email'), "trim|required");
        $this->form_validation->set_rules('status', lang('status'), "trim|required");
        
        
        $password          = $this->input->post('password',TRUE);
        if($password != "")
        {
        $this->form_validation->set_rules('password', lang('password'), 'required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password|min_length[6]'), 'required');
        $data['password']           = md5($this->input->post('password',TRUE));
        }
         
        
        
        if ($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['group_id']           = $this->input->post('group_id',TRUE);
        $data['parent_user_id']     = $this->input->post('parent_user_id',TRUE);
        $data['first_name']         = $this->input->post('first_name',TRUE);
        $data['last_name']          = $this->input->post('last_name',TRUE);
        $data['email']              = $this->input->post('email',TRUE);
        $data['status']             = $this->input->post('status',TRUE);
        $data['status_comment']     = $this->input->post('status_comment',TRUE);
        $data['ip_based']     		= $this->input->post('ip_based',TRUE);
        filter_data($this->user_table);
        set_common_update_value();
        
        
        $this->db->where("id",$id);
        $r = $this->db->update($this->user_table,$data);
        update_report($id);
        
        if($r)
            set_flashdata("success",lang('updated'));
                    
        return $r;
    }
    
    
    
     // ------------------------------------------------------------------------

    /**
     * Get Ajax User
     *
     * This function Get User with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */     
    function ajax_list_items($search_by=FALSE,$keyword = FALSE,$sortname = 'id',$sortorder = 'asc',$rp = 20,$page = 1)
    {  
        $offset = ($page - 1) * $rp;
      
        $this->db->limit($rp,$offset);
        
        if($search_by && $keyword )
        {
            if($search_by != "global_search")
                $this->db->like("lower($search_by)",strtolower($keyword));
            else
            {
               $this->db->like("CONCAT(lower($this->user_table.first_name),lower($this->user_table.last_name),lower($this->user_table.email),lower($this->user_table.status))",strtolower($keyword)); 
            }
        }
            
        
        if($sortname && $sortorder)    
            $this->db->order_by($sortname,$sortorder);
             
        $this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*",FALSE);
        $this->db->select("$this->group_table.name as group_name");
        $this->db->select("$this->table.name as site_name");
        $this->db->from("$this->user_table");
        $this->db->join("$this->group_table","$this->group_table.id = $this->user_table.group_id","LEFT");
        $this->db->join("$this->table","$this->table.id = $this->user_table.site_id","LEFT");
        
         
        //filter_by_site_id($this->user_table);
        filter_data($this->user_table);      
        $query = $this->db->get();
		//echo $this->db->last_query();exit;
        
        $data['result'] = $query->result();
      
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
        
        
        $data['offset'] = $offset;
      
        return $data;
    }
    
    
    
    function get_flexigrid_cols()  
    {
         $modname = $this->uri->segment(1)."/".$this->uri->segment(2); 
         
           
         $curuser = $this->session->userdata['userinfo']->id;

    $query =  $this->db->query("SELECT *
	FROM `flexigrid` where model_name = '".$modname."' and user_id = '".$curuser."'") ; 

    $query =  $this->db->query("SELECT * FROM `flexigrid` where model_name = '".$modname."' and user_id = '".$curuser."'") ; 

    $col = $query->result();
    
    // $flexarray = ;
    if(isset($col[0]->column))
    {
    $colinfo = $col[0]->column ;
    }else{
    
    $colinfo = lang('site_name').','.lang('group_name').','.lang('permission').','.lang('first_name').','.lang('last_name').','.lang('email').','.lang('status');
    
    }
     //print_r($col[0]->column);
    $colinfo = explode(',', $colinfo);
    //print_r($colinfo);
    
    
    
    //added for hidding data available in database
	if(in_array(lang('site_name'), $colinfo)){$site_name =  "nothide";}else {$site_name=  "hide";}
	if(in_array(lang('group_name'), $colinfo)){$group_name=  "nothide";}else {$group_name=  "hide";}
	if(in_array(lang('permission'), $colinfo)){$permission=  "nothide";}else {$permission=  "hide";}
	if(in_array(lang('first_name'), $colinfo)){$first_name =  "nothide";}else {$first_name=  "hide";}
	if(in_array(lang('last_name'), $colinfo)){$last_name =  "nothide";}else {$last_name=  "hide";}
	if(in_array(lang('email'), $colinfo)){$email =  "nothide";}else {$email=  "hide";}
	if(in_array(lang('status'), $colinfo)){$status =  "nothide";}else {$status=  "hide";}
 
         
         
        
        if(currentuserinfo()->is_super_site)
        {
            $data[] = array(
                "display"   =>lang('site_name'),
                "name"      =>"site_name",
                "width"     =>"130",
                "sortable"  =>"false",
                "align"     =>"center",
                 "$site_name" => "true"
            );
        }      
        
          $data[]=   array(
                "display"   =>lang('group_name'),
                "name"      =>"group_name",
                "width"     =>"130",
                "sortable"  =>"false",
                "align"     =>"center",
               "$group_name" => "true"
            );  
            
            
          $data[]=   array(
                "display"   =>lang('permission'),
                "name"      =>"permission",
                "width"     =>"120",
                "sortable"  =>false,
                "align"     =>"center",
                "$permission" => "true"
            );  
                     
            
          $data[]=  array(
                "display"   =>lang('first_name'),
                "name"      =>"first_name",
                "width"     =>"120",
                "sortable"  =>"false",
                "align"     =>"center",
               "$first_name" => "true"
            );
          $data[]= array(
                "display"   =>lang('last_name'),
                "name"      =>"last_name",
                "width"     =>"120",
                "sortable"  =>"false",
                "align"     =>"center",
               "$last_name" => "true"
            );
          $data[]= array(
                "display"   =>lang('email'),
                "name"      =>"email",
                "width"     =>"150",
                "sortable"  =>"false",
                "align"     =>"center",
               "$email" => "true"
            );
           $data[] =  array(
                "display"   =>lang('status'),
                "name"      =>"status",
                "width"     =>"70",
                "sortable"  =>"false",
                "align"     =>"center",
                "$status" => "true"
            );
            
      
        
        return $data;
    }

	function profile_update($userid=null,$userdata){
		
		$data = (array)$userdata;
		$where = "id = $userid"; 
		$str = $this->db->update_string($this->user_table,$data,$where);
		$query=$this->db->query($str);
		return $query;
	}

	function password_setting($password,$new_password){				
		$userData=currentuserinfo();	
		$id=$userData->id;				
		$query=$this->db->get_where($this->user_table,array('password'=>$password,'id'=>$id));		
		if($query->num_rows === 1){			
			$data=array('password' => $new_password);
			$this->db->where('id',$id);
			$this->db->update($this->user_table,$data);
			return $query->row();
		}else{	
			return false;
		}
	}
     /**
     * Update Signature
     * This function updates signature
     * @access	public
     * @return	object 
     */

	 function getSign(){
		 $data=$this->db->get("user_sign");
		 return $data->row()->sign_field;
		
	 }
    
    function update_signature($id=null){				
		$id=currentuserinfo()->id;
		$data=array(
				'designation'=>$this->input->post("designation"),
				'phone_number'=>$this->input->post("phone_number"),
				'cell_number'=>$this->input->post("cell_number"),
				'fax_number'=>$this->input->post("fax_number"),
				'company_name'=>$this->input->post("company_name"),
				'certification'=>$this->input->post("certification"),
				'company_url'=>$this->input->post("company_url"),	
				//'disclaimer'=>$this->input->post("message")		
			);
			$this->db->where('id',$id);
			$this->db->update($this->user_table,$data);
	}
    
     /**
     * Get Signature
     * This function gets signature
     * @access	public
     * @return	object 
     */
    
    function get_signature(){				
		$userData=currentuserinfo();	
		$id=$userData->id;				
		$query=$this->db->get_where($this->user_table,array('id'=>$id));		
		if($query->num_rows === 1){			
			return $query->row();
		}else{	
			return false;
		}
	}

	//----------------------------------------------------------------------------------
     /**
     * Get  per page listing
     * This function get perpage record in flexigrid     
     * @access	public
     * @return	int 
     */
     
     function perPage($user_id){    		
		$controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2);
		$this->db->where("action",$controllerInfo);
		$this->db->where("user_id",$user_id);
        $query =$this->db->get($this->per_page);		
		if($query->num_rows >0){
			return $query->row()->records;
		}else{
			return false;
		}
     }

	 // ------------------------------------------------------------------------

	 /**
	 * @function Name   update()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 May 2013
	 */
 
    function update_perPage($array,$userId){	
        $controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2);
		$where="action = '$controllerInfo' AND user_id = $userId";
		$query=$this->db->update_string($this->per_page,$array,$where); 
		$result=$this->db->query($query);
		if($result){			
			return true;
		}else{			
			return false;
		}	
    }

	// ------------------------------------------------------------------------

	 /**
	 * @function Name   update()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 May 2013
	 */
 
    function insert_perPage($array){		
		$query=$this->db->insert_string($this->per_page,$array); 
		$result=$this->db->query($query);
		if($result){			
			return true;
		}else{			
			return false;
		}	
    }

	/**
	 * @function Name   update()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 May 2013
	 */
	 function export(){
		$items           = $this->input->get_post('items',TRUE);
        $items_data      = str_replace("row","",$items);
		$items_data      = explode(",",$items_data);

		$this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*",FALSE);
        $this->db->select("$this->group_table.name as group_name");
        $this->db->select("$this->table.name as site_name");
        $this->db->from("$this->user_table");
        $this->db->join("$this->group_table","$this->group_table.id = $this->user_table.group_id","LEFT");
        $this->db->join("$this->table","$this->table.id = $this->user_table.site_id","LEFT");
        $this->db->where_in("$this->user_table.id",$items_data);        
        filter_data($this->user_table);      
        $query = $this->db->get();
		
		$data= $query->result_array();
		return $data;
	 }
	 
	 /**
     * method list
     *
     * This function get all controller methods
     * 
     * @access	public
     * @return	array
     */     
    function set_permission($user_id   = NULL)
    {
          $group_name   =  explode(",",$this->input->post('group_name'));

          $group_id     = "";
          if($group_name!=""):
              foreach($group_name as $row):
                    if($group_id)
                    $group_id.=",";
                    $group_id.= $row;
              endforeach;
          endif;
          
          $data['extra_group_id']   =$group_id;
          
          $this->db->where("id",$user_id);
          $r = $this->db->update("users",$data);
          return TRUE;
        
    }
    
    // ------------------------------------------------------------------------

    /**
     * method list
     *
     * This function get all controller methods
     * 
     * @access	public
     * @return	array
     */     
    
    function get_permission($user_id   = NULL)
    {
         $this->db->where("id",$user_id);
         $r   =$this->db->get("users"); 
         
         return $r->row();      
    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	Group
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Group_mod extends CI_Model {
  
    var $table = "";
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
     * This function Add Group
     * 
     * @access	public
     * @return	int or Boolean
     */     
    function add()
    {
        
        
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('description', lang('website'), "trim");
        
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
      
                
        $data['name']           = $this->input->post('name',TRUE);
        $data['description']    = $this->input->post('description',TRUE);
        $data['parent_group_id']          = $this->input->post('parent_group_id',TRUE);
        $data['status']         = $this->input->post('status',TRUE);
        set_common_insert_value();
        
        //pr($data);die;
        $this->db->insert($this->group_table,$data);  
        
      
        $id = $this->db->insert_id();
      	add_report($id);
        set_flashdata("success",lang('success'));
		//echo $id;die;
        return $id;
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Site
     *
     * This function Get Group by Group id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {   
        //Filter Data
        filter_data($this->group_table);
        //$this->db->where("is_super",0);
        
        $this->db->where('id',$id);
        $query = $this->db->get($this->group_table);
		//echo $this->db->last_query();exit;
        if($query->num_rows() > 0)
        return $query->row();
           
   
        show_404();
    }
    
    
    
    //----------------------------------------------------------------------------------
     /**
     * Update Group
     *
     * This function Update Group
     * 
     * @access	public
     * @return	int 
     */     
    function update($id = NULL)
    {
       $this->form_validation->set_rules('name', lang('name'), 'trim|required');
       $this->form_validation->set_rules('description', lang('website'), "trim");
       $this->form_validation->set_rules('parent_group_id', lang('parent_group'), "trim");
        
        if ($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        
        $data['name']           = $this->input->post('name',TRUE);
        $data['description']    = $this->input->post('description',TRUE);
        $data['parent_group_id']          = $this->input->post('parent_group_id',TRUE);
        $data['status']         = $this->input->post('status',TRUE);
        
        
        set_common_update_value();
        filter_data($this->group_table);

        $this->db->where("is_super",0);
        $this->db->where("id",$id);
        $r = $this->db->update($this->group_table,$data);
        update_report($id); 
        
        if($r)
            set_flashdata("success",lang('updated'));
                    
        return $r;
    }
    
    
    
     // ------------------------------------------------------------------------

    /**
     * Get Ajax Companies
     *
     * This function Get Group with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */     
  function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc')
    {  
         $offset = ($offset - 1) * $limit;

        $this->db->limit($limit, $offset);
        $text=strtolower(trim($text));
        if($text) {
            $this->db->like("CONCAT($this->group_table.name,$this->group_table.description)",
                $text);
        }

            
     if($order_by && $order)
            $this->db->order_by($order_by, $order);
             
        $this->db->select("SQL_CALC_FOUND_ROWS $this->group_table .*",FALSE);
        //$this->db->select("site.name as site_name");
        $this->db->from("$this->group_table");
        //$this->db->join('site', 'site.id = user_groups.site_id',"LEFT");
        $this->db->select("g2.name as parent_group");
        $this->db->join('user_groups as g2', 'g2.id = user_groups.parent_group_id',"LEFT");
    
        filter_data($this->group_table);
        
        
        //$this->db->where("site.is_super",0);   
        $query = $this->db->get();
        
       $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
		//pr($data);die;
        return $data;
    }
    
    
    
    
      function get_flexigrid_cols()  
    {
        
        if(currentuserinfo()->is_super_site)
        {
            $data[] = array(
                "display"   =>lang('site_name'),
                "name"      =>"site_name",
                 "order_by" => "yes" ); }
        
        $data[] =  array(
                    "display"   =>lang('name'),
                    "name"      =>"parent_group",
                    "order_by" => "yes"
                );
        
        
       $data[] =  array(
                    "display"   =>lang('parent_group'),
                    "name"      =>"name",
                     "order_by" => "yes"
                );
        
         /*$data[] =  array(
                    "display"   =>lang('description'),
                    "name"      =>"description",
                     "order_by" => "yes"
                ); */
		 $data[] =  array(
                "display"   =>lang('status'),
                "name"      =>"status",
                 "order_by" => "yes"
            );
        $data[] =  array(
                "display"   =>lang('permission'),
                "name"      =>"permission",
                 "order_by" => "no"
            );
       
        
        return $data;
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
    function get_groups()
    {   
		$this->db->where('status', 'active');
        $this->db->where("site_id",current_site_id());
        $query = $this->db->get($this->group_table);
        return $query->result();
    }

	 
    // ------------------------------------------------------------------------

    /**
     * View Parent Groups
     *
     * This function View Parent Groups
     * 
     * @access	public
     * @return	Object 
     */     
    function view_parent_groups($id=null)
    {   
		$this->db->where('status', 'active');
        $this->db->where("site_id",current_site_id());
		$this->db->where("id",$id);
        $query = $this->db->get($this->group_table);
        return $query->row();
    }

	//----------------------------------------------------------------------------------
     /**
     * Get  per page listing
     * This function get perpage record in flexigrid     
     * @access	public
     * @return	int 
     */
     
     function perPage($user_id){    		
		$controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
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
        $controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);
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
	function status_update($id  =NULL,$status)
    {
	
			
			if($status=='inactive')
			{
				$status ='active';
			}
			else
			{
				$status ='inactive';
			}
		$user_id= currentuserinfo()->id;
		

		foreach($this->session->userdata('child_list') as $row)		
		{
			$rows[]=str_replace("$user_id","", "$row");
			
		}
	
        //$this->db->where('site_id',current_site_id());
		$this->db->where('id',$id);

		$data['status']= $status;
        $r = $this->db->update($this->group_table,$data);  
		//echo $this->db->last_query();exit;

		         if($this->db->affected_rows()>=1)
				 	{
        				set_flashdata("success",lang('updated')); 
			
					}else{
						set_flashdata("error",lang('permisson'));
					}      
        return $r;
		
    }
    
}
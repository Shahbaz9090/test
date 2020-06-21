<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	Site
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Site_mod extends CI_Model {
  
    var $table = "site";
    var $user_table = "users";
    var $group_table = "user_groups";   
    var $permission_table = "user_group_permissions";
   
    
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
     * This function Add Site
     * 
     * @access	public
     * @return	int or Boolean
     */     
    function add()
    {
        
        
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
        
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $this->db->trans_start();
                
        $data['name']           = $this->input->post('name',TRUE);
        $data['email']          = $this->input->post('email',TRUE);
        $data['website']        = $this->input->post('website',TRUE);
        $data['description']    = $this->input->post('description',TRUE);
        $data['language']       = $this->input->post('language',TRUE);
        $data['status']         = $this->input->post('status',TRUE);
        $data['status_comment'] = $this->input->post('status_comment',TRUE);
        
        $data['last_ip']        = current_ip();
        $data['added_by']       = currentuserinfo()->id;
        $data['created_time']   = current_date();
        //$data['modified_time']   = current_date();
       
        $this->db->insert($this->table,$data);           
        $id = $this->db->insert_id();
              
        
        
        //Insert Default super group of this site
        $group['site_id']        = $id;
        $group['added_by']       = currentuserinfo()->id;
        $group['last_ip']        = current_ip();        
        $group['created_time']   = current_date(); 
        $group['name']           = "Super Admin";
        $group['description']    = "Own site data access";
        $group['status']         = $data['status'];
        $group['is_super']       = 1;
        
        $this->db->insert($this->group_table,$group);
        $gid = $this->db->insert_id();
            
        $pwd = '123456';//uniqid();
                
        //Insert Default User
        $user['site_id']       = $id;
        $user['added_by']       = currentuserinfo()->id;
        $user['last_ip']        = current_ip();        
        $user['created_time']   = current_date(); 
        $user['group_id']     = $gid;
        $user['email']        = $data['email'];
        $user['password']     = md5($pwd);
        $user['status']       = $data['status'];
        
        $this->db->insert($this->user_table,$user);        
        
        $this->db->trans_complete();
         add_report($id);
        set_flashdata("success",lang('success'));
        return $id;
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Site
     *
     * This function Get Site by Site id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {   
        $this->db->where('id',$id);       
        $this->db->where("is_super",0);
        $query = $this->db->get($this->table);   
        if($query->num_rows() > 0)
           return $query->row();
           
        show_404();
    }
    
    
    
    //----------------------------------------------------------------------------------
     /**
     * Update Site
     *
     * This function Update Site
     * 
     * @access	public
     * @return	int 
     */     
    function update($id = NULL)
    {
       $this->form_validation->set_rules('name', lang('name'), 'trim|required');
       $this->form_validation->set_rules('website', lang('website'), "trim|required");
        
        if ($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['name']           = $this->input->post('name',TRUE);
        $data['email']          = $this->input->post('email',TRUE);
        $data['website']        = $this->input->post('website',TRUE);
        $data['description']    = $this->input->post('description',TRUE);
        $data['language']       = $this->input->post('language',TRUE);
        $data['status']         = $this->input->post('status',TRUE);
        $data['status_comment'] = $this->input->post('status_comment',TRUE);
        $data['last_ip']        = current_ip();
        $data['added_by']       = 0;
        $data['modified_time']   = current_date();
        $this->db->where("id",$id);      
        $this->db->where("is_super",0); 
        $r = $this->db->update($this->table,$data);
        
        update_report($id);
        if($r)
            set_flashdata("success",lang('updated'));
                    
        return $r;
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
    function ajax_list_items($search_by=FALSE,$keyword = FALSE,$sortname = 'id',$sortorder = 'asc',$rp = 20,$page = 1)
    {  
        $offset = ($page - 1) * $rp;
      
        $this->db->limit($rp,$offset);
        
        if($search_by && $keyword )
        {
            if($search_by != "global_search")
                $this->db->like($search_by,$keyword);
            else
            {
               $this->db->like("CONCAT($this->table.name,$this->table.website)",$keyword); 
            }
        }
            
        
        if($sortname && $sortorder)    
            $this->db->order_by($sortname,$sortorder);
             
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        $this->db->from("$this->table");
        
        $this->db->where("is_super",0);
              
        $query = $this->db->get();
        
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
    $col = $query->result();
    
    // $flexarray = ;
    if(isset($col[0]->column))
    {
    $colinfo = $col[0]->column ;
    }  else {
    
    $colinfo = lang('name').','.lang('email').','.lang('description').','.lang('website').','.lang('status');
    
    }
     //print_r($col[0]->column);
    $colinfo = explode(',', $colinfo);
    //print_r($colinfo);
    
    
    
    //added for hidding data available in database
if(in_array(lang('name'), $colinfo)){$name =  "nothide";}else {$name=  "hide";}
if(in_array(lang('email'), $colinfo)){$email=  "nothide";}else {$email=  "hide";}
if(in_array(lang('description'), $colinfo)){$description=  "nothide";}else {$description=  "hide";}
if(in_array(lang('website'), $colinfo)){$website =  "nothide";}else {$website=  "hide";}
if(in_array(lang('status'), $colinfo)){$status =  "nothide";}else {$status=  "hide";}
 
        $data = array(
            array(
                "display"   =>lang('name'),
                "name"      =>"name",
                "width"     =>"150",
                "sortable"  =>"false",
                "align"     =>"center",
                "$name" => "true"
            ),
            array(
                "display"   =>lang('email'),
                "name"      =>"email",
                "width"     =>"150",
                "sortable"  =>"false",
                "align"     =>"center",
                "$email" => "true"
            ),
            array(
                "display"   =>lang('description'),
                "name"      =>"description",
                "width"     =>"200",
                "sortable"  =>"false",
                "align"     =>"center",
                "$description" => "true"
            ),
            array(
                "display"   =>lang('website'),
                "name"      =>"website",
                "width"     =>"200",
                "sortable"  =>"false",
                "align"     =>"center",
                "$website" => "true"
            ),
            array(
                "display"   =>lang('status'),
                "name"      =>"status",
                "width"     =>"200",
                "sortable"  =>"true",
                "align"     =>"center",
                "$status" => "true"
            )
        );
        
        return $data;
    }
    
    
    
}
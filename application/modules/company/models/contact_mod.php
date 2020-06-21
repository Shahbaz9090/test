<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		Rookie
 * @subpackage	Models
 * @category	Contact * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Incstatus_update
 * @since		Version 1.0
 */
 
class Contact_mod extends CI_Model {

    public $table = "companies_contact";
    public $companies_table ="companies";

	 public $per_page ="per_page";
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
     * This function Add Company with Contact
     * 
     * @access	public
     * @return	mixed Array 
     */     
    function add()
    {        

        $this->form_validation->set_rules('rating', 'rating', 'trim|required');
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('emails', lang('email'), 'trim|valid_email');
       
        $this->form_validation->set_rules('company_name', lang('company_name'), 'trim|required');
		$this->form_validation->set_rules('department', lang('department'), 'trim|required');
        //$this->form_validation->set_rules('primary_phone', lang('primary_phone'), 'trim|required|numeric');
        if(!empty($this->input->post('primary_phone',TRUE))){
            $this->form_validation->set_rules('primary_phone', lang('primary_phone'), 'trim|required|numeric|regex_match[/^[0-9]{10}$/]');
            $st = $this->is_unique_primary_phone($this->input->post('primary_phone',TRUE),$this->input->post('company_name',TRUE));
        }else{
            $st='1';
        }
        if(!empty($this->input->post('emails',TRUE))){
            $this->form_validation->set_rules('emails', lang('emails'), 'trim|valid_email');
            $dt = $this->is_unique_primary_email($this->input->post('emails',TRUE),$this->input->post('company_name',TRUE));
           // pr($dt);die;
        }else{
            $dt='1';
        }
        $this->form_validation->set_rules('designation', lang('designation'), 'trim|required');
        $this->form_validation->set_rules('previous_company', lang('previous_company'), 'trim|required');
		$this->form_validation->set_rules('company_status', lang('company_status'), 'trim|required');
		//$this->form_validation->set_rules('assign_group[]', lang('assign_group'), 'trim|required');
		//$this->form_validation->set_rules('assign_user[]', lang('assign_user'), 'trim|required');
		//$this->form_validation->set_rules('notes', lang('notes'), 'trim|required');
        
        
        
        
        if ($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            $data_status = 'error_required';
            return $data_status;
           
        }else if ($st == FALSE && $st!='1')
                {
                    //set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
                    $data_status = 'error_phone';
                    return $data_status;
        }else if ($dt == FALSE && $dt!='1')
                {
                    //set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
                    $data_status = 'error_email';
                    return $data_status;
        }else{
                

                
        
        
        /*$c_data['name']           = $this->input->post('company_name',TRUE);
        $c_data['website']        = $this->input->post('company_website',TRUE);
        set_common_insert_value();    
        
        $this->db->where("website",$c_data['website']);
        $query = $this->db->get("companies");
        
        $c_id = 0;
        
        if($query->num_rows() > 0)
            $c_id = $query->row()->id;
        else
        {
            $this->db->insert("companies",$c_data);
            $c_id = $this->db->insert_id();
        }*/
       // pr($_POST);die;
        if(!empty($_POST['assign_group'])){
            $assign_group_str = implode(',',$_POST['assign_group']);
        }if(!empty($_POST['assign_user'])){
            $assign_user_str = implode(',',$_POST['assign_user']);
        }
        //$data['company_id']         = $c_id;
        $data['company_id']         = $this->input->post('company_name',TRUE);
        $data['name']               = $this->input->post('name',TRUE);
        $data['department']         = $this->input->post('department',TRUE);
        $data['designation']               = $this->input->post('designation',TRUE);
        $data['email_id']           = $this->input->post('emails',TRUE);
        $data['primary_phone']      = $this->input->post('primary_phone',TRUE);
        $data['previous_company']      = $this->input->post('previous_company',TRUE);
        $data['secondary_phone']    = $this->input->post('personal_mobile_number',TRUE);
        $data['personal_email']    = $this->input->post('personal_email',TRUE);
        $data['company_status']    = $this->input->post('company_status',TRUE);
        $data['group_id']    = $assign_group_str;
        $data['added_by']            =  currentuserinfo()->id;
        $data['assign_users']            =  $assign_user_str;
        $data['rating']              = $this->input->post('rating',TRUE);
        $data['hot_contact']        = $this->input->post('hot_contact',TRUE);
        $data['hot_contact_comment']= $this->input->post('hot_contact_comment',TRUE);
        $data['notes']              = $this->input->post('notes',TRUE);
        $data['salutation']         = $this->input->post('salutation',TRUE);
        //pr($data);die;
        set_common_insert_value();           
        $this->db->insert("$this->table",$data);
        $id = $this->db->insert_id();
       if($id)
       {
           //$this->Contacter_doc($id);
       }
         
        
         $perent_id=currentuserinfo()->parent_user_id;
         $url       =  base_url()."company/contact/view"."/$id";
         //send_mail($perent_id,$url,"Company contact has Been Added");

         if($perent_id!=0){
            $top_parrent_id=currentUser($perent_id);                        
            //send_mail($top_parrent_id->parent_user_id,$url,"Company contact has Been Added");
         }  

        

             
        add_report($id);
        set_flashdata("success",lang('success'));
        return $id;


        } 
        //pr($st);
        
        
       
        
    }
    
    // ------------------------------------------------------------------------

    /**
     * Get Company
     *
     * This function Get Company Contact search by Contact id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {   
		
		$this->db->where("id",$id);
		$data = $this->db->get($this->table);
		$var = $data->row();
		
		// pr($var);die;
		if($var->group_id!='0')
		{
        if (!isset(currentuserinfo()->is_super) || currentuserinfo()->is_super != 1) 
        {
            $user_id = currentuserinfo()->id;
            // $this->db->or_where_in('assign_users', $user_id);
            // $extra_where = " OR FIND_IN_SET (".$user_id.", assign_users) ";
        }
        // filter_data($this->table, $extra_where);
		$this->db->select("$this->table .*,$this->table .id as contact_ids");
        $this->db->select('companies.name as company_name',TRUE);
		$this->db->select('companies.website as company_website',FALSE);
		$this->db->select('department.name as department_name',TRUE);
		$this->db->select('designation.name as designation_name',TRUE);
        $this->db->select('user_groups.id,user_groups.name as group_name',TRUE);
		$this->db->select('users.id,users.first_name,users.last_name',TRUE);
        $this->db->where("$this->table.id",$id);    
        $this->db->from("$this->table");
        $this->db->join('companies', "companies.id = $this->table.company_id");
		$this->db->join('department', "department.id = $this->table.department");
		$this->db->join('designation', "designation.id = $this->table.designation");
		$this->db->join('user_groups', "user_groups.id = $this->table.group_id",'left');
		$this->db->join('users', "users.group_id = $this->table.group_id",'left');
        //$this->db->join('countries', "countries.country_id = $this->table.country_id"); 
		}else{
			if (!isset(currentuserinfo()->is_super) || currentuserinfo()->is_super != 1) 
            {
                $user_id = currentuserinfo()->id;
                // $this->db->or_where_in('assign_users', $user_id);
                // $extra_where = " OR FIND_IN_SET (".$user_id.", assign_users) ";
            }
            // filter_data($this->table, $extra_where); 
			$this->db->select("$this->table .*,$this->table .id as contact_ids");
			$this->db->select('companies.name as company_name',TRUE);
			$this->db->select('companies.website as company_website',FALSE);
			$this->db->select('department.name as department_name',TRUE);
			$this->db->select('designation.name as designation_name',TRUE);
			//$this->db->select('user_groups.id,user_groups.name as group_name',TRUE);
			//$this->db->select('users.id,users.first_name,users.last_name',TRUE);
			$this->db->where("$this->table.id",$id);    
			$this->db->from("$this->table");
			$this->db->join('companies', "companies.id = $this->table.company_id");
			$this->db->join('department', "department.id = $this->table.department");
			$this->db->join('designation', "designation.id = $this->table.designation");
			//$this->db->join('user_groups', "user_groups.id = $this->table.group_id");
			//$this->db->join('users', "users.group_id = $this->table.group_id");
		}		
        $query = $this->db->get();
		//$this->db->where("$this->table.id",$id);
		// echo $this->db->last_query();die;
        if($query->num_rows() > 0)
			//pr($query->row());die;
           return $query->row();
           
        //show_404();
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Ajax Companies Contact
     *
     * This function Get Companies Contact with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */     
   function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc', $candidate_arr = null,$is_export=false, $items_data = NULL) {
        $offset = ($offset - 1) * $limit;

       if($is_export==false)
        {
            $this->db->limit($limit, $offset);
        }
        if($is_export==true &&  !empty($items_data))
        {
            $this->db->where_in("$this->table.id", $items_data);
        }
        $text=strtolower(trim($text));

        if($text) {
            $this->db->like("CONCAT(companies.name,companies.website,$this->table.name,$this->table.primary_phone,$this->table.email_id,$this->table.state,$this->table.city,$this->table.personal_email,$this->table.secondary_phone,department.name,designation.name)",$text);
        }

        if($order_by && $order){

        $this->db->order_by($order_by, $order);
        }

        $extra_where = "";
		if (!isset(currentuserinfo()->is_super) || currentuserinfo()->is_super != 1) 
        {
            $userinfo = currentuserinfo();
            $user_id = $userinfo->id;
            $permission = $this->session->userdata("permission");
            //get childs
            $child_list = get_child($userinfo->id, [$userinfo->group_id]);
            $child_list = @$child_list[0];
            $child_list[] = @$user_id;//for their assigned contact
            $assigned_users = [];
            if(isset($permission['own_view']) && !empty($permission['own_view']))
            {
                $assigned_users[] = $user_id;
            }
            else
            {
                $assigned_users = $child_list;
            }
            // $this->db->or_where_in('assign_users', $user_id);
            
            foreach ($assigned_users as $user)
            {
                $extra_where .= " OR FIND_IN_SET (".$user.",".$this->table.".assign_users)";
            }
            // pr($child_list);die;
            
        }
		filter_data($this->table, $extra_where);

     
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table .id as id,$this->table.group_id as group_id, $this->table .added_by as added_by, $this->table .primary_phone as primary_phone,$this->table .name as name
							,$this->table .status as status,$this->table .company_status as company_status,$this->table .email_id as email_id,$this->table.personal_email,$this->table.secondary_phone",FALSE);
        $this->db->select('companies.name as company_name');
		//$this->db->select('users.first_name as ower',TRUE);
        $this->db->select('companies.website as company_website');
		$this->db->select('department.name as department_name',TRUE);
		$this->db->select('designation.name as designation_name',TRUE);
        //$this->db->select('user_groups.name as group_name',TRUE);
        //$this->db->select('countries.country_name as country_name');
        //$this->db->select('regions.name as state_name');
        $this->db->from("$this->table");
        $this->db->join('companies', "companies.id = $this->table.company_id");
		//$this->db->join('users', "users.id= $this->table.added_by");
		$this->db->join('department', "department.id = $this->table.department");
		$this->db->join('designation', "designation.id = $this->table.designation");
		//$this->db->join('user_groups', "user_groups.id = $this->table.group_id");
        //$this->db->join('countries', "countries.country_id = $this->table.country_id");
        //$this->db->join('regions', "regions.id = $this->table.state");
        
        
        $query = $this->db->get();
        //pr($query->result());exit;
        // echo $this->db->last_query();die;
        if($is_export==false)
        {
            echo '.';
        }

        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
		//pr($data);die;
        return $data;
    }
    
    
    
    
    //----------------------------------------------------------------------------------
     /**
     * Update Company
     *
     * This function Update Company Contact Detail
     * 
     * @access	public
     * @return	int 
     */     
    function update($id = NULL,$company_id=null)
    {
		
		// pr($company_id);die;
		
        $this->form_validation->set_rules('rating', 'rating', 'trim|required');
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
        $this->form_validation->set_rules('company_name', lang('company_name'), 'trim|required');
		
       /// $this->form_validation->set_rules('primary_phone', lang('primary_phone'), 'trim|required|numeric');
        $this->form_validation->set_rules('department', lang('department'), 'trim|required');
        $this->form_validation->set_rules('designation', lang('designation'), 'trim|required');
        $this->form_validation->set_rules('previous_company', lang('previous_company'), 'trim|required');
		$this->form_validation->set_rules('company_status', lang('company_status'), 'trim|required');
		//$this->form_validation->set_rules('notes', lang('notes'), 'trim|required');
        
       
         if(!empty($this->input->post('primary_phone',TRUE))){
            
            $this->form_validation->set_rules('primary_phone', lang('primary_phone'), 'trim|required|numeric|regex_match[/^[0-9]{10}$/]');
            $st = $this->is_unique_primary_phone($this->input->post('primary_phone',TRUE), $company_id,$id);
        }else{
           $st ="1"; 
        }
        if(!empty($this->input->post('emails',TRUE))){
            $this->form_validation->set_rules('emails', lang('emails'), 'trim|valid_email');
            $dt = $this->is_unique_primary_email($this->input->post('emails',TRUE),$company_id,$id);
            // $dt = $this->is_unique_primary_email($this->input->post('emails',TRUE),$this->input->post('company_name',TRUE),$company_id,$id);
           // pr($dt);die;
        }else{
            $dt ='1';
        }
        
         if ($this->form_validation->run() == FALSE)
        
        {
            //set_flashdata("error",validation_errors());

            $data_status = 'error_required';
            return $data_status;
           
        }else if ($st == FALSE &&  $st!='1')
                {
                    //set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
                    
                    $data_status = 'error_phone';
                    return $data_status;
        }else if ($dt == FALSE &&  $dt!='1')
                {
                    //set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
                    $data_status = 'error_email';
                    return $data_status;
        }else{

                   
                    if(!empty($_POST['assign_group'])){
                        $assign_group_str = implode(',',$_POST['assign_group']);
                    }if(!empty($_POST['assign_user'])){
                        $assign_user_str = implode(',',$_POST['assign_user']);
                    }

                    $data['company_id']         	= $this->input->post('company_name',TRUE);
                    $data['name']               	= $this->input->post('name',TRUE);
                    $data['department']         	= $this->input->post('department',TRUE);
                    $data['designation']            = $this->input->post('designation',TRUE);
                    $data['email_id']           	= $this->input->post('emails',TRUE);
                    $data['primary_phone']      	= $this->input->post('primary_phone',TRUE);
                    $data['previous_company']       = $this->input->post('previous_company',TRUE);
                    $data['secondary_phone']    	= $this->input->post('personal_mobile_number',TRUE);
                    $data['personal_email']    		= $this->input->post('personal_email',TRUE);
                    $data['company_status']    		= $this->input->post('company_status',TRUE);
            		$data['group_id']    			= $assign_group_str;
            		$data['added_by']            	=  currentuserinfo()->id;
					$data['assign_users']           =  $assign_user_str;
                    $data['rating']              	= $this->input->post('rating',TRUE);
                    $data['hot_contact']        	= $this->input->post('hot_contact',TRUE);
                    $data['hot_contact_comment']	= $this->input->post('hot_contact_comment',TRUE);
            		$data['notes'] 					= $this->input->post('notes',TRUE);
                    
            		
            		/*if($this->input->post('assign_user',TRUE)!=""):
            		 $data['added_by']      = $this->input->post('assign_user',TRUE);
            	    endif;*/
            	  
                   
                   // pr($data);die;
                    filter_data($this->table); 
                    set_common_update_value();
                    $this->db->where("id",$id);
                    $r = $this->db->update("$this->table",$data);
                    update_report($id);
                     if($id)
                   {
                       $this->Contacter_doc($id);
                   }
        
                    if($r){
                        set_flashdata("success",lang('updated'));
                    }
                                
                    return $r;

            }
    }
    
    function get_flexigrid_cols()  
    {
         $data = array(
            array(
                "display" => lang('company_name'),
                "name" => "company_name",
                "order_by" => "yes"),
           /* array(
                "display" => lang('company_website'),
                "name" => "company_website",
                "order_by" => "yes"),*/
			array(
                "display" => lang("name"),
                "name" => "name",
                "order_by" => "yes"),
            array(
                "display" => lang('primary_phone'),
                "name" => "primary_phone",
                "order_by" => "yes"),
			array(
                "display" => lang("department"),
                "name" => "department_name",
                "order_by" => "yes"),
			array(
                "display" => lang("designation"),
                "name" => "designation_name",
                "order_by" => "yes"),
			array(
                "display" => lang("personal_email"),
                "name" => "personal_email",
                "order_by" => "yes"),
			array(
                "display" => lang("personal_mobile_number"),
                "name" => "secondary_phone",
                "order_by" => "yes"),
            array(
                "display" => lang("status"),
                "name" => "status",
                "order_by" => "yes"),
            /*array(
                "display" => lang("ower"),
                "name" => "ower",
                "order_by" => "yes"),*/
            array(
                "display" => lang('email'),
                "name" => "email_id",
                "order_by" => "yes")
          ) ;

        return $data;
    }
    
    
    
    
    //----------------------------------------------------------------------------------
     /**
     * Update Company
     *
     * This function Update Company Name
     * 
     * @access	public
     * @return	int 
     */     
    function ajax_is_email($email  =NULL,$id=null)
    {
        $this->db->where('site_id',current_site_id());
        $this->db->where('email_id',$email);		
		$this->db->where('id !=', $id);
        $query =$this->db->get($this->table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }
	
	//----------------------------------------------------------------------------------
     /**
     * Update Status of contact
     *
     * This function Update Status Company Contact
     * 
     * @access	public
     * @return	int currentuserinfo()->id
     */     
    function status_update($id  =NULL,$status)
    {
	
			
			if($status=='0')
			{
				$status =1;
			}
			else
			{
				$status =0;
			}
		$user_id= currentuserinfo()->id;
		

		foreach($this->session->userdata('child_list') as $row)		
		{
			$rows[]=str_replace("$user_id","", "$row");
			
		}
	
        //$this->db->where('site_id',current_site_id());
		$this->db->where('id',$id);

		$data['status']= $status;
        $r = $this->db->update($this->table,$data);  
		//echo $this->db->last_query();exit;

		         if($this->db->affected_rows()>=1)
				 	{
        				set_flashdata("success",lang('updated')); 
			
					}else{
						set_flashdata("error",lang('permisson'));
					}      
        return $r;
		
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

	// ------------------------------------------------------------------------

	 /**
	 * @function Name   export()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 Aug 2013
	 */
     function export(){ 
        $items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);
        //pr($items_data);die;
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table .id as id,$this->table.group_id as group_id, $this->table .added_by as added_by, $this->table .primary_phone as primary_phone,$this->table .name as name
                            ,$this->table .status as status,$this->table .company_status as company_status,$this->table .email_id as email_id,$this->table.personal_email,$this->table.secondary_phone,companies.name as company_name",FALSE);
        //$this->db->select('');
        //$this->db->select('users.first_name as ower',TRUE);
        $this->db->select('companies.website as company_website');
        $this->db->select('department.name as department_name',TRUE);
        $this->db->select('designation.name as designation_name',TRUE);
        //$this->db->select('user_groups.name as group_name',TRUE);
        //$this->db->select('countries.country_name as country_name');
        //$this->db->select('regions.name as state_name');
        $this->db->from("$this->table");
        $this->db->join('companies', "companies.id = $this->table.company_id");
        //$this->db->join('users', "users.id= $this->table.added_by");
        $this->db->join('department', "department.id = $this->table.department");
        $this->db->join('designation', "designation.id = $this->table.designation");
        //$this->db->join('user_groups', "user_groups.id = $this->table.group_id");
        //$this->db->join('countries', "countries.country_id = $this->table.country_id");
        //$this->db->join('regions', "regions.id = $this->table.state");
        
        if (!isset(currentuserinfo()->is_super) || currentuserinfo()->is_super != 1) 
        {
            $user_id = currentuserinfo()->id;
            $this->db->or_where_in('assign_users', $user_id);
        }
        if(!empty($items)){ 
            $this->db->where_in("$this->table.id",$items_data);
        }
        $query = $this->db->get();
        //$this->db->last_query();
        $data= $query->result();    
        //pr($data);die;
        return $data;
    }
	
    //----------------------------------------------------------------------------------
     /**
     * Add Company Website
     *
     * This function Update Company Name
     * 
     * @access	public
     * @return	int 
     */     
    function ajax_is_website($email  =NULL)
    {        
	    $this->db->where('site_id',current_site_id());
        $this->db->where('website',$email);
        $query =$this->db->get($this->companies_table);
        
        $num_rows = $query->num_rows();
        return $num_rows;
    }
    
    
    
    //--------------------------------------------
    
    /*vender document upload function 
     * @access public
     */
    function Contacter_doc($id)
    {
        
          $count_image=count($_FILES['fileToUpload']['name']);
          
          $this->load->library('upload');
          $err=array();
		  $error="";
          $sys_err=array();          
          for($i=0;$i<$count_image;$i++){
            $_FILES['userfile']['name']    = $_FILES['fileToUpload']['name'][$i];
            //echo $_FILES['userfile']['types']    = $_FILES['fileToUpload']['type'][$i];exit;
            $_FILES['userfile']['type']     = $_FILES['fileToUpload']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['fileToUpload']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['fileToUpload']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['fileToUpload']['size'][$i];
            
            $config['file_name']        = $_FILES['fileToUpload']['name'][$i];
            $config['upload_path']      = 'Contacter_doc/';//$this->config->item('vendor_doc').'nsa/'; 
            $config['allowed_types']    = 'doc|docx|pdf|csv|DOCX|DOC|PDF|txt|jpg|JPEG|png';			
            $config['max_size']	        = '';
            $config['encrypt_name']     = TRUE;
            $config['remove_spaces']    = TRUE;
            $config['overwrite']        = FALSE;
    		
            $this->upload->initialize($config);
    		if (!$this->upload->do_upload())
    		{  
               $error = $this->upload->display_errors();
               $error = strip_tags($error);               
               $sys_err[]="<strong>Error : ".$config['file_name'].':</strong> '.$error;
                
    		}
    		else
    		{ 
    		$data =  $this->upload->data();   
                $file_data=array(
                    'companies_contact_id'=> $id,
                    'doc_file'=> $data['file_name'],
                    'file_name'=> $data['orig_name']
                    );
                //$file_data = $data['file_name'];
               // $file_data = $id;
               // $filesize = $data['file_size'];
               // $filetype = $data['file_type'];
                
                //Read doc file if server string fine Win means windows server
              //  $server = $_SERVER['SERVER_SIGNATURE'];
                
              
                $this->db->insert("companies_contact_doc",$file_data);
                
				
            }
        }
                   
    }
    
      // ------------------------------------------------------------------------

    /**
     * 
     *
     * This function Get Company Contact DOC file functions 
     * 
     * @access	public
     * @return	Object 
     */ 
    
    // ------------------------------------------------------------------------
    
    
    function get_contact_doc_file($id = NULL)
    {
               
        $this->db->select('companies_contact_doc.file_name as file_name');
        $this->db->select('companies_contact_doc.file_id as file_id');
	$this->db->select('companies_contact_doc.doc_file as doc_file');
        $this->db->where("companies_contact_doc.companies_contact_id",$id);    
        $this->db->from("companies_contact_doc");              
        $query = $this->db->get();
        return $query->result();        
    
    }
    
      /*
      * This function remove Contact doc file 
      * @public
      * 
      */ 
	function ajax_remove_doc($id=null){
		
            $query=$this->db->delete('companies_contact_doc', array('file_id' => $id)); 
			$doc_file          =$this->input->post("doc_file");
			unlink(ATTACHMENT_PATH.'Contacter_doc/'.$doc_file);
                 return true;

	}
	
	public function check_contact_existance($primary_phone,$company_id,$id=null) {
        //$database=DEFAULT_DATABASE;
        
        if(empty($id)){
            $this->db->select("id");
            $this->db->where("primary_phone ",trim($primary_phone));
            $this->db->where('company_id = '.$company_id, NULL, TRUE);
            
        }else{
            
            $this->db->select("id");
            $this->db->where("primary_phone ",trim($primary_phone)); 
            $this->db->where('company_id = '.$company_id, NULL, TRUE);
            $this->db->where('id != '.$id, NULL, TRUE);
        }
        
         $count = $this->db->get("companies_contact")->num_rows();
         //echo $this->db->last_query();die;
        if ($count > 0)
            return true;
    }

    function is_unique_primary_phone($val,$company_id=NULL,$id=null)
    {
       
        
        $this->db->select("id");
        $this->db->where("primary_phone",trim($val));
        if(!empty($company_id) ){
            $this->db->where('company_id', $company_id, TRUE);
        }
        if(!empty($id) ){
            $this->db->where('id != '.$id, NULL, TRUE);
        }
        
        $is_row = $this->db->get("companies_contact")->num_rows();
        // echo $this->db->last_query();die;
        if ($is_row>0)
        {
            
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    } 

    function is_unique_primary_email($val,$company_id,$id=null)
    {
       
        // var_dump($id);die;
        $this->db->select("id");
        $this->db->where("email_id",trim($val));
        if(!empty($company_id) ){
            $this->db->where('company_id = '.$company_id, NULL, TRUE);
        }
        if(!empty($id) ){
            $this->db->where('id != '.$id, NULL, TRUE);
        }
        
        $is_row = $this->db->get("companies_contact")->num_rows();
       // echo $this->db->last_query();die;
        if ($is_row>0)
        {
           
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function get_assigned_users($id)
    {
        $this->db->select('assign_users')->from($this->table)->where('id',$id);
        $query = $this->db->get();
        $assigned_users = [];
        if($query->num_rows()>0)
        {
            $assigned_users = explode(',',$query->row()->assign_users);
        }
        return $assigned_users;
    }
   
}
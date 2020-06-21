<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Group Permission Model
 *
 * @package		User
 * @subpackage	Group Permission
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Group_permission_mod extends CI_Model {
  
    
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
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
    public function method_list()
    {
        $this->db->group_by("title");
        $this->db->order_by("title","asc");
        $this->db->where('is_super',0);
        $query = $this->db->get("controllers_info");
        return $query->result();
    }
    
    public function module_list()
    {
        $result = [];
        $this->db->select('frm1.id,frm1.form_name,frm1.form_label,frm1.parent_id,frm1.module_name,frm1.module_title,frm1.module_type,frm1.module_controller,frm1.module_icon,frm1.order_by,frm1.status,frm1.is_deleted,frm1.action,frm1.action_type,frm1.custom_action,frm2.module_title AS parent_name');
        $this->db->where('frm1.status',1);
        $this->db->where('frm1.is_deleted',1);
        $this->db->join('inch_form AS frm2','frm2.id=frm1.parent_id','LEFT');
        $this->db->where("frm1.parent_id != 0");
        // $this->db->where("frm1.parent_id != '#'");
        $this->db->order_by('frm1.module_title',"ASC");
        // $this->db->group_by('frm1.id');
        $query =  $this->db->get('inch_form AS frm1');
        if($query->num_rows()>0)
        {
            $result = $query->result();
        }
        
        return $result;
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
    public function permission_data($group_id = NULL)
    {
		$this->db->where('group_id' ,$group_id);
		$query = $this->db->get("user_group_permissions");

		if($query->num_rows() > 0)
		{
		    $data = $query->row()->data;
		    
		    if($data != '')
		        return json_decode(stripslashes($data),TRUE);                
		}
		return array();     
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * set permission
     *
     * This function set permission 
     * 
     * @access	public
     * @return	array
     */     
    public function set_permission($id = NULL)
    {
      	
      	

        $names  = $this->input->post('name');
		//pr($names);
        $post   = $this->input->post();
      	
        $uri = array();
        $actions = NULL;
        
        foreach($names as $name){
			if($this->input->post($name))
			{
				$action = $this->input->post($name);
				$actions[$name]    = $action;


				$str = NULL;
						  
				foreach($action as $row)
				{
					$str[] = $row;
				}
                // pr($str);die;
				$this->db->where("controller",$action['controller']);
				$this->db->where("module",$action['module']);
				$this->db->where_in("action",$str,TRUE);
				$query = $this->db->get("controllers_info");

				$module_name = NULL;
			    // pr($query->result());die;
			 	foreach($query->result() as $row)
			 	{
					if($row->module == $row->controller)
					{
                        $uri[ $row->controller.'/'.$row->method] =$row->action;  
                    }
					else
					{
						$uri[$row->module.'/'.$row->controller.'/'.$row->method] =$row->action; 
					}
				}  
				 
			}
		}
    	pr($uri);die;
        $data['uri']      = json_encode($uri);
        $data['group_id'] = $id;
        $data['data']     = json_encode($actions);
		
		/*
		echo "URI: <br/>";
        pr($data['uri']);

		echo "Data: <br/>";
        pr($data['data']);
		die;
		*/

        $this->db->where('group_id',$id);
        $r =$this->db->get("user_group_permissions");
        if($r->num_rows() > 0)
        {
            $this->db->where('group_id',$id);
            return $this->db->update("user_group_permissions",$data);			
        }
        else
        {
            return $this->db->insert("user_group_permissions",$data);   
        }      
    }
    
    public function set_permission_new($id = NULL)
    {
      	$actions_methods = (array) json_decode(PERM_MODULE);
      	// pr($actions_methods);die;
      	
        $names  = $this->input->post('name');
        $post   = $this->input->post();
        
        // pr($_POST);
        $uri = array();
        $actions = NULL;
        
        foreach($names as $name){
            if($this->input->post($name))
            {
				$action 		= $this->input->post($name);
				$actions[$name]	= $action;
				// pr($action);
				$str 			= NULL;
				foreach($action as $row)
				{
					$str[] = $row;
				}

				// pr($str);die;
                if(isset($action['controller_duplicate']) && !empty($action['controller_duplicate']))
                {
                    $this->db->where("module_controller", $action['controller_duplicate']);
                }
                else
                {
                    $this->db->where("module_controller", $action['controller']);
                }
                $this->db->where("module_name", $action['module']);
                // $this->db->where_in("action", $str,TRUE);
                $where = [];
                foreach ($str as $key => $value) {
                    $where[] =  "FIND_IN_SET('".$value."', action)";
                }
                if(isset($where) && !empty($where))
                {
                    $this->db->where(" ( ".implode(" OR ", $where)." ) ", NULL, FALSE);
                }

                $query  = $this->db->get("inch_form");
                if($query->num_rows()>0)
                {
                    $row            = $query->row();
                    // echo $this->db->last_query();die;
                    $action_tmp = $action;
                    unset($action_tmp['controller']);
                    unset($action_tmp['module']);
                    if(isset($action['controller_duplicate']) && !empty($action['controller_duplicate']))
                    {
                        unset($action_tmp['controller_duplicate']);
                    }
                    // pr($action_tmp);
                    // pr($row);die;
                    $action_opts    = $row->action;
                    $action_opts    = explode(',', $action_opts);
                    // pr($action_opts);die;
                    $module_name    = NULL;
                    
                    foreach($action_tmp as $method => $action_opt)
                    {
                        // echo $action_opt."<br>";
                        // pr($query->result());die;
                        $method2 = array_search($action_opt, $actions_methods);
                        $method = str_replace('own_', "", $method);
                        $method = str_replace('all_', "", $method);
                        if($row->module_name == $row->module_controller)
                        {

                            $uri[ $row->module_controller.'/'.$method] = $action_opt;  
                        }
                        else
                        {
                            $uri[$row->module_name.'/'.$row->module_controller.'/'.$method] = $action_opt; 
                        }
                    } 
                    // pr($uri);die;
                } 
            }
        }
        // pr($uri);die;
        $data['uri']      = json_encode($uri);
        $data['group_id'] = $id;
        $data['data']     = json_encode($actions);
        $this->db->where('group_id',$id);
        $r =$this->db->get("user_group_permissions");
        if($r->num_rows() > 0)
        {
            $this->db->where('group_id',$id);
            return $this->db->update("user_group_permissions",$data);           
        }
        else
        {
            return $this->db->insert("user_group_permissions",$data);   
        }      
    }

}
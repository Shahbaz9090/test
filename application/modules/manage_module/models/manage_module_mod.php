<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Manage Support Form Model 
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Support Form
 * @author		Tekshapers Inc
 * @website		http://www.nss.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Manage_module_mod extends CI_Model {
	
	
    var $table = "inch_support";
    var $inch_form = "inch_form";
    
	function __construct()
    {
        parent::__construct();
    }
    
    public function module_list()
    {
    	$result = [];
    	$this->db->select('id,form_name,form_label,parent_id,module_title,module_name,module_type,module_controller,module_icon,order_by,status,is_deleted,action,extra_method,view_on_left,action_type,custom_action');
    	//$this->db->where('status',1);
    	$this->db->where('is_deleted',1);
        // $this->db->where('view_on_left',1);
    	$this->db->where('parent_id',0);
    	$this->db->order_by('order_by',"ASC");
    	$query =  $this->db->get($this->inch_form);
    	if($query->num_rows()>0)
    	{
    		$result = $query->result();
    		// pr($result);die;
    		foreach ($result as $key => $value) {
    			
    			$this->db->select('id,form_name,form_label,parent_id,module_title,module_name,module_type,module_controller,module_icon,order_by,status,is_deleted,action,extra_method,view_on_left,action_type,custom_action');
		    	//$this->db->where('status',1);
		    	$this->db->where('is_deleted',1);
                // $this->db->where('view_on_left',1);
		    	$this->db->where('parent_id',$value->id);
		    	$this->db->order_by('order_by',"ASC");
		    	$result[$key]->child_list =  $this->db->get($this->inch_form)->result();
    		}
    	}

    	return $result;
    }

    public function module_save()
    {
    	$data 					= [];
    	$postData 				= $this->input->post();
        // pr($postData);die;
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['status'] 		= 1; // static by default
    	$data['is_deleted'] 	= 1; // static by default
    	$data['module_type'] 	= 2; // static by default
    	$data['module_title'] 	= $postData['module_title'];
        $data['module_name']    = $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
        $data['module_icon']    = $postData['module_icon'];
        $data['view_on_left']   = $postData['view_on_left'];
        $data['extra_method']   = $postData['extra_method'];
        $data['action_type']    = $postData['action_type'];
        if($postData['action_type']==1)
        {
            $data['action']         = implode(",", $postData['add_action']);
            
            $data['custom_action']  = NULL;
        }
        else
        {
            $data['action']         = implode(",", array_keys(array_filter($postData['custom_action'])));
            $data['custom_action']  = json_encode(array_filter($postData['custom_action']));
        }
        
		$this->db->insert($this->inch_form, $data);
    	return $this->db->insert_id();
    }

    public function module_edit()
    {
        // pr($_POST);die;
    	$data 					= [];
    	$postData 				= $this->input->post();
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['module_title'] 	= $postData['module_title'];
        $data['module_name']    = $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
        $data['module_icon']    = $postData['module_icon'];
        $data['view_on_left']   = $postData['view_on_left'];
        $data['extra_method']   = $postData['extra_method'];
        $data['action_type']    = $postData['action_type'];
        if($postData['action_type']==1)
        {
            $data['action']         = implode(",", $postData['edit_action']);
            $data['custom_action']  = NULL;
        }
        else
        {
            $data['action']         = implode(",", array_keys(array_filter($postData['custom_action'])));
            $data['custom_action']  = json_encode(array_filter($postData['custom_action']));
        }
    	$this->db->where('id',$postData['module_id']);
    	return $this->db->update($this->inch_form, $data);
    }
    

} //=========End Class==============//
<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter Manage Support Form Controller
 *
 * @package        CodeIgniter
 * @subpackage    Controllers
 * @category    Support Form
 * @author        Tekshapers INC
 * @website        http://www.nss.com
 * @company     Tekshapers Inc
 * @since        Version 1.0
 */

class Manage_module extends MY_Controller
{
    private $data         = array();
    private $export_limit = null;
    private $delete_limit = null;
    private $db2;

    public function __construct()
    {
        parent::__construct();
        //checkSuperAdmin();
        $this->load->model('manage_module_mod');
        $this->lang->load('manage_module', get_site_language());

        $this->data['head']['title'] = "Form Module";
        $this->data['readonly']      = null;
        $this->data['base_url']      = base_url("manage_module");
        $this->export_limit          = $this->config->item('export_limit');
        $this->delete_limit          = $this->config->item('delete_limit');
        $this->table_name            = "inch_support";

        $this->data['module']      = 'Form Module';
        $this->data['module_link'] = base_url("manage_module") . "/list_items";
    }

    public function index()
    {
        redirect(base_url('manage_module/module_list'));
    }
    
    public function module_list()
    {
        $config["base_url"]	= SITE_PATH."manage_module/module_list/";
    	if(isPostBack())
    	{	
    		if(isset($_POST['add_new_module']))
    		{
	    		$status = $this->manage_module_mod->module_save();
	    		if($status)
	    		{
	    			// unset($_POST);
	    			set_flashdata('success','Module successfully added');
	    			redirect($config["base_url"]);
	    		}
    		}
    		elseif(isset($_POST['edit_module']))
    		{
	    		$status = $this->manage_module_mod->module_edit();
	    		if($status)
	    		{
	    			// unset($_POST);
	    			set_flashdata('success','Module successfully updated');
	    			redirect($config["base_url"]);
	    		}
    		}
    	}

		$result = $this->manage_module_mod->module_list();
		// pr($result);die;
		$this->data["result"] = $result;
		$views[] = "module_list";
		//pr($this->data);die;
        view_load($views,$this->data);
    }

    public function reorder_module()
    {
        if ($this->input->is_ajax_request()) {

        	// pr(json_decode($_POST['reorder_module']));die;
            if (isset($_POST['reorder_module']) && !empty($_POST['reorder_module'])) 
            {
                $reorder_module	= json_decode($this->input->post('reorder_module'));

            	foreach ($reorder_module as $rbkey => $module) {

            		$this->db->where("id",$module->id);
            		$this->db->update("inch_form",['order_by'=>$rbkey+1,'parent_id'=>0]);
            		if(isset($module->children) && !empty($module->children))
            		{
            			foreach ($module->children as $key2 => $children) {

		            		$this->db->where("id",$children->id);
		            		$res = $this->db->update("inch_form",['order_by'=>$key2+1,'parent_id'=>$module->id]);
		            	}
            		}
            	}

            	// pr($new_data);die;
	           /* $form->form_data		= $new_data;
	            $updates              	= array();
                $updates['form_data'] 	= json_encode($form);
                // pr(json_decode($updates['form_data']));die;
                $this->db->trans_start();
                $this->db->where('id', $result->id);
                $res = $this->db->update('inch_form', $updates);*/
                // $this->db->trans_complete();
                if($res)
                {
        			echo json_encode(['status' => 1, 'message' => 'Module successfully reordered.']);
                }
                else
                {
        			echo json_encode(['status' => 0, 'message' => 'Module could not be reordered.']);
                }
		        
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
    public function remove_module()
    {
        if ($this->input->is_ajax_request()) {
        	// pr($_POST);die;
            if (isset($_POST['module_id']) && !empty($_POST['module_id'])) 
            {
                $module_id	= ($this->input->post('module_id'));
                $this->db->trans_start();
                $this->db->where('id', $module_id);
                $this->db->where('module_type',2);
                $res = $this->db->update('inch_form',['is_deleted'=>2]);
                $this->db->trans_complete();
                if($res)
                {
        			echo json_encode(['status' => 1, 'message' => 'Module successfully deleted.']);
                }
                else
                {
        			echo json_encode(['status' => 0, 'message' => 'Module could not be deleted.']);
                }
		        
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
   public function active(){
		 
		 $id = $_POST['id'];
		 $data['staus'] = $_POST['status'];
		 $this->db->where('id',$id);
		 $data = $this->db->update('inch_form',$data);
	 }
	 public function inactive(){
		 $id = $_POST['id'];
		 $data['status'] = $_POST['status'];
		 $this->db->where('id',$id);
		 $data = $this->db->update('inch_form',$data);
	 }
} //End of the class

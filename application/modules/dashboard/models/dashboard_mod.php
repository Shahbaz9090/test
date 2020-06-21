<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Account Model 
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Account 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Dashboard_mod extends CI_Model {

	public $tbl_job_order          = "job_order";
    public $groups                 = "user_groups";
    public $tbl_users              = "users";
    public $company_table          = "companies";
    public $company_contact        = "companies_contact";
    public $type_table             = "job_order_type";
    public $tbl_job_order_assign   = "job_order_assign_list";
    public $tbl_job_order_type     = "job_order_type";
    public $job_status             = "job_status";
    public $job_status_view        = "job_status_view";

	public $job_order_activity     = "job_order_activity";


    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }
    
    
	function getJobOrder($userId,$group_id=null){       
        $this->db->select("$this->job_order_activity.*");
		$this->db->from("$this->job_order_activity");        
        $query = $this->db->get();		
		$result=$query->result();
		return $result;
	}
    
    function check_user($id)
    {
        $site_id = currentuserinfo()->site_id;
        $data = array(
            'site_id' => $site_id,
            'user_id' => $id);
        $query = $this->db->get_where('user_report_type', $data);
        $result = $query->row();
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function update_report_type($data = null, $id = null)
    {
        $site_id = '1';
        $check_user = $this->check_user($id);
        if($check_user)
        {
           $this->db->where("user_id", $id);
           $this->db->update('user_report_type', $data); 
        }
        else
        {
            $data['site_id'] = $site_id;
            $data['user_id'] = $id;
            $this->db->insert('user_report_type', $data);
        }
        
        
        
    }
	
	/**
     * appointment_data
     *
     * This function show appointment data
     * 
     * @access	public
     * @return  json array 
     */
    function appointment_data() {
		$this->db->select("a.id,a.type as notification_type,a.appointment_name as title,a.description,a.appointment_date as start,module,CONCAT(u.first_name,' ',u.last_name) as added_by",false)
        ->from('appointment a')
        ->join('users u','u.id = a.added_by','left');
        filter_data_for_dashboard("a");
        $query = $this->db->get();
		// pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return json_encode($query->result());
			/*$data = $query->result();
			foreach($data as $key=>$val){
				if($val->module =='sales_spares'){
				$title = "<span style=\"background-color:red;color:#fff;\">".$val->title ."</span>";
				$data[$key]->title = $title;
				}else if($val->module =='sales_governing'){
				$title = "<span style=\"background-color:red;color:#fff;\">".$val->title ."</span>";
				$data[$key]->title = $title;
				}
				
			}
				//pr($data);die;
				$encoded =  json_encode($data);
				return $encoded;*/
        }
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		
 * @subpackage	Models
 * @category	Company
 * @author		Pradeep 
 * @website		http://www.onlienprabhakar.com
 * @company     Techbiddiesit Inc
 * @since		Version 1.0
 */
 
class Mail_mod extends CI_Model {

    public $table   	= "email_data_china";
    public $table_doc   = "email_data_doc_china";
	public $per_page	= "per_page";
    public $type    	= NULL;
   
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
        $this->type = $this->uri->segment(2);
    }
    
    // ------------------------------------------------------------------------
         
    public function get_mail_list($type, $msg_type='inbox', $id='', $count='', $limit='', $start='')
    {
		$this->db->select("SQL_CALC_FOUND_ROWS e.*",FALSE);
		//pr("yaa");die;
		$status = $this->input->get('status');
		$search = $this->input->get('search');
		$email = $this->input->get('email');
		//var_dump($email);die;
        if(isset($search) && !empty($search))
        {   
			$where = "( CONCAT(cc_email, from_name, to_email, from_email, to_name, reply_name, subject, message) LIKE '%".$search."%' OR FIND_IN_SET('".$search."', tags) )";
            $this->db->where($where);
        }
        if(isset($email) && !empty($email) && $email != 'null')
        {  
			//pr("yess");die;
			$mail = explode(',',$email);
			$where = [];
			foreach ($mail as $key => $value) {
				$where[] =  "FIND_IN_SET('".$value."', standard_tags)";
			}
			if(isset($where) && !empty($where))
			{
				$this->db->where(" ( ".implode(" OR ", $where)." ) ", NULL, FALSE);
			}
			//pr($email);die;
			//$this->db->where_in('standard_tags',$mail);
        }
        if(isset($status) && $status!='')
        {   
            // $where = "( CONCAT(release_email) LIKE '%".$status."%' OR FIND_IN_SET('".$status."', release_email) )";
            $this->db->where('release_email', $status);
        }

        if($id!='')
        {
            $this->db->where("e.".PRIMARY_KEY, $id);
        }
        if ($limit != "" && $start != "") {
            $this->db->limit($limit, $start);
        }

        if($limit != '' && $start == '' && $count == '')
        {
            $this->db->limit(PERPAGE, 0);
        }
      	
        // $this->db->where('e.type',$type);
        if($type == "sales_spares_email_china"){
            $this->db->where('e.type','1');
        }if($type == "sales_governing_email_china"){
            $this->db->where('e.type','2');
        }if($type == "sales_pcb_email_china"){
            $this->db->where('e.type','3');
        }if($type == "service_pcb_email_china"){
            $this->db->where('e.type','4');
        }if($type == "service_automation_email_china"){
            $this->db->where('e.type','5');
        }if($type == "service_dcs_email_china"){
            $this->db->where('e.type','6');
        }
        $this->db->order_by('e.id', "DESC");
        $this->db->where('e.msg_type',$msg_type);
        $query = $this->db->get($this->table .' AS e');
        $data['result'] = $query->result();
        // echo $this->db->last_query();exit;
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"]  = $query->row()->count;
		//pr($data);die;
        return $data;
    }

    function get($id = 0)
    {
        if ($id)
        {
            // $this->db->select('ed.*,edd.filename,edd.file_title');
            $this->db->where('ed.id', $id);
            // $this->db->where('ed.type', $this->type);
            /*
            if($this->type == "sales_spares_email_china"){
            $this->db->where('e.type','1');
            }if($this->type == "sales_governing_email_china"){
                $this->db->where('e.type','2');
            }if($this->type == "sales_pcb_email_china"){
                $this->db->where('e.type','3');
            }if($this->type == "service_pcb_email_china"){
                $this->db->where('e.type','4');
            }if($this->type == "service_automation_email_china"){
                $this->db->where('e.type','5');
            }if($this->type == "service_dcs_email_china"){
                $this->db->where('e.type','6');
            }*/
            // $this->db->join('email_data_doc as edd', 'ed.id=edd.email_data_id','left');
            // $this->db->group_by('edd.id');
            $data['mail_list'] = $this->db->get($this->table.' as ed')->row();
             // echo $this->db->last_query();exit;
            $data['mail_doc'] = $this->get_doc($id);
            return $data;
        }
    }

    public function get_doc($id = null)
    {
        if ($id)
        {
            $this->db->select('edd.id,edd.filename,edd.file_title');
            $this->db->where('edd.email_data_id', $id);
            return $this->db->get($this->table_doc.' as edd')->result_array();
        }
    }

    
    function get_flexigrid_cols()
    {
        $data = array(
        array(
            "display"   =>('ID'),
            "name"      =>"id",
            "order_by" => "yes"
        ),
        array(
            "display"   =>('Subject'),
            "name"      =>"subject",
            "order_by" => "yes"
        ),array(
            "display"   =>('From'),
            "name"      =>"from",
            "order_by" => "yes"
        ),array(
            "display"   =>('To'),
            "name"      =>"to",
            "order_by" => "yes"
        ),
        array(
            "display" => ("Date"),
            "name" => "mail_date",
            "order_by" => "yes"),
        );
        return $data;       
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
	 * @function Name   export()
	 * @purpose         to export a record 
	 * @return			boolean
	 * @created         2 Aug 2013
	 */
	function export(){
		$items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);

		$this->db->select('c.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name');
		$this->db->from('companies c');
		$this->db->join("industry ind" , 'c.industry=ind.id');
		$this->db->join("countries co" , 'co.id=c.country');
		$this->db->join("states st" , 'st.id=c.state_comp');
		$this->db->join("cities ct" , 'ct.id=c.city_comp');
		$this->db->where_in("c.id",$items_data);
		$query = $this->db->get();

		$data= $query->result_array();	
		//pr($data);die;
		return $data;
	}
	
	function inbox_data($id, $limit = 0, $offset = 0)
    {
        $this->db->select('*');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'Desc');
        $this->db->where('user_id', $id);
        $this->db->where('msg_type', "inbox");
        return $this->db->get('email_data');


    }

    function delete_inbox_entry() //delete record from sales leads table
    {
        $inbox_id = $this->uri->segment(3);
        $this->db->where('id', $inbox_id);

        $deleted = $this->db->delete('email_data', array('id' => $inbox_id));


    }
    /** get inbox content **/
    function get_inbox_content() //delete record from sales leads table
    {
        $inbox_id = $this->uri->segment(3);
        $this->db->where('id', $inbox_id);

        $deleted = $this->db->get('email_data', array('id' => $inbox_id));

        foreach ($deleted->result() as $row)
        {
            return $sub = $row->message;
        }

    }
    /////////////////////////////////inbox data close//////////////////////////////////////

    function sendbox_data($id, $limit = 0, $offset = 0)
    {
        $this->db->select('*');
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'Desc');
        $this->db->where('user_id', $id);
        $this->db->where('msg_type', "sent_box");
        return $this->db->get('email_data');


    }

    function get_inbox_mail_by_id($id = 0)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('email_data');
            if ($query->num_rows())
            {
                $row_data = $query->result_array();

                for ($i = 0; $i < count($row_data); $i++)
                {
                    //$name =explode('<',$row_data[$i]['from']);
                    //$data['name'] =$this->get_email_name($from);
                    $from = trim(array_pop(explode('<', $row_data[$i]['from'])), '>');
                    $data['from'] = $from;
                    $data['id'] = $row_data[$i]['id'];
                    $gmail_id = $this->get_Gemail_id();
                    if(!$gmail_id)
                    {
                        $data['email_id'] = $this->get_loginUser_email();
                    }
                    else
                    {
                        $data['email_id'] = $gmail_id;
                    }
                    
                    $data['subject'] = $row_data[$i]['subject'];
                    $data['last_sync_date'] = $row_data[$i]['last_sync_date'];
                    $data['cc_email'] = $row_data[$i]['cc_email'];
                    $data['message'] = $row_data[$i]['message'];
                    $data['recived_message'] = $row_data[$i]['recived_message'];
                    $data['recived_mail'] = $row_data[$i]['recived_mail'];
                    $data['to'] = $row_data[$i]['to'];
                    $data['msg_type'] = $row_data[$i]['msg_type'];
                    $data['mail_id'] = $row_data[$i]['mail_id'];
                    $data['read'] = $row_data[$i]['read'];
                    return $data;
                }

            }

        }
    }

    function get_email_name($user)
    {
        $this->db->order_by('id', 'desc');
        $this->db->like('form_data', "%$user%");

        $query = $this->db->get('sales_leads_data');
        if ($query->num_rows())
        {
            $row_data = $query->result_array();

            for ($i = 0; $i < count($row_data); $i++)
            {
                $var = $row_data[$i]['form_data'];
                $obj = json_decode($var);
                $email_name = $obj->name;


            }
            return $email_name;
        }

    }
    

    public function get_Gemail_id()
    {
        $session_data = $this->session->userdata('logged_in');
        $this->db->where('user_id', $session_data['user_id']);
        $query = $this->db->get('gmail_credencials');
        $row = $query->result();
        return @$row[0]->email_id;
    }
    
    
    public function get_loginUser_email()
    {
        $session_data = $this->session->userdata('logged_in');
        $this->db->where('id', $session_data['user_id']);
        $query = $this->db->get('amg_admin');
        $row = $query->result();
        return @$row[0]->email;
    }
    
    
    
    function inbox_data_sorting($id, $limit, $offset,$OrderBy, $ShortBy,$type)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->where('msg_type',$type);
        $this->db->limit($limit, $offset);
        $this->db->order_by($OrderBy, $ShortBy);
        return $this->db->get('email_data');
        
    }
    
    /** make massage readable **/
    
    
    function make_message_readable($msg_id)
    {
        $field = array(
        'read'=>"1");
        $this->db->where('id', $msg_id);
        $this->db->update('email_data', $field);  
    }
       
}
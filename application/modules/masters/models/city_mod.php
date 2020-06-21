<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		Rookie
 * @subpackage	Models
 * @category	Company
 * @author		Prabhakar Ram
 * @website		http://www.onlienprabhakar.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class City_mod extends CI_Model {

    public $table     = "cities";
    public $table1     = "states";
    public $table2     = "countries";
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

    
    function fetch_state($country_id){
       
	   if(!empty($country_id)){
		   $country_ids=explode(',',$country_id);
	   }
        $this->db->where_in('country_id', $country_ids);
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get('states');
		//pr($query->num_rows());die;
        if($query->num_rows()>0 ){
        $output = '<option value="">Select</option>';
        foreach($query->result() as $row){
           // pr($row);die;
		    ///$output .= ;
            $output .= '<option value="'.$row->id.'">'.$row->state_name.'</option>';
        }
        //pr($output);die;
		}else{
			$output .= '<option value="">No state found</option>';
		}
        return $output;
    }
    function add()
    {
        
        /*$this->db->where("website",$this->input->post('website',TRUE));
        $this->db->where("site_id",current_site_id());
        $r =$this->db->get($this->table);
                
        if($r->num_rows() > 0)
        {      
            set_flashdata("error","The Company Website field must contain a unique value");       
            return FALSE;
                          
        }*/
        
        
        $this->form_validation->set_rules('city_name', lang('city_name'), 'trim|required');
        $this->form_validation->set_rules('state_name', lang('state_name'), 'trim|required');
        $this->form_validation->set_rules('country_name', lang('country_name'), 'trim|required');
		
        
         $st = $this->is_unique_names(strtolower($this->input->post('city_name',TRUE)),strtolower($this->input->post('country_name',TRUE)),strtolower($this->input->post('state_name',TRUE)),"add");
        if ($this->form_validation->run() == FALSE)
        {	
			
            //set_flashdata("error",validation_errors());
            $data_status = 'error_required';
			return $data_status;
        } elseif($st == FALSE)
        {
			
            //set_flashdata("error","Client Id already exists");
			$data_status = 'error';
			return $data_status;
            //return FALSE;
        } 
        
        $data['state_id']             = $this->input->post('state_name',TRUE); 
        $data['country_id']             = $this->input->post('country_name',TRUE); 
        $data['city_name']             = $this->input->post('city_name',TRUE);
		$data['status']        			 = $this->input->post('status',TRUE);
        $data['created_date']           = current_date();
        $data['modified_date']          = current_date();
        //pr($data);die;
        //set_common_insert_value();        
        $this->db->insert($this->table,$data);           
        $id = $this->db->insert_id();

        add_report($id);
        
        set_flashdata("success",lang('success'));
        return $id;
    }
    
    // ------------------------------------------------------------------------

    /**
     * Get Company
     *
     * This function Get Company search by company id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {  
       //filter_data($this->table);
	  
        //$this->db->where('id',$id);
        $sql = $this->db->select("ci.*,co.id as country_id,co.country_name,st.state_name")
               ->from("cities ci")
               ->join("states st" , 'st.id=ci.state_id')
               ->join("countries co" , 'co.id=st.country_id')
               ->where(array("ci.id" => $id));
    
         $query = $sql->get()->row();
         return $query;
           
        //show_404();
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
            $this->db->like("CONCAT(ci.city_name,st.state_name,co.country_name)",$text);
        }

        if($order_by && $order)
           // $this->db->order_by($order_by, $order);

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        //filter_data($this->table);      
        $query = $this->db->select("ci.*,co.country_name,st.state_name")
               ->from("cities ci")
               ->join("states st" , 'st.id=ci.state_id')
               ->join("countries co" , 'co.id=st.country_id')
               ->get();
        //->row();
        
        //pr($query->result());exit;
        //echo $this->db->last_query();exit;
		//pr($offset);
        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
        return $data;
    }
    
    public function is_unique_names($val,$country_id,$state_id,$method) {

        //$database=DEFAULT_DATABASE;
        // echo "SELECT id FROM $this->table WHERE country_name='$name' AND id!=".$country_id;die;	
        $id = $this->uri->segment(4);
		//pr($method);die;
		if($method=='add'){
			$query=$this->db->query("SELECT id FROM cities WHERE city_name='$val'  AND country_id=".$country_id." AND state_id=".$state_id);
			//echo "SELECT id FROM states WHERE state_name='$val'  AND country_id=".$country_id;exit;
		}else{
			$query=$this->db->query("SELECT id FROM cities WHERE city_name='$val' AND id!=".$id." AND country_id=".$country_id." AND state_id=".$state_id);
		}
        
        //echo "SELECT id FROM states WHERE state_name=".$val." AND id!=".$id." AND country_id=".$country_id;exit;
        $count=$query->num_rows();
		//pr($count);die;
        if ($count > 0)
        {
            return FALSE;
        }
        else
        {
			//echo"atyyaa";die;
            return TRUE;
        }
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
    function update($id = NULL)
    {
       $this->form_validation->set_rules('city_name', lang('city_name'), 'trim|required');
  	    //$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
        $this->form_validation->set_rules('state_name', lang('state_name'), 'trim|required');
        $this->form_validation->set_rules('country_name', lang('country_name'), 'trim|required');
        $st = $this->is_unique_names(strtolower($this->input->post('city_name',TRUE)),strtolower($this->input->post('country_name',TRUE)),strtolower($this->input->post('state_name',TRUE)),"edit");
        if ($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            $data_status = 'error_required';
			return $data_status;
        } elseif($st == FALSE)
        {
            //set_flashdata("error","Client Id already exists");
			$data_status = 'error';
			return $data_status;
            //return FALSE;
        } 
        //pr($_POST);die;
        $data['state_id']             = $this->input->post('state_name',TRUE); 
        $data['country_id']             = $this->input->post('country_name',TRUE); 
        $data['city_name']            = strtolower($this->input->post('city_name',TRUE));
		$data['status']         = $this->input->post('status',TRUE);
        $data['modified_date']        = current_date();
      // $data['short_code']            = $this->input->post('ind_short_code',TRUE);
        filter_data($this->table);
        $this->db->where("id",$id);
        //set_common_update_value();
        $r = $this->db->update($this->table,$data);
        
        update_report($id);
        
        if($r)
            set_flashdata("success",lang('updated'));
                    
        return $r;
    }
    
   
    function get_flexigrid_cols()  
    {
           $data = array(
            array(
                "display"   =>"Id",
                "name"      =>"id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('country_name'),
                "name"      =>"country_name",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('state_name'),
                "name"      =>"state_name",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('city_name'),
                "name"      =>"city_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('status'),
                "name"      =>"status",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('created'),
                "name"      =>"created_date",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('modified'),
                "name"      =>"modified_date",
                "order_by" => "yes"
            )
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
		$controllerInfo=$this->uri->segment(2)."/".$this->uri->segment(3);
		//pr($controllerInfo);die;
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
        $controllerInfo=$this->uri->segment(2)."/".$this->uri->segment(3);
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
		//pr($array);die;
		$query=$this->db->insert_string($this->per_page,$array); 
		$result=$this->db->query($query);
		//pr($result);die;
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

		//$this->db->select("$this->table .id,$this->table2 .country_name,$this->table1 .state_name,$this->table .city_name");
        //$this->db->from("$this->table");
		//$this->db->order_by("city_name");

		//$this->db->where_in("id",$items_data);
       
        //$query = $this->db->get();
        
        //$data= $query->result_array();		
        //return $data;
        
        $sql = $this->db->select("ci.id,ci.city_name,co.country_name,st.state_name")
               ->from("cities ci")
               ->join("states st" , 'st.id=ci.state_id')
               ->join("countries co" , 'co.id=st.country_id')
               ->get();
        
        $data= $sql->result_array();		
		return $data;
	}
    
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



    public function check_name_existance($name,$country_id,$state_id,$city_id=Null) {

        //$database=DEFAULT_DATABASE;
        //echo $name;
   
      
        if(empty($city_id)){
            $query=$this->db->query("SELECT id FROM $this->table WHERE city_name='$name' && country_id = '$country_id' && state_id = '$state_id' ");
        }else{
        
           $query=$this->db->query("SELECT id FROM $this->table WHERE id !='$city_id' && city_name='$name' && country_id = '$country_id' && state_id = '$state_id' "); 
        }

        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }


    public function is_unique_city_name($name,$country_id,$state_id) {

        //$database=DEFAULT_DATABASE;
        // echo "SELECT id FROM $this->table WHERE country_name='$name' AND id!=".$country_id;die;
        $city_id = $this->uri->segment(4);
       // echo $city_id;die;
        if(empty($city_id)){
               $query=$this->db->query("SELECT id FROM $this->table WHERE city_name='$name'  AND country_id = " .$country_id." AND state_id = " .$state_id );
        }else{
             $query=$this->db->query("SELECT id FROM $this->table WHERE city_name='$name' AND id!=".$city_id." AND country_id = " .$country_id." AND state_id = " .$state_id );  
        }
     
        //echo "SELECT id FROM $this->table WHERE city_name='$name' AND id!=".$city_id." AND country_id = " .$country_id." AND state_id = " .$state_id;exit;
        $count=$query->num_rows(); 
        if ($count)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
   
}
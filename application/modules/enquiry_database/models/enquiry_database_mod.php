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
 
class Enquiry_database_mod extends CI_Model {
    
    public $table   	= TBL_PREFIX."enquiry";
    public $enq_product = TBL_PREFIX."enquiry_product";
    public $enq_document = TBL_PREFIX."enquiry_document";
    public $product_quot = TBL_PREFIX."enquiry_quotation";
    public $enq_revision = TBL_PREFIX."enquiry_revision";
	public $per_page	= "per_page";

    /**
	 * Constructor
	 */     
    public function __construct()
    {
        parent::__construct();
    }
      
    function ajax_list_items($text, $limit, $offset, $order_by='form_id', $order='desc',$type = NULL, $enquiry_id = NULL, $is_export=false, $items_data = NULL ) {
		
        $offset = ($offset - 1) * $limit;
        if($is_export==false)
        {
            $this->db->limit($limit, $offset);
        }
        if($is_export==true &&  !empty($items_data))
        {
            $this->db->where_in("ep.form_id", $items_data);
        }
        $search_keyword=strtolower(trim($text));
        //pr($search_keyword);die;
        if($search_keyword) {
            $where = "(ep.description_issued_by_customer LIKE '%$search_keyword%' OR ep.description_issued_by_inch LIKE '%$search_keyword%' OR ep.make_issue_inch LIKE '%$search_keyword%' OR ep.description_issued_by_cfit LIKE '%$search_keyword%' OR ep.make_issue_cfit LIKE '%$search_keyword%' OR um.name LIKE '%$search_keyword%' OR e.enq_no LIKE '%$search_keyword%' )";
			$this->db->where($where);
        }

        if($order_by && $order){
            $this->db->order_by($order_by, $order);
        }

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
       /// filter_data($this->enq_product);   // c is alias of companies   
        //$query = $this->db->get();
       // pr($query->result());exit;
        // echo $this->db->last_query();exit;
		
		if($form_id)
        {
            $this->db->where('ep.'.PRIMARY_KEY, $form_id);
        }
        $this->db->select("SQL_CALC_FOUND_ROWS e.form_id as main_enquiry_id,e.enq_no,ep.*, um.name as unit_name, hsn.name as hsn_name",FALSE);
        $this->db->join(TBL_PREFIX.'unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->join($this->table.' as e','e.form_id=ep.enquiry_id','LEFT');
        // $this->db->join('users as u2','u2.id=ep.make_issue_cfit','LEFT');
        if($enquiry_id)
        {
            $this->db->where('ep.enquiry_id',$enquiry_id);
        }
        if($type)
        {
            $this->db->where('e.enquiry_type',$type);
        }
        $this->db->order_by('ep.'.PRIMARY_KEY, 'ASC');
        $this->db->group_by('ep.'.PRIMARY_KEY, 'ASC');
        $query = $this->db->get($this->enq_product.' AS ep');
        $data['result'] = $query->result();
        //pr($this->db->last_query());die;
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"]  = $query->row()->count;
        $data['offset'] = $offset;
		//pr($data);die;
        return $data;
    }  

	function get_flexigrid_cols()  
    {
           $data = array(
            array(
                "display"   =>'Comm ID',
                "name"      =>"enq_no",
                "order_by" => "yes"
            ),array(
                "display"   =>'Description issued by Customer',
                "name"      =>"description_issued_by_customer",
                "order_by" => "yes"
            ),array(
                "display"   =>'Description issued by  Inch',
                "name"      =>"description_issued_by_inch",
                "order_by" => "yes"
            ),array(
                "display"   =>'Make issued by inch',
                "name"      =>"make_issue_inch",
                "order_by" => "yes"
            ),array(
                "display"   =>'Qty',
                "name"      =>"qty",
                "order_by" => "yes"
            ),array(
                "display"   =>'UOM',
                "name"      =>"unit_name",
                "order_by" => "yes"
            ),array(
                "display"   =>'Description issued by  CFIT',
                "name"      =>"description_issued_by_cfit",
                "order_by" => "yes"
            ),array(
                "display"   =>'Make issued by CFIT',
                "name"      =>"make_issue_cfit",
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
		if($result){			
			return true;
		}else{			
			return false;
		}	
    }
    

}
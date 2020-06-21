<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model
 *  @package		Rookie
 * @subpackage	Models
 * @category	Common * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Common_mod extends CI_Model
 {
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
        
        
        
    }
    
    //----------------------------------------------------------------------------------
      /**
     * Get  Contract Type
     *
     * This function will Get Contract Type  
     * 
     * @access	public
     * @return	Object 
     */     
    
    public function get_contract_type()
    {
        $query = $this->db->get("visa_type");
        return $query->result(); 
    }
    
    
      //----------------------------------------------------------------------------------
      /**
     * Get  Source
     *
     * This function will Get Source   
     * 
     * @access	public
     * @return	Object 
     */     
    
    public function get_source()
    {
        $query = $this->db->get("source");
        return $query->result(); 
    }
	
	
	 //----------------------------------------------------------------------------------
      /**
     * Get  Work Status
     *
     * This function will Get Source   
     * 
     * @access	public
     * @return	Object 
     */     
    
    public function get_work_status()
    {
        $query = $this->db->get("work_status");
        return $query->result(); 
    }
	
	
	 //----------------------------------------------------------------------------------
      /**
     * Get Education
     *
     * This function will Get Education   
     * 
     * @access	public
     * @return	Object 
     */    
	public function get_education()
    {
        $query = $this->db->get("education");
        return $query->result(); 
    }
	
	
	/**
 * Find model data from the database.
 * @purpose Function to retrieve single row from database
 * @param String $table Name of table to retrieve data
 
 * @param Array condition Used to perform find operations for finding
 * @param Array fields to spacify in list for column retrieval 
	Eg.
		$this->common_mod->findFirst('tableName',array('id'=>"2","email"=>'ajit3790@gmail.com'),array('id','email') );
			
 *  
 * @return mixed $data
 */
	function findFirst($table=null,$conditions=array(),$fields=array()){
		if($fields!=null){
			if(is_array($fields)){
				if(count($fields) > 0){
					foreach($fields as $key=>$value){
						$this->db->select("$table.$value",false);
					}
				}else{
					$this->db->select("$table.*",false);
				}
			}else{
				$this->db->select("$table.$fields",false);
			}
		}else{
			$this->db->select("$table.*",false);
		}

		$this->db->from($table);
		
		if(is_array($conditions)){
			$indexer=1;
			foreach($conditions as $k=>$val){
				if($indexer==1){
					$this->db->where("$k","$val");
				}else{
					$this->db->where("$k","$val");
				}
			}
		}else{
			$this->db->where("$key","$conditions");
		}

		$query_data=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query_data->row();
	}

	
    
}
    
    
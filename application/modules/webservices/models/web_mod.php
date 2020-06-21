<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Web_mod extends CI_Model {

    var $table = "services";
    function __construct() {
        parent::__construct();
    }

	/*****************function for login*****************/
	function login($email=null, $password=null) {
		$this->db->select('*');
	    $this->db->from('testuser');
        $this->db->where('password', ($password));
         $this->db->where('email', ($email));
        //$where = "(email_id ='$email_id' or phone = '$email_id')";
         //$this->db->where($where);
         $this->db->where('status', '1');
	     $this->db->limit(1);
	    $query = $this->db->get();
	    if($query->num_rows()==1) {
		 return $query->row();
	    } else {
		 return false;
	    }
	}


    /*****************function for login*****************/
    
    /*****************function for upload Resume*****************/
    function upload_file(){
        
        if(!empty($_FILES['resume']['name']) ){   
        
                $config['upload_path'] = './uploads';
        		$config['allowed_types'] = '*';
                $config['max_width']  = '0';
        		$config['max_height']  = '0';
                $config['encrypt_name'] = '0';
                $config['remove_spaces'] = TRUE;
                
             
                
                $this->load->library('upload');
                $this->upload->initialize($config); 
                $this->upload->do_upload('resume');
            
            
                if(!$this->upload->data()){
               
                    $error = '';
                    $this->upload->display_errors('<p>','</p>');
                    $errors = $this->upload->display_errors();
                   // echo $errors;
                    //die;
                   $array = array('error' => $this->upload->display_errors());
                    //Here return the image error validation
                    					
                }
                else
                {
                
                   $array = array('upload_data' => $this->upload->data());
                   }
            }
           
            return $array;
    }
    function uploadResume(){
        $resume='';
        $created = date('Y-m-d h:i:s');
        @$file_data=$this->upload_file();
         $resume = $file_data['upload_data']['file_name'];
        $data = array(
        'user_id' => $_POST['user_id'],
        'site_id' => $_POST['site_id'],
        'resume' => $resume,
        'created' => $created
        );
        
        $this->db->insert('all_resume' ,$data);
        $data = $this->db->insert_id();
        return $data; 
  }
  /*****************function for upload Resume*****************/  
	
}

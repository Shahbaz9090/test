<?php

 if ( !function_exists('update_data') ) {
    /**
	 *
	 * save data into table
     * @param $table string table name
     * @param array data to be updated
     * @param array key fields 
	 * @access	public
	 * @return	int
     * 
	 */	    
     
   function update_data($data,$table,$id=null)
	{

        $CI = &get_instance();
        $CI->db->where($id);
        $CI->db->update($table, $data); 
    }
}


 if ( !function_exists('get_data') ) {
    /**
	 *
	 * save data into table
     * @param $table string table name
     * @param array data to be updated
     * @param array key fields 
	 * @access	public
	 * @return	int
     * 
	 */	    
     
   function get_data($table,$id=null,$attr=null)
	{

        $CI = &get_instance();
        if($attr)$CI->db->select($attr);
        if($id)$CI->db->where($id);
        $result  = $CI->db->get($table);
        foreach($result->result() as $row){
            return $row;
        }
        return null; 
    }
}

     
    function last_msg($msg_type, $email, $type, $country_type)
	{
        // echo $msg_type;
        $CI = &get_instance();
        $CI->db->select('id,mail_id,last_sync');
        $CI->db->order_by('id', 'DESC');
        $CI->db->where("mail_id IS NOT NULL", NULL, FASLE);
        $CI->db->limit(1);
        if($country_type=='2')
        {
            $CI->db->where(array('msg_type'=>$msg_type));
        	$result  = $CI->db->get('email_data_china');
        }
        else
        {
            $CI->db->where(array('msg_type'=>$msg_type,'type'=>$type));
        	$result  = $CI->db->get('email_data');
        }
        $CI->db->where("mail_id <> NULL", NULL, FASLE);
		return $result->row();
        // echo $CI->db->last_query();die;
    }

    function last_msg_id_new($user_id, $msg_type, $email, $type, $country_type)
    {
        $CI = &get_instance();
        $CI->db->select_max('mail_id');
        if($country_type=='2')
        {
            $CI->db->where(array('msg_type'=>$msg_type));
            $result  = $CI->db->get('email_data_china');
        }
        else
        {
            $CI->db->where(array('msg_type'=>$msg_type,'type'=>$type));
            $result  = $CI->db->get('email_data');
        }
        $mailid = $result->row();
        $id=$mailid->mail_id;
        return $id;
    }
	
    function last_msg_id($id,$type,$email)
    {
    
        $CI = &get_instance();
        $CI->db->where(array('user_id'=>$id,'msg_type'=>$type,'to'=>$email));
        $CI->db->select_max('mail_id');
        $result  = $CI->db->get('email_data');
        //$mailid=$result->result();
        //$id=$mailid[0]->mail_id;
        //if($id==''){
        //  $id=0;
        //}
        //return $id;
        //print_r($result->result());die;
        //echo $CI->db->last_query();die;
        foreach($result->result() as $row){
           return $row->mail_id;
        } 
    }
    
	
	
	function get_data_last_dates_new($user_id, $msg_type,$email, $type, $country_type)
	{
	
        $CI = &get_instance();
		$CI->db->select_max('last_sync');
        if($country_type=='2')
        {
            $CI->db->where(array('msg_type'=>$msg_type));
        	$result  = $CI->db->from('email_data_china');
        }
        else
        {
            $CI->db->where(array('msg_type'=>$msg_type,'type'=>$type));
        	$result  = $CI->db->from('email_data');
        }
        // $CI->db->order_by('id', 'desc');
        // $CI->db->where(array('user_id'=>$id));
        $CI->db->limit(1);
        return $query = $CI->db->get()->row()->last_sync;
        // echo $CI->db->last_query();die;
        
    }

	function get_data_last_dates($id,$type,$email)
    {
    
        $CI = &get_instance();
        //$CI->db->where(array('user_id'=>$id,'msg_type'=>$type,'to'=>$email));
       // $CI->db->select_max('mail_id');
       // $result  = $CI->db->get('email_data');
        
        $CI->db->select('*');
        $CI->db->from('email_data');
        $CI->db->order_by('id', 'desc');
        $CI->db->where(array('user_id'=>$id));
        $CI->db->limit(1);
        $query = $CI->db->get();
        // echo $CI->db->last_query();die;
        foreach($query->result() as $row){
           return $row->last_sync;
        } 
    }
    
	


/* last message id for sendbox */
function last_msg_id_sendbox($id,$type,$email)
	{

        $CI = &get_instance();
        $CI->db->where(array('user_id'=>$id,'msg_type'=>$type,'from'=>$email));
        $CI->db->select_max('mail_id');
        $result  = $CI->db->get('email_data');
        //echo $CI->db->last_query();
        foreach($result->result() as $row){
           // echo $CI->db->last_query();
          
            return $row->mail_id;
        } 
    }



if ( !function_exists('get_data_last_date') ) {
    /**
	 * sonam Singh
	 * save data into table
     * @param $table string table name
     * @param array data to be updated
     * @param array key fields 
	 * @access	public
	 * @return	int
     * 
	 */	    
     
   function get_data_last_date($table,$id=null,$attr=null)
	{

        $CI = &get_instance();
        if($attr)$CI->db->select($attr);
        if($id)$CI->db->where($id);
        $result  = $CI->db->get($table);
        foreach($result->result() as $row){
            return $row;
        }
        return null; 
    }
}

    function mypr($data=null){
        echo "<pre>";
        print_r($data);die;
    }

    if (!function_exists('get_smtp_user')) {

        function get_smtp_user($type='sales_spares_email', $category=1)
        {

            $CI = &get_instance();
            if($type)$CI->db->where("type", $type);
            if($type)$CI->db->where("category", $category);
            return $CI->db->get('inch_emailsmtpuserpass')->row();
            
        }
    }

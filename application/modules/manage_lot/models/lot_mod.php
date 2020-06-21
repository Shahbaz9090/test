<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		
 * @subpackage	Models
 * @category	Company
 * @author		Pradeep 
 * @website		http://www.pradeepdev.in
 * @company     Techbiddiesit Inc
 * @since		Version 1.0
 */
 
class Lot_mod extends CI_Model {
    
    public $table   	   	= TBL_PREFIX."manage_lot";
    public $table_detail    = TBL_PREFIX."manage_lot_detail";
    public $lot_chat        = TBL_PREFIX."lot_ticket_logs";
    public $lot_document    = TBL_PREFIX."lot_document";
	public $user_id			= NULL;
    
    public function __construct()
    {
        parent::__construct();
        $this->user_id = currentuserinfo()->id;
    }
      
    public function get_list($type, $id='', $count='', $limit='', $start='')
    {
        $search_keyword = $this->input->get_post('search_keyword');
        if(isset($search_keyword) && !empty($search_keyword))
        {
            $search_keyword = strtolower($search_keyword);
            $this->db->like("LOWER(CONCAT(e.client_subject,' ',e.internal_subject,' ',e.payment_terms,' ',e.enq_no,' ',e.notes,' ',e.rfq_pr_no,' ',c.name,' ',u.first_name,' ',u.last_name,' ',u2.first_name,' ',u2.last_name,' ',ug.name,' ',es.name as status_name))", $search_keyword);
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
        filter_data('e');

        $this->db->order_by('e.'.PRIMARY_KEY, 'DESC');
		$query = $this->db->get($this->table .' AS e');
        $data['result'] = $query->result();
        // pr($data['result']);die;
        // echo $this->db->last_query();exit;
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"]  = $query->row()->count;
		// pr($data);die;
        return $data;
    }
        
    public function __get_product_list($id, $order_id = NULL, $po_nos=NULL)
    {
        if(!empty($id) && is_array($id))
        {
            $this->db->where_in('ep.'.PRIMARY_KEY, $id);
        }
        elseif(!empty($id))
        {
            $this->db->where('ep.'.PRIMARY_KEY, $id);
        }
        $this->db->select("ep.*, um.name as unit_name, hsn.name as hsn_name,hsn.gst,hsn.hsn_no,hsn.customs_duty,sc.name as supplier_name, sv.name as supplier_type_name, concat(u.first_name,' ',u.last_name) as added_by_name",FALSE);
        $this->db->join(TBL_PREFIX.'unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=ep.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=ep.supplier','LEFT');
        $this->db->join('users as u','u.id=ep.added_by','LEFT');
        if($order_id)
        {
            $this->db->where('ep.order_id',$order_id);
        }
        if($po_nos)
        {
            $this->db->where('ep.supplier_po',$po_nos);
        }
        $this->db->order_by('ep.'.PRIMARY_KEY, 'ASC');
        $query = $this->db->get($this->enq_product.' AS ep');
        // return $query->result();
        $product_list = $query->result();
        return $product_list;
        // echo $this->db->last_query();die;
    }
    
    public function add($order_id=NULl)
    {
        // pr($_POST);
        // $this->form_validation->set_rules('invoice_no', lang('invoice_no'), 'trim|required');
        $this->form_validation->set_rules('client_reference', lang('client_reference'), 'trim|required');
        $this->form_validation->set_rules('source', lang('source'), 'trim|required');
        $this->form_validation->set_rules('destination', lang('destination'), 'trim|required');
        $this->form_validation->set_rules('via', lang('via'), 'trim|required');
        $this->form_validation->set_rules('mode_of_dispatch', lang('mode_of_dispatch'), 'trim|required');
        $this->form_validation->set_rules('terms_of_delivery', lang('terms_of_delivery'), 'trim|required');
        $this->form_validation->set_rules('lot_date', lang('lot_date'), 'trim|required|');
                
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        
        $data['invoice_no']         = "INV".strtoupper(uniqid());
        $data['client_reference']   = $this->input->post('client_reference',TRUE);
        $data['source']             = $this->input->post('source',TRUE);
        $data['destination']        = $this->input->post('uom',TRUE);
        $data['via']                = $this->input->post('via',TRUE);
        $data['mode_of_dispatch']   = $this->input->post('mode_of_dispatch',TRUE);
        $data['terms_of_delivery']  = $this->input->post('terms_of_delivery',TRUE);
        $data['lot_date']           = $this->input->post('lot_date',TRUE);
        
        set_common_insert_value();
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success",lang('add_lot_success'));
        return $last_id;
    }

    public function get_order_list($searchText=NULL, $limit = 20)
    {

        $this->db->select('po_no,form_id');
        if(isset($searchText) && !empty($searchText))
        {
            $this->db->like('po_no',$searchText);
        }
        else
        {
            $this->db->limit($limit);
            $this->db->order_by('form_id', 'DESC');
        }
        return $this->db->get('inch_order')->result();
    }

    public function get_order_product_list($p_ids, $added_product = NULL)
    {
        $this->db->select('op.form_id,op.order_id,op.description_issued_by_customer,op.description_issued_by_inch,op.qty,op.uom,op.unit_price,o.po_no,op.unit_offer_price,op.total_unit_offer_price');
        $this->db->join('inch_order as o','o.form_id=op.order_id','LEFT');
        $this->db->where_in('op.form_id', $p_ids);
        if(isset($added_product) && !empty($added_product))
        {
            $this->db->where_not_in('op.form_id', $added_product);
        }
        $this->db->where_in('op.is_received', 1);
        $this->db->where_in('op.is_lot', 0);
        $this->db->order_by('op.order_id', 'DESC');
        return $this->db->get('inch_order_product as op')->result();
    }

    public function get_mail_list($id = NULL, $china_mail_id = NULL)
    {
        $final_data = [];
        if(isset($id) && !empty($id))
        {
            $data = [];
            $ids = explode(",", $id);
            $this->db->where_in('ed.id', $ids);
            $data['mail_list'] = $this->db->get($this->email.' as ed')->result();
            $data['mail_doc'] = $this->get_doc($id);
            $final_data['india_mail_list'] = $data;
        }

        if(isset($china_mail_id) && !empty($china_mail_id))
        {
            $data = [];
            $china_mail_ids = explode(",", $china_mail_id);
            $this->db->where_in('ed.id', $china_mail_ids);
            $data['mail_list'] = $this->db->get($this->email.' as ed')->result();
            $data['mail_doc'] = $this->get_doc($id);
            $final_data['china_mail_list'] = $data;
        }

        return $final_data;
    }

    public function add_document($order_id)
    {
        if(isset($_FILES['document_name']) && !empty($_FILES['document_name']['name']) && isset($_POST['order_id']) && !empty($_POST['order_id']) && isset($_POST['document_type']) && !empty($_POST['document_type']))
        {
            // pr($_POST);die;
            $order_id =  $_POST['order_id'];
            $user_id    = currentuserinfo()->id;
            $current_ip = current_ip();
            $path       = 'upload/order/';
            $data = [];
            foreach ($_FILES['document_name']['name'] as $myfile_key => $myfile) {
                $_FILES['myfile']['name']     = $_FILES['document_name']['name'][$myfile_key];
                $_FILES['myfile']['type']     = $_FILES['document_name']['type'][$myfile_key];
                $_FILES['myfile']['tmp_name'] = $_FILES['document_name']['tmp_name'][$myfile_key];
                $_FILES['myfile']['error']    = $_FILES['document_name']['error'][$myfile_key];
                $_FILES['myfile']['size']     = $_FILES['document_name']['size'][$myfile_key];
                $fileData = $this->uploadFiles($_FILES['myfile'], $path);
                // pr($fileData);die;
                if(isset($fileData['success'])){
                    $data[$myfile_key]['document']          = $_FILES['document_name']['name'][$myfile_key];
                    $data[$myfile_key]['file_name']         = $fileData['success']['file_name'];
                    $data[$myfile_key]['added_by']          = $user_id;
                    $data[$myfile_key]['last_ip']           = $current_ip;
                    $data[$myfile_key]['order_id']        = $order_id;
                    $data[$myfile_key]['document_type ']    = $_POST['document_type'];
                }
            }

            // pr($data);die;
            if(isset($data) && !empty($data))
            {
                $status = $this->db->insert_batch($this->lot_document, $data);
            }
            return $status;
        }
    }  

    public  function get_ticket_message_chat($ticket_id_for_message){
        // echo "string";
        $query = $this->db->query("SELECT `et`.*, concat(snd.first_name, ' ', snd.last_name) as SENDER_NAME, concat(rcv.first_name, ' ', rcv.last_name) as RECEIVER_NAME FROM ".$this->lot_chat." as `et` JOIN `users` as `snd` ON `snd`.`id` = `et`.`sender` JOIN `users` as `rcv` ON `rcv`.`id` = `et`.`receiver` WHERE `et`.`ticket_id` = $ticket_id_for_message");
        $data = $query->result_array();
        return $data;
        // pr($data);die;
        // echo $this->db->last_query();die;
    }
           
    public function insert_chat($data=array()){
        
        return $this->db->insert($this->lot_chat, $data);

    }
        
    public function get_unreadchat($order_id)
    { 
        $query = $this->db->query("SELECT * FROM $this->lot_chat WHERE ticket_id = '" . (int)$order_id . "' AND is_read='0'");
        return $query->row_array();
    }
        
    public function updatechat($ticket_id)
    {
        
        $result = $this->db->get_where($this->lot_chat, ['ticket_id'=>$ticket_id])->result();
        // pr($result);die;
        foreach ($result as $key => $row) {
            if(isset($row->read_by) && !empty($row->read_by))
            {
                $read_by = $row->read_by;
                $read_by = explode(",", $read_by);
                // echo $this->user_id;
                // pr($read_by);die;
                if(!in_array("$this->user_id", $read_by))
                {
                    // echo "if";
                    $read_by[] = $this->user_id;
                    $data['read_by'] = implode(',', $read_by);
                    // pr($data['read_by']);die;
                    $this->db->where('ticket_id', $ticket_id);
                    $this->db->where('id', $row->id);
                    $this->db->update($this->lot_chat, $data);
                }
            }
            else
            {
                $data['read_by'] = $this->user_id;
                $this->db->where('ticket_id', $ticket_id);
                $this->db->where('id', $row->id);
                $this->db->update($this->lot_chat,$data);
            }
        }
    }
        
    public function get_chat_count_user_wise($ticket_id) {

        $this->db->select("count(id) as chat_count");
        $this->db->where("added_by!=", $this->user_id, FALSE);
        $this->db->where("( NOT FIND_IN_SET('".$this->user_id."', read_by) OR read_by IS NULL)",NULL, FALSE);
        $chat_count = $this->db->get($this->lot_chat)->row()->chat_count;
        return $chat_count;
        // echo $this->db->last_query();die;
    }

    public function get_all_message_chat_count_admin() {

        $query = $this->db->query("SELECT `FSTL`.*, concat(FS_U.first_name, ' ', FS_U.last_name) as SENDER_NAME, concat(FS_UR.first_name, ' ', FS_UR.last_name) as RECEIVER_NAME FROM ".$this->lot_chat." as `FSTL` JOIN `oc_customer` as `FS_U` ON `FS_U`.`customer_id` = `FSTL`.`sender` JOIN `oc_customer` as `FS_UR` ON `FS_UR`.`customer_id` = `FSTL`.`receiver`  WHERE `FSTL`.`receiver` = '1' AND `FSTL`.`is_read` = '0' ORDER BY FSTL.ticket_id DESC ");
        return $query->row();
    }
    
    public function get_all_message_chat_admin() {
        //echo 'in model ghbvuhb';print_r($customer_id);die; 
        $query = $this->db->query("SELECT `FSTL`.*,O.customer_id  FROM ".$this->lot_chat." as `FSTL`   JOIN `oc_order` as `O` ON `O`.`order_id` = `FSTL`.`ticket_id` WHERE `FSTL`.`receiver` = '1'  AND `FSTL`.`is_read` = '0' ORDER BY FSTL.ticket_id DESC ");
        $i=1;
        $j=1;
        $st=$query->row();
        //echo '<pre>';print_r($st);die;
        
        $k=0;
        
        foreach($query->rows as $key=> $val) {
            //echo '<pre>';print_r($st[$key]['ticket_id']);
            if($query->rows[$key-1]['ticket_id']!=$query->rows[$key]['ticket_id']){
            $data[$k]['customer_id']=$val['customer_id'];
            $data[$k]['ticket_id']=$val['ticket_id'];
                $k++;
            }
            
            
        }
        //echo '<pre>';print_r($data);die;
        
        foreach($data as $key=> $val) {
            //echo '<pre>';print_r($st[$key]['ticket_id']);
            
            foreach($query->rows as $k=> $v) {
                if($val['ticket_id']==$v['ticket_id']){
                    $data[$key]['chat_id']=$j++;
                }
            }
            $j=1;
        }
        
        //echo '<pre>';print_r($data);die;
        return $data;
    }

}
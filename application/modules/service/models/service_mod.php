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
 
class Service_mod extends CI_Model {
    
    public $table   	   	= TBL_PREFIX."service";
    public $job_table       = TBL_PREFIX."job_card_details";
    public $box_table       = TBL_PREFIX."service_delivery_box";
    public $job_offer       = TBL_PREFIX."job_offer";
    public $invoice_table   = TBL_PREFIX."job_invoice";
    public $job_estimation  = TBL_PREFIX."job_estimation";
    public $enq_document    = TBL_PREFIX."order_document";
    public $order_chat    	= TBL_PREFIX."order_ticket_logs";
    public $email       	= "email_data";
	public $per_page		= "per_page";
	public $user_id			= NULL;
       
    public function __construct()
    {
        parent::__construct();
        $this->user_id = currentuserinfo()->id;
    }
      
    public function get_service_list($id='', $count='', $limit='', $start='')
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
      	$this->db->select("SQL_CALC_FOUND_ROWS e.*,c.name client_name,cc.name client_issuer_name,cc1.name client_technical_name,concat(s.first_name,' ',s.last_name) sales_lead_name,concat(s1.first_name,' ',s1.last_name) service_lead_name,s1.mobile servie_lead_mobile,c.company_address as client_address",FALSE);
        $this->db->join('companies as c','c.id=e.client','LEFT');
        $this->db->join('companies_contact AS cc','cc.id=e.client_issuer','LEFT');
        $this->db->join('companies_contact AS cc1','cc1.id=e.client_technical','LEFT');
        $this->db->join('users as s','s.id=e.sales_lead','LEFT');
        $this->db->join('users as s1','s1.id=e.sevice_lead','LEFT');
        // $this->db->join('inch_order_status_master as es','es.form_id=e.current_status','LEFT');
        // $this->db->join('inch_order_status_china_master as cs','cs.form_id=e.china_status','LEFT');
        // $this->db->join('users as u2','u2.id=e.cfit_name','LEFT');
        // $this->db->join('user_groups as ug','ug.id=u.group_id','LEFT');
        // $this->db->join('inch_enquiry as eq','eq.enq_no=e.enq_no','LEFT');
        // $this->db->join($this->enq_product.' as p','p.order_id=e.form_id','LEFT');
        $this->db->group_by('e.form_id');
        
        $this->db->order_by('e.'.PRIMARY_KEY, 'DESC');
		$query = $this->db->get($this->table .' AS e');
        $data['result'] = $query->result();
        // pr($data['result']);die;
        // echo $this->db->last_query();exit;
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"]  = $query->row()->count;

		// pr($data);die;
		if(isset($data['result']) && !empty($data['result']))
		{
			foreach ($data['result'] as $key => $row) {
				$chat_count = $this->get_chat_count_user_wise($row->form_id);
				$data['result'][$key]->chat_count = $chat_count;
			}
		}
		// pr($data['result']);die;
        return $data;
    }
    
    public function insert_job_card_entry($service_id)
    {
        if(isset($service_id) && !empty($service_id))
        {
            $data1 = [];
            //first get no. of card & then insert same
            $this->db->select('no_of_cards')->from($this->table)->where('form_id',$service_id);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $no_of_cards = (int) $query->row()->no_of_cards;
                if($no_of_cards > 0)
                {
                    for($i =1; $i <= $no_of_cards;$i++)
                    {
                        $data['service_id']   = $service_id;
                        $data['job_sequence'] = $i;
                        $data['added_by']     = currentuserinfo()->id;
                        $data['created_time'] = date('Y-m-d H:i:s');
                        $data1[]              = $data;
                    }
                }
                // var_dump($data1);die;
                if(!empty($data1))
                {
                    $this->db->insert_batch($this->job_table, $data1);
                }
                
                $last_id = $this->db->insert_id();
                add_report($service_id);
                set_flashdata('success','Service added successfully!!');
                redirect($this->data['module_url'].'/list_items');
            }
        }
    }

    public function get_estimation($service_id)
    {
        $this->db->select("ep.*,ep.form_id job_id,s.inquiry_no,h.original_cost,h.repairable,e.offloading_cost,e.components_cost,e.original_cost,e.service_time,e.testing_time,e.quality_time,e.lead_time", FALSE);
        $this->db->join("inch_job_estimation h","ep.form_id = h.job_id", 'left');
        $this->db->join($this->table." s","s.form_id = ep.service_id", 'left');
        $this->db->join($this->job_estimation." e","e.job_id = ep.form_id", 'left');
        $this->db->where('ep.service_id',$service_id);
        // $this->db->where_in('ep.form_id',$ids);
        $this->db->order_by('ep.job_sequence','asc');
        $query = $this->db->get("inch_job_card_details".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }
    
    public function add_offer($service_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('analysis_cost', 'Analysis Cost', 'trim|required|');
        $this->form_validation->set_rules('repairing_cost', 'Repairing Cost', 'trim|required');
                    
        if($this->form_validation->run() == FALSE)
        {
            // echo validation_errors();die;
            set_flashdata("error", validation_errors());
            return FALSE;
        }

        $data['analysis_cost']     = $this->input->post('analysis_cost',TRUE);
        $data['repairing_cost']    = $this->input->post('repairing_cost',TRUE);
        $data['job_id']            = $this->input->post('job_id',TRUE);

        //first get offer rev no
        $rev_no = 0;
        $this->db->select('max(rev_no) as rev_no')->where('job_id',$data['job_id'])->where('service_id',$service_id);
        $query = $this->db->get('inch_job_offer');
        if($query->num_rows() > 0)
        {
            $rev_no = $query->row()->rev_no;
        } 
        $rev_no++;
        $data['rev_no']            = $rev_no;
        $data['service_id']        = $service_id;
        $data['added_by']          = currentuserinfo()->id;
        set_common_insert_value();
        $status = $this->db->insert('inch_job_offer', $data);
        // echo $this->db->last_query();die;
        add_report($id);
        set_flashdata("success","Offer Added successfully!!!");
        return $status;
    }


    public function edit_offer($service_id)
    {
        $this->form_validation->set_rules('analysis_cost', 'Analysis Cost', 'trim|required|');
        $this->form_validation->set_rules('repairing_cost', 'Repairing Cost', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // echo validation_errors();die;
            set_flashdata("error", validation_errors());
            return FALSE;
        }
        $offer_id                  = $this->input->post('offer_id_edit',TRUE);
        $data['analysis_cost']     = $this->input->post('analysis_cost',TRUE);
        $data['repairing_cost']    = $this->input->post('repairing_cost',TRUE);
        if(isset($offer_id) && !empty($offer_id))
        {
            $status = $this->db->where('form_id',$offer_id)->where('service_id',$service_id)->update('inch_job_offer',$data);
            return $status;
        }
        return false;
    }
    
    public function get_offer_revision_list($service_id)
    {
        $this->db->select("ep.*,s.inquiry_no,j.job_sequence", FALSE);
        // $this->db->join('users as u','u.id=ep.added_by','LEFT');
        $this->db->join($this->table." s","s.form_id = ep.service_id", 'left');
        $this->db->join($this->job_table." j","j.form_id = ep.job_id", 'left');
        $this->db->where('ep.service_id',$service_id);
        $query = $this->db->get($this->job_offer.' AS ep');
        $list = $query->result();
        // echo $this->db->last_query();die;
        // pr($list);die;
        return $list;
    }
    
    public function freeze_offer($service_id)
    {
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
            $ids = $_GET['ids'];
            $ids = explode(',', $ids);
            $data['is_freeze'] = 1;
            $status = $this->db->where_in('form_id', $ids)->update('inch_job_offer',$data);
            return $status;
        }
        return false;
    }

    public function unfreeze_offer($service_id)
    {
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
            $ids = $_GET['ids'];
            $ids = explode(',', $ids);
            $data['is_freeze'] = 0;
            $status = $this->db->where_in('form_id', $ids)->update('inch_job_offer',$data);
            return $status;
        }
        return false;
    }


    public function add_offer_terms($service_id)
    {
        // pr($_POST);
        $this->form_validation->set_rules('payment_terms', 'Payment Terms', 'trim|required');
        $this->form_validation->set_rules('freight_insurance', 'Freight Insurance', 'trim|required');
        $this->form_validation->set_rules('delivery_schedule', 'Delivery Schedule', 'trim|required');
        $this->form_validation->set_rules('warranty_terms', 'Warranty Terms', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $data['payment_terms']      = $this->input->post('payment_terms',TRUE);
        $data['freight_insurance']  = $this->input->post('freight_insurance',TRUE);
        $data['delivery_schedule']  = $this->input->post('delivery_schedule',TRUE);
        $data['warranty_terms']     = $this->input->post('warranty_terms',TRUE);
        $this->db->where('form_id',$service_id)->update($this->table, $data);
        $last_id = $this->db->affected_rows();
        if($last_id)
        {
            set_flashdata('success',' Offer Terms Updated successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
    }

    public function add_order_details($service_id)
    {
        // pr($_POST);
        $this->form_validation->set_rules('wo_no', 'WO No.', 'trim|required');
        $this->form_validation->set_rules('wo_date', 'WO Date', 'trim|required');
        $this->form_validation->set_rules('order_payment_terms', 'Payment Terms', 'trim|required');
        $this->form_validation->set_rules('order_freight_insurance', 'Freight Insurance', 'trim|required');
        $this->form_validation->set_rules('order_delivery_terms', 'Delivery Terms', 'trim|required');
        $this->form_validation->set_rules('order_warranty_terms', 'Warranty Terms', 'trim|required');
        $this->form_validation->set_rules('order_pf', 'P&F', 'trim|required');
        $this->form_validation->set_rules('wo_mode', 'WO Mode', 'trim|required');
        $this->form_validation->set_rules('order_remarks', 'Remarks', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $data['wo_no']                  = $this->input->post('wo_no',TRUE);
        $data['wo_date']                = $this->input->post('wo_date',TRUE);
        $data['order_payment_terms']    = $this->input->post('order_payment_terms',TRUE);
        $data['order_freight_insurance']= $this->input->post('order_freight_insurance',TRUE);
        $data['order_delivery_terms']   = $this->input->post('order_delivery_terms',TRUE);
        $data['order_warranty_terms']   = $this->input->post('order_warranty_terms',TRUE);
        $data['order_pf']               = $this->input->post('order_pf',TRUE);
        $data['wo_mode']                = $this->input->post('wo_mode',TRUE);
        $data['order_no_of_cards']      = $this->input->post('order_no_of_cards',TRUE);
        $data['order_remarks']          = $this->input->post('order_remarks',TRUE);
        $this->db->where('form_id',$service_id)->update($this->table, $data);
        // echo $this->db->last_query();die;
        $status = $this->db->affected_rows();
        if($status)
        {
            set_flashdata('success',' Order Details Updated Successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
    }
    
    public function edit_order_amount($service_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('analysis_cost', 'Analysis Cost', 'trim|required');
        $this->form_validation->set_rules('repairing_cost', 'Repairing Cost', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $job_id = $this->input->post('job_id',TRUE);
        if($job_id)
        {

            $data['order_analysis_amount'] = $this->input->post('analysis_cost',TRUE);
            $data['order_repair_amount']   = $this->input->post('repairing_cost',TRUE);
            $this->db->where('service_id',$service_id)->where('form_id',$job_id)->update($this->job_table, $data);
            // echo $this->db->last_query();die;
            $status = $this->db->affected_rows();
            if($status)
            {
                $this->db->select('sum(order_analysis_amount) as total_analysis,sum(order_repair_amount) total_order');
                $this->db->where('service_id',$service_id)->from($this->job_table);
                $query = $this->db->get();
                if($query->num_rows() > 0)
                {
                    $data1['order_taxable_value'] = $query->row()->total_analysis+$query->row()->total_order;
                    $data1['order_total_value']   = 1.18*$data1['order_taxable_value'];
                    $this->db->where('form_id',$service_id)->update($this->table,$data1);
                }
                set_flashdata('success',' Order Details Updated Successfully.');
            }
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
    }

    public function get_payment_list($service_id)
    {
        $this->db->select("ep.*,concat(u.first_name,' ',u.last_name) as added_by", FALSE);
        $this->db->where('ep.service_id',$service_id);
        $this->db->where('ep.service_id',$service_id);
        $this->db->join('users u','u.id=ep.added_by','left');
        $this->db->order_by('ep.created_time','DESC');
        $query = $this->db->get("inch_payment_details_service".' AS ep');
        $payment_list = $query->result();
        return $payment_list;
    }

    public function __get_price_calc($id, $enquiry_id)
    {
        if($id)
        {
            $this->db->where('ep.'.PRIMARY_KEY,$id);
        }

        $this->db->select("ep.*,e.currency_factor, um.name as unit_name, sc.name as supplier, sv.name as supplier_type_name, hsn.name as hsn_name,hsn.customs_duty,hsn.hsn_no,hsn.gst as hsn_gst",FALSE);
        $this->db->join('inch_unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=q.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=q.supplier','LEFT');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->join($this->table.' as e','e.form_id=ep.enquiry_id');
        $this->db->where('ep.enquiry_id',$enquiry_id);
        $this->db->order_by('ep.'.PRIMARY_KEY, 'ASC');
        $query = $this->db->get($this->enq_product.' AS ep');
        $product_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($product_list);die;
        return $product_list;
    }
    
    public function get_offer_list($id, $order_id)
    {
        if($id)
        {
            $this->db->where('ep.'.PRIMARY_KEY,$id);
        }

        $this->db->select("ep.*, um.name as unit_name, concat(u.first_name,' ',u.last_name) as given_by, sc.name as supplier_name, sv.name as supplier_type_name, hsn.name as hsn_name, hsn.gst as hsn_gst",FALSE);
        $this->db->join('inch_unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=ep.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=ep.supplier','LEFT');
        $this->db->join('users as u','u.id=ep.added_by','LEFT');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->where('ep.order_id',$order_id);
        $this->db->where('ep.supplier_po_seq > ', 0);
        $this->db->where('ep.status', 1);
        $this->db->group_by('ep.form_id');
        $query = $this->db->get($this->enq_product.' AS ep');
        $product_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($product_list);die;
        return $product_list;
    }



    public function __get_offer_list($id, $enquiry_id)
    {
        if($id)
        {
            $this->db->where('ep.'.PRIMARY_KEY,$id);
        }

        $this->db->select("ep.*,er.id as revision_id,er.product_id as revision_product_id, um.name as unit_name,q.form_id as quotation_id, q.product_id, q.vat, q.unit_price, q.unit_price_with_tax, q.total_price_with_tax, q.delivery_days, q.gw, q.payment_terms, q.validity_days, q.delivery_cost, q.packing_cost, q.warranty_month, q.supplier, q.supplier_type, concat(u.first_name,' ',u.last_name) as given_by, sc.name as supplier, sv.name as supplier_type_name, hsn.name as hsn_name, hsn.gst as hsn_gst",FALSE);
        $this->db->join($this->enq_product.' as ep','ep.form_id=er.product_id AND er.status=1','LEFT');
        $this->db->join($this->product_quot.' as q','q.form_id=er.quotation_id AND er.status=1','LEFT');
        $this->db->join('inch_unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=q.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=q.supplier','LEFT');
        $this->db->join('users as u','u.id=q.added_by','LEFT');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->where('er.enquiry_id',$enquiry_id);
        $this->db->group_by('er.id');
        $this->db->order_by('er.product_id', 'ASC');
        $query = $this->db->get($this->enq_revision.' AS er');
        $product_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($product_list);die;
        return $product_list;
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
                $status = $this->db->insert_batch($this->enq_document, $data);
            }
            return $status;
        }
    }   

    public function get_document_list($id, $order_id)
    {

        if($id)
        {
            $this->db->where('ed.id', $id);
        }
        $this->db->select("ed.*, concat(u.first_name,' ',u.last_name) AS user_name", FALSE);
        if(isset($order_id) && !empty($order_id))
        {
            $this->db->where('ed.order_id',$order_id);
        }
        $this->db->join('users as u','u.id=ed.added_by','LEFT');
        $this->db->order_by('ed.document_type', 'ASC');
        $query = $this->db->get($this->enq_document.' AS ed');
        return $query->result();
        // echo $this->db->last_query();die;
    }
    
	public function export()
    {
		$items          = $this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data     = explode(",",$items_data);
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
    
    public function get_doc($id = null)
    {
        if ($id)
        {
            $this->db->select('edd.filename,edd.file_title');
            $this->db->where('edd.email_data_id', $id);
            return $this->db->get('email_data_doc as edd')->result_array();
        }
    }

    public function get_email_name($user)
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

    public function uploadFiles($file_arr, $folder='upload/documents/') {
        
        if (isset($file_arr['name']) && $file_arr['name'] != '') {
            
            $path       = $file_arr['name'];
            $ext        = pathinfo($path, PATHINFO_EXTENSION);
            $name       = md5(time());
            $file_name  = $name . "." . $ext;
            $folder_doc = FCPATH.$folder;
            if (!file_exists($folder_doc)) {
                mkdir($folder_doc, 0777, true);
            }
            $file_arr['name']           = $file_name;
            $config['upload_path']      = $folder_doc;
            $config['allowed_types']    = 'doc|docx|xls|xlsx|pdf|jpeg|jpg|gif|png';
            $config['max_size']         = 0;
            $config['encrypt_name']     = TRUE;
            $config['remove_spaces']    = TRUE;
            $config['overwrite']        = FALSE;
            $this->load->library('upload');
            $this->upload->initialize($config);
            $data=array();
            if (!$this->upload->do_upload('myfile'))
            {
                $data['error'] = $this->upload->display_errors();
            } else
            {
                $data['success'] = $this->upload->data();
            }
            return $data;
        }
    }
    
    public  function get_ticket_message_chat($ticket_id_for_message){
        // echo "string";
        $query = $this->db->query("SELECT `et`.*, concat(snd.first_name, ' ', snd.last_name) as SENDER_NAME, concat(rcv.first_name, ' ', rcv.last_name) as RECEIVER_NAME FROM ".$this->order_chat." as `et` JOIN `users` as `snd` ON `snd`.`id` = `et`.`sender` JOIN `users` as `rcv` ON `rcv`.`id` = `et`.`receiver` WHERE `et`.`ticket_id` = $ticket_id_for_message");
        $data = $query->result_array();
        return $data;
        // pr($data);die;
        // echo $this->db->last_query();die;
    }
           
    public function insert_chat($data=array()){
        
        return $this->db->insert($this->order_chat, $data);

    }
        
    public function get_unreadchat($order_id)
    { 
        $query = $this->db->query("SELECT * FROM $this->order_chat WHERE ticket_id = '" . (int)$order_id . "' AND is_read='0'");
        return $query->row_array();
    }
        
    public function updatechat($ticket_id)
    {
        
        $result = $this->db->get_where($this->order_chat, ['ticket_id'=>$ticket_id])->result();
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
           			$this->db->update($this->order_chat, $data);
                }
           	}
           	else
           	{
           		$data['read_by'] = $this->user_id;
           		$this->db->where('ticket_id', $ticket_id);
           		$this->db->where('id', $row->id);
           		$this->db->update($this->order_chat,$data);
           	}
        }
    }
        
    public function get_chat_count_user_wise($ticket_id) {

    	$this->db->select("count(id) as chat_count");
    	$this->db->where("added_by!=", $this->user_id, FALSE);
    	$this->db->where("( NOT FIND_IN_SET('".$this->user_id."', read_by) OR read_by IS NULL)",NULL, FALSE);
    	$chat_count = $this->db->get($this->order_chat)->row()->chat_count;
    	return $chat_count;
    	// echo $this->db->last_query();die;
    }

    public function get_all_message_chat_count_admin() {

        $query = $this->db->query("SELECT `FSTL`.*, concat(FS_U.first_name, ' ', FS_U.last_name) as SENDER_NAME, concat(FS_UR.first_name, ' ', FS_UR.last_name) as RECEIVER_NAME FROM ".$this->order_chat." as `FSTL` JOIN `oc_customer` as `FS_U` ON `FS_U`.`customer_id` = `FSTL`.`sender` JOIN `oc_customer` as `FS_UR` ON `FS_UR`.`customer_id` = `FSTL`.`receiver`  WHERE `FSTL`.`receiver` = '1' AND `FSTL`.`is_read` = '0' ORDER BY FSTL.ticket_id DESC ");
        return $query->row();
    }
    
    public function get_all_message_chat_admin() {
        //echo 'in model ghbvuhb';print_r($customer_id);die; 
        $query = $this->db->query("SELECT `FSTL`.*,O.customer_id  FROM ".$this->order_chat." as `FSTL`   JOIN `oc_order` as `O` ON `O`.`order_id` = `FSTL`.`ticket_id` WHERE `FSTL`.`receiver` = '1'  AND `FSTL`.`is_read` = '0' ORDER BY FSTL.ticket_id DESC ");
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

    public function get_client_contact_list($client_contact_id)
    {
        if($client_contact_id)
        {
            $this->db->where_in('cc.id', $client_contact_id);
        }
        // $this->db->select("cc.*, concat(u.first_name,' ',u.last_name) AS user_name", FALSE);
        $this->db->select("cc.*, d.name as designation_name, dt.name as department_name", FALSE);
        $this->db->join('designation as d','d.id=cc.designation','LEFT');
        $this->db->join('department as dt','dt.id=cc.department','LEFT');
        $query = $this->db->get('companies_contact AS cc');
        $data = $query->result();
        // echo $this->db->last_query();die;
        return $data;
    }

    public function change_order_status($status_id=NULL, $whose=NULL, $order_id=NULL)
    {
        if($status_id && $whose && $order_id)
        {
            $data = [];
            if($whose=='india')
            {
                $data['current_status'] = $status_id;
                if($status_id = '2')
                {
                    $data['to_cfit'] = date('Y-m-d H:i:s');
                    $data['from_india'] = date('Y-m-d H:i:s');
                }
                $this->db->where('form_id',$order_id);
                return $this->db->update($this->table, $data);
                // echo $this->db->last_query();die;
            }
            elseif($whose=='china')
            {
                $data['china_status'] = $status_id;
                if($status_id = '8')
                {
                    $data['from_cfit'] = date('Y-m-d H:i:s');
                    $data['to_india'] = date('Y-m-d H:i:s');
                }
                $this->db->where('form_id',$order_id);
                return $this->db->update($this->table, $data);
            }
        }
    }

    public function change_cfit_name($cfit_id=NULL, $order_id=NULL)
    {
        if($cfit_id && $order_id)
        {
            $this->db->where('form_id', $order_id);
            return $this->db->update($this->table, ['cfit_id'=>$cfit_id]);
            // echo $this->db->last_query();die;
        }
    }

    public function change_po_status($status=NULL,$order_id=NULL)
    {
        if($order_id)
        {
            $data['status'] = $status;
            $this->db->where('form_id', $order_id);
            return $this->db->update($this->table, $data);
            // echo $this->db->last_query();die;
        }
    }
          

    public function get_internal_notes($service)
    {
        $this->db->select("ep.*,concat(s.first_name,' ',s.last_name) added_by", FALSE);
        $this->db->where('ep.service_id',$service);
        $this->db->join('users as s','s.id=ep.added_by','LEFT');
        $query = $this->db->get("inch_service_internal_note".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function get_pbg_details($order_id)
    {
        $this->db->select("*", FALSE);
        $this->db->where('ep.order_id',$order_id);
        $query = $this->db->get("inch_pbg_details".' AS ep');
        $payment_list = $query->row();
        return $payment_list;
    } 

    public function get_tax_by_hsn($hsncode)
    {
        // die($hsncode);
        $this->db->select("gst", FALSE);
        $this->db->where('ep.form_id',$hsncode);
        $query = $this->db->get("inch_hsn_code_master".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->row()->gst;
        }
        return false;
    }  

    public function get_products($order,$source)
    {
        // die($hsncode);
        $this->db->select("form_id,enquiry_id,product_sequence", FALSE);
        $this->db->where('ep.order_id',$order);
        $this->db->where('ep.supplier_country',$source);
        $this->db->order_by('ep.created_time','asc');
        $query = $this->db->get("inch_order_product".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    } 

    public function get_product_detail($order,$ids)
    {
        // die($hsncode);
        $this->db->select("*,h.name hsn_name", FALSE);
        $this->db->join("inch_hsn_code_master h","ep.hsn_code = h.form_id", 'left');
        $this->db->where('ep.order_id',$order);
        $this->db->where_in('ep.form_id',$ids);
        $this->db->order_by('ep.created_time','asc');
        $query = $this->db->get("inch_order_product".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }  

    public function create_delivery_challan($job_id,$service_id)
    {
        // die($hsncode);
        $sequence = 0;
        $this->db->select("max(ep.delivery_challan_no) as sequence", FALSE);
        $this->db->where('ep.service_id',$service_id);
        $query = $this->db->get($this->job_table.' AS ep');
        if($query->num_rows() > 0)
        {
            $sequence =  ((int)$query->row()->sequence) + 1;
        }
        //now update delivery challan no. in job table
        $job_id = explode(',',$job_id);
        $this->db->where_in('form_id',$job_id)->update($this->job_table,['delivery_challan_no'=>$sequence]);
        // echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }  

    public function get_delivery_challan_no($service_id)
    {
        // die($hsncode);
        $no = 0;
        $this->db->select("max(ep.delivery_challan_no) as sequence", FALSE);
        $this->db->where('ep.service_id',$service_id);
        $query = $this->db->get($this->job_table.' AS ep');
        if($query->num_rows() > 0)
        {
            $no = ((int)$query->row()->sequence);
        }
        return $no;
    }

    public function add_delivery_box($service_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('type', 'Box Type', 'trim|required');
        $this->form_validation->set_rules('box_name', 'Box Name', 'trim|required');
        $this->form_validation->set_rules('length', 'Box Length', 'trim|required');
        $this->form_validation->set_rules('height', 'Box Height', 'trim|required');
        $this->form_validation->set_rules('weight', 'Box Weight', 'trim|required');
        $this->form_validation->set_rules('job_ids', 'Job Card', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $data['type']       = $this->input->post('type',TRUE);
        $data['length']     = $this->input->post('length',TRUE);
        $data['height']     = $this->input->post('height',TRUE);
        $data['box_name']   = $this->input->post('box_name',TRUE);
        $data['gw']         = $this->input->post('gw',TRUE);
        $data['nw']         = $this->input->post('nw',TRUE);
        $data['weight']     = $this->input->post('weight',TRUE);
        $data['cbm']        = $this->input->post('cbm',TRUE);
        $data['wt_sea']     = $this->input->post('wt_sea',TRUE);
        $data['wt_air']     = $this->input->post('wt_air',TRUE);
        $data['delivery_challan_no']     = $this->input->post('delivery_challan_no',TRUE);
        $data['service_id'] = $service_id;
        set_common_insert_value();
        $this->db->insert($this->box_table, $data);
        $box_id = $this->db->insert_id();
        if($box_id)
        {
            $job_ids  = $this->input->post('job_ids',TRUE);
            $job_ids  = explode(',',$job_ids);
            $this->db->where_in('form_id',$job_ids)->update($this->job_table,['box_id'=>$box_id]);
            return $this->db->affected_rows();
        }
        return false;
    }

    public function delete_box($id,$service_id)
    {
        // pr($_POST);die;
        $this->db->where('form_id',$id)->where('service_id',$service_id);
        $status = $this->db->delete($this->box_table);
        if($status)
        {
            $this->db->where_in('box_id',$id)->update($this->job_table,['box_id'=>0]);
            if($this->db->affected_rows())
            {
                set_flashdata("success","Record deleted successfully!!!");
                return;
            }
        }
        set_flashdata("error","Something went wrong, Please try again!!!");
        return;
    } 

    public function delete_challan($service_id)
    {
        // pr($_POST);die;
        $challan_no = $this->input->get('challan_no');
        $job_ids    = $this->input->get('job_id');
        if((isset($challan_no) && !empty($challan_no)) && (isset($job_ids) && !empty($job_ids)))
        {
            $job_ids = explode(',',$job_ids);
            $this->db->where_in('form_id',$job_ids)->where('service_id',$service_id)->update($this->job_table,['delivery_challan_no'=>0]);
            if($this->db->affected_rows())
            {
                set_flashdata("success","Record deleted successfully!!!");
                return;
            }
        }
        set_flashdata("error","Something went wrong, Please try again!!!");
        return;
    } 

    public function get_challan_data($service_id,$challan)
    {
        // pr($_POST);die;
        if($service_id && $challan)
        {
            $this->db->select('*')->from($this->box_table);
            $this->db->where('service_id',$service_id)->where('delivery_challan_no',$challan);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $box_details = $query->result_array();
                foreach ($box_details as $key=>$box)
                {
                    // pr($box);die;
                    $this->db->select('e.*,s.inquiry_no')->from($this->job_table." as e");
                    $this->db->where('e.service_id',$service_id)
                    ->where('e.delivery_challan_no',$box['delivery_challan_no'])
                    ->where('e.box_id',$box['form_id']);
                    $this->db->join($this->table." s","s.form_id = e.service_id", 'left');
                    $query1 = $this->db->get();
                    if($query1->num_rows() > 0)
                    {
                        $box_details[$key]['jobs'] = $query1->result_array();
                    }
                }
                return $box_details;
            }
            return false;
        }
    } 

    public function get_revisions_offer($service_id)
    {
        // die($hsncode);
        $this->db->select("rev_no as revision", FALSE);
        $this->db->where('ep.service_id',$service_id);
        $this->db->group_by('ep.rev_no');
        $query = $this->db->get('inch_job_offer AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function get_offer_details($service_id)
    {
        // die($hsncode);
        $rev_no = $this->input->get('rev');
        if($rev_no)
        {
            $this->db->select("j.card_name,j.card_make,j.card_model,j.sr_no,concat(s.inquiry_no,'-',j.job_sequence) job_id,ep.analysis_cost,ep.repairing_cost", FALSE);
            $this->db->where('s.form_id',$service_id);
            $this->db->where('ep.rev_no',$rev_no);
            $this->db->join($this->job_table." j","j.form_id = ep.job_id", 'left');
            $this->db->join($this->table." s","s.form_id = j.service_id", 'left');
            $this->db->order_by('j.form_id');
            $query = $this->db->get('inch_job_offer AS ep');
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        }
        return false;
    }

    public function get_job_costs_for_invoice($service_id,$job_id)
    {
        // die($hsncode);
        if(isset($job_id) && !empty($job_id))
        {
            $total_cost = 0;
            $job_id = explode(',',$job_id);
            $this->db->select("j.order_analysis_amount,j.order_repair_amount", FALSE);
            $this->db->where('j.service_id',$service_id);
            $this->db->where_in('j.form_id',$job_id);
            $this->db->order_by('j.form_id');
            $query = $this->db->get($this->job_table." j");
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $job)
                {
                    $total_cost += $job->order_repair_amount + $job->order_repair_amount;
                }
                return $total_cost;
            }
        }
        return false;
    }

    public function get_contact_person($service_id)
    {
        // die($hsncode);
        $this->db->select('c.id,c.name');
        $this->db->join($this->table." s","s.client = c.id", 'left');
        $this->db->where('s.form_id',$service_id);
        $query = $this->db->get('companies_contact c');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function get_client_name()
    {
        // die($hsncode);
        $this->db->select('id,name');
        $this->db->select('status',1);
        $query = $this->db->get('companies');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }

    public function fetch_data_according_company($company_id)
    {
        // die($hsncode);
        $this->db->select('company_address,tax_gst');
        $this->db->where('id',$company_id);
        $query = $this->db->get('companies');
        if($query->num_rows() > 0)
        {
            $data['status'] =  "success";
            $data['result'] =  $query->row();
            return $data;
        }
        return false;
    }

    public function fetch_contact_according_company($company_id)
    {
        $output = '';
        $this->db->where('company_id', $company_id);
        $this->db->where('status', '1');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('companies_contact');
        if($query->num_rows()>0)
        {
            $output = '<option value="">Select</option>';
            foreach($query->result() as $row)
            {
                $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
        else
        {
            $output .= '<option value="">No state found</option>';
        }
        return $output;
    }

    public function add_invoice($service_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('dispatch_date', 'Dispatch Date', 'trim|required');
        $this->form_validation->set_rules('del_challan', 'Delivery/Challan', 'trim|required');
        $this->form_validation->set_rules('eway_bill_no', 'Eway bill No', 'trim|required');
        $this->form_validation->set_rules('shipment_through', 'Shipment Through', 'trim|required');
        $this->form_validation->set_rules('lr_no', 'LR No', 'trim|required');
        $this->form_validation->set_rules('job_ids', 'Job Card', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            // set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $data['dispatch_date']       = $this->input->post('dispatch_date',TRUE);
        $data['taxable_value']       = $this->input->post('taxable_value',TRUE);
        $data['purchase_tax']        = $this->input->post('purchase_tax',TRUE);
        $data['total_invoice_value'] = $this->input->post('total_invoice_value',TRUE);
        $data['del_challan']         = $this->input->post('del_challan',TRUE);
        $data['eway_bill_no']        = $this->input->post('eway_bill_no',TRUE);
        $data['shipment_through']    = $this->input->post('shipment_through',TRUE);
        $data['client_contact']      = $this->input->post('client_contact',TRUE);
        $data['second_client_contact']= $this->input->post('second_client_contact',TRUE);
        $data['consignee']           = $this->input->post('consignee',TRUE);
        $data['consignee_contact']   = $this->input->post('consignee_contact',TRUE);
        $data['second_consignee_contact']= $this->input->post('second_consignee_contact',TRUE);
        $data['lr_no']               = $this->input->post('lr_no',TRUE);
        $data['job_id']              = $this->input->post('job_ids',TRUE);
        $data['mode_of']             = $this->input->post('mode_of',TRUE);
        $data['service_id'] = $service_id;
        set_common_insert_value();
        $this->db->insert($this->invoice_table, $data);
        $id =  $this->db->insert_id();
        return $id;
    }

    public function get_invoice_list($service_id,$id=null)
    {
        $this->db->select('ioi.*,ioi.consignee as company_id,com.name as consignee_name,com.company_address as consignee_address,com.tax_gst as consignee_gst,sup.name as shipment_through_name,con.name as client_contact_name,cont.name as second_client_contact_name, conta.name as consignee_contact_name, contac.name as second_consignee_contact_name');
        // $this->db->join('inch_order as io','io.form_id=ioi.order_id','left');
        $this->db->join('companies as com','com.id=ioi.consignee','left');
        $this->db->join('companies_contact as con','con.id=ioi.client_contact','left');
        $this->db->join('companies_contact as cont','cont.id=ioi.second_client_contact','left');
        $this->db->join('companies_contact as conta','conta.id=ioi.consignee_contact','left');
        $this->db->join('companies_contact as contac','contac.id=ioi.second_consignee_contact','left');
        $this->db->join('supplier_ind as sup','sup.id=ioi.shipment_through','left');
        if($id)
        {
            $this->db->where('ioi.id',$id);
        }
        $this->db->where('ioi.service_id',$service_id);
        $this->db->order_by('ioi.invoice_no','asc');
        $this->db->order_by('ioi.id','desc');
        $query = $this->db->get($this->invoice_table.' as ioi');
        //pr($this->db->last_query());die;
        if($query->num_rows() > 0)
        {

            if($id)
            {
                return $query->row();
            }
            else
            {
                return $query->result();
            }
        }
        return false;
    }

    public function edit_invoice($id,$service_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('dispatch_date', 'Dispatch Date', 'trim|required');
        $this->form_validation->set_rules('del_challan', 'Delivery/Challan', 'trim|required');
        $this->form_validation->set_rules('eway_bill_no', 'Eway bill No', 'trim|required');
        $this->form_validation->set_rules('shipment_through', 'Shipment Through', 'trim|required');
        $this->form_validation->set_rules('lr_no', 'LR No', 'trim|required');
        // $this->form_validation->set_rules('job_ids', 'Job Card', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            // set_flashdata("error", validation_errors());
            return FALSE;
        } 
        $data['dispatch_date']       = $this->input->post('dispatch_date',TRUE);
        $data['taxable_value']       = $this->input->post('taxable_value',TRUE);
        $data['purchase_tax']        = $this->input->post('purchase_tax',TRUE);
        $data['total_invoice_value'] = $this->input->post('total_invoice_value',TRUE);
        $data['del_challan']         = $this->input->post('del_challan',TRUE);
        $data['eway_bill_no']        = $this->input->post('eway_bill_no',TRUE);
        $data['shipment_through']    = $this->input->post('shipment_through',TRUE);
        $data['client_contact']      = $this->input->post('client_contact',TRUE);
        $data['second_client_contact']= $this->input->post('second_client_contact',TRUE);
        $data['consignee']           = $this->input->post('consignee',TRUE);
        $data['consignee_contact']   = $this->input->post('consignee_contact',TRUE);
        $data['second_consignee_contact']= $this->input->post('second_consignee_contact',TRUE);
        $data['lr_no']               = $this->input->post('lr_no',TRUE);
        // $data['job_id']              = $this->input->post('job_ids',TRUE);
        $data['mode_of']             = $this->input->post('mode_of',TRUE);
        $data['service_id'] = $service_id;
        // ();
        $this->db->where('id',$id)->where('service_id',$service_id)->update($this->invoice_table, $data);
        $id =  $this->db->affected_rows();
        return $id;
    }

    public function freeze_invoice($service_id)
    {
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
            $ids = $_GET['ids'];
            $ids = explode(',', $ids);
            $data['is_freeze'] = 1;
            $status = $this->db->where_in('id', $ids)->update($this->invoice_table,$data);
            return $status;
        }
        return false;
    }


    public function dispatch_invoice($service_id)
    {
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
            $ids = $_GET['ids'];
            $ids = explode(',', $ids);
            if(isset($ids) && !empty($ids))
            {
                foreach ($ids as $id)
                {
                    $no = 0;
                    $this->db->select('max(invoice_sequence) as invoice_no')->from($this->invoice_table);
                    $query = $this->db->get();
                    if($query->num_rows() > 0)
                    {
                        $no = $query->row()->invoice_no;
                    }
                    $no += 1;
                    //now update sequence in db
                    $data['is_dispatch']      = 1;
                    $data['invoice_sequence'] = $no;
                    $data['invoice_date_time'] = date('Y-m-d H:i:s');
                    $status1 = $this->db->where_in('id', $id)->update($this->invoice_table,$data);
                }
                return $status1;
            }
        }
        return false;
    }

    public function delete_invoice($id,$service_id)
    {
        return $this->db->where('service_id',$service_id)->where('id',$id)->delete($this->invoice_table);
    }

    public function get_invoice_details($service_id)
    {
        $invoice_id = $this->input->get('invoice_id');
        if(isset($invoice_id) && !empty($invoice_id))
        {
            $this->db->select('i.*,com.state_comp bill_to_state,s.order_payment_terms payment_terms,s.wo_no,s.wo_date,s.inquiry_no,com.name as company_name,com.company_address bill_to_address,comp.company_address ship_to_address,comp.name as supplier_name,com.pincode city_code,comp.pincode second_city_code,ct.city_name,st.state_name,cts.city_name as second_city_name,sts.state_name as second_state_name,comp.tax_gst as second_gst,com.tax_gst as first_gst,con.salutation,cont.salutation as second_salutation,cont.primary_phone as second_phone_no,cont.email_id as second_email_id,con.primary_phone as first_phone_no,con.email_id as first_email_id,cont.name as second_client_contact,con.name as client_contact,conta.salutation consignee_salutation, conta.name as consignee_contact,conta.primary_phone as consignee_phone,conta.email_id as consignee_email,contac.name as second_consignee_contact,contac.salutation as second_consignee_salutation,contac.primary_phone as second_consignee_phone,contac.email_id as second_consignee_email,sup.name as transporter');
            $this->db->join($this->table." s","s.form_id = i.service_id", 'left');
            $this->db->join('companies_contact as con','con.id=i.client_contact','left');
            $this->db->join('companies_contact as cont','cont.id=i.second_client_contact','left');
            $this->db->join('companies_contact as conta','conta.id=i.consignee_contact','left');
            $this->db->join('companies as com','com.id=s.client','left');
            $this->db->join('companies as comp','comp.id=i.consignee','left');
            $this->db->join('cities as ct','ct.id=com.city_comp','left');
            $this->db->join('states as st','st.id=com.state_comp','left');
            $this->db->join('companies_contact as contac','contac.id=i.second_consignee_contact','left');
            $this->db->join('cities as cts','cts.id=comp.city_comp','left');
            $this->db->join('states as sts','sts.id=comp.state_comp','left');
            $this->db->join('supplier_ind as sup','sup.id=i.shipment_through','left');
            $this->db->where('s.form_id',$service_id);
            $this->db->where('i.id',$invoice_id);
            $query = $this->db->get($this->invoice_table.' i');
            if($query->num_rows() > 0)
            {
                return $query->row();
            }
        }
        return false;
    }

    public function get_job_details($service_id)
    {
        $invoice_id = $this->input->get('invoice_id');
        if(isset($invoice_id) && !empty($invoice_id))
        {
            $this->db->select("concat(s.inquiry_no,'-',j.job_sequence) job_card,j.order_analysis_amount,j.order_repair_amount,j.card_name,j.card_make,j.card_model,j.sr_no",FALSE);
            $this->db->where('i.service_id',$service_id);
            //$this->db->where('ip.order_id',$order_id);
            $this->db->where('i.id',$invoice_id);
            $this->db->where("FIND_IN_SET(j.form_id,i.job_id)!=0");
            $this->db->join('inch_job_card_details  as j ','j.service_id=i.service_id','left');
            $this->db->join($this->table." s","s.form_id = i.service_id", 'left');
            // $this->db->join('inch_hsn_code_master as hsn','hsn.form_id=ip.hsn_code','left');
            // $this->db->join(TBL_PREFIX.'unit_master as um','um.form_id=ip.uom','left');
            // $this->db->join(TBL_PREFIX.'order_invoice_details as id','id.product_id=ip.form_id','left');
            //$this->db->group_by('ip.'.PRIMARY_KEY, 'ASC');   
            // $this->db->order_by('ip.'.PRIMARY_KEY, 'ASC');
            $query = $this->db->get('inch_job_invoice AS i');
           if($query->num_rows() > 0)
           {
                // pr($query->result());die;
                return $query->result();
           }
           return false;
        }
    }
}
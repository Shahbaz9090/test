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
 
class Job_mod extends CI_Model {
    
    public $table   	   	 = TBL_PREFIX."job_card_details";
    public $job_estimation   = TBL_PREFIX."job_estimation";
    public $in_out_details   = TBL_PREFIX."in_out_details";
    public $service_table    = TBL_PREFIX."service";
    public $contract         = TBL_PREFIX."job_contract";
    public $enq_document     = TBL_PREFIX."order_document";
    public $order_chat    	 = TBL_PREFIX."order_ticket_logs";
    public $store_requirement= TBL_PREFIX."store_requirement";
    public $email       	 = "email_data";
	public $per_page		 = "per_page";
	public $user_id			 = NULL;
       
    public function __construct()
    {
        parent::__construct();
        $this->user_id = currentuserinfo()->id;
    }
      
    public function get_job_list($id='', $count='', $limit='', $start='',$service_id='')
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
        if($service_id!='')
        {
            $this->db->where("e.service_id", $service_id);
        }
        if ($limit != "" && $start != "") {
            $this->db->limit($limit, $start);
        }

        if($limit != '' && $start == '' && $count == '')
        {
            $this->db->limit(PERPAGE, 0);
        }
        filter_data('e');
      	$this->db->select("SQL_CALC_FOUND_ROWS e.*,e.form_id job_id,s.enquiry_date,s.card_type,s.no_of_cards,s.inquiry_no,concat(s0.first_name,' ',s0.last_name) service_engineer,concat(s1.first_name,' ',s1.last_name) testing_engineer,concat(s2.first_name,' ',s2.last_name) quality_engineer,concat(s3.first_name,' ',s3.last_name) lead_engineer,concat(s4.first_name,' ',s4.last_name) sales_lead_name,concat(s5.first_name,' ',s5.last_name) service_lead_name,js.name status_name",FALSE);
        // $this->db->select("SQL_CALC_FOUND_ROWS e.*,c.name client_name,cc.name client_issuer_name,cc1.name client_technical_name,concat(s.first_name,' ',s.last_name) sales_lead_name,concat(s1.first_name,' ',s1.last_name) service_lead_name",FALSE);
        $this->db->join($this->service_table.' as s','s.form_id=e.service_id','LEFT');
        $this->db->join('users as s0','s0.id=e.service_engineer','LEFT');
        $this->db->join('users as s1','s1.id=e.testing_engineer','LEFT');
        $this->db->join('users as s2','s2.id=e.quality_engineer','LEFT');
        $this->db->join('users as s3','s3.id=e.lead_engineer','LEFT');
        $this->db->join('users as s4','s4.id=s.sales_lead','LEFT');
        $this->db->join('users as s5','s5.id=s.sevice_lead','LEFT');
        $this->db->join('inch_job_card_status as js','js.form_id=e.status','LEFT');
        $this->db->group_by('e.form_id');
        
        $this->db->order_by('e.'.PRIMARY_KEY, 'ASC');
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
    

    public function get_job_status()
    {
        // die($hsncode);
        $this->db->select("ep.*", FALSE)->where('status','1');
        $query = $this->db->get("inch_job_card_status".' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    } 

    public function get_job_estimation($job_id)
    {
        // die($hsncode);
        $this->db->select("ep.*", FALSE)->where('job_id',$job_id);
        $query = $this->db->get($this->job_estimation.' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    } 


    public function get_in_out_details($job_id,$id=null)
    {
        // die($hsncode);
        $this->db->select("ep.*,concat(u.first_name,' ',u.last_name) issuer_name,employee_id", FALSE)->where('job_id',$job_id);
        $this->db->join('users as u','u.id=ep.issuer','LEFT');
        if($id)
        {
            $this->db->where("ep.form_id",$id);
        }
        $this->db->order_by('ep.form_id','DESC');
        $query = $this->db->get($this->in_out_details.' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    } 

    public function get_store_requirements($job_id,$row_id=null)
    {
        // die($hsncode);
        $this->db->select("ep.*,concat(u.first_name,' ',u.last_name) added_by,employee_id,concat(s.inquiry_no,'-',jd.job_sequence) job_name", FALSE)->where('job_id',$job_id);
        if($row_id)
        {
            $this->db->where('ep.form_id',$row_id);
        }
        $this->db->join('users as u','u.id=ep.added_by','LEFT');
        $this->db->join($this->table.' as jd','jd.form_id=ep.job_id');
        $this->db->join($this->service_table.' as s','s.form_id=jd.service_id');
        $this->db->order_by('ep.form_id','DESC');
        $query = $this->db->get($this->store_requirement.' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    } 

    public function get_employee_list($job_id)
    {
        // die($hsncode);
        $this->db->select("ep.*", FALSE)->where('status','active');
        $query = $this->db->get('users AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    } 
    
    public function add_estimation($id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('components', 'components', 'trim|required');
        $this->form_validation->set_rules('components_cost', 'components_cost', 'trim|required|');
        $this->form_validation->set_rules('remarks', 'remarks', "trim|required");
        $this->form_validation->set_rules('original_ref', 'original_ref', 'trim|required');
        $this->form_validation->set_rules('original_cost', 'original_cost', 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            // set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id    = currentuserinfo()->id;
        // $hsn_code_and_tax = $this->input->post('hsn_code',TRUE);
        // $hsn_data = explode("_", $hsn_code_and_tax);
        $data['repairable']         = $this->input->post('repairable',TRUE);
        $data['service_level']      = $this->input->post('service_level',TRUE);
        $data['testing_level']      = $this->input->post('testing_level',TRUE);
        $data['quality_level']      = $this->input->post('quality_level',TRUE);
        $data['lead_level']         = $this->input->post('lead_level',TRUE);
        $data['service_time']       = $this->input->post('service_time',TRUE);
        $data['testing_time']       = $this->input->post('testing_time',TRUE);
        $data['quality_time']       = $this->input->post('quality_time',TRUE);
        $data['lead_time']          = $this->input->post('lead_time',TRUE);
        $data['offloading']         = $this->input->post('offloading',TRUE);
        $data['offloading_cost']    = $this->input->post('offloading_cost',TRUE);
        $data['components']         = $this->input->post('components',TRUE);
        $data['components_cost']    = $this->input->post('components_cost',TRUE);
        $data['remarks']            = $this->input->post('remarks',TRUE);
        $data['approximate_cost']   = $this->input->post('approximate_cost',TRUE);
        $data['original_ref']       = $this->input->post('original_ref',TRUE);
        $data['original_cost']      = $this->input->post('original_cost',TRUE);
        // $data['vat']             = @$hsn_data[1];
        $data['job_id']              = $id;
        // $data['make_issue_inch']                = $user_id;
        set_common_insert_value();
        $this->db->insert($this->job_estimation, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success","Job card estimation added successfully!!!");
        return $last_id;
    }

    public function edit_estimation($job_id,$id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('components', 'components', 'trim|required');
        $this->form_validation->set_rules('components_cost', 'components_cost', 'trim|required|');
        $this->form_validation->set_rules('remarks', 'remarks', "trim|required");
        $this->form_validation->set_rules('original_ref', 'original_ref', 'trim|required');
        $this->form_validation->set_rules('original_cost', 'original_cost', 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            // set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id    = currentuserinfo()->id;
        $data['repairable']         = $this->input->post('repairable',TRUE);
        $data['service_level']      = $this->input->post('service_level',TRUE);
        $data['testing_level']      = $this->input->post('testing_level',TRUE);
        $data['quality_level']      = $this->input->post('quality_level',TRUE);
        $data['lead_level']         = $this->input->post('lead_level',TRUE);
        $data['service_time']       = $this->input->post('service_time',TRUE);
        $data['testing_time']       = $this->input->post('testing_time',TRUE);
        $data['quality_time']       = $this->input->post('quality_time',TRUE);
        $data['lead_time']          = $this->input->post('lead_time',TRUE);
        $data['offloading']         = $this->input->post('offloading',TRUE);
        $data['offloading_cost']    = $this->input->post('offloading_cost',TRUE);
        $data['components']         = $this->input->post('components',TRUE);
        $data['components_cost']    = $this->input->post('components_cost',TRUE);
        $data['remarks']            = $this->input->post('remarks',TRUE);
        $data['approximate_cost']   = $this->input->post('approximate_cost',TRUE);
        $data['original_ref']       = $this->input->post('original_ref',TRUE);
        $data['original_cost']      = $this->input->post('original_cost',TRUE);
        set_common_update_value2();
        $this->db->where('form_id',$id)->where('job_id',$job_id);
        $this->db->update($this->job_estimation, $data);
        set_flashdata("success","Job card estimation edited successfully!!!");
        return true;
    }
    
    public function add_in_out($id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('purpose', 'purpose', 'trim|required|');
        $this->form_validation->set_rules('remarks', 'remarks', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id                    = currentuserinfo()->id;
        $data['issuer']             = $user_id;
        $data['purpose']            = $this->input->post('purpose',TRUE);
        $data['remarks']            = $this->input->post('remarks',TRUE);
        $data['out_date']           = date('Y-m-d H:i:s');
        $data['in_date']            = '';
        $data['job_id']             = $id;
        set_common_insert_value();
        $this->db->insert($this->in_out_details, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success","Record added successfully!!!");
        return $last_id;
    }

    public function add_in_detail($id,$job_id)
    {
        // pr($_POST);die;
        $data['in_date']           = date('Y-m-d H:i:s');
        $this->db->where('form_id',$id)->where('job_id',$job_id)->update($this->in_out_details, $data);
        set_flashdata("success","Record updated successfully!!!");
        return $this->db->affected_rows();
    }
    
    public function edit_in_out($id,$job_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('issuer', 'issuer', 'trim|required');
        $this->form_validation->set_rules('purpose', 'purpose', 'trim|required|');
        $this->form_validation->set_rules('out_date', 'out_date', "trim|required");
        $this->form_validation->set_rules('in_date', 'in_date', 'trim|required');
        $this->form_validation->set_rules('remarks', 'remarks', 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            // set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $out_date                   = date('Y-m-d H:i:s',strtotime($this->input->post('out_date',TRUE)));
        $in_date                    = date('Y-m-d H:i:s',strtotime($this->input->post('in_date',TRUE)));
        $data['issuer']             = $this->input->post('issuer',TRUE);
        $data['purpose']            = $this->input->post('purpose',TRUE);
        $data['out_date']           = $out_date;
        $data['in_date']            = $in_date;
        $data['remarks']            = $this->input->post('remarks',TRUE);
        $data['job_id']             = $job_id;
        set_common_update_value2();
        $this->db->where('form_id',$id)->where('job_id',$job_id);
        $this->db->update($this->in_out_details, $data);
        set_flashdata("success","Record Updated successfully!!!");
        return true;
    }

    public function delete_in_out($id,$job_id)
    {
        // pr($_POST);die;
        $this->db->where('form_id',$id)->where('job_id',$job_id);
        $this->db->delete($this->in_out_details);
        set_flashdata("success","Record deleted successfully!!!");
        return true;
    }   
    
    public function get_store_issue($job_name)
    {
        $this->db->close();
        $confignew = connect_to_oc_db();
        $OC = $this->load->database($confignew, TRUE);
        $OC->select('op.*,p.upc,concat(o.firstname," ",o.lastname) customer_name',false)->from('oc_order_product op')
        ->join('oc_order o','op.order_id=o.order_id')
        ->join('oc_product p','p.product_id=op.order_product_id')
        ->where('TRIM(op.progress_id)',$job_name)
        ->order_by('o.order_id','DESC');
        $query = $OC->get();
        if($query->num_rows() > 0)
        {
            // pr($query->result());die;
            return $query->result();
        }
        // echo $OC->last_query();die;
        $OC->close();
        return false;
    }

    public function get_upc_list()
    {
        $this->db->close();
        $confignew = connect_to_oc_db();
        $OC = $this->load->database($confignew, TRUE);
        $OC->select('op.upc,op.product_id',false)->from('oc_product op')
        ->where('op.status','1')
        ->order_by('op.product_id','DESC');
        $query = $OC->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        $OC->close();
        return false;
    }

    public function get_digital_product_details($product_id)
    {
        $data = [];
        $cat  = [];
        $this->db->close();
        $confignew = connect_to_oc_db();
        $OC = $this->load->database($confignew, TRUE);
        $OC->select('cd.name category_name,cd.category_id,c.parent_id',false)
        ->join('oc_category c','c.category_id=pc.category_id')
        ->join('oc_category_description cd','c.category_id=cd.category_id')
        ->from('oc_product_to_category pc')
        ->where('pc.product_id',$product_id)
        ->where('cd.language_id','1')->limit(2);
        $query = $OC->get();
        // echo $OC->last_query();die;
        if($query->num_rows() > 0)
        {
            // pr($query->result());die;
            $cat_id = '';
            foreach($query->result() as $category)
            {
                if($category->parent_id == 59)
                {
                    $data['category'] = $category->category_name;
                    $cat_id           = $category->category_id;
                }
                if($cat_id == $category->parent_id)
                {
                    $data['sub_category'] = $category->category_name;
                }
            }
            // $data['category'] = $cat;
        }
        //now get specification also
        $OC->select('pd.model,pd.sales_price',false)
        ->from('oc_product pd')
        ->where('pd.product_id',$product_id);
        $query = $OC->get();
        // echo $OC->last_query();die;
        if($query->num_rows() > 0)
        {
            $data['specification'] =  $query->row()->model;
            $data['price']         =  $query->row()->sales_price;
        }
        $OC->close();
        return $data;
    }

    public function add_requirements($job_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('new_or_exist', 'Status', 'trim|required|');
        $this->form_validation->set_rules('qty', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('requirement', 'Requirement', 'trim|required');
        $this->form_validation->set_rules('ref_price', 'Ref. Price', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // set_flashdata("error",validation_errors());
            $data['validation_errors'] = true;
            return $data;
        } 
        // $user_id                    = currentuserinfo()->id;
        // $data['added_by']           = $user_id;
        $data['new_or_exist']       = $this->input->post('new_or_exist',TRUE);
        $data['upc']                = $this->input->post('upc_value',TRUE);
        $data['category']           = $this->input->post('category',TRUE);
        $data['sub_cat']            = $this->input->post('sub_cat',TRUE);
        $data['specification']      = $this->input->post('specification',TRUE);
        $data['qty']                = $this->input->post('qty',TRUE);
        $data['requirement']        = $this->input->post('requirement',TRUE);
        $data['ref_price']          = $this->input->post('ref_price',TRUE);
        $data['total_price']        = $this->input->post('total_price',TRUE);
        $data['supplier_name']      = $this->input->post('supplier_name',TRUE);
        $data['job_id']             = $job_id;
        set_common_insert_value();
        $this->db->insert($this->store_requirement, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success","Record added successfully!!!");
        return $last_id;
    }
    
    public function edit_requirements($id,$job_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('new_or_exist', 'Status', 'trim|required|');
        $this->form_validation->set_rules('qty', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('requirement', 'Requirement', 'trim|required');
        $this->form_validation->set_rules('ref_price', 'Ref. Price', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            // set_flashdata("error",validation_errors());
            $data['validation_errors'] = true;
            return $data;
        } 
        // $user_id                    = currentuserinfo()->id;
        // $data['added_by']           = $user_id;
        $data['new_or_exist']       = $this->input->post('new_or_exist',TRUE);
        $data['upc']                = $this->input->post('upc_value',TRUE);
        $data['category']           = $this->input->post('category',TRUE);
        $data['sub_cat']            = $this->input->post('sub_cat',TRUE);
        $data['specification']      = $this->input->post('specification',TRUE);
        $data['qty']                = $this->input->post('qty',TRUE);
        $data['requirement']        = $this->input->post('requirement',TRUE);
        $data['ref_price']          = $this->input->post('ref_price',TRUE);
        $data['total_price']        = $this->input->post('total_price',TRUE);
        $data['supplier_name']      = $this->input->post('supplier_name',TRUE);
        $data['modified_time']      = date('Y-m-d H:i:s');
        // set_common_update_value2();
        $this->db->where('form_id',$id)->where('job_id',$job_id)->update($this->store_requirement, $data);
        $affected_rows = $this->db->affected_rows();
        // add_report($affected_rows);
        set_flashdata("success","Record updated successfully!!!");
        return $affected_rows;
    }
    
    public function delete_store_requirements($id,$job_id)
    {
        // pr($_POST);die;
        $this->db->where('form_id',$id)->where('job_id',$job_id);
        $this->db->delete($this->store_requirement);
        set_flashdata("success","Record deleted successfully!!!");
        return true;
    }  

    public function add_contract($job_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('subject', lang('subject'), 'trim|required');
        $this->form_validation->set_rules('contract_no', lang('contract_no'), 'trim|required|');
        //$this->form_validation->set_rules('supplier', lang('supplier'), "trim|required");
        //$this->form_validation->set_rules('supplier_contract', lang('supplier_contract'), 'trim|required');
        $this->form_validation->set_rules('payment_terms', lang('payment_terms'), 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            $data['validation_errors'] = true;
            return $data;
        } 
        $data['contract_status']                = $this->input->post('contract_status',TRUE);
        $data['internal_remarks']               = $this->input->post('internal_remarks',TRUE);
        $data['advance']                        = $this->input->post('advance_paid',TRUE);
        $data['advance_date']                   = $this->input->post('advance_paid_date',TRUE);
        $data['balance']                        = $this->input->post('balance_paid',TRUE);
        $data['balance_date']                   = $this->input->post('balance_paid_date',TRUE);
        $data['advance_amount']                 = $this->input->post('advance_amount',TRUE);
        $data['comitted_date']                  = $this->input->post('comitted_date',TRUE);
        $data['supplier_invoice_no']            = $this->input->post('supplier_invoice_no',TRUE);
        $data['supplier_date']                  = $this->input->post('supplier_invoice_date',TRUE);
        $data['subject']                        = $this->input->post('subject',TRUE);
        $data['currency']                       = $this->input->post('currency',TRUE);
        $data['contract_name']                  = $this->input->post('contract_name',TRUE);
        $data['supplier']                       = $this->input->post('supplier',TRUE);
        $data['supplier_contract']              = $this->input->post('supplier_contract',TRUE);
        $data['contract_no']                    = $this->input->post('contract_no',TRUE);
        $data['contract_date']                  = $this->input->post('contract_date',TRUE);
        $data['payment_terms']                  = $this->input->post('payment_terms',TRUE);
        $data['freight_insurance']              = $this->input->post('freight',TRUE);
        $data['pf']                             = $this->input->post('pf',TRUE);
        $data['delivery_terms']                 = $this->input->post('delivery_terms',TRUE);
        $data['warranty_terms']                 = $this->input->post('warranty_terms',TRUE);
        $data['ld_charges']                     = $this->input->post('ld_charges',TRUE);
        $data['currency_terms']                 = $this->input->post('currency_terms',TRUE);
        $data['inspection']                     = $this->input->post('inspection',TRUE);
        $data['po_basic']                       = $this->input->post('po_basic',TRUE);
        $data['po_tax']                         = $this->input->post('po_tax',TRUE);
        $data['po_tax_value']                   = $this->input->post('po_tax_value',TRUE);
        $data['contract_basic']                 = $this->input->post('contract_basic',TRUE);
        $data['igst']                           = $this->input->post('igst',TRUE);
        $data['cgst']                           = $this->input->post('cgst',TRUE);
        $data['sgst']                           = $this->input->post('sgst',TRUE);
        $data['contract_amount']                = $this->input->post('contract_amount',TRUE);
        $data['note']                           = $this->input->post('note',TRUE);
        $data['job_id']                         = $job_id;
        set_common_insert_value();
        $this->db->insert($this->contract, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success","Contract added successfully!!!");
        return $last_id;
    }

    public function get_contract($job_id,$id=null)
    {
        // die($hsncode);
        $this->db->select("ep.*,s.name supplier_name,st.name as status", FALSE);
        // $this->db->join("$this->table p","ep.order_id = p.form_id", 'left');
        $this->db->join("supplier_ind s","ep.supplier = s.id", 'left');
        $this->db->join("inch_contract_status st","ep.contract_status = st.form_id", 'left');
        $this->db->where('ep.job_id',$job_id);
        if($id)
        {
            $this->db->where('ep.form_id',$id);
        }
        // $this->db->where_in('ep.form_id',$ids);
        $this->db->order_by('ep.created_time','asc');
        $query = $this->db->get($this->contract.' AS ep');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
    }
    
    public function edit_contract($id,$job_id)
    {
        $this->form_validation->set_rules('subject', lang('subject'), 'trim|required');
        $this->form_validation->set_rules('contract_no', lang('contract_no'), 'trim|required|');
        $this->form_validation->set_rules('payment_terms', lang('payment_terms'), 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            $data['validation_errors'] = true;
            return $data;
        } 
        $data['contract_status']                = $this->input->post('contract_status',TRUE);
        $data['internal_remarks']               = $this->input->post('internal_remarks',TRUE);
        $data['advance']                        = $this->input->post('advance_paid',TRUE);
        $data['advance_date']                   = $this->input->post('advance_paid_date',TRUE);
        $data['balance']                        = $this->input->post('balance_paid',TRUE);
        $data['balance_date']                   = $this->input->post('balance_paid_date',TRUE);
        $data['advance_amount']                 = $this->input->post('advance_amount',TRUE);
        $data['comitted_date']                  = $this->input->post('comitted_date',TRUE);
        $data['supplier_invoice_no']            = $this->input->post('supplier_invoice_no',TRUE);
        $data['supplier_date']                  = $this->input->post('supplier_invoice_date',TRUE);
        $data['subject']                        = $this->input->post('subject',TRUE);
        $data['currency']                       = $this->input->post('currency',TRUE);
        $data['contract_name']                  = $this->input->post('contract_name',TRUE);
        $data['supplier']                       = $this->input->post('supplier',TRUE);
        $data['supplier_contract']              = $this->input->post('supplier_contract',TRUE);
        $data['contract_no']                    = $this->input->post('contract_no',TRUE);
        $data['contract_date']                  = $this->input->post('contract_date',TRUE);
        $data['payment_terms']                  = $this->input->post('payment_terms',TRUE);
        $data['freight_insurance']              = $this->input->post('freight',TRUE);
        $data['pf']                             = $this->input->post('pf',TRUE);
        $data['delivery_terms']                 = $this->input->post('delivery_terms',TRUE);
        $data['warranty_terms']                 = $this->input->post('warranty_terms',TRUE);
        $data['ld_charges']                     = $this->input->post('ld_charges',TRUE);
        $data['currency_terms']                 = $this->input->post('currency_terms',TRUE);
        $data['inspection']                     = $this->input->post('inspection',TRUE);
        $data['po_basic']                       = $this->input->post('po_basic',TRUE);
        $data['po_tax']                         = $this->input->post('po_tax',TRUE);
        $data['po_tax_value']                   = $this->input->post('po_tax_value',TRUE);
        $data['contract_basic']                 = $this->input->post('contract_basic',TRUE);
        $data['igst']                           = $this->input->post('igst',TRUE);
        $data['cgst']                           = $this->input->post('cgst',TRUE);
        $data['sgst']                           = $this->input->post('sgst',TRUE);
        $data['contract_amount']                = $this->input->post('contract_amount',TRUE);
        $data['note']                           = $this->input->post('note',TRUE);
        $data['job_id']                         = $job_id;
        set_common_update_value();
        $this->db->where('form_id',$id);
        $this->db->where('job_id',$job_id);
        $this->db->update($this->contract, $data);
        $last_id = $this->db->affected_rows();
        set_flashdata("success","Contract updated successfully!!!");
        return $last_id;
    }
    
    public function freeze_unfreeze_contract($id,$job_id,$status)
    {
       $data['is_freeze'] = $status;
       $this->db->where_in('form_id',$id)->where('job_id',$job_id)->update($this->contract,$data);
       return $this->db->affected_rows();
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


    public function get_additional_assign($job_id)
    {
        
        // $this->db->select("cc.*, concat(u.first_name,' ',u.last_name) AS user_name", FALSE);
        $this->db->select("aa.*,concat(u.first_name,' ',u.last_name) service_engineer_name,concat(u1.first_name,' ',u1.last_name) testing_engineer_name,concat(u2.first_name,' ',u2.last_name) quality_engineer_name,concat(u3.first_name,' ',u3.last_name) lead_engineer_name", FALSE);
        $this->db->join('users as u','u.id=aa.service_engineer','LEFT');
        $this->db->join('users as u1','u1.id=aa.testing_engineer','LEFT');
        $this->db->join('users as u2','u2.id=aa.quality_engineer','LEFT');
        $this->db->join('users as u3','u3.id=aa.lead_engineer','LEFT');
        $query = $this->db->get('inch_job_additional_assignment aa');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        return false;
        // echo $this->db->last_query();die;
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

    public function change_job_status($status_id=NULL,$job_id=NULL)
    {
        if($status_id && $job_id)
        {
            $this->db->where('form_id', $job_id);
            return $this->db->update($this->table, ['status'=>$status_id]);
            // echo $this->db->last_query();die;
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


          

    public function get_payment_list($order_id)
    {
        $this->db->select("*", FALSE);
        $this->db->where('ep.order_id',$order_id);
        // $this->db->where('ep.status', 1);
        // $this->db->group_by('ep.supplier_po_seq');
        $query = $this->db->get("inch_payment_details".' AS ep');
        $payment_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($payment_list);die;
        return $payment_list;
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


    public function product_sequence($order)
    {
        // die($hsncode);
        $this->db->select("max(ep.product_sequence) as sequence", FALSE);
        $this->db->where('ep.order_id',$order);
        $query = $this->db->get("inch_order_product".' AS ep');
        if($query->num_rows() > 0)
        {
            return ((int)$query->row()->sequence) + 1;
        }
        return false;
    }  

}
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
 
class Order_mod extends CI_Model {
    
    public $table   	   	= TBL_PREFIX."order";
    public $enq_product     = TBL_PREFIX."order_product";
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
      
    public function get_order_list($type, $id='', $count='', $limit='', $start='')
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
      	$this->db->select("SQL_CALC_FOUND_ROWS e.*, cs.name as china_status_name,count(p.form_id) as total_product, SUM(p.status) as total_product_recieved",FALSE);
        // $this->db->join('companies as c','c.id=e.client_name','LEFT');
        // $this->db->join('inch_order_status_master as es','es.form_id=e.current_status','LEFT');
        $this->db->join('inch_order_status_china_master as cs','cs.form_id=e.china_status','LEFT');
        // $this->db->join('users as u','u.id=e.inch_name','LEFT');
        // $this->db->join('users as u2','u2.id=e.cfit_name','LEFT');
        // $this->db->join('companies_contact AS cc','cc.id=e.issuer_name','LEFT');
        // $this->db->join('user_groups as ug','ug.id=u.group_id','LEFT');
        // $this->db->join('inch_enquiry as eq','eq.enq_no=e.enq_no','LEFT');
        $this->db->join($this->enq_product.' as p','p.order_id=e.form_id','LEFT');
        $this->db->where('e.order_type', $type);
        $this->db->where('e.is_deleted',0);
        $this->db->group_by('e.form_id');
        
        if($this->data['designation'] != 'Super Admin')
        {
            if($this->data['is_china'])
            {
                $this->db->where('current_status', 3);
            }
        }

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
    
    public function add_product($id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('description_issued_by_customer', lang('description_issued_by_customer'), 'trim|required');
        $this->form_validation->set_rules('description_issued_by_inch', lang('description_issued_by_inch'), 'trim|required|');
        $this->form_validation->set_rules('qty', lang('qty'), "trim|required");
        $this->form_validation->set_rules('uom', lang('uom'), 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id    = currentuserinfo()->id;
        // $hsn_code_and_tax = $this->input->post('hsn_code',TRUE);
        // $hsn_data = explode("_", $hsn_code_and_tax);
        $data['description_issued_by_customer'] = $this->input->post('description_issued_by_customer',TRUE);
        $data['description_issued_by_inch']     = $this->input->post('description_issued_by_inch',TRUE);
        $data['qty']                            = $this->input->post('qty',TRUE);
        $data['uom']                            = $this->input->post('uom',TRUE);
        $data['hsn_code']                       = $this->input->post('hsn_code',TRUE);
        $data['make_issue_inch']                = $this->input->post('make_issue_inch',TRUE);
        // $data['vat']                            = @$hsn_data[1];
        $data['enquiry_id']                     = $id;
        // $data['make_issue_inch']                = $user_id;
        set_common_insert_value();
        $this->db->insert($this->enq_product, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success",lang('add_product_success'));
        return $last_id;
    }

    public function edit_product($id, $enquiry_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('description_issued_by_customer', lang('description_issued_by_customer'), 'trim|required');
        $this->form_validation->set_rules('description_issued_by_inch', lang('description_issued_by_inch'), 'trim|required|');
        $this->form_validation->set_rules('qty', lang('qty'), "trim|required");
        $this->form_validation->set_rules('uom', lang('uom'), 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $hsn_code_and_tax = $this->input->post('hsn_code',TRUE);
        $hsn_data = explode("_", $hsn_code_and_tax);
        $data['description_issued_by_customer'] = $this->input->post('description_issued_by_customer',TRUE);
        $data['description_issued_by_inch']     = $this->input->post('description_issued_by_inch',TRUE);
        $data['qty']                            = $this->input->post('qty',TRUE);
        $data['uom']                            = $this->input->post('uom',TRUE);
        $data['hsn_code']                       = $this->input->post('hsn_code',TRUE);
        $data['make_issue_inch']                = $this->input->post('make_issue_inch',TRUE);

        // $data['hsn_code']                       = @$hsn_data[0];
        // $data['vat']                            = @$hsn_data[1];
        set_common_update_value2();
        $this->db->where('form_id', $id);
        $status = $this->db->update($this->enq_product, $data);
        add_report($id);
        set_flashdata("success",lang('edit_product_success'));
        return $status;
    }
    
    public function edit_product_china($id, $enquiry_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('description_issued_by_cfit', lang('description_issued_by_cfit'), 'trim|required|');
        $this->form_validation->set_rules('make_issue_cfit', lang('make_issue_cfit'), 'trim|required');
                    
        if($this->form_validation->run() == FALSE)
        {
            // echo validation_errors();die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        
        $hsn_code_and_tax = $this->input->post('hsn_code',TRUE);
        $hsn_data = explode("_", $hsn_code_and_tax);
        $data['description_issued_by_cfit']     = $this->input->post('description_issued_by_cfit',TRUE);
        $data['make_issue_cfit']                = $this->input->post('make_issue_cfit',TRUE);

        set_common_update_value2();
        $this->db->where('form_id', $id);
        $status = $this->db->update($this->enq_product, $data);
        // echo $this->db->last_query();die;
        add_report($id);
        set_flashdata("success",lang('edit_product_success'));
        return $status;
    }
    
    public function get_product_list($id, $order_id = NULL, $po_nos=NULL)
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
        // pr($product_list);die;
        /*if(isset($product_list) && !empty($product_list))
        {
            foreach ($product_list as $key => $product) {
                $this->db->select("pq.*, sc.name as supplier, sv.name as supplier_type_name, concat(u.first_name,' ',u.last_name) as added_by_name", FALSE);
                $this->db->where('pq.product_id',$product->form_id);
                $this->db->join('supplier_vendor as sv','sv.id=pq.supplier_type','LEFT');
                $this->db->join('supplier_china as sc','sc.id=pq.supplier');
                $this->db->join('users as u','u.id=pq.added_by','LEFT');
                $this->db->order_by('pq.'.PRIMARY_KEY, 'DESC');
                $query = $this->db->get($this->product_quot.' AS pq');
                $quotation_list = $query->result();
                // pr($quotation_list);die;
                $product_list[$key]->quotation_list = $quotation_list;
            }

        }*/
        // pr($product_list);die;
        return $product_list;
        // echo $this->db->last_query();die;
    }
    
    public function add_po_product($order_id)
    {
        // pr($_POST);
        $this->form_validation->set_rules('description_issued_by_customer', lang('description_issued_by_customer'), 'trim|required');
        $this->form_validation->set_rules('description_issued_by_inch', lang('description_issued_by_inch'), 'trim|required');
        $this->form_validation->set_rules('qty', lang('qty'), 'trim|required');
        $this->form_validation->set_rules('uom', 'Unit Of Measurement', 'trim|required');
        $this->form_validation->set_rules('hsn_code_india', lang('hsn_code'), 'trim|required');
        $this->form_validation->set_rules('enquiry_id', lang('enquiry_id'), 'trim|required');
        // $this->form_validation->set_rules('hsn_code_china', lang('hsn_code'), 'trim|required');
        $this->form_validation->set_rules('supplier_country', lang('supplier_country'), 'trim|required');
        $this->form_validation->set_rules('po_basic', lang('po_basic'), 'trim|required');
        $this->form_validation->set_rules('inv_description', lang('inv_description'), 'trim|required|');
        $this->form_validation->set_rules('po_total_basic', lang('po_total_basic'), "trim|required");
        $this->form_validation->set_rules('po_tax', lang('po_tax'), 'trim|required');
        $this->form_validation->set_rules('po_tax_value', lang('po_tax_value'), 'trim|required');
        $this->form_validation->set_rules('total_price_with_tax', lang('total_price_with_tax'), 'trim|required');
        // $this->form_validation->set_rules('validity_days', lang('validity_days'), 'trim|required');
        // $this->form_validation->set_rules('delivery_cost', lang('delivery_cost'), 'trim|required');
        // $this->form_validation->set_rules('packing_cost', lang('packing_cost'), 'trim|required');
        // $this->form_validation->set_rules('warranty_month', lang('warranty_month'), 'trim|required');
        // $this->form_validation->set_rules('supplier_country', lang('supplier_country'), 'trim|required');
        // $this->form_validation->set_rules('supplier', lang('supplier'), 'trim|required');
        // $this->form_validation->set_rules('supplier_type', lang('supplier_type'), 'trim|required');
        // $this->form_validation->set_rules('vat', lang('vat'), 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            // pr(validation_errors());die;
            set_flashdata("error", validation_errors());
            return FALSE;
        } 
        
        $data['description_issued_by_customer'] = $this->input->post('description_issued_by_customer',TRUE);
        $data['description_issued_by_inch']     = $this->input->post('description_issued_by_inch',TRUE);
        $data['qty']                            = $this->input->post('qty',TRUE);
        $data['uom']                            = $this->input->post('uom',TRUE);
        $data['hsn_code']                       = $this->input->post('hsn_code_india',TRUE);
        // $data['hsn_code_china']                 = $this->input->post('hsn_code_china',TRUE);
        $data['po_basic']                       = $this->input->post('po_basic',TRUE);
        $data['inv_description']                = $this->input->post('inv_description',TRUE);
        $data['po_total_basic']                 = $this->input->post('po_total_basic',TRUE);
        $data['total_price_with_tax']           = $this->input->post('total_price_with_tax',TRUE);
        $data['po_tax_value']                   = $this->input->post('po_tax_value',TRUE);
        $data['product_sequence']               = $this->input->post('product_sequence',TRUE);
        // $data['validity_days']                  = $this->input->post('validity_days',TRUE);
        // $data['delivery_cost']                  = $this->input->post('delivery_cost',TRUE);
        // $data['packing_cost']                   = $this->input->post('packing_cost',TRUE);
        // $data['warranty_month']                 = $this->input->post('warranty_month',TRUE);
        $data['supplier_country']               = $this->input->post('supplier_country',TRUE);
        // $data['supplier']                       = $this->input->post('supplier',TRUE);
        // $data['supplier_type']                  = $this->input->post('supplier_type',TRUE);
        $data['vat']                            = $this->input->post('po_tax',TRUE);
        $data['enquiry_id']                     = $this->input->post('enquiry_id',TRUE);
        $data['order_id']                       = $order_id;
        
        set_common_insert_value();
        $this->db->insert($this->enq_product, $data);
        $last_id = $this->db->insert_id();
        add_report($last_id);
        set_flashdata("success",lang('add_product_success'));
        return $last_id;
    }

    public function edit_po_product($id, $order_id)
    {
        // pr($_POST);die;
       $this->form_validation->set_rules('description_issued_by_customer', lang('description_issued_by_customer'), 'trim|required');
        $this->form_validation->set_rules('description_issued_by_inch', lang('description_issued_by_inch'), 'trim|required');
        $this->form_validation->set_rules('qty', lang('qty'), 'trim|required');
        $this->form_validation->set_rules('uom', 'Unit Of Measurement', 'trim|required');
        $this->form_validation->set_rules('hsn_code_india', lang('hsn_code'), 'trim|required');
        $this->form_validation->set_rules('enquiry_id', lang('enquiry_id'), 'trim|required');
        // $this->form_validation->set_rules('hsn_code_china', lang('hsn_code'), 'trim|required');
        $this->form_validation->set_rules('supplier_country', lang('supplier_country'), 'trim|required');
        $this->form_validation->set_rules('po_basic', lang('po_basic'), 'trim|required');
        $this->form_validation->set_rules('inv_description', lang('inv_description'), 'trim|required|');
        $this->form_validation->set_rules('po_total_basic', lang('po_total_basic'), "trim|required");
        $this->form_validation->set_rules('po_tax', lang('po_tax'), 'trim|required');
        $this->form_validation->set_rules('po_tax_value', lang('po_tax_value'), 'trim|required');
        $this->form_validation->set_rules('total_price_with_tax', lang('total_price_with_tax'), 'trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        }
        
        $data['description_issued_by_customer'] = $this->input->post('description_issued_by_customer',TRUE);
        $data['description_issued_by_inch']     = $this->input->post('description_issued_by_inch',TRUE);
        $data['qty']                            = $this->input->post('qty',TRUE);
        $data['uom']                            = $this->input->post('uom',TRUE);
        $data['hsn_code']                       = $this->input->post('hsn_code_india',TRUE);
        $data['po_basic']                       = $this->input->post('po_basic',TRUE);
        $data['inv_description']                = $this->input->post('inv_description',TRUE);
        $data['po_total_basic']                 = $this->input->post('po_total_basic',TRUE);
        $data['total_price_with_tax']           = $this->input->post('total_price_with_tax',TRUE);
        $data['po_tax_value']                   = $this->input->post('po_tax_value',TRUE);
        $data['supplier_country']               = $this->input->post('supplier_country',TRUE);
        $data['vat']                            = $this->input->post('po_tax',TRUE);
        $data['enquiry_id']                     = $this->input->post('enquiry_id',TRUE);

        set_common_update_value2();
        $this->db->where('form_id', $id);
        $status = $this->db->update($this->enq_product, $data);
        add_report($id);
        set_flashdata("success",lang('edit_product_success'));
        return $status;
    }
    
    public function edit_offer($product_id, $enquiry_id)
    {
        // pr($_POST);die;
        $this->form_validation->set_rules('cf', lang('cf'), 'trim|required');
        $this->form_validation->set_rules('shipping_cost_china_india', lang('shipping_cost_china_india'), 'trim|required|');
        $this->form_validation->set_rules('basic_custom_duty', lang('basic_custom_duty'), "trim|required");
        $this->form_validation->set_rules('shipping_cost_india', lang('shipping_cost_india'), 'trim|required');
        $this->form_validation->set_rules('total_landed_price', lang('total_landed_price'), 'trim|required');
        $this->form_validation->set_rules('unit_price_landed_cost', lang('unit_price_landed_cost'), 'trim|required');
        $this->form_validation->set_rules('margin', lang('margin'), 'trim|required');
        $this->form_validation->set_rules('unit_offer_price', lang('unit_offer_price'), 'trim|required');
        $this->form_validation->set_rules('total_unit_offer_price', lang('total_unit_offer_price'), 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['cf']                         = $this->input->post('cf',TRUE);
        $data['shipping_cost_china_india']  = $this->input->post('shipping_cost_china_india',TRUE);
        $data['basic_custom_duty']          = $this->input->post('basic_custom_duty',TRUE);
        $data['shipping_cost_india']        = $this->input->post('shipping_cost_india',TRUE);
        $data['total_landed_price']         = $this->input->post('total_landed_price',TRUE);
        $data['unit_price_landed_cost']     = $this->input->post('unit_price_landed_cost',TRUE);
        $data['margin']                     = $this->input->post('margin',TRUE);
        $data['unit_offer_price']           = $this->input->post('unit_offer_price',TRUE);
        $data['total_unit_offer_price']     = $this->input->post('total_unit_offer_price',TRUE);
        set_common_update_value2();
        $this->db->where('form_id', $product_id);
        $status = $this->db->update($this->enq_product, $data);
        add_report($product_id);
        set_flashdata("success",lang('edit_offer_success'));
        return $status;
    }
    
    public function get_price_calc($id, $order_id)
    {
        if($id)
        {
            $this->db->where('ep.'.PRIMARY_KEY, $id);
        }

        $this->db->select("ep.*, um.name as unit_name, concat(u.first_name,' ',u.last_name) as given_by, sc.name as supplier, sv.name as supplier_type_name, hsn.name as hsn_name, hsn.gst as hsn_gst,ep.description_issued_by_customer,ep.description_issued_by_inch,ep.make_issue_inch,ep.description_issued_by_cfit,ep.make_issue_cfit,ep.qty",FALSE);
        $this->db->join('inch_unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=ep.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=ep.supplier','LEFT');
        $this->db->join('users as u','u.id=ep.added_by','LEFT');
        $this->db->join($this->table.' as e','e.form_id=ep.order_id');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->where('ep.order_id',$order_id);
        $this->db->where('ep.status', 1);
        $this->db->group_by('ep.form_id');
        $query = $this->db->get($this->enq_product.' AS ep');
        $product_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($product_list);die;
        return $product_list;
    }

    public function get_price_calc_print($id, $enquiry_id)
    {
        if($id)
        {
            $this->db->where('ep.'.PRIMARY_KEY,$id);
        }
        if(isset($_GET['rev']) && !empty($_GET['rev']))
        {
            $this->db->where('q.revision', $_GET['rev']);
        }
        $this->db->select("q.*,e.currency_factor, um.name as unit_name, concat(u.first_name,' ',u.last_name) as given_by, sc.name as supplier, sv.name as supplier_type_name, hsn.name as hsn_name, hsn.gst as hsn_gst,ep.description_issued_by_customer,ep.description_issued_by_inch,ep.make_issue_inch,ep.description_issued_by_cfit,ep.make_issue_cfit,ep.qty",FALSE);
        $this->db->join($this->enq_product.' as ep','ep.form_id=q.product_id','LEFT');
        $this->db->join('inch_unit_master as um','um.form_id=ep.uom','LEFT');
        $this->db->join('supplier_vendor as sv','sv.id=q.supplier_type','LEFT');
        $this->db->join('supplier_china as sc','sc.id=q.supplier','LEFT');
        $this->db->join('users as u','u.id=q.added_by','LEFT');
        $this->db->join($this->table.' as e','e.form_id=ep.enquiry_id');
        $this->db->join(TBL_PREFIX.'hsn_code_master as hsn','hsn.form_id=ep.hsn_code','LEFT');
        $this->db->where('q.enquiry_id',$enquiry_id);
        $this->db->where('q.status', 1);
        $this->db->group_by('q.form_id');
        $this->db->order_by('q.revision', 'ASC');
        $query = $this->db->get($this->product_quot.' AS q');
        $product_list = $query->result();
        // echo $this->db->last_query();die;
        // pr($product_list);die;
        return $product_list;
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
    
    public function get_offer_revision_list($order_id)
    {
        $this->db->select("SUM(total_unit_offer_price) as total_unit_offer_price, concat(u.first_name,' ',u.last_name) as given_by, supplier_po_seq", FALSE);
        $this->db->join('users as u','u.id=ep.added_by','LEFT');
        $this->db->where('ep.order_id',$order_id);
        $this->db->where('ep.status', 1);
        $this->db->group_by('ep.supplier_po_seq');
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


    public function get_abg_details($order_id)
    {
        $this->db->select("*", FALSE);
        $this->db->where('ep.order_id',$order_id);
        $query = $this->db->get("inch_abg_details".' AS ep');
        $payment_list = $query->row();
        return $payment_list;
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

    public function get_supplier_state($id)
    {
        $this->db->where('ed.id', $id)->where('state','1');//1 for haryana
        $data = $this->db->get('supplier_ind as ed')->num_rows();
        if($data)
        {
            return true;
        }
        return false;
    }  

}
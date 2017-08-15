<?php

class Credit extends Admin_Controller {	

	protected $activemenu 	= 'credit';
	var $current_admin	= false;
	
	
	function __construct()
	{		
		parent::__construct();		
		
		$this->load->model(array('Credit_model', 'Search_model', 'Point_model', 'Voucher_model', 'Branch_model'));
		//$this->load->model('location_model');
		$this->load->helper(array('formatting'));
		$this->lang->load('credit');
		
		$this->current_admin	= $this->session->userdata('admin');
		
		//var_dump($this->current_admin);
	}
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to retrieve voucher point or credit to customers automatically
	|----------------------------------------------------------------------------------------------------------*/
	function retrieve_voucher_value()
	{
		$data = array();
		$coupon_id = ($this->input->post('voucher_id')) ? $this->input->post('voucher_id') : 0;
		$payment = ($this->input->post('payment')) ? $this->input->post('payment') : '';
		//$coupon_id = 1;
		//$payment = 'Point';
	
		//check table first
		$vouchers = $this->Voucher_model->get_voucher($coupon_id);
	
	
		$value = 0;
		if($vouchers){
			if($payment == 'Credit'){
				$value = $vouchers->credit_consume;
			}else{
				$value = $vouchers->point_consume;
			}
		}else{
			$value		= 0;
		}
	
		echo $value;
	}
	
	public function check_credit($value)
	{
		//$customer_id			= $this->input->post('customer_id');
		$card 					= $this->input->post('card');
		$payment				= $this->input->post('payment');
				
		$customer		= $this->Customer_model->get_customer_by_card($card);
				
		if(!empty($customer) && isset($customer)){
			$balance = 0;
			if($payment == 'Credit'){
				$credit_balance = $this->Credit_model->get_credit_amt($customer['id']);
				$balance = $credit_balance['credit_amt'];
			}else{
				$point_balance = $this->Point_model->get_point_amt($customer['id']);
				$balance = $point_balance['point_amt'];
			}
						
			if($value > $balance)
			{
				if($payment == 'Credit'){
					$this->form_validation->set_message('check_credit', lang('invalid_credit_balance'));
				}else{
					$this->form_validation->set_message('check_credit', lang('invalid_point_balance'));
				}
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}else{			
			if($payment == 'Credit'){
				$this->form_validation->set_message('check_credit', lang('invalid_credit_balance'));
			}else{
				$this->form_validation->set_message('check_credit', lang('invalid_point_balance'));
			}
			return FALSE;
		}
			
		
	
	}
	
	//this is a callback to make sure that customers are not sharing an email address
	function check_card($str)
	{
		$customer	= $this->Customer_model->get_customer_by_card($str);
		
		if ($customer)
		{
			return TRUE;
		}
		else
		{
			//$this->form_validation->set_message('check_card', '2222');
			$this->form_validation->set_message('check_card', lang('error_card_in_use'));
			return FALSE;			
		}
	}
	
	function index($sort_by='created',$sort_order='desc', $code=0, $page=0, $rows=15)
	{		
		$data['activemenu'] 		= $this->activemenu;
		//if they submitted an export form do the export
		if($this->input->post('submit') == 'export')
		{
			$this->load->model('Credit_model');
			$this->load->helper('download_helper');
			$post	= $this->input->post(null, false);
			$term	= (object)$post;

			$data['credits']	= $this->Credit_model->get_credits($term);		
			
			force_download_content('credits.xml', $this->load->view($this->config->item('admin_folder').'/credits_xml', $data, true));
			
			//kill the script from here
			die;
		}
		
		$this->load->helper('form');
		$this->load->helper('date');
		$data['message']	= $this->session->flashdata('message');
		$data['page_title']	= lang('credits');
		$data['code']		= $code;
		$term				= false;
		
		$post	= $this->input->post(null, false);
		if($post)
		{
			//if the term is in post, save it to the db and give me a reference
			$term			= json_encode($post);			
			$code			= $this->Search_model->record_term($term);
			$data['code']	= $code;
			//reset the term to an object for use
			$term	= (object)$post;
		}
		elseif ($code)
		{
			$term	= $this->Search_model->get_term($code);
			$term	= json_decode($term);
		} 
 		
				
 		$data['term']	= $term;
 		$data['credits']	= $this->Credit_model->get_credits($term, $sort_by, $sort_order, $rows, $page);
		$data['total']	= $this->Credit_model->get_credits_count($term);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/credit/index/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
		$config['total_rows']		= $data['total'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 7;		
		
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '';
		$config['first_tag_close']	= '';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '';
		$config['last_tag_close']	= '';

		$config['full_tag_open']	= '<div class="btn-group">';
		$config['full_tag_close']	= '</div>';
		$config['cur_tag_open']		= '<a class="btn btn-white active" href="#">';
		$config['cur_tag_close']	= '</a>';
		
		$config['num_tag_open']		= '';
		$config['num_tag_close']	= '';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '';
		$config['prev_tag_close']	= '';

		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '';
		$config['next_tag_close']	= '';
		
		$this->pagination->initialize($config);
	
		$data['sort_by']	= $sort_by;
		$data['sort_order']	= $sort_order;
				
		$this->view($this->config->item('admin_folder').'/credits', $data);
	}
	
	function export()
	{
		$this->load->model('customer_model');
		$this->load->helper('download_helper');
		$post	= $this->input->post(null, false);
		$term	= (object)$post;
		
		$data['credits']	= $this->Credit_model->get_credits($term);		

		foreach($data['credits'] as &$o)
		{
			$o->items	= $this->Credit_model->get_items($o->id);
		}

		force_download_content('credits.xml', $this->load->view($this->config->item('admin_folder').'/credits_xml', $data, true));
		
	}
	
	function edit_status()
    {
    	$this->auth->is_logged_in();
    	$order['id']		= $this->input->post('id');
    	$order['status']	= $this->input->post('status');
    	
    	$this->Credit_model->save_order($order);
    	
    	echo url_title($order['status']);
    }    
	
	function bulk_delete()
    {
    	$credits	= $this->input->post('order');
    	
		if($credits)
		{
			foreach($credits as $order)
	   		{
	   			$this->Credit_model->delete($order);
	   		}
			$this->session->set_flashdata('message', lang('message_credits_deleted'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_no_credits_selected'));
		}
   		//redirect as to change the url
		redirect($this->config->item('admin_folder').'/credits');	
    }
    
    function topup_credit_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('topup_credit_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';   
    	$data['remark']				= '';    	
    	$data['active']				= false;
    	$data['branch_id']			= false;
    	
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/credit');
    		}
    			
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['email_subscribe']	= $customer->email_subscribe;    		
    			
    	}
    	
    	$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
    	$branch_list = array();
    	foreach($branches as $branch)
    	{
    		$branch_list[$branch['id']] = $branch['name'];
    	}
    	$data['branches'] = $branch_list;
    	
    	
    	//Checking for super admin
    	if($this->current_admin['branch'] == 0):
    		$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
    	endif;
    	
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('topup_date', 'lang:topup_date', 'trim|required');
    	$this->form_validation->set_rules('customer_cost', 'lang:customer_cost', 'trim|required|numeric');
    	$this->form_validation->set_rules('customer_topup_value', 'lang:customer_topup_value', 'trim|required|numeric');
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');    	
    	$this->form_validation->set_rules('active', 'lang:active');
    	    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/topup_credit_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		
    		$save['id']					= $id;
    		$save['customer_id']		= $customer['id'];
    		$save['cost']				= $this->input->post('customer_cost');
    		$save['in']					= $this->input->post('customer_topup_value');
    		$save['remark']				= $this->input->post('remark');
    		$save['created']			= format_ymd_malaysia($this->input->post('topup_date'));
    		$save['staff_id']			= $this->current_admin['id'];
    		
    		//Checking for super admin
    		if($this->current_admin['branch'] == 0):
    			$save['branch_id']					= $this->input->post('branch_id');
    		else:
    			$save['branch_id']					= $this->current_admin['branch'];
    		endif;
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');
    			
    		$last_id = $this->Credit_model->save_credit($save);
    			
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    			
    		//go to credit info
    		redirect($this->config->item('admin_folder').'/credit/topup_credit_info/'.$last_id);
    	}
    }
    
    function topup_credit_info($id = false)
    {
    	$data['page_title']		= lang('topup_credit_info');
    	
    	if($id){    		
    		$data['credit'] = $this->Credit_model->get_credit($id);    		
    		$this->view($this->config->item('admin_folder').'/topup_credit_info', $data);
    	}else{
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/credit/');
    	}
    }
    
    function consume_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('consume_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';
    	$data['remark']				= '';
    	$data['options']			= '';
    	$data['active']				= false;
    	$data['voucher_id'] = '';
    	
    	
    	$vouchers = $this->Voucher_model->get_vouchers(NULL, $this->current_admin, TRUE);
    	$voucher_list = array();
    	foreach($vouchers as $voucher)
    	{
    		$voucher_list[$voucher->id] = $voucher->name;
    	}
    	$data['vouchers'] = $voucher_list;
    	 
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/credit');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['options']			= '';
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    	 
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('consume_date', 'lang:consume_date', 'trim|required');
    	$this->form_validation->set_rules('consume_amount', 'lang:consume_amount', 'trim|required|numeric|callback_check_credit');
    	
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	$this->form_validation->set_rules('payment', 'lang:payment', 'required');
    	$this->form_validation->set_rules('voucher_id', 'lang:products');
    
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/consume_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer		= $this->Customer_model->get_customer_by_card($card);
    		$payment				= $this->input->post('payment');    		
    		$consume_amount			= $this->input->post('consume_amount');
    		$voucher_id				= $this->input->post('voucher_id');
    		$remark					= $this->input->post('remark');
    		$payment				= $this->input->post('payment');
    		$last_id = '';
    		
    		//get voucher details for retrieve branch from:
    		$voucher_row = $this->Voucher_model->get_voucher($voucher_id);    	
    		
    		if($payment == 'Credit')
    		{    			    			
    			$save['id']					= $id;
    			$save['customer_id']		= $customer['id'];
    			$save['out']				= $consume_amount;
    			$save['remark']				= $remark;
    			$save['created']			= format_ymd_malaysia($this->input->post('consume_date'));
    			$save['staff_id']			= $this->current_admin['id'];
    			$save['voucher_id']			= $voucher_id;
    			$save['branch_id']			= $voucher_row->branch_id;
    			//$save['branch'] = $staff_branch;    			
    			$last_id = $this->Credit_model->save_credit($save);
    			
    			//in same time, if credit consume can earn point:
    			$point_in['id'] = '';
    			$point_in['customer_id'] = $customer['id'];
    			$point_in['point'] 	= $consume_amount;
    			$point_in['created'] = format_ymd_malaysia($this->input->post('consume_date'));
    			$point_in['staff_id'] = $this->current_admin['id'];
    			$point_in['branch_id'] = $voucher_row->branch_id;
    			//$point_in['branch'] = $staff_branch;
    			$point_in['voucher_id'] = $voucher_id;
    			//$point_in['status'] = 1; //enable
    			$point_in['remark'] = 'Bonus Point from consumption';
    				
    			$this->Point_model->save_point($point_in);
    			
    		}
    		else{
    			$save['id'] = '';
    			$save['customer_id'] =  $customer['id'];
    			$save['depoint'] 	= $consume_amount;
    			$save['created'] = format_ymd_malaysia($this->input->post('consume_date'));
    			$save['staff_id'] = $this->current_admin['id'];
    			$save['branch_id'] = $voucher_row->branch_id;
    			//$save['branch'] = $staff_branch;
    			//$save['status'] = 1; //enable
    			$save['remark'] =  $remark;
    			$save['voucher_id']			= $voucher_id;
    		
    			$last_id = $this->Point_model->save_point($save);
    		}
    		
    		//check if voucher customer has this voucher then update
    		$save_voucher['voucher_id'] = $voucher_id;
    		$save_voucher['customer_id'] = $customer['id'];
    		$is_exist = $this->Voucher_model->check_voucher_customer($voucher_id, $customer['id']);
    		
    		if($is_exist){
    			$voucher_details = $this->Voucher_model->my_voucher_details($voucher_id, $customer['id']);
    			$save_voucher['qty'] = $voucher_details['qty'] + 1;
    			$this->Voucher_model->update_voucher_customer($save_voucher);
    		}else{
    			$this->Voucher_model->add_voucher_customer($save_voucher);
    		}
    		
    		//$save['status']				= 1;
    		//$save['active']				= $this->input->post('active');    		 
    		 
    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    		 
    		//go back to the credit
    		//redirect($this->config->item('admin_folder').'/credit');
    		redirect($this->config->item('admin_folder').'/credit/consume_info/'.$last_id.'/'.$payment);
    	}
    }
    
    function consume_info($id = false, $payment_type = false)
    {    	
    	$data['page_title']		= lang('consume_info');
    	
    	if($id && $payment_type){
    		if($payment_type == 'Credit'){
    			$data['credit'] = $this->Credit_model->get_credit($id);
    		}else{
    			$data['point'] = $this->Point_model->get_point($id);
    		}
    		
    		$this->view($this->config->item('admin_folder').'/consume_info', $data);
    	}else{
    		//go back to the credit
    		redirect($this->config->item('admin_folder').'/credit/');
    	}
    }
    
    function deduct_credit_form($id = false)
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');
    
    	$data['page_title']		= lang('deduct_credit_form');
    
    	//default values are empty if the customer is new
    	$data['id']					= '';
    	$data['trx_no']				= '';
    	$data['card']				= '';
    	$data['created']			= '';
    	$data['cost']				= '';
    	$data['in']					= '';
    	$data['out']				= '';
    	$data['remark']				= '';
    	$data['options']			= '';
    	$data['active']				= false;
    	$data['branch_id']			= false;
    	
    	$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
    	$branch_list = array();
    	foreach($branches as $branch)
    	{
    		$branch_list[$branch['id']] = $branch['name'];
    	}
    	$data['branches'] = $branch_list;
    	     	     	    
    	$customer = '';
    	if ($id)
    	{
    		//$this->customer_id	= $id;
    		$customer		= $this->Customer_model->get_customer_by_id($id);
    		//if the customer does not exist, redirect them to the customer list with an error
    		if (!$customer)
    		{
    			$this->session->set_flashdata('error', lang('error_not_found'));
    			redirect($this->config->item('admin_folder').'/credit');
    		}
    		 
    		//set values to db values
    		$data['id']					= $customer->id;
    		$data['trx_no']				= $customer->trx_no;
    		$data['name']				= $customer->name;
    		$data['firstname']			= $customer->firstname;
    		$data['lastname']			= $customer->lastname;
    		$data['email']				= $customer->email;
    		$data['phone']				= $customer->phone;
    		$data['company']			= $customer->company;
    		$data['active']				= $customer->active;
    		$data['options']			= '';
    		$data['email_subscribe']	= $customer->email_subscribe;
    		 
    	}
    
    	//Checking for super admin
    	if($this->current_admin['branch'] == 0):
    		$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
    	endif;
    	
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
    	//$this->form_validation->set_rules('consume_date', 'lang:consume_date', 'trim|required');
    	$this->form_validation->set_rules('credit_amount', 'lang:credit_amount', 'trim|required|numeric|callback_check_credit');    	 
    	$this->form_validation->set_rules('remark', 'lang:remark', 'trim|required');
    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->view($this->config->item('admin_folder').'/deduct_credit_form', $data);
    	}
    	else
    	{
    		$card = $this->input->post('card');
    		$customer				= $this->Customer_model->get_customer_by_card($card);
    		$trx_no					= $this->input->post('trx_no');
    		$credit_amount			= $this->input->post('credit_amount');
    		$remark					= $this->input->post('remark');
    		$last_id = '';
        		
    			$save['id']					= $id;
    			$save['customer_id']		= $customer['id'];
    			$save['trx_no']				= $trx_no;
    			$save['out']				= $credit_amount;
    			$save['remark']				= $remark;
    			$save['created']			= date('Y-m-d H:i:s');
    			$save['staff_id']			= $this->current_admin['id'];  		    			
    			//Checking for super admin
    			if($this->current_admin['branch'] == 0):
    				$save['branch_id']					= $this->input->post('branch_id');
    			else:
    				$save['branch_id']					= $this->current_admin['branch'];
    			endif;
    			    			
    			//$save['branch'] = $staff_branch;
    			$last_id = $this->Credit_model->save_credit($save);
    			 
    			//in same time, if credit consume can earn point:
    			$point_in['id'] = '';
    			$point_in['customer_id'] = $customer['id'];
    			$point_in['trx_no']		 = $trx_no;
    			$point_in['point'] 	= $credit_amount;
    			$point_in['created'] = date('Y-m-d H:i:s');
    			$point_in['staff_id'] = $this->current_admin['id'];
    			
    			//Checking for super admin
    			if($this->current_admin['branch'] == 0):
    				$point_in['branch_id']					= $this->input->post('branch_id');
    			else:
    				$point_in['branch_id']					= $this->current_admin['branch'];
    			endif;
    			
    			$point_in['remark'] = 'Bonus Point from consumption';    
    			$this->Point_model->save_point($point_in);

    		$this->session->set_flashdata('message', lang('message_saved_customer'));
    		 
    		//go back to the credit
    		//redirect($this->config->item('admin_folder').'/credit');
    		redirect($this->config->item('admin_folder').'/credit/consume_info/'.$last_id.'/Credit');
    	}
    }
    
    function check_balance()
    {
    	$data['activemenu'] 		= $this->activemenu;
    	//$this->load->helper('form');
    	$this->load->helper(array('form', 'date'));
    	$this->load->library('form_validation');    	
    	$data['page_title']		= lang('check_balance');
    	$data['credit_balance'] = '';
    	$data['point_balance'] = '';
    			
    	$card 					= $this->input->post('card');
    	    	        	 
    	$this->form_validation->set_rules('card', 'lang:card', 'trim|required|max_length[255]|callback_check_card');
    	    	 
    	if ($this->form_validation->run() == TRUE)
    	{
    		$card = $this->input->post('card');
    		$customer				= $this->Customer_model->get_customer_by_card($card);
    		$credit_balance = $this->Credit_model->get_credit_amt($customer['id']);
    		$point_balance = $this->Point_model->get_point_amt($customer['id']);
    		
    		$data['credit_balance'] = $credit_balance['credit_amt'];
    		$data['point_balance'] = $point_balance['point_amt'];
    	}
    	
    	$this->view($this->config->item('admin_folder').'/check_balance', $data);    	
    }
    
    
    
}
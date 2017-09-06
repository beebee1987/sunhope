<?php

class Clients extends Admin_Controller {	
	
	var $client_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Client_model');
		$this->lang->load('client');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['page_title']	= lang('clients');
		$data['clients']	= $this->Client_model->get_clients(NULL, $this->current_admin);
		
		$this->view($this->config->item('admin_folder').'/clients', $data);
	}
	
	function check_qty_used()
	{
		$client_id = $this->input->post('client_id');
		$customer_id = $this->input->post('customer_id');
		$used = $this->input->post('used');
	
		$details = $this->Client_model->my_client_details($client_id, $customer_id);
	
		if($details['used'] + $used > $details['qty'])
		{
			$this->form_validation->set_message('check_qty_used', lang('invalid_used_qty'));
			return FALSE;
		}else {
			return TRUE;
		}
	}
	
	
	function form($id = false)
	{
		
		//die(print_r($_POST));
		$today_date 	= date("Ymd");
				
		$this->load->helper(array('form', 'date', 'url'));
		$folderName = 'uploads/client/'.$today_date.'/';
		$config['upload_path']		= $folderName;
				
		if (!is_dir($folderName)) {
			mkdir($folderName, 0777, TRUE);
			//mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
		}
		
		
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);
		
		$this->load->library('form_validation');
		
		$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
		$branch_list = array();
		foreach($branches as $branch)
		{
			$branch_list[$branch['id']] = $branch['name'];
		}
		$data['branches'] = $branch_list;
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->client_id	= $id;
		
		$data['page_title']		= lang('client_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['code']					= '';
		$data['name']					= '';
		$data['start_date']				= '';
		$data['whole_order_client']		= 1;
		$data['max_product_instances'] 	= '';
		$data['end_date']				= '';
		$data['max_uses']				= '';
		$data['reduction_target'] 		= 'price';
		$data['reduction_type']			= '';
		$data['reduction_amount']		= '';
		$data['point_consume']			= '';
		$data['image']					= '';
		$data['desc']					= '';
		$data['branch_id']				= '';
		
		$added = array();
		
		if ($id)
		{	
			$client		= $this->Client_model->get_client($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$client)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/product');
			}
			
			//set values to db values
			$data['id']						= $client->id;
			$data['code']					= $client->code;
			$data['name']					= $client->name;
			$data['start_date']				= $client->start_date;
			$data['end_date']				= $client->end_date;
			//$data['whole_order_client']		= $client->whole_order_client;
			$data['whole_order_client']	= 1;
			$data['max_product_instances'] 	= $client->max_product_instances;
			$data['num_uses']     			= $client->num_uses;
			$data['max_uses']				= $client->max_uses;
			//$data['reduction_target']		= $client->reduction_target;
			$data['reduction_target']		= 'price';
			$data['reduction_type']			= $client->reduction_type;
			$data['reduction_amount']		= $client->reduction_amount;
			$data['point_consume']			= $client->point_consume;
			$data['image']					= $client->image;
			$data['desc']					= $client->desc;
			$data['branch_id']				= $client->branch_id;
			
			$added = $this->Client_model->get_product_ids($id);
		}
		
		//Checking for super admin
		if($this->current_admin['branch'] == 0):
			$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
		endif;
		
		$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_code');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
		$this->form_validation->set_rules('max_product_instances', 'lang:limit_per_order', 'trim|numeric');
		$this->form_validation->set_rules('whole_order_client', 'lang:whole_order_discount');
		//$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim|required');
		$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim');
		$this->form_validation->set_rules('reduction_type', 'lang:reduction_type', 'trim');
		$this->form_validation->set_rules('reduction_amount', 'lang:reduction_amount', 'trim|numeric');
		
		$this->form_validation->set_rules('point_consume', 'lang:point_consume', 'trim|numeric');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('desc', 'lang:desc', 'trim');
		
		$this->form_validation->set_rules('start_date', 'lang:start_date');
		$this->form_validation->set_rules('end_date', 'lang:end_date');
		
		// create product list
		$products = $this->Product_model->get_products();
		
		// set up a 2x2 row list for now
		$data['product_rows'] = "";
		$x=0;
		while(TRUE) { // Yes, forever, until we find the end of our list
			if ( !isset($products[$x] )) break; // stop if we get to the end of our list
			$checked = "";
			if(in_array($products[$x]->id, $added))
			{
				$checked = "checked='checked'";
			}
			$data['product_rows']  .=  "<tr><td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked></td><td> ". $products[$x]->name ."</td>";
			
			$x++;
			
			//reset the checked value to nothing
			$checked = "";
			if ( isset($products[$x] )) { // if we've gotten to the end on this row
				if(in_array($products[$x]->id, $added))
				{
					$checked = "checked='checked'";
				}
				$data['product_rows']  .= 	"<td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked><td><td> ". $products[$x]->name ."</td></tr>";
			} else {
				$data['product_rows']  .= 	"<td> </td></tr>";
			}
			
			$x++;
		} 
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/client_form', $data);
		}
		else
		{
			$this->load->helper('text');
			$uploaded	= $this->upload->do_upload('image');						
			
			$save['id']						= $id;
			$save['code']					= $this->input->post('code');
			$save['name']					= $this->input->post('name');
			$save['start_date']				= $this->input->post('start_date');
			//$save['end_date']				= $this->input->post('end_date');
			//$save['max_uses']				= $this->input->post('max_uses');
			$save['start_date']				= format_ymd_malaysia($this->input->post('start_date'));
			$save['end_date']				= format_ymd_malaysia($this->input->post('end_date'));
			//$save['whole_order_client'] 	= $this->input->post('whole_order_client');
			$save['whole_order_client'] 	= 1;
			$save['max_product_instances'] 	= $this->input->post('max_product_instances');
			//$save['reduction_target']		= $this->input->post('reduction_target');
			$save['reduction_target']		= 'price';
			$save['reduction_type']			= $this->input->post('reduction_type');
			$save['reduction_amount']		= $this->input->post('reduction_amount');
			$save['point_consume']			= $this->input->post('point_consume');
			$save['desc']					= $this->input->post('desc');
			$save['staff_id']				= $this->current_admin['id'];
			$save['created_date']			= date('Y-m-d H:i:s');
						
			//Checking for super admin
			if($this->current_admin['branch'] == 0):
				$save['branch_id']					= $this->input->post('branch_id');
			else:
				$save['branch_id']					= $this->current_admin['branch'];
			endif;

			if($save['start_date']=='')
			{
				$save['start_date'] = null;
			}
			if($save['end_date']=='')
			{
				$save['end_date'] = null;
			}
			
			$product = $this->input->post('product');
			
			if ($id)
			{
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						//$file = 'uploads/'.$data['image'];
						//$config['upload_path'] = FCPATH . 'uploads/';
			
						$file = $folderName.$data['image'];
							
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
					
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/client_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				if (!is_dir($folderName)) {
					mkdir($folderName, 0777, TRUE);
					//mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
				}
			
				$image			= $this->upload->data();
					
				$save['image']  = $folderName.$image['file_name'];
				//$save['image']	= $image['file_name'];
			}
			
			// save client
			$promo_id = $this->Client_model->save($save);
			
			// save products if not a whole order client
			//   clear products first, then save again (the lazy way, but sequence is not utilized at the moment)
			$this->Client_model->remove_product($id);
			
			if(!$save['whole_order_client'] && $product) 
			{
				while(list(, $product_id) = each($product))
				{
					$this->Client_model->add_product($promo_id, $product_id);
				}
			}
			
			// We're done
			$this->session->set_flashdata('message', lang('message_saved_client'));
			
			//go back to the product list
			redirect($this->config->item('admin_folder').'/clients');
		}
	}

	//this is a callback to make sure that 2 clients don't have the same code
	function check_code($str)
	{
		$code = $this->Client_model->check_code($str, $this->client_id);
        if ($code)
       	{
			$this->form_validation->set_message('check_code', lang('error_already_used'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//this is a callback to make sure that clients valid
	function check_client($str)
	{
		$client = $this->Voucher_model->get_client_by_code($str);
		if ($client)
		{
				
			$is_valid = $this->Voucher_model->is_valid($client);
				
			if($is_valid){
				return TRUE;
			}else{
				$this->form_validation->set_message('check_client', lang('error_client'));
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('check_client', lang('error_not_found'));
			return FALSE;
		}
	}
	
	function check_card($str)
	{
		$card = $this->Customer_model->check_card($str);
		if ($card)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_card', lang('error_card_not_found'));
			return FALSE;
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$client	= $this->Client_model->get_client($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$client)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/clients');
			}
			else
			{
				$this->Client_model->delete_client($id);
				
				$this->session->set_flashdata('message', lang('message_client_deleted'));
				redirect($this->config->item('admin_folder').'/clients');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/clients');
		}
	}
	
	function process_client()
	{
		$data['page_title']		= lang('process_client');
		$today_date 	= date("Ymd");
		//die(print_r($_POST));
	
		$this->load->helper(array('form', 'date'));
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
		//default values are empty if the product is new
		$data['id']						= '';
		//$data['code']					= '';
		$data['client_id']				= '';
		$data['card']					= '';
		
		$clients = $this->Client_model->get_clients(NULL, $this->current_admin, TRUE);
		$client_list = array();
		foreach($clients as $client)
		{
			$client_list[$client->id] = $client->name;
		}
		$data['clients'] = $client_list;
	
		$added = array();
	
		//$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_client');
		$this->form_validation->set_rules('client_id', 'lang:products');
		$this->form_validation->set_rules('card', 'lang:card', 'trim|required|callback_check_card');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/client_proceed', $data);
		}
		else
		{
			//$code					= $this->input->post('code');
			$client_id				= $this->input->post('client_id');
			$card					= $this->input->post('card');						
				
			// We're done
			//$this->session->set_flashdata('message', lang('message_customer_client'));
			//go back to the product list
			redirect($this->config->item('admin_folder').'/clients/process_client_details/'.$client_id.'/'.$card);
		}
	}
	
	function process_client_details($client_id = '', $member_card = '')
	{		
		$data['page_title']		= lang('process_client');
		$this->load->helper(array('form', 'date', 'url'));
		$this->load->library('form_validation');
			
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$this->form_validation->set_rules( 'used', lang('use_qty'), 'trim|required|numeric|callback_check_qty_used' );
			
			if ($this->form_validation->run() == FALSE)
			{
				$client_id = $this->input->post('client_id');
				$member_card = $this->input->post('customer_card');
			}
			else
			{
				$save['active']  = $this->input->post('active');
				$used  			= $this->input->post('used');
				$save['client_id'] = $this->input->post('client_id');
				$save['customer_id'] = $this->input->post('customer_id');
																
				$is_exist = $this->Client_model->check_client_customer($save['client_id'], $save['customer_id']);
				
				if($is_exist){
					$details = $this->Client_model->my_client_details($save['client_id'], $save['customer_id']);
					$save['used'] = $details['used'] + $used;
					$id = $this->Client_model->update_client_customer($save);
				}else{
					// impossible happen here
					$save['used'] = $used;
					$this->Client_model->add_client_customer($save);
				}
				
				//customer client log , can know all the using client log
				$log['client_id'] = $save['client_id'];
				$log['customer_id'] = $save['customer_id'];
				$log['used'] = $used;
				$log['trx_date'] = date('Y-m-d H:i:s');
				$log['staff_id'] = $this->current_admin['id'];
					
				$this->Client_model->add_customer_client_log($log);
					
				if($id > 0){
					// We're done
					$this->session->set_flashdata('message', lang('message_saved_client'));
					//go back to the process client form
					redirect($this->config->item('admin_folder').'/clients/process_client/');
				}else{
					$this->session->set_flashdata('error', lang('error_saved_client'));
					//go back to the process client form with error message
					redirect($this->config->item('admin_folder').'/clients/process_client/');
				}
			}
			
			
		}
	
		if($client_id == '' || $member_card == ''){
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/clients/process_client');
		}else{
				
			$client = $this->Client_model->get_client($client_id);
			$customer = $this->Customer_model->get_customer_by_card($member_card);
				
			$data['client_id'] = $client->id;
			$data['customer_id'] = $customer['id'];
			$data['customer'] = $customer;
	
			$data['details'] = $this->Client_model->my_client_details($client->id, $customer['id']);
	
			$this->view(config_item('admin_folder').'/client_proceed_details', $data);
		}
	}
}
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
		$today_date 	= date("Ymd");
				
		$this->load->helper(array('form', 'date', 'url'));
		$folderName = 'uploads/client/'.$today_date.'/';
		$config['upload_path']		= $folderName;
				
//		if (!is_dir($folderName)) {
//			mkdir($folderName, 0777, TRUE);
//			mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
//		}
		
		
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		
		$this->load->library('upload', $config);
		
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->client_id	= $id;
		
		$data['page_title']		= lang('client_form');
		
		//default values are empty if the product is new
		$data['id']					= '';
		$data['name']					= '';
                $data['email']					= '';
                $data['phone']					= '';
                $data['company']				= '';
                $data['default_billing_address']		= '';
                $data['image']					= '';
		
		$data['whole_order_client']		= 1;
		
		$data['branch_id']				= '';
		
		$added = array();
		
		if ($id)
		{	
			$client		= $this->Client_model->get_client($id);
                        

			//if the product does not exist, redirect them to the product list with an error
			if (!$client)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/clients');
			}
			
			//set values to db values
			$data['id']						= $client->id;
			$data['name']					= $client->name;
                        $data['email']					= $client->email;
                        $data['phone']					= $client->phone;
                        $data['company']					= $client->company;
                        $data['image']					= $client->logo;
                        $data['default_billing_address']		= $client->default_billing_address;
                        $data['active']		= $client->active;
                        
			$data['whole_order_client']	= 1;
			//$data['reduction_target']		= $client->reduction_target;
		}
		
		//Checking for super admin		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		
		$this->form_validation->set_rules('email', 'lang:email', 'trim');
		$this->form_validation->set_rules('phone', 'lang:phone', 'trim');
                $this->form_validation->set_rules('company', 'lang:company', 'trim');
                $this->form_validation->set_rules('image', 'lang:logo', 'trim');
                $this->form_validation->set_rules('default_billing_address', 'lang:default_billing_address', 'trim');
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/client_form', $data);
		}
		else
		{
			$this->load->helper('text');
			$uploaded	= $this->upload->do_upload('image');	
                        
                        //die();
                        //var_dump($uploaded);
                        
                        
			
			$save['id']						= $id;
			$save['name']					= $this->input->post('name');
			$save['email']				= $this->input->post('email');
                        $save['phone']				= $this->input->post('phone');
                        $save['company']				= $this->input->post('company');
                        $save['default_billing_address']				= $this->input->post('default_billing_address');
                        
                        if($id){
                            $save['active']				= $this->input->post('active');
                        }
                        
                        $save['logo']				= $data['image'];
			
			
                        
                        
                        
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
					mkdir('./uploads/client/' . $today_date.'/thumbs', 0777, TRUE);
				}
			
				$image			= $this->upload->data();
                                
                                //die();
                                //var_dump($image);
                                
                                
                                
                                $config = array();
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $image['full_path'];
                                $config['create_thumb'] = TRUE;
                                $config['new_image'] = $image['file_path'] . 'thumbs/';
                                $config['maintain_ratio'] = TRUE;
                                $config['thumb_marker'] = '';
                                $config['width'] = 222;
                                $config['height'] = 120;
                                $this->load->library('image_lib', $config);
                                $this->image_lib->resize();
                                
				$save['logo']  = $folderName. 'thumbs/' .$image['file_name'];                                
			}
                        
                        if($id){
                            $this->Client_model->update_client($id, $save);
                        }else{
                            $this->Client_model->add_client($save);
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
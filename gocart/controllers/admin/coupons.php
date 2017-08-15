<?php

class Coupons extends Admin_Controller {	
	
	var $coupon_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Coupon_model');
		$this->load->model('Product_model');
		$this->load->model('Customer_model');
		$this->load->model('Branch_model');
		$this->lang->load('coupon');
		
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['page_title']	= lang('coupons');
		$data['coupons']	= $this->Coupon_model->get_coupons(NULL, $this->current_admin);
		
		$this->view($this->config->item('admin_folder').'/coupons', $data);
	}
	
	function check_qty_used()
	{
		$coupon_id = $this->input->post('coupon_id');
		$customer_id = $this->input->post('customer_id');
		$used = $this->input->post('used');
	
		$details = $this->Coupon_model->my_coupon_details($coupon_id, $customer_id);
	
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
		$folderName = 'uploads/coupon/'.$today_date.'/';
		$config['upload_path']		= $folderName;
				
		if (!is_dir($folderName)) {
			mkdir($folderName, 0777, TRUE);
			//mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
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
		
		$this->coupon_id	= $id;
		
		$data['page_title']		= lang('coupon_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['code']					= '';
		$data['name']					= '';
		$data['start_date']				= '';
		$data['whole_order_coupon']		= 1;
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
			$coupon		= $this->Coupon_model->get_coupon($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$coupon)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/product');
			}
			
			//set values to db values
			$data['id']						= $coupon->id;
			$data['code']					= $coupon->code;
			$data['name']					= $coupon->name;
			$data['start_date']				= $coupon->start_date;
			$data['end_date']				= $coupon->end_date;
			//$data['whole_order_coupon']		= $coupon->whole_order_coupon;
			$data['whole_order_coupon']	= 1;
			$data['max_product_instances'] 	= $coupon->max_product_instances;
			$data['num_uses']     			= $coupon->num_uses;
			$data['max_uses']				= $coupon->max_uses;
			//$data['reduction_target']		= $coupon->reduction_target;
			$data['reduction_target']		= 'price';
			$data['reduction_type']			= $coupon->reduction_type;
			$data['reduction_amount']		= $coupon->reduction_amount;
			$data['point_consume']			= $coupon->point_consume;
			$data['image']					= $coupon->image;
			$data['desc']					= $coupon->desc;
			$data['branch_id']				= $coupon->branch_id;
			
			$added = $this->Coupon_model->get_product_ids($id);
		}
		
		//Checking for super admin
		if($this->current_admin['branch'] == 0):
			$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
		endif;
		
		$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_code');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
		$this->form_validation->set_rules('max_product_instances', 'lang:limit_per_order', 'trim|numeric');
		$this->form_validation->set_rules('whole_order_coupon', 'lang:whole_order_discount');
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
			$this->view($this->config->item('admin_folder').'/coupon_form', $data);
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
			//$save['whole_order_coupon'] 	= $this->input->post('whole_order_coupon');
			$save['whole_order_coupon'] 	= 1;
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
					$this->view(config_item('admin_folder').'/coupon_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				if (!is_dir($folderName)) {
					mkdir($folderName, 0777, TRUE);
					//mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
				}
			
				$image			= $this->upload->data();
					
				$save['image']  = $folderName.$image['file_name'];
				//$save['image']	= $image['file_name'];
			}
			
			// save coupon
			$promo_id = $this->Coupon_model->save($save);
			
			// save products if not a whole order coupon
			//   clear products first, then save again (the lazy way, but sequence is not utilized at the moment)
			$this->Coupon_model->remove_product($id);
			
			if(!$save['whole_order_coupon'] && $product) 
			{
				while(list(, $product_id) = each($product))
				{
					$this->Coupon_model->add_product($promo_id, $product_id);
				}
			}
			
			// We're done
			$this->session->set_flashdata('message', lang('message_saved_coupon'));
			
			//go back to the product list
			redirect($this->config->item('admin_folder').'/coupons');
		}
	}

	//this is a callback to make sure that 2 coupons don't have the same code
	function check_code($str)
	{
		$code = $this->Coupon_model->check_code($str, $this->coupon_id);
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
	
	//this is a callback to make sure that coupons valid
	function check_coupon($str)
	{
		$coupon = $this->Voucher_model->get_coupon_by_code($str);
		if ($coupon)
		{
				
			$is_valid = $this->Voucher_model->is_valid($coupon);
				
			if($is_valid){
				return TRUE;
			}else{
				$this->form_validation->set_message('check_coupon', lang('error_coupon'));
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('check_coupon', lang('error_not_found'));
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
			$coupon	= $this->Coupon_model->get_coupon($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$coupon)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/coupons');
			}
			else
			{
				$this->Coupon_model->delete_coupon($id);
				
				$this->session->set_flashdata('message', lang('message_coupon_deleted'));
				redirect($this->config->item('admin_folder').'/coupons');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/coupons');
		}
	}
	
	function process_coupon()
	{
		$data['page_title']		= lang('process_coupon');
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
		$data['coupon_id']				= '';
		$data['card']					= '';
		
		$coupons = $this->Coupon_model->get_coupons(NULL, $this->current_admin, TRUE);
		$coupon_list = array();
		foreach($coupons as $coupon)
		{
			$coupon_list[$coupon->id] = $coupon->name;
		}
		$data['coupons'] = $coupon_list;
	
		$added = array();
	
		//$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_coupon');
		$this->form_validation->set_rules('coupon_id', 'lang:products');
		$this->form_validation->set_rules('card', 'lang:card', 'trim|required|callback_check_card');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/coupon_proceed', $data);
		}
		else
		{
			//$code					= $this->input->post('code');
			$coupon_id				= $this->input->post('coupon_id');
			$card					= $this->input->post('card');						
				
			// We're done
			//$this->session->set_flashdata('message', lang('message_customer_coupon'));
			//go back to the product list
			redirect($this->config->item('admin_folder').'/coupons/process_coupon_details/'.$coupon_id.'/'.$card);
		}
	}
	
	function process_coupon_details($coupon_id = '', $member_card = '')
	{		
		$data['page_title']		= lang('process_coupon');
		$this->load->helper(array('form', 'date', 'url'));
		$this->load->library('form_validation');
			
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$this->form_validation->set_rules( 'used', lang('use_qty'), 'trim|required|numeric|callback_check_qty_used' );
			
			if ($this->form_validation->run() == FALSE)
			{
				$coupon_id = $this->input->post('coupon_id');
				$member_card = $this->input->post('customer_card');
			}
			else
			{
				$save['active']  = $this->input->post('active');
				$used  			= $this->input->post('used');
				$save['coupon_id'] = $this->input->post('coupon_id');
				$save['customer_id'] = $this->input->post('customer_id');
																
				$is_exist = $this->Coupon_model->check_coupon_customer($save['coupon_id'], $save['customer_id']);
				
				if($is_exist){
					$details = $this->Coupon_model->my_coupon_details($save['coupon_id'], $save['customer_id']);
					$save['used'] = $details['used'] + $used;
					$id = $this->Coupon_model->update_coupon_customer($save);
				}else{
					// impossible happen here
					$save['used'] = $used;
					$this->Coupon_model->add_coupon_customer($save);
				}
				
				//customer coupon log , can know all the using coupon log
				$log['coupon_id'] = $save['coupon_id'];
				$log['customer_id'] = $save['customer_id'];
				$log['used'] = $used;
				$log['trx_date'] = date('Y-m-d H:i:s');
				$log['staff_id'] = $this->current_admin['id'];
					
				$this->Coupon_model->add_customer_coupon_log($log);
					
				if($id > 0){
					// We're done
					$this->session->set_flashdata('message', lang('message_saved_coupon'));
					//go back to the process coupon form
					redirect($this->config->item('admin_folder').'/coupons/process_coupon/');
				}else{
					$this->session->set_flashdata('error', lang('error_saved_coupon'));
					//go back to the process coupon form with error message
					redirect($this->config->item('admin_folder').'/coupons/process_coupon/');
				}
			}
			
			
		}
	
		if($coupon_id == '' || $member_card == ''){
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/coupons/process_coupon');
		}else{
				
			$coupon = $this->Coupon_model->get_coupon($coupon_id);
			$customer = $this->Customer_model->get_customer_by_card($member_card);
				
			$data['coupon_id'] = $coupon->id;
			$data['customer_id'] = $customer['id'];
			$data['customer'] = $customer;
	
			$data['details'] = $this->Coupon_model->my_coupon_details($coupon->id, $customer['id']);
	
			$this->view(config_item('admin_folder').'/coupon_proceed_details', $data);
		}
	}
}
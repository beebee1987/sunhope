<?php

class Cart extends Front_Controller {

	var $customer;
	
	function __construct()
	{
		parent::__construct();
			
		$this->load->model(array('point_model','credit_model','admin_model','Slider_model','Company_model','latest_news_model','Settings_model','Voucher_model', 'Coupon_model'));	
			
		$this->customer = $this->go_cart->customer();
	}
	
	public function run_key() {
	
		$chars = array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
				'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
				'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '?', '!', '@', '#',
				'$', '%', '^', '&', '*', '(', ')', '[', ']', '{', '}', '|', ';', '/', '=', '+'
		);
	
		shuffle($chars);
	
		$num_chars = count($chars) - 1;
		$token = '';
	
		for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
			$token .= $chars[mt_rand(0, $num_chars)];
		}
	
		return $token;
	}
	
	public function staff_login($password, $username)
	{
		// Get the value in the field
		$username = $_POST[$username];
	
		$is_staff = $this->admin_model->login($username,$password);
		
		if (!$is_staff)
		{
			$this->form_validation->set_message('staff_login', lang('not_staff_error_message'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	public function check_branch_point($point)
	{
		// Get the value in the field
		$staff_username	  		= $this->input->post('staff_username');
		$staff_password	  		= $this->input->post('staff_password');
				
		$admin = $this->admin_model->get_admin($staff_username,$staff_password);
					
		if (!empty($admin) && isset($admin))
		{				
			$credit_balance = $this->point_model->get_branch_point_balance($admin['branch_id']);
						
			if($point > $credit_balance['point_amt']){
				$this->form_validation->set_message('check_branch_point', 'Insufficient of Branch Point');
				return FALSE;
			}else{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	
	public function check_credit($value)
	{		
		$customer_id			= $this->input->post('customer_id');
		$payment				= $this->input->post('payment');
				
		$balance = 0;
		if($payment == 'Credit'){
			$credit_balance = $this->credit_model->get_credit_amt($customer_id);
			$balance = $credit_balance['credit_amt'];
		}else{
			$point_balance = $this->point_model->get_point_amt($customer_id);
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
		
	}
	
	public function check_point($value)
	{
		$customer_id			= $this->input->post('customer_id');
		$balance = 0;
		
		$point_balance = $this->point_model->get_point_amt($customer_id);
		$balance = $point_balance['point_amt'];
		
		if($value > $balance)
		{
			$this->form_validation->set_message('check_credit', lang('invalid_point_balance'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	
	}
	
	function check_voucher_qty_used()
	{
		$voucher_id = $this->input->post('voucher_id');
		$customer_id = $this->input->post('customer_id');
		$used_qty = $this->input->post('used_qty');
	
		$details = $this->Voucher_model->my_voucher_details($voucher_id, $customer_id);
	
		if($details['used'] + $used_qty > $details['qty'])
		{
			$this->form_validation->set_message('check_voucher_qty_used', lang('invalid_used_qty'));
			return FALSE;
		}else {
			return TRUE;
		}
	}
	
	function check_coupon_qty_used()
	{
		$coupon_id = $this->input->post('coupon_id');
		$customer_id = $this->input->post('customer_id');
		$used_qty = $this->input->post('used_qty');
	
		$details = $this->Coupon_model->my_coupon_details($coupon_id, $customer_id);
	
		if($details['used'] + $used_qty > $details['qty'])
		{
			$this->form_validation->set_message('check_coupon_qty_used', lang('invalid_used_qty'));
			return FALSE;
		}else {
			return TRUE;
		}
	}
	
	function index()
	{		
		//make sure they're logged in
		//$this->Customer_model->is_logged_in('cart/index/');
						
		$data['page_title']	= 'Sun Hope Industry Sdn Bhd';
		$data['seo_title']	= 'Sun Hope Industry Sdn Bhd';
		$data['homepage']			= true;
		$data['sliders'] 			= $this->Slider_model->display_one_slider();
		//$data['companies'] 			= $this->Company_model->get_company_list();
		//$this->view('details', $data);		
		//$this->view('homepage', $data);
		$this->view('homepage', $data);
	}

	function page($id = false)
	{
		//if there is no page id provided redirect to the homepage.
		$data['page']	= $this->Page_model->get_page($id);
		if(!$data['page'])
		{
			show_404();
		}
		$this->load->model('Page_model');
		$data['base_url']			= $this->uri->segment_array();
		
		$data['fb_like']			= true;

		$data['page_title']			= $data['page']->title;
		
		$data['meta']				= $data['page']->meta;
		$data['seo_title']			= (!empty($data['page']->seo_title))?$data['page']->seo_title:$data['page']->title;
		
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$this->view('page', $data);
	}
	
	
	function search($code=false, $page = 0)
	{
		$this->load->model('Search_model');
		
		//check to see if we have a search term
		if(!$code)
		{
			//if the term is in post, save it to the db and give me a reference
			$term		= $this->input->post('term', true);
			$code		= $this->Search_model->record_term($term);
			
			// no code? redirect so we can have the code in place for the sorting.
			// I know this isn't the best way...
			redirect('cart/search/'.$code.'/'.$page);
		}
		else
		{
			//if we have the md5 string, get the term
			$term	= $this->Search_model->get_term($code);
		}
		
		if(empty($term))
		{
			//if there is still no search term throw an error
			$this->session->set_flashdata('error', lang('search_error'));
			redirect('cart');
		}

		$data['page_title']			= lang('search');
		$data['gift_cards_enabled']	= $this->gift_cards_enabled;
		
		//fix for the category view page.
		$data['base_url']			= array();
		
		$sort_array = array(
							'name/asc' => array('by' => 'name', 'sort'=>'ASC'),
							'name/desc' => array('by' => 'name', 'sort'=>'DESC'),
							'price/asc' => array('by' => 'sort_price', 'sort'=>'ASC'),
							'price/desc' => array('by' => 'sort_price', 'sort'=>'DESC'),
							);
		$sort_by	= array('by'=>false, 'sort'=>false);
	
		if(isset($_GET['by']))
		{
			if(isset($sort_array[$_GET['by']]))
			{
				$sort_by	= $sort_array[$_GET['by']];
			}
		}
		
			$data['page_title']	= lang('search');
			$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
			//set up pagination
			$this->load->library('pagination');
			$config['base_url']		= base_url().'cart/search/'.$code.'/';
			$config['uri_segment']	= 4;
			$config['per_page']		= 20;
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$result					= $this->Product_model->search_products($term, $config['per_page'], $page, $sort_by['by'], $sort_by['sort']);
			$config['total_rows']	= $result['count'];
			$this->pagination->initialize($config);
	
			$data['products']		= $result['products'];
			foreach ($data['products'] as &$p)
			{
				$p->images	= (array)json_decode($p->images);
				$p->options	= $this->Option_model->get_product_options($p->id);
			}
			$this->view('category', $data);
	}
	

	
	function category($id)
	{
		
		//get the category
		$data['category'] = $this->Category_model->get_category($id);
				
		if (!$data['category'] || $data['category']->enabled==0)
		{
			show_404();
		}
				
		$product_count = $this->Product_model->count_products($data['category']->id);
		
		//set up pagination
		$segments	= $this->uri->total_segments();
		$base_url	= $this->uri->segment_array();
		
		if($data['category']->slug == $base_url[count($base_url)])
		{
			$page	= 0;
			$segments++;
		}
		else
		{
			$page	= array_splice($base_url, -1, 1);
			$page	= $page[0];
		}
		
		$data['base_url']	= $base_url;
		$base_url			= implode('/', $base_url);
		
		$data['product_columns']	= $this->config->item('product_columns');
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$data['meta']		= $data['category']->meta;
		$data['seo_title']	= (!empty($data['category']->seo_title))?$data['category']->seo_title:$data['category']->name;
		$data['page_title']	= $data['category']->name;
		
		$sort_array = array(
							'name/asc' => array('by' => 'products.name', 'sort'=>'ASC'),
							'name/desc' => array('by' => 'products.name', 'sort'=>'DESC'),
							'price/asc' => array('by' => 'sort_price', 'sort'=>'ASC'),
							'price/desc' => array('by' => 'sort_price', 'sort'=>'DESC'),
							);
		$sort_by	= array('by'=>'sequence', 'sort'=>'ASC');
	
		if(isset($_GET['by']))
		{
			if(isset($sort_array[$_GET['by']]))
			{
				$sort_by	= $sort_array[$_GET['by']];
			}
		}
		
		//set up pagination
		$this->load->library('pagination');
		$config['base_url']		= site_url($base_url);
		
		$config['uri_segment']	= $segments;
		$config['per_page']		= 24;
		$config['total_rows']	= $product_count;
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
				
		$this->pagination->initialize($config);
		
		
		$data['products']	= $this->Product_model->get_products($data['category']->id, $config['per_page'], $page, $sort_by['by'], $sort_by['sort']);
		
		
		foreach ($data['products'] as &$p)
		{
			$p->images	= (array)json_decode($p->images);
			$p->options	= $this->Option_model->get_product_options($p->id);
		}
		
		$this->view('category', $data);
	}
	
	function product($id)
	{
		//get the product
		$data['product']	= $this->Product_model->get_product($id);
		
		
		if(!$data['product'] || $data['product']->enabled==0)
		{
			show_404();
		}
		
		$data['base_url']			= $this->uri->segment_array();
		
		// load the digital language stuff
		$this->lang->load('digital_product');
		
		$data['options']	= $this->Option_model->get_product_options($data['product']->id);
		
		$related			= $data['product']->related_products;
		$data['related']	= array();
		

				
		$data['posted_options']	= $this->session->flashdata('option_values');

		$data['page_title']			= $data['product']->name;
		$data['meta']				= $data['product']->meta;
		$data['seo_title']			= (!empty($data['product']->seo_title))?$data['product']->seo_title:$data['product']->name;
			
		if($data['product']->images == 'false')
		{
			$data['product']->images = array();
		}
		else
		{
			$data['product']->images	= array_values((array)json_decode($data['product']->images));
		}

		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
					
		$this->view('product', $data);
	}
	
	
	function add_to_cart()
	{
		// Get our inputs
		$product_id		= $this->input->post('id');
		$quantity 		= $this->input->post('quantity');
		$post_options 	= $this->input->post('option');
		
		// Get a cart-ready product array
		$product = $this->Product_model->get_cart_ready_product($product_id, $quantity);
		
		//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
		if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])
		{
			$stock	= $this->Product_model->get_product($product_id);
			
			//loop through the products in the cart and make sure we don't have this in there already. If we do get those quantities as well
			$items		= $this->go_cart->contents();
			$qty_count	= $quantity;
			foreach($items as $item)
			{
				if(intval($item['id']) == intval($product_id))
				{
					$qty_count = $qty_count + $item['quantity'];
				}
			}
			
			if($stock->quantity < $qty_count)
			{
				//we don't have this much in stock
				$this->session->set_flashdata('error', sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity));
				$this->session->set_flashdata('quantity', $quantity);
				$this->session->set_flashdata('option_values', $post_options);

				redirect($this->Product_model->get_slug($product_id));
			}
		}

		// Validate Options 
		// this returns a status array, with product item array automatically modified and options added
		//  Warning: this method receives the product by reference
		$status = $this->Option_model->validate_product_options($product, $post_options);
		
		// don't add the product if we are missing required option values
		if( ! $status['validated'])
		{
			$this->session->set_flashdata('quantity', $quantity);
			$this->session->set_flashdata('error', $status['message']);
			$this->session->set_flashdata('option_values', $post_options);
		
			redirect($this->Product_model->get_slug($product_id));
		
		} else {
		
			//Add the original option vars to the array so we can edit it later
			$product['post_options']	= $post_options;
			
			//is giftcard
			$product['is_gc']			= false;
			
			// Add the product item to the cart, also updates coupon discounts automatically
			$this->go_cart->insert($product);
		
			// go go gadget cart!
			redirect('cart/view_cart');
		}
	}
	
	function view_cart()
	{
		
		$data['page_title']	= 'View Cart';
		$data['gift_cards_enabled'] = $this->gift_cards_enabled;
		
		$this->view('view_cart', $data);
	}
	
	function remove_item($key)
	{
		//drop quantity to 0
		$this->go_cart->update_cart(array($key=>0));
		
		redirect('cart/view_cart');
	}
	
	function update_cart($redirect = false)
	{
		//if redirect isn't provided in the URL check for it in a form field
		if(!$redirect)
		{
			$redirect = $this->input->post('redirect');
		}
		
		// see if we have an update for the cart
		$item_keys		= $this->input->post('cartkey');
		$coupon_code	= $this->input->post('coupon_code');
		$gc_code		= $this->input->post('gc_code');
		
		if($coupon_code)
		{
			$coupon_code = strtolower($coupon_code);
		}
			
		//get the items in the cart and test their quantities
		$items			= $this->go_cart->contents();
		$new_key_list	= array();
		//first find out if we're deleting any products
		foreach($item_keys as $key=>$quantity)
		{
			if(intval($quantity) === 0)
			{
				//this item is being removed we can remove it before processing quantities.
				//this will ensure that any items out of order will not throw errors based on the incorrect values of another item in the cart
				$this->go_cart->update_cart(array($key=>$quantity));
			}
			else
			{
				//create a new list of relevant items
				$new_key_list[$key]	= $quantity;
			}
		}
		$response	= array();
		foreach($new_key_list as $key=>$quantity)
		{
			$product	= $this->go_cart->item($key);
			//if out of stock purchase is disabled, check to make sure there is inventory to support the cart.
			if(!$this->config->item('allow_os_purchase') && (bool)$product['track_stock'])
			{
				$stock	= $this->Product_model->get_product($product['id']);
			
				//loop through the new quantities and tabluate any products with the same product id
				$qty_count	= $quantity;
				foreach($new_key_list as $item_key=>$item_quantity)
				{
					if($key != $item_key)
					{
						$item	= $this->go_cart->item($item_key);
						//look for other instances of the same product (this can occur if they have different options) and tabulate the total quantity
						if($item['id'] == $stock->id)
						{
							$qty_count = $qty_count + $item_quantity;
						}
					}
				}
				if($stock->quantity < $qty_count)
				{
					if(isset($response['error']))
					{
						$response['error'] .= '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';
					}
					else
					{
						$response['error'] = '<p>'.sprintf(lang('not_enough_stock'), $stock->name, $stock->quantity).'</p>';
					}
				}
				else
				{
					//this one works, we can update it!
					//don't update the coupons yet
					$this->go_cart->update_cart(array($key=>$quantity));
				}
			}
			else
			{
				$this->go_cart->update_cart(array($key=>$quantity));
			}
		}
		
		//if we don't have a quantity error, run the update
		if(!isset($response['error']))
		{
			//update the coupons and gift card code
			$response = $this->go_cart->update_cart(false, $coupon_code, $gc_code);
			// set any messages that need to be displayed
		}
		else
		{
			$response['error'] = '<p>'.lang('error_updating_cart').'</p>'.$response['error'];
		}
		
		
		//check for errors again, there could have been a new error from the update cart function
		if(isset($response['error']))
		{
			$this->session->set_flashdata('error', $response['error']);
		}
		if(isset($response['message']))
		{
			$this->session->set_flashdata('message', $response['message']);
		}
		
		if($redirect)
		{
			redirect($redirect);
		}
		else
		{
			redirect('cart/view_cart');
		}
	}

	
	/***********************************************************
			Gift Cards
			 - this function handles adding gift cards to the cart
	***********************************************************/
	
	function giftcard()
	{
		if(!$this->gift_cards_enabled) redirect('/');
		
		// Load giftcard settings
		$gc_settings = $this->Settings_model->get_settings("gift_cards");
				
		$this->load->library('form_validation');
		
		$data['allow_custom_amount']	= (bool) $gc_settings['allow_custom_amount'];
		$data['preset_values']			= explode(",",$gc_settings['predefined_card_amounts']);
		
		if($data['allow_custom_amount'])
		{
			$this->form_validation->set_rules('custom_amount', 'lang:custom_amount', 'numeric');
		}
		
		$this->form_validation->set_rules('amount', 'lang:amount', 'required');
		$this->form_validation->set_rules('preset_amount', 'lang:preset_amount', 'numeric');
		$this->form_validation->set_rules('gc_to_name', 'lang:recipient_name', 'trim|required');
		$this->form_validation->set_rules('gc_to_email', 'lang:recipient_email', 'trim|required|valid_email');
		$this->form_validation->set_rules('gc_from', 'lang:sender_email', 'trim|required');
		$this->form_validation->set_rules('message', 'lang:custom_greeting', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['error']				= validation_errors();
			$data['page_title']			= lang('giftcard');
			$data['gift_cards_enabled']	= $this->gift_cards_enabled;
			$this->view('giftcards', $data);
		}
		else
		{
			
			// add to cart
			
			$card['price'] = set_value(set_value('amount'));
			
			$card['id']				= -1; // just a placeholder
			$card['sku']			= lang('giftcard');
			$card['base_price']		= $card['price']; // price gets modified by options, show the baseline still...
			$card['name']			= lang('giftcard');
			$card['code']			= generate_code(); // from the string helper
			$card['excerpt']		= sprintf(lang('giftcard_excerpt'), set_value('gc_to_name'));
			$card['weight']			= 0;
			$card['quantity']		= 1;
			$card['shippable']		= false;
			$card['taxable']		= 0;
			$card['fixed_quantity'] = true;
			$card['is_gc']			= true; // !Important
			$card['track_stock']	= false; // !Imporortant
			
			$card['gc_info'] = array("to_name"	=> set_value('gc_to_name'),
									 "to_email"	=> set_value('gc_to_email'),
									 "from"		=> set_value('gc_from'),
									 "personal_message"	=> set_value('message')
									 );
			
			// add the card data like a product
			$this->go_cart->insert($card);
			
			redirect('cart/view_cart');
		}
	}
	
	/***********************************************************
	 Special Coding for tesing
	- this function handles testing function to the cart
	***********************************************************/
	
	function newform()
	{							
		$data['page_title']	= 'View Form';
		
		$this->view('view_form', $data);
		
	}
	
	function typography()
	{
		$data['page_title']	= 'Typography';
		$this->view('typography', $data);
	}
	
	function tab_bar()
	{
		$data['page_title']	= 'Tab Bar';
		$this->view('tab-bar', $data);
	}
	
	function block_buttons()
	{
		$data['page_title']	= 'Block Button';
		$this->view('block-buttons', $data);
	}
	
	function form()
	{
		$data['page_title']	= 'Form';
		$this->view('form', $data);
	}
	
	function slider()
	{
		$data['page_title']	= 'Slider';
		$this->view('slider', $data);
	}
	
	function blog(){
		$data['page_title']	= 'BLOG';
		$this->view('blog', $data);
	}
	
	
	function gallery(){
		$data['page_title']	= 'GALLERY';
		$data['seo_title']	= 'Gallery';
		$this->load->model(array('Gallery_model'));
		$data['rs_gallery'] 		= $this->Gallery_model->display_one_gallery();
	
		$this->view('gallery', $data);
	}
	
	
	
	function twitter(){
		$data['page_title']	= 'TWITTER';
		$this->view('twitter', $data);
	}
	
	function videos(){
		$data['page_title']	= 'VIDEO';
		$this->view('videos', $data);
	}
	
	function contact_us(){
		$data['page_title']	= 'CONTACT_US';
		$data['seo_title']	= 'Contact Us';
		$this->load->model(array('Message_model', 'profile_model'));
		$data['countries']			= $this->Location_model->get_countries();
		$data['profile']			= $this->profile_model->get_profile($this->admin_id);
	
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
	
		if ($submitted){
	
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');
			//$this->form_validation->set_rules('company_name', 'Company Name', 'required|max_length[100]');
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|max_length[128]|callback_check_email');
			$this->form_validation->set_rules('telephone_number', 'Telephone Number', 'required');
			//$this->form_validation->set_rules('facsimile_number', 'Facsimile Number', 'required');
			//$this->form_validation->set_rules('address', 'Address', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			//$this->form_validation->set_rules('state', 'State', 'required');
			//$this->form_validation->set_rules('postcode', 'Postcode', 'required');
			//$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('comment', 'Message', 'required');
			//Captcha
			//$this->form_validation->set_rules('security_code', 'Security Code', 'required');
				
			//$userCaptcha  	= $this->input->post('security_code');
			/* Get the actual captcha value that we stored in the session (see below) */
			//$word = $this->session->userdata('captchaWord');
				
				
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$this->session->unset_userdata('captchaWord');
	
				$name	  			= $this->input->post('name');
				//$company_name	  	= $this->input->post('company_name');
				$email_address		= $this->input->post('email_address');
				$telephone_number	= $this->input->post('telephone_number');
				//$facsimile_number	= $this->input->post('facsimile_number');
				//$address			= $this->input->post('address');
				//$city				= $this->input->post('city');
				//$state				= $this->input->post('state');
				//$postcode			= $this->input->post('postcode');
				//$country			= $this->input->post('country');
				$comment  			= $this->input->post('comment');
				//$security_code  	= $this->input->post('security_code');
	
				$save['name'] = $name;
				$save['company_name'] = '';
				$save['email_address'] = $email_address;
				$save['telephone_number'] = $telephone_number;
				$save['facsimile_number'] = '';
				$save['address'] = '';
				$save['city'] = '';
				$save['state'] = '';
				$save['postcode'] = '';
				$save['country_id'] = '';
				$save['comment'] = $comment;
				$id = $this->Message_model->save_comment($save);
	
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from($email_address, $name);
				$this->email->to($this->config->item('email'));
				$this->email->bcc($this->config->item('email'));
				$this->email->subject('Contact Us');
				$this->email->message(html_entity_decode($comment));
				$this->email->send();
	
				$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect(current_url());
			}else{
	
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
	
				$data['error'] = validation_errors();
	
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
	
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
	
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
	
			}
				
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
				
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
				
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
	
		$this->view('contact_us', $data);
	}
	
	function awards(){
		$data['page_title']	= 'AWARDS AND RECOGNITIONS';
		$this->view('awards', $data);
	}
	
	function events(){
		$data['page_title']	= 'Events';
		//$this->load->model(array('Event_model'));
		//$data['events']			= $this->Event_model->get_events();
		$this->view('events', $data);
	}
	
	function about()
	{
		$data['page_title'] = lang('about_us');
		$data['base_url'] = 'about';
		$data['seo_title']	= 'About Us';
	
		$this->load->model('profile_model');
		$data['profile']			= $this->profile_model->get_profile($this->admin_id);
	
		$this->view('about', $data);
	}
	
	function services()
	{
		$data['base_url'] = 'services';
		$data['seo_title']	= 'Services';
		$this->load->model('profile_model');
		$data['profile'] = $this->profile_model->get_profile($this->admin_id);
		$this->view('services', $data);
	}
	
	function portfolio()
	{
		$data['base_url'] = 'portfolio';
		$data['seo_title']	= 'Portfolio';
		$this->load->model('profile_model');
		$data['profile'] = $this->profile_model->get_profile($this->admin_id);
	
	
		$this->view('portfolio', $data);
	}
	
	function clients()
	{
		$data['page_title']	= 'CLIENTS';
		$data['seo_title']	= 'Clients';
		$this->load->model('profile_model');
		$data['profile'] = $this->profile_model->get_profile($this->admin_id);
		$this->view('clients', $data);
	}
	
	function details()
	{
		$this->Customer_model->is_logged_in('cart/details/');
		$data['page_title']	= 'VIP Privileges';
		$data['seo_title']	= 'VIP Privileges';		
		$this->view('details', $data);
	}
	
	function homeslide()
	{
		$this->Customer_model->is_logged_in('cart/homeslide/');
		$data['page_title']	= 'VIP Privileges';
		$data['seo_title']	= 'VIP Privileges';
				
		$data['homepage']			= true;
		$data['sliders'] 			= $this->Slider_model->display_one_slider();
		$data['companies'] 			= $this->Company_model->get_company_list();
		$this->view('homeslide', $data);
	}
	
	function company_details()
	{
		$this->Customer_model->is_logged_in('cart/company_details/');
		$data['page_title']	= 'Company Details';
		$data['seo_title']	= 'Company Details';
		
		$data['companies'] = $this->Company_model->get_company_list();
		
		$this->view('company_details', $data);
	}
	
	function my_card()
	{
		$this->Customer_model->is_logged_in('cart/my_card/');
		$data['page_title']	= 'My Card';
		$data['seo_title']	= 'My Card';
		$setting = $this->Settings_model->get_settings('gocart');
		
		if($setting['image_card'] != ''){
			$data['image_card'] = $setting['image_card'];
		}else{
			$data['image_card'] = 'assets/img/no_image.png';
		}		
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
		$this->view('my_card', $data);
	}
	
	function member_center()
	{
		$this->Customer_model->is_logged_in('cart/member_center/');
		$data['page_title']	= 'Member Center';
		$data['seo_title']	= 'Member Center';
		$setting = $this->Settings_model->get_settings('gocart');
		
		
		if($setting['image_card'] != ''){
			$data['image_card'] = $setting['image_card'];
		}else{
			$data['image_card'] = 'assets/img/no_image.png';
		}		
		
		$data['customer_points'] = $this->point_model->get_point_amt($this->customer['id']);
		$data['customer_credits'] = $this->credit_model->get_total_credit_consume($this->customer['id']);
		$data['customer_credits_remain'] = $this->credit_model->get_credit_amt($this->customer['id']);
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
		
		$this->view('member_center', $data);
	}
	
	function top_up_credit_qrcode()
	{
		$data['page_title']	= 'Top Up Credit QR Code';
		$data['seo_title']	= 'Top Up Credit QR Code';
		$this->load->library('ciqrcode');
	
		$encrypt = random_string('alnum', 16);
		//echo $this->run_key();
		//echo random_string((string)$this->run_key(), 16);
		
		$link = site_url('cart/top_up_credit/'. $encrypt .'/'.$this->customer['id']);	
		$params['data'] = $link;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = FCPATH.'uploads/qrcode/top_up_credit_qrcode.png';
		$this->ciqrcode->generate($params);
		
		$data['link'] = $link;
		$data['encrypt'] = $encrypt;
		$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/top_up_credit_qrcode.png" />';
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
					
		$this->view('top_up_credit_qrcode', $data);
	}
	
	function top_up_credit($string_passing_value,$customer_id = NULL)
	{				
/* 		if(empty($customer_id))
		{
			redirect('cart');
		} */
		
		$data['page_title']	= 'Top Up Credit';
		$data['seo_title']	= 'Top Up Credit';
		$data['encrypt'] = $string_passing_value;
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
		
		//$data['customer_id'] = $this->customer['id'];
		$data['customer_id'] = $customer_id;
				
		//$data['customer'] = $this->customer;
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
		
		if ($submitted){		
			//$this->form_validation->set_rules('staff_branch', 'lang:staff_branch', 'required|max_length[100]');
			$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
			$this->form_validation->set_rules('customer_id', 'lang:customer_id');			
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');			
			$this->form_validation->set_rules('customer_cost', 'lang:customer_cost', 'required|numeric');
			$this->form_validation->set_rules('customer_topup_value', 'lang:customer_topup_value', 'required|numeric');
			$this->form_validation->set_rules('topup_remark', 'lang:remark', 'required');
			
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$staff_branch	  		= $this->input->post('staff_branch');
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
				
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);

				$customer_id			= $this->input->post('customer_id');
				$customer_cost			= $this->input->post('customer_cost');				
				$customer_topup_value	= $this->input->post('customer_topup_value');												
				$topup_remark			= $this->input->post('topup_remark');
				
				$save['id'] = '';
				$save['customer_id'] = $customer_id;
				$save['cost'] = $customer_cost;
				$save['in']   = $customer_topup_value;
				$save['created'] = date("Y-m-d H:i:s");
				$save['staff_id'] = $admin['id'];
				$save['branch_id'] = $admin['branch_id'];
				//$save['branch'] = $staff_branch;
				$save['status'] = 1; //enable
				$save['remark'] = $topup_remark;
																
				$id = $this->credit_model->save_credit($save);						
		
				//$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect('cart/top_up_credit_info/'.$id);
			}else{
		
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
		
				$data['error'] = validation_errors();
		
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
		
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
		
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		
			}
		
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
		
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
		
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
		
			
		$this->view('top_up_credit', $data);
	}
	
	function top_up_credit_info($credit_id = 0)
	{
		$data['page_title']	= 'Top Up Credit Info';
		$data['seo_title']	= 'Top Up Credit Info';
		$data['credit_info'] = $this->credit_model->get_credit($credit_id);		
		$data['admin'] = $this->admin_model->get_admin_by_id($data['credit_info']['staff_id']);
		$data['company'] = $this->Company_model->get_company_list();
		
		$this->view('top_up_credit_info', $data);
	}
	
	/*
	 * 
	 * TOP UP POINT and DEDUCT POINT
	 * 
	 * 
	 * */
	function top_up_point_qrcode()
	{
		$data['page_title']	= 'Top Up Point QR Code';
		$data['seo_title']	= 'Top Up Point QR Code';
		$this->load->library('ciqrcode');
	
		$encrypt = random_string('alnum', 16);
		//echo $this->run_key();
		//echo random_string((string)$this->run_key(), 16);
	
		$link = site_url('cart/top_up_point/'. $encrypt .'/'.$this->customer['id']);
		$params['data'] = $link;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = FCPATH.'uploads/qrcode/top_up_point_qrcode.png';
		$this->ciqrcode->generate($params);
	
		$data['link'] = $link;
		$data['encrypt'] = $encrypt;
		$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/top_up_point_qrcode.png" />';
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
			
		$this->view('top_up_point_qrcode', $data);
	}
	
	function top_up_point($string_passing_value,$customer_id = NULL)
	{
		/* 		if(empty($customer_id))
			{
		redirect('cart');
		} */
	
		$data['page_title']	= 'Top Up Point';
		$data['seo_title']	= 'Top Up Point';
		$data['encrypt'] = $string_passing_value;
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
	
		//$data['customer_id'] = $this->customer['id'];
		$data['customer_id'] = $customer_id;
	
		//$data['customer'] = $this->customer;
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
	
		if ($submitted){
			//$this->form_validation->set_rules('staff_branch', 'lang:staff_branch', 'required|max_length[100]');
			$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
			$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
			$this->form_validation->set_rules('customer_id', 'lang:customer_id');
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
			$this->form_validation->set_rules('customer_topup_point', 'lang:customer_topup_point', 'required|numeric|callback_check_branch_point');
			$this->form_validation->set_rules('topup_remark', 'lang:remark','required');
				
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$staff_branch	  		= $this->input->post('staff_branch');
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
	
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);
	
				$trx_no					= $this->input->post('trx_no');
				$customer_id			= $this->input->post('customer_id');				
				$customer_topup_point	= $this->input->post('customer_topup_point');
				$topup_remark			= $this->input->post('topup_remark');
	
				$save['id'] = '';
				$save['customer_id'] = $customer_id;
				$save['point']   = $customer_topup_point;
				$save['created'] = date("Y-m-d H:i:s");
				$save['staff_id'] = $admin['id'];
				$save['branch_id'] = $admin['branch_id'];
				//$save['branch'] = $staff_branch;				
				$save['remark'] = $topup_remark;
				$save['trx_no'] = $trx_no;
	
				$id = $this->point_model->save_point($save);
				
				//deduct branch point for particular branch point
				$branch_save['id'] = '';
				$branch_save['customer_id'] = $customer_id;
				$branch_save['depoint']   = $customer_topup_point;
				$branch_save['created'] = date("Y-m-d H:i:s");
				$branch_save['staff_id'] = $admin['id'];
				$branch_save['branch_id'] = $admin['branch_id'];				
				$branch_save['remark'] = $topup_remark;
				$branch_save['trx_no'] = $trx_no;
				
				$this->point_model->save_branch_point($branch_save);
	
				//$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect('cart/top_up_point_info/'.$id);
			}else{
	
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
	
				$data['error'] = validation_errors();
	
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
	
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
	
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
	
			}
	
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
	
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
	
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
	
			
		$this->view('top_up_point', $data);
	}
	
	function top_up_point_info($point_id = 0)
	{
		$data['page_title']	= 'Top Up Point Info';
		$data['seo_title']	= 'Top Up Point Info';
		$data['point_info'] = $this->point_model->get_point($point_id);
		$data['admin'] = $this->admin_model->get_admin_by_id($data['point_info']['staff_id']);
		$data['company'] = $this->Company_model->get_company_list();
	
		$this->view('top_up_point_info', $data);
	}
		
	/*
	 * 
	 * DEDUCT POINT
	 * 
	 * */
	function deduct_point_qrcode()
	{
		$data['page_title']	= 'Deduct Point QR Code';
		$data['seo_title']	= 'Deduct Point QR Code';
		$this->load->library('ciqrcode');
	
		$encrypt = random_string('alnum', 16);
	
		$link = site_url('cart/deduct_point/'.$encrypt.'/'.$this->customer['id']);
	
		$params['data'] = $link;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = FCPATH.'uploads/qrcode/deduct_point_qrcode.png';
		$this->ciqrcode->generate($params);
	
		$data['link'] = $link;
		$data['encrypt'] = $encrypt;
		$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/deduct_point_qrcode.png" />';
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
	
		$this->view('deduct_point_qrcode', $data);
	}
	
	function deduct_point($string_passing_value,$customer_id = NULL)
	{
		$data['page_title']	= 'Deduct Point';
		$data['seo_title']	= 'Deduct Point';
		$data['encrypt'] = $string_passing_value;
			
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
		//$data['customer_id'] = $this->customer['id'];
		$data['customer_id'] = $customer_id;
		//$data['customer'] = $this->customer;
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);

		if ($submitted){
			//$this->form_validation->set_rules('staff_branch', 'lang:staff_branch', 'required|max_length[100]');
			$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
				
			$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'required');
			$this->form_validation->set_rules('consume_amount', 'lang:consume_amount', 'required|numeric|callback_check_point');
			$this->form_validation->set_rules('remark', 'lang:remark', 'required');				
	
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
	
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);
				$staff_branch = $admin['branch_id'];
		
				$trx_no					= $this->input->post('trx_no');
				$customer_id			= $this->input->post('customer_id');
				$consume_amount			= $this->input->post('consume_amount');
				$remark					= $this->input->post('remark');
											
				$save['id'] = '';
				$save['customer_id'] = $customer_id;
				$save['depoint'] 	= $consume_amount;
				$save['created'] = date("Y-m-d H:i:s");
				$save['staff_id'] = $admin['id'];
				$save['branch_id'] = $admin['branch_id'];
				//$save['branch'] = $staff_branch;
				$save['remark'] = $remark;

				$id = $this->point_model->save_point($save);
					
				//$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect('cart/deduct_point_info/'.$id);
			}else{
	
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
	
				$data['error'] = validation_errors();
	
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
	
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
	
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
	
			}
	
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
	
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
	
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
	
			
		$this->view('deduct_point', $data);
	}
	
	function deduct_point_info($id = 0)
	{
		$data['page_title']	= 'Deduct Point Info';
		$data['seo_title']	= 'Deduct Point Info';
		
		$data['info'] = $this->point_model->get_point($id);
		$data['company'] = $this->Company_model->get_company_list();
		$data['admin'] = $this->admin_model->get_admin_by_id($data['info']['staff_id']);
	
		$this->view('deduct_point_info', $data);
	}
				
	
	function consumption_qrcode($encrypt = '', $customer_id = '', $voucher_id = '')
	{
		$data['page_title']	= 'Consumption QR Code';
		$data['seo_title']	= 'Consumption QR Code';
		$this->load->library('ciqrcode');
			
		if(empty($encrypt)):
			$encrypt = random_string('alnum', 16);
		endif;
						
		if(isset($voucher_id) && !empty($voucher_id)):
			$voucher_param = '/'.$voucher_id;
		else:
			$voucher_param = '';		
		endif;		
		
		$link = site_url('cart/consumption/'.$encrypt.'/'.$this->customer['id'].$voucher_param);			
		
		$params['data'] = $link;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = FCPATH.'uploads/qrcode/consumption_qrcode.png';
		$this->ciqrcode->generate($params);
	
		$data['link'] = $link;
		$data['encrypt'] = $encrypt;
		$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/consumption_qrcode.png" />';
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
				
		$this->view('consumption_qrcode', $data);
	}
	
	function consumption($string_passing_value = '',$customer_id = NULL, $voucher_id = '')
	{				
		$data['page_title']	= 'Consumption';
		$data['seo_title']	= 'Consumption';
		$data['encrypt'] 	= $string_passing_value;
			
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
		//$data['customer_id'] = $this->customer['id'];
		$data['customer_id'] = $customer_id;				
		//$data['customer'] = $this->customer;
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);

		if($voucher_id){
			$data['voucher_id'] = $voucher_id;
		}else{
			$data['voucher_id'] = '';
		}
		
		$vouchers = $this->Voucher_model->get_vouchers();
		$voucher_list = array();
		foreach($vouchers as $voucher)
		{			
			$voucher_list[$voucher->id] = $voucher->name;
		}
		$data['vouchers'] = $voucher_list;
		
		if ($submitted){
			//$this->form_validation->set_rules('staff_branch', 'lang:staff_branch', 'required|max_length[100]');
			$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
			
			$this->form_validation->set_rules('payment', 'lang:payment', 'required');
			$this->form_validation->set_rules('consume_amount', 'lang:consume_amount', 'required|numeric|callback_check_credit');
			$this->form_validation->set_rules('remark', 'lang:remark', 'required');
			$this->form_validation->set_rules('voucher_id', 'lang:products');
			
				
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$staff_branch	  		= $this->input->post('staff_branch');
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
	
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);
				$staff_branch = $admin['branch_id'];
				
				
				$customer_id			= $this->input->post('customer_id');
				$consume_amount			= $this->input->post('consume_amount');
				$voucher_id				= $this->input->post('voucher_id');
				$remark					= $this->input->post('remark');
				$payment				= $this->input->post('payment');
					
				
				if($payment == 'Credit')
				{
					$save['id'] = '';
					$save['customer_id'] = $customer_id;
					$save['out'] 		= $consume_amount;
					$save['created'] = date("Y-m-d H:i:s");
					$save['staff_id'] = $admin['id'];
					$save['branch_id'] = $admin['branch_id'];
					//$save['branch'] = $staff_branch;
					$save['voucher_id'] = $voucher_id;
					//$save['status'] = 1; //enable
					$save['remark'] = $remark;
					
					$id = $this->credit_model->save_credit($save);
					
					//in same time, if credit consume can earn point:					
					$point_in['id'] = '';
					$point_in['customer_id'] = $customer_id;
					$point_in['point'] 	= $consume_amount;
					$point_in['created'] = date("Y-m-d H:i:s");
					$point_in['staff_id'] = $admin['id'];
					$point_in['branch_id'] = $admin['branch_id'];
					//$point_in['branch'] = $staff_branch;
					$point_in['voucher_id'] = $voucher_id;
					//$point_in['status'] = 1; //enable
					$point_in['remark'] = 'Bonus Point from consumption';
					
					//
					$this->point_model->save_point($point_in);
					
				}
				else{
					$save['id'] = '';
					$save['customer_id'] = $customer_id;
					$save['depoint'] 	= $consume_amount;
					$save['created'] = date("Y-m-d H:i:s");
					$save['staff_id'] = $admin['id'];
					$save['branch_id'] = $admin['branch_id'];
					//$save['branch'] = $staff_branch;
					$save['voucher_id'] = $voucher_id;
					//$save['status'] = 1; //enable
					$save['remark'] = $remark;
						
					$id = $this->point_model->save_point($save);
				}
				
				//check if voucher customer has this voucher then update
				$save_voucher['voucher_id'] = $voucher_id;
				$save_voucher['customer_id'] = $customer_id;
				$is_exist = $this->Voucher_model->check_voucher_customer($voucher_id, $customer_id);
				
				if($is_exist){
					$voucher_details = $this->Voucher_model->my_voucher_details($voucher_id, $customer_id);
					$save_voucher['qty'] = $voucher_details['qty'] + 1;
					$this->Voucher_model->update_voucher_customer($save_voucher);
				}else{
					$this->Voucher_model->add_voucher_customer($save_voucher);
				}
	
				//$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect('cart/consumption_info/'.$id.'/'.$payment);
			}else{
	
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
	
				$data['error'] = validation_errors();
	
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
	
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
	
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
	
			}
	
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
	
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
	
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
	
			
		$this->view('consumption', $data);
	}
	
	function consumption_info($id = 0, $payment = '')
	{
		$data['page_title']	= 'Consumption Info';
		$data['seo_title']	= 'Consumption Info';
		$data['payment'] = $payment;
		
		
		if($payment == 'Credit')
		{
			$data['info'] = $this->credit_model->get_credit($id);				
		}
		else
		{
			$data['info'] = $this->point_model->get_point($id);
		}
		
		
		$data['company'] = $this->Company_model->get_company_list();
		$data['admin'] = $this->admin_model->get_admin_by_id($data['info']['staff_id']);
				
		$this->view('consumption_info', $data);
	}
	
	function membership_promotion()
	{
		$data['page_title']	= 'Membership Promotion';
		$data['seo_title']	= 'Membership Promotion';
		$data['customer_id'] = $this->customer['id'];
		$data['encrypt']  	= random_string('alnum', 16);
		$data['vouchers']	= $this->Voucher_model->get_vouchers();
		$data['coupons']	= $this->Coupon_model->get_coupons();
		
		
		$this->view('membership_promotion', $data);
	}
	
	function news()
	{
		$data['page_title']	= 'News';
		$data['seo_title']	= 'News';
	
		$data['latest_news'] = $this->latest_news_model->get_list();
		
		$this->view('news', $data);
	}
	
	function my_vouchers()
	{
		$data['page_title']	= 'My Vouchers';
		$data['seo_title']	= 'My Vouchers';
		
		$data['customer_id'] = $this->customer['id'];
		$data['vouchers'] = $this->Voucher_model->my_voucher($this->customer['id']);
		//$data['voucher_details'] = $this->Voucher_model->voucher_listing(NULL, $this->customer['id']);	
		//$data['vouchers'] = $this->Voucher_model->my_voucher(3);
		
		$this->view('my_vouchers', $data);
	}
	
	function my_coupons()
	{
		$data['page_title']	= 'My Coupons';
		$data['seo_title']	= 'My Coupons';
		
		$data['customer_id'] = $this->customer['id'];
		$data['coupons'] = $this->Coupon_model->my_coupon($this->customer['id']);
	
		$this->view('my_coupons', $data);
	}
	
	function process_voucher_qrcode($customer_id, $voucher_id)
	{
		$data['page_title']	= 'Process Voucer QR Code';
		$data['seo_title']	= 'Process Voucer QR Code';
		
		if($voucher_id == '' || $customer_id == ''){
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect('cart/my_vouchers/');
		}else{				
			$this->load->library('ciqrcode');
			
			$link = site_url('cart/process_voucher/'.$this->customer['id'].'/'.$voucher_id);
			
			$params['data'] = $link;
			$params['level'] = 'H';
			$params['size'] = 5;
			$params['savename'] = FCPATH.'uploads/qrcode/process_voucher_qrcode.png';
			$this->ciqrcode->generate($params);
			
			$data['link'] = $link;
			$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/process_voucher_qrcode.png" />';
			$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
			
			$this->view('process_voucher_qrcode', $data);			
		}				
	}
	
	function process_voucher($customer_id = NULL, $voucher_id = '')
	{
		$data['page_title']		= lang('process_voucher');
		$today_date 	= date("Ymd");
		//die(print_r($_POST));
	
		$this->load->helper(array('form', 'date'));
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');						

		//default values are empty if the product is new
		$data['id']						= '';
		$data['customer_id']			= $customer_id;		
		
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
		if($voucher_id){
			$data['voucher_id'] = $voucher_id;
		}else{
			$data['voucher_id'] = '';
		}
		
		$vouchers = $this->Voucher_model->get_vouchers();
		$voucher_list = array();
		foreach($vouchers as $voucher)
		{
			$voucher_list[$voucher->id] = $voucher->name;
		}
		$data['vouchers'] = $voucher_list;
		
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
				$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
				$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
					
				$this->form_validation->set_rules('voucher_id', 'lang:products');
				$this->form_validation->set_rules('used_qty', 'lang:used_qty', 'trim|required|numeric|callback_check_voucher_qty_used');
			
				//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
				//string compare
				if ($this->form_validation->run() == TRUE)
				{
					//$staff_branch	  		= $this->input->post('staff_branch');
					$staff_username	  		= $this->input->post('staff_username');
					$staff_password	  		= $this->input->post('staff_password');
				
					$admin = $this->admin_model->get_admin($staff_username,$staff_password);
					//$staff_branch = $admin['branch_id'];
				
					$customer_id			= $this->input->post('customer_id');
					$voucher_id				= $this->input->post('voucher_id');
					$used_qty				= $this->input->post('used_qty');
				
					//check if voucher customer has this voucher then update
					$save_voucher['voucher_id'] = $voucher_id;
					$save_voucher['customer_id'] = $customer_id;
					$is_exist = $this->Voucher_model->check_voucher_customer($voucher_id, $customer_id);
				
					if($is_exist){
						$voucher_details = $this->Voucher_model->my_voucher_details($voucher_id, $customer_id);
						$save_voucher['used'] = $voucher_details['used'] + $used_qty;
						$this->Voucher_model->update_voucher_customer($save_voucher);
					}else{
						$save_voucher['used'] = $used_qty;
						$this->Voucher_model->add_voucher_customer($save_voucher);
					}
					
					//customer voucher log , can know all the using voucher log
					$log['voucher_id'] = $voucher_id;
					$log['customer_id'] = $customer_id;
					$log['used'] = $used_qty;
					$log['trx_date'] = date('Y-m-d H:i:s');
					$log['staff_id'] = $admin['id'];
					
					$this->Voucher_model->add_customer_voucher_log($log);
						
					// We're done
					$this->session->set_flashdata('message', lang('message_customer_voucher'));
					//go back to the product list
					redirect('cart/process_voucher_details/'.$customer_id.'/'.$voucher_id);									
				}
				else{
					$data['error'] = validation_errors();				
				}
		}
		
		$this->view('voucher_proceed', $data);
		
	}
	
	function process_voucher_details($customer_id, $voucher_id)
	{
		$data['page_title']		= lang('process_voucher_info');				
		$data['seo_title']		= lang('process_voucher_info');						
		$data['voucher'] 		= $this->Voucher_model->my_voucher_details($voucher_id, $customer_id);
		$data['customer'] 		= $this->Customer_model->get_customer_by_id($customer_id);
		
		$this->view('voucher_proceed_info', $data);
	}
	
	function process_coupon_qrcode($customer_id, $coupon_id)
	{		
		$data['page_title']	= 'Process Coupon QR Code';
		$data['seo_title']	= 'Process Coupon QR Code';
					
		if($coupon_id == '' || $customer_id == ''){		
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect('cart/my_coupons/');
		}else{
			$this->load->library('ciqrcode');
				
			$link = site_url('cart/process_coupon/'.$this->customer['id'].'/'.$coupon_id);
				
			$params['data'] = $link;
			$params['level'] = 'H';
			$params['size'] = 5;
			$params['savename'] = FCPATH.'uploads/qrcode/process_coupon_qrcode.png';
			$this->ciqrcode->generate($params);
				
			$data['link'] = $link;
			$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/process_coupon_qrcode.png" />';
			$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
				
			$this->view('process_coupon_qrcode', $data);
		}
	}
	
	function process_coupon($customer_id = NULL, $coupon_id = '')
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
		$data['customer_id']			= $customer_id;
	
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
		if($coupon_id){
			$data['coupon_id'] = $coupon_id;
		}else{
			$data['coupon_id'] = '';
		}
	
		$coupons = $this->Coupon_model->get_coupons();
		$coupon_list = array();
		foreach($coupons as $coupon)
		{
			$coupon_list[$coupon->id] = $coupon->name;
		}
		$data['coupons'] = $coupon_list;
	
	
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('staff_branch', 'lang:staff_branch');
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
				
			$this->form_validation->set_rules('coupon_id', 'lang:products');
			$this->form_validation->set_rules('used_qty', 'lang:used_qty', 'trim|required|numeric|callback_check_coupon_qty_used');
				
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$staff_branch	  		= $this->input->post('staff_branch');
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
	
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);
				//$staff_branch = $admin['branch_id'];
	
				$customer_id			= $this->input->post('customer_id');
				$coupon_id				= $this->input->post('coupon_id');
				$used_qty				= $this->input->post('used_qty');
	
				//check if coupon customer has this coupon then update
				$save_coupon['coupon_id'] = $coupon_id;
				$save_coupon['customer_id'] = $customer_id;
				$is_exist = $this->Coupon_model->check_coupon_customer($coupon_id, $customer_id);
	
				if($is_exist){
					$coupon_details = $this->Coupon_model->my_coupon_details($coupon_id, $customer_id);
					$save_coupon['used'] = $coupon_details['used'] + $used_qty;
					$this->Coupon_model->update_coupon_customer($save_coupon);
				}else{
					$save_coupon['used'] = $used_qty;
					$this->Coupon_model->add_coupon_customer($save_coupon);
				}
				
				//customer coupon log , can know all the using coupon log
				$log['coupon_id'] = $coupon_id;
				$log['customer_id'] = $customer_id;
				$log['used'] = $used_qty;
				$log['trx_date'] = date('Y-m-d H:i:s');
				$log['staff_id'] = $admin['id'];
					
				$this->Coupon_model->add_customer_coupon_log($log);
	
				// We're done
				$this->session->set_flashdata('message', lang('message_customer_coupon'));
				//go back to the product list
				redirect('cart/process_coupon_details/'.$customer_id.'/'.$coupon_id);
			}
			else{
				$data['error'] = validation_errors();
			}
		}
	
		$this->view('coupon_proceed', $data);
	
	}
	
	function process_coupon_details($customer_id, $coupon_id)
	{
		$data['page_title']		= lang('process_coupon_info');
		$data['seo_title']		= lang('process_coupon_info');
		$data['coupon'] 		= $this->Coupon_model->my_coupon_details($coupon_id, $customer_id);
		$data['customer'] 		= $this->Customer_model->get_customer_by_id($customer_id);
	
		$this->view('coupon_proceed_info', $data);
	}
	
	function transaction_record()
	{
		$data['page_title']	= 'Transaction Record';
		$data['seo_title']	= 'Transaction Record';	
		$data['credit_record'] = $this->credit_model->get_list($this->customer['id']);
		
		$this->view('transaction_record', $data);
	}
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to add voucher into customers
	|----------------------------------------------------------------------------------------------------------*/
	function add_voucher()
	{
		$data = array();
		$voucher_id = ($this->input->post('voucher_id')) ? $this->input->post('voucher_id') : 0;
		$customer_id = ($this->input->post('customer_id')) ? $this->input->post('customer_id') : 0;		
		//$voucher_id = 2;
		//$customer_id = 3;
		
		//check table first
		$exist = $this->Voucher_model->check_voucher_customer($voucher_id, $customer_id);

		 if(!$exist){
			$save['voucher_id'] = $voucher_id;
			$save['customer_id'] = $customer_id;
			$save['active'] = 0; //enable
			
			$result 	= $this->Voucher_model->add_voucher_customer($save);
		}else{
			$result		= 'GOT';
		}				
		
		echo $result;
		//echo $result; 
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
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to add coupon into customers
	|----------------------------------------------------------------------------------------------------------*/
	function add_coupon()
	{
		$data = array();
		$coupon_id = ($this->input->post('coupon_id')) ? $this->input->post('coupon_id') : 0;
		$customer_id = ($this->input->post('customer_id')) ? $this->input->post('customer_id') : 0;
		//$coupon_id = 2;
		//$customer_id = 3;
	
		//check table first
		$exist = $this->Coupon_model->check_coupon_customer($coupon_id, $customer_id);
	
		if(!$exist){
			$save['coupon_id'] = $coupon_id;
			$save['customer_id'] = $customer_id;
			$save['active'] = 0; //enable
				
			$result 	= $this->Coupon_model->add_coupon_customer($save);
		}else{
			$result		= 'GOT';
		}
	
		echo $result;
		//echo $result;
	}
	
	function deduct_credit_qrcode()
	{
		$data['page_title']	= 'Deduct Credit QR Code';
		$data['seo_title']	= 'Deduct Credit QR Code';
		$this->load->library('ciqrcode');
	
		$encrypt = random_string('alnum', 16);
		//echo $this->run_key();
		//echo random_string((string)$this->run_key(), 16);
	
		$link = site_url('cart/deduct_credit/'. $encrypt .'/'.$this->customer['id']);
		$params['data'] = $link;
		$params['level'] = 'H';
		$params['size'] = 5;
		$params['savename'] = FCPATH.'uploads/qrcode/deduct_credit_qrcode.png';
		$this->ciqrcode->generate($params);
	
		$data['link'] = $link;
		$data['encrypt'] = $encrypt;
		$data['qr_code'] = '<img src="'.base_url().'uploads/qrcode/deduct_credit_qrcode.png" />';
		$data['customer'] = (array)$this->Customer_model->get_customer($this->customer['id']);
			
		$this->view('deduct_credit_qrcode', $data);
	}
		
	function deduct_credit($string_passing_value,$customer_id = NULL)
	{
		$data['page_title']	= 'Deduct Credit';
		$data['seo_title']	= 'Deduct Credit';
		$data['encrypt'] = $string_passing_value;
			
		// 		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$submitted 	= $this->input->post('submitted');
		$data['error'] = '';
		//$data['customer_id'] = $this->customer['id'];
		$data['customer_id'] = $customer_id;
		//$data['customer'] = $this->customer;
		$data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
				
		if ($submitted){
			$this->form_validation->set_rules('staff_username', 'lang:staff_username', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('staff_password', 'lang:staff_password', 'trim|required|min_length[6]|callback_staff_login[staff_username]');
				
			$this->form_validation->set_rules('trx_no', 'lang:trx_no', 'trim|required');
			$this->form_validation->set_rules('credit_amount', 'lang:credit_amount', 'required|numeric|callback_check_credit');
			$this->form_validation->set_rules('remark', 'lang:remark', 'required');				
	
			//original is: if ($this->form_validation->run() == TRUE && strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
			//string compare
			if ($this->form_validation->run() == TRUE)
			{
				//$staff_branch	  		= $this->input->post('staff_branch');
				$staff_username	  		= $this->input->post('staff_username');
				$staff_password	  		= $this->input->post('staff_password');
	
				$admin = $this->admin_model->get_admin($staff_username,$staff_password);
				$staff_branch = $admin['branch_id'];
	
	
				$customer_id			= $this->input->post('customer_id');
				$trx_no					= $this->input->post('trx_no');
				$credit_amount			= $this->input->post('credit_amount');
				$remark					= $this->input->post('remark');
					
				$save['id'] = '';
				$save['customer_id'] = $customer_id;
				$save['out'] 		 = $credit_amount;
				$save['trx_no']		 = $trx_no;
				$save['created'] = date("Y-m-d H:i:s");
				$save['staff_id'] = $admin['id'];
				$save['branch_id'] = $admin['branch_id'];
				$save['remark'] = $remark;
					
				$id = $this->credit_model->save_credit($save);
					
				//in same time, if credit consume can earn point:
				$point_in['id'] = '';
				$point_in['customer_id'] = $customer_id;
				$point_in['point'] 	= $credit_amount;
				$point_in['trx_no']		 = $trx_no;
				$point_in['created'] = date("Y-m-d H:i:s");
				$point_in['staff_id'] = $admin['id'];
				$point_in['branch_id'] = $admin['branch_id'];
				$point_in['remark'] = 'Bonus Point from consumption';
					
				//
				$this->point_model->save_point($point_in);
															
				//$this->session->set_flashdata('message', 'Hi '. $name. '. Thank you! We will response you as soon as possible.');
				redirect('cart/consumption_info/'.$id.'/Credit');
			}else{
	
				/* if(strcmp(strtoupper($userCaptcha),strtoupper($word)) != 0){
				 //if there is still no search term throw an error
				$this->session->set_flashdata('error', 'Security code not match. Please try again');
				} */
	
				$data['error'] = validation_errors();
	
				/* Setup vals to pass into the create_captcha function */
				// 				$vals = array(
				// 						'img_path' => 'uploads/static/',
				// 						'img_url' => base_url().'uploads/static/',
				// 				);
	
				/* Generate the captcha */
				// 				$data['captcha'] = create_captcha($vals);
	
				// 				/* Store the captcha value (or 'word') in a session to retrieve later */
				// 				$this->session->set_userdata('captchaWord', $data['captcha']['word']);
	
			}
	
		}else{
			// 			$vals = array(
			// 					'img_path' => 'uploads/static/',
			// 					'img_url' => base_url().'uploads/static/',
			// 			);
	
			// 			/* Generate the captcha */
			// 			$data['captcha'] = create_captcha($vals);
	
			// 			/* Store the captcha value (or 'word') in a session to retrieve later */
			// 			$this->session->set_userdata('captchaWord', $data['captcha']['word']);
		}
	
			
		$this->view('deduct_credit', $data);
	}
	
	
}
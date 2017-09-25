<?php

class ProjectCategorys extends Admin_Controller {	
	
	var $projectcategory_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
		$this->load->model('Project_model');		
		
		$this->lang->load('project');
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['page_title']	= lang('project_category');
		//filter access and branch out automatically
		$data['projectscategorys']	= $this->Project_model->get_projectcategorys(NULL, $this->current_admin);		
		//$data['vouchers']	= $this->Voucher_model->get_vouchers();
		
		$this->view($this->config->item('admin_folder').'/projectcategorys', $data);
	}
	
	function form($id = false)
	{
		$today_date 	= date("Ymd");
		//die(print_r($_POST));

		$this->load->helper(array('form', 'date', 'url'));
		
		$this->load->library('form_validation');
		
//		$branches = $this->Branch_model->get_branch_list($this->current_admin, TRUE);
//		$branch_list = array();		
//		foreach($branches as $branch)
//		{
//			$branch_list[$branch['id']] = $branch['name'];
//		}
//		$data['branches'] = $branch_list;		
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->voucher_id	= $id;
		
		$data['page_title']		= lang('project_category_form');
		
		//default values are empty if the product is new
		$data['id']						= '';
		$data['name']					= '';
		$data['desc']					= '';
		
		$added = array();
		
		if ($id)
                {
		
			$category		= $this->Project_model->get_projectcategory($id);

			//if the product does not exist, redirect them to the product list with an error
			if (!$category)
			{
				$this->session->set_flashdata('message', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/product');
			}
			
			//set values to db values
			$data['id']					= $category->id;
			$data['name']					= $category->name;
			$data['desc']					= $category->desc;
			$data['create_date']				= $category->create_date;
			
//			$added = $this->Voucher_model->get_product_ids($id);
		}
		
		//Checking for super admin
//		if($this->current_admin['branch'] == 0):
//			$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
//		endif;		
			
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
//		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
		$this->form_validation->set_rules('desc', 'lang:desc', 'trim');
		
		// create product list
//		$products = $this->Product_model->get_products();
//		
//		// set up a 2x2 row list for now
//		$data['product_rows'] = "";
//		$x=0;
//		while(TRUE) { // Yes, forever, until we find the end of our list
//			if ( !isset($products[$x] )) break; // stop if we get to the end of our list
//			$checked = "";
//			if(in_array($products[$x]->id, $added))
//			{
//				$checked = "checked='checked'";
//			}
//			$data['product_rows']  .=  "<tr><td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked></td><td> ". $products[$x]->name ."</td>";
//			
//			$x++;
//			
//			//reset the checked value to nothing
//			$checked = "";
//			if ( isset($products[$x] )) { // if we've gotten to the end on this row
//				if(in_array($products[$x]->id, $added))
//				{
//					$checked = "checked='checked'";
//				}
//				$data['product_rows']  .= 	"<td><input type='checkbox' name='product[]' value='". $products[$x]->id ."' $checked><td><td> ". $products[$x]->name ."</td></tr>";
//			} else {
//				$data['product_rows']  .= 	"<td> </td></tr>";
//			}
//			
//			$x++;
//		} 
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/projectcategory_form', $data);
		}
		else
		{
                    $this->load->helper('text');

                    $save['id']					= $id;
                    $save['name']					= $this->input->post('name');
                    $save['desc']					= $this->input->post('desc');
                    $save['create_date']                           = date('Y-m-d H:i:s');
                    $this->Project_model->savecategory($save);

                    // We're done
                    $this->session->set_flashdata('message', lang('message_saved_voucher'));

                    //go back to the product list
                    redirect($this->config->item('admin_folder').'/projectcategorys');
		}
	}
        
        function delete($id = false)
	{
		if ($id)
		{	
			$category	= $this->Project_model->get_projectcategory($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$category)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/projectcategorys');
			}
			else
			{
				$this->Project_model->delete_category($id);
				$this->session->set_flashdata('message', lang('message_category_deleted'));
				redirect($this->config->item('admin_folder').'/projectcategorys');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/projectcategorys');
		}
	}

	
	
}
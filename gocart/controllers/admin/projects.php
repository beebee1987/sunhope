<?php

class Projects extends Admin_Controller {	
	
	var $project_id;
	var $current_admin	= false;
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		$this->load->model('Project_model');		
		$this->load->model('Voucher_model');
		$this->lang->load('project');
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
            $count  = 0 ; 
		$data['page_title']	= lang('projects');
		//filter access and branch out automatically
//		$data['projects']	= $this->Project_model->get_projects(NULL, $this->current_admin);		
		//$data['projects']	= $this->Project_model->get_projects();	
		$this->view($this->config->item('admin_folder').'/projects', $data);
	}
	
	
	function form($upload_true = true)
	{
            $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
            if($upload_true){
                $this->session->set_flashdata('message', lang('message_project_deleted'));
            }
//		$today_date 	= date("Ymd");
//		//die(print_r($_POST));
//
//		$this->load->helper(array('form', 'date', 'url'));
//		
//		$folderName = 'uploads/project/';
//		$config['upload_path']		= $folderName;		
//		if (!is_dir($folderName)) {
//			mkdir($folderName, 0777, TRUE);
//			//mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
//		}				
//		
//		$config['allowed_types']	= 'gif|jpg|png';
//		$config['max_size']			= $this->config->item('size_limit');
//		$config['encrypt_name']		= true;
//		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		
				
//		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
//		
//		$this->project_id	= $id;
		
		$data['page_title']		= lang('project_form');
		
		//default values are empty if the product is new
//		$data['id']						= '';
//		$data['code']					= '';
//		$data['name']					= '';
//		$data['start_date']				= '';
//		$data['whole_order_project']	= 1;
//		$data['max_product_instances'] 	= '';
//		$data['end_date']				= '';
//		$data['max_uses']				= '';
//		$data['reduction_target'] 		= 'price';
//		$data['reduction_type']			= '';
//		$data['reduction_amount']		= '';
//		$data['point_consume']			= '';	
//		$data['credit_consume']			= '';
//		$data['image']					= '';
//		$data['desc']					= '';
//		$data['branch_id']  			= '';
//		
//		$added = array();
		
//		if ($id)
//		{	
//			$project		= $this->Project_model->get_project($id);
//
//			//if the product does not exist, redirect them to the product list with an error
//			if (!$project)
//			{
//				$this->session->set_flashdata('message', lang('error_not_found'));
//				redirect($this->config->item('admin_folder').'/product');
//			}
//			
//			//set values to db values
//			$data['id']						= $project->id;
//			$data['code']					= $project->code;
//			$data['name']					= $project->name;
//			$data['start_date']				= $project->start_date;
//			$data['end_date']				= $project->end_date;
//			//$data['whole_order_project']	= $project->whole_order_project;
//			$data['whole_order_project']	= 1;
//			$data['whole_order_project']	= $project->whole_order_project;
//			$data['max_product_instances'] 	= $project->max_product_instances;
//			$data['num_uses']     			= $project->num_uses;
//			$data['max_uses']				= $project->max_uses;
//			//$data['reduction_target']		= $project->reduction_target;
//			$data['reduction_target']		= 'price';
//			$data['reduction_type']			= $project->reduction_type;
//			$data['reduction_amount']		= $project->reduction_amount;
//			$data['point_consume']			= $project->point_consume;
//			$data['credit_consume']			= $project->credit_consume;			
//			$data['image']					= $project->image;
//			$data['desc']					= $project->desc;
//			$data['branch_id']				= $project->branch_id;
//			
//			$added = $this->Project_model->get_product_ids($id);
//		}
		
		//Checking for super admin
		if($this->current_admin['branch'] == 0):
			$this->form_validation->set_rules('branch_id', 'lang:branch', 'trim|required');
		endif;		
		
//		$this->form_validation->set_rules('code', 'lang:code', 'trim|required|callback_check_code');	
//		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
//		$this->form_validation->set_rules('max_uses', 'lang:max_uses', 'trim|numeric');
//		$this->form_validation->set_rules('max_product_instances', 'lang:limit_per_order', 'trim|numeric');
//		$this->form_validation->set_rules('whole_order_project', 'lang:whole_order_discount');
//		//$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim|required');
//		$this->form_validation->set_rules('reduction_target', 'lang:reduction_target', 'trim');
//		$this->form_validation->set_rules('reduction_type', 'lang:reduction_type', 'trim');
//		$this->form_validation->set_rules('reduction_amount', 'lang:reduction_amount', 'trim|numeric');
//		$this->form_validation->set_rules('point_consume', 'lang:point_consume', 'trim|numeric');
//		$this->form_validation->set_rules('credit_consume', 'lang:credit_consume', 'trim|numeric');
//		$this->form_validation->set_rules('image', 'lang:image', 'trim');
//		$this->form_validation->set_rules('desc', 'lang:desc', 'trim');
//		
//		$this->form_validation->set_rules('start_date', 'lang:start_date');
//		$this->form_validation->set_rules('end_date', 'lang:end_date');
		
		// create product list
		
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/project_form', $data);
		}
		else
		{
			
//			$this->load->helper('text');
//			$uploaded	= $this->upload->do_upload('image');
//			
//			$save['id']						= $id;
//			$save['code']					= $this->input->post('code');
//			$save['name']					= $this->input->post('name');
//			$save['start_date']				= format_ymd_malaysia($this->input->post('start_date'));
//			$save['end_date']				= format_ymd_malaysia($this->input->post('end_date'));
//			$save['max_uses']				= $this->input->post('max_uses');
//			$save['whole_order_project'] 	= 1;
//			//$save['whole_order_project'] 	= $this->input->post('whole_order_project');
//			$save['max_product_instances'] 	= $this->input->post('max_product_instances');
//			//$save['reduction_target']		= $this->input->post('reduction_target');
//			$save['reduction_target']		= 'price';
//			$save['reduction_type']			= $this->input->post('reduction_type');
//			$save['reduction_amount']		= $this->input->post('reduction_amount');
//			$save['point_consume']			= $this->input->post('point_consume');
//			$save['credit_consume']			= $this->input->post('credit_consume');
//			$save['desc']					= $this->input->post('desc');
//			$save['staff_id']				= $this->current_admin['id'];
//			$save['created_date']			= date('Y-m-d H:i:s');
//						
//			//Checking for super admin
//			if($this->current_admin['branch'] == 0):
//				$save['branch_id']					= $this->input->post('branch_id');
//			else:
//				$save['branch_id']					= $this->current_admin['branch'];
//			endif;			
//			
//
//			if($save['start_date']=='')
//			{
//				$save['start_date'] = null;
//			}
//			if($save['end_date']=='')
//			{
//				$save['end_date'] = null;
//			}
//			
//			$product = $this->input->post('product');
//			
//			if ($id)
//			{	
//				//delete the original file if another is uploaded
//				if($uploaded)
//				{
//					if($data['image'] != '')
//					{
//						//$file = 'uploads/'.$data['image'];
//						//$config['upload_path'] = FCPATH . 'uploads/';						 						
//						
//						$file = $folderName.$data['image'];												
//							
//						//delete the existing file if needed
//						if(file_exists($file))
//						{
//							unlink($file);
//						}
//					}
//				}
//					
//			}
//			else
//			{
//				if(!$uploaded)
//				{
//					$data['error']	= $this->upload->display_errors();
//					$this->view(config_item('admin_folder').'/project_upload_form', $data);
//					return; //end script here if there is an error
//				}
//			}
//			
//			if($uploaded)
//			{
//				if (!is_dir($folderName)) {
//					mkdir($folderName, 0777, TRUE);
//					//mkdir('./uploads/project/' . $today_date.'/thumbs', 0777, TRUE);
//				}
//								
//				$image			= $this->upload->data();
//															
//				$save['image']  = $folderName.$image['file_name'];
//				//$save['image']	= $image['file_name'];
//			}
//			
//			
//			
//			// save project
//			$promo_id = $this->Project_model->save($save);
//			
//			// save products if not a whole order project
//			//   clear products first, then save again (the lazy way, but sequence is not utilized at the moment)
//			$this->Project_model->remove_product($id);
//			
//			if(!$save['whole_order_project'] && $product) 
//			{
//				while(list(, $product_id) = each($product))
//				{
//					$this->Project_model->add_product($promo_id, $product_id);
//				}
//			}
//			
//			// We're done
//			$this->session->set_flashdata('message', lang('message_saved_project'));
//			
//			//go back to the product list
//			redirect($this->config->item('admin_folder').'/projects');
		}
	}

	//this is a callback to make sure that 2 projects don't have the same code
	function check_code($str)
	{
		$code = $this->Project_model->check_code($str, $this->project_id);
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
//	
//	//this is a callback to make sure that 2 projects don't have the same code
//	function check_project($str)
//	{
//		$project = $this->Project_model->get_project_by_code($str);
//		if ($project)
//		{
//			
//			$is_valid = $this->Project_model->is_valid($project);
//			
//			if($is_valid){
//				return TRUE;
//			}else{
//				$this->form_validation->set_message('check_project', lang('error_project'));
//				return FALSE;
//			}									
//		}
//		else
//		{
//			$this->form_validation->set_message('check_project', lang('error_not_found'));
//			return FALSE;
//		}
//	}
//	
//	function check_card($str)
//	{
//		$card = $this->Customer_model->check_card($str);
//		if ($card)
//		{			
//			return TRUE;			
//		}
//		else
//		{
//			$this->form_validation->set_message('check_card', lang('error_card_not_found'));
//			return FALSE;
//		}
//	}
//	
	function delete($id = false)
	{
		if ($id)
		{	
			$project	= $this->Project_model->get_projects($id);
			//if the promo does not exist, redirect them to the customer list with an error
			if (!$project)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/projects/form');
			}
			else
			{
				$this->Project_model->delete_project($id);
				
				$this->session->set_flashdata('message', lang('message_project_deleted'));
				redirect($this->config->item('admin_folder').'/projects/form');
			}
		}
		else
		{
			//if they do not provide an id send them to the promo list page with an error
			$this->session->set_flashdata('message', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/projects/form');
		}
	}
//	
//	function process_project()
//	{
//		$data['page_title']		= lang('process_project');
//		$today_date 	= date("Ymd");
//		//die(print_r($_POST));
//	
//		$this->load->helper(array('form', 'date'));
//		$this->load->library('form_validation');
//		$this->load->helper('url');
//		$this->load->helper('form');
//		
//		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
//			
//		//default values are empty if the product is new
//		$data['id']						= '';
//		$data['project_id']				= '';
//		$data['card']					= '';	
//
//		
//		$projects	= $this->Project_model->get_projects(NULL, $this->current_admin, TRUE);
//		$project_list = array();
//		foreach($projects as $project)
//		{
//			$project_list[$project->id] = $project->name;
//		}
//		$data['projects'] = $project_list;
//		
//	
//		$added = array();
//	
//		$this->form_validation->set_rules('project_id', 'lang:products');
//		$this->form_validation->set_rules('card', 'lang:card', 'trim|required|callback_check_card');
//						
//		if ($this->form_validation->run() == FALSE)
//		{
//			$this->view($this->config->item('admin_folder').'/project_proceed', $data);
//		}
//		else
//		{					
//			$project_id					= $this->input->post('project_id');
//			$card					= $this->input->post('card');
//			
//			// We're done
//			//$this->session->set_flashdata('message', lang('message_customer_project'));				
//			//go back to the product list
//			redirect($this->config->item('admin_folder').'/projects/process_project_details/'.$project_id.'/'.$card);
//		}
//	}
//	
//	function process_project_details($project_id = '', $member_card = '')
//	{
//		$data['page_title']		= lang('process_project');
//		$this->load->helper(array('form', 'date', 'url'));
//		$this->load->library('form_validation');
//		
//		
//		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//									
//			$this->form_validation->set_rules( 'used', lang('use_qty'), 'trim|required|numeric|callback_check_qty_used' );
//								
//			if ($this->form_validation->run() == FALSE)
//			{				
//				$project_id = $this->input->post('project_id');
//				$member_card = $this->input->post('customer_card');				
//			}
//			else 
//			{
//				$save['active']  = $this->input->post('active');
//				$used  			= $this->input->post('used');
//				$save['project_id'] = $this->input->post('project_id');
//				$save['customer_id'] = $this->input->post('customer_id');
//					
//				$is_exist = $this->Project_model->check_project_customer($save['project_id'], $save['customer_id']);
//				
//				if($is_exist){
//					$details = $this->Project_model->my_project_details($save['project_id'], $save['customer_id']);									
//					$save['used'] = $details['used'] + $used;				
//					$id = $this->Project_model->update_project_customer($save);				
//				}else{
//					// impossible happen here
//					$save['used'] = $used;
//					$this->Project_model->add_project_customer($save);
//				}
//				
//				//customer project log , can know all the using project log
//				$log['project_id'] = $save['project_id'];
//				$log['customer_id'] = $save['customer_id'];
//				$log['used'] = $used;
//				$log['trx_date'] = date('Y-m-d H:i:s');
//				$log['staff_id'] = $this->current_admin['id'];
//					
//				$this->Project_model->add_customer_project_log($log);
//
//				if($id > 0){
//					// We're done
//					$this->session->set_flashdata('message', lang('message_saved_project'));
//					//go back to the process project form
//					redirect($this->config->item('admin_folder').'/projects/process_project/');
//				}else{
//					$this->session->set_flashdata('error', lang('error_saved_project'));
//					//go back to the process project form with error message
//					redirect($this->config->item('admin_folder').'/projects/process_project/');
//				}
//			}
//			
//		}
//		
//		if($project_id == '' || $member_card == ''){
//			$this->session->set_flashdata('message', lang('error_not_found'));
//			redirect($this->config->item('admin_folder').'/projects/process_project');
//		}else{			
//			
//			$project = $this->Project_model->get_project($project_id);
//			$customer = $this->Customer_model->get_customer_by_card($member_card);
//			
//			$data['project_id'] = $project->id;
//			$data['customer_id'] = $customer['id'];
//			$data['customer'] = $customer;
//			
//						
//			$data['details'] = $this->Project_model->my_project_details($project->id, $customer['id']);
//						
//			$this->view(config_item('admin_folder').'/project_proceed_details', $data);						
//		}
//	}
        
        public function do_upload() { 
//            redirect('admin_folder').'/projects';
//            redirect($this->config->item('admin_folder').'/projects/form_success');
//            echo '<script>console.log("Your stuff here")</script>';
         $config['upload_path']   = 'uploads/project/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $this->load->library('upload', $config);
			
//         if ( ! $this->upload->do_upload('userfile')) {
//             echo 'lalalalala1';
//            $data =  array('error' => $this->upload->display_errors()); 
////            redirect($this->config->item('admin_folder').'/projects/form/success');
//            $this->view(config_item('admin_folder').'/project_form', $data);
////            redirect('admin_folder').'/projects/form';
//         }
//			
//         else { 
//             echo 'lalalalala2';
//            $data = array('upload_data' => $this->upload->data()); 
////            redirect($this->config->item('admin_folder').'/projects/form/success');
//            $this->view(config_item('admin_folder').'/project_form_success', $data);
////            redirect('admin_folder').'/projects/form_success'; 
//         } 
         
         if(!empty($_FILES)){
             $this->upload->do_upload($_FILES['file']['name']);
         }
         
         foreach ($_FILES as $userfile => $fileObject)  //fieldname is the form field name
        {
             echo "{$userfile} =>  ";
             print_r( $fileObject);
//             echo $userfile;
//             print_r( $fileObject);
            if (!empty($fileObject['name']))
            {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($userfile['userfile']['name']))
                {
                    $errors = $this->upload->display_errors();
                    flashMsg($errors);
                }
                else
                {
                    echo 'lalalalala2';
                     // Code After Files Upload Success GOES HERE
                }
            }
        }
      } 
	
	public function uploadImage()
        {
            $today_date 	= date("Ymd");

            $this->load->helper(array('form', 'date', 'url'));

            $folderName = 'uploads/project/';
            $config['upload_path']		= $folderName;		
            if (!is_dir($folderName)) {
                    mkdir($folderName, 0777, TRUE);
                    //mkdir('./uploads/coupon/' . $today_date.'/thumbs', 0777, TRUE);
            }	
             $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'codexworld';
             $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
            if($mysqli->connect_errno){
                echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
            
            $targetDir = $folderName;
            $fileName = $_FILES['file']['name'];
            $targetFile = $targetDir.$fileName;
            
            if(!file_exists($targetFile)){
                if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
                    $count++;
                    $this->load->model('Project_model');
                    $data = array( 
                        'url'           => $targetFile, 
                        'name'          => $fileName,
                        'upload_date'   => date("Y-m-d H:i:s"),
                        'status'        => 'INACTIVE'
                     ); 
                     var_dump($data);
                    $img_id = $this->Project_model->save($data); 
                    //$data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
                    //insert file information into db table
    //                $conn->query("INSERT INTO projects_products (url,name, upload_date) VALUES('".$targetFile."','".$fileName."','".date("Y-m-d H:i:s")."')");
                }
            }else{
                if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
                    $project_url_exist = $this->Project_model->get_project_by_url($targetFile);
                    if(!$project_url_exist){
                        $this->load->model('Project_model');
                        $data = array( 
                            'url'           => $targetFile, 
                            'name'          => $fileName,
                            'upload_date'   => date("Y-m-d H:i:s"),
                            'status'        => 'INACTIVE'
                         ); 
                         var_dump($data);
                        $img_id = $this->Project_model->save($data); 
                    }
                }
            }
            $this->session->set_flashdata('message', lang('message_project_uploaded'));
        }
        
        public function getData()
        {
            $data['vouchers']	= $this->Project_model->get_projects(NULL, $this->current_admin);
//            redirect($this->config->item('admin_folder').'projects/form');
//            $this->form(false);
//            return $this->Project_model->get_projects(NULL, $this->current_admin);
//            header('Content-type: application/json');
//            echo json_encode($data);
        }
        
        
	
	
}

?>
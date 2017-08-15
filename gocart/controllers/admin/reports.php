<?php

class Reports extends Admin_Controller {

	//this is used when editing or adding a customer
	var $customer_id	= false;	
	protected $activemenu 	= 'reports';
	var $current_admin	= false;

	function __construct()
	{		
		parent::__construct();

		$this->auth->check_access('Admin', true);
		
		$this->load->model('Order_model');
		$this->load->model('Search_model');
		$this->load->model('Credit_model');
		$this->load->model('Point_model');
		$this->load->model('Voucher_model');
		$this->load->model('Coupon_model');
		$this->load->helper(array('formatting'));
		
		$this->lang->load('report');
		$this->current_admin	= $this->session->userdata('admin');
	}
	
	function index()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('reports');
		$data['years']		= $this->Order_model->get_sales_years();
		$this->view($this->config->item('admin_folder').'/reports', $data);
	}
	
	function daily_reports()
	{		
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		
		$this->view($this->config->item('admin_folder').'/daily_reports', $data);
	}
	
	function monthly_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('monthly_reports');
	
		$this->view($this->config->item('admin_folder').'/monthly_reports', $data);
	}
	
	function print_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('print_statement');
	
		$this->view($this->config->item('admin_folder').'/print_reports', $data);
	}
	
	function voucher_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('voucher_report');
		$this->load->helper(array('form', 'date'));
		$data['voucher_id'] = '';
		$vouchers = $this->Voucher_model->get_vouchers();		
		$voucher_list[0] = 'Please select a voucher';
		foreach($vouchers as $voucher)
		{
			$voucher_list[$voucher->id] = $voucher->name;
		}
		$data['vouchers'] = $voucher_list;
	
		$this->view($this->config->item('admin_folder').'/voucher_reports', $data);
	}
	
	function coupon_reports()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('coupon_report');
		$this->load->helper(array('form', 'date'));
		$data['coupon_id'] = '';
		$coupons = $this->Coupon_model->get_coupons();
		$coupon_list[0] = 'Please select a coupon';
		foreach($coupons as $coupon)
		{
			$coupon_list[$coupon->id] = $coupon->name;
		}
		$data['coupons'] = $coupon_list;
	
		$this->view($this->config->item('admin_folder').'/coupon_reports', $data);
	}
	
	function daily_trx()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		$this->load->helper('date');
		$start	= $this->input->post('start');
		$end	= $this->input->post('end');	
		$data['start']			= $start;
		$data['end']			= $end;
		$data['credits_in']		= $this->Credit_model->get_add_credits_trx($start, $end, $this->current_admin);
		$data['credits_out']	= $this->Credit_model->get_minus_credits_trx($start, $end, $this->current_admin);
		$data['points_in']		= $this->Point_model->get_add_points_trx($start, $end, $this->current_admin);
		$data['points_out']	= $this->Point_model->get_minus_points_trx($start, $end, $this->current_admin);
		$data['credit_voucher_out']	= $this->Credit_model->get_voucher_trx($start, $end, $this->current_admin);
		$data['point_voucher_out']	= $this->Point_model->get_voucher_trx($start, $end, $this->current_admin);
						
		$this->load->view($this->config->item('admin_folder').'/reports/daily_transaction', $data);
	}
	
	function viewdailypdf($start = '', $end = '')
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		$this->load->helper('date');
		$this->load->helper('pdf');
		//$start	= $this->input->post('start');
		//$end		= $this->input->post('end');
		
		$credits_in			= $this->Credit_model->get_add_credits_trx($start, $end, $this->current_admin);
		$credits_out		= $this->Credit_model->get_minus_credits_trx($start, $end, $this->current_admin);
		$points_in			= $this->Point_model->get_add_points_trx($start, $end, $this->current_admin);
		$points_out			= $this->Point_model->get_minus_points_trx($start, $end, $this->current_admin);
		$credit_voucher_out	= $this->Credit_model->get_voucher_trx($start, $end, $this->current_admin);
		$point_voucher_out	= $this->Point_model->get_voucher_trx($start, $end, $this->current_admin);
				
		$pdf_dailyreport = generate_pdf_daily_report($credits_in, $credits_out, $points_in, $points_out, $credit_voucher_out, $point_voucher_out, $start, $end);
					
	}
	
	function monthly_trx()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('monthly_reports');
		
		
		$this->load->helper('date');
		$year	= $this->input->post('year');
		$month	= $this->input->post('month');
		$card	= $this->input->post('card');
		
		
	 	/* $year	= '2015';
		$month	= '6';
		$card	= $this->input->post('card');  */
		//$customer_id = NULL;
	
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}		
				
		$data['year']			= $year;
		$data['month']			= $month;
		$data['card']			= $card;
		
		$data['credits_in']		= $this->Credit_model->get_add_credits_trx_monthly($year, $month, $customer_id, $this->current_admin);					
		$data['credits_out']	= $this->Credit_model->get_minus_credits_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$data['points_in']		= $this->Point_model->get_add_points_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$data['points_out']		= $this->Point_model->get_minus_points_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$data['credit_voucher_out']	= $this->Credit_model->get_voucher_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$data['point_voucher_out']	= $this->Point_model->get_voucher_trx_monthly($year, $month, $customer_id, $this->current_admin);		
		
		$this->load->view($this->config->item('admin_folder').'/reports/monthly_transaction', $data);
	}
	
	function viewmonthlypdf($year = '', $month = '', $card = '')
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('monthly_reports');				
		$this->load->helper('date');
		$this->load->helper('pdf');
		
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
		//$start	= $this->input->post('start');
		//$end		= $this->input->post('end');	
		$credits_in			= $this->Credit_model->get_add_credits_trx_monthly($year, $month, $customer_id, $this->current_admin);	
		$credits_out		= $this->Credit_model->get_minus_credits_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$points_in			= $this->Point_model->get_add_points_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$points_out			= $this->Point_model->get_minus_points_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$credit_voucher_out	= $this->Credit_model->get_voucher_trx_monthly($year, $month, $customer_id, $this->current_admin);
		$point_voucher_out	= $this->Point_model->get_voucher_trx_monthly($year, $month, $customer_id, $this->current_admin);
	
		$pdf_dailyreport = generate_pdf_monthly_report($credits_in, $credits_out, $points_in, $points_out, $credit_voucher_out, $point_voucher_out, $year, $month, $card);
			
	}
	
	function print_statement()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('print_statement');
		
		$this->load->helper('date');		
		$from_year	= $this->input->post('from_year');
		$from_month	= $this->input->post('from_month');
		$start = $from_year.'-'.$from_month.'-01';
		
		$to_year	= $this->input->post('to_year');
		$to_month	= $this->input->post('to_month');
		$end = $to_year.'-'.$to_month.'-31';
		
		$card	= $this->input->post('card');
			
		$data['from_year']				= $from_year;
		$data['from_month']				= $from_month;		
		$data['to_year']				= $to_year;
		$data['to_month']				= $to_month;
		$data['card']					= $card;
	
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
	
		if(!is_null($customer_id)):
			$data['customer'] = $customer;
			$data['credit_balance'] = $this->Credit_model->get_credit_amt($customer_id);
			$data['point_balance'] = $this->Point_model->get_point_amt($customer_id);
			$data['credits']		= $this->Credit_model->get_credits_trx($start, $end, $customer_id);
		endif;
		$this->load->view($this->config->item('admin_folder').'/reports/print_statement', $data);
	}
	
	function viewprintpdf($from_year = '', $from_month = '', $to_year = '', $to_month = '', $card = '')
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('print_statement');
		
		$this->load->helper('date');
		$this->load->helper('pdf');
		
		$start = $from_year.'-'.$from_month.'-01';		
		$end = $to_year.'-'.$to_month.'-31';
			
		$customer = $this->Customer_model->get_customer_by_card($card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
		
		if(!is_null($customer_id)):
			$credit_balance = $this->Credit_model->get_credit_amt($customer_id);
			$point_balance = $this->Point_model->get_point_amt($customer_id);
			$credits	   = $this->Credit_model->get_credits_trx($start, $end, $customer_id);
		endif;
		
		$pdf_printstatement = generate_pdf_print_statement($customer, $credit_balance, $point_balance, $credits, $from_year, $from_month, $to_year, $to_month, $card);
			
	}
	
	function voucher_listing()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('voucher_report');
	
		$voucher_id	= $this->input->post('voucher_id');				
		$member_card	= $this->input->post('customer_card');
		
		//$voucher_id	= 1;
		//$member_card = 3;
		
		$data['voucher_id']		= $voucher_id;		
		$data['card']			= $member_card;
		
		$customer = $this->Customer_model->get_customer_by_card($member_card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}

		$data['customer'] = $customer;
		$data['vouchers'] = $this->Voucher_model->voucher_listing($voucher_id, $customer_id, $this->current_admin);
				
		$this->load->view($this->config->item('admin_folder').'/reports/voucher_listing', $data);
	}
	
	function viewvoucherpdf($voucher_id = '', $member_card = '')
	{
		$this->load->helper('date');
		$this->load->helper('pdf');
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('voucher_report');
		
		
		//$voucher_id	= $this->input->post('voucher_id');
		//$member_card	= $this->input->post('customer_card');				
	
		$customer = $this->Customer_model->get_customer_by_card($member_card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
		//$start	= $this->input->post('start');
		//$end		= $this->input->post('end');
		$customer			= $customer;
		$vouchers			= $this->Voucher_model->voucher_listing($voucher_id, $customer_id, $this->current_admin);
		
		$pdf_voucherreport = generate_pdf_voucher_report($customer, $vouchers, $voucher_id, $customer_id);
			
	}
	
	function coupon_listing()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('coupon_report');
	
		$coupon_id	= $this->input->post('coupon_id');
		$member_card	= $this->input->post('customer_card');
	
		//$coupon_id	= 1;
		//$member_card = 3;
		$data['coupon_id']		= $coupon_id;
		$data['card']			= $member_card;
	
		$customer = $this->Customer_model->get_customer_by_card($member_card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
	
		$data['customer'] = $customer;
		$data['coupons'] = $this->Coupon_model->coupon_listing($coupon_id, $customer_id, $this->current_admin);
	
		$this->load->view($this->config->item('admin_folder').'/reports/coupon_listing', $data);
	}
	
	function viewcouponpdf($coupon_id = '', $member_card = '')
	{
		$this->load->helper('date');
		$this->load->helper('pdf');
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('coupon_report');
		
	
		//$coupon_id	= $this->input->post('coupon_id');
		//$member_card	= $this->input->post('customer_card');
		
	
		$customer = $this->Customer_model->get_customer_by_card($member_card);
		$customer_id = NULL;
		if(isset($customer) && !empty($customer))
		{
			$customer_id = $customer['id'];
		}
		//$start	= $this->input->post('start');
		//$end		= $this->input->post('end');
		$customer			= $customer;
		$coupons			= $this->Coupon_model->coupon_listing($coupon_id, $customer_id, $this->current_admin);
		
			
		$pdf_couponreport = generate_pdf_coupon_report($customer, $coupons, $coupon_id, $customer_id);
			
	}
	
	
	
	function best_sellers()
	{
		$data['page_title']	= lang('daily_reports');
		$start	= $this->input->post('start');
		$end	= $this->input->post('end');
		$data['best_sellers']	= $this->Order_model->get_best_sellers($start, $end);
		
		$this->load->view($this->config->item('admin_folder').'/reports/best_sellers', $data);	
	}
	
	function sales()
	{
		$data['page_title']	= lang('daily_reports');
		$year			= $this->input->post('year');
		$data['orders']	= $this->Order_model->get_gross_monthly_sales($year);
		$this->load->view($this->config->item('admin_folder').'/reports/sales', $data);	
	}

}
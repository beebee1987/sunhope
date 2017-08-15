<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function generate_pdf_invoice($invoice_data, $stream = TRUE)
{
    $CI = & get_instance();

    $data = array(
        'invoice_details'   => $invoice_data,
        'output_type'       => 'pdf'
    );

    $html = $CI->load->view('pdf_templates/invoices', $data, TRUE);

    $CI->load->helper('mpdf');

    $filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $invoice_data['invoice_details']->invoice_number), '_'));

    return pdf_create($html, $filename , $stream);
}
function generate_pdf_quote($quote_data, $stream = TRUE)
{
    $CI = & get_instance();

    $data = array(
        'quote_details'   => $quote_data,
        'output_type'       => 'pdf'
    );

    $html = $CI->load->view('pdf_templates/quotes', $data, TRUE);

    $CI->load->helper('mpdf');

    $filename = 'quote_'.strtolower(trim(preg_replace('#\W+#', '_', $quote_data['quote_details']->quote_id), '_'));

    return pdf_create($html, $filename, $stream);
}
function generate_pdf_report($full_report_data, $stream = TRUE, $bill_date)
{
	$CI = & get_instance();

	$data = array(
			'report_details'   => $full_report_data,
			'output_type'       => 'pdf',
			'bill_date'		=> $bill_date,
	);

	$html = $CI->load->view('pdf_templates/report', $data, TRUE);

	$CI->load->helper('mpdf');

	$client_name = isset($full_report_data[0]['invoice_client']) && !empty($full_report_data[0]['invoice_client']) ? $full_report_data[0]['invoice_client'] : 'EMPTY_CLIENT';
	$client_date = isset($full_report_data[0]['invoice_date']) && !empty($full_report_data[0]['invoice_date']) ? $full_report_data[0]['invoice_date'] : 'NO_DATE';
	$client_status = isset($full_report_data[0]['invoice_status']) && !empty($full_report_data[0]['invoice_status']) ? $full_report_data[0]['invoice_status'] : 'NO_STATUS';

	// statement name and month file
	$filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $client_name.'_'.$client_date.'_'.$client_status) , '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_daily_report($credits_in, $credits_out, $points_in, $points_out, $credit_voucher_out, $point_voucher_out, $start, $end, $stream = TRUE)
{
	$CI = &get_instance();
	
	$data = array(
			'credits_in'   		    => $credits_in,
			'credits_out'   	    => $credits_out,
			'points_in'   		    => $points_in,
			'points_out'   			=> $points_out,
			'credit_voucher_out'    => $credit_voucher_out,
			'point_voucher_out'     => $point_voucher_out,			
			'output_type'       	=> 'pdf',			
	);
	$html = $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	//$html = $CI->load->view($this->config->item('admin_folder').'/pdf_templates/daily', $data, TRUE);
	//echo $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	$CI->load->helper('mpdf');
		
	// statement name and month file
	$filename = 'daily_trx_'.strtolower(trim(preg_replace('#\W+#', '_', $start.'_'.$end) , '_'));
	
	return pdf_create($html, $filename , $stream);
}

function generate_pdf_monthly_report($credits_in, $credits_out, $points_in, $points_out, $credit_voucher_out, $point_voucher_out, $year, $month, $card ,$stream = TRUE)
{	
	$CI = &get_instance();

	$data = array(
			'credits_in'   		    => $credits_in,
			'credits_out'   	    => $credits_out,
			'points_in'   		    => $points_in,
			'points_out'   			=> $points_out,
			'credit_voucher_out'    => $credit_voucher_out,
			'point_voucher_out'     => $point_voucher_out,
			'output_type'       	=> 'pdf',
	);
	$html = $CI->load->view('admin/pdf_templates/monthly', $data, TRUE);
	//$html = $CI->load->view($this->config->item('admin_folder').'/pdf_templates/daily', $data, TRUE);
	//echo $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	$CI->load->helper('mpdf');

	// statement name and month file
	$filename = 'monthly_trx_'.strtolower(trim(preg_replace('#\W+#', '_', $year.'_'.$month.'_'.$card) , '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_print_statement($customer, $credit_balance, $point_balance, $credits, $from_year, $from_month, $to_year, $to_month , $card, $stream = TRUE)
{
	$CI = &get_instance();

	$data = array(
			'customer'   		    => $customer,
			'credit_balance'   	    => $credit_balance,
			'point_balance'   		=> $point_balance,
			'credits'   			=> $credits,			
			'output_type'       	=> 'pdf',
	);
	$html = $CI->load->view('admin/pdf_templates/print_statement', $data, TRUE);
	//$html = $CI->load->view($this->config->item('admin_folder').'/pdf_templates/daily', $data, TRUE);
	//echo $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	$CI->load->helper('mpdf');

	// statement name and month file
	$filename = 'print_statement_'.strtolower(trim(preg_replace('#\W+#', '_from_', $from_year.'_'.$from_month.'_to_'.$from_year.'_'.$to_month.'_'.$card) , '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_voucher_report($customer, $vouchers, $voucher_id, $customer_id, $stream = TRUE)
{
	$CI = &get_instance();

	$data = array(
			'customer'   		    => $customer,
			'vouchers'   	    	=> $vouchers,			
			'output_type'       	=> 'pdf',
	);
	$html = $CI->load->view('admin/pdf_templates/voucher', $data, TRUE);
	//$html = $CI->load->view($this->config->item('admin_folder').'/pdf_templates/daily', $data, TRUE);
	//echo $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	$CI->load->helper('mpdf');

	// statement name and month file
	$filename = 'voucher_'.strtolower(trim(preg_replace('#\W+#', '_', $voucher_id.'_'.$customer_id) , '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_coupon_report($customer, $coupons, $coupon_id, $customer_id, $stream = TRUE)
{
	$CI = &get_instance();

	$data = array(
			'customer'   		    => $customer,
			'coupons'   	    	=> $coupons,
			'output_type'       	=> 'pdf',
	);
	$html = $CI->load->view('admin/pdf_templates/coupon', $data, TRUE);
	//$html = $CI->load->view($this->config->item('admin_folder').'/pdf_templates/daily', $data, TRUE);
	//echo $CI->load->view('admin/pdf_templates/daily', $data, TRUE);
	$CI->load->helper('mpdf');

	// statement name and month file
	$filename = 'coupon_'.strtolower(trim(preg_replace('#\W+#', '_', $coupon_id.'_'.$customer_id) , '_'));

	return pdf_create($html, $filename , $stream);
}

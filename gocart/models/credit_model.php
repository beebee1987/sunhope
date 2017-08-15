<?php
Class Credit_model extends CI_Model
{
	function __construct()
	{
			parent::__construct();
	}
	
	function get_credits($search=false, $sort_by='', $sort_order='DESC', $limit=0, $offset=0)
	{
		$this->db->select(' credit.*, customers.id as customer_id, customers.name as customer_name, customers.card as customer_card ');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if ($search)
		{
			if(!empty($search->start_top))
			{				
				$this->db->where('created >=',format_ymd_malaysia($search->start_top).' 00:00:00');
			}
			if(!empty($search->end_top))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$search->end_date = date('Y-m-d', strtotime(format_ymd_malaysia($search->end_top))+86400);
				$this->db->where('created <',$search->end_top.' 23:59:59');
			}
			if(!empty($search->customer_id))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?				
				$this->db->where('customer_id',$search->customer_id);
			}
			if(!empty($search->customer_card))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$this->db->where('customers.card',$search->customer_card);
			}
			if(!empty($search->customer_name))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$this->db->where('customers.name',$search->customer_name);
			}
			//branch
			/* if(!empty($search->branch))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$this->db->where('branch',$search->branch);
			}	 */
		}
	
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		if(!empty($sort_by))
		{
			$this->db->order_by($sort_by, $sort_order);
		}
	
		return $this->db->get('credit')->result();
	}
	
	function get_credits_count($search=false)
	{
		if ($search)
		{
			if(!empty($search->start_top))
			{
				$this->db->where('created >=',format_ymd_malaysia($search->start_top).' 00:00:00');
			}
			if(!empty($search->end_top))
			{
				$this->db->where('created <',format_ymd_malaysia($search->end_top).' 23:59:59');
			}
			if(!empty($search->customer_id))
			{
				//increase by 1 day to make this include the final day
				//I tried <= but it did not function. Any ideas why?
				$this->db->where('customer_id',$search->customer_id);
			}
			//branch
			/* if(!empty($search->branch))
			{
			//increase by 1 day to make this include the final day
			//I tried <= but it did not function. Any ideas why?
			$this->db->where('branch',$search->branch);
			}	 */
				
		}
	
		return $this->db->count_all_results('credit');
	}
	
	
	function get_list($customer_id = '')
	{		
		if($customer_id != '')
		{
			$this->db->where('customer_id', $customer_id);
		}
		$res = $this->db->get('credit');
		return $res->result_array();
	}
	
	function get_credit_amt($customer_id = '')
	{		
		$this->db->select(' (sum(`in`) - sum(`out`)) as credit_amt ');
		$res = $this->db->where('customer_id', $customer_id)->get('credit');
		
		return $res->row_array();
	}
	
	function get_total_credit_consume($customer_id = '')
	{
		$this->db->select(' (sum(`out`)) as total_consumption ');
		$res = $this->db->where('customer_id', $customer_id)->get('credit');
	
		return $res->row_array();
	}
	
	function get_credit($id)
	{
		$this->db->select(' credit.*, customers.id as customer_id, customers.name as customer_name, customers.card as customer_card ');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		$res = $this->db->where('credit.id', $id)->get('credit');
		return $res->row_array();
	}
	
	function save_credit($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('credit', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('credit', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_message($id)
	{
		$this->db->where('id', $id)->delete('credit');
		return $id;
	}
	
	function get_add_credits_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = credit.staff_id');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
		
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
		
		$this->db->where('in > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('credit.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
		return $credits;
	}
	
	function get_minus_credits_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = credit.staff_id');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
	
		$this->db->where('out > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('credit.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
		return $credits;
	}
	
	function get_add_credits_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = credit.staff_id');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if(!empty($year))
		{
			$this->db->where('YEAR(created)', (int)$year);						
		}
	
		if(!empty($month))
		{
			$this->db->where('MONTH(created)', (int)$month);		
		}
		
		if(!empty($customer_id))
		{
			$this->db->where('customer_id', $customer_id);
		}
		
		$this->db->where('in > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('credit.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
		
	
		return $credits;
	}
	
	function get_minus_credits_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = credit.staff_id');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if(!empty($year))
		{
			$this->db->where('YEAR(created)', (int)$year);						
		}
	
		if(!empty($month))
		{
			$this->db->where('MONTH(created)', (int)$month);		
		}
	
		if(!empty($customer_id))
		{
			$this->db->where('customer_id', $customer_id);
		}
	
		$this->db->where('out > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('credit.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
		return $credits;
	}
	
	function get_credits_trx($start, $end, $customer_id)
	{
	
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = credit.staff_id');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		
		if(!empty($start))
		{
			$this->db->where('created >=', $start.' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  $end.' 23:59:59');
		}
	
		if(!empty($customer_id))
		{
			$this->db->where('customer_id', $customer_id);
		}	
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
	
		return $credits;
	}
	
	function get_voucher_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card, vouchers.name as voucher_name');
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		$this->db->join('vouchers', 'vouchers.id = credit.voucher_id');
		
		
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
	
		$this->db->where('out > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('credit.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
		return $credits;
	}
	
	function get_voucher_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		$this->db->select(' credit.*, credit.id as credit_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card, vouchers.name as voucher_name');		
		$this->db->join('branch', 'credit.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = credit.customer_id');
		$this->db->join('vouchers', 'vouchers.id = credit.voucher_id');
		
		if(!empty($year))
		{
			$this->db->where('YEAR(created)', (int)$year);
		}
	
		if(!empty($month))
		{
			$this->db->where('MONTH(created)', (int)$month);
		}
	
		if(!empty($customer_id))
		{
			$this->db->where('customer_id', $customer_id);
		}
	
		$this->db->where('out > 0');
	
		if(isset($current_admin)&&!empty($current_admin)):
		if($current_admin['branch'] > 0):
		$this->db->where('credit.branch_id', $current_admin['branch']);
		endif;
		endif;
	
		// just fetch a list of order id's
		$credits	= $this->db->get('credit')->result();
	
		return $credits;
	}
	
}
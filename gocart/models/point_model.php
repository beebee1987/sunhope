<?php
Class Point_model extends CI_Model
{
	function __construct()
	{
			parent::__construct();
	}
	
	
	function get_points($search=false, $sort_by='', $sort_order='DESC', $limit=0, $offset=0)
	{
		$this->db->select('point.*, customers.id as customer_id, customers.name as customer_name, customers.card as customer_card ');
		$this->db->join('customers', 'customers.id = point.customer_id');
		
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
				$this->db->where('created <',format_ymd_malaysia($search->end_top). ' 23:59:59');
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
	
			return $this->db->get('point')->result();
	}
	
		function get_points_count($search=false)
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
	
				return $this->db->count_all_results('point');
			}
	
	function get_list($customer_id = '')
	{		
		if($customer_id != '')
		{
			$this->db->where('customer_id', $customer_id);
		}
		$res = $this->db->get('point');
		return $res->result_array();
	}
	
		
	function get_point_amt($customer_id = '')
	{
		$this->db->select(' (sum(point) - sum(depoint)) as point_amt ');
		$res = $this->db->where('customer_id', $customer_id)->get('point');
		return $res->row_array();
	}
	

	function get_point($id)
	{
		$this->db->select('point.*, customers.id as customer_id, customers.name as customer_name, customers.card as customer_card ');
		$this->db->join('customers', 'customers.id = point.customer_id');
		$res = $this->db->where('point.id', $id)->get('point');
		return $res->row_array();
	}
	
	function save_point($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('point', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('point', $data);
			return $this->db->insert_id();
		}
	}
	
	function get_branch_points($search=false, $sort_by='', $sort_order='DESC', $limit=0, $offset=0)
	{
		$this->db->select('branch_point.*, branch.name as branch_name');
		$this->db->join('branch', 'branch.id = branch_point.branch_id');
		
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
				$this->db->where('created <',format_ymd_malaysia($search->end_top). ' 23:59:59');
			}
							
		}
	
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		if(!empty($sort_by))
		{
			$this->db->order_by($sort_by, $sort_order);
		}
	
		return $this->db->get('branch_point')->result();
	}
	
	function get_branch_point($id)
	{
		$this->db->select('branch_point.*');
		$res = $this->db->where('branch_point.id', $id)->get('branch_point');
		return $res->row_array();
	}
	
	function get_branch_point_balance($branch_id)
	{
		$this->db->select(' (sum(point) - sum(depoint)) as point_amt ');
		$res = $this->db->where('branch_id', $branch_id)->get('branch_point');
		return $res->row_array();		
	}
	
	function get_branch_points_count($search=false)
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
		}
	
		return $this->db->count_all_results('branch_point');
	}
	
	function save_branch_point($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('branch_point', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('branch_point', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_message($id)
	{
		$this->db->where('id', $id)->delete('point');
		return $id;
	}
	
	function get_add_points_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = point.staff_id');
		$this->db->join('branch', 'point.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = point.customer_id');
		
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
	
		$this->db->where('point > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('point.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	function get_minus_points_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = point.staff_id');
		$this->db->join('branch', 'point.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = point.customer_id');
		
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
	
		$this->db->where('depoint > 0');
	
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('point.branch_id', $current_admin['branch']);
			endif;
		endif;
		
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	function get_add_points_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = point.staff_id');
		$this->db->join('branch', 'point.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = point.customer_id');
		
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
	
		$this->db->where('point > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('point.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	function get_minus_points_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card');
		$this->db->join('admin', 'admin.id = point.staff_id');
		$this->db->join('branch', 'point.branch_id = branch.id');	
		$this->db->join('customers', 'customers.id = point.customer_id');
		
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
	
		$this->db->where('depoint > 0');
		
		if(isset($current_admin)&&!empty($current_admin)):
			if($current_admin['branch'] > 0):
				$this->db->where('point.branch_id', $current_admin['branch']);
			endif;
		endif;
	
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	function get_voucher_trx($start, $end, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card, vouchers.name as voucher_name');
		$this->db->join('branch', 'point.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = point.customer_id');
		$this->db->join('vouchers', 'vouchers.id = point.voucher_id');
	
	
		if(!empty($start))
		{
			$this->db->where('created >=', format_ymd_malaysia($start).' 00:00:00');
		}
	
		if(!empty($end))
		{
			$this->db->where('created <',  format_ymd_malaysia($end).' 23:59:59');
		}
	
		$this->db->where('depoint > 0');
	
		if(isset($current_admin)&&!empty($current_admin)):
		if($current_admin['branch'] > 0):
		$this->db->where('point.branch_id', $current_admin['branch']);
		endif;
		endif;
	
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	function get_voucher_trx_monthly($year, $month, $customer_id, $current_admin = false)
	{
		$this->db->select(' point.*, point.id as point_id, branch.name as branch_name, customers.name as customer_name, customers.card as customer_card, vouchers.name as voucher_name');
		$this->db->join('branch', 'point.branch_id = branch.id');
		$this->db->join('customers', 'customers.id = point.customer_id');
		$this->db->join('vouchers', 'vouchers.id = point.voucher_id');
	
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
	
		$this->db->where('depoint > 0');
	
		if(isset($current_admin)&&!empty($current_admin)):
		if($current_admin['branch'] > 0):
		$this->db->where('point.branch_id', $current_admin['branch']);
		endif;
		endif;
	
		// just fetch a list of order id's
		$points	= $this->db->get('point')->result();
	
		return $points;
	}
	
	
}
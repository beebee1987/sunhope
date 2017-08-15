<?php
Class Branch_model extends CI_Model
{

    var $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    
    function get_branch_list($current_admin, $is_form=TRUE)
    {    	
    	if($is_form):
    		$this->db->where('active','1');
    	endif;
    	
    	if(!empty($current_admin) && isset($current_admin)):
	    	if($current_admin['branch'] > 0):
	    		$this->db->where('id', $current_admin['branch']);
	    	endif;
    	endif;
    	
        $branch = $this->db->get('branch')->result_array();
        // unserialize the field data       
        
        return $branch;
    }
    
    
    function save_branch($data)
    {
        if(!empty($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update('branch', $data);
            return $data['id'];
        } else {
            $this->db->insert('branch', $data);
            return $this->db->insert_id();
        }
    }
    
    function delete_branch($branch_id)
    {
        $this->db->where(array('id'=>$branch_id))->delete('branch');
        return $id;
    }
    
    
    function deactivate($id)
    {
        $branch   = array('id'=>$id, 'active'=>0);
        $this->save_branch($branch);
    }
    
    function delete($id)
    {
        /*
        deleting a customer will remove all their orders from the system
        this will alter any report numbers that reflect total sales
        deleting a customer is not recommended, deactivation is preferred
        */
        
        //this deletes the branch record
        $this->db->where('id', $id);
        $this->db->delete('branch');
        
        // Delete Address records
        $this->db->where('customer_id', $id);
        $this->db->delete('branch');
        
        //get all the orders the customer has made and delete the items from them
        $this->db->select('id');
        $result = $this->db->get_where('orders', array('customer_id'=>$id));
        $result = $result->result();
        foreach ($result as $order)
        {
            $this->db->where('order_id', $order->id);
            $this->db->delete('order_items');
        }
        
        //delete the orders after the items have already been deleted
        $this->db->where('customer_id', $id);
        $this->db->delete('orders');
    }

    
    function get_branch_by_id($branch_id)
    {
    	$result = $this->db->get_where('branch', array('id'=>$branch_id));
    	return $result->row_array();
    }

    

   
}
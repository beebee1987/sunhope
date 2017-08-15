<?php
Class Company_model extends CI_Model
{

    var $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    
    function get_company_list()
    {
        $company = $this->db->get('company_details')->result_array();
        // unserialize the field data       
        
        return $company;
    }
    
    
    function save_company($data)
    {
        if(!empty($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update('company_details', $data);
            return $data['id'];
        } else {
            $this->db->insert('company_details', $data);
            return $this->db->insert_id();
        }
    }
    
    function delete_company($company_id)
    {
        $this->db->where(array('id'=>$company_id))->delete('company_details');
        return $id;
    }
    
    
    function deactivate($id)
    {
        $company   = array('id'=>$id, 'active'=>0);
        $this->save_company($company);
    }
    
    function delete($id)
    {
        /*
        deleting a customer will remove all their orders from the system
        this will alter any report numbers that reflect total sales
        deleting a customer is not recommended, deactivation is preferred
        */
        
        //this deletes the company_details record
        $this->db->where('id', $id);
        $this->db->delete('company_details');
        
        // Delete Address records
        $this->db->where('customer_id', $id);
        $this->db->delete('company_details');
        
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

    
    function get_company_by_id($company_id)
    {
    	$result = $this->db->get_where('company_details', array('id'=>$company_id));
    	return $result->row_array();
    }

    

   
}
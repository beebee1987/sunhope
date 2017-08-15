<?php
Class Admin_model extends CI_Model
{

    var $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    
    function save_address($data)
    {
        // prepare fields for db insertion
        $data['field_data'] = serialize($data['field_data']);
        // update or insert
        if(!empty($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update('customers_address_bank', $data);
            return $data['id'];
        } else {
            $this->db->insert('customers_address_bank', $data);
            return $this->db->insert_id();
        }
    }
    
    function delete_address($id, $customer_id)
    {
        $this->db->where(array('id'=>$id, 'customer_id'=>$customer_id))->delete('customers_address_bank');
        return $id;
    }
        
    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('active', 1);
        $this->db->where('password',  sha1($password));
        $this->db->limit(1);
        $result = $this->db->get('admin');
        $admin   = $result->row_array();
        
        if ($admin)
        {                       
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function get_admin($username, $password)
    {
    	$this->db->select('*');
    	$this->db->where('username', $username);
    	$this->db->where('active', 1);
    	$this->db->where('password',  sha1($password));
    	$this->db->limit(1);
    	$result = $this->db->get('admin');
    	$admin   = $result->row_array();    
    	return $admin;
    }
    
    function get_admin_by_id($id)
    {
    	$this->db->select('*, branch.name as branch_name');
    	$this->db->join("branch", "branch.id=admin.branch_id");
    	$this->db->where('admin.id', $id);
    	$this->db->limit(1);
    	$result = $this->db->get('admin');
    	$admin   = $result->row_array();
    	return $admin;
    }
        
}
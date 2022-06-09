<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelCustomer extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_customer()
    {
        $this->db->select('customer_phone,customer_name,customer_address');
        $this->db->distinct();
        $this->db->order_by( 'id', 'desc' );
        $query = $this->db->get('orders');
        $result = $query->result_array();
        return $result;
    }
}

?>
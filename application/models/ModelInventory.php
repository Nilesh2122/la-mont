<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelInventory extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_inventory()
    {
        $this->db->from( 'tbl_product' );
        $this->db->where( 'tbl_product.active_state', 1 );
        $this->db->order_by( 'tbl_product.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function edit_row($id,$data)
    {
        $this->db->where('product_id',$id);
        $this->db->update('tbl_product',$data);
        return $this->db->affected_rows();      
    }
}

?>
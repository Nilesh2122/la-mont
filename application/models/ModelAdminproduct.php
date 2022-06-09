<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelAdminproduct extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_product()
    {
        $this->db->select( 'admin_products.*,tbl_store.id as store_id,tbl_store.name as store_name' );
        $this->db->join( 'tbl_store','tbl_store.id = admin_products.store_id','left' );
        $this->db->from( 'admin_products' );
		$this->db->where( 'admin_products.active_state', 1 );
        $this->db->order_by( 'admin_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function add_product_process($data)
    {
        $this->db->insert( 'tbl_product', $data );
        $product_id = $this->db->insert_id();
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Product added sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
    public function edit_product($product_id)
    {
        $this->db->from( 'admin_products' );
        $this->db->where( 'admin_products.product_id', $product_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function edit_product_process($data)
    {
        $this->db->where('product_id', $data['product_id']);
        $this->db->update('tbl_product',$data);
        $product_id = $data['product_id'];
        
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Product Edit sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
	public function delete_product($product_id)
    {
		$data['active_state'] = '0';
        $this->db->where('product_id', $product_id);
        $this->db->update('tbl_product',$data);
    }
    public function getProductData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM admin_products where product_id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM admin_products ORDER BY product_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getActiveProductData()
    {
        $this->db->from( 'admin_products' );
        $this->db->where( 'admin_products.active_state', 1 );
        $this->db->order_by( 'admin_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('product_id', $id);
            $update = $this->db->update('admin_products', $data);
            return ($update == true) ? true : false;
        }
    }
}

?>
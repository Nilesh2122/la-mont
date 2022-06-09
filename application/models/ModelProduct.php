<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelProduct extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_product()
    {
        $this->db->select( 'tbl_product.*,tbl_store.id as store_id,tbl_store.name as store_name' );
        $this->db->join( 'tbl_store','tbl_store.id = tbl_product.store_id','left' );
        $this->db->from( 'tbl_product' );
		$this->db->where( 'tbl_product.active_state', 1 );
        $this->db->order_by( 'tbl_product.product_id', 'desc' );
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
        $this->db->select( '*,tbl_product.name as Product_name,tbl_categories.name as cat_name,tbl_store.name as store_name' );
        $this->db->from( 'tbl_product' );
        $this->db->join( 'tbl_categories','tbl_categories.id = tbl_product.category_id','left' );
        $this->db->join( 'tbl_store','tbl_store.id = tbl_product.store_id','left' );
        $this->db->where( 'tbl_product.product_id', $product_id);
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
            $sql = "SELECT * FROM tbl_product where product_id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM tbl_product ORDER BY product_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getActiveProductData()
    {
        /*$sql = "SELECT * FROM tbl_product WHERE availability = ? ORDER BY product_id DESC";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();*/
        $this->db->select( 'tbl_product.*,tbl_store.id as store_id,tbl_store.name as store_name' );
        $this->db->join( 'tbl_store','tbl_store.id = tbl_product.store_id','left' );
        $this->db->from( 'tbl_product' );
        $this->db->where( 'tbl_product.active_state', 1 );
        $this->db->order_by( 'tbl_product.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('product_id', $id);
            $update = $this->db->update('tbl_product', $data);
            return ($update == true) ? true : false;
        }
    }
}

?>
<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelProductstore extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_product()
    {
        $store_id = $this->session->userdata('id');
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'warehouse_products.store_id', $store_id );
		$this->db->where( 'warehouse_products.active_state', 1 );
        $this->db->order_by( 'warehouse_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function manage_product_order()
    {
        $store_id = $this->session->userdata('id');
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'warehouse_products.store_id', $store_id );
        $this->db->where( 'warehouse_products.active_state', 1 );
        $this->db->where( 'warehouse_products.qty !=', 0 );
        $this->db->order_by( 'warehouse_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function add_product_process($data,$data_img)
    {
        if(isset($data_img['totalFiles']))
        {
            $data['image'] = 'assets/product_images/'.$data_img['totalFiles'][0];
        }
        else
        {
            $data['image'] = '';
        }
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
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'warehouse_products.product_id', $product_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function edit_product_process($data,$data_img)
    {
        if(!empty($data_img))
        {
            $data['image'] = 'assets/product_images/'.$data_img['totalFiles'][0];
        }
        $this->db->where('product_id', $data['product_id']);
        $this->db->update('warehouse_products',$data);
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
        $this->db->update('warehouse_products',$data);
    }
    public function getProductData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM warehouse_products where product_id = ?";
            $query = $this->db->query($sql, array($id));

            return $query->row_array();
        }

        $sql = "SELECT * FROM warehouse_products ORDER BY product_id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getActiveProductData()
    {
        $store_id = $this->session->userdata('id');
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'warehouse_products.store_id', $store_id );
        $this->db->where( 'warehouse_products.qty !=', 0 );
        $this->db->where( 'warehouse_products.active_state', 1 );
        $this->db->order_by( 'warehouse_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
        
        /*$sql = "SELECT * FROM warehouse_products WHERE availability = ? ORDER BY product_id DESC";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();*/
    }
    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('product_id', $id);
            $update = $this->db->update('warehouse_products', $data);
            return ($update == true) ? true : false;
        }
    }
}

?>
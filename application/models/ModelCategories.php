<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelCategories extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_categories()
    {
        $this->db->from( 'tbl_categories' );
        $this->db->where( 'tbl_categories.is_active',1);
        $this->db->order_by( 'tbl_categories.id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function add_category_process($data)
    {
        $this->db->insert( 'tbl_categories', $data );
        $product_id = $this->db->insert_id();
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Category added sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
    public function edit_product($categories_id)
    {
        $this->db->from( 'tbl_categories' );
        $this->db->where( 'tbl_categories.id', $categories_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function edit_category_process($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_categories',$data);
        $product_id = $this->db->insert_id();
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Category edit sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
    public function delete_category($category)
    {
        $data['is_active'] = '0';
        $this->db->where('id', $category);
        $this->db->update('tbl_categories',$data);
    }
}

?>
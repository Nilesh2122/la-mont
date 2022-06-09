<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelAdmin extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_admin()
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'role', 2);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function edit_admin($store_id)
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'tbl_store.id', $store_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function edit_admin_process($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_store',$data);
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Admin Edit sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
    public function delete_store($store_id)
    {
        $data['active_state'] = '0';
        $this->db->where('id', $store_id);
        $this->db->update('tbl_store',$data);
    }
}

?>
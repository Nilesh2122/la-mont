<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelStore extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function manage_store()
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'role', 3);
        //$this->db->where( 'active_state', 1);
        $this->db->order_by( 'tbl_store.id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function add_store_process($data)
    {
        $this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'phone', $data['phone']);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'There is already an account with this phone.', 'data' => NULL );
        }
        else
        {
            $this->db->insert( 'tbl_store', $data );            
            if ( $this->db->affected_rows() > 0 ) 
            {
                $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Store added successful.');
            }
            else
            {
                $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.', 'data' => NULL );
            }
        }
        return $response_object;
    }
    public function edit_store($store_id)
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'tbl_store.id', $store_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function edit_store_process($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_store',$data);
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Store Edit sucessfully.' );
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
    public function verify_password($data)
    {
        $this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'phone', $data[ 'phone' ]  );
        $this->db->where( 'password', $data[ 'password' ] );
        $this->db->where( 'role', 2 );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $this->db->select( '*' );
            $this->db->from( 'tbl_store' );
            $this->db->where( 'id', $data[ 'store_id' ]  );
            $query = $this->db->get();
            $user = $query->row_array();
            $password = base64_decode($user['password']);
            $response_object = array( 'success' => true, 'status_code' => 1, 'message' => 'Login successful.','data'=>$password);
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => 0, 'message' => 'Invalid login or password.');
        }
        return $response_object;
    }
}

?>
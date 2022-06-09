<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelAccount extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function login_process($data)
    {
        $this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'phone', $data[ 'phone' ]  );
        $this->db->where( 'password', $data[ 'password' ] );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $user = $query->row_array();
            $response_object = array( 'success' => true, 'status_code' => 1, 'message' => 'Login successful.','data'=>$user);
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => 0, 'message' => 'Invalid login or password.');
        }
        return $response_object;
    }
    public function profile($user_id)
    {
        $this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'id', $user_id );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $user = $query->row_array();
            $response_object = array( 'success' => true, 'status_code' => 1, 'message' => 'Profile data.','data'=>$user);
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => 0, 'message' => 'Failed.');
        }
        return $response_object;
    }
    public function edit_profile_process($data)
    {
        /*$this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'email', $data['email']);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'There is already an account with this email.', 'data' => NULL );
        }
        else
        {
            $this->db->where('id', $data['id']);
            $this->db->update('tbl_store',$data);
            if ( $this->db->affected_rows() > 0 ) 
            {
                $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Profile Edit sucessfully.' );
            } 
            else 
            {
                $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
            }
        }*/

        $this->db->where('id', $data['id']);
        $this->db->update('tbl_store',$data);
        if ( $this->db->affected_rows() > 0 ) 
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Profile Edit sucessfully.' );
        } 
        else 
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
}

?>
<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelDashboard extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function superadmin_dashboard()
    {
        $user_id = $this->session->userdata('id');
        $this->db->from( 'tbl_product' );
        //$this->db->where( 'store_id', $user_id);
        $query = $this->db->get();
        $result['all_products'] = $query->num_rows();

        $this->db->from( 'tbl_store' );
        $this->db->where( 'role', 2);
        $query = $this->db->get();
        $result['all_store'] = $query->num_rows();

        $this->db->from( 'tbl_categories' );
        $query = $this->db->get();
        $result['all_category'] = $query->num_rows();

        $query = $this->db->query('SELECT SUM( net_amount)as total FROM admin_orders WHERE paid_status = 1')->row();
        $result['total_sale'] = floatval($query->total);

        $this->db->distinct();
        $query = $this->db->get('orders');
        $result['all_customer'] = $query->num_rows();


        $this->db->select( 'admin_orders.*,tbl_store.name' );
        $this->db->join( 'tbl_store','tbl_store.id = admin_orders.store_id' );
        $this->db->from( 'admin_orders' );
        $this->db->order_by( 'admin_orders.id', 'desc' );
        $this->db->limit('5');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $result['orders'] = $query->result_array();
            for($i=0;$i<count($result['orders']);$i++)
            {
                $this->db->from( 'admin_orders_item' );
                $this->db->where( 'admin_orders_item.order_id', $result['orders'][$i]['id']);
                $query = $this->db->get();
                if ( $query->num_rows() > 0 )
                {
                    $re = $query->row_array();
                    $result['orders'][$i]['qty'] = $query->num_rows();
                }
                else
                {
                    $result['orders'][$i]['qty'] = 0;
                }
            }
        }
        return $result;
    }
    public function admin_dashboard()
    {
        $user_id = $this->session->userdata('id');
        $this->db->from( 'admin_products' );
        $query = $this->db->get();
        $result['all_products'] = $query->num_rows();

        $this->db->from( 'tbl_store' );
        $this->db->where( 'role', 3);
        $this->db->where( 'active_state', 1);
        $query = $this->db->get();
        $result['all_store'] = $query->num_rows();

        $query = $this->db->query('SELECT SUM( net_amount)as total FROM warehouse_orders WHERE paid_status = 1')->row();
        $result['total_sale_warehouse'] = floatval($query->total);

        $query = $this->db->query('SELECT SUM( net_amount)as total FROM orders WHERE user_id = '.$user_id.' AND paid_status = 1')->row();
        $result['total_sale_customer'] = floatval($query->total);

        $this->db->select( 'warehouse_orders.*,tbl_store.name' );
        $this->db->join( 'tbl_store','tbl_store.id = warehouse_orders.store_id' );
        $this->db->from( 'warehouse_orders' );
        $this->db->order_by( 'warehouse_orders.id', 'desc' );
        $this->db->limit('5');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $result['orders'] = $query->result_array();
            for($i=0;$i<count($result['orders']);$i++)
            {
                $this->db->from( 'warehouse_orders_item' );
                $this->db->where( 'warehouse_orders_item.order_id', $result['orders'][$i]['id']);
                $query = $this->db->get();
                if ( $query->num_rows() > 0 )
                {
                    $re = $query->row_array();
                    $result['orders'][$i]['qty'] = $query->num_rows();
                }
                else
                {
                    $result['orders'][$i]['qty'] = 0;
                }
            }
        }


        $this->db->from( 'orders' );
        $this->db->where( 'user_id', $user_id);
        $this->db->order_by( 'orders.id', 'desc' );
        $this->db->limit('5');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $result['customer_orders'] = $query->result_array();
            for($i=0;$i<count($result['customer_orders']);$i++)
            {
                $this->db->from( 'orders_item' );
                $this->db->where( 'orders_item.order_id', $result['customer_orders'][$i]['id']);
                $query = $this->db->get();
                if ( $query->num_rows() > 0 )
                {
                    $re = $query->row_array();
                    $result['customer_orders'][$i]['qty'] = $query->num_rows();
                }
                else
                {
                    $result['customer_orders'][$i]['qty'] = 0;
                }
            }
        }
        return $result;
    }
    public function warehouse_dashboard()
    {
        $user_id = $this->session->userdata('id');
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'store_id', $user_id);
        $query = $this->db->get();
        $result['all_products'] = $query->num_rows();

        $query = $this->db->query('SELECT SUM( net_amount)as total FROM orders WHERE user_id = '.$user_id.' AND paid_status = 1')->row();
        $result['total_sale_customer'] = floatval($query->total);

        $this->db->from( 'orders' );
        $this->db->where( 'user_id', $user_id);
        $this->db->order_by( 'orders.id', 'desc' );
        $this->db->limit('5');
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) 
        {
            $result['customer_orders'] = $query->result_array();
            for($i=0;$i<count($result['customer_orders']);$i++)
            {
                $this->db->from( 'orders_item' );
                $this->db->where( 'orders_item.order_id', $result['customer_orders'][$i]['id']);
                $query = $this->db->get();
                if ( $query->num_rows() > 0 )
                {
                    $re = $query->row_array();
                    $result['customer_orders'][$i]['qty'] = $query->num_rows();
                }
                else
                {
                    $result['customer_orders'][$i]['qty'] = 0;
                }
            }
        }
        return $result;
    }

    public function dashboard_data()
    {
        $user_id = $this->session->userdata('id');
        if($this->session->userdata('role') == '1')
        {
            $this->db->from( 'tbl_product' );
            //$this->db->where( 'store_id', $user_id);
            $query = $this->db->get();
            $result['all_products'] = $query->num_rows();

            $this->db->from( 'tbl_store' );
            $this->db->where( 'role', 2);
            $query = $this->db->get();
            $result['all_store'] = $query->num_rows();

            $this->db->from( 'tbl_categories' );
            $query = $this->db->get();
            $result['all_category'] = $query->num_rows();

            $query = $this->db->query('SELECT SUM( net_amount)as total FROM warehouse_orders WHERE paid_status = 1')->row();
            $result['total_sale'] = floatval($query->total);

            $this->db->select( 'warehouse_orders.*,tbl_store.name' );
            $this->db->join( 'tbl_store','tbl_store.id = warehouse_orders.store_id' );
            $this->db->from( 'warehouse_orders' );
            $this->db->order_by( 'warehouse_orders.id', 'desc' );
            $query = $this->db->get();
            if ( $query->num_rows() > 0 ) 
            {
                $result['orders'] = $query->result_array();
                for($i=0;$i<count($result['orders']);$i++)
                {
                    $this->db->from( 'warehouse_orders_item' );
                    $this->db->where( 'warehouse_orders_item.order_id', $result['orders'][$i]['id']);
                    $query = $this->db->get();
                    if ( $query->num_rows() > 0 )
                    {
                        $re = $query->row_array();
                        $result['orders'][$i]['qty'] = $re['qty'];
                    }
                    else
                    {
                        $result['orders'][$i]['qty'] = 0;
                    }
                    //$result['orders'][$i]['qty'] = $query->num_rows();
                }
            }
            
        }
        else
        {
            $this->db->from( 'warehouse_products' );
            $this->db->where( 'store_id', $user_id);
            $query = $this->db->get();
            $result['all_products'] = $query->num_rows();
            $result['all_store'] = '0';

            $this->db->from( 'tbl_categories' );
            $query = $this->db->get();
            $result['all_category'] = $query->num_rows();

            $query = $this->db->query('SELECT SUM( net_amount)as total FROM orders WHERE paid_status = 1')->row();
            $result['total_sale'] = floatval($query->total);

            $this->db->select( 'orders.*,orders.customer_name as name' );
            $this->db->from( 'orders' );
            $this->db->order_by( 'orders.id', 'desc' );
            $query = $this->db->get();
            $result['orders'] = $query->result_array();
            for($i=0;$i<count($result['orders']);$i++)
            {
                $this->db->from( 'orders_item' );
                $this->db->where( 'orders_item.order_id', $result['orders'][$i]['id']);
                $query = $this->db->get();
                $re = $query->row_array();
                $result['orders'][$i]['qty'] = $re['qty'];
            }   
        }
        
        return $result;
    }
    public function login_process($data)
    {
        $this->db->select( '*' );
        $this->db->from( 'tbl_store' );
        $this->db->where( 'email', strtolower( trim( $data[ 'email' ] ) ) );
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
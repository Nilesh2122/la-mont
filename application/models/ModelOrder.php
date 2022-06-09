<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelOrder extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function get_order_data()
    {
        $user_id = $this->session->userdata('id');
        $this->db->from( 'orders' );
        $this->db->where( 'user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $this->db->from( 'orders_item' );
            $this->db->where( 'orders_item.order_id', $result[$i]['id']);
            $query = $this->db->get();
            if ( $query->num_rows() > 0 )
            {
                $re = $query->row_array();
                $result[$i]['qty'] = $query->num_rows();
            }
            else
            {
                $result[$i]['qty'] = 0;
            }
        }
        return $result;
    }
    public function getOrdersData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM orders WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM orders ORDER BY id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        for($i=0;$i<count($result);$i++)
        {
            $this->db->from( 'orders_item' );
            $this->db->where( 'orders_item.order_id', $result[$i]['id']);
            $query = $this->db->get();
            $re = $query->row_array();
            $result[$i]['qty'] = $re['qty'];
        }
        return $result;
    }
    public function getCompanyData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM company WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }
    }
    public function order_process()
    {
        $user_id = $this->session->userdata('id');
        $bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $data = array(
            'bill_no' => $bill_no,
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_phone' => $this->input->post('customer_phone'),
            'date_time' => strtotime(date('Y-m-d h:i:s a')),
            'gross_amount' => $this->input->post('gross_amount_value'),
            'cgst_rate' => $this->input->post('cgst_rate'),
            'cgst' => ($this->input->post('cgst_rate') != 0) ?$this->input->post('cgst_value'):0,

            'sgst_rate' => $this->input->post('sgst_rate'),
            'sgst' => ($this->input->post('sgst_rate') != 0) ?$this->input->post('sgst_value'):0,

            'igst_rate' => $this->input->post('igst_rate'),
            'igst' => ($this->input->post('igst_rate') != 0) ?$this->input->post('igst_value'):0,
            
            'net_amount' => $this->input->post('net_amount_value'),
            'discount' => $this->input->post('discount'),
            'paid_status' => 1,
            'user_id' => $user_id
        );

        $insert = $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();

        $this->load->model('ModelAdminproduct');

        $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
            $items = array(
                'order_id' => $order_id,
                'product_id' => $this->input->post('product')[$x],
                'qty' => $this->input->post('qty')[$x],
                'rate' => $this->input->post('rate_value')[$x],
                'amount' => $this->input->post('amount_value')[$x],
            );

            $this->db->insert('orders_item', $items);

            // now decrease the stock from the product
            $product_data = $this->ModelAdminproduct->getProductData($this->input->post('product')[$x]);
            $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

            $update_product = array('qty' => $qty);


            $this->ModelAdminproduct->update($update_product, $this->input->post('product')[$x]);
        }
        if($order_id)
        {
            $net_amount = $this->input->post('net_amount_value');
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Order Created Sucessfully.','data' => $order_id, 'phone'=> $data['customer_phone'], 'bill' => $bill_no, 'name'=> $data['customer_name'], 'amount' => $net_amount,'item' => $count_product );
        }
        else
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
    // get the orders item data
    public function getOrdersItemData($order_id = null)
    {
        if(!$order_id) {
            return false;
        }

        $sql = "SELECT * FROM orders_item WHERE order_id = ?";
        $query = $this->db->query($sql, array($order_id));
        return $query->result_array();
    }

    public function order_item_data($order_id = null)
    {
        if(!$order_id) {
            return false;
        }
        
        $this->db->select( 'orders_item.*,admin_products.name' );
        $this->db->from( 'orders_item' );
        $this->db->join( 'admin_products','orders_item.product_id = admin_products.product_id','left' );
        $this->db->where( 'orders_item.order_id', $order_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function manage_product_all()
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
    public function manage_store_return()
    {
        $store_id = $this->session->userdata('id');
        $this->db->from( 'store_return' );
        //$this->db->where( 'store_return.store_id', $store_id );
        $this->db->order_by( 'store_return.return_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function store_returns()
    {
        $user_id = $this->session->userdata('id');
        $data = array(
            'store_id' => $user_id,
            'customer_name' => $this->input->post('customer_name'),
            'bill_no' => $this->input->post('bill_no'),
            'customer_phone' => $this->input->post('customer_phone'),
            'reason' => $this->input->post('reasons'),
            'created_at' => date('Y-m-d h:i:s')
        );
        $insert = $this->db->insert('store_return', $data);
        $return_id = $this->db->insert_id();

        $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) 
        {
            $items = array(
                'return_id' => $return_id,
                'product_id' => $this->input->post('product')[$x],
                'qty' => $this->input->post('qty')[$x]
            );
            $this->db->insert('store_return_products', $items);
        }
        if($return_id)
        {
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Created Sucessfully.');
        }
        else
        {
            $response_object = array( 'success' => false, 'status_code' => '0', 'message' => 'failed.');
        }
        return $response_object;
    }
}

?>
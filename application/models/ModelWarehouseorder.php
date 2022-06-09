<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelWarehouseorder extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    public function getOrdersData($id = null)
    {
        if($id) {
            $this->db->select( 'warehouse_orders.*,tbl_store.name,tbl_store.location' );
            $this->db->join( 'tbl_store','tbl_store.id = warehouse_orders.store_id' );
            $this->db->from( 'warehouse_orders' );
            $this->db->where( 'warehouse_orders.id', $id);
            $query = $this->db->get();
            return $query->row_array();

            /*$sql = "SELECT * FROM warehouse_orders WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();*/
        }

       /* $sql = "SELECT * FROM warehouse_orders ORDER BY id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();*/

        $this->db->select( 'warehouse_orders.*,tbl_store.name' );
        $this->db->join( 'tbl_store','tbl_store.id = warehouse_orders.store_id' );
        $this->db->from( 'warehouse_orders' );
        $this->db->order_by( 'warehouse_orders.id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();

        for($i=0;$i<count($result);$i++)
        {
            $this->db->from( 'warehouse_orders_item' );
            $this->db->where( 'warehouse_orders_item.order_id', $result[$i]['id']);
            $query = $this->db->get();
            $result[$i]['qty'] = $query->num_rows();
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
    public function getwarehouseData($id)
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'tbl_store.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        $result['service_charge_value'] = $result['com'];
        if($result['state'] == '0')
        {
            $result['cgst'] = '9';
            $result['sgst'] = '9';
            $result['igst'] = '0';
        }
        else
        {
            $result['cgst'] = '0';
            $result['sgst'] = '0';
            $result['igst'] = '18';
        }
        return $result;
    }
    public function order_process()
    {
        $user_id = $this->session->userdata('id');
        $bill_no = 'BILPR-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        $data = array(
            'bill_no' => $bill_no,
            'store_id' => $this->input->post('store_id'),
            'date_time' => strtotime(date('Y-m-d h:i:s a')),
            'gross_amount' => $this->input->post('gross_amount_value'),
            'service_charge_rate' => $this->input->post('service_charge_rate'),
            'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,

            'cgst_rate' => $this->input->post('cgst_rate'),
            'cgst' => ($this->input->post('cgst_rate') != 0) ?$this->input->post('cgst_value'):0,

            'sgst_rate' => $this->input->post('sgst_rate'),
            'sgst' => ($this->input->post('sgst_rate') != 0) ?$this->input->post('sgst_value'):0,

            'igst_rate' => $this->input->post('igst_rate'),
            'igst' => ($this->input->post('igst_rate') != 0) ?$this->input->post('igst_value'):0,

            'net_amount' => $this->input->post('net_amount_value'),
            'paid_status' => 1,
            'user_id' => $user_id
        );

        $insert = $this->db->insert('warehouse_orders', $data);
        $order_id = $this->db->insert_id();

        $this->load->model('ModelAdminproduct');
        $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
            $product_id = $this->input->post('product')[$x];
            $product = $this->ModelAdminproduct->edit_product($product_id);

            $this->db->from( 'warehouse_products' );
            $this->db->where( 'warehouse_products.barcode', $product['barcode']);
            $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                $re = $query->row_array();
                $new_product_id = $re['product_id'];

                $up['qty'] = ($re['qty'] + $this->input->post('qty')[$x]);
                $this->db->where('product_id', $new_product_id);
                $update = $this->db->update('warehouse_products', $up);
            }
            else{
                $product_data = array(
                    'category_id' => $product['category_id'],
                    'store_id' => $this->input->post('store_id'),
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'product_price' => $product['product_price'],
                    'image' => $product['image'],
                    'size' => $product['size'],
                    'barcode' => $product['barcode'],
                    'sku' => $product['sku'],
                    'qty' => $this->input->post('qty')[$x],
                    'availability' => $product['availability'],
                    'active_state' => '1',
                    'created_date' => date('Y-m-d H:i:s')
                );            
                $this->db->insert('warehouse_products', $product_data);
                $new_product_id = $this->db->insert_id();
            }
            $items = array(
                'order_id' => $order_id,
                'product_id' => $new_product_id,
                'qty' => $this->input->post('qty')[$x],
                'rate' => $this->input->post('rate_value')[$x],
                'amount' => $this->input->post('amount_value')[$x],
            );

            $this->db->insert('warehouse_orders_item', $items);

            // now decrease the stock from the product
            $product_data = $this->ModelAdminproduct->getProductData($this->input->post('product')[$x]);
            $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

            $update_product = array('qty' => $qty);


            $this->ModelAdminproduct->update($update_product, $this->input->post('product')[$x]);
        }
        if($order_id)
        {
            $this->db->from( 'tbl_store' );
            $this->db->where( 'tbl_store.id', $data['store_id']);
            $query = $this->db->get();
            $re = $query->row_array();
            $phone = $re['phone'];
            $name = $re['name'];
            $net_amount = $this->input->post('net_amount_value');
            $response_object = array( 'success' => true, 'status_code' => '1', 'message' => 'Order Created Sucessfully.','data' => $order_id, 'phone'=> $phone, 'bill' => $bill_no, 'name'=> $name, 'amount' => $net_amount, 'item' => $count_product );
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
        $this->db->select( 'warehouse_orders_item.*,warehouse_products.name' );
        $this->db->from( 'warehouse_orders_item' );
        $this->db->join( 'warehouse_products','warehouse_orders_item.product_id = warehouse_products.product_id','left' );
        $this->db->where( 'warehouse_orders_item.order_id', $order_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}

?>
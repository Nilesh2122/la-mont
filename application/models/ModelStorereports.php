<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );

Class ModelStorereports extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }
    function get_products_report()
    {
        $store_id = $this->session->userdata('id');
        $this->db->from( 'warehouse_products' );
        $this->db->where( 'warehouse_products.store_id', $store_id );
        $this->db->where( 'warehouse_products.active_state', 1 );
        if(isset($_GET['from'])){
            $dateStart = $this->input->get('from');
            $dateTo = $this->input->get('to');
            $fromDate=date('Y-m-d',strtotime($dateStart));
            $toDate=date('Y-m-d',strtotime($dateTo));
            $this->db->where('DATE(created_date) >=',$fromDate);
            $this->db->where('DATE(created_date) <=',$toDate);
        }
        $this->db->order_by( 'warehouse_products.product_id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_categories_report()
    {
        $this->db->from( 'tbl_categories' );
        $this->db->order_by( 'tbl_categories.id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_warehouses_report()
    {
        $this->db->from( 'tbl_store' );
        $this->db->where( 'role', 3);
        $this->db->order_by( 'tbl_store.id', 'desc' );
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_sales_report()
    {
        $this->db->select( 'warehouse_orders.*,tbl_store.name' );
        $this->db->join( 'tbl_store','tbl_store.id = warehouse_orders.store_id' );
        $this->db->from( 'warehouse_orders' );
        $this->db->order_by( 'warehouse_orders.id', 'desc' );
        $query = $this->db->get();
        $result['orders'] = $query->result_array();
        for($i=0;$i<count($result['orders']);$i++)
        {
            $this->db->from( 'warehouse_orders_item' );
            $this->db->where( 'warehouse_orders_item.order_id', $result['orders'][$i]['id']);
            $query = $this->db->get();
            $result['orders'][$i]['qty'] = $query->num_rows();
        }
        /*echo "<pre>";
        print_r($result);
        echo "</pre>";
        exit();*/
        return $result['orders'];
    }
}

?>
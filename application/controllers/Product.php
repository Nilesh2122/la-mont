<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelProduct');
		$this->load->model('ModelCategories');
		$this->load->model('ModelStore');
	}
	public function index()
	{
		$result['product'] = $this->ModelProduct->manage_product();
		$this->load->view('header');
		$this->load->view('manage_product',$result);
		$this->load->view('footer');
	}
	public function addProduct()
	{
		$result['store'] = $this->ModelStore->manage_store();
		$result['categories'] = $this->ModelCategories->manage_categories();
		$this->load->view('header');
		$this->load->view('add_product',$result);
		$this->load->view('footer');
	}
	public function add_product_process()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category'),
			'store_id' => '1',
			'product_price' => $this->input->post('price'),
			'size' => $this->input->post('size'),
			'barcode' => $this->input->post('barcode'),
			'gst' => $this->input->post('gst'),
			'qty' => $this->input->post('quantity'),
			'active_state' => '1',
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelProduct->add_product_process($data);
		echo json_encode($response_data);
    }
    public function edit_product()
	{
		$product_id = $this->uri->segment(3);
		$result['product'] = $this->ModelProduct->edit_product($product_id);
		$result['store'] = $this->ModelStore->manage_store();
		$result['categories'] = $this->ModelCategories->manage_categories();
		$this->load->view('header');
		$this->load->view('edit_product',$result);
		$this->load->view('footer');  
	}
	public function edit_product_process()
	{
		$data = array(
			'product_id' => $this->input->post('product_id'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category'),
			'store_id' => '1',
			'product_price' => $this->input->post('price'),
			'size' => $this->input->post('size'),
			'barcode' => $this->input->post('barcode'),
			'qty' => $this->input->post('qty'),
			'active_state' => '1',
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelProduct->edit_product_process($data);
		echo json_encode($response_data);
    }
	public function delete_product()
	{
		$product_id = $this->uri->segment('3');
		$result = $this->ModelProduct->delete_product($product_id);
		redirect(base_url().'Product', 'refresh');	
	}
}

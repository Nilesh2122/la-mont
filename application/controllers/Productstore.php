<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productstore extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelProductstore');
		$this->load->model('ModelCategories');
		$this->load->model('ModelStore');
	}
	public function index()
	{
		$result['product'] = $this->ModelProductstore->manage_product();
		$this->load->view('header');
		$this->load->view('manage_product_store',$result);
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
		// echo "<pre>";
		// print_r($_FILES);
		// echo "</pre>";
		// exit();
		$data_img = [];
		$count = count($_FILES['images']['name']);
		for($i=0;$i<$count;$i++)
		{
			if(!empty($_FILES['images']['name'][$i]))
			{	
				$_FILES['file']['name'] = $_FILES['images']['name'][$i];
				$_FILES['file']['type'] = $_FILES['images']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['images']['error'][$i];
				$_FILES['file']['size'] = $_FILES['images']['size'][$i];
				$config['upload_path'] = 'assets/product_images/'; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
          		$config['max_size'] = 0; // max_size in kb
          		$config['file_name'] = $_FILES['images']['name'][$i];
          		$this->load->library('upload',$config); 
          		if($this->upload->do_upload('file'))
          		{
          			$uploadData = $this->upload->data();
          			$filename = $uploadData['file_name'];
          			$data_img['totalFiles'][] = $filename;
          		}
          	}
        }
		$data = array(
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category'),
			'store_id' => '1',
			'description' => $this->input->post('description'),
			'product_price' => $this->input->post('price'),
			'size' => $this->input->post('size'),
			'barcode' => $this->input->post('barcode'),
			'sku' => $this->input->post('sku'),
			'qty' => $this->input->post('quantity'),
			'active_state' => '1',
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelProduct->add_product_process($data,$data_img);
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
		$data_img = [];
		$count = count($_FILES['images']['name']);
		for($i=0;$i<$count;$i++)
		{
			if(!empty($_FILES['images']['name'][$i]))
			{	
				$_FILES['file']['name'] = $_FILES['images']['name'][$i];
				$_FILES['file']['type'] = $_FILES['images']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['images']['error'][$i];
				$_FILES['file']['size'] = $_FILES['images']['size'][$i];
				$config['upload_path'] = 'assets/product_images/'; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
          		$config['max_size'] = 0; // max_size in kb
          		$config['file_name'] = $_FILES['images']['name'][$i];
          		$this->load->library('upload',$config); 
          		if($this->upload->do_upload('file'))
          		{
          			$uploadData = $this->upload->data();
          			$filename = $uploadData['file_name'];
          			$data_img['totalFiles'][] = $filename;
          		}
          	}
        }
		$data = array(
			'product_id' => $this->input->post('product_id'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category'),
			'store_id' => $this->input->post('store'),
			'description' => $this->input->post('description'),
			'product_price' => $this->input->post('price'),
			'size' => $this->input->post('size'),
			'barcode' => $this->input->post('barcode'),
			'sku' => $this->input->post('sku'),
			'qty' => $this->input->post('qty'),
			'active_state' => '1',
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelProduct->edit_product_process($data,$data_img);
		echo json_encode($response_data);
    }
	public function delete_product()
	{
		$product_id = $this->uri->segment('3');
		$result = $this->ModelProduct->delete_product($product_id);
		redirect(base_url().'Product', 'refresh');	
	}
}

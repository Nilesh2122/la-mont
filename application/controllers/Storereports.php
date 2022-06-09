<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storereports extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelStorereports');
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('manage_store_reports');
		$this->load->view('footer');
	}
	public function products()
	{
		$result['product'] = $this->ModelStorereports->get_products_report();
		$this->load->view('header');
		$this->load->view('product_reports',$result);
		$this->load->view('footer');
		
		/*$filename = "Product_excel.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($productResult)) {
			foreach ($productResult as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();*/
	}
	public function categories()
	{
		$productResult = $this->ModelReports->get_categories_report();
		$filename = "categories_excel.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($productResult)) {
			foreach ($productResult as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();
	}
	public function warehouses()
	{
		$result['store'] = $this->ModelAdminreports->get_warehouses_report();
		$this->load->view('header');
		$this->load->view('warehouse_reports',$result);
		$this->load->view('footer');
		/*$filename = "warehouses_excel.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($productResult)) {
			foreach ($productResult as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();*/
	}
	public function sales()
	{
		$productResult = $this->ModelReports->get_sales_report();
		$filename = "sales_excel.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($productResult)) {
			foreach ($productResult as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();
	}

	public function edit()
	{
		$prod_price_id=$this->input->post('prod_price_id');
		$new_inventory=$this->input->post('new_inventory');
		$result=$this->ModelInventory->edit_row($prod_price_id,array("qty"=>$new_inventory));
		if($result){
			echo json_encode(array('message'=>'Inventory Updated Successfully','type'=>'success'));
		}else {
			echo json_encode(array('message'=>'Something went wrong','type'=>'warning'));
		}
	}
	public function add_store_process()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'category' => $this->input->post('category'),
			'location' => $this->input->post('location'),
			'owner' => $this->input->post('owner_name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'com' => $this->input->post('com'),
			'role' => 2,
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelStore->add_store_process($data);
		echo json_encode($response_data);
	}
	public function edit_store()
	{
		$store_id = $this->uri->segment(3);
		$result['store'] = $this->ModelStore->edit_store($store_id);
		$this->load->view('header');
		$this->load->view('edit_store',$result);
		$this->load->view('footer');
	}
	public function edit_store_process()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'category' => $this->input->post('category'),
			'location' => $this->input->post('location'),
			'owner' => $this->input->post('owner_name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelStore->edit_store_process($data);
		echo json_encode($response_data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelInventory');
	}
	public function index()
	{
		$result['product'] = $this->ModelInventory->manage_inventory();
		$this->load->view('header');
		$this->load->view('manage_inventory',$result);
		$this->load->view('footer');
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

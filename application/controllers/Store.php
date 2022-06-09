<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelStore');
		$this->load->model('ModelCategories');
	}
	public function index()
	{
		$result['store'] = $this->ModelStore->manage_store();
		$this->load->view('header');
		$this->load->view('manage_store',$result);
		$this->load->view('footer');
	}
	public function addStore()
	{
		$this->load->view('header');
		$this->load->view('add_store');
		$this->load->view('footer');
	}
	public function add_store_process()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'location' => $this->input->post('location'),
			'owner' => $this->input->post('owner_name'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'password' => base64_encode($this->input->post('password')),
			'com' => $this->input->post('com'),
			'state' => $this->input->post('group1'),
			'role' => 3,
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
			'location' => $this->input->post('location'),
			'owner' => $this->input->post('owner_name'),
			//'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'password' => base64_encode($this->input->post('password')),
			'com' => $this->input->post('com'),
			'state' => $this->input->post('group1'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelStore->edit_store_process($data);
		echo json_encode($response_data);
    }
    public function verify_password()
	{
		$data = array(
			'store_id' => $this->input->post('store_id'),
			'phone' => $this->input->post('phone'),
			'password' => base64_encode($this->input->post('password'))
		);
		$response_data =$this->ModelStore->verify_password($data);
		echo json_encode($response_data);
    }
    public function delete_store()
	{
		$store_id = $this->uri->segment('3');
		$result = $this->ModelStore->delete_store($store_id);
		redirect(base_url().'Store', 'refresh');	
	}
	public function enc()
	{
		$this->load->library('encrypt');
		$msg = 'My secret message';

		$encrypted_string = $this->encrypt->encode($msg);
		echo $encrypted_string;
	}
}

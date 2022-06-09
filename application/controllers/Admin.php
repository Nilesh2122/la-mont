<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelAdmin');
	}
	public function index()
	{
		$result['admin'] = $this->ModelAdmin->manage_admin();
		$this->load->view('header');
		$this->load->view('manage_admin',$result);
		$this->load->view('footer');
	}
    public function edit_admin()
	{
		$store_id = $this->uri->segment(3);
		$result['admin'] = $this->ModelAdmin->edit_admin($store_id);
		$this->load->view('header');
		$this->load->view('edit_admin',$result);
		$this->load->view('footer');
	}
	public function edit_admin_process()
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
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelAdmin->edit_admin_process($data);
		echo json_encode($response_data);
    }
    public function delete_store()
	{
		$store_id = $this->uri->segment('3');
		$result = $this->ModelStore->delete_store($store_id);
		redirect(base_url().'Store', 'refresh');	
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelAccount');
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function login_process()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'password' => base64_encode($this->input->post('password'))
		);
		$response_data =$this->ModelAccount->login_process($data);
		
		if($response_data)
		{
			if($response_data['status_code'] == 1)
			{
				$this->session->set_userdata(array(
					'id'  => $response_data['data']['id'],
					'name'  => $response_data['data']['name'],
					'email'  => $response_data['data']['email'],
					'role'  => $response_data['data']['role']
				));
			}
		}
		echo json_encode($response_data);	
	}
	public function profile()
	{
		$user_id = $this->session->userdata('id');
		$response_data = $this->ModelAccount->profile($user_id);
		/*echo "<pre>";
		print_r($response_data);
		echo "</pre>";
		exit();*/
		$this->load->view('header');
		$this->load->view('profile',$response_data);
		$this->load->view('footer');
	}
	public function edit_profile_process()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'location' => $this->input->post('location'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelAccount->edit_profile_process($data);
		echo json_encode($response_data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
}

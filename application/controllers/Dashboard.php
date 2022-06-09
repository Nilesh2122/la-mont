<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelDashboard');
	}
	public function index()
	{
		if (!$this->session->userdata('id'))
		{ 
			redirect(base_url(), 'refresh');
		} 
		$this->load->view('header');
       	if($this->session->userdata('role') == '1')
        {
        	$result = $this->ModelDashboard->superadmin_dashboard();
        	/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			exit();*/
        	$this->load->view('superadmin_dashboard',$result);
        }else if($this->session->userdata('role') == '2')
        {
        	$result = $this->ModelDashboard->admin_dashboard();
        	$this->load->view('admin_dashboard',$result);	
        }else{
        	$result = $this->ModelDashboard->warehouse_dashboard();
        	$this->load->view('warehouse_dashboard',$result);	
        }
		/**/
		$this->load->view('footer');
	}
}

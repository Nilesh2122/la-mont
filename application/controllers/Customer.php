<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelCustomer');
	}
	public function index()
	{
		$result['customer'] = $this->ModelCustomer->manage_customer();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";
		exit();*/
		$this->load->view('header');
		$this->load->view('manage_customer',$result);
		$this->load->view('footer');
	}
}

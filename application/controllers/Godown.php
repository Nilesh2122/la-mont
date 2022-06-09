<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Godown extends CI_Controller {
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
		$this->load->view('godown_product',$result);
		$this->load->view('footer');
	}
}

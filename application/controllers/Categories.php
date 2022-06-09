<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelCategories');
	}
	public function index()
	{
		$result['categories'] = $this->ModelCategories->manage_categories();
		$this->load->view('header');
		$this->load->view('manage_categories',$result);
		$this->load->view('footer');
	}
	public function addCategories()
	{
		$this->load->view('header');
		$this->load->view('add_categories');
		$this->load->view('footer');
	}
	public function add_category_process()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelCategories->add_category_process($data);
		echo json_encode($response_data);
    }
    public function edit_categories()
	{
		$categories_id = $this->uri->segment(3);
		$result['categories'] = $this->ModelCategories->edit_product($categories_id);
		$this->load->view('header');
		$this->load->view('edit_categories',$result);
		$this->load->view('footer');  
	}
	public function edit_category_process()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$response_data = $this->ModelCategories->edit_category_process($data);
		echo json_encode($response_data);
    }
    public function delete_category()
	{
		$category = $this->uri->segment('3');
		$result = $this->ModelCategories->delete_category($category);
		redirect(base_url().'Categories', 'refresh');	
	}
}

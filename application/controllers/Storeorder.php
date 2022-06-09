<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storeorder extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();	  
		$this->load->helper('form');		  
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelProductstore');
		$this->load->model('ModelStoreorder');
	}
	public function index()
	{
		$result['order'] = $this->ModelStoreorder->manage_store_order();
		/*echo "<pre>";
    	print_r($result);
    	echo "</pre>";
    	exit();*/
		$this->load->view('header');
		$this->load->view('manage_store_order',$result);
		$this->load->view('footer');
	}
	public function addorder()
	{
    	$this->data['products'] = $this->ModelStoreorder->manage_product();      	

    	/*echo "<pre>";
    	print_r($this->data);
    	echo "</pre>";
    	exit();*/
		$this->load->view('header');
		$this->load->view('add_store_order',$this->data);
		$this->load->view('footer');
	}
	public function fetch_product_qty()
	{
		$product_id = $this->input->post('product_id');
		$response_data = $this->ModelProductstore->edit_product($product_id);
		echo json_encode($response_data);
    }
	public function order_process()
	{
		$response_data = $this->ModelStoreorder->order_process();
		if($response_data['status_code'] == '1')
		{
			$phone = $response_data['phone'];
			$bill = $response_data['bill'];
			$item = $response_data['item'];
			$amount = $response_data['amount'];
			$name =  str_replace(' ','%20',$response_data['name']);
			$this->customer_bill_sms($phone,$bill,$name,$amount,$item);
		}
		echo json_encode($response_data);
	}
	public function customer_bill_sms($phone,$bill,$name,$amount,$item)
	{
		$details = "http://sms.pearlsms.com/public/sms/send?sender=DVYTRP&smstype=TRANS&numbers=".$phone."&apikey=b617ec3e3bc74a10a5d268ac41b10b01&message=Hello,%20".$name.",%20thank%20you%20for%20shopping%20with%20LA%20MONT%20perfumes.%20Here%27s%20your%20invoice%20for%20order%20".$bill."%20with%20".$item."%20items%20worth%20Rs%20".$amount."%20You%20can%20see%20invoice%20https://chiragkheni.com/assets/admin_bill/".$bill.".pdf%20Viste%20our%20instgram%20page%20https....%20DVYTRP";
		/*$details = "http://sms.pearlsms.com/public/sms/send?sender=DVYTRP&smstype=TRANS&numbers=".$phone."&apikey=b617ec3e3bc74a10a5d268ac41b10b01&message=Hello,%20".$name.",%20Order%20Invoice%20link%20-%20https://chiragkheni.com/assets/customer_bill/".$bill.".pdf%20DVYTRP";*/
		$json = file_get_contents($details);
		$details = json_decode($json, TRUE);
		//echo json_encode($details);
	}
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->ModelProductstore->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	public function getTableProductRow()
	{
		$products = $this->ModelProductstore->getActiveProductData();
		echo json_encode($products);
	}
	public function manage_product_all()
	{
		$products = $this->ModelStoreorder->manage_product_all();
		echo json_encode($products);
	}
	function GeneratePdf($id)
	{
		$result['order_data'] = $this->ModelStoreorder->getOrdersData($id);
		$result['orders_items'] = $this->ModelStoreorder->order_item_data($id);
		$result['order_date'] = date('d/m/Y', $result['order_data']['date_time']);
		$result['paid_status'] = ($result['order_data']['paid_status'] == 1) ? "Paid" : "Unpaid";
		$this->load->view('customer_bill_pdf',$result);
		/*$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->pdf->loadHtml($html);
		$this->pdf->render();
		$this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));*/
	}
	public function printDiv($id)
	{   
		if($id) {
			$result['order_data'] = $this->ModelStoreorder->getOrdersData($id);
			$result['orders_items'] = $this->ModelStoreorder->order_item_data($id);
			$result['order_date'] = date('d/m/Y', $result['order_data']['date_time']);
			$result['paid_status'] = ($result['order_data']['paid_status'] == 1) ? "Paid" : "Unpaid";
			
			$this->load->view('header');
			$this->load->view('invoice_print',$result);
			$this->load->view('footer');

			/*$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          La mont perfume
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>Bill ID:</b> '.$order_data['bill_no'].'<br>
			        <b>Customer:</b> '.$order_data['customer_name'].'<br>
			        <b>Address:</b> '.$order_data['customer_address'].' <br />
			        <b>Contact:</b> '.$order_data['customer_phone'].'
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped table-bordered">
			          <thead>
			          <tr>
			            <th>Product</th>
			            <th>Price</th>
			            <th>Qty</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->ModelProduct->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>$'.$v['rate'].'</td>
				            <td>'.$v['qty'].'</td>
				            <td>$'.$v['amount'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table table-striped">
			            <tr>
			              <th style="width:50%">Gross Amount:</th>
			              <td>$'.$order_data['gross_amount'].'</td>
			            </tr>';

			            if($order_data['service_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
				              <td>$'.$order_data['service_charge'].'</td>
				            </tr>';
			            }

			            if($order_data['vat_charge'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>$'.$order_data['vat_charge'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>$'.$order_data['discount'].'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>$'.$order_data['net_amount'].'</td>
			            </tr>
			            <tr>
			              <th>Bill Status:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;*/
		}
	}
	public function manage_store_return()
	{
		$this->data['returns'] = $this->ModelStoreorder->manage_store_return();
		/*echo "<pre>";
    	print_r($this->data);
    	echo "</pre>";
    	exit();*/
		$this->load->view('header');
		$this->load->view('manage_store_return',$this->data);
		$this->load->view('footer');	
	}
	public function add_return_order()
	{
		$this->data['products'] = $this->ModelStoreorder->manage_product_all();
		$this->load->view('header');
		$this->load->view('retun_store_order',$this->data);
		$this->load->view('footer');	
	}
	public function store_returns()
	{
        $response_data = $this->ModelStoreorder->store_returns();
		echo json_encode($response_data);
	}
	public function search_order_data()
	{
		$data = array(
            'bill_no' => $this->input->post('bill_no'),
            'customer_phone' => $this->input->post('customer_phone')
        );
        $response_data = $this->ModelStoreorder->search_order_data($data);
		//echo json_encode($response_data);
        
	}
}

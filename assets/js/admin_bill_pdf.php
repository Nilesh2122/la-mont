<?php
require_once( 'dompdf/autoload.inc.php' );
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$date = date('d-m-Y', $order_data['date_time']);
$time = date('h:i a', $order_data['date_time']);
$date_time = $date . ' ' . $time;
$coll = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style type="text/css">
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}
a {
  color: #5D6975;
  text-decoration: underline;
}
body{
  font-family: "Poppins", sans-serif;
}
header {
  padding: 10px 0;
  margin-bottom: 30px;
}
#logo {
  text-align: center;
  margin-bottom: 10px;
}
#logo img {
  width: 90px;
}
h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}
#project {
  float: right;
}
#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}
#company {
  float: left;
  text-align: left;
}
#project div,
#company div {
  white-space: nowrap;        
}
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}
table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}
        table th,
table td {
  text-align: center;
}
table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}
table .service,
table .desc {
  text-align: left;
}
table td {
  padding: 10px;
  text-align: right;
}
table td.service,
table td.desc {
  vertical-align: top;
}
table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}
table td.grand {
  border-top: 1px solid #5D6975;;
}
#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}
footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
</style>
  </head>
  <body>
    <header class="clearfix">
      <h1>INVOICE '.$order_data['bill_no'].'</h1>
      <div id="company" class="clearfix">
        <h3 style="color: #fc4b6c;">La Mont Perfume</h3>
        <div>Royal Arcade, G-47,<br /> Varachha Main Rd, Sarthana Jakat Naka,<br />Nana Varachha, <br/>Surat - 395006</div>
      </div>
      <div id="project">
        <h3>To,</h3>
        <div><span>CLIENT</span>'.$order_data['name'].'</div>
        <div><span>ADDRESS</span>'.$order_data['location'].'</div>
        <div><span>DATE</span>'.$date.'</div>
        <div><span>TIME</span>'.$time.'</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="desc">Description</th>
            <th>Quantity</th>
            <th>Unit Cost</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>';
          $i = 1;
          foreach ($orders_items as $row) {
          $coll .='<tr>
            <td class="service">'.$i.'</td>
            <td class="desc">'.$row['name'].'</td>
            <td class="unit">'.$row['qty'].'</td>
            <td class="qty">'.$row['rate'].'</td>
            <td class="total">'.$row['amount'].'</td>
          </tr>';
          $i++; 
          }
          $coll .='<tr>
            <td colspan="4">Sub - Total amount</td>
            <td class="total">'.$order_data['gross_amount'].'</td>
          </tr>
          <tr>
            <td colspan="4">service charge ('.$order_data['service_charge_rate'].'%) </td>
            <td class="total">'.$order_data['service_charge'].'</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">'.$order_data['net_amount'].'</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
$dompdf->loadHtml( $coll );
$dompdf->setPaper( 'A4', 'portrait' );
$dompdf->render();
ob_end_clean();
$output = $dompdf->output();
file_put_contents( 'assets/admin_bill/'.$order_data['bill_no'].'.pdf', $output );
$dompdf->stream( '11',array("Attachment"=>0));
?>
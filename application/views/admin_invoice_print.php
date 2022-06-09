
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Admin Order Invoice</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Adminorder">Admin Order</a></li>
                            <li class="breadcrumb-item active">Admin Order Invoice</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <h3><b>INVOICE</b> <span class="pull-right"><?php echo $order_data['bill_no']; ?></span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">La Mont Perfume</b></h3>
                                            <p class="text-muted m-l-5">Royal Arcade, G-47,
                                                <br/> Varachha Main Rd, Sarthana Jakat Naka,
                                                <br/> Nana Varachha,
                                                <br/> Surat - 395006</p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold"><?php echo $order_data['name']; ?></h4>
                                            <p class="text-muted m-l-30"><?php echo $order_data['location']; ?></p>
                                            <?php 
                                            $date = date('d-m-Y', $order_data['date_time']);
                                            $time = date('h:i a', $order_data['date_time']);
                                            $date_time = $date . ' ' . $time;
                                            ?>
                                            <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i><?php echo $date; ?></p>
                                            <p><b>Invoice Time :</b> <i class="fa fa-calendar"></i><?php echo $time; ?></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Description</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($orders_items as $row) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td class="text-right"><?php echo $row['qty']; ?> </td>
                                                    <td class="text-right"> <?php echo $row['rate']; ?> </td>
                                                    <td class="text-right"> <?php echo $row['amount']; ?> </td>
                                                </tr>
                                                <?php $i++; } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub - Total amount: <?php echo $order_data['gross_amount']; ?></p>
                                        <p>CGST (<?php echo $order_data['cgst_rate']; ?>%) : <?php echo $order_data['cgst']; ?> </p>
                                        <p>SGST (<?php echo $order_data['sgst_rate']; ?>%) : <?php echo $order_data['sgst']; ?> </p>
                                        <p>service charge (<?php echo $order_data['service_charge_rate']; ?>%) : <?php echo $order_data['service_charge']; ?> </p>
                                        <hr>
                                        <h3><b>Total :</b> <?php echo $order_data['net_amount']; ?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <button id="print" class="btn btn-info" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                © 2022 Admin by la mont perfume
            </footer>
        </div>
        
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo base_url(); ?>Adminproduct">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light"><?php echo $all_products; ?></h3>
                                <h5 class="text-muted m-b-0">Total Products</h5></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo base_url(); ?>Storeorder">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht">Rs. <?php echo $total_sale_customer; ?></h3>
                                <h5 class="text-muted m-b-0">Total Customer Sales</h5></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url(); ?>Storeorder/addorder"><button class="pull-right btn btn-success">Add Order</button></a>
                        <h4 class="card-title">Recent 5 Customer Orders</h4>
                        <div class="table-responsive m-t-20">
                            <table class="table stylish-table">
                                <thead>
                                    <tr>
                                        <th>Bill No.</th>
                                        <th>Customer Name</th>
                                        <th>Prod.Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($customer_orders as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['bill_no']; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $row['net_amount']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
        
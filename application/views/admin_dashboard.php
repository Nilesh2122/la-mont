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
                <a href="<?php echo base_url(); ?>Store">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht"><?php echo $all_store; ?></h3>
                                <h5 class="text-muted m-b-0">Total Warehouse</h5></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo base_url(); ?>Warehouseorder">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht"><?php echo $total_sale_warehouse; ?></h3>
                                <h5 class="text-muted m-b-0">Total Warehouse Sales</h5></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo base_url(); ?>Order">
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url(); ?>Adminorder/Warehouseorder"><button class="pull-right btn btn-success">Add Order</button></a>
                        <h4 class="card-title">Recent 5 Warehouse Orders</h4>
                        <div class="table-responsive m-t-20">
                            <table class="table stylish-table">
                                <thead>
                                    <tr>
                                        <th>Bill No.</th>
                                        <th>Store Name</th>
                                        <th>Prod.Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($orders as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['bill_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url(); ?>Adminorder/Order"><button class="pull-right btn btn-success">Add Order</button></a>
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
        
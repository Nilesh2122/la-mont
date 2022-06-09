<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Manage Warehouse Orders</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manage Warehouse orders</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
										<th>Bill No.</th>
                                        <th>Store Name</th>
                                        <th>DateTime</th>
                                        <th>Prod.Qty</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order as $row)
                                    {
                                        $date = date('d-m-Y', $row['date_time']);
                                        $time = date('h:i a', $row['date_time']);
                                        $date_time = $date . ' ' . $time;
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
										<td><?php echo $row['bill_no'];?></td>
                                        <td><?php echo $row['name']; ?></td>
										<td><?php echo $date_time; ?></td>
										<td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $row['net_amount'];?></td>
                                        <td>

                                            <a target="__blank" href="<?php echo base_url(); ?>Warehouseorder/printDiv/<?php echo $row['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                                        </td>
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
    <footer class="footer">  © 2022 Admin by la mont perfume </footer>
</div>
    

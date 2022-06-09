<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Manage Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manage Product</li>
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
										<th>Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
										<th>Qty</th>
										<th>Barcode</th>
                                        <th>Size</th>
                                        <th>Availability</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($product as $row)
                                    {?>
                                    <tr>
										<!-- <td><img src="<?php echo $row['image'];?>" width="100" height="100"></td> -->
                                        <td><?php echo $row['product_id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['product_price']; ?></td>
										<td><?php echo $row['qty']; ?></td>
										<td><?php echo $row['barcode']; ?></td>
                                        <td><?php echo $row['size'].' ML'; ?></td>
                                        <td><?php echo ($row['availability'] == 1) ? 'Active' : 'Inactive';?></td>
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
    

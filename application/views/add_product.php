
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Add Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form action="" id="add_product" method="Post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product Name</label>
                                            <input type="text" id="name" name="name" class="form-control">
                                            <small class="feedback-name"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control custom-select" id="category" name="category">
                                                <option value="0">Choose a Category</option>
                                                <?php
                                                foreach($categories as $row)
                                                {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <small class="feedback-category"> </small> 
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Product Price</label>
                                            <input type="text" id="price" name="price" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            <small class="feedback-price"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Qty</label>
                                            <input type="text" id="quantity" name="quantity" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            <small class="feedback-quantity"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
								<div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Barcode</label>
                                            <input type="text" id="barcode" name="barcode" class="form-control">
                                            <small class="feedback-barcode"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="form-group">
                                            <label class="control-label">SKU Code</label>
                                            <input type="text" id="sku" name="sku" class="form-control">
                                            <small class="feedback-sku"> </small> 
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label">Size</label>
                                            <select class="form-control custom-select" id="sie" name="size">
                                                <option value="0">Choose a ML</option>
                                                <option value="6">6 ML</option>
                                                <option value="50">50 ML</option>
                                                <option value="100">100 ML</option>
                                                <option value="250">250 ML</option>
                                            </select>
                                            <small class="feedback-size"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">GST %</label>
                                            <input type="text" id="gst" name="gst" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="1" maxlength="3">
                                            <small class="feedback-gst"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Size</label>
                                            <input type="text" id="size" name="size" class="form-control">
                                            <small class="feedback-size"> </small> 
                                        </div>
                                    </div> -->
                                    <!--/span-->
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Warehouse</label>
                                            <select class="form-control custom-select" id="store" name="store">
                                                <option value="0">Choose a Warehouse</option>
                                                <?php
                                                foreach($store as $row)
                                                {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <small class="feedback-store"> </small> 
                                        </div>
                                    </div> -->
                                </div>
                                <!--/row-->
                                
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
         © 2022 Admin by la mont perfume
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Edit Product</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Product</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form action="" id="edit_product" method="Post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" id="product_id" class="form-control" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <label class="control-label">Product Name</label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $product['Product_name']; ?>">
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
                                                <option value="<?php echo $row['id']; ?>" <?php echo ($product['category_id'] == $row['id']) ? 'Selected' : ''; ?>><?php echo $row['name']; ?></option>
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
                                            <input type="text" id="price" name="price" class="form-control" value="<?php echo $product['product_price']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            <small class="feedback-price"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Qty</label>
                                            <input type="text" id="qty" name="qty" class="form-control" value="<?php echo $product['qty']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            <small class="feedback-quantity"> </small> 
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Barcode</label>
                                            <input type="text" id="barcode" name="barcode" class="form-control" value="<?php echo $product['barcode']; ?>">
                                            <small class="feedback-barcode"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="form-group">
                                            <label class="control-label">SKU Code</label>
                                            <input type="text" id="sku" name="sku" class="form-control" value="<?php echo $product['sku']; ?>">
                                            <small class="feedback-sku"> </small> 
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label">Size</label>
                                            <select class="form-control custom-select" id="sie" name="size">
                                                <option value="0">Choose a ML</option>
                                                <option value="6" <?php echo ($product['size'] == '6') ? 'Selected' : ''; ?>>6 ML</option>
                                                <option value="50" <?php echo ($product['size'] == '50') ? 'Selected' : ''; ?>>50 ML</option>
                                                <option value="100" <?php echo ($product['size'] == '100') ? 'Selected' : ''; ?>>100 ML</option>
                                                <option value="250" <?php echo ($product['size'] == '250') ? 'Selected' : ''; ?>>250 ML</option>
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
                                            <input type="text" id="gst" name="gst" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="1" maxlength="3" value="<?php echo $product['gst']; ?>">
                                            <small class="feedback-gst"> </small> 
                                        </div>
                                    </div>
                                </div>
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
    <footer class="footer">
         © 2022 Admin by la mont perfume
    </footer>
</div>
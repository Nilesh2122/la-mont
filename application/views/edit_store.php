<style type="text/css">
    .toggle-password{
        position: absolute;
        right: 5%;
        bottom: 38%;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Edit Store</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Store</a></li>
                    <li class="breadcrumb-item active">Edit Store</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form action="" id="edit_store" method="Post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" id="id" class="form-control" name="id" value="<?php echo $store['id']; ?>">
                                            <label class="control-label">Store Name</label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $store['name']; ?>">
                                            <small class="feedback-name"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Location</label>
                                            <textarea class="form-control" id="location" name="location" rows="5"><?php echo $store['location']; ?></textarea>
                                            <small class="feedback-location"></small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Shop Owner Name</label>
                                            <input type="text" id="owner_name" name="owner_name" class="form-control" value="<?php echo $store['owner']; ?>">
                                            <small class="feedback-owner_name"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No.</label>
                                            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $store['phone']; ?>" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" minlength="10" maxlength="10">
                                            <small class="feedback-phone"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email Id</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $store['email']; ?>">
                                            <small class="feedback-email"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" value="<?php echo base64_decode($store['password']); ?>">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                            <small class="feedback-password"> </small> 
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Commission</label>
                                            <input type="text" id="com" name="com" class="form-control" value="<?php echo $store['com']; ?>" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" minlength="1" maxlength="3">
                                            <small class="feedback-com"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="control-label d-block mt-3">State</label>
                                            <input name="group1" type="radio" id="radio_1" <?php echo ($store['state'] == '0') ? 'checked' : ''; ?> value="0">
                                            <label for="radio_1">Gujarat</label>
                                            <input name="group1" type="radio" id="radio_2" <?php echo ($store['state'] == '1') ? 'checked' : ''; ?> value="1">
                                            <label for="radio_2">Out of Gujarat</label>
                                        </div>
                                    </div>
                                    <!--/span-->
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

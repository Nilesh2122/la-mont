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
                <h3 class="text-themecolor m-b-0 m-t-0">Add Store</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Store</a></li>
                    <li class="breadcrumb-item active">Add Store</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form action="" id="add_store" method="Post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Store Name</label>
                                            <input type="text" id="name" name="name" class="form-control">
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
                                            <textarea class="form-control" id="location" name="location" rows="5"></textarea>
                                            <small class="feedback-location"></small> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Shop Owner Name</label>
                                            <input type="text" id="owner_name" name="owner_name" class="form-control">
                                            <small class="feedback-owner_name"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No.</label>
                                            <input type="text" id="phone" name="phone" class="form-control" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" minlength="10" maxlength="10">
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
                                            <input type="email" id="email" name="email" class="form-control">
                                            <small class="feedback-email"> </small> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control">
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
                                            <input type="text" id="com" name="com" class="form-control" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" minlength="1" maxlength="3">
                                            <small class="feedback-com"> </small> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label class="control-label d-block mt-3">State</label>
                                            <input name="group1" type="radio" id="radio_1" checked="" value="0">
                                            <label for="radio_1">Gujarat</label>
                                            <input name="group1" type="radio" id="radio_2" value="1">
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

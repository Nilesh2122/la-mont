<style type="text/css">
.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: right;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Return Management </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Return Management </li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form role="form" id="search_order" method="post" class="form-horizontal">
                          <div class="box-body">

                            <div class="col-md-7 col-xs-12 pull">

                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Bill Number</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Enter Bill Number" autocomplete="off" />
                                </div>
                              </div>
                              <div class="form-group row" style="text-align: center;">
                                <div class="col-sm-5">
                                  <b>Or</b>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-3 control-label" style="text-align:left;">Phone Number</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Phone Number" autocomplete="off">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-xs-12 pull">

                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-success">Search</button>
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

<script type="text/javascript">
$('#search_order').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Storeorder/search_order_data", 
        method:"POST",
        dataType : "json",
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() 
        {
            $('.submit-btn').css('display','none');
            $('.loading-btn').css('display','block');
        },
        success:function(json)
        {
            console.log(json);
            //swal("Success!", "Supplier added sucessfully.", "success")
            if(json.status_code == '1')
            {
                swal({
                  title: "Success!",
                  text: json.message,
                  type: "success",
                  confirmButtonText: "OK"
                }).then(function(isConfirm) 
                {
                  if (isConfirm) 
                  {
                     //window.location.href = base_url+"Order";
                     window.location.href = base_url+"Storeorder/GeneratePdf/"+json.data;
                  }
                });
            }
            else
            {
                swal({
                  title: "Errors!",
                  text: json.message,
                  type: "error",
                  confirmButtonText: "OK"
                }).then(function(isConfirm) 
                {
                  if (isConfirm) 
                  {
                    location.reload(true);
                  }
                });
            }
            
            //
        },
        complete: function() 
        {
            $('.submit-btn').css('display','inline');
            $('.loading-btn').css('display','none');         
        }
    });
});
</script>
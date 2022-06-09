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
                <h3 class="text-themecolor m-b-0 m-t-0">Returns Management</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Returns Management</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form role="form" id="returns_form" method="post" class="form-horizontal">
                          <div class="box-body">
                            <div class="col-md-7 col-xs-12 pull">
                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Client Name</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Client Name" autocomplete="off" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Client Phone</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Client Phone" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Bill No</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Enter Bill No" autocomplete="off" required>
                                </div>
                              </div>
                            </div>
                            
                            <table class="table table-bordered" id="product_info_table">
                              <thead>
                                <tr>
                                  <th style="width:50%">Product</th>
                                  <th style="width:10%">Qty</th>
                                  <th style="width:10%"><button type="button" id="add_row" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                                </tr>
                              </thead>

                               <tbody>
                                 <tr id="row_1">
                                   <td>
                                    <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;"  required>
                                        <option value=""></option>
                                        <?php foreach ($products as $k): ?>
                                          <option value="<?php echo $k['product_id'] ?>"><?php echo $k['name'].'-'.$k['barcode']; ?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </td>
                                    <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                                    
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                                 </tr>
                               </tbody>
                            </table>

                            <br /> <br/>

                            <div class="col-md-6 col-xs-12 pull">

                             <div class="form-group row">
                                <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Reasons for a Product Return</label>
                                <div class="col-sm-7">
                                  <textarea type="text" class="form-control" id="reasons" name="reasons" placeholder="Enter Reasons" autocomplete="off" required></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-success">Add</button>
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
$(document).ready(function() {
    $(".select_group").select2();
    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>';
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + 'Storeorder/manage_product_all/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
            //  console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.product_id+'">'+value.name+'-'+value.barcode+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });
});

function removeRow(tr_id)
{
    $("#product_info_table tbody tr#row_"+tr_id).remove();
}
$('#returns_form').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Order/admin_returns", 
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
                     window.location.href = base_url+"Order/manage_admin_return";
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
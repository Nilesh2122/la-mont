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
                <h3 class="text-themecolor m-b-0 m-t-0">Add Warehouse Orders </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
                    <li class="breadcrumb-item active">Add Warehouse Orders </li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-body">
                        <form role="form" id="add_order" method="post" class="form-horizontal">
                          <div class="box-body">

                            <?php echo validation_errors(); ?>
                            <table class="table table-bordered" id="product_info_table">
                              <thead>
                                <tr>
                                  <th style="width:50%">Product</th>
                                  <th style="width:10%">Qty</th>
                                  <th style="width:10%">Rate</th>
                                  <th style="width:20%">Amount</th>
                                  <th style="width:10%"><button type="button" id="add_row" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                                </tr>
                              </thead>

                               <tbody>
                                 <!-- <tr id="row_1">
                                   <td>
                                    <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                                        <option value=""></option>
                                        <?php foreach ($products as $k): ?>
                                          <option value="<?php echo $k['product_id'] ?>"><?php echo $k['name'].'-'.$k['barcode']; ?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </td>
                                    <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                                    <td>
                                      <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off">
                                      <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                                    </td>
                                    <td>
                                      <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                                      <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                                 </tr> -->
                               </tbody>
                            </table>

                            <br /> <br/>

                            <div class="col-md-6 col-xs-12 pull">

                              <div class="form-group row">
                                <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                                </div>
                              </div>

                              <?php if($company_data['state'] == '0'){?>
                              <div class="form-group row">
                                <label for="vat_charge" class="col-sm-5 control-label">CGST <?php echo $company_data['cgst'] ?>%</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="cgst" name="cgst" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="cgst_value" name="cgst_value" autocomplete="off">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="vat_charge" class="col-sm-5 control-label">SGST <?php echo $company_data['sgst'] ?>%</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="sgst" name="sgst" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="sgst_value" name="sgst_value" autocomplete="off">
                                </div>
                              </div>
                              <?php }else{
                              ?>
                              <div class="form-group row">
                                <label for="vat_charge" class="col-sm-5 control-label">IGST <?php echo $company_data['igst'] ?>%</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="igst" name="igst" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="igst_value" name="igst_value" autocomplete="off">
                                </div>
                              </div>
                              <?php  
                              } ?>
                              <?php if($is_service_enabled == true): ?>
                              <div class="form-group row">
                                <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
                                </div>
                              </div>
                              <?php endif; ?>

                              
                              <div class="form-group row">
                                <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                                <div class="col-sm-7">
                                  <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                                  <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                                </div>
                              </div>

                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                            <input type="hidden" name="cgst_rate" value="<?php echo $company_data['cgst'] ?>" autocomplete="off">
                            <input type="hidden" name="sgst_rate" value="<?php echo $company_data['sgst'] ?>" autocomplete="off">
                            <input type="hidden" name="igst_rate" value="<?php echo $company_data['igst'] ?>" autocomplete="off">

                            <input type="hidden" name="store_id" value="<?php echo $this->uri->segment(3); ?>">
                            <button type="submit" class="btn btn-success">Create Order</button>
                            <a href="<?php echo base_url('Warehouseorder/') ?>" class="btn btn-danger">Back</a>
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
          url: base_url + 'Warehouseorder/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
            //  console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.product_id+'">'+value.name+' - '+value.size+'ML - '+value.barcode+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
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
/*function getTotal(row = null) 
{
    if(row) {
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
}*/
function getTotal(row = null) 
{
  var product_id = $("#product_"+row).val();   
  var type_qty = $("#qty_"+row).val();
  $.ajax({
      type: "POST",
      dataType : "json",
      url: base_url + 'Warehouseorder/fetch_product_qty',    
      data: "product_id="+encodeURIComponent(product_id), 
      success: function(json)
      {
        qty = parseInt(json.qty);
        if(type_qty <= qty)
        {
            if(row) {
              var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
              total = total.toFixed(2);
              $("#amount_"+row).val(total);
              $("#amount_value_"+row).val(total);
              
              subAmount();

            } else {
              alert('no row !! please refresh the page');
            }
        }
        else
        {
          alert("use less than "+qty+" quality");
        }
      }
  });
}

function getProductData(row_id)
{
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Warehouseorder/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          console.log(response);
          $("#rate_"+row_id).val(response.product_price);
          $("#rate_value_"+row_id).val(response.product_price);

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.product_price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
}
function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var cgst = <?php echo ($company_data['cgst'] > 0) ? $company_data['cgst']:0; ?>;
    var sgst = <?php echo ($company_data['sgst'] > 0) ? $company_data['sgst']:0; ?>;
    var igst = <?php echo ($company_data['igst'] > 0) ? $company_data['igst']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var cgst = (Number($("#gross_amount").val())/100) * cgst;
    cgst = cgst.toFixed(2);
    $("#cgst").val(cgst);
    $("#cgst_value").val(cgst);

    var sgst = (Number($("#gross_amount").val())/100) * sgst;
    sgst = sgst.toFixed(2);
    $("#sgst").val(sgst);
    $("#sgst_value").val(sgst);

    var igst = (Number($("#gross_amount").val())/100) * igst;
    igst = igst.toFixed(2);
    $("#igst").val(igst);
    $("#igst_value").val(igst);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(cgst) + Number(sgst) + Number(igst) - Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
    } // /else discount 
}
function removeRow(tr_id)
{
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
}
$('#add_order').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Warehouseorder/order_process", 
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
                     window.location.href = base_url+"Warehouseorder/GeneratePdf/"+json.data;
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
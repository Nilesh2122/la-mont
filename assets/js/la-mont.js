$(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).ready(function() {
    $('#example23').DataTable({
        order: [[ 0, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $("#print").click(function() {
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("div.printableArea").printArea(options);
    });
});
var base_url = $('#base_url').val();
$('#edit_admin').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Admin/edit_admin_process", 
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
                    window.location.href = base_url+"Admin";
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
        },
        complete: function() 
        {
            $('.submit-btn').css('display','inline');
            $('.loading-btn').css('display','none');         
        }
    });
});
$('#add_product').on('submit', function(e)
{
    var name = document.getElementById('name').value;
    var category = document.getElementById('category').value;
    var price = document.getElementById('price').value;
    var quantity = document.getElementById('quantity').value;
    if(name=='')
    {
        $('.feedback-name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#name').focus();
        return false;
    }
    /*else if(category != '0')
    {
        $('.feedback-category').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#category').focus();
        return false;
    }*/
    else if(price=='')
    {
        $('.feedback-price').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#price').focus();
        return false;
    }
    else if(quantity=='')
    {
        $('.feedback-quantity').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#quantity').focus();
        return false;
    }
    else
    {   
        e.preventDefault();
        $.ajax({
            url: base_url+"Product/add_product_process", 
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
                         window.location.href = base_url+"Product";
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
    }
});
$('#edit_product').on('submit', function(e)
{
    var name = document.getElementById('name').value;
    var category = document.getElementById('category').value;
    var price = document.getElementById('price').value;
    var quantity = document.getElementById('qty').value;
    if(name=='')
    {
        $('.feedback-name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#name').focus();
        return false;
    }
    else if(price=='')
    {
        $('.feedback-price').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#price').focus();
        return false;
    }
    else if(quantity=='')
    {
        $('.feedback-quantity').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#quantity').focus();
        return false;
    }
    else
    {   
        e.preventDefault();
        $.ajax({
            url: base_url+"Product/edit_product_process", 
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
                        window.location.href = base_url+"Product";
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
    }
});
function delete_poduct(e)
{
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function(isConfirm) 
            {
        if (isConfirm.value == true) 
        {
            window.location.href =  base_url+"Product/delete_product/"+e;
        }
        else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}
$('#add_category').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Categories/add_category_process", 
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
                    window.location.href = base_url+"Categories";
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
$('#edit_category').on('submit', function(e)
{
    e.preventDefault();
    $.ajax({
        url: base_url+"Categories/edit_category_process", 
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
                     window.location.href = base_url+"Categories";
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
function delete_category(e)
{
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function(isConfirm) 
            {
        if (isConfirm.value == true) 
        {
            window.location.href =  base_url+"Categories/delete_category/"+e;
        }
        else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}
$('#add_store').on('submit', function(e)
{
    var name = document.getElementById('name').value;
    var location = document.getElementById('location').value;
    var owner_name = document.getElementById('owner_name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var comission = document.getElementById('com').value;
    if(name=='')
    {
        $('.feedback-name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#name').focus();
        return false;
    }
    else if(location=='')
    {
        $('.feedback-location').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#location').focus();
        return false;
    }
    else if(owner_name=='')
    {
        $('.feedback-owner_name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#owner_name').focus();
        return false;
    }
    else if(phone=='')
    {
        $('.feedback-phone').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#phone').focus();
        return false;
    }
    else if(email=='')
    {
        $('.feedback-email').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#email').focus();
        return false;
    }
    else if(password=='')
    {
        $('.feedback-password').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#password').focus();
        return false;
    }
    else if(comission=='')
    {
        $('.feedback-comission').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#comission').focus();
        return false;
    }
    else
    {   
        e.preventDefault();
        $.ajax({
            url: base_url+"Store/add_store_process", 
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
                        window.location.href = base_url+"Store";
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
                        $('#email').focus();
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
    }
});
$('#edit_store').on('submit', function(e)
{
    var name = document.getElementById('name').value;
    var location = document.getElementById('location').value;
    var owner_name = document.getElementById('owner_name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    if(name=='')
    {
        $('.feedback-name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#name').focus();
        return false;
    }
    else if(location=='')
    {
        $('.feedback-location').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#location').focus();
        return false;
    }
    else if(owner_name=='')
    {
        $('.feedback-owner_name').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#owner_name').focus();
        return false;
    }
    else if(phone=='')
    {
        $('.feedback-phone').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#phone').focus();
        return false;
    }
    else if(email=='')
    {
        $('.feedback-email').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#email').focus();
        return false;
    }
    else if(password=='')
    {
        $('.feedback-password').html("This is a required field.").fadeIn().delay(3000).fadeOut();
        $('#password').focus();
        return false;
    }
    else
    {   
        e.preventDefault();
        $.ajax({
            url: base_url+"Store/edit_store_process", 
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
                        window.location.href = base_url+"Store";
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
    }
});
function delete_store(e)
{
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function(isConfirm) 
            {
        if (isConfirm.value == true) 
        {
            window.location.href =  base_url+"Store/delete_store/"+e;
        }
        else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

$('#edit_profile').on('submit', function(e)
{   
    e.preventDefault();
    $.ajax({
        url: base_url+"Account/edit_profile_process", 
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
                     window.location.href = base_url+"account/profile";
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

$(".inventory_container").change(function(){
    var prod_price_id= $(this).attr('data-prod_price_id');
    var new_inventory=$(this).val();
    var param={prod_price_id:prod_price_id,new_inventory:new_inventory};
    $.ajax({
        type: "POST",
        dataType : "json",
        url: base_url+"inventory/edit",  
        data: "prod_price_id="+encodeURIComponent(prod_price_id)+"&new_inventory="+encodeURIComponent(new_inventory), 
        success:function(json)
        {
            console.log(json);
            //swal("Success!", "Supplier added sucessfully.", "success")
            if(json.type == 'success')
            {
                swal({
                  title: "Success!",
                  text: json.message,
                  type: "success",
                  confirmButtonText: "OK"
                });
            }
            else
            {
                swal({
                  title: "Error!",
                  text: json.message,
                  type: "error",
                  confirmButtonText: "OK"
                });
            }
        }
    });
});

function verify_password(e) {
    
    var a=$('#verify_password_'+e).serialize();
    console.log(a);
    $.ajax({
        url: base_url+"Store/verify_password", 
        method:"POST",
        dataType : "json",
        data:a,
        cache: false,
        beforeSend: function() 
        {
            $('.submit-btn').css('display','none');
            $('.loading-btn').css('display','block');
        },
        success:function(json)
        {
            console.log(json);
            console.log(json.success);
            if(json.status_code == 1)
            {
                $('#verify_password_'+e).hide();
                $('#show_password_'+e).text(json.data);
            }
            else
            {
                $('.feedback-name').html(json.message).fadeIn().delay(3000).fadeOut();
            }
        },
        complete: function() 
        {
            $('.submit-btn').css('display','inline');
            $('.loading-btn').css('display','none');         
        }
    });
}
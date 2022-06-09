<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Manage Store</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manage Store</li>
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
                                        <th>Store Name</th>
                                        <th>Owner Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Commission %</th>
                                        <th>Action</th>
                                        <th>Order</th>
                                        <th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($store as $row)
                                    {?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['owner']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php echo $row['com']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>Store/edit_store/<?php echo $row['id'];?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a onclick="delete_store(<?php echo $row['id']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                             <a href="<?php echo base_url(); ?>Warehouseorder/addwarehouseorder/<?php echo $row['id'];?>"><button type="button" class="btn btn-info btn-circle"><i class="fa fa-plus"></i> </button></a>
                                        </td>
                                        <td><i style="cursor: pointer;" class="fa fa-lock" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $row['id'];?>"></i>
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
    <?php foreach($store as $row)
    {?>
    <div class="modal fade" id="exampleModalCenter-<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $row['name']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="Post" action="" id="verify_password_<?php echo $row['id'];?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number</label>
                    <input type="hidden" name="store_id" value="<?php echo $row['id'];?>">
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="10" maxlength="10">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" >
                </div>
                <p class="feedback-name"> </p> 
                <button type="button" class="btn btn-primary" onClick='verify_password(<?php echo $row['id'];?>)'>Submit</button>
            </form>
            <div id="show_password_<?php echo $row['id'];?>">
                
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <footer class="footer">  © 2022 Admin by la mont perfume </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
    

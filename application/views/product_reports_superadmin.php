<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Product Report</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Product Report</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label>Date : </label>
                        <input type="text" class="form-control" style="width: 25%;" name="daterange"/>
                        
                        <select class="form-control custom-select" style="width: 25%" tabindex="1" onchange="getval_swirlask(this);">
                            <option value="">Select Dates</option>
                            <?php
                            for ($i_month = 1; $i_month <= 3; $i_month++) 
                            { 
                                $selected = '';
                                if(isset($_GET['dates']))
                                {
                                    $selected = ($this->input->get('dates') == $i_month ? ' selected' : '');
                                }
                                else
                                {
                                    $selected = '';
                                }
                                if($i_month == '1'){
                                    $txt = 'Today';
                                }else if($i_month == '2'){
                                    $txt = 'Last 1 month';
                                }
                                else if($i_month == '3'){
                                    $txt = 'Last 3 month';
                                }
                                echo '<option value="'.$i_month.'"'.$selected.'>'.$txt.'</option>'."\n";
                            }
                            ?>
                        </select>
                        <button type="button" class="btn waves-effect waves-light btn-danger ml-3" onclick="reset()">Reset</button>
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
                                        <th>Date</th>
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
										<td><?php echo ($row['qty'] == 0) ? 'Out of Stock' : $row['qty'];?></td>
										<td><?php echo $row['barcode']; ?></td>
                                        <td><?php echo $row['size'].' ML'; ?></td>
                                        <td><?php echo $row['created_date']; ?></td>
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
<script>
    function reset() {
        var url = '<?php echo base_url();?>Reports/products'; 
        window.location = url;
    }
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
        }, function(start, end, label) {
        start = start.format('YYYY-MM-DD');
        end = end.format('YYYY-MM-DD');
        var url = '<?php echo base_url();?>Reports/products?from='+start+'&to='+end; 
        window.location = url;
        console.log("A new date selection was made: " + start + ' to ' + end.format('YYYY-MM-DD'));
    });
    function getval_swirlask(sel)
    {
        url1 = sel.value;
        if(url1 != '0')
        {
          var url = '<?php echo base_url(); ?>Reports/products?dates='+url1; 
          window.location = url;
        }
        else
        {
          var url = '<?php echo base_url(); ?>Reports/products'; 
          window.location = url;
        }
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/main-logo.png">
    <title>La mont perfume Admin panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/image-uploader.min.css">
    <link href="<?php echo base_url();?>assets/css/sweetalert.css" rel="stylesheet" type="text/css">
</head>
<?php
$role_id = $this->session->userdata['role'];
?>
<body class="fix-header fix-sidebar card-no-border">
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="<?php echo base_url(); ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/main-logo.png" alt="homepage" class="light-logo" style="width: 50%;" />
                           
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <!-- <img src="<?php echo base_url(); ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
                         <!-- Light Logo text -->    
                        <!--  <img src="<?php echo base_url(); ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> --></span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box">
                            <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $this->session->userdata['name']; ?></h4>
                                                <p class="text-muted"><?php echo $this->session->userdata['email']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>account/profile"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url();?>Account/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Dashboard" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                           
                        </li>
                        <?php
                        if($role_id == 1)
                        {
                        ?>
                        <li> <a class="" href="<?php echo base_url(); ?>Admin" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Admin</span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Category</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Categories/addCategories">Add Category</a></li>
                                <li><a href="<?php echo base_url(); ?>Categories">Manage Category</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Products</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Product/addProduct">Add Product</a></li>
                                <li><a href="<?php echo base_url(); ?>Product">Manage Product</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Admin Orders</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Adminorder/addadminorder">Add Admin Order</a></li>
                                <li><a href="<?php echo base_url(); ?>Adminorder">Manage Admin Orders</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Inventory" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Product Inventory</span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Reports" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Product Report</span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Customer" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">All Customer</span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Adminorder/manage_admin_return" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Returns Management</span></a>
                        </li>
                        <?php }else if($role_id == 2){ ?>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Godown" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Godown product</span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Adminproduct" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Product</span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Warehouse</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Store/addStore">Add Warehouse</a></li>
                                <li><a href="<?php echo base_url(); ?>Store">Manage Warehouse</a></li>
                                <li><a href="<?php echo base_url(); ?>Warehouseorder">Warehouse Orders</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Customer Orders</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Order/addorder">Add Order</a></li>
                                <li><a href="<?php echo base_url(); ?>Order">Manage Orders</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Adminreports" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Reports</span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Returns Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Order/add_return_order_admin">Add Returns</a></li>
                                <li><a href="<?php echo base_url(); ?>Order/manage_admin_return">Returns Management</a></li>
                            </ul>
                        </li>
                        <?php }else{
                            ?>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Productstore" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Manage Product</span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Orders</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Storeorder/addorder">Add Order</a></li>
                                <li><a href="<?php echo base_url(); ?>Storeorder">Manage Orders</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url(); ?>Storereports" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Reports</span></a>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Returns Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Storeorder/add_return_order">Add Returns</a></li>
                                <li><a href="<?php echo base_url(); ?>Storeorder/manage_store_return">Returns Management</a></li>
                            </ul>
                        </li>
                        <?php
                        } ?> 
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <a href="<?php echo base_url();?>Account/logout" class="link" data-toggle="tooltip" title="Logout" style="width: 100%;"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
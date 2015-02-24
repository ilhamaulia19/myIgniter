<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keyword" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="description" content="Custom Framework Codeigniter and bootstrap">
    <meta name="author" content="Asrul Hanafi">
    
    <!--GroceryCRUD CSS-->
    <?php if (isset($css_files)) {
    foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; } ?>

	<!--Bootstrap-->
    <title><?php echo $title ?></title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/alertify.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/default.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/a-design.css') ?>" rel="stylesheet">
    <!--Font-->
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--GroceryCRUD JS-->
    <?php if (isset($js_files)) { foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; } else { ?>
    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script> 
    <?php } ?>       
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index"><?php echo $title ?></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo  $this->ion_auth->user()->row()->username ?></a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo  site_url('auth/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" id="search-menu" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Grocery Crud <span class="fa arrow fa-fw"></span></b></a>
                    <ul class="nav nav-second-level">
                        <li><a href='<?php echo  site_url('crud/offices_management')?>'>Offices</a></li>
                        <li><a href='<?php echo  site_url('crud/employees_management')?>'>Employees</a></li>
                        <li><a href='<?php echo  site_url('crud/customers_management')?>'>Customers</a></li>
                        <li><a href='<?php echo  site_url('crud/orders_management')?>'>Orders</a></li>
                        <li><a href='<?php echo  site_url('crud/products_management')?>'>Products</a></li>
                        <li><a href='<?php echo  site_url('crud/film_management')?>'>Films</a></li>                 
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-lock fa-fw"></i> Auth <span class="fa arrow fa-fw"></span></b></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo  site_url('crud/users')?>">Users</a></li>
                        <li><a href="<?php echo  site_url('crud/users_groups')?>">Users Groups</a></li>
                        <li><a href="<?php echo  site_url('crud/groups')?>">Groups</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>


<!-- Page Content -->
<div id="page-wrapper">
    <?php echo $page ?>
</div>
<!-- /#page-wrapper -->

<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sb-admin-2.js') ?>"></script>
<script src="<?php echo base_url('assets/js/alertify.min.js') ?>"></script>
<script>
    var site = '<?= site_url(); ?>';
    var ur_class = '<?= $this->uri->segment(1); ?>';
    var url_function = '<?= $this->uri->segment(2); ?>';
</script>
<script src="<?php echo base_url('assets/js/a-design.js') ?>"></script>
</body>
</html>
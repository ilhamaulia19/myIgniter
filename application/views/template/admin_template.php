<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keyword" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="description" content="Custom Framework Codeigniter and bootstrap">
    <meta name="author" content="Asrul Hanafi">
    <title><?php echo $title ?></title>
    
    <!--GroceryCRUD CSS-->
    <?php if (isset($css_files)) : ?>
        <?php foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
    <?php endif ?>

	<!--Bootstrap-->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!--Font-->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!--AdminLTE-->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>" rel="stylesheet">
    <!--Alertify-->
    <link href="<?php echo base_url('assets/css/alertify.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/default.min.css') ?>" rel="stylesheet">
    <!--CSS PLUGINS-->
    <?php if (isset($css_plugins)): ?>
        <?php foreach ($css_plugins as $url_plugin): ?>
            <link href="<?php echo base_url("$url_plugin") ?>" rel="stylesheet">
        <?php endforeach ?>
    <?php endif ?>
    <!--Custom CSS-->
    <link href="<?php echo base_url('assets/css/a-design.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- GroceryCRUD JS -->
    <?php if (isset($js_files)) { foreach($js_files as $file): ?> 
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; } else { ?>
        <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>             
    <?php } ?>       
    <!--JS Plugins-->
    <?php if (isset($js_plugins)): ?>
        <?php foreach ($js_plugins as $url_plugin): ?>
            <script src="<?php echo base_url("$url_plugin") ?>"></script>                
        <?php endforeach ?>
    <?php endif ?>      
</head>
<body class="skin-green fixed">
<!-- Site wrapper -->
<div class="wrapper">  
    <header class="main-header">
        <a href="<?php echo site_url('crud/index') ?>" class="logo"><b>My</b>Igniter</a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo  $this->ion_auth->user()->row()->username ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url('crud/users/read').'/'.$this->ion_auth->user()->row()->id ?>"><i class="fa fa-user fa-fw"></i> Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo  site_url('auth/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="<?php echo site_url('crud/index') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-table fa-fw"></i> Grocery Crud <i class="fa fa-angle-left pull-right"></i></b></a>
                    <ul class="treeview-menu">
                        <li><a href='<?php echo  site_url('crud/offices_management')?>'><i class="fa fa-circle-o"></i> Offices</a></li>
                        <li><a href='<?php echo  site_url('crud/employees_management')?>'><i class="fa fa-circle-o"></i> Employees</a></li>
                        <li><a href='<?php echo  site_url('crud/customers_management')?>'><i class="fa fa-circle-o"></i> Customers</a></li>
                        <li><a href='<?php echo  site_url('crud/orders_management')?>'><i class="fa fa-circle-o"></i> Orders</a></li>
                        <li><a href='<?php echo  site_url('crud/products_management')?>'><i class="fa fa-circle-o"></i> Products</a></li>
                        <li><a href='<?php echo  site_url('crud/film_management')?>'><i class="fa fa-circle-o"></i> Films</a></li>                 
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-lock fa-fw"></i> Ion Auth <i class="fa fa-angle-left pull-right"></i></b></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo  site_url('crud/users')?>"><i class="fa fa-circle-o"></i> Users</a></li>
                        <li><a href="<?php echo  site_url('crud/users_groups')?>"><i class="fa fa-circle-o"></i> Users Groups</a></li>
                        <li><a href="<?php echo  site_url('crud/groups')?>"><i class="fa fa-circle-o"></i> Groups</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title ?>
          </h1>
          <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('crud/index') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <?php if ($this->uri->segment(3)){ ?>
                <li>
                    <a href="<?php echo site_url().'/'.$this->uri->segment(1).'/'.$this->uri->segment(2) ?>" title=""><?php echo $this->uri->segment(2) ?></a>
                </li>
                <li>
                    <?php echo $this->uri->segment(3) ?>
                </li> 
            <?php }else{ ?>
                <li class="active">
                    <?php echo $this->uri->segment(2) ?>
                </li>                     
            <?php } ?> 
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <?php echo $page ?>
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 3.0  
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">Asrul Hanafi</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->
<!--Bootstrap JS-->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<!--Alertify JS-->
<script src="<?php echo base_url('assets/js/alertify.min.js') ?>"></script>
<!--AdminLTE JS-->
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimScroll.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
<script>
    var site = '<?= site_url(); ?>';
    var ur_class = '<?= $this->uri->segment(1); ?>';
    var url_function = '<?= $this->uri->segment(2); ?>';
</script>
<!--Custom JS-->
<script src="<?php echo base_url('assets/js/a-design.js') ?>"></script>
</body>
</html>
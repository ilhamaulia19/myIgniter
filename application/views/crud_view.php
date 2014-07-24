<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="author" content="Asrul Hanafi">
	<!--GroceryCRUD-->
	<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
	<?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	<!--Bootstrap-->
    <title>myIgniter</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-theme.min.css') ?>" rel="stylesheet">
    <!--Font-->
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
<!-- Beginning header -->
<div class="navbar navbar-default navbar-static-top">
	<div class="container">
			<a href="<?php echo site_url('crud'); ?>" class="navbar-brand">myIgniter</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		<div class="navbar-collapse collapse" id="navbar-main">
		<center>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#">myIgniter</a></li>
			<li class = "dropdown">
            	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Examples <b class = "caret"></b></a>
					<ul class = "dropdown-menu">
						<li><a href='<?php echo site_url('crud/offices_management')?>'>Offices</a></li>
						<li><a href='<?php echo site_url('crud/employees_management')?>'>Employees</a></li>
						<li><a href='<?php echo site_url('crud/customers_management')?>'>Customers</a></li>
						<li><a href='<?php echo site_url('crud/orders_management')?>'>Orders</a></li>
						<li><a href='<?php echo site_url('crud/products_management')?>'>Products</a></li>
						<li><a href='<?php echo site_url('crud/film_management')?>'>Films</a></li>
						<li><a href='<?php echo site_url('crud/multigrids')?>'>Multigrid [BETA]</a></li>
					</ul>
			</li>
			<li class = "dropdown">
            	<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown"><?php echo $data['username']; ?> <b class = "caret"></b></a>
					<ul class = "dropdown-menu">
						<li><a href="<?php echo site_url('crud/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
			</ul>
		</center>
		</div>
	</div>
</div>
<!-- End of header-->
<div class="container">
<!---Container--->
<div class="row">
	<div class="col-md-12 text-center">
		<div class="jumbotron">
			<h1><i class="fa fa-cogs"></i> myIgniter</h1>
				<p>myIgniter is a custom PHP framework for web developer. 
				Combined between Codeigniter with Bootstrap and fontawesome User Interface,
				include auto PHP GroceryCRUD for create table with Create-Read-Update-Delete and simple authentication system.
				</p>
				<p>
				<a href="" class="btn btn-primary btn-lg"><i class="fa fa-download"></i> Download myIgniter</a>
				<a href="" class="btn btn-primary btn-lg"><i class="fa fa-github"></i> View project on GitHub</a>
				</p>
		</div>
	</div>
</div>
<!--Grid-->
<div class="row">
	<div class="col-md-12">
			<h2>Grocery CRUD examples</h2>
			<div><?php echo $output; ?></div>
	</div>
</div>
<br/>
<!-- Beginning footer -->
<footer>
	<div class="row">
		<div class="col-md-12">
			<p class="footer">
				<span class="pull-right">Page rendered in <strong>{elapsed_time}</strong> seconds</span>
			Made by <a href="http://www.facebook.com/hanafi.asrul" target="_blank">Asrul Hanafi</a>. 
			Contact at <a href="mailto:hanafi.asrul@gmail.com">hanafi.asrul@gmail.com</a>.
			</p>
		</div>
	</div>
</footer>
<!-- End of Footer -->
</div>
<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
</body>
</html>
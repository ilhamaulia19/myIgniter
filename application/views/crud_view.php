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
    <!--Font-->
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">myIgniter</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Examples <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href='<?php echo site_url('crud/offices_management')?>'>Offices</a></li>
						<li><a href='<?php echo site_url('crud/employees_management')?>'>Employees</a></li>
						<li><a href='<?php echo site_url('crud/customers_management')?>'>Customers</a></li>
						<li><a href='<?php echo site_url('crud/orders_management')?>'>Orders</a></li>
						<li><a href='<?php echo site_url('crud/products_management')?>'>Products</a></li>
						<li><a href='<?php echo site_url('crud/film_management')?>'>Films</a></li>					
					</ul>
				</li>
				<li class = "dropdown">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $data['username']; ?> <b class = "caret"></b></a>
					<ul class = "dropdown-menu">
						<li><a href="<?php echo site_url('crud/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->		
	</div>
</nav>

<!-- Header-->
<header>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
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
	</div>
</header>

<!-- Grocery Crud -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2>Grocery CRUD examples</h2>
				<div><?php echo $output; ?></div>
			</div>
		</div>
	</div>
</section>


<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="footer">
					<span class="pull-right">Page rendered in <strong>{elapsed_time}</strong> seconds</span>
					Made by <a href="http://www.facebook.com/hanafi.asrul" target="_blank">Asrul Hanafi</a>. 
					Contact at <a href="mailto:hanafi.asrul@gmail.com">hanafi.asrul@gmail.com</a>.
				</p>
			</div>
		</div>
	</div>
</footer>
<!-- End of Footer -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
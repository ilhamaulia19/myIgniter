<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keyword" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="description" content="Custom Framework Codeigniter and bootstrap">
    <meta name="author" content="Asrul Hanafi">

	<!--Bootstrap-->
    <title><?php echo $title ?></title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.css') ?>" rel="stylesheet">    
    <link href="<?php echo base_url('assets/css/a-design.css') ?>" rel="stylesheet">
    <!--Font-->
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--jQuery-->
    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script> 
</head>
<body>
<!-- Page Content -->
<?php echo $page ?>
<!-- /#page-wrapper -->

<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sb-admin-2.js') ?>"></script>
<script>
    var site = '<?= site_url(); ?>';
    var ur_class = '<?= $this->uri->segment(1); ?>';
    var url_function = '<?= $this->uri->segment(2); ?>';
</script>
<script src="<?php echo base_url('assets/js/a-design.js') ?>"></script>
</body>
</html>
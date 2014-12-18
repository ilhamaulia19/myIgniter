<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="author" content="Asrul Hanafi">
  <!--Bootstrap-->
    <title>myIgniter Login</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
    <!--Font-->
  <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                          <?php echo lang('login_heading');?>
                        </h3>
                    </div>
                    <div class="panel-body">
                      <?php if ($message) { ?>
                      <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                          <span class="sr-only">Close</span></button>
                          <div id="infoMessage"><?= $message;?></div>
                      </div>
                      <?php } ?>
                      <?php echo form_open("auth/login");?>
                      <fieldset>

                          <div class="form-group">
                            <?php echo lang('login_identity_label', 'identity');?>
                            <?php echo form_input($identity);?>
                          </div>

                          <div class="form-group">
                            <?php echo lang('login_password_label', 'password');?>
                            <?php echo form_input($password);?>
                          </div>

                          <div class="checkbox">
                            <label>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                            <?php echo lang('login_remember_label', 'remember');?>
                            </label>
                          </div>

                          <button class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-sign-in"></i> <?=lang('login_submit_btn')?></button>
                       
                       </fieldset>
                        <?php echo form_close();?>

                        <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
                        </div>
                </div>
                <div>
                  <strong>Demo</strong><br>
                  Email : admin@admin.com <br>
                  Pass : password
                </div>
            </div>
        </div>
    </div>  
<!-- End of Footer -->
<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/sb-admin-2.js') ?>"></script>
</body>
</html>
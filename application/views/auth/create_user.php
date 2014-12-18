<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-user"></i> 
          <?php echo lang('create_user_heading');?><br> <small><?php echo lang('create_user_subheading');?></small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Users</h3>
        </div>
    <div class="panel-body">        
  <?php if ($message) { ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span></button>
          <div id="infoMessage"><?= $message;?></div>
      </div>
  <?php } ?>

  <?php echo form_open("auth/create_user");?>
        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_fname_label', 'first_name');?>
            </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($first_name);?>
          </div>
        </div>
        <br>
        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_lname_label', 'last_name');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($last_name);?>
        </div>
        </div>
        <br>

        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_company_label', 'company');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($company);?>
        </div>
        </div>
        <br>

        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_email_label', 'email');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($email);?>
        </div>
        </div>
        <br>

        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_phone_label', 'phone');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($phone);?>
        </div>
        </div>
        <br>

        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_password_label', 'password');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($password);?>
        </div>
        </div>
        <br>

        <div class="row" >
          <div class="col-lg-2">
            <label> 
              <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> 
              </label>
          </div>
          <div class="col-lg-10">
              <?php echo form_input($password_confirm);?>
        </div>
        </div>
        <br>

          <a href="<?= site_url('crud/ion_auth_admin') ?>" class="btn btn-default">Back</a>
          <button type="submit" class="btn btn-primary"><?= lang('create_user_submit_btn') ?></button>
  <?php echo form_close();?>

      </div>
      </div>
  </div>
</div>
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>My</b>Igniter</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php echo $message;?>
    <form action="<?php echo site_url('auth/login')?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="identity" class="form-control" placeholder="Email"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password"/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">    
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" value="1"> <?php echo lang('login_remember_label');?>
            </label>
          </div>                        
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('login_submit_btn')?></button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<script>
$('input').iCheck({
  checkboxClass: 'icheckbox_square-blue',
  radioClass: 'iradio_square-blue',
  increaseArea: '20%' // optional
});
$('body').addClass('login-page');
</script>
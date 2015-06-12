<div class="login-box">
  <div class="login-logo">
    <a href=""><b>My</b>Igniter</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div class="message"></div>
    <form action="<?php echo site_url('auth/ajax_login')?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="identity" class="form-control" placeholder="Email" autofocus />
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
          <button type="submit" class="btn btn-primary btn-block btn-flat"><span id="btnLoading" ></span> <?php echo lang('login_submit_btn')?></button>
        </div><!-- /.col -->
      </div>
    </form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<script>
$(function(){
  redirect = '<?php echo $redirect ?>';
  base_url = '<?php echo base_url() ?>';
  $('input').iCheck({ checkboxClass: 'icheckbox_square-blue' });

  $('form').on('submit',function(event){
    event.preventDefault();
    $("#btnLoading").addClass('disabled');
    $("#btnLoading").html('<img src="' + base_url + 'assets/svg/loading-spin.svg" alt=""> ');

    $.ajax({
        url      : $(this).attr('action'),
        type     : 'POST',
        data     : $(this).serialize(),
        success  : function(data) {
            if (data == "false") {
              $('.message').html('<div class="alert alert-danger">Invalid login</div>').hide().slideDown();
              $('input').val('');
              $('input[name="identity"]').focus();
            }else{
              window.location.href = redirect;
            };
            $("#btnLoading").html('');
        }
    });
  });
});
</script>
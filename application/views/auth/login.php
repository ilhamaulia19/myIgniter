<div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i>
                          <?php echo lang('login_heading');?>
                        </h3>
                    </div>
                    <div class="panel-body">
                      <?php echo $message;?>

                      <form action="<?php echo site_url('auth/login')?>" id="login_form" method="POST" role="form">
                          <div class="form-group">
                            <?php echo lang('login_identity_label', 'identity');?>
                            <input type="email" name="identity" class="form-control" required="required">
                          </div>


                          <div class="form-group">
                            <?php echo lang('login_password_label', 'password');?>
                            <input type="password" name="password" class="form-control" required="required">
                          </div>

                          <div class="checkbox">
                            <label for="remember">
                                <input type="checkbox" value="1"><?php echo lang('login_remember_label');?>
                            </label>
                          </div>

                          <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> <?php echo lang('login_submit_btn')?></button>
                      </form>

                        <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
                        </div>
                </div>
                
            </div>
              <div class="col-md-8">
                <div class="info">
                  <h1 class="anim"><i class="fa fa-gears"></i> Welcome to myIgniter</h1>
                  <br>
                  <p>myIgniter is a custom PHP framework for web developer. Combined between Codeigniter with Bootstrap and fontawesome User Interface, include auto PHP GroceryCRUD for create table with Create-Read-Update-Delete and Ion authentication system.</p>
                  <p>
                    <strong>Demo</strong><br>
                    Email : admin@admin.com <br>
                    Pass : password
                  </p>
                </div>
              </div>
        </div>
    </div>
<script>
$(function(){
  $('.anim').addClass('animated fadeInRight');
});
</script>
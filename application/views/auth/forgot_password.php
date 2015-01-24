<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i>
                    	<?php echo lang('forgot_password_heading');?>
                    </h3>
                </div>
                <div class="panel-body">
				<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

                <?php echo $message;?>
				<?php echo form_open("auth/forgot_password");?>
				<fieldset>
				      <div class="form-group">
				      	<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
				      	<?php echo form_input($email);?>
				      </div>

				      <button class="btn btn-lg btn-success btn-block" type="submit"><i class="fa fa-mail-forward"></i> <?=lang('forgot_password_submit_btn')?></button>
				</fieldset>
				<?php echo form_close();?>
				</div>
            </div>
        </div>
    </div>
</div>  
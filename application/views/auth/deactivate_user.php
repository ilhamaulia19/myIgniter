<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-user"></i> 
          <?php echo lang('deactivate_heading');?> <br/><small><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></small>
      </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">

<?php echo form_open("auth/deactivate/".$user->id);?>

  <p>
  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p>
    <a href="<?= site_url('auth/ion_auth_admin') ?>" class="btn btn-default">Kembali</a>
     <button type="submit" class="btn btn-primary"><?= lang('deactivate_submit_btn') ?></button>
 </p>

<?php echo form_close();?>
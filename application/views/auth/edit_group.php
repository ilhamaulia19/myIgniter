<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-users"></i> 
          <?php echo lang('edit_group_heading');?> <br><small><?php echo lang('edit_group_subheading');?></small>
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

<?php echo form_open(current_url());?>

      <div class="row" >
          <div class="col-lg-2">
            <label> 
            <?php echo lang('edit_group_name_label', 'group_name');?> 
            </label>
          </div>
        <div class="col-lg-10">
            <?php echo form_input($group_name);?>
      </div>
      </div>
      <br>

      <div class="row" >
          <div class="col-lg-2">
            <label> 
            <?php echo lang('edit_group_desc_label', 'description');?> 
            </label>
          </div>
        <div class="col-lg-10">
            <?php echo form_input($group_description);?>
      </div>
      </div>
      <br>

		<p>
        <a href="<?= site_url('crud/ion_auth_admin') ?>" class="btn btn-default">Back</a>
         <button type="submit" class="btn btn-primary"><?= lang('edit_group_submit_btn') ?></button>
       </p>

<?php echo form_close();?>
  </div>
</div>
</div>
</div>
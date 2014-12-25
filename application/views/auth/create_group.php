<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-users"></i> 
          <?php echo lang('create_group_heading');?><br> <small><?php echo lang('create_user_subheading');?></small>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-plus-circle"></i> Group</h3>
        </div>
    <div class="panel-body">  
  <?php if ($message) { ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span></button>
          <div id="infoMessage"><?= $message;?></div>
      </div>
  <?php } ?>

<?php echo form_open("auth/create_group");?>

      <div class="row" >
          <div class="col-lg-2">
            <label> 
            <?php echo lang('create_group_name_label', 'group_name');?> 
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
            <?php echo lang('create_group_desc_label', 'description');?> 
            </label>
          </div>
          <div class="col-lg-10">
            <?php echo form_input($description);?>
          </div>
      </div>
      <br>

         <button type="submit" class="btn btn-primary"><?= lang('create_group_submit_btn') ?></button>
         <a href="<?= site_url('crud/ion_auth_admin') ?>" class="btn btn-default">Cancel</a>
<?php echo form_close();?>
        </div>
      </div>
  </div>
</div>
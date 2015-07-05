<?php
	//$this->set_css($this->default_theme_path.'/flex/css/flexigrid.css');
	$this->set_js_lib($this->default_theme_path.'/flexigrid/js/jquery.form.js');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/flexigrid/js/flexigrid-add.js');

	//$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class="flexigrid crud-form box" data-unique-hash="<?php echo $unique_hash; ?>">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i> <?php echo $this->l('form_add'); ?> <?php echo $subject?> </h3>
	</div>

	<div id='main-table-box' class="box-body">
		<?php echo form_open( $insert_url, 'method="post" class="form-horizontal" id="crudForm" autocomplete="off" enctype="multipart/form-data"'); ?>
    
		<?php $focus = 'none'; $i=1; foreach($fields as $field) {	?>
			<div class='row' id="<?php echo $field->field_name; ?>_field_box">
				<div class='form-display-as-box col-lg-2 control-label' id="<?php echo $field->field_name; ?>_display_as_box">
					<label>
						<?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""; ?>
					</label>
				</div>
				<div class='col-lg-10' id="<?php echo $field->field_name; ?>_input_box">
					<?php echo $input_fields[$field->field_name]->input ?>
				</div>
			</div>
			<br>
			<?php if ($i == 1): $focus = $field->field_name; endif ?>
		<?php $i++; } ?>

		<!-- Start of hidden inputs -->
			<?php
				foreach($hidden_fields as $hidden_field){
					echo $hidden_field->input;
				}
			?>
		<!-- End of hidden inputs -->
		<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
		<div id='report-error' class='report-div error alert alert-danger' role="alert"></div>
		<div id='report-success' class='report-div success alert alert-success'></div>
	       

		<button type="submit" id="form-button-save" class="btn btn-primary"><?php echo $this->l('form_save'); ?></button>
		<?php 	if(!$this->unset_back_to_list) { ?>
		
		<button type="button" id="save-and-go-back-button" class="btn btn-info"><?php echo $this->l('form_save_and_go_back'); ?></button>
		<button type="button" id="cancel-button" class="btn btn-default"><?php echo $this->l('form_cancel'); ?></button>
		<?php 	} ?>
		<span class='small-loading' id='FormLoading'><img src="<?php echo base_url('assets/svg/loading-spin-primary.svg') ?>" alt="loading..."> <?php echo $this->l('form_insert_loading'); ?></span>
		<?php echo form_close(); ?>
	</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';
	var focus = '<?php echo $focus ?>';	
	var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
	var message_insert_error = "<?php echo $this->l('insert_error')?>";
</script>
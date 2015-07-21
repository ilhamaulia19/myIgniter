<?php
	// Jquery
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);	
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	if (!$this->is_IE7()) {
		$this->set_js_lib($this->default_javascript_path.'/common/list.js');
	}

	//$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/flexigrid.js');

    $this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Fancybox */
	$this->set_css('assets/js/plugins/fancybox/jquery.fancybox.css');
	$this->set_js('assets/js/plugins/fancybox/jquery.fancybox.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.easing-1.3.pack.js');

	/** Jquery UI */
	$this->load_js_jqueryui();
?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo $subject?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
	var unique_hash = '<?php echo $unique_hash; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
</script>
<!--ga faham-->
<div id='list-report-error' class='report-div error ' ></div>

<!--alert-->
<div id='list-report-success' class='report-div success report-list' ></div>

<!--panel-->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-table"></i> <?php echo $subject ?></h3>
		<div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-box-tool" id="mini-refresh"><i class='fa fa-refresh'></i></button>
		</div>
	</div>
    <div class="box-body">
		<div class="flexigrid" data-unique-hash="<?php echo $unique_hash; ?>">
			<div id="hidden-operations" class="hidden-operations"></div>
		
			<?php if(!$unset_add || !$unset_export || !$unset_print){?>
			<div class="tDiv row">
				<div class="tDiv2 col-xs-6">
					<?php if(!$unset_add){?>
					<!-- Button ADD  -->
			        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> <?php echo $subject?>' class='add-anchor add_button btn btn-primary'>
			                <i class="fa fa-plus-circle"></i> 
							<span class="add"><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
			            </a>
			        <!-- Akhir Button ADD  -->
		            <?php }?>
				</div>
				<div class="tDiv3 col-xs-6 text-right">
					<div class="btn-group">
					<?php if(!$unset_export) { ?>
					<!-- Button Export  -->
			        	<a class="export-anchor btn btn-info" data-url="<?php echo $export_url; ?>" target="_blank">
							<i class="fa fa-file-excel-o"></i> 
							<span class="export"><?php echo $this->l('list_export');?></span>
			            </a>
			         <!-- Akhir Button Export  -->
					<?php } ?>
					<?php if(!$unset_print) { ?>
			        	<a class="print-anchor btn btn-info" data-url="<?php echo $print_url; ?>">
							<i class="fa fa-print"></i>
							<span class="print"><?php echo $this->l('list_print');?></span>
			            </a>
					<?php }?>
					</div>
				</div>        
			</div>
			<?php } ?>

			<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>
		    <!--iki tampil table'e-->
			<div id='ajax_list' class="ajax_list">
				<?php echo $list_view?>
			</div>	

			<div class="row">
				<div class="col-md-6">
					<div class="sDiv quickSearchBox" id='quickSearchBox'>
						<div class="sDiv2">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group input-group input-group-sm">
										<input type="text" class="qsbsearch_fieldox search_text form-control" placeholder="<?php echo $this->l('list_search');?>" name="search_text" size="30" id='search_text'>
										<span class="input-group-btn">
								            <button type="button" value="<?php echo $this->l('list_search');?>" class="crud_search btn btn-default btn-flat" id='crud_search'><i class="fa fa-search"></i></button>
								        	<button type="button" value="<?php echo $this->l('list_clear_filtering');?>" id='search_clear' class="search_clear btn btn-default btn-flat">Clear</button>
										</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group ">
										<select class="form-control input-sm" name="search_field" id="search_field">
											<option value=""><?php echo $this->l('list_search_all');?></option>
											<?php foreach($columns as $column){?>
											<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>		
				<div class="col-md-6">
					<div class="pDiv">
						<div class="pDiv2">
							<div class="row">
								<div class="col-md-12 col-lg-6">								
									<div class="pGroup">
										<span class="pcontrol">
											<?php list($show_lang_string, $entries_lang_string) = explode('{paging}', $this->l('list_show_entries')); ?>
											<div class="form-group input-group input-group-sm">
												<input type="text" name="per_page" id='per_page' class="per_page form-control input-sm" value="<?php echo $paging_options[0] ?>" >
												<span class="input-group-btn">
													<button type="submit" class="btn btn-default btn-flat">
														<?php list($show_lang_string, $entries_lang_string) = explode('{paging}', $this->l('list_show_entries')); ?>
														<?php echo $show_lang_string; ?>
													</button>
												</span>
											</div>
											<input type='hidden' name='order_by[0]' id='hidden-sorting' class='hidden-sorting' value='<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>' />
											<input type='hidden' name='order_by[1]' id='hidden-ordering' class='hidden-ordering'  value='<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>'/>
										</span>
									</div>
								</div>
								<div class="col-md-12 col-lg-6">
									<div class="pGroup">
										<div class="form-group input-group">
											<span class="input-group-btn">
												<button type="button" class="pPrev pButton prev-button btn btn-default btn-flat btn-sm"><?php echo $this->l('list_paging_previous');?></button>
											</span>
												<?php $paging_starts_from = "<span id='page-starts-from' class='page-starts-from'>1</span>"; ?>
												<?php $paging_ends_to = "<span id='page-ends-to' class='page-ends-to'>". ($total_results < $default_per_page ? $total_results : $default_per_page) ."</span>"; ?>
												<?php $paging_total_results = "<span id='total_items' class='total_items'>$total_results</span>"?>
											<input name='page' type="text" value="1" size="4" id='crud_page' class="crud_page form-control input-sm text-center">
											<span class="input-group-btn">
												<button type="button" class="pNext pButton next-button btn btn-default btn-flat btn-sm"><?php echo $this->l('list_paging_next');?></button>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'>
								<span id="btn-refresh"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo str_replace( array('{start}','{end}','{results}'),
											array($paging_starts_from, $paging_ends_to, $paging_total_results),
											$this->l('list_displaying')
										   ); ?>				
				</div>
			</div>
			<?php echo form_close(); ?>		
		</div>
	</div>
	<div class="overlay" id="overlayTable" style="display:none;">
		<i class="fa fa-refresh fa-spin"></i>
	</div>
</div>
<!-- /.panel-body -->
<script>
	var successMesage = "<?php echo $success_message; ?>";
</script>
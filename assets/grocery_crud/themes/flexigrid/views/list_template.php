<?php
	$this->set_css($this->default_theme_path.'/flexigrid/css/plugins/dataTables/dataTables.bootstrap.css');
	$this->set_css($this->default_theme_path.'/flexigrid/css/awesome.css');

	//iki jqueryne
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);	
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
	$this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

	if (!$this->is_IE7()) {
		$this->set_js_lib($this->default_javascript_path.'/common/list.js');
	}

	$this->set_js($this->default_theme_path.'/flexigrid/js/plugins/dataTables/jquery.dataTables.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/plugins/dataTables/dataTables.bootstrap.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/flexigrid.js');

    $this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');

	/** Fancybox */
	$this->set_css($this->default_css_path.'/jquery_plugins/fancybox/jquery.fancybox.css');
	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.fancybox-1.3.4.js');
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
<div id='list-report-success' class='report-div success report-list'  <?php if($success_message !== null){?>style="display:block"<?php }?>><?php
	if($success_message !== null) { ?>
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $success_message; ?>
	</div>
	<?php }	?>
</div>

<!--panel-->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $subject ?></h3>
		<div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-box-tool" id="mini-refresh"><i class='fa fa-refresh'></i></button>
		</div>
	</div>
    <div class="box-body">
		<div class="flexigrid" data-unique-hash="<?php echo $unique_hash; ?>">
			<div id="hidden-operations" class="hidden-operations"></div>
			<!--
			<div class="mDiv">
				<div class="ftitle">
					&nbsp;
				</div>
				<div title="<?php //echo $this->l('minimize_maximize');?>" class="ptogtitle">
					<span></span>
				</div>
			</div>
			<div id='main-table-box' class="main-table-box">
			-->

			<?php if(!$unset_add || !$unset_export || !$unset_print){?>
			<div class="tDiv row">
				<div class="tDiv2 col-sm-6">
					<?php if(!$unset_add){?>
					<!-- Button ADD  -->
			        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> <?php echo $subject?>' class='add-anchor add_button btn btn-primary'>
			                <i class="fa fa-plus-circle"></i> 
							<span class="add"><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
			            </a>
			        <!-- Akhir Button ADD  -->
		            <?php }?>
				</div>
				<div class="tDiv3 col-sm-6 text-right">
					<?php if(!$unset_export) { ?>
					<!-- Button Export  -->
			        	<a class="export-anchor btn btn-info" data-url="<?php echo $export_url; ?>" target="_blank">
							<i class="fa fa-print"></i> 
							<span class="export"><?php echo $this->l('list_export');?></span>
			            </a>
			         <!-- Akhir Button Export  -->
					<?php } ?>
					<?php if($unset_print) { ?>
			        	<a class="print-anchor btn btn-info" data-url="<?php echo $print_url; ?>">
							<i class="fa fa-file-excel-o"></i>
							<span class="print"><?php echo $this->l('list_print');?></span>
			            </a>
					<?php }?>
					<div class="pDiv" style="display: none">
						<div class="pDiv2" style="display: inline">
							<div class="pGroup" style="display: inline">
								<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading' style="display: inline">
									<button type="button" id="btn-refresh" class="btn btn-info"><span class='fa fa-refresh'></span></button>
								</div>
							</div>
						</div>
					</div>		
				</div>        
			</div>
			<?php } ?>

			<!-- iki pencariane -->
			<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>
		    <!--
			<div class="row" style="margin-bottom:10px">

			    <div class="pGroup col-md-2">
					<select name="per_page" id='per_page' class="per_page form-control">
						<?php foreach($paging_options as $option){?>
							<option value="<?php echo $option; ?>" <?php if($option == $default_per_page){?>selected="selected"<?php }?>><?php echo $option; ?>&nbsp;&nbsp;</option>
						<?php }?>
					</select>
					<input type='hidden' name='order_by[0]' id='hidden-sorting' class='hidden-sorting form-control' value='<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>' />
					<input type='hidden' name='order_by[1]' id='hidden-ordering' class='hidden-ordering form-control'  value='<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>'/>
				</div>
				
		        <div class="col-md-5">
					<select name="search_field" id="search_field" class="form-control">
						<option value=""><?php echo $this->l('list_search_all');?></option>
						<?php foreach($columns as $column){?>
						<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
						<?php }?>
					</select>
		        </div>

		        <div class="col-md-5">
		            <div class="input-group">
		            	<input type="text" class="qsbsearch_fieldox search_text form-control" name="search_text" id='search_text' placeholder="SEARCH">
		            	<span class="input-group-btn" align="right">
				            <input type="button" value="<?php echo $this->l('list_search');?>" class="crud_search btn btn-default" id='crud_search'>
				        	<input type="button" value="<?php echo $this->l('list_clear_filtering');?>" id='search_clear' class="search_clear btn btn-default">	
				        </span>
			       	</div>
		        </div>
		    </div>
			-->

		    <!--iki tampil table'e-->
			<div id='ajax_list' class="ajax_list">
				<?php echo $list_view?>
			</div>

			<!--
			<div class="sDiv quickSearchBox row" id='quickSearchBox'>
		        <div class="pGroup col-md-7">
					<span class="pPageStat">
						<?php $paging_starts_from = "<span id='page-starts-from' class='page-starts-from'>1</span>"; ?>
						<?php $paging_ends_to = "<span id='page-ends-to' class='page-ends-to'>". ($total_results < $default_per_page ? $total_results : $default_per_page) ."</span>"; ?>
						<?php $paging_total_results = "<span id='total_items' class='total_items'>$total_results</span>"?>
						<?php echo str_replace( array('{start}','{end}','{results}'),
												array($paging_starts_from, $paging_ends_to, $paging_total_results),
												$this->l('list_displaying')
											   ); ?>
					</span>
				</div>
		        
		        <div class="pGroup col-md-5" align="right">
		            <div class="form-group input-group">
		                <span class="input-group-btn">
		                <div class="pFirst pButton first-button btn btn-default">
							<span>First</span>
						</div>
		                <div class="pPrev pButton prev-button btn btn-default">
							<span>Previous</span>
						</div>
						</span>
		                
		                <input name='page' type="text" value="1" id='crud_page' class="crud_page form-control" >
						<span class="input-group-addon">
		                    <?php echo $this->l('list_paging_of'); ?> <span id='last-page-number' class="last-page-number">
		                     <?php echo ceil($total_results / $default_per_page)?>
		                </span>
		                </span>
		                <span class="input-group-btn">
		 				<div class="pNext pButton next-button btn btn-default" >
							<span>Next</span>
						</div>
						<div class="pLast pButton last-button btn btn-default">
							<span>End</span>
						</div>               
		                </span>
					</div>
				</div>

		    </div>
			-->
		     
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<!-- /.panel-body -->

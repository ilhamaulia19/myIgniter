<?php if(!empty($list)){ ?>
<div class="bDiv" >
	<table class="table table-bordered table-hover table-striped" id="flex1">
		<thead>
			<tr class='hDiv'>
				<th>No.</th>
				<?php foreach($columns as $column){?>
				<th><?php echo $column->display_as?></th>
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
				<th abbr="tools" axis="col1"><?php echo $this->l('list_actions'); ?></th>
				<?php }?>
			</tr>
		</thead>		
		<tbody>
		<?php $i = 1; foreach($list as $num_row => $row){ ?>        
		<tr>
			<td><?= $i ?></td>
			<?php foreach($columns as $column){?>
				<td>
					<?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?>
				</td>
			<?php }?>

			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td align="right" width='20%'>
				<div class='tools'>				
                    <?php if(!$unset_read){?>
						<a href='<?php echo $row->read_url?>' title='<?php echo $this->l('list_view')?> <?php echo $subject?>' class="edit_button"><span class='fa fa-list'></span> Detail</a> &nbsp;   
					<?php }?>
                                        
                    <?php if(!$unset_edit){?>
						<a href='<?php echo $row->edit_url?>' title='<?php echo $this->l('list_edit')?> <?php echo $subject?>' class="edit_button"><span class='fa fa-pencil'></span> Edit</a> &nbsp; 
					<?php }?>

                    <?php if(!$unset_delete){?>
                    	<a href='<?php echo $row->delete_url?>' title='<?php echo $this->l('list_delete')?> <?php echo $subject?>' class="delete-row" ><span class='fa fa-trash-o'></span> Delete</a> &nbsp;
                    <?php }?>
                    <?php 
					if(!empty($row->action_urls)){
						foreach($row->action_urls as $action_unique_id => $action_url){ 
							$action = $actions[$action_unique_id];
					?>
							<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>">
							<span class="<?php echo $action->image_url ?>"></span>
								<?php 
								echo $action->label;
								?>
							</a>		
					<?php }
					}
					?>					
				</div>
			</td>
			<?php }?>
		</tr>
<?php $i = $i+1; } ?>        
		</tbody>
		</table>
	</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->l('list_no_items'); ?>
	<br/>
	<br/>
<?php }?>	
<script>
$(document).ready(function() {
	$('#flex1').dataTable();
	$('#mini-refresh i').removeClass('fa-spin');   
	$('#overlayTable').fadeOut(500);
});
</script>
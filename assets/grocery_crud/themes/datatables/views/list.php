<?php if(!empty($list)){ ?>
<div class="bDiv" >
	<table class="table table-bordered table-hover" id="flex1">
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
				<td><?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?></td>
			<?php }?>

			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td class="td-action">
				<ul class='tools list-unstyled table-menu'>				
                    <?php if(!empty($row->action_urls)){ foreach($row->action_urls as $action_unique_id => $action_url){ $action = $actions[$action_unique_id]; ?>
					<li>
						<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>"><i class="<?php echo $action->image_url ?>"></i> <?php echo $action->label; ?></a>	
					</li>
					<?php }	} ?>					

                    <?php if(!$unset_read){?>
                    <li>
						<a href='<?php echo $row->read_url?>' title='<?php echo $this->l('list_view')?> <?php echo $subject?>' class="edit_button"><i class='fa fa-list'></i> Detail</a>   
					</li>
					<?php }?>
                                        
                    <?php if(!$unset_edit){?>
					<li>
						<a href='<?php echo $row->edit_url?>' title='<?php echo $this->l('list_edit')?> <?php echo $subject?>' class="edit_button"><i class='fa fa-pencil'></i> Edit</a> 
					</li>
					<?php }?>

                    <?php if(!$unset_delete){?>
                    <li>
                    	<a href='<?php echo $row->delete_url?>' title='<?php echo $this->l('list_delete')?> <?php echo $subject?>' class="delete-row" ><i class='fa fa-trash-o'></i> Delete</a>
                    </li>
                    <?php }?>
				</ul>
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
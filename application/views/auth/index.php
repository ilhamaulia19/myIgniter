<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-users"></i> 
        	<?php echo lang('index_heading');?> <br><small><?php echo lang('index_subheading');?></small>
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
            	<p><a href="<?= site_url('auth/create_user') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?=lang('index_create_user_link')?></a>
            	<a href="<?= site_url('auth/create_group') ?>" class="btn btn-success"><i class="fa fa-users"></i> <?=lang('index_create_group_link')?></a></p>

                <?php if ($message) { ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span></button>
                  <div id="infoMessage"><?= $message;?></div>
                </div>
                <?php } ?>
        		<div class="table-responsive">
        		<table class="table table-hover table-bordered" id="dataTables">
        			<thead>
        				<tr>
        					<th><?php echo lang('index_fname_th');?></th>
        					<th><?php echo lang('index_lname_th');?></th>
        					<th><?php echo lang('index_email_th');?></th>
        					<th><?php echo lang('index_groups_th');?></th>
        					<th><?php echo lang('index_status_th');?></th>
        					<th><?php echo lang('index_action_th');?></th>
        				</tr>
        			</thead>
        			<tbody>
        			<?php foreach ($users as $user):?>
        				<tr>
        		            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
        		            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
        		            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
        					<td>
        						<?php foreach ($user->groups as $group):?>
        							<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
        		                <?php endforeach?>
        					</td>
        					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
        					<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
        				</tr>
        			<?php endforeach;?>
        			</tbody>
        		</table>
        		</div>
            </div>
        </div>
	</div>
</div>
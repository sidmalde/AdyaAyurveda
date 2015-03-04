<!--<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Patient'), array('action' => 'add'), array('class' => 'btn btn-success btn-xs'));?>
	</div>
</h2>-->
<div class="row">
	<div class="col-md-12">
		<? if (!empty($group['User'])): ?>
			<table class="span12 table table-condensed table-striped table-bordered table-hover ">
				<thead>
					<tr>
						<th><?=__('Name'); ?></th>
						<th><?=__('Phone'); ?></th>
						<th><?=__('Mobile'); ?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<? foreach ($group['User'] as $user): ?>
						<tr <?=empty($user['deleted']) ? 'class="success"' : 'class="error"';?>>
							<td><?=$user['title'];?> <?=$user['firstname'];?> <?=$user['lastname'];?>&nbsp;</td>
							<td><?=$user['phone'];?>&nbsp;</td>
							<td><?=$user['mobile'];?>&nbsp;</td>
							<td class="actions">
								<span class="btn-group">
									<?=$this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', 'user' => $user['id']), array('class' => 'btn btn-info'));?>
									<?=$this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'delete', 'user' => $user['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete this user?'));?>
								</span>
								<?/*=$this->Html->link(__('View'), array('action' => 'view', $user['id'])); ?>
								<?=$this->Html->link(__('Edit'), array('action' => 'edit', $user['id'])); ?>
								<?=$this->Form->postLink(__('Delete'), array('action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); */?>
							</td>
						</tr>
				<? endforeach; ?>
			</table>
		<? else: ?>
			<div class="alert alert-info">
				<p class="text-info text-center lead"><strong><?=__('There are currently no users in this group.');?></strong></p>
				<p class="text-center"><?=$this->Html->link(__('Add New User'), array('controller' => 'users', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-primary'));?></p>
			</div>
		<? endif; ?>
	</div>
</div>
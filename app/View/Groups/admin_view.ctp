<div class="row">
	<div class="span12 page-header">
		<div class="row">
			<div class="span8"><h3><?=@$pageTitle;?></h3></div>
			<div class="span3">
				<div class="btn-group pull-right">
					<?=$this->Html->link(__('Back to Groups'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-danger'));?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<div class="row">
			<div class="span7">
				<dl class="dl-horizontal">
					<dt><?=__('Description');?></dt><dd><?=$group['Group']['description'];?></dd>
					<dt><?=__('Created');?></dt><dd><?=$this->Time->niceShort($group['Group']['created']);?></dd>
					<dt><?=__('Modified');?></dt><dd><?=$this->Time->niceShort($group['Group']['modified']);?></dd>
					<dt>
					</dt>
				</dl>
			</div>
			<div class="span2">
				<span class="btn-toolbar">
					<span class="btn-group btn-group-vertical">
						<a class="btn btn-success" href="<?=$this->Html->url(array('controller' => 'groups', 'action' => 'edit', 'group' => $group['Group']['id'], 'admin' => true));?>"><i class="icon-cog icon-white"></i> <?=__('Edit Group');?></a>
						<a class="btn btn-danger" href="<?=$this->Html->url(array('controller' => 'groups', 'action' => 'delete', 'group' => $group['Group']['id'], 'admin' => true));?>" onclick="return confirm('<?=__('Are you sure you want to delete this group?');?>');"><i class="icon-remove icon-white"></i> <?=__('Delete Group');?></a>
						<a class="btn btn-primary" href="<?=$this->Html->url(array('controller' => 'users', 'action' => 'add', 'admin' => true));?>"><i class="icon-plus icon-white"></i> <?=__('Add User');?></a>
					</span>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<? if (!empty($group['User'])): ?>
					<table class="span12 table table-condensed table-striped table-bordered table-hover ">
						<thead>
							<tr>
								<th><?=__('Ref'); ?></th>
								<th><?=__('Email'); ?></th>
								<th><?=__('Title'); ?></th>
								<th><?=__('Firstname'); ?></th>
								<th><?=__('Lastname'); ?></th>
								<th><?=__('Mobile'); ?></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<? foreach ($group['User'] as $user): ?>
								<tr <?=empty($user['deleted']) ? 'class="success"' : 'class="error"';?>>
									<td><?=$user['ref']; ?>&nbsp;</td>
									<td><?=$user['email']; ?>&nbsp;</td>
									<td><?=$user['title']; ?>&nbsp;</td>
									<td><?=$user['firstname']; ?>&nbsp;</td>
									<td><?=$user['lastname']; ?>&nbsp;</td>
									<td><?=$user['mobile']; ?>&nbsp;</td>
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
	</div>
</div>
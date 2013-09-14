<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		<?=$this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="row">
	<div class="col-xs-12">
		<ul class="nav nav-tabs" id="myTab">
			<?php foreach ($groups as $index => $group): ?>
				<? $activeLinkClass=($index == 0) ? 'class="active"': '';?>
				<li <?=$activeLinkClass;?>>
					<a href="<?='#'.Sanitize::paranoid(strtolower($group['Group']['name']));?>" data-toggle="tab">
						<span class="badge badge-info">(<?=count($group['User']);?>)</span>
						<?=$group['Group']['name'];?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

	 
		<div id="myTabContent" class="tab-content">
			<?php foreach ($groups as $index => $group): ?>
				<? $tabClass=($index == 0) ? 'active in': 'fade'; ?>
				<div class="tab-pane <?=$tabClass;?>" id="<?=Sanitize::paranoid(strtolower($group['Group']['name']));?>">
					<div class="row">
						<div class="col-xs-1">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit Group'), array('controller' => 'groups', 'action' => 'edit', 'group' => $group['Group']['id'], 'admin' => true), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete Group'), array('controller' => 'groups', 'action' => 'delete', 'group' => $group['Group']['id'], 'admin' => true), array('escape' => false), __('Are you sure you want to delete this group?'));?></li>
								<li><?=$this->Html->link('<i class="icon-plus"></i> '.__('Add User'), array('controller' => 'users', 'action' => 'add', 'admin' => true), array('escape' => false));?></li>
							</ul>
						</div>
						<div class="col-xs-11">
							<dl class="dl-horizontal">
								<dt><?=__('Description');?></dt><dd><?=$group['Group']['description'];?></dd>
								<dt><?=__('Created');?></dt><dd><?=$this->Time->niceShort($group['Group']['created']);?></dd>
								<dt><?=__('Modified');?></dt><dd><?=$this->Time->niceShort($group['Group']['modified']);?></dd>
								<dt></dt>
								<dd>
								</dd>
							</dl>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<? if (!empty($group['User'])): ?>
								<table class="table table-condensed table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th><?=__('Email'); ?></th>
											<th><?=__('Title'); ?></th>
											<th><?=__('Firstname'); ?></th>
											<th><?=__('Lastname'); ?></th>
											<th><?=__('Mobile'); ?></th>
											<th><?=__('Active'); ?></th>
											<th><?=__('Deleted'); ?></th>
											<th>
												&nbsp;
											</th>
										</tr>
									</thead>
									<? foreach ($group['User'] as $user): ?>
											<tr <?=empty($user['deleted']) ? 'class="success"' : 'class="error"';?>>
												<td><?=$user['email']; ?>&nbsp;</td>
												<td><?=$user['title']; ?>&nbsp;</td>
												<td><?=$user['firstname']; ?>&nbsp;</td>
												<td><?=$user['lastname']; ?>&nbsp;</td>
												<td><?=$user['mobile']; ?>&nbsp;</td>
												<td><?=$user['active']; ?>&nbsp;</td>
												<td><?=$user['deleted']; ?>&nbsp;</td>
												<td class="actions">
													<div class="btn-group">
														<?=$this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', 'user' => $user['id']), array('class' => 'btn btn-info'));?>
														<?=$this->Html->link(__('Edit').'<span class="caret"></span>', array('controller' => 'users', 'action' => 'edit', 'user' => $user['id']), array('escape' => false, 'class' => 'btn btn-success dropdown-toggle', 'data-toggle' => 'dropdown'));?>
														<ul class="dropdown-menu">
															<!-- dropdown menu links -->
															<? if (empty($user['active'])): ?>
																<li><?=$this->Html->link(__('Activate'), array('controller' => 'users', 'action' => 'activate', 'user' => $user['id']));?></li>
															<? endif; ?>
															<li><?=$this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'delete', 'user' => $user['id']));?></li>
															<li><?=$this->Html->link(__('More...'), array('controller' => 'users', 'action' => 'edit', 'user' => $user['id']));?></li>
														</ul>
													</div>
													<?/*=$this->Html->link(__('View'), array('action' => 'view', $user['id'])); ?>
													<?=$this->Html->link(__('Edit'), array('action' => 'edit', $user['id'])); ?>
													<?=$this->Form->postLink(__('Delete'), array('action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); */?>
												</td>
											</tr>
									<? endforeach; ?>
								</table>
							<? else: ?>
								<div class="alert alert-info">
									<p class="text-center lead"><strong><?=__('There are currently no users in this group.');?></strong></p>
								</div>
							<? endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

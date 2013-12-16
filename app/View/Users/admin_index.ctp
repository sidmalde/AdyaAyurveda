<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
		<?=$this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="row">
	<div class="col-md-12">
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
					<? if (!empty($group['User'])): ?>
						<table class="table table-condensed table-striped table-bordered table-hover datatable">
							<thead>
								<tr>
									<th><?=__('Email'); ?></th>
									<th><?=__('Name'); ?></th>
									<th><?=__('City'); ?></th>
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
										<td><?=$user['title'].' '.$user['firstname'].' '.$user['lastname']; ?>&nbsp;</td>
										<td><?=$user['city']; ?>&nbsp;</td>
										<td><?=$user['mobile']; ?>&nbsp;</td>
										<td><?=$user['active']; ?>&nbsp;</td>
										<td><?=$user['deleted']; ?>&nbsp;</td>
										<td class="condensed">
											<div class="btn-group">
												<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
												<ul class="dropdown-menu">
													<? if (empty($user['active'])): ?>
														<li><?=$this->Html->link(__('Activate'), array('controller' => 'users', 'action' => 'activate', 'user' => $user['id']), array('escape' => false));?></li>
													<? endif; ?>
													<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'users', 'action' => 'edit', 'user' => $user['id']), array('escape' => false));?></li>
													<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'users', 'action' => 'delete', 'user' => $user['id']), array('escape' => false));?></li>
													<li><?=$this->Html->link('<i class="icon-eye-open"></i> '.__('View'), array('controller' => 'users', 'action' => 'view', 'user' => $user['id']), array('escape' => false));?></li>
												</ul>
											</div>
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
			<?php endforeach; ?>
		</div>
	</div>
</div>

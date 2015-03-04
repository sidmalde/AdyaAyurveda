<div class="col-md-12">
	<? if (!empty($userDataFields)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover datatable">
			<thead>
				<tr>
					<th><?=__('Gender'); ?></th>
					<th><?=__('Field Name'); ?></th>
					<th><?=__('Data Type'); ?></th>
					<th><?=__('Values'); ?></th>
					<th><?=__('Description'); ?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($userDataFields As $userDataField): ?>
					<tr>
						<td><?=$userDataField['UserDataField']['gender'];?></td>
						<td><?=ucwords(implode(" ", explode("_", $userDataField['UserDataField']['field_name'])));?></td>
						<td><?=$userDataField['UserDataField']['type'];?></td>
						<td><?=$userDataField['UserDataField']['values'];?></td>
						<td><?=$userDataField['UserDataField']['description'];?></td>
						<td class="condensed">
							<div class="btn-group">
								<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><?=$this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'data_field_edit', 'userDataField' => $userDataField['UserDataField']['id'], 'admin' => true), array('escape' => false));?></li>
									<li><?=$this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'data_field_delete', 'userDataField' => $userDataField['UserDataField']['id'], 'admin' => true), array('escape' => false), __('Are you sure you want to delete this group?'));?></li>
								</ul>
							</div>
						</td>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	<? else: ?>
		<div class="alert">
			<p class="text-center lead"><?=__('There are currently no User Data Fields');?></p>
		</div>
	<? endif; ?>
</div>
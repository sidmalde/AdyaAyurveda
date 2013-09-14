<? if (!empty($systemStatuses)): ?>
	<table class="table table-striped table-bordered table-condensed">
		<tr>
			<th><?=__('Name');?></th>
			<th><?=__('Summary');?></th>
			<th><?=__('Last Updated');?></th>
			<th>&nbsp;</th>
		</tr>
		<? foreach($systemStatuses as $systemStatus): ?>
			<tr>
				<td><?=$systemStatus['SystemStatus']['name'];?></td>
				<td><?=$systemStatus['SystemStatus']['description'];?></td>
				<td><?=$this->Time->niceDate($systemStatus['SystemStatus']['modified']);?></td>
				<td>
					<div class="btn-group pull-right">
						<?=$this->Html->link(__('Edit'), array('action' => 'view', 'systemStatus' => $systemStatus['SystemStatus']['id']), array('class' => 'btn btn-info'));?>
						<?=$this->Html->link(__('Delete'), array('action' => 'delete', 'systemStatus' => $systemStatus['SystemStatus']['id']), array('class' => 'btn btn-danger'), __('Are you sure?'));?>
					</div>
				</td>
			</tr>
		<? endforeach; ?>
	</table>
<? else: ?>
	<div class="alert alert-info">
		<p class="text-info text-center lead"><strong><?=__('There are currently no System Statuses.');?></strong></p>
		<p class="text-center"><?=$this->Html->link(__('Add New System Status'), array('action' => 'add', 'admin' => true), array('class' => 'btn btn-primary'));?></p>
	</div>
<? endif; ?>
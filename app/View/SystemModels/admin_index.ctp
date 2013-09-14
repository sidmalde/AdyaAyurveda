<div class="row">
	<div class="span12 page-header">
		<div class="row">
			<div class="span8"><h3><?=@$pageTitle;?></h3></div>
			<div class="span3">
				<div class="pull-right">
					<?=$this->Html->link(__('New System Model'), array('action' => 'add'), array('class' => 'btn btn-primary'));?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<? if (!empty($systemModels)): ?>
			<table class="span12 table table-bordered table-striped table-condensed table-hover">
				<thead>
					<tr>
						<th><?=__('Name');?></th>
						<th><?=__('Description');?></th>
						<th><?=__('Last Modified');?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($systemModels as $systemModel): ?>	
						<tr>
							<td><?=$systemModel['SystemModel']['name'];?></td>
							<td><?=$systemModel['SystemModel']['description'];?></td>
							<td><?=$this->Time->niceDate($systemModel['SystemModel']['modified']);?></td>
							<td>
								<div class="btn-group">
									<?=$this->Html->link('Edit', array('action' => 'edit', 'systemModel' => $systemModel['SystemModel']['id']), array('class' => 'btn btn-info'));?>
									<?=$this->Html->link('Delete', array('action' => 'delete', 'systemModel' => $systemModel['SystemModel']['id']), array('class' => 'btn btn-warning'), __('Are you sure?'));?>
								</div>
							</td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		<? else: ?>
			<div class="alert alert-info">	
				
				<p class="text-info text-center lead"><strong><?=__('No System Models have been added yet.');?></strong></p>
				<p class="text-center"><?=$this->Html->link(__('Add System Model'), array('controller' => 'system_models', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-primary'));?></p>
			</div>
		<? endif; ?>
	</div>
</div>

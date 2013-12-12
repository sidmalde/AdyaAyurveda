<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Order'), array('action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h2>
<div class="well">
	<? if(!empty($orders)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Ref');?></th>
				<th><?=__('Created By');?></th>
				<th><?=__('Patient');?></th>
				<th><?=__('Items');?></th>
				<th><?=__('Total');?></th>
				<th><?=__('Created');?></th>
				<th><?=__('Modified');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($orders as $order): ?>
				<tr>
					<td><?=$order['Order']['ref'];?></td>
					<td><?=$order['User']['firstname'].' '.$order['User']['lastname'];?></td>
					<td><?=$order['Patient']['firstname'].' '.$order['Patient']['lastname'];?></td>
					<td><?=count($order['OrderItem']);?></td>
					<td><?=$this->Number->currency($order['Order']['total'], 'GBP');?></td>
					<td><?=$this->Time->niceShort($order['Order']['created']);?></td>
					<td><?=$this->Time->niceShort($order['Order']['modified']);?></td>
					<td class="actions condensed">
						<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'orders', 'action' => 'edit', 'order' => $order['Order']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'orders', 'action' => 'delete', 'order' => $order['Order']['id']), array('escape' => false), __('Are you sure?'));?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?endforeach; ?>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no orders.');?></strong></p>
		</div>
	<? endif; ?>
</div>
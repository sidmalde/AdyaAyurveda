<div class="outer-5">
	<? if(!empty($invoices)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Ref');?></th>
				<th><?=__('Created By');?></th>
				<th><?=__('Patient');?></th>
				<th><?=__('Total');?></th>
				<th><?=__('Created');?></th>
				<th><?=__('Modified');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($invoices as $invoice): ?>
				<tr>
					<td><?=$invoice['Invoice']['ref'];?></td>
					<td><?=$invoice['User']['firstname'].' '.$invoice['User']['lastname'];?></td>
					<td><?=$invoice['Patient']['firstname'].' '.$invoice['Patient']['lastname'];?></td>
					<td><?=$this->Number->currency($invoice['Invoice']['total'], 'GBP');?></td>
					<td><?=$this->Time->niceShort($invoice['Invoice']['created']);?></td>
					<td class="actions condensed">
						<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="fa fa-book"></i> '.__('View'), array('controller' => 'invoices', 'action' => 'view', 'invoice' => $invoice['Invoice']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="fa fa-cog"></i> '.__('Edit'), array('controller' => 'invoices', 'action' => 'edit', 'invoice' => $invoice['Invoice']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="fa fa-trash"></i> '.__('Delete'), array('controller' => 'invoices', 'action' => 'delete', 'invoice' => $invoice['Invoice']['id']), array('escape' => false), __('Are you sure?'));?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?endforeach; ?>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no invoices');?></strong></p>
		</div>
	<? endif; ?>
</div>
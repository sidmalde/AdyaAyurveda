<div class="outer-5">

	<div class="well">
		<?=$this->Form->create('Invoice', array('url' => array('action' => 'add')));?>
			<?=$this->Form->input('order_id', array('empty' => __('Please select an order:'), 'options' => $orders));?>
			
			<?=$this->Form->button(__('Generate Invoice'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
		<?=$this->Form->end();?>
	</div>

	<? if(!empty($invoices)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Ref');?></th>
				<th><?=__('Patient');?></th>
				<th><?=__('Total');?></th>
				<th><?=__('Created');?></th>
				<th class="condensed">&nbsp;</th>
			</tr>
			<? foreach($invoices as $invoice): ?>
				<tr>
					<td><?=$invoice['Invoice']['ref'];?></td>
					<td><?=$invoice['User']['firstname'].' '.$invoice['User']['lastname'];?></td>
					<td><?=$this->Number->currency($invoice['Invoice']['total'], 'GBP');?></td>
					<td><?=$this->Time->niceShort($invoice['Invoice']['created']);?></td>
					<td class="condensed">
						<?=$this->Html->link('<i class="fa fa-book"></i> '.__('View PDF'), array('controller' => 'invoices', 'action' => 'view', 'invoice' => $invoice['Invoice']['id']), array('escape' => false, 'class' => 'btn btn-primary'));?>
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
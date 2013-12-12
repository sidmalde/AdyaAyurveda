<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Product'), array('action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h2>
<div class="well">
	<? if(!empty($products)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Name');?></th>
				<th><?=__('Code');?></th>
				<th><?=__('Barcode');?></th>
				<th><?=__('Quantity');?></th>
				<th><?=__('Created');?></th>
				<th><?=__('Modified');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($products as $product): ?>
				<tr>
					<td><?=$product['Product']['name'];?></td>
					<td><?=$product['Product']['code'];?></td>
					<td><?=$product['Product']['barcode'];?></td>
					<td><?=$product['Product']['quantity'].' '.$product['Product']['measurement'];?></td>
					<td><?=$this->Time->niceShort($product['Product']['created']);?></td>
					<td><?=$this->Time->niceShort($product['Product']['modified']);?></td>
					<td class="actions condensed">
						<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'products', 'action' => 'edit', 'product' => $product['Product']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'products', 'action' => 'delete', 'product' => $product['Product']['id']), array('escape' => false));?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?endforeach; ?>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no products.');?></strong></p>
		</div>
	<? endif; ?>
</div>
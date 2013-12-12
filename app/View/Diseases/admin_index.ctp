<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Disease'), array('action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h2>
<div class="well">
	<? if(!empty($diseases)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Disease');?></th>
				<th><?=__('Created');?></th>
				<th><?=__('Modified');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($diseases as $disease): ?>
				<tr>
					<td><?=$disease['Disease']['disease'];?></td>
					<td><?=$this->Time->niceShort($disease['Disease']['created']);?></td>
					<td><?=$this->Time->niceShort($disease['Disease']['modified']);?></td>
					<td class="actions condensed">
						<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'diseases', 'action' => 'edit', 'disease' => $disease['Disease']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'diseases', 'action' => 'delete', 'disease' => $disease['Disease']['id']), array('escape' => false));?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?endforeach; ?>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no diseases.');?></strong></p>
		</div>
	<? endif; ?>
</div>
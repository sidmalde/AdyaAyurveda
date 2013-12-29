<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Page'), array('action' => 'add'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h2>
<div class="well">
	<? if(!empty($pages)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Url');?></th>
				<th><?=__('Title');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($pages as $page): ?>
				<tr>
					<td><?=$page['Page']['url'];?></td>
					<td><?=$page['Page']['title'];?></td>
					<td class="actions condensed">
						<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'pages', 'action' => 'edit', 'page' => $page['Page']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'pages', 'action' => 'delete', 'page' => $page['Page']['id']), array('escape' => false));?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?endforeach; ?>
		</table>
	<? else: ?>
		<div class="alert alert-info">
			<p class="text-center lead"><strong><?=__('There are currently no pages.');?></strong></p>
		</div>
	<? endif; ?>
</div>
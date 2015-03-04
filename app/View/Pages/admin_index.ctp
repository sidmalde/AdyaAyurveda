<div class="outer-5">
	<? if(!empty($pages)): ?>
		<table class="table table-condensed table-striped table-bordered table-hover">
			<tr>
				<th><?=__('Url');?></th>
				<th><?=__('Title');?></th>
				<th><?=__('Published');?></th>
				<th><?=__('Last Updated');?></th>
				<th>&nbsp;</th>
			</tr>
			<? foreach($pages as $page): ?>
				<tr>
					<td><?=$page['Page']['url'];?></td>
					<td><?=$page['Page']['title'];?></td>
					<td><?=$page['Page']['publish'];?></td>
					<td><?=date('d M Y', strtotime($page['Page']['modified']));?></td>
					<td class="actions condensed">
						<?/*<div class="btn-group">
							<button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=__('Actions')?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><?=$this->Html->link('<i class="icon-cog"></i> '.__('Edit'), array('controller' => 'pages', 'action' => 'edit', 'page' => $page['Page']['id']), array('escape' => false));?></li>
								<li><?=$this->Html->link('<i class="icon-remove"></i> '.__('Delete'), array('controller' => 'pages', 'action' => 'delete', 'page' => $page['Page']['id']), array('escape' => false));?></li>
							</ul>
						</div> */?>
						<div class="btn-group">
							<?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'pages', 'action' => 'edit', 'page' => $page['Page']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false));?>
							<?=$this->Html->link('<i class="fa fa-trash-o"></i> '.__('Delete'), array('controller' => 'pages', 'action' => 'delete', 'page' => $page['Page']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Are you sure?'));?>
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
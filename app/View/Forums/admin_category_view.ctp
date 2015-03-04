<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link('<i class="fa fa-plus"></i> '.__('Forum Topic'), array('controller' => 'forums', 'action' => 'topic_add'), array('class' => 'btn btn-primary btn-xs', 'escape' => false));?>
		<?=$this->Html->link('<i class="fa fa-reply"></i> '.__('Back'), array('controller' => 'forums', 'action' => 'index'), array('class' => 'btn btn-danger btn-xs', 'escape' => false));?>
	</div>
</h3>
<hr />
<div class="row">
	<div class="col-xs-12">
		<div class="well">
			<table class="table table-bordered">
				<? if(!empty($forumCategory['ForumCategory']['parent_forum_category_id'])): ?>
					<tr>
						<th><?=__('Parent Category');?></th>
						<td><?=$forumCategories[$forumCategory['ForumCategory']['parent_forum_category_id']];?></td>
					</tr>
				<? endif; ?>
				<tr>
					<th><?=__('Title');?></th>
					<td><?=$forumCategory['ForumCategory']['title'];?></td>
				</tr>
				<tr>
					<th><?=__('Description');?></th>
					<td><?=$forumCategory['ForumCategory']['description'];?></td>
				</tr>
				<tr>
					<th><?=__('Publish');?></th>
					<td><?=($forumCategory['ForumCategory']['publish']) ? __('Yes') : __('No');?></td>
				</tr>
				<tr>
					<th><?=__('Created');?></th>
					<td><?=date("d-M-Y", strtotime($forumCategory['ForumCategory']['created']));?></td>
				</tr>
				<tr>
					<th class="condensed"><?=__('Modified');?></th>
					<td><?=date("d-M-Y", strtotime($forumCategory['ForumCategory']['modified']));?></td>
				</tr>
			</table>
		</div>
	</div>
	<? if (!empty($forumCategory['ForumTopic'])): ?>
		<div class="col-xs-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th><?=__('Title');?></th>
						<th><?=__('Published');?></th>
						<th><?=__('Posts');?></th>
						<th><?=__('Last Updated');?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($forumCategory['ForumTopic'] as $forumTopic): ?>
						<tr>
							<td><?=$forumTopic['topic'];?></td>
							<td><?=($forumTopic['publish']) ? __('Yes') : __('No');?></td>
							<td><?=count($forumTopic['ForumPost']);?></td>
							<td class="condensed nowrap"><?=date("d-M-Y", strtotime($forumTopic['modified']));?></td>
							<td class="condensed">
								<div class="btn-group">
									<?=$this->Html->link(__('Actions').' <span class="caret"></span>', '#', array('escape' => false, 'class' => 'btn btn-info btn-xs dropdown-toggle', 'data-toggle' => 'dropdown'));?>
									<ul class="dropdown-menu">
										<li><?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'forums', 'action' => 'topic_view', 'forumCategory' => $forumTopic['id']), array('escape' => false));?></li>
										<li><?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'forums', 'action' => 'topic_edit', 'forumCategory' => $forumTopic['id']), array('escape' => false));?></li>
										<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'forums', 'action' => 'topic_delete', 'forumCategory' => $forumTopic['id']), array('escape' => false), __('Are yo sure?'));?></li>
									</ul>
								</div>
							</td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>
	<? endif; ?>
</div>
<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link('<i class="fa fa-plus"></i> '.__('Forum Topic'), array('controller' => 'forums', 'action' => 'topic_add'), array('class' => 'btn btn-primary btn-xs', 'escape' => false));?>
		<?=$this->Html->link('<i class="fa fa-plus"></i> '.__('Forum Category'), array('controller' => 'forums', 'action' => 'category_add'), array('class' => 'btn btn-primary btn-xs', 'escape' => false));?>
	</div>
</h3>
<hr />
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><?=__('Title');?></th>
					<th><?=__('Published');?></th>
					<th><?=__('Topics');?></th>
					<th><?=__('Last Updated');?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($forumCategories as $forumCategory): ?>
					<tr class="success">
						<td><?=$forumCategory['ForumCategory']['title'];?></td>
						<td class="condensed nowrap"><?=($forumCategory['ForumCategory']['publish']) ? __('Yes') : __('No');?></td>
						<td class="condensed nowrap"><?=count($forumCategory['ForumTopic']);?></td>
						<td class="condensed nowrap"><?=date("d-M-Y", strtotime($forumCategory['ForumCategory']['modified']));?></td>
						<td class="condensed">
							<div class="btn-group">
								<?=$this->Html->link(__('Actions').' <span class="caret"></span>', '#', array('escape' => false, 'class' => 'btn btn-info btn-xs dropdown-toggle', 'data-toggle' => 'dropdown'));?>
								<ul class="dropdown-menu">
									<li><?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'forums', 'action' => 'category_view', 'forumCategory' => $forumCategory['ForumCategory']['id']), array('escape' => false));?></li>
									<li><?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'forums', 'action' => 'category_edit', 'forumCategory' => $forumCategory['ForumCategory']['id']), array('escape' => false));?></li>
									<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'forums', 'action' => 'category_delete', 'forumCategory' => $forumCategory['ForumCategory']['id']), array('escape' => false), __('Are yo sure?'));?></li>
								</ul>
							</div>
						</td>
					</tr>
					<? if(!empty($forumCategory['ChildForumCategory'])): ?>
						<? foreach($forumCategory['ChildForumCategory'] as $childForumCategory): ?>
							<tr class="danger child">
								<td><?=$childForumCategory['title'];?></td>
								<td><?=($childForumCategory['publish']) ? __('Yes') : __('No');?></td>
								<td><?=__('N/A');?></td>
								<td><?=count($childForumCategory['ForumTopic']);?></td>
								<td class="condensed nowrap"><?=date("d-M-Y", strtotime($childForumCategory['modified']));?></td>
								<td class="condensed">
									<div class="btn-group">
										<?=$this->Html->link(__('Actions').' <span class="caret"></span>', '#', array('escape' => false, 'class' => 'btn btn-info btn-xs dropdown-toggle', 'data-toggle' => 'dropdown'));?>
										<ul class="dropdown-menu">
											<li><?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'forums', 'action' => 'category_view', 'forumCategory' => $childForumCategory['id']), array('escape' => false));?></li>
											<li><?=$this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit'), array('controller' => 'forums', 'action' => 'category_edit', 'forumCategory' => $childForumCategory['id']), array('escape' => false));?></li>
											<li><?=$this->Html->link('<i class="fa fa-times"></i> '.__('Delete'), array('controller' => 'forums', 'action' => 'category_delete', 'forumCategory' => $childForumCategory['id']), array('escape' => false), __('Are yo sure?'));?></li>
										</ul>
									</div>
								</td>
							</tr>
						<? endforeach; ?>
					<? endif; ?>
				<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
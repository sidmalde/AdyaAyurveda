<h1>
	<?=$title_for_layout;?>
	<div class="pull-right">
		<?#=$this->Html->link(__('Create Discussion Topic'), '#shareStory', array('class' => 'btn btn-success btn-sm', 'data-toggle' => 'modal', 'data-target' => '#shareStory'));?>
	</div>
</h1>

<div class="main-content">
	<? foreach($forumCategories as $forumCategory): ?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h2 class="panel-title">
					<?=$forumCategory['ForumCategory']['title'];?>
					<?#=$this->Html->link('<i class="fa fa-plus"></i> '.__('New Topic'), '#shareStory', array('escape' => false, 'class' => 'btn btn-success whiteText btn-xs pull-right', 'data-toggle' => 'modal', 'data-target' => '#addForumCategoryTopic'));?>
				</h2>
			</div>
			<div class="panel-body">
				<? if(!empty($forumCategory['ForumTopic'])): ?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?=__('Forum Topic');?></th>
								<th><?=__('Discussions');?></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<? foreach($forumCategory['ForumTopic'] as $forumTopic): ?>
								<tr>
									<td><?=$forumTopic['topic'];?></td>
									<td class="condensed text-center"><?=count($forumTopic['ForumPost']);?></td>
									<td class="condensed">
										<?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'forums', 'action' => 'view', 'forumCategory' => $forumCategory['ForumCategory']['ref'], 'forumTopic' => $forumTopic['ref']/* , Inflector::slug(strtolower($forumTopic['topic']), '-') */), array('escape' => false, 'class' => 'btn btn-success btn-xs'));?>
									</td>
								</tr>
							<? endforeach; ?>
						</tbody>
					</table>
				<? else: ?>
					
				<? endif; ?>
			</div>
		</div>
	<? endforeach; ?>
	
	<?/*<table class="table table-bordered table-hover table-forum">
		<thead>
			<tr>
				<th><?=__('Title');?></th>
				<th><?=__('Topics');?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<? foreach($forumCategories as $forumCategory): ?>
				<tr class="success">
					<td><?=$forumCategory['ForumCategory']['title'];?></td>
					<td class="condensed nowrap"><?=count($forumCategory['ForumTopic']);?></td>
					<td class="condensed">
						<?=$this->Html->link('<i class="fa fa-eye"></i> '.__('View'), array('controller' => 'forums', 'action' => 'category_view', 'forumCategory' => $forumCategory['ForumCategory']['id']), array('escape' => false, 'class' => 'btn btn-sm btn-success'));?>
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
	</table>*/?>
</div>
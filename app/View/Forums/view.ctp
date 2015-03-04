<h1>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<? if(isset($currentUser)): ?>
			<?=$this->Html->link('<i class="fa fa-plus"></i> '.__('New Post'), '#forumPost', array('data-toggle' => 'modal', 'data-target' => '#forumPost', 'class' => 'btn btn-success btn-sm', 'escape' => false));?>
		<? else: ?>
			<?=$this->Html->link(__('You must be logged in to post'), array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-link'));?>
		<? endif; ?>
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-warning btn-sm'));?>
	</div>
</h1>

<div class="main-content">
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th><?=__('#');?></th>
				<th><?=__('Topic of discussion');?></th>
				<th><?=__('Replies');?></th>
			</tr>
		</thead>
		<tbody>
			<? foreach($forumTopic['ForumPost'] as $forumPost): ?>
				<tr>
					<td class="condensed"><?=$forumPost['ref'];?></td>
					<td>
						<span class="forum-topic-post-title"><?=$this->Html->link($forumPost['post'], array('action' => 'view_post', 'forumCategory' => $forumTopic['ForumCategory']['ref'], 'forumTopic' => $forumTopic['ForumTopic']['ref'], 'forumPost' => $forumPost['ref']));?></span><br />
						<span class="forum-topic-post-author-date">
							<?=(empty($forumPost['User']['username'])) ? $forumPost['User']['firstname'].' '.$forumPost['User']['lastname'] : $forumPost['User']['username'];?>, <?=date("d-M-Y", strtotime($forumPost['created']));?>
						</span>
					</td>
					<td class="condensed"><?=count($forumPost['ChildForumPost']);?></td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="forumPost" tabindex="-1" aria-labelledby="forumPost" aria-hidden="true">
	<?=$this->Form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'add_post', 'forumCategory' => $forumCategory, 'forumTopic' => $forumTopicRef), 'class' => 'form'));?>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?=__('Reply to post');?></h4>
				</div>
				<div class="modal-body">
					<?=$this->Form->input('post');?>
				</div>
				<div class="modal-footer">
					<?=$this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-primary'));?>
					<?=$this->Form->button('Close', array('type' => 'submit', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'));?>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-content -->
	<?=$this->Form->end();?>
</div><!-- /.modal -->
<h1>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<? if(isset($currentUser)): ?>
			<?=$this->Html->link(__('Reply'), '#forumPostReply', array('data-toggle' => 'modal', 'data-target' => '#forumPostReply', 'class' => 'btn btn-success btn-sm'));?>
		<? else: ?>
			<?=$this->Html->link(__('You must be logged in to reply'), array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-link'));?>
		<? endif; ?>
		<?=$this->Html->link(__('Back'), array('action' => 'view', 'forumCategory' => $forumPost['ForumTopic']['ForumCategory']['ref'], 'forumTopic' => $forumPost['ForumTopic']['ref']), array('class' => 'btn btn-warning btn-sm'));?>
	</div>
</h1>

<div class="main-content">
	<? foreach($forumPost['ChildForumPost'] as $index => $childForumPost): ?>
		<div class="forum-post">
			<div class="forum-post-title">
				<div class="row">
					<div class="col-sm-11"><?=date("d-M-Y", strtotime($childForumPost['created'])).' at '.date("h:i", strtotime($childForumPost['created']));?></div>
					<div class="col-sm-1 pull-right"><span class="pull-right">#<?=($index+1);?></span></div>
				</div>
			</div>
			<div class="forum-post-content">
				<div class="row">
					<div class="col-sm-2">
						<div class="forum-post-user">
							<?=(empty($childForumPost['User']['username'])) ? $childForumPost['User']['firstname'].' '.$childForumPost['User']['lastname'] : $childForumPost['User']['username'];?>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="forum-post-post">
							<?=$childForumPost['post'];?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<? endforeach; ?>
	
	<div class="v-outer15">
		<div class="text-center">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<? if(isset($currentUser)): ?>
						<?=$this->Html->link(__('Reply'), '#forumPostReply', array('data-toggle' => 'modal', 'data-target' => '#forumPostReply', 'class' => 'btn btn-success btn-sm btn-block'));?>
					<? else: ?>
						<?=$this->Html->link(__('You must be logged in to reply'), array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-link'));?>
					<? endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="forumPostReply" tabindex="-1" aria-labelledby="forumPostReply" aria-hidden="true">
	<?=$this->Form->create('ForumPost', array('url' => array('controller' => 'forums', 'action' => 'add_post', 'forumCategory' => $forumCategory, 'forumTopic' => $forumTopic, 'forumPost' => $forumPostRef), 'class' => 'form'));?>
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

<?/*<div class="modal fade" id="forumPostReply" tabindex="-1" aria-labelledby="forumPostReply" aria-hidden="true">
	<?=$this->element('forum_post_reply_form_open', array('forumCategory' => $forumPost['ForumTopic']['ForumCategory']['ref'], 'forumTopic' => $forumPost['ForumTopic']['ref'], 'forumPost' => $forumPost['ForumPost']['ref']));?>
		<div class="modal-content">
			<div class="modal-header">
				<?=$this->element('forum_post_reply_form_header');?>
			</div>
			<div class="modal-body">
				<?=$this->element('forum_post_reply_form_body');?>
			</div>
			<div class="modal-footer">
				<?=$this->element('forum_post_reply_form_footer');?>
			</div>
		</div><!-- /.modal-content -->
	<?=$this->element('forum_post_reply_form_close');?>
</div><!-- /.modal -->*/?>
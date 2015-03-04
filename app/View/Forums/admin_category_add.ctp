<h3>
	<?=@$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'forums', 'action' => 'index'), array('class' => 'btn btn-primary btn-xs'));?>
	</div>
</h3>
<hr />
<div class="row">
	<div class="col-xs-12">
		<div class="well">
			<?=$this->Form->create('ForumCategory');?>
				<?=$this->Form->input('title');?>
				<?=$this->Form->input('description');?>
				<?=$this->Form->input('publish');?>
				<?=$this->Form->button(__('Save'), array('class' => 'btn btn-success'));?>
			<?=$this->Form->end();?>
		</div>
	</div>
</div>
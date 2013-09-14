<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'groups', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>
<br />
<div class="row">
	<div class="col-xs-12">
		<div class="well">
			<?=$this->Form->create('Group'); ?>
				<?=$this->Form->input('name');?>
				<?=$this->Form->input('description');?>
			<?=$this->Form->end(__('Submit')); ?>
		</div>
	</div>
</div>
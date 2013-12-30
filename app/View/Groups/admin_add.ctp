<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'groups', 'action' => 'index'), array('class' => 'btn btn-success btn-xs'));?>
	</div>
</h3>
<br />
<div class="row">
	<div class="col-md-12">
		<div class="well">
			<?=$this->Form->create('Group'); ?>
				<?=$this->Form->input('name');?>
				<?=$this->Form->input('description');?>
			<?=$this->Form->end(__('Submit')); ?>
		</div>
	</div>
</div>
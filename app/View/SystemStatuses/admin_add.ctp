<div class="well">
	<?=$this->Form->create('SystemStatus');?>
		<?=$this->Form->input('system_model_id', array('class' => 'span6'));?>
		<?=$this->Form->input('name', array('class' => 'span6'));?>
		<?=$this->Form->input('description', array('class' => 'span6'));?>
		<div class="btn-group">
			<?=$this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-warning'));?>
			<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-primary'));?>
		</div>
	<?=$this->Form->end(); ?>
</div>

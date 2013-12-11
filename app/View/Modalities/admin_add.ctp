<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h2>
<div class="well">
	<?=$this->Form->create('Modality');?>
		<?=$this->Form->input('modality');?>
		<?=$this->Form->input('description');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
<div class="well">
	<?=$this->Form->create('Modality');?>
		<?=$this->Form->input('modality');?>
		<?=$this->Form->input('description');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
<div class="well">
	<?=$this->Form->create('Modality');?>
		<?=$this->Form->hidden('id', array('value' => $modality['Modality']['id']));?>
		<?=$this->Form->input('modality', array('value' => $modality['Modality']['modality']));?>
		<?=$this->Form->input('description', array('value' => $modality['Modality']['description']));?>
		<?=$this->Form->button(__('Save Changes'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
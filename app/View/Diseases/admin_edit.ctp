<div class="well">
	<?=$this->Form->create('Disease');?>
		<?=$this->Form->hidden('id', array('value' => $disease['Disease']['id']));?>
		<?=$this->Form->input('disease', array('value' => $disease['Disease']['disease']));?>
		<?=$this->Form->input('description', array('value' => $disease['Disease']['description']));?>
		<?=$this->Form->button(__('Save Changes'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
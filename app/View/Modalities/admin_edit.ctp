<h2>
	<?=$title_for_layout;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('New Modality'), array('action' => 'add'), array('class' => 'btn btn-success btn-xs'));?>
	</div>
</h2>
<div class="well">
	<?=$this->Form->create('Modality');?>
		<?=$this->Form->hidden('id', array('value' => $modality['Modality']['id']));?>
		<?=$this->Form->input('modality', array('value' => $modality['Modality']['modality']));?>
		<?=$this->Form->input('description', array('value' => $modality['Modality']['description']));?>
		<?=$this->Form->button(__('Save Changes'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
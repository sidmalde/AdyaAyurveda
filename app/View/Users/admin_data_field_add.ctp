<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="well">
	<?=$this->Form->create('UserDataField', array('url' => array('controller' => 'users', 'action' => 'data_field_add')));?>
		<?=$this->Form->input('gender', array('empty' => __('Please select an option:'), 'options' => $userGenders));?>
		<?=$this->Form->input('field_name');?>
		<?=$this->Form->input('type', array('empty' => __('Please select an option:'), 'options' => $userFieldTypes));?>
		<?=$this->Form->input('values');?>
		<?=$this->Form->input('description');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm'));?>
	</div>
</h3>

<div class="well">
	<?=$this->Form->create('UserDataField', array('url' => array('controller' => 'users', 'action' => 'data_field_edit', 'userDataField' => $userDataField['UserDataField']['id'])));?>
		<?=$this->Form->hidden('id', array('value' => $userDataField['UserDataField']['id']));?>
		<?=$this->Form->input('gender', array('empty' => __('Please select an option:'), 'options' => $userGenders, 'selected' => $userDataField['UserDataField']['gender']));?>
		<?=$this->Form->input('field_name', array('value' => ucwords(implode(" ", explode("_", $userDataField['UserDataField']['field_name'])))));?>
		<?=$this->Form->input('type', array('empty' => __('Please select an option:'), 'options' => $userFieldTypes, 'selected' => $userDataField['UserDataField']['type']));?>
		<?=$this->Form->input('values', array('value' => $userDataField['UserDataField']['values']));?>
		<?=$this->Form->input('description', array('value' => $userDataField['UserDataField']['description']));?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
<h3>
	<?=@$pageTitle;?>
	<div class="btn-group pull-right">
		<?=$this->Html->link(__('Back'), array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-success btn-xs'));?>
	</div>
</h3>

<div class="well">
	<?=$this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add')));?>
		<div class="col-md-6">
			<?=$this->Form->input('group_id', array('empty' => __('Please select an option:'), 'options' => $groups));?>
			<?=$this->Form->input('email');?>
			<?=$this->Form->input('firstname');?>
			<?=$this->Form->input('lastname');?>
			<?=$this->Form->input('password');?>
			<?/* =$this->Form->input('date_of_birth'); */?>
			<?=$this->Form->input('phone');?>
			<?=$this->Form->input('mobile');?>
			<?=$this->Form->input('patient_type', array('empty' => __('Please select an option:'), 'options' => $patientTypes));?>
			<?=$this->Form->input('gender', array('empty' => __('Please select an option:'), 'options' => $userGenders));?>
		</div>
		<div class="col-md-6">
			<?=$this->Form->input('address_1');?>
			<?=$this->Form->input('address_2');?>
			<?=$this->Form->input('address_3');?>
			<?=$this->Form->input('city');?>
			<?=$this->Form->input('region');?>
			<?=$this->Form->input('postcode');?>
			<?=$this->Form->input('country');?>
		</div>
		<div class="clear">&nbsp;</div>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
<?=$this->Form->create('SystemStatus', array('url' => Router::url(array('action' =>'edit', 'systemStatus' => $systemStatus['SystemStatus']['id'])), 'type' => 'file')); ?>
	<?=$this->Form->hidden('id', array('value' => $systemStatus['SystemStatus']['id']));?>
	<?=$this->Form->input('system_model_id', array('class' => 'input-block-level', 'empty' => __('Please select a System Model: '), 'options' => $systemModels, 'selected' => $systemStatus['SystemStatus']['system_model_id']));?>
	<?=$this->Form->input('name', array('class' => 'input-block-level', 'placeholder' => 'name'));?>
	<?=$this->Form->input('description', array('class' => 'input-block-level', 'placeholder' => 'description'));?>
	
	<div class="btn-group">
		<?=$this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-success', 'data-loading-text' =>'Saving...')); ?>
		<?=$this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-danger'), 'Are you sure you want to cancel?'); ?>
	</div>
<?=$this->Form->end(); ?>

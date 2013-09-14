<?php echo $this->Form->create('SystemStatus', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit SystemStatus'); ?></legend>
	<?php
		echo $this->Form->input('id', array('class' => 'input-block-level', 'placeholder' => 'id'));
		echo $this->Form->input('status_type_id', array('class' => 'input-block-level', 'placeholder' => 'status_type_id'));
		echo $this->Form->input('name', array('class' => 'input-block-level', 'placeholder' => 'name'));
		echo $this->Form->input('description', array('class' => 'input-block-level', 'placeholder' => 'description'));
	?>
   	<div class="btn-group">
      <button class="btn btn-success" type="submit" data-loading-text="Saving...">Save</button>
      <?php echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-danger'), 'Are you sure you want to cancel?'); ?>		</div>
	</fieldset>
<?php echo $this->Form->end(); ?>

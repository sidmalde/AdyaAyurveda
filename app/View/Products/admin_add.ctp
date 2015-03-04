<div class="well">
	<?=$this->Form->create('Product');?>
		<?=$this->Form->input('name');?>
		<?=$this->Form->input('description');?>
		<?=$this->Form->input('code');?>
		<?=$this->Form->input('barcode');?>
		<?=$this->Form->input('quantity');?>
		<?=$this->Form->input('measurement', array('empty' => __('Please select an option:')));?>
		<?=$this->Form->input('price');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
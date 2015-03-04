<div class="well">
	<?=$this->Form->create('Product');?>
		<?=$this->Form->hidden('id', array('value' => $product['Product']['id']));?>
		<?=$this->Form->input('name', array('value' => $product['Product']['name']));?>
		<?=$this->Form->input('description', array('value' => $product['Product']['description']));?>
		<?=$this->Form->input('code', array('value' => $product['Product']['code']));?>
		<?=$this->Form->input('barcode', array('value' => $product['Product']['barcode']));?>
		<?=$this->Form->input('quantity', array('value' => $product['Product']['quantity']));?>
		<?=$this->Form->input('measurement', array('empty' => __('Please select an option:'), 'selected' => $product['Product']['measurement']));?>
		<?=$this->Form->input('price', array('value' => $product['Product']['price']));?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
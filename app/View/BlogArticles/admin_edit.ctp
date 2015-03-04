<div class="well">
	<?=$this->Form->create('BlogArticle');?>
		<?=$this->Form->hidden('id');?>
		<?=$this->Form->input('user_id');?>
		<?=$this->Form->input('title');?>
		<?=$this->Form->input('summary');?>
		<?=$this->Form->input('post', array('label' => array('text' => __('Content'))));?>
		<?=$this->Form->input('publish');?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
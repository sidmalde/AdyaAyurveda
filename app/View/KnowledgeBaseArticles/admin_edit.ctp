<div class="well">
	<?=$this->Form->create('KnowledgeBaseArticle');?>
		<?=$this->Form->hidden('id', array('value' => $kbArticle['KnowledgeBaseArticle']['id']));?>
		<?=$this->Form->input('disease_id', array('empty' => __('Please choose an option:'), 'selected' => $kbArticle['KnowledgeBaseArticle']['disease_id']));?>
		<?=$this->Form->input('modality_id', array('empty' => __('Please choose an option:'), 'selected' => $kbArticle['KnowledgeBaseArticle']['modality_id']));?>
		<?=$this->Form->input('title', array('value' => $kbArticle['KnowledgeBaseArticle']['title']));?>
		<?=$this->Form->input('content', array('value' => $kbArticle['KnowledgeBaseArticle']['content']));?>
		<?=$this->Form->button(__('Save'), array('type' => 'submit', 'class' => 'btn btn-success'));?>
	<?=$this->Form->end();?>
</div>
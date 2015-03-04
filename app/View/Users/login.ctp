<div>
	
</div>
<div class="col-md-6 col-md-offset-3">
	<div class="well">
		<?=$this->Form->create('User', array('url' => array('action' => 'login'), 'class' => 'form-loginhorizontal'));?>
			<?=$this->Form->input('email');?>
			<?=$this->Form->input('password');?>
			<?=$this->Form->button(__('Login'), array('type' => 'submit', 'class' => 'btn btn-block btn-info'));?>
		<?=$this->Form->end();?>
	</div>
</div>
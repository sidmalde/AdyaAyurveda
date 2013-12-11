<div>
	
</div>
<div class="col-md-4 col-md-offset-4">
	<div class="well">
		<?=$this->Form->create('User', array('url' => array('action' => 'login'), 'class' => 'form-login'));?>
			<?=$this->Form->input('email', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>', 'after' => '</div>'));?>
			<?=$this->Form->input('password', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-asterisk"></i></span>', 'after' => '</div>'));?>
		<?=$this->Form->button(__('Login'), array('type' => 'submit', 'class' => 'btn btn-block btn-info'));?>
		<?=$this->Form->end();?>
	</div>
</div>
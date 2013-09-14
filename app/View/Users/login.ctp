<div>
	
</div>
<div class="col-xs-4 col-xs-offset-4">
	<div class="well">
		<?=$this->Form->create('User', array('url' => array('action' => 'login'), 'class' => 'form-login'));?>
			<?=$this->Form->input('email', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-user"></i></span>', 'after' => '</div>'));?>
			<?=$this->Form->input('password', array('between' => '<div class="input-group"><span class="input-group-addon"><i class="icon-asterisk"></i></span>', 'after' => '</div>'));?>
		<?=$this->Form->end();?>
	</div>
</div>
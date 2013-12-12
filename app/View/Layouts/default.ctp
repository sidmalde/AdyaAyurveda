<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset(); ?>
	<title><?=$title_for_layout; ?></title>
	<?=$this->Html->meta('icon');?>

	<?=$this->fetch('meta');?>
	<?=$this->fetch('css');?>
	<?=$this->fetch('script');?>
	
	<?=$this->Html->script('jquery-1.10.2.min'); ?>
	
	<?=$this->Html->css('font-awesome/css/font-awesome.min'); ?>
	<?=$this->Html->css('bootstrap.min'); ?>
	<?=$this->Html->css('cerulean_bootstrap.min'); ?>
	<?=$this->Html->css('core'); ?>
	
	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
</head>
<body>
	<div class="container">
		<div id="content" class="row">
			<div class="col-md-12">
				<?=$this->element('header-default');?>
				<?=$this->element('nav-default');?>
				<?=$this->Session->flash(); ?>

				<?=$this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer" class="row">
			<div class="col-md-12">
			</div>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
</body>
</html>

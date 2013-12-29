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
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<?=$this->Session->flash(); ?>

				<?=$this->fetch('content'); ?>
			</div>
			<div class="col-md-3">
				<div class="well">
					<h3><?=__('Contact Us');?></h3>
					<p><i class="fa fa-phone fa-3"></i> <a href="callto:02032877299">020 3287 7299</a></p>
					<p><i class="fa fa-envelope fa-3"></i> <a href="mailto:info@adya-ayurveda.com" traget="_blank">info@adya-ayurveda.com</a></p>
					</p>
				</div>
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

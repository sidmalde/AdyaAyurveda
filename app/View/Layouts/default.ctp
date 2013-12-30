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
	
	<?=$this->Html->css('bootstrap-combined.no-icons.min.css'); ?> 
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
				<p>
					“The herbs and techniques of Ayurveda may seem quite 
					simple on the surface. However, the way they put the 
					body into balance has far reaching effects on the way 
					you feel. You can change the quality of your life if 
					you follow a few simple methods of living, eating and 
					taking herbal food supplements.” -Dr Naram
				</p>
				<img src="/img/pics/ayurveda-basil.jpg" />
				<h3><?=__('Contact Us');?></h3>
				<p><a href="callto:02032877299" traget="_blank"><i class="fa fa-phone fa-xs"></i> 020 3287 7299</a></p>
				<p><a href="mailto:info@adya-ayurveda.com" traget="_blank"><i class="fa fa-envelope fa-xs"></i> info@adya-ayurveda.com</a></p>
				<hr />
				<p class="text-center">
					<a href="https://www.facebook.com/adyaayurveda" target="_blank"><i class="fa fa-facebook-square fa-md"></i></a>
					<a href="#" target="_blank"><i class="fa fa-twitter-square fa-md"></i></a>
					<a href="https://uk.linkedin.com/pub/sarita-nahar/a/a46/a1a" target="_blank"><i class="fa fa-linkedin-square fa-md"></i></a>
				</p>
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

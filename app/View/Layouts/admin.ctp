<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset(); ?>
	<title>
		<?=$title_for_layout; ?>
	</title>
	<?=$this->Html->meta('icon');?>

	<?=$this->fetch('meta');?>
	<?=$this->fetch('css');?>
	<?=$this->fetch('script');?>
	
	<?=$this->Html->script('jquery-1.10.2.min'); ?>
	
	<?=$this->Html->css('bootstrap-combined.no-icons.min.css'); ?> 
	<?=$this->Html->css('font-awesome/css/font-awesome.min'); ?>
	<?=$this->Html->css('bootstrap.min'); ?>
	<?/* =$this->Html->css('slate_bootstrap.min');  */?>
	<?=$this->Html->css('cerulean_bootstrap.min'); ?>
	<?=$this->Html->css('core'); ?>
	
	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
</head>
<body class="admin-layout">
	<?=$this->element('header-admin');?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?=$this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer" class="row">
			<div class="col-md-12">
			</div>
		</div>
		<div class="clear">
		</div>
	</div>
	<?=$this->element('flash_container');?>
</body>
</html>

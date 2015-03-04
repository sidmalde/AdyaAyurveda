<!DOCTYPE html>
<html>
	<head>
		<?=$this->Html->charset(); ?>
		<title><?=$title_for_layout; ?></title>
		<?=$this->Html->meta('icon');?>

		<?=$this->fetch('meta');?>
		
		<?=$this->Html->css('old/bootstrap-combined.no-icons.min.css'); ?>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css" media="all">
		<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/united/bootstrap.min.css" rel="stylesheet">
		<?=$this->Html->css('old/cerulean_bootstrap.min'); ?>
		<?#=$this->Html->css('old/theme'); ?>
		<?=$this->Html->css('old/core'); ?>
		
		<meta property="og:title" content="<?=@$title_for_layout?>&nbsp;" />
		<meta property="og:site_name" content="<?=__('AdyaAyurveda');?>" />
		<meta name="og:description" content="<?=@$pageDescription?>" />
		<meta property="og:url" content="<?=Router::url( $this->here, true );?>" />
		
		<?
		/*
		<meta property="og:image" content="<? if (!empty($this->viewVars['currentWebsite']['Website']['url'])) { echo 'https://www.'.$this->viewVars['currentWebsite']['Website']['url']; } ?>/img/vertical-new-logo-sm.gif" />
		<meta property="og:image:type" content="image/gif" />
		<meta property="og:image:width" content="134" />
		<meta property="og:image:height" content="140" />
		<meta property="og:image" content="<? if (!empty($this->viewVars['currentWebsite']['Website']['url'])) { echo 'https://www.'.$this->viewVars['currentWebsite']['Website']['url']; } ?>/img/vertical-new-logo.gif" />
		<meta property="og:image:type" content="image/gif" />
		<meta property="og:image:width" content="641" />
		<meta property="og:image:height" content="533" />
		<meta property="twitter:account_id" content="4503599629048672" />
		*/
		?>
		
		
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
				<?=$this->element('front-right-column');?>
			</div>
			<div id="footer" class="row">
				<div class="col-md-12">
				</div>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		<?=$this->element('flash_container');?>
		<script src="//code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
		<?=$this->Html->script('bootstrap.min'); ?>
		<?=$this->Html->script('core'); ?>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54f75fbd665cb1f8" async="async"></script>
	</body>
</html>

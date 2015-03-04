<!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title><?=$title_for_layout;?></title>
		
		 <!-- Bootstrap Core CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- Timeline CSS -->
		<link href="/css/plugins/timeline.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="/css/sb-admin-2.css" rel="stylesheet">
		<!-- Morris Charts CSS -->
		<link href="/css/plugins/morris.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Calendar File -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.6/fullcalendar.min.css">
		<!-- DateTimePicker File -->
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/css/bootstrap-datetimepicker.min.css">
		<!-- Admin Core File -->
		<link href="/css/admin-core.css" rel="stylesheet">
		
		
	
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
	</head>
	<body>
		<div id="wrapper">
			<?=$this->element('admin/header');?>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-md-11">
						<h2 class="page-header"><?=$title_for_layout;?></h2>
					</div>
					<div class="col-md-1 header-controls">
						<?
							if(!empty($headerButtons)) {
								foreach($headerButtons as $headerButton) {
									echo $this->Html->link($headerButton['title'], $headerButton['url'], $headerButton['options']);
								}
							}
						?>
					</div>
				</div>
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
			
			<!-- jQuery Version 1.11.0 -->
			<script src="/js/jquery-1.11.0.js"></script>
			<!-- Bootstrap Core JavaScript -->
			<script src="/js/bootstrap.min.js"></script>
			<!-- Metis Menu Plugin JavaScript -->
			<script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
			<!-- Morris Charts JavaScript -->
			<?/*<script src="/js/plugins/morris/raphael.min.js"></script>
			<script src="/js/plugins/morris/morris.min.js"></script>
			<script src="/js/plugins/morris/morris-data.js"></script>*/?>
			<!-- Custom Theme JavaScript -->
			<script src="/js/sb-admin-2.js"></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/js/bootstrap-datetimepicker.min.js"></script>
			
			<?=$this->Html->script('core'); ?>
		</div>
	</body>
</html>
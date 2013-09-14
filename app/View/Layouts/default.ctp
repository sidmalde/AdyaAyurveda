<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
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
	
	<?=$this->Html->css('font-awesome/css/font-awesome.min'); ?>
	<?=$this->Html->css('bootstrap.min'); ?>
	<?=$this->Html->css('slate_bootstrap.min'); ?>
	<?=$this->Html->css('core'); ?>
	
	<?=$this->Html->script('bootstrap.min'); ?>
	<?=$this->Html->script('core'); ?>
</head>
<body>
	<?=$this->element('header-default');?>
	<div class="container">
		<div id="content" class="row">
			<div class="col-xs-12">
				<?=$this->Session->flash(); ?>

				<?=$this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer" class="row">
			<div class="col-xs-12">
			</div>
		</div>
		<div class="clear">
		</div>
	</div>
</body>
</html>

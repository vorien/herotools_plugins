<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $cakeDescription ?>:
			<?= $this->fetch('title') ?>
		</title>

		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('base.css') ?>
		<?= $this->Html->css('cake.css') ?>
		<?= $this->Html->css('Vorien/Dashboard.jqueryui/jquery-ui.min') ?>
		<?= $this->Html->css('Vorien/Dashboard.bootstrap/bootstrap') ?>
		<?= $this->Html->css('Vorien/Dashboard.main') ?>
		<?= $this->Html->css('Vorien/HeroCombat.jqueryui_slider_pips/jquery-ui-slider-pips') ?>
		<?= $this->Html->css('Vorien/HeroCombat.herocombat') ?>
		<?= $this->Html->css('Vorien/HeroCombat.herocombat-margins') ?>

		<?= $this->Html->script('Vorien/Dashboard.jquery/jquery-2.2.4.min') ?>
		<?= $this->Html->script('Vorien/Dashboard.jqueryui/jquery-ui.min') ?>
		<?= $this->Html->script('Vorien/Dashboard.bootstrap/bootstrap.min') ?>
		<?= $this->Html->script('Vorien/HeroCombat.jqueryui_slider_pips/jquery-ui-slider-pips') ?>
		<?= $this->Html->script('Vorien/HeroCombat.lookupfunctions') ?>
		<?= $this->Html->script('Vorien/HeroCombat.levelarrayfunctions') ?>
		<?= $this->Html->script('Vorien/HeroCombat.sliderarrayfunctions') ?>
		<?= $this->Html->script('Vorien/HeroCombat.herocombat') ?>
		<?= $this->Html->script('Vorien/HeroCombat.dcalcfunctions') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>

	</head>

	<body>
		<nav class="top-bar expanded" data-topbar role="navigation">
			<ul class="title-area large-3 medium-4 columns">
				<li class="name">
					<h1><a href=""><?= $this->fetch('title') ?></a></h1>
				</li>
			</ul>
			<div class="top-bar-section">
				<ul class="right">
					<li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
					<li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></li>
				</ul>
			</div>

		</nav>
		<?= $this->Flash->render() ?>
		<div class="container clearfix">
			<?= $this->fetch('content') ?>
		</div>
		<footer>
		</footer>
		<script>
			$(function () {
				$("select[multiple]").each(function () {
					var childcount = $(this).children().length;
					var childheight = $(this).children(":first").height();
					//			console.log(childcount);
					//			console.log(childheight);
					//			console.log($(this).attr("id"));
					//			console.log($(this).children().length);
					$(this).height(childcount * childheight)
				});
			});
		</script>
	</body>
</html>


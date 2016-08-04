<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $this->fetch('title') ?>
		</title>

		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('base.css') ?>
		<?= $this->Html->css('cake.css') ?>
		<?= $this->Html->css('Vorien/Dashboard.jqueryui/jquery-ui.min') ?>
		<?= $this->Html->css('Vorien/Dashboard.bootstrap/bootstrap') ?>
		<?= $this->Html->css('Vorien/Dashboard.main') ?>
		<?= $this->Html->css('Vorien/HeroCSheet.herocombat') ?>
		<?= $this->Html->css('Vorien/HeroCSheet.herocombat-margins') ?>

		<?= $this->Html->script('Vorien/Dashboard.jquery/jquery-2.2.4.min') ?>
		<?= $this->Html->script('Vorien/Dashboard.jqueryui/jquery-ui.min') ?>
		<?= $this->Html->script('Vorien/Dashboard.bootstrap/bootstrap.min') ?>
		<?= $this->Html->script('Vorien/HeroCSheet.jqueryui/jquery.ui.touch-punch.min') ?>
		<?= $this->Html->script('Vorien/HeroCSheet.herocombat') ?>
		<?= $this->Html->script('Vorien/HeroCSheet.tracing/tracing') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>

	</head>

	<body>
    <nav>
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


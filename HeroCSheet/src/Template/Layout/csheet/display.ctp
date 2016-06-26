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
		<title>
			<?= $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('Vorien/HDParser.cake.generic');
		echo $this->Html->css('Vorien/HDParser.jqueryui/jquery-ui.min');
		echo $this->Html->css('Vorien/HDParser.bootstrap/bootstrap');
		echo $this->Html->css('Vorien/HDParser.main');
		echo $this->Html->css('Vorien/HDParser.herocombat');
		echo $this->Html->css('Vorien/HDParser.herocombat-margins');

		echo $this->Html->script('Vorien/HDParser.jquery/jquery-2.1.1.min');
		echo $this->Html->script('Vorien/HDParser.jqueryui/jquery-ui.min');
		echo $this->Html->script('Vorien/HDParser.jqueryui/jquery.ui.touch-punch.min');
		echo $this->Html->script('Vorien/HDParser.bootstrap/bootstrap.min');
		echo $this->Html->script('Vorien/HDParser.herocombat');
		echo $this->Html->script('Vorien/HDParser.tracing/tracing');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
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


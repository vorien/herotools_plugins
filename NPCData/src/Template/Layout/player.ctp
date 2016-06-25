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
			<?= $this->fetch('title') ?>
        </title>
		<?= $this->Html->meta('icon') ?>
		<?= $this->Html->css('base.css') ?>
		<?= $this->Html->css('cake.css') ?>
		<?= $this->Html->css('jqueryui/jquery-ui.css') ?>
		<?= $this->Html->css('jqueryui/jquery-ui.theme.css') ?>
		<?= $this->Html->css('bootstrap/bootstrap.css') ?>
		<?= $this->Html->css('bootstrap/bootstrap-theme.css') ?>
		<?= $this->Html->css('select2/select2.css') ?>
		<?= $this->Html->css('npcdata.css') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>
    </head>
    <body>
		<?= $this->Html->script("jquery/jquery-2.2.4.min.js") ?>
		<?= $this->Html->script('jqueryui/jquery-ui.min.js') ?>
		<?= $this->Html->script('bootstrap/bootstrap.min.js') ?>
		<?= $this->Html->script('select2/select2.js') ?>
		<?= $this->fetch('script') ?>
		<?php // debug($this->request); ?>
		<?php // debug($this->request->params); ?>
		<?php // debug($this->request->params['action']); ?>
        <div class="container-fluid npcnav-wrapper">
            <div class="npcnav npcnav-brand">NPC Data</div>
            <div class="npcnav npcnav-spacer"></div>
            <div class="npcnav npcnav-item"><?= $this->Html->link(__('List NPCs'), ['controller' => 'Playerdata', 'action' => 'index']) ?></div>
            <div class="npcnav npcnav-item"><?= $this->Html->link(__('New NPC'), ['controller' => 'Playerdata', 'action' => 'addperson']) ?></div>
			<?php
			switch ($this->request->params['action']) {
				case 'view':
					echo('<div class="npcnav npcnav-item">' . $this->Html->link(__('Edit Persona'), ['controller' => 'Playerdata', 'action' => 'edit', $this->request->params['pass'][0]]) . '</div>');
					break;
				case 'edit':
					echo('<div class="npcnav npcnav-item">' . $this->Html->link(__('View Persona'), ['controller' => 'Playerdata', 'action' => 'view', $this->request->params['pass'][0]]) . '</div>');
					break;
				default:
					//No request value or not view/edit, ignored
					break;
			}
			?>
        </div>
		<?= $this->Flash->render() ?>
        <div class="container clearfix">
			<?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>
        <script>
			$(function () {
				$(".slider").each(function () {
					var $this = $(this);
					var defaultvalue = $(".personality", $this).data('value');
					var disabled = $(".personality", $this).data('disabled');
					// find any .slider-range element WITHIN scope of $this
					$(".personality-slider", $this).slider({
						range: "min",
						min: 0,
						max: 100,
						value: defaultvalue,
						disabled: disabled,
						slide: function (event, ui) {
							// find any element with class .amount WITHIN scope of $this
							$(".personality", $this).val(ui.value);
						}
					});
				});
				$('.selectmultiple').select2({
						dropdownAutoWidth: false,
						closeOnSelect: false,
						tags: true,
						width: '100%',
						minimumResultsForSearch: Infinity
					});
			});
        </script>
    </body>

</html>

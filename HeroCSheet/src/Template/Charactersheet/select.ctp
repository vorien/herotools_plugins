<?php
$characterlist = array();
$templatelist = array();

foreach ($characterfiles as $characterfile) {
	$characterlist[$characterfile] = $characterfile;
}
foreach ($templates as $template) {
	$templatelist[$template] = $template;
}
?>

<div id="page-container" class="row">
	<div id="page-content" class="col-xs-6"></div>
	<div id="page-content" class="col-xs-12">
		<h2><?php echo __('Select Character and Base Template'); ?></h2>
		<div class="form character">
			<?php
			echo $this->Form->create(null, [ 'type' => 'post']);
			if (!empty($characterlist)) {
				echo $this->Form->input('character', array(
					'options' => $characterlist
				));
				echo $this->Form->hidden('action', ['default' => 'display']);
				if (!empty($templatelist)) {
					echo $this->Form->input('main', array(
						'options' => $templatelist
					));
					echo $this->Form->submit('Select');
					echo $this->Form->end();
					$buttontext = "Upload A Character or Template";
				} else {
					$buttontext = "Upload A Template";
				}
			} else {
				$buttontext = "Upload A Character";
			}
			?>
		</div>
		<div class="form upload">
			<?php
			echo $this->Form->create(null, [ 'type' => 'post']);
			echo $this->Form->hidden('action', ['default' => 'upload']);
			echo $this->Form->submit($buttontext);
			echo $this->Form->end();
			?>
		</div>
	</div>
	<div id="page-content" class="col-xs-6"></div>
</div>


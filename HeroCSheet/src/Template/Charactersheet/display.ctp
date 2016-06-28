<?php
//debug($characteristics); 
//debug($regularskills); 
//debug($norollskills);S
//debug($backgroundskills); 
//debug($talents); 
//debug($perks); 
//debug($activespells); 
//debug($castspells);
//debug($powers);
?>
<style>
	body{
		background-color: white;
	}
	.print-button form div.submit{
		margin: 0;
		padding: 0;
	}
	iframe{
		display: none;
	}
</style>

<div class="content" style="font-size: smaller; background-color: #FFF; padding: 10px;">
	<div class='row'>
		<div class='col-xs-22'>
			<?php
			if ($print == 'display') {
				echo $this->element('Vorien/HeroCSheet.display/navtabs');
				echo $this->element('Vorien/HeroCSheet.display/tabpanelcharacteristics');
			}
			?>

			<div class="row first-in-panel">
				<div class="col-xs-5">
					<div class="row">
						<div class="col-xs-8 column-head">Attribute</div>
						<div class="col-xs-4 column-head">Value</div>
						<div class="col-xs-4 column-head">Cost</div>
						<div class="col-xs-4 column-head">Roll</div>
					</div>
					<?php
					foreach ($characteristics as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-8">
								<?php echo $value['stat']; ?>
							</div>
							<div class="col-xs-4">
								<?php echo $value['value']; ?>
							</div>
							<div class="col-xs-4">
								<?php echo $value['cost']; ?>
							</div>
							<div class="col-xs-4">
								<?php echo $value['roll'] . (!empty($value['roll']) ? "-" : ""); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="col-xs-11">
					<div class="row">
						<div class="col-xs-24">
							<div class="row">
								<div class="col-xs-8 column-head">Skill</div>
								<div class="col-xs-2 column-head">Roll</div>
								<div class="col-xs-2 column-head">Cost</div>
								<div class="col-xs-10 column-head">Notes</div>
							</div>
							<?php
							foreach ($regularskills as $key => $value) {
								?>
								<div class="row">
									<div class="col-xs-8">
										<?php echo (array_key_exists('display', $value) ? $value['display'] . (array_key_exists('star', $value) ? "<span class='asterisk'>*</span>" : "") : "&nbsp;"); ?>
									</div>
									<div class="col-xs-2">
										<?php echo $this->Display->getSkillRoll($value, $characteristics); ?>
									</div>
									<div class="col-xs-2">
										<?php echo (array_key_exists('cost', $value) ? $value['cost'] : "&nbsp;"); ?>
									</div>
									<div class="col-xs-10 small">
										<?php echo $this->Display->displayExtras($value); ?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<div class="row second-in-panel">
						<div class="col-xs-24">
							<div class="row">
								<div class="col-xs-8 column-head">Skill</div>
								<div class="col-xs-2 column-head">Cost</div>
								<div class="col-xs-10 column-head">Notes</div>
							</div>
							<?php
							foreach ($norollskills as $key => $value) {
								?>
								<div class="row">
									<div class="col-xs-8">
										<?php echo (array_key_exists('display', $value) ? $value['display'] . (array_key_exists('star', $value) ? "<span class='asterisk'>*</span>" : "") : "&nbsp;"); ?>
									</div>
									<div class="col-xs-2">
										<?php echo (array_key_exists('cost', $value) ? $value['cost'] : "&nbsp;"); ?>
									</div>
									<div class="col-xs-10 small">
										<?php echo $this->Display->displayExtras($value); ?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-xs-8">

					<div class="row">
						<div class="col-xs-10 column-head">Skill</div>
						<div class="col-xs-2 column-head">Roll</div>
						<div class="col-xs-2 column-head">Cost</div>
					</div>
					<?php
					foreach ($backgroundskills as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-10">
								<?php echo (array_key_exists('display', $value) ? $value['display'] . (array_key_exists('star', $value) ? "*" : "") : "&nbsp;"); ?>
							</div>
							<div class="col-xs-2">
								<?php echo $this->Display->getSkillRoll($value, $characteristics); ?>
							</div>
							<div class="col-xs-2">
								<?php echo (array_key_exists('cost', $value) ? $value['cost'] : "&nbsp;"); ?>
							</div>
						</div>
						<?php
					}
					?>

				</div>
			</div>
			<?php
			if ($print == 'display') {
				echo $this->element('Vorien/HeroCSheet.display/tabpaneltpa');
			} else {
				echo $this->element('Vorien/HeroCSheet.print/pagebreak');
			}
			?>
			<div class ="row first-in-panel">
				<div class="col-xs-24">
					<?php $perktabs = array(3, 4, 2, 2, 13); ?>
					<div class="row">
						<div class="col-xs-<?= $perktabs[0] ?> column-head">Perk</div>
						<div class="col-xs-<?= $perktabs[1] ?> column-head">Type</div>
						<div class="col-xs-<?= $perktabs[2] ?> column-head">Roll</div>
						<div class="col-xs-<?= $perktabs[3] ?> column-head">Cost</div>
						<div class="col-xs-<?= $perktabs[4] ?> column-head">Notes</div>
					</div>
					<?php
					foreach ($perks as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-<?= $perktabs[0] ?>">
								<?php echo $value['name']; ?>
							</div>
							<div class="col-xs-<?= $perktabs[1] ?> small">
								<?php echo $value['alias']; ?>
							</div>
							<div class="col-xs-<?= $perktabs[2] ?>">
								<?php echo (array_key_exists('roll', $value) ? $value['roll'] . (!empty($value['roll']) ? "-" : "") : "&nbsp;"); ?>
							</div>
							<div class="col-xs-<?= $perktabs[3] ?>">
								<?php echo $value['cost']; ?>
							</div>
							<div class="col-xs-<?= $perktabs[4] ?> small">
								<?php echo $this->Display->displayExtras($value); ?>
							</div>
						</div>
						<hr class="min-padding">
						<?php
					}
					?>
				</div>
			</div>
			<div class="row second-in-panel">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-6 column-head">Talent</div>
						<div class="col-xs-2 column-head">Cost</div>
						<div class="col-xs-12 column-head">Notes</div>
					</div>
					<?php
					foreach ($talents as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-6">
								<?php echo $value['display']; ?>
							</div>
							<div class="col-xs-2">
								<?php echo $value['cost']; ?>
							</div>
							<div class="col-xs-12 small">
								<?php echo $this->Display->displayExtras($value); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-8 column-head">Ability</div>
						<div class="col-xs-2 column-head">Levels</div>
						<div class="col-xs-2 column-head">Cost</div>
						<div class="col-xs-10 column-head">Notes</div>
					</div>
					<?php
					foreach ($activespells as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-8">
								<?php echo $value['display']; ?>
							</div>
							<div class="col-xs-2">
								<?php echo (array_key_exists('levels', $value) ? ($value['levels'] !== 0 ? $value['levels'] : "&nbsp;") : "&nbsp;"); ?>
							</div>
							<div class="col-xs-2">
								<?php echo round($value['cost']); ?>
							</div>
							<div class="col-xs-10 small">
								<?php echo $this->Display->displayExtras($value); ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
			if ($print == 'display') {
				echo $this->element('Vorien/HeroCSheet.display/tabpanelcomplications');
			}
			?>
			<div class ="row first-in-panel">
				<div class="col-xs-24">
					<?php $complicationtabs = array(8, 4, 1, 10); ?>
					<div class="row">
						<div class="col-xs-<?= $complicationtabs[0] ?> column-head">Complication</div>
						<div class="col-xs-<?= $complicationtabs[1] ?> column-head">Type</div>
						<div class="col-xs-<?= $complicationtabs[2] ?> column-head">Value</div>
						<div class="col-xs-<?= $complicationtabs[3] ?> column-head">Notes</div>
					</div>
					<?php
					foreach ($complications as $key => $value) {
						?>
						<div class="row">
							<div class="col-xs-<?= $complicationtabs[0] ?>">
								<?php echo $value['input']; ?>
							</div>
							<div class="col-xs-<?= $complicationtabs[1] ?> small">
								<?php echo $value['alias']; ?>
							</div>
							<div class="col-xs-<?= $complicationtabs[2] ?>">
								<?php echo $value['cost']; ?>
							</div>
							<div class="col-xs-<?= $complicationtabs[3] ?> small">
								<?php echo $this->Display->displayExtras($value, true); ?>
							</div>
						</div>
						<hr class="min-padding">
						<?php
					}
					?>
				</div>
			</div>
			<?php
			if ($print == 'display') {
				echo $this->element('Vorien/HeroCSheet.display/tabpanelclose');
			}
			?>
		</div>
		<div class="col-xs-2 print-button">
			<?php
			echo $this->Form->create(null, ['type' => 'post']);
			echo $this->Form->hidden('action', ['value' => ($print == 'display' ? 'print' : 'display')]);
			echo $this->Form->submit(ucfirst($print == 'display' ? 'print' : 'display'));
			echo $this->Form->end();
			?>
		</div>

	</div>
</div>

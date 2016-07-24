<?php

$this->set('title', 'Dossier Data');
	$this->set('action', 'view');
?>
<legend><?= __('Dossier for: ' . $persona->person->name) ?></legend>
<div class='page-wrapper'>
	<ul class="nav nav-tabs nav-justified">
		<!--<li class='named-tab'><?= h($persona->person->name) ?></li>-->
		<li class="active"><a data-toggle="tab" href="#main">Main</a></li>
		<li><a data-toggle="tab" href="#details">Details</a></li>
		<li><a data-toggle="tab" href="#notes">Notes</a></li>
	</ul>
	<div class="tab-content">
		<div id="main" class="tab-pane fade in active">
			<div class="row">
				<div class="col-xs-12">
					<div class='row' style='height: 15em;'><div class='col-xs-8'>
							<img class='resizedatserver' data-image="<?= $persona->picture ?>">
						</div></div>
					<div class='row'>&nbsp;</div>
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Name') ?></div><div class='col-xs-12'><?= $persona->has('person') ? $persona->person->name : '' ?></div></div>
					<!--			<div class='row'><div class='col-xs-6 text-primary'><?= __('Agenda') ?></div><div class='col-xs-12'><?= $persona->has('agenda') ? $persona->agenda->name : '' ?></div></div>-->
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Profession') ?></div><div class='col-xs-12'><?= h($persona->profession) ?></div></div>
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Employer') ?></div><div class='col-xs-12'><?= h($persona->employer) ?></div></div>
					<!--			<div class='row'><div class='col-xs-6 text-primary'><?= __('Id') ?></div><div class='col-xs-12'><?= $this->Number->format($persona->id) ?></div></div>-->
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Influence') ?></div><div class='col-xs-12'><?= $this->Number->format($persona->influence) ?></div></div>
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Wealth') ?></div><div class='col-xs-12'><?= $this->Number->format($persona->wealth) ?></div></div>
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Created') ?></div><div class='col-xs-12'><?= h($persona->created) ?></div></div>
					<div class='row'><div class='col-xs-6 text-primary'><?= __('Modified') ?></div><div class='col-xs-12'><?= h($persona->modified) ?></div></div>
				</div>
				<div class="col-xs-12">
<?php
foreach ($personalities as $personality) {
$personalityname = strtolower($personality['name']);
?>
					<div class="slider">
						<div class="row">
							<div class="col-xs-7 text-primary"><?= __($personality['name']) ?></div>
							<div class='col-xs-5 virtue'><?= $personality['virtue'] ?></div>
							<div class="ps-wrapper col-xs-7 personality" data-value="<?= $persona->$personalityname ?>" data-disabled=1><div class="personality-slider"></div></div>
							<div class='col-xs-5 vice'><?= $personality['vice'] ?></div>
						</div>
					</div>
<?php
}
?>
				</div>
			</div>
		</div>
		<div id="details" class="tab-pane fade">
<?php
$rowclass = ['name' => 'col-xs-7', 'description' => 'col-xs-17', 'related' => 'col-xs-6', 'relatedrows' => 'col-xs-18'];
$related = ['Archetypes', 'Flaws', 'Guilds', 'Motivations', 'Qualities', 'Quirks'];
foreach ($related as $value) {
$assoc = strtolower($value);
?>
			<div class="row">
				<div class="<?= $rowclass['related'] ?> related-heading"><?= __("Related $value") ?></div>
				<div class='<?= $rowclass['relatedrows'] ?>'>
<?php if (!empty($persona->$assoc)): ?>
					<div class="row">
						<div class="<?= $rowclass['name'] ?> assoc-name-heading"><?= __('Name') ?></div>
						<div class="<?= $rowclass['description'] ?> assoc-description-heading"><?= __('Description') ?></div>
					</div>
<?php foreach ($persona->$assoc as $relatedassoc): ?>
					<div class="row line-above">
						<div class="<?= $rowclass['name'] ?> assoc-name-content"><?= h($relatedassoc->name) ?></div>
						<div class="<?= $rowclass['description'] ?> assoc-description-content"><?= h($relatedassoc->description) ?></div>
					</div>
<?php endforeach; ?>
<?php endif; ?>
				</div>
			</div>
			<div class='row'>&nbsp;</div>
<?php
}
?>
		</div>
		<div id="notes" class="tab-pane fade">
			<?php
			//debug($persona->notes);
			foreach($persona->notes as $note){
				echo('<div id="' . $note['id'] . '" class="display-note">' . $note['note'] . '</div>');
			}
				?>
		</div>
	</div>
</div>

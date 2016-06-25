<?php $this->set('title', 'Add Dossier Data'); ?>
<div class="personas form large-9 medium-8 columns content">
	<?= $this->Form->create($persona) ?>
    <fieldset>
        <legend><?= __('Add Dossier for: ' . $persona->person->name) ?></legend>
		<?php
		echo '<input type="hidden" name="person_id" value="' . $persona->person_id . '">' . "\n";
		echo '<input type="hidden" name="agenda_id" value="4">' . "\n";
		echo $this->Form->input('profession');
		echo $this->Form->input('employer');
		echo $this->Form->input('influence');
		echo $this->Form->input('wealth');
		echo $this->Form->input('picture');
        echo $this->Form->input('gender');
		foreach ($personalities as $personality) {
			$personalityname = strtolower($personality['name']);
			?>
			<div class="slider">
				<div class="row p-wrapper">
					<div class="col-xs-4">
						<label for="<?= $personalityname ?>"><?= $personality['name'] ?></label>
						<input  id="<?= $personalityname ?>" type="hidden" name="<?= $personalityname ?>" value="<?= $persona->$personalityname ?>" data-value="<?= $persona->$personalityname ?>" class="personality"></input>
					</div>
					<div class='col-xs-4 virtue'><?= $personality['virtue'] ?></div>
					<div class="ps-wrapper col-xs-10"><div class="personality-slider"></div></div>
					<div class='col-xs-4 vice'><?= $personality['vice'] ?></div>
				</div>
			</div>
			<?php
		}
		echo $this->Form->input('archetypes._ids', ['options' => $archetypes]);
		echo $this->Form->input('flaws._ids', ['options' => $flaws]);
		echo $this->Form->input('guilds._ids', ['options' => $guilds]);
		echo $this->Form->input('motivations._ids', ['options' => $motivations]);
		echo $this->Form->input('qualities._ids', ['options' => $qualities]);
		echo $this->Form->input('quirks._ids', ['options' => $quirks]);
		?>
    </fieldset>
	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
	<?= $this->Form->end() ?>
</div>

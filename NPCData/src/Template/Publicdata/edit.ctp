<?php
$this->set('title', 'Modify Dossier Data'); 
?>
<div class="personas form large-9 medium-8 columns content">
	<legend><?= __('Edit Dossier for: ' . $persona->person->name) ?></legend>
	<ul class="nav nav-tabs nav-justified">
		<!--<li class='named-tab'><?= h($persona->person->name) ?></li>-->
		<li class="active"><a data-toggle="tab" href="#main">Main</a></li>
		<li><a data-toggle="tab" href="#details">Details</a></li>
		<li><a data-toggle="tab" href="#notes">Notes</a></li>
	</ul>
	<?= $this->Form->create($persona); ?>
	<div class="tab-content">
		<div id="main" class="tab-pane fade in active">
				<?php
				echo '<input type="hidden" name="person_id" value="' . $persona->person_id . '">' . "\n";
				echo '<input type="hidden" name="agenda_id" value="1">' . "\n";
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
				?>
				<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-submit']); ?>
		</div>
		<div id="details" class="tab-pane fade in">
			<?php
				echo $this->Form->input('archetypes._ids', ['options' => $archetypes, 'class' => 'selectmultiple']);
				echo $this->Form->input('flaws._ids', ['options' => $flaws, 'class' => 'selectmultiple']);
				echo $this->Form->input('guilds._ids', ['options' => $guilds, 'class' => 'selectmultiple']);
				echo $this->Form->input('motivations._ids', ['options' => $motivations, 'class' => 'selectmultiple']);
				echo $this->Form->input('qualities._ids', ['options' => $qualities, 'class' => 'selectmultiple']);
				echo $this->Form->input('quirks._ids', ['options' => $quirks, 'class' => 'selectmultiple']);
			?>
			<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-submit']) ?>
		</div>
	<?= $this->Form->end() ?>
		<div id="notes" class="tab-pane fade in">
			<?php
//			debug($persona->notes);
				echo '<div class="clearfix">';
				echo $this->Form->create($newnote, ['url' => ['action' => 'addnote']]);
				echo $this->Form->hidden('persona_id', ['default' => $persona->id]);
				echo $this->Form->textarea('note', ['class' => 'textarea-withbutton']);
				echo $this->Form->button(__('Add Note'), ['class' => 'btn btn-primary btn-submit btn-textarea-left']);
				echo $this->Form->end();
				echo '</div>';
			foreach($persona->notes as $note){
				echo $this->Form->create($note, ['url' => ['action' => 'editnote', $note->id]]);
				echo $this->Form->hidden('persona_id', ['default' => $note->persona_id]);
				echo $this->Form->textarea('note', ['class' => 'textarea-withbutton']);
				echo $this->Form->button(__('Update Note'), ['class' => 'btn btn-primary btn-submit btn-textarea-left']);
				echo $this->Form->end();
			}
			?>
		</div>
	</div>
</div>



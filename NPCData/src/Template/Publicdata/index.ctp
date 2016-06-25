<?php $this->set('title', 'NPC Dossiers'); ?>
<div class="content">
	<?php foreach ($publiclist as $npc) { ?>
		<div class='row'>
			<div class='col-xs-2'><?= $this->Html->image('baldemar/' . $npc['picture']) ?></div>
			<div class='col-xs-1'>&nbsp;</div>
			<div class='col-xs-6 text-center'>
				<div class='row'>
					<div class='col-xs-24'><h2><?= $npc['person']['name'] ?></h2></div>
					<div class='col-xs-24'><b><?= $npc['profession'] ?></b></div>
				</div>
				<div class='row'>
			<div class='col-xs-4'>&nbsp;</div>
					<div class='col-xs-8'><?= $this->Html->link(__('View'), ['action' => 'view', $npc['id']]) ?></div>
					<div class='col-xs-8'><?= $this->Html->link(__('Edit'), ['action' => 'edit', $npc['id']]) ?></div>
			<div class='col-xs-4'>&nbsp;</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>


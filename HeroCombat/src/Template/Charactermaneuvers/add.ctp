<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['controller' => 'Maneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Maneuver'), ['controller' => 'Maneuvers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="charactermaneuvers form large-9 medium-8 columns content">
    <?= $this->Form->create($charactermaneuver) ?>
    <fieldset>
        <legend><?= __('Add Charactermaneuver') ?></legend>
        <?php
            echo $this->Form->input('character_id', ['options' => $characters, 'empty' => true]);
            echo $this->Form->input('maneuver_id', ['options' => $maneuvers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

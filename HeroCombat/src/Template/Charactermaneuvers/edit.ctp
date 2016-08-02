<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $charactermaneuver->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $charactermaneuver->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['controller' => 'Maneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Maneuver'), ['controller' => 'Maneuvers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="charactermaneuvers form large-9 medium-8 columns content">
    <?= $this->Form->create($charactermaneuver) ?>
    <fieldset>
        <legend><?= __('Edit Charactermaneuver') ?></legend>
        <?php
            echo $this->Form->input('characterstat_id', ['options' => $characterstats, 'empty' => true]);
            echo $this->Form->input('maneuver_id', ['options' => $maneuvers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

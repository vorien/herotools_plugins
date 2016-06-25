<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="maneuvers form large-9 medium-8 columns content">
    <?= $this->Form->create($maneuver) ?>
    <fieldset>
        <legend><?= __('Add Maneuver') ?></legend>
        <?php
            echo $this->Form->input('sort_order');
            echo $this->Form->input('effect');
            echo $this->Form->input('type');
            echo $this->Form->input('maneuver');
            echo $this->Form->input('phase');
            echo $this->Form->input('ocv_action');
            echo $this->Form->input('ocv_amt');
            echo $this->Form->input('dcv_action');
            echo $this->Form->input('dcv_amt');
            echo $this->Form->input('dmg_action');
            echo $this->Form->input('dmg_amt');
            echo $this->Form->input('rng_action');
            echo $this->Form->input('rng_amt');
            echo $this->Form->input('str_action');
            echo $this->Form->input('str_amt');
            echo $this->Form->input('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

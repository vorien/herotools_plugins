<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Weapons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weapons form large-9 medium-8 columns content">
    <?= $this->Form->create($weapon) ?>
    <fieldset>
        <legend><?= __('Add Weapon') ?></legend>
        <?php
            echo $this->Form->input('weapon');
            echo $this->Form->input('type');
            echo $this->Form->input('str_overage');
            echo $this->Form->input('str_adds_damage');
            echo $this->Form->input('ocv');
            echo $this->Form->input('dcv');
            echo $this->Form->input('damage_classes');
            echo $this->Form->input('damage_type');
            echo $this->Form->input('damage_effect');
            echo $this->Form->input('stunx');
            echo $this->Form->input('str_min');
            echo $this->Form->input('body');
            echo $this->Form->input('def');
            echo $this->Form->input('mass');
            echo $this->Form->input('ar_cost');
            echo $this->Form->input('length');
            echo $this->Form->input('hands');
            echo $this->Form->input('shots');
            echo $this->Form->input('thrown');
            echo $this->Form->input('rmod');
            echo $this->Form->input('max_range');
            echo $this->Form->input('concentration');
            echo $this->Form->input('advantages');
            echo $this->Form->input('notes');
            echo $this->Form->input('str_overage_old');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weapons'), ['controller' => 'Weapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weapon'), ['controller' => 'Weapons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterweapons form large-9 medium-8 columns content">
    <?= $this->Form->create($characterweapon) ?>
    <fieldset>
        <legend><?= __('Add Characterweapon') ?></legend>
        <?php
            echo $this->Form->input('characterstat_id', ['options' => $characterstats, 'empty' => true]);
            echo $this->Form->input('weapon_id', ['options' => $weapons, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('ocv_modifier');
            echo $this->Form->input('dcv_modifier');
            echo $this->Form->input('damage_classes_modifier');
            echo $this->Form->input('str_min_modifier');
            echo $this->Form->input('range_modifier');
            echo $this->Form->input('max_range_modifier');
            echo $this->Form->input('offhand_offset');
            echo $this->Form->input('offhand_defense');
            echo $this->Form->input('multi_attack_offset');
            echo $this->Form->input('weapon_element');
            echo $this->Form->input('notes');
            echo $this->Form->input('characterlevels._ids', ['options' => $characterlevels]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

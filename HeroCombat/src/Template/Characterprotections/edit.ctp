<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $characterprotection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $characterprotection->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Coverings'), ['controller' => 'Coverings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Covering'), ['controller' => 'Coverings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Armors'), ['controller' => 'Armors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armor'), ['controller' => 'Armors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterprotections form large-9 medium-8 columns content">
    <?= $this->Form->create($characterprotection) ?>
    <fieldset>
        <legend><?= __('Edit Characterprotection') ?></legend>
        <?php
            echo $this->Form->input('active');
            echo $this->Form->input('character_id', ['options' => $characters, 'empty' => true]);
            echo $this->Form->input('location_id', ['options' => $locations, 'empty' => true]);
            echo $this->Form->input('covering_id', ['options' => $coverings, 'empty' => true]);
            echo $this->Form->input('armor_id', ['options' => $armors, 'empty' => true]);
            echo $this->Form->input('material_id', ['options' => $materials, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('n_pd_modifier');
            echo $this->Form->input('n_ed_modifier');
            echo $this->Form->input('r_pd_modifiers');
            echo $this->Form->input('r_ed_modifiers');
            echo $this->Form->input('stealth_penalty');
            echo $this->Form->input('weight_modifier');
            echo $this->Form->input('training_penalty_offset');
            echo $this->Form->input('normal_dr');
            echo $this->Form->input('killing_dr');
            echo $this->Form->input('notes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

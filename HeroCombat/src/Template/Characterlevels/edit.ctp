<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $characterlevel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Levels'), ['controller' => 'Levels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Level'), ['controller' => 'Levels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterlevels form large-9 medium-8 columns content">
    <?= $this->Form->create($characterlevel) ?>
    <fieldset>
        <legend><?= __('Edit Characterlevel') ?></legend>
        <?php
            echo $this->Form->input('character_id', ['options' => $characters, 'empty' => true]);
            echo $this->Form->input('level_id', ['options' => $levels, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('qty');
            echo $this->Form->input('characterweapons._ids', ['options' => $characterweapons]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $characterlevelsCharacterweapon->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevelsCharacterweapon->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Characterlevels Characterweapons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterlevelsCharacterweapons form large-9 medium-8 columns content">
    <?= $this->Form->create($characterlevelsCharacterweapon) ?>
    <fieldset>
        <legend><?= __('Edit Characterlevels Characterweapon') ?></legend>
        <?php
            echo $this->Form->input('characterlevel_id', ['options' => $characterlevels, 'empty' => true]);
            echo $this->Form->input('characterweapon_id', ['options' => $characterweapons, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

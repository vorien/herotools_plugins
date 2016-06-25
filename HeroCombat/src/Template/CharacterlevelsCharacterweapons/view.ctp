<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Characterlevels Characterweapon'), ['action' => 'edit', $characterlevelsCharacterweapon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Characterlevels Characterweapon'), ['action' => 'delete', $characterlevelsCharacterweapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevelsCharacterweapon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels Characterweapons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevels Characterweapon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characterlevelsCharacterweapons view large-9 medium-8 columns content">
    <h3><?= h($characterlevelsCharacterweapon->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Characterlevel') ?></th>
            <td><?= $characterlevelsCharacterweapon->has('characterlevel') ? $this->Html->link($characterlevelsCharacterweapon->characterlevel->name, ['controller' => 'Characterlevels', 'action' => 'view', $characterlevelsCharacterweapon->characterlevel->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Characterweapon') ?></th>
            <td><?= $characterlevelsCharacterweapon->has('characterweapon') ? $this->Html->link($characterlevelsCharacterweapon->characterweapon->name, ['controller' => 'Characterweapons', 'action' => 'view', $characterlevelsCharacterweapon->characterweapon->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($characterlevelsCharacterweapon->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($characterlevelsCharacterweapon->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($characterlevelsCharacterweapon->modified) ?></td>
        </tr>
    </table>
</div>

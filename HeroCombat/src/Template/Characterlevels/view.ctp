<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Characterlevel'), ['action' => 'edit', $characterlevel->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Characterlevel'), ['action' => 'delete', $characterlevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevel->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Levels'), ['controller' => 'Levels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Level'), ['controller' => 'Levels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characterlevels view large-9 medium-8 columns content">
    <h3><?= h($characterlevel->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Characterstat') ?></th>
            <td><?= $characterlevel->has('characterstat') ? $this->Html->link($characterlevel->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterlevel->characterstat->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Level') ?></th>
            <td><?= $characterlevel->has('level') ? $this->Html->link($characterlevel->level->id, ['controller' => 'Levels', 'action' => 'view', $characterlevel->level->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($characterlevel->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($characterlevel->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Qty') ?></th>
            <td><?= $this->Number->format($characterlevel->qty) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($characterlevel->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($characterlevel->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterweapons') ?></h4>
        <?php if (!empty($characterlevel->characterweapons)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Characterstat Id') ?></th>
                <th><?= __('Weapon Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Ocv Modifier') ?></th>
                <th><?= __('Dcv Modifier') ?></th>
                <th><?= __('Damage Classes Modifier') ?></th>
                <th><?= __('Str Min Modifier') ?></th>
                <th><?= __('Range Modifier') ?></th>
                <th><?= __('Max Range Modifier') ?></th>
                <th><?= __('Offhand Offset') ?></th>
                <th><?= __('Offhand Defense') ?></th>
                <th><?= __('Multi Attack Offset') ?></th>
                <th><?= __('Weapon Element') ?></th>
                <th><?= __('Notes') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($characterlevel->characterweapons as $characterweapons): ?>
            <tr>
                <td><?= h($characterweapons->id) ?></td>
                <td><?= h($characterweapons->characterstat_id) ?></td>
                <td><?= h($characterweapons->weapon_id) ?></td>
                <td><?= h($characterweapons->name) ?></td>
                <td><?= h($characterweapons->ocv_modifier) ?></td>
                <td><?= h($characterweapons->dcv_modifier) ?></td>
                <td><?= h($characterweapons->damage_classes_modifier) ?></td>
                <td><?= h($characterweapons->str_min_modifier) ?></td>
                <td><?= h($characterweapons->range_modifier) ?></td>
                <td><?= h($characterweapons->max_range_modifier) ?></td>
                <td><?= h($characterweapons->offhand_offset) ?></td>
                <td><?= h($characterweapons->offhand_defense) ?></td>
                <td><?= h($characterweapons->multi_attack_offset) ?></td>
                <td><?= h($characterweapons->weapon_element) ?></td>
                <td><?= h($characterweapons->notes) ?></td>
                <td><?= h($characterweapons->created) ?></td>
                <td><?= h($characterweapons->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characterweapons', 'action' => 'view', $characterweapons->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characterweapons', 'action' => 'edit', $characterweapons->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characterweapons', 'action' => 'delete', $characterweapons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterweapons->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Characterweapon'), ['action' => 'edit', $characterweapon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Characterweapon'), ['action' => 'delete', $characterweapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterweapon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weapons'), ['controller' => 'Weapons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weapon'), ['controller' => 'Weapons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characterweapons view large-9 medium-8 columns content">
    <h3><?= h($characterweapon->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Characterstat') ?></th>
            <td><?= $characterweapon->has('characterstat') ? $this->Html->link($characterweapon->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterweapon->characterstat->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Weapon') ?></th>
            <td><?= $characterweapon->has('weapon') ? $this->Html->link($characterweapon->weapon->id, ['controller' => 'Weapons', 'action' => 'view', $characterweapon->weapon->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($characterweapon->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Notes') ?></th>
            <td><?= h($characterweapon->notes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($characterweapon->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Ocv Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->ocv_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Dcv Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->dcv_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Damage Classes Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->damage_classes_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Min Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->str_min_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Range Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->range_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Max Range Modifier') ?></th>
            <td><?= $this->Number->format($characterweapon->max_range_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Offhand Offset') ?></th>
            <td><?= $this->Number->format($characterweapon->offhand_offset) ?></td>
        </tr>
        <tr>
            <th><?= __('Offhand Defense') ?></th>
            <td><?= $this->Number->format($characterweapon->offhand_defense) ?></td>
        </tr>
        <tr>
            <th><?= __('Multi Attack Offset') ?></th>
            <td><?= $this->Number->format($characterweapon->multi_attack_offset) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($characterweapon->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($characterweapon->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Weapon Element') ?></th>
            <td><?= $characterweapon->weapon_element ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterlevels') ?></h4>
        <?php if (!empty($characterweapon->characterlevels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Characterstat Id') ?></th>
                <th><?= __('Level Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Qty') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($characterweapon->characterlevels as $characterlevels): ?>
            <tr>
                <td><?= h($characterlevels->id) ?></td>
                <td><?= h($characterlevels->characterstat_id) ?></td>
                <td><?= h($characterlevels->level_id) ?></td>
                <td><?= h($characterlevels->name) ?></td>
                <td><?= h($characterlevels->qty) ?></td>
                <td><?= h($characterlevels->created) ?></td>
                <td><?= h($characterlevels->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characterlevels', 'action' => 'view', $characterlevels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characterlevels', 'action' => 'edit', $characterlevels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characterlevels', 'action' => 'delete', $characterlevels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

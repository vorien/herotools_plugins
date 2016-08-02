<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weapons'), ['controller' => 'Weapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weapon'), ['controller' => 'Weapons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterweapons index large-9 medium-8 columns content">
    <h3><?= __('Characterweapons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('characterstat_id') ?></th>
                <th><?= $this->Paginator->sort('weapon_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('ocv_modifier') ?></th>
                <th><?= $this->Paginator->sort('dcv_modifier') ?></th>
                <th><?= $this->Paginator->sort('damage_classes_modifier') ?></th>
                <th><?= $this->Paginator->sort('str_min_modifier') ?></th>
                <th><?= $this->Paginator->sort('range_modifier') ?></th>
                <th><?= $this->Paginator->sort('max_range_modifier') ?></th>
                <th><?= $this->Paginator->sort('offhand_offset') ?></th>
                <th><?= $this->Paginator->sort('offhand_defense') ?></th>
                <th><?= $this->Paginator->sort('multi_attack_offset') ?></th>
                <th><?= $this->Paginator->sort('weapon_element') ?></th>
                <th><?= $this->Paginator->sort('notes') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characterweapons as $characterweapon): ?>
            <tr>
                <td><?= $this->Number->format($characterweapon->id) ?></td>
                <td><?= $characterweapon->has('characterstat') ? $this->Html->link($characterweapon->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterweapon->characterstat->id]) : '' ?></td>
                <td><?= $characterweapon->has('weapon') ? $this->Html->link($characterweapon->weapon->id, ['controller' => 'Weapons', 'action' => 'view', $characterweapon->weapon->id]) : '' ?></td>
                <td><?= h($characterweapon->name) ?></td>
                <td><?= $this->Number->format($characterweapon->ocv_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->dcv_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->damage_classes_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->str_min_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->range_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->max_range_modifier) ?></td>
                <td><?= $this->Number->format($characterweapon->offhand_offset) ?></td>
                <td><?= $this->Number->format($characterweapon->offhand_defense) ?></td>
                <td><?= $this->Number->format($characterweapon->multi_attack_offset) ?></td>
                <td><?= h($characterweapon->weapon_element) ?></td>
                <td><?= h($characterweapon->notes) ?></td>
                <td><?= h($characterweapon->created) ?></td>
                <td><?= h($characterweapon->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $characterweapon->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characterweapon->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characterweapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterweapon->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

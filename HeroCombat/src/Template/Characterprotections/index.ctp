<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
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
<div class="characterprotections index large-9 medium-8 columns content">
    <h3><?= __('Characterprotections') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('active') ?></th>
                <th><?= $this->Paginator->sort('characterstat_id') ?></th>
                <th><?= $this->Paginator->sort('location_id') ?></th>
                <th><?= $this->Paginator->sort('covering_id') ?></th>
                <th><?= $this->Paginator->sort('armor_id') ?></th>
                <th><?= $this->Paginator->sort('material_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('n_pd_modifier') ?></th>
                <th><?= $this->Paginator->sort('n_ed_modifier') ?></th>
                <th><?= $this->Paginator->sort('r_pd_modifier') ?></th>
                <th><?= $this->Paginator->sort('r_ed_modifier') ?></th>
                <th><?= $this->Paginator->sort('stealth_penalty') ?></th>
                <th><?= $this->Paginator->sort('weight_modifier') ?></th>
                <th><?= $this->Paginator->sort('training_penalty_offset') ?></th>
                <th><?= $this->Paginator->sort('normal_dr') ?></th>
                <th><?= $this->Paginator->sort('killing_dr') ?></th>
                <th><?= $this->Paginator->sort('notes') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characterprotections as $characterprotection): ?>
            <tr>
                <td><?= $this->Number->format($characterprotection->id) ?></td>
                <td><?= h($characterprotection->active) ?></td>
                <td><?= $characterprotection->has('characterstat') ? $this->Html->link($characterprotection->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterprotection->characterstat->id]) : '' ?></td>
                <td><?= $characterprotection->has('location') ? $this->Html->link($characterprotection->location->id, ['controller' => 'Locations', 'action' => 'view', $characterprotection->location->id]) : '' ?></td>
                <td><?= $characterprotection->has('covering') ? $this->Html->link($characterprotection->covering->name, ['controller' => 'Coverings', 'action' => 'view', $characterprotection->covering->id]) : '' ?></td>
                <td><?= $characterprotection->has('armor') ? $this->Html->link($characterprotection->armor->id, ['controller' => 'Armors', 'action' => 'view', $characterprotection->armor->id]) : '' ?></td>
                <td><?= $characterprotection->has('material') ? $this->Html->link($characterprotection->material->id, ['controller' => 'Materials', 'action' => 'view', $characterprotection->material->id]) : '' ?></td>
                <td><?= h($characterprotection->name) ?></td>
                <td><?= $this->Number->format($characterprotection->n_pd_modifier) ?></td>
                <td><?= $this->Number->format($characterprotection->n_ed_modifier) ?></td>
                <td><?= $this->Number->format($characterprotection->r_pd_modifier) ?></td>
                <td><?= $this->Number->format($characterprotection->r_ed_modifier) ?></td>
                <td><?= $this->Number->format($characterprotection->stealth_penalty) ?></td>
                <td><?= $this->Number->format($characterprotection->weight_modifier) ?></td>
                <td><?= $this->Number->format($characterprotection->training_penalty_offset) ?></td>
                <td><?= $this->Number->format($characterprotection->normal_dr) ?></td>
                <td><?= $this->Number->format($characterprotection->killing_dr) ?></td>
                <td><?= h($characterprotection->notes) ?></td>
                <td><?= h($characterprotection->created) ?></td>
                <td><?= h($characterprotection->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $characterprotection->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characterprotection->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characterprotection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterprotection->id)]) ?>
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

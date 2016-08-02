<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Levels'), ['controller' => 'Levels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Level'), ['controller' => 'Levels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterlevels index large-9 medium-8 columns content">
    <h3><?= __('Characterlevels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('characterstat_id') ?></th>
                <th><?= $this->Paginator->sort('level_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('qty') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characterlevels as $characterlevel): ?>
            <tr>
                <td><?= $this->Number->format($characterlevel->id) ?></td>
                <td><?= $characterlevel->has('characterstat') ? $this->Html->link($characterlevel->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterlevel->characterstat->id]) : '' ?></td>
                <td><?= $characterlevel->has('level') ? $this->Html->link($characterlevel->level->id, ['controller' => 'Levels', 'action' => 'view', $characterlevel->level->id]) : '' ?></td>
                <td><?= h($characterlevel->name) ?></td>
                <td><?= $this->Number->format($characterlevel->qty) ?></td>
                <td><?= h($characterlevel->created) ?></td>
                <td><?= h($characterlevel->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $characterlevel->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characterlevel->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characterlevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevel->id)]) ?>
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

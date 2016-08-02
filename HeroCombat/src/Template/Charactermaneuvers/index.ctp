<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['controller' => 'Maneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Maneuver'), ['controller' => 'Maneuvers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="charactermaneuvers index large-9 medium-8 columns content">
    <h3><?= __('Charactermaneuvers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('characterstat_id') ?></th>
                <th><?= $this->Paginator->sort('maneuver_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($charactermaneuvers as $charactermaneuver): ?>
            <tr>
                <td><?= $this->Number->format($charactermaneuver->id) ?></td>
                <td><?= $charactermaneuver->has('characterstat') ? $this->Html->link($charactermaneuver->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $charactermaneuver->characterstat->id]) : '' ?></td>
                <td><?= $charactermaneuver->has('maneuver') ? $this->Html->link($charactermaneuver->maneuver->id, ['controller' => 'Maneuvers', 'action' => 'view', $charactermaneuver->maneuver->id]) : '' ?></td>
                <td><?= h($charactermaneuver->created) ?></td>
                <td><?= h($charactermaneuver->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $charactermaneuver->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $charactermaneuver->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $charactermaneuver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charactermaneuver->id)]) ?>
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

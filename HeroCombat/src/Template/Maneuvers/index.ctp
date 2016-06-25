<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Maneuver'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="maneuvers index large-9 medium-8 columns content">
    <h3><?= __('Maneuvers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('sort_order') ?></th>
                <th><?= $this->Paginator->sort('effect') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('maneuver') ?></th>
                <th><?= $this->Paginator->sort('phase') ?></th>
                <th><?= $this->Paginator->sort('ocv_action') ?></th>
                <th><?= $this->Paginator->sort('ocv_amt') ?></th>
                <th><?= $this->Paginator->sort('dcv_action') ?></th>
                <th><?= $this->Paginator->sort('dcv_amt') ?></th>
                <th><?= $this->Paginator->sort('dmg_action') ?></th>
                <th><?= $this->Paginator->sort('dmg_amt') ?></th>
                <th><?= $this->Paginator->sort('rng_action') ?></th>
                <th><?= $this->Paginator->sort('rng_amt') ?></th>
                <th><?= $this->Paginator->sort('str_action') ?></th>
                <th><?= $this->Paginator->sort('str_amt') ?></th>
                <th><?= $this->Paginator->sort('notes') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maneuvers as $maneuver): ?>
            <tr>
                <td><?= $this->Number->format($maneuver->id) ?></td>
                <td><?= $this->Number->format($maneuver->sort_order) ?></td>
                <td><?= h($maneuver->effect) ?></td>
                <td><?= h($maneuver->type) ?></td>
                <td><?= h($maneuver->maneuver) ?></td>
                <td><?= $this->Number->format($maneuver->phase) ?></td>
                <td><?= h($maneuver->ocv_action) ?></td>
                <td><?= $this->Number->format($maneuver->ocv_amt) ?></td>
                <td><?= h($maneuver->dcv_action) ?></td>
                <td><?= $this->Number->format($maneuver->dcv_amt) ?></td>
                <td><?= h($maneuver->dmg_action) ?></td>
                <td><?= $this->Number->format($maneuver->dmg_amt) ?></td>
                <td><?= h($maneuver->rng_action) ?></td>
                <td><?= $this->Number->format($maneuver->rng_amt) ?></td>
                <td><?= h($maneuver->str_action) ?></td>
                <td><?= $this->Number->format($maneuver->str_amt) ?></td>
                <td><?= h($maneuver->notes) ?></td>
                <td><?= h($maneuver->created) ?></td>
                <td><?= h($maneuver->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $maneuver->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $maneuver->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $maneuver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maneuver->id)]) ?>
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

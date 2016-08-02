<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Coverings'), ['controller' => 'Coverings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Covering'), ['controller' => 'Coverings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coveringlocations index large-9 medium-8 columns content">
    <h3><?= __('Coveringlocations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('covering_id') ?></th>
                <th><?= $this->Paginator->sort('location_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coveringlocations as $coveringlocation): ?>
            <tr>
                <td><?= $this->Number->format($coveringlocation->id) ?></td>
                <td><?= $coveringlocation->has('covering') ? $this->Html->link($coveringlocation->covering->name, ['controller' => 'Coverings', 'action' => 'view', $coveringlocation->covering->id]) : '' ?></td>
                <td><?= $coveringlocation->has('location') ? $this->Html->link($coveringlocation->location->id, ['controller' => 'Locations', 'action' => 'view', $coveringlocation->location->id]) : '' ?></td>
                <td><?= h($coveringlocation->created) ?></td>
                <td><?= h($coveringlocation->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $coveringlocation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coveringlocation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coveringlocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coveringlocation->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Covering'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['controller' => 'Coveringlocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['controller' => 'Coveringlocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coverings index large-9 medium-8 columns content">
    <h3><?= __('Coverings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coverings as $covering): ?>
            <tr>
                <td><?= $this->Number->format($covering->id) ?></td>
                <td><?= h($covering->name) ?></td>
                <td><?= h($covering->created) ?></td>
                <td><?= h($covering->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $covering->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $covering->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $covering->id], ['confirm' => __('Are you sure you want to delete # {0}?', $covering->id)]) ?>
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

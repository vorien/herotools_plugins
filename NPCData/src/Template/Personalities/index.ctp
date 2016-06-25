<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personality'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personalities index large-9 medium-8 columns content">
    <h3><?= __('Personalities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('sort_order') ?></th>
                <th><?= $this->Paginator->sort('virtue') ?></th>
                <th><?= $this->Paginator->sort('vice') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personalities as $personality): ?>
            <tr>
                <td><?= $this->Number->format($personality->id) ?></td>
                <td><?= h($personality->name) ?></td>
                <td><?= $this->Number->format($personality->sort_order) ?></td>
                <td><?= h($personality->virtue) ?></td>
                <td><?= h($personality->vice) ?></td>
                <td><?= h($personality->created) ?></td>
                <td><?= h($personality->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personality->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personality->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personality->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Allguild'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allguilds index large-9 medium-8 columns content">
    <h3><?= __('Allguilds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('profession') ?></th>
                <th><?= $this->Paginator->sort('incidence') ?></th>
                <th><?= $this->Paginator->sort('normalized') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allguilds as $allguild): ?>
            <tr>
                <td><?= $this->Number->format($allguild->id) ?></td>
                <td><?= h($allguild->name) ?></td>
                <td><?= h($allguild->profession) ?></td>
                <td><?= $this->Number->format($allguild->incidence) ?></td>
                <td><?= $this->Number->format($allguild->normalized) ?></td>
                <td><?= h($allguild->created) ?></td>
                <td><?= h($allguild->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $allguild->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $allguild->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $allguild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allguild->id)]) ?>
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

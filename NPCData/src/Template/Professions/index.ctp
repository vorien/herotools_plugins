<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Profession'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="professions index large-9 medium-8 columns content">
    <h3><?= __('Professions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('guild_id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('incidence') ?></th>
                <th><?= $this->Paginator->sort('normalized') ?></th>
                <th><?= $this->Paginator->sort('low') ?></th>
                <th><?= $this->Paginator->sort('high') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professions as $profession): ?>
            <tr>
                <td><?= $this->Number->format($profession->id) ?></td>
                <td><?= $profession->has('guild') ? $this->Html->link($profession->guild->name, ['controller' => 'Guilds', 'action' => 'view', $profession->guild->id]) : '' ?></td>
                <td><?= h($profession->name) ?></td>
                <td><?= $this->Number->format($profession->incidence) ?></td>
                <td><?= $this->Number->format($profession->normalized) ?></td>
                <td><?= $this->Number->format($profession->low) ?></td>
                <td><?= $this->Number->format($profession->high) ?></td>
                <td><?= h($profession->created) ?></td>
                <td><?= h($profession->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $profession->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $profession->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $profession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profession->id)]) ?>
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

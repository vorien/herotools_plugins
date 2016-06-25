<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Userdata'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userdata index large-9 medium-8 columns content">
    <h3><?= __('Userdata') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('is_gm') ?></th>
                <th><?= $this->Paginator->sort('is_admin') ?></th>
                <th><?= $this->Paginator->sort('characterfile') ?></th>
                <th><?= $this->Paginator->sort('mainfile') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userdata as $userdata): ?>
            <tr>
                <td><?= $this->Number->format($userdata->id) ?></td>
                <td><?= $userdata->has('user') ? $this->Html->link($userdata->user->id, ['controller' => 'Users', 'action' => 'view', $userdata->user->id]) : '' ?></td>
                <td><?= h($userdata->is_gm) ?></td>
                <td><?= h($userdata->is_admin) ?></td>
                <td><?= h($userdata->characterfile) ?></td>
                <td><?= h($userdata->mainfile) ?></td>
                <td><?= h($userdata->created) ?></td>
                <td><?= h($userdata->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userdata->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userdata->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userdata->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userdata->id)]) ?>
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

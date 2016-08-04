<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Userdata'), ['controller' => 'Userdata', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Userdata'), ['controller' => 'Userdata', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characters index large-9 medium-8 columns content">
    <h3><?= __('Characters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('player') ?></th>
                <th><?= $this->Paginator->sort('str') ?></th>
                <th><?= $this->Paginator->sort('con') ?></th>
                <th><?= $this->Paginator->sort('ocv') ?></th>
                <th><?= $this->Paginator->sort('dcv') ?></th>
                <th><?= $this->Paginator->sort('omcv') ?></th>
                <th><?= $this->Paginator->sort('dmcv') ?></th>
                <th><?= $this->Paginator->sort('ma_dc') ?></th>
                <th><?= $this->Paginator->sort('n_pd') ?></th>
                <th><?= $this->Paginator->sort('n_ed') ?></th>
                <th><?= $this->Paginator->sort('r_pd') ?></th>
                <th><?= $this->Paginator->sort('r_ed') ?></th>
                <th><?= $this->Paginator->sort('body') ?></th>
                <th><?= $this->Paginator->sort('stun') ?></th>
                <th><?= $this->Paginator->sort('endurance') ?></th>
                <th><?= $this->Paginator->sort('recovery') ?></th>
                <th><?= $this->Paginator->sort('userdata_id') ?></th>
                <th><?= $this->Paginator->sort('gm_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characters as $character): ?>
            <tr>
                <td><?= $this->Number->format($character->id) ?></td>
                <td><?= h($character->name) ?></td>
                <td><?= h($character->player) ?></td>
                <td><?= $this->Number->format($character->str) ?></td>
                <td><?= $this->Number->format($character->con) ?></td>
                <td><?= $this->Number->format($character->ocv) ?></td>
                <td><?= $this->Number->format($character->dcv) ?></td>
                <td><?= $this->Number->format($character->omcv) ?></td>
                <td><?= $this->Number->format($character->dmcv) ?></td>
                <td><?= $this->Number->format($character->ma_dc) ?></td>
                <td><?= $this->Number->format($character->n_pd) ?></td>
                <td><?= $this->Number->format($character->n_ed) ?></td>
                <td><?= $this->Number->format($character->r_pd) ?></td>
                <td><?= $this->Number->format($character->r_ed) ?></td>
                <td><?= $this->Number->format($character->body) ?></td>
                <td><?= $this->Number->format($character->stun) ?></td>
                <td><?= $this->Number->format($character->endurance) ?></td>
                <td><?= $this->Number->format($character->recovery) ?></td>
                <td><?= $character->has('userdata') ? $this->Html->link($character->userdata->id, ['controller' => 'Userdata', 'action' => 'view', $character->userdata->id]) : '' ?></td>
                <td><?= $this->Number->format($character->gm_id) ?></td>
                <td><?= h($character->created) ?></td>
                <td><?= h($character->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $character->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $character->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?>
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

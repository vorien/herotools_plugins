<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Characterstat'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterstats index large-9 medium-8 columns content">
    <h3><?= __('Characterstats') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('character_id') ?></th>
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
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characterstats as $characterstat): ?>
            <tr>
                <td><?= $this->Number->format($characterstat->id) ?></td>
                <td><?= $this->Number->format($characterstat->character_id) ?></td>
                <td><?= $this->Number->format($characterstat->str) ?></td>
                <td><?= $this->Number->format($characterstat->con) ?></td>
                <td><?= $this->Number->format($characterstat->ocv) ?></td>
                <td><?= $this->Number->format($characterstat->dcv) ?></td>
                <td><?= $this->Number->format($characterstat->omcv) ?></td>
                <td><?= $this->Number->format($characterstat->dmcv) ?></td>
                <td><?= $this->Number->format($characterstat->ma_dc) ?></td>
                <td><?= $this->Number->format($characterstat->n_pd) ?></td>
                <td><?= $this->Number->format($characterstat->n_ed) ?></td>
                <td><?= $this->Number->format($characterstat->r_pd) ?></td>
                <td><?= $this->Number->format($characterstat->r_ed) ?></td>
                <td><?= $this->Number->format($characterstat->body) ?></td>
                <td><?= $this->Number->format($characterstat->stun) ?></td>
                <td><?= $this->Number->format($characterstat->endurance) ?></td>
                <td><?= $this->Number->format($characterstat->recovery) ?></td>
                <td><?= h($characterstat->created) ?></td>
                <td><?= h($characterstat->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $characterstat->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characterstat->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characterstat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterstat->id)]) ?>
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

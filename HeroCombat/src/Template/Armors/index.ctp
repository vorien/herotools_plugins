<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Armor'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="armors index large-9 medium-8 columns content">
    <h3><?= __('Armors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('armor') ?></th>
                <th><?= $this->Paginator->sort('r_pd') ?></th>
                <th><?= $this->Paginator->sort('r_ed') ?></th>
                <th><?= $this->Paginator->sort('training_penalty') ?></th>
                <th><?= $this->Paginator->sort('ar_cost') ?></th>
                <th><?= $this->Paginator->sort('weight') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($armors as $armor): ?>
            <tr>
                <td><?= $this->Number->format($armor->id) ?></td>
                <td><?= h($armor->type) ?></td>
                <td><?= h($armor->armor) ?></td>
                <td><?= $this->Number->format($armor->r_pd) ?></td>
                <td><?= $this->Number->format($armor->r_ed) ?></td>
                <td><?= $this->Number->format($armor->training_penalty) ?></td>
                <td><?= h($armor->ar_cost) ?></td>
                <td><?= $this->Number->format($armor->weight) ?></td>
                <td><?= h($armor->created) ?></td>
                <td><?= h($armor->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $armor->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $armor->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $armor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armor->id)]) ?>
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

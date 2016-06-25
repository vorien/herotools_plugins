<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Material'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materials index large-9 medium-8 columns content">
    <h3><?= __('Materials') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('material') ?></th>
                <th><?= $this->Paginator->sort('manufacture') ?></th>
                <th><?= $this->Paginator->sort('option') ?></th>
                <th><?= $this->Paginator->sort('r_pd') ?></th>
                <th><?= $this->Paginator->sort('r_ed') ?></th>
                <th><?= $this->Paginator->sort('weightmultiplier') ?></th>
                <th><?= $this->Paginator->sort('grade') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $material): ?>
            <tr>
                <td><?= $this->Number->format($material->id) ?></td>
                <td><?= h($material->material) ?></td>
                <td><?= h($material->manufacture) ?></td>
                <td><?= h($material->option) ?></td>
                <td><?= $this->Number->format($material->r_pd) ?></td>
                <td><?= $this->Number->format($material->r_ed) ?></td>
                <td><?= $this->Number->format($material->weightmultiplier) ?></td>
                <td><?= $this->Number->format($material->grade) ?></td>
                <td><?= h($material->created) ?></td>
                <td><?= h($material->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $material->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $material->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?>
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

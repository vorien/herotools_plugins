<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Armors'), ['controller' => 'Armors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armor'), ['controller' => 'Armors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="armormaterials index large-9 medium-8 columns content">
    <h3><?= __('Armormaterials') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('armor_id') ?></th>
                <th><?= $this->Paginator->sort('material_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($armormaterials as $armormaterial): ?>
            <tr>
                <td><?= $this->Number->format($armormaterial->id) ?></td>
                <td><?= $armormaterial->has('armor') ? $this->Html->link($armormaterial->armor->ArmorData, ['controller' => 'Armors', 'action' => 'view', $armormaterial->armor->id]) : '' ?></td>
                <td><?= $armormaterial->has('material') ? $this->Html->link($armormaterial->material->MaterialData, ['controller' => 'Materials', 'action' => 'view', $armormaterial->material->id]) : '' ?></td>
                <td><?= h($armormaterial->created) ?></td>
                <td><?= h($armormaterial->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $armormaterial->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $armormaterial->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $armormaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armormaterial->id)]) ?>
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

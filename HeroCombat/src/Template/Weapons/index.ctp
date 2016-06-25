<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Weapon'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weapons index large-9 medium-8 columns content">
    <h3><?= __('Weapons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('weapon') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('str_overage') ?></th>
                <th><?= $this->Paginator->sort('str_adds_damage') ?></th>
                <th><?= $this->Paginator->sort('ocv') ?></th>
                <th><?= $this->Paginator->sort('dcv') ?></th>
                <th><?= $this->Paginator->sort('damage_classes') ?></th>
                <th><?= $this->Paginator->sort('damage_type') ?></th>
                <th><?= $this->Paginator->sort('damage_effect') ?></th>
                <th><?= $this->Paginator->sort('stunx') ?></th>
                <th><?= $this->Paginator->sort('str_min') ?></th>
                <th><?= $this->Paginator->sort('body') ?></th>
                <th><?= $this->Paginator->sort('def') ?></th>
                <th><?= $this->Paginator->sort('mass') ?></th>
                <th><?= $this->Paginator->sort('ar_cost') ?></th>
                <th><?= $this->Paginator->sort('length') ?></th>
                <th><?= $this->Paginator->sort('hands') ?></th>
                <th><?= $this->Paginator->sort('shots') ?></th>
                <th><?= $this->Paginator->sort('thrown') ?></th>
                <th><?= $this->Paginator->sort('rmod') ?></th>
                <th><?= $this->Paginator->sort('max_range') ?></th>
                <th><?= $this->Paginator->sort('concentration') ?></th>
                <th><?= $this->Paginator->sort('advantages') ?></th>
                <th><?= $this->Paginator->sort('notes') ?></th>
                <th><?= $this->Paginator->sort('str_overage_old') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($weapons as $weapon): ?>
            <tr>
                <td><?= $this->Number->format($weapon->id) ?></td>
                <td><?= h($weapon->weapon) ?></td>
                <td><?= h($weapon->type) ?></td>
                <td><?= $this->Number->format($weapon->str_overage) ?></td>
                <td><?= $this->Number->format($weapon->str_adds_damage) ?></td>
                <td><?= $this->Number->format($weapon->ocv) ?></td>
                <td><?= $this->Number->format($weapon->dcv) ?></td>
                <td><?= $this->Number->format($weapon->damage_classes) ?></td>
                <td><?= h($weapon->damage_type) ?></td>
                <td><?= h($weapon->damage_effect) ?></td>
                <td><?= $this->Number->format($weapon->stunx) ?></td>
                <td><?= $this->Number->format($weapon->str_min) ?></td>
                <td><?= $this->Number->format($weapon->body) ?></td>
                <td><?= $this->Number->format($weapon->def) ?></td>
                <td><?= $this->Number->format($weapon->mass) ?></td>
                <td><?= h($weapon->ar_cost) ?></td>
                <td><?= h($weapon->length) ?></td>
                <td><?= $this->Number->format($weapon->hands) ?></td>
                <td><?= h($weapon->shots) ?></td>
                <td><?= h($weapon->thrown) ?></td>
                <td><?= $this->Number->format($weapon->rmod) ?></td>
                <td><?= h($weapon->max_range) ?></td>
                <td><?= h($weapon->concentration) ?></td>
                <td><?= $this->Number->format($weapon->advantages) ?></td>
                <td><?= h($weapon->notes) ?></td>
                <td><?= $this->Number->format($weapon->str_overage_old) ?></td>
                <td><?= h($weapon->created) ?></td>
                <td><?= h($weapon->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $weapon->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $weapon->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $weapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weapon->id)]) ?>
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

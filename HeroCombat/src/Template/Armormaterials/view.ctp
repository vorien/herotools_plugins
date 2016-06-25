<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Armormaterial'), ['action' => 'edit', $armormaterial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Armormaterial'), ['action' => 'delete', $armormaterial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armormaterial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Armors'), ['controller' => 'Armors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armor'), ['controller' => 'Armors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="armormaterials view large-9 medium-8 columns content">
    <h3><?= h($armormaterial->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Armor') ?></th>
            <td><?= $armormaterial->has('armor') ? $this->Html->link($armormaterial->armor->ArmorData, ['controller' => 'Armors', 'action' => 'view', $armormaterial->armor->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Material') ?></th>
            <td><?= $armormaterial->has('material') ? $this->Html->link($armormaterial->material->MaterialData, ['controller' => 'Materials', 'action' => 'view', $armormaterial->material->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($armormaterial->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($armormaterial->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($armormaterial->modified) ?></td>
        </tr>
    </table>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coveringlocation'), ['action' => 'edit', $coveringlocation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coveringlocation'), ['action' => 'delete', $coveringlocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coveringlocation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Coverings'), ['controller' => 'Coverings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Covering'), ['controller' => 'Coverings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coveringlocations view large-9 medium-8 columns content">
    <h3><?= h($coveringlocation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Covering') ?></th>
            <td><?= $coveringlocation->has('covering') ? $this->Html->link($coveringlocation->covering->name, ['controller' => 'Coverings', 'action' => 'view', $coveringlocation->covering->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= $coveringlocation->has('location') ? $this->Html->link($coveringlocation->location->LocationData, ['controller' => 'Locations', 'action' => 'view', $coveringlocation->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($coveringlocation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($coveringlocation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($coveringlocation->modified) ?></td>
        </tr>
    </table>
</div>

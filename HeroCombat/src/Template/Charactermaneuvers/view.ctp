<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Charactermaneuver'), ['action' => 'edit', $charactermaneuver->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Charactermaneuver'), ['action' => 'delete', $charactermaneuver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charactermaneuver->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['controller' => 'Maneuvers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Maneuver'), ['controller' => 'Maneuvers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="charactermaneuvers view large-9 medium-8 columns content">
    <h3><?= h($charactermaneuver->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Characterstat') ?></th>
            <td><?= $charactermaneuver->has('characterstat') ? $this->Html->link($charactermaneuver->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $charactermaneuver->characterstat->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Maneuver') ?></th>
            <td><?= $charactermaneuver->has('maneuver') ? $this->Html->link($charactermaneuver->maneuver->id, ['controller' => 'Maneuvers', 'action' => 'view', $charactermaneuver->maneuver->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($charactermaneuver->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($charactermaneuver->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($charactermaneuver->modified) ?></td>
        </tr>
    </table>
</div>

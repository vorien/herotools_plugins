<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Profession'), ['action' => 'edit', $profession->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Profession'), ['action' => 'delete', $profession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profession->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Professions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profession'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="professions view large-9 medium-8 columns content">
    <h3><?= h($profession->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Guild') ?></th>
            <td><?= $profession->has('guild') ? $this->Html->link($profession->guild->name, ['controller' => 'Guilds', 'action' => 'view', $profession->guild->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($profession->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($profession->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Incidence') ?></th>
            <td><?= $this->Number->format($profession->incidence) ?></td>
        </tr>
        <tr>
            <th><?= __('Normalized') ?></th>
            <td><?= $this->Number->format($profession->normalized) ?></td>
        </tr>
        <tr>
            <th><?= __('Low') ?></th>
            <td><?= $this->Number->format($profession->low) ?></td>
        </tr>
        <tr>
            <th><?= __('High') ?></th>
            <td><?= $this->Number->format($profession->high) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($profession->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($profession->modified) ?></td>
        </tr>
    </table>
</div>

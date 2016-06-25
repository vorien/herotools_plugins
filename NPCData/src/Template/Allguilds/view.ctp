<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Allguild'), ['action' => 'edit', $allguild->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Allguild'), ['action' => 'delete', $allguild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allguild->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Allguilds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allguild'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="allguilds view large-9 medium-8 columns content">
    <h3><?= h($allguild->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($allguild->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Profession') ?></th>
            <td><?= h($allguild->profession) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($allguild->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Incidence') ?></th>
            <td><?= $this->Number->format($allguild->incidence) ?></td>
        </tr>
        <tr>
            <th><?= __('Normalized') ?></th>
            <td><?= $this->Number->format($allguild->normalized) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($allguild->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($allguild->modified) ?></td>
        </tr>
    </table>
</div>

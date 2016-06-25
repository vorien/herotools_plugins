<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personality'), ['action' => 'edit', $personality->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personality'), ['action' => 'delete', $personality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personality->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personalities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personality'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personalities view large-9 medium-8 columns content">
    <h3><?= h($personality->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($personality->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Virtue') ?></th>
            <td><?= h($personality->virtue) ?></td>
        </tr>
        <tr>
            <th><?= __('Vice') ?></th>
            <td><?= h($personality->vice) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personality->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($personality->sort_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personality->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personality->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Virtue Description') ?></h4>
        <?= $this->Text->autoParagraph(h($personality->virtue_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Vice Description') ?></h4>
        <?= $this->Text->autoParagraph(h($personality->vice_description)); ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Level'), ['action' => 'edit', $level->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Level'), ['action' => 'delete', $level->id], ['confirm' => __('Are you sure you want to delete # {0}?', $level->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Levels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Level'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="levels view large-9 medium-8 columns content">
    <h3><?= h($level->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($level->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Color') ?></th>
            <td><?= h($level->color) ?></td>
        </tr>
        <tr>
            <th><?= __('Uses') ?></th>
            <td><?= h($level->uses) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($level->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cost') ?></th>
            <td><?= $this->Number->format($level->cost) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($level->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($level->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterlevels') ?></h4>
        <?php if (!empty($level->characterlevels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Characterstat Id') ?></th>
                <th><?= __('Level Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Qty') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($level->characterlevels as $characterlevels): ?>
            <tr>
                <td><?= h($characterlevels->id) ?></td>
                <td><?= h($characterlevels->characterstat_id) ?></td>
                <td><?= h($characterlevels->level_id) ?></td>
                <td><?= h($characterlevels->name) ?></td>
                <td><?= h($characterlevels->qty) ?></td>
                <td><?= h($characterlevels->created) ?></td>
                <td><?= h($characterlevels->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characterlevels', 'action' => 'view', $characterlevels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characterlevels', 'action' => 'edit', $characterlevels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characterlevels', 'action' => 'delete', $characterlevels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

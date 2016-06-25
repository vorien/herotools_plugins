<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Target'), ['action' => 'edit', $target->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Target'), ['action' => 'delete', $target->id], ['confirm' => __('Are you sure you want to delete # {0}?', $target->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Targets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Target'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="targets view large-9 medium-8 columns content">
    <h3><?= h($target->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Roll') ?></th>
            <td><?= h($target->roll) ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= h($target->location) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($target->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Penalty') ?></th>
            <td><?= $this->Number->format($target->penalty) ?></td>
        </tr>
        <tr>
            <th><?= __('Stunx') ?></th>
            <td><?= $this->Number->format($target->stunx) ?></td>
        </tr>
        <tr>
            <th><?= __('Bodyx') ?></th>
            <td><?= $this->Number->format($target->bodyx) ?></td>
        </tr>
        <tr>
            <th><?= __('Nstun') ?></th>
            <td><?= $this->Number->format($target->nstun) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($target->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($target->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Locations') ?></h4>
        <?php if (!empty($target->locations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Target Id') ?></th>
                <th><?= __('Roll') ?></th>
                <th><?= __('Location') ?></th>
                <th><?= __('Sublocation') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($target->locations as $locations): ?>
            <tr>
                <td><?= h($locations->id) ?></td>
                <td><?= h($locations->target_id) ?></td>
                <td><?= h($locations->roll) ?></td>
                <td><?= h($locations->location) ?></td>
                <td><?= h($locations->sublocation) ?></td>
                <td><?= h($locations->created) ?></td>
                <td><?= h($locations->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Locations', 'action' => 'view', $locations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Locations', 'action' => 'edit', $locations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Locations', 'action' => 'delete', $locations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $locations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

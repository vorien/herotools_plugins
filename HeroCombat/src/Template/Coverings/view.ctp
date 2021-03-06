<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Covering'), ['action' => 'edit', $covering->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Covering'), ['action' => 'delete', $covering->id], ['confirm' => __('Are you sure you want to delete # {0}?', $covering->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coverings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Covering'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['controller' => 'Coveringlocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['controller' => 'Coveringlocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coverings view large-9 medium-8 columns content">
    <h3><?= h($covering->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($covering->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($covering->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($covering->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($covering->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterprotections') ?></h4>
        <?php if (!empty($covering->characterprotections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Character Id') ?></th>
                <th><?= __('Location Id') ?></th>
                <th><?= __('Covering Id') ?></th>
                <th><?= __('Armor Id') ?></th>
                <th><?= __('Material Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('N Pd Modifier') ?></th>
                <th><?= __('N Ed Modifier') ?></th>
                <th><?= __('R Pd Modifiers') ?></th>
                <th><?= __('R Ed Modifiers') ?></th>
                <th><?= __('Stealth Penalty') ?></th>
                <th><?= __('Weight Modifier') ?></th>
                <th><?= __('Training Penalty Offset') ?></th>
                <th><?= __('Normal Dr') ?></th>
                <th><?= __('Killing Dr') ?></th>
                <th><?= __('Notes') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($covering->characterprotections as $characterprotections): ?>
            <tr>
                <td><?= h($characterprotections->id) ?></td>
                <td><?= h($characterprotections->active) ?></td>
                <td><?= h($characterprotections->character_id) ?></td>
                <td><?= h($characterprotections->location_id) ?></td>
                <td><?= h($characterprotections->covering_id) ?></td>
                <td><?= h($characterprotections->armor_id) ?></td>
                <td><?= h($characterprotections->material_id) ?></td>
                <td><?= h($characterprotections->name) ?></td>
                <td><?= h($characterprotections->n_pd_modifier) ?></td>
                <td><?= h($characterprotections->n_ed_modifier) ?></td>
                <td><?= h($characterprotections->r_pd_modifiers) ?></td>
                <td><?= h($characterprotections->r_ed_modifiers) ?></td>
                <td><?= h($characterprotections->stealth_penalty) ?></td>
                <td><?= h($characterprotections->weight_modifier) ?></td>
                <td><?= h($characterprotections->training_penalty_offset) ?></td>
                <td><?= h($characterprotections->normal_dr) ?></td>
                <td><?= h($characterprotections->killing_dr) ?></td>
                <td><?= h($characterprotections->notes) ?></td>
                <td><?= h($characterprotections->created) ?></td>
                <td><?= h($characterprotections->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characterprotections', 'action' => 'view', $characterprotections->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characterprotections', 'action' => 'edit', $characterprotections->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characterprotections', 'action' => 'delete', $characterprotections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterprotections->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Coveringlocations') ?></h4>
        <?php if (!empty($covering->coveringlocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Covering Id') ?></th>
                <th><?= __('Location Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($covering->coveringlocations as $coveringlocations): ?>
            <tr>
                <td><?= h($coveringlocations->id) ?></td>
                <td><?= h($coveringlocations->covering_id) ?></td>
                <td><?= h($coveringlocations->location_id) ?></td>
                <td><?= h($coveringlocations->created) ?></td>
                <td><?= h($coveringlocations->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Coveringlocations', 'action' => 'view', $coveringlocations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Coveringlocations', 'action' => 'edit', $coveringlocations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Coveringlocations', 'action' => 'delete', $coveringlocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coveringlocations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

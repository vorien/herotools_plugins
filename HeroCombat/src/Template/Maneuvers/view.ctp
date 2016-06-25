<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Maneuver'), ['action' => 'edit', $maneuver->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Maneuver'), ['action' => 'delete', $maneuver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maneuver->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Maneuvers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Maneuver'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="maneuvers view large-9 medium-8 columns content">
    <h3><?= h($maneuver->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Effect') ?></th>
            <td><?= h($maneuver->effect) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($maneuver->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Maneuver') ?></th>
            <td><?= h($maneuver->maneuver) ?></td>
        </tr>
        <tr>
            <th><?= __('Ocv Action') ?></th>
            <td><?= h($maneuver->ocv_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Dcv Action') ?></th>
            <td><?= h($maneuver->dcv_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Dmg Action') ?></th>
            <td><?= h($maneuver->dmg_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Rng Action') ?></th>
            <td><?= h($maneuver->rng_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Action') ?></th>
            <td><?= h($maneuver->str_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Notes') ?></th>
            <td><?= h($maneuver->notes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($maneuver->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($maneuver->sort_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Phase') ?></th>
            <td><?= $this->Number->format($maneuver->phase) ?></td>
        </tr>
        <tr>
            <th><?= __('Ocv Amt') ?></th>
            <td><?= $this->Number->format($maneuver->ocv_amt) ?></td>
        </tr>
        <tr>
            <th><?= __('Dcv Amt') ?></th>
            <td><?= $this->Number->format($maneuver->dcv_amt) ?></td>
        </tr>
        <tr>
            <th><?= __('Dmg Amt') ?></th>
            <td><?= $this->Number->format($maneuver->dmg_amt) ?></td>
        </tr>
        <tr>
            <th><?= __('Rng Amt') ?></th>
            <td><?= $this->Number->format($maneuver->rng_amt) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Amt') ?></th>
            <td><?= $this->Number->format($maneuver->str_amt) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($maneuver->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($maneuver->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Charactermaneuvers') ?></h4>
        <?php if (!empty($maneuver->charactermaneuvers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Character Id') ?></th>
                <th><?= __('Maneuver Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($maneuver->charactermaneuvers as $charactermaneuvers): ?>
            <tr>
                <td><?= h($charactermaneuvers->id) ?></td>
                <td><?= h($charactermaneuvers->character_id) ?></td>
                <td><?= h($charactermaneuvers->maneuver_id) ?></td>
                <td><?= h($charactermaneuvers->created) ?></td>
                <td><?= h($charactermaneuvers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Charactermaneuvers', 'action' => 'view', $charactermaneuvers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Charactermaneuvers', 'action' => 'edit', $charactermaneuvers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Charactermaneuvers', 'action' => 'delete', $charactermaneuvers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charactermaneuvers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

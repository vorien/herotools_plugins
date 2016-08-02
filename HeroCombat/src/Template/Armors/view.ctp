<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Armor'), ['action' => 'edit', $armor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Armor'), ['action' => 'delete', $armor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Armors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="armors view large-9 medium-8 columns content">
    <h3><?= h($armor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($armor->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Armor') ?></th>
            <td><?= h($armor->armor) ?></td>
        </tr>
        <tr>
            <th><?= __('Ar Cost') ?></th>
            <td><?= h($armor->ar_cost) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($armor->id) ?></td>
        </tr>
        <tr>
            <th><?= __('R Pd') ?></th>
            <td><?= $this->Number->format($armor->r_pd) ?></td>
        </tr>
        <tr>
            <th><?= __('R Ed') ?></th>
            <td><?= $this->Number->format($armor->r_ed) ?></td>
        </tr>
        <tr>
            <th><?= __('Training Penalty') ?></th>
            <td><?= $this->Number->format($armor->training_penalty) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight') ?></th>
            <td><?= $this->Number->format($armor->weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($armor->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($armor->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Armormaterials') ?></h4>
        <?php if (!empty($armor->armormaterials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Armor Id') ?></th>
                <th><?= __('Material Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($armor->armormaterials as $armormaterials): ?>
            <tr>
                <td><?= h($armormaterials->id) ?></td>
                <td><?= h($armormaterials->armor_id) ?></td>
                <td><?= h($armormaterials->material_id) ?></td>
                <td><?= h($armormaterials->created) ?></td>
                <td><?= h($armormaterials->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Armormaterials', 'action' => 'view', $armormaterials->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Armormaterials', 'action' => 'edit', $armormaterials->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Armormaterials', 'action' => 'delete', $armormaterials->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armormaterials->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Characterprotections') ?></h4>
        <?php if (!empty($armor->characterprotections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Characterstat Id') ?></th>
                <th><?= __('Location Id') ?></th>
                <th><?= __('Covering Id') ?></th>
                <th><?= __('Armor Id') ?></th>
                <th><?= __('Material Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('N Pd Modifier') ?></th>
                <th><?= __('N Ed Modifier') ?></th>
                <th><?= __('R Pd Modifier') ?></th>
                <th><?= __('R Ed Modifier') ?></th>
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
            <?php foreach ($armor->characterprotections as $characterprotections): ?>
            <tr>
                <td><?= h($characterprotections->id) ?></td>
                <td><?= h($characterprotections->active) ?></td>
                <td><?= h($characterprotections->characterstat_id) ?></td>
                <td><?= h($characterprotections->location_id) ?></td>
                <td><?= h($characterprotections->covering_id) ?></td>
                <td><?= h($characterprotections->armor_id) ?></td>
                <td><?= h($characterprotections->material_id) ?></td>
                <td><?= h($characterprotections->name) ?></td>
                <td><?= h($characterprotections->n_pd_modifier) ?></td>
                <td><?= h($characterprotections->n_ed_modifier) ?></td>
                <td><?= h($characterprotections->r_pd_modifier) ?></td>
                <td><?= h($characterprotections->r_ed_modifier) ?></td>
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
</div>

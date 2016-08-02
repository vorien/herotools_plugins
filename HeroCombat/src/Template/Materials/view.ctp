<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Material'), ['action' => 'edit', $material->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Material'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="materials view large-9 medium-8 columns content">
    <h3><?= h($material->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Material') ?></th>
            <td><?= h($material->material) ?></td>
        </tr>
        <tr>
            <th><?= __('Manufacture') ?></th>
            <td><?= h($material->manufacture) ?></td>
        </tr>
        <tr>
            <th><?= __('Option') ?></th>
            <td><?= h($material->option) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($material->id) ?></td>
        </tr>
        <tr>
            <th><?= __('R Pd') ?></th>
            <td><?= $this->Number->format($material->r_pd) ?></td>
        </tr>
        <tr>
            <th><?= __('R Ed') ?></th>
            <td><?= $this->Number->format($material->r_ed) ?></td>
        </tr>
        <tr>
            <th><?= __('Weightmultiplier') ?></th>
            <td><?= $this->Number->format($material->weightmultiplier) ?></td>
        </tr>
        <tr>
            <th><?= __('Grade') ?></th>
            <td><?= $this->Number->format($material->grade) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($material->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($material->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Armormaterials') ?></h4>
        <?php if (!empty($material->armormaterials)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Armor Id') ?></th>
                <th><?= __('Material Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($material->armormaterials as $armormaterials): ?>
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
        <?php if (!empty($material->characterprotections)): ?>
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
            <?php foreach ($material->characterprotections as $characterprotections): ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Characterprotection'), ['action' => 'edit', $characterprotection->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Characterprotection'), ['action' => 'delete', $characterprotection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterprotection->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterstats'), ['controller' => 'Characterstats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterstat'), ['controller' => 'Characterstats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Coverings'), ['controller' => 'Coverings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Covering'), ['controller' => 'Coverings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Armors'), ['controller' => 'Armors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Armor'), ['controller' => 'Armors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characterprotections view large-9 medium-8 columns content">
    <h3><?= h($characterprotection->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Characterstat') ?></th>
            <td><?= $characterprotection->has('characterstat') ? $this->Html->link($characterprotection->characterstat->id, ['controller' => 'Characterstats', 'action' => 'view', $characterprotection->characterstat->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Location') ?></th>
            <td><?= $characterprotection->has('location') ? $this->Html->link($characterprotection->location->id, ['controller' => 'Locations', 'action' => 'view', $characterprotection->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Covering') ?></th>
            <td><?= $characterprotection->has('covering') ? $this->Html->link($characterprotection->covering->name, ['controller' => 'Coverings', 'action' => 'view', $characterprotection->covering->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Armor') ?></th>
            <td><?= $characterprotection->has('armor') ? $this->Html->link($characterprotection->armor->id, ['controller' => 'Armors', 'action' => 'view', $characterprotection->armor->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Material') ?></th>
            <td><?= $characterprotection->has('material') ? $this->Html->link($characterprotection->material->id, ['controller' => 'Materials', 'action' => 'view', $characterprotection->material->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($characterprotection->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Notes') ?></th>
            <td><?= h($characterprotection->notes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($characterprotection->id) ?></td>
        </tr>
        <tr>
            <th><?= __('N Pd Modifier') ?></th>
            <td><?= $this->Number->format($characterprotection->n_pd_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('N Ed Modifier') ?></th>
            <td><?= $this->Number->format($characterprotection->n_ed_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('R Pd Modifier') ?></th>
            <td><?= $this->Number->format($characterprotection->r_pd_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('R Ed Modifier') ?></th>
            <td><?= $this->Number->format($characterprotection->r_ed_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Stealth Penalty') ?></th>
            <td><?= $this->Number->format($characterprotection->stealth_penalty) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight Modifier') ?></th>
            <td><?= $this->Number->format($characterprotection->weight_modifier) ?></td>
        </tr>
        <tr>
            <th><?= __('Training Penalty Offset') ?></th>
            <td><?= $this->Number->format($characterprotection->training_penalty_offset) ?></td>
        </tr>
        <tr>
            <th><?= __('Normal Dr') ?></th>
            <td><?= $this->Number->format($characterprotection->normal_dr) ?></td>
        </tr>
        <tr>
            <th><?= __('Killing Dr') ?></th>
            <td><?= $this->Number->format($characterprotection->killing_dr) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($characterprotection->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($characterprotection->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Active') ?></th>
            <td><?= $characterprotection->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

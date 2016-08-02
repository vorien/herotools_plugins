<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Weapon'), ['action' => 'edit', $weapon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weapon'), ['action' => 'delete', $weapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weapon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Weapons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weapon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="weapons view large-9 medium-8 columns content">
    <h3><?= h($weapon->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Weapon') ?></th>
            <td><?= h($weapon->weapon) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($weapon->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Damage Type') ?></th>
            <td><?= h($weapon->damage_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Damage Effect') ?></th>
            <td><?= h($weapon->damage_effect) ?></td>
        </tr>
        <tr>
            <th><?= __('Ar Cost') ?></th>
            <td><?= h($weapon->ar_cost) ?></td>
        </tr>
        <tr>
            <th><?= __('Length') ?></th>
            <td><?= h($weapon->length) ?></td>
        </tr>
        <tr>
            <th><?= __('Shots') ?></th>
            <td><?= h($weapon->shots) ?></td>
        </tr>
        <tr>
            <th><?= __('Max Range') ?></th>
            <td><?= h($weapon->max_range) ?></td>
        </tr>
        <tr>
            <th><?= __('Notes') ?></th>
            <td><?= h($weapon->notes) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($weapon->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Overage') ?></th>
            <td><?= $this->Number->format($weapon->str_overage) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Adds Damage') ?></th>
            <td><?= $this->Number->format($weapon->str_adds_damage) ?></td>
        </tr>
        <tr>
            <th><?= __('Ocv') ?></th>
            <td><?= $this->Number->format($weapon->ocv) ?></td>
        </tr>
        <tr>
            <th><?= __('Dcv') ?></th>
            <td><?= $this->Number->format($weapon->dcv) ?></td>
        </tr>
        <tr>
            <th><?= __('Damage Classes') ?></th>
            <td><?= $this->Number->format($weapon->damage_classes) ?></td>
        </tr>
        <tr>
            <th><?= __('Stunx') ?></th>
            <td><?= $this->Number->format($weapon->stunx) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Min') ?></th>
            <td><?= $this->Number->format($weapon->str_min) ?></td>
        </tr>
        <tr>
            <th><?= __('Body') ?></th>
            <td><?= $this->Number->format($weapon->body) ?></td>
        </tr>
        <tr>
            <th><?= __('Def') ?></th>
            <td><?= $this->Number->format($weapon->def) ?></td>
        </tr>
        <tr>
            <th><?= __('Mass') ?></th>
            <td><?= $this->Number->format($weapon->mass) ?></td>
        </tr>
        <tr>
            <th><?= __('Hands') ?></th>
            <td><?= $this->Number->format($weapon->hands) ?></td>
        </tr>
        <tr>
            <th><?= __('Rmod') ?></th>
            <td><?= $this->Number->format($weapon->rmod) ?></td>
        </tr>
        <tr>
            <th><?= __('Advantages') ?></th>
            <td><?= $this->Number->format($weapon->advantages) ?></td>
        </tr>
        <tr>
            <th><?= __('Str Overage Old') ?></th>
            <td><?= $this->Number->format($weapon->str_overage_old) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($weapon->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($weapon->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Thrown') ?></th>
            <td><?= $weapon->thrown ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Concentration') ?></th>
            <td><?= $weapon->concentration ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterweapons') ?></h4>
        <?php if (!empty($weapon->characterweapons)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Characterstat Id') ?></th>
                <th><?= __('Weapon Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Ocv Modifier') ?></th>
                <th><?= __('Dcv Modifier') ?></th>
                <th><?= __('Damage Classes Modifier') ?></th>
                <th><?= __('Str Min Modifier') ?></th>
                <th><?= __('Range Modifier') ?></th>
                <th><?= __('Max Range Modifier') ?></th>
                <th><?= __('Offhand Offset') ?></th>
                <th><?= __('Offhand Defense') ?></th>
                <th><?= __('Multi Attack Offset') ?></th>
                <th><?= __('Weapon Element') ?></th>
                <th><?= __('Notes') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($weapon->characterweapons as $characterweapons): ?>
            <tr>
                <td><?= h($characterweapons->id) ?></td>
                <td><?= h($characterweapons->characterstat_id) ?></td>
                <td><?= h($characterweapons->weapon_id) ?></td>
                <td><?= h($characterweapons->name) ?></td>
                <td><?= h($characterweapons->ocv_modifier) ?></td>
                <td><?= h($characterweapons->dcv_modifier) ?></td>
                <td><?= h($characterweapons->damage_classes_modifier) ?></td>
                <td><?= h($characterweapons->str_min_modifier) ?></td>
                <td><?= h($characterweapons->range_modifier) ?></td>
                <td><?= h($characterweapons->max_range_modifier) ?></td>
                <td><?= h($characterweapons->offhand_offset) ?></td>
                <td><?= h($characterweapons->offhand_defense) ?></td>
                <td><?= h($characterweapons->multi_attack_offset) ?></td>
                <td><?= h($characterweapons->weapon_element) ?></td>
                <td><?= h($characterweapons->notes) ?></td>
                <td><?= h($characterweapons->created) ?></td>
                <td><?= h($characterweapons->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Characterweapons', 'action' => 'view', $characterweapons->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Characterweapons', 'action' => 'edit', $characterweapons->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Characterweapons', 'action' => 'delete', $characterweapons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterweapons->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Character'), ['action' => 'edit', $character->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Character'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Userdata', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Userdata', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="characters view large-9 medium-8 columns content">
    <h3><?= h($character->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($character->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Player') ?></th>
            <td><?= h($character->player) ?></td>
        </tr>
<!--        <tr>
            <th><?= __('User') ?></th>
            <td><?= $character->has('user') ? $this->Html->link($character->user->id, ['controller' => 'Users', 'action' => 'view', $character->user->id]) : '' ?></td>
        </tr>-->
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($character->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Str') ?></th>
            <td><?= $this->Number->format($character->str) ?></td>
        </tr>
        <tr>
            <th><?= __('Con') ?></th>
            <td><?= $this->Number->format($character->con) ?></td>
        </tr>
        <tr>
            <th><?= __('Ocv') ?></th>
            <td><?= $this->Number->format($character->ocv) ?></td>
        </tr>
        <tr>
            <th><?= __('Dcv') ?></th>
            <td><?= $this->Number->format($character->dcv) ?></td>
        </tr>
        <tr>
            <th><?= __('Omcv') ?></th>
            <td><?= $this->Number->format($character->omcv) ?></td>
        </tr>
        <tr>
            <th><?= __('Dmcv') ?></th>
            <td><?= $this->Number->format($character->dmcv) ?></td>
        </tr>
        <tr>
            <th><?= __('Ma Dc') ?></th>
            <td><?= $this->Number->format($character->ma_dc) ?></td>
        </tr>
        <tr>
            <th><?= __('N Pd') ?></th>
            <td><?= $this->Number->format($character->n_pd) ?></td>
        </tr>
        <tr>
            <th><?= __('N Ed') ?></th>
            <td><?= $this->Number->format($character->n_ed) ?></td>
        </tr>
        <tr>
            <th><?= __('R Pd') ?></th>
            <td><?= $this->Number->format($character->r_pd) ?></td>
        </tr>
        <tr>
            <th><?= __('R Ed') ?></th>
            <td><?= $this->Number->format($character->r_ed) ?></td>
        </tr>
        <tr>
            <th><?= __('Body') ?></th>
            <td><?= $this->Number->format($character->body) ?></td>
        </tr>
        <tr>
            <th><?= __('Stun') ?></th>
            <td><?= $this->Number->format($character->stun) ?></td>
        </tr>
        <tr>
            <th><?= __('Endurance') ?></th>
            <td><?= $this->Number->format($character->endurance) ?></td>
        </tr>
        <tr>
            <th><?= __('Recovery') ?></th>
            <td><?= $this->Number->format($character->recovery) ?></td>
        </tr>
        <tr>
            <th><?= __('Gm Id') ?></th>
            <td><?= $this->Number->format($character->gm_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($character->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($character->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Characterlevels') ?></h4>
        <?php if (!empty($character->characterlevels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Character Id') ?></th>
                <th><?= __('Level Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Qty') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($character->characterlevels as $characterlevels): ?>
            <tr>
                <td><?= h($characterlevels->id) ?></td>
                <td><?= h($characterlevels->character_id) ?></td>
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
    <div class="related">
        <h4><?= __('Related Charactermaneuvers') ?></h4>
        <?php if (!empty($character->charactermaneuvers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Character Id') ?></th>
                <th><?= __('Maneuver Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($character->charactermaneuvers as $charactermaneuvers): ?>
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
    <div class="related">
        <h4><?= __('Related Characterprotections') ?></h4>
        <?php if (!empty($character->characterprotections)): ?>
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
            <?php foreach ($character->characterprotections as $characterprotections): ?>
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
        <h4><?= __('Related Characterweapons') ?></h4>
        <?php if (!empty($character->characterweapons)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Character Id') ?></th>
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
            <?php foreach ($character->characterweapons as $characterweapons): ?>
            <tr>
                <td><?= h($characterweapons->id) ?></td>
                <td><?= h($characterweapons->character_id) ?></td>
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

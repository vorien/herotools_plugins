<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Character'), ['action' => 'edit', $character->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Character'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Userdata'), ['controller' => 'Userdata', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Userdata'), ['controller' => 'Userdata', 'action' => 'add']) ?> </li>
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
        <tr>
            <th><?= __('Userdata') ?></th>
            <td><?= $character->has('userdata') ? $this->Html->link($character->userdata->id, ['controller' => 'Userdata', 'action' => 'view', $character->userdata->id]) : '' ?></td>
        </tr>
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
</div>

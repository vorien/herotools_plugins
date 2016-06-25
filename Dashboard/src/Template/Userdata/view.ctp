<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Userdata'), ['action' => 'edit', $userdata->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Userdata'), ['action' => 'delete', $userdata->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userdata->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Userdata'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Userdata'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userdata view large-9 medium-8 columns content">
    <h3><?= h($userdata->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $userdata->has('user') ? $this->Html->link($userdata->user->id, ['controller' => 'Users', 'action' => 'view', $userdata->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Characterfile') ?></th>
            <td><?= h($userdata->characterfile) ?></td>
        </tr>
        <tr>
            <th><?= __('Mainfile') ?></th>
            <td><?= h($userdata->mainfile) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($userdata->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($userdata->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($userdata->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Gm') ?></th>
            <td><?= $userdata->is_gm ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Is Admin') ?></th>
            <td><?= $userdata->is_admin ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

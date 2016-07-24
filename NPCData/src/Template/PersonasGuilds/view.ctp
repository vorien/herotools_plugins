<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Guild'), ['action' => 'edit', $personasGuild->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Guild'), ['action' => 'delete', $personasGuild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasGuild->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Guilds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Guild'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasGuilds view large-9 medium-8 columns content">
    <h3><?= h($personasGuild->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasGuild->has('persona') ? $this->Html->link($personasGuild->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasGuild->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Guild') ?></th>
            <td><?= $personasGuild->has('guild') ? $this->Html->link($personasGuild->guild->name, ['controller' => 'Guilds', 'action' => 'view', $personasGuild->guild->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasGuild->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Direction') ?></th>
            <td><?= $this->Number->format($personasGuild->direction) ?></td>
        </tr>
        <tr>
            <th><?= __('Strength') ?></th>
            <td><?= $this->Number->format($personasGuild->strength) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasGuild->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasGuild->modified) ?></td>
        </tr>
    </table>
</div>

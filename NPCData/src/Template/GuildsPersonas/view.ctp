<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Guilds Persona'), ['action' => 'edit', $guildsPersona->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Guilds Persona'), ['action' => 'delete', $guildsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guildsPersona->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Guilds Personas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guilds Persona'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="guildsPersonas view large-9 medium-8 columns content">
    <h3><?= h($guildsPersona->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $guildsPersona->has('persona') ? $this->Html->link($guildsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $guildsPersona->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Guild') ?></th>
            <td><?= $guildsPersona->has('guild') ? $this->Html->link($guildsPersona->guild->name, ['controller' => 'Guilds', 'action' => 'view', $guildsPersona->guild->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($guildsPersona->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Direction') ?></th>
            <td><?= $this->Number->format($guildsPersona->direction) ?></td>
        </tr>
        <tr>
            <th><?= __('Strength') ?></th>
            <td><?= $this->Number->format($guildsPersona->strength) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($guildsPersona->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($guildsPersona->modified) ?></td>
        </tr>
    </table>
</div>

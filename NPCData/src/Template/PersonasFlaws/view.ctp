<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Flaw'), ['action' => 'edit', $personasFlaw->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Flaw'), ['action' => 'delete', $personasFlaw->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasFlaw->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Flaws'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Flaw'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasFlaws view large-9 medium-8 columns content">
    <h3><?= h($personasFlaw->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasFlaw->has('persona') ? $this->Html->link($personasFlaw->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasFlaw->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Flaw') ?></th>
            <td><?= $personasFlaw->has('flaw') ? $this->Html->link($personasFlaw->flaw->name, ['controller' => 'Flaws', 'action' => 'view', $personasFlaw->flaw->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasFlaw->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Severity') ?></th>
            <td><?= $this->Number->format($personasFlaw->severity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasFlaw->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasFlaw->modified) ?></td>
        </tr>
    </table>
</div>

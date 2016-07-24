<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Archetype'), ['action' => 'edit', $personasArchetype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Archetype'), ['action' => 'delete', $personasArchetype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasArchetype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Archetypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Archetype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasArchetypes view large-9 medium-8 columns content">
    <h3><?= h($personasArchetype->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasArchetype->has('persona') ? $this->Html->link($personasArchetype->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasArchetype->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Archetype') ?></th>
            <td><?= $personasArchetype->has('archetype') ? $this->Html->link($personasArchetype->archetype->name, ['controller' => 'Archetypes', 'action' => 'view', $personasArchetype->archetype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasArchetype->id) ?></td>
        </tr>
        <tr>
            <th><?= __('N D') ?></th>
            <td><?= $this->Number->format($personasArchetype->n_d) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasArchetype->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasArchetype->modified) ?></td>
        </tr>
    </table>
</div>

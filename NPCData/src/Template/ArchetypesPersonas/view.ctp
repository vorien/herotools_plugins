<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Archetypes Persona'), ['action' => 'edit', $archetypesPersona->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Archetypes Persona'), ['action' => 'delete', $archetypesPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $archetypesPersona->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Archetypes Personas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Archetypes Persona'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="archetypesPersonas view large-9 medium-8 columns content">
    <h3><?= h($archetypesPersona->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $archetypesPersona->has('persona') ? $this->Html->link($archetypesPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $archetypesPersona->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Archetype') ?></th>
            <td><?= $archetypesPersona->has('archetype') ? $this->Html->link($archetypesPersona->archetype->name, ['controller' => 'Archetypes', 'action' => 'view', $archetypesPersona->archetype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($archetypesPersona->id) ?></td>
        </tr>
        <tr>
            <th><?= __('N D') ?></th>
            <td><?= $this->Number->format($archetypesPersona->n_d) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($archetypesPersona->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($archetypesPersona->modified) ?></td>
        </tr>
    </table>
</div>

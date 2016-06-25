<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Motivations Persona'), ['action' => 'edit', $motivationsPersona->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Motivations Persona'), ['action' => 'delete', $motivationsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motivationsPersona->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Motivations Personas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Motivations Persona'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="motivationsPersonas view large-9 medium-8 columns content">
    <h3><?= h($motivationsPersona->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $motivationsPersona->has('persona') ? $this->Html->link($motivationsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $motivationsPersona->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Motivation') ?></th>
            <td><?= $motivationsPersona->has('motivation') ? $this->Html->link($motivationsPersona->motivation->name, ['controller' => 'Motivations', 'action' => 'view', $motivationsPersona->motivation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($motivationsPersona->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $this->Number->format($motivationsPersona->priority) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($motivationsPersona->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($motivationsPersona->modified) ?></td>
        </tr>
    </table>
</div>

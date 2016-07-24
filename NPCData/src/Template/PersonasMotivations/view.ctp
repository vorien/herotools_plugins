<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Motivation'), ['action' => 'edit', $personasMotivation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Motivation'), ['action' => 'delete', $personasMotivation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasMotivation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Motivations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Motivation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasMotivations view large-9 medium-8 columns content">
    <h3><?= h($personasMotivation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasMotivation->has('persona') ? $this->Html->link($personasMotivation->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasMotivation->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Motivation') ?></th>
            <td><?= $personasMotivation->has('motivation') ? $this->Html->link($personasMotivation->motivation->name, ['controller' => 'Motivations', 'action' => 'view', $personasMotivation->motivation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasMotivation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $this->Number->format($personasMotivation->priority) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasMotivation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasMotivation->modified) ?></td>
        </tr>
    </table>
</div>

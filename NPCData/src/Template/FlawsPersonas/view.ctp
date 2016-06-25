<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Flaws Persona'), ['action' => 'edit', $flawsPersona->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Flaws Persona'), ['action' => 'delete', $flawsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flawsPersona->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Flaws Personas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Flaws Persona'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="flawsPersonas view large-9 medium-8 columns content">
    <h3><?= h($flawsPersona->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $flawsPersona->has('persona') ? $this->Html->link($flawsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $flawsPersona->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Flaw') ?></th>
            <td><?= $flawsPersona->has('flaw') ? $this->Html->link($flawsPersona->flaw->name, ['controller' => 'Flaws', 'action' => 'view', $flawsPersona->flaw->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($flawsPersona->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Severity') ?></th>
            <td><?= $this->Number->format($flawsPersona->severity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($flawsPersona->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($flawsPersona->modified) ?></td>
        </tr>
    </table>
</div>

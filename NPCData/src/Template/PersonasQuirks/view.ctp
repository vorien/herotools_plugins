<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Quirk'), ['action' => 'edit', $personasQuirk->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Quirk'), ['action' => 'delete', $personasQuirk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasQuirk->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Quirks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Quirk'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasQuirks view large-9 medium-8 columns content">
    <h3><?= h($personasQuirk->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasQuirk->has('persona') ? $this->Html->link($personasQuirk->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasQuirk->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Quirk') ?></th>
            <td><?= $personasQuirk->has('quirk') ? $this->Html->link($personasQuirk->quirk->name, ['controller' => 'Quirks', 'action' => 'view', $personasQuirk->quirk->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasQuirk->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Severity') ?></th>
            <td><?= $this->Number->format($personasQuirk->severity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasQuirk->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasQuirk->modified) ?></td>
        </tr>
    </table>
</div>

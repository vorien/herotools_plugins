<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Personas Quality'), ['action' => 'edit', $personasQuality->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Personas Quality'), ['action' => 'delete', $personasQuality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasQuality->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas Qualities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Personas Quality'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Qualities'), ['controller' => 'Qualities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quality'), ['controller' => 'Qualities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personasQualities view large-9 medium-8 columns content">
    <h3><?= h($personasQuality->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Persona') ?></th>
            <td><?= $personasQuality->has('persona') ? $this->Html->link($personasQuality->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasQuality->persona->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Quality') ?></th>
            <td><?= $personasQuality->has('quality') ? $this->Html->link($personasQuality->quality->name, ['controller' => 'Qualities', 'action' => 'view', $personasQuality->quality->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personasQuality->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Severity') ?></th>
            <td><?= $this->Number->format($personasQuality->severity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($personasQuality->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($personasQuality->modified) ?></td>
        </tr>
    </table>
</div>

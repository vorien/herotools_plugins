<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Archetypes Persona'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="archetypesPersonas index large-9 medium-8 columns content">
    <h3><?= __('Archetypes Personas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('archetype_id') ?></th>
                <th><?= $this->Paginator->sort('n_d') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($archetypesPersonas as $archetypesPersona): ?>
            <tr>
                <td><?= $this->Number->format($archetypesPersona->id) ?></td>
                <td><?= $archetypesPersona->has('persona') ? $this->Html->link($archetypesPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $archetypesPersona->persona->id]) : '' ?></td>
                <td><?= $archetypesPersona->has('archetype') ? $this->Html->link($archetypesPersona->archetype->name, ['controller' => 'Archetypes', 'action' => 'view', $archetypesPersona->archetype->id]) : '' ?></td>
                <td><?= $this->Number->format($archetypesPersona->n_d) ?></td>
                <td><?= h($archetypesPersona->created) ?></td>
                <td><?= h($archetypesPersona->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $archetypesPersona->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $archetypesPersona->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $archetypesPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $archetypesPersona->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

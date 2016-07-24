<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Archetype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasArchetypes index large-9 medium-8 columns content">
    <h3><?= __('Personas Archetypes') ?></h3>
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
            <?php foreach ($personasArchetypes as $personasArchetype): ?>
            <tr>
                <td><?= $this->Number->format($personasArchetype->id) ?></td>
                <td><?= $personasArchetype->has('persona') ? $this->Html->link($personasArchetype->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasArchetype->persona->id]) : '' ?></td>
                <td><?= $personasArchetype->has('archetype') ? $this->Html->link($personasArchetype->archetype->name, ['controller' => 'Archetypes', 'action' => 'view', $personasArchetype->archetype->id]) : '' ?></td>
                <td><?= $this->Number->format($personasArchetype->n_d) ?></td>
                <td><?= h($personasArchetype->created) ?></td>
                <td><?= h($personasArchetype->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasArchetype->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasArchetype->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasArchetype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasArchetype->id)]) ?>
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

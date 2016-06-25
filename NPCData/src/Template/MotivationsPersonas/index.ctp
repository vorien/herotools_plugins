<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Motivations Persona'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="motivationsPersonas index large-9 medium-8 columns content">
    <h3><?= __('Motivations Personas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('motivation_id') ?></th>
                <th><?= $this->Paginator->sort('priority') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($motivationsPersonas as $motivationsPersona): ?>
            <tr>
                <td><?= $this->Number->format($motivationsPersona->id) ?></td>
                <td><?= $motivationsPersona->has('persona') ? $this->Html->link($motivationsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $motivationsPersona->persona->id]) : '' ?></td>
                <td><?= $motivationsPersona->has('motivation') ? $this->Html->link($motivationsPersona->motivation->name, ['controller' => 'Motivations', 'action' => 'view', $motivationsPersona->motivation->id]) : '' ?></td>
                <td><?= $this->Number->format($motivationsPersona->priority) ?></td>
                <td><?= h($motivationsPersona->created) ?></td>
                <td><?= h($motivationsPersona->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $motivationsPersona->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $motivationsPersona->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $motivationsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motivationsPersona->id)]) ?>
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

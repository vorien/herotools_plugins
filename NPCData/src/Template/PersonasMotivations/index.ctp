<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Motivation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasMotivations index large-9 medium-8 columns content">
    <h3><?= __('Personas Motivations') ?></h3>
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
            <?php foreach ($personasMotivations as $personasMotivation): ?>
            <tr>
                <td><?= $this->Number->format($personasMotivation->id) ?></td>
                <td><?= $personasMotivation->has('persona') ? $this->Html->link($personasMotivation->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasMotivation->persona->id]) : '' ?></td>
                <td><?= $personasMotivation->has('motivation') ? $this->Html->link($personasMotivation->motivation->name, ['controller' => 'Motivations', 'action' => 'view', $personasMotivation->motivation->id]) : '' ?></td>
                <td><?= $this->Number->format($personasMotivation->priority) ?></td>
                <td><?= h($personasMotivation->created) ?></td>
                <td><?= h($personasMotivation->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasMotivation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasMotivation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasMotivation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasMotivation->id)]) ?>
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

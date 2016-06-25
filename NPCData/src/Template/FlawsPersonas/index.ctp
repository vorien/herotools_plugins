<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Flaws Persona'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="flawsPersonas index large-9 medium-8 columns content">
    <h3><?= __('Flaws Personas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('flaw_id') ?></th>
                <th><?= $this->Paginator->sort('severity') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flawsPersonas as $flawsPersona): ?>
            <tr>
                <td><?= $this->Number->format($flawsPersona->id) ?></td>
                <td><?= $flawsPersona->has('persona') ? $this->Html->link($flawsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $flawsPersona->persona->id]) : '' ?></td>
                <td><?= $flawsPersona->has('flaw') ? $this->Html->link($flawsPersona->flaw->name, ['controller' => 'Flaws', 'action' => 'view', $flawsPersona->flaw->id]) : '' ?></td>
                <td><?= $this->Number->format($flawsPersona->severity) ?></td>
                <td><?= h($flawsPersona->created) ?></td>
                <td><?= h($flawsPersona->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $flawsPersona->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flawsPersona->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $flawsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flawsPersona->id)]) ?>
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

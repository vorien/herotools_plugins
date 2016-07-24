<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Flaw'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasFlaws index large-9 medium-8 columns content">
    <h3><?= __('Personas Flaws') ?></h3>
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
            <?php foreach ($personasFlaws as $personasFlaw): ?>
            <tr>
                <td><?= $this->Number->format($personasFlaw->id) ?></td>
                <td><?= $personasFlaw->has('persona') ? $this->Html->link($personasFlaw->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasFlaw->persona->id]) : '' ?></td>
                <td><?= $personasFlaw->has('flaw') ? $this->Html->link($personasFlaw->flaw->name, ['controller' => 'Flaws', 'action' => 'view', $personasFlaw->flaw->id]) : '' ?></td>
                <td><?= $this->Number->format($personasFlaw->severity) ?></td>
                <td><?= h($personasFlaw->created) ?></td>
                <td><?= h($personasFlaw->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasFlaw->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasFlaw->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasFlaw->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasFlaw->id)]) ?>
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

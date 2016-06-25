<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="archetypes index large-9 medium-8 columns content">
    <h3><?= __('Archetypes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($archetypes as $archetype): ?>
            <tr>
                <td><?= $this->Number->format($archetype->id) ?></td>
                <td><?= h($archetype->name) ?></td>
                <td><?= h($archetype->description) ?></td>
                <td><?= h($archetype->created) ?></td>
                <td><?= h($archetype->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $archetype->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $archetype->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $archetype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $archetype->id)]) ?>
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

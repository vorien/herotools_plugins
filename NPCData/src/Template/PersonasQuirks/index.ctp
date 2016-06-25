<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Quirk'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasQuirks index large-9 medium-8 columns content">
    <h3><?= __('Personas Quirks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('quirk_id') ?></th>
                <th><?= $this->Paginator->sort('severity') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personasQuirks as $personasQuirk): ?>
            <tr>
                <td><?= $this->Number->format($personasQuirk->id) ?></td>
                <td><?= $personasQuirk->has('persona') ? $this->Html->link($personasQuirk->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasQuirk->persona->id]) : '' ?></td>
                <td><?= $personasQuirk->has('quirk') ? $this->Html->link($personasQuirk->quirk->name, ['controller' => 'Quirks', 'action' => 'view', $personasQuirk->quirk->id]) : '' ?></td>
                <td><?= $this->Number->format($personasQuirk->severity) ?></td>
                <td><?= h($personasQuirk->created) ?></td>
                <td><?= h($personasQuirk->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasQuirk->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasQuirk->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasQuirk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasQuirk->id)]) ?>
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

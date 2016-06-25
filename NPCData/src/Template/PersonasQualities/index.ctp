<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Quality'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualities'), ['controller' => 'Qualities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quality'), ['controller' => 'Qualities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasQualities index large-9 medium-8 columns content">
    <h3><?= __('Personas Qualities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('quality_id') ?></th>
                <th><?= $this->Paginator->sort('severity') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personasQualities as $personasQuality): ?>
            <tr>
                <td><?= $this->Number->format($personasQuality->id) ?></td>
                <td><?= $personasQuality->has('persona') ? $this->Html->link($personasQuality->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasQuality->persona->id]) : '' ?></td>
                <td><?= $personasQuality->has('quality') ? $this->Html->link($personasQuality->quality->name, ['controller' => 'Qualities', 'action' => 'view', $personasQuality->quality->id]) : '' ?></td>
                <td><?= $this->Number->format($personasQuality->severity) ?></td>
                <td><?= h($personasQuality->created) ?></td>
                <td><?= h($personasQuality->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasQuality->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasQuality->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasQuality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasQuality->id)]) ?>
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

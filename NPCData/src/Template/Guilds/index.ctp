<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Professions'), ['controller' => 'Professions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profession'), ['controller' => 'Professions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="guilds index large-9 medium-8 columns content">
    <h3><?= __('Guilds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('incidence') ?></th>
                <th><?= $this->Paginator->sort('normalized') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guilds as $guild): ?>
            <tr>
                <td><?= $this->Number->format($guild->id) ?></td>
                <td><?= h($guild->name) ?></td>
                <td><?= $this->Number->format($guild->incidence) ?></td>
                <td><?= $this->Number->format($guild->normalized) ?></td>
                <td><?= h($guild->created) ?></td>
                <td><?= h($guild->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $guild->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $guild->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $guild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guild->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Guilds Persona'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="guildsPersonas index large-9 medium-8 columns content">
    <h3><?= __('Guilds Personas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('persona_id') ?></th>
                <th><?= $this->Paginator->sort('guild_id') ?></th>
                <th><?= $this->Paginator->sort('direction') ?></th>
                <th><?= $this->Paginator->sort('strength') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guildsPersonas as $guildsPersona): ?>
            <tr>
                <td><?= $this->Number->format($guildsPersona->id) ?></td>
                <td><?= $guildsPersona->has('persona') ? $this->Html->link($guildsPersona->persona->id, ['controller' => 'Personas', 'action' => 'view', $guildsPersona->persona->id]) : '' ?></td>
                <td><?= $guildsPersona->has('guild') ? $this->Html->link($guildsPersona->guild->name, ['controller' => 'Guilds', 'action' => 'view', $guildsPersona->guild->id]) : '' ?></td>
                <td><?= $this->Number->format($guildsPersona->direction) ?></td>
                <td><?= $this->Number->format($guildsPersona->strength) ?></td>
                <td><?= h($guildsPersona->created) ?></td>
                <td><?= h($guildsPersona->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $guildsPersona->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $guildsPersona->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $guildsPersona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guildsPersona->id)]) ?>
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

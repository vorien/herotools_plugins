<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Personas Guild'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasGuilds index large-9 medium-8 columns content">
    <h3><?= __('Personas Guilds') ?></h3>
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
            <?php foreach ($personasGuilds as $personasGuild): ?>
            <tr>
                <td><?= $this->Number->format($personasGuild->id) ?></td>
                <td><?= $personasGuild->has('persona') ? $this->Html->link($personasGuild->persona->id, ['controller' => 'Personas', 'action' => 'view', $personasGuild->persona->id]) : '' ?></td>
                <td><?= $personasGuild->has('guild') ? $this->Html->link($personasGuild->guild->name, ['controller' => 'Guilds', 'action' => 'view', $personasGuild->guild->id]) : '' ?></td>
                <td><?= $this->Number->format($personasGuild->direction) ?></td>
                <td><?= $this->Number->format($personasGuild->strength) ?></td>
                <td><?= h($personasGuild->created) ?></td>
                <td><?= h($personasGuild->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $personasGuild->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personasGuild->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $personasGuild->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personasGuild->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Agendas'), ['controller' => 'Agendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Agenda'), ['controller' => 'Agendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notes'), ['controller' => 'Notes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note'), ['controller' => 'Notes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualities'), ['controller' => 'Qualities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quality'), ['controller' => 'Qualities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personas index large-9 medium-8 columns content">
    <h3><?= __('Personas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('person_id') ?></th>
                <th><?= $this->Paginator->sort('agenda_id') ?></th>
                <th><?= $this->Paginator->sort('profession') ?></th>
                <th><?= $this->Paginator->sort('employer') ?></th>
                <th><?= $this->Paginator->sort('influence') ?></th>
                <th><?= $this->Paginator->sort('wealth') ?></th>
                <th><?= $this->Paginator->sort('picture') ?></th>
                <th><?= $this->Paginator->sort('gender') ?></th>
                <th><?= $this->Paginator->sort('generosity') ?></th>
                <th><?= $this->Paginator->sort('decency') ?></th>
                <th><?= $this->Paginator->sort('reliability') ?></th>
                <th><?= $this->Paginator->sort('reserve') ?></th>
                <th><?= $this->Paginator->sort('benevolence') ?></th>
                <th><?= $this->Paginator->sort('restraint') ?></th>
                <th><?= $this->Paginator->sort('moderation') ?></th>
                <th><?= $this->Paginator->sort('stability') ?></th>
                <th><?= $this->Paginator->sort('outlook') ?></th>
                <th><?= $this->Paginator->sort('integrity') ?></th>
                <th><?= $this->Paginator->sort('discipline') ?></th>
                <th><?= $this->Paginator->sort('spirit') ?></th>
                <th><?= $this->Paginator->sort('gregariousness') ?></th>
                <th><?= $this->Paginator->sort('conformity') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $persona): ?>
            <tr>
                <td><?= $this->Number->format($persona->id) ?></td>
                <td><?= $persona->has('person') ? $this->Html->link($persona->person->name, ['controller' => 'People', 'action' => 'view', $persona->person->id]) : '' ?></td>
                <td><?= $persona->has('agenda') ? $this->Html->link($persona->agenda->name, ['controller' => 'Agendas', 'action' => 'view', $persona->agenda->id]) : '' ?></td>
                <td><?= h($persona->profession) ?></td>
                <td><?= h($persona->employer) ?></td>
                <td><?= $this->Number->format($persona->influence) ?></td>
                <td><?= $this->Number->format($persona->wealth) ?></td>
                <td><?= h($persona->picture) ?></td>
                <td><?= h($persona->gender) ?></td>
                <td><?= $this->Number->format($persona->generosity) ?></td>
                <td><?= $this->Number->format($persona->decency) ?></td>
                <td><?= $this->Number->format($persona->reliability) ?></td>
                <td><?= $this->Number->format($persona->reserve) ?></td>
                <td><?= $this->Number->format($persona->benevolence) ?></td>
                <td><?= $this->Number->format($persona->restraint) ?></td>
                <td><?= $this->Number->format($persona->moderation) ?></td>
                <td><?= $this->Number->format($persona->stability) ?></td>
                <td><?= $this->Number->format($persona->outlook) ?></td>
                <td><?= $this->Number->format($persona->integrity) ?></td>
                <td><?= $this->Number->format($persona->discipline) ?></td>
                <td><?= $this->Number->format($persona->spirit) ?></td>
                <td><?= $this->Number->format($persona->gregariousness) ?></td>
                <td><?= $this->Number->format($persona->conformity) ?></td>
                <td><?= h($persona->created) ?></td>
                <td><?= h($persona->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $persona->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $persona->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $persona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $persona->id)]) ?>
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

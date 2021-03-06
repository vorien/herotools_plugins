<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Quality'), ['action' => 'edit', $quality->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Quality'), ['action' => 'delete', $quality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quality->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Qualities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quality'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="qualities view large-9 medium-8 columns content">
    <h3><?= h($quality->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($quality->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($quality->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($quality->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($quality->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Personas') ?></h4>
        <?php if (!empty($quality->personas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Person Id') ?></th>
                <th><?= __('Agenda Id') ?></th>
                <th><?= __('Profession') ?></th>
                <th><?= __('Employer') ?></th>
                <th><?= __('Influence') ?></th>
                <th><?= __('Wealth') ?></th>
                <th><?= __('Picture') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('Generosity') ?></th>
                <th><?= __('Decency') ?></th>
                <th><?= __('Reliability') ?></th>
                <th><?= __('Reserve') ?></th>
                <th><?= __('Benevolence') ?></th>
                <th><?= __('Restraint') ?></th>
                <th><?= __('Moderation') ?></th>
                <th><?= __('Stability') ?></th>
                <th><?= __('Outlook') ?></th>
                <th><?= __('Integrity') ?></th>
                <th><?= __('Discipline') ?></th>
                <th><?= __('Spirit') ?></th>
                <th><?= __('Gregariousness') ?></th>
                <th><?= __('Conformity') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($quality->personas as $personas): ?>
            <tr>
                <td><?= h($personas->id) ?></td>
                <td><?= h($personas->person_id) ?></td>
                <td><?= h($personas->agenda_id) ?></td>
                <td><?= h($personas->profession) ?></td>
                <td><?= h($personas->employer) ?></td>
                <td><?= h($personas->influence) ?></td>
                <td><?= h($personas->wealth) ?></td>
                <td><?= h($personas->picture) ?></td>
                <td><?= h($personas->gender) ?></td>
                <td><?= h($personas->generosity) ?></td>
                <td><?= h($personas->decency) ?></td>
                <td><?= h($personas->reliability) ?></td>
                <td><?= h($personas->reserve) ?></td>
                <td><?= h($personas->benevolence) ?></td>
                <td><?= h($personas->restraint) ?></td>
                <td><?= h($personas->moderation) ?></td>
                <td><?= h($personas->stability) ?></td>
                <td><?= h($personas->outlook) ?></td>
                <td><?= h($personas->integrity) ?></td>
                <td><?= h($personas->discipline) ?></td>
                <td><?= h($personas->spirit) ?></td>
                <td><?= h($personas->gregariousness) ?></td>
                <td><?= h($personas->conformity) ?></td>
                <td><?= h($personas->created) ?></td>
                <td><?= h($personas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Personas', 'action' => 'view', $personas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Personas', 'action' => 'edit', $personas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Personas', 'action' => 'delete', $personas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

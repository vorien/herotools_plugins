<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Characterlevels Characterweapon'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characterlevelsCharacterweapons index large-9 medium-8 columns content">
    <h3><?= __('Characterlevels Characterweapons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('characterlevel_id') ?></th>
                <th><?= $this->Paginator->sort('characterweapon_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characterlevelsCharacterweapons as $characterlevelsCharacterweapon): ?>
            <tr>
                <td><?= $this->Number->format($characterlevelsCharacterweapon->id) ?></td>
                <td><?= $characterlevelsCharacterweapon->has('characterlevel') ? $this->Html->link($characterlevelsCharacterweapon->characterlevel->name, ['controller' => 'Characterlevels', 'action' => 'view', $characterlevelsCharacterweapon->characterlevel->id]) : '' ?></td>
                <td><?= $characterlevelsCharacterweapon->has('characterweapon') ? $this->Html->link($characterlevelsCharacterweapon->characterweapon->name, ['controller' => 'Characterweapons', 'action' => 'view', $characterlevelsCharacterweapon->characterweapon->id]) : '' ?></td>
                <td><?= h($characterlevelsCharacterweapon->created) ?></td>
                <td><?= h($characterlevelsCharacterweapon->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $characterlevelsCharacterweapon->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characterlevelsCharacterweapon->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characterlevelsCharacterweapon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characterlevelsCharacterweapon->id)]) ?>
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

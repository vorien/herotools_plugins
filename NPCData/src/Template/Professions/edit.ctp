<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $profession->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $profession->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Professions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="professions form large-9 medium-8 columns content">
    <?= $this->Form->create($profession) ?>
    <fieldset>
        <legend><?= __('Edit Profession') ?></legend>
        <?php
            echo $this->Form->input('guild_id', ['options' => $guilds, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('incidence');
            echo $this->Form->input('normalized');
            echo $this->Form->input('low');
            echo $this->Form->input('high');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

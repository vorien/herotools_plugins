<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Professions'), ['controller' => 'Professions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profession'), ['controller' => 'Professions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="guilds form large-9 medium-8 columns content">
    <?= $this->Form->create($guild) ?>
    <fieldset>
        <legend><?= __('Add Guild') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('incidence');
            echo $this->Form->input('normalized');
            echo $this->Form->input('personas._ids', ['options' => $personas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

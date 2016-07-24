<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Personas Guilds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasGuilds form large-9 medium-8 columns content">
    <?= $this->Form->create($personasGuild) ?>
    <fieldset>
        <legend><?= __('Add Personas Guild') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('guild_id', ['options' => $guilds, 'empty' => true]);
            echo $this->Form->input('direction');
            echo $this->Form->input('strength');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

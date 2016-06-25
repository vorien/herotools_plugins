<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $guildsPersona->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $guildsPersona->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Guilds Personas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="guildsPersonas form large-9 medium-8 columns content">
    <?= $this->Form->create($guildsPersona) ?>
    <fieldset>
        <legend><?= __('Edit Guilds Persona') ?></legend>
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

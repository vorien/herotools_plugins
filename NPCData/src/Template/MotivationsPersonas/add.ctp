<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Motivations Personas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="motivationsPersonas form large-9 medium-8 columns content">
    <?= $this->Form->create($motivationsPersona) ?>
    <fieldset>
        <legend><?= __('Add Motivations Persona') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('motivation_id', ['options' => $motivations, 'empty' => true]);
            echo $this->Form->input('priority');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

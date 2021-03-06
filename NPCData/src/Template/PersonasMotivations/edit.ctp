<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personasMotivation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personasMotivation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personas Motivations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasMotivations form large-9 medium-8 columns content">
    <?= $this->Form->create($personasMotivation) ?>
    <fieldset>
        <legend><?= __('Edit Personas Motivation') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('motivation_id', ['options' => $motivations, 'empty' => true]);
            echo $this->Form->input('priority');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

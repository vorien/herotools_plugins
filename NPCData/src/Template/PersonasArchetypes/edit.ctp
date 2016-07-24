<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personasArchetype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personasArchetype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personas Archetypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasArchetypes form large-9 medium-8 columns content">
    <?= $this->Form->create($personasArchetype) ?>
    <fieldset>
        <legend><?= __('Edit Personas Archetype') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('archetype_id', ['options' => $archetypes, 'empty' => true]);
            echo $this->Form->input('n_d');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personasFlaw->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personasFlaw->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personas Flaws'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasFlaws form large-9 medium-8 columns content">
    <?= $this->Form->create($personasFlaw) ?>
    <fieldset>
        <legend><?= __('Edit Personas Flaw') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('flaw_id', ['options' => $flaws, 'empty' => true]);
            echo $this->Form->input('severity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Agendas'), ['controller' => 'Agendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Agenda'), ['controller' => 'Agendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notes'), ['controller' => 'Notes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Note'), ['controller' => 'Notes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Qualities'), ['controller' => 'Qualities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quality'), ['controller' => 'Qualities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personas form large-9 medium-8 columns content">
    <?= $this->Form->create($persona) ?>
    <fieldset>
        <legend><?= __('Add Persona') ?></legend>
        <?php
            echo $this->Form->input('person_id', ['options' => $people, 'empty' => true]);
            echo $this->Form->input('agenda_id', ['options' => $agendas, 'empty' => true]);
            echo $this->Form->input('profession');
            echo $this->Form->input('employer');
            echo $this->Form->input('influence');
            echo $this->Form->input('wealth');
            echo $this->Form->input('picture');
            echo $this->Form->input('gender');
            echo $this->Form->input('generosity');
            echo $this->Form->input('decency');
            echo $this->Form->input('reliability');
            echo $this->Form->input('reserve');
            echo $this->Form->input('benevolence');
            echo $this->Form->input('restraint');
            echo $this->Form->input('moderation');
            echo $this->Form->input('stability');
            echo $this->Form->input('outlook');
            echo $this->Form->input('integrity');
            echo $this->Form->input('discipline');
            echo $this->Form->input('spirit');
            echo $this->Form->input('gregariousness');
            echo $this->Form->input('conformity');
            echo $this->Form->input('archetypes._ids', ['options' => $archetypes]);
            echo $this->Form->input('flaws._ids', ['options' => $flaws]);
            echo $this->Form->input('guilds._ids', ['options' => $guilds]);
            echo $this->Form->input('motivations._ids', ['options' => $motivations]);
            echo $this->Form->input('qualities._ids', ['options' => $qualities]);
            echo $this->Form->input('quirks._ids', ['options' => $quirks]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

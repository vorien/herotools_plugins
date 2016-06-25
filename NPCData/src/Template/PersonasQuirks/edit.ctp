<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personasQuirk->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personasQuirk->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personas Quirks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="personasQuirks form large-9 medium-8 columns content">
    <?= $this->Form->create($personasQuirk) ?>
    <fieldset>
        <legend><?= __('Edit Personas Quirk') ?></legend>
        <?php
            echo $this->Form->input('persona_id', ['options' => $personas, 'empty' => true]);
            echo $this->Form->input('quirk_id', ['options' => $quirks, 'empty' => true]);
            echo $this->Form->input('severity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

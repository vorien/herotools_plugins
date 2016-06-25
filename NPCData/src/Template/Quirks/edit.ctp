<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $quirk->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $quirk->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Quirks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quirks form large-9 medium-8 columns content">
    <?= $this->Form->create($quirk) ?>
    <fieldset>
        <legend><?= __('Edit Quirk') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('personas._ids', ['options' => $personas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

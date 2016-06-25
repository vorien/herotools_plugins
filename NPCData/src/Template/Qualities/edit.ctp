<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $quality->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $quality->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Qualities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="qualities form large-9 medium-8 columns content">
    <?= $this->Form->create($quality) ?>
    <fieldset>
        <legend><?= __('Edit Quality') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('personas._ids', ['options' => $personas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

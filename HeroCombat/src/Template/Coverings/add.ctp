<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Coverings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['controller' => 'Coveringlocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['controller' => 'Coveringlocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coverings form large-9 medium-8 columns content">
    <?= $this->Form->create($covering) ?>
    <fieldset>
        <legend><?= __('Add Covering') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

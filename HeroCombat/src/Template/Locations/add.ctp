<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Targets'), ['controller' => 'Targets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Target'), ['controller' => 'Targets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['controller' => 'Coveringlocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Coveringlocation'), ['controller' => 'Coveringlocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Add Location') ?></legend>
        <?php
            echo $this->Form->input('target_id', ['options' => $targets]);
            echo $this->Form->input('roll');
            echo $this->Form->input('location');
            echo $this->Form->input('sublocation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

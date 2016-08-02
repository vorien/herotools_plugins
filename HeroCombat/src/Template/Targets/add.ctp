<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Targets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="targets form large-9 medium-8 columns content">
    <?= $this->Form->create($target) ?>
    <fieldset>
        <legend><?= __('Add Target') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('sort_order');
            echo $this->Form->input('roll');
            echo $this->Form->input('location');
            echo $this->Form->input('penalty');
            echo $this->Form->input('stunx');
            echo $this->Form->input('bodyx');
            echo $this->Form->input('nstun');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

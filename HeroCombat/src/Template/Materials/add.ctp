<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="materials form large-9 medium-8 columns content">
    <?= $this->Form->create($material) ?>
    <fieldset>
        <legend><?= __('Add Material') ?></legend>
        <?php
            echo $this->Form->input('material');
            echo $this->Form->input('manufacture');
            echo $this->Form->input('option');
            echo $this->Form->input('r_pd');
            echo $this->Form->input('r_ed');
            echo $this->Form->input('weightmultiplier');
            echo $this->Form->input('grade');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

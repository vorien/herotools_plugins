<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Armors'), ['controller' => 'Armors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armor'), ['controller' => 'Armors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Materials'), ['controller' => 'Materials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Material'), ['controller' => 'Materials', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="armormaterials form large-9 medium-8 columns content">
    <?= $this->Form->create($armormaterial) ?>
    <fieldset>
        <legend><?= __('Add Armormaterial') ?></legend>
        <?php
            echo $this->Form->input('armor_id', ['options' => $armors, 'empty' => true]);
            echo $this->Form->input('material_id', ['options' => $materials, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

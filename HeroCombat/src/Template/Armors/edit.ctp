<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $armor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $armor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Armors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Armormaterials'), ['controller' => 'Armormaterials', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Armormaterial'), ['controller' => 'Armormaterials', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="armors form large-9 medium-8 columns content">
    <?= $this->Form->create($armor) ?>
    <fieldset>
        <legend><?= __('Edit Armor') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('armor');
            echo $this->Form->input('r_pd');
            echo $this->Form->input('r_ed');
            echo $this->Form->input('training_penalty');
            echo $this->Form->input('ar_cost');
            echo $this->Form->input('weight');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

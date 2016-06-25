<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $coveringlocation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $coveringlocation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Coveringlocations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Coverings'), ['controller' => 'Coverings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Covering'), ['controller' => 'Coverings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coveringlocations form large-9 medium-8 columns content">
    <?= $this->Form->create($coveringlocation) ?>
    <fieldset>
        <legend><?= __('Edit Coveringlocation') ?></legend>
        <?php
            echo $this->Form->input('covering_id', ['options' => $coverings, 'empty' => true]);
            echo $this->Form->input('location_id', ['options' => $locations, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

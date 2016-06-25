<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Allguilds'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="allguilds form large-9 medium-8 columns content">
    <?= $this->Form->create($allguild) ?>
    <fieldset>
        <legend><?= __('Add Allguild') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('profession');
            echo $this->Form->input('incidence');
            echo $this->Form->input('normalized');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

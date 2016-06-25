<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personality->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personality->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Personalities'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="personalities form large-9 medium-8 columns content">
    <?= $this->Form->create($personality) ?>
    <fieldset>
        <legend><?= __('Edit Personality') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('sort_order');
            echo $this->Form->input('virtue');
            echo $this->Form->input('virtue_description');
            echo $this->Form->input('vice');
            echo $this->Form->input('vice_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

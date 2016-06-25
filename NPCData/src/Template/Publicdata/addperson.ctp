<?php $this->set('title', 'New NPC'); ?>
<div class="people form large-9 medium-8 columns content">
    <?= $this->Form->create($person) ?>
    <fieldset>
        <legend><?= __('Add Person') ?></legend>
        <?php
            echo $this->Form->input('given_name');
            echo $this->Form->input('family_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

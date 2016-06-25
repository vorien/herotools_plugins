<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterlevels'), ['controller' => 'Characterlevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterlevel'), ['controller' => 'Characterlevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Charactermaneuvers'), ['controller' => 'Charactermaneuvers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Charactermaneuver'), ['controller' => 'Charactermaneuvers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterprotections'), ['controller' => 'Characterprotections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterprotection'), ['controller' => 'Characterprotections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characterweapons'), ['controller' => 'Characterweapons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characterweapon'), ['controller' => 'Characterweapons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="characters form large-9 medium-8 columns content">
    <?= $this->Form->create($character) ?>
    <fieldset>
        <legend><?= __('Add Character') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('player');
            echo $this->Form->input('str');
            echo $this->Form->input('con');
            echo $this->Form->input('ocv');
            echo $this->Form->input('dcv');
            echo $this->Form->input('omcv');
            echo $this->Form->input('dmcv');
            echo $this->Form->input('ma_dc');
            echo $this->Form->input('n_pd');
            echo $this->Form->input('n_ed');
            echo $this->Form->input('r_pd');
            echo $this->Form->input('r_ed');
            echo $this->Form->input('body');
            echo $this->Form->input('stun');
            echo $this->Form->input('endurance');
            echo $this->Form->input('recovery');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('gm_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

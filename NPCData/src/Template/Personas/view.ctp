<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Persona'), ['action' => 'edit', $persona->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Persona'), ['action' => 'delete', $persona->id], ['confirm' => __('Are you sure you want to delete # {0}?', $persona->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Personas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Persona'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Agendas'), ['controller' => 'Agendas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Agenda'), ['controller' => 'Agendas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notes'), ['controller' => 'Notes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note'), ['controller' => 'Notes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Archetypes'), ['controller' => 'Archetypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Archetype'), ['controller' => 'Archetypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Flaws'), ['controller' => 'Flaws', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Flaw'), ['controller' => 'Flaws', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guilds'), ['controller' => 'Guilds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guild'), ['controller' => 'Guilds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Motivations'), ['controller' => 'Motivations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Motivation'), ['controller' => 'Motivations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Qualities'), ['controller' => 'Qualities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quality'), ['controller' => 'Qualities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quirks'), ['controller' => 'Quirks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quirk'), ['controller' => 'Quirks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="personas view large-9 medium-8 columns content">
    <h3><?= h($persona->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $persona->has('person') ? $this->Html->link($persona->person->name, ['controller' => 'People', 'action' => 'view', $persona->person->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Agenda') ?></th>
            <td><?= $persona->has('agenda') ? $this->Html->link($persona->agenda->name, ['controller' => 'Agendas', 'action' => 'view', $persona->agenda->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Profession') ?></th>
            <td><?= h($persona->profession) ?></td>
        </tr>
        <tr>
            <th><?= __('Employer') ?></th>
            <td><?= h($persona->employer) ?></td>
        </tr>
        <tr>
            <th><?= __('Picture') ?></th>
            <td><?= h($persona->picture) ?></td>
        </tr>
        <tr>
            <th><?= __('Gender') ?></th>
            <td><?= h($persona->gender) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($persona->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Influence') ?></th>
            <td><?= $this->Number->format($persona->influence) ?></td>
        </tr>
        <tr>
            <th><?= __('Wealth') ?></th>
            <td><?= $this->Number->format($persona->wealth) ?></td>
        </tr>
        <tr>
            <th><?= __('Generosity') ?></th>
            <td><?= $this->Number->format($persona->generosity) ?></td>
        </tr>
        <tr>
            <th><?= __('Decency') ?></th>
            <td><?= $this->Number->format($persona->decency) ?></td>
        </tr>
        <tr>
            <th><?= __('Reliability') ?></th>
            <td><?= $this->Number->format($persona->reliability) ?></td>
        </tr>
        <tr>
            <th><?= __('Reserve') ?></th>
            <td><?= $this->Number->format($persona->reserve) ?></td>
        </tr>
        <tr>
            <th><?= __('Benevolence') ?></th>
            <td><?= $this->Number->format($persona->benevolence) ?></td>
        </tr>
        <tr>
            <th><?= __('Restraint') ?></th>
            <td><?= $this->Number->format($persona->restraint) ?></td>
        </tr>
        <tr>
            <th><?= __('Moderation') ?></th>
            <td><?= $this->Number->format($persona->moderation) ?></td>
        </tr>
        <tr>
            <th><?= __('Stability') ?></th>
            <td><?= $this->Number->format($persona->stability) ?></td>
        </tr>
        <tr>
            <th><?= __('Outlook') ?></th>
            <td><?= $this->Number->format($persona->outlook) ?></td>
        </tr>
        <tr>
            <th><?= __('Integrity') ?></th>
            <td><?= $this->Number->format($persona->integrity) ?></td>
        </tr>
        <tr>
            <th><?= __('Discipline') ?></th>
            <td><?= $this->Number->format($persona->discipline) ?></td>
        </tr>
        <tr>
            <th><?= __('Spirit') ?></th>
            <td><?= $this->Number->format($persona->spirit) ?></td>
        </tr>
        <tr>
            <th><?= __('Gregariousness') ?></th>
            <td><?= $this->Number->format($persona->gregariousness) ?></td>
        </tr>
        <tr>
            <th><?= __('Conformity') ?></th>
            <td><?= $this->Number->format($persona->conformity) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($persona->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($persona->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Notes') ?></h4>
        <?php if (!empty($persona->notes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Persona Id') ?></th>
                <th><?= __('Note') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->notes as $notes): ?>
            <tr>
                <td><?= h($notes->id) ?></td>
                <td><?= h($notes->persona_id) ?></td>
                <td><?= h($notes->note) ?></td>
                <td><?= h($notes->created) ?></td>
                <td><?= h($notes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notes', 'action' => 'view', $notes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notes', 'action' => 'edit', $notes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notes', 'action' => 'delete', $notes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Archetypes') ?></h4>
        <?php if (!empty($persona->archetypes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->archetypes as $archetypes): ?>
            <tr>
                <td><?= h($archetypes->id) ?></td>
                <td><?= h($archetypes->name) ?></td>
                <td><?= h($archetypes->description) ?></td>
                <td><?= h($archetypes->created) ?></td>
                <td><?= h($archetypes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Archetypes', 'action' => 'view', $archetypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Archetypes', 'action' => 'edit', $archetypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Archetypes', 'action' => 'delete', $archetypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $archetypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Flaws') ?></h4>
        <?php if (!empty($persona->flaws)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->flaws as $flaws): ?>
            <tr>
                <td><?= h($flaws->id) ?></td>
                <td><?= h($flaws->name) ?></td>
                <td><?= h($flaws->description) ?></td>
                <td><?= h($flaws->created) ?></td>
                <td><?= h($flaws->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Flaws', 'action' => 'view', $flaws->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Flaws', 'action' => 'edit', $flaws->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Flaws', 'action' => 'delete', $flaws->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flaws->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Guilds') ?></h4>
        <?php if (!empty($persona->guilds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Incidence') ?></th>
                <th><?= __('Normalized') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->guilds as $guilds): ?>
            <tr>
                <td><?= h($guilds->id) ?></td>
                <td><?= h($guilds->name) ?></td>
                <td><?= h($guilds->incidence) ?></td>
                <td><?= h($guilds->normalized) ?></td>
                <td><?= h($guilds->created) ?></td>
                <td><?= h($guilds->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Guilds', 'action' => 'view', $guilds->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Guilds', 'action' => 'edit', $guilds->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Guilds', 'action' => 'delete', $guilds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guilds->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Motivations') ?></h4>
        <?php if (!empty($persona->motivations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->motivations as $motivations): ?>
            <tr>
                <td><?= h($motivations->id) ?></td>
                <td><?= h($motivations->name) ?></td>
                <td><?= h($motivations->description) ?></td>
                <td><?= h($motivations->created) ?></td>
                <td><?= h($motivations->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Motivations', 'action' => 'view', $motivations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Motivations', 'action' => 'edit', $motivations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Motivations', 'action' => 'delete', $motivations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $motivations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Qualities') ?></h4>
        <?php if (!empty($persona->qualities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->qualities as $qualities): ?>
            <tr>
                <td><?= h($qualities->id) ?></td>
                <td><?= h($qualities->name) ?></td>
                <td><?= h($qualities->created) ?></td>
                <td><?= h($qualities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Qualities', 'action' => 'view', $qualities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Qualities', 'action' => 'edit', $qualities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Qualities', 'action' => 'delete', $qualities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $qualities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Quirks') ?></h4>
        <?php if (!empty($persona->quirks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($persona->quirks as $quirks): ?>
            <tr>
                <td><?= h($quirks->id) ?></td>
                <td><?= h($quirks->name) ?></td>
                <td><?= h($quirks->created) ?></td>
                <td><?= h($quirks->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Quirks', 'action' => 'view', $quirks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Quirks', 'action' => 'edit', $quirks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Quirks', 'action' => 'delete', $quirks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quirks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

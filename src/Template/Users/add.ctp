<fieldset>
    <legend>Ajouter un utilisateur</legend>
    <?= $this->Form->create($new) ?>
        <?= $this->Form->control('pseudo', [
            'label' => 'Prénom de l\'utilisateur',
        ]) ?>
        <?= $this->Form->control('password', [
            'label' => 'Nom de l\'utilisateur'
        ]) ?>
        <?= $this->Form->button('Ajouter votre utilisateur') ?>
    <?= $this->Form->end() ?>
</fieldset>

<fieldset>
    <legend>Se connecter</legend>
    <?= $this->Form->create() ?>
        <?= $this->Form->control('pseudo', [
            'label' => 'Pseudo de l\'utilisateur',
        ]) ?>
        <?= $this->Form->control('password', [
            'label' => 'Mot de passe de l\'utilisateur'
        ]) ?>
        <?= $this->Form->button('Se connecter') ?>
    <?= $this->Form->end() ?>
</fieldset>

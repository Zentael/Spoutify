<fieldset>
    <legend>Editer la description de l'artiste</legend>
    <?= $this->Form->create($editA, ['enctype' => 'multipart/form-data']) ?>
        <?= $this->Form->control('artistname', [
            'label' => 'Nom de l\'artiste',
        ]) ?>
        <?= $this->Form->control('region', [
            'label' => 'Pays d\'origine de l\'artiste',
        ]) ?>
        <?= $this->Form->control('debutdate', [
            'label' => 'L\'année de lancement de l\'artiste',
        ]) ?>
        <?= $this->Form->control('linkspotify', [
            'label' => 'Le lien spotify de l\'artiste',
        ]) ?>
        <?= $this->Form->button('Valider votre modification') ?>
    <?= $this->Form->end() ?>
</fieldset>

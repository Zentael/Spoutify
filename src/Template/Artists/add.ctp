<fieldset>
    <legend>Ajouter un artiste</legend>
    <?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
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
    <?= $this->Form->control('picture', ['label' => 'Une phot de l\'artiste', 'type' => 'file']) ?>
        <?= $this->Form->button('Ajouter l\'artiste') ?>
    <?= $this->Form->end() ?>
</fieldset>

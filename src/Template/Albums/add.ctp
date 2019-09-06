<fieldset>
    <legend>Ajouter un album</legend>
    <?= $this->Form->create($new, ['enctype' => 'multipart/form-data']) ?>
        <?= $this->Form->control('title', [
            'label' => 'Titre de l\'album',
        ]) ?>
        <?= $this->Form->control('style', [
            'label' => 'Style de l\'album',
        ]) ?>
        <?= $this->Form->control('releasedate', [
            'label' => 'L\'année de sortie de l\'album',
            'type' => 'number',
            'min' => "1990", 'max' => date("Y")
        ]) ?>
        <?= $this->Form->control('linkspotify', [
            'label' => 'Le lien Spotify de l\'album',
        ]) ?>
        <?= $this->Form->control('picture', ['label' => 'La couverture de l\'album', 'type' => 'file']) ?>
        <?= $this->Form->button('Ajouter l\'album') ?>
    <?= $this->Form->end() ?>
</fieldset>

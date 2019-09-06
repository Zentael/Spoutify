<fieldset>
    <legend>Editer la description de l'album</legend>
    <?= $this->Form->create($editA) ?>
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
        <?= $this->Form->button('Valider votre modification') ?>
    <?= $this->Form->end() ?>
</fieldset>

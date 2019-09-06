<?php //file : src/Templates/Movies/editPoster.ctp

?>

<h1>
La photo de l'artiste
</h1>

<figure class="poster">
    <?php
    if(!empty($editA->picture)){ ?>
        <?= $this->Html->image('../data/pictures/artists/'.$editA->picture, ['alt' => 'Photo de : '.$editA->artistname]) ?>
    <?php } else { ?>
        <?= $this->Html->image('default.jpg', ['alt' => "Pas de photo disponible"]) ?>
    <?php } ?>
</figure>

<fieldset>
    <legend>Changer la photo de l'artiste</legend>
<?= $this->Form->create($editA, ['enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('picture', ['label' => 'La photo de l\'artiste', 'type' => 'file']) ?>
    <?= $this->Form->button('Valider votre modification') ?>
<?= $this->Form->end() ?>
</fieldset>
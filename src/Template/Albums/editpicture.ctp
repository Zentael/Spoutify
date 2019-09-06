<?php //file : src/Templates/Movies/editpicture.ctp

?>

<h1>
La couverture de l'album
</h1>

<figure class="picture">
    <?php
    if(!empty($editP->picture)){ ?>
        <?= $this->Html->image('../data/pictures/'.$editP->picture, ['alt' => 'Couverture de : '.$editP->title]) ?>
    <?php } else { ?>
        <?= $this->Html->image('default.jpg', ['alt' => "Pas d'affiche disponible"]) ?>
    <?php } ?>
</figure>

<fieldset>
    <legend>Changer la couverture de l'album</legend>
<?= $this->Form->create($editP, ['enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('picture', ['label' => 'La couverture de l\'album', 'type' => 'file']) ?>
    <?= $this->Form->button('Valider votre modification') ?>
<?= $this->Form->end() ?>
</fieldset>
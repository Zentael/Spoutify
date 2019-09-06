<?php //file : src/Templates/Albums/view.ctp
$album = $a;
?>

<h1>
    L'album, en détail
</h1>
<blockquote>"<?= $album->title ?>"</blockquote>
<div class="viewContainer">
    <div>
        <h3>Résumé :</h3>
        <div>Genre : <?= $album->style ?></div>
        <div>
            <div><?= (!empty($album->releasedate)) ? $album->releasedate->i18nFormat('dd/MM/yyyy') : '' ?></div>
            <div>Peut être écouté<a target="_blank" href="https://open.spotify.com/embed/album/<?= $album->linkspotify ?>"> là </a></div>
        </div>
    </div>
    <?php if(!empty($album->linkspotify)){ ?>
        <div>
            <iframe src="https://open.spotify.com/embed/album/<?=$album->linkspotify?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
        </div>
    <?php } ?>


    <figure class="picture">
        <?php
        if(!empty($album->picture)){ ?>
            <?= $this->Html->image('../data/pictures/albums/'.$album->picture, ['alt' => 'Couverture de : '.$album->title]) ?>
        <?php } else { ?>
            <?= $this->Html->image('default.jpg', ['alt' => "Pas de couverture d'album disponible"]) ?>
        <?php } ?>
    </figure>
</div>

<?php if($this->Session->read('Auth.User') && $auth->user('role') === 'admin'){ ?>
    <div class="viewEdit">
        <div>
            <?= $this->Html->link('Changer la couverture', ['action' => 'editpicture', $album->id]) ?>
        </div>
        <?php
            if(!empty($album->picture)) {
        ?>
                <div>
                    <?= $this->Form->postLink('Supprimer la couverture', ['action' => 'deletepicture', $album->id]); ?>
                </div>
        <?php
            }
        ?>
        <div>
            <?= $this->Html->link('Edit', ['action' => 'edit', $album->id]) ?>
        </div>
        <div>
            <?= $this->Form->postLink('Delete', ['action' => 'delete', $album->id, $album->artist_id], ['confirm' => 'Sûr ?']); ?>
        </div>
    </div>
<?php } else { ?>
    <div>peu pas éditer</div>
<?php } ?>

<!--<span><?php var_dump($album); ?></span>-->

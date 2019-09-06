<?php //file : src/Templates/artists/view.ctp

?>

<h1>
    L'artiste, en détail
</h1>
<blockquote>"<?= $artist->artistname ?>"</blockquote>

<div class="viewContainer">
    <div>
        <div>
            <?php if(!empty($artist->debutdate)){
                echo '<div>A commencé en '.$artist->debutdate.'</div>';
            }?>
            <?php if(!empty($artist->region)){
                echo '<div>Vient de '.$artist->region .'</div>';
            }?>
            <?php if(!empty($artist->linkspotify)){
                echo '<div><a target="_blank" href="https://open.spotify.com/embed/artist/'.$artist->linkspotify.'">Son spotify</a></div>';
            }?>
        </div>

    </div>

    <figure class="poster">
        <?php
        if(!empty($artist->picture)){ ?>
            <?= $this->Html->image('../data/pictures/artists/'.$artist->picture, ['alt' => 'Affiche de : '.$artist->title]) ?>
        <?php } else { ?>
            <?= $this->Html->image('default.jpg', ['alt' => "Pas d'affiche disponible"]) ?>
        <?php } ?>
    </figure>
</div>

<div class="viewArtist-sub">

    <div>
        <div>Ses albums :</div>
        <div>
        <?php
        if(!empty($artist->albums)){
            foreach($artist->albums as $key => $album){
                echo '<div>';
                    echo '<div>'.$this->Html->link($album->title, ['controller' => 'albums', 'action' => 'view', $album->id]).
                        ', '.$album->releasedate.'</div>';
                    echo'<div>Peut être écouté<a href="'. $album->linkspotify .'"> là </a></div>';
                    echo'<div> - '.$album->style.'</div>';
                echo '</div>';
            }
        } else echo '<span>Il n\'y a pas encore d\'albums</span>';
        ?>
        </div>
    </div>
    <div>
        <?php
        if($artistFavourites->count() > 1){
            echo $artistFavourites->count(). ' utilisateurs on mis cet artiste dans leurs favoris';
        } else if ($artistFavourites->count() === 1){
            echo $artistFavourites->count(). ' utilisateur a mis cet artiste dans ses favoris';
        } else {
            echo 'Soyez le premier utilisateur à placer cet artiste dans vos favoris !';
        }
        ?>
    </div>
    <?php if(!empty($artist->linkspotify)){
        echo'<div>
        <iframe src="https://open.spotify.com/embed/artist/'.$artist->linkspotify.'" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
    </div>';
    } ?>

    <div>
        <?php if($this->Session->read('Auth.User')) {
            if($artistFavourites->where(['user_id' => $auth->user('id')])->count() === 0) {
                echo $this->Html->link('Ajouter à mes favoris', ['controller' => 'favourites', 'action' => 'add', $artist->id, $auth->user('id')]);
            } else {
                echo $this->Form->postLink('Retirer de mes favoris', ['controller' => 'favourites', 'action' => 'delete', $artist->id, $auth->user('id')]);
            }
        } else {
            echo $this->Html->link('Connectez-vous', ['controller' => 'users', 'action' => 'login', $artist->id]). ' pour pouvoir ajouter l\'artiste à vos favoris';
        } ?>
    </div>
</div>
<?php if($this->Session->read('Auth.User') && $auth->user('role') === 'admin'){ ?>
    <div class="viewEdit">
        <div>
            <?= $this->Html->link('Changer l\'image', ['action' => 'editpicture', $artist->id]) ?>
        </div>
        <?php
        if(!empty($artist->picture)) {
            ?>
            <div>
                <?= $this->Form->postLink('Supprimer l\'image', ['action' => 'deletepicture', $artist->id]); ?>
            </div>
            <?php
        }
        ?>
        <div>
            <?= $this->Html->link('Edit', ['action' => 'edit', $artist->id]) ?>
        </div>
        <div>
            <?= $this->Html->link('Ajouter un album', ['controller' => 'albums', 'action' => 'add', $artist->id]) ?>
        </div>
        <div>
            <?= $this->Form->postLink('Delete', ['action' => 'delete', $artist->id], ['confirm' => 'Sûr ?']); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="editBar">peu pas éditer</div>
<?php } ?>

<?php /*if($this->Session->read('Auth.User')){ ?>
    <div class="viewEdit">
        <div>
            <?= $this->Html->link('Changer l\'affiche', ['action' => 'editPoster', $artist->id]) ?>
        </div>
        <?php
            if(!empty($artist->picture)) {
        ?>
                <div>
                    <?= $this->Form->postLink('Supprimer l\'affiche', ['action' => 'deletePoster', $artist->id]); ?>
                </div>
        <?php
            }
        ?>
        <div>
            <?= $this->Html->link('Edit', ['action' => 'edit', $artist->id]) ?>
        </div>
        <div>
            <?= $this->Form->postLink('Delete', ['action' => 'delete', $artist->id], ['confirm' => 'Sûr ?']); ?>
        </div>
    </div>
<?php }*/ ?>

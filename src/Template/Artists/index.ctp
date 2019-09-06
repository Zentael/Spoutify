<?php //file : src/Templates/Quotes/index.ctp

?>
<h1>
    Les artistes de Spoutify
</h1>

<h2>Les artistes au top</h2>
<ul>
    <?php
        foreach ($top4Artists as $top):
            echo '<li>';
            echo $this->Html->link($top->artistname, ['action' => 'view', $top->id]);
            echo '</li>';
        endforeach;
    ?>
</ul>
<h2>Les nouveaux challengers</h2>
<ul>
    <?php
    foreach ($challengers4Artists as $challenger):
        echo '<li>';
        echo $this->Html->link($challenger->artistname, ['action' => 'view', $challenger->id]);
        echo '</li>';
    endforeach;
    ?>
</ul>
<h2>Tout les artistes</h2>
<ul>
    <?php foreach ($a as $artist): $singleArtistAlbum[$artist->id];?>
        <li>
            <div>
                <div>
                    <?= $this->Html->link($artist->artistname, ['action' => 'view', $artist->id]) ?>
                </div>

                <figure class="poster">
                    <?php
                    if(!empty($artist->picture)){ ?>
                        <?= $this->Html->image('../data/pictures/artists/'.$artist->picture, ['alt' => 'Photo de : '.$artist->title]) ?>
                    <?php } else { ?>
                        <?= $this->Html->image('default.jpg', ['alt' => "Pas de photo disponible"]) ?>
                    <?php } ?>
                </figure>
            </div>
            <?php if(!empty($singleArtistAlbum[$artist->id])){ ?>
                <div>Ecouter le dernier album : <?= $this->Html->link($singleArtistAlbum[$artist->id]->title, ['controller' => 'albums', 'action' => 'view', $singleArtistAlbum[$artist->id]->id]) ?></div>
            <?php } ?>

        </li>

    <?php endforeach;

    if($this->Session->read('Auth.User') && $auth->user('role') === 'user'){
        echo $this->Html->link('Votre artiste préféré n\'est pas sur la plateforme ? Faites une demande aux admins', ['controller' => 'requests', 'action' => 'add', $auth->user('id')]);
    }

    if($this->Session->read('Auth.User') && $auth->user('role') === 'admin'){
        echo $this->Html->link('Ajouter un artiste', ['action' => 'add']);
    }?>
</ul>
<!--<span><?php var_dump($a); ?></span>-->
<?php echo '<p>Il y a ' .$a->count(). ' artiste';?>
<?php if($a->count() > 1){echo 's';}
echo '</p>'?>

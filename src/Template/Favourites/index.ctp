<?php //file : src/Templates/Quotes/index.ctp

?>
<h1>
    Les Commentaires
</h1>

<ul>
    <?php foreach ($c as $comment): ?>
        <li>
            <span>
                <?= $this->Html->link($comment->content, ['action' => 'profil', $comment->grade]) ?>
            </span>
        </li>

    <?php endforeach; ?>
</ul>
<!--<span><?php var_dump($c); ?></span>-->
<?php echo '<p>Il y a ' .$c->count(). ' commentaire';?>
<?php if($c->count() > 1){echo 's';}
echo '</p>'?>

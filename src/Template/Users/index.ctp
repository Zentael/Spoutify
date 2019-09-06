<?php //file : src/Templates/Quotes/index.ctp

?>
<h1>
    Les Utilisateurs de Spoutify
</h1>

<ul>
    <?php foreach ($u as $user): ?>
        <li>
            <span>
                <?= $this->Html->link($user->pseudo, ['action' => 'view', $user->id]) ?>
            </span>
        </li>

    <?php endforeach; ?>
    <?= $this->Html->link('Ajouter un utilisateur', ['action' => 'add']) ?>
</ul>
<!--<span><?php var_dump($u); ?></span>-->
<?php echo '<p>Il y a ' .$u->count(). ' utilisateur';?>
<?php if($u->count() > 1){echo 's';}
echo '</p>'?>

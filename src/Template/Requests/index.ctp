<?php //file : src/Templates/Quotes/index.ctp

?>
<h1>
    Les Demande des utilisateurs de Spoutify
</h1>
<ul class="Requests-index">
    <?php foreach ($requests as $request): ?>
        <li>
            <span>
                <?= $this->Html->link($singleUserRequest[$request->id]->pseudo, ['action' => 'view', $request->id]) ?>
            </span>
            <span>
                <?php if($request->status !== "unread"){
                    echo $this->Form->postlink('Effacer cette demande', ['action' => 'delete', $request->id]);
                } else {
                    echo "~Nouvelle demande";
                }?>
            </span>
        </li>

    <?php endforeach; ?>
</ul>
<!--<span><?php var_dump($requests); ?></span>-->
<?php echo '<p>Il y a ' .$requests->count(). ' demande';?>
<?php if($requests->count() > 1){echo 's';}
echo '</p>'?>

<?php

$cakeDescription = 'Spoutify';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
        <?= $cakeDescription ?>:
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('reset.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Nunito|Slabo+27px" rel="stylesheet">
    <?= $this->Html->css('main.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <header>
        <h1>Spoutify</h1>
        <nav>
            <?= $this->Html->link('Liste des artistes', ['controller' => 'artists', 'action' => 'index'],
                array('class' => $this->templatePath === "Artists" && $this->template === "index" ?
                    'active' : ''))
            ?>
            <?= $this->Html->link('Un album au hasard', ['controller' => 'albums', 'action' => 'random']) ?>

            <?php if($this->Session->read('Auth.User')){ ?>
                <?= $this->Html->link('Changer d\'utilisateur', ['controller' => 'users', 'action' => 'changeAccount']) ?>

                <?php if($auth->user('role') === 'user'){
                    echo $this->Html->link('Faire une requête', ['controller' => 'requests', 'action' => 'add']);
                } else if($auth->user('role') === 'admin'){
                    echo $this->Html->link('Voir les requêtes', ['controller' => 'requests', 'action' => 'index']);
                } ?>
                <?= $this->Html->link('Se déconnecter', ['controller' => 'users', 'action' => 'logout']) ?>
                <span style="color:green;"><?= 'Bienvenue '.$auth->user('pseudo')?></span>
            <?php } else {?>
                <?= $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login']) ?>
                <?= $this->Html->link('Créer un utilisateur', ['controller' => 'users', 'action' => 'add']) ?>
                <span style="color:red;">Invité</span>
            <?php } ?>
        </nav>

    </header>
    <main>
        <!-- Récupère les messages utilisateur et les affichent-->
        <?= $this->Flash->render() ?>

        <!-- Récupère les données et le contenu de la page et l'affiche-->
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>
</body>
</html>

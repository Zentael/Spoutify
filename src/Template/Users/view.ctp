<?php //file : src/Templates/users/view.ctp

?>

<h1>
    L'utilisateur
</h1>
<h2><?= $user->pseudo ?></h2>
<div>
    <?php

        if($user->id === $auth->user('id')) {
            echo 'Artistes mis en favoris :';
            foreach ($user->favourites as $key => $favourite) {
                echo '<div>';
                echo $this->Html->link($favourite->artist->artistname, ['controller' => 'artists', 'action' => 'view', $favourite->artist->id]);
                echo '</div>';
            }
        } else if ($this->Session->read('Auth.User')){
            echo 'Les favoris que vous avez en commun avec '.$user->pseudo.' : ';
            foreach ($user->favourites as $key => $favourite) {
                foreach($connectedUser->favourites as $key => $connectedFavourite){
                    if($favourite->artist_id === $connectedFavourite->artist_id){
                        echo '<div>';
                        echo $this->Html->link($favourite->artist->artistname, ['controller' => 'artists', 'action' => 'view', $favourite->artist->id]);
                        echo '</div>';
                    }
                }
            }
            echo 'Vous pourriez aimer ces artistes que '.$user->pseudo.' a mis dans ses favoris : ';
            foreach ($user->favourites as $key => $favourite) {
                $mightLike = true;
                foreach($connectedUser->favourites as $key => $connectedFavourite){
                    if($favourite->artist_id === $connectedFavourite->artist_id){
                        $mightLike = false;
                    }
                }
                if ($mightLike){
                    echo '<div>';
                    echo $this->Html->link($favourite->artist->artistname, ['controller' => 'artists', 'action' => 'view', $favourite->artist->id]);
                    echo '</div>';
                }
            }
        }
    ?>
</div>

<!--<span><?php var_dump($user); ?></span>-->

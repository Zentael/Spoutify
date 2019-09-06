<?php

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior;
use Composer\EventDispatcher\Event;

class ArtistImageBehavior extends Behavior{
    //Indique sur quelle colonne on travaille
    protected $_defaultConfig = [
        'field' => 'picture'
    ];

    //Fonction qui sert à appeler à chaque fois que l'on utilisera la methode ->delete sur un enregitrement movie
    /*public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options){

        //on reconstitue le chemin vers notre fichier
        $old = WWW_ROOT.'data/pictures/artists'.$entity->picture;

        //si le fichier existe, on le supprime
        if(!empty($entity->picture) && file_exists($old)){
            unlink($old);
        }
        return true;
    }*/
}
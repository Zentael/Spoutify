<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArtistsTable extends Table{

    public function initialize(array $config){
        //Demande à Cake de gèrer les created et modified
        $this->addBehavior('Timestamp');
        //Demande à Cake de gérer la gestion des images stockées
        $this->addBehavior('ArtistImage');

        $this->hasMany('Favourites', [
            'foreignKey' => 'artist_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('Albums', [
            'foreignKey' => 'artist_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);



    }

    public function validationDefault(Validator $v)
    {
        $v->maxLength('artistname', 150)
            ->allowEmpty('region')
            ->allowEmpty('picture')
            ->allowEmpty('debutdate')
            ->allowEmpty('linkspotify')
            ->maxLength('linkspotify', 150);
        return $v;
    }
}

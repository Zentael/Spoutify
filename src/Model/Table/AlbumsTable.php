<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlbumsTable extends Table{

    public function initialize(array $config){
        //Demande à Cake de gérer les created et modified
        $this->addBehavior('Timestamp');
        //Demande à Cake de gérer la gestion des images stockées
        $this->addBehavior('AlbumImage');

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $v)
    {
        $v->allowEmpty('title')
            ->maxLength('title', 150)
            ->allowEmpty('picture')
            ->allowEmpty('style')
            ->allowEmpty('releasedate')
            ->allowEmpty('linkspotify');
        return $v;
    }
}

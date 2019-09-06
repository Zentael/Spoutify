<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FavouritesTable extends Table{

    public function initialize(array $config){
        //Demande à Cake de gérer les created et modified
        $this->addBehavior('Timestamp');

        $this->belongsTo('Artists', [
           'foreignKey' => 'artist_id',
           'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
}

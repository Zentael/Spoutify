<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table{

    public function initialize(array $config){
        //Demande à Cake de gérer les created et modified
        $this->addBehavior('Timestamp');
        //Demande à Cake de gérer la gestion des images stockées

        $this->hasMany('Favourites', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('Requests', [
            'foreignKey' => 'user_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

    public function validationDefault(Validator $v)
    {
        return $v;
    }
}

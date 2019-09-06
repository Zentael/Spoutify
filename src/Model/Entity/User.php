<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher; // Add this line

class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    // Add this method
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 07/03/2019
 * Time: 14:52
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Artist extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
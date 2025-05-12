<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Calculator extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'height' => true,
        'weight' => true,
        'age' => true,
        'gender' => true,
        'bmi' => true,
        'caloric_needs' => true
    ];
}

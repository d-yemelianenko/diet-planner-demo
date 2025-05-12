<?php

namespace App\Model\Table;


use Cake\ORM\Table;
use Cake\Validation\Validator;

class CalculatorsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('calculations');
    }

    public function validationDefault(Validator $validator): Validator {}
}

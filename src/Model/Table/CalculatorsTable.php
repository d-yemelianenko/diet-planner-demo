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

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence(['height', 'weight'])
            ->notEmptyString('height', 'Wzrost jest wymagany')
            ->notEmptyString('weight', 'Waga jest wymagana')
            ->notEmptyString('age', 'Wiek jest wymagany')
            ->numeric('height', 'Wzrost musi być liczbą')
            ->numeric('weight', 'Waga musi być liczbą')
            ->numeric('age', 'Wiek musi być liczbą')
            ->greaterThan('height', 0, 'Wzrost musi być większy niż 0')
            ->lessThan('height', 300, 'Wzrost musi być mniejszy niż 300')
            ->greaterThan('weight', 0, 'Waga musi być większa niż 0')
            ->greaterThan('age', 0, 'Wiek musi być większy niż 0')
            ->inList('gender', ['male', 'female'], 'Wybierz poprawną płeć');
        return $validator;
    }
}

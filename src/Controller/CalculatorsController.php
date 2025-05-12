<?php

namespace App\Controller;

class CalculatorsController extends AppController
{
    /**
     * Displays paginated calculations with user data
     * 
     * Fetches all calculations with associated user records,
     * paginates results for better UX
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Calculations->find()
            ->contain(['Users']);
        $calculations = $this->paginate($query);

        $this->set(compact('calculations'));
    }
    /**
     * Handles calorie calculation logic
     * 
     * - Validates user authentication
     * - Processes BMI/BMR calculations
     * - Saves health metrics to database
     * - Implements gender-specific formulas
     * 
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function calculate()
    {
        // Pobierz id użytkownika z sesji
        $userId = $this->request->getSession()->read('Auth.id');
        if (!$userId) {
            $this->Flash->error(__('Musisz być zalogowany, aby uzyskać dostęp do tej strony.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $user = $this->request->getSession()->read('Auth');

        // Pobierz tabelę Calculations za pomocą fetchTable()
        $calculationsTable = $this->fetchTable('Calculations');

        // Sprawdź, czy użytkownik ma już wpis w tabeli Calculations
        $calculation = $calculationsTable
            ->find()
            ->where(['user_id' => $userId])
            ->first();

        // Jeśli użytkownik nie ma wpisu, utwórz nową encję
        if (!$calculation) {
            $calculation = $calculationsTable->newEmptyEntity();
            $calculation->user_id = $userId; // Przypisz user_id do nowej encji
        }

        if ($this->request->is('post')) { //, 'put'
            $data = $this->request->getData();


            if (!is_numeric($data['height']) || !is_numeric($data['weight']) || !is_numeric($data['age'])) {
                $this->Flash->warning(__('Wprowadź poprawne wartości wzrostu, wagi i wieku.'));
            } else {
                // Rzutuj dane na float
                $heightInCm = (float)$data['height']; // Wzrost w centymetrach
                $weight = (float)$data['weight']; // Waga w kilogramach
                $age = (int)$data['age']; // Wiek w latach
                $gender = $data['gender']; // Płeć

                if ($heightInCm > 0) {
                    // Przelicz wzrost na metry
                    $heightInMeters = $heightInCm / 100;

                    // Oblicz BMI
                    $bmi = round($weight / ($heightInMeters * $heightInMeters), 2);

                    // Oblicz BMR
                    if ($gender === 'male') {
                        $bmr = (9.99 * $weight) + (6.25 * $heightInCm) - (4.92 * $age) + 5;
                    } else {
                        $bmr = (9.99 * $weight) + (6.25 * $heightInCm) - (4.92 * $age) - 161;
                    }
                    $bmr2 = round($bmr);


                    $calculation = $calculationsTable->patchEntity($calculation, [
                        'height' => $heightInMeters,
                        'weight' => $weight,
                        'bmi' => $bmi,
                        'caloric_needs' => $bmr2,
                        'user_id' => $userId // jeśli potrzebne
                    ]);

                    $saved = $calculationsTable->save($calculation);
                    if ($saved) {
                        $this->Flash->success(__('Dane zostały zapisane.'));
                    } else {

                        $this->Flash->warning(__('Nie udało się zapisać danych.'));
                    }
                } else {
                    $this->Flash->warning(__('Wzrost musi być większy niż 0.'));
                }
            }
        }

        // Przekaż dane do widoku
        $this->set(compact('user', 'calculation'));
    }
}

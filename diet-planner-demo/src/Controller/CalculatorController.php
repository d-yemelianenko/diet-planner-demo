<?php
namespace App\Controller;

class CalculatorController extends AppController
{
    public function index()
    {
        // Przykładowe dane zamiast zapytania do bazy
        $calculations = [
            [
                'id' => 1,
                'user' => ['name' => 'Przykładowy Użytkownik'],
                'height' => 1.75,
                'weight' => 70,
                'bmi' => 22.86,
                'goal' => 'Podtrzymanie wagi'
            ]
        ];

        $this->set(compact('calculations'));
    }

    public function calculator()
    {
        // Symulacja danych użytkownika
        $user = [
            'id' => 1,
            'name' => 'Demo User',
            'email' => 'demo@example.com'
        ];

        // Przykładowe dane obliczeń
        $calculation = [
            'height' => null,
            'weight' => null,
            'age' => null,
            'gender' => 'female',
            'pal' => 1.4,
            'bmi' => null,
            'goal' => null
        ];

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (!is_numeric($data['height']) || !is_numeric($data['weight']) || !is_numeric($data['age'])) {
                $this->Flash->warning(__('Wprowadź poprawne wartości wzrostu, wagi i wieku.'));
            } else {
                $heightInCm = (float)$data['height'];
                $weight = (float)$data['weight'];
                $age = (int)$data['age'];
                $gender = $data['gender'];
                $pal = (float)$data['pal'];

                if ($heightInCm > 0) {
                    $heightInMeters = $heightInCm / 100;
                    $bmi = round($weight / ($heightInMeters * $heightInMeters), 2);

                   
                    if ($gender === 'male') {
                        $bmr = (9.99 * $weight) + (6.25 * $heightInCm) - (4.92 * $age) + 5;
                    } else {
                        $bmr = (9.99 * $weight) + (6.25 * $heightInCm) - (4.92 * $age) - 161;
                    }
                    $bmr2 = round($bmr);

                    $cpm = $bmr2 * $pal;

                    if ($bmi < 18.5) {
                        $goal = 'Kontrolowany przyrost masy ciała (+300 kcal/dzień)';
                        $cpm += 300;
                    } elseif ($bmi <= 24.99) {
                        $goal = 'Podtrzymanie obecnej masy ciała';
                    } else {
                        $goal = 'Redukcja tkanki tłuszczowej (-300 kcal/dzień)';
                        $cpm -= 300;
                    }

                    
                    $calculation = [
                        'height' => $heightInMeters,
                        'weight' => $weight,
                        'bmi' => $bmi,
                        'caloric_needs' => $bmr2,
                        'goal' => $goal,
                        'pal' => $pal,
                        'cpm' => $cpm
                    ];

                    $this->Flash->success(__('Przykładowe dane zostały obliczone.'));
                } else {
                    $this->Flash->warning(__('Wzrost musi być większy niż 0.'));
                }
            }
        }

        $this->set(compact('user', 'calculation'));
    }
 
}

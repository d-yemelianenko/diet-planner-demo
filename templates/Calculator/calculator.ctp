<div class="calculator-container">
    <h2 class="calculator-title">Kalkulator BMI i BMR</h2>

    <?php if ($calculation->id): ?>
        <div class="bmi-result">
            <h3 class="result-title">📊 Ostatnie wyniki:</h3>
            <div class="result-card">
                <p><strong>BMI:</strong> <?= h($calculation->bmi) ?></p>
                <p><strong>BMR:</strong> <?= h($calculation->caloric_needs) ?> kcal/dzień</p>
            </div>
        </div>
    <?php endif; ?>

    <?= $this->Form->create(null, ['class' => 'calculator-form']) ?>
    <fieldset>
        <div class="input-group">
            <?= $this->Form->control('height', [
                'label' => '📏 Wzrost (cm)',
                'type' => 'number',
                'step' => '0.1',
                'min' => '0',
                'required' => true
            ]) ?>
        </div>
        <div class="input-group">
            <?= $this->Form->control('weight', [
                'label' => '⚖️ Waga (kg)',
                'type' => 'number',
                'step' => '0.1',
                'min' => '0',
                'required' => true
            ]) ?>
        </div>
        <div class="input-group">
            <?= $this->Form->control('age', [
                'label' => '🎂 Wiek (lata)',
                'type' => 'number',
                'min' => '1',
                'required' => true
            ]) ?>
        </div>

        <?= $this->Form->button(__($calculation->id ? '🔄 Zaktualizuj' : '⚡ Oblicz'), ['class' => 'calculate-button']) ?>
        <?= $this->Form->end() ?>
</div>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Settings'; ?>

<div class="site-settings">
    <h1>Settings</h1>

    <?php if (Yii::$app->session->hasFlash('settingsSubmitted')): ?>
        <div class="alert alert-success">
            Settings was saved
        </div>
    <?php endif; ?>
    
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'money_max') ?>

        <?= $form->field($model, 'money_min') ?>

        <?= $form->field($model, 'money_limit') ?>

        <?= $form->field($model, 'mana_max') ?>
        
        <?= $form->field($model, 'mana_min') ?>

        <?= $form->field($model, 'mana_to_money_coef') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
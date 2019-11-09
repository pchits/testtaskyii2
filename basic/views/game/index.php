<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Game'; 
?>
<h1>Game</h1>

<?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->session->hasFlash('newgameDone')): ?>

        <div class="alert alert-success">
            You got a new prise! You can take it or play again
        </div>

        <blockquote class="blockquote">
            <?= Html::encode($game['type']); ?>
            <?= Html::encode($game['value']); ?>
            <?= Html::encode($game['name']); ?>
        </blockquote>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'send', 'value' => 'save']) ?>
        </div>

    <?php elseif (Yii::$app->session->hasFlash('newgameSave')): ?>

        <div class="alert alert-success">
            Your prise saved!
        </div>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Play', ['class' => 'btn btn-primary', 'name' => 'send', 'value' => 'play']) ?>
    </div>

<?php ActiveForm::end(); ?>
<ul>

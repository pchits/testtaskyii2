<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Real Prises'; 
?>
<h1>Real Prises</h1>

<?php if (Yii::$app->session->hasFlash('newpriseSubmitted')): ?>

        <div class="alert alert-success">
            New Real Prise was created!
        </div>

    <?php endif; ?>
    
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'quantity') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
<ul>

<?php foreach ($prises as $prise): ?>
    <li>
        <?= $prise->name ?>: 
        <?= $prise->quantity ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>